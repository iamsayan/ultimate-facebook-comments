<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Ultimate Facebook Comments
 * @subpackage Public
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

add_action( 'init', 'ufc_render_comments_components' );

function ufc_render_comments_components() {
    $options = get_option('ufc_plugin_global_options');

    if( ! ( isset($options['ufc_enable_fb_comment_cb']) && ($options['ufc_enable_fb_comment_cb'] == 1) ) ) return;

    if( !empty( $options['ufc_facebook_comments_app_id'] ) ) {
    
        add_action( 'wp_head', 'ufc_add_fb_comments_meta', 10 );
        // load fb comments sdk
        add_action( 'wp_footer', 'ufc_init_fb_comments_components', 100 );

        if( isset( $options['ufc_fb_comment_auto_display'] ) && $options['ufc_fb_comment_auto_display'] == 'after_content' ) {
            $priority = 10;
            if ( !empty( $options['ufc_fb_comment_priority'] ) ) {
                $priority = $options['ufc_fb_comment_priority'];
            }
            add_filter( 'the_content', 'ufc_fb_comments_after', $priority );
        }
        elseif( isset( $options['ufc_fb_comment_auto_display'] ) && $options['ufc_fb_comment_auto_display'] == 'replace_native_comment' ) {
            add_filter( 'comments_template', 'ufc_load_comments_template' );
            add_filter( 'woocommerce_product_tabs', 'ufc_woo_facebook_comments_tab' );
        }

        if( isset( $options['ufc_http_to_https_cb'] ) && $options['ufc_http_to_https_cb'] == 1 ) {
            add_filter( 'ufc_facebook_comments_load_target_url', 'ufc_fix_http_to_https_migration', 10, 2 );
        }
    }
}

function ufc_add_fb_comments_meta() { 

    if( ! is_singular() ) return;

    if( ufc_check_is_amp_page() ) {
        return;
    }

    $options = get_option('ufc_plugin_global_options');

    $content = '<!-- This website uses the Ultimate Facebook Comments plugin v' . UFC_PLUGIN_VERSION . ' - https://wordpress.org/plugins/ultimate-facebook-comments/ -->' . "\n";
    $content .= '<meta property="fb:app_id" content="' . $options['ufc_facebook_comments_app_id'] . '"/>' . "\n";
    
    if( apply_filters( 'ufc_facebook_app_id_output', true ) ) {
        echo $content;
    }

    $style = '<style type="text/css">.fb-comments, .fb-comments span, .fb-comments span iframe[style] { min-width:100% !important; width:100% !important }</style>' . "\n";
    if( !empty( $options['ufc_custom_css_comment']) ) {
        $style .= '<style type="text/css">.fb-comments-text { ' . esc_html($options['ufc_custom_css_comment']) . ' }</style>'."\n";
    }

    echo $style;
}

function ufc_init_fb_comments_components() {

    if( ! is_singular() ) return;

    global $post;

    if( ! is_object( $post ) ) {
        return;
    }

    if( ufc_check_is_amp_page() ) {
        return;
    }

    $options = get_option('ufc_plugin_global_options');
    $p_meta = get_post_meta( $post->ID, '_ufc_disable', true );

    if ( isset( $options['ufc_enable_on_post_types'] ) && !in_array( get_post_type( $post->ID ), $options['ufc_enable_on_post_types'] ) ) {
        return;
    }

    if( get_post_type( $post->ID ) == 'product' && ( isset( $options['ufc_fb_comment_auto_display'] ) && $options['ufc_fb_comment_auto_display'] == 'replace_native_comment' ) ) {
        return;
    }

    $script = '';
    if( !empty( $options['ufc_facebook_comments_app_id'] ) ) {

        $script .= "\n" . '<!-- Facebook SDK is added by Ultimate Facebook Comments v' . UFC_PLUGIN_VERSION . ' plugin -->' . "\n";
        $script .= '<div id="fb-root"></div>';
        $script .= '<script type="text/javascript">';
        $script .= '(function() {';
        $script .= ufc_add_fb_comments_sdk_to_body();
        $script .= ufc_get_load_script();
        $script .= '})();';
        $script .= '</script>';
        $script .= "\n" . '<!-- / End of Facebook SDK -->' . "\n";
    }

    if ( ( $options['ufc_fb_comment_auto_display'] == 'after_content' && $p_meta != 'yes' ) ) {
        echo $script;
    }
    elseif ( $options['ufc_fb_comment_auto_display'] == 'replace_native_comment') {
        if( post_type_supports( get_post_type( $post->ID ), 'comments' ) ) {
            if ( comments_open( $post->ID ) ) {
                echo $script;
            }
        }
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
        js.async = true;
        js.src = '//connect.facebook.net/" . esc_html($options['ufc_fb_comment_language']) . "/sdk.js#xfbml=1&autoLogAppEvents=1&version=v3.2&appId=" . $options['ufc_facebook_comments_app_id'] . "';
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        ";
    //$script .= 'console.log( "SDK Loaded" );';

    if ( isset( $options['ufc_fb_comment_loading_method'] ) && $options['ufc_fb_comment_loading_method'] == 'on_scroll' ) {
        $script = "document.getElementById('ufc-button-div').style.display = 'none'; document.getElementById('ufc-button').style.display = 'none'; function ufc_async_load() { var element = document.getElementById('" . esc_html($options['ufc_comment_area_id']) . "').getBoundingClientRect();
        if (document.getElementById('facebook-jssdk')) return; if ( element.top < window.innerHeight ) { " . $script . " }; };";
    }

    if ( isset( $options['ufc_fb_comment_loading_method'] ) && $options['ufc_fb_comment_loading_method'] == 'on_click' ) {
        $script = "document.getElementById('fbc-comments-div').style.display = 'none'; if(document.getElementById('fbc-comments-text')) { document.getElementById('fbc-comments-text').style.display = 'none' }; document.getElementById('ufc-button-div').style.display = 'block'; if(document.getElementById('poweredby')) { document.getElementById('poweredby').style.display = 'none'; }
        function ufc_async_load() { document.getElementById('fbc-comments-div').style.display = 'block'; if(document.getElementById('fbc-comments-text')) { document.getElementById('fbc-comments-text').style.display = 'block' }; if(document.getElementById('poweredby')) { document.getElementById('poweredby').style.display = 'block' }; document.getElementById('ufc-button-div').style.display = 'none';
            this.style.display = 'none'; " . $script . " };";
    }

    return $script;
}

function ufc_get_load_script() {
    $options = get_option('ufc_plugin_global_options');

    if ( isset( $options['ufc_fb_comment_loading_method'] ) && $options['ufc_fb_comment_loading_method'] == 'on_scroll' ) {
        return ufc_scroll_script();
    } elseif ( isset( $options['ufc_fb_comment_loading_method'] ) && $options['ufc_fb_comment_loading_method'] == 'on_click' ) {
        return ufc_click_script();
    }
    return;
}

function ufc_scroll_script() {
    $scroll_script = "if (window.addEventListener) {
        window.addEventListener( 'scroll', ufc_async_load, false );
    } else if (window.attachEvent) {
        window.attachEvent( 'onscroll', ufc_async_load );
    }";

    return $scroll_script;
}

function ufc_click_script() {
    $click_script = "var button = document.getElementById('ufc-button');
    if (button.addEventListener) {
        button.addEventListener( 'click', ufc_async_load, false );
    } else if (button.attachEvent) {
        button.attachEvent( 'onclick', ufc_async_load );
    }";

    return $click_script;
}

function ufc_comments_area_content() {

    global $post;

    if( ! is_object( $post ) ) {
        return;
    }

    $options = get_option('ufc_plugin_global_options');

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

    $html = '';
    if( !empty($options['ufc_fb_comment_msg']) ) {
        $html .= '<'. $tag .' id="fbc-comments-text" class="fb-comments-text" style="margin-bottom:15px;text-align:' . $options['ufc_fb_comment_msg_align'] . ';">' . $options['ufc_fb_comment_msg'] . '</'. $tag .'>';
    }
    $html .= '<div id="ufc-button-div" style="text-align: center; display: none;"><button id="ufc-button" class="' . esc_html($options['ufc_loading_button_class']) . '">' . esc_html($options['ufc_loading_button_text']) . '</button></div>';
    $html .= '<div id="fbc-comments-div" class="fb-comments" data-notify="true" data-colorscheme="' . $options['ufc_fb_comments_theme'] . '" data-href="' . $url . '" data-numposts="' . $no . '" data-order-by="' . $options['ufc_fb_comment_sorting'] . '" data-width="' . $width . '"></div>';
 
    if( isset($options['ufc_enable_promo_cb']) && ($options['ufc_enable_promo_cb'] == 1) ) {
        $html .= '<div id="poweredby" style="text-align: center;font-size: 12px;">Powered by <a href="https://wordpress.org/plugins/ultimate-facebook-comments/" target="_blank" style="color:inherit;text-decoration:none;">Ultimate Facebook Comments</a></div>';
    }
    return $html;
}

function ufc_load_comments_template() {
    $options = get_option('ufc_plugin_global_options');

    if ( isset( $options['ufc_enable_on_post_types'] ) && !in_array( get_post_type( get_the_ID() ), $options['ufc_enable_on_post_types'] ) ) {
        return;
    }

    if ( ! comments_open( get_the_ID() ) || post_password_required() || ufc_check_is_amp_page() ) {
        return plugin_dir_path( __FILE__ ) . 'templates/comments-template-empty.php';
    }
    return plugin_dir_path( __FILE__ ) . 'templates/comments-template.php';
}

function ufc_fb_comments_after( $content ) {
    global $post;
        
    if( ! is_object( $post ) ) {
        return $content;
    }

    if ( ! in_the_loop() ) {
        return $content;
    }

    if( ufc_check_is_amp_page() ) {
        return $content;
    }

    $options = get_option('ufc_plugin_global_options');
    $p_meta = get_post_meta( $post->ID, '_ufc_disable', true );

    $get_bgcolor = '';
    if ( !empty($options['ufc_fbc_area_bgcolor'] )) {
        $get_bgcolor = 'background-color:' . sanitize_text_field($options['ufc_fbc_area_bgcolor']);
    }

    $cookie_consent = '';
    if( isset($options['ufc_fb_comment_consent_notice_cb']) && ($options['ufc_fb_comment_consent_notice_cb'] == 1) ) {
        $cookie_consent = '<div id="consent-notice" class="ufc-consent" style="display: none;">
        <p style="text-align:center;line-height:0.2;color:red;font-size:15px;"><strong>' . esc_html($options['ufc_fb_comment_consent_notice_title']) . '</strong></p>
        <p style="font-size:12px;color:#5e5e5e;">' . esc_html($options['ufc_fb_comment_consent_notice_msg']) . '</p>
        <p><span id="ufc-accept">' . esc_html($options['ufc_fb_comment_user_agreement_btn']) . '</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="ufc-decline">' . esc_html($options['ufc_fb_comment_user_agreement_decline_btn']) . '</span></p>
        </div>';
    }

    $comment_content = '<div id="' . esc_html($options['ufc_comment_area_id']) . '" class="ufc-comments ' . esc_html($options['ufc_comment_area_class']) . '" style="width:100%;' . $get_bgcolor . '">' . ufc_comments_area_content() . '</div>';

    if( isset( $comment_content ) ) {
        $fullcontent =  $content . $cookie_consent . $comment_content;
    }

    if( isset($options['ufc_enable_on_post_types']) ) {
        $post_types = $options['ufc_enable_on_post_types'];
        foreach( $post_types as $item ) {
            if ( isset( $fullcontent ) && is_singular( $item ) && $p_meta != 'yes' ) { 
                return $fullcontent;
            }
        }
    }

    return $content;
}

function ufc_woo_facebook_comments_tab( $tabs ) {
    $options = get_option('ufc_plugin_global_options');
    $p_meta = get_post_meta( get_the_ID(), '_ufc_disable', true );

    $count = get_post_meta( get_the_ID(), '_post_fb_comment_count', true );
    if( ! $count ) {
        $count = 0;
    }

    if ( isset( $options['ufc_enable_on_post_types'] ) && in_array( get_post_type( get_the_ID() ), $options['ufc_enable_on_post_types'] ) ) {
        if ( is_singular( 'product' ) && $p_meta != 'yes' ) {
            // Adds the new tab
            $tabs['fb-comments'] = array(
                'title'     => sprintf( __( 'Comments (%s)', 'ultimate-facebook-comments' ), $count ),
                'priority'  => apply_filters( 'ufc_woocommerce_output_priority', 50 ),
                'callback'  => 'ufc_woo_facebook_comments_tab_content'
            );
        }
    }
    
    return $tabs;
}

function ufc_woo_facebook_comments_tab_content() {
    $sc_content = '[ufc-fb-comments tag="h2"]';
    $sc_content = apply_filters( 'ufc_woocommerce_custom_shortcode_output', $sc_content );

    $content = '<div id="ufc-woocommerce-content">';
    $content .= do_shortcode( $sc_content );
    $content .= '</div>';
    $content = apply_filters( 'ufc_woocommerce_custom_output', $content );

    echo $content;
}

function ufc_get_site_http_protocol() {
    if ( is_ssl() || ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ) ) {
        return 'https://';
    } else {
        return 'http://';
    }
}

function ufc_check_is_amp_page() {
    if ( ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) || ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) ) {
        return true;
    }
    return false;
}

function ufc_fix_http_to_https_migration( $url, $post ) {
    return str_replace( 'https://', 'http://', $url );
}

?>