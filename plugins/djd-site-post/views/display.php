<?php

/**
 * This file is used to markup the public facing aspect of the plugin.
 */

?>

<?php
/**
 * For further development. Next (or pro) release will allow front end editting of existing posts.
 */

 
//$post_id = 86;
//$my_post = get_post($post_id);

// Set editor (content field) style
switch($djd_options['djd-editor-style']){
	case 'simple':
		$teeny = true;
		$show_quicktags = false;
		add_filter( 'teeny_mce_buttons', create_function ( '' , "return array('');" ) , 50 );
		break;
	case 'rich':
		$teeny = false;
		$show_quicktags = true;
		break;
	case 'html':
		$teeny = true;
		$show_quicktags = true;
		add_filter ( 'user_can_richedit' , create_function ( '' , 'return false;' ) , 50 );
		break;
}

if ($called_from_widget == '1') {
	$teeny = true;
	$show_quicktags = false;
	add_filter ( 'user_can_richedit' , create_function ( '' , 'return false;' ) , 50 );
}

//add_filter( 'wp_default_editor', create_function('', 'return "html";') );


?>

<form class="djd_site_post_form" method="post" enctype="multipart/form-data">

	<p hidden="hidden" class="form_error_message"></p>
	<?php if ($djd_options['djd-login-link']) { ?>
		<?php  //if(!is_user_logged_in()) {?>
			<a style="float: right;" href="<?php echo wp_login_url( get_permalink() ); ?>" title="<?php _e('Login');?> "> </a>
			
		<?php //}
	  //else{
	  ?>
		 
		<!--<a style="float: right;" href="<?php //echo wp_login_url( get_permalink() ); ?>" title="<?php //echo $current_user->user_login;?>"><?php //echo $current_user->user_login;?> </a>-->

	<?php } //}?>
	
	<?php //wp_editor($content, $unique_id, array('textarea_rows'=>8,'media_buttons' => true )); ?>
	<div id="field-wrapper">
		<legend><?php echo ( $djd_options['djd-form-name'] ? $djd_options['djd-form-name'] : __('Frontend Post', 'djd-site-post') ); ?></legend>
		<label for="djd_site_post_titel"><?php echo ( $djd_options['djd-title'] ? $djd_options['djd-title'] : __('Title', 'djd-site-post') ); ?></label>
		<!-- <input type="text" required="required" id="djd_site_post_title" name="djd_site_post_title" maxlength="255" autofocus="autofocus"/> -->
		<input type="text" <?php if ( $djd_options['djd-title-required'] == "1" ) echo "required='required'"; ?> id="djd_site_post_title" name="djd_site_post_title" maxlength="255" autofocus="autofocus"/>
		<?php if ($djd_options['djd-show-excerpt']) { ?>
			<label for="djd_site_post_excerpt"><?php echo ( $djd_options['djd-excerpt'] ? $djd_options['djd-excerpt'] : __('Excerpt', 'djd-site-post') ); ?></label>
			<textarea id="djd_site_post_excerpt" name="djd_site_post_excerpt" maxlength="255" /> 
		<?php } ?>
		<label for="djd_site_post_content"><?php echo ( $djd_options['djd-content'] ? $djd_options['djd-content'] : __('Text', 'djd-site-post') ); ?></label>
		<?php
		$settings = array(
			'media_buttons'	=> (boolean) $djd_options['djd-allow-media-upload'],
			'teeny'			=> $teeny,
			'quicktags'		=> $show_quicktags
		);
		
		wp_editor('', 'djd_site_post_content', $settings );

		if ( is_user_logged_in() || $djd_options['djd-guest-cat-select'] ){
		
			$orderby = $djd_options['djd-category-order']; //The sort order for categories. hien thi bao nhieu category 'include' 			=> '111,112,113,114,115',
			switch($djd_options['djd-categories']){
				case 'none':
					break;
				case 'list':
					$args = array(
						'orderby'           => $orderby,
						'order'             => 'ASC',
						'show_count'        => 0,
						'hide_empty'        => 0,
						'child_of'          => 1,
						'echo'              => 0,
						'exclude'           => '',
						'include' 			=> '',
						'hierarchical'      => 0,
						'name'              => 'djd_site_post_select_category',
						'class'             => 'class=djd_site_post_form',
						'depth'             => 0,
						'tab_index'         => 0,
						'hide_if_empty'     => false
					); ?>
					<label for="select_post_category"><?php echo ( $djd_options['djd-categories-label'] ? $djd_options['djd-categories-label'] : __('Select a Category', 'djd-site-post') ); ?></label>
					<?php echo str_replace("&nbsp;", "&#160;", wp_dropdown_categories($args));
					break;
				case 'check':
					$args = array(
						'type'              => 'post',
						'orderby'           => $orderby,
						'order'             => 'ASC',
						'hide_empty'        => 1,
						'child_of'           => 0,
						'hierarchical'      => 0,
						'taxonomy'          => 'category',
						'pad_counts'        => false
					); ?>
					<label for="djd_site_post_cat_checklist"><?php echo ( $djd_options['djd-categories-label'] ? $djd_options['djd-categories-label'] : __('Category', 'djd-site-post') ); ?></label>
					<ul id="djd_site_post_cat_checklist">
					<?php $cats = get_categories($args);
					foreach ($cats as $cat) { ?>
						<li><input type="checkbox" name="djd_site_post_checklist_category[]" value="<?php echo ($cat->cat_ID); ?>" /><?php echo($cat->cat_name); ?></li>
					<?php } ?>
					</ul>
					<?php break;
			}
		}
		if ($djd_options['djd-allow-new-category'] && $verified_user['djd_can_manage_categories']) { ?>
			<label for="djd_site_post_new_category"><?php echo ( $djd_options['djd-create-category'] ? $djd_options['djd-create-category'] : __('New category', 'djd-site-post') ); ?></label>
			<input type="text" id="djd_site_post_new_category" name="djd_site_post_new_category" maxlength="255" />
		<?php }
		if ($djd_options['djd-show-tags']) { ?>
			<label for="djd_site_post_tags"><?php echo ( $djd_options['djd-tags'] ? $djd_options['djd-tags'] : __('Tags (comma-separated)', 'djd-site-post') ); ?></label>
			<input type="text" id="djd_site_post_tags" name="djd_site_post_tags" maxlength="255" />
			<?php } ?>
		<?php 
		if ( ($djd_options['djd-guest-info']) && (!is_user_logged_in()) ){ ?>
			<label for="djd_site_post_guest_name"><?php _e('Your Name', 'djd-site-post'); ?></label>
			<input type="text" required="required" id="djd_site_post_guest_name" name="djd_site_post_guest_name" maxlength="40" />

			<label for="djd_site_post_guest_email"><?php _e('Your Email', 'djd-site-post'); ?></label>
			<input type="email" required="required" id="djd_site_post_guest_email" name="djd_site_post_guest_email" maxlength="40" />
		<?php } ?>
	</div> <!-- field-wrapper -->
	<button type="submit"><?php echo ( $djd_options['djd-send-button'] ? $djd_options['djd-send-button'] : __('Send', 'djd-site-post') ); ?></button>
</form>