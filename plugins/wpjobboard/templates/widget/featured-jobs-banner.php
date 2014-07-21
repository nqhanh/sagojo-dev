<!--Neu la nguoi tim viec-->
    <?php  if(!get_user_meta(wp_get_current_user()->ID, "is_employer")):  ?>
<?php

/**
 * Featured Local Jobs
 * 
 * Featured jobs widget template file
 * 
 * 
 * @author hanhdo
 * @package Templates
 * @subpackage Widget
 * 
 */

 /* @var $jobList array List of Wpjb_Model_Job objects */

?>

<link type="text/css" rel="stylesheet" href="<?php echo plugins_url('js/stu12.css', __FILE__ );?>" />

<?php echo $theme->before_widget ?>
<?php if($title) echo $theme->before_title.$title.$theme->after_title ?>
<div id="wpjb_widget_featured" class="wbjp_widget">

		<?php $idclass=rand(1, 10);?>
		<?php if(!empty($jobList)): foreach($jobList as $job):?>
			<div class="slidePanel panel3" caption="<?php echo $job->id;?>">
				<div class="innerPanel ad-hinh-<?php echo $idclass;?>" style="width: 304px;">
					<?php if($job->isNew()): ?>
                            <img src="<?php wpjb_new_img_featured() ?>" alt="" style="margin-top: -1px;margin-left: -1px;position: absolute;"/>
                        <?php endif; ?>
					<div class="ad-content-<?php echo $idclass;?>">
						<div class="ad-title-<?php echo $idclass;?>"><a href="<?php echo wpjb_link_to("job", $job);?>" class="job_id-<?php echo $idclass;?>"><?php esc_html_e($job->job_title);?></a>
						</div>
						<div class="ad-location-<?php echo $idclass;?>">
							<?php if($job->locationToString()):?>
								<?php _e("Job Location ", WPJB_DOMAIN) ?><?php esc_html_e($job->locationToString());?>
							<?php endif; ?>
						</div>
						<div class="ad-salary-<?php echo $idclass;?>">
							<?php if($job->job_salary):?>
								<?php _e("Salary ", WPJB_DOMAIN);?><?php wpjb_job_salary($job).wpjb_job_currency($job);?>
							<?php else :?>
								<?php _e("Salary ", WPJB_DOMAIN);?><?php _e("Negotiable", WPJB_DOMAIN);?>			
							<?php endif;?>
						</div>		
						
						<div style="padding:10px 0px 15px;"><img id="item" style="cursor:pointer;height:16px;" src="<?php echo wpjb_img("calendar.png");?>" alt="" class="wpjb-inline-img" />&nbsp;<?php echo wpjb_job_created_at(get_option('date_format'), $job) ?><span class="jobtype-<?php echo $idclass;?> first rounded"><a href="<?php echo wpjb_link_to("job", $job);?>" style="color:#fff;"><?php _e("Apply online", WPJB_DOMAIN);?></a></span>
						</div>
					</div>
				</div>
			</div>
		<?php $idclass--;?>
		<?php endforeach; ?>
		<?php else: ?>
		<?php 
		if(isset($_GET["job_board"]))
		$get_view = $_GET['job_board'];
		$is_job = substr($get_view, 0, 10);
		if($is_job=="%2Fview%2F") echo "ok";?>
		
			<?php _e("No featured jobs found.", WPJB_DOMAIN) ?>
		<?php endif; ?>

</div>
<?php echo $theme->after_widget ?>
<?php endif; ?>
<!--End neu la nguoi tim viec-->