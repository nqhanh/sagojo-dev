<?php

/**
 * Search jobs
 * 
 * Search jobs widget template file
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Widget
 * 
 */


?>

<?php echo $theme->before_widget ?>
<?php if($title) echo $theme->before_title.$title.$theme->after_title ?>

<?php /*<div id="wpjb_widget_alerts" class="wpjb_widget">*/?>
    
    
    <form action="<?php echo wpjb_link_to("search"); ?>" method="get">
        <?php if(!$use_permalinks): ?>
        <input type="hidden" name="page_id" value="<?php echo Wpjb_Project::getInstance()->conf("link_jobs") ?>" />
        <input type="hidden" name="job_board" value="find" />
        <?php endif; ?>
		<input class="search_input" type="text" name="query" placeholder="<?php _e("Enter job title, position,..." ,WPJB_DOMAIN) ?>" /><br/>
        <?php 
		
		global $wpdb;
        $rows = $wpdb->get_results( "SELECT * FROM wpjb_category" );
        $selectBox1  = '';
        $selectBox1 .= '<select class="search_input" name="category" style="color:#959595;">';
        $selectBox1 .= '<option value="" selected">'.__("All categories", WPJB_DOMAIN).'</option>';
			foreach ( $rows as $row ) 
			{
				$selectBox1 .= '<option value="'.$row->id.'" style="color:#555555;">'.__($row->title).'</option>';
			}
		$selectBox1 .= '</select>';
		echo $selectBox1;
					$city_file = WP_PLUGIN_DIR."/wpjobboard/application/config/city_list.ini" ;
					if (file_exists($city_file) && is_readable($city_file))
					{
						$citys=parse_ini_file($city_file,true);
						?>
						<select class="search_input" name="location" id="city" style="color:#959595;">
						<option value="" selected><?php _e("Any location", WPJB_DOMAIN) ?></option>
						<?php						   
						foreach ($citys as $city) { 
							?>
							<option value="<?php echo $city['iso2']; ?>" style="color:#555555;"><?php _e($city['name']) ?></option>
							<?php
							}
							?>
							</select>
							<?php						
					}
					else
					{
						// If the configuration file does not exist or is not readable, DIE php DIE!
						die("Sorry, the $city_file file doesnt seem to exist or is not readable!");
					}
					
					
							?>
		
							
        <input class="home_search"  type="submit" value="<?php _e("Search", WPJB_DOMAIN) ?>" />
    </form>

<?php /*</div>*/?>

<?php echo $theme->after_widget ?>