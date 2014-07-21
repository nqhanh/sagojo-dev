<?php

/**
 * Search projects
 * 
 * Search projects widget template file
 * 
 * 
 * @author hanhdo205
 * @package Templates
 * @subpackage Widget
 * 
 */


?>

<?php echo $theme->before_widget ?>
<?php if($title) echo $theme->before_title.$title.$theme->after_title ?>

<div id="wpjb_widget_alerts" class="wpjb_widget">
 
    <form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
    <input type="text" name="s" placeholder="<?php _e("Search Keyword" ,WPJB_DOMAIN) ?>"/>
    <input type="hidden" name="post_type" value="freelance_post" /> 
    <input type="submit" alt="Search" value="<?php _e("Search", WPJB_DOMAIN) ?>" />
  </form> 
</div>

<?php echo $theme->after_widget ?>
