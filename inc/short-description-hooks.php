<?php
/**
 * Add the Short Title to Articles Custom Post Type
 * 
 * The Metabox styling will not match Gutenberg
 * See: https://github.com/WordPress/gutenberg/issues/12101
 */

/**
 * Create the Short Title input field
 * 
 * @param object $post    The post
 * @param array  $metabox The metabox arguments
 */
function Short_Title_input(object $post, array $metabox)
{
    $meta_key = $metabox['args']['meta_key'];
    $field_name = $metabox['args']['name'];
    $short_title = get_post_meta(get_the_ID(), $meta_key, true);

    echo '' . wp_nonce_field(basename(__FILE__), $meta_key . '_nonce') . '
        <b>' . esc_attr($field_name) . '</b></br>
        <input
            type="text"
            id="article-' . esc_attr($meta_key) . '"
            name="' . esc_attr($meta_key) . '"
            value="' . esc_attr($short_title) . '"
        >
    ';
}

/**
 * Add the Metabox for the Short Title input field
 */
function Add_Short_title()
{
    add_meta_box(
        'short_title',
        'Article Short Title',
        'Short_Title_input',
        'articles',
        'side',
        'high',
        array(
            'meta_key' => 'article_short_title',
            'name' => 'Short Title'
        )
    );
}

add_action('add_meta_boxes', 'Add_Short_title');

/**
 * Callback to handle Short Title on save
 * 
 * @param int    $post_id The ID for the Post
 * @param object $post    The Post
 */
function Add_Save_Short_Title_meta( int $post_id, object $post )
{
    $meta_key = 'article_short_title';
    $nonce = isset($_POST[$meta_key . '_nonce']) ?
        sanitize_html_class($_POST[$meta_key . '_nonce']) : '';

    if (!wp_verify_nonce($nonce, basename(__FILE__))) {
        return $post_id;
    }

    $post_type = get_post_type_object($post->post_type);

    if (!current_user_can($post_type->cap->edit_post, $post_id)) {
        return $post_id;
    }

    $new_meta_value = isset($_POST[$meta_key]) ?
        sanitize_html_class($_POST[$meta_key]) : '';
    $meta_value = get_post_meta($post_id, $meta_key, true);

    if ($new_meta_value && '' === $meta_value) {
        add_post_meta($post_id, $meta_key, $new_meta_value, true);
    } elseif ($new_meta_value && $new_meta_value !== $meta_value) {
        update_post_meta($post_id, $meta_key, $new_meta_value);
    } elseif ('' === $new_meta_value && $meta_value) {
        delete_post_meta($post_id, $meta_key, $meta_value);
    }   
}
add_action('save_post', 'Add_Save_Short_Title_meta', 10, 2);

/**
 * Get the Postmeta for the WP API
 * 
 * @param array $post An array of properties for the Post
 * 
 * @return array $postmeta Return the postmeta for the post
 */
function Get_Post_Meta_For_api( array $post) : array
{
    $post_id = $post['id'];

    return get_post_meta($post_id);
}

/**
 * Callback to register postmeta for the Post
 */
function Create_Api_Posts_Meta_field()
{
    register_rest_field(
        'articles',
        'article_short_title',
        array(
            'get_callback' => 'Get_Post_Meta_For_api',
            'schema' => null,
        )
    );
}
add_action('rest_api_init', 'Create_Api_Posts_Meta_field');