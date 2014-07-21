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
<?php //include('bbit-compress.php'); ?>  
<!doctype html>
<!--[if !IE]>     --> <html class="no-js non-ie" <?php language_attributes(); ?>> <!--[endif]-->
<!--[if IE 7 ]>  -->  <html class="no-js ie7" <?php language_attributes(); ?>> <!--[endif]-->
<!--[if IE 8 ]>   --> <html class="no-js ie8" <?php language_attributes(); ?>> <!--[endif]-->
<!--[if IE 9 ]>    --><html class="no-js ie9" <?php language_attributes(); ?>> <!--[endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
<meta http-equiv="Content-Type" content="text/html; charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo bloginfo('template_directory');?>/images/favicon.ico"/>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<title><?php wp_title('&#124;', true, 'right'); ?></title>
<meta property="fb:app_id" content="1436191323271276"/>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />


<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js' type='text/javascript'> </script> -->

<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/css/creativsocial-styles.css"/>
	<!--Tabber---->
	<link type="text/css" rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/css/responsive-tabs.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/css/style.css" />
	<?php //css and java slideshow?>
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/css/slider/reset.css" type="text/css"   charset="utf-8" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/css/slider/style.css" type="text/css" charset="utf-8" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/css/slider/fractionslider.css" type="text/css" charset="utf-8">
	<script src="<?php echo bloginfo('template_directory');?>/js/slider/jquery.fractionslider.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo bloginfo('template_directory');?>/js/slider/main.js" type="text/javascript" charset="utf-8"></script>
	<?php //end css slideshow?>



	<?php 
		if(qtrans_getLanguage()=='en') { ?>
		<meta name="language" content="English"/>		
		<?php }		
		if(qtrans_getLanguage()=='vi'){ ?>
			<meta name="language" content="Vietnamese"/>
		<?php 	
      // put your code here if the current language code is 'en' (English)
		} elseif(qtrans_getLanguage()=='ja') { ?>
			<meta name="language" content="Japanese"/>	
      <?php // put your code here if the current language code is 'id' (Indonesian)
    }	
	?>    	
<style>
 #wrapper_mobile{
     /*max-width: 960px; */  
     margin: 0 auto;       
 }
</style>
	<!--CSS of datetime picker Add Project-->
	<link href="<?php echo bloginfo('template_directory');?>/css/kendo_002.css" rel="stylesheet">
	<link href="<?php echo bloginfo('template_directory');?>/css/kendo.css" rel="stylesheet">
	<!--END CSS of datetime picker Add Project-->
	<!--CSS of datetime picker Resume-->
	<link href="<?php echo bloginfo('template_directory');?>/Css_datepicker/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
	<!--CSS of datetime picker Resume-->
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/Css_mobile/normalize.css"/>
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory');?>/Css_mobile/style.css"/>
	<link href="<?php echo bloginfo('template_directory');?>/star_rating/css/rating_style.css" rel="stylesheet" type="text/css" media="all">
	<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/star_rating/js/rating_update.js"></script>		
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
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
	<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/js/jquery.isotope.min.js"></script>
	
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&appId=1436191323271276&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">
		/*
		* Author: Ryan Sutana
		* Author URI: http://www.sutanaryan.com/
		* Description: This snippet add more site functionality.
		*/

		var _rys = jQuery.noConflict();
		_rys("document").ready(function(){
		
			_rys(window).scroll(function () {
				if (_rys(this).scrollTop() > 136) {
					_rys('.nav-container').addClass("f-nav");
				} else {
					_rys('.nav-container').removeClass("f-nav");
				}
			});

		});
	</script>
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
               	<?php responsive_header_top(); // before header content hook ?>
                <div id="header" ><div id="header-top">
                     <?php responsive_in_header(); // header hook ?>
                        <?php get_sidebar('top'); ?>
                        	<?php if ( get_header_image() != '' ) : ?>
                                <div id="logo">
                                    <div id="logo-img"><a href="<?php echo home_url('/'); ?>" title="Tìm việc làm, công việc, tuyển dụng,viec lam,cong viec"><img src="<?php header_image(); ?>" width="<?php if(function_exists('get_custom_header')) { echo get_custom_header() -> width;} else { echo HEADER_IMAGE_WIDTH;} ?>" height="<?php if(function_exists('get_custom_header')) { echo get_custom_header() -> height;} else { echo HEADER_IMAGE_HEIGHT;} ?>" alt="<?php bloginfo('name'); ?>" /></a></div>
                                    <div id="logo-font">
											<div id="logo-font-con" style="float: left;">
												<a id="font-logo-soc">
													<?php _e('Job matching and Job auctioning service for freelancers, jobseekers, employers and agencies')?>
													<?php echo '&nbsp;|&nbsp;';?>
													<img id="flag_id" title="Form Japan - Tokyo" src="<?php echo bloginfo('template_directory');?>/images/jp.png"/>&nbsp;<?php _e('&nbsp;From Japan - Tokyo')?>
												</a>
												<div id="clear"></div>
											</div>
									</div>
                                </div><!-- end of #logo -->
								
                            <?php endif; // header image was removed ?>
                        <?php if ( !get_header_image() ) : ?>
                        <?php endif; // header image was removed (again) ?>
						</div> <!--end header-top-->
						<div class="nav-container"><div class="nav-twomenu">
                     				<?php wp_nav_menu(array(
                    				    'container'       => 'div',
                    						'container_class'	=> 'main-nav',
                    						'fallback_cb'	  =>  'responsive_fallback_menu',
                    						'theme_location'  => 'header-menu')
                    					); 
                    				?> <div style="float:right;"><?php get_sidebar('gallery');?></div>
							</div><div id="button">
                                    <label href="#" id="pull"><a>menu</a></label> 
                             </div>
						</div><!--end nav-container-->
                              
                    			<?php responsive_header_bottom(); // after header content hook ?>
								
            </div><!-- end of #header -->
            <?php responsive_header_end(); // after header container hook ?>
        	<?php responsive_wrapper(); // before wrapper container hook ?>             
            <div id="wrapper" class="clearfix <?php wpjb_resume_mods(); ?>">
        		<?php responsive_wrapper_top(); // before wrapper content hook ?>
        		<?php responsive_in_wrapper(); // wrapper hook ?>
        		<?php include("wp-content/themes/responsive/wordpress_users_online.php");
			update_user_online();?>