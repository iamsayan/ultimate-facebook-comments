<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Ultimate Social Comments
 * @subpackage Public
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

$options = get_option('ufc_plugin_global_options');

if( ! empty($options['ufc_facebook_comments_app_id']) && ! empty($options['ufc_fb_comment_language'])) {

    $get_bgcolor = '';
    if ( !empty($options['ufc_fbc_area_bgcolor'] )) {
        $get_bgcolor = 'background-color:' . sanitize_text_field($options['ufc_fbc_area_bgcolor']);
    }
    
    if( isset($options['ufc_fb_comment_consent_notice_cb']) && ($options['ufc_fb_comment_consent_notice_cb'] == 1) ) {
        echo '<div id="consent-notice" class="ufc-consent" style="display: none;">
        <p style="text-align:center;line-height:0.2;color:red;font-size:15px;"><strong>' . esc_html($options['ufc_fb_comment_consent_notice_title']) . '</strong></p>
        <p style="font-size:12px;color:#5e5e5e;">' . esc_html($options['ufc_fb_comment_consent_notice_msg']) . '</p>
        <p><span id="ufc-accept">' . esc_html($options['ufc_fb_comment_user_agreement_btn']) . '</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="ufc-decline">' . esc_html($options['ufc_fb_comment_user_agreement_decline_btn']) . '</span></p>
        </div>';
    }

    echo '<div id="' . esc_html($options['ufc_comment_area_id']) . '" class="ufc-comments ' . esc_html($options['ufc_comment_area_class']) . '" style="width:100%;' . $get_bgcolor . '">' . ufc_comments_area_content() . '</div>';
}

?>