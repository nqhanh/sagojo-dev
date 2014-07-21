 <?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Content/Sidebar Template
 *
   Template Name:  Action page
 *
 * @file           action.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/action.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */
if(isset($_GET['title'])){   
    $title = $_GET['title'];
    $table  = '';
if(!isset($_GET['page'])){  
$page = 1;  
} else {  
$page = $_GET['page']; 
get_header(); 
echo "<div id=\"content\" class=\"grid col-620 content-lost-pw\">";
?>
<?php get_template_part( 'loop-header' ); ?>
        
			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>       
				<h1 class="entry-title post-title">
					<?php echo "coupon by: ".$title; ?>
				</h1>
                
                <div class="post-entry-coupon">
<?php
}  
 
// Chá»�n sá»‘ káº¿t quáº£ tráº£ vá»� trong má»—i trang máº·c Ä‘á»‹nh lĂ  10 
$max_results = 30;  

// TĂ­nh sá»‘ thá»© tá»± giĂ¡ trá»‹ tráº£ vá»� cá»§a Ä‘áº§u trang hiá»‡n táº¡i 
$from = (($page * $max_results) - $max_results);  
   if($title != 'noselect'){
		require('wp-blog-header.php');
   	    $sql = "SELECT * FROM wpjb_discount WHERE title = '$title' ORDER BY used DESC,id DESC LIMIT $from, $max_results";
        $query = mysql_query($sql);

        $table .= '<table width="100%">';
        $table .= '<tr bgcolor="#F0F0F0">';
		$table .= '<td>No.</td><td >ID</td><td>Coupon code</td><td>Price (US$)</td><td>Expires at (d/m/Y)</td><td>Used (times)</td>';
		$table .= '</tr>';
		$stt=1;
		$now = date('d/m/Y', time());
		$isexpires = "0";
        while($row = mysql_fetch_array($query)){
			
			$expires = $row['expires'];
			$dayleft = $expires - $now;
			if ($dayleft == 0) {$isexpires = "1";
			$class = "style='text-decoration:line-through;'";}
			$class = "";
            $status = $row['used'];
			if ($status==0) $status="<img src='".site_url()."/wp-content/banners/unused.jpg'>"; else $status="<img src='".site_url()."/wp-content/banners/used.jpg'>";
			$expires =  new DateTime($row['expires_at']);
            if ($stt%2==0)			
                $table .= '<tr bgcolor="#F0F0F0"><td>'.$stt.'</td><td>'.$row['id'].'</td><td>'.$row['code'].'</td><td>'.$row['discount'].'</td><td '.$class.'>'.date_format($expires,'d/m/Y').'</td><td>'.$row['used'].'</td></tr>';
            else
                $table .= '<tr  ><td>'.$stt.'</td><td>'.$row['id'].'</td><td>'.$row['code'].'</td><td>'.$row['discount'].'</td><td '.$class.'>'.date_format($expires,'d/m/Y').'</td><td>'.$row['used'].'</td></tr>';
			$stt++;
			$isexpires = "0";
        }

        $table .= '</table>'; 		
    }
    else{
        $table .= '<table width="100%"><tr bgcolor="#F0F0F0">';
        $table .= '<td>No.</td><td >ID</td><td>Coupon code</td><td>Price (US$)</td><td>Expires at (d/m/Y)</td><td>Used (times)</td>';
        $table .= '</tr></table>';
    }
    
    echo $table;   	
}
// TĂ­nh tá»•ng káº¿t quáº£ trong toĂ n DB:  
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM wpjb_discount WHERE title = '$title'"),0);  

// TĂ­nh tá»•ng sá»‘ trang. LĂ m trĂ²n lĂªn sá»­ dá»¥ng ceil()  
$total_pages = ceil($total_results / $max_results);  

// Táº¡o liĂªn káº¿t Ä‘áº¿n cĂ¡c trang Ä‘Ă£ Ä‘Ă¡nh sá»‘ thá»© tá»± 
echo "<center>";  

// Táº¡o liĂªn káº¿t Ä‘áº¿n trang trÆ°á»›c trang Ä‘ang xem 
if($page > 1){  
$prev = ($page - 1);  
echo "<a href=\"".$_SERVER['PHP_SELF']."?page_id=23&page=$prev&title=$title\"><</a>&nbsp;";  
}  

for($i = 1; $i <= $total_pages; $i++){  
if(($page) == $i){  
echo "<span class='tranghientai'>".$i."</span>";  
} else {  
echo "<a href=\"".$_SERVER['PHP_SELF']."?page_id=23&page=$i&title=$title\">$i</a>&nbsp;";  
}  
}  

// Táº¡o liĂªn káº¿t Ä‘áº¿n trang tiáº¿p theo  
if($page < $total_pages){  
$next = ($page + 1);  
echo "<a href=\"".$_SERVER['PHP_SELF']."?page_id=23&page=$next&title=$title\">></a>";  
}  
echo "</center>"; 

if(!isset($_GET['page'])){  
$page = 1;  
} else {  
$page = $_GET['page'];
?>
</div><!-- end of .post-entry -->
            
				<?php get_template_part( 'post-data' ); ?>
				               
				<?php responsive_entry_bottom(); ?>      
			</div><!-- end of #post-<?php the_ID(); ?> --> 
			
			<?php responsive_entry_after(); ?>
<?php
echo "</div><!-- end of #content -->"; 
get_sidebar();
get_footer();
}  
?>