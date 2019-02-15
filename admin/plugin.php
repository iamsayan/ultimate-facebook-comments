<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Ultimate Facebook Comments
 * @subpackage Public
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

add_action( 'tgmpa_register', 'ufc_plugin_tgmpa_register_recommended_plugins' );

function ufc_plugin_tgmpa_register_recommended_plugins() {

	$plugins = apply_filters(
        'ufc_core_recommendations_plugins',
        array(
		    array(
		    	'name'              => 'WP Last Modified Info',
		    	'slug'              => 'wp-last-modified-info',
		    	'required'          => false,
		    	'force_activation'	=> false,
            ),
            array(
		    	'name'              => 'Facebook Account Kit Login',
		    	'slug'              => 'fb-account-kit-login',
		    	'required'          => false,
		    	'force_activation'	=> false,
            ),
            array(
		    	'name'              => 'WP Auto Republish',
		    	'slug'              => 'wp-auto-republish',
		    	'required'          => false,
		    	'force_activation'	=> false,
            ),
            array(
		    	'name'              => 'WP Page Permalink Extension',
		    	'slug'              => 'change-wp-page-permalinks',
		    	'required'          => false,
		    	'force_activation'	=> false,
            ),
            array(
		    	'name'              => 'Simple Posts Ticker',
		    	'slug'              => 'simple-posts-ticker',
		    	'required'          => false,
		    	'force_activation'	=> false,
            ),
            array(
		    	'name'              => 'Easy Header Footer',
		    	'slug'              => 'remove-wp-meta-tags',
		    	'required'          => false,
		    	'force_activation'	=> false,
            ),
        )
    );
    
    $config = apply_filters(
        'ufc_core_recommendations_plugins_config',
            array(
		    'id'           => 'ultimate-facebook-comments',
		    'menu'         => 'ufc-install-recommended-plugins',
            'parent_slug'  => 'ultimate-facebook-comments',
		    'capability'   => 'manage_options', 
		    'has_notices'  => true,
		    'is_automatic' => true,
		    'dismissable'  => true,
		    'strings'      => array(
		    	'page_title'   => __( 'Install Recommended Plugins', 'ultimate-facebook-comments' ),
		    	'menu_title'   => __( 'Recommended', 'ultimate-facebook-comments' ),
                'return'       => __( 'Return to Recommended Plugins Installer', 'ultimate-facebook-comments' ),
            )
        )
	);
    // Register notice
	tgmpa( $plugins, $config );
    
}