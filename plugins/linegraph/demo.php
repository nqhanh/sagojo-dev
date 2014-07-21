<div class="wrap"><div id="icon-ibpro" class="icon32 icon32-posts-post"></div><h2>Daily graph</h2>
<?php

$res_arr_values2 = array();
echo "<div style=\"clear:both;\"></div>";
echo "<div style=\"background-color:#e2e2e2;padding:5px 10px 5px;\">Daily job seekers</div><div style=\"float:left;width:25%;\"><table>";
for ($i=6;$i>=0;$i--) {
$sql3 = "SELECT created_at,COUNT(*) as Num FROM wpjb_resume WHERE DATEDIFF(NOW(),created_at) = $i";
$query3 = mysql_query($sql3);
echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">".date("d/m/Y", time()- 60 * 60 * 24 * $i)."</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">";
while($row3 = mysql_fetch_array($query3)){
	echo $row3['Num']."</td></tr>";
	$res_arr_values2[] = $row3;
}
}
echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">";
echo "</table></div><div style=\"float:right;\">";
    echo "<script type=\"text/javascript\">";
      echo "google.load(\"visualization\", \"1\", {packages:[\"corechart\"]});";
      echo "google.setOnLoadCallback(drawChart2);";
      echo "function drawChart2() {";
        echo "var data = google.visualization.arrayToDataTable([";
          echo "['Month', 'Job Seekers'],";
			foreach ($res_arr_values2 as $arr){			
          echo "['".date("d/m",strtotime($arr[created_at]))."', ".$arr[Num]."],";     
		  }
        echo "]);";

       echo " var options = {";
        echo "};";

        echo "var chart = new google.visualization.LineChart(document.getElementById('chart_div2'));";
        echo "chart.draw(data, options);";
      echo "}";
    echo "</script>";
   echo " <div id=\"chart_div2\" style=\"width: 450px; height: 250px;\"></div>";

echo "</div>";

//Daily active resumes   
$res_arr_values2 = array();
echo "<div style=\"clear:both;\"></div>";
echo "<div style=\"background-color:#e2e2e2;padding:5px 10px 5px;\">Daily active resumes</div><div style=\"float:left;width:25%;\"><table>";
for ($i=6;$i>=0;$i--) {
$sql3 = "SELECT created_at,COUNT(*) as Num FROM wpjb_resume WHERE is_active = 1 AND DATEDIFF(NOW(),updated_at) = $i";
$query3 = mysql_query($sql3);
echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">".date("d/m/Y", time()- 60 * 60 * 24 * $i)."</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">";
while($row3 = mysql_fetch_array($query3)){
	echo $row3['Num']."</td></tr>";
	$res_arr_values2[] = $row3;
}
} 
echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">";
$n=0;
$i=6; 
foreach ($res_arr_values2 as $thing) {
$bigar1[$n][day] = date("d/m", time()- 60 * 60 * 24 * $i);
$bigar1[$n][Num] = $thing[Num]; 
$n++;
$i--;
if ($i==-1) break; 
} 
echo "</table></div><div style=\"float:right;\">";
    echo "<script type=\"text/javascript\">";
      echo "google.load(\"visualization\", \"1\", {packages:[\"corechart\"]});";
      echo "google.setOnLoadCallback(drawChart3);";
      echo "function drawChart3() {";
        echo "var data = google.visualization.arrayToDataTable([";
          echo "['Month', 'Active Resumes'],";
			foreach ($bigar1 as $arr1){			
          echo "['".$arr1[day]."', ".$arr1[Num]."],";     
		  }
        echo "]);";

       echo " var options = {";
        echo "};";

        echo "var chart = new google.visualization.LineChart(document.getElementById('chart_div3'));";
        echo "chart.draw(data, options);";
      echo "}";
    echo "</script>";
   echo " <div id=\"chart_div3\" style=\"width: 450px; height: 250px;\"></div>";
echo "</div>";


?>

