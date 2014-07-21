	<div class='author-private'>
		<div class='' id="freelance-header-container">
			<fieldset>
				<legend>
					<h2>
						<?php
						/*$name =  get_user_meta($auth->ID , 'fname' ,TRUE). " " . get_user_meta($auth->ID , 'lname' ,TRUE); 
						if (strlen($name) < 3) $name = get_the_author_meta( 'user_login' , $auth->ID );
						echo $name;*/
						$name = $auth->display_name;
						echo $name;
						?>'s <?php _e('Public Records', 'responsive'); ?>
					</h2>
				</legend>	
					<?PHP
					$profilescore = get_user_meta( $auth->id, 'profilescore', TRUE );if (empty($profilescore)) $profilescore = 15;
					?>	
					<div style='width:70%;background-color:#E3F2F4;height:20px;margin:3px auto;border-radius:10px'>
					<div style='width:<?php echo $profilescore;?>%;background-color:green;height:20px;color:white;border-radius:10px'>
					</div>
					</div>
					<?php echo "profilescore: $profilescore/100";?>
					</br>
				
				
				<div class='left-50'>
					<div class="freelance-profile-author-first freelance-profile-authorinfo">
						<label><?php _e('First Name: ', 'responsive'); ?></label>
						<?php echo get_user_meta($auth->ID , 'first_name' ,TRUE); ?>
					</div>
					<div class="freelance-profile-author-last freelance-profile-authorinfo">
						<label><?php _e('Last Name: ', 'responsive'); ?></label>
						<?php echo get_user_meta($auth->ID ,'last_name' ,TRUE); ?>
					</div>
					<div class="freelance-profile-author-gender freelance-profile-authorinfo">
						<label><?php _e('Gender (age): ', 'responsive'); ?></label>
						<?php echo get_user_meta($auth->ID ,'gender' ,TRUE) . "(" . get_user_meta($auth->ID ,'age' ,TRUE) . ")"; ?>
					</div>
					<div class="freelance-profile-author-zipcode freelance-profile-authorinfo">
						<label><?php _e('Zipcode: ', 'responsive'); ?></label>
						<?php echo get_user_meta($auth->ID ,'zip' ,TRUE); ?>
					</div>
					<div class="freelance-profile-author-contry freelance-profile-authorinfo">
						<label><?php _e('Country: ', 'responsive'); ?></label>
						<?php echo get_user_meta($auth->ID ,'country' ,TRUE); ?>
					</div>
					
					<div class="freelance-profile-author-contry freelance-profile-authorinfo">
						<label><?php _e('City: ', 'responsive'); ?></label>
						<?php echo __(get_user_meta($auth->ID ,'city' ,TRUE)); ?>
					</div>
					
					<div class="freelance-profile-author-web freelance-profile-authorinfo">
						<label for="url"><?php _e('Website:', 'responsive'); ?></label>
						<a href='<?php echo  get_user_meta($auth->id ,'website' ,TRUE); ?>' title='visit <?php echo  get_user_meta($auth->id ,'website' ,TRUE); ?>' ><?php echo  get_user_meta($auth->id ,'website' ,TRUE); ?></a>
					</div>
					
					<div class="freelance-profile-author-about freelance-profile-authorinfo">
						<label for="bio"><?php _e('About me:', 'responsive') ?></label>
						<?php echo stripslashes(get_user_meta($auth->ID ,'bio',TRUE ) ); ?>
					</div>
					
					<div class="freelance-profile-author-my freelance-profile-authorinfo">
						<label for="refr"><?php _e('My references:', 'responsive') ?></label>
						<?php echo stripslashes(get_user_meta($auth->ID ,'refr',TRUE ) ); ?>
					</div>
					
				</div>
		
		</div>

	</div>
<div style='clear:both'></div>	
<!--Tab script-->
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready( function() {
			$("#tabtabs ul li:first").addClass("active");
			$("#tabtabs div:gt(0)").hide();
			$("#tabtabs ul li").click(function(){
				$("#tabtabs ul li").removeClass('active');
				//var current_index = $(this).index(); // Sử dụng cho jQuery >= 1.4.x
				var current_index = $("#tabtabs ul li").index(this);
				$("#tabtabs ul li:eq("+current_index+")").addClass("active");
				$("#tabtabs div").hide();
				$("#tabtabs div:eq("+current_index+")").fadeIn(100);
			});
		});
	</script>
<!--End Tab script-->
<?php
			 $args = array(
			'author' => $auth->ID,
			'user_id' => $auth->ID ,
			'post_type' => 'freelance_post',
			);
			$the_query = new WP_Query( $args );
			$comments = get_comments($args);
?>
<div id="tabwrapper">
	<div id="tabtabs">
	<ul>
			<?php if ($the_query->have_posts()) {?>
			<li><?php _e('Listings', 'responsive'); ?></li>
			<?php } if ($comments) {?>
			<li><?php _e('Estimates', 'responsive'); ?></li>		
			<li><?php _e('Reviewed', 'responsive') ; ?></li>
			<?php } ?>
	</ul>
	<?php if ($the_query->have_posts()) {?>
	<div class="author_list">
			<h2><?php printf(__('Listings by %1$s', 'responsive') , $name , ('responsive')) ; ?></h2>
			<?php
			
			
			// The Loop
			while ( $the_query->have_posts() ) : $the_query->the_post();
				?>
				<li>&mdash;
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'go to view %s', 'responsive' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"> 
				<?php echo substr(get_the_title(),0,50)."..."; ?>
				</a>
				</li>
				<?php
			endwhile;
			// Reset Post Data
			wp_reset_postdata();
			
			?>	
				
	</div>

	<?php } if ($comments) {?>
	<div class="author_list">
			<h2><?php printf(__('Estimates by %1$s', 'responsive') , $name , ('responsive')) ; ?></h2>
				<?php				
				foreach($comments as $comment) :
				echo "<li><a href='" .get_permalink($comment->comment_post_ID). "'>" . substr($comment->comment_content,0,50) . "</a></li>";
				endforeach;
				?>
	</div>
	
	<div class="author_list">	
			<h2><?php printf(__('Reviewed to %1$s', 'responsive') , $name , ('responsive')) ; ?></h2>
				<?php			
				foreach($comments as $comment) :				
					$review = get_comment_meta($comment->comment_ID , 'review', true ); 
					$review_project = get_comment_meta($comment->comment_ID , 'review_project', true ); 
					if (!empty($review)&&!empty($review_project))
						{
						echo "<br />";
						echo "<p class = 'pro_title'>".$review_project."</p>";
						echo "<p class = 'first black rounded'>";
						echo stripslashes($review);
						echo "</p>";
						}
				endforeach;
				?>
	</div>
	<?php } ?>	
	</div><!-- end tabs panel -->
</div>
<!-- google analytics code -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21715567-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>	
			


<?php
// add 1 point to author score
//$score = get_user_meta($auth->ID ,'score',TRUE );
//$score++; update_user_meta($auth->ID ,'score', $score );
