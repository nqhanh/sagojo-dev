<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Content/Sidebar Template
 *
   Template Name:  Employer Landing
 *
 * @file           employer_landing.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/employer_landing.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/css/style6.css" />
        <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css' />
        <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css' />
<div id="content" class="grid col-940 ">

<?php get_template_part( 'loop-header' ); ?>
        
			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>       
				
                
                <div class="post-entry">
				
				<h1 style="text-align:center;"><?php _e('Intelligent recruitment solutions','responsive')?></h1>
				<div style="clear:both;padding-top:40px;"></div>
				<div class="grid col-90">&nbsp;</div>
				<div class="grid col-220" style="text-align: center;">
					<div class="image-solution"><img src="<?php echo bloginfo('template_directory');?>/images/emailicon.jpg" width="100px"></div>
					<div class="text-solution"><?php _e('View applications in your inbox or online','responsive')?></div>
				</div>
				<div class="grid col-220" style="text-align: center;">
					<div class="image-solution"><img src="<?php echo bloginfo('template_directory');?>/images/clockicon.jpg" width="100px"></div>
					<div class="text-solution"><?php _e('We will review the job within 24 hours','responsive')?></div>
				</div>
				<div class="grid col-220" style="text-align: center;">
					<div class="image-solution"><img src="<?php echo bloginfo('template_directory');?>/images/calendaricon.jpg" width="100px"></div>
					<div class="text-solution"><?php _e('Post a job for 30 days','responsive')?></div>
				</div>
				<div class="grid col-90 fit">&nbsp;</div>
				<div style="clear:both;padding-top:40px;"></div>

				<div align="center"><a class="employer-button" href="<?php echo site_url()?>/post-a-job"><?php _e('POST A JOB','responsive')?></a></div>
				
				<div style="clear:both;padding-top:40px;"></div>
					<div class="post-a-job-header">
					<div class="grid col-940">
					<p><?php _e('Here are some of the benefits your organization will receive when you post your job openings at sagojo.com:','responsive')?></p>
					<span style="display:block;padding-left: 20px;"><img src="<?php echo bloginfo('template_directory');?>/images/check.png" width="16" height="16"><?php _e('Priority listing above other jobs.','responsive')?></span>
					<span style="display:block;padding-left: 20px;"><img src="<?php echo bloginfo('template_directory');?>/images/check.png" width="16" height="16"><?php _e('Job postings are featured on the home pages of sagojo.com and fanpage Facebook.','responsive')?></span>
					<span style="display:block;padding-left: 20px;"><img src="<?php echo bloginfo('template_directory');?>/images/check.png" width="16" height="16"><?php _e('New job postings are highlighted brings more attention.','responsive')?></span>
					<span style="display:block;padding-left: 20px;"><img src="<?php echo bloginfo('template_directory');?>/images/check.png" width="16" height="16"><?php _e('Your job postings will receive maximum exposure for a minimal fee!','responsive')?></span>	
					<div style="clear:both;padding-top:20px;"></div>
					<div id="homeblog">
						<h2 class="widget-title"><?php _e('Job Posting Packages','responsive')?></h2>
						<div class="textwidget"><?php _e('Our pricing is affordable and your guaranteed to get results from your job posting','responsive')?></div>
					</div>
					<div class="button-wrapper"><a href="<?php echo site_url()?>/job-pack" target=_blank class="a-btn">
                        <span></span>
						<span><?php _e('ENTER','responsive')?></span>
                        <span><?php _e('View Job Pack','responsive')?></span>
						</a></div>					
					</div></div>
					<div style="clear:both;padding-top:40px;"></div>
					<div class="grid col-460"><div class="effect2 postajob"><h3 class="postajob-title"><?php _e('With HR Outsourcing Services, you will: ','responsive')?></h3><p><img src="<?php echo bloginfo('template_directory');?>/images/tick-image.png"><?php _e('Foster the process of seeking qualified candidates promptly.','responsive')?><br/><img src="<?php echo bloginfo('template_directory');?>/images/tick-image.png"><?php _e('Save more valuable time in managing labors.','responsive')?><br/><img src="<?php echo bloginfo('template_directory');?>/images/tick-image.png"><?php _e('Solve complicated materials in HR administrations efficiently.','responsive')?></p><p><?php _e('Further information and supports please contact us via phone (08) 73091212 or email: tthang@aline.jp','responsive')?></p></div></div>
					<div class="grid col-460 fit"><div class="effect2 postajob"><h3 class="postajob-title"><?php _e('Need some work done?','responsive')?></h3><p><img src="<?php echo bloginfo('template_directory');?>/images/tick-image.png"><?php _e('It&prime;s free and takes minutes.','responsive')?><br/><img src="<?php echo bloginfo('template_directory');?>/images/tick-image.png"><?php _e('Describe the work you need, and talented freelancers apply instantly with proposals.','responsive')?></p><span class="post-arrow"></span><div align="center"><a class="employer-button" href="<?php echo site_url()?>/jobs"><?php _e('POST A PROJECT','responsive')?></a>
					</div></div></div>
					
                </div><!-- end of .post-entry -->
            
				<?php get_template_part( 'post-data' ); ?>
				               
				<?php responsive_entry_bottom(); ?>      
			</div><!-- end of #post-<?php the_ID(); ?> --> 
			
			<?php responsive_entry_after(); ?>      
</div><!-- end of #content -->


<?php get_footer(); ?>
