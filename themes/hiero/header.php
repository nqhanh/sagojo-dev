<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package aThemes
 */
$at_options = get_option('at_options');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php wp_title( '-', true, 'right' ); ?></title>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php if ( !empty( $at_options['site_favicon'] ) ) : ?>
	<link rel="icon" href="<?php echo $at_options['site_favicon']; ?>" type="image/x-icon" />
    <?php endif; ?>
	<?php if ( !empty( $at_options['site_apple_icon'] ) ) : ?>
	<link rel="apple-touch-icon" href="<?php echo $at_options['site_apple_icon']; ?>" />
    <?php endif; ?>

	<?php wp_head(); ?>
	<?php echo $at_options['code_header']; ?>
	
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body <?php body_class(); ?>>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1&appId=159226384286347";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<div class="clearfix container">
			

			<?php //if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>
			<?php //endif; //mang xa hoi?> 

			<nav id="main-navigation" class="main-navigation" role="navigation">
				<a href="#main-navigation" class="nav-open">Menu</a>
				<a href="#" class="nav-close">Close</a>
				<?php wp_nav_menu( array( 'container_class' => 'clearfix sf-menu', 'theme_location' => 'main' ) ); ?>
			<!-- #main-navigation --></nav>
			<!--<img src="<?php// echo bloginfo('template_directory')?>/images/titleimg_2013.gif" title="a-line" alt="a-line">-->
		</div>
	<header id="masthead" class="site-header" role="banner">
		
	<!-- #masthead --></header>

	<div id="main" class="site-main">
		<div class="clearfix container">