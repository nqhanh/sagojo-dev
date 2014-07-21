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


 
    <?php // Get the ID of a given category
    //$category_id =126;

    // Get the URL of this category
    //$category_link = get_category_link($category_id );
	 $user_info = get_userdata(1);
	 $author= $user_info->ID;
	$display_name = get_the_author_meta('display_name'); 
	
	?>
	
	<ul>
					<li id="author-profile-avatar">
							<al class="gallery">
							<li style="margin: 0;position: relative;width: 287px;height: 100%;">
									
								<?php echo get_avatar(100); ?>
							</li>
							</al>	
						</li>
						<li id="author-profile-name-display"><?php the_author_meta('display_name', 1); ?></li>	
						
	</ul>






<?php echo $theme->after_widget ?>

