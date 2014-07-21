	<div id="freelance-container">
			<div class='freelance-single'>
											
				
				<div class="freelance-header-meta">
					<div id="freelace-vi-bi-bu">
							<div id="freelance-view">
								<?php
									$view = get_post_meta( get_the_ID(), 'viewcount', TRUE);
									if ($view == 0) $viewcount = "0";
									else $viewcount = $view;
									echo "<div id='view-view-container'>";
									_e('Views','responsive');
									echo "</div>";
									echo "<div id='vi-number'><span>".$viewcount ."</span></div>";
								?>			
								
							</div>
							<div id="freelance-bid">
								<?php
									echo "<div id='bid-bid-container'>";
									_e('Bids','responsive');
									echo "</div>";
									
									echo "<div id='bid-number'><span id='bid-bid'>";
									comments_number( __('0','responsive'),  __('1','responsive'), '%' );
									echo "</span></div>";
								?>
							</div>
							<div id="freelance-budget">
								<?php
									echo "<div id='bubget-bubget-container'>";
									echo "<img src='".get_bloginfo('stylesheet_directory') ."/library/images/money.png'>&nbsp;";
									$budg = get_post_meta( get_the_ID(), 'cf_budget', TRUE);
									$budget = $budg_array[$budg];
									if ($budg >1000000000) $budg = '0';
									$currency = get_post_meta(get_the_ID(), 'cf_currency', TRUE);										
									if ($budg == '0') echo  __('Budget', 'responsive' ) . "</div><div ='bud-number'><span >".__('none', 'responsive' )." </span></div>" ;	
									else {
										if ($currency == 'VND')
											echo  __('Budget', 'responsive' ) . "</div><div ='bud-number'><span >".number_format($budg,0,",",".") ." đ</span></div>" ;	
										else echo  __('Budget', 'responsive' ) . "</div><div ='bud-number'><span > $".number_format($budg,0,",",".") ."</span></div>" ;																		
									}
								?>
							</div>
					</div>
					<div id="freelace-deadline">
						<?php
							echo "<img src='".get_bloginfo('stylesheet_directory') ."/library/images/time.png'>&nbsp;";
							$deadl = get_post_meta( get_the_ID(), 'cf_deadline', TRUE);
							$deadline = convert_datetime($deadl);
							$bidcheck = get_post_meta(get_the_ID(), 'estimatechosen', TRUE);
							if (!empty($bidcheck)) echo " <span id='deadline-deadline'>". __('Closed ', 'responsive' ) ."</span>";
							/*if ($deadline > 9999999999) echo __('No deadline', 'responsive' );*/
							elseif (current_time('timestamp')> $deadline) echo " <span id='deadline-deadline'>". __('Expires ', 'responsive' ) ."</span>";
							else echo " <span id='deadline-deadline'>". __('Deadline in ', 'responsive' ) . human_time_diff(current_time('timestamp'),$deadline)."</span>";
								
						?>
					</div>
				</div>
							
				<div class="entry-content post_content">
					<div id="avatarcontent">
						<div id="avatar-wpfr">
							<?php wpfr_avatar( get_the_author_meta('ID') ,100); ?>
						</div>				
					<?php the_content() ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'responsive' ), 'after' => '</div>' ) ); ?>
					</div>
					<div style='clear:both'></div>
				</div>
				<div id="freelance-post-date">
					<div id="freelance-post-date-con">
						<?php majormedia_posted_on(); ?> 	
					</div>
					
				</div>	
				<div class='avatarpop'>
				<?php 
				if (get_current_user_id() !=  get_the_author_ID()){?>
					<div class="freelance-header">
							
							
							<div class='datana'>
								<?php
								if (wp_verify_nonce($_POST['rating'],'up') )	//security
									{
									echo "<img src='" . get_bloginfo('stylesheet_directory') .'/library/images/smile.png' . "' title='" . __('Thanks for voting ! I appreciate it' , 'responsive') . "'>";
									$rating = get_user_meta(get_the_author_meta('ID') ,'rating',TRUE );
									$rating++;
									update_user_meta(get_the_author_meta('ID') ,'rating', $rating );
									}
								else
									{
									?>
									<form method='post'>
									<?php wp_nonce_field('up','rating'); ?>
									<input type="hidden" name="accept" value="no">
									<input type="hidden" name="commid" value="<?php comment_ID(); ?>">
									<input type='image' src='<?php echo get_bloginfo('stylesheet_directory') ."/library/images/number1.png"; ?>' title='<?php _e('Click if you think this is cool', 'responsive'); ?>' >
									</form>	
									<?php
									}
									?>
							</div>
							
							<div class='datanb'>
									<?php
									if (wp_verify_nonce($_POST['rating'],'down') )	//security
										{
										echo "<img src='" . get_bloginfo('stylesheet_directory') .'/library/images/sad.png' . "' title='" . __('I appreciate your downvote, but could you please let me know what is wrong ?' , 'responsive') . "'>";
										$rating = get_user_meta(get_the_author_meta('ID') ,'rating',TRUE );
										$rating--; if ($rating < 1) $rating = 1;
										update_user_meta(get_the_author_meta('ID') ,'rating', $rating );
										}
									else
										{
									?>
										<form method='post'>
										<?php wp_nonce_field('down','rating'); ?>
										<input type="hidden" name="accept" value="no">
										<input type="hidden" name="commid" value="<?php comment_ID(); ?>">
										<input type='image' src='<?php echo get_bloginfo('stylesheet_directory') ."/library/images/number10.png"; ?>' title='<?php _e('Click if you think this is not so great', 'responsive'); ?>' >
										</form>	
									<?php
										}
									?>
							</div>
							
						
							<div style='clear:both'></div>
						</div>
						<?php }?>
						<div id="author-images">
							
								<?php 
									echo "<div id='author-au'>";
									echo "<div id='image-image'><img src='".get_bloginfo('stylesheet_directory') ."/library/images/bar.png'></div>";			
									$rate = get_user_meta( get_the_author_meta('ID'), 'rating', TRUE ); 
									if (empty($rate) || !is_numeric($rate)) $rate = "-?-";
									
										
											echo "<div id='tacgia'>	";
												_e('Author rating: ', 'responsive' );
											echo "</div>";
									echo "</div>";
									
									
										$stars = (int)$rate / 20; if ($stars > 5) $stars = 5;
										for ($q=0;$q < $stars; $q++)
											{
												echo "<img src='" . get_bloginfo('stylesheet_directory') .'/library/images/rating_star.gif' . "' style='margin:0px;' >";
											}
											
										
										
										echo "<strong>($rate)</strong>";
									
									
									
								?>
							
						</div>
						<div id="score-number">
							<?php
								$score = get_user_meta(get_the_author_meta('ID') ,'score',TRUE );
								if ($score < 1) $score = "?";
								echo "<div id='score-score'>";
								_e('Score:','responsive');
								echo "</div>";
								echo "<span>$score</span>";
							?>
						</div>
						<div style='clear:both'></div>
						
	
				</div><!---End avatarpop---->
			<?php $bidcheck = get_post_meta(get_the_ID(), 'estimatechosen', TRUE);
				global $current_user;
				get_currentuserinfo();
				if (!empty($bidcheck)){
					if ($current_user->ID == get_comment( $bidcheck )->user_id){
							$contact_info = get_userdata(get_the_author_meta('ID'))->contactinfo;
							$phone = get_userdata(get_the_author_meta('ID'))->phone;
							echo "<div class=\"contact_info\"><div class=\"first red rounded\">";
							echo "<label>";
							_e('How to contact:','responsive');
							echo "</label> ".$contact_info;
							echo "<br /><label>";
							_e('Phone:','responsive');
							echo "</label> ".$phone;
							echo "</div></div>";
						}
				}
			?>
			
				
				
			<?php //majormedia_content_nav( 'nav-below' ); ?>
			
			<?php responsive_add_view_count(); ?>
			</div>
	</div>
