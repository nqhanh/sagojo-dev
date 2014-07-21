<?php
	$_SESSION['country'] = $_POST['country'];
	if (wp_verify_nonce($_POST['usersets'],'update') )	//security
		{
		if($_POST) 
			{
			global $wpdb;
			echo "<h2>Profile updated.</h2>";
			
			$website = $wpdb->escape($_POST['wurl']);
			$bio = $wpdb->escape($_POST['bio']);
			$refr = $wpdb->escape($_POST['refr']);
			
			$country = $wpdb->escape($_POST['country']);
			$city = $wpdb->escape($_POST['city']);
			
			$phone = $wpdb->escape($_POST['phone']);
			$contactinfo = $wpdb->escape($_POST['contactinfo']);
			
			$skill1 = $wpdb->escape($_POST['skill1']);
			$percent1 = $wpdb->escape($_POST['percent1']);
			
			$skill2 = $wpdb->escape($_POST['skill2']);
			$percent2 = $wpdb->escape($_POST['percent2']);

			$skill3 = $wpdb->escape($_POST['skill3']);
			$percent3 = $wpdb->escape($_POST['percent3']);

			$skill4 = $wpdb->escape($_POST['skill4']);
			$percent4 = $wpdb->escape($_POST['percent4']);

			$skill5 = $wpdb->escape($_POST['skill5']);
			$percent5 = $wpdb->escape($_POST['percent5']);
			
			update_user_meta( $auth->id, 'bio', $bio );
				
			update_user_meta( $auth->id, 'refr', $refr );						
			
			update_user_meta( $auth->id, 'country', $country );
			update_user_meta( $auth->id, 'city', $city );
			
			update_user_meta( $auth->id, 'phone', $phone );
			update_user_meta( $auth->id, 'contactinfo', $contactinfo );
			update_user_meta( $auth->id, 'website', $website );
			
			update_user_meta( $auth->id, 'skill1', $skill1 );
			update_user_meta( $auth->id, 'percent1', $percent1 );
			
			update_user_meta( $auth->id, 'skill2', $skill2 );
			update_user_meta( $auth->id, 'percent2', $percent2 );

			update_user_meta( $auth->id, 'skill3', $skill3 );
			update_user_meta( $auth->id, 'percent3', $percent3 );

			update_user_meta( $auth->id, 'skill4', $skill4 );
			update_user_meta( $auth->id, 'percent4', $percent4 );

			update_user_meta( $auth->id, 'skill5', $skill5 );
			update_user_meta( $auth->id, 'percent5', $percent5 );
			
			$psc = 0;
						
			if (strlen(get_user_meta( $auth->id, 'bio',TRUE )) > 20) $psc=$psc+20;
			if (strlen(get_user_meta( $auth->id, 'refr',TRUE )) > 20) $psc=$psc+20;
			
			if (strlen(get_user_meta( $auth->id, 'phone',TRUE )) > 8) $psc=$psc+25;
			if (strlen(get_user_meta( $auth->id, 'contactinfo',TRUE )) > 10) $psc=$psc+25;
			if (strlen(get_user_meta( $auth->id, 'website',TRUE )) > 6) $psc=$psc+10;
			
			update_user_meta( $auth->id, 'profilescore', $psc );
			
			
			if(isset($email)) 
				{
				if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email))
					{ 
					if ( email_exists( $email ) ) 
						{
						$message .= "<div id='error'>" . __('This e-mail address already exists in the system. Please use a different e-mail address, or log in to your account','responsive'). ".</div>"; 
						}
					else
						{
						wp_update_user( array ('ID' => $auth->ID, 'user_email' => $email) ) ;
						}
					}
				else 
					{ 
					$message .= "<div id='error'>" . __('Please enter a valid email id.', 'responsive') . "</div>"; 
					}
				}
			if($password) 
				{
				if (strlen($password) < 5 || strlen($password) > 15) 
					{
					$message = "<div id='error'>" . __('Password must be 5 to 15 characters in length.', 'responsive'). "</div>";
					}
				//elseif( $password == $confirm_password ) {
				elseif(isset($password) && $password != $confirm_password) 
					{
						$message = "<div class='error'>" . __('Password Mismatch','responsive'). "</div>";
					} 
				elseif ( isset($password) && !empty($password) ) 
					{
						$update = wp_set_password( $password, $auth->id );
						$message = "<div id='success'>" . __('Your profile updated successfully.', 'responsive'). "</div>";
					}
				}
			}
		}
	?>

	
	<div class='author-private'>
	<div class=''>
		<fieldset>
			<legend>
				<h3><?php 
				_e('Profile and Settings', 'responsive');	
				$profilescore = get_user_meta( $auth->id, 'profilescore', TRUE );if (empty($profilescore)) $profilescore = 15;
				?>
				</h3>
			</legend>
				
			<progress class="css3" value="<?php echo $profilescore;?>" max="100">
								      <div class="progress-bar">
								        <span style="width:<?php echo $profilescore;?>%;"></span>
								      </div>
								 </progress>
			<div id="profile-score">
			<?php _e('Fill out all fields to raise your score and ranking.', 'responsive');?>
			</div>
		</fieldset>
	</div>
	<div class='left-50'>
		<fieldset>
			<legend><?php _e('<h3>User settings</h3>', 'responsive'); ?></legend>
			<?php /*<div id="personal-item"><?php _e('Items marked * are never public', 'responsive'); ?></div>*/?>
			<form method="post" id="personal-form-id-authorinfo" class="personal-form-class-authorinfo">

				<?php $rows = $wpdb->get_results( "SELECT id,title FROM wpjb_resume WHERE user_id=$auth->ID" );
						if ($rows){?>
							<label><?php _e('Edit my resume:', 'responsive'); ?></label>
							<?php 
							foreach ($rows as $row){
								echo " &rarr;&nbsp;<a href='".site_url()."/resumes-board/my-resume/' target=_blank>";
								_e('Edit now', 'responsive');
								echo "</a>&nbsp;";
							}		
						}
						?>
				<div style='clear:both'></div>
				
				<div id="personal-contry" class="personal-profile">
					<label for="country"><?php _e('Country', 'responsive'); ?></label>
					<div class="personal-input">
					<select name="country" id="country"><option value="Vietnam">Viet Nam</option></select>						
				</div>
				</div>				
				<div style='clear:both'></div>	
				<div id="personal-city" class="personal-profile">
					<label for="city"><?php _e('City', 'responsive'); ?></label>
					<div class="personal-input">
					<?php
					$city_file = "city_list_vn.ini" ;
					if (file_exists($city_file) && is_readable($city_file))
					{
						$citys=parse_ini_file($city_file,true);
						?>
						<select name="city" id="city">
						<option value="<?php echo stripslashes(get_user_meta($auth->id ,'city' ,TRUE)); ?>"><?php _e(stripslashes(get_user_meta($auth->id ,'city' ,TRUE))); ?></option>
						<?php						   
						foreach ($citys as $city) { 
							?>
							<option value="<?php echo $city['name']; ?>"><?php _e($city['name']) ?></option>
							<?php
							}
							?>
							</select>
							<?php						
					}
					else
					{
						// If the configuration file does not exist or is not readable, DIE php DIE!
						die("Sorry, the $city_file file doesnt seem to exist or is not readable!");
					}
					
					
							?>	
					</div>
				</div>				
				<div style='clear:both'></div>		
				
				<div id="personal-web" class="personal-profile">
					<label for="url"><?php _e('Website', 'responsive'); ?></label>
					<div class="personal-input">
						<input class="text-input" name="wurl" type="text" id="wurl" value="<?php echo  stripslashes(get_user_meta($auth->id ,'website' ,TRUE)); ?>" />
					</div>
				</div>
				
				<div id="personal-about" class="personal-profile">
					<label for="description"><?php _e('About me', 'responsive') ?></label>
					<div class="personal-input">
						<textarea name="bio" id="desc" rows="5" cols="50"><?php echo stripslashes(get_user_meta($auth->id ,'bio',TRUE )); ?></textarea>
					</div>
				</div>
				<div id="personal-refer" class="personal-profile">
					<label for="refr"><?php _e('References/experience', 'responsive') ?></label>
					<div class="personal-input">
						<textarea name="refr" id="refr" rows="5" cols="50"><?php echo stripslashes(get_user_meta($auth->id ,'refr',TRUE )); ?></textarea>
					</div>
				</div>
				<div id="personal-refer" class="personal-profile">
					<label for="refr"><?php _e('Skills', 'responsive') ?></label><br />
					<div class="personal-input" style="clear:both;">	
						<?php 	$skill1=get_user_meta( $auth->id, 'skill1', TRUE );
								if (empty($skill1)){ 
									$percent1 = 0;?>
									<input type="text" name="skill1" style="color:#006600;font-weight:bold;" placeholder="<?php _e('Enter first skill if any...', 'responsive') ?>">
								<?php }
								else {$percent1=get_user_meta( $auth->id, 'percent1', TRUE );?>
									<input type="text" name="skill1" style="color:#006600;font-weight:bold;" value="<?php echo $skill1;?>">
								<?php }?>
						
						<input type="hidden" id="Mytextboxelement1" name="percent1" value="<?php echo $percent1;?>">
						<span class="options"><a href="#" onclick="myJsProgressBarHandler.setPercentage('element1','+5');return false;"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/icons/add.gif" alt="" title="" onmouseout="$('Text1').innerHTML ='&laquo; Select Options'" onmouseover="$('Text1').innerHTML ='Add 5%'"/></a></span>
						<span class="options"><a href="#" onclick="myJsProgressBarHandler.setPercentage('element1','-5');return false;"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/icons/minus.gif" alt="" title="" onmouseout="$('Text1').innerHTML ='&laquo; Select Options'" onmouseover="$('Text1').innerHTML ='Minus 5%'" /></a></span>
						<span class="progressBar" id="element1"><?php echo $percent1;?>%</span>
						<br/>
					
						<?php 	$skill2=get_user_meta( $auth->id, 'skill2', TRUE );
								if (empty($skill2)){ 
									$percent2 = 0;?>
									<input type="text" name="skill2" style="color:#006600;font-weight:bold;" placeholder="<?php _e('Enter second skill if any...', 'responsive') ?>">
								<?php }
								else {$percent2=get_user_meta( $auth->id, 'percent2', TRUE );?>
									<input type="text" name="skill2" style="color:#006600;font-weight:bold;" value="<?php echo $skill2;?>">
								<?php }?>
						
						<input type="hidden" id="Mytextboxelement2" name="percent2" value="<?php echo $percent2;?>">
						<span class="options"><a href="#" onclick="myJsProgressBarHandler.setPercentage('element2','+5');return false;"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/icons/add.gif" alt="" title="" onmouseout="$('Text2').innerHTML ='&laquo; Select Options'" onmouseover="$('Text2').innerHTML ='Add 5%'"/></a></span>
						<span class="options"><a href="#" onclick="myJsProgressBarHandler.setPercentage('element2','-5');return false;"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/icons/minus.gif" alt="" title="" onmouseout="$('Text2').innerHTML ='&laquo; Select Options'" onmouseover="$('Text2').innerHTML ='Minus 5%'" /></a></span>
						<span class="progressBar" id="element2"><?php echo $percent2;?>%</span>
						<br/>
						
						<?php 	$skill3=get_user_meta( $auth->id, 'skill3', TRUE );
								if (empty($skill3)){ 
									$percent3 = 0;?>
									<input type="text" name="skill3" style="color:#006600;font-weight:bold;" placeholder="<?php _e('Enter third skill if any...', 'responsive') ?>">
								<?php }
								else {$percent3=get_user_meta( $auth->id, 'percent3', TRUE );?>
									<input type="text" name="skill3" style="color:#006600;font-weight:bold;" value="<?php echo $skill3;?>">
								<?php }?>
						
						<input type="hidden" id="Mytextboxelement3" name="percent3" value="<?php echo $percent3;?>">
						<span class="options"><a href="#" onclick="myJsProgressBarHandler.setPercentage('element3','+5');return false;"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/icons/add.gif" alt="" title="" onmouseout="$('Text3').innerHTML ='&laquo; Select Options'" onmouseover="$('Text3').innerHTML ='Add 5%'"/></a></span>
						<span class="options"><a href="#" onclick="myJsProgressBarHandler.setPercentage('element3','-5');return false;"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/icons/minus.gif" alt="" title="" onmouseout="$('Text3').innerHTML ='&laquo; Select Options'" onmouseover="$('Text3').innerHTML ='Minus 5%'" /></a></span>					
						<span class="progressBar" id="element3"><?php echo $percent3;?>%</span>
						<br/>
						
						<?php 	$skill4=get_user_meta( $auth->id, 'skill4', TRUE );
								if (empty($skill4)){ 
									$percent4 = 0;?>
									<input type="text" name="skill4" style="color:#006600;font-weight:bold;" placeholder="<?php _e('Enter fourth skill if any...', 'responsive') ?>">
								<?php }
								else {$percent4=get_user_meta( $auth->id, 'percent4', TRUE );?>
									<input type="text" name="skill4" style="color:#006600;font-weight:bold;" value="<?php echo $skill4;?>">
								<?php }?>
						
						<input type="hidden" id="Mytextboxelement4" name="percent4" value="<?php echo $percent4;?>">
						<span class="options"><a href="#" onclick="myJsProgressBarHandler.setPercentage('element4','+5');return false;"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/icons/add.gif" alt="" title="" onmouseout="$('Text4').innerHTML ='&laquo; Select Options'" onmouseover="$('Text4').innerHTML ='Add 5%'"/></a></span>
						<span class="options"><a href="#" onclick="myJsProgressBarHandler.setPercentage('element4','-5');return false;"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/icons/minus.gif" alt="" title="" onmouseout="$('Text4').innerHTML ='&laquo; Select Options'" onmouseover="$('Text4').innerHTML ='Minus 5%'" /></a></span>
						<span class="progressBar" id="element4"><?php echo $percent4;?>%</span>
						<br/>
						
						<?php 	$skill5=get_user_meta( $auth->id, 'skill5', TRUE );
								if (empty($skill5)){ 
									$percent5 = 0;?>
									<input type="text" name="skill5" style="color:#006600;font-weight:bold;" placeholder="<?php _e('Enter fifth skill if any...', 'responsive') ?>">
								<?php }
								else {$percent5=get_user_meta( $auth->id, 'percent5', TRUE );?>
									<input type="text" name="skill5" style="color:#006600;font-weight:bold;" value="<?php echo $skill5;?>">
								<?php }?>
						
						<input type="hidden" id="Mytextboxelement5" name="percent5" value="<?php echo $percent5;?>">
						<span class="options"><a href="#" onclick="myJsProgressBarHandler.setPercentage('element5','+5');return false;"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/icons/add.gif" alt="" title="" onmouseout="$('Text5').innerHTML ='&laquo; Select Options'" onmouseover="$('Text5').innerHTML ='Add 5%'"/></a></span>
						<span class="options"><a href="#" onclick="myJsProgressBarHandler.setPercentage('element5','-5');return false;"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/icons/minus.gif" alt="" title="" onmouseout="$('Text5').innerHTML ='&laquo; Select Options'" onmouseover="$('Text5').innerHTML ='Minus 5%'" /></a></span>
						<span class="progressBar" id="element5"><?php echo $percent5;?>%</span>
						<br/>
					</div>
				</div>
				
				<div id="personal-info-below" class="personal-profile"><?php _e('<strong>Info below is shown to job lister when your estimate is selected, or to freelancer when you are the job lister.</strong>', 'responsive'); ?></div>
				
				<div id="personal-firstname" class="personal-profile">
					<label for="phone"><?php _e('My phone number', 'responsive'); ?></label>		
					<div class="personal-input">
						<input class="text-input" name="phone" type="text" id="phone" value="<?php echo get_user_meta($auth->id ,'phone' ,TRUE); ?>" />
					</div>
				</div>
				<div id="personal-my-contact" class="personal-profile">
					<label for="contactinfo"><?php _e('My contactinfo', 'responsive'); ?></label>
					<div class="personal-input">
						<textarea name="contactinfo" id="desc" rows="3" cols="50"><?php echo stripslashes(get_user_meta($auth->id ,'contactinfo',TRUE )); ?></textarea>
					</div>
				</div>
				<div id="personal-update" class="personal-profile">
					<?php wp_nonce_field('update','usersets'); ?>
					<input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Update', 'responsive'); ?>" />
				</div>
			</form>
		</fieldset>
	</div>
<script type="text/javascript">
				document.observe('dom:loaded', function() {

					// first manuale progressbar : different bar (width, height, images) and no animation
					manualPB = new JS_BRAMUS.jsProgressBar(
								$('element6'),
								75,
								{
									showText	: false,
									animate		: false,
									width		: 154,
									height		: 11,
									boxImage	: location.protocol + '//' + location.hostname+'/wordpress_op2/wp-content/themes/responsive/images/bramus/custom1_box.gif',
									barImage	: location.protocol + '//' + location.hostname+'/wordpress_op2/wp-content/themes/responsive/images/bramus/custom1_bar.gif'
								}
							);

					
				}, false);
			</script>
			
	<!--<div class='left-50'>
		<?php
			echo "<fieldset> <legend>"; 
			_e('<h3>Avatar Update</h3>', 'responsive');
			echo "</legend>";
		if (wp_verify_nonce($_POST['alavatar'],'update') )	//security
			{
			if ( strstr( $_FILES['lavatar']['name'], '.php' ) ) wp_die('For security reasons, the extension ".php" cannot be in your file name.');
			if ( ! empty( $_FILES['lavatar']['name'] ) ) 
				{
				$mimes = array(
					'jpg|jpeg|jpe' => 'image/jpeg',
					'gif' => 'image/gif',
					'png' => 'image/png',
					'bmp' => 'image/bmp',
					'tif|tiff' => 'image/tiff'
				);
			
				// front end (theme my profile etc) support
				if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );

				//$simple_local_avatars->user_id_being_edited = $auth->id; // make user_id known to unique_filename_callback function
				$avatar = wp_handle_upload( $_FILES['lavatar'], array( 'mimes' => $mimes, 'test_form' => false ) );
				
				if ( empty($avatar['file']) ) 
					{
					echo "error, please try again";	
					}			
				update_user_meta( $auth->id, 'lavatar', $avatar['url'] );		// save user information (overwriting old)
				} 		
			}
		?>
		<?php wpfr_avatar( $auth->id ,140); ?>
		<form method='post' ENCTYPE="multipart/form-data">
		<input type='file' name='lavatar'>
		<?php wp_nonce_field('update','alavatar'); ?>
		<input type='submit' value='update avatar'>
		</form>
		<?php _e('<small>Tip: use a transparant png for maximum effects.</small><br>', 'responsive'); ?>
		
		
		<?php _e('<br><h3>system data</h3>', 'responsive'); ?>
		<?php echo "<br><strong>Username: $auth->user_login <br>Registration: $auth->user_registered</strong>"; ?>
		<br/>
		<?PHP include('mapme.php'); 
		
			echo "</fieldset>";
		?>
		
	</div>	
	
	<div style='clear:both'></div>	-->
	
<!--<div style='margin:10px;background:white;padding:10px'>
	<h2><?php _e('Publish your jobs ! (if any)', 'responsive'); ?></h2>	
	<br/><br/>
		<?php
		if (!empty($_POST['ppost']))
			{
			$my_post['ID'] = $wpdb->escape($_POST['ppost']);
			$my_post['post_status'] = 'publish';
			// Update the post into the database
			wp_update_post( $my_post );
			
			// reward user
			$current_user = wp_get_current_user();
			$score = get_user_meta($current_user->ID ,'score',TRUE );
			$score = $score + 100;
			update_user_meta($current_user->ID ,'score',$score );
			}
		
		$the_query = new WP_Query( array( 'author' => $auth->ID, 'post_status' => 'pending','post_type' => 'freelance_post') );		
		// The Loop
		while ( $the_query->have_posts() ) : $the_query->the_post();
			
			echo '<div style="margin:5px;padding:5px;border:2px solid red">';
			echo "<H3>";
			the_title();
			ECHO "</H3>";			
			the_excerpt();
			echo '<form method="POST"><input type="hidden" name="ppost" value="' . get_the_ID() . '"><input type="SUBMIT" VALUE="PUBLISH THIS LISTING"></form>';
			echo '</div>';
			
		endwhile;
		// Reset Post Data
		wp_reset_postdata();
		?>	

</div>-->
<div class="notification">
<?php _e('Below we show you what everyone else sees when they visit this page' , 'responsive'); ?>	
</div>
</div>
<div style='clear:both'></div>	