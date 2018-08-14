<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @category   HTML
 * @package    Ultimate WordPress Comments
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

function ufc_enable_fb_comment_cb_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>   <label class="switch">
         <input type="checkbox" id="fbc-enable" name="ufc_plugin_global_options[ufc_enable_fb_comment_cb]" value="1" <?php checked(isset($options['ufc_enable_fb_comment_cb']), 1); ?> /> 
         <div class="slider round"></div></label>&nbsp;&nbsp;<span class="tooltip" title="Enable this if you want to enable facebook comments for posts and pages."><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_facebook_comments_app_id_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>  <input id="appid" name="ufc_plugin_global_options[ufc_facebook_comments_app_id]" type="text" size="35" style="width:35%;" required placeholder="Enter facebook app id" value="<?php if (isset($options['ufc_facebook_comments_app_id'])) { echo $options['ufc_facebook_comments_app_id']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="Enter facebook app id."><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_no_of_fb_comments_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( empty($options['ufc_no_of_fb_comments']) ) {
        $options['ufc_no_of_fb_comments'] = '10';
    }
    ?>  <input id="fbc-no" name="ufc_plugin_global_options[ufc_no_of_fb_comments]" type="number" min="1" size="10" style="width:10%;" required placeholder="2586647663138" value="<?php if (isset($options['ufc_no_of_fb_comments'])) { echo $options['ufc_no_of_fb_comments']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="Enter the number of facebook comments to display in comment box."><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_fb_comment_sorting_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( !isset($options['ufc_fb_comment_sorting']) ) {
        $options['ufc_fb_comment_sorting'] = 'Social Ranking';
    }
    $items = array("Social Ranking", "Time", "Reverse Time");
    echo '<select id="fb-comments-sort" name="ufc_plugin_global_options[ufc_fb_comment_sorting]" style="width:25%;">';
    foreach($items as $item) {
        $selected = ($options['ufc_fb_comment_sorting'] == $item) ? 'selected="selected"' : '';
        echo '<option value="' . $item . '" ' . $selected . '>' . $item . '</option>';
    }
    echo '</select>';
?>&nbsp;&nbsp;<span class="tooltip" title="Select the facebook comment sorting method from here."><span title="" class="dashicons dashicons-editor-help"></span></span>
<?php
}

function ufc_fb_comment_language_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( empty($options['ufc_fb_comment_language']) ) {
        $options['ufc_fb_comment_language'] = 'en_US';
    } ?>
    <input id="fb-comments-lang" name="ufc_plugin_global_options[ufc_fb_comment_language]" type="text" size="15" style="width:15%" required placeholder="en_US" value="<?php if (isset($options['ufc_fb_comment_language'])) { echo $options['ufc_fb_comment_language']; } ?>" />
    &nbsp;&nbsp;<span class="tooltip" title="Select in which language you want to load facebook sdk. e.g. en_US, de_DE, es_ES"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}    

function ufc_fb_comments_theme_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( !isset($options['ufc_fb_comments_theme']) ) {
        $options['ufc_fb_comments_theme'] = 'Light';
    }
    $items = array("Light", "Dark");
    echo '<select id="fb-comments-theme" name="ufc_plugin_global_options[ufc_fb_comments_theme]" style="width:18%;">';
        foreach($items as $item) {
        $selected = ($options['ufc_fb_comments_theme'] == $item) ? 'selected="selected"' : '';
        echo '<option value="' . $item . '" ' . $selected . '>' . $item . '</option>';
    }
    echo '</select>';
?>&nbsp;&nbsp;<span class="tooltip" title="Select the theme of facebook comments box from here."><span title="" class="dashicons dashicons-editor-help"></span></span>
<?php
}

function ufc_fb_comment_box_width_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( empty($options['ufc_fb_comment_box_width']) ) {
        $options['ufc_fb_comment_box_width'] = '100%';
    } ?>
    <input id="fb-comments-width" name="ufc_plugin_global_options[ufc_fb_comment_box_width]" type="text" size="12" style="width:12%" required placeholder="100%" value="<?php if (isset($options['ufc_fb_comment_box_width'])) { echo $options['ufc_fb_comment_box_width']; } ?>" />
    &nbsp;&nbsp;<span class="tooltip" title="Set facebook comment box width(px)."><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_fb_comment_auto_display_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( !isset($options['ufc_fb_comment_auto_display']) ) {
        $options['ufc_fb_comment_auto_display'] = 'Replace Native Comment';
    }
    $items = array( "Replace Native Comment", "After Content" );
    echo '<select id="fb-comments-display" name="ufc_plugin_global_options[ufc_fb_comment_auto_display]" style="width:35%;">';
        foreach($items as $item) {
        $selected = ($options['ufc_fb_comment_auto_display'] == $item) ? 'selected="selected"' : '';
        echo '<option value="' . $item . '" ' . $selected . '>' . $item . '</option>';
    }
    echo '</select>';

    ?><span id="fbc-override-span"><span id="fb-comments-override-span" style="display:none;">&nbsp;&nbsp;&nbsp;<label for="fb-comments-override"><strong><?php _e( 'Select:', 'ultimate-facebook-comments' ); ?></strong></label>&nbsp;&nbsp;
    <?php

    if( !isset($options['ufc_fb_comment_box_override']) ) {
        $options['ufc_fb_comment_box_override'] = 'Show Facebook Comments';
    }
    $items = array("Show Facebook Comments", "Show both Comments");
    echo '<select id="fb-comments-override" name="ufc_plugin_global_options[ufc_fb_comment_box_override]" style="width:38%;">';
        foreach($items as $item) {
        $selected = ($options['ufc_fb_comment_box_override'] == $item) ? 'selected="selected"' : '';
        echo '<option value="' . $item . '" ' . $selected . '>' . $item . '</option>';
    }
    echo '</select>';
    
    ?></label></span></span>&nbsp;&nbsp;
    <span class="tooltip" title="Select the position where you want to display facebook comment box."><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_fbc_area_bgcolor_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>  <input id="fb-comments-bgcolor" name="ufc_plugin_global_options[ufc_fbc_area_bgcolor]" type="text" class="ufc-color-picker" placeholder="#fff" value="<?php if (isset($options['ufc_fbc_area_bgcolor'])) { echo $options['ufc_fbc_area_bgcolor']; } ?>" />
    <?php
}

function ufc_fb_comment_loading_method_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( !isset($options['ufc_fb_comment_loading_method']) ) {
        $options['ufc_fb_comment_loading_method'] = 'Default';
    }
    $items = array("Default", "On Scroll", "On Click");
    echo '<select id="fb-comments-load" name="ufc_plugin_global_options[ufc_fb_comment_loading_method]" style="width:16%;">';
        foreach($items as $item) {
        $selected = ($options['ufc_fb_comment_loading_method'] == $item) ? 'selected="selected"' : '';
        echo '<option value="' . $item . '" ' . $selected . '>' . $item . '</option>';
    }
    echo '</select>';

    ?><span id="fbc-on-click" style="display:none;">&nbsp;&nbsp;&nbsp;<label for="fbc-button-text"><strong><?php _e( 'Button Text:', 'ultimate-facebook-comments' ); ?></strong></label>&nbsp;&nbsp;
    
    <?php
    if( empty($options['ufc_loading_button_text']) ) {
        $options['ufc_loading_button_text'] = 'Leave a Comment';
    } ?>
    
    <input id="fbc-button-text" name="ufc_plugin_global_options[ufc_loading_button_text]" type="text" size="26" style="width:26%" placeholder="Leave a Comment" required value="<?php if (isset($options['ufc_loading_button_text'])) { echo $options['ufc_loading_button_text']; } ?>" />
    
    &nbsp;&nbsp;<label for="fbc-button-class"><strong><?php _e( 'Class:', 'ultimate-facebook-comments' ); ?></strong></label>&nbsp;&nbsp;
    <input id="fbc-button-class" name="ufc_plugin_global_options[ufc_loading_button_class]" type="text" size="20" style="width:20%" placeholder="btn button" value="<?php if (isset($options['ufc_loading_button_class'])) { echo $options['ufc_loading_button_class']; } ?>" />
    
    </span>&nbsp;&nbsp;<span class="tooltip" title="Select how you want to load facebook comments box from here. On Scroll or On Click method improves your page speed."><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_comment_area_class_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( empty($options['ufc_comment_area_class']) ) {
        $options['ufc_comment_area_class'] = 'ufc-comments-area';
    } ?>
    <input id="fbc-area-class" name="ufc_plugin_global_options[ufc_comment_area_class]" type="text" size="45" style="width:45%" placeholder="ufc-comments-area" value="<?php if (isset($options['ufc_comment_area_class'])) { echo $options['ufc_comment_area_class']; } ?>" />
    
    <? if( empty($options['ufc_comment_area_id']) ) {
        $options['ufc_comment_area_id'] = 'ufc-comments';
    } ?>
    &nbsp;&nbsp;<label for="fbc-box-id"><strong><?php _e( 'ID:', 'ultimate-facebook-comments' ); ?></strong></label>&nbsp;&nbsp;
    <input id="fbc-box-id" name="ufc_plugin_global_options[ufc_comment_area_id]" type="text" size="35" style="width:35%" placeholder="ufc-comments" value="<?php if (isset($options['ufc_comment_area_id'])) { echo $options['ufc_comment_area_id']; } ?>" />
    
    &nbsp;&nbsp;<span class="tooltip" title="Set comment area css class and ID to match facebook comment area with your theme."><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_load_fb_comment_url_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( !isset($options['ufc_load_fb_comment_url']) ) {
        $options['ufc_load_fb_comment_url'] = 'Default';
    }
    $items = array("Default", "Homepage", "Custom URL");
    echo '<select id="fbc-url" name="ufc_plugin_global_options[ufc_load_fb_comment_url]" style="width:22%;">';
        foreach($items as $item) {
        $selected = ($options['ufc_load_fb_comment_url'] == $item) ? 'selected="selected"' : '';
        echo '<option value="' . $item . '" ' . $selected . '>' . $item . '</option>';
    }
    echo '</select>';
?>
<span id="fbc-curl-show" style="display:none;">&nbsp;&nbsp;&nbsp;<label for="fbc-curl"><strong><?php _e( 'Custom URL:', 'ultimate-facebook-comments' ); ?></strong></label>&nbsp;&nbsp;<input id="fbc-curl" name="ufc_plugin_global_options[ufc_load_fb_comment_custom_url]" type="url" size="50" style="width:50%" placeholder="<?php echo get_site_url(); ?>" value="<?php if (isset($options['ufc_load_fb_comment_custom_url'])) { echo $options['ufc_load_fb_comment_custom_url']; } ?>" />
</span>&nbsp;&nbsp;<span class="tooltip" title="Select the url which you want to load in facebook comment."><span title="" class="dashicons dashicons-editor-help"></span></span>
<?php
}

function ufc_fb_comment_msg_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?><input id="fb-comments-msg" name="ufc_plugin_global_options[ufc_fb_comment_msg]" type="text" size="40" style="width:40%" placeholder="Leave a Reply" value="<?php if (isset($options['ufc_fb_comment_msg'])) { echo $options['ufc_fb_comment_msg']; } ?>" />
    <span id="fb-comments-msg-align-show">&nbsp;&nbsp;&nbsp;<label for="fb-comments-msg-align"><strong><?php _e( 'Align:', 'ultimate-facebook-comments' ); ?></strong></label>&nbsp;
    
    <?php 
    if( !isset($options['ufc_fb_comment_msg_align']) ) {
        $options['ufc_fb_comment_msg_align'] = 'Left';
    }
    $items = array("Left", "Center", "Right");
    echo '<select id="fb-comments-msg-align" name="ufc_plugin_global_options[ufc_fb_comment_msg_align]" style="width:20%;">';
        foreach($items as $item) {
        $selected = ($options['ufc_fb_comment_msg_align'] == $item) ? 'selected="selected"' : '';
        echo '<option value="' . $item . '" ' . $selected . '>' . $item . '</option>';
    }
    echo '</select>';
    ?>    
    </span>&nbsp;&nbsp;<span class="tooltip" title="Set a custom text which you want to display before facebook comment box."><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_custom_css_comment_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>
    <textarea id="fbc-css" name="ufc_plugin_global_options[ufc_custom_css_comment]" rows="4" cols="95" placeholder="e.g. color:red; font-size:14px;" style="width:95%"><?php if (isset($options['ufc_custom_css_comment'])) { echo $options['ufc_custom_css_comment']; } ?></textarea>
    <br><small>Just write any css property to set custom style for comment box title.</small>
    <?php
}

function ufc_enable_on_post_types_display() {
    $options = get_option('ufc_plugin_global_options');
    
    if( !isset($options['ufc_enable_on_post_types']) ) {
        $options['ufc_enable_on_post_types'][] = '';
    }

    $post_types = get_post_types(array(
        'public'   => true,
    ), 'names'); 

    echo '<select id="post-types" name="ufc_plugin_global_options[ufc_enable_on_post_types][]" multiple="multiple" required style="width:85%;">';
    foreach($post_types as $item) {
        $selected = in_array( $item, $options['ufc_enable_on_post_types'] ) ? 'selected="selected"' : '';
        echo '<option value="' . $item . '" ' . $selected . '>' . $item . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="Select post types where you want to show facebook comment box."><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_fb_comment_consent_notice_cb_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>  <label class="switch">
        <input type="checkbox" id="fbc-notice" name="ufc_plugin_global_options[ufc_fb_comment_consent_notice_cb]" value="1" <?php checked(isset($options['ufc_fb_comment_consent_notice_cb']), 1); ?> /> 
        <div class="slider round"></div></label>&nbsp;&nbsp;<span class="tooltip" title="Enable this if you want to show a cookie consent related to facebook comments to your site's first time visitor. If they accept this notice, then only they can post comments."><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_fb_comment_consent_notice_title_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( empty($options['ufc_fb_comment_consent_notice_title']) ) {
        $options['ufc_fb_comment_consent_notice_title'] = 'Action Required!';
    }
    ?>  <input id="fbc-notice-title" name="ufc_plugin_global_options[ufc_fb_comment_consent_notice_title]" type="text" size="50" style="width:50%" placeholder="Action Required!" value="<?php if (isset($options['ufc_fb_comment_consent_notice_title'])) { echo $options['ufc_fb_comment_consent_notice_title']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="Set title for notice/message/cookie consent of your website."><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_fb_comment_consent_notice_msg_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( empty($options['ufc_fb_comment_consent_notice_msg']) ) {
        $options['ufc_fb_comment_consent_notice_msg'] = 'We embed Facebook Comments plugin to allow you to leave comment at our website using your Facebook account. It may collects your IP address, your web browser User Agent, store and retrieve cookies on your browser, embed additional tracking, and monitor your interaction with the commenting interface, including correlating your Facebook account with whatever action you take within the interface (such as “liking” someone’s comment, replying to other comments), if you are logged into Facebook. For more information about how this data may be used, please see Facebook’s data privacy policy: https://www.facebook.com/about/privacy/update.';
    } ?>
    <textarea id="fbc-notice-msg" name="ufc_plugin_global_options[ufc_fb_comment_consent_notice_msg]" rows="8" cols="95" placeholder="" style="width:95%"><?php if (isset($options['ufc_fb_comment_consent_notice_msg'])) { echo $options['ufc_fb_comment_consent_notice_msg']; } ?></textarea>
    <br><small>Write here the notice/message which you want to show as consent to your first time commenter.</small>
    <?php
}

function ufc_show_comment_count_cb_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>   <label class="switch">
         <input type="checkbox" id="fbc-count" name="ufc_plugin_global_options[ufc_show_comment_count_cb]" value="1" <?php checked(isset($options['ufc_show_comment_count_cb']), 1); ?> /> 
         <div class="slider round"></div></label>&nbsp;&nbsp;<span class="tooltip" title="Enable this if you want to show comment counts on individual posts in edit.php page. This function may decrease edit.php page loading time as it fetchs comment count directly from facebook api on overy page load."><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_add_fmt_admin_bar_cb_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>   <label class="switch">
         <input type="checkbox" id="fbc-mt" name="ufc_plugin_global_options[ufc_add_fmt_admin_bar_cb]" value="1" <?php checked(isset($options['ufc_add_fmt_admin_bar_cb']), 1); ?> /> 
         <div class="slider round"></div></label>&nbsp;&nbsp;<span class="tooltip" title="Enable this if you want to add a link on wordpress admin bar to view facebbook comment moderation tool directly from admin area."><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_remove_wp_comments_trace_cb_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>   <label class="switch">
         <input type="checkbox" id="fbc-trace" name="ufc_plugin_global_options[ufc_remove_wp_comments_trace_cb]" value="1" <?php checked(isset($options['ufc_remove_wp_comments_trace_cb']), 1); ?> /> 
         <div class="slider round"></div></label>&nbsp;&nbsp;<span class="tooltip" title="Enable this if you want to disable wordpress native comment completely from both frontend and backend."><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_enable_promo_cb_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>   <label class="switch">
         <input type="checkbox" id="fbc-promo" name="ufc_plugin_global_options[ufc_enable_promo_cb]" value="1" <?php checked(isset($options['ufc_enable_promo_cb']), 1); ?> /> 
         <div class="slider round"></div></label>&nbsp;&nbsp;<span class="tooltip" title="Please enable this option to help Ultimate Facebook Comments get more popularity as your thank to the hard work I do for you totally free. This option adds a text under the comment section which will allow your site visitors recognize the name of comment solution you use. Thank you!"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_del_plugin_settings_cb_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>   <label class="switch">
         <input type="checkbox" id="ufc-delete" name="ufc_plugin_global_options[ufc_del_plugin_settings_cb]" value="1" <?php checked(isset($options['ufc_del_plugin_settings_cb']), 1); ?> /> 
         <div class="slider round"></div></label>&nbsp;&nbsp;<span class="tooltip" title="Enable this option if you want to delete all plugin settings from your database at the time of plugin uninstallation"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

?>