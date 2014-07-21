<?php
$args=array(
  'showposts' => 4,
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
	$j=0;
	foreach($posts as $post) {
		setup_postdata($post); ?>	
		<?php if ($j==0) { ?>		
		<div class="post_list first_news">	
			<div class="tinmoi tu-van-huong-nghiep">
				<!--<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(300,200), array('title' => "") ); ?></a>-->
				<?php if ( is_sticky() ) : ?>
					<div class="sticky"><?php _e( 'Important', 'max-magazine' ); ?></div>
				<?php endif; ?>									
				<h2 id="conten-child-tieude"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'max-magazine'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				
				<div class="exceprt"><p><?php the_content_rss('', FALSE, '', 50);?></p>
					<?php 
						/**
						 * the_excerpt() returns first 30 words in the post.
						 * length is defined in functions.php.
						 */
						//the_excerpt();
					?>
				</div><div class="more"><a href="<?php the_permalink(); ?>"><?php _e('Read more &rarr;', 'responsive'); ?></a></div> 
			</div>
		</div> <!-- first_news -->
		<?php        
		} //end if $j==0        
		else {        
		if ($j==1 || $j ==2) echo "<div class=\"post_list next_news col-300\">";
		else echo "<div class=\"post_list next_news col-300 fit\">";
		?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(133,100), array('title' => "") ); ?></a>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
		</div>
		<?php
			}
			$j++;
	} // foreach($posts
	echo "</div>";//post_in_cat
} // if ($posts
echo "<div style=\"clear:both;\"></div>";
?>