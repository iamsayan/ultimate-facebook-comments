<?php
/**
 * Plugin Name: Ultimate Facebook Comments
 * Plugin URI: https://iamsayan.github.io/ultimate-facebook-comments/
 * Description: Ultimate Facebook Comments plugin will help you to display Facebook Comments box on your website easily. You can use Facebook Comments on your posts or pages.
 * Version: 1.4.1
 * Author: Sayan Datta
 * Author URI: https://sayandatta.com
 * License: GPLv3
 * Text Domain: ultimate-facebook-comments
 * Domain Path: /languages
 * 
 * Ultimate Facebook Comments is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * Ultimate Facebook Comments is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Ultimate Facebook Comments. If not, see <http://www.gnu.org/licenses/>.
 *
 * @category Public
 * @package  Ultimate Facebook Comments
 * @author   Sayan Datta
 * @license  http://www.gnu.org/licenses/ GNU General Public License
 * @link     https://iamsayan.github.io/ultimate-facebook-comments/
 */

//Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'UFC_PLUGIN_VERSION', '1.4.0' );

// debug scripts
//define ( 'UFC_PLUGIN_ENABLE_DEBUG', 'true' );

// Internationalization
add_action( 'plugins_loaded', 'ufc_plugin_load_textdomain' );
/**
 * Load plugin textdomain.
 * 
 * @since 1.1.0
 */
function ufc_plugin_load_textdomain() {
    load_plugin_textdomain( 'ultimate-facebook-comments', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
}

register_activation_hook( __FILE__, 'ufc_plugin_run_on_activation' );
register_deactivation_hook( __FILE__, 'ufc_plugin_run_on_deactivation' );

function ufc_plugin_run_on_activation() {

    if ( ! current_user_can( 'activate_plugins' ) ) {
        return;
    }
    set_transient( 'ufc-admin-notice-on-activation', true, 5 );
}

function ufc_plugin_run_on_deactivation() {

    if ( ! current_user_can( 'activate_plugins' ) ) {
        return;
    }

    delete_option( 'ufc_plugin_dismiss_rating_notice' );
    delete_option( 'ufc_plugin_no_thanks_rating_notice' );
    delete_option( 'ufc_plugin_installed_time' );
}

//add admin styles and scripts
function ufc_custom_admin_styles_scripts( $hook ) {

    $ver = UFC_PLUGIN_VERSION;
    if( defined( 'UFC_PLUGIN_ENABLE_DEBUG' ) ) {
        $ver = time();
    }

    $current_screen = get_current_screen();
    if ( strpos( $current_screen->base, 'ultimate-facebook-comments') !== false ) {
        wp_enqueue_style( 'ufc-admin-style', plugins_url( 'admin/assets/css/admin.min.css', __FILE__ ), array(), $ver );
        wp_enqueue_style( 'ufc-style', plugins_url( 'admin/assets/css/style.min.css', __FILE__ ), array(), $ver );      
        wp_enqueue_style( 'ufc-selectize-theme-css', plugins_url( 'admin/assets/css/selectize.css', __FILE__ ), array(), '0.12.6' );       
        
        wp_enqueue_script( 'ufc-script', plugins_url( 'admin/assets/js/admin.min.js', __FILE__ ), array( 'jquery', 'wp-color-picker' ), $ver, true );
        wp_enqueue_script( 'ufc-selectize-js', plugins_url( 'admin/assets/js/selectize.min.js', __FILE__ ), array(), '0.12.6' );
       
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
    }

    if ( $hook === 'edit.php' ) {
        wp_enqueue_style( 'ufc-edit', plugins_url( 'admin/assets/css/edit.min.css', __FILE__ ), array(), $ver );
        wp_enqueue_script( 'ufc-post-edit', plugins_url( 'admin/assets/js/edit.min.js', __FILE__ ), array( 'jquery' ), $ver, true );
    }
}

add_action( 'admin_enqueue_scripts', 'ufc_custom_admin_styles_scripts' );

function ufc_frontend_enqueue_scripts() {
    $options = get_option('ufc_plugin_global_options');

    if( ufc_check_is_amp_page() ) {
        return;
    }

    $ver = UFC_PLUGIN_VERSION;
    if( defined( 'UFC_PLUGIN_ENABLE_DEBUG' ) ) {
        $ver = time();
    }

    if( isset($options['ufc_fb_comment_consent_notice_cb']) && ($options['ufc_fb_comment_consent_notice_cb'] == 1) ) {
        wp_enqueue_script( 'ufc-cookie-js', plugin_dir_url( __FILE__ ) . 'public/js/jquery.cookie.min.js', array ( 'jquery' ), '1.4.1', true );
        wp_enqueue_style( 'ufc-consent', plugins_url( 'public/css/consent.min.css', __FILE__ ), array(), $ver );   
        wp_enqueue_script( 'ufc-consent-js', plugin_dir_url( __FILE__ ) . 'public/js/consent.min.js', array ( 'jquery' ), $ver, true );
    }
    /**
     * frontend ajax requests.
     */
    wp_enqueue_script( 'ufc-frontend-script', plugins_url( 'public/js/frontend.min.js', __FILE__ ), array( 'jquery' ), $ver, true );
    wp_localize_script( 'ufc-frontend-script', 'ufc_frontend_ajax_data',
        array( 
            'ajaxurl'   => admin_url( 'admin-ajax.php' ),
            'permalink' => get_permalink(),
            'title'     => get_the_title(),
            'postid'    => get_the_ID(),
            'security'  => wp_create_nonce( 'ufc_fbcomments' ),
            'version'   => UFC_PLUGIN_VERSION,
        )
    );
}

add_action( 'wp_enqueue_scripts', 'ufc_frontend_enqueue_scripts' );

function ufc_ajax_save_admin_scripts() {
    if ( is_admin() ) { 
        // Embed the Script on our Plugin's Option Page Only
        if ( isset($_GET['page']) && $_GET['page'] == 'ultimate-facebook-comments' ) {
            wp_enqueue_script('jquery');
            wp_enqueue_script( 'jquery-form' );
        }
    }
}

add_action( 'admin_init', 'ufc_ajax_save_admin_scripts' );

function ufc_plugin_all_notices() { 
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
            <p><a href="https://developers.facebook.com/apps" target="_blank" class="button button-secondary"><?php _e( 'Create New Facebook App ID', 'ultimate-facebook-comments' ); ?></a></p>
        </div><?php
    } elseif( !empty( $options['ufc_facebook_comments_app_id'] ) && empty( $options['ufc_facebook_comments_app_secret'] ) ) { ?>
        <div id="appid-notice" class="notice notice-error">
            <p><?php _e( 'Please enter your Facebook App Secret for Ultimate Facebook Comments Plugin to work properly. Go to Facebook for Developers and copy App Secret and paste it to plugin settings.', 'ultimate-facebook-comments' ); ?></p>
            <p><a href="https://developers.facebook.com/apps/<?php echo $options['ufc_facebook_comments_app_id']; ?>/settings/basic/" target="_blank" class="button button-secondary"><?php _e( 'View App Secret', 'ultimate-facebook-comments' ); ?></a></p>
        </div><?php
    }
}

add_action( 'admin_notices', 'ufc_plugin_all_notices' ); 

$options = get_option('ufc_plugin_global_options');

require_once plugin_dir_path( __FILE__ ) . 'admin/loader.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/notice.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/donate.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/ajax.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/post-meta.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/disable-native.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/admin-bar.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/dashboard-edit-screen.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/dashboard-column.php';

require_once plugin_dir_path( __FILE__ ) . 'public/comments-loader.php';
require_once plugin_dir_path( __FILE__ ) . 'public/shortcode.php';
require_once plugin_dir_path( __FILE__ ) . 'public/template-tags.php';

// add action links
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'ufc_add_action_links', 10, 2 );

function ufc_add_action_links ( $links ) {
    $ufclinks = array(
        '<a href="' . admin_url( 'admin.php?page=ultimate-facebook-comments' ) . '">' . __( 'Settings', 'ultimate-facebook-comments' ) . '</a>',
    );
    return array_merge( $ufclinks, $links );
}

function ufc_plugin_meta_links( $links, $file ) {
    $plugin = plugin_basename(__FILE__);
	if ( $file == $plugin ) // only for this plugin
		return array_merge( $links, 
            array( '<a href="https://wordpress.org/support/plugin/ultimate-facebook-comments" target="_blank">' . __( 'Support', 'ultimate-facebook-comments' ) . '</a>' ),
            array( '<a href="https://www.paypal.me/iamsayan" target="_blank">' . __( 'Donate', 'ultimate-facebook-comments' ) . '</a>' )
            
		);
	return $links;
}

add_filter( 'plugin_row_meta', 'ufc_plugin_meta_links', 10, 2 );