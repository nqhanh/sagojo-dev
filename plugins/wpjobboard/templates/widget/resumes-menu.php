<?php

/**
 * Resumes menu
 * 
 * Resumes menu widget template file
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Widget
 * 
 */
?>

<?php echo $theme->before_widget ?>
<?php if($title) echo $theme->before_title.$title.$theme->after_title ?>
<span class="icon-arrow-down"> </span>
<ul id="wpjb_widget_resumesmenu" class="wpjb_widget">
<!--Neu la nha tuyen dung-->
<?php if(get_user_meta(wp_get_current_user()->ID, "is_employer")): ?>

        <li class="wpjb-li wpjb-boxshow-top">
            <a class="wpjb-ntdhover-link" href="<?php echo wpjb_link_to("step_add") ?>"></a>
            <a class="wpjb-ntd-link" href="<?php echo wpjb_link_to("step_add") ?>">
                <?php _e("Post a Job", WPJB_DOMAIN) ?>
            </a>
            <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
        </li>
    
        <li class="wpjb-li wpjb-underline-top">
            <a class="wpjb-ntdhover-link" href="<?php echo wpjb_link_to("employer_panel") ?>"></a>
            <a class="wpjb-ntd-link" href="<?php echo wpjb_link_to("employer_panel") ?>">
                <?php _e("Company Jobs", WPJB_DOMAIN) ?>
            </a>
            <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
        </li>
        <li class="wpjb-li wpjb-underline-top">
            <a class="wpjb-ntdhover-link" href="<?php echo wpjb_link_to("employer_edit") ?>"></a>
            <a class="wpjb-ntd-link" href="<?php echo wpjb_link_to("employer_edit") ?>">
                <?php _e("Company Profile", WPJB_DOMAIN) ?>
            </a>
            <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
        </li>
		<li class="wpjb-li wpjb-underline-top wpjb-boxshow-botton">
        <a class="wpjb-ntdhover-link"  href="<?php echo site_url()?>?page_id=24"></a>
        <a class="wpjb-ntd-link" href="<?php echo site_url()?>?page_id=24">
            <?php _e("Payment Account", WPJB_DOMAIN) ?>
        </a>
        <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li>
        <!--<?php //if(Wpjb_Project::getInstance()->conf("cv_enabled")): ?>
        <li class="wpjb-li wpjb-underline-top">
            <a class="wpjb-ntdhover-link" href="<?php //echo wpjb_link_to("employer_access") ?>"></a>
            <a class="wpjb-ntd-link" href="<?php //echo wpjb_link_to("employer_access") ?>">
                <?php //_e("Resumes Access", WPJB_DOMAIN) ?>
            </a>
            <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
        </li>
        <?php //endif; ?>-->   
    <?php endif; ?>
<!--End neu la nha tuyen dung-->	
	


<!--Neu la nguoi tim viec-->
    
<?php if($is_employee && $is_loggedin): ?>
    <!--<span class="icon-arrow-down"> </span>-->
    <li class="wpjb-li wpjb-boxshow-top" >
        <a class="wpjb-ntdhover-link"  href="<?php echo wpjr_link_to("myresume") ?>"></a>
        <a class="wpjb-ntd-link" href="<?php echo wpjr_link_to("myresume") ?>">
            <?php _e("My Resume", WPJB_DOMAIN) ?>
        </a>
        <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li>
	<li class="wpjb-li wpjb-underline-top">
        <a class="wpjb-ntdhover-link"  href="<?php echo wpjb_link_to("advsearch") ?>"></a>
        <a class="wpjb-ntd-link" href="<?php echo wpjb_link_to("advsearch") ?>">
            <?php _e("Advanced Job Search", WPJB_DOMAIN) ?>
        </a>
        <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li>    
	<li class="wpjb-li wpjb-underline-top">
        <a class="wpjb-ntdhover-link"  href="<?php echo site_url() ?>/?page_id=100"></a>
        <a class="wpjb-ntd-link" href="<?php echo site_url() ?>/?page_id=100">
            <?php _e("For Jobseeker", WPJB_DOMAIN) ?>
        </a>
        <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li>
	<li class="wpjb-li wpjb-underline-top">
        <a class="wpjb-ntdhover-link"  href="<?php echo site_url()?>/my-jobs/"></a>
        <a class="wpjb-ntd-link" href="<?php echo site_url()?>/my-jobs/">
            <?php _e("My saved jobs", WPJB_DOMAIN) ?>
        </a>
        <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li><li class="wpjb-li wpjb-underline-top">
        <a class="wpjb-ntdhover-link"  href="<?php echo site_url()?>/applied-jobs/"></a>
        <a class="wpjb-ntd-link" href="<?php echo site_url() ?>/applied-jobs">
            <?php _e("My applied jobs", WPJB_DOMAIN) ?>
        </a>
        <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li>
		 
	<!--Begin phan quan tri-->
	<?php $userlevel = get_user_meta(wp_get_current_user()->ID, "wp_user_level",trues);
		if ($userlevel > 0): ?>

	<li class="wpjb-li wpjb-underline-top">
            <a class="wpjb-ntdhover-link" href="<?php echo wpjr_url() ?>"></a>    
            <a class="wpjb-ntd-link" href="<?php echo wpjr_url() ?>">
            <?php _e("Browse Resumes", WPJB_DOMAIN) ?>
            </a>
            <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li>
    <li class="wpjb-li wpjb-underline-top wpjb-boxshow-botton">
        <a class="wpjb-ntdhover-link" href="<?php echo wpjr_link_to("advsearch") ?>"></a>
        <a class="wpjb-ntd-link" href="<?php echo wpjr_link_to("advsearch") ?>">
            <?php _e("Search Resumes", WPJB_DOMAIN) ?>
        </a>
        <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li>
	<li class="wpjb-li wpjb-underline-top wpjb-boxshow-botton">
        <a class="wpjb-ntdhover-link"  href="<?php echo wpjb_url() ?>"></a>
        <a class="wpjb-ntd-link" href="<?php echo wpjb_url() ?>">
            <?php _e("View Jobs", WPJB_DOMAIN) ?>
        </a>
        <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li>	
	<?php endif; ?><!--End phan quan tri-->
	<!--Begin phan quan tri NAKA-->
	<?php //if ($userlevel == 2): ?>
	<!--<li class="wpjb-li wpjb-underline-top wpjb-boxshow-botton">
        <a class="wpjb-ntdhover-link"  href="<?php echo site_url()?>?page_id=24"></a>
        <a class="wpjb-ntd-link" href="<?php echo site_url()?>?page_id=24">
            <?php _e("Coupon", WPJB_DOMAIN) ?>
        </a>
        <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li>-->
	<?php //endif; ?><!--END phan quan tri NAKA-->	
<?php endif; ?>
<!--End neu la nguoi tim viec-->
<!--Begin Moi tuan mot con so-->
	<?php 
	if ($userlevel > 0): ?>
	<li class="wpjb-li wpjb-underline-top wpjb-boxshow-botton">
        <a class="wpjb-ntdhover-link"  href="<?php echo site_url()?>?page_id=19"></a>
        <a class="wpjb-ntd-link" href="<?php echo site_url()?>?page_id=19">
            <?php _e("Sharing a figures", WPJB_DOMAIN) ?>
        </a>
        <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li>   
	<?php endif; ?><!--END Moi tuan mot con so-->	
	
</ul>

<?php echo $theme->after_widget ?>