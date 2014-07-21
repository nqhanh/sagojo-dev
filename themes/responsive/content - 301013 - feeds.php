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
<div id="posts-list"><?php $j=1; ?>
	<?php if (have_posts()) : ?><div class="post">
		<?php while (have_posts()) : the_post(); ?>
				
				<?php if ($j%3==0){ ?>
				
				<div class="grid col-300blog fit"><div class="my-exceprt-border">
						<div class="flickrgrid3">
    						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium',  array('title'=> trim(strip_tags( $attachment->the_title)))); ?></a>
    					</div>
    					<div style="clear: both;"></div>
    					<div class="my-exceprt">
						<h1 id="blog-exceprt"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'max-magazine'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
						
						<?php 
							/**
							 * the_excerpt() returns first 30 words in the post.
							 * length is defined in functions.php.
							 */
							//the_excerpt();
							the_content_rss('', FALSE, '', 20);
						?>
					</div> 
					</div>
					</div><!-- end of .col-300 fit -->
					
				<div style="clear: both;"></div>
				<?php }//if ($j==2)
				else { ?>
					
				<div class="grid col-300blog"><div class="my-exceprt-border">
					<div class="flickrgrid3">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium',  array('title'=> trim(strip_tags( $attachment->the_title)))); ?></a>
					</div>
					<div style="clear: both;"></div>
					<div class="my-exceprt">
					<h1 id="blog-exceprt"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'max-magazine'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
						
						<?php 
							/**
							 * the_excerpt() returns first 30 words in the post.
							 * length is defined in functions.php.
							 */
							//the_excerpt();
						the_content_rss('', FALSE, '', 20);
						?>
					</div></div>
					</div><!-- end of .col-300 -->
					
				<?php } $j++; ?>	
		<?php endwhile; ?>	
						 	
			
		</div>		

		
		<?php if ( function_exists('max_magazine_pagination') ) { max_magazine_pagination(); } ?>		
		
	<?php endif; ?>	

</div>