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
<meta name="google-site-verification" content="ZB2mmuiKfvD1vNnejIycuYULzSjYFNpl2tUeQBrNjLk" />
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo bloginfo('template_directory');?>/images/logo-title.png"/>
<title><?php wp_title('&#124;', true, 'right'); ?></title>
<meta property="og:image" content="<?php echo bloginfo('template_directory');?>/images/sagojo_fb.png"/>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="<?php echo bloginfo('template_directory')?>/fonts/fonts.css" type="text/css" charset="utf-8" />


<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js' type='text/javascript'> </script>

<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/css/creativsocial-styles.css"/>

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
	
	<script src="<?php echo bloginfo('template_directory');?>/Scripts_datepicker/jquery-1.7.1.min.js" type="text/javascript"></script> 
    
    <script src="<?php echo bloginfo('template_directory');?>/Scripts_datepicker/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script> 
    
    
    <link href="<?php echo bloginfo('template_directory');?>/Css_datepicker/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />

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


	<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/Css_mobile/normalize.css"/>
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/Css_mobile/style.css"/>
	<!--<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>-->
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->
	<script>
		$(function() {
			var pull 		= $('#pull');
				menu 		= $('nav ul');
				menuHeight	= menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});

			$(window).resize(function(){
        		var w = $(window).width();
        		if(w > 320 && menu.is(':hidden')) {
        			menu.removeAttr('style');
        		}
    		});
		});
	</script>

<?php wp_head(); ?>
</head>
 
 
 
<body <?php body_class(); ?>>

     <nav class="clearfix">

				<?php wp_nav_menu(array(
                     
                     
                             'menu' => 'Menu chinh',
                             'container'    =>'',
                        	 'container_class'=>'',
                        	 'container_id'  =>'',
                        	 'menu_class'      => 'clearfix',
                        	 'menu_id'         => '',
                            
                            )
                         );
                ?>

		</nav>
        
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
                                    <div id="logo-img"><a href="<?php echo home_url('/'); ?>"><img src="<?php header_image(); ?>" width="<?php if(function_exists('get_custom_header')) { echo get_custom_header() -> width;} else { echo HEADER_IMAGE_WIDTH;} ?>" height="<?php if(function_exists('get_custom_header')) { echo get_custom_header() -> height;} else { echo HEADER_IMAGE_HEIGHT;} ?>" alt="<?php bloginfo('name'); ?>" /></a></div>
                                    <div id="logo-font">
									
											<div id="logo-font-con">
												<a id="font-logo-soc">
													<?php _e('Job matching service for freelancers, freelance job, jobseekers and employers')?>
													
												</a>
												<div id="soc-jp">
														<a><?php echo '&nbsp;|&nbsp;';?></a>
														
												</div>
			
												<div id="japan-tokyo">
												
														<a><img src="<?php echo bloginfo('template_directory');?>/images/jp.png"/>&nbsp;<?php _e('&nbsp;From Japan - Tokyo')?></a>
														
												</div>
												<div id="clear"></div>
												
											</div>
											
									</div>
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
                                    <label href="#" id="pull"><a>menu</a></label> 
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