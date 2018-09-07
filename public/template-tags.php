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

    // Generate the URL
    $url = 'https://graph.facebook.com/' . $posturl;

    // Make API request
    $response = wp_remote_get( esc_url_raw( $url ), array( 'httpversion' => '1.1' ) );

    // Check the response code
	$response_code = wp_remote_retrieve_response_code( $response ); // log this for API issues
    
    // Bail out early if there are any errors.
    if( 200 != $response_code || is_wp_error( $response ) ) {
        return false;
    }
    
    // set response body
    $response_body = wp_remote_retrieve_body( $response );

    // Return the json decoded content.
    $data = json_decode( $response_body );

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