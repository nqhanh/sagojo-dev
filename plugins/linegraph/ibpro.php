<?php
/*
Plugin Name: linegraph
Plugin URI: http://hanhdo.besaba.com
Description: A plugin for display the Top Rebates.
Version: 1.0
Author: Hanh
Author URI: http://hanhdo.besaba.com
License: GPL2
*/

//HOOKS
add_action('init','linegraph_plugin_init');
/********************************************************/
/* FUNCTIONS
********************************************************/
function linegraph_plugin_init(){
    //do work //load file java, css, lang...
	wp_register_style( 'linegraphcss', plugins_url('/linegraph.css', __FILE__) );
	wp_enqueue_style( 'linegraphcss' );
	load_plugin_textdomain('linegraph', false, basename( dirname( __FILE__ ) ) . '/language');
}

// Creating the most-read-widget 
class FeatureEmployer_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'FeatureEmployer_widget', 

// Widget name will appear in UI
__('Featured Employer', 'ibpro'), 

// Widget description
array( 'description' => __( 'Displays featured employer logo.', 'ibpro' ), ) 
);
}

// Creating widget front-end code hien thi tren wweb
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
echo "<div class='feature-widget'>";
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];?>
<?php
// This is where you run the code and display the output
	global $wpdb;
	$rebates = $wpdb->get_results ("SELECT id,company_name,company_logo_ext FROM wpjb_employer WHERE is_logo > 0 ORDER BY RAND() LIMIT 12");
	$i=1;
	foreach ($rebates as $key => $row) {
	if($i%6==0)	echo "<div class='employerlogo grid col-140 fit'>";
	else echo "<div class='employerlogo grid col-140'>";
		echo "<span><a href=\"".site_url()."/tim-viec-lam/company/".$row->id."/\"><img src=\"".site_url()."/wp-content/plugins/wpjobboard/environment/company/logo_".$row->id.".".$row->company_logo_ext."\" alt=\"\" title=\"".$row->company_name."\" class=\"grayscale\" /></a><span>";		
	echo "</div>";
	$i++;	
	}
echo "</div>";
?>

<?php
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'Featured Employer', 'ibpro' );
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
} // Class most-read-widget ends here //hien ben tay phai



// Register and load the widget
function wpb_featured_widget() {
	register_widget( 'FeatureEmployer_widget' );
}
add_action( 'widgets_init', 'wpb_featured_widget' );

/*Start*/



// Creating the most-read-widget 
class Jobs_blog_widget extends WP_Widget {

		function __construct() {
				parent::__construct(
				// Base ID of your widget
				'Jobs_blog_widget', 

				// Widget name will appear in UI
				__('Jobs blog widget', 'ibpro'), 

				// Widget description
				array( 'description' => __('Hien thi Category danh cho Hau.', 'ibpro' ), ) 
				);
		}

		// Creating widget front-end code hien thi tren wweb
		// This is where the action happens
		public function widget( $args, $instance ) {
				$title = apply_filters( 'widget_title', $instance['title'] );
				// before and after widget arguments are defined by themes
				echo $args['before_widget'];
				echo "<div class='feature-widget'>";
				if ( ! empty( $title ) )
				echo $args['before_title'] . $title . $args['after_title'];?>
				<?php
				// This is where you run the code and display the output
					//code show category;
					//$category_title = __("Blog");
					// Get the ID of a given category
					$category_id =187;
 $args = array(
	'show_option_all'    => '',
	'orderby'            => 'name',
	'order'              => 'ASC',
	'style'              => 'list',
	'show_count'         => 0,
	'hide_empty'         => 0,
	'use_desc_for_title' => 1,
	'child_of'           => 187,
	'exclude'            => '',
	'exclude_tree'       => '',
	'include'            => '',
	'hierarchical'       => 1,
	'title_li'           => '',
	'show_option_none'   => __( 'No categories' )

); 
					// Get the URL of this category
					$category_link = get_category_link($category_id );
				
					 wp_list_categories($args);
				echo "</div>";
				?>

				<?php
				echo $args['after_widget'];
		}
				
		// Widget Backend    //hien ben tay phai
		public function form( $instance ) {
			if ( isset( $instance[ 'title' ] ) ) {
				$title = $instance[ 'title' ];
			}
			else {
				$title = __( 'Jobs blog widget', 'ibpro' );
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
function wpb_blog_widget() {
	register_widget( 'Jobs_blog_widget' );
}
add_action( 'widgets_init', 'wpb_blog_widget' );

/* end tao cnvl
          */

// **************************** CREATE A SETTINGS MENU IN WP-ADMIN *************************
function find_my_menu_linegraph( $handle, $sub = false ){
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

if (! find_my_menu_linegraph( 'wp linegraph' ) )
{
	add_action('admin_menu', 'linegraph_menu',6);
	if (!function_exists('linegraph_menu'))
	{
		function linegraph_menu() {
			add_menu_page('Organic graph', 'Organic graph', 'edit_posts', 'wp_linegraph_menu', 'wp_linegraph_install', WP_PLUGIN_URL.'/linegraph/images/menu-icon.png' );
		}
		if (!function_exists('wp_linegraph_install'))
		{
			function wp_linegraph_install()
			{
				//include_once (ATHEMES_PATH .'/linegraph_admin.php');
				include_once (WP_PLUGIN_DIR .'/linegraph/linegraph_admin.php');
				
			}
		}
	}
}
// add all the bells and whistles
add_action('admin_menu', 'linegraph_menu2',6);
function linegraph_menu2() {
	add_submenu_page( 'wp_linegraph_menu', 'Daily graph', 'Daily graph', 'edit_posts', 'wp_linegraph_daily','linegraph_menu_daily' );
	function linegraph_menu_daily(){
		//include_once ( ATHEMES_PATH .'/demo.php');
		include_once ( WP_PLUGIN_DIR .'/linegraph/daily.php');
	}
}

// add all the bells and whistles
add_action('admin_menu', 'linegraph_menu3',6);
function linegraph_menu3() {
	add_submenu_page( 'wp_linegraph_menu', 'Since launch', 'Since launch', 'edit_posts', 'wp_linegraph_organic','linegraph_menu_organic' );
	function linegraph_menu_organic(){
		include_once ( WP_PLUGIN_DIR .'/linegraph/organic.php');
	}
}
// add all the bells and whistles
add_action('admin_menu', 'linegraph_menu4',6);
function linegraph_menu4() {
	add_submenu_page( 'wp_linegraph_menu', 'Job view', 'Job view', 'edit_posts', 'wp_linegraph_viewed','linegraph_menu_viewed' );
	function linegraph_menu_viewed(){
		include_once ( WP_PLUGIN_DIR .'/linegraph/viewed.php');
	}
}
// add all the bells and whistles
add_action('admin_menu', 'linegraph_menu5',6);
function linegraph_menu5() {
	add_submenu_page( 'wp_linegraph_menu', 'Coupon', 'Coupon', 'edit_posts', 'wpjb/wp_linegraph_coupon','linegraph_menu_coupon' );
	function linegraph_menu_coupon(){
		include_once ( WP_PLUGIN_DIR .'/linegraph/coupon_page.php');
	}
}
// add all the bells and whistles
add_action('admin_menu', 'linegraph_menu6',6);
function linegraph_menu6() {
	add_submenu_page( 'linegraph_menu_coupon', 'Action', 'Action', 'edit_posts', 'wp_linegraph_action','linegraph_menu_action' );
	function linegraph_menu_action(){
		include_once ( WP_PLUGIN_DIR .'/linegraph/action.php');
	}
}
// add all the bells and whistles
add_action('admin_menu', 'linegraph_menu7',6);
function linegraph_menu7() {
	add_submenu_page( 'linegraph_menu_coupon', 'insertform', 'insertform', 'edit_posts', 'wp_linegraph_insertform','linegraph_menu_insertform' );
	function linegraph_menu_insertform(){
		include_once ( WP_PLUGIN_DIR .'/linegraph/insertform.php');
	}
}
// add all the bells and whistles
add_action('admin_menu', 'linegraph_menu8',6);
function linegraph_menu8() {
	add_submenu_page( 'linegraph_menu_coupon', 'insert', 'insert', 'edit_posts', 'wp_linegraph_insert','linegraph_menu_insert' );
	function linegraph_menu_insert(){
		include_once ( WP_PLUGIN_DIR .'/linegraph/insert.php');
	}
}
// add all the bells and whistles
add_action('admin_menu', 'linegraph_menu9',6);
function linegraph_menu9() {
	add_submenu_page( 'wp_linegraph_menu', 'Applications', 'Applications', 'edit_posts', 'wpjb/wp_linegraph_application','linegraph_menu_application' );
	function linegraph_menu_application(){
		include_once ( WP_PLUGIN_DIR .'/linegraph/application.php');
	}
}
// add all the bells and whistles
add_action('admin_menu', 'linegraph_menu10',6);
function linegraph_menu10() {
	add_submenu_page( 'wp_linegraph_menu', 'Employer Logos', 'Employer Logos', 'edit_posts', 'wpjb/wp_linegraph_logo','linegraph_menu_logo' );
	function linegraph_menu_logo(){
		include_once ( WP_PLUGIN_DIR .'/linegraph/logo.php');
	}
}
?>