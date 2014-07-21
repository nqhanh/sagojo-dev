<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Single Posts Template
 *
 *
 * @file           single.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/single.php
 * @link           http://codex.wordpress.org/Theme_Development#Single_Post_.28single.php.29
 * @since          available since Release 1.0
 */

	get_header(); 

?>


<div id="content-cnvl" class="">
      
	<?php get_template_part( 'loop-header' ); ?>
         
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
        
			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>   
					<div class="breadcrumbs">
						<span><a href="<?php echo site_url();?>" title="Home">Home</a>
						<?php //printf( __( '%s', 'max-magazine' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
						<?php the_category(' ','multiple'); ?></span><?php //the_title(); ?>
 
					</div>
				<?php responsive_entry_top(); ?>

                <?php get_template_part( 'post-meta' ); ?> <!--chay den trang post-meta.php-->
				
                <div class="post-entry" style="text-align: justify;">
						<?php /*echo "<div class='blog-author-info'>";
						$author_id=$post->post_author;
						$user_info = get_userdata($author_id);
						$category = get_the_category();	
						$user_url = $user_info->user_url;
						if (empty($user_url)) $user_url = "http://www.sagojo.com";
						echo get_avatar( $author_id, 70 );
						echo "<div class='blog-author-info-content'><div class='blog-display_name'>".the_author_posts_link()."</div>";
						echo "<div class='blog-text'><div class='blog-cat-date-post'>".the_date('dd-mm-yyyy')."</div>";
						echo "<div class='blog-cat-title'>".the_time()." - ".$user_url."</div></div></div>";
						echo "</div>";*/
						
						?>
						
						<?php
						the_content(__('Read more &#8250;', 'responsive')); ?>
						<?php setPostViews(get_the_ID());?>
                    <?php if ( get_the_author_meta('description') != '' ) : ?>
                    
                    <div id="author-meta">
                    <?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '80' ); }?>
                        <div class="about-author"><?php _e('About','responsive'); ?> <?php the_author_posts_link(); ?></div>
                        <p><?php the_author_meta('description') ?></p>
                    </div><!-- end of #author-meta -->
                    
                    <?php endif; // no description, no author's meta ?>
                   	
                    <?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'responsive'), 'after' => '</div>')); ?>
                </div><!-- end of .post-entry -->
				<div class="share-social">
							<div class="fb-share">
								<div class="fb-share-button" data-href="<?php echo get_permalink();?>" data-type="button"></div>
							</div>
							<div class="fb-buttom-like">
							<div class="fb-like" data-href="<?php the_permalink();?>" data-colorscheme="light" data-layout="button_count" data-action="like"
								data-show-faces="false" data-send="false"></div>
							</div>
							<div class="google-plus">
								<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
								<g:plusone size="medium" data-height="20"></g:plusone>
							</div>
							<div class="share-twitter">
								<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php the_title();?>">Tweet</a>
								<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https'; 
									if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
									fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
							</div>
				</div><!---End share-social--->
				<div class="fb-comments" data-href="<?php echo get_permalink();?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
                <!--<div style="clear:both;"></div>-->
                <!--Phan nay minh se biet duoc noi dung cu cung lien quan nhe.Quan trong-->
                <!--<div class="panavigation">
			        <div class="previous"><?php //previous_post_link( '<h2 style="font-size:18px; margin:0;"><span class="meta-nav">%link</h2>' ); ?></div>
                    <div class="next"><?php //next_post_link('<h2 style="font-size:18px; margin:0;">%link <span class="meta-nav"></h2>' ); ?></div>
                    <div style="clear: both;"></div>
		        </div><!-- end of .navigation -->
                
                <?php //get_template_part( 'post-data' ); ?>
				               
				<?php responsive_entry_bottom(); ?>  
				<!--<div style="clear:both;"></div>				-->
			</div><!-- end of #post-<?php //the_ID(); ?> -->      
			
			<div id="relate-post-single">
				<?php

				$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 7, 'post__not_in' => array($post->ID) ) );
				if( $related ){?>
				<h1 id="relate-single"><?php _e('[:en]Related posts:[:vi]Xem thêm hướng dẫn:', 'responsive');?></h1> 
				<?php foreach( $related as $post ) {
				setup_postdata($post); ?>
				 <ul style="margin: 0 1.5em 0.4em 0;padding-left: 2.0em;"> 
						<li style="list-style: square inside;display: list-item;">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						</li>
					</ul>   
				<?php }
				wp_reset_postdata(); }?>
			</div>
			<?php //responsive_entry_after(); ?>            
            
			<?php //responsive_comments_before(); ?>
			<?php //comments_template( '', true ); ?>
			<?php //responsive_comments_after(); ?>
            
        <?php 
		endwhile; 

		get_template_part( 'loop-nav' ); 

	else : 

		get_template_part( 'loop-no-posts' ); 

	endif; 
	?>  
      
</div><!-- end of #content -->
<?php get_footer(); ?>

