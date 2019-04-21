<?php

/**
 * @package   Ultimate Facebook Comments
 * @author    Sayan Datta
 * @license   http://www.gnu.org/licenses/gpl.html
 * 
 */

# template tags
function get_fb_comment_count( $post_id = null ) {
    $options = get_option('ufc_plugin_global_options');

    if ( ! $post_id ) {

        global $post;
        if( ! is_object( $post ) ) {
            return;
        }

        $post_id = $post->ID;
    }

    $url = get_permalink( $post_id );
    $count = get_post_meta( $post_id, '_post_fb_comment_count', true );
    if ( ( isset( $options['ufc_fb_comment_auto_display'] ) && $options['ufc_fb_comment_auto_display'] != 'replace_native_comment' ) && comments_open( $post_id ) ) {
        $wpc_count = get_comments_number( $post_id );
        if( apply_filters( 'ufc_comment_count_merge_wpc', true ) ) {
            $count = $count + $wpc_count;
        }
    }
    $comments = '<span class="fb-comments-count" data-href="' . $url . '">' . $count . '</span>';
    if ( ! $count || $count == 0 ) {
        $comments = apply_filters( 'ufc_no_comments_text', __( 'Leave a Comment', 'ultimate-facebook-comments' ) );
    }
    elseif ( $count == 1 ) {
        $comments .= apply_filters( 'ufc_single_comment_text', __( ' Comment', 'ultimate-facebook-comments' ) );
    }
    elseif ( $count > 1 ) {
        $comments .= apply_filters( 'ufc_multiple_comments_text', __( ' Comments', 'ultimate-facebook-comments' ) );
    }
    return '<a href="' . $url . '#' . $options['ufc_comment_area_id'] . '" itemprop="commentCount" title="' . __( 'Comments for ', 'ultimate-facebook-comments' ) . get_the_title( $post_id ) . '" class="' . apply_filters( 'ufc_comment_count_css_class', 'comments-link' ) . '">' . $comments . '</a>';
}

function fb_comment_count( $post_id = null ) {
    echo get_fb_comment_count( $post_id );
}