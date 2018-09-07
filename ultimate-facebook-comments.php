<?php
/**
 * Plugin Name: Ultimate Facebook Comments
 * Plugin URI: https://iamsayan.github.io/ultimate-facebook-comments/
 * Description: Ultimate Facebook Comments plugin will help you to display Facebook Comments box on your website easily. You can use Facebook Comments on your posts or pages.
 * Version: 1.1.7
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

function ufc_load_plugin_version() {
    // fetch plugin version
    $ufcpluginfo = get_plugin_data(__FILE__);
    $ufcversion = $ufcpluginfo['Version']; 
    return $ufcversion;
}

//add admin styles and scripts
function ufc_custom_admin_styles_scripts( $hook ) {

    $current_screen = get_current_screen();
    if ( strpos( $current_screen->base, 'ultimate-facebook-comments') !== false ) {
        wp_enqueue_style( 'ufc-admin-style', plugins_url( 'admin/assets/css/admin.min.css', __FILE__ ), array(), ufc_load_plugin_version() );
        wp_enqueue_style( 'ufc-cb-style', plugins_url( 'admin/assets/css/style.min.css', __FILE__ ), array(), ufc_load_plugin_version() );
        wp_enqueue_style( 'ufc-select2', plugins_url( 'admin/assets/css/select2.min.css', __FILE__ ), array(), ufc_load_plugin_version() );       
        
        wp_enqueue_script( 'ufc-script', plugins_url( 'admin/assets/js/admin.min.js', __FILE__ ), array( 'jquery', 'wp-color-picker' ), ufc_load_plugin_version(), true );
        wp_enqueue_script( 'ufc-select2-js', plugins_url( 'admin/assets/js/select2.min.js', __FILE__ ), array(), ufc_load_plugin_version() );
        
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
    }

    if ( $hook == 'edit.php' ) {
        wp_enqueue_style( 'ufc-edit', plugins_url( 'admin/assets/css/edit.min.css', __FILE__ ), array(), ufc_load_plugin_version() );
        wp_enqueue_script( 'ufc-post-edit', plugins_url( 'admin/assets/js/edit.min.js', __FILE__ ), array( 'jquery' ), ufc_load_plugin_version(), true );
    }
}

add_action( 'admin_enqueue_scripts', 'ufc_custom_admin_styles_scripts' );

$options = get_option('ufc_plugin_global_options');

require_once plugin_dir_path( __FILE__ ) . 'admin/loader.php';
require_once plugin_dir_path( __FILE__ ) . 'public/shortcode.php';
require_once plugin_dir_path( __FILE__ ) . 'public/template-tags.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/disable-native.php';

if( isset($options['ufc_enable_fb_comment_cb']) && ($options['ufc_enable_fb_comment_cb'] == 1) ) {

    require_once plugin_dir_path( __FILE__ ) . 'admin/admin-bar.php';
    require_once plugin_dir_path( __FILE__ ) . 'admin/dashboard-column.php';
    require_once plugin_dir_path( __FILE__ ) . 'public/comments-loader.php';
    require_once plugin_dir_path( __FILE__ ) . 'admin/dashboard-edit-screen.php';

}

function ufc_first_time_cookie_notice() {

    $options = get_option('ufc_plugin_global_options');
    if( isset($options['ufc_fb_comment_consent_notice_cb']) && ($options['ufc_fb_comment_consent_notice_cb'] == 1) ) {
        wp_enqueue_script( 'ufc-cookie-js', plugin_dir_url( __FILE__ ) . 'public/js/jquery.cookie.min.js', array ( 'jquery' ), '1.4.1', true );
        wp_enqueue_style( 'ufc-consent', plugins_url( 'public/css/consent.min.css', __FILE__ ), array(), '1.1.6' );   
        wp_enqueue_script( 'ufc-consent-js', plugin_dir_url( __FILE__ ) . 'public/js/consent.min.js', array ( 'jquery' ), '1.1.7', true );
    }
}

add_action( 'wp_enqueue_scripts', 'ufc_first_time_cookie_notice' );

// add action links
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'ufc_add_action_links', 10, 2 );

function ufc_add_action_links ( $links ) {
    $ufclinks = array(
        '<a href="' . admin_url( 'options-general.php?page=ultimate-facebook-comments' ) . '">' . __( 'Settings', 'ultimate-facebook-comments' ) . '</a>',
    );
    return array_merge( $ufclinks, $links );
}

function ufc_plugin_meta_links( $links, $file ) {
    static $plugin;

    if ( !$plugin ) {
        $plugin = plugin_basename(__FILE__);
    }

	if ( $file == $plugin ) // only for this plugin
		return array_merge( $links, 
            array( '<a href="https://wordpress.org/support/plugin/ultimate-facebook-comments" target="_blank">' . __( 'Support', 'ultimate-facebook-comments' ) . '</a>' ),
            array( '<a href="https://www.paypal.me/iamsayan" target="_blank">' . __( 'Donate', 'ultimate-facebook-comments' ) . '</a>' )
            
		);
	return $links;
}

add_filter( 'plugin_row_meta', 'ufc_plugin_meta_links', 10, 2 );

// match with ocean wp theme
function ufc_add_consent_style() { ?>
    <script>
        jQuery(document).ready(function($) {
            $('<div id="consent-div" style="margin-top: 30px; padding-top: 30px; border-top: 1px solid #f1f1f1; display:none;"></div>').insertBefore('div#consent-notice');
            $("#ufc-accept").click(function() {
                $("#consent-div").slideUp();
            });
            if ($.cookie('UFC_CA') != 'true') {
                $("#consent-div").show();
            }
        });
    </script>
<?php
}

//add_action('wp_footer', 'ufc_add_consent_style', 10);

?>