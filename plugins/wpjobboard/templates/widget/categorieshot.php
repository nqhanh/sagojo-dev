<!--Neu la nguoi tim viec-->
    <?php  if((!get_user_meta(wp_get_current_user()->ID, "is_employer"))&&(strpos($_SERVER["REQUEST_URI"],'/view/')===false)):  ?>
<?php

/**
 * Categories 
 * 
 * Categories widget template
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Widget
 * 
 */

 /* @var $categories array List of Wpjb_Model_Category objects */
 /* @var $param stdClass Widget configurations options */


?>
<div class="effect4">
<?php echo $theme->before_widget ?>
<?php if($title) echo $theme->before_title.$title.$theme->after_title ?>
<div id="wpjb_widget_categories" class="wbjp_widget">
<ul>
    <?php if(!empty($categories)): foreach($categories as $category): ?>
    <?php if($param->hide_empty && !$category->getCount()) continue; ?>
    <li class="hot-cat-li">
        <div class="cat-title"><a href="<?php echo wpjb_link_to("category", $category) ?>">
            <?php esc_html_e($category->title) ?></a></div><div class="cat-count">
            <?php if($param->count): ?><?php echo intval($category->getCount()) ?><?php endif; ?></div>
        
    </li>
	
    <?php endforeach; ?>
	<li class="hot-cat-li-all"><a href="<?php echo site_url();?>/viec-lam/#wpjb_widget_categories"><?php _e("view all &raquo;", WPJB_DOMAIN) ?></a></li>
    <?php else: ?>
    <li><?php _e("No categories found.", WPJB_DOMAIN) ?></li>
    <?php endif; ?>
</ul>
</div>
<?php echo $theme->after_widget ?>
</div>
<?php endif; ?>
<!--End neu la nguoi tim viec-->