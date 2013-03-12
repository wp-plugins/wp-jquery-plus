<?php
/*
Plugin Name: WP jQuery Plus
Plugin URI: http://zslabs.com
Description: Loads jQuery from Google using the exact jQuery version as your current WordPress install while still maintaining backwards comptability for the core WP jQuery library
Author: Zach Schnackel
Author URI: http://zslabs.com
Version: 0.4
*/


/**
 * Check the WordPress version on activation
 * Deactivate plugin if running lower than 3.5
 * @return void
 *
 * @since 0.4
 */
function wpjp_activate() {

	global $wp_version;

	if ( version_compare( $wp_version, '3.5', '<' ) ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );
		wp_die( printf( __( 'Sorry, but your version of WordPress, <strong>%s</strong>, does not meet WP jQuery Plus\'s required version of <strong>3.5</strong> to run properly. The plugin has been deactivated. <a href="%s">Click here to return to the Dashboard</a>', 'wpjp' ), $wp_version, admin_url() ) );
	}

}
register_activation_hook( __FILE__, 'wpjp_activate' );

/**
 * Swap jQuery source for Google
 * @return void
 *
 * @since 0.3
 */
function wpjp_set_src() {

	if ( !is_admin() ) {

		// Get current version of jQuery from WordPress core
		$wp_jquery_ver = $GLOBALS['wp_scripts']->registered['jquery']->ver;

		// Set jQuery Google URL
		$jquery_google_url = '//ajax.googleapis.com/ajax/libs/jquery/'.$wp_jquery_ver.'/jquery.min.js';

		// De-register jQuery
		wp_deregister_script( 'jquery' );

		// Register jQuery with Google URL
		wp_register_script( 'jquery', $jquery_google_url, '', null, false );

	}
}
add_action( 'wp_enqueue_scripts', 'wpjp_set_src' );

/**
 * Add local fallback for jQuery if CDN is down or not accessible
 * @param  string $src
 * @param  string $handle
 * @return string
 */
function wpjp_local_fallback( $src, $handle ) {

	if ( !is_admin() ) {

		static $add_jquery_fallback = false;

		if ( $add_jquery_fallback ) {
			echo '<script>window.jQuery || document.write(\'<script src="' . includes_url( 'js/jquery/jquery.js' ) . '"><\/script>\')</script>' . "\n";
			$add_jquery_fallback = false;
		}

		if ( $handle === 'jquery' ) {
			$add_jquery_fallback = true;
		}

		return $src;

	}

	return $src;

}
add_filter( 'script_loader_src', 'wpjp_local_fallback', 10, 2 );