=== Plugin Name ===
Contributors: Woxxy
Donate link: http://foolrulez.org/donate/
Tags: yourls, url, shortening, widget
Requires at least: 2.8
Tested up to: 2.8.4
Stable tag: 0.4

This widget lets you embed your YOURLS installation (or someone else's through API) to have a short URL service into your sidebar.

== Description ==

This widget lets you embed your YOURLS installation (or someone else's through API) to have a short URL service into your sidebar.
It's pretty simple as for now and it does its work.

I will implement more options as inserting the password directly into the widget options menu (instead of via text-editor) in a few days. If you are using a passworded admin menu you have to edit yourls-widget-config.php. Further info in FAQ section. 

== Installation ==

1. Upload the folder `yourls-widget` (keep the name intact) to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Add the widget to your sidebar via the `Appearance/Widgets` menu.
4. Insert the URL to the API into the widget options. Example: http://yourdomain.com/yourls-api.php
5. If the YOURLS installation is in "private" configuration (with password to access admin) you have to enter the username and password in the yourls-widget-config.php file. Further info in FAQ section. 

== Frequently Asked Questions ==

=The widget gives an "Invalid username or password" notice/ I have a private configuration of YOURLS (admin access needs password).=
	
This happens because your YOURLS installation is private configuration.
To fix this you have to edit the yourls-widget-config.php and add user and password in the fields.
	
Example with username "user and password "password:
		`<?php $username = 'insert_your_user';
		$password = 'Insert_your_password';?>`
becomes:
		`<?php $username = 'user';
		$password = 'password';?>`

=Let any website use my API even if I have password protected admin=

To do this you have to edit your YOURLS API (yourls-api.php) and remove these lines:

`if ( defined(’YOURLS_PRIVATE’) && YOURLS_PRIVATE == true )
require_once( dirname(__FILE__).’/includes/auth.php’ );`

This will disable the password protection on the API, but will keep your admin menu passworded.

== Screenshots ==
Empty for now!

== Changelog ==
= 0.4 =
Fixed a mistake in the code not making jQuery work.

= 0.3 =
* First simple yet stable release.