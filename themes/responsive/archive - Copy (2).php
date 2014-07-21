<?php get_header();
 ?>
<div class="breadcrumbs">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</div> 

<div id="content" class="grid col-620 ">



            	<!-- Cua anh Hanh - dung edit -->
			<?php 
			$taxonomies=get_taxonomies('','freelance_category'); 
			$taxonomyName = get_query_var( 'taxonomy' );
			if ($taxonomyName=='freelance_category'){	
				echo single_cat_title();
				if ( is_tag() )
					echo single_tag_title();
				echo "<div id='freelance-page'>";
				
				if ( have_posts() ) :
				?><div class='index-title'>
						<div class='jobline'>
							<div class='time'><strong><?php _e( 'Posted', 'responsive' ); ?></strong></div>
							<div class='link'><strong><?php _e( 'Job description', 'responsive' ); ?></strong></div>
							
							<div class='budget'>				
								
								<strong><?php _e( 'Budget', 'responsive' ); ?></strong>
								<?PHP echo "</a>"; ?>				
							</div>
							
							<div class='deadline'><strong><?php _e( 'Deadline', 'responsive' ); ?></strong></div>
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

						<article id="post-0" class="post no-results not-found">
							<header class="entry-header">
								<h1 class="entry-title"><?php _e( 'There are no jobs yet.', 'responsive' ); ?></h1>
							</header><!-- .entry-header -->

							<div class="entry-content">
								<p><?php _e( 'Create some jobs by posting in the box above.', 'responsive' ); ?></p>
								<?php get_search_form(); ?>
							</div><!-- .entry-content -->
						</article><!-- #post-0 -->

					<?php endif; ?>
							</div><!--# freelance border-->
							
				<!-- Cua anh Hanh - dung edit -->					
				<?php } else {?>					
									
		      <?php if ( function_exists('yoast_breadcrumb') ) {
                	  yoast_breadcrumb('<div class="breadcrumbs">','</div>');
                } ?>
                
                <?php //the_breadcrumb(); ?> <!--day la su dung function.php Breadcrumm-->
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
            
				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<h1 class="page-title">
							<?php
								/*if ( is_day() ) :
									printf( __( 'Daily Archives: %s', 'wpfrl' ), '<span class="red">' . get_the_date() . '</span>' );
								elseif ( is_month() ) :
									printf( __( 'Monthly Archives: %s', 'wpfrl' ), '<span class="red">' . get_the_date( 'F Y' ) . '</span>' );
								elseif ( is_year() ) :
									printf( __( 'Yearly Archives: %s', 'wpfrl' ), '<span class="red">' . get_the_date( 'Y' ) . '</span>' );
								else :
									_e( 'Archives', 'wpfrl' );
								endif;*/
                                the_category(', ');
							?>
						</h1>
						<div class="dash2"></div>
					</header>

					<?php rewind_posts(); ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							/* Include the Post-Format-specific template for the content.
							 */
							get_template_part( 'content', get_post_format() );//chay snag file content lat noi dung
						?>

					<?php endwhile; ?>

					<?php if (function_exists("majormedia_pagination")) {
								majormedia_pagination(); 
					} elseif (function_exists("majormedia_content_nav")) { 
								majormedia_content_nav( 'nav-below' );
					}?>

				<?php else : ?>

					<article id="post-0" class="post no-results not-found">
						<header class="entry-header">
							<h1 class="entry-title"><?php _e( 'Nothing Found', 'wpfrl' ); ?></h1>
						</header><!-- .entry-header -->

						<div class="entry-content post_content">
							<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wpfrl' ); ?></p>
							<?php get_search_form(); ?>
						</div><!-- .entry-content -->
					</article><!-- #post-0 -->

				<?php endif; ?>

			</div><!--# freelance border-->
            <?php if (function_exists('wp_corenavi')) wp_corenavi(); 
            
            }?>
    </div> <!-- end #content -->

<?php get_sidebar(); ?>        
<?php get_footer(); ?>