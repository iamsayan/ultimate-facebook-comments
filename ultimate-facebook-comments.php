<?php
/**
 * Plugin Name: Ultimate Facebook Comments
 * Plugin URI: https://iamsayan.github.io/ultimate-facebook-comments/
 * Description: Ultimate Facebook Comments plugin will help you to display Facebook Comments box on your website easily. You can use Facebook Comments on your posts or pages.
 * Version: 1.3.1
 * Author: Sayan Datta
 * Author URI: https://profiles.wordpress.org/infosatech/
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

define( 'UFC_PLUGIN_VERSION', '1.3.1' );
define( 'UFC_PLUGIN_DIR', plugin_dir_path(__FILE__) );

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

//add admin styles and scripts
function ufc_custom_admin_styles_scripts( $hook ) {

    $current_screen = get_current_screen();
    if ( strpos( $current_screen->base, 'ultimate-facebook-comments') !== false || strpos( $current_screen->base, 'ufc-notifications') !== false ) {
        wp_enqueue_style( 'ufc-admin-style', plugins_url( 'admin/assets/css/admin.min.css', __FILE__ ), array(), UFC_PLUGIN_VERSION );
        wp_enqueue_style( 'ufc-cb-style', plugins_url( 'admin/assets/css/style.min.css', __FILE__ ), array(), UFC_PLUGIN_VERSION );
        wp_enqueue_style( 'ufc-select2', plugins_url( 'admin/assets/css/select2.min.css', __FILE__ ), array(), UFC_PLUGIN_VERSION );       
        
        wp_enqueue_script( 'ufc-script', plugins_url( 'admin/assets/js/admin.min.js', __FILE__ ), array( 'jquery', 'wp-color-picker' ), UFC_PLUGIN_VERSION, true );
        wp_enqueue_script( 'ufc-select2-js', plugins_url( 'admin/assets/js/select2.min.js', __FILE__ ), array(), UFC_PLUGIN_VERSION );
       
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
    }

    if ( $hook == 'edit.php' ) {
        wp_enqueue_style( 'ufc-edit', plugins_url( 'admin/assets/css/edit.min.css', __FILE__ ), array(), UFC_PLUGIN_VERSION );
        wp_enqueue_script( 'ufc-post-edit', plugins_url( 'admin/assets/js/edit.min.js', __FILE__ ), array( 'jquery' ), UFC_PLUGIN_VERSION, true );
    }
}

add_action( 'admin_enqueue_scripts', 'ufc_custom_admin_styles_scripts' );

function ufc_first_time_cookie_notice() {

    $options = get_option('ufc_plugin_global_options');
    if( isset($options['ufc_fb_comment_consent_notice_cb']) && ($options['ufc_fb_comment_consent_notice_cb'] == 1) ) {
        wp_enqueue_script( 'ufc-cookie-js', plugin_dir_url( __FILE__ ) . 'public/js/jquery.cookie.min.js', array ( 'jquery' ), '1.4.1', true );
        wp_enqueue_style( 'ufc-consent', plugins_url( 'public/css/consent.min.css', __FILE__ ), array(), UFC_PLUGIN_VERSION );   
        wp_enqueue_script( 'ufc-consent-js', plugin_dir_url( __FILE__ ) . 'public/js/consent.min.js', array ( 'jquery' ), UFC_PLUGIN_VERSION, true );
    }
}

add_action( 'wp_enqueue_scripts', 'ufc_first_time_cookie_notice' );

function ufc_frontend_enqueue_scripts() {
    /**
     * frontend ajax requests.
     */
    wp_enqueue_script( 'ufc-frontend-script', plugins_url( 'public/js/frontend.min.js', __FILE__ ), array( 'jquery' ), UFC_PLUGIN_VERSION, true );
    wp_localize_script( 'ufc-frontend-script', 'ufc_frontend_ajax_data',
        array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'permalink' => get_permalink(),
            'title' => get_the_title(),
            'postid' => get_the_ID()
        )
    );
}

add_action( 'wp_enqueue_scripts', 'ufc_frontend_enqueue_scripts' );

register_activation_hook(__FILE__, 'ufc_plugin_run_on_activation');

function ufc_plugin_run_on_activation() {

    if ( ! current_user_can( 'activate_plugins' ) ) {
        return;
    }

    $args = array(
        'post_type' => array( 'post', 'page' ), // Only get the posts
        'post_status' => 'publish', // Only the posts that are published
        'posts_per_page' => -1 // Get every post
    );
    $posts = get_posts( $args );
    foreach ( $posts as $post ) {
        $posturl = get_permalink( $post->ID );
        // Generate the URL
        $url = 'https://graph.facebook.com/' . $posturl;
        // Make API request
        $response = wp_remote_get( esc_url_raw( $url ), array( 'httpversion' => '1.1' ) );
        // Check the response code
	    $response_code = wp_remote_retrieve_response_code( $response ); // log this for API issues
        // Bail out early if there are any errors.
        if( 200 != $response_code || is_wp_error( $response ) ) {
            return false;
        }
        // set response body
        $response_body = wp_remote_retrieve_body( $response );
        // Return the json decoded content.
        $data = json_decode( $response_body );
        if( !empty( $data ) ) {
            if ( isset( $data->og_object->id ) ) {
                update_post_meta( $post->ID, '_post_fb_comment_object_id', $data->og_object->id );
            } else {
                update_post_meta( $post->ID, '_post_fb_comment_object_id', 'null' );
            }

            if ( isset( $data->share->comment_count ) ) {
                update_post_meta( $post->ID, '_post_fb_comment_count', $data->share->comment_count );
            } else {
                update_post_meta( $post->ID, '_post_fb_comment_count', 0 );
            }
        } else {
            update_post_meta( $post_id, '_post_fb_comment_object_id', 'null' );
            update_post_meta( $post_id, '_post_fb_comment_count', 0 );
        }
    }
}

register_deactivation_hook( __FILE__, 'ufc_plugin_run_on_deactivation' );

function ufc_plugin_run_on_deactivation() {

    if ( ! current_user_can( 'activate_plugins' ) ) {
        return;
    }

    delete_option( 'ufc_plugin_dismiss_rating_notice' );
    delete_option( 'ufc_plugin_no_thanks_rating_notice' );
    delete_option( 'ufc_plugin_installed_time' );
}

$options = get_option('ufc_plugin_global_options');

require_once plugin_dir_path( __FILE__ ) . 'admin/loader.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/notice.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/ajax.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/disable-native.php';
require_once plugin_dir_path( __FILE__ ) . 'public/shortcode.php';

if( isset($options['ufc_enable_fb_comment_cb']) && ($options['ufc_enable_fb_comment_cb'] == 1) ) {
    require_once plugin_dir_path( __FILE__ ) . 'admin/admin-bar.php';
    require_once plugin_dir_path( __FILE__ ) . 'admin/dashboard-edit-screen.php';
    require_once plugin_dir_path( __FILE__ ) . 'admin/dashboard-column.php';
    require_once plugin_dir_path( __FILE__ ) . 'public/comments-loader.php';
}

if( empty( $options['ufc_facebook_comments_app_id'] ) ) {
    add_action( 'admin_notices', 'ufc_no_app_id_notice' );
}

function ufc_no_app_id_notice() {

    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    ?>
    <div class="notice notice-error">
        <p style="line-height: 2.5;"><?php _e( 'Please create and enter your Facebook App ID for Ultimate Facebook Comments Plugin to work properly.', 'ultimate-facebook-comments' ); ?>&nbsp;&nbsp;<a href="<?php echo admin_url( 'options-general.php?page=ultimate-facebook-comments' ); ?>" class="button button-secondary"><?php _e( 'Enter App ID', 'ultimate-facebook-comments' ); ?></a>&nbsp;&nbsp;<a href="https://developers.facebook.com/apps" target="_blank" class="button button-secondary"><?php _e( 'Create App', 'ultimate-facebook-comments' ); ?></a></p>
    </div>
    <?php
}

# template tags
function get_fb_comment_count() {

    $options = get_option('ufc_plugin_global_options');

    global $post;
    $url = get_permalink( $post->ID );
    $count = get_post_meta( $post->ID, '_post_fb_comment_count', true );
    if ( ( isset( $options['ufc_fb_comment_auto_display'] ) && $options['ufc_fb_comment_auto_display'] != 'replace_native_comment' ) && comments_open() ) {
        $wpc_count = get_comments_number( $post->ID );
        if( apply_filters( 'ufc_comment_count_merge_wpc', true ) ) {
            $count = $count + $wpc_count;
        }
    }
    $comments = $count;
    if ( ! $count || $count == 0 ) {
        $comments = __( 'Leave a Comment', 'ultimate-facebook-comments' );
    }
    elseif ( $count == 1 ) {
        $comments .= __( ' Comment', 'ultimate-facebook-comments' );
    }
    elseif ( $count > 1 ) {
        $comments .= __( ' Comments', 'ultimate-facebook-comments' );
    }
    return '<a href="' . $url . '#' . $options['ufc_comment_area_id'] . '" title="' . __( 'Comments for ', 'ultimate-facebook-comments' ) . $post->post_title . '" class="' . apply_filters( 'ufc_comment_count_css_class', 'comments-link' ) . '">' . $comments . '</a>';
}

function fb_comment_count() {
    echo get_fb_comment_count();
}

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

?>