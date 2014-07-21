<?php 

/**
 * Job details
 * 
 * This template is responsible for displaying job details on job details page
 * (template single.php) and job preview page (template preview.php)
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Resumes
 */

 /* @var $resume Wpjb_Model_Resume */
 /* @var $can_browse boolean True if user has access to resumes */
$is_modern = $resume->stylecv;
		if(($is_modern==1)&&($resume->is_active==1)) :?>
		
		<?php $redirect = site_url()."/resume/?job_resumes=".$resume->id;							
					wp_redirect($redirect);
					exit();
					
		else :?>			

<div id="wpjb-main" class="wpjr-page-resume">

    <?php wpjb_flash() ?>
	<?php
    $array = array(   
"[:en]Default[:vi]Mặc định[:ja]Default"=>"#ddeef6",
"[:en]GreenDark[:vi]Xanh lá đậm[:ja]GreenDark"=>"#1e7145",
"[:en]Teal[:vi]Xanh ngọc[:ja]Teal"=>"#00aba9",
"[:en]Green[:vi]Xanh lục[:ja]Green"=>"#00a300",
"[:en]Magenta[:vi]Màu đỏ sậm[:ja]Magenta"=>"#ff0097",
"[:en]Pink[:vi]Màu hồng[:ja]Pink"=>"#9f00a7",
"[:en]PinkDark[:vi]Màu hồng đậm[:ja]PinkDark"=>"#7e3878",
"[:en]Yellow[:vi]Màu vàng[:ja]Yellow"=>"#ffc40d",
"[:en]Orange[:vi]Màu cam[:ja]Orange"=>"#e3a21a",
"[:en]OrangeDark[:vi]Màu cam đậm[:ja]OrangeDark"=>"#da532c",
"[:en]Purple[:vi]Màu tím[:ja]Purple"=>"#603cba",
"[:en]White[:vi]Trắng[:ja]White"=>"#ffffff",
"[:en]BlueDark[:vi]Màu xanh đậm[:ja]BlueDark"=>"#2b5797",	
   );
    ?>
    
    <!--<div class="wpjb-resume-headline">-->
	<!--Lay thong tin cover-CV-->
                <?php $cove_color = $resume->getFieldValue(1); ?>
		<?php echo "<style type='text/css'>.cvcolor{ overflow:hidden;margin-bottom: 24px;}</style>";?>
			
    <!--Lay thong tin cover-CV-->
	<!--<div style="overflow:hidden;margin-bottom: 24px;background-color:<?php //echo $array[$cove_color]?>; color:invertColor(<?php //echo $array[$cove_color]?>); ">-->
	<div class=cvcolor>
	<!--Doi mau chu tuong ung voi mau nen-->
	<!--<script type="text/javascript">      
   		 function invertColor(hexTripletColor) {
       		 	var color = hexTripletColor;
        	 	color = color.substring(1); // remove #
      	  	 	color = parseInt(color, 16); // convert to integer
       		 	color = 0xFFFFFF ^ color; // invert three bytes
       		 	color = color.toString(16); // convert to hex
       		 	color = ("000000" + color).slice(-6); // pad with leading zeros
       		 	color = "#" + color; // prepend #
       		 	return color;
    		 }
    		 $(".cvcolor").each(function() {
       		 	var c1 = "#ddeef6"; 
       		 	var c2 = invertColor(c1);
        	 	$(this).css({
           	 		"color": c2,
           	 		"background-color": c1        
        		});
    		});
	</script>-->
	<!--Doi mau chu tuong ung voi mau nen-->		
        <img src="<?php echo wpjb_resume_photo() ?>" alt="" class="wpjb-resume-photo" />
        <strong><?php esc_html_e($resume->title) ?></strong><br>
        <i><?php esc_html_e($resume->headline) ?></i>
    </div>

	<div class="dragitems">
    <ul id="allfields" runat="server" class="wpjb-info">
			<?php if($resume->namsinh): ?>
            <li>
                <label><?php _e("Birthday", WPJB_DOMAIN) ?></label>
                <?php echo ($can_browse) ? $resume->namsinh : wpjb_block_resume_details(); ?>
            </li>
            <?php endif; ?>
			<?php if ($resume->gender==0): $gender="[:en]Female[:vi]Nữ[:ja]女性"; else: $gender="[:en]Male[:vi]Nam[:ja]男性"; endif;?>
            <li>
                <label><?php _e("Gender", WPJB_DOMAIN) ?></label>
                <?php echo ($can_browse) ? __($gender) : wpjb_block_resume_details(); ?>
            </li>
           
            <?php if($resume->degree): ?>
            <li>
                <label><?php _e("Degree", WPJB_DOMAIN) ?></label>
                <?php wpjb_resume_degree($resume) ?>
            </li>
            <?php endif; ?>
            
            <?php if($resume->years_experience): ?>
            <li>
                <label><?php _e("Experience", WPJB_DOMAIN) ?></label>
                <?php wpjb_resume_experience($resume) ?>
            </li>
            <?php endif; ?>
            
            <?php if($resume->category_id): ?>
            <li>
                <label><?php _e("Category", WPJB_DOMAIN) ?></label>
                <?php esc_html_e($resume->getCategory(true)->title) ?>
            </li>
            <?php endif; ?>
            
            <?php if($resume->email): ?>
            <li>
                <label><?php _e("E-mail", WPJB_DOMAIN) ?></label>
                <?php echo ($can_browse) ? $resume->email : wpjb_block_resume_details(); ?>
            </li>
            <?php endif; ?>
            
            <?php if($resume->phone): ?>
            <li>
                <label><?php _e("Phone Number", WPJB_DOMAIN) ?></label>
                <?php echo $can_browse ? $resume->phone : wpjb_block_resume_details() ?>
            </li>
            <?php endif; ?>
            
            <?php if($resume->website): ?>
            <li>
                <label><?php _e("Website", WPJB_DOMAIN) ?></label>
                <?php echo $can_browse ? $resume->website : wpjb_block_resume_details() ?>
            </li>
            <?php endif; ?>
			<?php if($resume->address): ?>
            <li>
                <label><?php _e("Address", WPJB_DOMAIN) ?></label>
                <?php esc_html_e($resume->address) ?>
            </li>
            <?php endif; ?>			
			<?php if($resume->locationToString()): ?>
            <li>
                <label><?php _e("Location", WPJB_DOMAIN) ?></label>
				<?php esc_html_e($resume->locationToString()) ?>
            </li>       
			<?php endif; ?>
			
			<?php if($resume->salary): if ($resume->sym_currency==0): $sym_currency="USD"; else: $sym_currency="VND"; endif;?>
            <li>
                <label><?php _e("Salary Preference", WPJB_DOMAIN) ?></label>
                <?php echo number_format($resume->salary,0,",",".").$sym_currency; ?>/<?php _e("month", WPJB_DOMAIN) ?>
            </li>
			<?php else : ?>
			<li>
                <label><?php _e("Salary Preference", WPJB_DOMAIN) ?></label>
                <?php _e("Negotiable", WPJB_DOMAIN) ?>
            </li>			
            <?php endif; ?>
			
            <!--Additional field show here-->
            <?php foreach($resume->getNonEmptyFields() as $field): ?>
            <?php /* @var $field Wpjb_Model_FieldValue */ ?>
            <li>
                <label><?php esc_html_e($field->getLabel()); ?></label>
                <?php wpjb_field_value($field) ?>
            </li>
            <?php endforeach; ?>
            <?php if($resume->hasFile()): ?>
            <li>
                <label><?php _e("File", WPJB_DOMAIN) ?></label>
                
                    <?php if($can_browse): ?> 
                    <a href="<?php esc_attr_e($resume->getFileUrl()) ?>"><?php _e("download") ?></a>
                    <?php else: ?>
                    <?php wpjb_block_resume_details() ?>
                    <?php endif; ?>
                
            </li>
            <?php endif; ?>
			<li>
                <label><?php _e("Last Resume Update", WPJB_DOMAIN) ?></label>
                <?php wpjb_resume_last_update_at(get_option('date_format'), $resume) ?>
            </li>
    </ul>
	</div>


    <div class="wpjb-job-content">
        <h3><?php _e("Experience", WPJB_DOMAIN) ?></h3>
        <div class="wpjb-job-text">
		<?php 
		
			$job = $resume->experience;
			$job = strip_tags($job, '<p><a><b><strong><em><i><ul><li><h3><h4><br>');
			$job = nl2br($job);
			$find = array("</ul><br />", "</li><br />", "</ol><br />");
			$repl = array("</ul>", "</li>", "</ol>");
			echo str_replace($find, $repl, $job);
		?>
		
		</div>
    </div>
    
    <div class="wpjb-job-content">
        <h3><?php _e("Education", WPJB_DOMAIN) ?></h3>
        <div class="wpjb-job-text">
		<?php 
		
			$job = $resume->education;
			$job = strip_tags($job, '<p><a><b><strong><em><i><ul><li><h3><h4><br>');
			$job = nl2br($job);
			$find = array("</ul><br />", "</li><br />", "</ol><br />");
			$repl = array("</ul>", "</li>", "</ol>");
			echo str_replace($find, $repl, $job);
		?>
		</div>
    </div>
	
	<div class="wpjb-job-content">
        <h3><?php _e("Skills", WPJB_DOMAIN) ?></h3>
        <div class="wpjb-job-text">
		<?php 
		
			$job = $resume->skills;
			$job = strip_tags($job, '<p><a><b><strong><em><i><ul><li><h3><h4><br>');
			$job = nl2br($job);
			$find = array("</ul><br />", "</li><br />", "</ol><br />");
			$repl = array("</ul>", "</li>", "</ol>");
			echo str_replace($find, $repl, $job);
		?>
		
		</div>
    </div>

    <?php foreach($resume->getNonEmptyTextareas() as $field): ?>
    <div class="wpjb-job-content">
        <h3><?php esc_html_e($field->getLabel()) ?></h3>
        <div class="wpjb-job-text"><?php wpjb_field_value($field) ?></div>
    </div>
    <?php endforeach; ?>

</div>
<?php endif; ?>