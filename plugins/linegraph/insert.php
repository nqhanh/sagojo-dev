<div class="wrap"><div id="icon-ibpro" class="icon32 icon32-posts-post"></div><h2>Insert</h2>
<?php 
if (isset($_POST['user']))
$user = $_POST['user'];
if (isset($_POST['code']))
$code = $_POST['code'];
$discount = $_POST['title'];
if ($discount==50) $maxuses =1;
else $maxuses =5;

$expires_at = $_POST['date'];
$type = $_POST['used'];
if ($type==1) $used =1;
else if ($type==2) $used =0;
$emailtitle = $_POST['emailtitle'];
if ($emailtitle=="")
$emailtitle = "[sagojo]Your payment code";
$vemailmes = $_POST['vemailmes'];
$eemailmes = $_POST['eemailmes'];
$signature = "<table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#251E6E'><tr><td width='20px'></td><td width='260px'><img src='http://sagojo.com/wp-content/themes/responsive/core/images/default-logo.png' width='150'></td><td><font color='#FFFFFF' face='Arial' size='5'>plum jobs, rewarding lives</font></td></tr><tr><td width='20px'></td><td colspan='2'><font color='#FFFFFF' face='Arial'>Cung cấp và đấu giá việc làm cho freelancer, người tìm việc và nhà tuyển dụng	| <img src='http://sagojo.com/wp-content/themes/responsive/images/jp.png'> Đến từ Nhật Bản</font></td></tr><tr><td>&nbsp;</td></tr></table>";
$vemailmes .= "<br/><br/>Mã số đăng tin của Quý Công ty là: {$code}<br/>Vui lòng giữ mã số này cẩn thận!";
$eemailmes .= "<br/><br/>Your payment code is: {$code}<br/>Please keep it safe!";
$vemailmes .= "<br/><br/>".$signature."<br/><br/>";
$eemailmes .= "<br/><br/>".$signature;
$emailmes = $vemailmes.$eemailmes;
if(($_POST['user']!='')&&($discount==50||$discount==100||$discount==200)&&($type==1||$type==2))
	$query = "INSERT INTO wpjb_discount(title,code,discount,type,currency,expires_at,is_active,used,max_uses)VALUES('$user','$code','$discount',2,18,'$expires_at',1,'$used','$maxuses')";
if(mysql_query($query)){ 
	echo "inserted";
	$headers = 'From: [sagojo] <postmaster@aline.jp>' . "\r\n";
	add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
	wp_mail($user, $emailtitle, $emailmes, $headers );
} 
else{ 
	echo "fail";
} ?>