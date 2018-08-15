=== Ultimate Facebook Comments ===
Contributors: Infosatech
Tags: facebook comments, comments, facebook, lazy comments, pagespeed
Requires at least: 3.0
Tested up to: 4.9
Stable tag: 1.1.3
Requires PHP: 5.3
Donate link: http://bit.ly/2I0Gj60
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

Ultimate Facebook Comments plugin will help you to display Facebook Comments box on your website easily. You can use Facebook Comments on your posts or pages.

== Description ==

### Ultimate Facebook Comments: the Ultimate Facebook Comments plugin for WordPress.

If you’re running a blog of any kind, you’re probably looking to build an online community. You're targeting like-minded people who share the interests highlighted by the content on your site. It’s a mutually beneficial relationship: Your visitors get information that they consider valuable by visiting your site, and you build an audience.

However, it’s also a great idea to allow your visitors to interact with one another. One of the best ways to do that is with a comments section that allows them to not only leave you feedback on your content but also to interact with each other. Here are some of the benefits you can expect from a comments section.

#### What does this plugin do?

This plugin hooks into WordPress native comment area or after content area and shows the facebook comments box using lazyload.

* 100% GDPR Compliant.
* Allows you to display facebook comment box in your posts and pages individually.
* Allows you to customize the facebook comment box title text.
* Allows you to disable WordPress native comments and hide everything from WordPress dashboard.
* Allows you to set custom styles for comment box title.
* Allows you to set custom styles for comment area also.
* Allows you to set the comment area background colour.
* Allows you to open facebook comments moderation tool directly from plugin settings page.
* And you can customize all and everything.

### Themes Tested with this plugin and works perfect ###

* Astra/Pro
* OceanWP
* Genesis Framework
* GeneratePress
* Zephyr
* Impreza
* Twentyseventeen
* and many more.

#### Compatibility

This plugin is fully compatible with WordPress Version 3.0 and beyond and also compatible with any WordPress theme.

#### Support/Contribute

* Active development of this plugin is handled [on GitHub](https://github.com/iamsayan/ultimate-facebook-comments).
* Pull requests for documenting bugs are highly appreciated.
* If you think you’ve found a bug (e.g. You’re experiencing unexpected behaviour), please post on the [support forums](https://wordpress.org/support/plugin/ultimate-facebook-comments) first.

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

= Will it require editing code to show Facebook Comment box? =

Not at all. You can show the facebook comments by just installing this plugin. Use the Plugin Options to customize the plugin settings according to your need.

= Is this plugin compatible with any themes? =

Yes, this plugin is compatible with any theme.

= How to show FB comment count on posts meta? =

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

= 1.1.3 =
Release Date: August 15, 2018

* Improved: Admin column comment count feature.
* Bug fixed.

= 1.1.2 =
Release Date: August 13, 2018

* Added: Template Tags support to show facebook comment count on pages/posts in the frontend.
* Added: a feature that shows facebook comment count beside posts/pages on the edit.php page.
* Improved: It is possible to disable facebook comments from the quick edit.
* Improved: Now facebook comment box ID is customizable to match with your theme.
* Improved: Comment notification system by adding data-notify="true" in facebook comment.
* Improved: Admin UI.
* Fixed: A bug where facebook SDK loads too early.
* Fixed: A bug where Facebook comments show on attachments but this post type is not selected in plugin Settings.

= 1.1.0 =
Release Date: August 9, 2018

* Added: I18n support.
* Added: An admin column item indicating on which posts facebook comment is active.
* Improved: Made uninstall cleanup optional through a plugin setting and improved uninstall mechanism.
* Improved: Plugin settings now depends on own meta box.
* Improved: Admin UI.

* Initial release.

= Other Versions =

* View the <a href="https://plugins.svn.wordpress.org/ultimate-facebook-comments/trunk/changelog.txt" target="_blank">Changelog</a> file.

== Upgrade Notice ==

= 1.1.3 =
In this release, most of the bugs have been fixed. Update the plugin on your website now to get fixes and enhancements.

= 1.1.2 =
In this release, most of the bugs have been fixed. Also, new features have been introduced. Please, update the plugin on your website now to get fixes and enhancements.

= 1.1.0 =
In this release, most of the bugs have been fixed. Also, new features have been introduced. Please, update the plugin on your website now to get fixes and enhancements.