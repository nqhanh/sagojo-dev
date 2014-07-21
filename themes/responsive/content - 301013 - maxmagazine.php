<?php
/**
 * The default template for displaying content.
 *
 * @file      footer.php
 * @package   max-magazine
 * @author    Sami Ch.
 * @link 	  http://gazpo.com
 */
?>
 <?php wp_get_current_user();?>
<div id="posts-list"><?php $j=0; ?>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
				<div class="post">		
				<?php if ($j==0){ ?>
				<div class="first black rounded">
				<div class="post-image-first">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(300,200), array('title' => "") ); ?></a>
				</div>
					
				<div class="right">
			
					<?php if ( is_sticky() ) : ?>
						<div class="sticky"><?php _e( 'Important', 'max-magazine' ); ?></div>
					<?php endif; ?>
					
					<h2> <a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'max-magazine'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					
					<!--<div class="post-meta">
						<!--<span class="date"><?php //the_time( get_option( 'date_format' ) ); ?></span> 
						<span class="sep"> - </span>						
						<span class="category"><?php //the_category(', '); ?></span>-->
						<?php /*the_tags( '<span class="sep"> - </span><span class="tags">' . __('Tagged: ', 'max-magazine' ) . ' ', ", ", "</span>" ) */?>
						<?php //if ( comments_open() ) : ?>
							<!--<span class="sep"> - </span>
							<span class="comments"><?php //comments_popup_link( __('0', 'max-magazine'), __( '1', 'max-magazine'), __('%', 'max-magazine')); ?></span> -->			
						<?php //endif; ?>		
					<!--</div>								-->
						
					<div class="exceprt">
						<?php 
							/**
							 * the_excerpt() returns first 30 words in the post.
							 * length is defined in functions.php.
							 */
							the_excerpt();
						?>
					</div> 
					
					<!--<div class="more">
						<a href="<?php the_permalink(); ?>"><?php _e('Read Post &rarr;', 'max-magazine'); ?></a>
					</div>-->
<?php
//for use in the loop, list 2 post titles related to first tag on current post
$tags = wp_get_post_tags($post->ID);
if ($tags) {
  //echo '<p><b>>';
  $first_tag = $tags[0]->term_id;
  $args=array(
    'tag__in' => array($first_tag),
    'post__not_in' => array($post->ID),
    'showposts'=>2,
    'caller_get_posts'=>1
   );
  $my_query = new WP_Query($args);
  if( $my_query->have_posts() ) {
	echo '<ul>';
    while ($my_query->have_posts()) : $my_query->the_post(); ?>
      <li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
      <?php
    endwhile;echo '</ul>';
  }
wp_reset_query();
}

?>
					
					
					 
				</div></div><!-- round -->	
		<?php }//if ($j==0
		else { ?>
                <div class="second"  style="margin-top: 20px;">
                <?php /*
                
                        $default_attr = array(
                    	'src'	=> $src,
                    	'class'	=> "attachment-$size",
                    	'alt'	=> trim(strip_tags( $wp_postmeta->_wp_attachment_image_alt )),
                    );*/
                    
                    $title= $wp_postmeta->_wp_attachment_image_alt;
                ?>
    				<div class="post-image">
    					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail',  array('title'=> trim(strip_tags( $attachment->the_title)))); ?></a>
    				</div>
    					
    				<div class="right">
    			
    					<?php if ( is_sticky() ) : ?>
    						<div class="sticky"><?php _e( 'Important', 'max-magazine' ); ?></div>
    					<?php endif; ?>
    					
    					<h1> <a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'max-magazine'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
    					
    					<div class="post-meta">
    						<!--<span class="date"><?php //the_time( get_option( 'date_format' ) ); ?></span> 
    						<span class="sep"> - </span>						
    						<span class="category"><?php //the_category(', '); ?></span>-->
    						<?php /*the_tags( '<span class="sep"> - </span><span class="tags">' . __('Tagged: ', 'max-magazine' ) . ' ', ", ", "</span>" )*/ ?>
    						<?php //if ( comments_open() ) : ?>
    							<!--<span class="sep"> - </span>
    							<span class="comments"><?php //comments_popup_link( __('0', 'max-magazine'), __( '1', 'max-magazine'), __('%', 'max-magazine')); ?></span> -->			
    						<?php //endif; ?>		
    					</div>								
    						
    					<div class="exceprt">
    						<?php 
    							/**
    							 * the_excerpt() returns first 30 words in the post.
    							 * length is defined in functions.php.
    							 */
    							the_excerpt();
    						?>
    					</div> 
    					
    					<!--<div class="more">
    						<a href="<?php the_permalink(); ?>"><?php _e('Read Post &rarr;', 'max-magazine'); ?></a>
    					</div> -->
    				</div>	
                
                </div>
		<?php } $j++; ?>
         <div style="clear: both;"></div>
        </div><!-- post -->

		<?php endwhile; ?>
		
		<?php if ( function_exists('max_magazine_pagination') ) { max_magazine_pagination(); } ?>		
		
	<?php endif; ?>	

</div>