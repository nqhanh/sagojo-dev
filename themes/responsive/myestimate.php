<?php
/*
Template Name: My Estimate
*/
get_header(); ?>
<?php $user_id = get_current_user_id();?>
<?php

			 $args = array(
			'author' => get_current_user_id(),
			'user_id' => get_current_user_id() ,
			'post_type' => 'freelance_post',
			'number'  => '30',
	 		
			);
			$the_query = new WP_Query( $args );
			$comments = get_comments($args);
?>
<div class="nav">
	<ul>
		<?php if ($user_id > 0):?>		
		<?php if ($comments):?><li class="current"><a href="<?php echo site_url()?>/my-estimate/"><?php _e('My Estimates','responsive');?></a></li><?php endif;?>
		<?php endif;?>
		<li><a href="<?php echo site_url()?>/freelance-page/"><?php _e('Opening Projects','responsive');?></a></li>
		<li><a href="<?php echo site_url()?>/closed-projects/"><?php _e('Closed Projects','responsive');?></a></li>
		<li><a href="<?php echo site_url()?>/freelance-archives/"><?php _e('Categories','responsive');?></a></li>
		<li class="like_this_button"><a href="<?php echo site_url()?>/jobs/"><?php _e('<strong>Post a Project</strong> - It&rsquo;s FREE!',  'responsive' ) ;?></a></li>
	</ul>
</div>
<div id="content" class="grid col-620 ">

<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/files/css3-mediaqueries.js"></script>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
        
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
        
        <?php get_template_part( 'loop-header' ); ?>
        
			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>       
				<?php responsive_entry_top(); ?>

                <?php get_template_part( 'post-meta-page' ); ?>
                
                <div class="post-entry">
                    <?php the_content(__('Read more &#8250;', 'responsive')); ?>
                    <?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'responsive'), 'after' => '</div>')); ?>
                </div><!-- end of .post-entry -->
            
				<?php get_template_part( 'post-data' ); ?>
				               
				<?php responsive_entry_bottom(); ?>      
			</div><!-- end of #post-<?php the_ID(); ?> --> 
			
			<?php responsive_entry_after(); ?>
            
			<?php responsive_comments_before(); ?>
			<?php comments_template( '', true ); ?>
			<?php responsive_comments_after(); ?>
            
        <?php 
		endwhile; 

		get_template_part( 'loop-nav' ); 

	else : 

		get_template_part( 'loop-no-posts' ); 

	endif; 
	?>  



<?php //hien thi my estimates
	foreach($comments as $comment) :
	$date = new DateTime($comment->comment_date);
	echo "<div class=\"each_eatimate\"><div class=\"my_estimate_post_title\">".get_the_title($comment->comment_post_ID)."</div>";
	echo "<div class=\"comment_avatar\">".get_avatar( $user_id, 36  )."</div><div class=\"comment_text\">".date_format($date, 'd/m/Y')."<br /><a href='" .get_permalink($comment->comment_post_ID). "'>\"" . st_substr($comment->comment_content,160) . "\"</a></div></div>";
	endforeach;
?>





<div class="clear"></div>
	
</div><!-- end of #content -->
<?php get_sidebar(); ?>        

<?php get_footer(); ?>
