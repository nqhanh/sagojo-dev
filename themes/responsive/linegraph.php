<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Content/Sidebar Template
 *
   Template Name:  Linegraph
 *
 * @file           linegraph.php
 * @package        Responsive 
 * @author         hanhdo 
 * @copyright      2014
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/linegraph.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

get_header(); ?>

<div id="content" class="grid col-620 ">
<?php $userlevel = get_user_meta(wp_get_current_user()->ID, "wp_user_level",trues); //set permission
		if ($userlevel > 0): ?>
<?php 
//Monthly job seekers since launch
$sql = "SELECT created_at, COUNT(*) as Num FROM wpjb_resume WHERE YEAR(`created_at`)>0000 AND created_at NOT IN(SELECT created_at FROM wpjb_resume WHERE YEAR(`created_at`)=2013 AND MONTH(`created_at`)=07) GROUP BY MONTH(`created_at`) ORDER BY YEAR(`created_at`),MONTH(`created_at`)";

$query = mysql_query($sql);
$res_arr_values = array();
echo "<div style=\"background-color:#e2e2e2;padding:5px 10px 5px;\">Monthly job seekers since launch</div><div style=\"float:left;width:25%;\"><table>";
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
   echo " <div id=\"chart_div\" style=\"width: 450px; height: 260px;\"></div>";

echo "</div>";

//Monthly active resumes since launch
$sql1 = "SELECT created_at, COUNT(*) as Num FROM wpjb_resume WHERE is_active = 1  AND YEAR(`created_at`)>0000 GROUP BY MONTH(`created_at`) ORDER BY YEAR(`created_at`),MONTH(`created_at`)";
$query1 = mysql_query($sql1);
$res_arr_values1 = array();
echo "<div style=\"clear:both;\"></div>";
echo "<div style=\"background-color:#e2e2e2;padding:5px 10px 5px;\">Monthly active resumes since launch</div><div style=\"float:left;width:25%;\"><table>";
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
   echo " <div id=\"chart_div1\" style=\"width: 450px; height: 250px;\"></div>";

echo "</div>";

//Daily job seekers 
$res_arr_values2 = array();
echo "<div style=\"clear:both;\"></div>";
echo "<div style=\"background-color:#e2e2e2;padding:5px 10px 5px;\">Daily job seekers</div><div style=\"float:left;width:25%;\"><table>";
for ($i=6;$i>0;$i--) {
$sql3 = "SELECT created_at,COUNT(*) as Num FROM wpjb_resume WHERE DATE(`created_at`) = DATE(SUBDATE(NOW(),$i)) AND YEAR(`created_at`)>0000 ORDER BY YEAR(`created_at`),MONTH(`created_at`)";
$query3 = mysql_query($sql3);
echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">".date("d/m/Y", time()- 60 * 60 * 24 * $i)."</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">";
while($row3 = mysql_fetch_array($query3)){
	echo $row3['Num']."</td></tr>";
	$res_arr_values2[] = $row3;
}
}
echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">";
$sql2 = "SELECT created_at,COUNT(*) as Num FROM wpjb_resume WHERE DATE(`created_at`) = DATE(NOW()) AND YEAR(`created_at`)>0000 ORDER BY YEAR(`created_at`),MONTH(`created_at`)";
$query2 = mysql_query($sql2);
echo date("d/m/Y", time())."</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">";
while($row2 = mysql_fetch_array($query2)){
	echo $row2['Num']."</td></tr>";
	$res_arr_values2[] = $row2;
}
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
for ($i=6;$i>0;$i--) {
$sql3 = "SELECT created_at,COUNT(*) as Num FROM wpjb_resume WHERE is_active = 1 AND DATE(`updated_at`) = DATE(SUBDATE(NOW(),$i)) AND YEAR(`created_at`)>0000 ORDER BY YEAR(`created_at`),MONTH(`created_at`)";
$query3 = mysql_query($sql3);
echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">".date("d/m/Y", time()- 60 * 60 * 24 * $i)."</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">";
while($row3 = mysql_fetch_array($query3)){
	echo $row3['Num']."</td></tr>";
	$res_arr_values2[] = $row3;
}
} 
echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">";
$sql2 = "SELECT created_at,COUNT(*) as Num FROM wpjb_resume WHERE is_active = 1 AND DATE(`updated_at`) = DATE(NOW()) AND YEAR(`created_at`)>0000 ORDER BY YEAR(`created_at`),MONTH(`created_at`)";
$query2 = mysql_query($sql2);
echo date("d/m/Y", time())."</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">";
while($row2 = mysql_fetch_array($query2)){
	echo $row2['Num']."</td></tr>";
	$res_arr_values2[] = $row2;
}
$n=0;
$i=6; 
foreach ($res_arr_values2 as $thing) {
$bigar1[$n][day] = date("d/m", time()- 60 * 60 * 24 * $i);
$bigar1[$n][Num] = $thing[Num]; 
$n++;
$i--; 
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

//Monthly organic job posting since launch
echo "<div style=\"clear:both;\"></div>";
$sql = "SELECT job_created_at, COUNT(*) as Num FROM wpjb_job WHERE YEAR(`job_created_at`)>0000 AND job_created_at NOT IN(SELECT job_created_at FROM wpjb_job WHERE YEAR(`job_created_at`)=2013 AND MONTH(`job_created_at`)=07)  AND employer_id <> 'NULL' GROUP BY MONTH(`job_created_at`) ORDER BY YEAR(`job_created_at`),MONTH(`job_created_at`)";
$query = mysql_query($sql);
$res_arr_values = array();

$sql1 = "SELECT applied_at, COUNT(*) as Num FROM wpjb_application WHERE YEAR(`applied_at`)>0000 AND applied_at NOT IN(SELECT applied_at FROM wpjb_application WHERE YEAR(`applied_at`)=2013 AND MONTH(`applied_at`)=07) GROUP BY MONTH(`applied_at`) ORDER BY YEAR(`applied_at`),MONTH(`applied_at`)";
$query1 = mysql_query($sql1);
$res_arr_values1 = array();

echo "<div style=\"background-color:#e2e2e2;padding:5px 10px 5px;\">Monthly Organic job posting/Applied since launch</div><div style=\"float:left;width:25%;\"><table>";
while($row = mysql_fetch_array($query)){
	$res_arr_values[] = $row;		
}

while($row1 = mysql_fetch_array($query1)){
	$res_arr_values1[] = $row1;		
}
$n=0; 
foreach ($res_arr_values as $thing) { 
$bigar[$n][job_created_at] = $thing[job_created_at]; 
$bigar[$n][Num] = $thing[Num];
$n++; 
} 
$n=0; 
foreach ($res_arr_values1 as $thing) { 
$bigar[$n][Num1] = $thing[Num]; 
$n++; 
} 
echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">Month</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">J...</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">A...</td></tr>";		
foreach ($bigar as $arr){
		$date = new DateTime($arr[job_created_at]);
		echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">".date_format($date, 'm-Y'); echo "</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">".$arr[Num]."</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">".$arr[Num1]."</td></tr>";		
			}
echo "</table></div><div style=\"float:right;\">";
echo "<script type=\"text/javascript\" src=\"https://www.google.com/jsapi\"></script>";
    echo "<script type=\"text/javascript\">";
      echo "google.load(\"visualization\", \"1\", {packages:[\"corechart\"]});";
      echo "google.setOnLoadCallback(drawChart4);";
      echo "function drawChart4() {";
        echo "var data = google.visualization.arrayToDataTable([";
          echo "['Month', 'Job posting', 'Application'],";
			foreach ($bigar as $arr){	
				echo "['".date("m-y",strtotime($arr[job_created_at]))."', ".$arr[Num].", ".$arr[Num1]."],";     
			}
        echo "]);";

       echo " var options = {";
        echo "};";

        echo "var chart = new google.visualization.LineChart(document.getElementById('chart_div4'));";
        echo "chart.draw(data, options);";
      echo "}";
    echo "</script>";
   echo " <div id=\"chart_div4\" style=\"width: 450px; height: 260px;\"></div>";

echo "</div>";

//Daily organic job posting  
$res_arr_values2 = array();
echo "<div style=\"clear:both;\"></div>";
echo "<div style=\"background-color:#e2e2e2;padding:5px 10px 5px;\">Daily Organic job posting/Applied</div><div style=\"float:left;width:25%;\"><table>";
for ($i=6;$i>0;$i--) {
$sql3 = "SELECT job_created_at,COUNT(*) as Num FROM wpjb_job WHERE DATE(`job_created_at`) = DATE(SUBDATE(NOW(),$i)) AND YEAR(`job_created_at`)>0000 AND employer_id <> 'NULL' ORDER BY YEAR(`job_created_at`),MONTH(`job_created_at`)";
$query3 = mysql_query($sql3);
while($row3 = mysql_fetch_array($query3)){
	$res_arr_values2[] = $row3;
}
}

$res_arr_values3 = array();
for ($i=6;$i>0;$i--) {
$sql3 = "SELECT applied_at,COUNT(*) as Num FROM wpjb_application WHERE DATE(`applied_at`) = DATE(SUBDATE(NOW(),$i)) AND YEAR(`applied_at`)>0000 ORDER BY YEAR(`applied_at`),MONTH(`applied_at`)";
$query3 = mysql_query($sql3);
while($row3 = mysql_fetch_array($query3)){
	$res_arr_values3[] = $row3;
}
}
$sql2 = "SELECT job_created_at,COUNT(*) as Num FROM wpjb_job WHERE DATE(`job_created_at`) = DATE(NOW()) AND YEAR(`job_created_at`)>0000 AND employer_id <> 'NULL' ORDER BY YEAR(`job_created_at`),MONTH(`job_created_at`)";
$query2 = mysql_query($sql2);
while($row2 = mysql_fetch_array($query2)){
	$res_arr_values2[] = $row2;
}
$sql2 = "SELECT applied_at,COUNT(*) as Num FROM wpjb_application WHERE DATE(`applied_at`) = DATE(NOW()) AND YEAR(`applied_at`)>0000 ORDER BY YEAR(`applied_at`),MONTH(`applied_at`)";
$query2 = mysql_query($sql2);
while($row2 = mysql_fetch_array($query2)){
	$res_arr_values3[] = $row2;
}
$n=0; 
foreach ($res_arr_values2 as $thing) { 
$bigar[$n][job_created_at] = $thing[job_created_at]; 
$bigar[$n][Num] = $thing[Num]; 
$n++; 
} 
$n=0;
$i=6; 
foreach ($res_arr_values3 as $thing) {
$bigar[$n][day] = date("d/m", time()- 60 * 60 * 24 * $i);
$bigar[$n][Num1] = $thing[Num]; 
$n++;
$i--; 
} 
echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">Day</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">J...</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">A...</td></tr>";		
$i=6;
foreach ($bigar as $arr){	
		echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">".date("d/m/Y", time()- 60 * 60 * 24 * $i); echo "</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">".$arr[Num]."</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">".$arr[Num1]."</td></tr>";		
			$i--;
			}
echo "</table></div><div style=\"float:right;\">";
    echo "<script type=\"text/javascript\">";
      echo "google.load(\"visualization\", \"1\", {packages:[\"corechart\"]});";
      echo "google.setOnLoadCallback(drawChart5);";
      echo "function drawChart5() {";
        echo "var data = google.visualization.arrayToDataTable([";
          echo "['Month', 'Job posting','Application'],";
			foreach ($bigar as $arr){	
				echo "['".$arr[day]."', ".$arr[Num].", ".$arr[Num1]."],";     
			}    		  
        echo "]);";

       echo " var options = {";
        echo "};";

        echo "var chart = new google.visualization.LineChart(document.getElementById('chart_div5'));";
        echo "chart.draw(data, options);";
      echo "}";
    echo "</script>";
   echo " <div id=\"chart_div5\" style=\"width: 450px; height: 250px;\"></div>";

echo "</div>";

//Monthly applied since launch - for backup
/*echo "<div style=\"clear:both;\"></div>";
$sql = "SELECT applied_at, COUNT(*) as Num FROM wpjb_application WHERE YEAR(`applied_at`)>0000 AND applied_at NOT IN(SELECT applied_at FROM wpjb_application WHERE YEAR(`applied_at`)=2013 AND MONTH(`applied_at`)=07) GROUP BY MONTH(`applied_at`) ORDER BY YEAR(`applied_at`),MONTH(`applied_at`)";
$query = mysql_query($sql);
$res_arr_values = array();
echo "<div style=\"background-color:#e2e2e2;padding:5px 10px 5px;\">Monthly applied since launch</div><div style=\"float:left;width:25%;\"><table>";
while($row = mysql_fetch_array($query)){
	$date = new DateTime($row['applied_at']);
	echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">".date_format($date, 'm-Y'); echo "</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">".$row['Num']."</td></tr>";
	$res_arr_values[] = $row;		
}
echo "</table></div><div style=\"float:right;\">";
echo "<script type=\"text/javascript\" src=\"https://www.google.com/jsapi\"></script>";
    echo "<script type=\"text/javascript\">";
      echo "google.load(\"visualization\", \"1\", {packages:[\"corechart\"]});";
      echo "google.setOnLoadCallback(drawChart6);";
      echo "function drawChart6() {";
        echo "var data = google.visualization.arrayToDataTable([";
          echo "['Month', 'Application'],";
			foreach ($res_arr_values as $arr){			
          echo "['".$arr[applied_at]."', ".$arr[Num]."],";     
		  }
        echo "]);";

       echo " var options = {";
        echo "};";

        echo "var chart = new google.visualization.LineChart(document.getElementById('chart_div6'));";
        echo "chart.draw(data, options);";
      echo "}";
    echo "</script>";
   echo " <div id=\"chart_div6\" style=\"width: 450px; height: 260px;\"></div>";

echo "</div>";*/

//Daily applied
/*$res_arr_values2 = array();
echo "<div style=\"clear:both;\"></div>";
echo "<div style=\"background-color:#e2e2e2;padding:5px 10px 5px;\">Daily applied</div><div style=\"float:left;width:25%;\"><table>";
for ($i=6;$i>0;$i--) {
$sql3 = "SELECT applied_at,COUNT(*) as Num FROM wpjb_application WHERE DATE(`applied_at`) = DATE(SUBDATE(NOW(),$i)) AND YEAR(`applied_at`)>0000 ORDER BY YEAR(`applied_at`),MONTH(`applied_at`)";
$query3 = mysql_query($sql3);
echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">".date("d/m/Y", time()- 60 * 60 * 24 * $i)."</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">";
while($row3 = mysql_fetch_array($query3)){
	echo $row3['Num']."</td></tr>";
	$res_arr_values2[] = $row3;
}
}
echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">";
$sql2 = "SELECT applied_at,COUNT(*) as Num FROM wpjb_application WHERE DATE(`applied_at`) = DATE(NOW()) AND YEAR(`applied_at`)>0000 ORDER BY YEAR(`applied_at`),MONTH(`applied_at`)";
$query2 = mysql_query($sql2);
echo date("d/m/Y", time())."</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">";
while($row2 = mysql_fetch_array($query2)){
	echo $row2['Num']."</td></tr>";
	$res_arr_values2[] = $row2;
}
echo "</table></div><div style=\"float:right;\">";
    echo "<script type=\"text/javascript\">";
      echo "google.load(\"visualization\", \"1\", {packages:[\"corechart\"]});";
      echo "google.setOnLoadCallback(drawChart7);";
      echo "function drawChart7() {";
        echo "var data = google.visualization.arrayToDataTable([";
          echo "['Month', 'Application'],";
			foreach ($res_arr_values2 as $arr){			
          echo "['".$arr[applied_at]."', ".$arr[Num]."],";     
		  }
        echo "]);";

       echo " var options = {";
        echo "};";

        echo "var chart = new google.visualization.LineChart(document.getElementById('chart_div7'));";
        echo "chart.draw(data, options);";
      echo "}";
    echo "</script>";
   echo " <div id=\"chart_div7\" style=\"width: 450px; height: 250px;\"></div>";

echo "</div>";*/
   ?>
   <?php endif; ?>     
</div><!-- end of #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php /*$meta_value = "dating";
	$meta_key = "1";
	$user_ids = get_users('role=subscriber');
	foreach($user_ids as $user_id){
		add_user_meta( $user_id->ID, $meta_value, $meta_key );
	}*/?>
