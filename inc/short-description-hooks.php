<?php
/**
 * Add the Short Title input filed to Metabox
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