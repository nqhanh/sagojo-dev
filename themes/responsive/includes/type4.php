<div id="homeblog"><div class="widget-title"><?php _e('[:en]Recent News Articles[:vi]Cẩm nang nghề nghiệp[:ja]Recent News Articles'); ?></div>
<div class="textwidget"><?php _e('[:en]Fresh job related content posted each day.[:vi]Những lời khuyên chân thành trên con đường tìm việc của bạn.[:ja]Fresh job related content posted each day.'); ?></div>
<?php
$args=array(
  'showposts' => 4,
 // 'post__in'  => get_option('sticky_posts'),
  'caller_get_posts'=>1
);
$thecat = $category->cat_ID;
$posts=get_posts($args);
if ($posts) {	
	$j=0;
	foreach($posts as $post) {
		setup_postdata($post); 	
		       
		if ($j<3) echo "<div class=\"post_list next_news col-220 post_list-".$j."\">";
		else echo "<div class=\"post_list next_news col-220 fit post_list-".$j."\">";
		?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(133,100), array('title' => "") ); ?></a>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
		</div>
		<?php
			
			$j++;
	} // foreach($posts
} // if ($posts
echo "<div style=\"clear:both;\"></div></div>";
?>