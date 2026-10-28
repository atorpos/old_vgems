<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

global $woocommerce_loop;
// Store column count for displaying the grid
$loop = wc_get_loop_prop( 'columns' );

$view_mode = etheme_get_view_mode();
if( !empty($woocommerce_loop['view_mode'])) {
    $view_mode = $woocommerce_loop['view_mode'];
} else {
    $woocommerce_loop['view_mode'] = $view_mode;
}

if($view_mode == 'list') {
    $view_class = 'products-list';
    if( $loop > 3 ) $loop = 3;
}else{
    $view_class = 'products-grid';
}
    
if ( ! empty( $woocommerce_loop['isotope'] ) && $woocommerce_loop['isotope'] || etheme_get_option( 'products_masonry' ) && is_shop() ) {
    $view_class .= ' et-isotope';
}

 ?>
<div class="row products-loop <?php echo esc_attr( $view_class ); ?> row-count-<?php echo esc_attr( $loop ); ?>">