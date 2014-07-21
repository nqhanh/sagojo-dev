<?php

/**
 * Freelance menu
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

<!--Begin Freelance Menu-->
	<?php $user_id = get_current_user_id();?>
	<?php
			 $args = array(
			'author' => get_current_user_id(),
			'user_id' => get_current_user_id() ,
			'post_type' => 'freelance_post',
			);
			$the_query = new WP_Query( $args );
			$comments = get_comments($args);
?>
	<?php if ($user_id > 0):?>
	<li class="wpjb-li wpjb-underline-top wpjb-boxshow-botton">
        <a class="wpjb-ntdhover-link"  href="<?php echo site_url()?>/jobs/"></a>
        <a class="wpjb-ntd-link" href="<?php echo site_url()?>/jobs/">
            <?php _e("Post Project", WPJB_DOMAIN) ?>
        </a>
        <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li>
		<?php if ($the_query->have_posts()):?>
	<li class="wpjb-li wpjb-underline-top wpjb-boxshow-botton">
        <a class="wpjb-ntdhover-link"  href="<?php echo site_url()?>/my-project/"></a>
        <a class="wpjb-ntd-link" href="<?php echo site_url()?>/my-project/">
            <?php _e("My Projects", WPJB_DOMAIN) ?>
        </a>
        <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li>
		<?php endif;?>
		<?php if ($comments):?>
	<li class="wpjb-li wpjb-underline-top wpjb-boxshow-botton">
        <a class="wpjb-ntdhover-link"  href="<?php echo site_url()?>/my-estimate/"></a>
        <a class="wpjb-ntd-link" href="<?php echo site_url()?>/my-estimate/">
            <?php _e("My Estimates", WPJB_DOMAIN) ?>
        </a>
        <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li>
		<?php endif;?>
	<li class="wpjb-li wpjb-underline-top wpjb-boxshow-botton">
        <a class="wpjb-ntdhover-link"  href="<?php echo home_url() . '/author/' . get_the_author_meta( 'user_login', wp_get_current_user()->ID ); ?>"></a>
        <a class="wpjb-ntd-link" href="<?php echo home_url() . '/author/' . get_the_author_meta( 'user_login', wp_get_current_user()->ID ); ?>">
            <?php _e("My Info", WPJB_DOMAIN) ?>
        </a>
        <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li>
	<?php endif;?>	
<!--END Freelance Menu-->	
</ul>
<?php echo $theme->after_widget ?>