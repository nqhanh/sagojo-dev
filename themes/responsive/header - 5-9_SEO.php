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
<!DOCTYPE HTML>
<!--[if !IE]>      <html class="no-js non-ie" <?php //language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" <?php //language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php //language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9" <?php //language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes();?>> <!--<![endif]-->

<head>
        <meta charset="<?php bloginfo('charset');?>"/>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo bloginfo('template_directory');?>/images/favicon.ico"/>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
        <title><?php wp_title('&#124;', true, 'right');?></title>
        <meta  property="og:image" content="<?php echo bloginfo('template_directory');?>/images/sagojo_fb.png"/>
        
        <link rel="profile" href="http://gmpg.org/xfn/11"/>
        <link rel="pingback" href="<?php bloginfo('pingback_url');?>"/>
        
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'/>
        <link href="<?php echo bloginfo('template_directory');?>/ratingfiles/ratings.css" rel="stylesheet" type="text/css" />
		<script src="<?php echo bloginfo('template_directory');?>/ratingfiles/ratings.js" type="text/javascript"></script>
        <!---google analytic-->
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        
          ga('create', 'UA-43521568-1', 'sagojo.com');
          ga('send', 'pageview');
        
        </script>
    
        <link rel="stylesheet" href="<?php echo bloginfo('template_directory')?>/fonts/fonts.css" type="text/css" charset="utf-8"/>
        
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js' type='text/javascript'> </script>
        
        <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/css/creativsocial-styles.css"/>

    	<script src="<?php echo bloginfo('template_directory');?>/Scripts_datepicker/jquery-1.7.1.min.js" type="text/javascript"></script> 
        
        <script src="<?php echo bloginfo('template_directory');?>/Scripts_datepicker/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script> 

        <link href="<?php echo bloginfo('template_directory');?>/Css_datepicker/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css"/>

    
    	<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/Css_mobile/normalize.css"/>
    	<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/Css_mobile/style.css"/>
        
    	<style type="text/css">
    	 #wrapper_mobile{
    		 max-width: 960px;
    		 margin: 0 auto;
    	 }
    	</style>
    	<script type="text/javascript">
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
                        
                        	<?php if ( get_header_image() != '' ) : ?>
                           
                                <div id="logo">
                                    <div id="logo-img"><a href="<?php echo home_url('/'); ?>"><img src="<?php header_image(); ?>" width="<?php if(function_exists('get_custom_header')) { echo get_custom_header() -> width;} else { echo HEADER_IMAGE_WIDTH;} ?>" height="<?php if(function_exists('get_custom_header')) { echo get_custom_header() -> height;} else { echo HEADER_IMAGE_HEIGHT;} ?>" alt="<?php bloginfo('name'); ?>" /></a></div>
                                    <div id="logo-font">
									
											<div id="logo-font-con">
												<h2>
												<a id="font-logo-soc">
													<?php _e('Job matching service for freelancers, freelance job, jobseekers and employers')?>
													
												</a>
												
												<div id="soc-jp">
														<a><?php echo '&nbsp;|&nbsp;';?></a>
														
												</div>
			
												<div id="japan-tokyo">
												
														<a><img src="<?php echo bloginfo('template_directory');?>/images/jp.png" alt="<?php _e('Tìm việc làm,tuyển dụng, việc làm hcm, tim viec lam, tuyen dung');?>"/>&nbsp;<?php _e('&nbsp;From Japan - Tokyo')?></a>
														
												</div>
												</h2>
												<div id="clear"></div>
												
											</div>
											
									</div>
                                </div><!-- end of #logo -->
 
                            <?php endif; // header image was removed ?>

                        <?php if ( !get_header_image() ) : ?>
   
                        <?php endif; // header image was removed (again) ?>
                        
                        
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
                                
                    
                    			<?php responsive_header_bottom(); // after header content hook ?>
                            
         
            </div><!-- end of #header -->
            
            <?php responsive_header_end(); // after header container hook ?>
            
        	<?php responsive_wrapper(); // before wrapper container hook ?>

             
             <!----------------------------------->
                
            <div id="wrapper" class="clearfix <?php wpjb_resume_mods(); ?>">
                
        		<?php responsive_wrapper_top(); // before wrapper content hook ?>
        		<?php responsive_in_wrapper(); // wrapper hook ?>