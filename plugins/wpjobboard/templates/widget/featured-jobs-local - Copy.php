<?php

/**
 * Featured Local Jobs
 * 
 * Featured jobs widget template file
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Widget
 * 
 */

 /* @var $jobList array List of Wpjb_Model_Job objects */

?>
<script src="<?php echo plugins_url('js/jquery-latest.pack.js', __FILE__ );?>" type="text/javascript"></script> 
<script src="<?php echo plugins_url('js/jcarousellite_1.0.1c4.js', __FILE__ );?>" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
	$(".newsticker-jcarousellite").jCarouselLite({
		vertical: true,
		hoverPause:true,
		visible: 1,
		auto:500,
		speed:3000
	});
});
</script>


<?php echo $theme->before_widget ?>
<?php if($title) echo $theme->before_title.$title.$theme->after_title ?>
<div id="wpjb_widget_featured" class="wbjp_widget"><div class="newsticker-jcarousellite">
<ul>
    <?php if(!empty($jobList)): foreach($jobList as $job): ?>
    
    <li><div style="text-align:center;padding: 5px 0px;border: 1px solid #e2e2e2;margin-right: 1px;"><a href="<?php echo wpjb_link_to("job", $job) ?>"><img src="<?php echo $job->getImageUrl() ?>" id="wpjb-logo" alt="" /></a></div>
        <div style="background-color:#e2e2e2;padding:5px;"><a href="<?php echo wpjb_link_to("job", $job) ?>" class="job_id"><?php esc_html_e(strip_tags(implode(' ',array_slice(explode(' ',$job->job_title),0,5)).'...')) ?></a>
        <?php _e(" | ", WPJB_DOMAIN); esc_html_e(" ".$job->company_name) ?><br>
        <?php esc_html_e(strip_tags(implode(' ',array_slice(explode(' ',$job->job_description),0,40)).'...')) ?>
        </div>
    </li>
    <?php endforeach; ?>
    <?php else: ?>
    <li><?php _e("No featured jobs found.", WPJB_DOMAIN) ?></li>
    <?php endif; ?>
</ul></div>
</div>
<?php echo $theme->after_widget ?>