<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Content/Sidebar Template
 *
   Template Name:  Coupon
 *
 * @file           coupon_page.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/coupon_page.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

get_header(); ?>
<div id="content" class="grid col-620 ">

<?php get_template_part( 'loop-header' ); ?>
        
			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>       
				<h1 class="post-title"><?php the_title(); ?></h1> 
                
                <div class="post-entry">
                    <form action="<?php echo site_url()?>/addnewconfirm" method="post">
					<?php _e('Input your Pack code below:','responsive')?><br/>
						<input name="code" type="text">
						<input name="submit" type="submit" value="<?php _e('Generate','responsive')?>" />
					</form>
                </div><!-- end of .post-entry -->
            
				<?php get_template_part( 'post-data' ); ?>
				               
				<?php responsive_entry_bottom(); ?>      
			</div><!-- end of #post-<?php the_ID(); ?> --> 
			
			<?php responsive_entry_after(); ?>      
</div><!-- end of #content -->


<?php get_footer(); ?>
