<?php

/*
Plugin Name: WP jQuery Plus
Plugin URI: http://zslabs.com
Description: Loads jQuery from Google using the exact jQuery version as your current WordPress install while still maintaining backwards comptability for the core WP jQuery library
Author: Zach Schnackel
Author URI: http://zslabs.com
Version: 0.2
*/

function wp_jquery_scripts() {
    if (!is_admin()) {
        // Get current version of jQuery from WordPress core
        $wp_jquery_ver = $GLOBALS['wp_scripts']->registered['jquery']->ver;
        // Figure out which protocol to use
        $http_protocol = is_ssl() ? 'https:' : 'http:';
        // Set jQuery Google URL
        $jquery_google_url = $http_protocol.'//ajax.googleapis.com/ajax/libs/jquery/'.$wp_jquery_ver.'/jquery.min.js';
        // De-register jQuery
        wp_deregister_script('jquery');
        // Register jQuery with Google URL
        wp_register_script('jquery', ''.$jquery_google_url.'', '', null, false);
    }
}
 
add_action('wp_enqueue_scripts', 'wp_jquery_scripts');