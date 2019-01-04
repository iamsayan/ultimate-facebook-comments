<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @category   HTML
 * @package    Ultimate WordPress Comments
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

require_once plugin_dir_path( __FILE__ ) . 'settings/settings-loader.php';
require_once plugin_dir_path( __FILE__ ) . 'settings/settings-fields.php';
require_once plugin_dir_path( __FILE__ ) . 'settings/tools.php';

// add settings page
add_action( 'admin_init', 'ufc_plugin_register_settings' );

function ufc_show_page() { 
    $options = get_option('ufc_plugin_global_options');
    require_once plugin_dir_path( __FILE__ ) . 'settings/settings-page.php';
}

function ufc_menu_item_options() {
    add_menu_page( __( 'Ultimate Facebook Comments', 'ultimate-facebook-comments' ), __( 'FB Comments', 'ultimate-facebook-comments' ), 'manage_options', 'ultimate-facebook-comments', 'ufc_show_page' , 'dashicons-facebook', 100 );
}

if( !is_network_admin() ) {
    add_action( 'admin_menu', 'ufc_menu_item_options' );
}