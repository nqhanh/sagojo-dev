<?php
include_once($_SERVER['DOCUMENT_ROOT']."/wp-content/banners/config.php");
include_once($_SERVER['DOCUMENT_ROOT']."/wp-config.php");
$mysql_hostname = DB_HOST;
$mysql_user = DB_USER;
$mysql_password = DB_PASSWORD;
$mysql_database = DB_NAME;
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password)
or die("Xin lỗi không thể kết nối");
mysql_select_db($mysql_database, $bd) or die("Không tìm thấy cơ sở dữ liệu");
mysql_set_charset('utf8',$bd);
if($_POST)
{
	//Post variables we received from user
	$homeurl = $_POST["homeurl"];
	$userPageId 	= $_POST["userpages"];
	$jobID 	= $_POST["jobID"];
	$job_slug 	= $_POST["job_slug"];
	$logo = $_POST["logo"];
	if ($logo == '') $logo = 'http://sagojo.com/wp-content/banners/apply_now_600.jpg';	
	$userMessage = $_POST["message"];
	if ($userMessage != '')
		$userMessage = $_POST["message"].'
	';
	else $userMessage = 'CẦN TUYỂN: ';
	$userFMessage = $_POST["fmessage"];
	if ($userFMessage != '')
		$userFMessage = $_POST["fmessage"].'
	';
	else $userFMessage = '';
	$sql="SELECT * FROM wpjb_job WHERE id = $jobID ORDER BY  `id` ASC  LIMIT 1 "; 
	
	$result=mysql_query($sql);
	
	while($row=mysql_fetch_array($result)){
	if ($row['job_salary'] == 0) $salary = 'thỏa thuận';
	else {
		if ($row['sym_currency'] == 0) $salary = '$'.number_format($row['job_salary'],0,".",",");
		else if ($row['sym_currency'] == 1) $salary = number_format($row['job_salary'],0,",",".").' đồng';
		else if ($row['sym_currency'] == 2) $salary = $row['job_salary'];
	}
	$job_contact = $row['job_contact'];
	$job_address = $row['job_address'];
	$company_name = $row['company_name'];
	$job_title = $row['job_title'];
	
	$mota = $row['job_description'];
	$mota = str_replace("<br />","
	",$row['job_description']);

	$userMessage = $userMessage.mb_strtoupper($row['job_title'],'UTF-8') .'
	'. '' .'
	'. '- Mức lương: ' .$salary .'
	'. '- Nơi làm việc: ' .$row['job_location'] .'
	'. '- Tên công ty: ' .$row['company_name'] .'
	'. ''.'
	'. 'MÔ TẢ CÔNG VIỆC: ' .'
	'. '' .'
	'.$mota .'
	'. ''.'
	'. 'KỸ NĂNG - KINH NGHIỆM BẮT BUỘC: ' .'
	'. '' .'
	'.$row['job_required'] .'
	'. ''.'
	'. 'QUYỀN LỢI - CHẾ ĐỘ: ' .'
	'. '' .'
	'.$row['job_interest'] .'
	'. ''.'
	'. '***ỨNG TUYỂN NGAY -->' .$job_slug .'
	'. ''.'
	'. $userFMessage;
	
	}	

	if(strlen($userMessage)<1) 
	{
		//message is empty
		$userMessage = 'No message was entered!';
	}
	
		//HTTP POST request to PAGE_ID/feed with the publish_stream
		$post_url = '/'.$userPageId.'/feed';
		//It can be found at https://developers.facebook.com/tools/access_token/
		$access_token = 'CAAUnDpoYT5UBAAiiWmBB00fqiQQDsdY2Y1q9eWF1MY8AtMC7yb0c7nZBXS3ahXoNN4KUP38kTO6cogbZABeXmWDZC2WvfrJUXSqUBUy1QFWTHexXvV3jdDJDf1IDY3BJVKi40FrQzny8q8xVcMHO6vZCvJSlCZASg9vHrv1J6oBGEq4vGQk9yNrp1kWELmtwZD';

		$params = array('access_token' => $access_token);		
		
		//Replace arvind07 with your Facebook ID
		$accounts = $facebook->api('/me/accounts', 'GET', $params);
		
		//get access token granted
		$accounts = $facebook->api('/me/accounts');
		foreach($accounts['data'] as $account){
		   if($account['id'] == $userPageId){
			  $token = $account['access_token'];
		   }
		}
		
		//Upload Photos To Facebook Fan Page
		$valid_files = array('image/jpeg', 'image/png', 'image/gif');

		//Check if the album exists
		/*$fql = "SELECT object_id FROM album WHERE owner = $userPageId AND name='sagojojobs'";
		$album_exists = $facebook->api(array(
			'method' => 'fql.query',
			'query' =>$fql,
			'access_token' => $token
		));
		if(array_key_exists(0, $album_exists)){
			//the album with that name exists, let's save his ID
			$album_uid = $album_exists[0]['object_id'];
		}else{
			//We don't have an album with that name, let's create an album
			$album_details = array('name'=> 'sagojojobs');
			$create_album =  $facebook->api('/'.$userPageId.'/albums', 'post', $album_details);
			//Get album ID of the album you've just created
			$album_uid = $create_album['id'];
		}		*/
		//$album_uid = '229788360478657'; //vieclam
		//$album_uid = '475669339198287'; //sagojo
		// posts message on page feed
				
		$msg_body = array(
			'message' => $userMessage,
			//'image' => '@' . $img,
			//'aid' => $album_uid,
			//'no_story' => 0,
			/*'name' => 'Cần tuyển: '.$job_title,
			'caption' => 'Người liên hệ: '.$job_contact,
			'link' => $job_slug,
			'description' => $company_name .' - Địa chỉ: 
			'. $job_address,
			'picture' => $logo,*/
			//'access_token' => $token
			/*'actions' => array(
								array(
									'name' => 'NỘP HỒ SƠ',
									'link' => $job_slug
								)
							)*/
		);
		
		if(isset($_FILES["pic"]) && !empty($_FILES["pic"]["tmp_name"])){
			$post_url = '/'.$userPageId.'/photos';
			if( !in_array($_FILES['pic']['type'], $valid_files ) ){
				echo 'Only jpg, png and gif image types are supported!';
			}else{
				#Upload photo here
				$img = realpath($_FILES["pic"]["tmp_name"]);
			}
			
			$msg_body = array(
				'message' => $userMessage,
				'image' => '@' . $img,
				'access_token' => $token
			);
		}
	
	  
	if ($fbuser) {
	 try {
			$postResult = $facebook->api($post_url, 'post', $msg_body );
		} catch (FacebookApiException $e) {
		echo $e->getMessage();
	  }
		/*if (isset($postResult['id']))
			{
				
				$attachment = array
				(
				'access_token'=>$token,
				'type' => 'photo',
				'message' => $userMessage,
				);
				$postResult = $facebook->api($post_url, 'post', $attachment );
				//$result = $facebook->api($userPageId.'/links/','post',$attachment);
			}*/
	}else{
	 $loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
	 header('Location: ' . $loginUrl);
	}
	//Show sucess message
	if($postResult)
	 {	
		

		header( 'Location:'.$homeurl ) ;

/*
		 echo '<html><head><title>Message Posted</title><link href="style.css" rel="stylesheet" type="text/css" /></head><body>';
		 echo '<div id="fbpageform" class="pageform" align="center">';
		 echo '<h1>Your message is posted on your facebook wall.</h1>';
		 echo '<a target="_blank" class="button" href="http://www.facebook.com/'.$userPageId.'">Visit Your Page</a>';
		 echo '</div>';
		 echo '</body></html>';*/
	 }
}

?>
