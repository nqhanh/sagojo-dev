<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Content/Sidebar Template
 *
   Template Name:  Maketing Emails
 *
 * @file           marketingemail.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/marketingemail.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */
//page template
$userlevel = get_user_meta(wp_get_current_user()->ID, "wp_user_level",trues);
		if (($userlevel == 1)||($userlevel == 2)){ 

get_header(); ?>

<div id="content" class="grid col-620 ">
<?php get_template_part( 'loop-header' ); ?>
        
			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>       
				<h1 class="entry-title-coupon post-title-coupon">
					Email Marketing
				</h1>
                
                <div class="post-entry">
                    
					<div class="grid col-300">
					<a href="<?php echo site_url() ?>/jobseekeremail">
						<img src="<?php echo site_url()?>/wp-content/themes/responsive/images/mail-jobseeker.png">
						<br />Sent email to jobseeker
					</a>
					</div><!-- end of .col-300 -->
					<div class="grid col-300">
					<a href="<?php echo site_url() ?>/employeremail">
						<img src="<?php echo site_url()?>/wp-content/themes/responsive/images/mail-jobseeker.png">
						<br />Sent email to employer
					</a>
					</div><!-- end of .col-300 -->
					<div class="grid col-300 fit">
					<img src="<?php echo site_url()?>/wp-content/themes/responsive/images/mail-jobseeker.png">
						<br />Sent email to partner
					</div><!-- end of .col-300 fit -->
                </div><!-- end of .post-entry -->
            
				<?php get_template_part( 'post-data' ); ?>
				               
				<?php responsive_entry_bottom(); ?>      
			</div><!-- end of #post-<?php the_ID(); ?> --> 
			
			<?php responsive_entry_after(); ?>  


<?php
/*maketing_mails( 'is_employer', '1');*/ //loai tru nha tuyen dung - chi gui mail cho jobseeker
/*maketing_mails( 'is_employer', '0');*/ //gui mail cho nha tuyen dung
?>     
</div><!-- end of #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php 
}
else {
	get_header(); ?>

        <div id="content-full" class="grid col-940">
        
			<?php responsive_entry_before(); ?>
			<div id="post-0" class="error404">       
				<?php responsive_entry_top(); ?>

                <div class="post-entry">
                    
                    <?php get_template_part( 'loop-no-posts' ); ?>
                    
                </div><!-- end of .post-entry -->
				               
				<?php responsive_entry_bottom(); ?>      
			</div><!-- end of #post-0 -->       
			<?php responsive_entry_after(); ?>

        </div><!-- end of #content-full -->

<?php get_footer(); 
}
?>