<?php

/**

 * The template for displaying the carousel posts.

 * Gets the category for the posts from the theme options. 

 * If no category is selected, displays the latest posts.

 *

 *

 * @file      footer.php

 * @package   max-magazine

 * @author    Sami Ch.

 * @link 	  http://gazpo.com

 *

 */

?>
<script type='text/javascript' src='<?php echo bloginfo('template_directory');?>/js/jcarousellite_1.0.1.min.js?ver=3.8.3'></script>
<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/js/custom.js?ver=3.8.3"></script>
<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/js/gazpo_custom.js?ver=3.8.3"></script>
<?php

	$carousel_cat_id = max_magazine_get_option('carousel_category');

	//if no category is selected for carousel, show latest posts

	if ( $carousel_cat_id == 0 ) {

		$post_query = 'posts_per_page=10&orderby=rand';

	} else {

		$post_query = 'cat='.$carousel_cat_id.'&posts_per_page=10&orderby=rand';

	}

?>



<div id="carousel">

	<div class="title">

		
<div id="homeblog"><div class="widget-title"><?php _e('[:en]Recent News Articles[:vi]Cẩm nang nghề nghiệp[:ja]Recent News Articles'); ?></div>
<div class="textwidget"><?php _e('[:en]Fresh job related content posted each day.[:vi]Những lời khuyên chân thành trên con đường tìm việc của bạn.[:ja]Fresh job related content posted each day.'); ?></div>		

		<div class="buttons">

			<div class="prev"><img src="<?php echo get_template_directory_uri(); ?>/images/prev.png" alt="prev" /></div>

			<div class="next"><img src="<?php echo get_template_directory_uri(); ?>/images/next.png" alt="next" /></div>

		</div>

</div>

			

	<div class="carousel-posts">				

		<ul>

			<?php query_posts( $post_query ); if( have_posts() ) : while( have_posts() ) : the_post(); ?>

			<li>

				<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( array(133,100), array('title' => "") ); ?></a>


					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'max-magazine'), the_title_attribute('echo=0')); ?>">

						<?php 
						the_title();							
						?>	

					</a>

			</li>

			<?php endwhile; endif;?>

			<?php wp_reset_query();?>

		</ul>				

	</div>			

</div><!-- /carousel -->