<!--Neu la nguoi tim viec-->
<?php if(!empty($jobList)):?>
    <?php  if((wp_get_current_user()->ID>0)&&(!get_user_meta(wp_get_current_user()->ID, "is_employer"))):  ?>

<?php

/**
 * Recently viewed jobs
 * 
 * Recently viewed jobs widget template file
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Widget
 * 
 */

 /* @var $jobList array List of Wpjb_Model_Job objects Cong viec moi xem */

?>

<?php echo $theme->before_widget ?>
<?php if($title) echo $theme->before_title.$title.$theme->after_title ?>
<ul id="wpjb-recently-viewed">
    <?php if(!empty($jobList)): foreach($jobList as $job): ?>
    <li >
        <a href="<?php echo wpjb_link_to("job", $job) ?>" target="_blank"><?php esc_html_e($job->job_title) ?></a>
        <?php //_e("at", WPJB_DOMAIN) ?> <?php //esc_html_e($job->company_name) ?>
        <br />
        <!--<small>
            <?php //_e("Location", WPJB_DOMAIN); esc_html_e(": ".$job->locationToString()) ?>
        </small>-->
    </li>
    <?php endforeach; ?>
    <?php else: ?>
    <li><?php _e("No job listings found.", WPJB_DOMAIN) ?></li>
    <?php endif; ?>
</ul>

<?php echo $theme->after_widget ?>

<?php endif; ?>
<!--End neu la nguoi tim viec-->
<?php endif; ?>