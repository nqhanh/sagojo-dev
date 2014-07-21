<?php
$filename = $_POST['filename'];
$path = $_SERVER['DOCUMENT_ROOT'].'/wordpress_op2/'.$_POST['directory'];
if(file_exists($path."/".$filename)) { 
 unlink($path."/".$filename); //delete file
 echo "File deleted!";
}
?>