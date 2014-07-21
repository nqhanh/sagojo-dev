<?php 

/**
* Resumes list
* 
* 
* @author Greg Winiarski
* @package Templates
* @subpackage Resumes
*/

/* @var $resumeList array of Wpjb_Model_Resume objects */
/* @var $can_browse boolean True if user has access to resumes */

?>

<div id="wpjb-main" class="wpjr-page-resumes">

   <?php wpjb_flash(); ?>
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
   <cl class="resumes">
        <?php if (!empty($resumeList)) : foreach($resumeList as $resume): ?>
<?php
$url = $resume->getImageUrl();
if(is_null($url)) {
$url = Wpjb_Project::getInstance()->media()."/user.png";
}
?>
       <la class="resume <?php wpjb_resume_mods(); ?> ">

       
           <a class="resume-hover-link" href="<?php echo wpjr_link_to("resume", $resume) ?>"></a>

           <?php /* @var $field Wpjb_Model_FieldValue */ ?>
          <!--Lay thong tin cover-CV-->
               <?php $cove_color = $resume->getFieldValue(1); ?>
           <!--Lay thong tin cover-CV-->
<span id="color" style="border-top: 2px solid <?php echo $array[$cove_color]; ?>;border: 2px solid <?php echo $array[$cove_color]; ?>; min-height: 74px;width:98.8%;display:block;">
           <dl class="resume_top">
               
               <div style="border: 7px solid #ddeef6<?php //echo $array[$cove_color]; ?>;	
					float: right;
					height: 55px !important;	
					width: 55px !important;
					margin-top:1px;
					margin-right:-2px;">
                   <a title="hello I am looking for a job" href="#">
                       <img  style="height: 55px !important; width: 55px !important;" src="<?php echo $url ?>"/> 
                   </a>
               </div>
               <div id="titlo-featured">
                   <strong><a href="<?php echo wpjr_link_to("resume", $resume) ?>"><?php esc_html_e($resume->firstname." ".$resume->lastname) ?></a></strong>
               </div>
               <dd class="title">
<?php //_e("Resume Category: ", WPJB_DOMAIN) ?>
<?php if ($resume->title){
if(strlen($resume->title)>15)
		{
			$resume->title=st_substr($resume->title,15,1);			
		}
esc_html_e($resume->title);
}
else esc_html_e($resume->getCategory(true)->title);

?>

               </dd>
              
               <!--<dt>Location</dt>-->
<?php if($resume->locationToString()): ?>
               <div id="location">
                   <strong><?php _e("Location: ", WPJB_DOMAIN) ?></strong><?php esc_html_e($resume->locationToString()) ?>
                   <div id="date2" class="wpjb-last wpjb-column-date">
                       <strong><?php //_e("Date: ", WPJB_DOMAIN) ?></strong>
                       <!--<span class="year"> <?php //wpjb_resume_last_update_at("M, d", $resume);?></span>-->
                   </div>
               </div>
<?php endif; ?>
               <!--<dt>Date Posted</dt>-->
           
           </dl>
</span>
       </la>
        <?php endforeach; else :?>
        <div>
                   <?php _e("No resumes found.", WPJB_DOMAIN); ?>
           </div>
           <?php endif; ?>
   </ol>
   
   <div id="wpjb-paginate-links">
       <?php wpjr_paginate_links() ?>
   </div>
   
   
<!--
   <table id="wpjb-resume-list" class="wpjb-table">
       <thead>
           <tr>
               <th><?php //_e("Name", WPJB_DOMAIN) ?></th>
               <th><?php //_e("Title", WPJB_DOMAIN) ?></th>
               <th class="wpjb-last"><?php //_e("Last Update", WPJB_DOMAIN) ?></th>
           </tr>
       </thead>
       <tbody>
       <?php //if (!empty($resumeList)) : foreach($resumeList as $resume): ?>
           <tr class="<?php //wpjb_resume_mods(); ?>">
               <td>
                   <a href="<?php //echo wpjr_link_to("resume", $resume) ?>"><?php //esc_html_e($resume->firstname." ".$resume->lastname) ?></a>
               </td>
               <td>
                   <?php //esc_html_e($resume->title) ?>
               </td>
               <td class="wpjb-last wpjb-column-date">
                   <?php //wpjb_resume_last_update_at("M, d", $resume);?>
               </td>
            </tr>
           <?php //endforeach; else :?>
           <tr>
               <td colspan="3" align="center">
                   <?php //_e("No resumes found.", WPJB_DOMAIN); ?>
               </td>
           </tr>
           <?php //endif; ?>
       </tbody>
   </table>

   <div id="wpjb-paginate-links">
       <?php wpjr_paginate_links() ?>
   </div>
   
   --->

</div>