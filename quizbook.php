<?php

/*
Plugin Name: Quizbook
Plguin URI: 
Description: Plugin para crear cuestionarios y exámenes con wordpress
Version: 1.0
Author: Carlos Moreno
Author URI:
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: quizbook
*/  

//Si el archivo se accede directamente, termina la ejecución
//if(!defined('ABSPATH')) die();
if(!defined('ABSPATH')) exit;

/*
* Añade posrtypes de quizes
*/
require_once plugin_dir_path(__FILE__) . 'includes/postTypes.php';

/* incluir los metaboxes campos para el formulario */
require_once plugin_dir_path(__FILE__) . 'includes/metaboxes.php';

/* se crea funciones de los roles */
require_once plugin_dir_path(__FILE__) . 'includes/roles.php';
register_activation_hook(__FILE__, 'quizbook_crear_role');
register_deactivation_hook(__FILE__, 'quizbook_remove_role');

register_activation_hook(__FILE__, 'quizbook_agregar_capabilities');
register_deactivation_hook(__FILE__, 'quizbook_remover_capabilites');


/*
* Añade el shortcode [quizbook]
*/ 

require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';

/*
* Regenera las reglas de las urls al activar el plugin
*/
register_activation_hook(__FILE__, 'quizbook_rewrite_flush');


/*
* Regenera las reglas de las urls al activar el plugin
*/
require_once plugin_dir_path(__FILE__) . 'includes/functions.php';
 