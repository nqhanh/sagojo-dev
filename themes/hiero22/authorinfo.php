<style>
 .left-50 h2{
    border-bottom: 1px solid #ddd;
}
</style>	
	<div class='author-private' id="author-info">
		<div class='' id="freelance-header-container">
			<h2 style="font-size: 35px;"><?php echo $auth->display_name;?>&rsquo;&nbsp;s Profile </h2>
				<div class='left-50'>
					
					
					<div class="freelance-profile-author-about freelance-profile-authorinfo">
						<label for="bio"><h2><?php _e('Headline', 'responsive') ?></h2></label>
						<?php echo stripslashes(get_user_meta($auth->ID ,'blogbio',TRUE ) ); ?>
					</div>
					<div class="freelance-profile-author-my freelance-profile-authorinfo">
						<label for="refr"><h2><?php _e('About me', 'responsive') ?></h2></label>
						<?php echo stripslashes(get_user_meta($auth->ID ,'blogrefr',TRUE ) ); ?>
					</div>    	           
				
		</div>
        </div>
  </div>		
		
		

	
	
    

<div style='clear:both'></div>	

