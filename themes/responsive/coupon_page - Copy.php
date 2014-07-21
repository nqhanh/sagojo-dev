<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Content/Sidebar Template
 *
   Template Name:  Coupon
 *
 * @file           coupon_page.php
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
<script language="javascript">
function ajaxFunction(id){
    var xmlHttp;
    if(window.XMLHttpRequest){
        // IE7+, Firefox, Chrome, Opera, Safari
        xmlHttp = new XMLHttpRequest;
    }
    else if(window.ActiveXObject){
        // IE6, IE5
        xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    
    xmlHttp.onreadystatechange = function(){
        if(xmlHttp.readyState == 4){
            document.getElementById('coupon').innerHTML = xmlHttp.responseText;
        }
    }
    xmlHttp.open('GET', '?page_id=23&title='+id, true);
    xmlHttp.send(null);
}
</script>
<div id="content" class="grid col-620 ">
<?php

$rows = $wpdb->get_results( "SELECT * FROM wpjb_discount GROUP BY title" );

$selectBox1  = '';
$selectBox1 .= '<div id="seclect-coupon"><select name="title" onchange="ajaxFunction(this.value);">';
$selectBox1 .= '    <option value="" selected>Select User</option>';
foreach ( $rows as $row ) 
{
	$selectBox1 .= '<option value="'.$row->title.'">'.$row->title.'</option>';
}
$selectBox1 .= '</select></div>';

?>
<?php get_template_part( 'loop-header' ); ?>
        
			<?php responsive_entry_before(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>       
				<h1 class="entry-title-coupon post-title-coupon">
					<?php echo "<div id='coupon_giamgia'>coupon by:&nbsp;&nbsp;&nbsp;</div> " .$selectBox1;?>
				</h1>
                
                <div class="post-entry-coupon">
                    <div id="coupon">
                        <table width="100%">
                    	<tr bgcolor="#F0F0F0"><td >No.</td><td >ID</td><td>Coupon code</td><td>Price (US$)</td><td>Expires at (d/m/Y)</td><td>Used (times)</td></tr>
                    	</table>
					</div>
                </div><!-- end of .post-entry -->
            
				<?php get_template_part( 'post-data' ); ?>
				               
				<?php responsive_entry_bottom(); ?>      
			</div><!-- end of #post-<?php the_ID(); ?> --> 
			
			<?php responsive_entry_after(); ?>      
</div><!-- end of #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
