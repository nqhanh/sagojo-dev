<div class="wrap"><div id="icon-ibpro" class="icon32 icon32-posts-post"></div><h2>Coupon</h2>
<div class="wpjb-buttons">
    <a href="?page=wp_linegraph_insertform"class="button button-highlighted">
        <?php _e("Add New Listing", WPJB_DOMAIN) ?>
    </a>
</div>
<?php
global $wpdb;
$rows = $wpdb->get_results( "SELECT * FROM wpjb_discount GROUP BY title" );
$selectBox1  = '';
//$selectBox1 .= '<div id="seclect-coupon"><select name="title" onchange="ajaxFunction(this.value);">';
$selectBox1 .= '<div id="seclect-coupon" style="float:left;margin-right: 6px;"><select name="title">';
$selectBox1 .= '    <option value="" selected>Select User</option>';
foreach ( $rows as $row ) 
{
	$selectBox1 .= '<option value="'.$row->title.'">'.$row->title.'</option>';
}
$selectBox1 .= '</select></div>';
?>
					<?php echo "<form action=\"?page=wp_linegraph_action\" method=\"post\">" .$selectBox1."<input name=\"mySubmit\" type=\"submit\" class=\"button-secondary action\" value=\"submit\" /></form>";?>

<?php	
if(!isset($_GET['trang'])){  
$page = 1;  
} else {  
$page = $_GET['trang']; 
}  
// Chá»�n sá»‘ káº¿t quáº£ tráº£ vá»� trong má»—i trang máº·c Ä‘á»‹nh lĂ  10 
$max_results = 30;  

// TĂ­nh sá»‘ thá»© tá»± giĂ¡ trá»‹ tráº£ vá»� cá»§a Ä‘áº§u trang hiá»‡n táº¡i 
$from = (($page * $max_results) - $max_results); 
?>
<table class="wp-list-table widefat fixed posts" cellspacing="0">
<thead><tr>
<th class="column-comments" scope="col" style="">&nbsp;&nbsp;ID</th>
<th class scope="col" style="">User's Email</th>
<th class scope="col" style="">Coupon code</th>
<th class scope="col" style="">Price (US$)</th>
<th class scope="col" style="">Expires at (d/m/Y)</th>
<th class scope="col" style="">Usage</th>
</tr></thead>
<tfoot><tr>
<th class="column-comments" scope="col" style="">&nbsp;&nbsp;ID</th>
<th class scope="col" style="">User's Email</th>
<th class scope="col" style="">Coupon code</th>
<th class scope="col" style="">Price (US$)</th>
<th class scope="col" style="">Expires at (d/m/Y)</th>
<th class scope="col" style="">Usage</th>
</tr></tfoot>
<tbody>
<?php		
   	    $sql = "SELECT * FROM wpjb_discount ORDER BY id DESC LIMIT $from, $max_results";
        $query = mysql_query($sql);

        
		$stt=1;
		$now = date('d/m/Y', time());
		$isexpires = "0";
		if($query === FALSE) {
			die(mysql_error()); // TODO: better error handling
		}
        while($row = mysql_fetch_array($query)){
			
			$expires = $row['expires'];
			$dayleft = $expires - $now;
			if ($dayleft == 0) {$isexpires = "1";
			$class = "style='text-decoration:line-through;'";}
			$class = "";
            
			$expires =  new DateTime($row['expires_at']);
			$table = '';
            if ($stt%2==0){			
                $table .= '<tr bgcolor="#F0F0F0"><td>'.$row['id'].'</td><td><strong><a title="Edit ('.$row['title'].')" href="?page=wpjb/discount&action=edit/id/'.$row['id'].'" target=_blank>'.$row['title'].'</a></strong>';
				
				$table .= '</td><td>'.$row['code'].'</td><td>'.$row['discount'].'</td><td '.$class.'>'.date_format($expires,'d/m/Y').'</td><td>'.$row['used'].'</td></tr>';}
            else{
                $table .= '<tr><td>'.$row['id'].'</td><td><strong><a title="Edit ('.$row['title'].')" href="?page=wpjb/discount&action=edit/id/'.$row['id'].'" target=_blank>'.$row['title'].'</a></strong>';
				
				$table .= '</td><td>'.$row['code'].'</td><td>'.$row['discount'].'</td><td '.$class.'>'.date_format($expires,'d/m/Y').'</td><td>'.$row['used'].'</td></tr>';}
			$stt++;
			$isexpires = "0";
			echo $table;
        }
?>
</tbody></table>

<?php

//Pagination
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wpjb_discount"),0);  

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
'prev_text'    => __('<'),
'next_text'    => __('>'),
'type'         => 'plain');

// ECHO THE PAGENATION 
echo '<div class="tablenav">
    <div class="tablenav-pages">';
echo paginate_links( $args );
echo '</div></div><!--// end .pagination -->';
?></div>			