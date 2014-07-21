<?php
/**
 * The default template for displaying content.
 *
 * @file      content.php
 * @package   max-magazine
 * @author    Sami Ch.
 * @link 	  http://gazpo.com
 */
?>
 <?php wp_get_current_user();?>
 
<div id="posts-list">
	<?php if (have_posts()) : ?><div class="post">
	
	<div id="containerjs">
		<?php while (have_posts()) : the_post(); ?>
				
		<div class="gridjs-cnvl">
			<div class="imgholder-cnvl">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(133,100), array('title'=> trim(strip_tags( $attachment->the_title)))); ?></a>
			</div>
			<h1 id="blog-exceprt-cnvl"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'max-magazine'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<p><?php the_content_rss('', FALSE, '', 36);?></p>
		</div>
				
					
		<?php endwhile; ?>	
						 	
			
		</div></div>	

		
		<?php if ( function_exists('max_magazine_pagination') ) { max_magazine_pagination(); } ?>		
		
	<?php endif; ?>	

</div>