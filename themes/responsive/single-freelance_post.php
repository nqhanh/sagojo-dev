<?php get_header(); ?>
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
<div class="nav">
	<ul>
		<li><a href="<?php echo site_url()?>/freelance-page/"><?php _e('Opening Projects','responsive');?></a></li>
		<li><a href="<?php echo site_url()?>/closed-projects/"><?php _e('Closed Projects','responsive');?></a></li>
		<li><a href="<?php echo site_url()?>/freelance-archives/"><?php _e('Categories','responsive');?></a></li>
		<li class="current"><a href="#"><?php _e('View Project','responsive');?></a></li>
		<li class="like_this_button"><a href="<?php echo site_url()?>/jobs/"><?php _e('<strong>Post a Project</strong> - It&rsquo;s FREE!',  'responsive' ) ;?></a></li>
	</ul>
</div>
<div id="content" class="grid col-620 ">
 
			<?php while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1 class="post-title">
					<?php the_title(); ?>
				</h1>
				<?php get_template_part( 'content', 'single-freelance_post' ); ?>

				
				<?php
							
					// If comments are open or we have at least one comment, load up the comment template
						comments_template( '/comments_freelance_post.php', true );
					
				?>
			</div>
			<?php endwhile; // end of the loop. ?>
</div> <!-- end #content -->
<?php get_sidebar(); ?>    
<?php get_footer(); ?>