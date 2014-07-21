<?php 

/**
 * Job details
 * 
 * This template is responsible for displaying job details on job details page
 * (template single.php) and job preview page (template preview.php)
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 */

 /* @var $job Wpjb_Model_Job */
 /* @var $company Wpjb_Model_Employer */
		$query = new Daq_Db_Query();
        $rows = $query->select()
            ->from("Wpjb_Model_Application a")
            ->where("a.user_id=?",$user_id)
            ->where("a.job_id=?",$job->getId())
            ->execute();
?>

<script type="text/javascript">
		/*
		* Author: Ryan Sutana
		* Author URI: http://www.sutanaryan.com/
		* Description: This snippet add more site functionality.
		*/

		var _job = jQuery.noConflict();
		_job("document").ready(function(){	
		_job('.applybutton').hide();
			_job(window).scroll(function () {
				if (_job(this).scrollTop() > 280) {
					_job('.post-title').addClass("f-title");
					var winWidth = _job(window).width();
					if(winWidth > 1023) {
						_job('.applybutton').show();
					} else {
						_job('.applybutton').hide(); 
					}
				} else {
					_job('.post-title').removeClass("f-title");
					_job('.applybutton').hide();
				}
			});

		});
	</script>
	<div class="post-title applybutton" style="background-color: transparent;">
	<div style="float:right;">
	<?php   	
    	if(empty($rows)){
	?>
		<a class="wpjb-top-button" href="<?php echo wpjb_link_to("apply", $job) ?>"><?php _e("Apply online", WPJB_DOMAIN) ?></a> 
    <?php } else {echo "<a class='wpjb-top-button'>"; _e("Applied", WPJB_DOMAIN); echo "</a>"; }?></div></div>
    <?php $job = wpjb_view("job");
    global $wpdb;
    $user_id = wp_get_current_user()->ID;
    if ($user_id>0){
	    $wpdb->query( $wpdb->prepare (
				"INSERT IGNORE INTO `wpjb_viewed` ( `JS_ID` , `J_ID`) VALUES ( %d, %d) ",
				array($user_id, $job->getId())
		));
	}
    ?>
    <table class="wpjb-info note black rounded">
        <tbody>
            <?php if($job->company_name): ?>
            <tr>
                <td class="wpjb-info-label"><?php _e("Company Name", WPJB_DOMAIN) ?></td>
                <td><?php wpjb_job_company($job) ?> <?php wpjb_job_company_profile($job->getEmployer(true)) ?></td>
            </tr>
            <?php endif; ?>
            <?php if($job->locationToString()): ?>
            <tr>
                <td class="wpjb-info-label"><?php _e("Job Location", WPJB_DOMAIN) ?></td>
                <td>                   
                    <?php esc_html_e($job->locationToString()) ?>
                </td>
            </tr>
            <?php endif; ?>
            <tr>
                <td class="wpjb-info-label"><?php _e("Date Posted", WPJB_DOMAIN) ?></td>
                <td><?php echo wpjb_job_created_at(get_option('date_format'), $job) ?></td>
            </tr>
            <?php if($job->job_category): ?>
            <tr>
                <td class="wpjb-info-label"><?php _e("Category", WPJB_DOMAIN) ?></td>
                <td><?php wpjb_job_category() ?></td>
            </tr>
            <?php endif ?>
            <?php if($job->job_type): ?>
            <tr>
                <td class="wpjb-info-label"><?php _e("Job Type", WPJB_DOMAIN) ?></td>
                <td><?php wpjb_job_type() ?></td>
            </tr>
            <?php endif; ?>
			<?php if($job->job_salary): ?>
            <tr>
                <td class="wpjb-info-label"><?php _e("Salary", WPJB_DOMAIN) ?></td>
                <td><?php wpjb_job_salary($job).wpjb_job_currency($job)?></td>
				
            </tr>
            <?php else : ?>
			<tr>
                <td><?php _e("Salary", WPJB_DOMAIN) ?></td>
                <td><?php _e("Negotiable", WPJB_DOMAIN) ?></td>
            </tr>			
            <?php endif; ?>
			
        </tbody>
    </table>
    <div class="wpjb-job-content">
        <h3><?php _e("Description", WPJB_DOMAIN) ?></h3>
        <div class="wpjb-job-text">

            <?php if($job->getImageUrl()): ?>
            <div><img src="<?php echo $job->getImageUrl() ?>" id="wpjb-logo" alt="" /></div>
            <?php endif; ?>

            <?php wpjb_job_description($job) ?>           
        </div>      
	
        <h3><?php _e("Required Experience/skills", WPJB_DOMAIN) ?></h3>
        <div class="wpjb-job-text">

            <?php wpjb_required_description($job) ?>
            
        </div>
		<?php if($job->job_interest): ?>
		<h3><?php _e("Conditions/ Benefits", WPJB_DOMAIN) ?></h3>
        <div class="wpjb-job-text">

            <?php wpjb_interest_description($job) ?>
            
        </div>
		<?php endif; ?>
        <?php foreach($job->getNonEmptyTextareas() as $field): ?>
        <h3><?php esc_html_e($field->getLabel()) ?></h3>
        <div class="wpjb-job-text"><?php wpjb_field_value($field) ?></div>
        <?php endforeach; ?>
    
	
	<h3><?php _e("Contact Information", WPJB_DOMAIN) ?></h3>
	<?php if (wp_get_current_user()->ID>0):?>
	<table class="wpjb-info">		
			<?php if($job->job_contact): ?>
            <tr>
                <td class="wpjb-info-label"><?php _e("Contact name", WPJB_DOMAIN) ?></td>
                <td><?php wpjb_job_contact($job)?></td>
            </tr>
            <?php endif; ?>
			<?php if($job->job_phone): ?>
            <tr>
                <td class="wpjb-info-label"><?php _e("Phone number", WPJB_DOMAIN) ?></td>
                <td><?php wpjb_job_phone($job)?></td>
            </tr>
            <?php endif; ?>
			<?php if($job->job_address): ?>
            <tr>
                <td class="wpjb-info-label"><?php _e("Address", WPJB_DOMAIN) ?></td>
                <td><?php wpjb_job_address($job)?>
                <?php if(wpjb_conf("show_maps") && $job->getGeo() && $job->getGeo()->lnglat !='14.058324,108.277199' && $job->getGeo()->lnglat !='10.823099,106.629662' && $job->getGeo()->lnglat !='10.746903,106.676292') : ?><a class="modalLink" href="#modal1"><img src="<?php echo wpjb_img("location.png") ?>" alt="" class="wpjb-inline-img" /></a>
                    <!--<a href="#" class="wpjb-tooltip">
                      <img src="<?php echo wpjb_img("location.png") ?>" alt="" class="wpjb-inline-img" />
                      <span><img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $job->getGeo()->lnglat ?>&zoom=16&location_type=ROOFTOP&size=500x200&sensor=false&result_type=street_address" width="500" height="200" /></span>
                    </a>-->
                   <script
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
</script>

<script>
var myCenter=new google.maps.LatLng(<?php echo $job->getGeo()->lnglat ?>);

function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:17,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker=new google.maps.Marker({
  position:myCenter,
  });

marker.setMap(map);

}

google.maps.event.addDomListener(window, 'load', initialize);


</script>
<div id="modal1" class="modal">
        <p class="closeBtn">x</p>
		<iframe width="500" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php wpjb_job_address($job)?>&amp;aq=0&amp;oq=orlan&amp;sll=<?php echo $job->getGeo()->lnglat ?>&amp;sspn=0.035898,0.055189&amp;ie=UTF8&amp;hq=&amp;hnear=<?php wpjb_job_address($job)?>&amp;t=m&amp;z=17&amp;ll=<?php echo $job->getGeo()->lnglat ?>&amp;iwloc=near&amp;output=embed"></iframe>
        <!--<div id='googleMap' style='width:499px;height:299px;'></div>-->
    </div>
<?php endif; ?>
                    </td>
            </tr>
            <?php endif; ?>
            <?php foreach($job->getNonEmptyFields() as $field): ?>
            <?php /* @var $field Wpjb_Model_FieldValue */ ?>
            <tr>
                <td class="wpjb-info-label"><?php esc_html_e($field->getLabel()); ?></td>
                <td><?php wpjb_field_value($field); ?></td>
            </tr>
            <?php endforeach; ?>
			<?php if($job->contact_description): ?>
            <tr>
                <td class="wpjb-info-label"><?php _e("Contact Description", WPJB_DOMAIN) ?></td>
                <td><?php wpjb_contact_description($job) ?></td>
            </tr>
            <?php endif; ?>		
    </table>
	<?php else: _e("Login to view", WPJB_DOMAIN);endif?>
	<?php $userlevel = get_user_meta(wp_get_current_user()->ID, "wp_user_level",trues);
		if ($userlevel != 0): ?>
	<h3><?php _e("Post to Facebook Page Wall", WPJB_DOMAIN) ?></h3>
	<table class="wpjb-info">
	<tr valign="top">
			
            <td class="wpjb-normal-td">
				<?php $return_link = wpjb_link_to("job", $job);?>
				<?php include ABSPATH.'wp-content/banners/postfb.php';?>
			</td>
    </tr>
	</table>
	<?php endif; ?><!--End phan quan tri-->
	
	</div>
	<script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
	<script src="<?php echo plugins_url('js/jquery.modal.js', __FILE__ );?>" type="text/javascript"></script>
	<script type="text/javascript">
	var md = jQuery.noConflict();
	</script>
	<script type="text/javascript">
	md(document).ready(function(){
    md('.modalLink').modal({
	
        trigger: '.modalLink',          // id or class of link or button to trigger modal
        olay:'div.overlay',             // id or class of overlay
        modals:'div.modal',             // id or class of modal
        animationEffect: 'slideDown',   // overlay effect | slideDown or fadeIn | default=fadeIn
        animationSpeed: 400,            // speed of overlay in milliseconds | default=400
        moveModalSpeed: 'slow',         // speed of modal movement when window is resized | slow or fast | default=false
        background: 'a2d3cd',           // hexidecimal color code - DONT USE #
        opacity: 0.7,                   // opacity of modal |  0 - 1 | default = 0.8
        openOnLoad: false,              // open modal on page load | true or false | default=false
        docClose: true,                 // click document to close | true or false | default=true    
        closeByEscape: true,            // close modal by escape key | true or false | default=true
        moveOnScroll: true,             // move modal when window is scrolled | true or false | default=false
        resizeWindow: true,             // move modal when window is resized | true or false | default=false
        video: 'http://player.vimeo.com/video/2355334?color=eb5a3d',    // enter the url of the video
        videoClass:'video',             // class of video element(s)
        close:'.closeBtn'               // id or class of close button
		

    });
	
});
</script>

