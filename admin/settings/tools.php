<?php

/**
 * Plugin tools options
 *
 * @package   Ultimate Facebook Comments
 * @author    Sayan Datta
 * @license   http://www.gnu.org/licenses/gpl.html
 */

/**
 * Process a settings export that generates a .json file of the shop settings
 */
function ufc_process_settings_export() {
	if( empty( $_POST['ufc_export_action'] ) || 'ufc_export_settings' != $_POST['ufc_export_action'] )
		return;
	if( ! wp_verify_nonce( $_POST['ufc_export_nonce'], 'ufc_export_nonce' ) )
		return;
	if( ! current_user_can( 'manage_options' ) )
		return;
	$settings = get_option( 'ufc_plugin_global_options' );
	$url = get_site_url();
    $find = array( 'http://', 'https://' );
    $replace = '';
    $output = str_replace( $find, $replace, $url );
	ignore_user_abort( true );
	nocache_headers();
	header( 'Content-Type: application/json; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=' . $output . '-ufc-export-' . date( 'm-d-Y' ) . '.json' );
	header( "Expires: 0" );
	echo json_encode( $settings );
	exit;
}

add_action( 'admin_init', 'ufc_process_settings_export' );

/**
 * Process a settings import from a json file
 */
function ufc_process_settings_import() {
	if( empty( $_POST['ufc_import_action'] ) || 'ufc_import_settings' != $_POST['ufc_import_action'] )
		return;
	if( ! wp_verify_nonce( $_POST['ufc_import_nonce'], 'ufc_import_nonce' ) )
		return;
	if( ! current_user_can( 'manage_options' ) )
		return;
    $extension = explode( '.', $_FILES['import_file']['name'] );
    $file_extension = end( $extension );
	if( $file_extension != 'json' ) {
		wp_die( __( '<strong>Settings import failed:</strong> Please upload a valid .json file to import settings in this website.', 'ultimate-facebook-comments' ) );
	}
	$import_file = $_FILES['import_file']['tmp_name'];
	if( empty( $import_file ) ) {
		wp_die( __( '<strong>Settings import failed:</strong> Please upload a file to import.', 'ultimate-facebook-comments' ) );
	}
	// Retrieve the settings from the file and convert the json object to an array.
	$settings = (array) json_decode( file_get_contents( $import_file ) );
    update_option( 'ufc_plugin_global_options', $settings );
    //wp_safe_redirect( admin_url( 'options-general.php?page=ultimate-facebook-comments' ) ); exit;
    function ufc_import_success_notice(){
        echo '<div class="notice notice-success is-dismissible">
                 <p><strong>' . __( 'Success! Plugin Settings has been imported successfully.', 'ultimate-facebook-comments' ) . '</strong></p>
             </div>';
	}
	
    add_action('admin_notices', 'ufc_import_success_notice'); 
}

add_action( 'admin_init', 'ufc_process_settings_import' );

/**
 * Process reset plugin settings
 */
function ufc_remove_plugin_settings() {
	if( empty( $_POST['ufc_reset_action'] ) || 'ufc_reset_settings' != $_POST['ufc_reset_action'] )
		return;
	if( ! wp_verify_nonce( $_POST['ufc_reset_nonce'], 'ufc_reset_nonce' ) )
		return;
	if( ! current_user_can( 'manage_options' ) )
		return;
    $plugin_settings = 'ufc_plugin_global_options';
    delete_option( $plugin_settings );

    function ufc_settings_reset_success_notice(){
        echo '<div class="notice notice-success is-dismissible">
                 <p><strong>' . __( 'Success! Plugin Settings reset successfully.', 'ultimate-facebook-comments' ) . '</strong></p>
             </div>';
	}
	
    add_action('admin_notices', 'ufc_settings_reset_success_notice'); 
}

add_action( 'admin_init', 'ufc_remove_plugin_settings' );

?>