<style>

#qtrans_imsg{
    
    display:none;
}

#personal-update{
    
    margin-top: 20px;
}

#author-info{
    
    /*border: 1px solid #ddd;*/
}

</style>

<?php
	
	if (wp_verify_nonce($_POST['usersets'],'update') )	//security
		{
		if($_POST) 
			{
			global $wpdb;
			echo "<h2>Profile updated.</h2>";
			
			
			$blogbio = $wpdb->escape($_POST['blogbio']);
			$blogrefr = $wpdb->escape($_POST['blogrefr']);
			
			
			update_user_meta( $auth->id, 'blogbio', $blogbio );
				
			update_user_meta( $auth->id, 'blogrefr', $blogrefr );						
			
			
			
			
		
			
	
			}
		}
	?>

	
	<div class='author-private'>

		<fieldset>
			<legend style="text-align: center;"><h1><?php _e('User settings', 'responsive'); ?></h1></legend>
			
			<form method="post" id="personal-form-id-authorinfo" class="personal-form-class-authorinfo">



				<div style='clear:both'></div>		
				
			
				
				<div id="personal-about" class="personal-profile">
					<label for="description"><h2><?php _e('Headline', 'responsive') ?></h2></label>
					<div class="personal-input">
                                    <?php wp_editor( stripslashes(get_user_meta($auth->id ,'blogbio',TRUE )), 'desc', array('textarea_name' => 'blogbio', 'editor_class' => 'requiredField', 'teeny' => true, 'textarea_rows' => 8,'media_buttons'=>false) ); ?>
                    </div>
					
				</div>
				<div id="personal-refer" class="personal-profile">
					
                    <label for="refr"><h2><?php _e('About me', 'responsive') ?></h2></label>
					<div class="personal-input">
                                    <?php wp_editor( stripslashes(get_user_meta($auth->id ,'blogrefr',TRUE )), 'refr', array('textarea_name' => 'blogrefr', 'editor_class' => 'requiredField', 'teeny' => true, 'textarea_rows' => 8,'media_buttons'=>false) ); ?>
                    </div>
                    
				</div>
				
                <div class="freelance-profile-author-my freelance-profile-authorinfo">
						<label for="refr"><h2><?php _e('Profile', 'responsive') ?></h2></label>
						<p><a  style="color:#9a9657; font-weight: bold; " href="<?php echo admin_url()?>/profile.php">Click here to update your profile.<br /></a><span style="font-size: 14px;"><em>(password, avatar, display name...)</em></span></p>
					</div>
				
				<div id="personal-update" class="personal-profile">
					<?php wp_nonce_field('update','usersets'); ?>
					<input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Update', 'responsive'); ?>" />
				</div>
			</form>
		</fieldset>

				
			
	

	
	<div style='clear:both'></div>
	
    <div class="notification">
    <?php _e('Below we show you what everyone else sees when they visit this page' , 'responsive'); ?>	
    </div>
</div>
<div style='clear:both'></div>	