<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Ultimate Facebook Comments
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

add_action( 'admin_notices', 'ufc_new_plugin_install_notice' );
add_action( 'admin_init', 'ufc_dismiss_fbak_notice' );

function ufc_new_plugin_install_notice() { 
    $options = get_option('ufc_plugin_global_options');

    /* Check transient, if available display notice */
    if( get_transient( 'ufc-admin-notice-on-activation' ) && empty( $options['ufc_facebook_comments_app_id'] ) ) { ?>
        <div class="notice notice-success is-dismissible">
            <p><strong><?php printf( __( 'Thanks for installing %1$s v%2$s plugin. Click <a href="%3$s">here</a> to configure plugin settings.', 'ultimate-facebook-comments' ), 'Ultimate Facebook Comments', UFC_PLUGIN_VERSION, admin_url( 'admin.php?page=ultimate-facebook-comments' ) ); ?></strong></p>
        </div> <?php
        /* Delete transient, only display this notice once. */
        delete_transient( 'ufc-admin-notice-on-activation' );
    }

    if( empty( $options['ufc_facebook_comments_app_id'] ) && empty( $options['ufc_facebook_comments_app_secret'] ) ) { ?>
        <div id="appid-notice" class="notice notice-error">
            <p><?php _e( 'Please create and enter your Facebook App ID for Ultimate Facebook Comments Plugin to work properly. If you have already created an app, then put <strong>APP ID</strong> and <strong>APP Secret</strong> in plugin settings.', 'ultimate-facebook-comments' ); ?></p>
            <p><a href="https://developers.facebook.com/apps" target="_blank" class="button button-secondary"><?php _e( 'Go to Facebook for Developers Page to get App ID', 'ultimate-facebook-comments' ); ?></a></p>
        </div><?php
    } elseif( !empty( $options['ufc_facebook_comments_app_id'] ) && empty( $options['ufc_facebook_comments_app_secret'] ) ) { ?>
        <div id="appid-notice" class="notice notice-error">
            <p><?php _e( 'Please enter your Facebook App Secret for Ultimate Facebook Comments Plugin to work properly. Go to Facebook for Developers and copy App Secret and paste it to plugin settings.', 'ultimate-facebook-comments' ); ?></p>
            <p><a href="https://developers.facebook.com/apps/<?php echo $options['ufc_facebook_comments_app_id']; ?>/settings/basic/" target="_blank" class="button button-secondary"><?php _e( 'View App Secret', 'ultimate-facebook-comments' ); ?></a></p>
        </div><?php
    }

    // Show notice to unlinked users
    if( '1' !== get_option( 'ufc_plugin_fbak_dismiss' ) ) {
        $dismiss = wp_nonce_url( add_query_arg( 'fbak_ufc_suggust', 'dismiss_true' ), 'ufc_fbak_suggust_ref' ); ?>
        <div class="notice notice-success">
            <p style="text-align: justify;"><strong><?php _e( 'Introducing the New Facebook Account Kit Login plugin which brings a lightweight, secure, flexible, free and easy way to configure Facebook\'s Secure and easy Passwordless Login to your WordPress website. You can login by using a OTP on your Phone Number or WhatsApp or Email Verification without any password. Try this plugin now!', 'ultimate-facebook-comments' ); ?></strong></p>
            <p><a href="<?php echo admin_url( 'plugin-install.php?s=Facebook+Account+Kit+Login+Sayan&tab=search&type=term' ); ?>" target="_blank" class="button button-secondary"><?php _e( 'Install this plugin', 'ultimate-facebook-comments' ); ?></a>&nbsp;
            <a href="<?php echo $dismiss; ?>" class="dismiss"><strong><?php _e( 'I have already tried it', 'ultimate-facebook-comments' ); ?></strong></a>&nbsp;<strong>|</strong>
            <a href="<?php echo $dismiss; ?>" class="dismiss"><strong><?php _e( 'No, I don\'t want to try it', 'ultimate-facebook-comments' ); ?></strong></a><span style="float: right;font-size: 10px;margin-top: 10px;"><?php _e( 'Powered by', 'ultimate-facebook-comments' ); ?> Ultimate facebook Comments</span></p>
        </div> <?php
    }
}

function ufc_dismiss_fbak_notice() {
    if ( ! isset( $_GET['fbak_ufc_suggust'] ) ) {
        return;
    }

    if ( 'dismiss_true' === $_GET['fbak_ufc_suggust'] ) {
        check_admin_referer( 'ufc_fbak_suggust_ref' );
        update_option( 'ufc_plugin_fbak_dismiss', '1' );
    }

    wp_redirect( remove_query_arg( 'fbak_ufc_suggust' ) );
    exit;
}