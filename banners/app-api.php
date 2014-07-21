<?php
if(isset($_POST['tag']) && $_POST['tag'] != ''){
	global $wpdb;
	$tag = $_POST['tag'];
	$jobs = array();
	require('./wp-blog-header.php');
	//Job Info
		if($tag=='jobinfo')
	{
			$category_id = intval($_POST['id']);
		$results = $wpdb->get_results("SELECT * FROM wpjb_job WHERE job_category = $category_id ORDER BY id DESC LIMIT 0,10");
		foreach($results as $j)
			{
				$id = $j->id;
				$company_name = $j->company_name;
				$job_type = $j->job_type;
				$job_category = $j->job_category;
				$job_location = $j->job_location;
				$job_title = $j->job_title;
				//$temp = explode(" ",(string)$j->job_expires_at);
				//$job_expires_at = $temp[0];
				//$job_expires_at = $j->job_expires_at;
				$job_expires_at = $j->job_created_at;
				$job_decription = $j->job_description;
				$job_required = $j->job_required;
				$job_interest = $j->job_interest;
				$contact_description = $j->contact_description;
				$job_salary = $j->job_salary;
				$job_contact = $j->job_contact;
				$job_phone = $j->job_phone;
				$job_address = $j->job_address;
				$sym_currency = $j->sym_currency;
				$job_slug = $j->job_solug;
				array_push($jobs,array("id"=>$j->id,"company_name"=>$j->company_name,"job_type"=>$j->job_type,"job_category"=>$j->job_category,"job_location"=>$j->job_location,"job_title"=>$j->job_title,"job_expires_at"=>$j->job_created_at,"job_decription"=>$j->job_description,"job_required"=>$j->job_required,"job_interest"=>$j->job_interest,"contact_description"=>$j->contact_description,"job_salary"=>$j->job_salary,"job_contact"=>$j->job_salary,"job_contact"=>$j->job_contact,"job_phone"=>$j->job_phone,"job_address"=>$j->job_address,"sym_currency"=>$j->sym_currency,"job_slug"=>$j->job_slug));
			}
			$response = array("success"=>0,"error"=>0,"jobs"=>$jobs);
			echo json_encode($response);
	}

	//start upload by FB user
	if($tag=='upload')
				{
						//start upload to server
						require_once("facebook.php");
						$facebook = new Facebook(array(
						'appId' => '322935957849434',
						'secret' => 'a8389ef77d63fb86c7c6bd5b11a0ef62',
						'cookie' => true
						));
						$kaishausername = $_POST['kaishausername'];
						$image = $_POST['image'];
						$comment = $_POST['comment'];
						$companyName = $_POST['companyName'];
						$category = $_POST['category'];
						$token = $_POST['token'];
						$user_id = $_POST['user_id'];
					
				if(!file_exists('wp-content/uploads/KaishaCameraImage')){
					mkdir('wp-content/uploads/KaishaCameraImage');
					chmod('wp-content/uploads/KaishaCameraImage',0777);
					}	
				if(!file_exists('wp-content/uploads/KaishaCameraImage/'.$user_id)){
						mkdir('wp-content/uploads/KaishaCameraImage/'.$user_id);
						chmod('wp-content/uploads/KaishaCameraImage/'.$user_id,0777);
							}	 
				define('UPLOAD_DIR', './wp-content/uploads/KaishaCameraImage/'.$user_id.'/');
				$image = str_replace('data:image/png;base64,', '', $image);
				$image = str_replace(' ', '+', $image);
				$data = base64_decode($image);
				$file = UPLOAD_DIR . uniqid() . '.jpg';
				$imageName = substr($file,2,strlen($file));
				
				$imageName = explode("/",$imageName);
				$imageName = $imageName[4];
				
				$success = file_put_contents($file, $data);
				echo $success ? $file : 'Unable to save the file.';
				$facebook->setFileUploadSupport(true);
				$args = array('message' => $comment . "\n" ."Xem chi tiết tại đây :" . 'https://play.google.com/store/apps/details?id=com.sagojo.kaishacamera&hl=vi');
				$args['image'] = '@' . realpath($file);
				$args['access_token'] = $token;
				$data1 = $facebook->api('/me/photos', 'post', $args);
				print_r($data1);
				$kaisha = array(
				'comment' => $comment,
				'companyName' => $companyName,
				'category' => $category,
				'user_id' => $user_id,
				'image' =>$imageName,
				'datepost' => date('d/m/Y')				
			);	        
				$insert = $wpdb->insert('wp_kaisha_camera', $kaisha);	
				}
		//end upload by FB user
		//start upload by sagojo user
			if($tag=='uploadsagojo')
				{
						//start upload to server
						require_once("facebook.php");
						$facebook = new Facebook(array(
						'appId' => '322935957849434',
						'secret' => 'a8389ef77d63fb86c7c6bd5b11a0ef62',
						'cookie' => true
						));
						$kaishausername = $_POST['kaishausername'];
						$image = $_POST['image'];
						$comment = $_POST['comment'];
						$companyName = $_POST['companyName'];
						$category = $_POST['category'];
						$token = $_POST['token'];
						$user_id = $_POST['user_id'];
					
				if(!file_exists('wp-content/uploads/KaishaCameraImage')){
					mkdir('wp-content/uploads/KaishaCameraImage');
					chmod('wp-content/uploads/KaishaCameraImage',0777);
					}	
				if(!file_exists('wp-content/uploads/KaishaCameraImage/'.$user_id)){
						mkdir('wp-content/uploads/KaishaCameraImage/'.$user_id);
						chmod('wp-content/uploads/KaishaCameraImage/'.$user_id,0777);
							}	 
				define('UPLOAD_DIR', './wp-content/uploads/KaishaCameraImage/'.$user_id.'/');
				$image = str_replace('data:image/png;base64,', '', $image);
				$image = str_replace(' ', '+', $image);
				$data = base64_decode($image);
				$file = UPLOAD_DIR . uniqid() . '.jpg';
				$imageName = substr($file,2,strlen($file));
				
								
				$imageName = explode("/",$imageName);
				$imageName = $imageName[4];
				
				
				$success = file_put_contents($file, $data);
				echo $success ? $file : 'Unable to save the file.';
				$kaisha = array(
				'comment' => $comment,
				'companyName' => $companyName,
				'category' => $category,
				'user_id' => $user_id,
				'image' =>$imageName,
				'datepost' => date('d/m/Y')				
			);	
				$insert = $wpdb->insert('wp_kaisha_camera', $kaisha);	
				}
		//end upload by sagojo user
		//end upload to server		
	$response = array("tag" => $tag, "success" => 0, "error" => 0);

	if($tag == 'login'){
		$creds = array();
		$creds['user_login'] = $_POST['user_login'];
		$creds['user_password'] = $_POST['user_password'];
		$creds['remember'] = false;

		$user = wp_signon($creds, false);
		if(is_wp_error($user)){

			$rr=$_POST['user_login'];
			
			$response["error"] = 1;
			$response["error_msg"] = $user->get_error_message();
			
			$response["ID"] = $wpdb->get_var("SELECT ID FROM wp_users WHERE user_email = '$rr' AND user_login = '$rr'");
			echo json_encode($response);
		} else {
			$response["success"] = 1;
			$response["msg"] = 'Login successful';
			$response["ID"] = $user->ID;
			$response["username"] = $user->user_login;
			$response["email"] = $user->user_email;
			$response["user_url"] = $user->user_url;
			$response["name"] = $user->display_name;
			$response["gender"] = $wpdb->get_var("SELECT gender FROM wpjb_resume WHERE user_id = {$user->ID}") == '1' ? 'male' : 'female';
			$response["birthday"] = $wpdb->get_var("SELECT namsinh FROM wpjb_resume WHERE user_id = {$user->ID}");
##			$response["gender"] = get_user_meta($user->ID, 'user_gender', true);
##			$response["birthday"] = get_user_meta($user->ID, 'rpr_nm_sinh', true);
			echo json_encode($response);
		}	
	}
	 else if ($tag == 'register') {
		$user_login = $_POST['user_login'];
		$user_password = $_POST['user_password'];
		$birthday = $_POST['birthday'];
		$user_email = $_POST['user_email'];
		$user_gender = $_POST['user_gender'];
		if($_POST['user_gender'] == 'male')
			$user_gender = '1';
		else if ($_POST['user_gender'] == 'female')
			$user_gender = '0';
		$user_url = $_POST['user_url'];
		$display_name = $_POST['display_name'];
		$user_firstname = $_POST['first_name'];
		$user_lastname = $_POST['last_name'];
		$fbconnect_netid = $_POST['fbconnect_netid'];
		
		if(($fbconnect_netid == 'horocope_facebook' || 
			$fbconnect_netid == 'colormatch_facebook') && 
			email_exists($user_email)){
			$response["success"] = 2;
			$response["user_id"] = $wpdb->get_var("SELECT ID FROM wp_users WHERE user_login = $user_login");
			$response["msg"] = 'Login facebook successful';
			echo json_encode($response);
		} else if(!validate_username($user_login)){
			$response["error"] = 2;
			$response["error_msg"] = "Invalidate username";
			echo json_encode($response);
		} else if(!is_email($user_email)){
			$response["error"] = 3;
			$response["error_msg"] = "Invalidate email";
			echo json_encode($response);
		} else {
			if($fbconnect_netid == 'horocope_facebook' || 
				$fbconnect_netid == 'colormatch_facebook'){
				
				$user_password = wp_generate_password();
				$response["passgen"] = $user_password;
			}
			$userdata = array(
				'user_login' => $user_login,
				'user_pass' => $user_password,
				'user_email' => $user_email,
				'user_url' => $user_url,
				'display_name' => $display_name,
			);

			$user = wp_insert_user($userdata);
			if(is_wp_error($user)){
				$response["error"] = 4;
				$response["user_id"] = $wpdb->get_var("SELECT ID FROM wp_users WHERE user_login = $user_login");
				$response["error_msg"] = $user->get_error_message();
				echo json_encode($response);
			} else {
				$wpjb_resume = array(
					'user_id' => $user,
					'email' => $user_email,
					'firstname' => $user_firstname,
					'lastname' => $user_lastname,
					'created_at' => date("Y-m-d H:i:s"),
					'updated_at' => date("Y-m-d H:i:s"),
					'namsinh' => $birthday,
					'gender' => $user_gender
				);
				$wpdb->insert('wpjb_resume', $wpjb_resume);
				
				$wp_usermeta = array();
				$wp_usermeta['meta_key'] = 'dating';
				$wp_usermeta['meta_value'] = '1';
				$wp_usermeta['user_id'] = $user;
				$wpdb->insert('wp_usermeta', $wp_usermeta);
				
				add_user_meta($user, '_register_via', $fbconnect_netid);
				$response["success"] = 3;
				$response["msg"] = 'Create user successful';
				$response["user"] = $user_login;
				$response["password"] = $user_password;
				$response["netid"] = $fbconnect_netid;
				$response["user_id"] = $user;
				echo json_encode($response);
			}
		}
		
	} elseif ($tag == 'update') {
		$user_email = $_POST['user_email'];
		$user_pass = $_POST['user_pass'];

		$new_birthday = $_POST['new_birthday'];
		$new_password = $_POST['new_password'];
		$new_email = $_POST['new_email'];

		$find_user = get_user_by('email', $user_email);

		$creds = array();
		$creds['user_login'] = $find_user->user_login;
		$creds['user_password'] = $_POST['user_pass'];
		$creds['remember'] = false;

		$user = wp_signon($creds, false);
		if(is_wp_error($user)){
			$response["error"] = 5;
			$response["error_msg"] = $user->get_error_message();
			echo json_encode($response);
		} else if(	$new_email && !is_email($user_email)){
			$response["error"] = 6;
			$response["msg"] = 'Invalide email';
			echo json_encode($response);
		} else {
			$userdata = array( 'ID' => $user->ID);
			$wpjb_resume = array();
			
			if($new_email){
				$userdata['user_email'] = $new_email;
				$wpjb_resume['email'] = $new_email;
				$response["newemail"] = $new_email;
			}
			if($new_password){
				$userdata['user_pass'] = $new_password;
				$response["newpass"] = $new_password;
			}
			wp_update_user($userdata);
			
			if($new_birthday){
				$wpjb_resume['namsinh'] = $new_birthday;
				$response["newbirth"] = $new_birthday;
			}
			if($_POST['new_gender']){
				$new_gender = $_POST['new_gender'];
				if( $_POST['new_gender'] && $_POST['new_gender'] == 'male')
					$new_gender = '1';
				else if ($_POST['new_gender'] && $_POST['new_gender'] == 'female')
					$new_gender = '0';
				$wpjb_resume['gender'] = $new_gender;
				$response["newgender"] = $new_gender;
			}
			$wpdb->update('wpjb_resume', $wpjb_resume, array('user_id' => $user->ID));
			$response["success"] = 4;
			echo json_encode($response);
		}
	} else {
		//echo "Invalid Request";
	}

} else {
	echo "Access Denied";
}

?>
