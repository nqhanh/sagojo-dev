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
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" id="personal-google-rochester-css" href="http://fonts.googleapis.com/css?family=Rochester&amp;ver=3.7-beta2-25801" type="text/css" media="all">
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
	
<style >
::-webkit-scrollbar {
	width: 12px;
}

::-webkit-scrollbar-thumb {
-webkit-border-radius: 10px;
border-radius: 10px;
background: #9A9657;/*rgba(4,189,250,0.8);*/
-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
}


::-webkit-scrollbar-track {
-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
-webkit-border-radius: 10px;
border-radius: 10px;
background: #fff;
}
</style>
	
</head>

<body <?php body_class(); ?>>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=159226384286347";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Netoops Blog Facebook Widget Start --><script type="text/javascript">/*<![CDATA[*/jQuery(document).ready(function() {jQuery(".noopslikebox").hover(function() {jQuery(this).stop().animate({right: "0"}, "medium");}, function() {jQuery(this).stop().animate({right: "-250"}, "medium");}, 500);});/*]]>*/</script><style type="text/css">.noopslikebox{background: url("http://sagojo.com/wp-content/uploads/2013/11/NBT-facebook_static-button1.png") no-repeat scroll left center transparent !important;display: block;float: right;height: 270px;padding: 0 5px 0 42px;width: 245px;z-index: 9999999;position:fixed;right:-250px;top:20%;}.noopslikebox div{border:none;position:relative;display:block;}.noopslikebox span{bottom: 12px;font: 8px "lucida grande",tahoma,verdana,arial,sans-serif;position: absolute;right: 7px;text-align: right;z-index: 999;}.noopslikebox span a{color: gray;text-decoration:none;}.noopslikebox span a:hover{text-decoration:underline;}</style><div class="noopslikebox"><div><iframe src="http://www.facebook.com/plugins/likebox.php?href=https://www.facebook.com/sagojocom&amp;width=245&amp;colorscheme=light&amp;show_faces=true&amp;connections=12&amp;stream=false&amp;header=false&amp;height=270" scrolling="no" frameborder="0" scrolling="no" style="border: medium none; overflow: hidden; height: 270px; width: 245px;background:#fff;"></iframe></div><a href='http://sagojo.com'><img src='http://sagojo.com/wp-content/uploads/2013/11/1x1juice.png'/></a></div><!--NetOops Blog Widgets@netoopsblog.blogspot.com --><!-- NetOops Blog Facebook Widget End -->

<style type='text/css'>
    #bttop{
        border:1px solid #9A9657;
        background:#9A9657;
        text-align:center;
        padding:8px;
        position:fixed;
        bottom:35px;
        right:10px;
        cursor:pointer;
        display:none;
        color:#fff;
        font-size:11px;
        font-weight:900;
        
    }
     #bttop:hover{
        
        border:1px solid #000;
        background:#000;
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
	<header id="masthead" class="site-header" role="banner">
		<div class="clearfix container">
			<div class="site-branding">
			<?php
				$heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
				if ( !empty( $at_options['site_logo'] ) ) :
			?>
				<<?php echo $heading_tag; ?> class="site-title">
					<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img src="<?php echo $at_options['site_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>" />
					</a>
				</<?php echo $heading_tag; ?>>
			<?php else : ?>
				<<?php echo $heading_tag; ?> class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</<?php echo $heading_tag; ?>>
				<div class="site-description"><?php bloginfo( 'description' ); ?></div>
			<?php endif; ?>
			<!-- .site-branding --></div>

			<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>
			<?php endif; ?>

		
		</div>
	<!-- #masthead --></header>
		<nav id="main-navigation" class="main-navigation" role="navigation">
				<a href="#main-navigation" class="nav-open">Menu</a>
				<a href="#" class="nav-close">Close</a>
				
				<?php wp_nav_menu( array( 'container_class' => 'clearfix sf-menu', 'theme_location' => 'main' ) ); ?>
			<!-- #main-navigation --></nav>

	<div id="main" class="site-main">
		<div class="clearfix container">
		