<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Content/Sidebar Template
 *
   Template Name:  List of saved jobs
 *
 * @file           savejob.php
 * @package        Responsive 
 * @author         Hanhdo 
 * @copyright      2014
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/savejob.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

get_header(); ?>

<?php
$user_id = wp_get_current_user()->ID;
$rows = $wpdb->get_results( "SELECT id,job_title,job_slug ,date FROM wpjb_save JOIN wpjb_job ON wpjb_save.j_id = wpjb_job.id WHERE wpjb_save.js_id = $user_id ORDER BY date DESC" );
?>
<div id="content" class="grid col-620 ">
<?php get_template_part( 'loop-header' ); ?>
        
			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>       
				<h1 class="entry-title-coupon post-title-coupon">
					<?php _e('My saved jobs', 'responsive');?>
				</h1>
                
                <div class="post-entry-savejob">
                    <div id="coupon">
                        <?php foreach ( $rows as $row ) 
							{
								$id = $row->id;
								echo "<div id='container-my-jobs'>";
								echo "<div id='shown_first_".$id."' style='display:inline;float:left;'><a  href = 'javascript:void(0)' onClick='delsavedjob(".$user_id.",".$id.",\"shown_first_".$id."\", \"hidden_first_".$id."\");'><img src='".site_url()."/wp-content/themes/responsive/images/Delete-icon.png' alt='Delete this saved job' title='Delete this saved job'></a></div>";
								echo "<div id='hidden_first_".$id."' style='display:none;float:left;'><a href = '#'><img src='".site_url()."/wp-content/themes/responsive/images/attributes_delete_icon.png' alt='Deleted' title='Deleted'></a></div>";
								echo "&nbsp;<img src='".site_url()."/wp-content/themes/responsive/images/floppy-icon.gif'>".date_format(date_create($row->date),'d/m/Y')." <a href = '".site_url()."/tim-viec-lam/view/".$row->job_slug."'>".$row->job_title."</a></div>";
							
							}
						?>
			<script type="text/javascrip">			
		    function delsavedjob(js_id,j_id,shown, hidden)
		    {
				var e = document.getElementById(shown);
		        var f = document.getElementById(hidden);
		     if(e.style.display == 'inline') {
		                   e.style.display = 'none';
		                   f.style.display = 'inline';
		       }
		       else {
		                   e.style.display = 'inline';
		                   f.style.display = 'none';
		       }
		    var xmlhttp;
		    if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
		    else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
				    xmlhttp.open("GET","<?php echo site_url()?>/wp-content/banners/delete-save-job.php?q="+js_id+"&c="+j_id,true);
				    xmlhttp.send();
		    }
	    	</script>
					</div>
                </div><!-- end of .post-entry -->
            
				<?php get_template_part( 'post-data' ); ?>
				               
				<?php responsive_entry_bottom(); ?>      
			</div><!-- end of #post-<?php the_ID(); ?> --> 
			
			<?php responsive_entry_after(); ?>      
</div><!-- end of #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>