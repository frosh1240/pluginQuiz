<?php 
if(!defined('ABSPATH')) exit;

/* 
* crea un shortcode, uso quizbook
*/

function quizbook_shortcode($atts, $content = null){
    $arg = array(
        'post_type' => 'quizes',
        'posts_per_page' => 5
    );

    $quizbook = new WP_Query($arg);
    ?>

    <form name="quizbook_enviar" id="quizbook_enviar">
        <div class="quizbook" id="quizbook">
            <ul>
                <?php 
                while($quizbook->have_posts()): $quizbook->the_post();
                ?>

                <li data-pregunta="<?php echo get_the_ID(); ?>">
                    <h2><?php the_title('<h2>', '</h2>'); ?></h2>
                    <div class="quizbook_preguntas">
                        <?php the_content('<p>', '</p>'); ?>
                    </div>
                    <div>
                        <?php 
                            $opciones = get_post_meta(get_the_ID());

                            foreach($opciones as $llave => $opcion){
                                $resultado = quizbook_filtrar_preguntas($llave);
                                
                                
                                if($resultado === 0){
                                    $numero = explode('_', $llave);
                                    ?> 
                                    <div id="<?php echo get_the_ID() . ":" . $numero[2]; ?>"> 
                                        <?php echo $opcion[0]; ?>
                                    </div>
                                    <?php
                                }

                            }
                        ?>
                    </div>
                </li>
                <?php endwhile; wp_reset_postdata();
                ?>
            </ul>
        </div>
    </form>

    <?php
}

add_shortcode('quizbook', 'quizbook_shortcode');