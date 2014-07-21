<?php
/**
 * Plugin Name: Recent Posts
 */

add_action( 'widgets_init', 'gamepress_recent_posts_load_widgets' );

function gamepress_recent_posts_load_widgets() {
	register_widget( 'gamepress_recent_posts_widget' );
}

class gamepress_recent_posts_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function gamepress_recent_posts_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'gamepress_tabbed_widget', 'description' => __('Displays a list of recent posts, reviews and videos in a tabbed widget', 'gamepress') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'gamepress_tabbed_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'gamepress_tabbed_widget', __('GamePress: Recent news, reviews & videos', 'gamepress'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$tab1_title = $instance['tab1_title'];
		$tab1_content = $instance['tab1_content'];
		$tab2_title = $instance['tab2_title'];
		$tab2_content = $instance['tab2_content'];
		$tab3_title = $instance['tab3_title'];
        $tab3_content = $instance['tab3_content'];
		$number = $instance['number'];

		?>
		<div class="widget reviews_widget">
			<div class="tabs-wrapper">
			
			<ul class="tabs-nav tabs">
                <?php for ( $x = 1; $x < 4; $x++ ) : if ( ${'tab' . $x .'_title'} ) : ?>
				<li><a href="#"><?php echo ${'tab' . $x .'_title'}; ?></a></li>
                <?php endif; endfor; ?>
			</ul>

            <?php 
            for ( $i = 1; $i < 4; $i++ ) : 
                switch ( ${'tab' . $i .'_content'} ) : 
                    case 'reviews' : 
                        get_reviews( $i, $number );
                        break;
                    case 'news' : 
                        get_news( $i, $number );
                        break;
                    case 'videos' : 
                        get_videos( $i, $number );
                        break;
                endswitch;
            endfor;
            ?>

		</div>
		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['number'] = strip_tags( $new_instance['number'] );
		$instance['tab1_title'] = strip_tags( $new_instance['tab1_title'] );
        $instance['tab1_content'] = strip_tags( $new_instance['tab1_content'] );
        $instance['tab2_title'] = strip_tags( $new_instance['tab2_title'] );
        $instance['tab2_content'] = strip_tags( $new_instance['tab2_content'] );
        $instance['tab3_title'] = strip_tags( $new_instance['tab3_title'] );
        $instance['tab3_content'] = strip_tags( $new_instance['tab3_content'] );
		
        return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array('number' => 3, 'tab1_title' => 'Reviews', 'tab1_content' => 'reviews', 'tab2_title' => 'News', 'tab2_content' => 'news', 'tab3_title' => 'Videos', 'tab1_content' => 'videos' );
		$instance = wp_parse_args( (array) $instance, $defaults );

        $arr_content;
        $arr_content['news'] = 1;
        
		$reviews_query = array('post_status' => 'publish', 'post_type' => 'gamepress_reviews');
        $reviews = new WP_Query($reviews_query);
        if ($reviews->have_posts()) { $arr_content['reviews'] = 1; } else { $arr_content['reviews'] = 0; };			
        wp_reset_query();
        
		$videos_query = array('post_status' => 'publish', 'post_type' => 'gamepress_video');
        $videos = new WP_Query($videos_query);
        if ($videos->have_posts()) { $arr_content['videos'] = 1; } else { $arr_content['videos'] = 0; };			
        wp_reset_query();
        
        ?>
		
		<!-- Tab #1 -->       
		<p>
			<label for="<?php echo $this->get_field_id( 'tab1_title' ); ?>"><?php _e('Tab #1 title','gamepress') ?>:</label>
			<input id="<?php echo $this->get_field_id( 'tab1_title' ); ?>" name="<?php echo $this->get_field_name( 'tab1_title' ); ?>" value="<?php echo $instance['tab1_title']; ?>" style="width:90%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tab1_content' ); ?>"><?php _e('Tab #1 content','gamepress') ?>:</label>
			<select id="<?php echo $this->get_field_id( 'tab1_content' ); ?>" name="<?php echo $this->get_field_name( 'tab1_content' ); ?>" class="widefat type" style="width:100%;">
                <?php foreach ( $arr_content as $type => $value ) : ?>	                        
                <option value='<?php echo $type; ?>' <?php if ( $type == $instance['tab1_content']) echo 'selected="selected"'; ?> <?php if ( $value != 1 ) echo 'disabled';?>><?php echo $type; ?></option>
                <?php endforeach; ?>
			</select>
		</p>
		<!-- Tab #2 -->       
		<p>
			<label for="<?php echo $this->get_field_id( 'tab2_title' ); ?>"><?php _e('Tab #2 title','gamepress') ?>:</label>
			<input id="<?php echo $this->get_field_id( 'tab2_title' ); ?>" name="<?php echo $this->get_field_name( 'tab2_title' ); ?>" value="<?php echo $instance['tab2_title']; ?>" style="width:90%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tab2_content' ); ?>"><?php _e('Tab #2 content','gamepress') ?>:</label>
			<select id="<?php echo $this->get_field_id( 'tab2_content' ); ?>" name="<?php echo $this->get_field_name( 'tab2_content' ); ?>" class="widefat type" style="width:100%;">
                <?php foreach ( $arr_content as $type => $value ) : ?>	                        
                <option value='<?php echo $type; ?>' <?php if ( $type == $instance['tab2_content']) echo 'selected="selected"'; ?> <?php if ( $value != 1 ) echo 'disabled';?>><?php echo $type; ?></option>
                <?php endforeach; ?>
			</select>
		</p>
		<!-- Tab #3 -->       
		<p>
			<label for="<?php echo $this->get_field_id( 'tab3_title' ); ?>"><?php _e('Tab #3 title','gamepress') ?>:</label>
			<input id="<?php echo $this->get_field_id( 'tab3_title' ); ?>" name="<?php echo $this->get_field_name( 'tab3_title' ); ?>" value="<?php echo $instance['tab3_title']; ?>" style="width:90%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tab3_content' ); ?>"><?php _e('Tab #3 content','gamepress') ?>:</label>
			<select id="<?php echo $this->get_field_id( 'tab3_content' ); ?>" name="<?php echo $this->get_field_name( 'tab3_content' ); ?>" class="widefat type" style="width:100%;">
                <?php foreach ( $arr_content as $type => $value ) : ?>	                        
                <option value='<?php echo $type; ?>' <?php if ( $type == $instance['tab3_content']) echo 'selected="selected"'; ?> <?php if ( $value != 1 ) echo 'disabled';?>><?php echo $type; ?></option>
                <?php endforeach; ?>
			</select>
		</p>		
        <!-- Number of posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number of posts to show','gamepress') ?>:</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>


	<?php
	}
    
}    
function get_reviews( $order = null, $limit = 3 ) {

    $query_r = array('posts_per_page' => $limit, 'nopaging' => 0, 'post_status' => 'publish', 'post_type' => 'gamepress_reviews');
    $reviews = new WP_Query($query_r);
    if ($reviews->have_posts()) :			
    ?>
    <ul id="tabs-<?php echo $order; ?>" class="reviews pane">				
        <?php  while ($reviews->have_posts()) : $reviews->the_post(); ?>
        
        <li>
            <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : ?>
            <div class="entry-thumb">
            <a href="<?php echo get_permalink() ?>" class="img-bevel" rel="bookmark" title="<?php the_title(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
            </div>
            <?php endif; ?>

            <div class="entry-wrapper">
                <h6 class="entry-title"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>
                <div class="entry-meta">
                    <?php the_time('F j, Y') ?> |
                    <?php comments_popup_link(__('No comments','gamepress'), __('1 comment','gamepress'), __('Comments: %','gamepress')); ?>
                </div>
                
                <?php if(get_post_meta(get_the_ID(), "gamepress_score", true)) : ?>
                <div class="rating-bar">
                    <?php echo gamepress_rating(get_post_meta(get_the_ID(), "gamepress_score", true)); ?>
                </div>
                <?php endif; ?>
            </div>
        </li>
        
        <?php endwhile; ?>			
    </ul>
    <?php 
    else: _e('No game reviews yet.','gamepress');
    endif; 
    wp_reset_query();

}

function get_news( $order = null, $limit = 3 ) {

    $recent_posts = new WP_Query(array('showposts' => $limit,'post_status' => 'publish'));
    ?>

    <ul id="tabs-<?php echo $order; ?>" class="news pane">
        <?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
        <li>
            <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : ?>
            <div class="entry-thumb">
            <a href="<?php echo get_permalink() ?>" class="img-bevel" rel="bookmark" title="<?php the_title(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
            </div>
            <?php endif; ?>
            <div class="entry-wrapper">
                <h6 class="entry-title"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>
                <div class="entry-meta">
                    <?php the_time('F j, Y') ?> |
                    <?php comments_popup_link(__('No comments','gamepress'), __('1 comment','gamepress'), __('Comments: %','gamepress')); ?>
                </div>
            </div>
        </li>

        <?php endwhile; ?>
    </ul>
    <?php 
    wp_reset_query();  
}

function get_videos( $order = null, $limit = 3 ) {

    $query_v = array('showposts' => $limit, 'nopaging' => 0, 'post_status' => 'publish', 'post_type' => 'gamepress_video');
    $videos = new WP_Query($query_v);
    if ($videos->have_posts()) :
    ?>
    <ul id="tabs-<?php echo $order; ?>" class="video pane">
        
        <?php  while ($videos->have_posts()) : $videos->the_post(); ?>
        
        <li>
            <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : ?>
            <div class="entry-thumb">
            <a href="<?php echo get_permalink() ?>" class="img-bevel" rel="bookmark" title="<?php the_title(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
            </div>
            <?php endif; ?>

            <div class="entry-wrapper">
                <h6 class="entry-title"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>
                <div class="entry-meta">
                    <?php the_time('F j, Y') ?> |
                    <?php comments_popup_link(__('No comments','gamepress'), __('1 comment','gamepress'), __('Comments: %','gamepress')); ?>
                </div>
            </div>
        </li>
        
        <?php endwhile; ?>
    </ul>
    
    <?php 
    else: _e('No videos yet.','gamepress');
    endif; 
    wp_reset_query();
    
}

?>