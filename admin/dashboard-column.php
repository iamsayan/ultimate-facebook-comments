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
        
    switch ( $column ) {
        case 'fb-comments':
            $options = get_option('ufc_plugin_global_options');

            global $post;
            $posturl = get_permalink( $post->ID );
            $url = 'https://graph.facebook.com/' . $posturl;
    
            $request = wp_remote_get( esc_url_raw( $url ), array( 'httpversion' => '1.1' ) );
    
            if( is_wp_error( $request ) ) {
                return false; // Bail early
            }
    
            $body = wp_remote_retrieve_body( $request );
            $data = json_decode( $body );
    
            if( !empty( $data ) ) {

                if ( isset( $data->og_object->id ) ) {
                    $comment_url = 'https://developers.facebook.com/tools/comments/url/' . $data->og_object->id . '/pending/descending/';
                } else {
                    $comment_url = 'https://developers.facebook.com/tools/comments/' . $options['ufc_facebook_comments_app_id'] . '/pending/descending/';
                }

                if ( isset( $data->share->comment_count ) ) {
                    $count = $data->share->comment_count;
                } else {
                    $count = 0;
                }

                if ( $count == 1 ) {
                    $comments = '<a href="' . $comment_url . '" target="_blank" class="post-fb-com-count post-fb-com-count-approved"><span class="fb-comment-count-approved" aria-hidden="true">1</span><span class="screen-reader-text">' . $count . __( ' comment', 'ultimate-facebook-comments' ) . '</span></a>';
                }
                elseif ( $count == 0 ) {
                    $comments = '<span aria-hidden="true">—</span><span class="screen-reader-text">' . __( 'No comments', 'ultimate-facebook-comments' ) . '</span>';
                }
                elseif ( $count > 1 ) {
                    $comments = '<a href="' . $comment_url . '" target="_blank" class="post-fb-com-count post-fb-com-count-approved"><span class="fb-comment-count-approved" aria-hidden="true">' . $count . '</span><span class="screen-reader-text">' . $count . __( ' comments', 'ultimate-facebook-comments' ) . '</span></a>';
                }

            }   ?>
            <div class="post-fb-com-count-wrapper"><?php echo $comments; ?></div>
            <?php
            break;
        case 'fb-comments-status':
            global $post;
            $p_meta = get_post_meta( get_the_ID(), '_ufc_disable', true );
            if ( $p_meta != 'yes' ) {
                echo '<span class="ufc-enable dashicons dashicons-yes" style="color:#3CB371" title="' . esc_attr__( 'Facebook Comment is enabled', 'ultimate-facebook-comments' ) . '" style="font-size:14px;"></span>';
            }
            elseif ( has_shortcode( $post->post_content, 'ufc-fb-comments') ) {
                 echo '<span class="ufc-disable dashicons dashicons-yes" style="color:#EE82EE" title="' . esc_attr__( 'Facebook Comment is inserted using Shortcode', 'ultimate-facebook-comments' ) . '" style="font-size:14px;"></span>';
            }
            else {
                echo '<span class="ufc-disable dashicons dashicons-no" style="color:#e14d43;" title="' . esc_attr__( 'Facebook Comment is disabled', 'ultimate-facebook-comments' ) . '" style="font-size:14px;"></span>';
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

add_action( 'admin_init', 'ufc_post_admin_actions' );

?>