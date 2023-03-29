<?php 
/*
* permite salir del archivo si se accede directamente
*/
if(!defined('ABSPATH')) exit;

/*
* Agrega los campos personalizados al metabox de quizes
*/

function quizbook_agregar_metaboxes(){
    //agregar el metabox a quizes

    add_meta_box('quizbook_meta_boxes', 'Respuestas','quizbook_metaboxes', 'quizes', 'normal', 'high', null);

}

add_action('add_meta_boxes', 'quizbook_agregar_metaboxes');

/*
* Muestra el contenido del HTML de los MetaBoxes
*/

function quizbook_metaboxes($post){ 
    wp_nonce_field(basename(__FILE__), 'quizbook_nonce' );

    ?>
    <table class="form-table">
        <tr>
            <th class="row-title">
                <h2>Añade las respuestas aqui</h2>
            </th>
        </tr>
        <tr>
            <th class="row-title">
                <label for="qb_respuesta_1">a)</label>
            </th>
            <td>
                <input type="text" name="qb_respuesta_1" id="quizbook_respuesta_1" value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_respuesta_1',true)); ?>" class="regular-text">
            </td>
        </tr>
        <tr>
            <th class="row-title">
                <label for="quizbook_respuesta_2">b)</label>
            </th>
            <td>
                <input type="text" name="qb_respuesta_2" id="quizbook_respuesta_2" value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_respuesta_2',true)); ?>" class="regular-text">
            </td>
        </tr>
        <tr>
            <th class="row-title">
                <label for="quizbook_respuesta_3">c)</label>
            </th>
            <td>
                <input type="text" name="qb_respuesta_3" id="quizbook_respuesta_3" value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_respuesta_3',true)); ?>" class="regular-text">
            </td>
        </tr> 
        <tr>
            <th class="row-title">
                <label for="quizbook_respuesta_4">d)</label>
            </th>
            <td>
                <input type="text" name="qb_respuesta_4" id="quizbook_respuesta_4" value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_respuesta_4',true)); ?>" class="regular-text">
            </td>
        </tr>
        <tr>
            <th class="row-title">
                <label for="quizbook_respuesta_5">e)</label>
            </th>
            <td>
                <input type="text" name="qb_respuesta_5" id="quizbook_respuesta_5" value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_respuesta_5',true)); ?>" class="regular-text">
            </td>
        </tr>

        <tr>
            <th class="row-title">
                <label for="quizbook_correcta">Respuesta Correcta</label>
            </th>
            <td>
                <?php $respuesta = esc_html(get_post_meta($post->ID, 'quizbook_correcta', true)); ?>
                <select name="quizbook_correcta" id="quizbook_correcta" class="postbox">
                    <option>Elige la respuesta corercta</option>
                    <option <?php selected($respuesta, 'qb_correcta:a'); ?> value="qb_correcta:a">a</option>
                    <option <?php selected($respuesta, 'qb_correcta:b'); ?> value="qb_correcta:b">b</option>
                    <option <?php selected($respuesta, 'qb_correcta:c'); ?> value="qb_correcta:c">c</option>
                    <option <?php selected($respuesta, 'qb_correcta:d'); ?> value="qb_correcta:d">d</option>
                    <option <?php selected($respuesta, 'qb_correcta:e'); ?> value="qb_correcta:e">e</option>
                </select>
            </td>
        </tr>
    </table>
    
    <?php        
}

/*
* Guarda los datos del metabox
*/

function quizbook_guardar_metaboxes($post_id, $post, $update){

    // Verifica si el nonce es valido
    if(!isset($_POST['quizbook_nonce']) || !wp_verify_nonce($_POST['quizbook_nonce'], basename(__FILE__)) ) return;
    // Verifica si el usuario tiene permisos para guardar
    if(!current_user_can('edit_post', $post_id)) return;
    // Verifica si el post es un revision
    if(wp_is_post_revision($post_id)) return;
    // Verifica si el post es un post type de quizes
    if($post->post_type != 'quizes') return;
    // Verifica si el post es un auto guardado
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    

    // Guarda los datos del metabox
    /* if(isset($_POST['qb_respuesta_1'])){
        update_post_meta($post_id, 'qb_respuesta_1', sanitize_text_field($_POST['qb_respuesta_1']));
    }
    if(isset($_POST['qb_respuesta_2'])){
        update_post_meta($post_id, 'qb_respuesta_2', sanitize_text_field($_POST['qb_respuesta_2']));
    }
    if(isset($_POST['qb_respuesta_3'])){
        update_post_meta($post_id, 'qb_respuesta_3', sanitize_text_field($_POST['qb_respuesta_3']));
    }
    if(isset($_POST['qb_respuesta_4'])){
        update_post_meta($post_id, 'qb_respuesta_4', sanitize_text_field($_POST['qb_respuesta_4']));
    }
    if(isset($_POST['qb_respuesta_5'])){
        update_post_meta($post_id, 'qb_respuesta_5', sanitize_text_field($_POST['qb_respuesta_5']));
    }
    if(isset($_POST['quizbook_correcta'])){
        update_post_meta($post_id, 'quizbook_correcta', sanitize_text_field($_POST['quizbook_correcta']));
    } */

    for($i = 1; $i <= 5; $i++){
        if(isset($_POST['qb_respuesta_'.$i])){
            update_post_meta($post_id, 'qb_respuesta_'.$i, sanitize_text_field($_POST['qb_respuesta_'.$i]));
        }
    }




}

add_action('save_post', 'quizbook_guardar_metaboxes', 10, 3);