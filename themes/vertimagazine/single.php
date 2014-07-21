<?php
/**
 * The Template for displaying all single posts.
 *
 * @package vertiMagazine theme
 */
?>
<?php get_header(); ?>
<div id="wrap">
	<div id="content">

		<?php get_template_part( 'loop', 'single' ); ?>
<div class="fb-like" style="display:block;" data-href="<?php echo get_permalink()?>" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="true" data-send="false"></div>
	</div><!-- #content -->
    <?php get_sidebar(); ?>
</div><!-- #wrap -->
<?php get_footer(); ?>