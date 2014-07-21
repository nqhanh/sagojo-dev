<div class="wrap"><div id="icon-ibpro" class="icon32 icon32-posts-post"></div><h2>Coupon</h2>
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
if((isset($_GET['title']))||(isset($_POST['title']))){   
	if(isset($_POST['title'])){   
		$title = $_POST['title'];
		$table  = '';
	}
	else if(isset($_GET['title'])){   
		$title = $_GET['title'];
		$table  = '';
	}	
if(!isset($_GET['trang'])){  
$page = 1;  
} else {  
$page = $_GET['trang']; } 
?>
				<h1 class="entry-title post-title">
					<?php echo "coupon by: ".$title; ?>
				</h1>                
<?php
 
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
   if($title != 'noselect'){
		
   	    $sql = "SELECT * FROM wpjb_discount WHERE title = '$title' ORDER BY used DESC,id DESC LIMIT $from, $max_results";
        $query = mysql_query($sql);

        
		$stt=2;
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

    }
    else{

    }
    
  echo "</tbody></table>	";
}
// TĂ­nh tá»•ng káº¿t quáº£ trong toĂ n DB:  
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wpjb_discount WHERE title = '$title'"),0);  

// TĂ­nh tá»•ng sá»‘ trang. LĂ m trĂ²n lĂªn sá»­ dá»¥ng ceil()  
$total_pages = ceil($total_results / $max_results);  

// Táº¡o liĂªn káº¿t Ä‘áº¿n cĂ¡c trang Ä‘Ă£ Ä‘Ă¡nh sá»‘ thá»© tá»± 
echo "<div class=\"tablenav\"><div class=\"tablenav-pages\">";  

// Táº¡o liĂªn káº¿t Ä‘áº¿n trang trÆ°á»›c trang Ä‘ang xem 
if($page > 1){  
$prev = ($page - 1);  
echo "<a class=\"page-numbers\" href=\"".$_SERVER['PHP_SELF']."?page=wp_linegraph_action&trang=$prev&title=$title\"><</a>&nbsp;";  
}  

for($i = 1; $i <= $total_pages; $i++){  
if(($page) == $i){  
echo "<span class=\"page-numbers current\">".$i."</span>";  
} else {  
echo "<a class=\"page-numbers\" href=\"".$_SERVER['PHP_SELF']."?page=wp_linegraph_action&trang=$i&title=$title\">$i</a>&nbsp;";  
}  
}  

// Táº¡o liĂªn káº¿t Ä‘áº¿n trang tiáº¿p theo  
if($page < $total_pages){  
$next = ($page + 1);  
echo "<a class=\"page-numbers\" href=\"".$_SERVER['PHP_SELF']."?page=wp_linegraph_action&trang=$next&title=$title\">></a>";  
}  
echo "</div></div>"; 

if(!isset($_GET['page'])){  
$page = 1;  
} else {  
$page = $_GET['page'];}
?>