<?php
$args=array(
  'showposts' => 3,
  'category__in' => array($category->term_id),
  'caller_get_posts'=>1
);
$thecat = $category->cat_ID;
$posts=get_posts($args);
if ($posts) {
	echo "<div id=\"post_in_cat\">";
	echo "<div id=\"cat-title\">";
	echo "<h1><a href=\"" . get_category_link( $category->term_id ) . "\" title=\"" . sprintf( __( "View all posts in %s" ), $category->name ) . "\" " . ">" . $category->name."</a></h1>";
	echo "</div>";
	foreach($posts as $post) {
		setup_postdata($post); ?>	
		<div class="post_list-cnvl first_news-cnvl">	
			<div class="c-post_list-cnvl c-first-cnvl">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(133,100), array('title' => "") ); ?></a>
				<?php if ( is_sticky() ) : ?>
					<div class="sticky"><?php _e( 'Important', 'max-magazine' ); ?></div>
				<?php endif; ?>									
				<h2 id="tieude-cnvl"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'max-magazine'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				
				<div class="exceprt"><p><?php the_content_rss('', FALSE, '',50);?></p>
					<?php 
						/**
						 * the_excerpt() returns first 30 words in the post.
						 * length is defined in functions.php.
						 */
						//the_excerpt();
					?>
				</div><!--<div class="more"><a href="<?php //the_permalink(); ?>"><?php //_e('Read more &rarr;', 'responsive'); ?></a></div> -->
			</div>
		</div> <!-- first_news -->
		<?php        
		
	} // foreach($posts
	echo "</div>";//post_in_cat
} // if ($posts
echo "<div style=\"clear:both;\"></div>";
?>