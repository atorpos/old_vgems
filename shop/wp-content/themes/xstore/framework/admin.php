<?php  if ( ! defined('ETHEME_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Add admin styles and scripts
// **********************************************************************// 

if(!function_exists('etheme_load_admin_styles')) {
	add_action( 'admin_enqueue_scripts', 'etheme_load_admin_styles', 150 );
	function etheme_load_admin_styles() {
		global $pagenow;
		
	    wp_enqueue_style('farbtastic');
	    $depends = '';
	    if(class_exists('Redux') && $pagenow == 'admin.php' && @$_GET['page'] == '_options') {
	    	$depends = array('redux-admin-css', 'select2-css');
	    	wp_dequeue_style( 'woocommerce_admin_styles' );
	    }
	    wp_enqueue_style('etheme_admin_css', ETHEME_CODE_CSS.'admin.css', $depends);
	    wp_enqueue_style("font-awesome", get_template_directory_uri().'/css/font-awesome.min.css');
	}
}

if(!function_exists('etheme_add_admin_script')) {
	add_action('admin_init','etheme_add_admin_script', 1130);
	function etheme_add_admin_script(){
		global $pagenow;
	    add_thickbox();

		$depends = array();
		if( $pagenow == 'widgets.php' ) {
			$depends = array();
		}
	    wp_enqueue_script('theme-preview');
	    wp_enqueue_script('common');
	    wp_enqueue_script('wp-lists');
	    wp_enqueue_script('postbox');
	    wp_enqueue_script('farbtastic');
	    //wp_enqueue_script('et_masonry', get_template_directory_uri().'/js/jquery.masonry.min.js',array(),false,true);
	    wp_enqueue_script('etheme_admin_js', ETHEME_CODE_JS.'admin.js', $depends, false,true);
	}
}


if(!function_exists('etheme_rate_redirect')) {
	add_action( 'init', 'etheme_rate_redirect');
	function etheme_rate_redirect() {
		if( isset( $_GET['page'] ) && $_GET['page'] === '_et_open_support' && false === headers_sent() ) {
			wp_redirect( ETHEME_SUPPORT_LINK );
			exit;
		}
		if( isset( $_GET['page'] ) && $_GET['page'] === '_et_rate_theme' && false === headers_sent() ) {
			wp_redirect( ETHEME_RATE_LINK );
			exit;
		}
		if( isset( $_GET['page'] ) && $_GET['page'] === '_et_open_documentation' && false === headers_sent() ) {
			wp_redirect( ETHEME_DOCS_LINK );
			exit;
		}
	}
}

if(!function_exists('etheme_support_chat')) {
	function etheme_support_chat() {
		if ( etheme_get_option( 'support_chat' ) && etheme_support_date() ) : ?>

			<?php
				$data = get_option( 'etheme_activated_data' );
				$data = $data['item'];
				$support_date = strtotime( $data['supported_until'] );
				$current_date = strtotime( date( "Y-m-d" ) );
				$remaining = $support_date - $current_date;
				$days_remaining = floor( $remaining / 86400 );
				$hours_remaining = floor( ( $remaining % 86400) / 3600 );
			?>

			<script>
				window.intercomSettings = {
					app_id: 't84fcdk1',
					"buyer": "<?php echo $data['buyer']; ?>",
					"support" : "<?php echo ( etheme_support_date() ) ? 'ON' : 'OFF' ?>",
					"supported_until": "<?php echo $data['supported_until']; ?>",
					"support_time_left" : "<?php echo $days_remaining . ' days ' . $hours_remaining . ' hours' ; ?>",
					"theme": "Xstore"
				};
			</script>	
		<?php endif; ?>

		<script data-cfasync="false">(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/t84fcdk1';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()
		</script>
	<?php	
	}
}

new EthemeUpdateSupport();

class EthemeUpdateSupport{

	private $errors = array();
	private $activated_data = array();
	
	function __construct(){
		$this->activated_data = get_option( 'etheme_activated_data' );
		add_action( 'wp_ajax_etheme_check_support', array( $this, 'etheme_check_support' ) );
	}

	// ! Check and update support date
	public function etheme_check_support(){

		if ( etheme_support_date() ) {
			echo json_encode( ['enabled' => esc_html__( 'You can use online chat at the right bottom to get help from 8theme support team', 'xstore' ), 'chat' => $this->chat_data() ] );
			die();
		}

		if ( ! $this->activated_data || ! $this->activated_data['purchase'] || empty( $this->activated_data['purchase'] ) ) {
			$this->error( esc_html__( 'Purchase code does not exist', 'xstore' ) );
		}

		$data = $this->remote_data();

		if ( ! isset( $data['supported_until'] ) ) $this->error( esc_html__( 'Can not get support period', 'xstore' ) );

		$local_date = strtotime( $this->activated_data['item']['supported_until'] );
		$envato_date = strtotime( $data['supported_until'] );

		if ( ! $local_date || ! $envato_date ) $this->error( esc_html__( 'Wrong date format of the support period', 'xstore' ) );

		if ( $local_date == $envato_date ){
			//$this->error( 'local support date same as envato' );
			//echo json_encode( ['succes' => esc_html__( 'Support data is updated', 'xstore' ) ] );
			//die();
		}

		$this->activated_data['item']['supported_until'] = $data['supported_until'];
		update_option( 'etheme_activated_data', maybe_unserialize( $this->activated_data ) );


    	$helper = sprintf( esc_html__( 'Sorry, theme support license has expired. Extend your support period on %s and then you\'ll be able to get help from 8theme support team.', 'xstore' ), '<a href="https://help.market.envato.com/hc/en-us/articles/207886473-Extending-and-Renewing-Item-Support" target="_blank">' . esc_html__( 'ThemeForest', 'xstore' ) . '</a>' );

		$text = ( etheme_support_date() ) ? esc_html__( 'Thank you. Support renewed. You can use online chat to get help from 8theme support team', 'xstore' ) : $helper;

		if ( ! etheme_support_date() ) {
			echo json_encode( ['succes' => $text, 'stop' => true ] );
		} else {
			echo json_encode( ['succes' => $text, 'chat' => $this->chat_data() ] );
		}

		die();
	}

	// ! Set chat data
	private function chat_data(){
		$support_date = strtotime( $this->activated_data['item']['supported_until'] );
		$current_date = strtotime( date( "Y-m-d" ) );
		$remaining = $support_date - $current_date;
		$days_remaining = floor( $remaining / 86400 );
		$hours_remaining = floor( ( $remaining % 86400) / 3600 );

		$array = array(
			'buyer' => $this->activated_data['item']['buyer'],
			'support' => ( etheme_support_date() ) ? 'ON' : 'OFF',
			'supported_until' => $this->activated_data['item']['supported_until'],
			'support_time_left'  => $days_remaining . ' days ' . $hours_remaining . ' hours',
		);

		return $array;
	}

	// ! Get new support date
	private function remote_data(){
		$theme_id = 15780546;
		$api_url = ETHEME_API;

		$response = wp_remote_get( $api_url . 'support/' . $this->activated_data['purchase'] . '?envato_id='. $theme_id .'&domain=' . $this->domain );
		$response_code = wp_remote_retrieve_response_code( $response );

		if( $response_code != '200' ) $this->error( esc_html__( 'Remote server did not respond. Support period was not updated', 'xstore' ) );

		$data = json_decode( wp_remote_retrieve_body( $response ), true );

		// ! Remote error
		if( isset( $data['error'] ) ) $this->error( $data['error'] );

		return $data;
	}

	// ! Get domain
	public function domain(){
		$domain = get_option( 'siteurl' );
		$domain = str_replace( 'http://', '', $domain );
		$domain = str_replace( 'https://', '', $domain );
		$domain = str_replace( 'www', '', $domain );
		$domain = urlencode( $domain );
		return $domain;
	}

	// ! Generate error
	public function error( $error ){
		$this->errors[] = $error;
		echo json_encode( ['errors' => $this->errors ] );
		die();
	}

}


add_action('wp_ajax_etheme_deactivate_theme', 'etheme_deactivate_theme');
if( ! function_exists( 'etheme_deactivate_theme' ) ) {
	function etheme_deactivate_theme() {
		$activated_data = get_option( 'etheme_activated_data' );
		$theme_id = 15780546;
		$api_url = ETHEME_API;
		$status = '';
		$errors = array();
		$api = ( ! empty( $activated_data['api_key'] ) ) ? $activated_data['api_key'] : false;

		$domain = get_option( 'siteurl' );
	    $domain = str_replace( 'http://', '', $domain );
	    $domain = str_replace( 'https://', '', $domain );
	    $domain = str_replace( 'www', '', $domain );
	    $domain = urlencode( $domain );

		$response = wp_remote_get( $api_url . 'deactivate/' . $api . '?envato_id='. $theme_id .'&domain=' . $domain );
		$response_code = wp_remote_retrieve_response_code( $response );

        if( $response_code != '200' ) {
            $errors[] = 'API error (5)';
            echo json_encode( $errors );
            die();
        }

        $data = json_decode( wp_remote_retrieve_body( $response ), true );

        if( isset( $data['error'] ) ) {
            $errors[] = $data['error'];
            echo json_encode( $errors );
            die();
        }

		if ( isset( $data['status'] ) ) {
			$status = $data['status'];
			$data = array(
				'api_key' => 0,
				'theme' => 0,
				'purchase' => 0,
	      	);
			update_option( 'etheme_activated_data', maybe_unserialize( $data ) );

			echo json_encode( $status );
			die();
		}
	}
}

add_action( 'wp_ajax_et_update_menu_ajax', 'et_update_menu_ajax' ); 
if ( ! function_exists('et_update_menu_ajax')) {

		function et_update_menu_ajax () {

			$post = $_POST['item_menu'];

			// update_post_meta( $post['db_id'], '_menu-item-disable_titles', $post['dis_titles']);
			update_post_meta( $post['db_id'], '_menu-item-anchor', sanitize_post($post['anchor']));
			update_post_meta( $post['db_id'], '_menu-item-design', sanitize_post($post['design']));
			update_post_meta( $post['db_id'], '_menu-item-design2', sanitize_post($post['design2']));
			update_post_meta( $post['db_id'], '_menu-item-column_width', $post['column_width']);
			update_post_meta( $post['db_id'], '_menu-item-column_height', $post['column_height']);

			update_post_meta( $post['db_id'], '_menu-item-sublist_width', $post['sublist_width']);

			update_post_meta( $post['db_id'], '_menu-item-columns', $post['columns']);
			update_post_meta( $post['db_id'], '_menu-item-icon', $post['icon']);
			update_post_meta( $post['db_id'], '_menu-item-label', sanitize_post($post['item_label']));
			update_post_meta( $post['db_id'], '_menu-item-background_repeat', sanitize_post($post['background_repeat']));
			update_post_meta( $post['db_id'], '_menu-item-background_position', $post['background_position']);
			update_post_meta( $post['db_id'], '_menu-item-use_img', sanitize_post($post['use_img']));
			update_post_meta( $post['db_id'], '_menu-item-widget_area', sanitize_post($post['widget_area']));
			update_post_meta( $post['db_id'], '_menu-item-static_block', sanitize_post($post['static_block']));
			// update_post_meta( $post['db_id'], '_menu-item-open_by_click', sanitize_post($post['open_by_click']));

			echo json_encode($meta);
			die();
		}
	}