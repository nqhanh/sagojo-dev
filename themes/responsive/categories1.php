<?php 


/**
 * Full Content Template
 *
   Template Name: Categories Page
 *
 * @file           categories.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/categories.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

/*Categories Page : ten hien thi trong luc ta tao page nhe nhin phan Template y*/
 ?>   
<?php if(get_user_meta(wp_get_current_user()->ID, "is_jobseeker")): ?>
							<?php $redirect = "index.php?page_id=100";
								wp_redirect($redirect);?>
						<?php elseif(get_option('users_can_register')): ?>
							<?php $redirect = "?page_id=275&job_resumes=/register";
								wp_redirect($redirect);?>
						<?php endif; ?>	
<?php get_sidebar(); ?>
<?php get_footer(); ?>
