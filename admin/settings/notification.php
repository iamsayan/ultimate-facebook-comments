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
    <h1><?php _e( 'Ultimate Facebook Comments - Email Notifications', 'ultimate-facebook-comments' ); ?> <span style="font-size:12px;"><?php _e( 'Ver', 'ultimate-facebook-comments' ); ?> <?php echo UFC_PLUGIN_VERSION; ?></span></h1>
    <div><?php _e( 'This is the Email Notification Module of the Ultimate Facebook Comments Plugin for WordPress.', 'ultimate-facebook-comments' ); ?></div><hr>
    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
			    <div class="postbox">
				    <h3 class="hndle" style="cursor:default;">
                        <span class="ufc-heading">
                            <span class="dashicons dashicons-admin-generic"></span> <?php _e( 'Email Notification Settings', 'ultimate-facebook-comments' ); ?>
                        </span>
                    </h3>
				    <div class="inside">
                        <form id="main-form" method="post" action="options.php">
                            <?php if ( function_exists('wp_nonce_field') ) { wp_nonce_field('ufc-notification'); } ?>
                            <?php settings_fields('ufc_show_plugin_noti_section'); ?>
                            <?php do_settings_sections('ufc_plugin_notification_section'); ?>
                            <?php submit_button( __( 'Save Settings', 'ultimate-facebook-comments' ), 'primary save-settings' ); ?>
                        </form>
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
                            <span>Version : <?php echo UFC_PLUGIN_VERSION; ?></span>
                        </div>
                        <div class="misc-pub-section">
                            <span>Author : <a href="https://profiles.wordpress.org/infosatech/" target="_blank">Sayan Datta</a></span>
                        </div>
                    </div>
                </div>
                <div class="postbox">
                    <h3 class="hndle"><span class="dashicons dashicons-smiley"></span> <?php _e( 'Like the plugin?', 'ultimate-facebook-comments' ); ?></h3>
                    <div class="inside">
                        <div class="misc-pub-section">
                            <span class="dashicons dashicons-star-filled"></span> <strong><a href="https://wordpress.org/support/plugin/ultimate-facebook-comments/reviews/?filter=5#new-post" target="_blank" title="Rate now">Rate this on WordPress</a></strong>
                        </div>
                        <div class="misc-pub-section">
                             <span class="dashicons dashicons-heart"></span> <strong><a href="http://bit.ly/2I0Gj60" target="_blank" title="Donate now">Make a small donation</a></strong>
                        </div>
                        <div class="misc-pub-section">
                            <span class="dashicons dashicons-twitter"></span> <strong><a href="https://twitter.com/home?status=I%20am%20using%20Ultimate%20Facebook%20Comments%20WordPress%20Plugin%20by%20%40im_sayaan%20for%20commenting%20on%20my%20%40WordPress%20Website%20-%20It%20is%20awesome%21%20>%20https%3A%2F%2Fwordpress.org%2Fplugins%2Fultimate-facebook-comments%2F" target="_blank" title="Tweet now">Tweet about the Plugin</a></strong>
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