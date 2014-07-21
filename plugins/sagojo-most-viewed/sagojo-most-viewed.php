<?php
/*
Plugin Name: sagojo Most Viewed
Plugin URI: http://sagojo.com
Description: A plugin for display the most read posts and recent posts by category.
Version: 1.0
Author: Hanh
Author URI: http://hanhdo.besaba.com
License: GPL2
*/

//HOOKS
add_action('init','sagojo_plugin_init');
/********************************************************/
/* FUNCTIONS
********************************************************/
function sagojo_plugin_init(){
    //do work
	setPostViews($postID);
	wp_register_style( 'sagojocss', plugins_url('/sagojo-most-viewed.css', __FILE__) );
	wp_enqueue_style( 'sagojocss' );
	load_plugin_textdomain('sagojo-most-viewed', false, basename( dirname( __FILE__ ) ) . '/language');
}

function getPostViews($postID,$start){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true) + intval($start);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "<span class='count'>0</span> ".__('View','sagojo-most-viewed');
    }
    return "<span class='count'>".$count."</span> ".__('Views','sagojo-most-viewed');
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// Creating the most-read-widget 
class most_read_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'most_read_widget', 

// Widget name will appear in UI
__('sagojo Most Viewed', 'sagojo-most-viewed'), 

// Widget description
array( 'description' => __( 'Display the most read posts by category.', 'sagojo-most-viewed' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
echo "<div class='sagojo-widget'>";
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output.
	$locate = $instance[ 'locate' ];
	$start = $instance[ 'start' ];
	if ( ! empty( $locate ) ) 
	query_posts(array( 'meta_key'=>post_views_count, 'orderby'=>meta_value_num, 'posts_per_page' => 10, 'order'=>DESC ));
	else {
		$post_id = get_the_ID();
		$category = get_the_category();	
	   query_posts(array( 'cat'=>$category[0]->term_id,'meta_key'=>post_views_count, 'orderby'=>meta_value_num, 'posts_per_page' => 10, 'order'=>DESC, 'post__not_in'=>array($post_id)));
	   }
	   $j=1;
	if (have_posts()) : while (have_posts()) : the_post(); 
	if($j%2==0) $color="xam"; else $color="trang";
	?>
	<li class="color-<?php echo $color;?>"><div class="small-image"><a style="display: block;" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'small-image', array('title' => "") ); ?></div><p class="sagojo-text"><?php the_title(); ?></a></p><p class="views"><?php echo getPostViews(get_the_ID(),$start)?></p></li>
	<?php $j++;
	endwhile; endif;
	wp_reset_query();  
echo "</div>";
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}
else {
$title = __( 'Most Read Posts', 'sagojo-most-viewed' );
}
if ( isset( $instance[ 'locate' ] ) ) {
	$locate = $instance[ 'locate' ];
}
else {
	$locate = "";
}
if ( isset( $instance[ 'start' ] ) ) {
	$start = $instance[ 'start' ];
}
else {
	$start = '0';
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>
<?php $checked = esc_attr( $locate );
if (!empty($checked)) $yes = "checked"; else $yes = "";?>
<input type="checkbox" name="<?php echo $this->get_field_name( 'locate' ); ?>" value="yes" <?php echo $yes?>>
<label for="<?php echo $this->get_field_id( 'locate' ); ?>"><?php _e( 'Display in Category' ); ?></label>
</p>
<p>
<label for="<?php echo $this->get_field_id( 'start' ); ?>"><?php _e( 'Start counter at:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'start' ); ?>" name="<?php echo $this->get_field_name( 'start' ); ?>" type="text" value="<?php echo  $start; ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['locate'] = ( ! empty( $new_instance['locate'] ) ) ? strip_tags( $new_instance['locate'] ) : '';
$instance['start'] = ( ! empty( $new_instance['start'] ) ) ? $new_instance['start'] : '0';
return $instance;
}
} // Class most-read-widget ends here

// Creating the recent-post-widget 
class recent_post_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'recent_post_widget', 

// Widget name will appear in UI
__('sagojo Recent Post', 'sagojo-most-viewed'), 

// Widget description
array( 'description' => __( 'Display the recent posts by category.', 'sagojo-most-viewed' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
echo "<div class='sagojo-widget'>";
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
$locate = $instance[ 'locate' ];
	if ( ! empty( $locate ) ) 
	query_posts(array( 'meta_key'=>post_views_count, 'posts_per_page' => 10, 'order'=>DESC ));
	else {
		$post_id = get_the_ID();
		$category = get_the_category(); 	
		query_posts( array (  'cat'=>$category[0]->term_id, 'posts_per_page'=>10, 'post__not_in'=>array($post_id)));
		}
		$i=1;
	if (have_posts()) : while (have_posts()) : the_post(); 
	if ($i%2==0) $colorv="xam"; else $colorv="trang";?>
        <li class="color-<?php echo $colorv;?>"><div class="small-image"><a style="display: block;" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'small-image', array('title' => "") ); ?></div>
          <p class="sagojo-text"><?php the_title(); ?>  
          </a><span class="entry-date"> <?php  echo get_the_date();?></span></p></li>
        <?php $i++; endwhile; endif;
		wp_reset_query();
echo "</div>";
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'Recent Posts', 'sagojo-most-viewed' );
}
if ( isset( $instance[ 'locate' ] ) ) {
$locate = $instance[ 'locate' ];
}
else {
$locate = "";
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
<?php $checked = esc_attr( $locate );
if (!empty($checked)) $yes = "checked"; else $yes = "";?>
<input type="checkbox" name="<?php echo $this->get_field_name( 'locate' ); ?>" value="yes" <?php echo $yes?>>
<label for="<?php echo $this->get_field_id( 'locate' ); ?>"><?php _e( 'Display in Category' ); ?></label>
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['locate'] = ( ! empty( $new_instance['locate'] ) ) ? strip_tags( $new_instance['locate'] ) : '';

return $instance;
}
} // Class recent-post-widget ends here

// Register and load the widget
function wpb_load_most_widget() {
	register_widget( 'most_read_widget' );
}
add_action( 'widgets_init', 'wpb_load_most_widget' );

function wpb_load_recent_widget() {
	register_widget( 'recent_post_widget' );
}
add_action( 'widgets_init', 'wpb_load_recent_widget' );
?>