<?php
/*
    MU Plugin: Paramètres généraux
    Description: Parémètres généraux pour Wordpress
    Author: Mathieu Cheze (proximit)
    Version: 1.0
*/

/* Remove the <div> surrounding the dynamic navigation to cleanup markup
*******************************************************************************/
function my_wp_nav_menu_args($args = '') {
    $args['container'] = false;
    return $args;
}

/* Remove Injected classes, ID's and Page ID's from Navigation <li> items
*******************************************************************************/
function my_css_attributes_filter($var) {
    return is_array($var) ? array() : '';
}

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

/* REMOVE XMLRPC METHOD (pour empêcher les attaques par "bruteforce")
*******************************************************************************/
function mmx_remove_xmlrpc_methods( $methods ) {
    unset( $methods['system.multicall'] );
    return $methods;
}
add_filter( 'xmlrpc_methods', 'mmx_remove_xmlrpc_methods');

/* MISCS ACTIONS & FILTERS
*******************************************************************************/
// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('sanitize_file_name', 'remove_accents' ); // Santiize file name accent on upload

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether


?>
