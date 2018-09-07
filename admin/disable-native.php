<?php

/**
 * The admin-facing functionality of the plugin.
 *
 * @package    Ultimate WordPress Comments
 * @subpackage Admin
 * @author     Sayan Datta
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 */

if( isset($options['ufc_remove_wp_comments_trace_cb']) && ($options['ufc_remove_wp_comments_trace_cb'] == 1) ) {
  
    if( isset($options['ufc_fb_comment_auto_display']) && ($options['ufc_fb_comment_auto_display'] == 'Replace Native Comment') ) {
        
        function ufc_hide_pingback_using_css() { ?>
            <style>
                label[for="ping_status"] {
                    display: none !important;
                }
            </style>
        <?php
        }

        function ufc_hide_comments_admin_columns( $columns ) {
            unset( $columns['comments'] );
            return $columns;
        }

        // Disable support for comments and trackbacks in post types
        function ufc_disable_comments_pings_support() {
            $post_types = get_post_types();
            foreach ( $post_types as $post_type ) {
                if( post_type_supports($post_type, 'trackbacks') ) {
                    remove_post_type_support( $post_type, 'trackbacks' );
                }
            }
        }

        add_filter('manage_edit-post_columns', 'ufc_hide_comments_admin_columns');
        add_filter('manage_edit-page_columns', 'ufc_hide_comments_admin_columns');
        add_action('admin_menu', 'ufc_remove_meta_boxes');
        add_action('admin_print_styles-post.php', 'ufc_hide_pingback_using_css', 10);
        add_action('admin_print_styles-post-new.php', 'ufc_hide_pingback_using_css', 10);
        add_action('admin_init', 'ufc_disable_comments_pings_support');

    } else {

        add_filter('comments_open', 'ufc_disable_comments_status', 20, 2);
        add_action('admin_init', 'ufc_disable_comments_post_types_support');

    }

    add_filter('pings_open', 'ufc_disable_comments_status', 20, 2);
    add_filter('comments_array', 'ufc_disable_comments_hide_existing_comments', 10, 2);
    add_action('admin_menu', 'ufc_disable_comments_admin_menu');
    add_action('admin_init', 'ufc_disable_comments_admin_menu_redirect');
    add_action('wp_dashboard_setup', 'ufc_disable_comments_dashboard');
    add_action('wp_before_admin_bar_render', 'ufc_remove_comments_admin_bar_links');
    add_action('widgets_init', 'ufc_disable_rc_widget');
    add_action('admin_print_styles-index.php', 'ufc_comment_admin_css');
    add_action('admin_print_styles-profile.php', 'ufc_comment_admin_css');
    add_filter('pre_option_default_pingback_flag', '__return_zero');
    add_action('admin_menu', 'ufc_remove_meta_boxes');

    // Disable support for comments and trackbacks in post types
    function ufc_disable_comments_post_types_support() {
        $post_types = get_post_types();
        foreach ($post_types as $post_type) {
            if(post_type_supports($post_type, 'comments')) {
                remove_post_type_support($post_type, 'comments');
                remove_post_type_support($post_type, 'trackbacks');
            }
        }
    }

    // Hide existing comments
    function ufc_disable_comments_hide_existing_comments($comments) {
        $comments = array();
        return $comments;
    }

    // Close comments on the front-end
    function ufc_disable_comments_status() {
        return false;
    }
    
    // Remove comments page in menu
    function ufc_disable_comments_admin_menu() {
        remove_menu_page('edit-comments.php');
        remove_submenu_page('options-general.php', 'options-discussion.php');
    }
   
    // Redirect any user trying to access comments page
    function ufc_disable_comments_admin_menu_redirect() {
        global $pagenow;
        if ($pagenow === 'edit-comments.php'|| $pagenow === 'options-discussion.php') {
            wp_safe_redirect(admin_url()); exit;
        }
    }
    
    // Remove comments metabox from dashboard
    function ufc_disable_comments_dashboard() {
        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    }
   
    // Remove comments links from admin bar
    function ufc_remove_comments_admin_bar_links() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
    }
   
    function ufc_disable_rc_widget() {
        unregister_widget( 'WP_Widget_Recent_Comments' );
    }

    function ufc_remove_meta_boxes() {
        remove_meta_box( 'commentsdiv', 'post', 'normal' );
        remove_meta_box( 'trackbacksdiv', 'post', 'normal' );
        remove_meta_box( 'commentsdiv', 'page', 'normal' );
        remove_meta_box( 'trackbacksdiv', 'page', 'normal' );
    }
    
    function ufc_comment_admin_css() {
        echo '<style>
            #dashboard_right_now .comment-count,
            #dashboard_right_now .comment-mod-count,
            #latest-comments,
            #welcome-panel .welcome-comments,
            .user-comment-shortcuts-wrap {
                display: none !important;
            }
        </style>';
    }
}

?>