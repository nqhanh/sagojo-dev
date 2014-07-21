<?php
/**
 * The Template for displaying all single posts.
 *
 * @package aThemes
 */

get_header();
$at_options = get_option('at_options');
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>
			<!-- AddThis Button BEGIN --->
						<!-- AddThis Button BEGIN -->
						<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
						<a class="note_addthis">Share this:</a>
						<a  rel="nofollow" class="lineit_button">
											<script type="text/javascript" src="http://media.line.naver.jp/js/line-button.js?v=20130508" ></script>
											<script type="text/javascript">
											new jp.naver.line.media.LineButton({"pc":false,"lang":"en","type":"d"});
											</script>
						</a>
						<a rel="nofollow" class="addthis_button_preferred_1"></a>
						<a rel="nofollow" class="addthis_button_preferred_2"></a>
						<a rel="nofollow" class="addthis_button_preferred_3"></a>
						<a rel="nofollow" class="addthis_button_preferred_4"></a>
						<a rel="nofollow" class="addthis_button_compact"></a>
						
						</div>
						<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
						<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52162f5f32669853"></script>
			<!-- AddThis Button END -->	
			<?php if ( $at_options['post_author_box'] == '1' ) : ?>
			<div class="clearfix author-info">
				<div class="author-photo"><?php echo get_avatar( get_the_author_id() , 75 ); ?></div>
				<div class="author-content">
					<h3><?php the_author(); ?></h3>
					<p><?php the_author_meta( 'description' ); ?></p>
					<div class="author-links">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="me">More Posts</a>

						<?php if ( get_the_author_meta( 'twitter' ) ) : ?>
						<a href="http://twitter.com/<?php echo get_the_author_meta( 'twitter' ); ?>">Twitter</a>
						<?php endif; ?>

						<?php if ( get_the_author_meta( 'facebook' ) ) : ?>
						<a href="https://facebook.com/<?php echo get_the_author_meta( 'facebook' ); ?>">Facebook</a>
						<?php endif; ?>

						<?php if ( get_the_author_meta( 'linkedin' ) ) : ?>
						<a href="http://linkedin.com/in/<?php echo get_the_author_meta( 'linkedin' ); ?>">LinkedIn</a>
						<?php endif; ?>
					</div>
				</div>
			<!-- .author-info --></div>
		    <?php endif; ?>

			<?php athemes_content_nav( 'nav-below' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>