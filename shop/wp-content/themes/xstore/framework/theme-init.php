<?php  if ( ! defined('ETHEME_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Set Content Width
// **********************************************************************//  
if (!isset( $content_width )) $content_width = 1170;

// **********************************************************************// 
// ! Include CSS and JS
// **********************************************************************// 
if(!function_exists('etheme_enqueue_scripts')) {
    function etheme_enqueue_scripts() {
        if ( !is_admin() ) {

            $script_depends = array();

            if ( is_singular() && get_option( 'thread_comments' ) )
                wp_enqueue_script( 'comment-reply' );

            wp_enqueue_script('jquery');
            wp_enqueue_script('head', get_template_directory_uri().'/js/head.min.js');
            wp_enqueue_script('plugins', get_template_directory_uri().'/js/plugins.min.js',array(),false,true);
            wp_enqueue_script('hoverIntent', get_template_directory_uri().'/js/jquery.hoverIntent.js',array(),false,true);
            wp_enqueue_script('etheme', get_template_directory_uri().'/js/etheme.min.js',$script_depends,false,true);
            if ( etheme_get_option('thumbs_slider_vertical') && (class_exists('Woocommerce')) ) {
                if ( is_product() ) {
                    wp_enqueue_script('stick', get_template_directory_uri().'/js/slick.min.js');
                }
            }

            $etConf = array();
            $cartUrl = '#';

            if (class_exists('WooCommerce')) {
                $etConf['checkoutUrl'] = esc_url( wc_get_checkout_url() );
                $cartUrl = esc_url( wc_get_cart_url() );

                // dequeue woocommerce zoom scripts
                if ( ! etheme_get_option( 'product_zoom' ) ) {
                    wp_dequeue_script( 'zoom' );
                }
            }

            $etConf = array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'noresults' => esc_html__('No results were found!', 'xstore'),
                'successfullyAdded' => esc_html__('Product added.', 'xstore'),
                'checkCart' => esc_html__('Please check your ', 'xstore') . "<a href='". $cartUrl ."'>" . esc_html__('cart.', 'xstore') ."</a>",
                'catsAccordion' => etheme_get_option('cats_accordion'),
                'contBtn' => esc_html__('Continue shopping', 'xstore'),
                'checkBtn' => esc_html__('Checkout', 'xstore'),
                'menuBack' => esc_html__('Back', 'xstore'),
                'woocommerce' => (class_exists('Woocommerce') && current_theme_supports('woocommerce')),
            );

            

            wp_localize_script( 'etheme', 'etConfig', $etConf);
            // wp_dequeue_script('prettyPhoto');
            wp_dequeue_script('prettyPhoto-init');
        }
    }
}

add_action( 'wp_enqueue_scripts', 'etheme_enqueue_scripts', 30);

// **********************************************************************// 
// ! Add new images size
// **********************************************************************// 

if(!function_exists('etheme_image_sizes')) {
    function etheme_image_sizes() {
        add_image_size( 'shop_catalog_alt', 600, 600, true );
    }
    add_action( 'after_setup_theme', 'etheme_image_sizes');
}

// **********************************************************************// 
// ! Theme 3d plugins
// **********************************************************************// 
add_action( 'init', 'etheme_3d_plugins' );
if(!function_exists('etheme_3d_plugins')) {
    function etheme_3d_plugins() {
        if(function_exists( 'set_revslider_as_theme' )){
            set_revslider_as_theme();
        }
        if(function_exists( 'set_ess_grid_as_theme' )){
            set_ess_grid_as_theme();
        }
    }
}

if(!function_exists('etheme_vcSetAsTheme')) {
    add_action( 'vc_before_init', 'etheme_vcSetAsTheme' );
    function etheme_vcSetAsTheme() {
        if(function_exists( 'vc_set_as_theme' )){
            vc_set_as_theme();
        }
    }
}

if(!defined('YITH_REFER_ID')) {
    define('YITH_REFER_ID', '1028760');
}

define('BSF_6892199_NOTICES', false);

// **********************************************************************// 
// ! Ititialize theme css configuration
// **********************************************************************// 
add_action('wp_head', 'etheme_init');
if(!function_exists('etheme_init')) {
    function etheme_init() {
        if ( is_admin() ) return;

        global $post;

        $bread_bg = etheme_get_option('breadcrumb_bg');
        $post_id = etheme_get_page_id( true );
        if ( $post_id['id'] == NULL && isset( $post->ID ) ) {
            $post_id = $post->ID;
        }

        if( in_array($post_id['type'], array('page', 'shop', 'blog', 'portfolio')) && $post_id['id'] > 0 && has_post_thumbnail($post_id['id']) && ! is_tax( 'portfolio_category' ) ) {
            $bread_bg['background-image'] = wp_get_attachment_url( get_post_thumbnail_id($post_id['id']), 'large');
        }

        if( is_category() || is_tax('product_cat') ) {
            $term_id = get_queried_object()->term_id;

            if( $term_id && $image = get_term_meta( $term_id, '_et_page_heading', true ) ) {
                $bread_bg['background-image'] = $image;
            }
        }

        if ( is_tax( 'portfolio_category' ) ) {

            $portfolio_pages = get_pages(array(
                'meta_key' => '_wp_page_template',
                'meta_value' => 'portfolio.php'
            ));
            if ( ! empty( $portfolio_pages[0]->ID ) && has_post_thumbnail( $portfolio_pages[0]->ID ) ) {
               $bread_bg['background-image'] = get_the_post_thumbnail_url( $portfolio_pages[0]->ID, 'large' );
            }
        }

        ?>
        <style type="text/css">

            .page-heading {
            <?php if(!empty($bread_bg['background-color'])): ?>  background-color: <?php echo $bread_bg['background-color']; ?>;<?php endif; ?>
            <?php if(!empty($bread_bg['background-image'])): ?>  background-image: url(<?php echo $bread_bg['background-image']; ?>) ; <?php endif; ?>
            <?php if(!empty($bread_bg['background-attachment'])): ?>  background-attachment: <?php echo $bread_bg['background-attachment']; ?>;<?php endif; ?>
            <?php if(!empty($bread_bg['background-size'])): ?>  background-size: <?php echo $bread_bg['background-size']; ?>;<?php endif; ?>
            <?php if(!empty($bread_bg['background-repeat'])): ?>  background-repeat: <?php echo $bread_bg['background-repeat']; ?>;<?php  endif; ?>
            <?php if(!empty($bread_bg['background-position'])): ?>  background-position: <?php echo $bread_bg['background-position']; ?>;<?php endif; ?>
            }

        </style>
        <?php
    }
}


if(!function_exists('etheme_load_textdomain')) {

    add_action('after_setup_theme', 'etheme_load_textdomain');

    function etheme_load_textdomain(){
        /**
         * Load theme translations
         */
        load_theme_textdomain( 'xstore', get_template_directory() . '/languages' );

        $locale = get_locale();
        $locale_file = get_template_directory() . "/languages/$locale.php";
        if ( is_readable( $locale_file ) )
            require_once( $locale_file );
    }
}
