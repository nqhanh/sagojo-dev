<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package vertiMagazine theme
 */
?>
		<div id="sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?>
			<?php endif; ?>
		</div><!--/sidebar-->
