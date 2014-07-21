<style>
.pagination {
		clear:both;
		padding:20px 0 30px 0;
		position:relative;
		font-size:15px;
		line-height:13px;
		margin:auto;
		text-align:center;
	}
		 
	.pagination span, .pagination a {
		display:inline-block;
		margin: 2px;
		padding:3px 5px 3px 5px;
		text-decoration:none;
		width:auto;
		color:#0066cc;
		border: 1px solid #e2e2e2;
		/*background:#fc0;*/
	}
		 
	.pagination a:hover{
		color:#fff;
		background: #f15a24;
	}
		 
	.pagination .current{
		padding:3px 5px 3px 5px;
		background: #f15a24;
		color: #fff;
	}


</style>
<div class="wrap"><div id="icon-ibpro" class="icon32 icon32-posts-post"></div><h2>Job view for last 30 days</h2>
<table class="wp-list-table widefat fixed posts" cellspacing="0">
<thead><tr>
<th class scope="col" style="">User</th>
<th class scope="col" style="">Job title</th>
<th class scope="col" style="">Is Apply</th>
<th class scope="col" style="">Date</th>

</tr></thead>
<tfoot><tr>
<th class scope="col" style="">User</th>
<th class scope="col" style="">Job title</th>
<th class scope="col" style="">Is Apply</th>
<th class scope="col" style="">Date</th>
</tr></tfoot>
<tbody>
<?php

require(ABSPATH .'/wp-blog-header.php');
if(!isset($_GET['trang'])){  
$page = 1;  
} else {  
$page = $_GET['trang']; 
}
$max_results = 20;  
$from = (($page * $max_results) - $max_results);
$sql = "SELECT job_title,Date,display_name,isApply,JS_ID
FROM wpjb_viewed
JOIN wpjb_job ON wpjb_viewed.j_id = wpjb_job.id
JOIN wp_users ON wpjb_viewed.js_id = wp_users.ID
ORDER BY wpjb_viewed.Date DESC  LIMIT $from, $max_results";
$query = mysql_query($sql) or die(mysql_error());;
if(is_resource($query))
{
	while($data = mysql_fetch_array($query)){
		if ($data['isApply']==0) $apply="No"; else $apply="Yes";
		$moderator = "<tr class='alternate'>";
		$moderator .= "<td class='post-title page-title column-title''><br><label>".$data['display_name']."</label></td>";
		$moderator .= "<td class='post-title page-title column-title'><br><label>".$data['job_title']."</label></td>";
		$moderator .= "<td class='post-title page-title column-title'><br><label>".$apply."</label></td>";
		$moderator .= "<td class='post-title page-title column-title'><br><label>".$data['Date']."</label></td></tr>";
		echo $moderator;

		
	}
}

?>
</tbody></table>
</div>
<?php
//Pagination
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wpjb_viewed"),0);
global $wpdb;  
$rows = $wpdb->get_results("SELECT JS_ID,isApply FROM wpjb_viewed");
$staff=0;
$visitor=0;
$isApp=0;
foreach ($rows as $row){
	$level = get_user_meta( $row->JS_ID, 'wp_user_level', true );
	if ($level>0||$count==4) $staff++;
	else {
		$visitor++;
		if ($row->isApply==1) $isApp++;
	}
}
$total_pages = ceil($total_results / $max_results);  

if(!isset($_GET['trang'])){  
$page = 1;  
} else {  
$page = $_GET['trang'];
}
$args = array(
'base'         => @add_query_arg('trang','%#%'),
'format'       => '&trang=%#%',
'total'        => $total_pages,
'current'      => $page,
'show_all'     => False,
'end_size'     => 1,
'mid_size'     => 2,
'prev_next'    => True,
'prev_text'    => __('Previous'),
'next_text'    => __('Next'),
'type'         => 'plain');

// ECHO THE PAGENATION 
echo '<div class="pagination">';
echo paginate_links( $args );
echo '</div><!--// end .pagination -->';
//mysql_query("DELETE FROM wpjb_discount") or die(mysql_error());
mysql_query("DELETE FROM wpjb_viewed WHERE DATEDIFF(NOW(),Date) > 30") or die(mysql_error());
//insert new column to exist table

/*resume-page
mysql_query("ALTER TABLE `wpjb_employer` ADD bg_color varchar(7) NOT NULL DEFAULT '#FFFFFF' AFTER `geo_longitude` ");
mysql_query("ALTER TABLE `wpjb_employer` ADD bg_image varchar(250) NOT NULL DEFAULT '0' AFTER `bg_color` ");
mysql_query("ALTER TABLE `wpjb_employer` ADD ctn_color varchar(7) NOT NULL DEFAULT '#FFFFFF' AFTER `bg_image` ");
mysql_query("ALTER TABLE `wpjb_employer` ADD bg_opacity varchar(3) NOT NULL DEFAULT '0.8' AFTER `ctn_color` ");
mysql_query("ALTER TABLE `wpjb_employer` ADD txtcolor varchar(7) NOT NULL DEFAULT '#333333' AFTER `bg_opacity` ");
mysql_query("ALTER TABLE `wpjb_employer` ADD link_color varchar(7) NOT NULL DEFAULT '#07A1CD' AFTER `txtcolor` ");
mysql_query("ALTER TABLE `wpjb_employer` ADD customcss text NOT NULL AFTER `link_color` ");
mysql_query("ALTER TABLE `wpjb_employer` ADD template tinyint(1) NOT NULL AFTER `customcss` ");
mysql_query("ALTER TABLE `wpjb_employer` ADD stylecv tinyint(1) NOT NULL AFTER `template` ");
mysql_query("ALTER TABLE `wpjb_employer` ADD why_us text NOT NULL AFTER `company_info` ");
mysql_query("ALTER TABLE `wpjb_resume` ADD skills text NOT NULL AFTER `education` ");*/
/*coupon page
mysql_query("ALTER TABLE `wpjb_listing` ADD f_visible smallint(5) UNSIGNED NOT NULL AFTER `visible`");
mysql_query("ALTER TABLE `wpjb_listing` ADD is_new tinyint(1) UNSIGNED NOT NULL AFTER `is_featured`");
mysql_query("ALTER TABLE `wpjb_listing` ADD is_hot tinyint(1) UNSIGNED NOT NULL AFTER `is_new`");
mysql_query("ALTER TABLE `wpjb_listing` ADD is_top tinyint(1) UNSIGNED NOT NULL AFTER `is_hot`");

mysql_query("ALTER TABLE `wpjb_job` ADD job_f_visible smallint(5) UNSIGNED NOT NULL AFTER `job_visible`");
mysql_query("ALTER TABLE `wpjb_job` ADD is_new tinyint(1) UNSIGNED NOT NULL AFTER `is_featured`");
mysql_query("ALTER TABLE `wpjb_job` ADD is_hot tinyint(1) UNSIGNED NOT NULL AFTER `is_new`");
mysql_query("ALTER TABLE `wpjb_job` ADD is_top tinyint(1) UNSIGNED NOT NULL AFTER `is_hot`");
mysql_query("ALTER TABLE `wpjb_job` ADD feature_expires_at datetime NOT NULL AFTER `job_expires_at`");
*/
/*mysql_query("ALTER TABLE `wpjb_employer` ADD is_logo tinyint(1) UNSIGNED NOT NULL AFTER `is_active`");*/
/*mysql_query("DELETE FROM `wpjb_mail`");*/
/*SET GLOBAL event_scheduler = ON;
SET @@global.event_scheduler = ON;
SET GLOBAL event_scheduler = 1;
SET @@global.event_scheduler = 1;

CREATE EVENT `update_is_top` ON SCHEDULE EVERY 1 DAY STARTS '2014-06-02 23:59:59' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE wpjb_job SET is_top =0 WHERE DATEDIFF( CURDATE( ) , DATE( feature_expires_at ) ) >=0
*/
/*mysql_query("UPDATE wpjb_job SET job_type = 1 WHERE job_type = 7");*/
/*mysql_query("UPDATE wpjb_job SET job_f_visible = 7");*/
/*mysql_query("ALTER TABLE `wpjb_job` MODIFY COLUMN  `job_f_visible` smallint(5) unsigned NOT NULL DEFAULT '7'");*/
/*mysql_query("UPDATE wpjb_job SET is_top =0 WHERE DATEDIFF( CURDATE( ) , DATE( feature_expires_at ) ) >=0");*/
//end insert new column to exist table
//mysql_query("UPDATE wpjb_type SET id=3 WHERE id=7") or die(mysql_error());
//mysql_query("UPDATE wpjb_job SET job_category = 1 WHERE job_category = 61");
//mysql_query("UPDATE `wpjb_job` SET `feature_expires_at`='2014-07-02 05:55:04' WHERE `id`=11554");
 mysql_query("UPDATE wpjb_job SET is_top =0 WHERE DATEDIFF( CURDATE( ) , DATE( feature_expires_at ) ) >=0");
 
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Role', 'Views'],
          ['By office staff',     <?php echo $staff;?>],
          ['By jobseeker',      <?php echo $visitor;?>]         
        ]);

        var options = {
          title: 'Job view for last 30 days',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
    <div id="piechart_3d" style="width: 450px; height: 250px;float:left;"></div>
	

    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Action', 'Count'],
		  ['Apply',      <?php echo $isApp;?>],
          ['View',     <?php echo ($visitor - $isApp);?>]
                  
        ]);

        var options = {
          title: 'Job apply/view',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_apply'));
        chart.draw(data, options);
      }
    </script>
    <div id="piechart_3d_apply" style="width: 450px; height: 250px;margin-left:451px;"></div>
<?php
$rows = $wpdb->get_results("SELECT * 
FROM  `wpjb_job` 
WHERE  `is_active` =1
AND `job_expires_at` >= NOW( ) 
AND  `is_new` =1");
foreach ($rows as $row){
	echo $row->feature_expires_at." - ";
}
?>