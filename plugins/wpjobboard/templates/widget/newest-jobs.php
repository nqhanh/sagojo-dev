<?php

/**
 * Recently posted jobs
 * 
 * Recent jobs widget template file
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Widget
 * 
 */

 /* @var $jobList array List of Wpjb_Model_Job objects */

?>
<style>
		
		.recentcontent{height: 490px;
			padding: 14px;
			overflow: auto;
			-moz-border-radius: 3px;
			border: 1px solid #e2e2e2;}
		.recentcontent p:nth-child(even){color:#999; font-family:Georgia,serif; font-size:17px; font-style:italic;}
		.recentcontent p:nth-child(3n+0){color:#c96;}
	</style>
<div style="clear:both;padding-top:60px;"></div>
<div id="wpjb_widget_recent_job_chinh" class="wbjp_widget">
<blockquote>
<?php _e("If you think you're too big for small jobs, maybe you're too small for big jobs", WPJB_DOMAIN);?>
<cite><?php _e("unnamed", WPJB_DOMAIN);?></cite>
</blockquote>
<?php echo $theme->before_widget ?>
<h5 class="tabber-widget-title">
<?php if($title) echo $theme->before_title.$title.$theme->after_title ?><div style="text-align:right; margin-top: -23px;">
            <a style="font-weight:normal;right;font-size: 15px;" href="<?php echo wpjb_url() ?>">
                <?php _e("view all &raquo;", WPJB_DOMAIN) ?>
            </a>
        </div></h5>
<div id="recentjob" class="recentcontent">
<cl>
    <?php if(!empty($jobList)): foreach($jobList as $job): ?>
    <li class="wpjb-recent-job">
        <a class="jb-recent-hover-link" href="<?php echo wpjb_link_to("job", $job) ?>" target="_blank">
			<!--<a href="<?php //echo wpjb_link_to("job", $job) ?>">--><strong>
			<?php /*esc_html_e(strip_tags(implode(' ',array_slice(explode(' ',$job->job_title),0,10)).'...'))*/ 

			esc_html_e(st_substr($job->job_title,50));
			?>
			</strong><!--</a>-->
			<br /><em><?php _e("", WPJB_DOMAIN); esc_html_e(" ".$job->company_name) ?></em>
			<br />
		</a>
        <!--<small>
            <?php //_e("Location", WPJB_DOMAIN); esc_html_e(": ".$job->locationToString()); ?>
        </small>-->
    </li>
    <?php endforeach; ?>
    <li style="margin-top: 27px;border: none;">
        <div style="text-align:right">
            <a href="<?php echo wpjb_url() ?>">
                <?php _e("view all &raquo;", WPJB_DOMAIN) ?>
            </a>
        </div>
    </li>
    <?php else: ?>
    <li><?php _e("No job listings found.", WPJB_DOMAIN) ?></li>
    <?php endif; ?>
    
</cl>
</div>
<?php echo $theme->after_widget ?></div>
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php //echo plugins_url('js/minified/jquery-1.9.1.min.js', __FILE__ );?>"%3E%3C/script%3E'))</script>
	<!-- custom scrollbars plugin -->	
	<script src="<?php //echo plugins_url('js/jquery.mCustomScrollbar.concat.min.js', __FILE__ );?>"></script>
	<script>
		(function($){
			$(window).load(function(){
				$("#recentjob").mCustomScrollbar({
					autoHideScrollbar:true,
					theme:"light-thin"
				});
			});
		})(jQuery);
	</script>