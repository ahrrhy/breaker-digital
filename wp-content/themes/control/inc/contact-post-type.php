<?php

// Register Contacts Post Type

add_action('init', 'register_post_types_contact');
function register_post_types_contact(){
    register_post_type('contacts', array(
        'labels' => array(
            'name'               => 'Contacts', // plural post name
            'singular_name'      => 'Contact', // single post name of this time
            'add_new'            => 'Add new',
            'add_new_item'       => 'Add new Contact',
            'edit_item'          => 'Edit Contact',
            'new_item'           => 'New Contact',
            'view_item'          => '',
        ),
        'description'        => '',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,

        'rewrite'          => true,

        'menu_icon'          => 'dashicons-location-alt',
        'supports'           => array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields',
            'revisions',
            'page-attributes',
            'post-formats'),
        'taxonomies'         => array('locations'),
        'has_archive'        => true
    ) );
}

// register Locations Taxonomy
add_action('init', 'create_taxonomy_location');
function create_taxonomy_location(){
// Labels
// list: http://wp-kama.ru/function/get_taxonomy_labels
    $labels = array(
        'name'              => 'Locations',
        'singular_name'     => 'Location',
        'search_items'      => 'Search Locations',
        'all_items'         => 'All Locations',
        'edit_item'         => 'Edit Location',
        'update_item'       => 'Update Location',
        'add_new_item'      => 'Add New Location',
        'new_item_name'     => 'New Location Name',
        'menu_name'         => 'Locations',
        'parent_item'       => null,
        'parent_item_colon' => null,
    );
// parameters
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'show_tagcloud'         => false, // равен аргументу show_ui
        'hierarchical'          => true,
        'update_count_callback' => '',
        'capabilities'          => array(),
        'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
        '_builtin'              => false,
        'query_var'             => true, // название параметра запроса
        'rewrite'               => true,
    );
    register_taxonomy('locations', array('contacts'), $args );
}





