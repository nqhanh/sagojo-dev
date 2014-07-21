<?php 


/**
 * Full Content Template
 *
   Template Name: Jobseekers Page
 *
 * @file           categories.php
 * @package        Responsive 
 * @author         sagojo.com 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/categories.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

if(get_user_meta(wp_get_current_user()->ID, "is_employer")){
	$redirect = wpjb_link_to("step_add");
	wp_redirect($redirect);
	exit();
} 
else {
	//if(wp_get_current_user()->ID>0) { 					
		get_header(); ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Recommendation Page Widgets') ) : ?>  
		        <?php endif; ?>
		<div id="tabber-category"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Job Type Widgets') ) : ?>  
		        <?php endif; ?>  </div> 
		<div id="content" class="<?php echo implode( ' ', responsive_get_content_classes() ); ?>">
		<!--<div id="content-full" class="grid col-940">-->
		   <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Jobseeker Page Widgets') ) : ?>  
		        <?php endif; ?>    
			     
		</div><!-- end of #content -->
		<?php
		get_sidebar();
		get_footer(); 
} 
?>
