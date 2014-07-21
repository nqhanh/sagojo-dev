<?php class sagojo_fromcategorieswidget extends WP_Widget
{
    function sagojo_fromcategorieswidget(){
    }
  //Displays the Widget in the front-end
    function widget($args, $instance){
    }
  //Saves the settings.
    function update($new_instance, $old_instance){
    }
  //Creates the form for the widget in the back-end.
    function form($instance){
    }
} // end sagojo_fromcategorieswidget class
function sagojo_fromcategorieswidgetInit() {
  register_widget('sagojo_fromcategorieswidget');
}
add_action('widgets_init', 'sagojo_fromcategorieswidgetInit');



function sagojo_fromcategorieswidget(){
    $widget_ops = array('description' => 'Hi?n th? category m?i nh?t');
    $control_ops = array('width' => 400, 'height' => 300);
    parent::WP_Widget(false,$name='Recent From Categories Widget',$widget_ops,$control_ops);
}



function form($instance){
//Defaults
    $instance = wp_parse_args( (array) $instance, array('title'=>'Tiêu d? Categories', 'posts_number'=>'5', 'blog_category'=>'') );
    $title = esc_attr($instance['title']);
    $posts_number = (int) $instance['posts_number'];
    $blog_category = (int) $instance['blog_category'];
    # Title
    echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
    # Number Of Posts
    echo '<p><label for="' . $this->get_field_id('posts_number') . '">' . 'S? lu?ng hi?n th?:' . '</label><input id="' . $this->get_field_id('posts_number') . '" name="' . $this->get_field_name('posts_number') . '" type="text" value="' . $posts_number . '" /></p>';
    # Category ?>
    <?php
        $cats_array = get_categories('hide_empty=0');
    ?>
    <p>
        <label for="<?php echo $this->get_field_id('blog_category'); ?>">Category</label>
        <select name="<?php echo $this->get_field_name('blog_category'); ?>" id="<?php echo $this->get_field_id('blog_category'); ?>" class="widefat">
            <?php foreach( $cats_array as $category ) { ?>
                <option value="<?php echo $category->cat_ID; ?>"<?php selected( $instance['blog_category'], $category->cat_ID ); ?>><?php echo $category->cat_name; ?></option>
            <?php } ?>
        </select>
    </p>
<?php
}
?>
<?php 
function update($new_instance, $old_instance){
    $instance = $old_instance;
    $instance['title'] = stripslashes($new_instance['title']);
    $instance['posts_number'] = (int) $new_instance['posts_number'];
    $instance['blog_category'] = (int) $new_instance['blog_category'];
    return $instance;
}


function widget($args, $instance){
    extract($args);
    $title = apply_filters('widget_title', empty($instance['title']) ? 'Recent From ' : $instance['title']);
    $posts_number = empty($instance['posts_number']) ? '' : (int) $instance['posts_number'];
    $blog_category = empty($instance['blog_category']) ? '' : (int) $instance['blog_category'];
    echo $before_widget;
    if ( $title )
    echo $before_title . $title . $after_title;
?>


    <?php query_posts("showposts=".$posts_number."&cat=".$blog_category);
    if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="block-post clearfix">
            <h3 class="title"><a href="<?php the_permalink(); ?>"><?php echo mb_substr(the_title('','',FALSE),0,35,'UTF-8');?>&hellip;</a></h3>
        </div> <!-- end .block-post -->
    <?php endwhile; endif; wp_reset_query(); ?>
<?php
    echo $after_widget;
}?>
<?php

