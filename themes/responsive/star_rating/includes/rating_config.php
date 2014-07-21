<?php
//error_reporting(E_ALL);
$x = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die(mysql_error());
mysql_select_db(DB_NAME,$x);
?>