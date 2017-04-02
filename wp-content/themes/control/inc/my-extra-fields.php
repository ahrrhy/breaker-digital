<?php
// подключаем функцию активации мета блока (my_extra_fields)
add_action('add_meta_boxes', 'my_extra_fields', 1);

function my_extra_fields() {
    add_meta_box( 'extra_fields', 'Дополнительные поля', 'extra_fields_box_func', 'videos', 'normal', 'high'  );
}

// код блока
function extra_fields_box_func( $post ){
    ?>
    <p>Director's Chosen Video: <?php $mark_v = get_post_meta($post->ID, 'add_video', 1); ?>
        <label><input type="radio" name="extra[add_video]" value="not_added" <?php checked( $mark_v, '' ); ?> />Don't choose</label>
        <label><input type="radio" name="extra[add_video]" value="added" <?php checked( $mark_v, 'nofollow' ); ?> /> Choose</label>
    </p>

    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
    <?php
}

// включаем обновление полей при сохранении
add_action('save_post', 'my_extra_fields_update', 0);

/* Сохраняем данные, при сохранении поста */
function my_extra_fields_update( $post_id ){
    if ( ! wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false; // проверка
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; // выходим если это автосохранение
    if ( !current_user_can('edit_post', $post_id) ) return false; // выходим если юзер не имеет право редактировать запись

    if( !isset($_POST['extra']) ) return false; // выходим если данных нет

    // Все ОК! Теперь, нужно сохранить/удалить данные
    $_POST['extra'] = array_map('trim', $_POST['extra']); // чистим все данные от пробелов по краям
    foreach( $_POST['extra'] as $key=>$value ){
        if( empty($value) ){
            delete_post_meta($post_id, $key); // удаляем поле если значение пустое
            continue;
        }

        update_post_meta($post_id, $key, $value); // add_post_meta() работает автоматически
    }
    return $post_id;
}