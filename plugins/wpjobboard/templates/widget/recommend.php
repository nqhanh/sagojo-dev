<?php

/**
 * Job recommend 
 * 
 * Job recommend widget template
 * 
 * 
 * @author sagojo.com
 * @package Templates
 * @subpackage Widget
 * 
 */

 /* @var $job_types array List of Wpjb_Model_JobType objects */
 /* @var $param stdClass Widget configurations options */

if (wp_get_current_user()->ID>0):
$rmd = new Wpjb_Widget_Recommend();
$rmd->setID(wp_get_current_user()->ID);
$rmd->checkCategory();
$rmd->checkType();
//print_r($rmd->postSuggestJobs());
$i = 0;
$list = array();
foreach ($rmd->postSuggestJobs() as $sugg) {
	$id = $sugg->getID();
	$job = new Wpjb_Model_Job($id);
	$list[] = $job;
	$i++;

	if($i >= 2) {
		break;
	}
}

$jobList = $list;
if(!empty($jobList)){
?>
<div id="wpjb-tem-widget-recommend-bingo">
	<?php echo $theme->before_widget ?>
	<div id="bingo-widget-a-p-container">
			<div class="wpjb-widget-r-v-p-title"><?php if($title) echo $theme->before_title.$title.$theme->after_title; else echo $theme->before_title;_e('[:en]BINGO!!! Your best match job is this.[:vi]BINGO!!! Hãy thử sức với các công việc này xem.[:ja]BINGO!!! Your best match job is this.');echo $theme->after_title;?></div>
		</div>
	<ul id="bingo-wpjb-recently-viewed">
		<?php if(!empty($jobList)): foreach($jobList as $job): ?>
		<li >
			<a href="<?php echo wpjb_link_to("job", $job) ?>"  target="_blank">&mdash;&nbsp;<?php esc_html_e($job->job_title);?>
				&nbsp;<em><?php //_e("at", WPJB_DOMAIN) ?> (<?php esc_html_e($job->company_name) ?>)</em>
			</a>
			
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
</div>
<?php }
endif;?>