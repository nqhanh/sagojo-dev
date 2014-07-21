<div class="wrap"><div id="icon-ibpro" class="icon32 icon32-posts-post"></div><h2>IBPro Rebates Importer</h2>
<?php
/*$db = mysql_connect("localhost", "root", "") or die("Could not connect.");

if(!$db) 

	die("no db");

if(!mysql_select_db("sagojo",$db))

 	die("No database selected.");*/

if(isset($_POST['submit']))
{

	move_uploaded_file($_FILES["filename"]["tmp_name"],"files/" . $_FILES["filename"]["name"]);

    $filename = $_FILES["filename"]["name"];
	 
    $handle = fopen("files/$filename", "r");
	
	mysql_query("TRUNCATE TABLE  `wp_rebates`");

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
     {

		$import="INSERT into  wp_rebates(rank,nickname,amount) values('$data[0]','$data[1]','$data[2]')";

		mysql_query($import) or die(mysql_error());
     }

     fclose($handle);

     print "Import done";

   }

   else

   {
      print "<form enctype='multipart/form-data' action='demo.php' method='POST'>";

      print "Type file name to import:<br>";

      print "<input type='file' name='filename' size='20' width=40><br>";

      print "<input type='submit' name='submit' value='submit'></form>";
   }


?>

