<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Content/Sidebar Template
 *
   Template Name:  Pricing Tables
 *
 * @file           pricing_tables.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/pricing_tables.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

get_header(); ?>
<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/css/reset.css">
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/css/pricing-tables.css">
	<!--[if lte IE 9]><link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/css/ie.css"><![endif]-->

	<style>.pricing-table{margin: 0 auto;top: 20px;position: relative;}</style>
<div id="content" class="grid col-940 ">

<?php get_template_part( 'loop-header' ); ?>
        
			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>       
				<h1 class="post-title"><?php the_title(); echo ' ';_e("Job City/Location"); ?></h1>
                
                <div class="post-entry"><div style="padding-bottom: 100px;">
                    <table class="pricing-table">
	<thead>
		<tr class="plan">
			<td class="green">
				<h2><?php _e('Free','responsive')?></h2>
				<em><?php _e('30 days on site','responsive')?></em>
			</td>
			<td class="yellow">
				<h2><?php _e('Standard','responsive')?></h2>
				<em><?php _e('30 days on site','responsive')?></em>
			</td>
			<td class="orange">
				<h2><?php _e('Professional','responsive')?></h2>
				<em><?php _e('30 days on site','responsive')?></em>
			</td>
			<td class="blue">
				<h2><?php _e('Enterprise','responsive')?></h2>
				<em><?php _e('30 days on site','responsive')?></em>
			</td>
		</tr>
		<tr class="price">
			<td class="green">
				<p><span>$</span>0</p>
				<span><?php _e('Allows 1 Job Posting','responsive')?></span>
				<!--<a href="#"><?php _e('Join','responsive')?></a>-->
			</td>
			<td class="yellow">
				<p><span>$</span>50</p>
				<span><?php _e('Allows 1 Job Posting','responsive')?></span>
				<!--<a href="#"><?php _e('Join','responsive')?></a>-->
			</td>
			<td class="orange">
				<p><span>$</span>100</p>
				<span><?php _e('Allows 5 Job Postings','responsive')?></span>
				<!--<a href="#"><?php _e('Join','responsive')?></a>-->
			</td>
			<td class="blue">
				<p><span>$</span>200</p>
				<span><?php _e('Allows 5 Job Postings','responsive')?></span>
				<!--<a href="#"><?php _e('Join','responsive')?></a>-->
			</td>
		</tr>
	</thead>
	
	<tbody>
		<tr class="clock-icon">
			<td><?php _e('Admin will approve them','responsive')?></td>
			<td><?php _e('Admin will approve them','responsive')?></td>
			<td><?php _e('Admin will approve them','responsive')?></td>
			<td><?php _e('Admin will approve them','responsive')?></td>
		</tr>
		<tr class="basket-icon">
			<td style="background-position: 0 -120px;"><?php _e('Consultant email','responsive')?></td>
			<td><?php _e('1 consultant email','responsive')?></td>
			<td><?php _e('4 consultant emails','responsive')?></td>
			<td><?php _e('4 consultant emails','responsive')?></td>
		</tr>
		<tr class="star-icon">
			<td style="background-position: 0 -120px;"><?php _e('Listed on the homepage','responsive')?></td>
			<td><?php _e('7 days listed on the homepage','responsive')?></td>
			<td><?php _e('7 days listed on the homepage','responsive')?></td>
			<td><?php _e('14 days listed on the homepage','responsive')?></td>
		</tr>
		<tr class="heart-icon">
			<td style="background-position: 0 -120px;"><?php _e('Facebook job posting','responsive')?></td>
			<td><?php _e('Facebook job posting','responsive')?></td>
			<td><?php _e('Facebook job posting','responsive')?></td>
			<td><?php _e('Facebook job posting','responsive')?></td>
		</tr>
	</tbody>
	
	<tfoot>
		<tr>
			<td class="green"><div class="border-top"><p class="feature1"><?php _e('View applications in your inbox or online.','responsive')?></p></div></td>
			<td class="yellow"><div class="border-top"><p class="feature1"><?php _e('View applications in your inbox or online.','responsive')?></p></div>
			<div class="border-top"><p class="feature2"><?php _e('Online Job Posting for 30 days.','responsive')?></p></div></td>
			<td class="orange"><div class="border-top"><p class="feature1"><?php _e('View applications in your inbox or online.','responsive')?></p></div>
			<div class="border-top"><p class="feature2"><?php _e('Online Job Posting for 30 days.','responsive')?></p></div>
			<div class="border-top"><p class="feature3"><?php _e('Priority Search for 1 weeks.','responsive')?></p></div>
			<div class="border-top"><p class="feature4"><?php _e('Featured Job for 1 weeks.','responsive')?></p></div>
				<!--<div class="table-float">
					<span class="arrow"></span>
					<p>Allows 5 Job Postings, commission up to 60% !!!</p>
					<p class="big"><?php _e('Most popular','responsive')?></p>
				</div>-->
			</td>
			<td class="blue"><div class="border-top"><p class="feature1"><?php _e('View applications in your inbox or online.','responsive')?></p></div>
			<div class="border-top"><p class="feature2"><?php _e('Online Job Posting for 30 days.','responsive')?></p></div>
			<div class="border-top"><p class="feature3"><?php _e('Priority Search for 2 weeks.','responsive')?></p></div>
			<div class="border-top"><p class="feature4"><?php _e('Featured Job for 2 weeks.','responsive')?></p></div>
			<div class="border-top"><p class="feature5"><?php _e('Support and consulting for your recruitments.','responsive')?></p></div>
			<div class="border-top"><p class="feature6"><?php _e('Your company&prime;s logos on the homepage.','responsive')?></p></div></td>
		</tr>
	</tfoot>
	
</table>
</div>
<div class="tu-van-huong-nghiep">
<h2 id="conten-child-tieude"><?php _e('Priority Search','responsive')?></h2><p>
<?php _e('Jobs with Priority Search status appear at the top of the search results page when a relevant keyword is entered. This is likely to increase their exposure to potential job seekers.','responsive')?></p>
<h2 id="conten-child-tieude"><?php _e('Featured Job','responsive')?></h2><p>
<?php _e('Promote your job and increase its exposure. Featured Jobs are promoted via a special banner across our site.','responsive')?></p></div>
                </div><!-- end of .post-entry -->
            
				<?php get_template_part( 'post-data' ); ?>
				               
				<?php responsive_entry_bottom(); ?>      
			</div><!-- end of #post-<?php the_ID(); ?> --> 
			
			<?php responsive_entry_after(); ?>      
</div><!-- end of #content -->


<?php get_footer(); ?>
