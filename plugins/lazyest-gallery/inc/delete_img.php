<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<?php
$Id = '';
$fld = '';
$Id = $_REQUEST['q'];
$fld = $_REQUEST['c'];
require('../../../../wp-blog-header.php');

	
	$img_dir = $_SERVER['DOCUMENT_ROOT'].'/wordpress_op2/wp-content/uploads/KaishaCameraImage/'.$fld.'/';
	$img_thmb = $_SERVER['DOCUMENT_ROOT'].'/wordpress_op2/wp-content/uploads/KaishaCameraImage/'.$fld.'/slides/';// if you had thumbnails

	$image_name = $Id;//assume that this is the image_name field from your database

	//unlink function return bool so you can use it as conditon
	if(unlink($img_dir.$image_name) && unlink($img_thmb.$image_name)){
		//assume that variable $image_id is queried from the database where your image record your about to delete is...
		mysql_query("DELETE FROM wp_kaisha_camera WHERE image = '$image_name'") or die(mysql_error());
		
	}else{
	   echo 'ERROR: unable to delete image file!';
	}
 

?>