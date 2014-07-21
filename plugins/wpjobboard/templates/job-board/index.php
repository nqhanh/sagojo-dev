<?php

/**
 * Jobs list
 * 
 * This template file is responsible for displaying list of jobs on job board
 * home page, category page, job types page and search results page.
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 * 
 * @var $jobList array List of jobs to display
 * @var $current_category Wpjb_Model_Category Available if browsing jobs by category
 * @var $current_type Wpjb_ModelJobType Available if browsing jobs by type
 */

?>
<style>
#content   { display: table; }
#post-273  { display: table-footer-group; }
#searchbox { display: table-header-group;}
</style>
<div id="wpjb-main" class="wpjb-page-index">

    <?php wpjb_flash(); ?>

    <?php if(wpjb_description()): ?>
    <div><?php echo wpjb_description() ?></div>
    <?php endif; ?>
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Job Type tabs Widget') ) : ?>  
		        <?php endif; ?> 
    <div class="jobs">
	<ol>
            <?php if (!empty($jobList)) : foreach($jobList as $job): ?>
            <?php /* @var $job Wpjb_Model_Job */ ?>
            <li class="<?php wpjb_job_features($job); ?> jobsboard">
                <!--<div id="logoso">-->
                    <a class="jobs-hover-link" title="<?php esc_html_e($job->job_title) ?>" href="<?php echo wpjb_link_to("job", $job) ?>" target="_blank"></a>
                    <a title="<?php esc_html_e($job->job_title) ?>" href="<?php echo wpjb_link_to("job", $job) ?>" target="_blank">
					<?php //if ($job->is_featured): ?>
					<?php if($job->getImageUrl()): ?>
						<img  class="logo" src="<?php echo $job->getImageUrl() ?>" alt=""/>
					  <!--<img  class="logo" src="<?php echo home_url() ?>/wp-content/banners/employer_icon.png" alt="" />-->
					<?php endif; ?>
                    </a>
                <!--</div>-->
                <div id="titlo" class="mot wpjb-column-title">
                    <strong>
                        <a href="<?php echo wpjb_link_to("job", $job) ?>" target="_blank"><?php esc_html_e($job->job_title) ?></a>
                        <?php if($job->isNew()): ?>
                            <img src="<?php wpjb_new_img() ?>" alt="" />
                        <?php endif; ?>
                        
                    </strong>
                    <div id="titlo" class="hai">
                        <strong>
                             <small class="wpjb-sub" style="color:<?php echo $job->getType()->getHexColor() ?>">
                                <?php //esc_html_e($job->getType()->title) ?>
								<?php if($job->job_salary):?>
									<?php _e("Salary ", WPJB_DOMAIN);?><?php wpjb_job_salary($job).wpjb_job_currency($job);?>
								<?php else :?>
									<?php _e("Salary ", WPJB_DOMAIN);?><?php _e("Negotiable", WPJB_DOMAIN);?>			
								<?php endif;?>
                            </small>
                        </strong>
				    </div>
				</div>
				
                
				<div id="title-congty">
                    <strong><small class="wpjb-sub"><?php esc_html_e($job->company_name) ?></small></strong>
                </div>    
                    <!--<div id="exc">Job Description: EMA is looking for an experience Web Developer. If you want to work on cool projects with a wide variety of clients, then you might be a great fit for EMA. What yo ...</div>-->
                    
                    <div id="location" class="ba">
                            <strong><?php _e("Location: ", WPJB_DOMAIN) ?></strong>
                            <?php esc_html_e($job->locationToString()) ?>
                    
                    <div id="location" class="bon">
                        <strong><?php _e("Date: ", WPJB_DOMAIN) ?></strong>
                        <span class="year"> <?php echo wpjb_job_created_at(get_option('date_format'), $job); ?></span>
                    </div>
                    </div>
                    
                
            </li>
             <?php endforeach; else :?>
             <div class="wpjb-table-empty">
                            <?php _e("No job listings found.", WPJB_DOMAIN); ?>
             </div>
              
             <?php endif; ?>

    </ol>
	</div>
     <div class="wpjb-paginate-links">
            <?php wpjb_paginate_links() ?>
     </div>
   
</div>
</div>
</div><!-- end of #post-273 -->
</div><!-- end of #content -->
<div class="effect2">
<div id="searchbox" class="widget_wpjb-search">
<form action="<?php echo wpjb_link_to("search"); ?>" method="get">
        <?php if(!$use_permalinks): ?>
        <input type="hidden" name="page_id" value="<?php echo Wpjb_Project::getInstance()->conf("link_jobs") ?>" />
        <input type="hidden" name="job_board" value="find" />
        <?php endif; ?>
        <?php 
		
		global $wpdb;
        $rows = $wpdb->get_results( "SELECT * FROM wpjb_category" );
        $selectBox1  = '';
        $selectBox1 .= '<select  class="cate_sl" name="category" style="color:#959595;">';
        $selectBox1 .= '<option value="" selected">'.__("All categories", WPJB_DOMAIN).'</option>';
			foreach ( $rows as $row ) 
			{
				$selectBox1 .= '<option value="'.$row->id.'" style="color:#555555;">'.__($row->title).'</option>';
			}
		$selectBox1 .= '</select>';
		echo $selectBox1;
					$city_file = WP_PLUGIN_DIR."/wpjobboard/application/config/city_list.ini" ;
					if (file_exists($city_file) && is_readable($city_file))
					{
						$citys=parse_ini_file($city_file,true);
						?>
						<select  class="location_sl" name="location" id="city" style="color:#959595;">
						<option value="" selected><?php _e("Any location", WPJB_DOMAIN) ?></option>
						<?php						   
						foreach ($citys as $city) { 
							?>
							<option value="<?php echo $city['iso2']; ?>" style="color:#555555;"><?php _e($city['name']) ?></option>
							<?php
							}
							?>
							</select>
							<?php						
					}
					else
					{
						// If the configuration file does not exist or is not readable, DIE php DIE!
						die("Sorry, the $city_file file doesnt seem to exist or is not readable!");
					}
					
					
							?>
		
							
		<input class="position_vt" type="text" name="query" placeholder="<?php _e("Enter job title, position,..." ,WPJB_DOMAIN) ?>" />
        <input class="bt_sm job_search"  type="submit" value="" />
</div>
</div><!-- end of .effect2 -->
<div><div><div>

	
