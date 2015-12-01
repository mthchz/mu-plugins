# Basing Must-Use plugins (mu-plugins)
Basing configuration for Wordpress.

## Usages
If doesn't exist, create mu-plugins directory on wp-content/. *(Not inside wp-content/plugins !)*

Put .php script on the mu-plugins root directory : *wp-content/mu-plugins/my-php-script.php*

[Codex:Must Use Plugins](https://codex.wordpress.org/Must_Use_Plugins).

## Features
* Remove the \<div\> surrounding the dynamic navigation to cleanup markup
* Remove Injected classes, ID's and Page ID's from Navigation \<li\> items
* Remove invalid rel attribute values in the categorylist
* Remove wp_head() injected Recent Comment styles
* Remove 'text/css' from our enqueued stylesheet
* Remove XMLRPC method (limit "bruteforce" attack)
* Remove actions :
  - Remove the links to the extra feeds such as category feeds
  - Remove the links to the general feeds: Post and Comment Feed
  - Remove the link to the Really Simple Discovery service endpoint, EditURI link
  - Remove the link to the Windows Live Writer manifest file.
  - Remove Index link
  - Remove Prev link
  - Remove Start link
  - Remove relational links for the posts adjacent to the current post.
  - Remove the XHTML generator that is generated on the wp_head hook, WP version
  - Remove adjacent posts to the current post
  - Remove canonical
  - Remove shortlink
* Add filters :
  - Allow shortcodes in Dynamic Sidebar
  - Remove \<p\> tags in Dynamic Sidebars (better!)
  - Remove surrounding \<div\> from WP Navigation
  - Remove auto \<p\> tags in Excerpt (Manual Excerpts only)
  - Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
  - Santiize file name accent on upload
* Remove filter :
  - Remove \<p\> tags from Excerpt altogether
