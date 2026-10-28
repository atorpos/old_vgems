<?php  if ( ! defined('ETHEME_FW')) exit('No direct script access allowed');
// **********************************************************************//
// ! Ititialize theme configuration and variables
// **********************************************************************//

add_action('wp_head', 'etheme_assets');
if(!function_exists('etheme_assets')) {
function etheme_assets() { 
	$post_id = etheme_get_page_id();
	$css = '';
	$dir = wp_upload_dir();
	if ( !is_file($dir['basedir'].'/xstore/options-style.min.css') || filesize($dir['basedir'].'/xstore/options-style.min.css') == 0 || is_customize_preview() ) {
		$css = et_custom_styles();
	}
	$header_bg_page = etheme_get_custom_field('header_bg', $post_id['id']);
    $header_bg_transparent = etheme_get_custom_field('header_transparent', $post_id['id']);
    if ( $header_bg_transparent ) {
        $header_bg_page = 'transparent';
    }
    if( ! empty( $header_bg_page) ) {
        $css .='.main-header {
            background:' . $header_bg_page . '!important;
        }';
    } ?>
	<style type="text/css">
		<?php echo $css; ?>
	</style>
	<?php
	}
}