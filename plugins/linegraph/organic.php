<div class="wrap"><div id="icon-ibpro" class="icon32 icon32-posts-post"></div><h2>Linegraph</h2>
<?php


//Monthly job seekers since launch
//$sql = "SELECT created_at, COUNT(*) as Num FROM wpjb_resume WHERE YEAR(`created_at`)>0000 AND created_at NOT IN(SELECT created_at FROM wpjb_resume WHERE YEAR(`created_at`)=2013 AND MONTH(`created_at`)=07) GROUP BY MONTH(`created_at`) ORDER BY YEAR(`created_at`),MONTH(`created_at`)";
$sql = "SELECT created_at, COUNT(*) as Num FROM wpjb_resume WHERE YEAR(`created_at`)>0000 GROUP BY MONTH(`created_at`) ORDER BY YEAR(`created_at`),MONTH(`created_at`)";
$query = mysql_query($sql);
$res_arr_values = array();
echo "<div style=\"background-color:#e2e2e2;padding:5px 10px 5px;\">Monthly job seekers since launch</div><div style=\"float:left;width:20%;\"><table>";
while($row = mysql_fetch_array($query)){
	$date = new DateTime($row['created_at']);
	echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">".date_format($date, 'm-Y'); echo "</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">".$row['Num']."</td></tr>";
	$res_arr_values[] = $row;		
}
echo "</table></div><div style=\"float:right;\">";
echo "<script type=\"text/javascript\" src=\"https://www.google.com/jsapi\"></script>";
    echo "<script type=\"text/javascript\">";
      echo "google.load(\"visualization\", \"1\", {packages:[\"corechart\"]});";
      echo "google.setOnLoadCallback(drawChart);";
      echo "function drawChart() {";
        echo "var data = google.visualization.arrayToDataTable([";
          echo "['Month', 'Job Seekers'],";
			foreach ($res_arr_values as $arr){			
          echo "['".date("m-y",strtotime($arr[created_at]))."', ".$arr[Num]."],";     
		  }
        echo "]);";

       echo " var options = {";
        echo "};";

        echo "var chart = new google.visualization.LineChart(document.getElementById('chart_div'));";
        echo "chart.draw(data, options);";
      echo "}";
    echo "</script>";
   echo " <div id=\"chart_div\" style=\"width: 900px; height: 500px;\"></div>";

echo "</div>";

//Monthly active resumes since launch
//$sql1 = "SELECT created_at, COUNT(*) as Num FROM wpjb_resume WHERE is_active = 1  AND YEAR(`created_at`)>0000 GROUP BY MONTH(`created_at`) ORDER BY YEAR(`created_at`),MONTH(`created_at`)";
$sql1 = "SELECT created_at, COUNT(*) as Num FROM wpjb_resume WHERE is_active = 1  AND YEAR(`created_at`)>0000 GROUP BY MONTH(`created_at`) ORDER BY YEAR(`created_at`),MONTH(`created_at`)";

$query1 = mysql_query($sql1);
$res_arr_values1 = array();
echo "<div style=\"clear:both;\"></div>";
echo "<div style=\"background-color:#e2e2e2;padding:5px 10px 5px;\">Monthly active resumes since launch</div><div style=\"float:left;width:20%;\"><table>";
while($row1 = mysql_fetch_array($query1)){
	$date = new DateTime($row1['created_at']);
	echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">".date_format($date, 'm-Y'); echo "</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">".$row1['Num']."</td></tr>";
	$res_arr_values1[] = $row1;
}
echo "</table></div><div style=\"float:right;\">";
    echo "<script type=\"text/javascript\">";
      echo "google.load(\"visualization\", \"1\", {packages:[\"corechart\"]});";
      echo "google.setOnLoadCallback(drawChart1);";
      echo "function drawChart1() {";
        echo "var data = google.visualization.arrayToDataTable([";
          echo "['Month', 'Active Resumes'],";
			foreach ($res_arr_values1 as $arr){			
          echo "['".date("m-y",strtotime($arr[created_at]))."', ".$arr[Num]."],";     
		  }
        echo "]);";

       echo " var options = {";
        echo "};";

        echo "var chart = new google.visualization.LineChart(document.getElementById('chart_div1'));";
        echo "chart.draw(data, options);";
      echo "}";
    echo "</script>";
   echo " <div id=\"chart_div1\" style=\"width: 900px; height: 250px;\"></div>";

echo "</div>";


?>

