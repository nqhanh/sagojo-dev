<?php
/**
 * The main template file.
 * Template Name: Blog
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package aThemes
 */

get_header(); ?>

			<div id="primary" class="content-area">
			
				<div class="entry-meta">
				  
				
				</div><!-- .entry-meta -->
			
				<div id="content" class="site-content" role="main">
				
				<?php
					$myposts = get_posts('');
						foreach($myposts as $post) :
						setup_postdata($post);
						?> 
						<a  href="<?php echo the_permalink();?>" ><?php echo get_the_date(); ?></a>&nbsp &nbsp<?php the_title(); ?>
						  <div class="post-item">
						 
							<div class="post-info">
								<ul >
								  <li class="post-title">
								  <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
								  <?php the_title(); ?>
								  </a>
								 </ul>
							  <!--<p class="post-meta">Posted by <?php //the_author(); ?></p>-->
							</div>
							
						  </div>
						<?php //comments_template(); ?>
						
						<?php endforeach; wp_reset_postdata(); ?>
        

				<!-- #content --></div>
			<!-- #primary --></div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>