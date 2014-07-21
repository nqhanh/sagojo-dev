<?php
/*
Template Name: Freelance Archives
*/
get_header(); ?>
<?php $user_id = get_current_user_id();?>
<div id="content" class="grid col-940">
<?php
			 $args = array(
			'author' => get_current_user_id(),
			'user_id' => get_current_user_id() ,
			'post_type' => 'freelance_post',
			);
			$the_query = new WP_Query( $args );
			$comments = get_comments($args);
?>
<div class="nav">
	<ul>	
		<li><a href="<?php echo site_url()?>/freelance-page/"><?php _e('Opening Projects','responsive');?></a></li>
		<li><a href="<?php echo site_url()?>/closed-projects/"><?php _e('Closed Projects','responsive');?></a></li>
		<li class="current"><a href="<?php echo site_url()?>/freelance-archives/"><?php _e('Categories','responsive');?></a></li>
		<li class="like_this_button"><a href="<?php echo site_url()?>/jobs/"><?php _e('<strong>Post a Project</strong> - It&rsquo;s FREE!',  'responsive' ) ;?></a></li>
	</ul>
</div>
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/files/css3-mediaqueries.js"></script>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
        
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



<?php //wp_list_freelance_categories('title_li='); ?>
<?php //hien thi tung category trong trang home

$cat_args = array(

  'orderby' => 'cat_ID',

  'order' => 'ASC',

  'child_of' => 0,

  'exclude'  => '1'

);

$categories =   get_freelance_categories($cat_args); 

foreach($categories as $category) { 
/*$args = array($category->cat_ID);
$tags = get_category_tags($args);
print_r($tags);*/
if ($category->category_parent == 0) {
$sub = '';
$child_list = get_freelance_categories('child_of='.$category->cat_ID.'&hide_empty=0');
foreach($child_list as $child) {
$sub .= '<li><a class="subcat" href="' . get_freelance_category_link( $child->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), __($child->name) ) . '" ' . '> &rarr;&nbsp;' . __($child->name).'</a>('.$child->count.')</li>';
}
//$child_list = wp_list_categories('orderby=id&show_count=0&use_desc_for_title=0&child_of='.$category->cat_ID.'');
    echo '<div class="freelance_categories_title"><a href="' . get_freelance_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), __($category->name) ) . '" ' . '>' . __($category->name).'</a></div><ol>';
	echo $sub;
	echo '</ol>';
	echo '<hr>';
}//if ($category

}//foreach($categories	
//het hien thi tung category trong trang home?>



<div class="clear"></div>
	
</div><!-- end of #content -->

<?php get_footer(); ?>
