<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Ultimate WordPress Comments
 * @subpackage Public
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

function get_fb_comment_count() {

    $options = get_option('ufc_plugin_global_options');

    global $post;
    $posturl = get_permalink($post->ID);
    $url = 'https://graph.facebook.com/' . $posturl;

    $request = wp_remote_get( esc_url_raw( $url ), array( 'httpversion' => '1.1' ) );

    if( is_wp_error( $request ) ) {
	    return false; // Bail early
    }

    $body = wp_remote_retrieve_body( $request );
    $data = json_decode( $body );

    if( ! empty( $data ) ) {

        if ( isset( $data->share->comment_count ) ) {
            $count = $data->share->comment_count;
        } else {
            $count = 0;
        }
        $comments = $count;
        if ( $count == 1 ) {
            $comments .= __( ' Comment', 'ultimate-facebook-comments' );
        }
        elseif ( $count == 0 ) {
            $comments = __( 'Leave a Comment', 'ultimate-facebook-comments' ); // or set it to 0 comments
        }
        elseif ( $count > 1 ) {
            $comments .= __( ' Comments', 'ultimate-facebook-comments' );
        }
        return '<a href="' . $posturl . '#' . $options['ufc_comment_area_id'] . '" title="Comments for '. $post->post_title . '">' . $comments . '</a>';
    }
}

function fb_comment_count() {
    echo get_fb_comment_count();
}

?>