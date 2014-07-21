<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package aThemes
 */
$at_options = get_option('at_options');
?>
		</div>
	<!-- #main --></div>

	<?php
		/* A sidebar in the footer? Yep. You can can customize
		 * your footer with up to four columns of widgets.
		 */
		get_sidebar( 'footer' );
	?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<!--<div class="clearfix container">
			<div class="site-info">
				Copyright &copy; <?php //echo date('Y'); ?> <?php //bloginfo( 'name' ); ?> A-LINE ltd. and A-LINE Vietnam Co., Ltd.
			</div><!-- .site-info -->

			<!--<div class="site-credit">
				President <a href="http://sagojo.com">Yohan Matsutani</a> 
			</div><!-- .site-credit -->
		<!--</div>-->
	<!-- #colophon --></footer>

<?php wp_footer(); ?>
<?php echo $at_options['code_footer']; ?>

</body>
</html>