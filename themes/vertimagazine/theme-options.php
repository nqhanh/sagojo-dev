<?php
    add_action('admin_menu', 'register_my_custom_submenu_page');
    
    function register_my_custom_submenu_page() {
		add_theme_page('Theme Options', 'Theme Options', 'read', 'my-custom-submenu-page', 'my_custom_submenu_page_callback' ); 
    }
    
    function my_custom_submenu_page_callback() {
		if(isset($_POST["facebook"])) {
      		$facebook = esc_attr($_POST["facebook"]);
    	}
		if(isset($_POST["twitter"])) {
      		$twitter = esc_attr($_POST["twitter"]);
    	}
		if(isset($_POST["youtube"])) {
      		$youtube = esc_attr($_POST["youtube"]);
    	}
    	if(isset($_POST["phone"])) {
      		$phone = esc_attr($_POST["phone"]);
    	}
		if(isset($_POST["email"])) {
      		$email = esc_attr($_POST["email"]);
    	}
		if(isset($_POST["copyright"])) {
      		$copyright = esc_attr($_POST["copyright"]);
    	}
		if(isset($_POST["image_1"])) {
      		$logo_sus = esc_attr($_POST["image_1"]);
    	}
		if(isset($_POST["image_2"])) {
      		$logo_jos = esc_attr($_POST["image_2"]);
    	}
    	if (isset($_POST["update_settings"])) {	
			update_option("copyright", $copyright);
			update_option("email", $email);
    		update_option("phone_number", $phone);
			update_option("logo_sus", $logo_sus);
			update_option("logo_jos", $logo_jos);
			update_option("facebook", $facebook);
			update_option("twitter", $twitter);
			update_option("youtube", $youtube);
    	}
		
    ?>
    <style type="text/css">
	#form-options th {
		width: 200px !important;
		padding: 10px !important;
		text-align:left !important;
	}
	</style>
      <div class="wrap">
        <form method="POST" action="">
        	<h2>General options</h2>
            
            <table id="form-options">
            <tr>
                <th scope="row">Facebook link</th>
                <td><input type="text" name="facebook" size="25" value="<?php $fb = get_option("facebook"); echo $fb; ?>" /></td>
            </tr>
            <tr>
                <th scope="row">Twitter link</th>
                <td><input type="text" name="twitter" size="25" value="<?php $tw = get_option("twitter"); echo $tw; ?>" /></td>
            </tr>
            <tr>
                <th scope="row">Youtube link</th>
                <td><input type="text" name="youtube" size="25" value="<?php $yt = get_option("youtube"); echo $yt; ?>" /></td>
            </tr>
            <tr>
                <th scope="row">Phone number</th>
                <td><input type="text" name="phone" size="25" value="<?php $ph = get_option("phone_number"); echo $ph; ?>" /></td>
            </tr>
            <tr>
                <th scope="row">Email</th>
                <td><input type="text" name="email" size="25" value="<?php $em = get_option("email"); echo $em; ?>" /></td>
            </tr>
            <tr>
                <th scope="row">Copyright</th>
                <td><textarea name="copyright"><?php $cr = get_option("copyright"); echo $cr; ?></textarea></td>
            </tr>
           	<tr>
            	<td colspan="2">
            		<h3>Top logo</h3>
                </td>
            </tr>
            <tr>    
                <th scope="row">Preview</th>
                <td><img src="<?php $ls = get_option("logo_sus"); echo $ls; ?>" name="preview1" id="preview1" alt="logo"/></td>
            </tr>
            <tr>
            	<th scope="row">Upload</th>
            	<td>
                	<input type="text" id="image_1" name="image_1" value="<?php $ls = get_option("logo_sus"); echo $ls; ?>" style="width: 200px; float:left; margin:0 5px;"/>
            		<input id="_btn" class="upload_image_button" type="button" value="Upload Image" />
                </td>
            </tr>
            
            
            <tr>
            	<td colspan="2">
            		<h3>Bottom logo</h3>
                </td>
            </tr>
            <tr>    
                <th scope="row">Preview</th>
                <td><img src="<?php $lj = get_option("logo_jos"); echo $lj; ?>" name="preview2" id="preview2" alt="logo"/></td>
            </tr>
            <tr>
            	<th scope="row">Upload</th>
            	<td>
                	<input type="text" id="image_2" name="image_2" value="<?php $lj = get_option("logo_jos"); echo $lj; ?>" style="width: 200px; float:left; margin:0 5px;"/>
            		<input id="_btn" class="upload_image_button" type="button" value="Upload Image" />
                </td>
            </tr>
           </table>
            
     
            <input type="hidden" name="update_settings" value="Y" />  
            <input type="submit" value="Save settings" class="button-primary"/> 
        </form>
    </div>
  <?php  
    }
  ?>