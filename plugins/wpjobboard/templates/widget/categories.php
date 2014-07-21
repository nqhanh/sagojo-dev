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
<div style="clear:both;padding-top:60px;"></div>
<div id="wpjb_widget_categories" class="wbjp_widget">
<blockquote>
<?php _e("Nothing is work unless you'd rather be doing something else", WPJB_DOMAIN);?>
<cite><?php _e("George Halas", WPJB_DOMAIN);?></cite>
</blockquote>
<?php echo $theme->before_widget ?>
<h5 class="tabber-widget-title">
<?php if($title) echo $theme->before_title.$title.$theme->after_title ?></h5>

<ol>
    <?php if(!empty($categories)): foreach($categories as $category): ?>
    <?php if($param->hide_empty && !$category->getCount()) continue; ?>
    <li>
        <a href="<?php echo wpjb_link_to("category", $category) ?>" target="_blank">
        &rarr;
            <?php esc_html_e($category->title) ?></a>
            <?php if($param->count): ?>(<?php echo intval($category->getCount()) ?>)<?php endif; ?>
        
    </li>
    <?php endforeach; ?>
    <?php else: ?>
    <li><?php _e("No categories found.", WPJB_DOMAIN) ?></li>
    <?php endif; ?>
</ol>

<?php echo $theme->after_widget ?></div>
<div style="clear:both;padding-top:60px;"></div>
<div id="wpjb_widget_categories_freelance" class="wbjp_widget">
<blockquote>
<?php _e("Dreams don't work unless you do", WPJB_DOMAIN);?>
<cite><?php _e("John C. Maxwell", WPJB_DOMAIN);?></cite>
</blockquote>
<h5 class="tabber-widget-title">