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

<script src="<?php echo plugins_url('js/stu12.js', __FILE__ );?>" type="text/javascript"></script> 
<link type="text/css" rel="stylesheet" href="<?php echo plugins_url('js/stu12.css', __FILE__ );?>" />


<?php echo $theme->before_widget ?>
<?php if($title) echo $theme->before_title.$title.$theme->after_title ?>
<div id="wpjb_widget_featured" class="wbjp_widget">
<ul class="iStu12">
    
    <li class="prev"></li>
    <li class="images">
		<div class="slide">
		<?php if(!empty($jobList)): foreach($jobList as $job): ?>
			<div class="slidePanel panel3" caption="<?php echo $job->id;?>">
				<div class="innerPanel">
					<div style="background-color: #fff;text-align:center;border: 1px solid #e2e2e2;margin: 0px auto 15px;width:150px;border-radius: 75px;
					-webkit-border-radius: 75px;
					-moz-border-radius: 75px;"><a href="<?php echo wpjb_link_to("job", $job) ?>"><img src="<?php echo $job->getImageUrl() ?>" id="wpjb-logo" alt="" style="height: 150px;;border-radius: 75px;
					-webkit-border-radius: 75px;
					-moz-border-radius: 75px;"/></a>
					
					</div>
					<div style="/*background-color:#e2e2e2;*/border:1px solid #e2e2e2;padding:5px;">
						<div style="padding:10px;background-color:#555;"><a href="<?php echo wpjb_link_to("job", $job) ?>" class="job_id">		<?php esc_html_e(strip_tags(implode(' ',array_slice(explode(' ',$job->job_title),0,6)).'...')) ?></a>
						</div>
						
						<div style="padding:10px 0px;"><?php if($job->job_salary): ?>
							<span style="font-size:20px;font-weight:600;color:#f15a24;"><img id="item" style="cursor:pointer;height:16px;" src="<?php echo wpjb_img("coin.png") ?>" alt="" class="wpjb-inline-img" /></span>&nbsp;<span style="font-size:20px;font-weight:700;color:#f15a24;"><?php wpjb_job_salary($job).wpjb_job_currency($job)?></span>
							<?php else : ?>
							<span style="font-size:20px;font-weight:600;color:#f15a24;"><img id="item" style="cursor:pointer;height:16px;" src="<?php echo wpjb_img("coin.png") ?>" alt="" class="wpjb-inline-img" /></span>&nbsp;<span style="font-size:20px;font-weight:700;color:#f15a24;"><?php _e("Negotiable", WPJB_DOMAIN) ?></span>			
							<?php endif; ?>
						</div>		
						<div>
							<?php if($job->locationToString()): ?>
							<img id="item" style="cursor:pointer;height:16px;" src="<?php echo wpjb_img("location.png") ?>" alt="" class="wpjb-inline-img" />
												  
									<?php esc_html_e($job->locationToString()) ?>
							   
							<?php endif; ?>
						</div>
						<div style="padding:10px 0px 15px;"><img id="item" style="cursor:pointer;height:16px;" src="<?php echo wpjb_img("calendar.png") ?>" alt="" class="wpjb-inline-img" />&nbsp;<?php echo wpjb_job_created_at(get_option('date_format'), $job) ?><span class="jobtype first rounded"><?php job_type($job) ?></span>
						</div>
					</div>
				</div>
			</div>	
		<?php endforeach; ?>
		<?php else: ?>
			<?php _e("No featured jobs found.", WPJB_DOMAIN) ?>
		<?php endif; ?>
		</div> 
	</li>
	<li class="next"></li>		       
</ul>
</div>
<?php echo $theme->after_widget ?>