<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Ultimate Social Comments
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

add_action( 'admin_bar_menu', 'ufc_custom_toolbar_link', 999 );

function ufc_custom_toolbar_link( $wp_admin_bar ) {
    $options = get_option('ufc_plugin_global_options');

    // If user not logged in, then get out!
    if ( ! is_user_logged_in() ) return;

    // If it's archive pages, then get out!
    if( is_home() || is_author() || is_category() || is_tag() || is_404() ) return;

    // If user can not manage comments, then get out!
    if ( ! current_user_can( 'moderate_comments' ) ) return;

    if( ! ( isset($options['ufc_enable_fb_comment_cb']) && ($options['ufc_enable_fb_comment_cb'] == 1) ) ) return;
        
    if ( empty($options['ufc_facebook_comments_app_id']) ) return;

    if( ! ( isset($options['ufc_add_fmt_admin_bar_cb']) && ($options['ufc_add_fmt_admin_bar_cb'] == 1) ) ) return;

    $args = array(
        'id' => 'ufc-modetation-tool',
        'parent' => 'top-secondary',
        'title' => __( 'Moderation Tool', 'ultimate-facebook-comments' ),
        'href' => 'https://developers.facebook.com/tools/comments/' . $options['ufc_facebook_comments_app_id'] . '/', 
        'meta' => array(
            'title' => __( 'Facebook Comment Moderation Tool', 'ultimate-facebook-comments' ),
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

?>