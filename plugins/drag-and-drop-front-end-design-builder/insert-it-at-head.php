<?php
/**
 * Plugin Name: Drag and Drop Front-End Design Builder
 * Plugin URI: http://wpsoft.com.br
 * Description: Design Builder that allow live edition in the front-end through the Limitless drag and drop system (http://themeforest.net/item/limitless-multipurpose-drag-n-drop-theme/5528738) - With this plugin always when you click in an element, their attributes are opened, avoiding waste of time to find it in a big list.
 * Version: 1.0
 * Author: diegpl, pkelbert
 * Author URI: http://wpsoft.com.br
 * License: GPL2
 */

function addOnHead() {
	echo "<script type='text/javascript' src='".plugins_url( 'drag-n-drop-element-click.js' , __FILE__ )."'></script>";
}

add_action('wp_head', 'addOnHead');


?>