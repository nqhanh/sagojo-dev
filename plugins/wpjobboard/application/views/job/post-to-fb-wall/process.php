<?php
include_once(ABSPATH."/wp-content/plugins/wpjobboard/application/views/job/post-to-fb-wall/config.php");
require(ABSPATH .'/wp-blog-header.php');
/*$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "sagojo";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password)
or die("Xin lỗi không thể kết nối");
mysql_select_db($mysql_database, $bd) or die("Không tìm thấy cơ sở dữ liệu");
mysql_set_charset('utf8',$bd);*/
if($_POST)
{
	//Post variables we received from user
	$userPageId 	= $_POST["userpages"];
	$jobID 	= $_POST["jobID"];
	//$userMessage 	= $_POST["message"];
	$sql="SELECT * FROM wpjb_job WHERE id = $jobID ORDER BY  `id` ASC  LIMIT 1 "; 
	
	$result=mysql_query($sql);
	
	while($row=mysql_fetch_array($result)){
	if ($row['job_salary'] == 0) $salary = 'thỏa thuận';
	else {
		if ($row['sym_currency'] == 0) $salary = 'USD'.$row['job_salary'];
		else if ($row['sym_currency'] == 1) $$salary = $row['job_salary'].' đồng';
		else if ($row['sym_currency'] == 2) $salary = $row['job_salary'];
	}
	$job_contact = $row['job_contact'];
	$job_address = $row['job_address'];
	$company_name = $row['company_name'];
	$job_slug = $row['job_slug'];
	$userMessage = 'CẦN TUYỂN: ' .mb_strtoupper($row['job_title'],'UTF-8') .'
	'. '' .'
	'. '- Mức lương: ' .$salary .'
	'. '- Nơi làm việc: ' .$row['job_location'] .'
	'. '- Tên công ty: ' .$row['company_name'] .'
	'. ''.'
	'. 'MÔ TẢ CÔNG VIỆC: ' .'
	'. '' .'
	'.$row['job_description'] .'
	'. ''.'
	'. 'KỸ NĂNG/ KINH NGHIỆM BẮT BUỘC: ' .'
	'. '' .'
	'.$row['job_required'] .'
	'. ''.'
	'. 'QUYỀN LỢI/ CHẾ ĐỘ: ' .'
	'. '' .'
	'.$row['job_interest'] .'
	'. ''.'
	'. '';
	
	}	

	if(strlen($userMessage)<1) 
	{
		//message is empty
		$userMessage = 'No message was entered!';
	}
	
		//HTTP POST request to PAGE_ID/feed with the publish_stream
		$post_url = '/'.$userPageId.'/feed';

		
		// posts message on page feed
		$msg_body = array(
			'message' => $userMessage,
			'name' => 'Ứng tuyển ngay hôm nay!',
			'caption' => 'Người liên hệ: '.$job_contact,
			'link' => site_url().'/tim-viec-lam/view/'.$job_slug,
			'description' => $company_name .' - Địa chỉ: 
			'. $job_address,
			'picture' => site_url().'/wp-content/banners/apply_now_600.jpg',
			'actions' => array(
								array(
									'name' => 'Ứng tuyển ngay và luôn!',
									'link' => site_url().'/tim-viec-lam/view/'.$job_slug
								)
							)
		);
		
	/*
		//posts message on page statues 
		$msg_body = array(
		'message' => $userMessage,			
		'actions' => array(
								array(
									'name' => 'Ứng tuyển ngay và luôn!',
									'link' => 'http://www.sagojo.com'
								)
							)
		);
	*/
	  
	if ($fbuser) {
	  try {
			$postResult = $facebook->api($post_url, 'post', $msg_body );
		} catch (FacebookApiException $e) {
		echo $e->getMessage();
	  }
	}else{
	 $loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
	 header('Location: ' . $loginUrl);
	}
	
	//Show sucess message
	if($postResult)
	 {
		 echo '<html><head><title>Message Posted</title><link href="style.css" rel="stylesheet" type="text/css" /></head><body>';
		 echo '<div id="fbpageform" class="pageform" align="center">';
		 echo '<h1>Your message is posted on your facebook wall.</h1>';
		 echo '<a class="button" href="'.$homeurl.'">Back to Main Page</a> <a target="_blank" class="button" href="http://www.facebook.com/'.$userPageId.'">Visit Your Page</a>';
		 echo '</div>';
		 echo '</body></html>';
	 }
}
 
?>
