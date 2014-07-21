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
#company-img { display: table-header-group;}
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
						<li class="fb-like" style="float: left; "  data-href="<?php echo site_url().$_SERVER["REQUEST_URI"] ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></li>
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
<div class="fb-comments" data-href="<?php echo site_url().$_SERVER["REQUEST_URI"] ?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
	
</div>
</div><!-- end of #post-273 -->
</div><!-- end of #content -->
<?php if($job->getEmployer(true)->getFileUrl()): ?>
            <div id="company-img"><div class="boxSep"><div class="imgLiquidFill imgLiquid"><img src="<?php echo $job->getEmployer(true)->getFileUrl() ?>" id="wpjb-logo" alt="" /></div></div></div>
            <?php endif; ?>
<div><!-- open of #post-273 -->
<div><!-- open of #content -->
<?php //dong 4 div ?>
</div></div></div></div>

<?php if($show_related && !empty($related)): ?>
	
<div id="custom-widgets" class="grid col-300 fit">	
	<div class="effect4">
		<div id="wpjb-related-job" class="widget-7 widget-odd feature-job-inside widget-wrapper widget_wpjb-featured-jobs">
			<div class="widget-title"><?php _e("Related Jobs", WPJB_DOMAIN) ?></div>
				<div id="wpjb_widget_related" class="wbjp_widget">
				<ul>
					<?php foreach($related as $relatedJob): ?>
					<li>
						<a href="<?php echo wpjb_link_to("job", $relatedJob) ?>" class="job_title_id" target="_blank"><?php esc_html_e(st_substr($relatedJob->job_title,30)) ?></a>
						<a href="<?php echo wpjb_link_to("job", $relatedJob) ?>" class="com_id"><?php _e("<br>", WPJB_DOMAIN); esc_html_e(" ".$relatedJob->company_name) ?></a>
						<!--<br />-->
						<!--<small>
							<?php //_e("Location", WPJB_DOMAIN); esc_html_e(": ".$job->locationToString()) ?>
						</small>-->
					</li>
					<?php endforeach; ?>
				   
				</ul>
			</div>
		</div>
	</div>
	
	<?php
	global $wpdb;
	$datas = $wpdb->get_results("SELECT wpjb_job.id
										FROM wpjb_viewed INNER JOIN wpjb_job
										ON wpjb_viewed.J_ID = wpjb_job.id
										WHERE wpjb_job.id <> $job->id
										AND wpjb_job.job_category = $job->job_category
										GROUP BY id
										ORDER BY id DESC
										LIMIT 7");
	
	foreach ($datas as $data){
	$id = $data->id;
	$job = new Wpjb_Model_Job($id);
	$list[] = $job;
}
$jobList = $list;

	?>
	
	
	<div class="effect4">
		<div id="wpjb-alsoviewed-job" class="widget-7 widget-odd feature-job-inside widget-wrapper widget_wpjb-featured-jobs">
			<div class="widget-title"><?php _e("Recommend Jobs", WPJB_DOMAIN) ?></div>
				<div id="wpjb_widget_alsoviewed" class="wbjp_widget">
				<ul>
					<?php foreach($jobList as $alsojob): ?>
					<li>
						<a href="<?php echo wpjb_link_to("job", $alsojob) ?>" class="job_title_id" target="_blank"><?php esc_html_e(st_substr($alsojob->job_title,30)) ?></a>
						<a href="<?php echo wpjb_link_to("job", $alsojob) ?>" class="com_id"><?php _e("<br>", WPJB_DOMAIN); esc_html_e(" ".$alsojob->company_name) ?></a>
						<!--<br />-->
						<!--<small>
							<?php //_e("Location", WPJB_DOMAIN); esc_html_e(": ".$job->locationToString()) ?>
						</small>-->
					</li>
					<?php endforeach; ?>
				   
				</ul>
			</div>
		</div>
	</div>

</div>

    <?php endif; ?>
	
<?php //mo lai 4 div ?>
<div id="content-1" class="grid col-300 fit"><div><div><div>