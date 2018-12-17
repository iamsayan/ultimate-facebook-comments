=== Ultimate Facebook Comments ===
Contributors: Infosatech
Tags: facebook comments, comments, facebook, lazy comments, pagespeed
Requires at least: 3.5
Tested up to: 5.0
Stable tag: 1.3.3
Requires PHP: 5.4
Donate link: http://bit.ly/2I0Gj60
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

Ultimate Facebook Comments plugin will help you to display Facebook Comments box on your website easily. You can use Facebook Comments on your posts or pages.

== Description ==

### Ultimate Facebook Comments: the Ultimate Facebook Comments plugin for WordPress.

If you’re running a blog of any kind, you’re probably looking to build an online community. You're targeting like-minded people who share the interests highlighted by the content on your site. In that case, Facebook Comments may help you a lot.

> GDPR compliant: does not collect any user data

#### Ultimate Facebook Comments - Features

* Add most popular Facebook commenting system in your website.
* **Lazy Load Facebook scripts and comments only after clicking a button or scrolling down.**
* **Translation ready!**
* **Live Facebook Comment Count**.
* **Email Notification**.
* Adjust number of comments, color scheme, language, width, sorting order, bg color, comments URL, comments box title etc.
* Facebook comments increases your audience.
* 3 different Facebook comments loading methods.
* Customize button label.
* **Super Lightweight.**
* Completely free to use with lifetime updates.
* **Developer friendly.**
* Mobile Ready.
* Direct access to Facebook comment moderation tool.
* Easily configurable with shortcodes.
* Shortcode ready widget.
* Ability to disable WordPress native comment system.
* Compatible with other Facebook sharing plugin.
* Follows the best WordPress coding standards.

#### Themes Tested with this plugin and works perfect

* Astra/Pro
* OceanWP
* Genesis Framework
* GeneratePress
* Zephyr
* Impreza
* Newspaper by tagdiv
* Divi theme
* Avada
* Writing
* Twentynineteen
* and many more.

#### Compatibility

This plugin is fully compatible with WordPress Version 3.5 and beyond and also compatible with any WordPress theme.

#### Support/Contribute

* Active development of this plugin is handled [on GitHub](https://github.com/iamsayan/ultimate-facebook-comments).
* Pull requests for documenting bugs are highly appreciated.
* If you think you’ve found a bug (e.g. You’re experiencing unexpected behavior), please post on the [support forums](https://wordpress.org/support/plugin/ultimate-facebook-comments) first.

Like the Ultimate Facebook Comments plugin? Consider leaving a [5 star review](https://wordpress.org/support/plugin/ultimate-facebook-comments/reviews/?rate=5#new-post).

== Installation ==

1. Visit 'Plugins Add New'.
1. Search for 'Ultimate Facebook Comments' and install it.
1. Or you can upload the `ultimate-facebook-comments` folder to the `/wp-content/plugins/` directory manually.
1. Activate Ultimate Facebook Comments from your Plugins page.
1. After activation, go to 'FB Comments' from Settings menu.
1. Enable options and save changes.

== Frequently Asked Questions ==

= Is there any admin interface for this plugin? =

Yes. You can access this from 'Settings Menu FB Comments'.

= How to use this plugin? =

Go to 'Settings Menu FB Comments', enable/disable options as per your need and save your changes.

= How to check this plugin is working? =

After enabling options in 'Settings Menu FB Comments', open any page or post and you can see the Facebook comment box.

= How this plugin works? =

This plugin hooks into the WordPress content area or replace WordPress native comment and displays Facebook Comment on posts and pages.

= Will it requires editing code to show Facebook Comment box? =

Not at all. You can show the Facebook comments by just installing this plugin. Use the Plugin Options to customize the plugin settings according to your need.

= Is this plugin compatible with any themes? =

Yes, this plugin is compatible with any theme.

= I want to migrate from other Facebook comments plugin. What are the steps? =

Just copy Facebook App ID and paste it on plugin settings page and this plugin will do the rest. Also, don't forget to configure plugin setting according to your need.

= As I am using other Facebook plugins, the Facebook SDK is already loaded by that plugin and Comments are not showing. What is the solution? =

Add these snippets in your functions.php file: `add_filter( 'ufc_facebook_sdk_reinit_method', '__return_true' );` and this will definitely work.

= How to show Facebook comment count on front end posts meta? =

In this case, you have to edit your theme's template files i.e. single.php, page.php etc. And add/replace default published date function with this:

Returns the last modified info:

`<?php if ( function_exists( 'get_fb_comment_count' ) ) {
		get_fb_comment_count();
	}
?>`

Displays/echos the last modified info:

`<?php if ( function_exists( 'fb_comment_count' ) ) {
		fb_comment_count();
	}
?>`

== Screenshots ==

1. Settings
2. Facebook comment box
3. Page loading speed with lazy load

== Changelog ==

= 1.3.3 =
Release Date: December 17, 2018

* NEW: Admin UI.
* Added: Option to set HTML tags for comment box title.
* Fixed: Minor bug fixed.

= 1.3.2 =
Release Date: December 9, 2018

* Improved: Admin UI.
* Fixed: Comments and Meta Boxes are not showing on posts edit screen if 'After Content' method is selected.
* Fixed: Some incorrectly translated strings.

= 1.3.1 =
Release Date: December 2, 2018

* Added: Notification Email Template.
* Added: WordPress Editor to Notification settings.
* Improved: Template Tag mechanism.
* Improved: Admin UI.
* Fixed: Some minor bugs.
* Fixed: Some incorrectly translated strings.
* Tested up to WordPress Version 5.0.

= 1.3.0 =
Release Date: November 28, 2018

* NEW: Added Email Notifications.
* Improved: Comment Count Mechanism.

= Other Versions =

* View the <a href="https://plugins.svn.wordpress.org/ultimate-facebook-comments/trunk/changelog.txt" target="_blank">Changelog</a>file.

== Upgrade Notice ==

= 1.3.3 =
In this release, redesigned the admin panel. Please reconfigure notification settings after plugin update.