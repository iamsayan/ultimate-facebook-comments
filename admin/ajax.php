<?php 

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Ultimate WordPress Comments
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

// ajax callback: email and terminate thread
// for both logged-in and non-logged-in users
add_action('wp_ajax_ufc_fb_comment_created', 'ufc_comment_create_ajax_request_handler' );
add_action('wp_ajax_nopriv_ufc_fb_comment_created', 'ufc_comment_create_ajax_request_handler' );
add_action('wp_ajax_ufc_fb_comment_removed', 'ufc_comment_remove_ajax_request_handler' );
add_action('wp_ajax_nopriv_ufc_fb_comment_removed', 'ufc_comment_remove_ajax_request_handler' );

if ( ! function_exists('ufc_comment_create_ajax_request_handler') ) {

	function ufc_comment_create_ajax_request_handler()  {

		// read ajax packet
		$commentID       = $_POST['commentID'];
		$href            = $_POST['href'];
        $commentText     = $_POST['commentText'];
        $post_id         = $_POST['postID'];
        $title           = $_POST['postTitle'];
        if( isset( $_POST['parentCommentID'] ) ) {
            $parentCommentID = $_POST['parentCommentID'];
        }

        $options = get_option( 'ufc_plugin_global_options' );
        $object_id = get_post_meta( $post_id, '_post_fb_comment_object_id', true );
        $count = get_post_meta( $post_id, '_post_fb_comment_count', true );
        $access_token = $options['ufc_facebook_comments_app_id'].'|'.$options['ufc_facebook_comments_app_secret'];
        
        // Make API request
        $response = wp_remote_get( add_query_arg( array( 
			'id' => urlencode( get_permalink( $post_id ) ),
			'access_token' => $access_token,
			'fields' => 'engagement,og_object'
        ), 'https://graph.facebook.com/v2.11/' ), array( 'httpversion' => '1.1' ) );
        
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

        //error_log( print_r( $data, TRUE ) );

        if( !empty( $data ) ) {
            if ( $object_id == '' || $object_id == 'null' || $object_id == 0 ) {
                if ( isset( $data->og_object->id ) ) {
                    update_post_meta( $post_id, '_post_fb_comment_object_id', $data->og_object->id );
                } else {
                    update_post_meta( $post_id, '_post_fb_comment_object_id', 'null' );
                }
            }
            if ( isset( $data->engagement->comment_plugin_count ) ) {
                update_post_meta( $post_id, '_post_fb_comment_count', $data->engagement->comment_plugin_count );
                update_post_meta( $post_id, 'ufc_comment_count', $data->engagement->comment_plugin_count );
            } else {
                if ( $count != '' ) {
                    update_post_meta( $post_id, '_post_fb_comment_count', $count );
                    update_post_meta( $post_id, 'ufc_comment_count', $count );
                } else {
                    update_post_meta( $post_id, '_post_fb_comment_count', 0 );
                    update_post_meta( $post_id, 'ufc_comment_count', 0 );
                }
            }
        } else {
            if ( $object_id != '' ) {
                update_post_meta( $post_id, '_post_fb_comment_object_id', $object_id );
            } else {
                update_post_meta( $post_id, '_post_fb_comment_object_id', 'null' );
            }

            if ( $count != '' ) {
                update_post_meta( $post_id, '_post_fb_comment_count', $count );
                update_post_meta( $post_id, 'ufc_comment_count', $count );
            } else {
                update_post_meta( $post_id, '_post_fb_comment_count', 0 );
                update_post_meta( $post_id, 'ufc_comment_count', 0 );
            }
        }

        if( isset($options['ufc_enable_fbc_notification_cb']) && ($options['ufc_enable_fbc_notification_cb'] == 1) ) {
            // get current time
		    $ftime = date( 'j F, Y @ g:i a', current_time( 'timestamp', 0 ) );
		    $post = get_post( $post_id );
            $admin_email = get_option( 'admin_email' );
            $post_author = get_user_by( 'id', $post->post_author );
            $post_link = get_permalink( $post_id );
		    $commentLabel = __( 'comment', 'ultimate-facebook-comments' );
		    if ( isset( $parentCommentID ) ) {
		    	$commentLabel = __( 'reply', 'ultimate-facebook-comments' );
            }
            if ( empty( $commentText ) ) {
                $commentText = __( 'A photo is published as facebook comments.', 'ultimate-facebook-comments' );
            }
            $blogurl = get_bloginfo( 'url' );
            $blogname = get_bloginfo( 'name' );
            $blogname = wp_specialchars_decode( $blogname, ENT_QUOTES );
            
            $emailName = $options['ufc_fbcn_name'];
            $emailFrom = $options['ufc_fbcn_email'];
            $emailRecipient = $options['ufc_fbcn_email_recipient'];
            $emailSubject = $options['ufc_fbcn_email_subject'];
            $emailSubject = stripslashes( $emailSubject );
            $emailSubject = str_replace( '[author_name]', $post_author->data->user_nicename, $emailSubject ); 
            $emailSubject = str_replace( '[post_title]', $title, $emailSubject ); 
            $emailSubject = str_replace( '[post_link]', $post_link, $emailSubject ); 
            $emailSubject = str_replace( '[site_name]', $blogname, $emailSubject ); 
            $emailSubject = str_replace( '[site_url]', $blogurl, $emailSubject );
            $emailSubject = str_replace( '[comment_text]', $commentText, $emailSubject );
            $emailSubject = str_replace( '[comment_type]', $commentLabel, $emailSubject );
            $emailSubject = stripslashes( strip_tags( $emailSubject ) );
            $emailBody = $options['ufc_fbcn_email_message'];
            $emailBody = stripslashes( $emailBody );
            $emailBody = str_replace( '[admin_email]', $admin_email, $emailBody ); 
            $emailBody = str_replace( '[author_name]', $post_author->data->user_nicename, $emailBody ); 
            $emailBody = str_replace( '[post_title]', $title, $emailBody ); 
            $emailBody = str_replace( '[post_link]', $post_link, $emailBody ); 
            $emailBody = str_replace( '[site_name]', $blogname, $emailBody ); 
            $emailBody = str_replace( '[site_url]', $blogurl, $emailBody );
            $emailBody = str_replace( '[comment_text]', $commentText, $emailBody );
            $emailBody = str_replace( '[comment_type]', $commentLabel, $emailBody );
            $emailBody = str_replace( '[comment_time]', $ftime, $emailBody );
            $emailBody = stripslashes( htmlspecialchars_decode( $emailBody ) );
    
            $recipient = array();
            $recipient = explode(',', $emailRecipient);
            if( isset($options['ufc_enable_fbcn_author_cb']) && ($options['ufc_enable_fbcn_author_cb'] == 1) ) {
                if( !in_array( $post_author->data->user_email, $recipient ) ) {
                    $recipient[] = $post_author->data->user_email;
                }
            }
            $subject = $emailSubject;
            $body = $emailBody;
            if ( isset($options['ufc_fbcn_template']) && ($options['ufc_fbcn_template'] == 'template_one') ) {
                $body = '<div style="padding: 18px;font-family: \'Open Sans\', \'Helvetica Neue\', Helvetica, sans-serif;background-color: #E4F2FD;border: 1px solid #C6D9E9;line-height: 1.6em;" class="post">
                    <table style="width: 100%;" class="post-details">
                        <tr>
                            <td valign="top">
                                <h1 style="margin: 0; padding: 3px 0 10px 0; font-size: 20px;margin-top: -5px; color: #555;" class="post-title">'. $emailSubject .'</h1>
                            </td>
                        </tr>
                    </table>
                    <table class="email-content" width="100%" style="-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;border: 1px solid #fff;padding: 18px;background: #fff;margin-top: 6px;margin-bottom: 1px;">
                        <tr>
                             <td valign="top">
                                <div style="color: #999;font-size: 12px;margin-top: -4px;margin-bottom: 10px;">
                                    <strong>'. __( 'URL: ', 'ultimate-facebook-comments' ) . '<a target="_blank" href="'. $post_link . '">'. $title .'</a> | <span style="color: #999;margin-top: 4px;">'. __( 'Posted on: ', 'ultimate-facebook-comments' ) . $ftime .'</span></strong>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <div class="ufc-email-body" style="font-size: 14px;padding-bottom: 18px;text-align: justify;">'. $emailBody .'</div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <div style="font-size:12px;margin-bottom: 5px;">
                                    <a style="padding: 8px 15px;width: 200px;font-weight: bold;color:#FFFFFF;background: #1E73BE;border: 1px solid #1E73BE;text-align: center;text-decoration: none;border-radius: 5px;-webkit-border-radius: 5px;-moz-border-radius: 5px" href="'. $post_link .'">'. __( 'Reply', 'ultimate-facebook-comments' ) .'</a>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>';
            }
            $message = '<html>
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                </head>
                <body>' . $body. '</body>
            </html>';
            $headers = array( 'Content-Type: text/html; charset=UTF-8', 'From: ' . $emailName . ' <' . $emailFrom . '>' . "\r\n" );
            wp_mail( $recipient, $subject, $message, $headers );
        }
	}
}

if ( ! function_exists('ufc_comment_remove_ajax_request_handler') ) {

	function ufc_comment_remove_ajax_request_handler()  {

		// read ajax packet
        $post_id = $_POST['postID'];
        $options = get_option( 'ufc_plugin_global_options' );
        $object_id = get_post_meta( $post_id, '_post_fb_comment_object_id', true );
        $count = get_post_meta( $post_id, '_post_fb_comment_count', true );
        $access_token = $options['ufc_facebook_comments_app_id'].'|'.$options['ufc_facebook_comments_app_secret'];
        
        // Make API request
        $response = wp_remote_get( add_query_arg( array( 
			'id' => urlencode( get_permalink( $post_id ) ),
			'access_token' => $access_token,
			'fields' => 'engagement,og_object'
        ), 'https://graph.facebook.com/v2.11/' ), array( 'httpversion' => '1.1' ) );
        
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
        
        if( !empty( $data ) ) {
            if ( $object_id == '' || $object_id == 'null' || $object_id == 0 ) {
                if ( isset( $data->og_object->id ) ) {
                    update_post_meta( $post_id, '_post_fb_comment_object_id', $data->og_object->id );
                } else {
                    update_post_meta( $post_id, '_post_fb_comment_object_id', 'null' );
                }
            }
            if ( isset( $data->engagement->comment_plugin_count ) ) {
                update_post_meta( $post_id, '_post_fb_comment_count', $data->engagement->comment_plugin_count );
                update_post_meta( $post_id, 'ufc_comment_count', $data->engagement->comment_plugin_count );
            } else {
                if ( $count != '' ) {
                    update_post_meta( $post_id, '_post_fb_comment_count', $count );
                    update_post_meta( $post_id, 'ufc_comment_count', $count );
                } else {
                    update_post_meta( $post_id, '_post_fb_comment_count', 0 );
                    update_post_meta( $post_id, 'ufc_comment_count', 0 );
                }
            }
        } else {
            if ( $object_id != '' ) {
                update_post_meta( $post_id, '_post_fb_comment_object_id', $object_id );
            } else {
                update_post_meta( $post_id, '_post_fb_comment_object_id', 'null' );
            }

            if ( $count != '' ) {
                update_post_meta( $post_id, '_post_fb_comment_count', $count );
                update_post_meta( $post_id, 'ufc_comment_count', $count );
            } else {
                update_post_meta( $post_id, '_post_fb_comment_count', 0 );
                update_post_meta( $post_id, 'ufc_comment_count', 0 );
            }
        }
	}
}

?>