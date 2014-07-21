<?php

/**
 * category menu
 * 
 * category menu widget template file
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


 <?php
    // Get the ID of a given category
    //$category_id =126;

    // Get the URL of this category
    //$category_link = get_category_link($category_id );
	
	
?>

<!-- Print a link to this category -->
        <?php 
            
             $category_title = __("Blog", WPJB_DOMAIN);
            
             
             $output .= "<li><a href='$posts_page'>$show_option_all</a></li>";
             //wp_list_categories('orderby=ID&optioncount=1&hierarchical=0&title_li=<h2 class="widget-title"><a href="'.esc_url( $category_link ). '">' .$category_title.'</a></h2>');
             wp_list_categories_n_multisite('orderby=ID&optioncount=1&hierarchical=0&exclude=1&title_li=<h2 class="widget-title"><a href="">' .$category_title.'</a></h2>');
             
            
        ?>
		
 
        <!--
        <ul id="wpjb_widget_resumesmenu" class="wpjb_widget">
        <li class="wpjb-li wpjb-underline-top">
            <a class="wpjb-ntdhover-link" href="<?php //echo site_url(); ?>/?cat=101"></a>
            <a class="wpjb-ntd-link" href="<?php //echo site_url(); ?>/?cat=101">
                <?php //_e("Events", WPJB_DOMAIN) ?>
            </a>
            <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
        </li>
		<li class="wpjb-li wpjb-underline-top">
            <a class="wpjb-ntdhover-link" href="<?php //echo wpjb_link_to("employer_panel") ?>"></a>
            <a class="wpjb-ntd-link" href="<?php //echo wpjb_link_to("employer_panel") ?>">
                <?php //_e("", WPJB_DOMAIN) ?>
            </a>
            <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
        </li>
</ul>-->




<?php echo $theme->after_widget ?>

