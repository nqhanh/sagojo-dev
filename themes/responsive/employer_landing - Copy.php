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
					<div class="post-a-job-header">
						<h1 style="border-bottom: none;padding:60px 0 0 20px;"><?php _e('With HR Outsourcing Services, you will: ','responsive')?></h1>						
						<p><img src="<?php echo bloginfo('template_directory');?>/images/star.png"><strong><?php _e('Foster the process of seeking qualified candidates promptly.','responsive')?></strong></p>
						<p><img src="<?php echo bloginfo('template_directory');?>/images/star.png"><strong><?php _e('Save more valuable time in managing labors.','responsive')?></strong></p>
						<p><img src="<?php echo bloginfo('template_directory');?>/images/star.png"><strong><?php _e('Solve complicated materials in HR administrations efficiently.','responsive')?></strong></p>

					</div><div style="clear:both;"></div>
					
					
					<div class="grid col-460"><div class="effect2 postajob"><div class="postajob-title"><?php _e('Intelligent recruitment solutions','responsive')?></div><p><img src="<?php echo bloginfo('template_directory');?>/images/tick-image.png"><?php _e('View applications in your inbox or online.','responsive')?><br/><img src="<?php echo bloginfo('template_directory');?>/images/tick-image.png"><?php _e('We will review the job within 24 hours and add it to the site.','responsive')?><br/><img src="<?php echo bloginfo('template_directory');?>/images/tick-image.png"><?php _e('Post a job free of charge to our site.','responsive')?>
</p><span class="post-arrow"></span><div align="center"><a class="employer-button" href="<?php echo site_url()?>/post-a-job"><?php _e('POST A JOB','responsive')?></a>
					</div></div></div>
					<div class="grid col-460 fit"><div class="effect2 postajob"><div class="postajob-title"><?php _e('Need some work done?','responsive')?></div><p><img src="<?php echo bloginfo('template_directory');?>/images/tick-image.png"><?php _e('It&prime;s free and takes minutes.','responsive')?><br/><img src="<?php echo bloginfo('template_directory');?>/images/tick-image.png"><?php _e('Describe the work you need, and talented freelancers apply instantly with proposals.','responsive')?><br/><img src="<?php echo bloginfo('template_directory');?>/images/tick-image.png"><?php _e('Ready to get started?','responsive')?></p><span class="post-arrow"></span><div align="center"><a class="employer-button" href="<?php echo site_url()?>/jobs"><?php _e('POST A PROJECT','responsive')?></a>
					</div></div></div>
					<div style="clear:both;padding-top:40px;"></div>
					<div id="homeblog">
						<div class="widget-title"><?php _e('Job Posting Packages','responsive')?></div>
						<div class="textwidget"><?php _e('Our pricing is affordable and your guaranteed to get results from your job posting','responsive')?></div>
					</div>
					<div style="clear:both;padding-top:20px;"></div>
					<table class="features-table">
				<tr>
					<td></td>
					<td class="col-cell col-cell1 col-cellh yellow"><?php _e('Standard','responsive')?></td>
					<td class="col-cell col-cell2 col-cellh orange"><?php _e('Professional','responsive')?></td>
					<td class="col-cell col-cell3 col-cellh blue"><?php _e('Enterprise','responsive')?></td>			
				</tr>
				<tr>
					<td><?php _e('Color highlighted brings more attention','responsive')?></td>
					<td class="col-cell col-cell1"><img src="<?php echo bloginfo('template_directory');?>/images/check.png" width="16" height="16"></td>
					<td class="col-cell col-cell2"><img src="<?php echo bloginfo('template_directory');?>/images/check.png" width="16" height="16"></td>
					<td class="col-cell col-cell3"><img src="<?php echo bloginfo('template_directory');?>/images/check.png" width="16" height="16"></td>			
				</tr>
				<tr>
					<td><?php _e('Priority listing above other jobs','responsive')?></td>
					<td class="col-cell col-cell1"><img src="<?php echo bloginfo('template_directory');?>/images/check.png" width="16" height="16"></td>
					<td class="col-cell col-cell2"><img src="<?php echo bloginfo('template_directory');?>/images/check.png" width="16" height="16"></td>
					<td class="col-cell col-cell3"><img src="<?php echo bloginfo('template_directory');?>/images/check.png" width="16" height="16"></td>			
				</tr>
				<tr>
					<td><?php _e('Job posted in fanpage Facebook','responsive')?></td>
					<td class="col-cell col-cell1"><img src="<?php echo bloginfo('template_directory');?>/images/check.png" width="16" height="16"></td>
					<td class="col-cell col-cell2"><img src="<?php echo bloginfo('template_directory');?>/images/check.png" width="16" height="16"></td>
					<td class="col-cell col-cell3"><img src="<?php echo bloginfo('template_directory');?>/images/check.png" width="16" height="16"></td>
				</tr>
				<tr>
					<td><?php _e('Post a job for 30 days','responsive')?></td>
					<td class="col-cell col-cell1"><img src="<?php echo bloginfo('template_directory');?>/images/check.png" width="16" height="16"></td>
					<td class="col-cell col-cell2"><img src="<?php echo bloginfo('template_directory');?>/images/check.png" width="16" height="16"></td>
					<td class="col-cell col-cell3"><img src="<?php echo bloginfo('template_directory');?>/images/check.png" width="16" height="16"></td>
				</tr>
				<tr class="no-border">
					<td><a class="employer-button" href="<?php echo site_url()?>/job-pack" target=_blank><?php _e('View Job Pack','responsive')?></a></td>
					<td class="col-cell col-cell1 col-cellf"><?php _e('1 Job','responsive')?></td>
					<td class="col-cell col-cell2 col-cellf"><?php _e('5 Jobs','responsive')?></td>
					<td class="col-cell col-cell3 col-cellf"><?php _e('5 Jobs','responsive')?></td>				
				</tr>		
	</table>
                </div><!-- end of .post-entry -->
            
				<?php get_template_part( 'post-data' ); ?>
				               
				<?php responsive_entry_bottom(); ?>      
			</div><!-- end of #post-<?php the_ID(); ?> --> 
			
			<?php responsive_entry_after(); ?>      
</div><!-- end of #content -->


<?php get_footer(); ?>
