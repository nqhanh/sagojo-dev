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
		
		.scrollcontent{height: 310px;
			padding: 14px;
			overflow: auto;
			-moz-border-radius: 3px;
			border: 2px solid #e2e2e2;}
		.scrollcontent p:nth-child(even){color:#999; font-family:Georgia,serif; font-size:17px; font-style:italic;}
		.scrollcontent p:nth-child(3n+0){color:#c96;}
	</style>
<link href="<?php echo plugins_url('js/jquery.mCustomScrollbar.css', __FILE__ );?>" rel="stylesheet" />
<div id="wpjb_widget_recent_job_chinh" class="wbjp_widget">

<?php echo $theme->before_widget ?>
<?php if($title) echo $theme->before_title.$title.$theme->after_title ?>
<div id="scrolljob" class="scrollcontent">
<al>
    <?php if(!empty($jobList)): foreach($jobList as $job): ?>
    <li class="wpjb-recent-job">
        <a class="jb-recent-hover-link" href="<?php echo wpjb_link_to("job", $job) ?>" target="_blank">
			<!--<a href="<?php //echo wpjb_link_to("job", $job) ?>">--><strong>
			<?php /*esc_html_e(strip_tags(implode(' ',array_slice(explode(' ',$job->job_title),0,10)).'...'))*/ 

			esc_html_e(st_substr($job->job_title,25));
			?>
			</strong><!--</a>-->
			<br /><em><?php _e("", WPJB_DOMAIN); esc_html_e(st_substr(" ".$job->company_name,30)) ?></em>
			<br />
		</a>
        <!--<small>
            <?php //_e("Location", WPJB_DOMAIN); esc_html_e(": ".$job->locationToString()); ?>
        </small>-->
    </li>
    <?php endforeach; ?>
    <!--<li>
        <div style="text-align:right">
            <a href="<?php /*echo wpjb_url()*/ ?>">
                <b><?php //_e("view all &raquo;", WPJB_DOMAIN) ?></b>
            </a>
        </div>
    </li>-->
    <?php else: ?>
    <li><?php _e("No job listings found.", WPJB_DOMAIN) ?></li>
    <?php endif; ?>
</al>
</div>
<?php echo $theme->after_widget ?></div>
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo plugins_url('js/minified/jquery-1.9.1.min.js', __FILE__ );?>"%3E%3C/script%3E'))</script>
	<!-- custom scrollbars plugin -->	
	<script src="<?php echo plugins_url('js/jquery.mCustomScrollbar.concat.min.js', __FILE__ );?>"></script>
	<script>
		(function($){
			$(window).load(function(){
				$("#scrolljob").mCustomScrollbar({
					autoHideScrollbar:true,
					theme:"light-thin"
				});
			});
		})(jQuery);
	</script>