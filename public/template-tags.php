<?php

/**
 * Plugin tools options
 *
 * @package   Ultimate WordPress Comments
 * @author    Sayan Datta
 * @license   http://www.gnu.org/licenses/gpl.html
 */

# template tags
function get_fb_comment_count() {

    $options = get_option('ufc_plugin_global_options');

    global $post;
    $url = get_permalink( $post->ID );
    $count = get_post_meta( $post->ID, '_post_fb_comment_count', true );
    if ( ( isset( $options['ufc_fb_comment_auto_display'] ) && $options['ufc_fb_comment_auto_display'] != 'replace_native_comment' ) && comments_open() ) {
        $wpc_count = get_comments_number( $post->ID );
        if( apply_filters( 'ufc_comment_count_merge_wpc', true ) ) {
            $count = $count + $wpc_count;
        }
    }
    $comments = $count;
    if ( ! $count || $count == 0 ) {
        $comments = __( 'Leave a Comment', 'ultimate-facebook-comments' );
    }
    elseif ( $count == 1 ) {
        $comments .= __( ' Comment', 'ultimate-facebook-comments' );
    }
    elseif ( $count > 1 ) {
        $comments .= __( ' Comments', 'ultimate-facebook-comments' );
    }
    return '<a href="' . $url . '#' . $options['ufc_comment_area_id'] . '" itemprop="commentCount" title="' . __( 'Comments for ', 'ultimate-facebook-comments' ) . $post->post_title . '" class="' . apply_filters( 'ufc_comment_count_css_class', 'comments-link' ) . '">' . $comments . '</a>';
}

function fb_comment_count() {
    echo get_fb_comment_count();
}

function ufc_load_fb_comments_count_shortcode() {
    fb_comment_count();
}

add_shortcode( 'ufc-fbc-count', 'ufc_load_fb_comments_count_shortcode' );