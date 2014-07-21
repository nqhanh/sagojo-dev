<div class='index-title'>
	<div id="jobline-content-index-hover-type">
		<div class='jobline-content-index-type'>
			
				

				<div class='link_type'>
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'go to view %s', 'responsive' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" target="_blank">
				
					<?php				
						echo st_substr(get_the_title(),60);										
					?></a>
					<div class="by_index">
					<?php _e('by: ', 'responsive' );
					the_author_posts_link();global $post;?></div>								    							
				</div>
				
				<div class='budget_type'>
					<strong>Freelance</strong>
				</div>
				
				
				<div id="clear"></div>
			
				<div id="location" class="ba">
                            <strong><?php _e( 'Budget', 'responsive' ); ?></strong>
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
                            
                    
                    <div style="float: right;padding-right: 20px;">
                        <strong><?php _e("Date: ", WPJB_DOMAIN) ?></strong>
                        <span class="year"> <?php $gmt_timestamp = get_post_time('U', false);
					echo human_time_diff( $gmt_timestamp, current_time('timestamp') ) . __(' ago', 'responsive' ) ; ?></span>
                    </div>
                    </div>	
		</div>	
		<!--<div class="like_this"><div class="like_this_button"><a href="<?php echo site_url()?>/jobs/"><?php _e('Post a Project like this!',  'responsive' ) ;?></a></div><div class="like_this_content"><?php the_excerpt()?></div></div>-->
	</div>
	
</div>


