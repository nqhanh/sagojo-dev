<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Colophon Widget Template
 *
 *
 * @file           sidebar-ads.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/sidebar-ads.php
 * @link           http://codex.wordpress.org/Theme_Development#Widgets_.28sidebar.php.29
 * @since          available since Release 1.1
 */
?>
    
	<?php responsive_widgets_before(); // above widgets container hook ?>
        <?php responsive_widgets(); // above widgets hook ?>
        
       <?php 
	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Ads Widgets') ) :  
       endif; 
	    ?>

        <?php responsive_widgets_end(); // after widgets hook ?>
	<?php responsive_widgets_after(); // after widgets container hook ?>