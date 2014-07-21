<?php
/*
Plugin Name: Merry Christmas Everyone
Plugin URI: http://www.svnlabs.com/christmas/
Description: Merry Christmas! Santa is flying here with gifts, happiness, candies and snow and much, much more. Come on in and check us out!
Date: 2012, Dec, 6
Author: Sandeep Verma
Version: 1.0.7
Author URI: http://www.svnlabs.com/
*/


if(!is_admin()){

if(get_option("xmas_media")=='true')
{

add_action('wp_enqueue_scripts', 'xmas_scripts_method');

}
}

function addBadgeScript() {
	if ( !is_admin() ) { 
		 
		$imaget =  get_option("santas");
		
		
		
		if($imaget == "" || $imaget ==null)
        $imaget = 'blue';
		
		
	
// name the function with empty strings.

    wp_register_script( 'jsFilexMas', plugins_url( '/js/tripleflap.js', __FILE__ ) );
    wp_enqueue_script( 'jsFilexMas' );
	
    
// Add variables to the script.
    wp_localize_script( 'jsFilexMas', 'jsFileVariables', array(
	    'xmas_url'   => get_option("xmas_url"),
	    'showTweet' => get_option("xmas_media"),
		'birdSprite' => get_bloginfo('wpurl').'/wp-content/plugins/merry-christmas-everyone/images/'.$imaget.'.png'
	    )
    );
	
	
	wp_register_script( 'jsFilexMas1', plugins_url( '/js/xmas.js', __FILE__ ) );
    wp_enqueue_script( 'jsFilexMas1' );


	
}
}
function merry_christmas_everyone_admin_menu() { 
	add_menu_page(
		"Merry Christmas",
		"Santa Here",
		8,
		__FILE__,
		"merry_christmas_everyone_options_page",
		get_bloginfo('wpurl').'/wp-content/plugins/merry-christmas-everyone/images/santa.png'
	); 
	//add_submenu_page(__FILE__,'olypics','Site list','8','list-site','oly_admin_list_site');
           
}

function merry_christmas_everyone_options_page() {
	echo '<div class="wrap">';
	echo '<h2>Merry Christmas Everyone </h2>';
	echo '<form method="post" action="options.php">';
  
	wp_nonce_field('update-options');
  
	echo '<table class="form-table" style="width:100%;">';
	echo '<tr valign="top">';
	echo '<td scope="row" style="width: 200px;">' . __('URL?', 'animated') . '</td>';
	echo '<td style="width: 430px;"><input type="text" name="xmas_url" value="' . get_option('xmas_url') . '" /></td>';
	echo '</tr>';
	
	echo '<tr><td scope="row">' . __('Display Snow and Sound?', 'ATB') . '</td>';
	echo '<td><input type="radio" name="xmas_media" value="true"'; 
	if(get_option('xmas_media') == "true")
		echo ' checked';
	echo '/> ' . __('Yes', 'animated') ;
	
	echo '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="xmas_media" value="false"'; 
	if(get_option('xmas_media') == "false")
		echo ' checked';
	echo '/> ' . __('No', 'animated') . '</td>';
	echo '</tr>';
        /////////////////////////////////////
    
	
	$xmas_mp3 = get_option("xmas_mp3");
	$xmas_ogg = get_option("xmas_ogg");
	 
	
	
	echo '<tr><td scope="row">' . __('HTML5 Song MP3?', 'ATB') . '</td>';
	echo '<td><input type="text" name="xmas_mp3" value="'.$xmas_mp3.'"'; 
	echo '/> ' . '</td>';
	echo '</tr>';
    
	
	echo '<tr><td scope="row">' . __('HTML5 Song OGG?', 'ATB') . '</td>';
	echo '<td><input type="text" name="xmas_ogg" value="'.$xmas_ogg.'"'; 
	echo '/> </td>';
	echo '</tr>';
    
	
	
	
	    
        echo '<tr><td scope="row">' . __('Change Santa?', 'ATB') . '</td>';
    
	echo '<td><table border="0"><tr><td  align="center"><input type="radio" name="santas" value="santa1"'; 
	if(get_option('santas') == "santa1" || get_option('santas') == "" || get_option('santas') == null)
		echo ' checked';
      $santa1 = '<div>Santa 1<div><div class="santa1"><img src="'.get_bloginfo('wpurl').'/wp-content/plugins/merry-christmas-everyone/images/santa01.png"></div>';
	echo '/> ' . __($santa1,'animated') . '</td>';
	
	echo '<td  align="center"><input type="radio" name="santas" value="santa2"'; 
	if(get_option('santas') == "santa2")
		echo ' checked';
         $santa2 = '<div>Santa 2<div><div class="santa2"><img src="'.get_bloginfo('wpurl').'/wp-content/plugins/merry-christmas-everyone/images/santa02.png"></div>';
	echo '/> ' . __($santa2, 'animated') . '</td>';

       
        
	echo '</tr></table>';
       echo '</td></tr>';


       ////////////////////////////////////////////
	echo '</table>';
	echo '<p class="submit">';	
	echo '<input type="submit" class="button-primary" value="' . __('Save Changes') . '" />';
	echo '</p>';
  
	settings_fields('MerryChristmasEveryone');
  
	echo '</form>';
	echo '</div><br><br><br><iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fsvnlab&amp;width=292&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false&amp;appId=181968385196620" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:258px;" allowTransparency="true"></iframe><a href="http://www.svnlabs.com/christmas/" target="_blank"><img src="'.get_bloginfo('wpurl').'/wp-content/plugins/merry-christmas-everyone/images/MerryChristmaseveryone.png"></a><div style="float: right; width: 300px; padding: 10px; text-align:center; background-color: #FFFFCC; border: 1px solid #000"><h3 style="text-align:center">Do you like this plugin? <br />I want to make it better?</h3><form action="https://www.paypal.com/cgi-bin/webscr" method="post"><input type="hidden" name="cmd" value="_s-xclick"><input type="hidden" name="hosted_button_id" value="RET8NPWS3BXQG"><input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online."><img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1"></form><br /><a href="http://www.svnlabs.com/christmas/" target="_blank">Make a donation via Paypal to show your appreciation - Let me buy a gift for Christmas!</a><p><a href="http://www.svnlabs.com/concentrate" title="concentrate"><strong>Concentrate</strong></a> <strong>&gt;</strong> <a href="http://www.svnlabs.com/observe" title="observe"><strong>Observe</strong></a> <strong>&gt;</strong> <a href="http://www.svnlabs.com/imagine" title="imagine"><strong>Imagine</strong></a> <strong>&gt;</strong> <a href="http://www.svnlabs.com/launch" title="launch"><strong>Launch</strong></a></p></div>';
	
	addBadgeScript();
}

function merry_christmas_everyone_register_settings() {
	register_setting('MerryChristmasEveryone', 'xmas_url');
	register_setting('MerryChristmasEveryone', 'xmas_media');
	register_setting('MerryChristmasEveryone', 'xmas_mp3');
	register_setting('MerryChristmasEveryone', 'xmas_ogg');
    register_setting('MerryChristmasEveryone', 'santas');
      
	}

$plugin_dir = basename(dirname(__FILE__));

add_option("xmas_url");
add_option("xmas_media", "false");
add_action('wp_footer', 'addBadgeScript');

if(is_admin()){
	add_action('admin_menu', 'merry_christmas_everyone_admin_menu');
	add_action('admin_init', 'merry_christmas_everyone_register_settings');
	
	
	
}


function xmas_scripts_method() {
	
	
	wp_register_script( 'custom-script-snow', plugins_url( '/js/snow.js', __FILE__ ) );
    wp_enqueue_script( 'custom-script-snow' );
	
	
		echo '<div id="santa" style="position:absolute;bottom:20px; right:5px;"><audio autoplay controls="controls" loop="loop" style="height: 0px; width:0px;"><source src="'.get_option("xmas_mp3").'" type="audio/mp4"><source src="'.get_option("xmas_ogg").'" type="audio/ogg"></audio></div>';
	
	
}    





?>