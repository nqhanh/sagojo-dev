<?php

/**
 * Job types 
 * 
 * Job types widget template
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Widget
 * 
 */

 /* @var $job_types array List of Wpjb_Model_JobType objects */
 /* @var $param stdClass Widget configurations options */


?>

<?php echo $theme->before_widget ?>
<?php if($title) echo $theme->before_title.$title.$theme->after_title ?>
<!--
<script type="text/javascript">
           $(document).ready(function(){
  
  var colors = ['#3498db','#3E009F', '#e74c3c','#2c3e50','#0FAAFF','#e67e22','#20196A','#738FE6','#0F8F08','#9b59b6'];
  
  

  $('#jt-all').css({'background': '' + colors[Math.floor(Math.random() *      colors.length)]});
  $('#jt-free').css({'background': '' + colors[Math.floor(Math.random() *      colors.length)]});
  $('#a1').css({'background': '' + colors[Math.floor(Math.random() *      colors.length)]});
  $('#a2').css({'background': '' + colors[Math.floor(Math.random() *      colors.length)]});
  $('#a4').css({'background': '' + colors[Math.floor(Math.random() *      colors.length)]});
  $('#a5').css({'background': '' + colors[Math.floor(Math.random() *      colors.length)]});
  $('#a6').css({'background': '' + colors[Math.floor(Math.random() *      colors.length)]});
  
});
        </script>
-->


<ul id="ul-job-type" class="filter option-set">
  <li><a data-filter-value="" id="jt-all" href="<?php echo site_url()?>/tim-viec-lam/"><?php _e("View all", WPJB_DOMAIN) ?></a></li>
  <li><a data-filter-value="" id="jt-free"  href="<?php echo site_url()?>/freelance-type/">Freelance</a></li>
    <?php if(!empty($job_types)): foreach($job_types as $type): ?>
    <?php if($param->hide_empty && !$type->getCount()) continue; ?>
    <li class="nav-top-item">
        <a data-filter-value="<?php echo ".a".$type->id;?>" id='<?php echo "a".$type->id;?>' href="<?php echo wpjb_link_to("jobtype", $type) ?>">
            <?php esc_html_e($type->title) ?>
            <?php if($param->count): ?>(<?php echo intval($type->getCount()) ?>)<?php endif; ?>
        </a>
    </li>
    <?php endforeach; ?>
    <?php else: ?>
    <li><?php _e("No job types found.", WPJB_DOMAIN) ?></li>
    <?php endif; ?>
</ul>
<script>$(function(){setNavigation();});function setNavigation(){$("#ul-job-type li a").each(function (){if (((window.location.href).split('/')[(window.location.href).split('/').length-2]) == $(this).attr('href').split('/')[$(this).attr('href').split('/').length-2]) { $(this).addClass('selected');}});}</script>


<?php echo $theme->after_widget ?>