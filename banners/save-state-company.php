<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<?php


$id = $_POST['id'];

$bg = "#".$_POST['bg'];

$ct = "#".$_POST['ct'];

$op = $_POST['op'];
if ($op=="NaN") $op = "1";

$img = $_POST['img'];

$txt = "#".$_POST['txtcl'];

$lnk = "#".$_POST['lnk'];

$tmp = $_POST['tmp'];


require('../../wp-blog-header.php');

	//mysql_query("UPDATE wpjb_resume SET bg_color = '$bg', ctn_color = '$ct', bg_opacity = '$op', bg_image = '$img' WHERE id = $id") or die(mysql_error());
	mysql_query("UPDATE wpjb_employer SET bg_color = '$bg', ctn_color = '$ct', bg_opacity = '$op', bg_image = '$img', txtcolor = '$txt', link_color = '$lnk', template = '$tmp'  WHERE id = $id") or die(mysql_error());

?>