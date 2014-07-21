<?php
if($_GET['do']=="preview"){//if the user wants to preview the page 
echo $HTTP_POST_VARS['message']; 
} 
if($_GET['do']!="submit"){//if the user dosen't want to submit the page 
echo " 
<script> 
function change(do){ 
 if(do=='prevew'){ 
   document.form.action=\"?do=preview\"; 
   document.form.submit(); 
 } 
 else{ 
      document.form.action=\"?do=submit\"; 
      document.form.submit(); 
 } 
} 
</script>"; 
echo "<form action=\"post\" name=\"form\>"; 
echo "<textarea> $HTTP_POST_VARS[message]</textarea>"; 
echo "<input type=\"button\" value=\"submit\" onclick=\"change('sub')\">"; 
echo "<input type=\"button\" value=\"preview\" onclick=\"change('preview)"; 
} 
if($_GET['do']=="submit"){ 
mysql_query("insert into.................") or die(mysql_error()); 
}
?>