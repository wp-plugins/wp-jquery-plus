<?php

/*
Plugin Name: WP jQuery Plus
Plugin URI: http://zslabs.com
Description: Loads jQuery from Google using the exact jQuery version as your current WordPress install while still maintaining backwards comptability for the core WP jQuery library
Author: Zach Schnackel
Author URI: http://zslabs.com
Version: 0.1
*/

function wp_jquery_scripts() {
	if (!is_admin()) {
		wp_enqueue_script('jquery');
		// Get current version of jQuery from WordPress core
		$wp_jquery_ver = $GLOBALS['wp_scripts']->registered['jquery']->ver;
		// Figure out which protocol to use
		$http_protocol = is_ssl() ? 'https:' : 'http:';
		// Set jQuery Google URL
		$jquery_google_url = $http_protocol.'//ajax.googleapis.com/ajax/libs/jquery/'.$wp_jquery_ver.'/jquery.min.js';
		// Setup Curl Function
		function jquery_get_data($url) {
			$ch = @curl_init($url);
			@curl_setopt($ch, CURLOPT_HEADER, TRUE);
			@curl_setopt($ch, CURLOPT_NOBODY, TRUE);
			@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
			@curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$status = array();
			preg_match('/HTTP\/.* ([0-9]+) .*/', @curl_exec($ch) , $status);
			return ($status[1] == 200);
		}
		if (jquery_get_data($jquery_google_url)) {
			wp_deregister_script('jquery');
			wp_register_script('jquery', ''.$jquery_google_url.'', '', $wp_jquery_ver, false);
		}
	}
}

add_action('wp_enqueue_scripts', 'wp_jquery_scripts');