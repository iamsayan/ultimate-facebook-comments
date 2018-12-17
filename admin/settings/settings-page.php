<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Ultimate WordPress Comments
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */
?>

<div class="wrap">
    <h1><?php _e( 'Ultimate Facebook Comments', 'ultimate-facebook-comments' ); ?> <span style="font-size:12px;"><?php _e( 'Ver', 'ultimate-facebook-comments' ); ?> <?php echo UFC_PLUGIN_VERSION; ?></span></h1>
    <div><?php _e( 'The Ultimate Facebook Comments Plugin for WordPress.', 'ultimate-facebook-comments' ); ?></div><hr>
    <div id="nav-container" class="nav-tab-wrapper">
        <a href="#main" class="nav-tab active" id="btn1"><span class="dashicons dashicons-admin-post" style="padding-top: 2px;"></span> <?php _e( 'Main', 'ultimate-facebook-comments' ); ?></a>
        <a href="#settings" class="nav-tab" id="btn2"><span class="dashicons dashicons-admin-generic" style="padding-top: 2px;"></span> <?php _e( 'Settings', 'ultimate-facebook-comments' ); ?></a>
        <a href="#display" class="nav-tab" id="btn3"><span class="dashicons dashicons-visibility" style="padding-top: 2px;"></span> <?php _e( 'Display', 'ultimate-facebook-comments' ); ?></a>
        <a href="#title" class="nav-tab" id="btn4"><span class="dashicons dashicons-welcome-write-blog" style="padding-top: 2px;"></span> <?php _e( 'Title', 'ultimate-facebook-comments' ); ?></a>
        <a href="#notice" class="nav-tab" id="btn5"><span class="dashicons dashicons-media-text" style="padding-top: 2px;"></span> <?php _e( 'GDPR', 'ultimate-facebook-comments' ); ?></a>
        <a href="#notification" class="nav-tab" id="btn6"><span class="dashicons dashicons-email" style="padding-top: 2px;"></span> <?php _e( 'Notification', 'ultimate-facebook-comments' ); ?></a>
        <a href="#others" class="nav-tab" id="btn7"><span class="dashicons dashicons-screenoptions" style="padding-top: 2px;"></span> <?php _e( 'Others', 'ultimate-facebook-comments' ); ?></a>
        <a href="#shortcode" class="nav-tab" id="btn8"><span class="dashicons dashicons-editor-code" style="padding-top: 2px;"></span> <?php _e( 'Shortcode', 'ultimate-facebook-comments' ); ?></a>
        <a href="#tools" class="nav-tab" id="btn9"><span class="dashicons dashicons-editor-help" style="padding-top: 2px;"></span> <?php _e( 'Tools', 'ultimate-facebook-comments' ); ?></a>
        <a href="#help" class="nav-tab" id="btn10"><span class="dashicons dashicons-editor-help" style="padding-top: 2px;"></span> <?php _e( 'Help', 'ultimate-facebook-comments' ); ?></a>
        <button class="nav-tab donate" style="cursor: pointer;" onclick="window.open('http://bit.ly/2I0Gj60', '_blank'); return false;"><span class="dashicons dashicons-smiley" style="padding-top: 2px;"></span> <?php _e( 'Donate this plugin', 'ultimate-facebook-comments' ); ?></button>
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
                <?php if ( function_exists('wp_nonce_field') ) { wp_nonce_field('ultimate-facebook-comments'); } ?>
                <?php settings_fields('ufc_show_plugin_section'); ?>
                <div id="show-main"> 
                    <?php do_settings_sections('ufc_plugin_main_section'); ?>
                    <?php submit_button( __( 'Save Settings', 'ultimate-facebook-comments' ), 'primary save-settings' ); ?>
                </div>
                <div style="display:none" id="show-settings">
                    <?php do_settings_sections('ufc_plugin_settings_section'); ?>
                    <?php submit_button( __( 'Save Settings', 'ultimate-facebook-comments' ), 'primary save-settings' ); ?>
                </div>
                <div style="display:none" id="show-display">
                    <?php do_settings_sections('ufc_plugin_display_section'); ?>
                    <?php submit_button( __( 'Save Settings', 'ultimate-facebook-comments' ), 'primary save-settings' ); ?>
                </div>
                <div style="display:none" id="show-title">
                    <?php do_settings_sections('ufc_plugin_title_section'); ?>
                    <?php submit_button( __( 'Save Settings', 'ultimate-facebook-comments' ), 'primary save-settings' ); ?>
                </div>
                <div style="display:none" id="show-notice">
                    <?php do_settings_sections('ufc_plugin_gdpr_section'); ?>
                    <?php submit_button( __( 'Save Settings', 'ultimate-facebook-comments' ), 'primary save-settings' ); ?>
                </div>    
                <div style="display:none" id="show-notification">
                    <?php do_settings_sections('ufc_plugin_notification_section'); ?>
                    <?php submit_button( __( 'Save Settings', 'ultimate-facebook-comments' ), 'primary save-settings' ); ?>
                </div>
                <div style="display:none" id="show-others">
                    <?php do_settings_sections('ufc_plugin_other_section'); ?>
                    <?php submit_button( __( 'Save Settings', 'ultimate-facebook-comments' ), 'primary save-settings' ); ?>
                </div>
                <div id="progressMessage" class="progressModal" style="display:none;"><?php _e( 'Please wait...', 'ultimate-facebook-comments' ); ?></div>
                <div id="saveMessage" class="successModal" style="display:none;"><p><?php _e( 'Settings Saved Successfully!', 'ultimate-facebook-comments' ); ?></p></div>
                <div style="display:none" id="show-shortcode">
                    <h3> Shortcode </h3><p><hr></p>
                    <p>You can insert the comment box manually in any page or post or template by simply using the shortcode <code>[ufc-fb-comments]</code>. To enter the shortcode directly into templates using PHP, enter <code>echo do_shortcode( '[ufc-fb-comments]' );</code></p>
                    <p>You can also use the options/attributes below to override the the settings above.</p>
                    <li><strong>url</strong> - set custom URL</li>
                    <li><strong>width</strong> -  minimum must be <strong>320</strong>px</li>
                    <li><strong>title</strong> - comments box title with a CSS class of <strong>title_class</strong> and align of <strong>title_align</strong></li>
                    <li><strong>num_comments</strong> - number of comments</li>
                    <li><strong>order_by</strong> - comment sorting: <strong>social/time/reverse_time</strong></li>
                    <li><strong>id</strong> - comments div id with a CSS class of <strong>class</strong> and backgound color of <strong>color</strong></li>
                    <li><strong>color_scheme</strong> - colour scheme: <strong>light/dark</strong></li>
                    <li><strong>tag</strong> - html tag: <strong>h1/h2/h3/h4/h5/h6/span/div</strong></li>
                    <li><strong>credit</strong> - enter "1" to link to the plugin page</li>
                    <li><strong>consent</strong> - enter "1" to show user agreement notice</li>
                    <p>Here's an example of using the shortcode:<br><code>[ufc-fb-comments url="https://developers.facebook.com/docs/plugins/comments/" title="Leave a Reply" title_align="left" title_class="fbc-title" id="fbc-div" class="fbc-class" color="#5d5d5d" width="500" num_comments="5" color_scheme="dark" order_by="time" tag="span" consent="1" credit="1"]</code></p>
                    <p>You can also insert the shortcode directly into your theme with PHP:<br><code>&lt;?php echo do_shortcode('[ufc-fb-comments url="https://developers.facebook.com/docs/plugins/comments/" title="Leave a Reply" title_align="left" title_class="fbc-title" id="fbc-div" class="fbc-class" color="#5d5d5d" width="500" num_comments="5" color_scheme="dark" order_by="time" tag="span" consent="1" credit="1"]'); ?&gt;</code></p><br>
                </div>
                <div style="display:none;" id="show-help">
                    <h3> Do you need help with this plugin? Here are some FAQ for you: </h3><p><hr></p>
                    <p><li><strong>How to create Facebook APP ID?</strong></li></p>
                    <p>Create your App ID from <a href="https://developers.facebook.com/apps" target="_blank">here</a>. Then to set up, choose your App and click <strong>"Settings > Basic"</strong>. Ensure you enter your website URL in both <strong>"App Domains"</strong> and <strong>"Add Platforms > Website > Site URL"</strong> URL and fill up all required details. Next just turn on app <a href="https://developers.facebook.com/apps/<?php echo $options['ufc_facebook_comments_app_id']; ?>/review-status/" target="_blank">review</a>. Now configure plugin settings with APP ID and other valid informations.</p>
                    
                    <p><li><strong>How to moderate Facebook Comments?</strong></li></p>
                    <p>You must be logged into your Facebook account to access Facebook Comments Moderation Tool. You can access Facebook Comments Moderation Tool from admin bar. By default, all admins to the App ID can moderate comments. To add any person as moderators, open <strong>Moderation Tool</strong> and go to <strong>Settings > Moderators</strong> and add any person as moderator.</p>
                    
                    <p><li><strong>How to show Facebook comment count on frontend posts meta?</strong></li></p>
                    <p>In this case, you have to edit your theme’s template files i.e. single.php, page.php etc. And add/replace default published date function with this: &nbsp;&nbsp;
                    <p><i>Displays/echos the last modified info:</i> <code>&lt;?php if ( function_exists( 'fb_comment_count' ) ) {
                                fb_comment_count();
            	           } ?&gt;</code></p>       
                    <p><i>Returns the last modified info:</i> <code>&lt;?php if ( function_exists( 'get_fb_comment_count' ) ) {
                                get_fb_comment_count();
            	    } ?&gt;</code></p>
                    </p></p>

                    <p><li><strong>As I am using other facebook plugins, the Facebook SDK is already loaded by that plugin but Facebook Comments are not showing. What is the solution?</strong></li></p>
                    <p>Add this snippets in your functions.php file: <code>add_filter( 'ufc_facebook_sdk_reinit_method', '__return_true' );</code> and this will definitely work.</p>
                    
                    <br>
                    
                    <h3> My Other WordPress Plugins </h3><p><hr></p>
                    <p><strong>Like this plugin? Check out my other WordPress plugins:</strong></p>
                    <li><strong><a href = "https://wordpress.org/plugins/ultimate-facebook-comments/" target = "_blank">WP Last Modified Info</a></strong> - Display last update date and time on pages and posts very easily with 'dateModified' Schema Markup.</li>
                    <li><strong><a href = "https://wordpress.org/plugins/change-wp-page-permalinks/" target = "_blank">WP Page Permalink Extension</a></strong> - Add any page extension like .html, .php, .aspx, .htm, .asp, .shtml only to wordpress pages very easily (tested on Yoast SEO).</li>
                    <li><strong><a href = "https://wordpress.org/plugins/remove-wp-meta-tags/" target = "_blank">Easy Header Footer</a></strong> - Customize WP header, add custom code and enable, disable or remove the unwanted meta tags, links from the source code and many more.</li>
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
							<?php submit_button( __( 'Export Settings', 'ultimate-facebook-comments' ), 'secondary', 'submit', false ); ?>
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
							<?php submit_button( __( 'Import Settings', 'ultimate-facebook-comments' ), 'secondary', 'submit', false ); ?>
						</p>
					</form>
                <p><hr></p>
                    <span><strong><?php _e( 'Reset Settings', 'ultimate-facebook-comments' ); ?></strong></span>
					<p style="color:red"><strong>WARNING: </strong><?php _e( 'Resetting will delete all custom options to the default settings of the plugin in your database.', 'ultimate-facebook-comments' ); ?></p>
					<form method="post">
						<p><input type="hidden" name="ufc_reset_action" value="ufc_reset_settings" /></p>
	                    <p>
							<?php wp_nonce_field( 'ufc_reset_nonce', 'ufc_reset_nonce' ); ?>
							<?php submit_button( __( 'Reset Settings', 'ultimate-facebook-comments' ), 'secondary', 'submit', false ); ?>
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
</div> 