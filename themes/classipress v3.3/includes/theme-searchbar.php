<?php
/**
 * Theme search bar across the header
 * Only show it on certain pages
 *
 * @author AppThemes
 * @package ClassiPress
 *
 */
global $cp_options;
?>

<?php if ( is_page_template( 'tpl-ads-home.php' ) || is_search() || is_404() || is_tax( APP_TAX_CAT ) || is_tax( APP_TAX_TAG ) || is_singular( APP_POST_TYPE ) ) : ?>

	<div id="search-bar">

		<div class="searchblock_out">

			<div class="searchblock">

				<form action="<?php echo home_url('/'); ?>" method="get" id="searchform" class="form_search">

					<div class="searchfield">

						<input name="s" type="text" id="s" tabindex="1" class="editbox_search" style="<?php cp_display_style( 'search_field_width' ); ?>" <?php if ( get_search_query() ) { echo 'value="'.trim(strip_tags(esc_attr(get_search_query()))).'"'; } else { ?> value="<?php _e( 'What are you looking for?', APP_TD ); ?>" onfocus="if (this.value == '<?php _e( 'What are you looking for?', APP_TD ); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'What are you looking for?', APP_TD ); ?>';}" <?php } ?> />

					</div>

					<div class="searchbutcat">

						<button class="btn-topsearch" type="submit" tabindex="3" title="<?php _e( 'Search Ads', APP_TD ); ?>" id="go" value="search" name="sa"><?php _e( 'Search Ads', APP_TD ); ?></button>

						<?php wp_dropdown_categories('show_option_all='. __( 'All Categories', APP_TD ) .'&hierarchical='. $cp_options->cat_hierarchy .'&hide_empty='. $cp_options->cat_hide_empty .'&depth='. $cp_options->search_depth .'&show_count='. $cp_options->cat_count .'&pad_counts='. $cp_options->cat_count .'&orderby=name&title_li=&use_desc_for_title=1&tab_index=2&name=scat&selected='.cp_get_search_catid().'&class=searchbar&taxonomy='.APP_TAX_CAT); ?>

					</div>

				</form>

			</div> <!-- /searchblock -->

		</div> <!-- /searchblock_out -->

	</div> <!-- /search-bar -->

<?php endif; ?>