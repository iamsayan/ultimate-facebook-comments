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

function ufc_custom_toolbar_link( $wp_admin_bar ) {

    $options = get_option('ufc_plugin_global_options');

    if ( !is_user_logged_in() ) return;

    if ( !current_user_can( 'moderate_comments' ) ) return;

    if ( empty($options['ufc_facebook_comments_app_id']) ) return;

    $args = array(
        'id' => 'ufc-modetation-tool',
        'parent' => 'top-secondary',
        'title' => __( 'Moderation Tool', 'ultimate-facebook-comments' ),
        'href' => 'https://developers.facebook.com/tools/comments/' . $options['ufc_facebook_comments_app_id'] . '/', 
        'meta' => array(
            'title' => __( 'Open Facebook Comment Moderation Tool', 'ultimate-facebook-comments' ),
            'target' => '_blank'
        )
    );
    $wp_admin_bar->add_node($args);

    $args = array(
        'id' => 'ufc-pending',
        'parent' => 'ufc-modetation-tool', 
        'title' => __( 'Pending Comments', 'ultimate-facebook-comments' ), 
        'href' => 'https://developers.facebook.com/tools/comments/' . $options['ufc_facebook_comments_app_id'] . '/pending/descending/', 
        'meta' => array( 
            'title' => __( 'Pending Comments', 'ultimate-facebook-comments' ),
            'target' => '_blank'
            )
    );
    $wp_admin_bar->add_node($args);

    $args = array(
        'id' => 'ufc-approved',
        'parent' => 'ufc-modetation-tool', 
        'title' => __( 'Approved Comments', 'ultimate-facebook-comments' ), 
        'href' => 'https://developers.facebook.com/tools/comments/' . $options['ufc_facebook_comments_app_id'] . '/approved/descending/', 
        'meta' => array(
            'title' => __( 'Approved Comments', 'ultimate-facebook-comments' ),
            'target' => '_blank'
            )
    );
    $wp_admin_bar->add_node($args);

    $args = array(
        'id' => 'ufc-deleted',
        'parent' => 'ufc-modetation-tool', 
        'title' => __( 'Deleted Comments', 'ultimate-facebook-comments' ), 
        'href' => 'https://developers.facebook.com/tools/comments/' . $options['ufc_facebook_comments_app_id'] . '/deleted/descending/', 
        'meta' => array(
            'title' => __( 'Deleted Comments', 'ultimate-facebook-comments' ),
            'target' => '_blank'
            )
    );
    $wp_admin_bar->add_node($args);

    $args = array(
        'id' => 'ufc-spam',
        'parent' => 'ufc-modetation-tool', 
        'title' => __( 'Spam Comments', 'ultimate-facebook-comments' ), 
        'href' => 'https://developers.facebook.com/tools/comments/' . $options['ufc_facebook_comments_app_id'] . '/reported_spam/descending/', 
        'meta' => array(
            'title' => __( 'Spam Comments', 'ultimate-facebook-comments' ),
            'target' => '_blank'
            )
    );
    $wp_admin_bar->add_node($args);


}

add_action('admin_bar_menu', 'ufc_custom_toolbar_link', 999);

function ufc_add_admin_bar_object() { ?>
    <style type="text/css">
        #wpadminbar #wp-admin-bar-ufc-modetation-tool .ab-icon:before {
            content: '\f107';
            top: 2px;
        }
    </style>
<?php
}

//add_action( 'wp_head', 'ufc_add_admin_bar_object', 10 );
//add_action( 'admin_head', 'ufc_add_admin_bar_object', 10 );

?>