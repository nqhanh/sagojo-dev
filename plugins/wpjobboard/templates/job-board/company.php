<?php

/**
 * Company profile page
 * 
 * This template displays company profile page
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 */

/* @var $jobList array List of active company job openings */
/* @var $company Wpjb_Model_Company Company information */

?>
<?php
$is_modern = $company->stylecv;
		if(($is_modern==1)&&($company->is_public==1)) :?>
		
		<?php $redirect = site_url()."/company-profile/?company=".$company->id;							
					wp_redirect($redirect);
					exit();
					
		else :?>	
<!-- JQUERY ______________________ -->
	<!--[if lt IE 9]> <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script> <![endif]-->
	<!--[if gte IE 9]><!--> <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js" type="text/javascript"></script> <!--<![endif]-->
<script src="<?php echo plugins_url('js/imgLiquid.js', __FILE__ );?>" type="text/javascript"></script>

<div id="wpjb-main" class="wpjb-page-company" >

    <?php wpjb_flash() ?>

    <?php if($company->isVisible()): ?>

    <table class="wpjb-info">
        <tbody>
            <!--<?php //if($company->locationToString()): ?>
            <tr>
                <td class="wpjb-info-label"><?php _e("Company Location", WPJB_DOMAIN) ?></td>
                <td>
                    <?php //if($company->getGeo()): ?>
                    <a href="#" class="wpjb-tooltip">
                      <img src="<?php //echo wpjb_img("location.png") ?>" alt="" class="wpjb-inline-img" />
                      <span><img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php //echo $company->getGeo()->lnglat ?>&zoom=13&size=500x200&sensor=false" width="500" height="200" /></span>
                    </a>
                    <?php //endif; ?>
                    <?php //esc_html_e($company->locationToString()) ?>
                </td>
            </tr>
            <?php //endif; ?>-->
			<script type="text/javascript">
			var _com = jQuery.noConflict();
				_com(document).ready(function () {
					_com(".imgLiquidFill").imgLiquid({fill:true});
					_com(".imgLiquidNoFill").imgLiquid({fill:false});
				});
			</script>
			<?php if($company->getFileUrl()): ?>
            <div class="boxSep"><div class="imgLiquidFill imgLiquid"><img src="<?php echo $company->getFileUrl() ?>" id="wpjb-logo" alt="" /></div></div>
            <?php endif; ?>
			
            <?php if($company->company_address): ?>
            <tr id="test">
                <td class="wpjb-info-label"><?php _e("Company Address", WPJB_DOMAIN) ?></td>
                <td><?php wpjb_company_address($company, __("Unknown", WPJB_DOMAIN)) ?>, <?php esc_html_e($company->locationToString()) ?></td>
            </tr>
            <?php endif; ?>
            <?php if($company->company_website): ?>
            <tr id="test">
                <td class="wpjb-info-label"><?php _e("Company Website", WPJB_DOMAIN) ?></td>
                <td><?php wpjb_company_website($company, __("Unknown", WPJB_DOMAIN)) ?></td>
            </tr>
            <?php endif; ?>			
			<?php if($company->company_field): ?>
            <tr id="test">
                <td class="wpjb-info-label"><?php _e("Field of Business", WPJB_DOMAIN) ?></td>
                <td><?php wpjb_company_field($company, __("Unknown", WPJB_DOMAIN)) ?></td>
            </tr>
            <?php endif; ?>
			<?php if($company->company_qual): ?>
            <tr id="test">
                <td class="wpjb-info-label"><?php _e("Number of Employees", WPJB_DOMAIN) ?></td>
                <td><?php wpjb_company_qual($company, __("Unknown", WPJB_DOMAIN)) ?></td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <div class="wpjb-job-content">
	<h3><?php _e("Introduction", WPJB_DOMAIN) ?></h3>
        <div class="wpjb-job-text">

            <?php if($company->getImageUrl()): ?>
            <div><img src="<?php echo $company->getImageUrl() ?>" id="wpjb-logo" alt="" /></div>
            <?php endif; ?>

            <?php wpjb_company_info($company) ?>

        </div>
	<h3><?php _e("Why work with us?", WPJB_DOMAIN) ?></h3>
        <div class="wpjb-job-text">

            <?php wpjb_company_whyus($company) ?>

        </div>
<article class="post">	
	<div class="wpjb-job-content" style="clear:both;padding: 10px;">
		<h5 class="also-viewed" style="margin-top: 0em;"><?php _e("Current job openings at", WPJB_DOMAIN) ?> <?php esc_html_e($company->company_name) ?></h5>
		
		
		
        <ul id="ul-apply">
            <?php if (!empty($jobList)): foreach($jobList as $job): ?>
            <?php /* @var $job Wpjb_Model_Job */ ?>
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
						<?php wpjb_job_created_time_ago(__("posted {time_ago} ago.", WPJB_DOMAIN), $job) ?>
					</span>
					<span class="apply-s"><?php _e('Views: ',WPJB_DOMAIN);  esc_html_e($job->stat_views);?></span>					
				</div>
				<div style="clear:both;"></div>
			</li>
            <?php endforeach; else :?>
            <li>
                <?php _e("Currently this employer doesn't have any openings.", WPJB_DOMAIN); ?>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</article>	
    </div>

    <?php endif; ?>

</div>
<?php endif; ?>