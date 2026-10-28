<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

$hover = etheme_get_option('product_img_hover');
$view = etheme_get_option('product_view');
$view_color = etheme_get_option('product_view_color');
$size = apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' );


// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

$show_counter = false;

if ( ! empty( $woocommerce_loop['show_counter'] ) )
    $show_counter = $woocommerce_loop['show_counter'];

if ( ! empty( $woocommerce_loop['hover'] ) )
    $hover = $woocommerce_loop['hover'];

if ( ! empty( $woocommerce_loop['product_view'] ) )
    $view = $woocommerce_loop['product_view'];

if ( ! empty( $woocommerce_loop['product_view_color'] ) )
    $view_color = $woocommerce_loop['product_view_color'];

if ( ! empty( $woocommerce_loop['size'] ) )
    $size = $woocommerce_loop['size'];

if ( etheme_get_custom_field('disable_grid_hover', $product->get_id()) ) {
    $hover = 'disable';
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
    $classes[] = 'first';
	$classes[] = 'grid-sizer';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}

if(!class_exists('YITH_WCWL')) {
	$classes[] = 'wishlist-disabled';
}

$classes[] = etheme_get_product_class( $woocommerce_loop['columns'] );

if ( ! empty( $woocommerce_loop['isotope'] ) && $woocommerce_loop['isotope'] || etheme_get_option( 'products_masonry' ) && is_shop() ) {
    $classes[] = 'et-isotope-item';
}

$classes[] = 'product-hover-' . $hover;
$classes[] = 'product-view-' . $view;
$classes[] = 'view-color-' . $view_color;

$product_settings = etheme_get_option('product_page_switchers');
$product_settings = $product_settings['enabled'];

if ( array_key_exists('product_page_addtocart', $product_settings) ) $classes[] = 'et_cart-on';
if ( array_key_exists('hide_buttons_mobile', $product_settings) ) $classes[] = 'hide-hover-on-mobile';

$view_mode = etheme_get_view_mode();

$full_title = $product_title = unicode_chars(get_the_title());
$title_limit = etheme_get_option('product_title_limit');

if ( $title_limit && strlen($product_title) > $title_limit) {
    $split = preg_split('/(?<!^)(?!$)/u', $product_title);
    $product_title = ($title_limit != '' && $title_limit > 0 && (count($split) >= $title_limit)) ? '' : $product_title;
    if ( $product_title == '' ) {
        for ($i=0; $i < $title_limit; $i++) { 
            $product_title .= $split[$i];
        }
        $product_title .= '...';
    }
}

?>
<div <?php wc_product_class( $classes ); ?>>
    <div class="content-product">
        <?php etheme_loader(); ?>
		<?php
		/**
		 * woocommerce_before_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item' );

		/**
		 * woocommerce_before_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );
		?>

        <?php if ( $view == 'booking' && $view_mode != 'list' && array_key_exists('product_page_productname', $product_settings) ): ?>
            <p class="product-title">
                <a href="<?php the_permalink(); ?>"><?php echo $product_title; ?></a>
            </p>
        <?php endif ?>

		<div class="product-image-wrapper hover-effect-<?php echo esc_attr( $hover ); ?>">

            <?php if ( $view != 'booking' ) etheme_product_availability(); ?>

			<a class="product-content-image" href="<?php the_permalink(); ?>" data-images="<?php echo etheme_get_image_list( $size ); ?>">
                <?php if ( $view == 'booking' ) etheme_product_availability(); ?>
				<?php if( $hover == 'swap' ) etheme_get_second_image( $size ); ?>
				<?php echo woocommerce_get_product_thumbnail( $size ); ?>
			</a>

            <?php if ($view == 'info' && $view != 'booking'): ?>
                <div class="product-mask">

                    <?php if (array_key_exists('product_page_productname', $product_settings)): ?>
                        <p class="product-title">
                            <a href="<?php the_permalink(); ?>"><?php echo $product_title; ?></a>
                        </p>
                    <?php endif ?>

                    <?php
                        /**
                         * woocommerce_after_shop_loop_item_title hook
                         *
                         * @hooked woocommerce_template_loop_rating - 5
                         * @hooked woocommerce_template_loop_price - 10
                         */
                        if (array_key_exists('product_page_price', $product_settings)) {
                            do_action( 'woocommerce_after_shop_loop_item_title' );
                        }
                    ?>
                </div>
            <?php endif ?>

            <?php if ( $view == 'booking' && $view_mode != 'list' ): ?>
                <?php if ( array_key_exists('product_page_price', $product_settings) ) do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
                <div class="product-excerpt">
                    <?php echo do_shortcode(get_the_excerpt()); ?>
                </div>
                <div class="product-excerpt">
                    <?php do_action( 'woocommerce_product_additional_information', $product ); ?>
                </div>
                <?php
                    if (array_key_exists('product_page_addtocart', $product_settings) && $view != 'booking' ) {
                        do_action( 'woocommerce_after_shop_loop_item' );
                    }
                ?>
            <?php endif ?>

            <?php if ($view == 'mask' || $view == 'mask2' || $view == 'mask3' || $view == 'default' || $view == 'info'): ?>
    			<footer class="footer-product">
                    <?php if ( $view == 'mask3' ): ?>
                        <?php echo etheme_wishlist_btn(); ?>
                    <?php else: ?>
                        <?php if (etheme_get_option('quick_view')): ?>
                            <span class="show-quickly" data-prodid="<?php echo $post->ID;?>"><?php esc_html_e('Quick View', 'xstore') ?></span>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php //if (array_key_exists('product_page_addtocart', $product_settings)) {
                        do_action( 'woocommerce_after_shop_loop_item' );
                    //}?>
                    <?php if ( $view == 'mask3' ): ?>
                        <?php if (etheme_get_option('quick_view')): ?>
                            <span class="show-quickly" data-prodid="<?php echo $post->ID;?>"><?php esc_html_e('Quick View', 'xstore') ?></span>
                         <?php endif ?>
                    <?php else: ?>
                        <?php echo etheme_wishlist_btn(); ?>
                    <?php endif; ?>
    			</footer>
            <?php endif ?>
		</div>

        <?php if ( ( $view != 'info' && $view != 'booking' || $view_mode == 'list' ) ): ?>
    		<div class="<?php if ( $view != 'light' ) : ?>text-center <?php endif; ?>product-details">

                <?php if ( $view == 'light' ) echo '<div class="light-left-side">'; ?>

    	        <?php if (array_key_exists('product_page_cats', $product_settings)): ?>
                    <?php etheme_product_cats(); ?>
    	        <?php endif ?>

    	        <?php if (array_key_exists('product_page_productname', $product_settings)): ?>
                    <p class="product-title">
                        <a href="<?php the_permalink(); ?>"><?php echo $product_title; ?></a>
                    </p>
    	        <?php endif ?>

                <?php if ( etheme_get_option( 'enable_brands' ) && etheme_get_option( 'product_page_brands' ) ) : ?>
                    <?php etheme_product_brands(); ?>
                <?php endif ?>

                <?php
                /**
                 * woocommerce_after_shop_loop_item_title hook
                 *
                 * @hooked woocommerce_template_loop_rating - 5
                 * @hooked woocommerce_template_loop_price - 10
                 */

                if ( array_key_exists('product_page_price', $product_settings) ) :
                    if ( $view != 'light' ) : ?>
                        <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
                    <?php else : ?>
                        <?php woocommerce_template_loop_rating(); ?>
                        <?php if ( $view_mode != 'list'  ): ?>
                            <div class="switcher-wrapper">
                                <div class="price-switcher">
                                    <div class="price-switch">
                                        <?php woocommerce_template_loop_price(); ?>
                                    </div>
                                    <div class="button-switch">
                                        <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ( $view_mode == 'list' ): ?>
                    <div class="product-excerpt">
                        <?php echo do_shortcode(get_the_excerpt()); ?>
                    </div>
                <?php endif ?>

                <?php if ( $view == 'light' && $view_mode == 'list' ) : ?>
                    <div class="switcher-wrapper">
                        <div class="price-switcher">
                            <div class="price-switch">
                                <?php woocommerce_template_loop_price(); ?>
                            </div>
                            <div class="button-switch">
                                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if( $show_counter ) etheme_product_countdown(); ?>

    			<?php

    				if ( array_key_exists('product_page_addtocart', $product_settings) && ! in_array( $view, array( 'mask', 'mask3', 'light' ) ) ) {
    					do_action( 'woocommerce_after_shop_loop_item' );
    				}
    			?>

                <?php if ( $view == 'light' ) echo '</div><!-- .light-left-side -->'; ?>

                <?php if ( $view == 'light' ) : ?>
                    <div class="light-right-side">
                        <?php if (etheme_get_option('quick_view')): ?>
                            <span class="show-quickly" data-prodid="<?php echo $post->ID;?>"><?php esc_html_e('Quick View', 'xstore') ?></span>
                        <?php endif; ?>

                        <?php echo etheme_wishlist_btn(); ?>
                    </div><!-- .light-right-side -->
                <?php endif; ?>
    		</div>
        <?php endif ?>
	</div><!-- .content-product -->
</div>