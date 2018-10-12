=== Ultimate Facebook Comments ===
Contributors: Infosatech
Tags: facebook comments, comments, facebook, lazy comments, pagespeed
Requires at least: 3.0
Tested up to: 4.9
Stable tag: 1.2.2
Requires PHP: 5.4
Donate link: http://bit.ly/2I0Gj60
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

Ultimate Facebook Comments plugin will help you to display Facebook Comments box on your website easily. You can use Facebook Comments on your posts or pages.

== Description ==

### Ultimate Facebook Comments: the Ultimate Facebook Comments plugin for WordPress.

If you’re running a blog of any kind, you’re probably looking to build an online community. You're targeting like-minded people who share the interests highlighted by the content on your site. In that case Facebook Comments may help you a lot.

> #### Ultimate Facebook Comments - Features
>
> - Add most popular Facebook commenting system in your website.<br />
> - **Lazy Load Facebook scripts and comments only after clicking a button or scrolling down.**<br />
> - **Translation ready!**<br />
> - **Live Facebook Comment Count**.<br />
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

Just copy Facebook App ID and paste it on plugin settings page and this plugin will do the rest. Also don't forget to configure plugin setting according to your need.

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

= 1.2.2 =
Release Date: October 12, 2018

* Fixed: Some times Facebook Comments box shows in a small comments area. Now it has been fixed.
* Fixed: An `Undefined index: ufc_fb_sdk_reinit` notice shows in WP Footer if Facebook SDK option is not selected.

= 1.2.1 =
Release Date: October 2, 2018

* Added: Option to set custom Accept/Decline text.
* Fixed: Most of the possible bugs are now fixed.

= 1.2.0 =
Release Date: September 24, 2018

* Added: Shortcode attributes.
* Fixed: a bug where "Facebook SDK - Already Loaded" option works only if lazy is enabled.

= 1.1.10 =
Release Date: September 23, 2018

* Fixed: Admin notice display mechanism.

= 1.1.9 =
Release Date: September 22, 2018

* Added: an option to set priority if "After Content" is selected.
* Fixed: a bug where facebook comments components load twice if "On Scroll" is selected.
* Improved Guide.
* Some minor bug fixed.

= 1.1.8 =
Release Date: September 14, 2018

* Tweak: make compatible with other facebook plugins.
* Fixed: Some untranslated strings.
* Some minor bug fixed.

= 1.1.7 =
Release Date: August 28, 2018

* Added: a new item 'Custom' in 'Comments Box Display Position'. It will globally disable auto insert if you want to use shortcode side-wide.
* Fixed: Admin Bar Moderation Tool on/off does not work. Now it has been fixed.
* Fixed: Unnecessary output of HTML components in quick edit mode.
* Fixed: jQuey cookie path issue related to consent notice.
* Updated: jQuery cookie library.

= 1.1.6 =
Release Date: August 28, 2018

* Improved: Comment count fetching method from Facebook API.
* Improved: Admin UI.
* Fixed: Some untranslated strings.
* Some minor bug fixed.

= 1.1.5 =
Release Date: August 19, 2018

* Tweak: replace native comments now depends on WordPress default comment enable/disable system as FB comment box does not show previously on frontend if Disable WP Native Comment is enabled.
* Fixed: Some untranslated strings.
* Bug fixed.

= 1.1.4 =
Release Date: August 18, 2018

* Added: Facebook SDK language codes.
* Fixed: Some untranslated strings.
* Bug fixed.

= 1.1.3 =
Release Date: August 15, 2018

* Improved: Admin column comment count feature.
* Fixed: Some untranslated strings.
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

= Other Versions =

* View the <a href="https://plugins.svn.wordpress.org/ultimate-facebook-comments/trunk/changelog.txt" target="_blank">Changelog</a> file.

== Upgrade Notice ==

= 1.1.8 =
In this release, we make this plugin compatible with other facebook related plugins.

= 1.1.7 =
In this release, most of the bugs have been fixed.

= 1.1.6 =
In this release, most of the bugs have been fixed. Update the plugin on your website now to get fixes and enhancements.

= 1.1.5 =
In this release, most of the bugs have been fixed. Update the plugin on your website now to get fixes and enhancements.

= 1.1.4 =
In this release, most of the bugs have been fixed. Update the plugin on your website now to get fixes and enhancements.

= 1.1.3 =
In this release, most of the bugs have been fixed. Update the plugin on your website now to get fixes and enhancements.

= 1.1.2 =
In this release, most of the bugs have been fixed. Also, new features have been introduced. Please, update the plugin on your website now to get fixes and enhancements.

= 1.1.0 =
In this release, most of the bugs have been fixed. Also, new features have been introduced. Please, update the plugin on your website now to get fixes and enhancements.