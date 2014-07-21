<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<?php

$id = '';

$id = $_REQUEST['q'];


require('../../wp-blog-header.php');

mysql_query("UPDATE wpjb_employer SET is_logo = 0 WHERE id = $id") or die(mysql_error());

?>