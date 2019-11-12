<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Ultimate Social Comments
 * @subpackage Public
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

add_shortcode( 'ufc-fb-comments', 'ufc_load_fb_comments_shortcode' );
add_shortcode( 'ufc-fbc-count', 'ufc_load_fb_comments_count_shortcode' );

function ufc_load_fb_comments_shortcode( $atts ) {
    global $post;

    if( ! is_object( $post ) ) {
        return;
    }

    if( ufc_check_is_amp_page() ) {
        return;
    }

    $options = get_option( 'ufc_plugin_global_options' );

    if( empty( $options['ufc_facebook_comments_app_id'] ) ) {
        return;
    }
    
    if( $options['ufc_load_fb_comment_url'] == 'default' ) {
        $url = get_permalink( $post->ID );
        if ( $url == '' ) {
            $url = html_entity_decode( esc_url( ufc_get_site_http_protocol() . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ) );
        }
    } elseif( $options['ufc_load_fb_comment_url'] == 'homepage' ) {
        $url = get_home_url();
    } elseif( $options['ufc_load_fb_comment_url'] == 'custom_url' ) {
        $url = !empty($options['ufc_load_fb_comment_custom_url']) ? $options['ufc_load_fb_comment_custom_url'] : get_permalink( $post->ID );
    }

    $url = apply_filters( 'ufc_facebook_comments_load_target_url', $url, $post );

    $tag = isset($options['ufc_fb_comment_title_html_tag']) ? $options['ufc_fb_comment_title_html_tag'] : 'div';
    $no = !empty($options['ufc_no_of_fb_comments']) ? $options['ufc_no_of_fb_comments'] : '10';
    $width = !empty($options['ufc_fb_comment_box_width']) ? $options['ufc_fb_comment_box_width'] : '100%';

    $credit = '';
    if( isset( $options['ufc_enable_promo_cb'] ) ) {
        $credit = $options['ufc_enable_promo_cb'];
    }

    $consent = '';
    if( isset( $options['ufc_fb_comment_consent_notice_cb'] ) ) {
        $consent = $options['ufc_fb_comment_consent_notice_cb'];
    }

    $atts = shortcode_atts(
		array(
			'order_by'     => $options['ufc_fb_comment_sorting'],
            'color_scheme' => $options['ufc_fb_comments_theme'],
            'url'          => $url,
            'title'        => $options['ufc_fb_comment_msg'],
            'title_class'  => 'fb-comments-text',
            'title_align'  => $options['ufc_fb_comment_msg_align'],
            'num_comments' => $no,
            'width'        => $width,
            'color'        => sanitize_text_field( $options['ufc_fbc_area_bgcolor'] ),
            'id'           => esc_html( $options['ufc_comment_area_id'] ),
            'class'        => esc_html( $options['ufc_comment_area_class'] ),
            'tag'          => $tag,
            'button_class' => esc_html($options['ufc_loading_button_class']),
            'button_text'  => esc_html($options['ufc_loading_button_text']),
            'loading'      => $options['ufc_fb_comment_loading_method'],
            'credit'       => $credit,
            'consent'      => $consent,
		), $atts, 'ufc-fb-comments' );

    $html = '';
    if( !empty( $atts['title'] ) ) {
        $html .= '<'. $atts['tag'] .' id="fbc-comments-text" class="'. $atts['title_class'] .'" style="margin-bottom:15px;text-align:' . $atts['title_align'] . ';">' . $atts['title'] . '</'. $atts['tag'] .'>';
    }
    $html .= '<div id="ufc-button-div" style="text-align: center; display: none;"><button id="ufc-button" class="' . $atts['button_class'] . '">' . $atts['button_text'] . '</button></div>';
    $html .= '<div id="fbc-comments-div" class="fb-comments" data-notify="true" data-colorscheme="' . $atts['color_scheme'] . '" data-href="' . $atts['url'] . '" data-numposts="' . $atts['num_comments'] . '" data-order-by="' . $atts['order_by'] . '" data-width="' . $atts['width'] . '"></div>';
 
    if( isset( $atts['credit'] ) && ( $atts['credit'] == 1 ) ) {
        $html .= '<div id="poweredby" style="text-align: center;font-size: 12px;">Powered by <a href="https://wordpress.org/plugins/ultimate-facebook-comments/" target="_blank" style="color:inherit;text-decoration:none">Ultimate Facebook Comments</a></div>';
    }
    
    $get_bgcolor = '';
    if ( !empty( $atts['color'] ) ) {
        $get_bgcolor = 'background-color:' . $atts['color'];
    }

    $cookie_consent = '';
    if( isset( $atts['consent'] ) && ( $atts['consent'] == 1 ) ) {
        $cookie_consent = '<div id="consent-notice" class="ufc-consent" style="display: none;">
        <p style="text-align:center;line-height:0.2;color:red;font-size:15px;"><strong>' . esc_html($options['ufc_fb_comment_consent_notice_title']) . '</strong></p>
        <p style="font-size:12px;color:#5e5e5e;">' . esc_html($options['ufc_fb_comment_consent_notice_msg']) . '</p>
        <p><span id="ufc-accept">' . esc_html($options['ufc_fb_comment_user_agreement_btn']) . '</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="ufc-decline">' . esc_html($options['ufc_fb_comment_user_agreement_decline_btn']) . '</span></p>
        </div>';
    }

    $sdk = "(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.async = true;
        js.src = '//connect.facebook.net/" . esc_html($options['ufc_fb_comment_language']) . "/sdk.js#xfbml=1&autoLogAppEvents=1&version=" . UFC_FB_SDK_VERSION . "&appId=" . $options['ufc_facebook_comments_app_id'] . "';
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        ";
    //$sdk .= 'console.log( "SDK Loaded" );';

    if ( isset( $atts['loading'] ) && $atts['loading'] == 'on_scroll' ) {
        $sdk = "document.getElementById('ufc-button-div').style.display = 'none'; document.getElementById('ufc-button').style.display = 'none'; function ufc_async_load() { var element = document.getElementById('" . esc_html($options['ufc_comment_area_id']) . "').getBoundingClientRect();
        if (document.getElementById('facebook-jssdk')) return; if ( element.top < window.innerHeight ) { " . $sdk . " }; };";
    }

    if ( isset( $atts['loading'] ) && $atts['loading'] == 'on_click' ) {
        $sdk = "document.getElementById('fbc-comments-div').style.display = 'none'; if(document.getElementById('fbc-comments-text')) { document.getElementById('fbc-comments-text').style.display = 'none' }; document.getElementById('ufc-button-div').style.display = 'block'; if(document.getElementById('poweredby')) { document.getElementById('poweredby').style.display = 'none'; }
        function ufc_async_load() { document.getElementById('fbc-comments-div').style.display = 'block'; if(document.getElementById('fbc-comments-text')) { document.getElementById('fbc-comments-text').style.display = 'block' }; if(document.getElementById('poweredby')) { document.getElementById('poweredby').style.display = 'block' }; document.getElementById('ufc-button-div').style.display = 'none';
            this.style.display = 'none'; " . $sdk . " };";
    }

    $script = "\n" . '<!-- Facebook SDK is added by Ultimate Social Comments v' . UFC_PLUGIN_VERSION . ' plugin -->' . "\n";
    $script .= '<div id="fb-root"></div>';
    $script .= '<script type="text/javascript">';
    $script .= '(function() {';
    $script .= $sdk;
    if ( isset( $atts['loading'] ) && $atts['loading'] == 'on_scroll' ) {
        $script .= ufc_scroll_script_sc();
    } elseif ( isset( $atts['loading'] ) && $atts['loading'] == 'on_click' ) {
        $script .= ufc_click_script_sc();
    }
    $script .= '})();';
    $script .= '</script>';
    $script .= "\n" . '<!-- / End of Facebook SDK -->' . "\n";

    $content = $cookie_consent . '<div id="' . $atts['id'] . '" class="ufc-comments ' . $atts['class'] . '" style="width:100%;' . $get_bgcolor . '">' . $html . '</div>' . $script;
    
    return $content;
}

function ufc_scroll_script_sc() {
    $scroll_script = "if (window.addEventListener) {
        window.addEventListener( 'scroll', ufc_async_load, false );
    } else if (window.attachEvent) {
        window.attachEvent( 'onscroll', ufc_async_load );
    }";

    return $scroll_script;
}

function ufc_click_script_sc() {
    $click_script = "var button = document.getElementById('ufc-button');
    if (button.addEventListener) {
        button.addEventListener( 'click', ufc_async_load, false );
    } else if (button.attachEvent) {
        button.attachEvent( 'onclick', ufc_async_load );
    }";

    return $click_script;
}

function ufc_load_fb_comments_count_shortcode( $atts ) {
    $atts = shortcode_atts(
		array(
			'id' => null,
        ), $atts, 'ufc-fbc-count' );
        
    echo get_fb_comment_count( $atts['id'] );
}

?>