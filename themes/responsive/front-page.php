<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Site Front Page
 Template Name: front page
 *
 * Note: You can overwrite front-page.php as well as any other Template in Child Theme.
 * Create the same file (name) include in /responsive-child-theme/ and you're all set to go!
 * @see            http://codex.wordpress.org/Child_Themes and
 *                 http://themeid.com/forum/topic/505/child-theme-example/
 *
 * @file           front-page.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/front-page.php
 * @link           http://codex.wordpress.org/Template_Hierarchy
 * @since          available since Release 1.0
 */

/**
 * Globalize Theme Options
 */
$responsive_options = responsive_get_options();
/**
 * If front page is set to display the
 * blog posts index, include home.php;
 * otherwise, display static front page
 * content
 */
if ( 'posts' == get_option( 'show_on_front' ) && $responsive_options['front_page'] != 1 ) {
	get_template_part( 'home' );
} elseif ( 'page' == get_option( 'show_on_front' ) && $responsive_options['front_page'] != 1 ) {
	$template = get_post_meta( get_option( 'page_on_front' ), '_wp_page_template', true );
	$template = ( $template == 'default' ) ? 'index.php' : $template;
	locate_template( $template, true );
} else { 

	get_header();
	
	//test for first install no database
	$db = get_option( 'responsive_theme_options' );
    //test if all options are empty so we can display default text if they are
    $empty = ( empty( $responsive_options['home_headline'] ) && empty( $responsive_options['home_subheadline'] ) && empty( $responsive_options['home_content_area'] ) ) ? false : true;
	?>
	
		
		
		<!--<img src="<?php ///echo bloginfo('template_directory');?>/images/featured-image.jpg" height="439" width="960">-->
		<div id="featured" class="grid col-940">
			<div class="slider">
					<style >
							#slide p {
								line-height: 20px;
								padding: 0 40px 0 40px;
							
							}
							
							.need-postion-s{font-weight: bold;}
							.one-post-s{text-transform: capitalize;
								font-weight: bold;}

								.free-post-s{
									text-transform: none;
									background: #f15a24;
									padding: 10px;
									text-decoration: none;
									color: #fff;
									font-size:20px;
									font-weight: 700;
								}
							</style>
					<div class="fs_loader" style="background: url(images/pattern.png) repeat;"></div>
					<div class="slide">
						
						<img 	src="<?php echo bloginfo('template_directory');?>/images/banner_puzzle.jpg"
								width="960px" height="279"			
								data-position="0,0" data-in="left" data-delay="200" data-out="right">
					
						<?php _e('<p class="need-postion-s" data-position="-8,30" data-in="top"><font color="#251E6E" size="20px">NEED A POSITION FILLED?</font></p>', 'responsive'); ?>
														
						<?php _e('<p class="one-post-s" data-position="70,200" data-in="left"><font color="#738FE6">Start by Signing Up or Post a Job</font></p>', 'responsive'); ?>		
						
						<?php _e('<p class="free-post-p" data-position="135,30" data-in="right"><a class="free-post-s" href="for-employer/" >Post a Job - It&prime;s <b>FREE!</b></a></p>', 'responsive'); ?>		
					
						<img 	src="<?php echo bloginfo('template_directory');?>/images/bg2.png"  width="960px" height="279"
								data-position="0,0"  data-delay="1" data-in="none" data-out="none" >
					</div>
					<div class="slide">
						
						<img 	src="<?php echo bloginfo('template_directory');?>/images/banner_stepup.jpg"  width="960px" height="279"
								data-position="0,0" data-in="fade" data-delay="200" data-out="bottomRight">
						
						<?php _e('<p class="" data-position="-8,30" data-in="top"  data-out="top"><font color="#333" style="font-weight: 700;">APPLY YOUR </font>&nbsp;<font style="font-weight: 700;" color="#251E6E" size="20px">DREAM JOB</font></p>', 'responsive'); ?>
										
						<?php _e('<p class="" data-position="70,165" data-in="right" data-step="2"><span style="font-weight: 700;"><font color="#738FE6" >POST YOUR RESUME </font>&nbsp;<font color="#f15a24">FREE</font></span></p>', 'responsive'); ?>		
						<?php _e('<p class="" data-position="135,30" data-in="bottom" data-step="2"><a class="free-post-s" href="resumes-board/my-resume/">Post Your Resume Now</a></p>', 'responsive'); ?>
						<img 	src="<?php echo bloginfo('template_directory');?>/images/bg2.png"  width="960px" height="279"
								data-position="0,0"  data-delay="1" data-in="none" data-out="none">													
					</div>
					
					<div class="slide">
						
						<img 	src="<?php echo bloginfo('template_directory');?>/images/banner_freelance.jpg"  width="960px" height="279"
								data-position="0,0" data-in="fade" data-delay="500" data-out="bottomRight">
								
						
						
						<?php _e('<p class="" data-position="-8,30" data-in="top" data-step="1" data-out="top"><font color="#333" style="font-weight: 700;">NEED SOME WORK </font>&nbsp;<font color="#251E6E" size="20px" style="font-weight: 700;">DONE?</font></p>', 'responsive'); ?>
										
						<?php _e('<p class="" data-position="70,130" data-in="bottom" data-step="1" ><font color="#738FE6" style="font-weight: 700;">Post a Project Today</font></p>', 'responsive'); ?>		
						<?php _e('<p class="" data-position="135,30" data-in="bottom" data-step="1"><a class="free-post-s" href="jobs/">Post a Project - It&prime;s FREE!</a></p>', 'responsive'); ?>
						
						<img 	src="<?php echo bloginfo('template_directory');?>/images/bg2.png"  width="960px" height="279"
								data-position="0,0"  data-delay="1" data-in="none" data-out="none">		
					</div>
				
				</div> <!---end slider--->
		<div id="layer">
				
				<div id="post-job-want-job">	
					
					
					<!--<div class="search grid fit-job fit">
						<?php responsive_widgets(); // responsive above widgets hook ?>
						<?php if (!dynamic_sidebar('right-sidebar')) : ?>
				            <div class="widget-wrapper">
				            
				                <div class="widget-title-home"><h3><?php _e('Sidebar Right', 'responsive'); ?></h3></div>
				                <div class="textwidget"><?php _e('This is your second home widget box. To edit please go to Appearance > Widgets and choose 7th widget from the top in area 7 called Home Widget 2. Title is also manageable from widgets as well.','responsive'); ?></div>
				            
							</div>
							<?php endif; //end of home-widget-2 ?>          
						<?php responsive_widgets_end(); // after widgets hook ?>
					</div>--><!-- end of .col-460 -->
			  </div><!---End post-job-want-job--->
			  <div id="clear"></div><!--End Clear-->
		</div><!-- end of #layer -->
    
	</div><!-- end of #featured -->             
	<?php 
	get_sidebar('colophon');
	echo "</div><div style='clear:both;'></div>";
	get_sidebar('right-half');
	get_sidebar('left-half');
	echo "<div style='clear:both;padding-top:40px;'></div>";		
	echo "<div id='vietnam-bg'>";
	echo "<div class=\"next_news col-300\">";
	include "wp-content/themes/responsive/map/index.php";
	echo "</div>";
	echo "<div id=\"widgets\" class=\"grid col-620 fit gallery-meta\">";
	require_once 'wp-content/themes/responsive/map/area.php';
	//get_sidebar('gallery');
	echo "</div></div><div style='clear:both;'></div>";	
	/*include "wp-content/themes/responsive/includes/type4.php";*/
	//include carousel posts

				if ( max_magazine_get_option( 'show_carousel' ) == 1 ){

					get_template_part('carousel'); 

				}
	//get_sidebar('home');
	get_footer(); 
}
?>