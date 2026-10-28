<?php
/*
Plugin Name: XStore Core
Plugin URI: http://8theme.com
Description: 8theme Core Plugin for Xstore theme
Version: 1.0.23
Author: 8theme
Text Domain: xstore-core
Author URI: http://8theme.com
*/

if(!defined('WPINC')) die();

include 'inc/functions.php';
include 'inc/post-types.php';
include 'inc/shortcodes.php';
include 'inc/support-panel.php';
include 'inc/twitteroauth/twitteroauth.php';
include 'inc/testimonials/woothemes-testimonials.php';
include 'inc/soundcloud/soundcloud-shortcode.php';

add_action('plugins_loaded', 'xstore_load_importers');

function xstore_load_importers() {
	if ( is_admin() && ! defined( 'IMPORT_DEBUG' ) ) {
		include 'inc/wordpress-importer/wordpress-importer.php';
		include 'inc/import.php';
	}
}

add_action( 'plugins_loaded', 'xstore_core_load_textdomain' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function xstore_core_load_textdomain() {
	$locale = apply_filters( 'plugin_locale', get_locale(), 'xstore-core' );

	load_textdomain( 'xstore-core', WP_LANG_DIR . '/xstore-core/xstore-core-' . $locale . '.mo' );
	load_plugin_textdomain( 'xstore-core', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );



	add_filter('pre_set_site_transient_update_plugins', 'check_for_plugin_update');
}



function check_for_plugin_update($checked_data){
	if ( ! defined( 'ETHEME_API' ) ) return $checked_data;

	$activated_data = get_option( 'etheme_activated_data' );
	$update_info = get_option( 'xstore-update-info', false );
	$key = $activated_data['api_key'];
	$plugins_dir = ETHEME_API . 'files/get/';
	$token = '?token=' . $key;
	$plugin_ver = ( isset( $update_info->plugin_version ) && ! empty( $update_info->plugin_version ) ) ? $update_info->plugin_version : false;

	if ( version_compare( '1.0.23', $plugin_ver, '<' ) ) {
		$plugins_dir = ETHEME_API . 'files/get/';
		$plugins_dir . 'et-core-plugin.zip';

		$plugin = new stdClass();
		$plugin->slug = 'et-core-plugin';
		$plugin->plugin = 'et-core-plugin/et-core-plugin.php';
		$plugin->new_version = $plugin_ver;
		$plugin->url = 'http://8theme.com/demo/xstore/change-log.php';
		$plugin->package = $plugins_dir . 'et-core-plugin.zip' . $token;
		$plugin->tested = '4.9.4';
		$checked_data->response['et-core-plugin/et-core-plugin.php'] = $plugin;
	}

	return $checked_data;
}




?>