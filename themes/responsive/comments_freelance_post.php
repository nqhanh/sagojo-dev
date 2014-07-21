<?php
/**
 * The template for displaying Comments.
 *
 * custom mod for freelance_post comments only
 */
 
//if ( have_comments() ) : 
	$deadl = get_post_meta( get_the_ID(), 'cf_deadline', TRUE);
	$deadline = convert_datetime($deadl);
	$bidcheck = get_post_meta(get_the_ID(), 'estimatechosen', TRUE);
	if ((!empty($bidcheck)) && (current_time('timestamp')> $deadline))
		{
			_e('<div style="text-align:left"><h5>This Job-offer has closed down. You can scroll down for more information</h5></div>','responsive');
		}	
	if (empty($bidcheck) && (current_time('timestamp')> $deadline))
		{
			_e('<div style="text-align:left"><h5>This Job-offer has expired. You can scroll down for more information</h5></div>','responsive');					
		}
	if ((!empty($bidcheck)) && (!(current_time('timestamp')> $deadline)))
		{
			_e('<div style="text-align:left"><h5>This Job-offer has closed down. You can scroll down for more information</h5></div>','responsive');
		}
	if ((empty($bidcheck)) && (!(current_time('timestamp')> $deadline))) {
	?>
		<div style='text-align:left'><h5><?php _e('Freelancers Bidding', 'responsive');?> (<?php comments_number( __('0','responsive'),  __('1','responsive'), '%' ); ?>)</h5></div>
	<?php } ?>
	
		<div id="container-comment-freelance-post">
			<ul class="comment-freelance-post">
				<?php
					/* Loop through and list the comments.
					 */
					wp_list_comments( array( 'callback' => 'majormedia_comment','reverse_top_level' => TRUE, ) );
				?>
			</ul>
		</div>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<div class="pagination">
			<?php paginate_comments_links();?>
		</div>
		<?php endif; // check for comment navigation ?>

<?php //endif; // have_comments() ?>
	

<div id="comments">
	<?php						
	if ((empty($bidcheck))&&(!(current_time('timestamp')> $deadline))){
			if ( is_user_logged_in() )
			{		
			$comments_args = array( 
				'title_reply'    => __('Respond to this job ', 'responsive'),
				'title_reply_to' => __('Provide an estimate for ', 'responsive'),
				'logged_in_as'   => '',
				'label_submit'   => __('Submit estimate/response', 'responsive'),
			   );
				global $current_user,$post;
				$args = array('user_id' => $current_user->ID,'post_id' => $post->ID);
				$usercomment = get_comments($args);
				if(count($usercomment) >= 1){
					_e('<div style="text-align:left">You&rsquo;ve already respond to this job.</div>', 'responsive');
				} else {
				comment_form($comments_args); 
				}
			}
			else
				{
				_e('<h3>You need to be logged in to provide estimates and respond to this job !</h3>Please ', 'responsive');		
				echo "<a href='". get_bloginfo('url') . "/?page_id=100' title='". __('register', 'responsive'). "'>";
				_e('log in or register now.', 'responsive');
				echo "</a>";
				/*echo "<div class='notlogged'>";
				echo "<table><tr><td><img src='" . get_bloginfo('stylesheet_directory') .'/library/images/notice.png' . "' width='100%'></td><td>";
				_e('<h3>You need to be logged in to provide estimates and respond to this job !</h3>Please log in or register now.<br/>', 'responsive');	
				$args = array(
						'remember' => false
					);
					wp_login_form( $args );				
				echo "</td><td>";
				echo "<a href='". get_bloginfo('url') . "/?page_id=100' title='". __('register', 'responsive'). "'>";
				echo "<img src='" . get_bloginfo('stylesheet_directory') .'/library/images/signin.png' . "' width='100%'><br>";
				_e('register', 'responsive');
				echo "</a></td></tr></table></div>";*/			
				}
		
	}
	?>
	
	
	
	

	<?php
		// If comments are closed and there are no comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Job is closed.', 'responsive' ); ?></p>
	<?php endif; ?>


</div><!-- #comments -->