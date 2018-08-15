<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Ultimate WordPress Comments
 * @subpackage Public
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

function ufc_load_fb_elements_in_header() {
    
    $options = get_option( 'ufc_plugin_global_options' );

    if ($options['ufc_fb_comment_loading_method'] == 'On Click') {
        $get_btn = '<button id="ufc-button" class="' . $options['ufc_loading_button_class'] . '" onclick="showUFC(); return false;">' . $options['ufc_loading_button_text'] . '</button><br><br>';
    } else {
        $get_btn = '';
    }

    if ( !empty($options['ufc_fbc_area_bgcolor'] )) {
        $get_bgcolor = 'background-color: ' . sanitize_text_field($options['ufc_fbc_area_bgcolor']);
    } else {
        $get_bgcolor = '';
    }

    if( isset($options['ufc_fb_comment_consent_notice_cb']) && ($options['ufc_fb_comment_consent_notice_cb'] == 1) ) {
        $cookie_consent = '<div id="consent-notice" class="ufc-consent" style="display:none;">
        <p style="text-align:center;line-height:0.2;color:red;font-size:15px;"><strong>' . $options['ufc_fb_comment_consent_notice_title'] . '</strong></p>
        <p style="font-size:12px;color:#5e5e5e;">' . $options['ufc_fb_comment_consent_notice_msg'] . '</p>
        <p><span id="ufc-accept">Accpet</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="ufc-decline">Decline</span></p>
        </div>';
    } else {
        $cookie_consent = '';
    }

    if ($options['ufc_fb_comment_loading_method'] == 'On Click') {
        $shortcode_content = $cookie_consent . '<div id="' . $options['ufc_comment_area_id'] . '" class="ufc-comments ' . $options['ufc_comment_area_class'] . '" style="text-align:center;' . $get_bgcolor . '">' . $get_btn . '</div>';
    } else {
        $shortcode_content = $cookie_consent . '<div id="' . $options['ufc_comment_area_id'] . '" class="ufc-comments ' . $options['ufc_comment_area_class'] . '" style="' . $get_bgcolor . '">' . ufc_comments_area_content() . '</div>';
    }

    return $shortcode_content;
}
add_shortcode( 'ufc-fb-comments', 'ufc_load_fb_elements_in_header' );
add_filter( 'widget_text', 'do_shortcode' );

?>