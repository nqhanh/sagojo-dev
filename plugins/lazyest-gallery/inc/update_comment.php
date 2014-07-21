<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<?php
$Id = '';
$str = '';
$Id = $_REQUEST['q'];
$str = $_REQUEST['c'];
require('../../../../wp-blog-header.php');
 
    mysql_query("UPDATE wp_kaisha_camera SET comment='$str' WHERE image='$Id'") or die(mysql_error());

?>