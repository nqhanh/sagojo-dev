<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Header Template
 *
 *
 * @file           header.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.3
 * @filesource     wp-content/themes/responsive/header.php
 * @link           http://codex.wordpress.org/Theme_Development#Document_Head_.28header.php.29
 * @since          available since Release 1.0
 */
?>
<!doctype html>
<!--[if !IE]>      <html class="no-js non-ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>

<title><?php wp_title('&#124;', true, 'right'); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js' type='text/javascript'> </script>

<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?> /css/creativsocial-styles.css"/>

<!---<link rel="stylesheet" type="text/css" href="../../wp-content/calendar/css/calendar.css" media="screen" />
 <script type="text/javascript" src="<?php// echo bloginfo('template_directory');?>wp-content/calendar/js/mootools.js"></script>
<script type="text/javascript" src="<?php //echo bloginfo('template_directory');?> wp-content/calendar/js/calendar.js"></script>-->

<!--Chinh sua menuzing------->
<!-- Styling -->

	<!--<link rel="stylesheet" href="<?php //echo bloginfo('template_directory');?> /core/css/styles_zing.css"/>
	
	<script src="<?php //echo bloginfo('template_directory');?> /core/js/jquery-1.8.3.min.js"></script>
	<script src="<?php //echo bloginfo('template_directory');?> /core/js/iscroll.js"></script>
	<script>
		if (window.screen.height==568) { // iPhone 4"
			document.querySelector("meta[name=viewport]").content="width=320.1";
		}			
	
	</script>
	
	<script src="<?php //echo bloginfo('template_directory');?> /core/js/jquery.mobile-1.3.0.min.js"></script>	

	<script src="<?php //echo bloginfo('template_directory');?> /core/js/helpers.js"></script>
	<script src="<?php //echo bloginfo('template_directory');?> /core/js/engine.js"></script>-->
	
<style type="text/css">


#menu{
    
    
        position:fixed;
        top:0;
        
        left:0;
        
        bottom:0;
        width:80%;
        
        z-index:1;
        background:#1B1464;
        padding-left: 0;
        /*overflow:auto;*/
        opacity:0;
        -webkit-transition:opacity 0s .5s;
        display:block;
        height:100%;
        overflow-y:scroll;
       /* -webkit-overflow-scrolling:touch;*/
        
        
        }
        
    
    
   #menu li.menu-item {

        height: 40px;
        list-style-type: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.4);
        box-shadow: 0 1px 0 rgba(255, 255, 255, 0.1);
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.75);
   
  
    }
    
    
    #menu li.menu-item ul.sub-menu li.menu-item{
        
        margin-bottom: 0px;
    
        margin-top: 0px;
        margin-left: -28px;  
    
        
    }
  
    
    #menu li.menu-item a {
       
        color: #BBBBBB;
        font-size: 15px;
        font-weight: bold;
        line-height: 40px;
        padding: 5px 0;
        padding-top: 5px;
        padding-bottom: 5px;
        padding-right: 50%;
        text-decoration: none;
    }
    
    #menu li.menu-item a:hover{
        
        font-size: 15px;
        
        color: #F15A24;
        text-decoration: none;
        font-weight: bold;
        
    }

    #menu li.menu-item ul.sub-menu li.menu-item a{
        
        
        display:block;
        
        padding:0px;
        border-bottom:1px solid #222;color:#fff;
        font-weight:bold;text-decoration:none;
        
        }
    #menu li.menu-item ul.sub-menu li.menu-item a:hover{
        
    
        color: #F15A24;
        
        }
        
        
    .handler{display:none}
        
    .handler#handler-right:checked ~ 
        
        
        
  .handler#handler-right:checked ~ 
  
  
  #wrapper_mobile{
    
    -webkit-transform:translate3D(-80%, 0, 0);
    -moz-transform:translate3D(-80%, 0, 0)
    
  
  }.handler#handler-right:checked ~ 
  
  
 #wrapper_mobile #content{overflow:hidden}
  
  .handler#handler-left:checked ~ 
  
  #menu{
    
    background: #1B1464;
    opacity:1;
    -webkit-transition:opacity 0s 0s;
  
    -moz-transition:opacity 0s 0s;
    /*margin-top: 30px;*/
  
  }
  
 
  
  
    
  
  
  .handler#handler-left:checked ~ 
  
  #wrapper_mobile{
    
    background: #FFF;
    -webkit-transform:translate3D(80%, 0, 0);
  
    -moz-transform:translate3D(80%, 0, 0);
    
  
  }
  
  .handler#handler-left:checked ~ 
  
  #wrapper_mobile #content{overflow:hidden}
  
  #wrapper_mobile{position:relative;z-index:2;
  
    /*background:#f5f5f5;height:100%;
  
     box-shadow:0 0 3px #000;*/
    /* -webkit-transform:translate3D(0, 0, 0);
     -moz-transform:translate3D(0, 0, 0);
     -webkit-transition:-webkit-transform .5s ease-in-out;
     -moz-transition:-moz-transform .5s ease-in-out*/
     }
     #wrapper_mobile #container #header #button{
        /*height:20px;*/
        padding:0px 0px;
        margin-top: 15px;
        line-height:20px;
        margin-bottom: 25px;
        
    
        
        }
        
        #wrapper_mobile #container #header #button #lable-left{
            
            color:#666;text-transform:uppercase;
            text-decoration:none;cursor:pointer;
            
  
            height: 38px;
            
            width: 42px;
            
            
            
            }
            
  #wrapper_mobile #container #header #button #lable-left:hover{
    color:#336c95}
    
    #wrapper_mobile #container #haeder #button label#right{
        float:left}
        
    /*#wrapper_mobile #content{padding:10px;color:#666;
        line-height:1.5em;font-size:.9em;
        font-weight:300;position:absolute;top:40px;left:0;right:0;
        bottom:0;overflow-y:scroll;
        
        -webkit-overflow-scrolling:touch
        
        }
        
        
        #wrapper_mobile #content p:not(:last-child){
            margin-bottom:20px
            
    }*/


</style>


<style>

 #wrapper_mobile{
     max-width: 960px;
     
     margin: 0 auto;
    
    
 }
</style>


<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
// Fixing iOS Safari "WTF" issue
// http://stackoverflow.com/questions/7358781/tapping-on-label-in-mobile-safari
$('label').click(function() {});
});//]]>  

</script>




<?php wp_head(); ?>
</head>
 
 
 
<body <?php body_class(); ?>>
<!---
<style type='text/css'>
    #bttop{
        border:1px solid #4adcff;
        background:#24bde2;
        text-align:center;
        padding:5px;
        position:fixed;
        bottom:35px;
        right:10px;
        cursor:pointer;
        display:none;
        color:#fff;
        font-size:11px;
        font-weight:900;
        border-radius: 20px;
    }
     #bttop:hover{
        border-radius: 20px;
        border:1px solid #ffa789;
        background:#ff6734;
     }
</style>
    <div id='bttop'>TOP</div>
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js' type='text/javascript'></script>
    <script type='text/javascript'>
            $(function()
            {
                $(window).scroll(function(){if($(this).scrollTop()!=0)
                        {   
                            $('#bttop').fadeIn();
                        }
                        else{
                            $('#bttop').fadeOut();}});$('#bttop').click(function(){$('body,html').animate({scrollTop:0},800);});});
                    
    </script>


--->
    <input type="checkbox" name="handler-left" class="handler" id="handler-left" onclick="null" />
     
        <?php wp_nav_menu(array(
                     
                     
                             'menu' => 'Menu chinh',
                             'container'    =>'',
                        	 'container_class'=>'',
                        	 'container_id'  =>'',
                        	 'menu_class'      => 'nav fl sf-js-enabled',
                        	 'menu_id'         => 'menu',
                            
                            )
                         );
                ?>


        
        
        <div id="wrapper_mobile">
             <?php responsive_container(); // before container hook ?>
        
            <div id="container" class="hfeed">
     
             <!--Phan May tinh--->
             
             
             
                
               	<?php responsive_header_top(); // before header content hook ?>
               
                <div id="header" >
                
                     <?php responsive_in_header(); // header hook ?>
                        <?php get_sidebar('top'); ?>
                        	   
                           
                                <?php //if (has_nav_menu('top-menu', 'responsive')) { ?>
                        	        <?php /*wp_nav_menu(array(
                        				    'container'       => '',
                        					'fallback_cb'	  =>  false,
                        					'menu_class'      => 'top-menu',
                        					'theme_location'  => 'top-menu')
                        					); */
                        				?>
                                <?php //} ?>
                                
                            
                           
                        	<?php if ( get_header_image() != '' ) : ?>
                            <!--<div id="khungbao">-->
                               <!--<div id="jop_number"> 
                                </div> -->
                                <div id="logo">
                                    <a href="<?php echo home_url('/'); ?>"><img src="<?php header_image(); ?>" width="<?php if(function_exists('get_custom_header')) { echo get_custom_header() -> width;} else { echo HEADER_IMAGE_WIDTH;} ?>" height="<?php if(function_exists('get_custom_header')) { echo get_custom_header() -> height;} else { echo HEADER_IMAGE_HEIGHT;} ?>" alt="<?php bloginfo('name'); ?>" /></a>
                                    <div id="logo-font"><a>plumjobs, rewarding lives</a></div>
                                </div><!-- end of #logo -->
                                
                                
                            <?php endif; // header image was removed ?>
                        
                        
                        
                    
                    
                        <?php if ( !get_header_image() ) : ?>
                                    
                            <!--<div id="logo">
                                <span class="site-name"><a href="<php //echo home_url('/'); ?>" title="<php echo //esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><php //bloginfo('name'); ?></a></span>
                                <span class="site-description"><php //bloginfo('description'); ?></span>
                            </div><!-- end of #logo -->  
                            
                        
                        <?php endif; // header image was removed (again) ?>
                        <!--</div><!---End Khung bao--->
                        
                    				<?php wp_nav_menu(array(
                    				    'container'       => 'div',
                    						'container_class'	=> 'main-nav',
                    						'fallback_cb'	  =>  'responsive_fallback_menu',
                    						'theme_location'  => 'header-menu')
                    					); 
                    				?>
                                    
                            <div id="button">
                                         <label for="handler-left" id="lable-left" href="#"></label>
                                 </div>
                                
                                <?php //if (has_nav_menu('sub-header-menu', 'responsive')) { ?>
                    	            <?php /*wp_nav_menu(array(
                    				    'container'       => '',
                    					'menu_class'      => 'sub-header-menu',
                    					'theme_location'  => 'sub-header-menu')
                    					); */
                    				?>
                                <?php //} ?>
                    
                    			<?php responsive_header_bottom(); // after header content hook ?>
                            
         
            </div><!-- end of #header -->
            
            <?php responsive_header_end(); // after header container hook ?>
            
        	<?php responsive_wrapper(); // before wrapper container hook ?>
        
            <!--<div id="border_top"></div>-->
             
             
             <!----------------------------------->
                
            <div id="wrapper" class="clearfix <?php wpjb_resume_mods(); ?>">
                
        		<?php responsive_wrapper_top(); // before wrapper content hook ?>
        		<?php responsive_in_wrapper(); // wrapper hook ?>