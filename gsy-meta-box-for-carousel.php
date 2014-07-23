<?php
/*
 * Plugin Name: GSY Meta Box For Carousel
 * Plugin URI: https://github.com/georgi-yankov/gsy-meta-box-for-carousel
 * Description: This plugin provides a way that let you choose a page in order to be used for carousel
 * Version: 1.0
 * Author: Georgi Yankov
 * Author URI: http://gsy-design.com
 */

/*
 * Here is the way it works:
 * Below every page you'll see a checkbox with the notice in red "Check this if
 * you want the page to appear in the carousel". You can check the checkbox or
 * leave uncheked, depends on the result you wish you have.
 * 
 * And here is the way to use that checkbox afterwords:
 * <?php
 * if ((get_post_meta($post->ID, 'gsy_carousel_meta_box_check', true)) AND
 * ((get_post_meta($post->ID, 'gsy_carousel_meta_box_check', true)) == 'on')) {
 *   // your code if it is checked...
 * } else {
 *   // your code if it is NOT checked...
 * }
 * ?>
 */

add_action('add_meta_boxes', 'gsy_carousel_meta_box_add');

function gsy_carousel_meta_box_add() {
    add_meta_box('gsy_carousel-meta-box-id', 'Carousel', 'gsy_carousel_meta_box_cb', 'page', 'normal', 'high');
}

function gsy_carousel_meta_box_cb($post) {
    $values = get_post_custom($post->ID);
    $check = isset($values['gsy_carousel_meta_box_check']) ? esc_attr($values['gsy_carousel_meta_box_check'][0]) : '';
    wp_nonce_field('gsy_carousel_meta_box_nonce', 'meta_box_nonce');
    ?>
    <p style="color: #e80000">
        <input type="checkbox" name="gsy_carousel_meta_box_check" id="gsy_carousel_meta_box_check" <?php checked($check, 'on'); ?> />
        <label for="gsy_carousel_meta_box_check">Check this if you want the page to appear in the carousel</label>
    </p>
    <?php
}

add_action('save_post', 'gsy_carousel_meta_box_save');

function gsy_carousel_meta_box_save($post_id) {
    // Bail if we're doing an auto save
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    // if our nonce isn't there, or we can't verify it, bail
    if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'gsy_carousel_meta_box_nonce'))
        return;

    // if our current user can't edit this post, bail
    if (!current_user_can('edit_post'))
        return;

    // now we can actually save the data
    $allowed = array(
        'a' => array(// on allow a tags
            'href' => array() // and those anchords can only have href attribute
        )
    );

    // This is purely my personal preference for saving checkboxes
    $chk = ( isset($_POST['gsy_carousel_meta_box_check']) && $_POST['gsy_carousel_meta_box_check'] ) ? 'on' : 'off';
    update_post_meta($post_id, 'gsy_carousel_meta_box_check', $chk);
}