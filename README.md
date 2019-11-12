![alt text](https://github.com/iamsayan/ultimate-facebook-comments/raw/master/banner.png "Plugin Banner")

# Ultimate Social Comments

🔥 Ultimate Social Comments plugin will help you to display Facebook Comments box on your website easily. You can use Facebook Comments on your posts or pages.

[![WP compatibility](https://plugintests.com/plugins/ultimate-facebook-comments/wp-badge.svg)](https://plugintests.com/plugins/ultimate-facebook-comments/latest) [![PHP compatibility](https://plugintests.com/plugins/ultimate-facebook-comments/php-badge.svg)](https://plugintests.com/plugins/ultimate-facebook-comments/latest)

## Description

### Ultimate Social Comments: the Ultimate Social Comments plugin for WordPress.

If you’re running a blog of any kind, you’re probably looking to build an online community. You're targeting like-minded people who share the interests highlighted by the content on your site. It’s a mutually beneficial relationship: Your visitors get information that they consider valuable by visiting your site, and you build an audience.

However, it’s also a great idea to allow your visitors to interact with one another. One of the best ways to do that is with a comments section that allows them to not only leave you feedback on your content but also to interact with each other. Here are some of the benefits you can expect from a comments section.

Like the Ultimate Social Comments plugin? Consider leaving a [5 star review](https://wordpress.org/support/plugin/ultimate-facebook-comments/reviews/?rate=5#new-post).

#### Ultimate Social Comments - Features

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

This plugin is fully compatible with WordPress Version 4.6 and beyond and also compatible with any WordPress theme.

#### Support/Contribute

* Active development of this plugin is handled [on GitHub](https://github.com/iamsayan/ultimate-facebook-comments).
* Pull requests for documenting bugs are highly appreciated.
* If you think you’ve found a bug (e.g. You’re experiencing unexpected behaviour), please post on the [support forums](https://wordpress.org/support/plugin/ultimate-facebook-comments) first.

## Installation ##

### From within WordPress ###
1. Visit 'Plugins > Add New'.
1. Search for 'Ultimate Social Comments'.
1. Activate Ultimate Social Comments from your Plugins page.
1. Go to "after activation" below.

### Manually ###
1. Upload the `ultimate-facebook-comments` folder to the `/wp-content/plugins/` directory.
1. Activate WP Last Modified Info plugin through the 'Plugins' menu in WordPress.
1. Go to "after activation" below.

### After activation ###
1. After activation go to 'Settings > Facebook Comments'.
1. Enable/disable options and save changes.

### Frequently Asked Questions

#### Is there any admin interface for this plugin?

Yes. You can access this from 'Settings > FB Comments'.

#### How to use this plugin?

Go to 'Settings > FB Comments', enable/disable options as per your need and save your changes.

#### How to check this plugin is working?

After enabling options in 'Settings > FB Comments', open any page or post and you can see the facebook comment box.

#### How this plugin works?

This plugin hooks into the WordPress content area or replace WordPress native comment and displays Facebook Comment on posts and pages.

#### Will it require editing code to show Facebook Comment box?

Not at all. You can show the facebook comments by just installing this plugin. Use the Plugin Options to customize the plugin settings according to your need.

#### Is this plugin compatible with any themes?

Yes, this plugin is compatible with any theme.

#### I want to migrate from other facebook comments plugin. What are the steps?

Just copy Facebook App ID and paste it on plugin settings page and this plugin will do the rest. Also don't forget to configure plugin setting according to your need.

#### How to show FB comment count on posts meta?

In this case, you have to edit your theme's template files i.e. single.php, page.php etc. And add/replace default published date function with this:

Returns the facebook comments count:

`<?php if ( function_exists( 'get_fb_comment_count' ) ) {
		get_fb_comment_count();
	}
?>`

Displays/echos facebook comments count:

`<?php if ( function_exists( 'fb_comment_count' ) ) {
		fb_comment_count();
	}
?>`

#### The plugin isn't working or have a bug?

Post detailed information about the issue in the [support forum](https://wordpress.org/support/plugin/ultimate-facebook-comments) and I will work to fix it.

## Changelog ##
[View Changelog](CHANGELOG.md)