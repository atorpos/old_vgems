<?php  if ( ! defined('ETHEME_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Add classes to body
// **********************************************************************//

add_filter('body_class', 'etheme_add_body_classes');
if(!function_exists('etheme_add_body_classes')) {
    function etheme_add_body_classes($classes) {
        $post_template  = etheme_get_post_template();
        $l = etheme_page_config();

        $post_id = etheme_get_page_id();
        $ht = etheme_get_header_type();

        $id = $post_id['id'];

        $custom_header = etheme_get_custom_field('custom_header', $id);
        if ( ! empty($custom_header) && $custom_header != $ht && ($custom_header != 'inherit') ) {
            $ht = $custom_header;
        }

        if ( etheme_get_option('fixed_header') == 'fixed' ) { $fixed_type = 'et-header-fixed'; }
        elseif ( etheme_get_option('fixed_header') == 'smart' ) { $fixed_type = 'et-header-sticky'; }
        else { $fixed_type = 'et-fixed-disable'; }

        if( etheme_get_option( 'fixed_nav' ) != 'disable') $classes[] = 'fixed-' . etheme_get_option('fixed_nav');
        if( etheme_get_option( 'promo_auto_open' ) ) $classes[] = 'open-popup ';
        if( etheme_get_option( 'promo_open_scroll' ) ) $classes[] = 'scroll-popup ';
        if( in_array( $ht, array( 'vertical', 'vertical2' ) ) ) $classes[] = 'et-vertical-fixed';
        $classes[] = 'breadcrumbs-type-'.$l['breadcrumb'];
        $classes[] = etheme_get_option('main_layout');
        $classes[] = (etheme_get_option('cart_widget')) ? 'cart-widget-on' : 'cart-widget-off';
        $classes[] = (etheme_get_option('search_form')) ? 'search-widget-on' : 'search-widget-off';
        $classes[] = (etheme_get_option('header_full_width')) ? 'et-header-full-width' : 'et-header-boxed';
        $classes[] = (etheme_get_option('header_overlap') || etheme_get_custom_field('header_overlap', $id)) ? 'et-header-overlap' : 'et-header-not-overlap';
        $classes[] = $fixed_type;
        $classes[] = (etheme_get_option('smart_header_menu')) ? 'header-smart-responsive' : '';
        $classes[] = (etheme_get_option('top_panel')) ? 'et-toppanel-on' : 'et-toppanel-off';
        $classes[] = (etheme_get_option('site_preloader')) ? 'et-preloader-on' : 'et-preloader-off';
        $classes[] = (etheme_get_option('just_catalog')) ? 'et-catalog-on' : 'et-catalog-off';
        $classes[] = ( ( etheme_get_option('footer_fixed') || etheme_get_custom_field('footer_fixed', $id) == 'yes' ) && etheme_get_custom_field('footer_fixed', $id) != 'no' ) ? 'et-footer-fixed-on' : 'et-footer-fixed-off';
        $classes[] = ( etheme_get_option( 'search_form' ) != 'header' || etheme_get_option( 'top_wishlist_widget' ) != 'header' || etheme_get_option( 'cart_widget' ) != 'header' || ( etheme_get_option('top_links') != 'header' && etheme_get_option('top_links') != 'menu' ) ) ? 'shop-top-bar': '';
        $classes[] = ( wp_is_mobile()) ? 'mobile-device' : ''; // new
        $classes[] = (etheme_get_option('menu_full_width')) ? 'mega-menus-full-width' : '';
        // $classes[] = (etheme_get_option('menu_item_by_click')) ? 'menu-open-by-click' : '';

        if ( etheme_get_option( 'secondary_menu' ) ) {
            $classes[] = 'et-secondary-menu-on';
            $classes[] = 'et-secondary-visibility-' . etheme_get_option('secondary_menu_visibility');
            if( etheme_get_option('secondary_menu_visibility') == 'opened' ) {
                $classes[] = (etheme_get_option('secondary_menu_home')) ? 'et-secondary-on-home' : '';
                $classes[] = (etheme_get_option('secondary_menu_subpages')) ? 'et-secondary-on-subpages' : '';
            } else {
                $classes[] = (etheme_get_option('secondary_menu_darkening')) ? 'et-secondary-darkerning-on' : 'et-secondary-darkerning-off';
            }
        } else {
            $classes[] = 'et-secondary-menu-off';
        }

        $classes[] = 'global-post-template-' . $post_template;

        $classes[] = "global-header-" . $ht;

        $header_bg = etheme_get_option('header_bg_color');

        if( !empty($header_bg['background-color']) && $header_bg['background-color'] == 'transparent' ) {
            $classes[] = "body-header-transparent";
        }

        if(!etheme_get_option('product_name_signle')) {
            $classes[] = 'global-product-name-off';
        } else {
            $classes[] = 'global-product-name-on';
        }

        if( etheme_iphone_detect() ) $classes[] = 'iphone-browser';

        if ( class_exists( 'WooCommerce_Quantity_Increment' ) ) $classes[] = 'et_quantity-off';

        return $classes;
    }
}

if( ! function_exists('etheme_iphone_detect')) {
    function etheme_iphone_detect($user_agent=NULL) {
        if(!isset($user_agent)) {
            $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        }
        return (strstr($user_agent, " AppleWebKit/") && strstr($user_agent, " Safari/") && !strstr($user_agent, " CriOS"));//(strpos($user_agent, 'iPhone') !== FALSE);
    } 
}

if(!function_exists('etheme_bordered_layout')) {
    function etheme_bordered_layout() {

        if(etheme_get_option('main_layout') != 'bordered') return;

        ?>
            <div class="body-border-left"></div>
            <div class="body-border-top"></div>
            <div class="body-border-right"></div>
            <div class="body-border-bottom"></div> 
        <?php
    }
    add_action('et_after_body', 'etheme_bordered_layout');
}

if(!function_exists('etheme_page_background')) {
    function etheme_page_background() {

        $post_id = etheme_get_page_id();

        $bg_image = etheme_get_custom_field('bg_image', $post_id['id']);
        $bg_color = etheme_get_custom_field('bg_color', $post_id['id']);

        if( ! empty( $bg_image ) || ! empty( $bg_color ) ) {
            ?>
                <style type="text/css">
                    body {
                        <?php if( ! empty( $bg_color ) ): ?>
                            background-color: <?php echo $bg_color; ?>!important;
                        <?php endif; ?>
                        <?php if( ! empty( $bg_image ) ): ?>
                            background-image: url(<?php echo $bg_image; ?>)!important;
                        <?php endif; ?>
                    }
                </style>
            <?php
        }
    }
    add_action('wp_head', 'etheme_page_background');
}

if ( !function_exists('et_custom_styles') ) {
    function et_custom_styles () {

        $css = '';

        $preloader = etheme_get_option( 'preloader_img' );

        $et_selectors = array();

        $activeColor = (etheme_get_option('activecol')) ? etheme_get_option('activecol') : '#8a8a8a';

        // Top bar background color with opacity
        $top_bar_bg = etheme_get_option('top_bar_bg');
        $top_bar_opacity = etheme_get_option('top_bar_bg_opacity');
        $topBar_bg_color = (!empty($top_bar_bg['background-color']) && $top_bar_opacity < 1 && $top_bar_bg['background-color'] != 'transparent') ? $top_bar_bg['background-color'] : '';

        // Header background color with opacity
        $header_bg_color = etheme_get_option('header_bg');
        $header_bg_opacity = etheme_get_option('header_bg_opacity');
        $header_bg_color = (!empty($header_bg_color['background-color']) && $header_bg_opacity < 1 && $header_bg_color['background-color'] != 'transparent' ) ? et_hex_to_rgba($header_bg_color['background-color'],$header_bg_opacity) : '';

        // Fixed header background color with opacity 
        $fixed_header_bg_color = etheme_get_option('fixed_header_bg');
        $fixed_header_bg_opacity = etheme_get_option('fixed_header_bg_opacity');
        $fixed_header_bg_color = (!empty($fixed_header_bg_color['background-color']) && $fixed_header_bg_opacity < 1 && $fixed_header_bg_color['background-color'] != 'transparent' ) ? et_hex_to_rgba($fixed_header_bg_color['background-color'],$fixed_header_bg_opacity) : '';

        $header_padding = etheme_get_option('header_padding');
        if ( !empty($header_padding) ) {
            $header_padding = $header_padding['padding-top'] . ' ' . $header_padding['padding-right'] . ' ' . $header_padding['padding-bottom'] . ' ' . $header_padding['padding-left'];
        }
        $header_margin_bottom = etheme_get_option('header_margin_bottom');

        if ( ! empty( $header_padding ) && trim($header_padding) != '') {
            $css .= '@media only screen and (min-width: 993px) {
                .header-wrapper.header-advanced header > .container .container-wrapper,
                .header-wrapper header > .container .container-wrapper, 
                .header-smart-responsive .header-wrapper header > .container .container-wrapper,
                .header-wrapper.header-two-rows .header-top .container-top-wrapper,
                .header-wrapper.header-simple header > .container .container-wrapper {
                    padding: ' .$header_padding . ';
                }
                .header-wrapper.header-xstore2 header .container-wrapper,
                .header-center .container-wrapper,
                .header-wrapper.header-center2 .container-wrapper {
                    padding: ' . $header_padding . '!important;
                }
            }';
        }
        if ( ! empty($header_margin_bottom) ) {
            $css .= '.breadcrumbs-type-disable.et-header-not-overlap:not(.home) .header-wrapper {
                margin-bottom: ' . $header_margin_bottom . 'px;
            }';
        }

        $et_selectors['active_color'] = '
            .active-color,
            .cart-widget-products a:hover,
            .star-rating span:before,
            .price ins .amount,
            .big-coast .amount,
            .tabs .tab-title.opened,
            .tabs .tab-title:hover,
            .product-brands .view-products,
            .shipping-calculator-button,
            .views-count,
            .post-comments-count,
            .read-more,
            span.active,
            .active-link,
            .active-link:hover,
            ul.active > li:before,
            .author-info .author-link,
            .comment-reply-link,
            .lost_password a,
            .product-content .compare:hover:before,
            .product-content .compare.added:before,
            .footer-product .compare:hover:before,
            .footer-product .compare.added:before,
            .product-content .compare:hover,
            .mobile-menu-wrapper .links li a:hover,
            .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active>a,
            .page-404 .largest,
            .meta-post-timeline .time-mon,
            .portfolio-filters .active,
            .portfolio-item .firstLetter,
            .tabs .accordion-title.opened-parent:after,
            .item-design-mega-menu .item-level-1 > a:hover,
            .text-color-dark .category-grid .categories-mask span,
            .header-standard .navbar-header .et-wishlist-widget .fa,
            .team-member .member-details h5,
            .team-member .member-content .menu-social-icons li:hover i,
            .fixed-header .menu-wrapper .menu > li.current-menu-item > a,
            .et-header-not-overlap.header-wrapper .menu-wrapper .menu > li.current-menu-item > a,
            .sidebar-widget ul li > ul.children li > a:hover,
            .product-information .out-of-stock,
            .sidebar-widget li a:hover,
            #etheme-popup-holder .mfp-close:hover:before,
            .etheme_widget_brands li a strong,
            .widget_product_categories.sidebar-widget ul li.current-cat > a,
            .shipping-calculator-button:focus,
            table.cart .product-details a:hover,
            .mobile-menu-wrapper .menu li a:hover,
            .mobile-menu-wrapper .menu > li .sub-menu li a:hover,
            .mobile-menu-wrapper .menu > li .sub-menu .menu-show-all a,
            #review_form .stars a:hover:before, #review_form .stars a.active:before,
            .item-design-mega-menu .nav-sublist-dropdown .nav-sublist li.current-menu-item a,
            .item-design-dropdown .nav-sublist-dropdown ul > li.current-menu-item > a,
            .mobile-menu-wrapper .mobile-sidebar-widget.etheme_widget_socials a:hover,
            .mobile-sidebar-widget.etheme_widget_socials .et-follow-buttons.buttons-size-large a:hover,
            .product-view-mask2.view-color-transparent .footer-product .button:hover:before, .product-view-mask2.view-color-transparent .show-quickly:hover:before,
            .product-view-mask2.view-color-transparent .yith-wcwl-add-button a.add_to_wishlist:hover:before,
            .product-view-default .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse.show a:before, .product-view-default .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse.show a:before,
            .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse.show a:before, .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse.show a:before,
            .product-view-mask2.view-color-transparent .yith-wcwl-wishlistexistsbrowse a:hover:before, .product-view-mask2.view-color-transparent .yith-wcwl-wishlistaddedbrowse a:hover:before,
            .product-information .yith-wcwl-add-to-wishlist a:hover:before, .product-info-wrapper .yith-wcwl-add-to-wishlist a:hover:before, .product-summary-center .yith-wcwl-add-to-wishlist a:hover:before,
            .widget_product_categories.sidebar-widget ul li a:hover,
            .et-wishlist-widget .wishlist-dropdown li .product-title a:hover,
            .woocommerce-MyAccount-navigation li.is-active a,
            .wcpv-sold-by-single a,
            .sb-infinite-scroll-load-more:not(.finished):hover,
            .single-product-booking .product-side-information-inner .price .amount,
            .product-view-booking .price .amount,
            .product-view-booking .content-product .button.compare:hover,
            .secondary-menu-wrapper .menu li:hover >a,
            .secondary-menu-wrapper .nav-sublist-dropdown .menu-item-has-children .nav-sublist ul > li > a:hover,
            .secondary-menu-wrapper .item-design-dropdown.menu-item-has-children ul .item-level-1 a:hover,
            .product-information .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:not(.alt):before,
            .header-wrapper.header-advanced .header-search.act-default div.fancy-select ul.options li:hover,
            .mc4wp-alert.mc4wp-error,
            .et-tabs-wrapper.title-hover .tabs-nav li a span,
            .et-timer.product-sale-counter .time-block span,
            .fullscreen-menu .menu > li > a:hover,
            .slide-view-timeline2 .meta-post-timeline .time-day,
            article.content-timeline2 .timeline-content .meta-post-timeline .time-day,
            .content-grid2 .meta-post-timeline .time-day,
            .menu-social-icons li a:hover,
            body .team-member:hover .menu-social-icons i,
            body .team-member:hover .menu-social-icons li i:hover,
            .product-information .yith-wcwl-add-to-wishlist a:not(.alt):hover,
            .summary-content .yith-wcwl-add-to-wishlist a:not(.alt):hover,
            .product-view-booking .content-product .button.compare:hover:before,
            .et-menu-list .item-title-holder a:hover
            ';

        $et_selectors['active_bg'] = '
            .tagcloud a:hover,
            .button.active,
            .btn.active,
            .btn.active:hover,
            .btn-checkout,
            .btn-checkout:hover,
            .btn-advanced,
            .btn-underline:after,
            input[type="submit"].btn-advanced,
            .button:hover, .btn:hover, input[type="submit"]:hover,
            .type-label-2,
            .et-loader svg .outline,
            .header-search.act-default [role="searchform"] .btn:hover,
            .widget_product_categories .widget-title,
            .price_slider_wrapper .ui-slider .ui-slider-handle,
            .price_slider_wrapper .ui-slider-range,
            .pagination-cubic ul li span.current,
            .pagination-cubic ul li a:hover,
            .woocommerce-pagination ul li span.current,
            .woocommerce-pagination ul li a:hover,
            .view-switcher .switch-list:hover a,
            .view-switcher .switch-grid:hover a,
            .view-switcher .switch-list.switcher-active a,
            .view-switcher .switch-grid.switcher-active a,

            .tabs .tab-title.opened span:after,
            .wpb_tabs .wpb_tabs_nav li a.opened span:after,
            table.shop_table .remove-item:hover,
            .et-tabs-wrapper .tabs-nav li:after,
            .checkout-button,
            .active-link:before,
            .block-title .label,
            .form-row.place-order .button,
            .wp-picture .post-categories,
            .single-tags a:hover,
            .portfolio-filters li a:after,
            .form-submit input[type="submit"],
            body .et-isotope-item .et-timer .time-block span,
            .woocommerce table.wishlist_table .product-remove a:hover,
            .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a:after,
            .vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading a span:after,
            .posts-nav-btn:hover .button,
            .posts-nav-btn .post-info,
            #cboxClose:hover,
            .global-post-template-large .post-categories,
            .global-post-template-large2 .post-categories,
            .portfolio-item .portfolio-image,
            .header-standard.header-color-dark .ico-design-1 .cart-bag,
            .testimonials-slider .owl-buttons .owl-prev:hover, .testimonials-slider .owl-buttons .owl-next:hover,
            .item-design-posts-subcategories .posts-content .post-preview-thumbnail .post-category,
            .sidebar-slider .owl-carousel .owl-controls .owl-next:hover,
            .sidebar-slider .owl-carousel .owl-controls .owl-prev:hover,
            .ibox-block .ibox-symbol i,
            ol.active > li:before,
            span.dropcap.dark,
            .fixed-header .menu-wrapper .menu > li.current-menu-item > a:after,
            .etheme_widget_entries_tabs .tabs .tab-title:after,
            .articles-pagination .current, .articles-pagination a:hover,
            .product-information .yith-wcwl-add-to-wishlist a:hover:before,
            .product-information .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:before,
            .product-information .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:before,
            .top-panel-container .menu-social-icons a:hover,
            .wp-picture .blog-mask:before,
            .main-images .owl-controls .owl-prev:hover,
            .main-images .owl-controls .owl-next:hover,
            .thumbnails-list .owl-controls .owl-next:hover,
            .thumbnails-list .owl-controls .owl-prev:hover,
            .portfolio-single-item .menu-social-icons a:hover i,
            .flexslider .flex-direction-nav a:hover,
            .back-top:hover,
            .tagcloud a:hover,
            .footer.text-color-light .tagcloud a:hover,
            .widget_search button:hover,
            .thumbnails-list .video-thumbnail span,
            .carousel-area .owl-prev:hover,
            .carousel-area .owl-next:hover,
            .brands-carousel .owl-prev:hover, .owl-images-carousel .owl-prev:hover, .brands-carousel .owl-next:hover, .owl-images-carousel .owl-next:hover,
            .post-gallery-slider .owl-controls .owl-buttons >div:hover,
            .quantity.buttons_added span:hover,
            .openswatch_widget_layered_nav ul li.chosen, .openswatch_widget_layered_nav ul li:hover,
            ul.swatch li.selected,
            .open-filters-btn a:hover,
            .owl-carousel .owl-pagination .owl-page:hover, .owl-carousel .owl-pagination .owl-page.active,
            .zoom-images-button:hover, .open-video-popup:hover, .open-360-popup:hover,
            .et-products-navigation > div:hover,
            .et-looks .et-looks-nav li.active a,
            .et-looks .et-looks-nav li:hover a,
            .quick-view-popup .mfp-close:hover,
            .read-more:before,
            .team-member .member-image:before,
            #cookie-notice .button,
            #cookie-notice .button.bootstrap,
            #cookie-notice .button.wp-default,
            #cookie-notice .button.wp-default:hover,
            .mfp-image-holder .mfp-close:hover, .mfp-iframe-holder .mfp-close:hover,#product-video-popup .mfp-close:hover,
            .et-products-navigation > div:hover .swiper-nav-arrow,
            .product-view-default .footer-product .show-quickly,
            .et-tabs-wrapper .tabs-nav li:after,
            .et-tabs-wrapper .tabs .accordion-title:after,
            div.pp_default .pp_content_container a.pp_next:hover, div.pp_default .pp_content_container a.pp_previous:hover,
            .header-wrapper.header-advanced .header-search.act-default [role="searchform"] .btn,
            .content-framed .content-article .read-more,
            .l2d-body footer .coupon-code .cc-wrapper .closed-text,
            .et-tabs-wrapper.title-hover .tabs-nav li:hover a span:hover, .et-tabs-wrapper.title-hover .tabs-nav li.et-opened a span:hover,
            .et-tabs-wrapper.title-hover .tabs-nav .delimiter,
            .header-simple .menu-wrapper .menu > li > a:after,
            .global-header-simple .header-color-dark .cart-bag,
            .header-simple .menu-wrapper .menu > li > a:hover:after,
            .header-simple .menu-wrapper .menu > li.current-menu-item > a:after,
            .team-member.member-type-2:hover .content-section,
            .product-view-mask3 .footer-product .yith-wcwl-add-button a.add_to_wishlist, .product-view-mask3 .footer-product .yith-wcwl-wishlistexistsbrowse a, .product-view-mask3 .footer-product .yith-wcwl-wishlistaddedbrowse a,
            .product-view-mask3 .footer-product .yith-wcwl-add-button a.add_to_wishlist.alt:hover,
            .product-view-mask3 .footer-product .button,
            .product-view-mask3 .footer-product .button:hover,
            .product-view-mask3 .footer-product .show-quickly,
            .product-view-mask3 .footer-product .compare,
            .product-view-mask3 .content-product .footer-product .yith-wcwl-add-button a.add_to_wishlist,
            .slide-view-timeline2:hover .meta-post-timeline,
            .swiper-entry .swiper-custom-left:hover, .swiper-entry .swiper-custom-right:hover,
            .et_post-slider .swiper-custom-right:hover, .et_post-slider .swiper-custom-left:hover,
            .swiper-pagination .swiper-pagination-bullet-active,
            article.content-timeline2:hover .meta-post-timeline
            .content-grid2:hover .meta-post-timeline,
            .swiper-slide #loader-1 span,
            article.content-timeline2:hover .meta-post-timeline,
            .content-grid2:hover .meta-post-timeline,
            .et-wishlist-widget .wishlist-count, 
            .header-color-white .et-wishlist-widget .wishlist-count, 
            .header-color-dark .et-wishlist-widget .wishlist-count,
            .fixed-header .et-wishlist-widget .wishlist-count,
            .shopping-container.ico-design-1.ico-bg-yes .badge-number,
            .shopping-container:not(.ico-design-1) .cart-bag .badge-number
            ';

        $et_selectors['active_border'] = '
            .tagcloud a:hover,
            .button.active,
            .btn.active,
            .btn.active:hover,
            .btn-checkout,
            .btn-checkout:hover,
            .btn-advanced,
            input[type="submit"].btn-advanced,
            .button:hover, input[type="submit"]:hover, .btn:hover,
            .form-row.place-order .button,
            .pagination-cubic ul li span.current,
            .pagination-cubic ul li a:hover,
            .woocommerce-pagination ul li span.current,
            .woocommerce-pagination ul li a:hover,
            .form-submit input[type="submit"],
            .fixed-header,
            .single-product-center .quantity.buttons_added span:hover,
            .header-standard.header-color-dark .cart-bag:before,
            .articles-pagination .current, .articles-pagination a:hover,
            .widget_search button:hover,
            table.cart .remove-item:hover,
            .checkout-button,
            .openswatch_widget_layered_nav ul li.chosen,
            .openswatch_widget_layered_nav ul li:hover,
            .open-filters-btn a:hover,
            .header-standard.header-color-dark .cart-bag,
            .header-standard.header-color-dark .cart-summ:hover .cart-bag,
            .header-standard .header-standard.header-color-dark,
            .header-standard .shopping-container.ico-design-1.ico-bg-yes .cart-bag:before,
            .header-standard .shopping-container .cart-summ:hover .cart-bag:before,
            .header-standard .shopping-container.ico-design-1.ico-bg-yes .cart-bag,
            .et-tabs-wrapper .tabs-nav li.et-opened:before,
            .et-tabs-wrapper .tabs .accordion-title.opened:before,
            .secondary-menu-wrapper .menu,
            .secondary-menu-wrapper .menu li.menu-item-has-children > .nav-sublist-dropdown,
            .header-wrapper.header-advanced .secondary-title,
            .secondary-menu-wrapper .item-design-dropdown .nav-sublist-dropdown ul > li.menu-item-has-children:hover > .nav-sublist ul,
            .quantity.buttons_added span:hover,
            .et-offer,
            .et-tabs-wrapper.title-hover .tabs-nav li a span,
            .global-header-simple .header-color-dark .cart-bag,
            .global-header-simple .header-color-dark .cart-bag:before,
            .global-header-simple .header-color-dark .cart-summ:hover .cart-bag,
            .global-header-simple .header-color-dark .cart-summ:hover .cart-bag:before,
            .team-member.member-type-2:hover .content-section:before,
            .slide-view-timeline2 .meta-post-timeline,
            article.content-timeline2 .timeline-content .meta-post-timeline,
            .content-grid2 .meta-post-timeline,
            .content-grid2:hover .meta-post-timeline
            ';

        $et_selectors['active_stroke'] = '
            .et-loader svg .outline,
            .et-timer.dark .time-block .circle-box svg circle
            ';

            $keyframes = array();
            $keyframes['swiper-loader'] = '
                @-webkit-keyframes scale {
                    0% {
                    -webkit-transform: scale(0);
                            transform: scale(0);
                    }
                    25% {
                    -webkit-transform: scale(0.9, 0.9);
                            transform: scale(0.9, 0.9);
                    background: ' . $activeColor . ';
                    }
                    50% {
                    -webkit-transform: scale(1, 1);
                            transform: scale(1, 1);
                    margin: 0 3px;
                    background: ' . $activeColor . ';
                    }
                    100% {
                    -webkit-transform: scale(0);
                            transform: scale(0);
                    }
                    }
                    @keyframes scale {
                    0% {
                    -webkit-transform: scale(0);
                            transform: scale(0);
                    }
                    25% {
                    -webkit-transform: scale(0.9, 0.9);
                            transform: scale(0.9, 0.9);
                    background: ' . $activeColor . ';
                    }
                    50% {
                    -webkit-transform: scale(1, 1);
                            transform: scale(1, 1);
                    margin: 0 3px;
                    background: ' . $activeColor . ';
                    }
                    100% {
                    -webkit-transform: scale(0);
                            transform: scale(0);
                    }
                }
            ';

            $fonts = get_option( 'etheme-fonts', false );
            if ( $fonts ) {
                foreach ( $fonts as $value ) {
                    // ! Validate format
                    switch ( $value['file']['extension'] ) {
                        case 'ttf':
                            $format = 'truetype';
                            break;
                        case 'otf':
                            $format = 'opentype';
                            break;
                        case 'eot':
                            $format = false;
                            break;
                        case 'eot?#iefix':
                            $format = 'embedded-opentype';
                            break;
                        case 'woff2':
                            $format = 'woff2';
                            break;
                        case 'woff':
                            $format = 'woff';
                            break;
                        default:
                            $format = false;
                            break;
                    }

                    $format = ( $format ) ? 'format("' . $format . '")' : '';

                    // ! Set fonts
                    $css .= '
                        @font-face {
                            font-family: ' . $value['name'] . ';
                            src: url(' . $value['file']['url'] . ') ' . $format . ';
                        }
                    ';
                }
            }
            if ( ! empty( $preloader ) ) $css .= $keyframes['swiper-loader'];

            $css .= etheme_js2tring($et_selectors['active_color']) . '{ color: ' . $activeColor . '}';
            $css .= etheme_js2tring($et_selectors['active_bg']) . '{ background-color: ' . $activeColor . '}';
            $css .= etheme_js2tring($et_selectors['active_border']) . '{ border-color: ' . $activeColor . '}';
            $css .= etheme_js2tring($et_selectors['active_stroke']) . ' { stroke: ' . $activeColor . '}';

            $sale_zise = etheme_get_option('sale_icon_size');
            $sale_zise = explode( 'x', $sale_zise );

            if ( ! isset( $sale_zise[0] ) ) $sale_zise[0] = 3.75;
            if ( ! isset( $sale_zise[1] ) ) $sale_zise[1] = $sale_zise[0];

            $css .= '.onsale, .product-images .sale-value{
                color: ' . etheme_get_option('sale_icon_color') . ';
                background-color: ' . etheme_get_option('sale_icon_bg_color') . ';
                border-radius: ' . etheme_get_option('sale_br_radius') . '%;
                width: ' . $sale_zise[0] . 'em;
                height: ' . $sale_zise[1] . 'em;
                line-height: ' . $sale_zise[1] . 'em;
            }';

            $css .= '.et-header-full-width .main-header .container,
                .et-header-full-width .navigation-wrapper .container,
                .et-header-full-width .fixed-header .container {
                    max-width: ' . etheme_get_option('header_width') . 'px;
                }';

            $css .= '@media (min-width: 1200px){
                .container, div.container {
                    width: ' . etheme_get_option('site_width') . 'px;
                }

                .boxed .template-container, .framed .template-container{
                    width: ' . (etheme_get_option('site_width') + 30 ) . 'px;
                }

                .boxed .header-wrapper, .framed .header-wrapper{
                     width: ' . (etheme_get_option('site_width') + 30 ) . 'px;
                }
            }';

            if( ! empty( $header_bg_color)) {
                $css .= '.header-bg-block, .header-vertical, .header-vertical2 {
                    background-color: ' .$header_bg_color . '!important;
                }';
            }

            if ( !empty( $fixed_header_bg_color )) {
            $css .= '.fixed-header {
                background-color: ' . $fixed_header_bg_color . '!important;
            }';
        }
        if ( ! empty( $topBar_bg_color)) {
            $css .= '.top-bar {
                background-color: '. et_hex_to_rgba($topBar_bg_color, $top_bar_opacity) . '!important;
            }';
        }

        // Secondary menu 
        $secondary_menu_border_width = etheme_get_option('secondary-menu-border-width');
        $secondary_menu_border_width_style = '';
        if ( $secondary_menu_border_width ) {
            if ( isset($secondary_menu_border_width['border-right']) && !empty($secondary_menu_border_width['border-right'])) {
                $secondary_menu_border_width_style .= 'border-right-width:' . $secondary_menu_border_width['border-right'] . ' !important;';
            }
            if ( isset($secondary_menu_border_width['border-bottom']) && !empty($secondary_menu_border_width['border-bottom'])) {
                $secondary_menu_border_width_style .= 'border-bottom-width:' . $secondary_menu_border_width['border-bottom'] . ' !important;';
            }
            if ( isset($secondary_menu_border_width['border-left']) && !empty($secondary_menu_border_width['border-left'])) {
                $secondary_menu_border_width_style .= 'border-left-width:' . $secondary_menu_border_width['border-left'] . ' !important;';
            }
        }

        $secondary_menu_border_style = etheme_get_option('secondary-menu-border-style');
        $secondary_menu_border_style = (!empty($secondary_menu_border_style['border-style']) && $secondary_menu_border_style['border-style'] != 'solid') ? $secondary_menu_border_style['border-style'] : '';

        // Secondary links
        $secondary_links_border_style = etheme_get_option('secondary-links-border-style');
        $secondary_links_border_style = (!empty($secondary_links_border_style['border-style']) && $secondary_links_border_style['border-style'] != 'solid' ) ? $secondary_links_border_style['border-style'] : '';

        $secondary_links_border_width = etheme_get_option('secondary-links-border-width');
        $secondary_links_border_width = ($secondary_links_border_width != 1) ? $secondary_links_border_width : '';

        if ( !empty($secondary_menu_border_width_style) && trim($secondary_menu_border_width_style) != '' ) {
            $css .= '.secondary-menu-wrapper .menu, .header-wrapper.header-advanced .secondary-title{' . $secondary_menu_border_width_style . '}';
        }

        if ( trim($secondary_menu_border_style) != '' ) {
            $css .= '.secondary-menu-wrapper .menu {
                border-style:' . $secondary_menu_border_style .';
            }
            .header-wrapper.header-advanced .secondary-title {
                border-left-style: ' . $secondary_menu_border_style . ';
                border-right-style: ' . $secondary_menu_border_style . ';
            }';
        }

        if ( trim($secondary_links_border_style) != '' ) {
            $css .= '.secondary-menu-wrapper .menu > li:not(:last-child) > a {
                border-bottom-style: ' . $secondary_links_border_style . '!important;
            }
            .menu-wrapper .secondary-menu-wrapper .menu > li {
                border: none;
                border-color: transparent;
            }';
        }
        if (!empty($secondary_links_border_width) && trim($secondary_links_border_width) != '') {
            $css .= '.secondary-menu-wrapper .menu > li > a {
                border-bottom-width:' . $secondary_links_border_width . 'px;
            }';
        }

        $light_buttons_radius = etheme_get_option('light_buttons_border_radius');
        $dark_buttons_radius = etheme_get_option('dark_buttons_border_radius');
        $active_buttons_radius = etheme_get_option('active_buttons_border_radius');
        if ( $light_buttons_radius ) {
            $light_buttons_radius = $light_buttons_radius['border-top'] . ' ' . $light_buttons_radius['border-right'] . ' ' . $light_buttons_radius['border-left'] . ' ' . $light_buttons_radius['border-bottom'];
        }
        if ( $dark_buttons_radius ) {
            $dark_buttons_radius = $dark_buttons_radius['border-top'] . ' ' . $dark_buttons_radius['border-right'] . ' ' . $dark_buttons_radius['border-left'] . ' ' . $dark_buttons_radius['border-bottom'];
        }
        if ( $active_buttons_radius ) {
            $active_buttons_radius = $active_buttons_radius['border-top'] . ' ' . $active_buttons_radius['border-right'] . ' ' . $active_buttons_radius['border-left'] . ' ' . $active_buttons_radius['border-bottom'];
        }
        $menu_links_border_radius = etheme_get_option('menu-links-border-radius');
        if ( $menu_links_border_radius ) {
            $menu_links_border_radius = $menu_links_border_radius['border-top'] . ' ' . $menu_links_border_radius['border-right'] . ' ' . $menu_links_border_radius['border-left'] . ' ' . $menu_links_border_radius['border-bottom'];
        }
        // Menu links 
        $menu_links_border_style_o = etheme_get_option('menu-border-style');
        $menu_links_border_style = !empty($menu_links_border_style_o['border-style']) ? $menu_links_border_style_o['border-style'] : '';

        $menu_links_border_style_o = etheme_get_option('menu-border-style-hover');
        $menu_links_border_style_hover = !empty($menu_links_border_style_o['border-style']) ? $menu_links_border_style_o['border-style'] : '';

        $menu_dr_border_style_o = etheme_get_option('menu_dropdown_border_style');
        $menu_dropdown_border_style = !empty($menu_dr_border_style_o['border-style']) ? $menu_dr_border_style_o['border-style'] : '';

        // Fixed header links 
        $f_menu_links_border_style_o = etheme_get_option('f_menu-border-style');
        $f_menu_links_border_style = !empty($f_menu_links_border_style_o['border-style']) ? $f_menu_links_border_style_o['border-style'] : '' ;

        $f_menu_links_border_style_hover_o = etheme_get_option('f_menu-border-style-hover');
        $f_menu_links_border_style_hover = !empty($f_menu_links_border_style_hover_o['border-style']) ? $f_menu_links_border_style_hover_o['border-style'] : '';

        if ( ! empty($light_buttons_radius) && trim($light_buttons_radius) != '' )  {
            $css .= 'input[type="submit"], .open-filters-btn .btn, .content-product .product-details .button, .woocommerce table.wishlist_table td.product-add-to-cart a, .woocommerce-Button {
                border-radius:' . $light_buttons_radius . '!important;
            }';
        }
        if ( ! empty( $dark_buttons_radius ) && trim($dark_buttons_radius) != '' )  {
            $css .= '.et-wishlist-widget .wishlist-dropdown .buttons .btn-view-wishlist, .checkout-button, .single_add_to_cart_button.button, .shopping-container .btn-view-cart, .before-checkout-form .button, 
            form.login .button, form.register .button, .price_slider_wrapper .button, .empty-cart-block .btn {
                border-radius: ' . $dark_buttons_radius .';
                }';
        }
        if ( ! empty($active_buttons_radius) && trim($active_buttons_radius) != '' )  {
            $css .= '.btn-checkout, .form-submit input[type=submit], .form-row.place-order .button {
                border-radius:' . $active_buttons_radius . ';
            }';
        }
        if ( ! empty( $menu_links_border_radius) && trim($menu_links_border_radius) != '' )  {
            $css .= '.menu-wrapper .menu > li, .secondary-title, .fullscreen-menu .menu > li, .fullscreen-menu .menu > li, .header-wrapper.header-advanced .menu-wrapper .menu > li {
                border-radius:' . $menu_links_border_radius . ';
            }';
        }
        if ( !empty( $menu_links_border_style ) && trim($menu_links_border_style) != '' ) {
            $css .= '.menu-wrapper .menu > li, .secondary-title, .fullscreen-menu .menu > li, .fullscreen-menu .menu > li, .header-wrapper.header-advanced .menu-wrapper .menu > li {
                border-style:' . $menu_links_border_style . ';
            }';
        }
        if ( !empty( $menu_links_border_style_hover ) && trim($menu_links_border_style_hover) != '' ) {
            $css .= '.menu-wrapper .menu > li:hover, .secondary-title, .fullscreen-menu .menu > li:hover, .fullscreen-menu .menu > li:hover, .header-wrapper.header-advanced .menu-wrapper .menu > li:hover {
                border-style:' . $menu_links_border_style_hover . ';
            }';
        }
        if ( !empty( $menu_dropdown_border_style) && trim($menu_dropdown_border_style) != '' )  {
            $css .= '.nav-sublist-dropdown, .my-account-link ul {
                border-style:' . $menu_dropdown_border_style . ';
            }';
        }

        if ( ! empty($f_menu_links_border_radius) && trim($f_menu_links_border_radius) != '' )  {
            $css .= '.fixed-header .menu-wrapper .menu > li {
            border-radius:' . $f_menu_links_border_radius . ';
            }';
        }
        if ( !empty($f_menu_links_border_style) && trim($f_menu_links_border_style) != '' ) { 
            $css .= '.fixed-header .menu-wrapper .menu > li {
            border-style:' . $f_menu_links_border_style . '!important;
            }';
        }
        if ( !empty($f_menu_links_border_style_hover) && trim($f_menu_links_border_style_hover) != '' ) { 
            $css .= '.fixed-header .menu-wrapper .menu > li:hover {
            border-style:' . $f_menu_links_border_style_hover . '!important;
            }';
        }

        $custom_css = etheme_get_option('custom_css');
        $custom_css_desktop = etheme_get_option('custom_css_desktop');
        $custom_css_tablet = etheme_get_option('custom_css_tablet');
        $custom_css_wide_mobile = etheme_get_option('custom_css_wide_mobile');
        $custom_css_mobile = etheme_get_option('custom_css_mobile');
        if($custom_css != '') {
            $css .= $custom_css;
        }
        if($custom_css_desktop != '') {
            $css .= '@media (min-width: 993px) { ' . $custom_css_desktop . ' }';
        }
        if($custom_css_tablet != '') {
            $css .= '@media (min-width: 768px) and (max-width: 992px) {' . $custom_css_tablet . ' }';
        }
        if($custom_css_wide_mobile != '') {
            $css .= '@media (min-width: 481px) and (max-width: 767px) { ' . $custom_css_wide_mobile . ' }';
        }
        if($custom_css_mobile != '') {
            $css .= '@media (max-width: 480px) { ' . $custom_css_mobile . ' }';
        }
         
        $background_img = etheme_get_option('background_img');
        if(!empty($background_img['background-color'])) {
                $css .= '.bordered .body-border-left,
                .bordered .body-border-top,
                .bordered .body-border-right,
                .bordered .body-border-bottom {
                    background-color:' . $background_img['background-color'] . ';
            }';
        }
        $logo_width = etheme_get_option('logo_width');
    

        $css .= '.header-logo img {
            max-width:' . esc_html( $logo_width ) . 'px;
        }';

    
        $tab_height = etheme_get_option('tab_height');
        
        if( etheme_get_option('tabs_scroll') ) {
            $css .= '.tabs.accordion .tab-content .tab-content-inner {
                height:' . esc_html( $tab_height ) .'px!important;
            }';
        }
        $css = et_minify_css($css);
        return $css;
    }
}

if ( !function_exists('et_minify_css') ) {
    function et_minify_css ($css) {
        // Normalize whitespace
        $css = preg_replace( '/\s+/', ' ', $css );
        
        // Remove spaces before and after comment
        $css = preg_replace( '/(\s+)(\/\*(.*?)\*\/)(\s+)/', '$2', $css );
        // Remove comment blocks, everything between /* and */, unless
        // preserved with /*! ... */ or /** ... */
        $css = preg_replace( '~/\*(?![\!|\*])(.*?)\*/~', '', $css );
        // Remove ; before }
        $css = preg_replace( '/;(?=\s*})/', '', $css );
        // Remove space after , : ; { } */ >
        $css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );
        // Remove space before , ; { } ( ) >
        $css = preg_replace( '/ (,|;|\{|}|>)/', '$1', $css );
        // Strips leading 0 on decimal values (converts 0.5px into .5px)
        $css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
        // Strips units if value is 0 (converts 0px to 0)
        $css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );
        // Converts all zeros value into short-hand
        $css = preg_replace( '/0 0 0 0/', '0', $css );
        // Shortern 6-character hex color codes to 3-character where possible
        $css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );
        return trim( $css );
    
    }
}

if( ! function_exists('etheme_woocommerce_installed') ) {
    function etheme_woocommerce_installed() {
        return class_exists('WooCommerce');
    }
}


// **********************************************************************// 
// ! WooCommerce active notice
// **********************************************************************// 
if( ! function_exists('etheme_woocommerce_notice') ) {
    function etheme_woocommerce_notice($notice = '') {
        if ( ! etheme_woocommerce_installed() ) {
            if ( $notice == '' ) $notice = esc_html__( 'To use this element install or activate WooCommerce plugin', 'etheme' );
            echo '<0>' . $notice . '</p>';
            return true;
        } else {
            return false;
        }
    }
}

// **********************************************************************// 
// ! Header color
// **********************************************************************// 
if( ! function_exists('etheme_get_header_color') ) {
    function etheme_get_header_color() {
        global $post;
        $color = etheme_get_option('header_color');
        if ( wp_is_mobile() ) {
            $color = etheme_get_option('mobile_header_color');
        }
        $post_id = etheme_get_page_id();

        $id = $post_id['id'];

        $custom = etheme_get_custom_field('header_color', $id);

        if( ! empty( $custom ) && $custom != 'inherit' ) {
            $color = $custom;
        }

        return $color;
    }
}

// **********************************************************************// 
// ! Header top bar color
// **********************************************************************// 

if( ! function_exists('etheme_get_tb_color') ) {
    function etheme_get_tb_color() {
        global $post;
        $color = etheme_get_option('top_bar_color');

        $post_id = etheme_get_page_id();

        $id = $post_id['id'];

        $custom = etheme_get_custom_field('top_bar_color', $id);

        if( ! empty( $custom ) && $custom != 'inherit' ) {
            $color = $custom;
        }

        return $color;
    }
}

// **********************************************************************// 
// ! Wp title
// **********************************************************************// 
if(!function_exists('etheme_wp_title')) {
    function etheme_wp_title($title, $sep ) {
        global $paged, $page;

        if ( is_feed() ) {
            return $title;
        }

        // Add the site name.
        $title .= get_bloginfo( 'name', 'display' );

        // Add the site description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) ) {
            $title = "$title $sep $site_description";
        }

        // Add a page number if necessary.
        if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
            $title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'xstore' ), max( $paged, $page ) );
        }

        return $title;
    }
    add_filter( 'wp_title', 'etheme_wp_title', 10, 2 );
}

if(!function_exists('etheme_get_the_title')) {
    function etheme_get_the_title() {

        $post_page = get_option( 'page_for_posts' );

        if( is_404() ) {
            return esc_html__('Page not found', 'xstore');
        }

        if(is_home()) {
            if( empty( $post_page) && ! is_single() && ! is_page() ) {
                return esc_html__('Blog', 'xstore');
            }
            return get_the_title( $post_page );
        }

        // Homepage and Single Page
        if ( is_home() || is_single() || is_404() ) {
            return get_the_title();
        }

        // Search Page
        if ( is_search() ) {
            return sprintf( esc_html__( 'Search Results for: %s', 'xstore' ), get_search_query() );
        }

        // Archive Pages
        if ( is_archive() ) {
            if ( is_author() ) {
                return sprintf( esc_html__( 'All posts by %s', 'xstore' ), get_the_author() );
            }
            elseif ( is_day() ) {
                return sprintf( esc_html__( 'Daily Archives: %s', 'xstore' ), get_the_date() );
            }
            elseif ( is_month() ) {
                return sprintf( esc_html__( 'Monthly Archives: %s', 'xstore'), get_the_date( _x( 'F Y', 'monthly archives date format', 'xstore' ) ) );
            }
            elseif ( is_year() ) {
                return sprintf( esc_html__( 'Yearly Archives: %s', 'xstore' ), get_the_date( _x( 'Y', 'yearly archives date format', 'xstore' ) ) );
            }
            elseif ( is_tag() ) {
                return sprintf( esc_html__( 'Tag Archives: %s', 'xstore' ), single_tag_title( '', false ) );
            }
            elseif ( is_category() ) {
                return sprintf( esc_html__( 'Category Archives: %s', 'xstore' ), single_cat_title( '', false ) );
            }
            elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
                return esc_html__( 'Asides', 'xstore' );
            }
            elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
                return esc_html__( 'Videos', 'xstore' );
            }
            elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
                return esc_html__( 'Audio', 'xstore' );
            }
            elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
                return esc_html__( 'Quotes', 'xstore' );
            }
            elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
                return esc_html__( 'Galleries', 'xstore' );
            }
            elseif ( is_tax( 'portfolio_category' ) ) {
                return single_term_title();
            }
            elseif( function_exists('is_bbpress') && is_bbpress() ){
                return esc_html__('Forums', 'xstore');
            }
            else {
                return esc_html__( 'Archives', 'xstore' );
            }
        }

        return get_the_title();
    }
}



// **********************************************************************// 
// ! Header Type
// **********************************************************************// 
if(!function_exists('etheme_get_header_type')) {
    function etheme_get_header_type() {
        $ht = etheme_get_option('header_type');
        $page = etheme_get_page_id();
        $page_id = $page['id'];
        $custom_header = etheme_get_custom_field('custom_header', $page_id);
        if ( ! empty($custom_header) && $custom_header != $ht && ( $custom_header != 'inherit') ) {
            $ht = $custom_header;
        }
        apply_filters('custom_header_filter', $ht );
        return $ht;
    }

}

// **********************************************************************// 
// ! Get logo
// **********************************************************************// 

if(!function_exists('etheme_get_logo_data')) {
    function etheme_get_logo_data() {
        $return = array(
            'logo' => array(),
            'fixed_logo' => array()
        );

        $logo_fixed = etheme_get_option('logo_fixed');
        if(!is_array($logo_fixed)) {
            $logo_fixed = array('url' => $logo_fixed);
        }

        $logoimg = etheme_get_option('logo');


        if(empty($logo_fixed['url'])) {
            $logo_fixed = $logoimg;
        }

        $page = etheme_get_page_id();

        $custom_logo = etheme_get_custom_field('custom_logo', $page['id'] );

        if($custom_logo != '') {
            $logoimg['url'] = $custom_logo;
        }

        $return['logo']['src'] = (!empty($logoimg['url'])) ? $logoimg['url'] : ETHEME_BASE_URI.'theme/assets/images/logo.png';
        $return['fixed_logo']['src'] = (!empty($logo_fixed['url'])) ? $logo_fixed['url'] : ETHEME_BASE_URI.'theme/assets/images/logo-fixed.png';

        if( is_ssl() ) {
            $return['logo']['src'] = str_replace('http://', 'https://', $return['logo']['src']);
            $return['fixed_logo']['src'] = str_replace('http://', 'https://', $return['fixed_logo']['src']);
        }

        $return['logo']['alt'] = '';
        $return['fixed_logo']['alt'] ='';

        if ( isset( $logoimg['id'] ) && $logoimg['id'] != '') {
            $return['logo']['alt'] = get_post_meta( $logoimg['id'], '_wp_attachment_image_alt', true ) ;
            $return['fixed_logo']['alt'] = get_post_meta( $logo_fixed['id'], '_wp_attachment_image_alt', true ) ;
        }

        if ( $return['logo']['alt'] == '' )  $return['logo']['alt'] = get_bloginfo( 'description' );
        if ( $return['fixed_logo']['alt'] == '' )  $return['logo']['alt'] = get_bloginfo( 'description' );    
        $return['logo']['width'] = (!empty($logoimg['width'])) ? $logoimg['width'] : 259;
        $return['logo']['height'] = (!empty($logoimg['height'])) ? $logoimg['height'] : 45;      
        $return['fixed_logo']['width'] = (!empty($logo_fixed['width'])) ? $logo_fixed['width'] : 259;
        $return['fixed_logo']['height'] = (!empty($logo_fixed['height'])) ? $logo_fixed['height'] : 45;

        return $return;
    }
}

// **********************************************************************// 
// ! Let's group all login, account and registration links together :)
// **********************************************************************//

if ( ! function_exists('etheme_sign_link') ) {
    function etheme_sign_link ($short = false) {
        $links = array();
        $login_link = wp_login_url( get_permalink() );
        if( class_exists('WooCommerce')) {
            $login_link = get_permalink( get_option('woocommerce_myaccount_page_id') );
        }
        $reg_id = etheme_tpl2id('et-registration.php');
        $class = ( etheme_get_header_type() == 'hamburger-icon' || etheme_get_option('sign_in_type') == 'icon' ) ? ' type-icon' : '';
        if (etheme_get_option('sign_in_type') == 'text_icon') {
            $class = ' type-icon-text';
        }
        if ( is_user_logged_in() ) {
            if( class_exists('WooCommerce')) {
                if ( has_nav_menu( 'my-account' ) ) { 
                    $submenu = wp_nav_menu(array(
                        'theme_location' => 'my-account',
                        'before' => '',
                        'container_class' => 'menu-main-container',
                        'after' => '',
                        'link_before' => '',
                        'link_after' => '',
                        'depth' => 100,
                        'fallback_cb' => false,
                        'walker' => new ETheme_Navigation,
                        'echo' => false
                    ));
                } else {
                    $sub_class = (etheme_get_option('top_links') == 'menu') ? 'nav-sublist-dropdown' : '';
                    $submenu = '<ul class="'.$sub_class.'">';
                    $permalink = wc_get_page_permalink( 'myaccount' );

                    foreach ( wc_get_account_menu_items() as $endpoint => $label ) {
                        $url = ( $endpoint != 'dashboard' ) ? wc_get_endpoint_url( $endpoint, '', $permalink ) : $permalink ;
                        $submenu .= '<li class="' . wc_get_account_menu_item_classes( $endpoint ) . '"><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
                    }

                    $submenu .= '</ul>';
                }

                $links['my-account'] = array(
                    'class' => 'my-account-link' . $class,
                    'link_class' => '',
                    'href' => get_permalink( get_option('woocommerce_myaccount_page_id') ),
                    'title' => esc_html__( 'My Account', 'xstore' ),
                    'submenu' => $submenu
                );

            }
            // $links['logout'] = array(
            //     'class' => 'logout-link' . $class,
            //     'link_class' => '',
            //     'href' => wp_logout_url(home_url()),
            //     'title' => esc_html__( 'Logout', 'xstore' )
            // );
        } else {

            $login_text = ($short) ? esc_html__( 'Sign In', 'xstore' ): esc_html__( 'Sign In or Create an account', 'xstore' );
            $login_text = (etheme_get_option('sign_in_text') != '') ? etheme_get_option('sign_in_text') : $login_text;

            $links['login'] = array(
                'class' => 'login-link' . $class,
                'link_class' => '',
                'href' => $login_link,
                'title' => $login_text
            );

            if(!empty($reg_id)) {
                $links['register'] = array(
                    'class' => 'register-link' . $class,
                    'link_class' => '',
                    'href' => get_permalink($reg_id),
                    'title' => esc_html__( 'Register', 'xstore' )
                );
            }

        }
        return $links;
    }
}

// **********************************************************************// 
// ! Show the account and registration links
// **********************************************************************//

if ( ! function_exists('etheme_show_sign_link') ) {
    function etheme_show_sign_link ($class = '', $sublist = false) {
        $links = etheme_sign_link(false, $sublist);
        $ex_links = '';
        // through the foreach because there can be registration, my account, or login element
        foreach ($links as $link):

            $submenu = '';

            $li_class = $class . ' ' . $link['class'];

            if( isset( $link['submenu'] ) ) {
                $submenu = $link['submenu'];
            }

            $ex_links .= sprintf(
                (etheme_get_option('top_links') == 'menu') ? '<li class="%s"><a href="%s" class="%s">%s</a>%s</li>' : '<div class="%s"><a href="%s" class="%s">%s</a>%s</div>',
                $li_class,
                $link['href'],
                $link['link_class'],
                $link['title'],
                $submenu
            );
        endforeach;

        return $ex_links;

    }
}

// **********************************************************************// 
// ! Get top links
// **********************************************************************// 

if(!function_exists('etheme_get_links')) {
    function etheme_get_links($args, $account) {
        extract(shortcode_atts(array(
            'short'  => false,
            'popups'  => true,
        ), $args));
        $links = array();

        if(etheme_get_option('promo_popup')) {
            $links['popup'] = array(
                'class' => 'popup_link',
                'link_class' => 'etheme-popup',
                'href' => '#etheme-popup-holder',
                'title' => etheme_get_option('promo-link-text'),
            );
            if(!etheme_get_option('promo_link')) {
                $links['popup']['class'] .= ' hidden';
            }
            if(etheme_get_option('promo_auto_open')) {
                $links['popup']['link_class'] .= ' open-click';
            }
        }

        if ( $account ) {
            $sign_in = etheme_sign_link($short);
            $links = array_merge($links, $sign_in);
        }

        return apply_filters('etheme_get_links', $links);
    }
}

// **********************************************************************// 
// ! Get gallery from content
// **********************************************************************//
if(!function_exists('etheme_gallery_from_content')) {
    function etheme_gallery_from_content($content) {

        $result = array(
            'ids' => array(),
            'filtered_content' => ''
        );

        preg_match('/\[gallery.*ids=.(.*).\]/', $content, $ids);
        if(!empty($ids)) {
            $result['ids'] = explode(",", $ids[1]);
            $content =  str_replace($ids[0], "", $content);
            $result['filtered_content'] = apply_filters( 'the_content', $content);
        }

        return $result;

    }
}

// **********************************************************************// 
// ! Get post classes
// **********************************************************************//
if(!function_exists('etheme_post_class')) {
    function etheme_post_class($cols = false, $layout = false ) {
        global $et_loop;

        $classes = array();
        $classes[] = 'blog-post';

        if($cols) {
            $classes[] = 'post-grid';
            $classes[] = 'isotope-item';
            $classes[] = 'col-md-' . $cols;
        }

        if(etheme_get_option('blog_byline')) {
            $classes[] = ' byline-on';
        } else {
            $classes[] = ' byline-off';
        }

        if( ! $layout ) {
            $classes[] = ' content-'.etheme_get_option('blog_layout');
        } else {
            $classes[] = ' content-'.$layout;
        }

        if( ! empty( $et_loop['slide_view'] ) ) {
            $classes[] = 'slide-view-' . $et_loop['slide_view'];
        }

        if( ! empty( $et_loop['blog_align'] ) ) {
            $classes[] = ' blog-align-' . $et_loop['blog_align'];
        }

        return $classes;
    }
}


// **********************************************************************// 
// ! Get post template
// **********************************************************************//
if(!function_exists('etheme_get_post_template')) {
    function etheme_get_post_template() {
        $template = etheme_get_option('post_template');

        $custom = etheme_get_custom_field('post_template');

        if( ! empty( $custom ) ) {
            $template = $custom;
        }

        return $template;
    }
}


// **********************************************************************// 
// ! Get grid cols
// **********************************************************************//
if(!function_exists('etheme_get_cols')) {
    function etheme_get_cols($columns ) {

        if( $columns < 1 ) {
            $columns = 1;
        }

        $cols = 12/$columns;

        return $cols;
    }
}


// **********************************************************************// 
// ! Get column class bootstrap
// **********************************************************************// 

if(!function_exists('etheme_get_product_class')) {
    function etheme_get_product_class($colums = 3 ) {
        $cols = 12 / $colums;

        $small = 6;
        $extra_small = 6;

        $class = 'col-md-' . $cols;
        $class .= ' col-sm-' . $small;
        $class .= ' col-xs-' . $extra_small;

        return $class;
    }
}


// **********************************************************************// 
// ! Get read more button text
// **********************************************************************//
if(!function_exists('etheme_get_read_more')) {
    function etheme_get_read_more() {
        $class = 'read-more';
        if ( etheme_get_option( 'read_more' ) == 'btn' ) $class .= ' btn medium active';
        return '<span class="' . $class . '">' . esc_html__( 'Continue reading', 'xstore' ) . '</span>';
    }
}

// **********************************************************************//
// ! Views coutner
// **********************************************************************//

if(!function_exists('etheme_get_views')) {
    function etheme_get_views($id = false) {
        if( ! $id ) {
            $id = get_the_ID();
        }
        $number = get_post_meta( $id, '_et_views_count', true );
        if( empty($number) ) $number = 0;
        return $number;
    }
}

add_action( 'wp', 'etheme_update_views');

if(!function_exists('etheme_update_views')) {
    function etheme_update_views() {
        if( ! is_single() || ! is_singular( 'post' ) ) return;

        $id = get_the_ID();

        $number = etheme_get_views( $id );
        if( empty($number) ) {
            $number = 1;
            add_post_meta( $id, '_et_views_count', $number );
        } else {
            $number++;
            update_post_meta( $id, '_et_views_count', $number );
        }
    }
}


if(!function_exists('etheme_has_post_audio')) {
    function etheme_has_post_audio() {
        $post_audio = etheme_get_custom_field('post_audio');
        if( ! empty( $post_audio ) ) {
            return true;
        }
        return false;
    }
}

if(!function_exists('etheme_the_post_audio')) {
    function etheme_the_post_audio() {
        $audio = etheme_get_custom_field('post_audio');

        if(!empty($audio)) {
            echo do_shortcode( $audio );
        }

    }
}

if(!function_exists('etheme_the_post_quote')) {
    function etheme_the_post_quote($id = false ) {
        if( ! $id ) $id = get_the_ID();
        $quote = etheme_get_custom_field('post_quote', $id);

        if(!empty($quote)) {
            echo do_shortcode( $quote );
        }

    }
}

if(!function_exists('etheme_has_post_video')) {
    function etheme_has_post_video() {
        $post_video = etheme_get_custom_field('post_video');
        if( ! empty( $post_video ) ) {
            return true;
        }
        return false;
    }
}

if(!function_exists('etheme_the_post_video')) {
    function etheme_the_post_video() {
        $url = etheme_get_custom_field('post_video');

        $embed =  VideoUrlParser::get_url_embed($url);
        if(!empty($embed)) {
            ?>
                <iframe width="100%" height="560" src="<?php echo $embed; ?>" frameborder="0" allowfullscreen></iframe>
            <?php
        }

    }
}

if(!function_exists('etheme_get_primary_category')) {
    function etheme_get_primary_category() {
        $primary = false;
        $cat = etheme_get_custom_field('primary_category');
        if(!empty($cat) && $cat != 'auto') {
            $primary = get_term_by( 'slug', $cat, 'category' );
        } else {
            $cats = wp_get_post_categories(get_the_ID());
            if( isset($cats[0]) ) {
                $primary = get_term_by( 'id', $cats[0], 'category' );
            }
        }
        if( $primary ) {
            $term_link = get_term_link( $primary );
            echo '<a href="' . esc_url( $term_link ) . '">' . $primary->name . '</a>';
        }
    }
}

// **********************************************************************// 
// ! Custom Comment Form
// **********************************************************************// 

if(!function_exists('etheme_custom_comment_form')) {
    function etheme_custom_comment_form($defaults) {
        $defaults['comment_notes_before'] = '
            <p class="comment-notes">
                <span id="email-notes">' . esc_html__( 'Your email address will not be published. Required fields are marked', 'xstore' ) . '</span>
            </p>';
        $defaults['comment_notes_after'] = '';
        $defaults['id_form'] = 'comments_form';

        $defaults['comment_field'] = '<div class="form-group"><label for="comment" class="control-label">'.__('Your Comment', 'xstore').'</label><textarea placeholder="' . esc_html__('Comment', 'xstore') . '" class="form-control required-field"  id="comment" name="comment" cols="45" rows="12" aria-required="true"></textarea></div>';

        return $defaults;
    }
}

add_filter('comment_form_defaults', 'etheme_custom_comment_form');

if(!function_exists('etheme_custom_comment_form_fields')) {
    function etheme_custom_comment_form_fields() {
        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $reqT = '<span class="required">*</span>';
        $aria_req = ($req ? " aria-required='true'" : ' ');
        $consent  = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
        $fields = array(
            'author' => '<div class="form-group comment-form-author">'.
                            '<label for="author" class="control-label">'.esc_html__('Name', 'xstore').' '.($req ? $reqT : '').'</label>'.
                            '<input id="author" name="author" placeholder="' . esc_html__('Your name (required)', 'xstore') . '" type="text" class="form-control ' . ($req ? ' required-field' : '') . '" value="' . esc_attr($commenter['comment_author']) . '" size="30" ' . $aria_req . '>'.
                        '</div>',
            'email' => '<div class="form-group comment-form-email">'.
                            '<label for="email" class="control-label">'.esc_html__('Email', 'xstore').' '.($req ? $reqT : '').'</label>'.
                            '<input id="email" name="email" placeholder="' . esc_html__('Your email (required)', 'xstore') . '" type="text" class="form-control ' . ($req ? ' required-field' : '') . '" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" ' . $aria_req . '>'.
                        '</div>',
            'url' => '<div class="form-group comment-form-url">'.
                            '<label for="url" class="control-label">'.esc_html__('Website', 'xstore').'</label>'.
                            '<input id="url" name="url" placeholder="' . esc_html__('Your website', 'xstore') . '" type="text" class="form-control" value="' . esc_attr($commenter['comment_author_url']) . '" size="30">'.
                        '</div>',

            'cookies' => '
                <p class="comment-form-cookies-consent">
                    <label for="wp-comment-cookies-consent">
                        <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '
                        <span>' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'xstore' ) . '</span>
                    </label>
                </p>',
        );

        return $fields;
    }
}

add_filter('comment_form_default_fields', 'etheme_custom_comment_form_fields');

// **********************************************************************// 
// ! Set exerpt 
// **********************************************************************//
if(!function_exists('etheme_excerpt_length')) {
    function etheme_excerpt_length( $length ) {
        return etheme_get_option('excerpt_length');
    }
}

add_filter( 'excerpt_length', 'etheme_excerpt_length', 999 );

if( ! function_exists( 'etheme_excerpt_more' ) ) {
    function etheme_excerpt_more( $more ) {
        return etheme_get_option( 'excerpt_words' );
    }
}

add_filter( 'excerpt_more', 'etheme_excerpt_more', 9999 );


// **********************************************************************// 
// ! Enable shortcodes in text widgets
// **********************************************************************// 
add_filter('widget_text', 'do_shortcode');


// **********************************************************************// 
// ! Add Facebook Open Graph Meta Data
// **********************************************************************// 

//Adding the Open Graph in the Language Attributes
if(!function_exists('etheme_add_opengraph_doctype')) {
    function etheme_add_opengraph_doctype($output ) {
        return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
    }
}
add_filter('language_attributes', 'etheme_add_opengraph_doctype');


if(!function_exists('etheme_excerpt')) {
    function etheme_excerpt($text, $excerpt){
        if ($excerpt) return $excerpt;

        $text = strip_shortcodes( $text );

        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);
        $text = strip_tags($text);
        $excerpt_length = apply_filters('excerpt_length', 55);
        $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
        $words = preg_split("/[\n
         ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
        if ( count($words) > $excerpt_length ) {
                array_pop($words);
                $text = implode(' ', $words);
                $text = $text . $excerpt_more;
        } else {
                $text = implode(' ', $words);
        }

        return apply_filters('wp_trim_excerpt', $text, $excerpt);
        }
}

// **********************************************************************//
// ! Search, search SKU
// **********************************************************************/

add_action('pre_get_posts', 'etheme_search_all_sku_query');
function etheme_search_all_sku_query($query){
   if ( is_search() && etheme_get_option('search_by_sku')) {
       add_filter('posts_join', 'etheme_search_post_join');
       add_filter('posts_where', 'etheme_search_post_excerpt');
   }

}

function etheme_search_post_join($join = ''){

   global $wp_the_query, $wpdb;

   // default
   $prefix = 'wp_';
   if ( $wpdb->prefix ) {
       // current site prefix
       $prefix = $wpdb->prefix;
   } elseif ( $wpdb->base_prefix ) {
       // wp-config.php defined prefix
       $prefix = $wpdb->base_prefix;
   }

   // escape if not woocommerce searcg query
   if ( empty( $wp_the_query->query_vars['wc_query'] ) || empty( $wp_the_query->query_vars['s'] ) )
       return $join;

   $join .= 'INNER JOIN '.$prefix.'postmeta AS jcmt1 ON ('.$prefix.'posts.ID = jcmt1.post_id)';

   return $join;
}


if ( ! function_exists( 'etheme_search_post_excerpt' ) ) :

    function etheme_search_post_excerpt($where = ''){

       global $wp_the_query;
       global $wpdb;

       // escape if not woocommerce search query
       if ( empty( $wp_the_query->query_vars['wc_query'] ) || empty( $wp_the_query->query_vars['s'] ) ) return $where;

       $s = $wp_the_query->query_vars['s'];

       $prefix = 'wp_';
       if ( $wpdb->prefix ) {
           // current site prefix
           $prefix = $wpdb->prefix;
       } elseif ( $wpdb->base_prefix ) {
           // wp-config.php defined prefix
           $prefix = $wpdb->base_prefix;
       }

        // ! Fix for wpml
        if ( defined( 'ICL_LANGUAGE_CODE' ) && ! defined( 'LOCO_LANG_DIR' ) ){
            $where .= " OR ( " . $prefix . "posts.ID IN ( SELECT " . $prefix . "postmeta.post_id  FROM " . $prefix . "postmeta WHERE meta_key = '_sku' AND meta_value LIKE '%$s%' )
                AND " . $prefix . "posts.ID IN (
                    SELECT ID FROM {$wpdb->prefix}posts 
                    LEFT JOIN {$wpdb->prefix}icl_translations ON {$wpdb->prefix}icl_translations.element_id = {$wpdb->prefix}posts.ID
                    WHERE post_type = 'product'
                    AND post_status = 'publish'
                    AND {$wpdb->prefix}icl_translations.language_code = '". ICL_LANGUAGE_CODE ."'
                ) )";
        } else {
            $where .= " OR " . $prefix . "posts.ID IN ( SELECT " . $prefix . "postmeta.post_id  FROM " . $prefix . "postmeta WHERE meta_key = '_sku' AND meta_value LIKE '%$s%' )";
        }

       return $where;
    }

endif;

// **********************************************************************// 
// ! AJAX search
// **********************************************************************// 
add_action( 'wp_ajax_et_ajax_search', 'etheme_ajax_search_action');
add_action( 'wp_ajax_nopriv_et_ajax_search', 'etheme_ajax_search_action');
if(!function_exists('etheme_ajax_search_action')) {
    function etheme_ajax_search_action() {
        global $woocommerce, $wpdb, $wp_query, $product;
        $result = array(
            'status' => 'error',
            'html' => ''
        );

        
        if ( ! isset( $_REQUEST['cat'] ) ) {
            $_REQUEST['cat'] = 0;
        }

        if( isset( $_REQUEST['s'] ) && $_REQUEST['s'] != '') {

            $s = sanitize_text_field( $_REQUEST['s'] );
            $i = 0;
            $to = 8;

            // ! Get sku results
            if ( etheme_get_option('search_by_sku') ) {
                $sku = $_REQUEST['s'];

                // ! Should the query do some extra joins for WPML Enabled sites...
                $wmplEnabled = false;

                if(defined('WPML_TM_VERSION') && defined('WPML_ST_VERSION') && class_exists("woocommerce_wpml")){
                    $wmplEnabled = true;
                    // ! What language should we search for...
                    $languageCode = ICL_LANGUAGE_CODE;
                }

                // ! Search for the sku of a variation and return the parent.
                $variationsSql = "
                  SELECT p.post_parent as post_id FROM $wpdb->posts as p
                  join $wpdb->postmeta pm
                  on p.ID = pm.post_id
                  and pm.meta_key='_sku'
                  and pm.meta_value LIKE '%$sku%'
                  ";

                // ! IF WPML Plugin is enabled join and get correct language product.
                if( $wmplEnabled ) {
                    $variationsSql .=
                        "join ".$wpdb->prefix."icl_translations t on
                         t.element_id = p.post_parent
                         and t.element_type = 'post_product'
                         and t.language_code = '$languageCode'";
                    ;
                }

                $variationsSql .= "
                      where 1
                      AND p.post_parent <> 0
                      and p.post_status = 'publish'
                      group by p.post_parent
                  ";
                $variations = $wpdb->get_results($variationsSql);


                $regularProductsSql =
                    "SELECT p.ID as post_id FROM $wpdb->posts as p
                        join $wpdb->postmeta pm
                        on p.ID = pm.post_id
                        and  pm.meta_key='_sku' 
                        AND pm.meta_value LIKE '%$sku%'
                        AND post_title NOT LIKE '%$sku%'
                    ";
                // ! IF WPML Plugin is enabled join and get correct language product.
                if($wmplEnabled) {
                    $regularProductsSql .=
                        "join ".$wpdb->prefix."icl_translations t on
                         t.element_id = p.ID
                         and t.element_type = 'post_product'
                         and t.language_code = '$languageCode'";
                }
                $regularProductsSql .=
                    "where 1
                    and (p.post_parent = 0 or p.post_parent is null)
                    and p.post_status = 'publish'
                    group by p.ID";
                $regular_products = $wpdb->get_results($regularProductsSql);
            }

            // ! Get title/excerpt results
            // $title_q = "SELECT ID FROM $wpdb->posts WHERE post_title LIKE '%$s%' AND post_type = 'product'";
            $excerpt_q = "SELECT ID FROM $wpdb->posts WHERE post_excerpt LIKE '%$s%' AND post_title NOT LIKE '%$s%' AND post_type = 'product'";

            if ( ! $wmplEnabled ) {
                $title_q = "SELECT ID FROM $wpdb->posts WHERE post_title LIKE '%$s%' AND post_type = 'product'";
            } else {
                $title_q = "
                    SELECT ID FROM $wpdb->posts
                    JOIN {$wpdb->prefix}icl_translations ON 
                    ($wpdb->posts.ID = {$wpdb->prefix}icl_translations.element_id)
                    AND {$wpdb->prefix}icl_translations.language_code = '$languageCode'
                    WHERE post_title LIKE '%$s%' AND post_type = 'product'
                ";
            }

            $title_q = $wpdb->get_results( $title_q );
            $excerpt_q = $wpdb->get_results( $excerpt_q );

            $title_q = array_reverse( $title_q );
            $excerpt_q = array_reverse( $excerpt_q );

            $products = array_merge( $title_q, $excerpt_q );

            $result['html'] .= '<div class="product-ajax-list"></ul>';

            if ( ! empty( $products ) || ! empty( $regular_products ) || ! empty( $variations ) ) {
                $result['status'] = 'success';
                $result['html'] .= '<h3 class="search-results-title">' . esc_html__('Products found', 'xstore') . '<a href="' . esc_url( home_url() ) . '/?s='. $s .'&post_type=product&product_cat=' . $_REQUEST['cat'] . '">' . esc_html__('View all', 'xstore' ) . '</a></h3>';
            }

            if ( ! empty( $products ) && count( $products ) > 0 ) {
                foreach ( $products as $post ) {
                    if ( $i >= $to )  break;

                    setup_postdata( $post );
                    $product = wc_get_product( $post->ID );

                    if ( ! $product->is_visible() ) continue;

                    if ( $_REQUEST['cat'] ) {
                        $terms = wp_get_post_terms( $post->ID, 'product_cat' );
                        $categories = array();
                        foreach ( $terms as $term ){
                            $categories[] = $term->slug;
                        } 

                        if ( ! in_array( $_REQUEST['cat'], $categories ) ) continue;
                    }
                    
                    $result['html'] .= '<li>';
                        $result['html'] .= '<a href="'.get_the_permalink($post->ID).'" title="'.get_the_title($post->ID).'" class="product-list-image">';
                            $result['html'] .= ( get_the_post_thumbnail( $post->ID ) ) ? get_the_post_thumbnail( $post->ID ) : wc_placeholder_img( $size = 'shop_thumbnail' );
                        $result['html'] .='</a>';
                        $result['html'] .= '<p class="product-title"><a href="'.get_the_permalink($post->ID).'" title="'.get_the_title($post->ID).'">'.get_the_title($post->ID).'</a></p>';
                        $result['html'] .= '<div class="price">'.$product->get_price_html().'</div>';
                    $result['html'] .= '</li>';

                    $i++;
                }
            }

            
            if ( ( ! empty( $regular_products ) || ! empty( $variations ) ) && etheme_get_option('search_by_sku') ) {

                $products = array_merge( $variations, $regular_products );

                $arrayID = array();
                foreach ( $products as $object ) {
                    array_push( $arrayID, $object->post_id );
                }
                $arrayID = array_unique( $arrayID );

                $newObjects = array();
                foreach ( $arrayID as $id ) {
                    foreach ( $products as $object ) {
                        if ( $object->post_id == $id ) {
                            array_push($newObjects, $object);
                            break;
                        }
                    }
                }

                foreach ( $newObjects as $post ) {
                    if ( $i >= $to )  break;

                    setup_postdata( $post );
                   // $_product = wc_get_product( get_the_ID() );

                    global $woocommerce;
                    $_product = new WC_Product( $post->post_id );
                    $_id = $_product->get_id();

                    $result['html'] .= '<li p-id="' . $post->ID . '">';
                        $result['html'] .= '<a href="'.get_the_permalink( $_id ).'" title="'.get_the_title( $_id ).'" class="product-list-image">';
                            $result['html'] .= ( get_the_post_thumbnail( $_id ) ) ? get_the_post_thumbnail( $_id ) : wc_placeholder_img( $size = 'shop_thumbnail' );
                        $result['html'] .='</a>';
                        $result['html'] .= '<p class="product-title"><a href="'.get_the_permalink( $_id ).'" title="'.get_the_title( $_id ).'">'.get_the_title($_id).'</a></p>';
                        $result['html'] .= '<div class="price">'.$_product->get_price_html().'</div>';
                    $result['html'] .= '</li>';

                    $i++;
                }
            }

            wp_reset_postdata();
            $result['html'] .= '</ul></div>';

            // ! Get posts results
            $args = array(
                's'                   => $s,
                'post_type'           => 'post',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                'posts_per_page'      => $to,
            );

            if ( etheme_get_option( 'search_ajax_page' ) ) {
                $args['post_type'] = array( 'post', 'page' );
            }

            if ( $_REQUEST['cat'] && ! etheme_get_option( 'search_ajax_product' ) ) $args['category_name'] = $_REQUEST['cat'];

            $posts = ( etheme_get_option( 'search_ajax_post' ) ) ? get_posts( $args ) : '' ;

            if ( !empty( $posts ) ) {
                ob_start();
                foreach ( $posts as $post ) {
                    ?>
                        <li>
                            <a href="<?php echo get_the_permalink( $post->ID ); ?>" class="post-list-image"><?php echo get_the_post_thumbnail( $post->ID );?></a>
                            <p class="post-title"><a href="<?php echo get_the_permalink( $post->ID ); ?>"><?php echo get_the_title( $post->ID ) ?></a></p>
                            <span class="post-date"><?php echo get_the_date( '',$post->ID ); ?></span>
                        </li>
  
                    <?php
                }

                $result['status'] = 'success';
                $result['html'] .= '<div class="posts-ajax-list">';
                $result['html'] .= '<h3 class="search-results-title">' . esc_html__('Posts found', 'xstore') . '<a href="' . esc_url( home_url() ) . '/?s='. $s .'&post_type=post">' . esc_html__('View all', 'xstore' ) . '</a></h3>';
                $result['html'] .= '<ul>' . ob_get_clean() . '</ul>';
                $result['html'] .= '</div>';
            }
            wp_reset_postdata();

            if ( empty( $products ) && empty( $posts ) && empty( $regular_products ) && empty( $variations ) ) {
                $result['status'] = 'error';
                $result['html'] = '<div class="empty-category-block">';
                $result['html'] .= '<h3>' . esc_html__( 'No results were found', 'xstore' ) . '</h3>';
                $result['html'] .= '<p class="not-found-info">' . esc_html__( 'We invite you to get acquainted with an assortment of our site. Surely you can find something for yourself!', 'xstore' ). '</p>';
                $result['html'] .= '</div>';
            }

            wp_reset_postdata();

        }

        echo json_encode($result);
        die();
    }
}


// **********************************************************************// 
// ! Add page to search results
// **********************************************************************// 
add_filter( 'pre_get_posts', 'etheme_search_filter' );
function etheme_search_filter( $query ) {
    if ( ! is_admin() ) {
        if ( etheme_get_option( 'search_ajax_post' ) && etheme_get_option( 'search_ajax_page' ) && $query->is_search && $query->query['post_type'] == 'post') {
            $query->set( 'post_type', array( 'post', 'page' ) );
        }
        return $query;
    }
}

// **********************************************************************// 
// ! Footer Type
// **********************************************************************// 
if(!function_exists('etheme_footer_type')) {
    function etheme_footer_type() {
        return etheme_get_option('footer_type');
    }

    add_filter('custom_footer_filter', 'etheme_footer_type',10);
}

// **********************************************************************// 
// ! Footer widgets class
// **********************************************************************// 
if(!function_exists('etheme_get_footer_widget_class')) {
    function etheme_get_footer_widget_class($n) {

        $class = 'col-md-';

        switch ($n) {
            case 1:
                $class .= 12;
                break;
            case 2:
                $class .= 6;
                break;
            case 3:
                $class .= 4;
                break;
            case 4:
                $class .= 3;
                break;

            default:
                $class .= 3;
                break;
        }

        if( $n == 4 ) {
            $class .= ' col-sm-6';
        }

        return $class;

    }
}

// **********************************************************************//
// ! Implement Opauth Facebook login
// **********************************************************************//

if( ! function_exists('etheme_login_facebook') ) {
    add_action('init', 'etheme_login_facebook', 20);
    function etheme_login_facebook() {
        if( ! class_exists( 'WooCommerce' ) ) return;
        if( empty( $_GET['facebook'] ) && empty( $_GET['code'] ) ) {
            return;
        }

        $page = get_option('etheme_fb_login');
        $account_url    = wc_get_page_permalink($page);
        $security_salt  = apply_filters('et_facebook_salt', '2NlBUibcszrVtNmDnxqDbwCOpLWq91eatIz6O1O');
        $app_id         = etheme_get_option('facebook_app_id');
        $app_secret     = etheme_get_option('facebook_app_secret');

        if( empty( $app_secret ) || empty( $app_id ) ) return;

        $config = array(
            'security_salt' => $security_salt,
            'host' => $account_url,
            'path' => '/',
            'callback_url' => $account_url,
            'callback_transport' => 'get',
            'strategy_dir' => ETHEME_CODE_3D . 'vendor/opauth/',
            'Strategy' => array(
                'Facebook' => array(
                    'app_id' => $app_id,
                    'app_secret' => $app_secret,
                    'scope' => 'email'
                ),
            )
        );

        if( empty( $_GET['code'] ) ) {
            $config['request_uri'] = '/facebook/';
        } else {
            $config['request_uri'] = '/facebook/int_callback?code=' . $_GET['code'];
        }

        new Opauth( $config );
    }
}

if( ! function_exists('etheme_process_facebook_callback') ) {
    add_action('init', 'etheme_process_facebook_callback', 30);
    function etheme_process_facebook_callback() {
        if( empty( $_GET['opauth'] ) ) return;

        $opauth = unserialize(etheme_decoding($_GET['opauth']));

        if( empty( $opauth['auth']['info'] ) ) {
            wc_add_notice( esc_html__( 'Can\'t login with Facebook. Please, try again later.', 'xstore' ), 'error' );
            return;
        }

        $info = $opauth['auth']['info'];

        if( empty( $info['email'] ) ) {
            wc_add_notice( esc_html__( 'Facebook doesn\'t provide your email. Try to register manually.', 'xstore' ), 'error' );
            return;
        }

        add_filter('pre_option_woocommerce_registration_generate_username', 'etheme_generate_username_option', 10);

        $password = wp_generate_password();
        $customer = wc_create_new_customer( $info['email'], '', $password);

        $user = get_user_by('email', $info['email']);

        if( is_wp_error( $customer ) ) {
            if( isset( $customer->errors['registration-error-email-exists'] ) ) {
                wc_set_customer_auth_cookie( $user->ID );
            }
        } else {
            wc_set_customer_auth_cookie( $customer );
        }

        wc_add_notice( sprintf( __( 'You are now logged in as <strong>%s</strong>', 'xstore' ), $user->display_name ) );

        remove_filter('pre_option_woocommerce_registration_generate_username', 'etheme_generate_username_option', 10);
    }
}
if( ! function_exists('etheme_add_account_to_menu') ) {
    add_action('init', 'etheme_add_account_to_menu');
    function etheme_add_account_to_menu() {
        if ( etheme_get_option('top_links') == 'menu' ) {
            etheme_menu_account_link();
        }
    }
}

if( ! function_exists('etheme_generate_username_option') ) {
    function etheme_generate_username_option() {
        return 'yes';
    }
}

// **********************************************************************//
// ! Facebook login button
// **********************************************************************//

if( ! function_exists('etheme_faceboook_login_button') ) {
    add_action( 'woocommerce_before_customer_login_form', 'etheme_faceboook_login_button');
    function etheme_faceboook_login_button() {
        if( ! class_exists( 'WooCommerce' ) ) return;
        $app_id         = etheme_get_option('facebook_app_id');
        $app_secret     = etheme_get_option('facebook_app_secret');

        if( empty( $app_secret ) || empty( $app_id ) ) return;

        $page = ( is_checkout() ) ? 'checkout' : 'myaccount';
        update_option( 'etheme_fb_login', $page );

        $facebook_login_url = add_query_arg( 'facebook', 'login', wc_get_page_permalink( $page ) );
        echo '<div class="et-facebook-login-wrapper"><a href="' . esc_url( $facebook_login_url ) . '" class="et-facebook-login-button"><i class="fa fa-facebook"></i> ' . esc_html__('Login / Register with Facebook', 'xstore') . '</a></div>';
    }
}


// **********************************************************************//
// ! Get activated theme
// **********************************************************************//

if(!function_exists('etheme_activated_theme')) {
    function etheme_activated_theme() {
        $activated_data = get_option( 'etheme_activated_data' );
        $theme = ( isset( $activated_data['theme'] ) && ! empty( $activated_data['theme'] ) ) ? $activated_data['theme'] : false ;
        return $theme;
    }

}


// **********************************************************************//
// ! Is theme activatd
// **********************************************************************//

if(!function_exists('etheme_is_activated')) {
    function etheme_is_activated() {
        if ( etheme_activated_theme() != ETHEME_PREFIX ) return false;
        if ( get_option( 'xtheme_is_activated', false ) && ! get_option( 'etheme_is_activated' ) ) update_option( 'etheme_is_activated', true );
        return get_option( 'etheme_is_activated', false );
    }
}


// **********************************************************************//
// ! Setup item data for old theme versions
// **********************************************************************//

add_action( 'admin_init', 'etheme_set_item' );
if ( ! function_exists( 'etheme_set_item' ) ) :
    function etheme_set_item(){
        if ( ! etheme_is_activated() ) return;
        $item_data = get_option( 'etheme_activated_data' );
        if ( ! empty( $item_data['item'] ) ) return;

        if( isset( $item_data['purchase'] ) && ! empty( $item_data['purchase'] ) ) {
            $code = trim( $item_data['purchase'] );

            if( empty( $code ) ) return;

            $theme_id = 15780546;
            $api = ETHEME_API;

            $domain = get_option('siteurl'); //or home
            $domain = str_replace('http://', '', $domain);
            $domain = str_replace('https://', '', $domain);
            $domain = str_replace('www', '', $domain); //add the . after the www if you don't want it
            $domain = urlencode($domain);

            $response = wp_remote_get( $api . 'activate/' . $code . '?envato_id='. $theme_id .'&domain=' . $domain );
            $response_code = wp_remote_retrieve_response_code( $response );

            if( $response_code != '200' ) return;
            
            $data = json_decode( wp_remote_retrieve_body($response), true );

            if( isset( $data['error'] ) ) return;
            if( ! $data['verified'] ) return;

            foreach ( $data as $key => $value ) {
               $item_data['item'][$key] = $value;
            }

            update_option( 'etheme_activated_data', maybe_unserialize( $item_data ) );
        }
        return;
    }
endif;


// **********************************************************************//
// ! Check support date
// **********************************************************************//

if ( ! function_exists( 'etheme_support_date' ) ) {
    function etheme_support_date(){
        $data = get_option( 'etheme_activated_data' );
        if ( ! isset( $data['item'] ) || empty( $data['item'] ) || empty( $data['item']['supported_until'] ) ) return false;
        $support_date = strtotime( $data['item']['supported_until'] );
        $current_date = strtotime( date( "Y-m-d" ) );
        return $support_date > $current_date;
    }
}


// **********************************************************************// 
// ! http://codex.wordpress.org/Function_Reference/wp_nav_menu#How_to_add_a_parent_class_for_menu_item
// **********************************************************************// 

add_filter( 'wp_nav_menu_objects', 'etheme_add_menu_parent_class');
function etheme_add_menu_parent_class($items ) {

    $parents = array();
    foreach ( $items as $item ) {
        if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
            $parents[] = $item->menu_item_parent;
        }
    }

    foreach ( $items as $item ) {
        if ( in_array( $item->ID, $parents ) ) {
            $item->classes[] = 'menu-parent-item';
        }
    }

    return $items;
}

// **********************************************************************// 
// ! Change WP coockie notice position
// **********************************************************************//
if( class_exists('Cookie_Notice') ) {
    remove_action( 'wp_footer', array( $cookie_notice, 'add_cookie_notice' ), 1000 );
    add_action( 'et_after_body', array( $cookie_notice, 'add_cookie_notice' ), 1000 );
}


// **********************************************************************// 
// ! Activation notice
// **********************************************************************//

if( !function_exists('etheme_activation_bar')) {
    add_action('init', 'etheme_activation_bar' );
    function etheme_activation_bar() {
        return;
        if( ! etheme_is_activated() ) {
            add_action( 'et_after_body', 'etheme_activation_bar_out', 200 );
        }
    }
}

if( ! function_exists('etheme_activation_bar_out')) {
    function etheme_activation_bar_out() {
        ?>
            <div class="etheme-activation-bar">Important Note: You need to <a href="<?php echo admin_url( 'themes.php?page=xstore-setup' ); ?>">activate XStore template</a> with your purchase code to continue working.</div>
        <?php
    }
}

// **********************************************************************// 
// ! Twitter API functions
// **********************************************************************// 
if(!function_exists('etheme_capture_tweets')) {
    function etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count) {

        $connection = etheme_connection_with_access_token($consumer_key,$consumer_secret,$user_token, $user_secret);
        $params = array(
            'screen_name' => $user,
            'count' => $count
        );

        $content = $connection->get("statuses/user_timeline",$params);

        return json_encode($content);
    }
}

if(!function_exists('etheme_connection_with_access_token')) {
    function etheme_connection_with_access_token($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret) {
        $connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
        return $connection;
    }
}


if(!function_exists('etheme_tweet_linkify')) {
    function etheme_tweet_linkify($tweet) {
        $tweet = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $tweet);
        $tweet = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $tweet);
        $tweet = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $tweet);
        $tweet = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $tweet);
        return $tweet;
    }
}
if(!function_exists('etheme_store_tweets')) {
    function etheme_store_tweets($file, $tweets) {
        ob_start(); // turn on the output buffering 
        $fo = etheme_fo($file, 'w'); // opens for writing only or will create if it's not there
        if (!$fo) return etheme_print_tweet_error(error_get_last());
        $fr = etheme_fw($fo, $tweets); // writes to the file what was grabbed from the previous function
        if (!$fr) return etheme_print_tweet_error(error_get_last());
        etheme_fc($fo); // closes
        ob_end_flush(); // finishes and flushes the output buffer; 
    }
}

if(!function_exists('etheme_pick_tweets')) {
    function etheme_pick_tweets($file) {
        ob_start(); // turn on the output buffering 
        $fo = etheme_fo($file, 'r'); // opens for reading only 
        if (!$fo) return etheme_print_tweet_error(error_get_last());
        $fr = etheme_fr($fo, filesize($file));
        if (!$fr) return etheme_print_tweet_error(error_get_last());
        etheme_fc($fo);
        ob_end_flush();
        return $fr;
    }
}

if(!function_exists('etheme_print_tweet_error')) {
    function etheme_print_tweet_error($errorsArray) {
        $html = '';
        if( count($errorsArray) > 0 ){
            foreach ($errorsArray as $key => $error) {
                $html .= '<p class="warning">Error: ' . $error['message']  . '</p>';
            }
        }
        return $html;
    }
}

if(!function_exists('etheme_twitter_cache_enabled')) {
    function etheme_twitter_cache_enabled(){
        return apply_filters('etheme_twitter_cache_enabled', true);
    }
}

if(!function_exists('etheme_get_tweets')) {
    function etheme_get_tweets($consumer_key, $consumer_secret, $user_token, $user_secret, $user, $count, $cachetime=50, $key = 'widget') {
        if(etheme_twitter_cache_enabled()){
            //setting the location to cache file
            $cachefile = ETHEME_CODE_DIR . 'cache/cache-twitter-' . $key . '.json';

            // the file exitsts but is outdated, update the cache file
            if (file_exists($cachefile) && ( time() - $cachetime > filemtime($cachefile)) && filesize($cachefile) > 0) {
                //capturing fresh tweets
                $tweets = etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count);
                $tweets_decoded = json_decode($tweets, true);
                //if get error while loading fresh tweets - load outdated file
                if(isset($tweets_decoded['errors'])) {
                    $tweets = etheme_pick_tweets($cachefile);
                }
                //else store fresh tweets to cache
                else
                    etheme_store_tweets($cachefile, $tweets);
            }
            //file doesn't exist or is empty, create new cache file
            elseif (!file_exists($cachefile) || filesize($cachefile) == 0) {
                $tweets = etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count);
                $tweets_decoded = json_decode($tweets, true);
                //if request fails, and there is no old cache file - print error
                if(isset($tweets_decoded['errors'])) {
                    echo etheme_print_tweet_error($tweets['errors']);
                    return array();
                }
                //make new cache file with request results
                else
                    etheme_store_tweets($cachefile, $tweets);
            }
            //file exists and is fresh
            //load the cache file
            else {
               $tweets = etheme_pick_tweets($cachefile);
            }
        } else{
           $tweets = etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count);
        }

        $tweets = json_decode($tweets, true);

        if(isset($tweets['errors'])) {
            echo etheme_print_tweet_error($tweets['errors']);
            return array();
        }

        return $tweets;
    }
}



// **********************************************************************// 
// ! Related posts 
// **********************************************************************// 

if(!function_exists('etheme_get_related_posts')) {
    function etheme_get_related_posts($postId = false, $limit = 5){
        global $post;
        if(!$postId) {
            $postId = $post->ID;
        }

        $query_type = etheme_get_option('related_query');
        $atts = array(
            'large' => 3,
            'notebook' => 3,
            'tablet_land' => 2,
            'tablet_portrait' => 2,
            'mobile' => 1,
            'size' => etheme_get_option('blog_related_images_size'),
            'slider_autoplay' => false,
            'slider_speed' => false,
        );
        $args = array();
        if($query_type == 'tags') {
            $tags = get_the_tags($postId);
            if ($tags) {
                $tags_ids = array();
                foreach($tags as $tag) $tags_ids[] = $tag->term_id;

                $args = array(
                    'tag__in' => $tags_ids,
                    'post__not_in' => array($postId),
                    'showposts'=>$limit, // Number of related posts that will be shown.
                );
            }
        } else {
            $categories = get_the_category($postId);
            if ($categories) {
                $category_ids = array();
                foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

                $args = array(
                    'category__in' => $category_ids,
                    'post__not_in' => array($postId),
                    'showposts'=>$limit, // Number of related posts that will be shown.
                );
            }
        }
        etheme_create_posts_slider($args, esc_html__('Related posts', 'xstore'), $atts);
    }
}



if(!function_exists('etheme_get_menus_options')) {
    function etheme_get_menus_options() {
        $menus = array();
        $menus = array(""=>"Default");
        $nav_terms = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
        foreach ( $nav_terms as $obj ) {
            $menus[$obj->slug] = $obj->name;
        }
        return $menus;
    }
}


// **********************************************************************// 
// ! Get image by size function
// ! TODO: echo param. Show full image tag param
// **********************************************************************// 
if( ! function_exists('etheme_get_image') ) {
    function etheme_get_image($attach_id, $size) {
        if (function_exists('wpb_getImageBySize')) {
            $image = wpb_getImageBySize( array(
                    'attach_id' => $attach_id,
                    'thumb_size' => $size
                ) );
            $image = $image['thumbnail'];
        } else {
            $image = wp_get_attachment_image( $attach_id, $size );
        }

        return $image;
    }
}

// **********************************************************************// 
// ! Hook photoswipe tempalate to the footer
// **********************************************************************// 
add_action('after_page_wrapper', 'etheme_photoswipe_template', 30);
if(!function_exists('etheme_photoswipe_template')) {
    function etheme_photoswipe_template() {
        ?>
<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
         It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides.
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>
        <?php
    }
}


if ( ! function_exists( 'etheme_stock_taxonomy' ) ) :
function etheme_stock_taxonomy( $term_id = false, $taxonomy = 'product_cat' ) {
    if ( $term_id === false ) return false;
    $args = array(
        'post_type'         => 'product',
        'posts_per_page'    => -1,
        'tax_query'         => array( 
            array(
                'taxonomy'  => $taxonomy,
                'field'     => 'term_id',
                'terms'     => $term_id
            ),
        ),
    );

    $cat_prods = get_posts( $args );
    $i = 0;

    foreach ( $cat_prods as $single_prod ) { 
        $product = wc_get_product( $single_prod->ID );
        if ( $product->is_in_stock() === true )  {
            $i++;
        }
    }

    return $i;
}
endif;


// **********************************************************************//
// ! Swiper Lazy Preloader
// **********************************************************************//
if(!function_exists('etheme_swiper_lazy_preloader')) {
    function etheme_swiper_lazy_preloader() {
        $img = etheme_get_option( 'preloader_img' );
        $output = '<div class="swiper-lazy-preloader"><div id="loader-1">';
        $output .= ( ! empty( $img['url'] ) ) ? '<img class="et-loader-img" src="' . $img['url'] . '" alt="et-loader">' : '<span></span><span></span><span></span><span></span><span></span>' ;
        $output .= '</div></div>';
        return $output;
    }
}


// **********************************************************************//
// ! Display quantity of posts on the page.
// **********************************************************************//
if ( ! function_exists( 'etheme_count_posts' ) ) :

    function etheme_count_posts() {
        global $wp_query;

        $paged    = max( 1, $wp_query->get( 'paged' ) );
        $per_page = $wp_query->get( 'posts_per_page' );
        $total    = $wp_query->found_posts;
        $first    = ( $per_page * $paged ) - $per_page + 1;
        $last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );
        $showing  = esc_html__( 'Showing', 'xstore' );

        if ( $total == 1 ) {
            $out = esc_html__( 'the single result', 'xstore' );
        } elseif ( $total <= $per_page || -1 === $per_page ) {
            $out = sprintf( '%1$s %2$d %3$s' , esc_html__( 'all', 'xstore' ), $total, esc_html__( 'posts', 'xstore' ) );
        } else {
            $out = sprintf( esc_html_x( ' %1$d&ndash;%2$d %4$s %3$d posts', '%1$d = first, %2$d = last, %3$d = total', 'xstore' ), $first, $last, $total, esc_html__( 'of', 'xstore' ) );
        }
        return printf( '<p class="et_coutn-posts">%1$s %2$s</p>',$showing, $out );

    }
endif;

// **********************************************************************//
// ! Change upload dir for custom fonts
// **********************************************************************//
function etheme_upload_dir($dir){
    $time = current_time( 'mysql' );
    $y = substr( $time, 0, 4 );
    $m = substr( $time, 5, 2 );
    $subdir = "/$y/$m";

    return array(
        'path' => $dir['basedir'] . '/custom-fonts' . $subdir,
        'url' => $dir['baseurl'] . '/custom-fonts' . $subdir ,
        'subdir' => '/custom-fonts' . $subdir,
    ) + $dir;
}

// **********************************************************************//
// ! Check file exists by filename
// **********************************************************************//
if ( ! function_exists( 'etheme_file_exists' ) ) :
    function etheme_file_exists( $name ) {

        // ! Change upload dir
        add_filter( 'upload_dir', 'etheme_upload_dir' );

        $upload_dir = wp_upload_dir();
        $name = str_replace( ' ', '-', $name );
        $file = $upload_dir['basedir'] . $upload_dir['subdir'] . '/' . $name;
        $file = file_exists( $file );

        // ! Set upload dir to default
        remove_filter( 'upload_dir', 'etheme_upload_dir' );

        return $file;
    }
endif;

// **********************************************************************//
// ! Force name sorting
// **********************************************************************//
if ( ! function_exists( 'et_force_name_sort' ) ) :
    function et_force_name_sort( $array, $order ){
        if ( count( $array ) <= 0 ) return;

        // ! Set values
        $to_sort = array();
        $sorted = array();

        // ! Set names array
        foreach ( $array as $key => $value ) {
            $to_sort[] = strtolower( $value->name );
        }

        // ! Sort names array
        sort( $to_sort );

        // ! Change order if need it
        if ( $order == 'DESC' ){
           $to_sort = array_reverse( $to_sort );
        }

        // ! Set new sorted array
        foreach ( $to_sort as $key => $value ) {
            foreach ( $array as $k => $v ) {
                if ( $value == strtolower( $v->name ) ) {
                    $sorted[] = $v;
                }
            }
        }
        return $sorted;
    }
endif;

// **********************************************************************//
// ! WC Marketplace fix
// **********************************************************************//
if ( class_exists( 'WCMp_Ajax' ) ) add_action( 'wp_head', 'single_product_multiple_vendor_class' );
if ( ! function_exists( 'single_product_multiple_vendor_class' ) ) :
   function single_product_multiple_vendor_class(){
        ?>
        <script type="text/javascript">
            var themeSingleProductMultivendor = '#content_tab_singleproductmultivendor';
        </script>
        <?php
    }
endif;

function unicode_chars($source, $iconv_to = 'UTF-8') {
    $decodedStr = '';
    $pos = 0;
    $len = strlen ($source);
    while ($pos < $len) {
        $charAt = substr ($source, $pos, 1);
        // if ($charAt == '%') {
        //     $pos++;
        //     $charAt = substr ($source, $pos, 1);
        //     if ($charAt == 'u') {
        //         // we got a unicode character
        //         $pos++;
        //         $unicodeHexVal = substr ($source, $pos, 4);
        //         $unicode = hexdec ($unicodeHexVal);
        //         $decodedStr .= code2utf($unicode);
        //         $pos += 4;
        //     }
        //     else {
        //         // we have an escaped ascii character
        //         $hexVal = substr ($source, $pos, 2);
        //         $decodedStr .= chr (hexdec ($hexVal));
        //         $pos += 2;
        //     }
        // }
        // else {
            $decodedStr .= $charAt;
            $pos++;
        //}
    }

    if ($iconv_to != "UTF-8") {
        $decodedStr = iconv("UTF-8", $iconv_to, $decodedStr);
    }
    
    return $decodedStr;
}

// For wpml test 
apply_filters( 'wpml_current_language', NULL );