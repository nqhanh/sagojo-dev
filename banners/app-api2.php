<?php
if(isset($_POST['tag']) && $_POST['tag'] !='')
{
	global $wpdb;
	//receive
	$tag = $_POST['tag'];
	require('./wp-blog-header.php');
	$response = array();
	$users = array();
	if($tag=='dating')
	{
			//nhan zodiac tu app
			$zodiac = $_POST['zodiac'];//parterm 05/05 05/06
			$zodiac1 = explode(" ",$zodiac);
			$fromDate = $zodiac1[0];
			$toDate = $zodiac1[1];
			
			// nhan age tu app
			$age = $_POST['age'];//parterm 15 20
			$age1 = explode("   -   ",$age);
			$fromAge =intval(date("Y")) - intval($age1[1]);
			$toAge = intval(date("Y")) - intval($age1[0]);
			$gender = $_POST['gender'];
		$results = $wpdb->get_results("SELECT * FROM wpjb_resume as res,wp_usermeta as um
									   WHERE  res.gender = '$gender'
									   		  AND res.user_id = um.user_id 
											  AND um.meta_key = 'dating' 
                                              AND um.meta_value = '1' 
                                           	  AND STR_TO_DATE( CONCAT( DAY( STR_TO_DATE( res.namsinh, '%d/%m/%Y' ) ) , '/', MONTH( 												  STR_TO_DATE(res.namsinh, '%d/%m/%Y' ) ) ) , '%d/%m' )
                                              BETWEEN STR_TO_DATE( '$fromDate', '%d/%m' )
                                              AND STR_TO_DATE( '$toDate', '%d/%m' )
											  AND YEAR(STR_TO_DATE(res.namsinh,'%d/%m/%Y')) 
											  BETWEEN $fromAge AND $toAge 
											  ORDER BY RAND() 
											  LIMIT 0,10
											  ");
		//$response = array("success"=>0,"error"=>0,"jobs"=>$jobs);
		foreach($results as $u)
		{
			$ID = $u->user_id;
			$firstname = $u->firstname;
			$lastname = $u->lastname;
			$namsinh = $u->namsinh;
			$email = $u->email;
			$phone = $u->phone;
			$display_name;
			$user_login;
			$results1 = $wpdb->get_results("SELECT * FROM wp_users WHERE ID = $u->user_id");
				foreach($results1 as $u1)
					{
						$display_name = $u1->display_name;
						$user_login = $u1->user_login;
					}
			array_push($users,array("user_id"=>$ID,"firstname"=>$firstname,"lastname"=>$lastname,"namsinh"=>$namsinh,
									"email"=>$email,"phone"=>$phone,"display_name"=>$display_name,"dating_user_login"=>$user_login));
		}
		$response = array("users"=>$users);
		echo json_encode($response);
	}
	else if($tag=='updatedating')
		{
			$usermeta = array();
			$ID = intval($_POST['ID']);
			$meta_value = $_POST['meta_value']; 
			$usermeta['meta_key'] = 'dating';
			$usermeta['meta_value'] = $meta_value;
			$usermeta['user_id'] = $ID;
			//check and insert status dating
			$rs = $wpdb->get_results("SELECT * FROM wp_usermeta WHERE user_id = $ID AND meta_key = 'dating'");
			$rows=count($rs);
			if($rows==0)
				$insert = $wpdb->insert('wp_usermeta', $usermeta);
			else
				//update status
				$wpdb->query("UPDATE wp_usermeta SET meta_value ='$meta_value' WHERE user_id = $ID AND meta_key = 'dating'");
			$response['cc']=$rows;
			echo json_encode($response);
		}
	else if($tag=='sendprivatemessage')
	{
		$pm_Subject = $_POST['subject'];
		$pm_Content = $_POST['content'];
		$pm_Sender = $_POST['sender_User'];//user_login of sender
		$pm_Recipient = $_POST['recipient_User'];//user_login of recipient
		$pm_TimeSender = $_POST['timesender']; 
		
		$pm_DisplayNameRecipient = $_POST['displaynamerecipient'];
		$rs = $wpdb->get_results("SELECT display_name FROM wp_users WHERE user_login = '$pm_Sender' ");
		$pm_DisplayNameSender;
		foreach($rs as $dn)
			{
				$pm_DisplayNameSender = $dn->display_name;
			}
		$pm = array(
				'subject' => $pm_Subject,
				'content' => $pm_Content,
				'sender' => $pm_Sender,
				'recipient' => $pm_Recipient,
				'timesender' =>$pm_TimeSender,
				'read' => 0,
				'deleted' => 0,
				'displaynamerecipient' =>$pm_DisplayNameRecipient,
				'displaynamesender' =>$pm_DisplayNameSender
				  );	 
		$insert = $wpdb->insert('wp_pm',$pm);
		echo json_encode($response);
	}
	else if($tag=='readprivatemessage')
	{
		$message = array();
		$response1 =  array();
		$pm_Recipient = $_POST['recipient_User'];//user_login of recipient
		$rs = $wpdb->get_results("SELECT * FROM wp_pm WHERE recipient = '$pm_Recipient' AND `read` = 0");
		
		
					
		foreach($rs as $m)
		{
			$id = $m->id;
			$read = $m->read;
			$subject = $m->subject;
			$content = $m->content;
			$sender = $m->sender;
			$recipient = $m->recipient;
			$timesender = $m->timesender;
			$displaynamesender = $m->displaynamesender;
			$displaynamerecipient = $m->displaynamerecipient;
			$wpdb->query("UPDATE wp_pm SET `read` = 1 WHERE id = $id");
			array_push($message,array("subject"=>$subject,"content"=>$content,"sender"=>$sender,"recipient"=>$recipient,
									  "timesender"=>$timesender,"read"=>$read,"id"=>$id,"displaynamesender"=>$displaynamesender,"displaynamerecipient"=>$displaynamerecipient));
		}
		$response1 = array("messages"=>$message);
		echo json_encode($response1);
		
	}
	else if($tag=='newmessage')
	{
		$json=array();
		$recipient_login = $_POST['recipient_login'];
		$rs = $wpdb->get_results("SELECT * FROM wp_pm WHERE recipient = '$recipient_login' AND `read` = 0");
		$rows=count($rs);
		if($rows==0)
			$json['yes'] = "0";
		else
			$json['yes'] = "1";
		echo json_encode($json);
	}
}
else
{
	echo "Access denied";
}
?>
