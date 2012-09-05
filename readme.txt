=== WP jQuery Plus ===
Contributors: zslabs
Tags: jquery,google
Requires at least: 3.3
Tested up to: 3.4.1
Stable tag: 0.3
License: GPLv2

Loads jQuery from Google using the exact jQuery version as your current WordPress install while still maintaining backwards comptability for the core WP jQuery library

== Description ==

There’s been a [whole heap of discussions](http://wpcandy.com/teaches/how-to-load-scripts-in-wordpress-themes) recently about the "correct" way to load jQuery onto your site. I thought I’d throw my solution into the ring. What this plugin does differently than others is it loads jQuery from Google - while still maintaining backwards compatability for the core WP jQuery library AND uses the core WP jQuery version!

*Future Plans*

* Store URL in transient for one less DB query (will only re-generate on WP upgrade to check for new jQuery version)

== Installation ==

1. Upload the `wp-jquery-plus` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Can you add `feature-x`? =

Sure! I'm always open to knew ideas. Just create a new forum post and I'll take a gander.

== Changelog ==

= 0.3 =
* Test push using https://github.com/benbalter/Github-to-WordPress-Plugin-Directory-Deployment-Script

= 0.2 =
* Removed CURL function (if Google is down, the entire Internet is down)

= 0.1 =
* Initial release