<?php
/**
 * Runs on Uninstall of Ultimate WordPress Comments
 *
 * @package   Ultimate WordPress Comments
 * @author    Sayan Datta
 * @license   http://www.gnu.org/licenses/gpl.html
 */

// Exit if accessed directly
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit;

// Make sure that we are uninstalling
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    exit();

// Leave no trail
$plugin_option = 'ufc_plugin_global_options';

if ( !is_multisite() ) {
	
    $options = get_option( $plugin_option );
	
	if ( isset($options['ufc_del_plugin_settings_cb']) && $options['ufc_del_plugin_settings_cb'] == 1 ) {
	
		// Remove all plugin settings
		delete_option( $plugin_option );
	}

} else { 

	// This is a multisite
	//
	// @since 1.3.1

    global $wpdb;
	
    $blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
    $original_blog_id = get_current_blog_id();
    foreach ( $blog_ids as $blog_id ) {
		
        switch_to_blog( $blog_id );
		
		$options = get_option( $plugin_option );
		
		if ( isset($options['ufc_del_plugin_settings_cb']) && $options['ufc_del_plugin_settings_cb'] == 1 ) {
			
			// Remove all plugin settings
			delete_option( $plugin_option );
		}
    }
    switch_to_blog( $original_blog_id );
}