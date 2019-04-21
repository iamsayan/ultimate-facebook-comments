<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Ultimate Facebook Comments
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

function ufc_plugin_register_settings() {
    
    // start post fields
    add_settings_section('ufc_plugin_main_option', __( 'Main Options', 'wp-last-modified-info' ) . '<p><hr></p>', null, 'ufc_plugin_main_section');
        add_settings_field('ufc_enable_fb_comment_cb', __( 'Enable Facebook Comment?', 'ultimate-facebook-comments' ), 'ufc_enable_fb_comment_cb_display', 'ufc_plugin_main_section', 'ufc_plugin_main_option', array( 'label_for' => 'fbc-enable' ));  
        add_settings_field('ufc_facebook_comments_app_id', __( 'Enter Facebook Application ID:', 'ultimate-facebook-comments' ), 'ufc_facebook_comments_app_id_display', 'ufc_plugin_main_section', 'ufc_plugin_main_option', array( 'label_for' => 'appid' ));  
        add_settings_field('ufc_facebook_comments_app_secret', __( 'Enter Facebook Application Secret:', 'ultimate-facebook-comments' ), 'ufc_facebook_comments_app_secret_display', 'ufc_plugin_main_section', 'ufc_plugin_main_option', array( 'label_for' => 'appsecret' ));  
        
    add_settings_section('ufc_plugin_settings_option', __( 'Comments Settings', 'wp-last-modified-info' ) . '<p><hr></p>', null, 'ufc_plugin_settings_section');   
        add_settings_field('ufc_no_of_fb_comments', __( 'Number of Comments to Display:', 'ultimate-facebook-comments' ), 'ufc_no_of_fb_comments_display', 'ufc_plugin_settings_section', 'ufc_plugin_settings_option', array( 'label_for' => 'fbc-no' ));  
        add_settings_field('ufc_fb_comment_sorting', __( 'Sort Facebook Comments by:', 'ultimate-facebook-comments' ), 'ufc_fb_comment_sorting_display', 'ufc_plugin_settings_section', 'ufc_plugin_settings_option', array( 'label_for' => 'fb-comments-sort' ));
        add_settings_field('ufc_fb_comment_language', __( 'Facebook Comments Language:', 'ultimate-facebook-comments' ), 'ufc_fb_comment_language_display', 'ufc_plugin_settings_section', 'ufc_plugin_settings_option', array( 'label_for' => 'fb-comments-lang' ));
        add_settings_field('ufc_fb_comments_theme', __( 'Comments Box Color Scheme:', 'ultimate-facebook-comments' ), 'ufc_fb_comments_theme_display', 'ufc_plugin_settings_section', 'ufc_plugin_settings_option', array( 'label_for' => 'fb-comments-theme' ));
        add_settings_field('ufc_fb_comment_box_width', __( 'Comments Box Width (px):', 'ultimate-facebook-comments' ), 'ufc_fb_comment_box_width_display', 'ufc_plugin_settings_section', 'ufc_plugin_settings_option', array( 'label_for' => 'fb-comments-width' ));
        add_settings_field('ufc_load_fb_comment_url', __( 'Load Facebook Comments for URL:', 'ultimate-facebook-comments' ), 'ufc_load_fb_comment_url_display', 'ufc_plugin_settings_section', 'ufc_plugin_settings_option', array( 'label_for' => 'fbc-url' ));  
        
    add_settings_section('ufc_plugin_display_option', __( 'Display Options', 'wp-last-modified-info' ) . '<p><hr></p>', null, 'ufc_plugin_display_section');   
        add_settings_field('ufc_fb_comment_auto_display', __( 'Comments Display Method:', 'ultimate-facebook-comments' ), 'ufc_fb_comment_auto_display_display', 'ufc_plugin_display_section', 'ufc_plugin_display_option', array( 'label_for' => 'fb-comments-display' ));
        add_settings_field('ufc_fb_comment_loading_method', __( 'Comments Loading Method:', 'ultimate-facebook-comments' ), 'ufc_fb_comment_loading_method_display', 'ufc_plugin_display_section', 'ufc_plugin_display_option', array( 'label_for' => 'fb-comments-load', 'class' => 'fbc-loading' ));
        add_settings_field('ufc_enable_on_post_types', __( 'Enable Facebook Comments for:', 'ultimate-facebook-comments' ), 'ufc_enable_on_post_types_display', 'ufc_plugin_display_section', 'ufc_plugin_display_option', array( 'label_for' => 'post-types', 'class' => 'fbc-post-types' ));  
        add_settings_field('ufc_comment_area_class', __( 'Comments Area Div CSS Class:', 'ultimate-facebook-comments' ), 'ufc_comment_area_class_display', 'ufc_plugin_display_section', 'ufc_plugin_display_option', array( 'label_for' => 'fbc-area-class' ));  
        add_settings_field('ufc_fbc_area_bgcolor', __( 'Comments Background Color:', 'ultimate-facebook-comments' ), 'ufc_fbc_area_bgcolor_display', 'ufc_plugin_display_section', 'ufc_plugin_display_option', array( 'label_for' => 'fb-comments-bgcolor', 'class' => 'bgcolor' ));
        
    add_settings_section('ufc_plugin_title_option', __( 'Title Options', 'wp-last-modified-info' ) . '<p><hr></p>', null, 'ufc_plugin_title_section');     
        add_settings_field('ufc_fb_comment_msg', __( 'Facebook Comments Box Title:', 'ultimate-facebook-comments' ), 'ufc_fb_comment_msg_display', 'ufc_plugin_title_section', 'ufc_plugin_title_option', array( 'label_for' => 'fb-comments-msg' ));
        add_settings_field('ufc_custom_css_comment', __( 'Custom CSS Properties for Title:', 'ultimate-facebook-comments' ), 'ufc_custom_css_comment_display', 'ufc_plugin_title_section', 'ufc_plugin_title_option', array( 'label_for' => 'fbc-css' ));  
        
    add_settings_section('ufc_plugin_gdpr_option', __( 'GDPR Notice Options', 'wp-last-modified-info' ) . '<p><hr></p>', null, 'ufc_plugin_gdpr_section');    
        add_settings_field('ufc_fb_comment_consent_notice_cb', __( 'User Agreement Prior to Comment?', 'ultimate-facebook-comments' ), 'ufc_fb_comment_consent_notice_cb_display', 'ufc_plugin_gdpr_section', 'ufc_plugin_gdpr_option', array( 'label_for' => 'fbc-notice' ));
        add_settings_field('ufc_fb_comment_consent_notice_title', __( 'User Agreement Title:', 'ultimate-facebook-comments' ), 'ufc_fb_comment_consent_notice_title_display', 'ufc_plugin_gdpr_section', 'ufc_plugin_gdpr_option', array( 'label_for' => 'fbc-notice-title' ));
        add_settings_field('ufc_fb_comment_consent_notice_msg', __( 'User Agreement Description:', 'ultimate-facebook-comments' ), 'ufc_fb_comment_consent_notice_msg_display', 'ufc_plugin_gdpr_section', 'ufc_plugin_gdpr_option', array( 'label_for' => 'fbc-notice-msg' ));
        add_settings_field('ufc_fb_comment_user_agreement_btn', __( 'User Agreement Button - Accept:', 'ultimate-facebook-comments' ), 'ufc_fb_comment_user_agreement_btn_display', 'ufc_plugin_gdpr_section', 'ufc_plugin_gdpr_option', array( 'label_for' => 'fbc-notice-btn-agree' ));
        
    add_settings_section('ufc_plugin_notification_option', __( 'Email Notification Options', 'wp-last-modified-info' ) . '<p><hr></p>', null, 'ufc_plugin_notification_section');
        add_settings_field('ufc_enable_fbc_notification_cb', __( 'Enable Email Notification?', 'ultimate-facebook-comments' ), 'ufc_enable_fbc_notification_cb_display', 'ufc_plugin_notification_section', 'ufc_plugin_notification_option', array( 'label_for' => 'fbc-notienable' ));  
        add_settings_field('ufc_fbcn_name', __( 'Custom Email Sender Name:', 'ultimate-facebook-comments' ), 'ufc_fbcn_name_display', 'ufc_plugin_notification_section', 'ufc_plugin_notification_option', array( 'label_for' => 'fbcn-name' ));  
        add_settings_field('ufc_fbcn_email', __( 'Custom Email Sender Email:', 'ultimate-facebook-comments' ), 'ufc_fbcn_email_display', 'ufc_plugin_notification_section', 'ufc_plugin_notification_option', array( 'label_for' => 'fbcn-email' ));  
        add_settings_field('ufc_enable_fbcn_author_cb', __( 'Send Email to Post Author?', 'ultimate-facebook-comments' ), 'ufc_enable_fbcn_author_cb_display', 'ufc_plugin_notification_section', 'ufc_plugin_notification_option', array( 'label_for' => 'fbc-notiauthor' ));  
        add_settings_field('ufc_fbcn_template', __( 'Notification Email Template:', 'ultimate-facebook-comments' ), 'ufc_fbcn_template_display', 'ufc_plugin_notification_section', 'ufc_plugin_notification_option', array( 'label_for' => 'fbcn-template' ));  
        add_settings_field('ufc_fbcn_email_recipient', __( 'List of Email Recipient(s):', 'ultimate-facebook-comments' ), 'ufc_fbcn_email_recipient_display', 'ufc_plugin_notification_section', 'ufc_plugin_notification_option', array( 'label_for' => 'fbcn-email-receive' ));  
        add_settings_field('ufc_fbcn_email_subject', __( 'Notification Email Subject:', 'ultimate-facebook-comments' ), 'ufc_fbcn_email_subject_display', 'ufc_plugin_notification_section', 'ufc_plugin_notification_option', array( 'label_for' => 'fbcn-emailsub' ));  
        add_settings_field('ufc_fbcn_email_message', __( 'Notification Email Message:', 'ultimate-facebook-comments' ), 'ufc_fbcn_email_message_display', 'ufc_plugin_notification_section', 'ufc_plugin_notification_option', array( 'label_for' => 'fbcn-emailmsg' ));  
        
    add_settings_section('ufc_plugin_other_option', __( 'Others Options', 'wp-last-modified-info' ) . '<p><hr></p>', null, 'ufc_plugin_other_section');    
        add_settings_field('ufc_http_to_https_cb', __( 'Auto Fix HTTP to HTTPS Migration?', 'ultimate-facebook-comments' ), 'ufc_http_to_https_cb_display', 'ufc_plugin_other_section', 'ufc_plugin_other_option', array( 'label_for' => 'fbc-https' ));  
        add_settings_field('ufc_add_fmt_admin_bar_cb', __( 'Show Admin Bar Moderation Tool?', 'ultimate-facebook-comments' ), 'ufc_add_fmt_admin_bar_cb_display', 'ufc_plugin_other_section', 'ufc_plugin_other_option', array( 'label_for' => 'fbc-mt' ));  
        add_settings_field('ufc_remove_wp_comments_trace_cb', __( 'Disable Native WP Comment?', 'ultimate-facebook-comments' ), 'ufc_remove_wp_comments_trace_cb_display', 'ufc_plugin_other_section', 'ufc_plugin_other_option', array( 'label_for' => 'fbc-trace' ));  
        add_settings_field('ufc_enable_promo_cb', __( 'Support / Promote this Plugin?', 'ultimate-facebook-comments' ), 'ufc_enable_promo_cb_display', 'ufc_plugin_other_section', 'ufc_plugin_other_option', array( 'label_for' => 'fbc-promo' ));  
        add_settings_field('ufc_del_plugin_settings_cb', __( 'Delete Settings upon Uninstallation?', 'ultimate-facebook-comments' ), 'ufc_del_plugin_settings_cb_display', 'ufc_plugin_other_section', 'ufc_plugin_other_option', array( 'label_for' => 'ufc-delete' ));  
    
    // register settings
    register_setting('ufc_show_plugin_section', 'ufc_plugin_global_options');
}

?>