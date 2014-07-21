<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<?php
$Id = '';
$str = '';
$Id = $_REQUEST['q'];
$str = $_REQUEST['c'];
require('../../../wp-blog-header.php');
 
    mysql_query("UPDATE wp_usermeta SET 'meta_value'='$str' WHERE 'user_id'='$Id' AND 'meta_key'='rich_editing'") or die(mysql_error());
	//update_user_meta($Id, 'rich_editing', $str);

?>