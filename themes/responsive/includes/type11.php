<?php
    $args=array(

      'showposts' => 3,

      'category__in' => array($category->term_id),

      'caller_get_posts'=>1

    );

    $posts=get_posts($args);

      if ($posts) {

        echo '<div class="catnote black rounded"><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '><b>' . $category->name.'</b></a></div><div id="posts-list"><div class="post">';

		$k=0;
        foreach($posts as $post) {

          setup_postdata($post);
			if ($k==2) $vitri='<div class="eachquad-end">';
			else $vitri='<div class="eachquad">';
			$k++;
			echo $vitri;
?>	

		<div class="carousel-posts">



					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'carousel-thumb', array('title' => "") ); ?></a>

				<!--</div>-->
				
				<!--<div class="right">-->
		
					<?php if ( is_sticky() ) : ?>

						<div class="sticky"><?php _e( 'Important', 'max-magazine' ); ?></div>

					<?php endif; ?>
					

					<h4><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'max-magazine'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h4>

					<div class="exceprt">

						<?php 

							/**

							 * the_excerpt() returns first 30 words in the post.

							 * length is defined in functions.php.

							 */

							the_excerpt();

						?>

					</div> 
					

					<!-- <div class="more"><a href="<?php the_permalink(); ?>"><?php _e('Detail &rarr;', 'max-magazine'); ?></a></div> -->


</div></div>
          <?php

        } // foreach($posts

	echo "</div><!-- post --></div> ";

      } // if ($posts
?>