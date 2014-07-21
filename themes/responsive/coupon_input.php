<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Content/Sidebar Template
 *
   Template Name:  Coupon
 *
 * @file           oupon_page.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/coupon_page.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

get_header(); ?>

<div id="content" class="grid col-620 ">
<?php
include 'connect.php'; 


?>
<?php get_template_part( 'loop-header' ); ?>
        
			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>       
				<h1 class="entry-title-coupon post-title-coupon">
					<?php echo "<div id='coupon_giamgia'>coupon by:&nbsp;&nbsp;&nbsp;</div> " .$selectBox1;?>
				</h1>
                
                <div class="post-entry">
                    <?
$db = mysql_connect("localhost", "root", "") or die("Could not connect.");

if(!$db) 

	die("no db");

if(!mysql_select_db("sagojo",$db))

 	die("No database selected.");

if(isset($_GET['submit']))

   {

     $filename=$_GET['filename'];
	 
     $handle = fopen("$filename", "r");

     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
     {
       $import="INSERT into  wpjb_discount(title,code,discount,type,currency,expires_at,is_active,used,max_uses) values('$data[0]',$data[1],$data[2]$data[3]',$data[4],$data[5],$data[6],$data[7]$data[8]',$data[9])";

       mysql_query($import) or die(mysql_error());
     }

     fclose($handle);

     print "Import done";

   }

   else

   {
      print "<form action='coupon_input.php' method='get'>";

      print "Type file name to import:<br>";

      print "<input type='file' name='filename' size='20' width=40 value='bangdiem.csv'><br>";

      print "<input type='submit' name='submit' value='submit'></form>";
   }


?>
                </div><!-- end of .post-entry -->
            
				<?php get_template_part( 'post-data' ); ?>
				               
				<?php responsive_entry_bottom(); ?>      
			</div><!-- end of #post-<?php the_ID(); ?> --> 
			
			<?php responsive_entry_after(); ?>      
</div><!-- end of #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
