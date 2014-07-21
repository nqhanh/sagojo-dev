<!--Neu la nguoi tim viec-->
    <?php  if((!get_user_meta(wp_get_current_user()->ID, "is_employer"))&&(strpos($_SERVER["REQUEST_URI"],'/view/')===false)):  ?>
<?php

/**
 * Featured Jobs
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
<span class="star-burst"><span><span><span>HOT</span></span></span></span>
<div class="effect4">
<?php echo $theme->before_widget ?>
<?php if($title) echo $theme->before_title.$title.$theme->after_title ?>
<div id="wpjb_widget_featured" class="wbjp_widget">
<ul>
    <?php if(!empty($jobList)): foreach($jobList as $job): ?>
    <li>
        <a href="<?php echo wpjb_link_to("job", $job) ?>" class="job_title_id" target="_blank"><?php esc_html_e(st_substr($job->job_title,30)) ?></a>
        <a href="<?php echo wpjb_link_to("job", $job) ?>" class="com_id"><?php _e("<br>", WPJB_DOMAIN); esc_html_e(" ".$job->company_name) ?></a>
        <!--<br />-->
        <!--<small>
            <?php //_e("Location", WPJB_DOMAIN); esc_html_e(": ".$job->locationToString()) ?>
        </small>-->
    </li>
    <?php endforeach; ?>
	<li class="hot-cat-li-all"><a href="<?php echo site_url();?>/viec-lam/#wpjb_widget_recent_job_chinh"><?php _e("view all &raquo;", WPJB_DOMAIN) ?></a></li>
    <?php else: ?>
    <li><?php _e("No featured jobs found.", WPJB_DOMAIN) ?></li>
    <?php endif; ?>
</ul>
</div>
<?php echo $theme->after_widget ?>
</div>
<?php endif; ?>
<!--End neu la nguoi tim viec-->