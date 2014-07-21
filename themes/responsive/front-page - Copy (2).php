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
		<div id="featured"><div id="layer">
				
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