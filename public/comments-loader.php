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

if( !empty( $options['ufc_facebook_comments_app_id'] ) ) {

    add_action('wp_head', 'ufc_add_fb_comments_meta', 10);
    // load fb comments sdk
    if ( isset( $options['ufc_fb_comment_loading_method'] ) && $options['ufc_fb_comment_loading_method'] == 'Default' ) {
        add_action('wp_footer', 'ufc_add_fb_comments_default_sdk_to_body', 10);
    } else {
        add_action('wp_footer', 'ufc_init_fb_comments_sdk', 10);
    }
    
    if( isset( $options['ufc_fb_comment_auto_display'] ) && $options['ufc_fb_comment_auto_display'] == 'After Content' ) {
        
        add_filter('the_content', 'ufc_fb_comments_after', 99);
        if( $options['ufc_fb_comment_box_override'] == 'Show Facebook Comments' ) {
            add_filter('comments_template', 'ufc_load_blank_comments_template');
        }

    } elseif( isset( $options['ufc_fb_comment_auto_display'] ) && $options['ufc_fb_comment_auto_display'] == 'Replace Native Comment' ) {
        
        add_filter('comments_template', 'ufc_load_comments_template');
    }
}

function ufc_add_fb_comments_meta() { 

    $options = get_option('ufc_plugin_global_options');
    $p_meta = get_post_meta( get_the_ID(), '_ufc_disable', true );

    global $post;
    if ( $p_meta != 'yes' || has_shortcode( $post->post_content, 'ufc-fb-comments') ) {

        if( !empty( $options['ufc_custom_css_comment']) ) {
            echo '<style type="text/css" id="ufc-custom-css">.fb-comments-text {' . esc_html($options['ufc_custom_css_comment']) . '}</style>'."\n";
        }
    }
    echo '<meta property="fb:app_id" content="' . $options['ufc_facebook_comments_app_id'] . '"/>';
}

function ufc_init_fb_comments_sdk() {

    $options = get_option('ufc_plugin_global_options');
    $p_meta = get_post_meta( get_the_ID(), '_ufc_disable', true );

    global $post;
    if ( $p_meta != 'yes' || has_shortcode( $post->post_content, 'ufc-fb-comments') ) {

        $script = '';
        if(!empty($options['ufc_facebook_comments_app_id'])) {

            $script .= '<div id="fb-root"></div>';
            $script .= '<script type="text/javascript">';
            $script .= 'function showUFC() {';
            $script .= ufc_add_fb_comments_sdk_to_body();
            $script .= '}';
            $script .= ufc_get_load_script();
            $script .= '</script>';
        }
        echo $script;
    }
}

function ufc_add_fb_comments_sdk_to_body() {

    $options = get_option('ufc_plugin_global_options');

    $script = '';
    $script .= "(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = '//connect.facebook.net/" . $options['ufc_fb_comment_language'] . "/sdk.js#xfbml=1&autoLogAppEvents=1&version=v3.0&appId=" . $options['ufc_facebook_comments_app_id'] . "';
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        ";
     return $script;
}

function ufc_get_load_script() {
    
    $options = get_option('ufc_plugin_global_options');

    if ( isset( $options['ufc_fb_comment_loading_method'] ) && $options['ufc_fb_comment_loading_method'] == 'On Scroll' ) {
        return ufc_scroll_script();
    } else {
        return ufc_click_script();
    }
}

function ufc_scroll_script() {

    $options = get_option('ufc_plugin_global_options');
    
    $scroll_script =  "window.onscroll = function () {
                var rect = document.getElementById('" . $options['ufc_comment_area_id'] . "').getBoundingClientRect();
                if (rect.top < window.innerHeight) {
                    var comment = document.getElementById('" . $options['ufc_comment_area_id'] . "');
                    comment.innerHTML = '" . ufc_comments_area_content() . "';
                    showUFC();
                    window.onscroll = null;
                } 
            }";

    return $scroll_script;
}

function ufc_click_script() {

    $options = get_option('ufc_plugin_global_options');
    
    $click_script = "document.getElementById('ufc-button').onclick = function() {
            var ufccomment = document.getElementById('" . $options['ufc_comment_area_id'] . "');
            ufccomment.innerHTML = '" . ufc_comments_area_content() . "';
            showUFC();
           };
        ";

    return $click_script;
}

function ufc_comments_area_content() {
    
    $options = get_option('ufc_plugin_global_options');

    if( $options['ufc_fb_comment_sorting'] == 'Social Ranking' ) {
        $sorting = 'social';
    } elseif( $options['ufc_fb_comment_sorting'] == 'Time' ) {
        $sorting = 'time';
    } elseif( $options['ufc_fb_comment_sorting'] == 'Reverse Time' ) {
        $sorting = 'reverse_time';
    }

    if( $options['ufc_fb_comments_theme'] == 'Light' ) {
        $theme = 'light';
    } elseif( $options['ufc_fb_comments_theme'] == 'Dark'  ) {
        $theme = 'dark';
    }

    if( $options['ufc_load_fb_comment_url'] == 'Default' ) {
        $url = get_permalink();
    } elseif( $options['ufc_load_fb_comment_url'] == 'Homepage' ) {
        $url = get_site_url();
    } elseif( $options['ufc_load_fb_comment_url'] == 'Custom URL' ) {
        $url = $options['ufc_load_fb_comment_custom_url'];
    }

    if( $options['ufc_fb_comment_msg_align'] == 'Left' ) {
        $align = 'left';
    } elseif( $options['ufc_fb_comment_msg_align'] == 'Center' ) {
        $align = 'center';
    } elseif( $options['ufc_fb_comment_msg_align'] == 'Right' ) {
        $align = 'right';
    }

    $no = $options['ufc_no_of_fb_comments'];
    $width = $options['ufc_fb_comment_box_width'];

    $html = '';
    if( !empty($options['ufc_fb_comment_msg']) ) {
        $html .= '<div id="fbc-comments-text" class="fb-comments-text" style="margin-bottom:15px;text-align:' . $align . '">' . $options['ufc_fb_comment_msg'] . '</div>';
    }
    $html .= '<div id="fbc-comments-div" class="fb-comments" data-notify="true" data-colorscheme="' . $theme . '" data-href="' . $url . '" data-numposts="' . $no . '" data-order-by="' . $sorting . '" data-width="' . $width . '"></div>';
 
    if( isset($options['ufc_enable_promo_cb']) && ($options['ufc_enable_promo_cb'] == 1) ) {
        $html .= '<div id="poweredby" style="text-align:center;"><small>Powered by <a href="https://wordpress.org/plugins/ultimate-facebook-comments/" target="_blank" style="color:inherit;text-decoration:none">Ultimate Facebook Comments</a></small></div>';
    }
    return $html;
}

function ufc_load_comments_template() {

    $options = get_option('ufc_plugin_global_options');
    $p_meta = get_post_meta( get_the_ID(), '_ufc_disable', true );

    if ( isset( $options['ufc_enable_on_post_types'] ) && !in_array( get_post_type( get_the_ID() ), $options['ufc_enable_on_post_types'] ) ) return;
        
    if ( $p_meta == 'yes' ) {
        return plugin_dir_path( __FILE__ ) . 'templates/comments-template-empty.php';
    }
    return plugin_dir_path( __FILE__ ) . 'templates/comments-template.php';
}

function ufc_load_blank_comments_template() {

    $options = get_option('ufc_plugin_global_options');

    if ( isset( $options['ufc_enable_on_post_types'] ) && !in_array( get_post_type( get_the_ID() ), $options['ufc_enable_on_post_types'] ) ) return;
    
    return plugin_dir_path( __FILE__ ) . 'templates/comments-template-empty.php';
}

function ufc_fb_comments_after( $content ) {

    $options = get_option('ufc_plugin_global_options');
    $p_meta = get_post_meta( get_the_ID(), '_ufc_disable', true );

    if ($options['ufc_fb_comment_loading_method'] == 'On Click') {
        $get_button = '<button id="ufc-button" class="' . $options['ufc_loading_button_class'] . '" onclick="showUFC();">' . $options['ufc_loading_button_text'] . '</button><br><br>';
    } else {
        $get_button = '';
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

    if ($options['ufc_fb_comment_loading_method'] == 'Default') {
        $comment_content = '<div id="' . $options['ufc_comment_area_id'] . '" class="ufc-comments ' . $options['ufc_comment_area_class'] . '" style="' . $get_bgcolor . '">' . ufc_comments_area_content() . '</div>';
    } else {
        $comment_content = '<div id="' . $options['ufc_comment_area_id'] . '" class="ufc-comments ' . $options['ufc_comment_area_class'] . '" style="text-align:center;' . $get_bgcolor . '">' . $get_button . '</div>';
    }

    if( isset( $comment_content ) ) {
        $fullcontent =  $content . $cookie_consent . $comment_content;
    }

    if( isset($options['ufc_enable_on_post_types']) ) {
        $post_types = $options['ufc_enable_on_post_types'];
        foreach($post_types as $item) {
            if ( isset( $fullcontent ) && is_singular( $item ) && $p_meta != 'yes' ) { 
                return $fullcontent;
            }
        }
    }
    return $content;
}


function ufc_add_fb_comments_default_sdk_to_body() { 

    $options = get_option('ufc_plugin_global_options');
    $p_meta = get_post_meta( get_the_ID(), '_ufc_disable', true );

    global $post;
    if ( $p_meta != 'yes' || has_shortcode( $post->post_content, 'ufc-fb-comments') ) { ?>

    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = '//connect.facebook.net/<?php echo $options['ufc_fb_comment_language']; ?>/sdk.js#xfbml=1&autoLogAppEvents=1&version=v3.0&appId=<?php echo $options['ufc_facebook_comments_app_id']; ?>';
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <?php
    }
}

function add_fb_sdk() { ?>
    <script>
        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = '//connect.facebook.net/<?php echo $options['ufc_fb_comment_language']; ?>/sdk.js#xfbml=1&autoLogAppEvents=1&version=v3.0&appId=<?php echo $options['ufc_facebook_comments_app_id']; ?>';
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
<?php
}

?>