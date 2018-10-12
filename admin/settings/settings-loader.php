<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Ultimate WordPress Comments
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

function ufc_plugin_register_settings() {
    
    // start post fields
    add_settings_section('ufc_plugin_option', '', null, 'ufc_plugin_global_section');
        add_settings_field('ufc_enable_fb_comment_cb', __( 'Enable Facebook Comment?', 'ultimate-facebook-comments' ), 'ufc_enable_fb_comment_cb_display', 'ufc_plugin_global_section', 'ufc_plugin_option', array( 'label_for' => 'fbc-enable' ));  
        add_settings_field('ufc_facebook_comments_app_id', __( 'Enter Facebook Application ID:', 'ultimate-facebook-comments' ), 'ufc_facebook_comments_app_id_display', 'ufc_plugin_global_section', 'ufc_plugin_option', array( 'label_for' => 'appid' ));  
        add_settings_field('ufc_no_of_fb_comments', __( 'No. of Comments to Display:', 'ultimate-facebook-comments' ), 'ufc_no_of_fb_comments_display', 'ufc_plugin_global_section', 'ufc_plugin_option', array( 'label_for' => 'fbc-no' ));  
        add_settings_field('ufc_fb_comment_sorting', __( 'Sort Facebook Comments by:', 'ultimate-facebook-comments' ), 'ufc_fb_comment_sorting_display', 'ufc_plugin_global_section' , 'ufc_plugin_option', array( 'label_for' => 'fb-comments-sort' ));
        add_settings_field('ufc_fb_comment_language', __( 'Facebook Comments Language:', 'ultimate-facebook-comments' ), 'ufc_fb_comment_language_display', 'ufc_plugin_global_section' , 'ufc_plugin_option', array( 'label_for' => 'fb-comments-lang' ));
        add_settings_field('ufc_fb_comments_theme', __( 'Comments Box Color Scheme:', 'ultimate-facebook-comments' ), 'ufc_fb_comments_theme_display', 'ufc_plugin_global_section' , 'ufc_plugin_option', array( 'label_for' => 'fb-comments-theme' ));
        add_settings_field('ufc_fb_comment_box_width', __( 'Comments Box Width:', 'ultimate-facebook-comments' ), 'ufc_fb_comment_box_width_display', 'ufc_plugin_global_section' , 'ufc_plugin_option', array( 'label_for' => 'fb-comments-width' ));
        add_settings_field('ufc_fb_comment_auto_display', __( 'Comments Auto Insert Method:', 'ultimate-facebook-comments' ), 'ufc_fb_comment_auto_display_display', 'ufc_plugin_global_section' , 'ufc_plugin_option', array( 'label_for' => 'fb-comments-display' ));
        add_settings_field('ufc_fbc_area_bgcolor', __( 'Background Color:', 'ultimate-facebook-comments' ), 'ufc_fbc_area_bgcolor_display', 'ufc_plugin_global_section' , 'ufc_plugin_option', array( 'label_for' => 'fb-comments-bgcolor' ));
        add_settings_field('ufc_fb_comment_loading_method', __( 'Comments Box Loading Method:', 'ultimate-facebook-comments' ), 'ufc_fb_comment_loading_method_display', 'ufc_plugin_global_section' , 'ufc_plugin_option', array( 'label_for' => 'fb-comments-load', 'class' => 'fbc-loading' ));
        add_settings_field('ufc_load_fb_comment_url', __( 'Load Facebook Comments for URL:', 'ultimate-facebook-comments' ), 'ufc_load_fb_comment_url_display', 'ufc_plugin_global_section', 'ufc_plugin_option', array( 'label_for' => 'fbc-url' ));  
        add_settings_field('ufc_enable_on_post_types', __( 'Select Post Types for FB Comments:', 'ultimate-facebook-comments' ), 'ufc_enable_on_post_types_display', 'ufc_plugin_global_section', 'ufc_plugin_option', array( 'label_for' => 'post-types', 'class' => 'fbc-post-types' ));  
        add_settings_field('ufc_fb_comment_msg', __( 'Facebook Comments Box Title:', 'ultimate-facebook-comments' ), 'ufc_fb_comment_msg_display', 'ufc_plugin_global_section' , 'ufc_plugin_option', array( 'label_for' => 'fb-comments-msg' ));
        add_settings_field('ufc_custom_css_comment', __( 'Custom CSS Properties for Title:', 'ultimate-facebook-comments' ), 'ufc_custom_css_comment_display', 'ufc_plugin_global_section', 'ufc_plugin_option', array( 'label_for' => 'fbc-css' ));  
        add_settings_field('ufc_comment_area_class', __( 'Comments Div CSS Class:', 'ultimate-facebook-comments' ), 'ufc_comment_area_class_display', 'ufc_plugin_global_section', 'ufc_plugin_option', array( 'label_for' => 'fbc-area-class' ));  
        add_settings_field('ufc_fb_sdk_reinit', __( 'Facebook SDK Status:', 'ultimate-facebook-comments' ), 'ufc_fb_sdk_reinit_display', 'ufc_plugin_global_section' , 'ufc_plugin_option', array( 'label_for' => 'fbc-reinit' ));
        add_settings_field('ufc_fb_comment_consent_notice_cb', __( 'User Agreement Prior to Comment?', 'ultimate-facebook-comments' ), 'ufc_fb_comment_consent_notice_cb_display', 'ufc_plugin_global_section' , 'ufc_plugin_option', array( 'label_for' => 'fbc-notice' ));
        add_settings_field('ufc_fb_comment_consent_notice_title', __( 'User Agreement Title:', 'ultimate-facebook-comments' ), 'ufc_fb_comment_consent_notice_title_display', 'ufc_plugin_global_section', 'ufc_plugin_option', array( 'label_for' => 'fbc-notice-title', 'class' => 'fbc-notice-title' ));  
        add_settings_field('ufc_fb_comment_consent_notice_msg', __( 'User Agreement Description:', 'ultimate-facebook-comments' ), 'ufc_fb_comment_consent_notice_msg_display', 'ufc_plugin_global_section', 'ufc_plugin_option', array( 'label_for' => 'fbc-notice-msg', 'class' => 'fbc-notice-msg' ));  
        add_settings_field('ufc_fb_comment_user_agreement_btn', __( 'User Agreement Button - Accept:', 'ultimate-facebook-comments' ), 'ufc_fb_comment_user_agreement_btn_display', 'ufc_plugin_global_section', 'ufc_plugin_option', array( 'label_for' => 'fbc-notice-btn-agree', 'class' => 'fbc-notice-btn' ));  
        add_settings_field('ufc_show_comment_count_cb', __( 'Show Comment Count on Edit Page?', 'ultimate-facebook-comments' ), 'ufc_show_comment_count_cb_display', 'ufc_plugin_global_section', 'ufc_plugin_option', array( 'label_for' => 'fbc-count' ));  
        add_settings_field('ufc_add_fmt_admin_bar_cb', __( 'Show Admin Bar Moderation Tool?', 'ultimate-facebook-comments' ), 'ufc_add_fmt_admin_bar_cb_display', 'ufc_plugin_global_section', 'ufc_plugin_option', array( 'label_for' => 'fbc-mt' ));  
        add_settings_field('ufc_remove_wp_comments_trace_cb', __( 'Disable Native WP Comment?', 'ultimate-facebook-comments' ), 'ufc_remove_wp_comments_trace_cb_display', 'ufc_plugin_global_section', 'ufc_plugin_option', array( 'label_for' => 'fbc-trace' ));  
        add_settings_field('ufc_enable_promo_cb', __( 'Support / Promote this Plugin?', 'ultimate-facebook-comments' ), 'ufc_enable_promo_cb_display', 'ufc_plugin_global_section', 'ufc_plugin_option', array( 'label_for' => 'fbc-promo' ));  
        add_settings_field('ufc_del_plugin_settings_cb', __( 'Delete Settings upon Uninstallation?', 'ultimate-facebook-comments' ), 'ufc_del_plugin_settings_cb_display', 'ufc_plugin_global_section', 'ufc_plugin_option', array( 'label_for' => 'ufc-delete' ));  
        
    // register settings
    register_setting('ufc_show_plugin_section', 'ufc_plugin_global_options');
}

?>