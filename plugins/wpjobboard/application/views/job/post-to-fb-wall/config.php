<?php
include_once(ABSPATH."/wp-content/plugins/wpjobboard/application/views/job/post-to-fb-wall/inc/facebook.php"); //include facebook SDK
 
######### edit details ##########
$appId = '168344050008950'; //Facebook App ID
$appSecret = '0a78b84723f9c7ab08702084ad163034'; // Facebook App Secret
$return_url = site_url().'/wp-content/plugins/wpjobboard/application/views/job/post-to-fb-wall/process.php';  //return url (url to script)
$homeurl = site_url().'/wp-content/plugins/wpjobboard/application/views/job/post-to-fb-wall/';  //return to home
$fbPermissions = 'publish_stream,manage_pages';  //Required facebook permissions
##################################

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret,
  'fileUpload' => true
));

$fbuser = $facebook->getUser();
?>