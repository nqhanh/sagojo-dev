<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Content/Sidebar Template
 *
   Template Name:  List of applied jobs
 *
 * @file           applyjob.php
 * @package        Responsive 
 * @author         Hanhdo 
 * @copyright      2014
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/applyjob.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

get_header(); ?>

<?php
$user_id = wp_get_current_user()->ID;
$rows = $wpdb->get_results( "SELECT job_id,job_title,job_slug,applied_at FROM wpjb_application JOIN wpjb_job ON wpjb_application.job_id = wpjb_job.id WHERE wpjb_application.user_id = $user_id ORDER BY applied_at DESC" );
?>
<div id="content" class="grid col-620 ">
<?php get_template_part( 'loop-header' ); ?>
        
			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>       
				<h1 class="entry-title-coupon post-title-coupon">
					<?php _e('My applied jobs', 'responsive');?>
				</h1>
                
                <div class="post-entry-savejob">
                    <div id="coupon">
                        <?php foreach ( $rows as $row ) 
							{
								$id = $row->job_id;
								echo "<div id='container-my-jobs'>";
								echo "&nbsp;<img src='".site_url()."/wp-content/themes/responsive/images/checkit.jpg'> ".date_format(date_create($row->applied_at),'d/m/Y')." <a href = '".site_url()."/tim-viec-lam/view/".$row->job_slug."'>".$row->job_title."</a></div>";
							
							}
						?>
			
					</div>
                </div><!-- end of .post-entry -->
            
				<?php get_template_part( 'post-data' ); ?>
				               
				<?php responsive_entry_bottom(); ?>      
			</div><!-- end of #post-<?php the_ID(); ?> --> 
			
			<?php responsive_entry_after(); ?>      
</div><!-- end of #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>