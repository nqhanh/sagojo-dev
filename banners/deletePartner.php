<?php
$user = $_POST['user'];
require('../../wp-blog-header.php');
 
    mysql_query("DELETE FROM wp_newsletter WHERE sex = '$user'") or die(mysql_error());

?>