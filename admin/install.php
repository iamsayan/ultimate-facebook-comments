<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Ultimate Social Comments
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

add_action( 'admin_notices', 'ufc_new_plugin_install_notice' );

function ufc_new_plugin_install_notice() { 
    $options = get_option('ufc_plugin_global_options');

    /* Check transient, if available display notice */
    if( get_transient( 'ufc-admin-notice-on-activation' ) && empty( $options['ufc_facebook_comments_app_id'] ) ) { ?>
        <div class="notice notice-success is-dismissible">
            <p><strong><?php printf( __( 'Thanks for installing %1$s v%2$s plugin. Click <a href="%3$s">here</a> to configure plugin settings.', 'ultimate-facebook-comments' ), 'Ultimate Social Comments', UFC_PLUGIN_VERSION, admin_url( 'admin.php?page=ultimate-facebook-comments' ) ); ?></strong></p>
        </div> <?php
        /* Delete transient, only display this notice once. */
        delete_transient( 'ufc-admin-notice-on-activation' );
    }

    if( empty( $options['ufc_facebook_comments_app_id'] ) && empty( $options['ufc_facebook_comments_app_secret'] ) ) { ?>
        <div id="appid-notice" class="notice notice-error">
            <p><?php _e( 'Please create and enter your Facebook App ID for Ultimate Social Comments Plugin to work properly. If you have already created an app, then put <strong>APP ID</strong> and <strong>APP Secret</strong> in plugin settings.', 'ultimate-facebook-comments' ); ?></p>
            <p><a href="https://developers.facebook.com/apps" target="_blank" class="button button-secondary"><?php _e( 'Go to Facebook for Developers Page to get App ID', 'ultimate-facebook-comments' ); ?></a></p>
        </div><?php
    } elseif( !empty( $options['ufc_facebook_comments_app_id'] ) && empty( $options['ufc_facebook_comments_app_secret'] ) ) { ?>
        <div id="appid-notice" class="notice notice-error">
            <p><?php _e( 'Please enter your Facebook App Secret for Ultimate Social Comments Plugin to work properly. Go to Facebook for Developers and copy App Secret and paste it to plugin settings.', 'ultimate-facebook-comments' ); ?></p>
            <p><a href="https://developers.facebook.com/apps/<?php echo $options['ufc_facebook_comments_app_id']; ?>/settings/basic/" target="_blank" class="button button-secondary"><?php _e( 'View App Secret', 'ultimate-facebook-comments' ); ?></a></p>
        </div><?php
    }
}