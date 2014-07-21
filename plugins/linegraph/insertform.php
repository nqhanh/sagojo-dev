<div class="wrap"><div id="icon-ibpro" class="icon32 icon32-posts-post"></div><h2>Insert</h2>
<form method="post" name="input" action="?page=wp_linegraph_insert" >
<table>
<tr>
<td><table>

 User's Email:<br/> <input name="user" type="text"/><br/>
 Code:<br/> 
 <?php
 mysql_query("UPDATE wpjb_job SET is_top =0 WHERE DATEDIFF( CURDATE( ) , DATE( feature_expires_at ) ) >=0");
 $seed = str_split('1234567890'.'abcdefghijklmnopqrstuvwxyz'
						.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'); // and any other characters
				shuffle($seed); // probably optional since array_is randomized; this may be redundant
				$rand = '';
				foreach (array_rand($seed, 13) as $k) $rand .= $seed[$k];
 ?>
 <input name="code" type="text" value ="<?php echo $rand;?>" /><br/> 
 Listing:<br/>
 <?php
global $wpdb;
$rows = $wpdb->get_results( "SELECT * FROM wpjb_listing WHERE price<>0" );
$selectBox1  = '';
$selectBox1 .= '<div id="seclect-coupon"><select name="title">';
$selectBox1 .= '    <option value="" selected>Select Listing</option>';
foreach ( $rows as $row ) 
{
	$selectBox1 .= '<option value="'.number_format($row->price, 0).'">$'.number_format($row->price, 0).' - '.$row->title.'</option>';
}
$selectBox1 .= '</select></div>';
echo $selectBox1;
?>
 <br/>
 
 Expires (yyyy-mm-dd) - default is 30 days:<br/>
 <?php 
 $expiresAt = strtotime("now + 30 days");
                $expiresAt = date("Y-m-d", $expiresAt);
 ?> 
 <input name="date" type="text" value="<?php echo $expiresAt;?>" /><br/>
 Paid for:<br/>
 <select name="used">
 <option value="" selected>Select Type</option>
 <option value="1">Paid after post a job</option>
 <option value="2">Paid for Prepaid account</option>
 </select><br/>
 
 </table></td>
 <td style="border-left:1px dashed #555;"></td>
 <td >
 Email title:<br/>
 <input name="emailtitle" type="text" size="80" /><br/>
 Message (in Vietnamese):<br/>
 <textarea name="vemailmes" rows="10" cols="80">Kính gởi Quý Công ty<br/><br/>
Chúng tôi đã nhận được thanh toán của Quý Công ty khi đăng tuyển dụng trên trang sagojo.com<br/>
Quý Công ty có thể truy cập vào link sau:<br/>
http://www.sagojo.com/submit<br/>
và điền mã số đăng tin bên dưới để kiểm tra tình trạng sử dụng.<br/>
</textarea><br/>
 Message (in English):<br/>
 <textarea name="eemailmes" rows="10" cols="80">Dear Customer<br/><br/>
We had received your payment for your job posting at sagojo.com<br/>
Please follow this link to check your payment code status:<br/>
http://www.sagojo.com/submit<br/>
</textarea>
 </td>
 </tr>
 </table>
 <input type="submit" name="Submit" value="insert" /> </form>