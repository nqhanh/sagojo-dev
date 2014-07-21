<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<?php
$js_id = '';
$j_id = '';
$js_id = $_REQUEST['q'];
$j_id = $_REQUEST['c'];
require('../../../../../wp-blog-header.php');
 
    mysql_query("INSERT INTO wpjb_save ( `js_id` , `j_id`) VALUES ( $js_id, $j_id) ") or die(mysql_error());

?>