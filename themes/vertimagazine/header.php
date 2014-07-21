<?php
/**
 * The Header for our theme.
 *
 *
 * @package vertiMagazine theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title>

<?php if (is_home () ) {
	bloginfo('name');
} elseif ( is_category() ) {
	single_cat_title(); echo ' - ' ; bloginfo('name');
} elseif (is_single() ) {
	$customField = get_post_custom_values("title");
	if (isset($customField[0])) {
		echo $customField[0];
	} else {
		single_post_title();
	}
} elseif (is_page() ) {
	bloginfo('name'); echo ': '; single_post_title();
} else {
	wp_title('',true);
} ?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1&appId=394203120706833";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like" data-href="<?php echo get_permalink();?>" data-width="600" data-height="100" data-colorscheme="light" data-layout="standard" data-action="like" data-show-faces="true" data-send="false"></div>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
  <div id="topnav">
	<nav>
    
	
	</nav>
			 <div class="navbar">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-th-list"></span>
						</a>
						
						<div class="nav-collapse collapse">
							<ul class="nav">
								<?php $menuParameters = array(
									'container'	   => false,
									'echo'			=> false,
									'items_wrap'	  => '%3$s',
									'depth'		   => 2,
									'theme_location'=>'top_menu',);

									if ( has_nav_menu('top_menu') ) { echo wp_nav_menu( $menuParameters ); } ?>  
								
							</ul>
								   
						</div>
						<div id="socialmedia">
							<ul class="nav2 pull-right">
								<li> <a href="<?php $fb = get_option("facebook"); echo $fb; ?>" target="_blank"><img src="<?php $path = get_template_directory_uri(); echo $path; ?>/images/facebook.png" alt="facebook"></a> </li>
								<li> <a style="display: block; margin-top: 1px;" href="<?php $tw = get_option("twitter"); echo $tw; ?>" target="_blank"><img src="<?php $path = get_template_directory_uri(); echo $path; ?>/images/twitter.png" alt="twitter"></a> </li>
								<li> <a href="<?php $yt = get_option("youtube"); echo $yt; ?>" target="_blank"><img src="<?php $path = get_template_directory_uri(); echo $path; ?>/images/youtube.png" alt="youtube"></a> </li>
							</ul>
							</div>
					</div>
				</div>
			</div>
	</div> 

	<span class="clear"></span>
	<header>
		<div id="logo">
			<a href="<?php echo home_url(); ?>">
            <?php // $password = (isset($_POST['password']) ? $_POST['password'] : ''); ?>
            
				<img src="<?php
                    $default_logo = get_template_directory_uri() . "/img/logo-default.png";
                    $tl = ((get_option("logo_sus") != '') ? get_option("logo_sus") : $default_logo ); 
                    echo $tl; 
                ?>" alt="<?php bloginfo('description'); ?>"/>
			</a>
		</div><!--/logo-->
		<!--/responsive social media-->
			<div id="respon_socialmedia">
				<a href="<?php $fb = get_option("facebook"); echo $fb; ?>"  target="_blank"><img src="<?php $path = get_template_directory_uri(); echo $path; ?>/images/r_facebook.png" alt="facebook"></a>
				<a href="<?php $tw = get_option("twitter"); echo $tw; ?>"  target="_blank"><img src="<?php $path = get_template_directory_uri(); echo $path; ?>/images/r_twitter.png" alt="twitter"></a>
				<a href="<?php $yt = get_option("youtube"); echo $yt; ?>"  target="_blank"><img src="<?php $path = get_template_directory_uri(); echo $path; ?>/images/r_youtube.png" alt="youtube"></a>
			</div><!--/socialmedia-->
		<!--/responsive social media-->
		<div id="search">
			<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
				<input class="search" type="text" value="type the keyword here" name="s" id="s" onfocus="this.value=''" />
				<input class="searchbutton" type="submit" id="searchsubmit" value="search" />
			</form>
		</div><!--/search-->
	</header>
	<div id="headernav">
		<?php 
				$menuParameters = array(
				  'container'	   => false,
				  'echo'			=> false,
				  'items_wrap'	  => '%3$s',
				  'depth'		   => 1,
				  'theme_location'=>'header_menu',
				);
				if ( has_nav_menu('header_menu') ) {
					echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' ); 
				}
			?>
	</div><!--/headernav-->