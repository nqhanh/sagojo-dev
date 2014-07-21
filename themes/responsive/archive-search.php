<?php 
/*
 Template Name: Search Archives
*/
get_header(); ?>
<?php $user_id = get_current_user_id();

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
		<li class="current"><a href="#"><?php _e('Archives','responsive');?></a></li>
		<li class="like_this_button"><a href="<?php echo site_url()?>/jobs/"><?php _e('<strong>Post a Project</strong> - It&rsquo;s FREE!',  'responsive' ) ;?></a></li>
	</ul>
</div>

<div id="content" class="grid col-620 ">
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
				<div id='freelance-page'>	
					<div class='index-title'>
						<div class='jobline'>
							<div class='time'><strong><?php _e( 'Posted', 'responsive' ); ?></strong></div>
							<div class='link'><strong><?php _e( 'Job description', 'responsive' ); ?></strong></div>
							
							<div class='budget'>				
								
								<strong><?php _e( 'Budget', 'responsive' ); ?></strong>
								<?PHP echo "</a>"; ?>				
							</div>
							
							<div class='deadline'><strong><?php _e( 'Bids', 'responsive' ); ?></strong></div>
						</div>
					</div>	
					
						<?php
							while ( have_posts() ) : the_post(); ?>
							
													<?php
														/* Include the Post-Format-specific template for the content.
														 */
														get_template_part( 'content-index', get_post_format() );
													?>
							
												<?php endwhile; 								
					
						// Reset Post Data
						
						?>
						
						<?php if (function_exists("max_magazine_pagination")) {
									max_magazine_pagination();
						} elseif (function_exists("majormedia_content_nav")) { 
									majormedia_content_nav( 'nav-below' );
						wp_reset_postdata();			
						}?>
							
				</div>
			</div><!--# freelance border-->
</div> <!-- end #content -->




<?php get_sidebar(); ?>        
<?php get_footer(); ?>