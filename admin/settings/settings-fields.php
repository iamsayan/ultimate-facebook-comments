<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Ultimate Facebook Comments
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

###############################################################
#########################    Main    ##########################
###############################################################

function ufc_enable_fb_comment_cb_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>   <label class="switch">
         <input type="checkbox" id="fbc-enable" name="ufc_plugin_global_options[ufc_enable_fb_comment_cb]" value="1" <?php checked(isset($options['ufc_enable_fb_comment_cb']), 1); ?> /> 
         <div class="slider round"></div></label>&nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Enable this if you want to enable facebook comments for posts and pages.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_facebook_comments_app_id_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>  <input id="appid" name="ufc_plugin_global_options[ufc_facebook_comments_app_id]" type="number" size="35" style="width:35%;" required placeholder="Enter facebook app id" value="<?php if (isset($options['ufc_facebook_comments_app_id'])) { echo $options['ufc_facebook_comments_app_id']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Enter facebook App ID that you get from Facebook Developers.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_facebook_comments_app_secret_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>  <input id="appsecret" name="ufc_plugin_global_options[ufc_facebook_comments_app_secret]" type="password" size="35" style="width:35%;" required placeholder="Enter facebook app secret" value="<?php if (isset($options['ufc_facebook_comments_app_secret'])) { echo $options['ufc_facebook_comments_app_secret']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Enter facebook App Secret that you get from Facebook Developers.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

###############################################################
#######################    Settings    ########################
###############################################################

function ufc_no_of_fb_comments_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( empty($options['ufc_no_of_fb_comments']) ) {
        $options['ufc_no_of_fb_comments'] = '10';
    }
    ?>  <input id="fbc-no" name="ufc_plugin_global_options[ufc_no_of_fb_comments]" type="number" min="1" size="25" style="width:25%;" required placeholder="10" value="<?php if (isset($options['ufc_no_of_fb_comments'])) { echo $options['ufc_no_of_fb_comments']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Enter the number of facebook comments to display as default in comment box.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_fb_comment_sorting_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( !isset($options['ufc_fb_comment_sorting']) ) {
        $options['ufc_fb_comment_sorting'] = 'social';
    }
    $items = array(
        'social'        => __( 'Social Ranking', 'ultimate-facebook-comments' ),
        'time'          => __( 'Oldest', 'ultimate-facebook-comments' ),
        'reverse_time'  => __( 'Newest', 'ultimate-facebook-comments' )
    );
    echo '<select id="fb-comments-sort" name="ufc_plugin_global_options[ufc_fb_comment_sorting]" style="width:25%;">';
    foreach( $items as $item => $label ) {
        $selected = ($options['ufc_fb_comment_sorting'] == $item) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
?>&nbsp;&nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Select the facebook comment sorting method from here.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
<?php
}

function ufc_fb_comment_language_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( !isset($options['ufc_fb_comment_language']) ) {
        $options['ufc_fb_comment_language'] = 'en_US';
    }
    $items = array('en_US', 'ca_ES', 'cs_CZ', 'cx_PH', 'cy_GB', 'da_DK', 'de_DE', 'eu_ES', 'en_UD', 'es_LA', 'es_ES', 'gn_PY', 'fi_FI', 'fr_FR', 'gl_ES', 'hu_HU', 'it_IT', 'ja_JP', 'ko_KR', 'nb_NO', 'nn_NO', 'nl_NL', 'fy_NL', 'pl_PL', 'pt_BR', 'pt_PT', 'ro_RO', 'ru_RU', 'sk_SK', 'sl_SI', 'sv_SE', 'th_TH', 'tr_TR', 'ku_TR', 'zh_CN', 'zh_HK', 'zh_TW', 'af_ZA', 'sq_AL', 'hy_AM', 'az_AZ', 'be_BY', 'bn_IN', 'bs_BA', 'bg_BG', 'hr_HR', 'nl_BE', 'en_GB', 'et_EE', 'fo_FO', 'fr_CA', 'ka_GE', 'el_GR', 'gu_IN', 'hi_IN', 'is_IS', 'id_ID', 'ga_IE', 'jv_ID', 'kn_IN', 'kk_KZ', 'lv_LV', 'lt_LT', 'mk_MK', 'mg_MG', 'ms_MY', 'mt_MT', 'mr_IN', 'mn_MN', 'ne_NP', 'pa_IN', 'sr_RS', 'so_SO', 'sw_KE', 'tl_PH', 'ta_IN', 'te_IN', 'ml_IN', 'uk_UA', 'uz_UZ', 'vi_VN', 'km_KH', 'tg_TJ', 'ar_AR', 'he_IL', 'ur_PK', 'fa_IR', 'ps_AF', 'my_MM', 'qz_MM', 'or_IN', 'si_LK', 'rw_RW', 'cb_IQ', 'ha_NG', 'ja_KS', 'br_FR', 'tz_MA', 'co_FR', 'as_IN', 'ff_NG', 'sc_IT', 'sz_PL');
    echo '<select id="fb-comments-lang" name="ufc_plugin_global_options[ufc_fb_comment_language]" style="width:25%;">';
        foreach( $items as $item ) {
        $selected = ($options['ufc_fb_comment_language'] == $item) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $item . '</option>';
    }
    echo '</select>';
?>&nbsp;&nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Select in which language you want to load facebook sdk. e.g. en_US, de_DE, es_ES.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
<?php
}

function ufc_fb_comments_theme_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( !isset($options['ufc_fb_comments_theme']) ) {
        $options['ufc_fb_comments_theme'] = 'light';
    }
    $items = array(
        'light'  => __( 'Light', 'ultimate-facebook-comments' ),
        'dark'   => __( 'Dark', 'ultimate-facebook-comments' )
    );
    echo '<select id="fb-comments-theme" name="ufc_plugin_global_options[ufc_fb_comments_theme]" style="width:25%;">';
        foreach( $items as $item => $label ) {
        $selected = ($options['ufc_fb_comments_theme'] == $item) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
?>&nbsp;&nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Select the theme of facebook comments box from here.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
<?php
}

function ufc_fb_comment_box_width_display() {
    $options = get_option( 'ufc_plugin_global_options' ); ?>
    <input id="fb-comments-width" name="ufc_plugin_global_options[ufc_fb_comment_box_width]" type="text" size="25" style="width:25%" placeholder="Default 100%" value="<?php if (isset($options['ufc_fb_comment_box_width'])) { echo $options['ufc_fb_comment_box_width']; } ?>" />
    &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Set facebook comment box width. Keep at this to ensure the comment box is responsive. Minimun is 320. Leave empty for responsive 100%.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_load_fb_comment_url_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( !isset($options['ufc_load_fb_comment_url']) ) {
        $options['ufc_load_fb_comment_url'] = 'default';
    }
    $items = array(
        'default'     => __( 'Default', 'ultimate-facebook-comments' ),
        'homepage'    => __( 'Homepage', 'ultimate-facebook-comments' ),
        'custom_url'  => __( 'Custom URL', 'ultimate-facebook-comments' )
    );
    echo '<select id="fbc-url" name="ufc_plugin_global_options[ufc_load_fb_comment_url]" style="width:25%;">';
        foreach( $items as $item => $label ) {
        $selected = ($options['ufc_load_fb_comment_url'] == $item) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    <span id="fbc-curl-show" style="display:none;">&nbsp;&nbsp;&nbsp;<label for="fbc-curl"><strong><?php _e( 'URL:', 'ultimate-facebook-comments' ); ?></strong></label>&nbsp;&nbsp;<input id="fbc-curl" name="ufc_plugin_global_options[ufc_load_fb_comment_custom_url]" type="url" size="35" style="width:35%" placeholder="<?php echo get_site_url(); ?>" value="<?php if (isset($options['ufc_load_fb_comment_custom_url'])) { echo $options['ufc_load_fb_comment_custom_url']; } ?>" />
    </span>&nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Select the url which you want to load in facebook comment.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_comment_load_compatibility_mode_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( !isset($options['ufc_comment_load_compatibility_mode']) ) {
        $options['ufc_comment_load_compatibility_mode'] = 'default';
    }
    $items = array(
        'default'  => __( 'Normal Mode (Default)', 'ultimate-facebook-comments' ),
        'enable'   => __( 'Compatibility Mode', 'ultimate-facebook-comments' )
    );
    echo '<select id="fbc-compatible" name="ufc_plugin_global_options[ufc_comment_load_compatibility_mode]" style="width:25%;">';
        foreach( $items as $item => $label ) {
        $selected = ($options['ufc_comment_load_compatibility_mode'] == $item) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>&nbsp;&nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Select the Facebook SDK Loader Method from here. Compatiblity Mode option is useful, if you are using Facebook Messenger Chat or using any other facebook related plugin which uses Facebook SDK.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
<?php
}

###############################################################
########################    Display    ########################
###############################################################

function ufc_fb_comment_auto_display_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( !isset($options['ufc_fb_comment_auto_display']) ) {
        $options['ufc_fb_comment_auto_display'] = 'replace_native_comment';
    }
    $items = array(
        'replace_native_comment'   => __( 'Replace Native Comment', 'ultimate-facebook-comments' ),
        'after_content'            => __( 'After Content', 'ultimate-facebook-comments' ),
        'disable'                  => __( 'Disable (use shortcode)', 'ultimate-facebook-comments' )
    );
    echo '<select id="fb-comments-display" name="ufc_plugin_global_options[ufc_fb_comment_auto_display]" style="width:25%;">';
        foreach( $items as $item => $label ) {
        $selected = ($options['ufc_fb_comment_auto_display'] == $item) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';

    ?><span id="fb-comments-priority-span" style="display:none;">&nbsp;&nbsp;&nbsp;&nbsp;<label for="fb-comments-priority"><strong><?php _e( 'Display Priority:', 'ultimate-facebook-comments' ); ?></strong></label>&nbsp;&nbsp;
    <?php

    if( empty($options['ufc_fb_comment_priority']) ) {
        $options['ufc_fb_comment_priority'] = '99';
    } 
    ?>  <input id="fb-comments-priority" name="ufc_plugin_global_options[ufc_fb_comment_priority]" type="number" size="10" style="width:10%;" value="<?php if (isset($options['ufc_fb_comment_priority'])) { echo $options['ufc_fb_comment_priority']; } ?>" />
    </span>
    &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Select the position where you want to display facebook comment box. If you want to manually insert facebook comments to your all posts/pages select \'Disable\' option and use shortcode with attributes according to your need and for priority higher number causes Facebook Comments to appear below the other elements at the webpage.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_fb_comment_loading_method_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( !isset($options['ufc_fb_comment_loading_method']) ) {
        $options['ufc_fb_comment_loading_method'] = 'default';
    }
    $items = array(
        'default'   => __( 'Default', 'ultimate-facebook-comments' ),
        'on_scroll' => __( 'On Scroll', 'ultimate-facebook-comments' ),
        'on_click'  => __( 'On Click', 'ultimate-facebook-comments' )
    );
    echo '<select id="fb-comments-load" name="ufc_plugin_global_options[ufc_fb_comment_loading_method]" style="width:18%;">';
        foreach( $items as $item => $label ) {
        $selected = ($options['ufc_fb_comment_loading_method'] == $item) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>
    <span id="fbc-on-click" style="display:none;">&nbsp;&nbsp;<label for="fbc-button-text"><strong><?php _e( 'Button Text:', 'ultimate-facebook-comments' ); ?></strong></label>&nbsp;&nbsp;
        <?php if( empty($options['ufc_loading_button_text']) ) {
            $options['ufc_loading_button_text'] = 'Leave a Comment';
        } ?>
        <input id="fbc-button-text" name="ufc_plugin_global_options[ufc_loading_button_text]" type="text" size="24" style="width:24%" placeholder="<?php _e( 'Leave a Comment', 'ultimate-facebook-comments' ); ?>" required value="<?php if (isset($options['ufc_loading_button_text'])) { echo $options['ufc_loading_button_text']; } ?>" />
        
        <?php if( empty($options['ufc_loading_button_class']) ) {
            $options['ufc_loading_button_class'] = 'btn button';
        } ?>
        &nbsp;&nbsp;<label for="fbc-button-class"><strong><?php _e( 'CSS Class:', 'ultimate-facebook-comments' ); ?></strong></label>&nbsp;&nbsp;
        <input id="fbc-button-class" name="ufc_plugin_global_options[ufc_loading_button_class]" type="text" size="18" style="width:18%" placeholder="btn button" value="<?php if (isset($options['ufc_loading_button_class'])) { echo $options['ufc_loading_button_class']; } ?>" />
    </span>
    &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Select how you want to load facebook comments box from here. If you select On Scroll or On Click, comments will be lazy loaded using this method and it improves your page speed.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_enable_on_post_types_display() {
    $options = get_option('ufc_plugin_global_options');
    
    if( !isset($options['ufc_enable_on_post_types']) ) {
        $options['ufc_enable_on_post_types'][] = 'post';
    }

    $post_types = get_post_types(array(
        'public'   => true,
    ), 'names'); 

    echo '<select id="post-types" name="ufc_plugin_global_options[ufc_enable_on_post_types][]" multiple="multiple" required style="width:80%;">';
    foreach( $post_types as $item ) {
        $selected = in_array( $item, $options['ufc_enable_on_post_types'] ) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $item . '</option>';
    }
    echo '</select>';
    ?>
    &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Select post types where you want to show facebook comment box.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_comment_area_class_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( empty($options['ufc_comment_area_class']) ) {
        $options['ufc_comment_area_class'] = 'ufc-comments-area';
    } ?>
    <input id="fbc-area-class" name="ufc_plugin_global_options[ufc_comment_area_class]" type="text" size="25" style="width:25%" placeholder="ufc-comments-area" value="<?php if (isset($options['ufc_comment_area_class'])) { echo $options['ufc_comment_area_class']; } ?>" />
    
    <? if( empty($options['ufc_comment_area_id']) ) {
        $options['ufc_comment_area_id'] = 'ufc-comments';
    } ?>
    &nbsp;&nbsp;<label for="fbc-box-id"><strong><?php _e( 'Div ID:', 'ultimate-facebook-comments' ); ?></strong></label>&nbsp;&nbsp;
    <input id="fbc-box-id" name="ufc_plugin_global_options[ufc_comment_area_id]" type="text" size="25" style="width:25%" placeholder="ufc-comments" value="<?php if (isset($options['ufc_comment_area_id'])) { echo $options['ufc_comment_area_id']; } ?>" />
    
    &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Set comment area css class and ID to match facebook comment area with your theme.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_fbc_area_bgcolor_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>  <input id="fb-comments-bgcolor" name="ufc_plugin_global_options[ufc_fbc_area_bgcolor]" type="text" class="ufc-color-picker" placeholder="#fff" value="<?php if (isset($options['ufc_fbc_area_bgcolor'])) { echo $options['ufc_fbc_area_bgcolor']; } ?>" />
    <?php
}

###############################################################
#########################    Title    #########################
###############################################################

function ufc_fb_comment_msg_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?><input id="fb-comments-msg" name="ufc_plugin_global_options[ufc_fb_comment_msg]" type="text" size="35" style="width:35%" placeholder="<?php _e( 'Leave a Reply (leave it blank for no title)', 'ultimate-facebook-comments' ); ?>" value="<?php if (isset($options['ufc_fb_comment_msg'])) { echo $options['ufc_fb_comment_msg']; } ?>" />
    <span id="fb-comments-msg-align-show">&nbsp;&nbsp;&nbsp;<label for="fb-comments-msg-align"><strong><?php _e( 'Align:', 'ultimate-facebook-comments' ); ?></strong></label>&nbsp;
    
    <?php 
    if( !isset($options['ufc_fb_comment_msg_align']) ) {
        $options['ufc_fb_comment_msg_align'] = 'left';
    }
    $items = array(
        'left'   => __( 'Left', 'ultimate-facebook-comments' ),
        'center' => __( 'Center', 'ultimate-facebook-comments' ),
        'right'  => __( 'Right', 'ultimate-facebook-comments' )
    );
    echo '<select id="fb-comments-msg-align" name="ufc_plugin_global_options[ufc_fb_comment_msg_align]" style="width:12%;margin-top:-2px;">';
        foreach( $items as $item => $label ) {
        $selected = ($options['ufc_fb_comment_msg_align'] == $item) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>    
    </span>
    
    <span id="fb-comments-title-html">&nbsp;&nbsp;&nbsp;<label for="fb-comments-title-html-tag"><strong><?php _e( 'HTML Tag:', 'ultimate-facebook-comments' ); ?></strong></label>&nbsp;
    <?php 
    if( !isset($options['ufc_fb_comment_title_html_tag']) ) {
        $options['ufc_fb_comment_title_html_tag'] = 'div';
    }
    $items = array(
        'h1'   => 'h1',
        'h2'   => 'h2',
        'h3'   => 'h3',
        'h4'   => 'h4',
        'h5'   => 'h5',
        'h6'   => 'h6',
        'span' => 'span',
        'div'  => 'div'
    );
    echo '<select id="fb-comments-title-html-tag" name="ufc_plugin_global_options[ufc_fb_comment_title_html_tag]" style="width:10%;margin-top:-2px;">';
        foreach( $items as $item => $label ) {
        $selected = ($options['ufc_fb_comment_title_html_tag'] == $item) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
    ?>    
    </span>
    &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Set a custom text which you want to display before facebook comment box.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_custom_css_comment_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>
    <textarea id="fbc-css" name="ufc_plugin_global_options[ufc_custom_css_comment]" rows="4" cols="75" placeholder="e.g. color:red; font-size:14px;" style="width:80%"><?php if (isset($options['ufc_custom_css_comment'])) { echo $options['ufc_custom_css_comment']; } ?></textarea>
    <br><small><?php _e( 'Just write any css property to set custom style for comment box title.', 'ultimate-facebook-comments' ); ?></small>
    <?php
}

###############################################################
#########################    Notice    ########################
###############################################################

function ufc_fb_comment_consent_notice_cb_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>  <label class="switch">
        <input type="checkbox" id="fbc-notice" name="ufc_plugin_global_options[ufc_fb_comment_consent_notice_cb]" value="1" <?php checked(isset($options['ufc_fb_comment_consent_notice_cb']), 1); ?> /> 
        <div class="slider round"></div></label>&nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'If this option is enabled, facebook comments box become hidden until user accept user agreement based on his/her facebook account shared information. This user agreement will be displayed when a user first time visit your website until they do not accept the user agreement. This extra step is added to comply with the GDPR. You also need to update your website\'s privacy policy.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_fb_comment_consent_notice_title_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( empty($options['ufc_fb_comment_consent_notice_title']) ) {
        $options['ufc_fb_comment_consent_notice_title'] = 'Action Required!';
    }
    ?>  <input id="fbc-notice-title" name="ufc_plugin_global_options[ufc_fb_comment_consent_notice_title]" type="text" size="40" style="width:40%" placeholder="<?php _e( 'Action Required!', 'ultimate-facebook-comments' ); ?>" value="<?php if (isset($options['ufc_fb_comment_consent_notice_title'])) { echo $options['ufc_fb_comment_consent_notice_title']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Set title for notice/message/cookie consent of your website.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_fb_comment_consent_notice_msg_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( empty($options['ufc_fb_comment_consent_notice_msg']) ) {
        $options['ufc_fb_comment_consent_notice_msg'] = 'We embed Facebook Comments plugin to allow you to leave comment at our website using your Facebook account. It may collects your IP address, your web browser User Agent, store and retrieve cookies on your browser, embed additional tracking, and monitor your interaction with the commenting interface, including correlating your Facebook account with whatever action you take within the interface (such as “liking” someone’s comment, replying to other comments), if you are logged into Facebook. For more information about how this data may be used, please see Facebook’s data privacy policy: https://www.facebook.com/about/privacy/update.';
    } ?>
    <textarea id="fbc-notice-msg" name="ufc_plugin_global_options[ufc_fb_comment_consent_notice_msg]" rows="6" cols="95" placeholder="" style="width:95%"><?php if (isset($options['ufc_fb_comment_consent_notice_msg'])) { echo $options['ufc_fb_comment_consent_notice_msg']; } ?></textarea>
    <br><small><?php _e( 'Write here the notice/message which you want to show as consent to your first time commenter.', 'ultimate-facebook-comments' ); ?></small>
    <?php
}

function ufc_fb_comment_user_agreement_btn_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( empty($options['ufc_fb_comment_user_agreement_btn']) ) {
        $options['ufc_fb_comment_user_agreement_btn'] = 'Accept';
    }
    if( empty($options['ufc_fb_comment_user_agreement_decline_btn']) ) {
        $options['ufc_fb_comment_user_agreement_decline_btn'] = 'Decline';
    }
    ?>  <input id="fbc-notice-btn-agree" name="ufc_plugin_global_options[ufc_fb_comment_user_agreement_btn]" type="text" size="38" style="width:25%" placeholder="<?php _e( 'Accept', 'ultimate-facebook-comments' ); ?>" value="<?php if (isset($options['ufc_fb_comment_user_agreement_btn'])) { echo $options['ufc_fb_comment_user_agreement_btn']; } ?>" />
        &nbsp;&nbsp;
        <label for="fbc-notice-btn-decline"><strong><?php _e( 'Decline:', 'ultimate-facebook-comments' ); ?></strong></label>&nbsp;&nbsp;
        <input id="fbc-notice-btn-decline" name="ufc_plugin_global_options[ufc_fb_comment_user_agreement_decline_btn]" type="text" size="37" style="width:25%" placeholder="<?php _e( 'Decline', 'ultimate-facebook-comments' ); ?>" value="<?php if (isset($options['ufc_fb_comment_user_agreement_decline_btn'])) { echo $options['ufc_fb_comment_user_agreement_decline_btn']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Set title for notice/message/cookie consent of your website.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

###############################################################
######################    Notification    #####################
###############################################################

function ufc_enable_fbc_notification_cb_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>   <label class="switch">
         <input type="checkbox" id="fbc-notienable" name="ufc_plugin_global_options[ufc_enable_fbc_notification_cb]" value="1" <?php checked(isset($options['ufc_enable_fbc_notification_cb']), 1); ?> /> 
         <div class="slider round"></div></label>&nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Enable this option if you want to enable email notifination if a new facebook comment is published in your blog.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_fbcn_name_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( empty($options['ufc_fbcn_name']) ) {
        $options['ufc_fbcn_name'] = get_bloginfo( 'name' );
    }
    ?>  <input id="fbcn-name" name="ufc_plugin_global_options[ufc_fbcn_name]" type="text" size="40" style="width:40%;" required placeholder="ex. Your Site Name" value="<?php if (isset($options['ufc_fbcn_name'])) { echo $options['ufc_fbcn_name']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Enter the custom email sender name here. If you are using ant SMTP plugin, please check that plugin\'s settings, as that plugin may control the wordpress email sender name.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_fbcn_email_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( empty($options['ufc_fbcn_email']) ) {
        $options['ufc_fbcn_email'] = get_bloginfo( 'admin_email' );
    }
    ?>  <input id="fbcn-email" name="ufc_plugin_global_options[ufc_fbcn_email]" type="email" size="40" style="width:40%;" required placeholder="ex. noreply@yoursite.com" value="<?php if (isset($options['ufc_fbcn_email'])) { echo $options['ufc_fbcn_email']; } ?>" />
        &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Enter the custom email sender email here. If you are using ant SMTP plugin, please check that plugin\'s settings, as that plugin may control the wordpress email sender email.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_fbcn_template_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( !isset($options['ufc_fbcn_template']) ) {
        $options['ufc_fbcn_template'] = 'default';
    }
    $items = array(
        'default'      => __( 'Plain Text Format', 'ultimate-facebook-comments' ),
        'template_one' => __( 'HTML Format', 'ultimate-facebook-comments' )
    );
    echo '<select id="fbcn-template" name="ufc_plugin_global_options[ufc_fbcn_template]" style="width:25%;">';
    foreach( $items as $item => $label ) {
        $selected = ($options['ufc_fbcn_template'] == $item) ? ' selected="selected"' : '';
        echo '<option value="' . $item . '"' . $selected . '>' . $label . '</option>';
    }
    echo '</select>';
?>&nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Select the facebook comments notification template from here.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
<?php
}

function ufc_fbcn_email_recipient_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( !isset($options['ufc_fbcn_email_recipient']) ) {
        $options['ufc_fbcn_email_recipient'] = get_bloginfo( 'admin_email' );
    }
    ?> 
    <input id="fbcn-email-receive" name="ufc_plugin_global_options[ufc_fbcn_email_recipient]" type="text" size="100" style="width:100%;" required placeholder="admin@yoursite.com" value="<?php if (isset($options['ufc_fbcn_email_recipient'])) { echo $options['ufc_fbcn_email_recipient']; } ?>" />
    <?php
}

function ufc_enable_fbcn_author_cb_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>  <label class="switch">
        <input type="checkbox" id="fbc-notiauthor" name="ufc_plugin_global_options[ufc_enable_fbcn_author_cb]" value="1" <?php checked(isset($options['ufc_enable_fbcn_author_cb']), 1); ?> /> 
        <div class="slider round"></div></label>
        &nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Enable this option if you want to notify post author about new comment as well.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_fbcn_email_subject_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    if( empty($options['ufc_fbcn_email_subject']) ) {
        $options['ufc_fbcn_email_subject'] = 'New Comment on your Blog: &#37;&#37;site_name&#37;&#37;';
    }
    $emailSubject = stripslashes( strip_tags($options['ufc_fbcn_email_subject'] ) );  
    ?>  <input id="fbcn-emailsub" name="ufc_plugin_global_options[ufc_fbcn_email_subject]" type="text" size="100" style="width:100%;" required placeholder="New comment on your blog." value="<?php if (isset($options['ufc_fbcn_email_subject'])) { echo $emailSubject; } ?>" />
        <br>
    <?php printf(
		'<small style="line-height: 2;"><i>%s</i><code>&#37;&#37;author_name&#37;&#37;</code> <code>&#37;&#37;post_title&#37;&#37;</code> <code>&#37;&#37;post_link&#37;&#37;</code> <code>&#37;&#37;site_name&#37;&#37;</code> <code>&#37;&#37;site_url&#37;&#37;</code> <code>&#37;&#37;comment_text&#37;&#37;</code> <code>&#37;&#37;comment_type&#37;&#37;</code></strong><small>',
		__( 'You can use these tags into email subject - ', 'ultimate-facebook-comments' )
	);
}

function ufc_fbcn_email_message_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    $emailBody = $options['ufc_fbcn_email_message'];
    if( empty( $emailBody ) ) {
        $emailBody = 'A new &#37;&#37;comment_type&#37;&#37; is published on your blog: &#37;&#37;comment_text&#37;&#37;';
    }
    //$emailBody = stripslashes( $emailBody );
    $emailBody = html_entity_decode( $emailBody, ENT_COMPAT, "UTF-8" );

    $args = array(
        'textarea_name'   => 'ufc_plugin_global_options[ufc_fbcn_email_message]',
        'textarea_rows'   => '10',
        'teeny'           => true,
        'tinymce'         => false,
    );
    wp_editor( $emailBody, 'fbcn-emailmsg', $args );
    printf(
		'<small style="line-height: 2;"><i>%1$s</i><code>&#37;&#37;admin_email&#37;&#37;</code> <code>&#37;&#37;author_name&#37;&#37;</code> <code>&#37;&#37;post_title&#37;&#37;</code> <code>&#37;&#37;post_link&#37;&#37;</code> <code>&#37;&#37;site_name&#37;&#37;</code> <code>&#37;&#37;site_url&#37;&#37;</code> <code>&#37;&#37;comment_text&#37;&#37;</code> <code>&#37;&#37;comment_type&#37;&#37;</code> <code>&#37;&#37;comment_time&#37;&#37;</code><i>. %2$s</i><small>',
		__( 'You can use these tags into email body - ', 'ultimate-facebook-comments' ), __( 'Email body supports HTML.', 'ultimate-facebook-comments' )
	);
}

###############################################################
#########################    Others    ########################
###############################################################

function ufc_show_comment_count_cb_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>  <label class="switch">
        <input type="checkbox" id="fbc-count" name="ufc_plugin_global_options[ufc_show_comment_count_cb]" value="1" <?php checked(isset($options['ufc_show_comment_count_cb']), 1); ?> /> 
        <div class="slider round"></div></label>&nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Enable this if you want to show comment counts like native wordpress style beside every individual posts in edit.php page. Note that comment count will be automatically updated when a new comment is added on your blog.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_add_fmt_admin_bar_cb_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>   <label class="switch">
         <input type="checkbox" id="fbc-mt" name="ufc_plugin_global_options[ufc_add_fmt_admin_bar_cb]" value="1" <?php checked(isset($options['ufc_add_fmt_admin_bar_cb']), 1); ?> /> 
         <div class="slider round"></div></label>&nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Enable this if you want to add a link on wordpress admin bar to view facebbook comment moderation tool directly from admin area.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_remove_wp_comments_trace_cb_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>   <label class="switch">
         <input type="checkbox" id="fbc-trace" name="ufc_plugin_global_options[ufc_remove_wp_comments_trace_cb]" value="1" <?php checked(isset($options['ufc_remove_wp_comments_trace_cb']), 1); ?> /> 
         <div class="slider round"></div></label>&nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Enable this if you want to disable wordpress native comment completely from both frontend and backend.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_enable_promo_cb_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>   <label class="switch">
         <input type="checkbox" id="fbc-promo" name="ufc_plugin_global_options[ufc_enable_promo_cb]" value="1" <?php checked(isset($options['ufc_enable_promo_cb']), 1); ?> /> 
         <div class="slider round"></div></label>&nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Please enable this option to help Ultimate Facebook Comments get more popularity as your thank to the hard work I do for you totally free. This option adds a text under the comment section which will allow your site visitors recognize the name of comment solution you use. Thank you!', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

function ufc_del_plugin_settings_cb_display() {
    $options = get_option( 'ufc_plugin_global_options' );
    ?>   <label class="switch">
         <input type="checkbox" id="ufc-delete" name="ufc_plugin_global_options[ufc_del_plugin_settings_cb]" value="1" <?php checked(isset($options['ufc_del_plugin_settings_cb']), 1); ?> /> 
         <div class="slider round"></div></label>&nbsp;&nbsp;<span class="tooltip" title="<?php _e( 'Enable this option if you want to delete all plugin settings from your database at the time of plugin uninstallation.', 'ultimate-facebook-comments' ); ?>"><span title="" class="dashicons dashicons-editor-help"></span></span>
    <?php
}

?>