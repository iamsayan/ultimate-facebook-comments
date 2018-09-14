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
    <h1><?php _e( 'Ultimate Facebook Comments', 'ultimate-facebook-comments' ); ?> <span style="font-size:12px;"><?php _e( 'Ver', 'ultimate-facebook-comments' ); ?> <?php echo ufc_load_plugin_version(); ?></span></h1>
    <div><?php _e( 'The Ultimate Facebook Comments Plugin for WordPress.', 'ultimate-facebook-comments' ); ?></div><hr>
    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
			    <div class="postbox">
				    <h3 class="hndle" style="cursor:default;">
                        <span class="ufc-heading">
                            <?php _e( 'Facebook Comments Settings', 'ultimate-facebook-comments' ); ?>
                        </span>
                    </h3>
				    <div class="inside">
                        <form id="main-form" method="post" action="options.php">
                            <?php if ( function_exists('wp_nonce_field') ) { wp_nonce_field('ultimate-facebook-comments'); } ?>
                            <?php settings_fields('ufc_show_plugin_section'); ?>
                            <?php do_settings_sections('ufc_plugin_global_section'); ?>
                            <p><?php submit_button( __( 'Save Settings', 'ultimate-facebook-comments' ), 'primary save-settings', '', false ); ?>&nbsp;&nbsp;<span class="spinner is-active" style="float: none;margin: -2px 5px 0; display:none;"></span></p>
                        </form>
                        <script>
                            jQuery(document).ready(function ($) {
                                $('.save-settings').click(function () {
                                    $(".save-settings").addClass("disabled");
                                    $(".spinner").show();
                                    $(".save-settings").val("<?php _e( 'Saving...', 'ultimate-facebook-comments' ); ?>");
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
            <div id="postbox-container-1" class="postbox-container">
                <div class="postbox">
                    <h3 class="hndle"><span class="dashicons dashicons-info"></span> <?php _e( 'Plugin Information', 'ultimate-facebook-comments' ); ?></h3>
                    <div class="inside">
                        <div class="misc-pub-section">
                            <span>Name : <strong>Ultimate Facebook Comments</strong></span>
                        </div>
                        <div class="misc-pub-section">
                            <span>Version : <?php echo ufc_load_plugin_version(); ?></span>
                        </div>
                        <div class="misc-pub-section">
                            <span>Author : <a href="https://profiles.wordpress.org/infosatech/" target="_blank">Sayan Datta</a></span>
                        </div>
                    </div>
                </div>
                <div class="postbox">
                    <h3 class="hndle"><span class="dashicons dashicons-edit"></span> <?php _e( 'User Manual', 'ultimate-facebook-comments' ); ?></h3>
                    <div class="inside">
                        <div class="misc-pub-section">
                            <span><?php _e( 'Here\'s the short user manual for you.', 'ultimate-facebook-comments' ); ?></span>
                            <br><br><span><strong>App ID</strong> - Create your App Id <a href="https://developers.facebook.com/apps" target="_blank">here</a>, fill up all required details in <strong>Settings > Basic Settings</strong> and turn on app <a href="https://developers.facebook.com/apps/<?php echo $options['ufc_facebook_comments_app_id']; ?>/review-status/" target="_blank">review</a>.</span>
                            <br><br><span>Now configure plugin settings according to your need with valid information.</span>
                        </div>
                    </div>
                </div>
                <div class="postbox">
                    <h3 class="hndle"><span class="dashicons dashicons-admin-users"></span> <?php _e( 'Comments Moderation', 'ultimate-facebook-comments' ); ?></h3>
                    <div class="inside">
                        <div class="misc-pub-section">
                            <span><strong>Note:</strong> You must be logged into your Facebook account to access Facebook Comments Moderation Tool.</span>
                            <br><br><span>By default, all admins to the App ID can moderate comments. To add any person as moderators, open <strong>Moderation Tool</strong> and go to <strong>Settings > Moderators</strong> and add any person as moderator.</span>
                        </div>
                    </div>
                </div>
                <div class="postbox">
                    <h3 class="hndle"><span class="dashicons dashicons-editor-code"></span> <?php _e( 'How to use Shortcode?', 'ultimate-facebook-comments' ); ?></h3>
                    <div class="inside">
                        <div class="misc-pub-section">
                            <span><strong>Shortcode : </strong><code>[ufc-fb-comments]</code></span>
                        </div>
                        <div class="misc-pub-section">
                             <span><strong>Instructions :</strong> You can insert the Facebook Comments box manually to any post or page using shortcode.</span>
                             <br><br><span>You can disable Facebook comments for individual posts / pages from meta box of post edit screen or from quick edit.</span>
                        </div>
                    </div>
                </div>
                <div class="postbox">
                    <h3 class="hndle"><span class="dashicons dashicons-tag"></span> <?php _e( 'Template Tags', 'ultimate-facebook-comments' ); ?></h3>
                    <div class="inside">
                        <div class="misc-pub-section">
                            <span>You can display Facebook Comments count theme's template files by using the template tags:</span>
                            <br><br><span><a href="https://wordpress.org/plugins/ultimate-facebook-comments/#how%20to%20show%20fb%20comment%20count%20on%20frontend%20posts%20meta%3F" target="_blank">Read the FAQ</a></span>
                            <br><br><span><strong>Note:</strong> Use Facebook Comment Count feature on live/production site only.</span>
                        </div>
                    </div>
                </div>
                <div class="postbox">
                    <h3 class="hndle"><span class="dashicons dashicons-smiley"></span> <?php _e( 'Like the plugin?', 'ultimate-facebook-comments' ); ?></h3>
                    <div class="inside">
                        <div class="misc-pub-section">
                            <span class="dashicons dashicons-star-filled"></span> <label><strong><a href="https://wordpress.org/support/plugin/ultimate-facebook-comments/reviews/?filter=5#postform" target="_blank" title="Rate now">Rate this on WordPress</a></strong>
                        </div>
                        <div class="misc-pub-section">
                             <label><span class="dashicons dashicons-heart"></span> <strong><a href="http://bit.ly/2I0Gj60" target="_blank" title="Donate now">Make a small donation</a></strong>
                        </div>
                        <div class="misc-pub-section">
                            <label><span class="dashicons dashicons-twitter"></span> <strong><a href="https://twitter.com/home?status=I%20am%20using%20Ultimate%20Facebook%20Comments%20WordPress%20Plugin%20by%20%40im_sayaan%20for%20commenting%20on%20my%20%40WordPress%20Website%20-%20It%20is%20awesome%21%20>%20https%3A%2F%2Fwordpress.org%2Fplugins%2Fultimate-facebook-comments%2F" target="_blank" title="Tweet now">Tweet about the Plugin</a></strong>
                        </div>
                    </div>
                </div>
                <div class="postbox">
                    <h3 class="hndle"><span class="dashicons dashicons-admin-plugins"></span> <?php _e( 'My Other Plugins!', 'ultimate-facebook-comments' ); ?></h3>
                    <div class="inside">
                        <div class="misc-pub-section">
                            <span class="dashicons dashicons-clock"></span> <label><strong><a href="https://wordpress.org/plugins/wp-last-modified-info/" target="_blank">WP Last Modified Info</a>: </strong>Display last update date and time on pages and posts very easily.
                        </div><hr>
                        <div class="misc-pub-section">
                            <span class="dashicons dashicons-admin-links"></span> <label><strong><a href="https://wordpress.org/plugins/change-wp-page-permalinks/" target="_blank">WP Page Permalink Extension</a>: </strong>Assign any extension to wordpress pages easily.
                        </div><hr>
                        <div class="misc-pub-section">
                            <span class="dashicons dashicons-admin-generic"></span> <label><strong><a href="https://wordpress.org/plugins/remove-wp-meta-tags/" target="_blank">Ultimate WP Header Footer</a>: </strong>Customize WordPress header easily with this plugin.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>