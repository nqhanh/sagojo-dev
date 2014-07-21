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
	<div id="featured" class="grid col-940">
		<!--<img src="<?php ///echo bloginfo('template_directory');?> /images/featured-image.jpg" height="439" width="960">-->
		<div id="layer">
				<h1 class="featured-subtitle">
					<?php
					if ( isset( $responsive_options['home_subheadline'] ) && $db && $empty )
						echo $responsive_options['home_subheadline'];
					else
						_e( 'Plum jobs, rewarding lives' );
					?>
				</h1>
				<div id="post-job-want-job">	
					<div class="grid-post-a-job fit-job">
						<?php responsive_widgets(); // above widgets hook ?>
						<div class="post-a-job ">
						<?php if(get_user_meta(wp_get_current_user()->ID, "is_employer")): ?>
							<a class="post-a-hover" href="<?php echo wpjb_link_to("step_add") ?>">  
						      <?php elseif(get_option('users_can_register')): ?>
                            <a class="post-a-hover" href="<?php echo wpjb_link_to("employer_new") ?>"> <?php endif; ?>
							<div class="post-title-home"><h2><?php _e('Post a job!','responsive'); ?></h2></div>
							<div class="posttexthome"><h3><?php _e('It&rsquo;s Free!','responsive'); ?><h3></div>
                            </a>   
						</div><!-- end of .widget-wrapper -->
						<?php responsive_widgets_end(); // responsive after widgets hook ?>
					</div><!-- end of .col-460 -->
			
					<div class="grid-want-a-job fit-job">
						<?php responsive_widgets(); // responsive above widgets hook ?>
						<div class="want-a-job"> 
						<?php  //if((wp_get_current_user()->ID>0)&&(!get_user_meta(wp_get_current_user()->ID, "is_employer"))):  ?>
							<a class="post-a-hover" href="<?php echo site_url();?>/?page_id=100">
	                           <?php //elseif(get_option('users_can_register')): ?>
							<!--<a href="<?php //echo wpjr_link_to("register") ?>">--><?php //endif; ?>
							<div class="post-title-home"><h2><?php _e('Want a job?','responsive'); ?></h2></div>
							<div class="posttexthome"><h3><?php _e('Sign up!','responsive'); ?></h3></div>
                            </a>           
						</div><!-- end of .widget-wrapper -->            
						<?php responsive_widgets_end(); // after widgets hook ?>
					</div><!-- end of .col-460 -->
					
					<div class="grid-bid-a-job fit-job fit">
						<?php responsive_widgets(); // responsive above widgets hook ?>
						<div class="bid-a-job"> 
							<a class="post-a-hover" href="<?php echo site_url();?>/freelance-page/">
							<div class="post-title-home"><h2><?php _e('Job Auction!','responsive'); ?></h2></div>
							<div class="posttexthome"><h3><?php _e('Post or bid!','responsive'); ?></h3></div>
                            </a>           
						</div><!-- end of .widget-wrapper -->            
						<?php responsive_widgets_end(); // after widgets hook ?>
					</div><!-- end of .col-460 -->
			  </div><!---End post-job-want-job--->
			  <div id="clear"></div><!--End Clear-->
		</div><!-- end of #layer -->
    
	</div><!-- end of #featured -->             
	<?php 
	get_sidebar('home');
	get_footer(); 
}
?>