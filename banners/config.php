<?php
include_once($_SERVER['DOCUMENT_ROOT']."/facebook.php"); //include facebook SDK
 
######### edit details ##########
$appId = '1450318551863189'; //Facebook App ID
$appSecret = 'd8ffbbd07a4cf0e56968c318be71c3d5'; // Facebook App Secret
$fbPermissions = 'publish_stream,manage_pages';  //Required facebook permissions
##################################

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret,
  'fileUpload' => true
));

$fbuser = $facebook->getUser();
//Return current URL
function curPageURL() {
 $pageURL = 'http';
 //if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 /*if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }*/
 //$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 $pageURL = "http://www.sagojo.com".$_SERVER["REQUEST_URI"];
 return $pageURL;
}
?>