<?php
/**
 * The default template for displaying content.
 *
 * @file      content.php
 * @package   max-magazine
 * @author    Sami Ch.
 * @link 	  http://gazpo.com
 */
?>
 <?php wp_get_current_user();?>
 <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/css/style_blocksit.css' media='screen' />
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
 <!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
 <script src="<?php echo get_template_directory_uri();?>/js/blocksit.js"></script>
<script>
var _post = jQuery.noConflict();
_post(document).ready(function() {
	
	
	//blocksit define
	_post(window).load( function() {
		var winWidth = _post(window).width();
		var conWidth;
		if(winWidth < 320) {
			conWidth = 240;
			col = 1
		} else if(winWidth < 440) {
			conWidth = 320;
			col = 1
		} else if(winWidth < 660) {
			conWidth = 440;
			col = 1
		} else if(winWidth < 880) {
			conWidth = 660;
			col = 2
		} else if(winWidth < 976) {
			conWidth = 880;
			col = 3;
		} else {
			conWidth = 976;
			col = 4;
		}
		_post('#containerjs').width(conWidth);
		_post('#containerjs').BlocksIt({
			numOfCol: col,
			offsetX: 8,
			offsetY: 8
		});
	});
	
	//window resize
	var currentWidth = 976;
	_post(window).resize(function() {
		var winWidth = _post(window).width();
		var conWidth;
		if(winWidth < 320) {
			conWidth = 240;
			col = 1
		} else if(winWidth < 440) {
			conWidth = 320;
			col = 1
		} else if(winWidth < 660) {
			conWidth = 440;
			col = 1
		} else if(winWidth < 880) {
			conWidth = 660;
			col = 2
		} else if(winWidth < 976) {
			conWidth = 880;
			col = 3;
		} else {
			conWidth = 976;
			col = 4;
		}
		
		if(conWidth != currentWidth) {
			currentWidth = conWidth;
			_post('#containerjs').width(conWidth);
			_post('#containerjs').BlocksIt({
				numOfCol: col,
				offsetX: 8,
				offsetY: 8
			});
		}
	});
});
</script>
<div id="posts-list">
	<?php if (have_posts()) : ?><div class="post">
	
	<div id="containerjs">
		<?php while (have_posts()) : the_post(); ?>
				
		<div class="gridjs">
		<div class="imgholder">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium',  array('title'=> trim(strip_tags( $attachment->the_title)))); ?></a>
		</div>
		<h1 id="blog-exceprt"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'max-magazine'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<p><?php the_content_rss('', FALSE, '', 20);?></p>
		</div>
				
					
		<?php endwhile; ?>	
						 	
			
		</div></div>	

		
		<?php if ( function_exists('max_magazine_pagination') ) { max_magazine_pagination(); } ?>		
		
	<?php endif; ?>	

</div>