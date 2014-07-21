<div class="wrap"><div id="icon-ibpro" class="icon32 icon32-posts-post"></div><h2>Organic graph</h2>
<?php

//Monthly organic job posting since launch
echo "<div style=\"clear:both;\"></div>";
$sql = "SELECT job_created_at, COUNT(*) as Num FROM wpjb_job WHERE YEAR(`job_created_at`)>0000 AND job_created_at NOT IN(SELECT job_created_at FROM wpjb_job WHERE YEAR(`job_created_at`)=2013 AND MONTH(`job_created_at`)=07)  AND employer_id <> 'NULL' GROUP BY MONTH(`job_created_at`) ORDER BY YEAR(`job_created_at`),MONTH(`job_created_at`)";
$query = mysql_query($sql);
$res_arr_values = array();

$sql1 = "SELECT applied_at, COUNT(*) as Num FROM wpjb_application WHERE YEAR(`applied_at`)>0000 AND applied_at NOT IN(SELECT applied_at FROM wpjb_application WHERE YEAR(`applied_at`)=2013 AND MONTH(`applied_at`)=07) GROUP BY MONTH(`applied_at`) ORDER BY YEAR(`applied_at`),MONTH(`applied_at`)";
$query1 = mysql_query($sql1);
$res_arr_values1 = array();

echo "<div style=\"background-color:#e2e2e2;padding:5px 10px 5px;\">Monthly organic job posting since launch / Monthly organic apply since launch</div><div style=\"float:left;width:10%;\"><table>";
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
echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">Month</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">Jobs</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">Applications</td></tr>";
foreach ($bigar as $arr){
	$date = new DateTime($arr[job_created_at]);
	echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">".date_format($date, 'm/Y'); echo "</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">".$arr[Num]."</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">".$arr[Num1]."</td></tr>";
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

echo "var chart = new google.visualization.AreaChart(document.getElementById('chart_div4'));";
echo "chart.draw(data, options);";
echo "}";
echo "</script>";
echo " <div id=\"chart_div4\" style=\"width: 900px; height: 500px;\"></div>";

echo "</div>";

//Daily organic job posting
$res_arr_values2 = array();
echo "<div style=\"clear:both;\"></div>";
echo "<div style=\"background-color:#e2e2e2;padding:5px 10px 5px;\">Daily organic job posting / Daily organic apply</div><div style=\"float:left;width:10%;\"><table>";
for ($i=15;$i>=0;$i--) {
	$sqlj3 = "SELECT job_created_at,COUNT(*) as Num FROM wpjb_job WHERE DATEDIFF(NOW(),job_created_at) = $i AND employer_id <> 'NULL' ";
	$queryj3 = mysql_query($sqlj3);
	while($rowj3 = mysql_fetch_array($queryj3)){
		$res_arr_values2[] = $rowj3;
	}
}

$res_arr_values3 = array();
for ($i=15;$i>=0;$i--) {
	$sqla3 = "SELECT applied_at,COUNT(*) as Num FROM wpjb_application WHERE DATEDIFF(NOW(),applied_at) = $i ";
	$querya3 = mysql_query($sqla3);
	while($rowa3 = mysql_fetch_array($querya3)){
		$res_arr_values3[] = $rowa3;
	}
}

$n=0;
foreach ($res_arr_values2 as $thing) {
	$bigar[$n][job_created_at] = $thing[job_created_at];
	$bigar[$n][Num] = $thing[Num];
	$n++;
}
$n=0;
$i=15;
foreach ($res_arr_values3 as $thing) {
	$bigar[$n][day] = date("d/m", time()- 60 * 60 * 24 * $i);
	$bigar[$n][Num1] = $thing[Num];
	$n++;
	$i--;
	if ($i==-1) break;
}
echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">Day</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">Jobs</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">Applications</td></tr>";
$i=15;
foreach ($bigar as $arr){
	echo "<tr><td style=\"border:1px solid #fff;background-color:#e2e2e2;\">".date("d/m/Y", time()- 60 * 60 * 24 * $i); echo "</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">".$arr[Num]."</td><td style=\"border:1px solid #fff;background-color:#e2e2e2;text-align:right;\">".$arr[Num1]."</td></tr>";
	$i--;
	if ($i==-1) break;
}
echo "</table></div><div style=\"float:right;\">";
echo "<script type=\"text/javascript\">";
echo "google.load(\"visualization\", \"1\", {packages:[\"corechart\"]});";
echo "google.setOnLoadCallback(drawChart5);";
echo "function drawChart5() {";
echo "var data = google.visualization.arrayToDataTable([";
echo "['Month', 'Job posting','Application'],";
$i=15;
foreach ($bigar as $arr){
	echo "['".$arr[day]."', ".$arr[Num].", ".$arr[Num1]."],";
	$i--;
	if ($i==-1) break;
}
echo "]);";

echo " var options = {";
echo "};";

echo "var chart = new google.visualization.AreaChart(document.getElementById('chart_div5'));";
echo "chart.draw(data, options);";
echo "}";
echo "</script>";
echo " <div id=\"chart_div5\" style=\"width: 900px; height: 250px;\"></div>";

echo "</div>";


?>

