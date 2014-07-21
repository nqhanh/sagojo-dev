<?php

/**
 * Job types 
 * 
 * Job types widget template
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Widget
 * 
 */

 /* @var $job_types array List of Wpjb_Model_JobType objects */
 /* @var $param stdClass Widget configurations options */


?>
<div id="wpjb-tem-widget-recently-v-p">
<?php echo $theme->before_widget ?>
<a id="wpjb-widget-a-p-title"><?php if($title) echo $theme->before_title.$title.$theme->after_title ?></a>

<ul id="taber-wpjb-recently-viewed">
    <?php if(!empty($applications)): foreach($applications as $job): ?>
    <li>
        &mdash;&nbsp;<a href="<?php echo wpjb_link_to("job", $job->getJob()) ?>" target="_blank">
            <?php esc_html_e($job->getJob()->job_title)?>
        </a>
    </li>
    
    <?php 	
	endforeach; ?>
	<li style="list-style-type:none;float:right;"><a href="<?php echo site_url()?>/applied-jobs/"><?php _e("see more...", WPJB_DOMAIN)?></a></li>
    <?php else: ?>
    <li><?php _e("Not yet applied.", WPJB_DOMAIN) ?></li>
    <?php endif; ?>
</ul>

<?php echo $theme->after_widget ?>
</div>