<?php 

/**
 * Apply for a job form
 * 
 * Displays form that allows to apply for a selected job
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 */

 /* @var $members_only bool True if only registered members can apply for jobs */
 /* @var $application_sent bool True if form was just submitted */
 /* @var $job Wpjb_Model_Job */
 /* @var $form Wpjb_Form_Apply */

?>


<div id="wpjb-main" class="wpjb-page-apply">

    <?php wpjb_flash(); ?>
    
    <?php if(isset($members_only) && $members_only): ?>
        <a href="<?php echo wpjb_link_to("job", $job) ?>"><?php _e("Go back to job details.", WPJB_DOMAIN) ?></a>
    <?php else: 
    	if(!isset($application_sent)): ?>
    <form id="wpjb-apply-form" action="" method="post" enctype="multipart/form-data" class="wpjb-form">
        <?php wpjb_form_render_hidden($form) ?>
        <?php foreach($form->getNonEmptyGroups() as $group): ?>
        <?php /* @var $group stdClass */ ?> 
        <fieldset class="wpjb-fieldset-<?php echo $group->name ?>">
            <legend class="wpjb-empty"><?php esc_html_e($group->legend) ?></legend>
            <?php foreach($group->element as $name => $field): ?>
            <?php /* @var $field Daq_Form_Element */ ?>
            <div class="<?php wpjb_form_input_features($field) ?>">

                <label class="wpjb-label">
                    <?php esc_html_e($field->getLabel()) ?>
                    <?php if($field->isRequired()): ?><span class="wpjb-required">*</span><?php endif; ?>
                </label>
                
                <div class="wpjb-field">
                    <?php wpjb_form_render_input($form, $field) ?>
                    <?php wpjb_form_input_hint($field) ?>
                    <?php wpjb_form_input_errors($field) ?>
                </div>
				
            </div>
            <?php endforeach; ?>
        </fieldset>
        <?php endforeach; ?>
        
            <div>
                <legend class="wpjb-empty"></legend>
                <input type="submit" name="wpjb_preview" id="wpjb_submit" value="<?php _e("Send Application", WPJB_DOMAIN) ?>" />
                <?php _e("or", WPJB_DOMAIN); ?>
				<a href="<?php echo wpjb_link_to("job", $job) ?>">&nbsp;<?php _e("cancel and go back", WPJB_DOMAIN) ?></a>
            </div>
        
    </form>
    <?php else: ?>
	
    <a class="wpjb-button wpjb-cancel" href="<?php echo wpjb_link_to("job", $job) ?>"><?php _e("&larr; Go back to job details.", WPJB_DOMAIN) ?></a>
	
    <?php endif; ?>

    <?php endif; ?>
</div>
<?php if(isset($application_sent)):?>
<h5 class="also-viewed"><?php _e("The others also viewed/applied", WPJB_DOMAIN) ?></h5>
<div class="post-entry"><?php
	global $wpdb;
	$datas = $wpdb->get_results("SELECT id
										FROM wpjb_viewed INNER JOIN wpjb_job
										ON wpjb_viewed.J_ID = wpjb_job.id
										WHERE wpjb_job.id <> $job->id
										AND wpjb_job.job_category = $job->job_category
										GROUP BY id
										ORDER BY id DESC
										LIMIT 15");
	
	foreach ($datas as $data){
	$id = $data->id;
	$job = new Wpjb_Model_Job($id);
	$list[] = $job;
}
$jobList = $list;

	?>

	<ul id="ul-apply">
    <?php if(!empty($jobList)): foreach($jobList as $job): ?>
    <li class="li-apply-job">
        <a class="apply-s" href="<?php echo wpjb_link_to("job", $job) ?>" target="_blank">
			<strong>
			<?php 
			esc_html_e($job->job_title);
			?>
			</strong>
		</a>
		
		<div id="apply-jobs1-local">
		<?php if($job->locationToString()):?>
				
				<span class="apply-s">
								&#8226;&nbsp;<?php _e("Job Location ", WPJB_DOMAIN) ?><?php esc_html_e($job->locationToString());?>
				</span>
				
				
		<?php endif; ?>
				<?php if($job->job_salary):?>
				<span class="apply-s">
								&#8226;&nbsp;<?php _e("Salary ", WPJB_DOMAIN);?><?php wpjb_job_salary($job).wpjb_job_currency($job);?>
							<?php else :?>
								&#8226;&nbsp;<?php _e("Salary ", WPJB_DOMAIN);?><?php _e("Negotiable", WPJB_DOMAIN);?>
				</span>
			<?php endif;?>
			
		</div>
		<div>
			<span>
				<?php _e("Date: ", WPJB_DOMAIN) ?><em><?php echo wpjb_job_created_at(get_option('date_format'), $job) ?></em>
			</span>
			<span class="apply-s"><?php _e('Views: ',WPJB_DOMAIN);  esc_html_e($job->stat_views);?></span>
			
		</div>
		<div style="clear:both;"></div>
   
    </li>
    <?php endforeach; ?>
    
    <?php else: ?>
    <li><?php _e("No job listings found.", WPJB_DOMAIN) ?></li>
    <?php endif; ?>
    
</ul>
	</div>
<?php endif; ?>