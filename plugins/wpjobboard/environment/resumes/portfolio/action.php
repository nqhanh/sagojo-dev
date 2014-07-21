 
<?php
if(!isset($_GET['page'])){  
$page = 1;  
} else {  
$page = $_GET['page'];  
}  

// Chọn số kết quả trả về trong mỗi trang mặc định là 10 
$max_results = 1;  

// Tính số thứ tự giá trị trả về của đầu trang hiện tại 
$from = (($page * $max_results) - $max_results);  

if(isset($_GET['title'])){
    
    $title = $_GET['title'];
    $table  = '';
    
    if($title != 'noselect'){
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'sagojo';
        
        $connect_db = mysql_connect($db_host, $db_user, $db_pass);
        $select_db = mysql_select_db($db_name, $connect_db);
		
		
        
        $sql = "SELECT * FROM wpjb_discount WHERE title = '$title' ORDER BY used DESC LIMIT $from, $max_results";
        $query = mysql_query($sql);

        $table .= '<table width="100%">';
        $table .= '<tr>';
		$table .= '<td>order</td><td>Coupon code</td><td>Price (US$)</td><td>Expires at (d/m/Y)</td><td>Status</td>';
		$table .= '</tr>';
		$stt=1;


        while($row = mysql_fetch_array($query)){
            $status = $row['used'];
			if ($status==0) $status="Unused"; else $status="Used";
			$expires =  new DateTime($row['expires_at']);			
            $table .= '<tr><td>'.$stt.'</td><td>'.$row['code'].'</td><td>'.$row['discount'].'</td><td>'.date_format($expires,'d/m/Y').'</td><td>'.$status.'</td></tr>';
			$stt++;
			
        }
		

        $table .= '</table>'; 
		
    }
    else{
        $table .= '<table width="100%"><tr>';
        $table .= '<td>order</td><td>Coupon code</td><td>Price (US$)</td><td>Expires at (d/m/Y)</td><td>Status</td>';
        $table .= '</tr></table>';
    }
    
    echo $table;   	
}
// Tính tổng kết quả trong toàn DB:  
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wpjb_discount WHERE title = '$title'"),0);  

// Tính tổng số trang. Làm tròn lên sử dụng ceil()  
$total_pages = ceil($total_results / $max_results);  

// Tạo liên kết đến các trang đã đánh số thứ tự 
echo "<center>Page: ";  

// Tạo liên kết đến trang trước trang đang xem 
if($page > 1){  
$prev = ($page - 1);  
echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev&title=$title\"><</a>&nbsp;";  
}  

for($i = 1; $i <= $total_pages; $i++){  
if(($page) == $i){  
echo "$i&nbsp;";  
} else {  
echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i&title=$title\">$i</a>&nbsp;";  
}  
}  

// Tạo liên kết đến trang tiếp theo  
if($page < $total_pages){  
$next = ($page + 1);  
echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next&title=$title\">></a>";  
}  
echo "</center>"; 
?>