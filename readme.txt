=== GSY Meta Box For Carousel ===
Tags: gsy, meta-box, carousel 
Requires at least: 3.0.1
Tested up to: 3.9.1
Stable tag: 3.0.1

This plugin provides a way that let you choose a page in order to be used for carousel.

== Description ==

 Below every page you'll see a checkbox with the notice in red "Check this if
 you want the page to appear in the carousel". You can check the checkbox or
 leave uncheked, depends on the result you wish to have.

== Installation ==

1. Upload `gsy-meta-box-for-carousel` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. And here is the way to use that checkbox afterwords:
 
 <?php
 if ((get_post_meta($post->ID, 'gsy_carousel_meta_box_check', true)) AND
 ((get_post_meta($post->ID, 'gsy_carousel_meta_box_check', true)) == 'on')) {
   // your code if it is checked...
 } else {
   // your code if it is NOT checked...
 }
 ?>

== Frequently Asked Questions ==

== Screenshots ==

== Changelog ==

== Upgrade Notice ==

== Arbitrary section ==

== A brief Markdown Example ==