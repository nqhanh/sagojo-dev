<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<?php
$js_id = '';
$j_id = '';
$js_id = $_REQUEST['q'];
$j_id = $_REQUEST['c'];
require('../../wp-blog-header.php');
 
    mysql_query("DELETE FROM wpjb_save WHERE js_id = $js_id AND j_id = $j_id") or die(mysql_error());

?>