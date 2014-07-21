<?php

/**
 * Job details container
 * 
 * Inside this template job details page is generated (using function 
 * wpjb_job_template)
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 * 
 * @var $job Wpjb_Model_Job
 * @var $related array List of related jobs
 * @var $show_related boolean
 */

?>
<style>
#content   { display: table; }
#post-273  { display: table-footer-group; }
#searchbox { display: table-header-group;}
</style>
<link rel="stylesheet" href="<?php echo plugins_url('js/main.css', __FILE__ );?>"/>

<div id="wpjb-main" class="wpjb-job wpjb-page-single">

    <?php wpjb_flash() ?>
    <?php wpjb_job_template() ?>
    <?php wpjb_job_tracker() ?>
    <?php $user_id = wp_get_current_user()->ID;?>

    <?php if(!wpjb_conf("front_hide_apply_link")): ?>
    <div class="wpjb-job-apply">
    <div style="float:left;">
	
    <?php
    	
    	if(empty($rows)){
	?>
				
        		<a class="wpjb-button" href="<?php echo wpjb_link_to("apply", $job) ?>"><?php _e("Apply online", WPJB_DOMAIN) ?></a>
        
        <?php } else {echo "<a class='wpjb-button'>"; _e("Applied", WPJB_DOMAIN); echo "</a>"; }
        
        if ($user_id > 0):?>     
    <div id="shown_first" style="display:inline">
        <a class="wpjb-button" href = "javascript:void(0)" onClick="savejob(<?php echo $user_id;?>,<?php echo $job->getId();?>,'shown_first', 'hidden_first');"><?php _e("Save this job", WPJB_DOMAIN) ?></a>
	</div>
	<div id="hidden_first" style="display:none">
        <a href = "#" class="wpjb-button"><?php _e("Successfully saved", WPJB_DOMAIN) ?></a>
	</div>     
        <script type="text/javascript">       
		    function savejob(js_id,j_id,shown, hidden)
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
				    xmlhttp.open("GET","<?php echo site_url()?>/wp-content/banners/save-job.php?q="+js_id+"&c="+j_id,true);
				    xmlhttp.send(); 				
		    }
	    	</script>
	    	<?php endif; ?>
	    	</div>
	    	<div id="facebook-like_share">
					
					<!--BEGIN code FB like-->
						<ul class="like-buttons">
						<li class="print-sagojo"><?php if(function_exists('pf_show_link')){echo pf_show_link();} ?></li>
						<li class="email-sagojo"><?php if(function_exists('instaemail_show_link')){echo instaemail_show_link();} ?></li>
						<li class="fb-like" style="float: left; "  data-href="<?php echo $return_link;?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></li>
						<li class="g-plus-one" style="float: left; margin-top: 5px;"><g:plusone size="medium"></g:plusone></li>
						
						</ul>
						<div class='clear h20'></div>
						<!--END code FB like-->
					
      </div>
       <!-- <?php _e("or", WPJB_DOMAIN) ?>
		<a href="<?php echo site_url() ?>/?page_id=100">&nbsp;<?php _e("cancel and go back", WPJB_DOMAIN) ?></a> -->
        <!--<a class="wpjb-cancel" href="<?php //echo wpjb_url() ?>"><?php //_e("cancel and go back", WPJB_DOMAIN) ?></a>-->
    </div>
    <?php endif; ?>
<div class="fb-comments" data-href="<?php echo get_permalink();?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>

	
	<?php if($show_related && !empty($related)): ?>
	<article class="post"><em></em>
	<div class="wpjb-job-content" style="clear:both;padding: 10px;">
		<h5 class="also-viewed" style="margin-top: 0em;"><?php _e("Related Jobs", WPJB_DOMAIN) ?></h5>
		
		
		<ul id="ul-apply">
		<?php foreach($related as $relatedJob): ?>
			<li class="li-apply-job">
				<a class="apply-s" href="<?php echo wpjb_link_to("job", $relatedJob) ?>" target="_blank">
					<strong>
					<?php 
					esc_html_e($relatedJob->job_title);
					?>
					</strong>
				</a>
				
				<div id="apply-jobs1-local">
				<?php if($relatedJob->locationToString()):?>
						
						<span class="apply-s">
										&#8226;&nbsp;<?php _e("Job Location ", WPJB_DOMAIN) ?><?php esc_html_e($relatedJob->locationToString());?>
						</span>
						
						
				<?php endif; ?>
						<?php if($relatedJob->job_salary):?>
						<span class="apply-s">
										&#8226;&nbsp;<?php _e("Salary ", WPJB_DOMAIN);?><?php wpjb_job_salary($relatedJob).wpjb_job_currency($relatedJob);?>
									<?php else :?>
										&#8226;&nbsp;<?php _e("Salary ", WPJB_DOMAIN);?><?php _e("Negotiable", WPJB_DOMAIN);?>
						</span>
					<?php endif;?>
					
				</div>
				<div>
					<span>
						<?php _e("Date: ", WPJB_DOMAIN) ?><?php echo wpjb_job_created_at(get_option('date_format'), $relatedJob) ?>
					</span>
					<span class="apply-s"><?php _e('Views: ',WPJB_DOMAIN);  echo $relatedJob->stat_views+rand(7, 123);?></span>
					
				</div>
				<div style="clear:both;"></div>
		   
			</li>
		<?php endforeach; ?>
		</ul>

    </div>
	</article>
    <?php endif; ?>
	
</div>

</div>
</div><!-- end of #post-273 -->
</div><!-- end of #content -->
<div class="effect2">
<div id="searchbox" class="widget_wpjb-search">
<form action="<?php echo wpjb_link_to("search"); ?>" method="get">
        <?php if(!$use_permalinks): ?>
        <input type="hidden" name="page_id" value="<?php echo Wpjb_Project::getInstance()->conf("link_jobs") ?>" />
        <input type="hidden" name="job_board" value="find" />
        <?php endif; ?>
        <?php 
		
		global $wpdb;
        $rows = $wpdb->get_results( "SELECT * FROM wpjb_category" );
        $selectBox1  = '';
        $selectBox1 .= '<select  class="cate_sl" name="category" style="color:#959595;">';
        $selectBox1 .= '<option value="" selected">'.__("All categories", WPJB_DOMAIN).'</option>';
			foreach ( $rows as $row ) 
			{
				$selectBox1 .= '<option value="'.$row->id.'" style="color:#555555;">'.__($row->title).'</option>';
			}
		$selectBox1 .= '</select>';
		echo $selectBox1;
					$city_file = WP_PLUGIN_DIR."/wpjobboard/application/config/city_list.ini" ;
					if (file_exists($city_file) && is_readable($city_file))
					{
						$citys=parse_ini_file($city_file,true);
						?>
						<select  class="location_sl" name="location" id="city" style="color:#959595;">
						<option value="" selected><?php _e("Any location", WPJB_DOMAIN) ?></option>
						<?php						   
						foreach ($citys as $city) { 
							?>
							<option value="<?php echo $city['iso2']; ?>" style="color:#555555;"><?php _e($city['name']) ?></option>
							<?php
							}
							?>
							</select>
							<?php						
					}
					else
					{
						// If the configuration file does not exist or is not readable, DIE php DIE!
						die("Sorry, the $city_file file doesnt seem to exist or is not readable!");
					}
					
					
							?>
		
							
		<input class="position_vt" type="text" name="query" placeholder="<?php _e("Enter job title, position,..." ,WPJB_DOMAIN) ?>" />
        <input class="bt_sm job_search"  type="submit" value="" />
    </form>
</div>
</div><!-- end of .effect2 -->

<div><div><div>

	