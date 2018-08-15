<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Ultimate WordPress Comments
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 *
 * Add meta box
 *
 * @param post $post The post object
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */

// get plugin settings
$options = get_option('ufc_plugin_global_options');

function ufc_add_meta_boxes( $post ) {

    // get plugin options
    $options = get_option('ufc_plugin_global_settings');
    // If user can't publish posts, then get out
    if ( ! current_user_can( 'publish_posts' ) ) return;

    add_meta_box( 'ufc_meta_box', __( 'Ultimate Facebook Comments', 'ultimate-facebook-comments' ), 'ufc_meta_box_callback', '', 'side', 'default' );
}

if( isset($options['ufc_enable_fb_comment_cb']) && ($options['ufc_enable_fb_comment_cb'] == 1) ) {
    if( isset($options['ufc_enable_on_post_types']) ) {
        $post_types = $options['ufc_enable_on_post_types'];
        foreach($post_types as $item) {
            add_action( "add_meta_boxes_{$item}", "ufc_add_meta_boxes" );
        }
    }
}

/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function ufc_meta_box_callback( $post ) {
    // get plugin options
    $options = get_option('ufc_plugin_global_settings');
    // retrieve post id
    $checkboxMeta = get_post_meta( $post->ID ); 
    // make sure the form request comes from WordPress
    wp_nonce_field( 'ufc_edit_build_nonce', 'ufc_edit_nonce' ); ?>
        
    <p id="ufc-status" class="meta-options">
        <label for="ufc_status" class="selectit">
		    <input id="ufc_status" type="checkbox" name="disablefbcomment" value="yes" <?php if ( isset ( $checkboxMeta['_ufc_disable'] ) ) checked( $checkboxMeta['_ufc_disable'][0], 'yes' ); ?> /> 
			<?php _e( 'Disable Facebook Comments', 'ultimate-facebook-comments' ); ?>
			<input type="hidden" id="ufc-disable-hidden" name="disablefbchidden" value="0">
		</label>
		<script type="text/javascript">
            jQuery(document).ready(function($) {
			    $('#ufc_status').change(function() {
                    if ($('#ufc_status').is(':checked')) {
                        $('#ufc-disable-hidden').val('1');
                    }
                    if (!$('#ufc_status').is(':checked')) {
                        $('#ufc-disable-hidden').val('0');
                    }
			    });
			    $('#ufc_status').trigger('change');
		    });
        </script>
    </p>
	<?php
}

add_action( 'quick_edit_custom_box', 'ufc_add_item_to_quick_edit', 10, 2 );

function ufc_add_item_to_quick_edit( $column_name, $post_type ) {

	global $post;

	if( $post->post_status == 'auto-draft' ) {
		return;
    }

	$hide_fbc = get_post_meta( get_the_ID(), '_ufc_disable', true );

	if ( did_action( 'quick_edit_custom_box' ) > 1 ) {
		return;
	}

	wp_nonce_field( 'ufc_edit_build_nonce', 'ufc_edit_nonce' ); ?>

    <div id="inline-edit-col-disable">
	    <em class="alignleft inline-edit-or"></em>
	    <label for="ufc_status" class="alignleft">
	        <input type="checkbox" id="ufc_status" name="disablefbcomment" value="yes" <?php if( $hide_fbc == 'yes' ) { echo 'checked'; } ?> >
		    <span class="checkbox-title"><?php _e( 'Disable Facebook Comments', 'ultimate-facebook-comments' ); ?></span>
		    <input type="hidden" id="ufc-disable-hidden" name="disablefbchidden" value="0">
        </label>
	</div>

	<script type="text/javascript">
        jQuery(document).ready(function($){
            $('#inline-edit-col-disable').appendTo('.inline-edit-col-left .inline-edit-col .inline-edit-group');
			$('#ufc_status').change(function() {
                if ($('#ufc_status').is(':checked')) {
                    $('#ufc-disable-hidden').val('1');
                }
                if (!$('#ufc_status').is(':checked')) {
                    $('#ufc-disable-hidden').val('0');
                }
			});
			$('#ufc_status').trigger('change');
		});
    </script>
	<?php
}

/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 */
function ufc_save_post_edit_data( $post_id ) {
    
    // verify taxonomies meta box nonce
	if ( ! isset( $_POST['ufc_edit_nonce'] ) || ! wp_verify_nonce( $_POST['ufc_edit_nonce'], 'ufc_edit_build_nonce' ) ) {
		return;
	}
	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	// store custom fields values
	// disablecomment string
	if( isset($_POST['disablefbchidden'] ) && $_POST['disablefbchidden'] == 1 ) {
        update_post_meta( $post_id, '_ufc_disable', 'yes' );
	}
	elseif( isset($_POST['disablefbchidden'] ) && $_POST['disablefbchidden'] == 0 ) {
        update_post_meta( $post_id, '_ufc_disable', 'no' );
	}
}

add_action( 'save_post', 'ufc_save_post_edit_data', 10, 2 );

?>