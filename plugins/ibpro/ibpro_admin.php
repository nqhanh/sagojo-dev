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
<div class="wrap"><div id="icon-ibpro" class="icon32 icon32-posts-post"></div><h2>IBPro</h2>
<table class="wp-list-table widefat fixed posts" cellspacing="0">
<thead><tr>
<th class="column-comments" scope="col" style="">&nbsp;&nbsp;ID</th>
<th class scope="col" style="">User Email</th>
<th class scope="col" style="">Account Number</th>
<th class scope="col" style="">Instrument Group</th>
<th class scope="col" style="">Volume (Lots) 1</th>
<th class scope="col" style="">Percent (%)</th>
<th class scope="col" style="">Commission (USD)</th>
<th class scope="col" style="">Edit</th>
</tr></thead>
<tfoot><tr>
<th class="column-comments" scope="col" style="">&nbsp;&nbsp;ID</th>
<th class scope="col" style="">User Email</th>
<th class scope="col" style="">Account Number</th>
<th class scope="col" style="">Instrument Group</th>
<th class scope="col" style="">Volume (Lots) 1</th>
<th class scope="col" style="">Percent (%)</th>
<th class scope="col" style="">Commission (USD)</th>
<th class scope="col" style="">Edit</th>
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
$sql = "SELECT ID,user_login,user_email FROM wp_users ORDER BY ID ASC  LIMIT $from, $max_results";
$query = mysql_query($sql) or die(mysql_error());;
if(is_resource($query))
{
	while($data = mysql_fetch_array($query)){

		$account_number = get_user_meta($data['ID'], 'account_number', TRUE);
		$instrument_group = get_user_meta($data['ID'], 'instrument_group', TRUE);
		$volume_lots = get_user_meta($data['ID'], 'volume_lots', TRUE);	
		$percent = get_user_meta($data['ID'], 'percent', TRUE);
		$commission_usd = get_user_meta($data['ID'], 'commission_usd', TRUE);
		$instrument_group_f = get_user_meta($data['ID'], 'instrument_group_f', TRUE);
		$volume_lots_f = get_user_meta($data['ID'], 'volume_lots_f', TRUE);	
		$percent_f = get_user_meta($data['ID'], 'percent_f', TRUE);
		$commission_usd_f = get_user_meta($data['ID'], 'commission_usd_f', TRUE);
		$moderator = "<tr class='alternate'>";
		$moderator .= "<td class='post-title page-title column-title''><br><label>".$data['ID']."</label></td>";
		$moderator .= "<td class='post-title page-title column-title'><br><label>".$data['user_email']."</label></td>";
		$moderator .= "<td class='post-title page-title column-title'><br><input type='text' value='".$account_number."' disabled></td>";
		$moderator .= "<td class='post-title page-title column-title'><input type='text' value='".$instrument_group."' disabled><br><input type='text' value='".$instrument_group_f."' disabled></td>";
		$moderator .= "<td class='post-title page-title column-title'><input type='text' value='".$volume_lots."' disabled><br><input type='text' value='".$volume_lots_f."' disabled></td>";
		$moderator .= "<td class='post-title page-title column-title'><input type='text' value='".$percent."' disabled><br><input type='text' value='".$percent_f."' disabled></td>";
		$moderator .= "<td class='post-title page-title column-title'><input type='text' value='".$commission_usd."' disabled><br><input type='text' value='".$commission_usd_f."' disabled></td>";		
		$moderator .= "<td class='post-title page-title column-title'><br><a href=\"".admin_url( 'user-edit.php?user_id=' .$data['ID'], 'http' )."\">Edit Profile</a></td></tr>";
		echo $moderator;
		
	}
}

?>
</tbody></table>
</div>
<?php
//Pagination
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wp_users"),0);  

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
?>