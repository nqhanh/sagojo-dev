	<?php 
	$skill1=get_user_meta( $auth->id, 'skill1', TRUE );
								if (empty($skill1)){ 
									$percent1 = 0;?>
								<?php }
								else {$percent1=get_user_meta( $auth->id, 'percent1', TRUE );?>
								<?php }?>
	<?php 
	$skill2=get_user_meta( $auth->id, 'skill2', TRUE );
								if (empty($skill2)){ 
									$percent2 = 0;?>
								<?php }
								else {$percent2=get_user_meta( $auth->id, 'percent2', TRUE );?>
								<?php }?>
	<?php 
	$skill3=get_user_meta( $auth->id, 'skill3', TRUE );
								if (empty($skill3)){ 
									$percent3 = 0;?>
								<?php }
								else {$percent3=get_user_meta( $auth->id, 'percent3', TRUE );?>
								<?php }?>
	<?php 
	$skill4=get_user_meta( $auth->id, 'skill4', TRUE );
								if (empty($skill4)){ 
									$percent4 = 0;?>
								<?php }
								else {$percent4=get_user_meta( $auth->id, 'percent4', TRUE );?>
								<?php }?>
	<?php 
	$skill5=get_user_meta( $auth->id, 'skill5', TRUE );
								if (empty($skill5)){ 
									$percent5 = 0;?>
								<?php }
								else {$percent5=get_user_meta( $auth->id, 'percent5', TRUE );?>
								<?php }?>	
	<?php if (!empty($skill1) && !empty($skill2) && !empty($skill3) && !empty($skill4) && !empty($skill5)){?>																			
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['<?php echo $skill1?>', <?php echo $percent1?>],
          ['<?php echo $skill2?>', <?php echo $percent2?>],
          ['<?php echo $skill3?>', <?php echo $percent3?>],
          ['<?php echo $skill4?>', <?php echo $percent4?>],
          ['<?php echo $skill5?>', <?php echo $percent5?>]
        ]);

       var options = {
          title: '<?php _e('My skills', 'responsive'); ?>'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
    <div id="piechart" style="width: 360px; height: 250px; border-left:1px dashed #e2e2e2; padding-left: 15px;"></div>
    <?php }?>
	<div class='author-private'>
		<div class='' id="freelance-header-container">
			
				<div class='left-50'>
					
					<div class="freelance-profile-author-zipcode freelance-profile-authorinfo">
						<label><?php _e('Member since: ','responsive');?></label>
						<?php 
									$date = new DateTime($auth->user_registered);									
									echo date_format($date, 'd/m/Y'); 									
								?>
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
						<a href='<?php echo  get_user_meta($auth->id ,'website' ,TRUE); ?>' target='_blank' rel='nofollow' title='visit <?php echo  get_user_meta($auth->id ,'website' ,TRUE); ?>' ><?php echo  get_user_meta($auth->id ,'website' ,TRUE); ?></a>
					</div>
					<div class="freelance-profile-author-about freelance-profile-authorinfo">
						<label for="bio"><?php _e('About me:', 'responsive') ?></label>
						<?php echo stripslashes(get_user_meta($auth->ID ,'bio',TRUE ) ); ?>
					</div>
					<div class="freelance-profile-author-my freelance-profile-authorinfo">
						<label for="refr"><?php _e('My references:', 'responsive') ?></label>
						<?php echo stripslashes(get_user_meta($auth->ID ,'refr',TRUE ) ); ?>
					</div>
					<div class="freelance-profile-author-my freelance-profile-authorinfo">
						
						<?php $rows = $wpdb->get_results( "SELECT id,title FROM wpjb_resume WHERE user_id=$auth->ID AND is_active=1" );
						if ($rows){?>
							<label><?php _e('My resume:', 'responsive'); ?></label>
							<?php 
							foreach ($rows as $row){
								echo " &rarr;&nbsp;<a href='".site_url()."/resumes-board/?job_resumes=/view/".$row->id."' target=_blank>";
								if ($row->title)
									echo $row->title;
								else _e('View my resume', 'responsive');
								echo "</a>&nbsp;";
							}		
						}
						?>
						
					</div>
		</div></div></div>		
		
		

	
	
    

<div style='clear:both'></div>	
<!--Tab script-->
<script type="text/javascript">
j(document).ready(function () {
	j('#tabwrapper').responsiveTabs({
            startCollapsed: 'accordion',
            collapsible: true,
            rotate: false,
            setHash: true
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
	<!--<div id="tabtabs">-->
		<ul>
				<?php if ($the_query->have_posts()) {?>
				<li><a href="#author_list_1"><?php _e('Listings', 'responsive'); ?></a></li>
				<?php } if ($comments) {?>
				<li><a href="#author_list_2"><?php _e('Last bid on', 'responsive'); ?></a></li>		
				<li><a href="#author_list_3"><?php _e('Feedback', 'responsive') ; ?></a></li>
				<li><a href="#author_list_4"><?php _e('Completed Work', 'responsive') ; ?></a></li>
				<li><a href="#author_list_5"><?php _e('Work in Progress', 'responsive') ; ?></a></li>
				<li><a href="#author_list_6"><?php _e('Incomplete', 'responsive') ; ?></a></li>
				<?php } ?>
		</ul>
		<?php if ($the_query->have_posts()) {
		$user_post_count = count_user_freelance_posts( $auth->ID );?>
		<div id="author_list_1">
				
				<?php
				
				
				// The Loop
				while ( $the_query->have_posts() ) : $the_query->the_post();
					?>
					
					<?php get_template_part( 'content-index', get_post_format() );?>
					<?php
				endwhile;
				// Reset Post Data

				wp_reset_postdata();
				
				
				?>	
					
		</div>

		<?php } if ($comments) {?>
		<div id="author_list_2">
				
					<?php
					$count = 0;				
					foreach($comments as $comment) :
					$count++;
					$date = new DateTime($comment->comment_date);
					echo "<div class=\"each_eatimate\"><div class=\"my_estimate_post_title\">".get_the_title($comment->comment_post_ID)."</div>";
					echo "<div class=\"comment_avatar\">".get_avatar( $auth->ID, 36  )."</div><div class=\"comment_text\">".date_format($date, 'd/m/Y')."<br /><a href='" .get_permalink($comment->comment_post_ID). "'>\"" . st_substr($comment->comment_content,160) . "\"</a></div></div>";
					
					endforeach;
					?>
		</div>
		
		<div id="author_list_3">
					<?php			
					foreach($comments as $comment) :				
						$reviews = get_comment_meta($comment->comment_ID , 'review', false ); 
						$review_project = get_comment_meta($comment->comment_ID , 'review_project', true );
						$userID_cm = get_comment_meta($comment->comment_ID , 'userID', false );
						$Date_cm = get_comment_meta($comment->comment_ID , 'Date', false );
						$user_name = get_comment_meta($comment->comment_ID , 'Username', false );
						$commentsvote = get_comment_meta($comment->comment_ID , '_commentsvote', true ); 
							if (!empty($review_project))
							{	
								$i=0;
								echo "<div class=\"each_eatimate\"><div class=\"my_estimate_post_title\">".$review_project."</div>";
								foreach ($reviews as $review):
											$date = new DateTime($Date_cm[$i]);
											if ($i==0){										
												echo "<div class=\"comment_avatar\">".get_avatar( $userID_cm[$i], 36  )."</div>";
												if (!empty($commentsvote))
													echo "<div class=\"comment_text_complain\">".$user_name[$i]." on ".date_format($date, 'd/m/Y')."<div class=\"commentsvote\"><img src=\"".site_url()."//wp-content/themes/responsive/library/images/number10.png\"></div><br />\"" .$review . "\"";
												else
													echo "<div class=\"comment_text\"><div class=\"feedback_user\">".$user_name[$i]." on ".date_format($date, 'd/m/Y')."</div>".commentRating($comment->comment_ID)."<br />\"" .$review . "\"";
											}
											else{
												if (!empty($commentsvote))
													echo "<div class=\"comment_text_reply_complain\">".$user_name[$i].": \"" . $review . "\"</div>";
												else
													echo "<div class=\"comment_text_reply\">".$user_name[$i].": \"" . $review . "\"</div>";
											}
											
											$i++;
								endforeach;
								echo "</div></div>";
							}
					endforeach;
					?>
		</div>
		<div id="author_list_4">
		<?php	
			$array_complete = array(0);	
			$win=0;
			$complete=0;
			foreach($comments as $comment) :	
				$choosen = get_post_meta( $comment->comment_post_ID, 'estimatechosen', true );
				$review_project_ID = get_comment_meta($comment->comment_ID , 'review_project_ID', true );	
				$commentsvote = get_comment_meta($comment->comment_ID , '_commentsvote', true );
				if($choosen == $comment->comment_ID) {
					$win++;
					if ((empty( $commentsvote)) && (! empty( $review_project_ID ))){
						array_push($array_complete,$comment->comment_post_ID);						
						$complete++;
					}
				}
			endforeach;
					$myargs = array(
						'post__in' => $array_complete,
						'post_type' => 'freelance_post',
					);
					$the_query4 = new WP_Query( $myargs );
						while ( $the_query4->have_posts() ) : $the_query4->the_post();
							get_template_part( 'content-profile', get_post_format() );
						endwhile;
					// Reset Post Data
					wp_reset_postdata();
			
		?>
		</div>
		<div id="author_list_5">
		<?php	
			$array_progress = array(0);	
			foreach($comments as $comment) :
			$choosen = get_post_meta( $comment->comment_post_ID, 'estimatechosen', true );
			$review_project_ID = get_comment_meta($comment->comment_ID , 'review_project_ID', true );
			$commentsvote = get_comment_meta($comment->comment_ID , '_commentsvote', true );
			if($choosen == $comment->comment_ID) {
				if ((empty($commentsvote)) && (empty($review_project_ID))){
					array_push($array_progress,$comment->comment_post_ID);
				}
			}
			endforeach;
					$myargs = array(
						'post__in' => $array_progress,
						'post_type' => 'freelance_post',
					);
					$the_query5 = new WP_Query( $myargs );
						while ( $the_query5->have_posts() ) : $the_query5->the_post();
							get_template_part( 'content-profile', get_post_format() );
						endwhile;
					// Reset Post Data
					wp_reset_postdata();
			
		?>
		</div>
		<div id="author_list_6">
		<?php	
			$array_incomplete = array(0);
			foreach($comments as $comment) :
				$choosen = get_post_meta( $comment->comment_post_ID, 'estimatechosen', true );				
				$review_project_ID = get_comment_meta($comment->comment_ID , 'review_project_ID', true );	
				$commentsvote = get_comment_meta($comment->comment_ID , '_commentsvote', true );
				if($choosen == $comment->comment_ID) {
					if((! empty( $commentsvote))){
						array_push($array_incomplete,$comment->comment_post_ID);
					}
				}
			endforeach;
					$myargs = array(
						'post__in' => $array_incomplete,
						'post_type' => 'freelance_post',
					);
					$the_query6 = new WP_Query( $myargs );
						while ( $the_query6->have_posts() ) : $the_query6->the_post();
							get_template_part( 'content-profile', get_post_format() );
						endwhile;
					// Reset Post Data
					wp_reset_postdata();
			
		?>
		</div>
		<?php } ?>	
	<!--</div><!-- end tabs panel -->
</div>


<?php
// add 1 point to author score
//$score = get_user_meta($auth->ID ,'score',TRUE );
//$score++; update_user_meta($auth->ID ,'score', $score );
