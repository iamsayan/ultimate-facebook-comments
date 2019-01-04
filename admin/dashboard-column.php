<?php 

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Ultimate WordPress Comments
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

function ufc_last_modified_info_on_column( $column, $post_id ) {
        
    global $post;
    switch ( $column ) {
        case 'fb-comments':
            $options = get_option('ufc_plugin_global_options');
            $count = get_post_meta( $post->ID, '_post_fb_comment_count', true );
            $object_id = get_post_meta( $post->ID, '_post_fb_comment_object_id', true );
            
            if ( $object_id == 'null' ) {
                $comment_url = 'https://developers.facebook.com/tools/comments/' . $options['ufc_facebook_comments_app_id'] . '/pending/descending/';
            } else {
                $comment_url = 'https://developers.facebook.com/tools/comments/url/' . $object_id . '/pending/descending/';
            }
            
            if ( $count == 1 ) {
                $comments = '<a href="' . $comment_url . '" target="_blank" class="post-fb-com-count post-fb-com-count-approved"><span class="fb-comment-count-approved" aria-hidden="true">1</span><span class="screen-reader-text">' . $count . __( ' comment', 'ultimate-facebook-comments' ) . '</span></a>';
            }
            elseif ( $count == 0 ) {
                $comments = '<span aria-hidden="true">—</span><span class="screen-reader-text">' . __( 'No comments', 'ultimate-facebook-comments' ) . '</span>';
            }
            elseif ( $count > 1 ) {
                $comments = '<a href="' . $comment_url . '" target="_blank" class="post-fb-com-count post-fb-com-count-approved"><span class="fb-comment-count-approved" aria-hidden="true">' . $count . '</span><span class="screen-reader-text">' . $count . __( ' comments', 'ultimate-facebook-comments' ) . '</span></a>';
            } ?>
            <div class="post-fb-com-count-wrapper"><?php echo $comments; ?></div>
            <?php
            break;
        case 'fb-comments-status':
            $options = get_option('ufc_plugin_global_options');
            $p_meta = get_post_meta( $post->ID, '_ufc_disable', true );
            
            if ( $options['ufc_fb_comment_auto_display'] == 'after_content' && $p_meta != 'yes' ) {
                echo '<span class="ufc-enable dashicons dashicons-yes" style="color:#3cb371" title="' . esc_attr__( 'Enabled', 'ultimate-facebook-comments' ) . '" style="font-size:14px;"></span>';
            }
            elseif ( has_shortcode( $post->post_content, 'ufc-fb-comments') || ( post_type_supports( get_post_type( $post->ID ), 'comments' ) && comments_open( $post->ID ) ) ) {
                echo '<span class="ufc-disable dashicons dashicons-yes" style="color:#3cb371" title="' . esc_attr__( 'Enabled', 'ultimate-facebook-comments' ) . '" style="font-size:14px;"></span>';
                //echo $refresh;
            }
            else {
                echo '<span class="ufc-disable dashicons dashicons-no" style="color:#e14d43;" title="' . esc_attr__( 'Disabled', 'ultimate-facebook-comments' ) . '" style="font-size:14px;"></span>';
            }
            break;
        // end all case breaks
    }
}

function ufc_post_columns_display( $columns ) {
    $options = get_option('ufc_plugin_global_options');

    if( isset($options['ufc_show_comment_count_cb']) && ($options['ufc_show_comment_count_cb'] == 1) ) {
        $columns['fb-comments'] = '<span class="dashicons dashicons-admin-comments" title="Facebook Comments"><span class="screen-reader-text">' . __( 'Facebook Comments', 'ultimate-facebook-comments' ) . '</span></span>';
    }
    $columns['fb-comments-status'] = '<span class="dashicons dashicons-facebook" title="Facebook Comments Status"><span class="screen-reader-text">' . __( 'Facebook Comments Status', 'ultimate-facebook-comments' ) . '</span></span>';
    return $columns;
}

function ufc_post_admin_actions() {

    $options = get_option('ufc_plugin_global_options');

    if( isset($options['ufc_enable_on_post_types']) ) {
        $post_types = $options['ufc_enable_on_post_types'];
        foreach ( $post_types as $ptc ) {
            add_filter( "manage_{$ptc}_posts_columns", "ufc_post_columns_display", 10, 1 );
            add_action( "manage_{$ptc}_posts_custom_column", "ufc_last_modified_info_on_column", 10, 2);
        }
    }
}

if( isset($options['ufc_enable_fb_comment_cb']) && ($options['ufc_enable_fb_comment_cb'] == 1) ) {
    add_action( 'admin_init', 'ufc_post_admin_actions' );
}

?>