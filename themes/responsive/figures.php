<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Full Content Template
 *
   Template Name:  Sharing a figures
 *
 * @file           figures.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/figures.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

get_header(); ?>

<div id="content-full" class="grid col-940">
<?php get_template_part( 'loop-header' ); ?>
        
			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>       
				
                
                <div class="post-entry-fig-job-resume">
					<div id="fig-jobpost-resumes">
						<div id="fig-images-date">
						
							<div id="fig-images"> 
								<img src="<?php echo bloginfo('template_directory');?>/images/cropped-copy-logo_sagojo.png"/>
								<strong><?php echo date("Y-M-d");?></strong>
							</div>
							
						
						</div>
						<div id="jobpost-resumes">
							<div id="figures-job-post" > 
								<?php 
									$directory = "wp-content/plugins/wpjobboard/environment/resumes/";
									$filecount = 0;
									$files = glob($directory . "*.{pdf,doc,docx,rtf,txt}",GLOB_BRACE);
									if ($files){
									 $filecount = count($files);
									}
									$resumes_active = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wpjb_resume WHERE is_active = 1"),0);
									$total_resumes_results = $resumes_active + $filecount;
									echo "<h2 id='title-resumes'>Job Seekers</h2> <div id='fig-number-resumes'><a>".$total_resumes_results ."</a></div>";
								
								?>
								<div id="clear"></div>
							</div>	
								
								
							<div id="figures-resumes"> 
								<?php 
								//include 'connect.php'; 
								$total_job_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wpjb_job WHERE is_filled = 0"),0);  
						
								echo "<h2 id='title-job-post'>Job Postings</h2> <div id='fig-number-job-post'> <a>".$total_job_results."</a></div>"; 
								?>
								<div id="clear"></div>
								
							</div>
							
						</div>
						
						<div id="clear"></div>
					</div>
				</div><!-- end of .post-entry -->
				<?php get_template_part( 'post-data' ); ?>             
				<?php responsive_entry_bottom(); ?>      
			</div><!-- end of #post-<?php the_ID(); ?> --> 
			<?php responsive_entry_after(); ?>     
</div><!-- end of #content-full -->
<?php get_footer(); ?>
