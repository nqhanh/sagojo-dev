<?php
/**
 
 *
 * This is the template that displays full width pages.
 * 
 * @package aThemes
 * The main template file.

 * Template Name: Content Listpost
 */


get_header(); ?>

			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">
				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to overload this in a child theme then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'content-listpost', get_post_format() );
							
						?>

					<?php endwhile; ?>

					<?php athemes_content_nav( 'nav-below' ); ?>

				<?php else : ?>

					<?php get_template_part( 'no-results', 'listpost' ); ?>

				<?php endif; ?>

				<!-- #content --></div>
			<!-- #primary --></div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>