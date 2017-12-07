<?php
/*
    MU Plugin: Basic WP Configuration
    Description: Basic configuration for Wordpress
    Author: Mathieu Cheze (Proximit Agency)
    Author URI: http://www.proximit-agency.fr/
    Version: 1.2
*/

/* Allow SVG through WordPress Media Uploader
*******************************************************************************/
//function cc_mime_types($mimes) {
//  $mimes['svg'] = 'image/svg+xml';
//  return $mimes;
//}
//add_filter('upload_mimes', 'cc_mime_types');

/* Remove wp version param from any enqueued scripts
*******************************************************************************/
function remove_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'remove_ver_css_js', 9999 );

/* Remove the <div> surrounding the dynamic navigation to cleanup markup
*******************************************************************************/
function my_wp_nav_menu_args($args = '') {
    $args['container'] = false;
    return $args;
}
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation

/* Remove invalid rel attribute values in the categorylist
*******************************************************************************/
function remove_category_rel_from_category_list($thelist) {
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute

/* Remove wp_head() injected Recent Comment styles
*******************************************************************************/
function my_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()

/* Remove 'text/css' from our enqueued stylesheet
*******************************************************************************/
function html5_style_remove($tag) {
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet

/* Remove XMLRPC method (limit "bruteforce" attack)
*******************************************************************************/
function mmx_remove_xmlrpc_methods( $methods ) {
    unset( $methods['system.multicall'] );
    return $methods;
}
add_filter( 'xmlrpc_methods', 'mmx_remove_xmlrpc_methods');

/* MISCS ACTIONS & FILTERS
*******************************************************************************/
// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Remove the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Remove the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Remove the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Remove the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Remove Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Remove Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); //Remove  Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Remove relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Remove	s the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // Remove adjacent posts to the current post
remove_action('wp_head', 'rel_canonical'); // Remove canonical
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); // Remove shortlink

// Add Filters
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('sanitize_file_name', 'remove_accents' ); // Santiize file name accent on upload

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether


?>
