			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post">
				
				<div class="date">in 
					<?php
					$category = get_the_category(); 
					if(!empty($category))
						echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
					?> 
					- <?php the_time('d M, Y') ?>
				</div>
				<div class="author">by <?php the_author(); ?> <span> - <?php comments_number( 'no comments', 'one comment', '% comments' ); ?></span></div><div class="clearfix"></div>
				<div class="title"><?php the_title(); ?></div>
				<div class="content"><?php the_content(''); ?></div>
                <div class="fb-like" style="display:block;" data-href="<?php echo get_permalink()?>" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="true" data-send="false"></div>
			</div><!--/post-->
			<?php comments_template( '', true ); ?>
			<?php endwhile; /* Use PageNavi*/ else : ?>
				<b>404 Not Found</b>
			<?php endif; ?>