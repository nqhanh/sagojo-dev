<script language="javascript">
function ajaxFunction(id){
    var xmlHttp;
    if(window.XMLHttpRequest){
        // IE7+, Firefox, Chrome, Opera, Safari
        xmlHttp = new XMLHttpRequest;
    }
    else if(window.ActiveXObject){
        // IE6, IE5
        xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    
    xmlHttp.onreadystatechange = function(){
        if(xmlHttp.readyState == 4){
            document.getElementById('city').innerHTML = xmlHttp.responseText;
        }
    }
    xmlHttp.open('GET', 'wp-content/themes/responsive/freelance_city.php?countryid='+id, true);
    xmlHttp.send(null);
}
</script>	
	<?php
	if (wp_verify_nonce($_POST['usersets'],'update') )	//security
		{
		if($_POST) 
			{
			global $wpdb;
			echo "<h2>profile updated.</h2>";
			$first = $wpdb->escape($_POST['first-name']);
			$last = $wpdb->escape($_POST['last-name']);
			$gender = $wpdb->escape($_POST['gender']);
			$age = $wpdb->escape($_POST['age']);
			$email = $wpdb->escape($_POST['email']);
			$website = $wpdb->escape($_POST['wurl']);
			$bio = $wpdb->escape($_POST['bio']);
			$refr = $wpdb->escape($_POST['refr']);
			$password = $wpdb->escape($_POST['pas1']);
			$confirm_password = $wpdb->escape($_POST['pas2']);
			$street = $wpdb->escape($_POST['street']);
			$country = $wpdb->escape($_POST['country']);
			$zip = $wpdb->escape($_POST['zip']);
			$phone = $wpdb->escape($_POST['phone']);
			$contactinfo = $wpdb->escape($_POST['contactinfo']);
			
			update_user_meta( $auth->id, 'fname', $first );
			update_user_meta( $auth->id, 'lname', $last );
			update_user_meta( $auth->id, 'bio', $bio );
			update_user_meta( $auth->id, 'gender', $gender );
			update_user_meta( $auth->id, 'age', $age );			
			update_user_meta( $auth->id, 'refr', $refr );						
			update_user_meta( $auth->id, 'street', $street );
			update_user_meta( $auth->id, 'country', $country );
			update_user_meta( $auth->id, 'zip', $zip );
			update_user_meta( $auth->id, 'phone', $phone );
			update_user_meta( $auth->id, 'contactinfo', $contactinfo );
			update_user_meta( $auth->id, 'website', $website );
			
			$psc = 0;
			if (strlen(get_user_meta( $auth->id, 'fname',TRUE )) > 2) $psc=$psc+10;
			if (strlen(get_user_meta( $auth->id, 'lname',TRUE )) > 2) $psc=$psc+10;
			if (strlen(get_user_meta( $auth->id, 'gender',TRUE )) > 20) $psc=$psc+5;
			if (strlen(get_user_meta( $auth->id, 'age',TRUE )) > 20) $psc=$psc+5;			
			if (strlen(get_user_meta( $auth->id, 'bio',TRUE )) > 20) $psc=$psc+10;
			if (strlen(get_user_meta( $auth->id, 'refr',TRUE )) > 20) $psc=$psc+10;
			if (strlen(get_user_meta( $auth->id, 'street',TRUE )) > 2) $psc=$psc+1;
			if (strlen(get_user_meta( $auth->id, 'zip',TRUE )) > 2) $psc=$psc+4;
			if (strlen(get_user_meta( $auth->id, 'phone',TRUE )) > 6) $psc=$psc+5;
			if (strlen(get_user_meta( $auth->id, 'contactinfo',TRUE )) > 8) $psc=$psc+10;
			if (strlen(get_user_meta( $auth->id, 'website',TRUE )) > 6) $psc=$psc+5;
			if (strlen(get_user_meta( $auth->id, 'lavatar',TRUE )) > 6) $psc=$psc+25;
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
				<?php 
				_e('Profile and Settings', 'responsive');	
				$profilescore = get_user_meta( $auth->id, 'profilescore', TRUE );if (empty($profilescore)) $profilescore = 15;
				?>
			</legend>
				
			<div style='width:70%;background-color:red;height:20px;margin:3px auto;'>
				<div style='width:<?php echo $profilescore;?>%;background-color:green;height:20px;color:white'></div>
			</div>
			<div id="profile-score">
			<?php _e('Fill out all fields to raise your score and ranking.', 'responsive');?>
				<?php _e('Profilescore:', 'responsive'); echo "$profilescore/100";?>
			</div>
		</fieldset>
	</div>
	<div class='left-50'>
		<fieldset>
			<legend><?php _e('<h3>User settings</h3>', 'responsive'); ?></legend>
			<div id="personal-item"><?php _e('Items marked * are never public', 'responsive'); ?></div>
			<form method="post" id="personal-form-id-authorinfo" class="personal-form-class-authorinfo">
				<div id="personal-firstname" class="personal-profile">
					<label for="first-name"><?php _e('First Name', 'responsive'); ?></label>
					<input class="text-input" name="first-name" type="text" id="first-name" value="<?php echo stripslashes(get_user_meta($auth->id , 'first_name' ,TRUE)); ?>" />
				</div>
				<div id="personal-lastname" class="personal-profile">
					<label for="last-name"><?php _e('Last Name', 'responsive'); ?></label>
					<input class="text-input" name="last-name" type="text" id="last-name" value="<?php echo stripslashes(get_user_meta($auth->id ,'last_name' ,TRUE)); ?>" />
				</div>
				<div id="personal-Gender" class="personal-profile">
					<label for="last-name"><?php _e('Gender', 'responsive'); ?></label>
					<select id="personal-Gender-seclect" name='gender'>
						<option value=''> <?php echo get_user_meta($auth->id ,'gender' ,TRUE); ?> </option>
						<option value='1'> male </option>
						<option value='0'> female </option>
					</select>
				</diV>
				
				<div id="personal-age" class="personal-profile">
					<label for="last-name"><?php _e('Age', 'responsive'); ?></label><!---style='width:20%;float:right;margin-right:4%;' -->
					<input class="text-input"  name="age" type="number" id="age" min='16' max='99' value="<?php echo get_user_meta($auth->id ,'age' ,TRUE); ?>" />		
				</div>
				<div style='clear:both'></div>
				
				<div id="personal-firstname" class="personal-profile">
					<label for="last-name"><?php _e('Zipcode', 'responsive'); ?></label>
					<input class="text-input" name="zip" type="text" id="zip" value="<?php echo stripslashes(get_user_meta($auth->id ,'zip' ,TRUE)); ?>" />
				</div>
				<div style='clear:both'></div>
				
				<div id="personal-contry" class="personal-profile">
					<label for="country"><?php _e('Country', 'responsive'); ?></label>
					<?php
						$country_file="country_list.ini" ;
						if (file_exists($country_file) && is_readable($country_file))
						{
						$countrys=parse_ini_file($country_file,true);						
						$selectBox1  = '';
						$selectBox1 .= '<select id="country" name="country" onchange="ajaxFunction(this.value);">';
						$selectBox1 .= '<option value="'.stripslashes(get_user_meta($auth->id ,'country' ,TRUE) ).'" selected>'.stripslashes(get_user_meta($auth->id ,'country' ,TRUE) ).'</option>';
						foreach ($countrys as $country) {							
							$selectBox1 .= '<option value="'.$country['name'].'">'.__($country['name']).'</option>';
						}
						$selectBox1 .= '</select>';
						echo $selectBox1;
						?>
						<span id="city">
							<select name="city">
								<option>City</option>
							</select>
						</span>
						<?php
						
						}
						else
						{
						// If the configuration file does not exist or is not readable, DIE php DIE!
						die("Sorry, the $file file doesnt seem to exist or is not readable!");
						}						
						?>		
				</div>
				
				<div style='clear:both'></div>		
				<div id="personal-email" class="personal-profile">
					<label for="email"><?php _e('E-mail *', 'responsive'); ?></label>
					<input class="text-input" name="email" type="text" id="email" value="<?php echo stripslashes($auth->user_email); ?>" />
				</div>
				<div id="personal-web" class="personal-profile">
					<label for="url"><?php _e('Website', 'responsive'); ?></label>
					<input class="text-input" name="wurl" type="text" id="wurl" value="<?php echo  stripslashes(get_user_meta($auth->id ,'website' ,TRUE)); ?>" />
				</div>
				<div id="personal-pass" class="personal-profile">
					<label for="pass1"><?php _e('Password *', 'responsive'); ?> </label>
					<input class="text-input" name="pas1" type="password" id="pas1" />
				</div>
				<div id="personal-repeatpass" class="personal-profile">
					<label for="pass2"><?php _e('Repeat Password *', 'responsive'); ?></label>
					<input class="text-input" name="pas2" type="password" id="pas2" />
				</div>
				<div id="personal-about" class="personal-profile">
					<label for="description"><?php _e('About me', 'responsive') ?></label>
					<textarea name="bio" id="desc" rows="5" cols="50"><?php echo stripslashes(get_user_meta($auth->id ,'bio',TRUE )); ?></textarea>
				</div>
				<div id="personal-refer" class="personal-profile">
					<label for="refr"><?php _e('References/experience', 'responsive') ?></label>
					<textarea name="refr" id="refr" rows="5" cols="50"><?php echo stripslashes(get_user_meta($auth->id ,'refr',TRUE )); ?></textarea>
				</div>
				<div id="personal-info-below" class="personal-profile"><?php _e('<strong>Info below is shown to job lister when your estimate is selected, or to freelancer when you are the job lister.</strong>', 'responsive'); ?></div>
				
				<div id="personal-firstname" class="personal-profile">
					<label for="phone"><?php _e('My phone number', 'responsive'); ?></label>		
					<input class="text-input" name="phone" type="text" id="phone" value="<?php echo get_user_meta($auth->id ,'phone' ,TRUE); ?>" />
				</div>
				<div id="personal-my-contact" class="personal-profile">
					<label for="contactinfo"><?php _e('My contactinfo', 'responsive'); ?></label>		
					<textarea name="contactinfo" id="desc" rows="3" cols="50"><?php echo stripslashes(get_user_meta($auth->id ,'contactinfo',TRUE )); ?></textarea>
				</div>
				<div id="personal-update" class="personal-profile">
					<?php wp_nonce_field('update','usersets'); ?>
					<input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Update', 'responsive'); ?>" />
				</div>
			</form>
		</fieldset>
	</div>
	
	<div class='left-50'>
		<?php
			echo "<fieldset> <legend>"; 
			_e('<h2>Avatar Update</h2>', 'responsive');
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
	
	<div style='clear:both'></div>	
	
<div style='margin:10px;background:white;padding:10px'>
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

</div>

<?php _e('Below we show you what everyone else sees when they visit this page' , 'responsive'); ?>	
</div>
<div style='clear:both'></div>	