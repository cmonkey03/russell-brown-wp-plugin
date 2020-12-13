<?php

/**
 * Register Connect Custom Post Types
 * 
 * @package Wpplugin
 * 
 * @return null
 */
function Create_Custom_Post_types()
{
    register_post_type(
        'articles',
        array(
            'labels' => array(
                'name'=> __('Articles', 'Wpplugin'),
                'singular_name' => __('Article', 'Wpplugin'),
                'menu_name' => __('Articles', 'Wpplugin'),
                'add_new_item' => __('Add New Article', 'Wpplugin'),
            ),
        'menu_icon' => 'dashicons-calendar',
        'hierarchical' => false,
        'taxonomies' => $taxonomies,
        'capability_type' => 'post',
        'has_archive' => true,
        'rewrite' => array('slug' => 'articles'),
        'public' => true,
        'show_in_menu' => true,
        'show_in_admin_bar' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        )
    );
}

add_action('init', 'Create_Custom_Post_types');
