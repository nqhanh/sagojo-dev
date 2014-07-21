<?php
	$searchTxt = esc_attr( appthemes_filter( get_search_query() ) );
	if ( $searchTxt ==  __( 'What are you looking for?', APP_TD ) )
		$searchTxt = '*';
?>

	<div class="content">

		<div class="content_botbg">

			<div class="content_res">

				<div id="breadcrumb">

					<?php if ( function_exists('cp_breadcrumb') ) cp_breadcrumb(); ?>

				</div><!-- /breadcrumb -->

				<!-- left block -->
				<div class="content_left">

					<div class="shadowblock_out">

						<div class="shadowblock">

							<h1 class="single dotted"><?php printf( __( "Search for '%s' returned %s results", APP_TD ), $searchTxt, $wp_query->found_posts ); ?></h1>

						</div><!-- /shadowblock -->

					</div><!-- /shadowblock_out -->

					<?php get_template_part( 'loop', 'ad_listing' ); ?>

				</div><!-- /content_left -->

				<?php get_sidebar(); ?>

				<div class="clr"></div>

			</div><!-- /content_res -->

		</div><!-- /content_botbg -->

	</div><!-- /content -->
