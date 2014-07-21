<div class='index-title'>
		<div class='excerpt-content-index'>
			
				<div class='link_title'>
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'go to view %s', 'responsive' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
				
					<?php				
						echo st_substr(get_the_title(),60);										
					?></a>
				</div>
				
				<div class='budget_title'>
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
				
				<div class='deadline_title'>
					<?php
					
					$gmt_timestamp = get_post_time('U', false);
					echo human_time_diff( $gmt_timestamp, current_time('timestamp') ) . __(' ago', 'responsive' ) ;
					?>
				</div>
				<div id="clear"></div>
			
		</div>
		<div class="the_excerpt"><?php the_excerpt()?></div>	

</div>


