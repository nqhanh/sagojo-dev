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

<?php $job_numbers=0;?>
   <?php if(!empty($job_types)): foreach($job_types as $type): ?>
<?php $job_numbers+=intval($type->getCount());?>
   <?php endforeach; ?>
   <?php endif; ?>
<?php _e("[:en]<span id='job_count_content'>Total job posted: </span><span id='job_count_number'>".$job_numbers."</span>
[:vi]<span id='job_count_content'>Việc làm đăng tuyển: </span><span id='job_count_number'>".$job_numbers."</span>
[:ja]<span id='job_count_content'>有効求人件数: </span><span id='job_count_number'>".$job_numbers."</span>") ?>
<?php echo $theme->after_widget ?>