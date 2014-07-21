<?php 


/**
 * Full Content Template
 *
   Template Name: News job Page
 *
 * @file           categories.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/categories.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

/*Categories Page : ten hien thi trong luc ta tao page nhe nhin phan Template y*/

/*SELECT *
FROM `wpjb_job`
ORDER BY `wpjb_job`.`is_featured` DESC
LIMIT 0 , 5*/

/*$rows = $wpdb->get_results("SELECT * FROM wpjb_job ORDER BY wpjb_job.is_featured ASC limit 5" );

foreach ( $rows as $row ) 
{
	echo "<br />".$row->job_title;
}*/

$rows = $wpdb->get_results("SELECT * FROM wpjb_employer ORDER BY wpjb_employer.user_id DESC");
$users_ = $wpdb->get_results("SELECT * FROM wp_users, wpjb_employer Where wp_users.ID = wpjb_employer.user_id");

	$temp=0;
	$i=0;
	foreach ( $users_ as $row ) 
	{
		 $temp= $row->ID;
		echo $temp."-";
		$i++;
		
		
		
	}
	echo "<br /><br /><br /><br />user = ".$i;
	
	
	


	
?>

<?php /*

echo "<br />thong tin bang:";
$users_ = $wpdb->get_results("SELECT ID FROM wp_users ORDER BY wp_users.ID DESC");
$e=0;
	foreach ( $users_ as $u) 
	{
		  
		echo $u->ID."-";
		$e++;
	}
	echo "<br /><br /><br /><br />user = ".$e*/
?>
<!--
<form>
<input type="checkbox" name="vehicle" value="Bike">Nếu bạn chọn sẽ khong có thành viên Employer trong này<br>

</form> -->