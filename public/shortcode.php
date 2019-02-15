<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Ultimate Facebook Comments
 * @subpackage Public
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

function ufc_load_fb_comments_shortcode( $atts ) {

    global $post;

    if( !is_object( $post ) ) {
        return;
    }

    $options = get_option( 'ufc_plugin_global_options' );
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
            'credit'       => $credit,
            'consent'      => $consent,
		), $atts, 'ufc-fb-comments' );

    $html = '';
    if( !empty( $atts['title'] ) ) {
        $html .= '<'. $atts['tag'] .' id="fbc-comments-text" class="'. $atts['title_class'] .'" style="margin-bottom:15px;text-align:' . $atts['title_align'] . ';">' . $atts['title'] . '</'. $atts['tag'] .'>';
    }
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
        $cookie_consent = '<div id="consent-notice" class="ufc-consent" style="display:none;">
        <p style="text-align:center;line-height:0.2;color:red;font-size:15px;"><strong>' . esc_html($options['ufc_fb_comment_consent_notice_title']) . '</strong></p>
        <p style="font-size:12px;color:#5e5e5e;">' . esc_html($options['ufc_fb_comment_consent_notice_msg']) . '</p>
        <p><span id="ufc-accept">' . esc_html($options['ufc_fb_comment_user_agreement_btn']) . '</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="ufc-decline">' . esc_html($options['ufc_fb_comment_user_agreement_decline_btn']) . '</span></p>
        </div>';
    }

    $content = $cookie_consent . '<div id="' . $atts['id'] . '" class="ufc-comments ' . $atts['class'] . '" style="width:100%;' . $get_bgcolor . '">' . $html . '</div>';
    
    return $content;
}

add_shortcode( 'ufc-fb-comments', 'ufc_load_fb_comments_shortcode' );

?>