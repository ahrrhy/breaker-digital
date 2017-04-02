<?php

// Register Video Post Type

add_action('init', 'register_post_types');
function register_post_types(){
    register_post_type('videos', array(
        'labels' => array(
            'name'               => 'videos', // plural post name
            'singular_name'      => 'video', // single post name of this time
            'add_new'            => 'Add new',
            'add_new_item'       => 'Add new video',
            'edit_item'          => 'Edit video',
            'new_item'           => 'New video',
            'view_item'          => '',
        ),
        'description'        => '',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'rewrite'          => true,
        'menu_icon'          => 'dashicons-video-alt2',
        'supports'           => array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields',
            'revisions',
            'page-attributes',
            'post-formats'),
        'taxonomies'         => array('directors'),
        'has_archive'        => true
    ) );
}

// register Directors Taxonomy
add_action('init', 'create_taxonomy');
function create_taxonomy(){
// Labels
// list: http://wp-kama.ru/function/get_taxonomy_labels
    $labels = array(
        'name'              => 'Directors',
        'singular_name'     => 'Director',
        'search_items'      => 'Search Directors',
        'all_items'         => 'All Directors',
        'edit_item'         => 'Edit Director',
        'update_item'       => 'Update Director',
        'add_new_item'      => 'Add New Director',
        'new_item_name'     => 'New Director Name',
        'menu_name'         => 'Directors',
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
    register_taxonomy('directors', array('videos'), $args );
}

function pippin_taxonomy_add_new_meta_field($term) {
// this will add the custom meta field to the add new term page
    ?>
    <div class="form-field">
        <label for="term_meta[photo-directed]">Add url photo:</label>
        <input type="text" id="term_meta[photo-directed]" name="term_meta[photo-directed]" value="<?php echo get_term_meta($term->term_id, 'photo-directed', 1); ?>" />
    </div>
    <?php
}
add_action( 'directors_add_form_fields', 'pippin_taxonomy_add_new_meta_field', 10, 2 );

// Edit term page
function pippin_taxonomy_edit_meta_field($term) {?>

    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="term_meta[photo-directed]">Add url photo:</label>
        </th>
        <td>
            <input type="text" id="term_meta[photo-directed]" name="term_meta[photo-directed]" value="<?php echo get_term_meta($term->term_id, 'photo-directed', 1); ?>" />
        </td>
    </tr>

    <?php
}
add_action( 'directors_edit_form_fields', 'pippin_taxonomy_edit_meta_field', 10, 2 );

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        foreach( $_POST['term_meta'] as $key=>$value ){
            if( empty($value) ){
                delete_term_meta( $term_id, $key); // Delete the field if the value is empty
                continue;
            }

            update_term_meta($term_id, $key, $value); // add_post_meta() работает автоматически
        }
    }

    return $term_id;
}
add_action( 'edited_directors', 'save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_directors', 'save_taxonomy_custom_meta', 10, 2 );