<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Full Content Template
 *
   Template Name:  Net Share Post Page
 *
 * @file           net-share-page.php
 * @package        Responsive 
 * @author         Hanhdo 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/net-share-page.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

get_header(); ?>

<div id="content-full" class="grid col-940">
        
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
        
        <?php get_template_part( 'loop-header' ); ?>
        
			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>       
				<?php responsive_entry_top(); ?>

                <?php //get_template_part( 'post-meta-page' ); ?>
                <?php $category_id = get_cat_ID( 'blog' );

				    // Get the URL of this category
				    $blogname = get_cat_name( $category_id );
				    
				    $category_link = get_category_link( $category_id );?>
                <div class="breadcrumbs">
							<span><a href="<?php echo site_url();?>" title="Home">Home</a>
							<?php /*printf( __( '%s', 'max-magazine' ), '<span>' . single_cat_title( '', false ) . '</span>' ); */?>
							<a href="<?php echo $category_link;?>"><?php echo $blogname;?></a></span><span><?php esc_html_e(the_title());?></span>
				 
				</div>
                
                <div class="post-entry">
                    <?php the_content(__('Read more &#8250;', 'responsive')); ?>
                    <?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'responsive'), 'after' => '</div>')); ?>
                </div><!-- end of .post-entry -->
            
				<?php get_template_part( 'post-data' ); ?>
				               
				<?php responsive_entry_bottom(); ?>      
			</div><!-- end of #post-<?php the_ID(); ?> -->       
			<?php responsive_entry_after(); ?>
            
			<?php responsive_comments_before(); ?>
			<?php comments_template( '', true ); ?>
			<?php responsive_comments_after(); ?>
            
        <?php 
		endwhile; 

		get_template_part( 'loop-nav' ); 

	else : 

		get_template_part( 'loop-no-posts' ); 

	endif; 
	?>  
      
</div><!-- end of #content-full -->

<?php get_footer(); ?>
