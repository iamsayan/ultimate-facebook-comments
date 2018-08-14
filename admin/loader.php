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

require plugin_dir_path( __FILE__ ) . 'settings/settings-loader.php';
require plugin_dir_path( __FILE__ ) . 'settings/settings-fields.php';

// add settings page
add_action( 'admin_init', 'ufc_plugin_register_settings' );

function ufc_remove_footer_admin() {
    echo 'Thanks for using <strong>Ultimate Facebook Comments v'. ufc_load_plugin_version() .'</strong> | Developed with <span style="color:#e25555;">♥</span> by <a href="https://profiles.wordpress.org/infosatech/" target="_blank" style="font-weight: 500;">Sayan Datta</a> | <a href="https://github.com/iamsayan/ultimate-facebook-comments" target="_blank" style="font-weight: 500;">GitHub</a> | <a href="https://wordpress.org/support/plugin/ultimate-facebook-comments" target="_blank" style="font-weight: 500;">Support</a> | <a href="https://wordpress.org/support/plugin/ultimate-facebook-comments/reviews/" target="_blank" style="font-weight: 500;">Rate it</a> (<span style="color:#ffa000;">&#9733;&#9733;&#9733;&#9733;&#9733;</span>), if you like this plugin.';
}

function ufc_show_page() { 
    $options = get_option('ufc_plugin_global_options');
    require plugin_dir_path( __FILE__ ) . 'settings/settings-page.php';
    add_action( 'admin_footer_text', 'ufc_remove_footer_admin');
}

function ufc_menu_item_options() {
    add_submenu_page('options-general.php', __( 'Ultimate Facebook Comments', 'ultimate-facebook-comments' ), __( 'Facebook Comments', 'ultimate-facebook-comments' ), 'manage_options', 'ultimate-facebook-comments', 'ufc_show_page'); 
}

if( !is_network_admin() ) {
    add_action( 'admin_menu', 'ufc_menu_item_options' );
}