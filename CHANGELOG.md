# Changelog
All notable changes to this project will be documented in this file.

## 1.4.5
Release Date: November 11, 2019

* Updated: Facebook SDK Version to v5.0.
* Fixed: Some untranslated strings.
* Fixed: Some typos.
* Fixed: Some broken links.
* Change the plugin name properly to avoid copyright infringement.
* Tested with WordPress 5.3.

## 1.4.4
Release Date: September 29, 2019

* Updated: Facebook SDK Version to v4.0.
* Improved: Properly validating the $_POST request.
* Removed: Some unused codes.
* Change the plugin name to avoid copyright infringement.

## 1.4.3
Release Date: June 15, 2019

* Added: Support to replace wordpress comment count with facebook comments count on frontend.
* Updated: Facebook SDK Version to v3.3.
* Tweak: WP Editor Media button will be hidden from now.
* Tested with WordPress 5.2.

## 1.4.2
Release Date: April 22, 2019

* Added: Support for post id in commnet count template tags.
* Added: Some filters to customize comment count text output.
* Added: span class and data-href in comment count output.
* Tweak: Reduced plugin size.
* Fixed: Conflict with Bootstrap CSS Class.
* Fixed: Missing HTML Tags in Admin Notice.
* Removed: Some CSS Files.

## 1.4.1
Release Date: March 13, 2019

* Added: Support for WooCommerece Comments.

## 1.4.0
Release Date: March 9, 2019

* Added: A method to automatically fetch comment count of a certain post if comment count meta doesn't exist.
* Added: Some Shortcodes attributes to customize frontend output via shortcode.
* Improved: The lazy loading mechanism to optimize page speed.
* Improved: The Javascript codes which is liable for unnecessary SDK loading.
* Improved: Compatibility with other Facebook Plugin.
* Improved: AJAX Security Mechanism.
* Tweak: Now Shortcode also supports Lazy loading methods - On Click and On Scroll.
* Tweak: Now this plugin automatically disables the output of Facebook Comments in AMP pages created by AMP for WP Plugin.
* Tweak: Facebook Comment Count will always enable from now. You can hide it from Screen Options.
* Tweak: Facebook Comment Application Secret now uses password type field.
* Fixed: A issue with Shortcode if shortcode is not in Post Content.
* Fixed: A Shortcode CSS issue. 
* Fixed: Duplicate HTML Element warning in browser console on Admin Settings Page.
* Removed: Some unwanted code from plugin codebase.
* Removed: Facebook SDK Loading Method option in plugin settings.

## 1.3.7
Release Date: February 18, 2019

* Added: Option to switch Facebook SDK loding method.
* Tweak: Now this plugin automatically disables the output of Facebook Comments in amp pages.
* Fixed: The wp editor saving issue with 'Notification Email Message'.
* Fixed: A issue with `quick_edit_custom_box` action hook.
* Tested with WordPress 5.1.

## 1.3.6
Release Date: February 15, 2019

* Improved: Added a security check for ajax requests.
* Improved: Appsecret Proof is being used to fetch info from Facebook Graph API.
* Tweak: Now Reply button directly redirects to Comments Area.
* Fixed: The editor height of 'Notification Email Message'.
* Added: WPML Compatibility.

## 1.3.5
Release Date: February 12, 2019

* Fixed: All minor bugs has been fixed.
* Fixed: Some incorrectly translated strings.

## 1.3.4
Release Date: January 4, 2019

* Improved: Facebook API Method to avoid Facebook api: (#4) Application request limit reached problem.
* Fixed: Some error notice.
* Fixed: Some incorrectly translated strings.

## 1.3.3
Release Date: December 17, 2018

* NEW: Admin UI.
* Added: Option to set HTML tags for comment box title.
* Fixed: Minor bug fixed.

## 1.3.2
Release Date: December 9, 2018

* Improved: Admin UI.
* Fixed: Comments and Meta Boxes are not showing on posts edit screen if 'After Content' method is selected.
* Fixed: Some incorrectly translated strings.

## 1.3.1
Release Date: December 2, 2018

* Added: Notification Email Template.
* Added: WordPress Editor to Notification settings.
* Improved: Template Tag mechanism.
* Improved: Admin UI.
* Fixed: Some minor bugs.
* Fixed: Some incorrectly translated strings.
* Tested up to WordPress Version 5.0.

## 1.3.0
Release Date: November 28, 2018

* NEW: Added Email Notifications.
* Improved: Comment Count Mechanism.

## 1.2.4
Release Date: October 15, 2018

* Fixed: Multiple output of facebook comments on frontend if the post is not inside loop when after content method is used.

## 1.2.3
Release Date: October 13, 2018

* Tweak: We have removed 'Facebook SDK Status' option to make plugin settings more easy. We have also introduced a new filter (Read FAQ) to reinit FB SDK, if SDK is already loaded by other plugins.

## 1.2.2
Release Date: October 12, 2018

* Fixed: Some times Facebook Comments box shows in a small comments area. Now it has been fixed.
* Fixed: An `Undefined index: ufc_fb_sdk_reinit` notice shows in WP Footer if Facebook SDK option is not selected.

## 1.2.1
Release Date: October 2, 2018

* Added: Option to set custom Accept/Decline text.
* Fixed: Most of the possible bugs are now fixed.

## 1.2.0
Release Date: September 24, 2018

* Added: Shortcode attributes.
* Fixed: a bug where "Facebook SDK - Already Loaded" option works only if lazy is enabled.

## 1.1.10
Release Date: September 23, 2018

* Fixed: Admin notice display mechanism.

## 1.1.9
Release Date: September 22, 2018

* Added: an option to set priority if "After Content" is selected.
* Fixed: a bug where facebook comments components load twice if "On Scroll" is selected.
* Improved Guide.
* Some minor bug fixed.

## 1.1.8
Release Date: September 14, 2018

* Tweak: make compatible with other facebook plugins.
* Fixed: Some untranslated strings.
* Some minor bug fixed.

## 1.1.7
Release Date: August 28, 2018

* Added: a new item 'Custom' in 'Comments Box Display Position'. It will globally disable auto insert if you want to use shortcode side-wide.
* Fixed: Admin Bar Moderation Tool on/off does not work. Now it has been fixed.
* Fixed: Unnecessary output of HTML components in quick edit mode.
* Fixed: jQuey cookie path issue related to consent notice.
* Updated: jQuery cookie library.

## 1.1.6
Release Date: August 28, 2018

* Improved: Comment count fetching method from Facebook API.
* Improved: Admin UI.
* Fixed: Some untranslated strings.
* Some minor bug fixed.

## 1.1.5
Release Date: August 19, 2018

* Tweak: replace native comments now depends on WordPress default comment enable/disable system as FB comment box does not show previously on frontend if Disable WP Native Comment is enabled.
* Fixed: Some untranslated strings.
* Bug fixed.

## 1.1.4
Release Date: August 18, 2018

* Added: Facebook SDK language codes.
* Fixed: Some untranslated strings.
* Bug fixed.

## 1.1.3
Release Date: August 15, 2018

* Improved: Admin column comment count feature.
* Bug fixed.

## 1.1.2
Release Date: August 13, 2018

* Added: Template Tags support to show facebook comment count on pages/posts in the frontend.
* Added: a feature that shows facebook comment count beside posts/pages on the edit.php page.
* Improved: It is possible to disable facebook comments from the quick edit.
* Improved: Now facebook comment box ID is customizable to match with your theme.
* Improved: Comment notification system by adding data-notify="true" in facebook comment.
* Improved: Admin UI.
* Fixed: A bug where facebook SDK loads too early.
* Fixed: A bug where Facebook comments show on attachments but this post type is not selected in plugin Settings.

## 1.1.0
Release Date: August 9, 2018

* Added: I18n support.
* Added: An admin column item indicating on which posts facebook comment is active.
* Improved: Made uninstall cleanup optional through a plugin setting and improved uninstall mechanism.
* Improved: Plugin settings now depends on own meta box.
* Improved: Admin UI.

## 1.0.3
Release Date: June 3, 2018

* Fix: 'Facebook Comment Area CSS Class' is not working when Default mode is active in 'FB Comment Box Loading Method'.
* Fix: Ajax does not work properly.
* Fix: Reset button does not work properly.

## 1.0.2
Release Date: June 2, 2018

* Added: GDPR Compatibility.
* Added: Default Facebook SDK Loading Method.
* Added: Option to show both fb comments and wp native comments on same page.
* Added: Option to set comment box background color.
* Improved: Admin UI.
* Bug Fix.

## 1.0.0
Release Date: May 30, 2018

* Initial release.
