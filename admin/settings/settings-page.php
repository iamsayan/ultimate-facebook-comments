<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Ultimate Facebook Comments
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */
?>

<div class="wrap">
    <div class="head-wrap">
        <h1 class="title">Ultimate Facebook Comments<span class="title-count"><?php echo UFC_PLUGIN_VERSION; ?></span></h1>
        <div><?php _e( 'The Ultimate Facebook Comments Plugin for WordPress.', 'ultimate-facebook-comments' ); ?></div><hr>
        <div class="top-sharebar">
            <a class="share-btn rate-btn" href="https://wordpress.org/support/plugin/ultimate-facebook-comments/reviews/?filter=5#new-post" target="_blank" title="<?php _e( 'Please rate 5 stars if you like Ultimate Facebook Comments', 'ultimate-facebook-comments' ); ?>"><span class="dashicons dashicons-star-filled"></span> <?php _e( 'Rate 5 stars', 'ultimate-facebook-comments' ); ?></a>
            <a class="share-btn twitter" href="https://twitter.com/home?status=Check%20out%20Ultimate%20Facebook%20Comments,%20an%20ultimate%20solution%20with%20email%20notification%20for%20%23WordPress%20that%20easily%20adds%20%23Facebook%20%23Comments%20in%20your%20posts%20and%20pages%20easily%20https%3A//wordpress.org/plugins/ultimate-facebook-comments/%20via%20%40im_sayaan" target="_blank"><span class="dashicons dashicons-twitter"></span> <?php _e( 'Tweet about Ultimate Facebook Comments', 'ultimate-facebook-comments' ); ?></a>
        </div>
    </div>
    <div id="nav-container" class="nav-tab-wrapper">
        <a href="#main" class="nav-tab active" id="btn1"><span class="dashicons dashicons-admin-post" style="padding-top: 2px;"></span> <?php _e( 'Main', 'ultimate-facebook-comments' ); ?></a>
        <a href="#settings" class="nav-tab" id="btn2"><span class="dashicons dashicons-admin-generic" style="padding-top: 2px;"></span> <?php _e( 'Settings', 'ultimate-facebook-comments' ); ?></a>
        <a href="#display" class="nav-tab" id="btn3"><span class="dashicons dashicons-visibility" style="padding-top: 2px;"></span> <?php _e( 'Display', 'ultimate-facebook-comments' ); ?></a>
        <a href="#title" class="nav-tab" id="btn4"><span class="dashicons dashicons-welcome-write-blog" style="padding-top: 2px;"></span> <?php _e( 'Title', 'ultimate-facebook-comments' ); ?></a>
        <a href="#notice" class="nav-tab" id="btn5"><span class="dashicons dashicons-media-text" style="padding-top: 2px;"></span> <?php _e( 'GDPR', 'ultimate-facebook-comments' ); ?></a>
        <a href="#notification" class="nav-tab" id="btn6"><span class="dashicons dashicons-email" style="padding-top: 2px;"></span> <?php _e( 'Notification', 'ultimate-facebook-comments' ); ?></a>
        <a href="#others" class="nav-tab" id="btn7"><span class="dashicons dashicons-screenoptions" style="padding-top: 2px;"></span> <?php _e( 'Others', 'ultimate-facebook-comments' ); ?></a>
        <a href="#shortcode" class="nav-tab" id="btn8"><span class="dashicons dashicons-editor-code" style="padding-top: 2px;"></span> <?php _e( 'Shortcode', 'ultimate-facebook-comments' ); ?></a>
        <a href="#tools" class="nav-tab" id="btn9"><span class="dashicons dashicons-admin-tools" style="padding-top: 2px;"></span> <?php _e( 'Tools', 'ultimate-facebook-comments' ); ?></a>
        <a href="#help" class="nav-tab" id="btn10"><span class="dashicons dashicons-editor-help" style="padding-top: 2px;"></span> <?php _e( 'Help', 'ultimate-facebook-comments' ); ?></a>
    </div>
    <script>
        var header = document.getElementById("nav-container");
        var btns = header.getElementsByClassName("nav-tab");
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
            });
        }
    </script>
    <div id="form_area">
        <div id="main-form">
            <form id="form-container" method="post" action="options.php">
                <?php settings_fields('ufc_show_plugin_section'); ?>
                <div id="show-main"> 
                    <?php do_settings_sections('ufc_plugin_main_section'); ?>
                    <?php submit_button( __( 'Save Settings', 'ultimate-facebook-comments' ), 'primary save-settings', 'submit-main' ); ?>
                </div>
                <div style="display:none" id="show-settings">
                    <?php do_settings_sections('ufc_plugin_settings_section'); ?>
                    <?php submit_button( __( 'Save Settings', 'ultimate-facebook-comments' ), 'primary save-settings', 'submit-settings' ); ?>
                </div>
                <div style="display:none" id="show-display">
                    <?php do_settings_sections('ufc_plugin_display_section'); ?>
                    <?php submit_button( __( 'Save Settings', 'ultimate-facebook-comments' ), 'primary save-settings', 'submit-display' ); ?>
                </div>
                <div style="display:none" id="show-title">
                    <?php do_settings_sections('ufc_plugin_title_section'); ?>
                    <?php submit_button( __( 'Save Settings', 'ultimate-facebook-comments' ), 'primary save-settings', 'submit-title' ); ?>
                </div>
                <div style="display:none" id="show-notice">
                    <?php do_settings_sections('ufc_plugin_gdpr_section'); ?>
                    <?php submit_button( __( 'Save Settings', 'ultimate-facebook-comments' ), 'primary save-settings', 'submit-gdpr' ); ?>
                </div>    
                <div style="display:none" id="show-notification">
                    <?php do_settings_sections('ufc_plugin_notification_section'); ?>
                    <?php submit_button( __( 'Save Settings', 'ultimate-facebook-comments' ), 'primary save-settings', 'submit-noti' ); ?>
                </div>
                <div style="display:none" id="show-others">
                    <?php do_settings_sections('ufc_plugin_other_section'); ?>
                    <?php submit_button( __( 'Save Settings', 'ultimate-facebook-comments' ), 'primary save-settings', 'submit-others' ); ?>
                </div>
                <div id="progressMessage" class="progressModal" style="display:none;"><?php _e( 'Please wait...', 'ultimate-facebook-comments' ); ?></div>
                <div id="saveMessage" class="successModal" style="display:none;"><p><?php _e( 'Settings Saved Successfully!', 'ultimate-facebook-comments' ); ?></p></div>
                <div id="show-shortcode" style="display: none;margin-bottom: 20px;">
                    <h3><?php _e( 'Shortcode', 'ultimate-facebook-comments' ); ?></h3><p><hr></p>
                    <p><?php printf( __( 'You can insert the comment box manually in any page or post or template by simply using the shortcode %1$s. To enter the shortcode directly into templates using PHP, enter %2$s', 'ultimate-facebook-comments' ), '<code>[ufc-fb-comments]</code>', '<code>echo do_shortcode(&#39;[ufc-fb-comments]&#39;);</code>' ); ?></strong></p>
                    <p><?php _e( 'You can also use the options/attributes below to override the the settings above.', 'ultimate-facebook-comments' ); ?></p>
                    <li><strong>url</strong> - <?php _e( 'set custom URL', 'ultimate-facebook-comments' ); ?></li>
                    <li><strong>width</strong> - <?php _e( 'minimum must be', 'ultimate-facebook-comments' ); ?> <strong>320</strong>px</li>
                    <li><strong>title</strong> - <?php printf( __( 'comments box title with a CSS class of %1$s and align of %2$s', 'ultimate-facebook-comments' ), '<strong>title_class</strong>', '<strong>title_align</strong>' ); ?></li>
                    <li><strong>num_comments</strong> - <?php _e( 'number of comments', 'ultimate-facebook-comments' ); ?></li>
                    <li><strong>order_by</strong> - <?php _e( 'comment sorting:', 'ultimate-facebook-comments' ); ?> <strong>social/time/reverse_time</strong></li>
                    <li><strong>id</strong> - <?php printf( __( 'comments div id with a CSS class of %1$s and backgound color of %2$s', 'ultimate-facebook-comments' ), '<strong>class</strong>', '<strong>color</strong>' ); ?></li>
                    <li><strong>color_scheme</strong> - <?php _e( 'colour scheme:', 'ultimate-facebook-comments' ); ?> <strong>light/dark</strong></li>
                    <li><strong>tag</strong> - <?php _e( 'html tag:', 'ultimate-facebook-comments' ); ?> <strong>h1/h2/h3/h4/h5/h6/span/div</strong></li>
                    <li><strong>button_class</strong> - <?php _e( 'button CSS class for On Click method, defaults to:', 'ultimate-facebook-comments' ); ?> <strong>btn button</strong></li>
                    <li><strong>button_text</strong> - <?php _e( 'button text for On Click method, defaults to:', 'ultimate-facebook-comments' ); ?> <strong>Leave a Reply</strong></li>
                    <li><strong>loading</strong> - <?php _e( 'comments loading method:', 'ultimate-facebook-comments' ); ?> <strong>default/on_scroll/on_click</strong></li>
                    <li><strong>credit</strong> - <?php printf( __( 'enter %s to link to the plugin page', 'ultimate-facebook-comments' ), '"1"' ); ?></li>
                    <li><strong>consent</strong> - <?php printf( __( 'enter %s to show user agreement notice', 'ultimate-facebook-comments' ), '"1"' ); ?></li>
                </div>
                <div style="display:none;" id="show-help">
                    <h3><?php _e( 'Do you need help with this plugin? Here are some FAQ for you:', 'ultimate-facebook-comments' ); ?></h3><p><hr></p>
                    <p><li><strong><?php _e( 'How to create Facebook APP ID?', 'ultimate-facebook-comments' ); ?></strong></li></p>
                    <p><?php printf( __( 'Create your App ID from %1$shere%2$s. Then to set up, choose your App and click %3$s. Ensure you enter your website URL in both %4$s and %5$s and fill up all required details. Next just turn on %6$s. Now configure plugin settings with APP ID and Secret and other valid informations.', 'ultimate-facebook-comments' ), '<a href="https://developers.facebook.com/apps" target="_blank">', '</a>', '<strong>"Settings > Basic"</strong>', '<strong>"App Domains"</strong>', '<strong>"Add Platforms > Website > Site URL"</strong>', 'App Review' ); ?></p>
                    <p><li><strong><?php _e( 'How to moderate Facebook Comments?', 'ultimate-facebook-comments' ); ?></strong></li></p>
                    <p><?php printf( __( 'You must be logged into your Facebook account to access Facebook Comments Moderation Tool. You can access Facebook Comments Moderation Tool from admin bar. By default, all admins to the App ID can moderate comments. To add any person as moderators, open %1$s and go to %2$s and add any person as moderator.', 'ultimate-facebook-comments' ), '<strong>Moderation Tool</strong>', '<strong>Settings > Moderators</strong>' ); ?></p>
                    <p><li><strong><?php _e( 'How to show Facebook comment count on frontend posts meta?', 'ultimate-facebook-comments' ); ?></strong></li></p>
                    <p><?php _e( 'In this case, you have to edit your theme’s template files i.e. single.php, page.php etc. And add/replace default published date function with this:', 'ultimate-facebook-comments' ); ?> &nbsp;&nbsp;
                    <p><i><?php _e( 'Displays/echos the facebook comments count:', 'ultimate-facebook-comments' ); ?></i> <code>&lt;?php if ( function_exists( 'fb_comment_count' ) ) {
                                fb_comment_count();
            	           } ?&gt;</code></p>       
                    <p><i><?php _e( 'Returns the facebook comments count:', 'ultimate-facebook-comments' ); ?></i> <code>&lt;?php if ( function_exists( 'get_fb_comment_count' ) ) {
                                get_fb_comment_count();
            	    } ?&gt;</code></p>
                    </p></p>
                    
                    <br>
                    
                    <h3><?php _e( 'My Other WordPress Plugins', 'ultimate-facebook-comments' ); ?></h3><p><hr></p>
                    <p><strong><?php _e( 'Like this plugin? Check out my other WordPress plugins:', 'ultimate-facebook-comments' ); ?></strong></p>
                    <li><strong><a href = "https://wordpress.org/plugins/wp-last-modified-info/" target = "_blank">WP Last Modified Info</a></strong> - <?php _e( 'Display last update date and time on pages and posts very easily with \'dateModified\' Schema Markup.', 'ultimate-facebook-comments' ); ?></li>
                    <li><strong><a href = "https://wordpress.org/plugins/wp-auto-republish/" target = "_blank">WP Auto Republish</a></strong> - <?php _e( 'Automatically republish you old evergreen content to grab better SEO.', 'ultimate-facebook-comments' ); ?></li>
                    <li><strong><a href = "https://wordpress.org/plugins/change-wp-page-permalinks/" target = "_blank">WP Page Permalink Extension</a></strong> - <?php _e( 'Add any page extension like .html, .php, .aspx, .htm, .asp, .shtml only to wordpress pages very easily (tested on Yoast SEO).', 'ultimate-facebook-comments' ); ?></li>
                    <li><strong><a href = "https://wordpress.org/plugins/simple-posts-ticker/" target = "_blank">Simple Posts Ticker</a></strong> - <?php _e( 'Simple Posts Ticker is a small tool that shows your most recent posts in a marquee style.', 'ultimate-facebook-comments' ); ?></li>
                    <li><strong><a href = "https://wordpress.org/plugins/fb-account-kit-login/" target = "_blank">Facebook Account Kit Login</a></strong> - <?php _e( 'This plugin helps to easily login or register to wordpress by using SMS or Email Verification without any password.', 'ultimate-facebook-comments' ); ?></li>
                    <li><strong><a href = "https://wordpress.org/plugins/remove-wp-meta-tags/" target = "_blank">Easy Header Footer</a></strong> - <?php _e( 'Customize WP header, add custom code and enable, disable or remove the unwanted meta tags, links from the source code and many more.', 'ultimate-facebook-comments' ); ?></li>
                    <br>
                </div>
            </form>
            <div style="display:none" id="show-tools">
                <h3><?php _e( 'Plugin Tools', 'ultimate-facebook-comments' ); ?> </h3><p><hr></p>
                    <span><strong><?php _e( 'Export Settings', 'ultimate-facebook-comments' ); ?></strong></span>
					<p><?php _e( 'Export the plugin settings for this site as a .json file. This allows you to easily import the configuration into another site.', 'ultimate-facebook-comments' ); ?></p>
					<form method="post">
						<p><input type="hidden" name="ufc_export_action" value="ufc_export_settings" /></p>
						<p>
							<?php wp_nonce_field( 'ufc_export_nonce', 'ufc_export_nonce' ); ?>
							<?php submit_button( __( 'Export Settings', 'ultimate-facebook-comments' ), 'secondary', 'submit-export', false ); ?>
						</p>
					</form>
                <p><hr></p>
                    <span><strong><?php _e( 'Import Settings', 'ultimate-facebook-comments' ); ?></strong></span>
					<p><?php _e( 'Import the plugin settings from a .json file. This file can be obtained by exporting the settings on another site using the form above.', 'ultimate-facebook-comments' ); ?></p>
					<form method="post" enctype="multipart/form-data">
						<p><input type="file" name="import_file" accept=".json"/></p>
						<p>
							<input type="hidden" name="ufc_import_action" value="ufc_import_settings" />
							<?php wp_nonce_field( 'ufc_import_nonce', 'ufc_import_nonce' ); ?>
							<?php submit_button( __( 'Import Settings', 'ultimate-facebook-comments' ), 'secondary', 'submit-import', false ); ?>
						</p>
					</form>
                <p><hr></p>
                    <span><strong><?php _e( 'Reset Settings', 'ultimate-facebook-comments' ); ?></strong></span>
					<p style="color:red"><strong><?php _e( 'WARNING:', 'ultimate-facebook-comments' ); ?> </strong><?php _e( 'Resetting will delete all custom options to the default settings of the plugin in your database.', 'ultimate-facebook-comments' ); ?></p>
					<form method="post">
						<p><input type="hidden" name="ufc_reset_action" value="ufc_reset_settings" /></p>
	                    <p>
							<?php wp_nonce_field( 'ufc_reset_nonce', 'ufc_reset_nonce' ); ?>
							<?php submit_button( __( 'Reset Settings', 'ultimate-facebook-comments' ), 'secondary', 'submit-reset', false ); ?>
					    </p>
					</form>
                <br>
            </div>
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    $('#form-container').submit(function() {
                        $('#progressMessage').show();
                        $('#appid-notice').fadeOut();
                        $(".save-settings").addClass("disabled");
                        $(".save-settings").val("<?php _e( 'Saving...', 'ultimate-facebook-comments' ); ?>");
                        $(this).ajaxSubmit({
                            success: function() {
                                $('#progressMessage').fadeOut();
                                $('#saveMessage').show().delay(4000).fadeOut();
                                $(".save-settings").removeClass("disabled");
                                $(".save-settings").val("<?php _e( 'Save Settings', 'ultimate-facebook-comments' ); ?>");
                            }
                        });
                        return false;
                    });
                });
            </script>
        </div>
    </div>
    <div class="coffee-box">
        <div class="coffee-amt-wrap">
            <p><select class="coffee-amt">
                <option value="5usd">$5</option>
                <option value="6usd">$6</option>
                <option value="7usd">$7</option>
                <option value="8usd">$8</option>
                <option value="9usd">$9</option>
                <option value="10usd" selected="selected">$10</option>
                <option value="11usd">$11</option>
                <option value="12usd">$12</option>
                <option value="13usd">$13</option>
                <option value="14usd">$14</option>
                <option value="15usd">$15</option>
                <option value=""><?php _e( 'Custom', 'ultimate-facebook-comments' ); ?></option>
            </select></p>
            <a class="button button-primary buy-coffee-btn" style="margin-left: 2px;" href="https://www.paypal.me/iamsayan/10usd" data-link="https://www.paypal.me/iamsayan/" target="_blank"><?php _e( 'Buy me a coffee!', 'ultimate-facebook-comments' ); ?></a>
        </div>
        <span class="coffee-heading"><?php _e( 'Buy me a coffee!', 'ultimate-facebook-comments' ); ?></span>
        <p style="text-align: justify;"><?php printf( __( 'Thank you for using %s. If you found the plugin useful buy me a coffee! Your donation will motivate and make me happy for all the efforts. You can donate via PayPal.', 'ultimate-facebook-comments' ), '<strong>Ultimate Facebook Comments v' . UFC_PLUGIN_VERSION . '</strong>' ); ?></strong></p>
        <p style="text-align: justify; font-size: 12px; font-style: italic;">Developed with <span style="color:#e25555;">♥</span> by <a href="https://sayandatta.com" target="_blank" style="font-weight: 500;">Sayan Datta</a> | <a href="https://github.com/iamsayan/ultimate-facebook-comments" target="_blank" style="font-weight: 500;">GitHub</a> | <a href="https://wordpress.org/support/plugin/ultimate-facebook-comments" target="_blank" style="font-weight: 500;">Support</a> | <a href="https://wordpress.org/support/plugin/ultimate-facebook-comments/reviews/?rate=5#new-post" target="_blank" style="font-weight: 500;">Rate it</a> (<span style="color:#ffa000;">&#9733;&#9733;&#9733;&#9733;&#9733;</span>) on WordPress.org, if you like this plugin.</p>
    </div>
</div>