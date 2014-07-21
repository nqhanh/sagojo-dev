<?php
// setup functions wp-freelance

// ************ CPT **************************
add_action( 'init', 'wpfrl_create_post_type' );

function wpfrl_create_post_type() {
	register_post_type( 'freelance_post',
		array(
			'labels' => array(
				'name' => 'Freelance Projects',
				'singular_name' => 'freelance Project',
				'menu_name' => 'Freelance Post'
			),
		'description'     => 'a job or project for the freelance section',
		'public'          => true,
		'has_archive'     => true,
		'capability_type' => 'post',
		'query_var'       => true,
		'rewrite'         => array('with_front' => false,'slug' => 'project'),
		'taxonomies'      => array('freelance_tag','freelance_category'),
		'supports'        => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields','comments' )
		)
	);
}

if (!taxonomy_exists('freelance_tag'))	
		{		
		// and tie the new taxo to the posts
		  register_taxonomy('freelance_tag','freelance_post', array(
			'hierarchical' => false,
			'show_ui' => true,
			'labels' => array(
			'name' => 'freelance tag',
			'singular_name' => 'freelance tag',
			'search_items' => 'search freelance tag',			
			'menu_name' => 'freelance tag',
			),	
			'query_var' => true,
			'rewrite' => array( 'with_front' => false,'slug' => 'freelance-tag' ),
		  ));
		}
if (!taxonomy_exists('freelance_category'))	
		{		
		// and tie the new taxo to the posts
		  register_taxonomy('freelance_category','freelance_post', array(
			'hierarchical' => true,
			'show_ui' => true,
			'labels' => array(
			'name' => 'freelance category',
			'singular_name' => 'freelance category',
			'search_items' => 'search freelance category',			
			'menu_name' => 'freelance category',
			),
			'query_var' => true,
			'rewrite' => array( 'with_front' => false,'slug' => 'freelance-category' ),
		  ));
		}
		
// ************ FLUSH PERM ON THEME SWITCH **************************		
function wpfrl_perm($oldname, $oldtheme=false) {
 flush_rewrite_rules();
}
add_action("after_switch_theme", "wpfrl_perm", 10 ,  2);
add_action("switch_theme", "wpfrl_perm", 10 , 2);

		
// ************ CREATE DATABASE **************************
function wpf_init() {
global $wpdb;
$table_name = $wpdb->prefix . "freelance";
		$sql2 = "CREATE TABLE $table_name (
		  pid mediumint(9) NOT NULL,
		  fname VARCHAR( 30 ) DEFAULT '' NOT NULL,
		  lname VARCHAR( 30 ) DEFAULT '' NOT NULL,
		  email VARCHAR( 30 ) DEFAULT '' NOT NULL,
		  zip VARCHAR( 10 ) DEFAULT '' NOT NULL,
		  actcode VARCHAR( 20 ) DEFAULT '' NOT NULL,
		  timein int(10) DEFAULT '0' NOT NULL,
		  visitorip VARCHAR( 16 ) DEFAULT '' NOT NULL,
		  UNIQUE KEY pid (pid)
		);";			
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql2);
}

// ************ GET IP **************************
function wpf_getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

// *********** CRON ***************************
add_action('wp', 'wpfrl_activation');
add_action('wpfrl_mail', 'wpfrlmail');

register_deactivation_hook(__FILE__, 'wpfrl_deactivation');
register_activation_hook(__FILE__, 'wpfrl_activation');


function wpfrl_deactivation() {
	wp_clear_scheduled_hook('wpfrl_mail');
}

function wpfrl_activation() {
	if ( !wp_next_scheduled( 'wpfrl_mail' ) ) {
		wp_schedule_event(time(), 'daily', 'wpfrl_mail');
	}
}

function wpfrlmail()
	{
	// future
	}
	
/*function wpfrl_notice()
	{
	$expire = get_option('wpfrloutdate' , 0);
	if ($expire)
		{
		echo '<div class="error">
		   <p>Your wp freelance pro theme is outdated ! Please visit <a href="http://wpfreelancepro.com">freelancepro.com</a> to get your (security ?) updates.</p>
		</div>';
		}
	}
	
add_action('admin_notices', 'wpfrl_notice');*/
// ***********END CRON ***************************

// *********** WP SIGNUP LOGO ********************
function wpfrl_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url(' . get_bloginfo('stylesheet_directory') .'/library/images/wpfrllogo.png) !important; }
    </style>';
}

add_action('login_head', 'wpfrl_logo');

// ************* HACK PAGINATION *******************
add_action( 'parse_query','wpfrl_changept' );
function wpfrl_changept() {
		if ( is_paged() && is_home() )
		set_query_var( 'post_type', array( 'freelance_post' )) ;
	return;
}

// ************* LOCAL BREADCRUMBS ******************
function wpfrl_breadcrumb() {
	$pid = $post->ID;
	$trail = '<a href="/">'. __('Home', 'wpfrl') .'</a>';
	get_post_type();
	
	if (is_front_page()) {
        // do nothing
	}
	 if ('freelance_post' == get_post_type() ) {		
			$trail .= " &raquo; ";
			$trail .= "<a href='" . get_bloginfo('url') . "/project/'> project</a>";
		}
		
	if (is_page()) {
		$bcarray = array();
		$pdata = get_post($pid);
		$bcarray[] = ' &raquo; '.$pdata->post_title."\n";
	while ($pdata->post_parent) {
		$pdata = get_post($pdata->post_parent);
		$bcarray[] = ' &raquo; <a href="'.get_permalink($pdata->ID).'">'.$pdata->post_title.'</a>';
	}
	$bcarray = array_reverse($bcarray);
		foreach ($bcarray AS $listitem) {
			$trail .= $listitem;
		}
	}
	elseif (is_single()) {
		$pdata = get_the_category($pid);
		$adata = get_post($pid);
		if(!empty($pdata)){
			$data = get_category_parents($pdata[0]->cat_ID, TRUE, ' &raquo; ');
			$trail .= " &raquo; ".substr($data,0,-8);
		}
		$trail.= ' &raquo; '.$adata->post_title."\n";
	}
   	elseif (is_category()) {
		$pdata = get_the_category($pid);
		$data = get_category_parents($pdata[0]->cat_ID, TRUE, ' &raquo; ');
		if(!empty($pdata)){
			$trail .= " &raquo; ".substr($data,0,-8);
		}
   }
    
	$trail.="";
	return $trail;
}

// **************************** CREATE A SETTINGS MENU IN WP-ADMIN *************************
/*function find_my_menu_item2( $handle, $sub = false ){
  if( !is_admin() || (defined('DOING_AJAX') && DOING_AJAX) )
    return false;
  global $menu, $submenu;
  $check_menu = $sub ? $submenu : $menu;
  if( empty( $check_menu ) )
    return false;
  foreach( $check_menu as $k => $item ){
    if( $sub ){
      foreach( $item as $sm ){
        if($handle == $sm[2])
          return true;
      }
    } else {
      if( $handle == $item[2] )
        return true;
    }
  }
  return false;
}*/

// double check because we also have the plugin-installer
	
/*if (! find_my_menu_item2( 'wp freelance' ) )
	{
	add_action('admin_menu', 'wpfrl_menu',6);
	if (!function_exists('wpfrl_menu'))
		{
		function wpfrl_menu() {
			add_menu_page('wpfrl_menu', 'wp freelance', 'administrator', 'wpfrl_mainmenu', 'wpfrl_install', get_bloginfo('stylesheet_directory') .'/library/images/menu-icon.png' );
			add_submenu_page( 'wpfrl_mainmenu', 'install', 'install', 'administrator', 'listings','wpfrl_install' );	
			}	
			if (!function_exists('wpfrl_install'))
				{
				function wpfrl_install()
					{
					include_once(get_theme_root() . '/responsive/menus/wpfrl_install.php');
					}
				}
		}
	}
// add all the bells and whistles
add_action('admin_menu', 'wpfrl_menu2',6);	
	function wpfrl_menu2() {
	add_submenu_page( 'wpfrl_mainmenu', 'setup', 'setup', 'administrator', 'settings','wpfrl_settings2' );		
			function wpfrl_settings2(){
			include_once(get_theme_root() . '/responsive/menus/wpfrl_settings.php');
			}	
		}*/