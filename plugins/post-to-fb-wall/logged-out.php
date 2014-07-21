<?php
$redirect_url = $_SERVER['HTTP_REFERER'];
include_once($_SERVER['DOCUMENT_ROOT']."/wp-content/plugins/post-to-fb-wall/config.php");
$facebook->destroySession();
?>
<?php

   header( 'Location:'.$redirect_url ) ;

?>