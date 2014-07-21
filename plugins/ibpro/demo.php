<div class="wrap"><div id="icon-ibpro" class="icon32 icon32-posts-post"></div><h2>IBPro Rebates Importer</h2>
<?php

if(isset($_POST['submit']))
{
	if($_FILES['filename']['error']>0){
		echo "<h1>Error: No file selected! Nothing to import.</h1>";
		?>
		<table class="wp-list-table widefat fixed posts" cellspacing="0">
		<thead><tr>
		<th class scope="col" style="">Rank</th>
		<th class scope="col" style="">Nickname</th>
		<th class scope="col" style="">Amount</th>
		</tr></thead>
		<tfoot><tr>
		<th class scope="col" style="">Rank</th>
		<th class scope="col" style="">Nickname</th>
		<th class scope="col" style="">Amount</th>
		</tr></tfoot>
	<tbody>
	<?php
	for ($i=0; $i<10;$i++) {
		echo "<tr><td class='post-title page-title column-title'>&nbsp;</td><td class='post-title page-title column-title'>&nbsp;</td><td class='post-title page-title column-title'>&nbsp;</td></tr>";
	}
	?>
	</tbody></table>
		<?php
	}
	else {
	move_uploaded_file($_FILES["filename"]["tmp_name"],WP_PLUGIN_DIR. "/ibpro/files/" . $_FILES["filename"]["name"]);

    $filename = $_FILES["filename"]["name"];
	 
    $handle = fopen(WP_PLUGIN_DIR. "/ibpro/files/$filename", "r");
	
	mysql_query("TRUNCATE TABLE  `wp_rebates`");

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
     {

		$import="INSERT into  wp_rebates(rank,nickname,amount) values('$data[0]','$data[1]','$data[2]')";

		mysql_query($import) or die(mysql_error());
     }

     fclose($handle);

     print "<strong>Import done!</strong><br><br>";
	 global $wpdb;
	$rebates = $wpdb->get_results ("SELECT * FROM wp_rebates");
	?>
	<table class="wp-list-table widefat fixed posts" cellspacing="0">
		<thead><tr>
		<th class scope="col" style="">Rank</th>
		<th class scope="col" style="">Nickname</th>
		<th class scope="col" style="">Amount</th>
		</tr></thead>
		<tfoot><tr>
		<th class scope="col" style="">Rank</th>
		<th class scope="col" style="">Nickname</th>
		<th class scope="col" style="">Amount</th>
		</tr></tfoot>
	<tbody>
<?php	
	foreach ($rebates as $key => $row) {
		$rank = $row->rank;
		$nick = $row->nickname;
		$amount = $row->amount;
		echo "<tr><td class='post-title page-title column-title'>$rank</td><td class='post-title page-title column-title'>$nick</td><td class='post-title page-title column-title'>$amount</td></tr>";
		
	}
	echo "</tbody></table>";

   }
}
   else

   {
	  print "<div style='float:left;clear:both;'><img src='".WP_PLUGIN_URL."/ibpro/images/csv.png'></div>";
	  print "<b>Import from your own CSV file</b><br>";
	  print "This is the best option for users who wish to Import rebates from their database.<br><br>";
      print "If you need to do the top rebates import, you can do that from IBPro Import panel. Select Rebates Import, select file from your computer and click Import.<br>Your CSV file should follow scheme below, otherwise import won’t work.<br><br>";
	  
	  print "1, Paul Walker, 100<br>";
	  
	  print "2, Steve Job, 99<br>";
	  
	  print "...<br><br><br>";
	  
	  print "<form enctype='multipart/form-data' action='?page=wp_ibpro_import' method='POST'>";

      print "Select file to import:<br>";

      print "<input type='file' name='filename' size='20' width=40>&nbsp;&nbsp;&nbsp;";

      print "<input type='submit' name='submit' class ='button button-primary' value='Import'></form>";
   }


?>

