 <?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Content/Sidebar Template
 *
   Template Name:  Action page
 *
 * @file           action.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/action.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */
 
if(isset($_POST['code'])){  
    $title = $_POST['code'];
get_header(); 
echo "<div id=\"content\" class=\"grid col-620 content-lost-pw\">";
?>
<?php get_template_part( 'loop-header' ); ?>
        
			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>       
				<h1 class="post-title"><?php the_title();?></h1> 
                
                <div class="post-entry">
<?php
  
 	
?>
<div class="post-entry"><?php
	global $wpdb;
	$datas = $wpdb->get_results("SELECT wpjb_job.id,wpjb_discount.used,wpjb_discount.max_uses,wpjb_discount.expires_at
										FROM wpjb_discount INNER JOIN wpjb_job
										ON wpjb_discount.id = wpjb_job.discount_id
										WHERE wpjb_discount.code = '$title'
										ORDER BY wpjb_job.id DESC");
	
	foreach ($datas as $data){
	$used = $data->used;
	$max_uses = $data->max_uses;
	$expires_at = $data->expires_at;
	$expires =  new DateTime($expires_at);
	$id = $data->id;
	$job = new Wpjb_Model_Job($id);
	$list[] = $job;
}
$jobList = $list;

	?>
<article class="post">	
	<div class="wpjb-job-content" style="clear:both;padding: 10px;">
	<h5 class="also-viewed" style="margin-top: 0em;"><?php _e('Job listing by this code', 'responsive') ?></h5>	
	<ul id="ul-apply">
    <?php if(!empty($jobList)): 	
	foreach($jobList as $job): ?>
    <li class="li-apply-job">
        <a class="apply-s" href="<?php echo wpjb_link_to("job", $job) ?>" target="_blank">
			<strong>
			<?php 
			esc_html_e($job->job_title);
			?>
			</strong>
		</a>
		
		<div id="apply-jobs1-local">
		<?php if($job->locationToString()):?>
				
				<span class="apply-s">
								&#8226;&nbsp;<?php _e("Job Location ", WPJB_DOMAIN) ?><?php esc_html_e($job->locationToString());?>
				</span>
				
				
		<?php endif; ?>
				<?php if($job->job_salary):?>
				<span class="apply-s">
								&#8226;&nbsp;<?php _e("Salary ", WPJB_DOMAIN);?><?php wpjb_job_salary($job).wpjb_job_currency($job);?>
							<?php else :?>
								&#8226;&nbsp;<?php _e("Salary ", WPJB_DOMAIN);?><?php _e("Negotiable", WPJB_DOMAIN);?>
				</span>
			<?php endif;?>
			
		</div>
		<div>
			<span>
				<?php _e("Date: ", WPJB_DOMAIN) ?><?php echo wpjb_job_created_at(get_option('date_format'), $job) ?>
			</span>
			<span class="apply-s"><?php _e('Views: ',WPJB_DOMAIN);  esc_html_e($job->stat_views);?></span>
			
		</div>
		<div style="clear:both;"></div>
   
    </li>
    <?php endforeach; ?>
	
    <?php else:
		$rows = $wpdb->get_results("SELECT * FROM wpjb_discount WHERE code = '$title'");
		foreach ($rows as $row){
			$used = $row->used;
			$max_uses = $row->max_uses;
			$expires_at = $row->expires_at;
			$expires =  new DateTime($expires_at);
		}
    ?><li class="li-apply-job"><?php _e("No job listings found.", WPJB_DOMAIN) ?></li>
    <?php endif; ?>
    <div class="wpjb-flash-error">
    <?php 
		echo "<div>"; _e("Your Job Pack's code status", WPJB_DOMAIN);
		echo "</div><div style='float:left;padding-right: 20px;'>";_e("Max uses: ", WPJB_DOMAIN); echo $max_uses;
		echo "</div><div style='float:left;padding-right: 20px;'>";_e("Usage: ", WPJB_DOMAIN); echo $used;		
		echo "</div><div style='float:left;padding-right: 20px;'>";_e("Remain: ", WPJB_DOMAIN); echo $max_uses-$used;
		echo "</div><div>";_e("Expires at: ", WPJB_DOMAIN); echo date_format($expires,'d/m/Y');echo "</div>";

	?>
	</div>
	</ul></div>
</article>
</div>


</div><!-- end of .post-entry -->
      
				<?php get_template_part( 'post-data' ); ?>
				               
				<?php responsive_entry_bottom(); ?>      
			</div><!-- end of #post-<?php the_ID(); ?> --> 
			
			<?php responsive_entry_after(); ?>      
</div><!-- end of #content -->
<?php


get_footer(); 
} else {
	echo "Access Denied";
}
?>