<?php
    $args=array(

      'showposts' => 5,

      'category__in' => array($category->term_id),

      'caller_get_posts'=>1

    );
    $thecat = $category->cat_ID;
    $posts=get_posts($args);

      if ($posts) {

                //class="catnote black rounded" --->bop meo goc ne.
        echo '<div id="cat-td-'.$thecat;
        //post_ID; //code tu sinh id
        echo '" class="cat-td-cat"' ; //class="include-type2"';
        ///post_class;//code tu sinh
        echo '>'; 
        echo '<h1 class="h1-type2"><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '><b>' . $category->name.'</b></a></h1></div><div id="posts-list"><div class="post"> ';

        $j=0;

        foreach($posts as $post) {

          setup_postdata($post); ?>	

    <?php if ($j==0) { ?>		

<div class="lquad">	

				<div class="tinmoi tu-van-huong-nghiep">

					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(300,200), array('title' => "") ); ?></a>

				<!--</div>-->
				
				<!--<div class="right">-->
		
					<?php if ( is_sticky() ) : ?>

						<div class="sticky"><?php _e( 'Important', 'max-magazine' ); ?></div>

					<?php endif; ?>
					

					 <h2 id="conten-child-tieude"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'max-magazine'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

					<div class="exceprt">

						<?php 

							/**

							 * the_excerpt() returns first 30 words in the post.

							 * length is defined in functions.php.

							 */

							the_excerpt();

						?>

					</div> 
					

					<!-- <div class="more"><a href="<?php the_permalink(); ?>"><?php _e('Chi tiết &rarr;', 'max-magazine'); ?></a></div> -->

				</div>

</div> <!-- lquad -->

        <?php 
        
        } //end if $j==0
        
        else {
        
        echo "<div class=\"rhalf\">";
        if ($j==1) echo'<div class="post-image-first-post">';
        else echo '<div class="post-image-next">';
        ?>
					<!--<a href="<?php //the_permalink(); ?>"><?php //the_post_thumbnail( 'carousel-thumb', array('title' => "") ); ?></a> Cai nay neu muon hien thi thi hien thi hinh nhe' cung dep do-->

                <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><b><?php the_title(); ?></b></a>
                <div class="exceprt">

						<?php 

							/**

							 * the_excerpt() returns first 30 words in the post.

							 * length is defined in functions.php.

							 */

							//the_excerpt(); 
						?>

					</div>

            </div>

        </div> <!-- half -->

        <?php
        
                }
                
                $j++;
        
        ?>

          <?php

        } // foreach($posts

        	echo "</div><!-- post --></div> ";

      } // if ($posts
?>