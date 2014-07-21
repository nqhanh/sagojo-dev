<?php 


/**
 * Full Content Template
 *
   Template Name: Employers Page
 *
 * @file           for_employer.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/for_employer.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

?> 
<?php if(get_user_meta(wp_get_current_user()->ID, "is_employer")): ?>
							<?php $redirect = wpjb_link_to("step_add");							
									wp_redirect($redirect);
									exit();?>	
						<?php elseif(get_option('users_can_register')): ?>
							<?php $redirect = wpjb_link_to("employer_new");
								wp_redirect($redirect);
								exit();?>
						<?php endif; ?>
<?php  if((wp_get_current_user()->ID>0)&&(!get_user_meta(wp_get_current_user()->ID, "is_employer"))):  	
		$redirect = "?page_id=100";
			wp_redirect($redirect);
			exit();?>
<?php endif; ?> 