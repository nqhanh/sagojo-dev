<div class='index-title'>
	<div id="jobline-content-index-hover">
		<div class='jobline-content-index'>
			
				<div class='time'>
				<?php
					$deadl = get_post_meta( get_the_ID(), 'cf_deadline', TRUE);
					$deadline = convert_datetime($deadl);
					$bidcheck = get_post_meta(get_the_ID(), 'estimatechosen', TRUE);					
				?>
				<?php /*echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago';*/
					/*echo esc_html( get_the_date());*/
					$gmt_timestamp = get_post_time('U', false);
					echo human_time_diff( $gmt_timestamp, current_time('timestamp') ) . __(' ago', 'responsive' ) ;
					echo "<br />";
					if (!empty($bidcheck)) _e( '<div class="closed_text">Closed</div>', 'responsive' );
					elseif (current_time('timestamp')> $deadline){
						_e( '<div class="expires_text">Expires</div>', 'responsive' );
						add_post_meta(get_the_ID(), 'is_expires', '1' );
					}
					else _e( '<div class="open_text">Opening</div>', 'responsive' );
				?>
				</div>

				<div class='link'>
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'go to view %s', 'responsive' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" target="_blank">
				
					<?php				
						echo st_substr(get_the_title(),60);										
					?></a>
					<div class="by_index">
					<?php _e('by: ', 'responsive' );
					the_author_posts_link();global $post;?></div>								    							
				</div>
				
				<div class='budget'>
					<?php
					$budg = get_post_meta( get_the_ID(), 'cf_budget', TRUE);
					$budget = $budg_array[$budg];
					if ($budg >1000000000) $budg = '0';
					$currency = get_post_meta(get_the_ID(), 'cf_currency', TRUE);
					if ($budg == '0') _e('no budget', 'responsive' );			
					else {
						if ($currency == 'VND')
							echo number_format($budg,0,",","."). __(' đ', 'responsive' ) ;
						else echo  __('$ ', 'responsive' ) . number_format($budg,0,",",".") ;
						
					}
					
					?>
				</div>
				
				<div class='deadline'>
					<?php
					/*$deadl = get_post_meta( get_the_ID(), 'cf_deadline', TRUE);
					$deadline = convert_datetime($deadl);
					$bidcheck = get_post_meta(get_the_ID(), 'estimatechosen', TRUE);
					if (!empty($bidcheck)) echo "Closed";
					/*if ($deadline > 9999999999) echo __('No', 'responsive' );*/
					/*elseif (current_time('timestamp')> $deadline) echo "Expires";
					else echo human_time_diff(current_time('timestamp'), $deadline);*/
					
					comments_number( '0', '1', '%' );
					?>
				</div>
				<div id="clear"></div>
			
			
		</div>	
		<div class="like_this"><div class="like_this_button"><a href="<?php echo site_url()?>/jobs/"><?php _e('Post a Project like this!',  'responsive' ) ;?></a></div><div class="like_this_content"><?php the_excerpt()?></div></div>
	</div>
	
</div>


