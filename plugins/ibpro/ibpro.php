<?php
/*
Plugin Name: ibpro
Plugin URI: http://hanhdo.besaba.com
Description: A plugin for display the Top Rebates.
Version: 1.0
Author: Hanh
Author URI: http://hanhdo.besaba.com
License: GPL2
*/

//HOOKS
add_action('init','ibpro_plugin_init');
/********************************************************/
/* FUNCTIONS
********************************************************/
function ibpro_plugin_init(){
    //do work
	wp_register_style( 'ibprocss', plugins_url('/ibpro.css', __FILE__) );
	wp_enqueue_style( 'ibprocss' );
	load_plugin_textdomain('ibpro', false, basename( dirname( __FILE__ ) ) . '/language');
}

// Creating the most-read-widget 
class ibpro_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'ibpro_widget', 

// Widget name will appear in UI
__('ibpro rebates', 'ibpro'), 

// Widget description
array( 'description' => __( 'Display the Top Rebates.', 'ibpro' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
echo "<div class='ibpro-widget'>";
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
	global $wpdb;
	$rebates = $wpdb->get_results ("SELECT * FROM wp_rebates");
	echo "<table><tr><td>Rank</td><td>Nickname</td><td>Amount</td></tr>";
	foreach ($rebates as $key => $row) {
		$rank = $row->rank;
		$nick = $row->nickname;
		$amount = $row->amount;
		echo "<tr><td>$rank</td><td>$nick</td><td>$amount</td></tr>";
		
	}
	echo "</table>";	
echo "</div>";
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'Top Rebates', 'ibpro' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class most-read-widget ends here



// Register and load the widget
function wpb_ibpro_widget_widget() {
	register_widget( 'ibpro_widget' );
}
add_action( 'widgets_init', 'wpb_ibpro_widget_widget' );


// **************************** CREATE A SETTINGS MENU IN WP-ADMIN *************************
function find_my_menu_ibpro( $handle, $sub = false ){
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
}

// double check because we also have the plugin-installer

if (! find_my_menu_ibpro( 'wp ibpro' ) )
{
	add_action('admin_menu', 'ibpro_menu',6);
	if (!function_exists('ibpro_menu'))
	{
		function ibpro_menu() {
			add_menu_page('IBPro User', 'IBPro User', 'administrator', 'wp_ibpro_menu', 'wp_ibpro_install', WP_PLUGIN_URL.'/ibpro/images/menu-icon.png' );
		}
		if (!function_exists('wp_ibpro_install'))
		{
			function wp_ibpro_install()
			{
				//include_once (ATHEMES_PATH .'/ibpro_admin.php');
				include_once (WP_PLUGIN_DIR .'/ibpro/ibpro_admin.php');
				
			}
		}
	}
}
// add all the bells and whistles
add_action('admin_menu', 'ibpro_menu2',6);
function ibpro_menu2() {
	add_submenu_page( 'wp_ibpro_menu', 'Rebates Import', 'Rebates Import', 'administrator', 'wp_ibpro_import','ibpro_menu_import' );
	function ibpro_menu_import(){
		//include_once ( ATHEMES_PATH .'/demo.php');
		include_once ( WP_PLUGIN_DIR .'/ibpro/demo.php');
	}
}
?>