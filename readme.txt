=== Ultimate Facebook Comments ===
Contributors: Infosatech
Tags: facebook comments, comments, facebook, lazy comments, pagespeed
Requires at least: 3.0
Tested up to: 5.0
Stable tag: 1.3.1
Requires PHP: 5.4
Donate link: http://bit.ly/2I0Gj60
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

Ultimate Facebook Comments plugin will help you to display Facebook Comments box on your website easily. You can use Facebook Comments on your posts or pages.

== Description ==

### Ultimate Facebook Comments: the Ultimate Facebook Comments plugin for WordPress.

If you’re running a blog of any kind, you’re probably looking to build an online community. You're targeting like-minded people who share the interests highlighted by the content on your site. In that case, Facebook Comments may help you a lot.

> #### Ultimate Facebook Comments - Features
>
> - Add most popular Facebook commenting system in your website.<br />
> - **Lazy Load Facebook scripts and comments only after clicking a button or scrolling down.**<br />
> - **Translation ready!**<br />
> - **Live Facebook Comment Count**.<br />
> - **Email Notification**.<br />
> - Adjust number of comments, color scheme, language, width, sorting order, bg color, comments url, comments box title etc..<br />
> - Facebook comments increases your audience.<br />
> - 3 different facebook comments loading methods.<br />
> - Customize button label.<br />
> - **Super Light weight.**<br />
> - Completely free to use with lifetime updates.<br />
> - **Developer friendly.**<br />
> - 100% GDPR complaint.<br />
> - Mobile Ready.<br />
> - Direct access to facebook comment moderation tool.<br />
> - Easily configurable with shortcodes.<br />
> - Shortcode ready widget.<br />
> - Ability to disable WordPress native comment system.<br />
> - Compatible with other facebook sharing plugin.<br />
> - Follows best WordPress coding standards.<br />

#### Compatibility

This plugin is fully compatible with WordPress Version 3.0 and beyond and also compatible with any WordPress theme.

#### Support/Contribute

* Active development of this plugin is handled [on GitHub](https://github.com/iamsayan/ultimate-facebook-comments).
* Pull requests for documenting bugs are highly appreciated.
* If you think you’ve found a bug (e.g. You’re experiencing unexpected behaviour), please post on the [support forums](https://wordpress.org/support/plugin/ultimate-facebook-comments) first.

Like the Ultimate Facebook Comments plugin? Consider leaving a [5 star review](https://wordpress.org/support/plugin/ultimate-facebook-comments/reviews/?rate=5#new-post).

== Installation ==

1. Visit 'Plugins > Add New'.
1. Search for 'Ultimate Facebook Comments' and install it.
1. Or you can upload the `ultimate-facebook-comments` folder to the `/wp-content/plugins/` directory manually.
1. Activate Ultimate Facebook Comments from your Plugins page.
1. After activation go to 'Settings > Facebook Comments'.
1. Enable options and save changes.

== Frequently Asked Questions ==

= Is there any admin interface for this plugin? =

Yes. You can access this from 'Settings > Facebook Comments'.

= How to use this plugin? =

Go to 'Settings > Facebook Comments', enable/disable options as per your need and save your changes.

= How to check this plugin is working? =

After enabling options in 'Settings > Facebook Comments', open any page or post and you can see the facebook comment box.

= How this plugin works? =

This plugin hooks into the WordPress content area or replace WordPress native comment and displays Facebook Comment on posts and pages.

= Will it requires editing code to show Facebook Comment box? =

Not at all. You can show the facebook comments by just installing this plugin. Use the Plugin Options to customize the plugin settings according to your need.

= Is this plugin compatible with any themes? =

Yes, this plugin is compatible with any theme.

= I want to migrate from other facebook comments plugin. What are the steps? =

Just copy Facebook App ID and paste it on plugin settings page and this plugin will do the rest. Also, don't forget to configure plugin setting according to your need.

= As I am using other facebook plugins, the Facebook SDK is already loaded by that plugin and Comments are not showing. What is the solution? =

Add this snippets in your functions.php file: `add_filter( 'ufc_facebook_sdk_reinit_method', '__return_true' );` and this will definitely work.

= How to show FB comment count on frontend posts meta? =

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
3. Page loading speed with lazyload

== Changelog ==

= 1.3.1 =
Release Date: December 2, 2018

* Added: Notification Email Template.
* Added: WordPress Editor to Notification settings.
* Improved: Template Tag mechanism.
* Improved: Admin UI.
* Fixed: Some minor bugs.
* Fixed: Some incorrectly translated strings.
* Tested upto WordPress Version 5.0.

= 1.3.0 =
Release Date: November 28, 2018

* NEW: Added Email Notifications.
* Improved: Comment Count Mechanism.

= Other Versions =

* View the <a href="https://plugins.svn.wordpress.org/ultimate-facebook-comments/trunk/changelog.txt" target="_blank">Changelog</a> file.

== Upgrade Notice ==

= 1.3.0 =
In this release, we add facebook comment Notification to this plugin.