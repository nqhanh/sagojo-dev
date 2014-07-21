<?php get_header(); ?>
<?php $user_id = get_current_user_id();
$taxonomyName = get_query_var( 'taxonomy' );
if ($taxonomyName=='freelance_category'||$taxonomyName=='freelance_tag'){?>
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
		<li class="current"><a href="#"><?php _e('Archives','responsive');?></a></li>
		<li class="like_this_button"><a href="<?php echo site_url()?>/jobs/"><?php _e('<strong>Post a Project</strong> - It&rsquo;s FREE!',  'responsive' ) ;?></a></li>
	</ul>
</div>
<?php }?>
<div id="content" class="grid col-620 ">
		
			<!-- Cua anh Hanh - dung edit -->
			<?php 
			
			if ($taxonomyName=='freelance_category'||$taxonomyName=='freelance_tag'){
				echo "<header class=\"page-header\">";
				echo "<h1 class=\"page-title\">";
				$term = get_queried_object();
				if ( is_category() )
					$term_name =  $term->name ;
				elseif ( is_tag() )
				$term_name = $term->name ;
				elseif ( is_tax() )
				$term_name =  $term->name ;
				echo __($term->name);
				//_e(single_cat_title());
				//_e('[:en]Eng[:vi]Vi[:ja]Ja');
				if ( is_tag() )
					echo __(single_tag_title());
				echo "</h1>";
				echo "<div class=\"dash2\"></div>";
				echo "</header>";
				
				echo "<div id='freelance-page'>";
				
				if ( have_posts() ) :?>				
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
				<?php rewind_posts(); ?>
									
						<?php /* Start the Loop */ ?>

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

					<?php
					
				else : ?>

								

							<div class="no-jobs-yet">
							<h5><?php _e( 'There are no jobs yet.', 'responsive' ); ?></h5>
								<p><?php _e( 'Need some work done? Post a Project Today.', 'responsive' ); ?></p>
								<div class="post_free"><div class="title"><a href="<?php echo site_url()?>/jobs/"><?php _e('Post a Project',  'responsive' ) ;?></div><div class="content"><?php _e('It&rsquo;s free!',  'responsive' ) ;?></div></a></div>
								<?php //get_search_form(); ?>
							</div><!-- .entry-content -->

				<?php endif; ?>
							</div><!--# freelance border-->
							
				<!-- Cua anh Hanh - dung edit -->		
								
				<?php } else {?>					
            
                <?php //the_breadcrumb(); ?> <!--day la su dung function.php Breadcrumm-->
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
            
				<div id="content" >	
					<h2 class="page-title">
						<?php if ( is_day() ) : ?>
							<?php printf( __( 'Daily Archives: %s', 'max-magazine' ), '<span>' . get_the_date() . '</span>' ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Monthly Archives: %s', 'max-magazine' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'max-magazine' ) ) . '</span>' ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Yearly Archives: %s', 'max-magazine' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'max-magazine' ) ) . '</span>' ); ?>
						<?php else : ?>
							<?php _e( 'Blog Archives', 'max-magazine' ); ?>
						<?php endif; ?>
					</h2>	
					
						<?php get_template_part( 'content', get_post_format() );?>
							
				</div>

			</div><!--# freelance border-->
            <?php if (function_exists('wp_corenavi')) wp_corenavi(); 
            
            }?>
    </div> <!-- end #content -->

<?php get_sidebar(); ?>        
<?php get_footer(); ?>