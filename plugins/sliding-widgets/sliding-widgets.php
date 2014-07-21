<?php 
/*
Plugin Name: Sliding Widgets
Plugin URI: http://wpeden.com/
Description: Sliding Widgets - WordPlress Plugin to create sliding widget area dynamically
Author: codename065
Version: 1.1.0
Author URI: http://wpeden.com/
*/

 
include("libs/class.plugin.php");
 

$wpbs_plugindir = str_replace('\\','/',dirname(__FILE__));
 
$wpbs_plugin = new ahm_plugin(end(explode('/',$wpbs_plugindir)));

define('wpbs__DIR',$wpbs__plugindir); 

function wpbs_header(){
    $wssopt = get_option('wpbs_opt');
    extract($wssopt);
    if(!$disable){
           
        ?>
    <style type="text/css">
    /********* common css for all box********/
    #wpbs__cont{
        width: <?php echo $width;?>px;
        height: <?php echo $height;?>px;
        background:<?php echo $bg;?>;
        -webkit-border-top-right-radius: 6px;
        -webkit-border-bottom-right-radius: 6px;
        -moz-border-radius-topright: 6px;
        -moz-border-radius-bottomright: 6px;
        border-top-right-radius: 6px;
        border-bottom-right-radius: 6px;
        z-index:999999;
        
        /*padding:5px;*/
    }
     
    #wpbs__cont iframe{
        -webkit-border-top-right-radius: 6px;
        -webkit-border-bottom-right-radius: 6px;
        -moz-border-radius-topright: 6px;
        -moz-border-radius-bottomright: 6px;
        border-top-right-radius: 6px;
        border-bottom-right-radius: 6px;
        margin-top: 3px;
    } 
    
    </style>
    
    <?php 
    //include the css file for the left,right,bottom and top
    if($position=='')$pos="left";else $pos=$position;
    include("tpls/".$pos."_css.php");
        
    }
    
}

function wpbs_widget_area(){
    $wssopt = get_option('wpbs_opt',array());
    extract($wssopt);
    if(!$disable){ 
    
     register_sidebar(array(
                    'name'          => 'Sliding Widget',
                    'id'            => 'wliding-widget',
                    'description'   => '',
                    'class'         => '',
                    'before_widget' => '<div id="sbox1" class="widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h2 class="widgettitle">',
                    'after_title'   => '</h2>' ));
    }
}
 

function wpbs_sliders(){
    //get the box settings and info
    $wssopt = get_option('wpbs_opt');
    extract($wssopt);
 if(!$disable){ 
        
            
    if(empty($spos))$spos= 50;
    if(empty($icon_box_width))$icon_box_width= 100;
    if(empty($icon_box_height))$icon_box_height= 100;
    if($position=='')$pos="left";else $pos=$position;
    
    // the slider div in appropriate file like left div is in left.php,right in right.php ..
    include("tpls/".$pos.".php");
    
       
    }
    
}




 
function wpbs_menu(){    
    //box slider menu for the admin
    add_menu_page("Sliding Widgets","Sliding Widgets","administrator",'wpbs_panel','wpbs_settings',plugins_url('sliding-widgets/images/icon.png'));
            
}


//show the settings page
function wpbs_settings(){
    include("tpls/settings.php");
}

//save the box slider options settings
function wpbs_save_settings(){
    update_option('wpbs_opt',$_POST['wpbs__opt']);
    die('Options Updated');
}


function wpbs_scripts(){
    global $wpbs_plugin;
    //$scripts = array('jquery','jquery-form'); 
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-form');
    $wpbs_plugin->load_scripts(); 
    $wpbs_plugin->load_styles(); 
}
 
 
 if(is_admin()){
     add_action("admin_menu","wpbs_menu");
 }

$wpbs_plugin->load_modules(); 

add_action('wp_enqueue_scripts','wpbs_scripts');
add_action('admin_enqueue_scripts','wpbs_scripts');
add_action('wp_head','wpbs_header');
add_action('wp_footer','wpbs_sliders');
add_action('wp_ajax_wpbs_save_settings','wpbs_save_settings');
add_action('init','wpbs_widget_area');

 