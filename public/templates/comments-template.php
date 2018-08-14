<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @category   HTML
 * @package    Ultimate WordPress Comments
 * @subpackage Public
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

$options = get_option('ufc_plugin_global_options');

if ($options['ufc_fb_comment_loading_method'] == 'On Click') {
    $get_button = '<button id="ufc-button" class="' . $options['ufc_loading_button_class'] . '" onclick="showUFC();">' . $options['ufc_loading_button_text'] . '</button>';
} else {
    $get_button = '';
}

if ( !empty($options['ufc_fbc_area_bgcolor'] )) {
    $get_bgcolor = 'background-color: ' . sanitize_text_field($options['ufc_fbc_area_bgcolor']);
} else {
    $get_bgcolor = '';
}

if( !empty($options['ufc_facebook_comments_app_id']) && !empty($options['ufc_fb_comment_language'])) {
    if( isset($options['ufc_fb_comment_consent_notice_cb']) && ($options['ufc_fb_comment_consent_notice_cb'] == 1) ) {
        echo '<div id="consent-notice" class="ufc-consent" style="display:none;">
        <p style="text-align:center;line-height:0.2;color:red;font-size:15px;"><strong>' . $options['ufc_fb_comment_consent_notice_title'] . '</strong></p>
        <p style="font-size:12px;color:#5e5e5e;">' . $options['ufc_fb_comment_consent_notice_msg'] . '</p>
        <p><span id="ufc-accept">Accpet</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="ufc-decline">Decline</span></p>
        </div>';
    }
    if ($options['ufc_fb_comment_loading_method'] == 'Default') {
        echo '<div id="' . $options['ufc_comment_area_id'] . '" class="ufc-comments ' . $options['ufc_comment_area_class'] . '" style="' . $get_bgcolor . '">' . ufc_comments_area_content() . '</div>';
    } else {
        echo '<div id="' . $options['ufc_comment_area_id'] . '" class="ufc-comments ' . $options['ufc_comment_area_class'] . '" style="text-align:center;' . $get_bgcolor . '">' . $get_button . '</div>';
    }
}

?>