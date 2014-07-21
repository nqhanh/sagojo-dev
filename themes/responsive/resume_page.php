<?php 

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Full Content Template
 *
   Template Name:  Resume Page
 *
 * @file           tintuc.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/full-width-page.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */


get_header(); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"
     type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.8.20/jquery-ui.min.js"
     type="text/javascript"></script>
    <script src="http://jquery-ui.googlecode.com/svn/tags/latest/external/jquery.bgiframe-2.1.2.js"
        type="text/javascript"></script>
    <script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/minified/i18n/jquery-ui-i18n.min.js"
        type="text/javascript"></script>
    <style>
        /*.textarea{background: #fff;}
        .dragitems{width: 20%; float: left; background: #f1f1f1;}
        .dropitems{width: 70%;float: left;background: #f1f1f1;
                   margin-left: 20px;padding:5px 5px 5px 5px;}
        .dragitems ul{list-style-type: none;padding-left: 5px;
                   display: block;}
        #content{height: 400px;width: 650px;}*/
    </style>
    <script language="javascript" type="text/javascript">
	var drg = jQuery.noConflict();
        drg(function() {
            drg("#allfields li").draggable({
                appendTo: "#content",
                helper: "clone",
                cursor: "select",
                revert: "invalid"
            });
            initDroppable(drg("#djd_site_post_content"));
            function initDroppable(drgelements) {
                drgelements.droppable({
                    hoverClass: "textarea",
                    accept: ":not(.ui-sortable-helper)",
                    drop: function(event, ui) {
                        var drgthis = drg(this);
 
                        var tempid = ui.draggable.text();
                        var dropText;
                        dropText = tempid;
                        var droparea = document.getElementById('djd_site_post_content');
                        var range1 = droparea.selectionStart;
                        var range2 = droparea.selectionEnd;
                        var val = droparea.value;
                        var str1 = val.substring(0, range1);
                        var str3 = val.substring(range1, val.length);
                        droparea.value = str1 + dropText + str3;
                    }
                });
            }
        });
    </script>
	<div class="dropitems"><div class="dragndrop">
<div id="content" class="<?php echo implode( ' ', responsive_get_content_classes() ); ?>">
        
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
        
        <?php get_template_part( 'loop-header' ); ?>
        
			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>       
				<?php responsive_entry_top(); ?>
                <?php get_template_part( 'post-meta-page' ); ?>
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
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Search Job Widgets') ) : ?>  
        <?php endif; ?>      
</div><!-- end of #content -->
</div></div><!-- end of .dropitems -->
<div id="widgets" class="grid-right col-300 fit">
<div class="dragitems">
    <ul id="allfields" runat="server" class="wpjb-info">
		<li>Noi dung</li>
	</ul>
</div>
</div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>