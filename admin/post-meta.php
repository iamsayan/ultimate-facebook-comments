<?php 

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Ultimate Facebook Comments
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

add_action( 'wp_head', 'ufc_fetch_fb_post_comment_count' );

function ufc_fetch_fb_post_comment_count() {
    $options = get_option( 'ufc_plugin_global_options' );

	if( ! is_single() ) {
		return;
    }

    if( ufc_check_is_amp_page() ) {
        return;
    }

    if( apply_filters( 'ufc_disable_comment_count_fetch_process', false ) ) {
        return;
    }
    
    $object_id = esc_attr( get_post_meta( get_the_ID(), '_post_fb_comment_object_id', true ) );
    $count = esc_attr( get_post_meta( get_the_ID(), '_post_fb_comment_count', true ) );
    $access_token = $options['ufc_facebook_comments_app_id'].'|'.$options['ufc_facebook_comments_app_secret'];
    $appsecret_proof = hash_hmac( 'sha256', $access_token, $options['ufc_facebook_comments_app_secret'] );

    if( $count != '' ) {
        return;
    }
    // Make API request
    $response = wp_remote_get( add_query_arg( array( 
        'id' => urlencode( get_permalink( get_the_ID() ) ),
        'access_token' => $access_token,
        'appsecret_proof' => $appsecret_proof,
        'fields' => 'engagement,og_object'
    ), 'https://graph.facebook.com/v3.2/' ), array( 'httpversion' => '1.1' ) );
    
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
        if ( isset( $data->og_object->id ) ) {
            update_post_meta( get_the_ID(), '_post_fb_comment_object_id', $data->og_object->id );
        }
        if ( isset( $data->engagement->comment_plugin_count ) ) {
            update_post_meta( get_the_ID(), '_post_fb_comment_count', $data->engagement->comment_plugin_count );
        }
    }
}

?>