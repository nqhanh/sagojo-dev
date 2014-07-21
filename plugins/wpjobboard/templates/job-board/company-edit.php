

<?php

/**
 * Edit company profile
 * 
 * Displays company profile form. Employer can edit his company page here.
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 * 
 */

/* @var $form Wpjb_Form_Frontend_Company Company edit form */
/* @var $company Wpjb_Model_Employer Currently logged in employer object */

?>

<div id="wpjb-main" class="wpjb-page-company-edit">

    <?php wpjb_flash() ?>

    <div class="wpjb-menu-bar">
	<?php $is_modern = $company->stylecv;
		if($is_modern==1) {?>
        <a href="<?php echo site_url()?>/company-profile/?company=<?php echo $company->id ?>"><?php _e("View company profile", WPJB_DOMAIN); ?></a>
		<p><a class='inline' href="#inline_content"><?php _e("Design you company profile", WPJB_DOMAIN); ?></a></p>
		<?php } else {?> <a href="<?php echo wpjb_link_to("company", $company) ?>"><?php _e("View company profile", WPJB_DOMAIN); ?></a><?php }?>
        
    </div>
    
    
    <form action="" method="post" enctype="multipart/form-data" class="wpjb-form wpjb-company-edit-form">
        <?php if($company->hasImage()): ?>
        <fieldset>
            <legend><?php _e("Company Logo", WPJB_DOMAIN) ?></legend>
            
            <div>
                <label class="wpjb-label"><?php _e("Profile Image", WPJB_DOMAIN) ?></label>
                <span>
                    <a href="<?php echo $company->getImageUrl() ?>" class="wpjb-button"><?php _e("Preview", WPJB_DOMAIN) ?></a>
                    <a href="<?php echo wpjb_link_to("employer_logo_delete", $company) ?>" class="wpjb-button"><?php _e("Delete", WPJB_DOMAIN) ?></a>
                </span>
            </div>
            
			<?php if($company->hasFile()): ?>
            <div>
                <label class="wpjb-label"><?php _e("Company cover", WPJB_DOMAIN) ?></label>
                <span>
                    <a href="<?php echo $company->getFileUrl() ?>" class="wpjb-button"><?php _e("Download", WPJB_DOMAIN) ?></a>
                    <a href="<?php echo wpjb_link_to("employer_cover_delete") ?>" class="wpjb-button"><?php _e("Delete file", WPJB_DOMAIN) ?></a>
                </span>
            </div>
            <?php endif; ?>
			<?php           
					$directory  = "wp-content/plugins/wpjobboard/environment/company/portfolio/".$company->id; 
					$images = scandir($directory);
					$ignore = Array(".", "..");
					$count=1;
					$siteurl = site_url();
					echo '<div class="portfolio-cls">';
					foreach($images as $dispimage){
					    if(!in_array($dispimage, $ignore)){
					    echo "<div id='del$count' class='port-img' style='clear:none;'><img src='$siteurl/$directory/$dispimage' width='85px' height='59px'><input type='button' id='delete$count' value='".__("Delete photo", WPJB_DOMAIN)."' onclick='deleteFile(\"$dispimage\",$count,\"$directory\");'></div>";
					    $count++;
					    }
					}
					echo '</div>';
					?>
					<script type="text/javascript" src="jquery.js"></script>
					<script type="text/javascript">
					function deleteFile(fname,rowid,directory)
					{
						var del = jQuery.noConflict();
						del.ajax({ url: "<?php echo site_url()?>/wp-content/banners/deletefile.php",
					        data: {"filename":fname,"directory":directory},
					        type: 'post',
					        success: function(output) {
					          alert(output);
					          del("#del"+rowid).remove();
					        }
					    });
					}
					</script>
        </fieldset>
        <?php endif; ?>
        <?php remove_filter( "mce_buttons_3","enable_more_buttons");?>
		<?php remove_filter( 'tiny_mce_before_init', 'myformatTinyMCE' );?>
        <?php wpjb_form_render_hidden($form) //libraries/Form/Admin/Company.php?>
        <?php foreach($form->getNonEmptyGroups() as $group): ?>
        <?php /* @var $group stdClass */ ?> 
        <fieldset class="wpjb-fieldset-<?php echo $group->name ?>">
            <legend class="wpjb-empty"><?php esc_html_e($group->legend) ?></legend>
            <?php foreach($group->element as $name => $field): ?>
            <?php /* @var $field Daq_Form_Element */ ?>
            <div class="<?php wpjb_form_input_features($field) ?>">

                <label class="wpjb-label">
                    <?php esc_html_e($field->getLabel()) ?>
                    <?php if($field->isRequired()): ?><span class="wpjb-required">*</span><?php endif; ?>
                </label>
                
                <div class="wpjb-field">
                    <?php wpjb_form_render_input($form, $field) ?>
                    <?php wpjb_form_input_hint($field) ?>
                    <?php wpjb_form_input_errors($field) ?>
                </div>

            </div>
            <?php endforeach; ?>
        </fieldset>
        <?php endforeach; ?>
        <div align="center">
            <legend class="wpjb-empty"></legend>
            <input type="submit" name="wpjb_preview" id="wpjb_submit" value="<?php _e("Update profile", WPJB_DOMAIN) ?>" />
        </div>
    </form>


<?php //$is_modern = $company->stylecv;
if($is_modern==1) {
$checked = $company->template;
?>
<!--Background image radio button hiddden-->
<style>
	.input_hidden {
		position: absolute;
		/*left: -9999px;*/
	}

	.selected {
		background-color: #ccc;
	}

	#sites label {
		display: inline-block;
		cursor: pointer;
	}

	#inline_content .sites-label{ 
		width: 25%;
		padding-bottom: 20px;

	}
	#sites label:hover {
		background-color: #efefef;
	}

	#sites label img {
		padding: 3px;
	
	}
		
</style>
<!--Background image radio button hiddden-->

<!-- lightbox -->
		<link rel="stylesheet" href="<?php echo plugins_url('colorbox.css', __FILE__ );?>">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="<?php echo plugins_url('jquery.colorbox.js', __FILE__ );?>" type="text/javascript"></script>
		<script>
		var lgbx = jQuery.noConflict();

						
			lgbx(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				/*lgbx(".group1").colorbox({rel:'group1'});
				lgbx(".group2").colorbox({rel:'group2', transition:"fade"});
				lgbx(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				lgbx(".group4").colorbox({rel:'group4', slideshow:true});
				lgbx(".ajax").colorbox();
				lgbx(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				lgbx(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				lgbx(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});*/
				lgbx(".inline").colorbox({
					inline:true, width:"50%",
					height:"75%",
					
					onCleanup:function(){ 
						
						var rid=<?php echo $company->id;?>; 
						
						var str_bgcl=lgbx("#bgcolor").val(); 
						var bgcl = str_bgcl.substring(1, 7);
						
						var str_ccl=lgbx("#ccolor").val(); 
						var ccl = str_ccl.substring(1, 7);
						
						var str_txtcl=lgbx("#txtcolor").val(); 
						var txtcl = str_txtcl.substring(1, 7);
						
						var str_lnk=lgbx("#link_color").val(); 
						var lnk = str_lnk.substring(1, 7);
						
						//var str_ct1=lgbx("#ctncolor").val(); 
						//var ct1 = str_ct1.substring(1, 7);
						var opct=lgbx("#cont-opacity").val();
												
						var bgimg=lgbx("#bgimg").val();				

						if(bgimg==null || bgimg.trim()=="") bgimg = "0";
						
						var template = lgbx('input[name="site"]:checked', '#myForm').val(); 
						
						//var dataString = "id=" + rid + "&bg=" + bgcl + "&ct=" + ct + "&op=" + opct + "&img=" + bgimg;
						var dataString = "id=" + rid + "&bg=" + bgcl + "&ct=" + ccl + "&op=" + opct + "&img=" + bgimg + "&txtcl=" + txtcl + "&lnk=" + lnk + "&tmp=" + template;
						
						lgbx.ajax({
							url : "<?php echo site_url()?>/wp-content/banners/save-state-company.php", // give complete url here
							type : "POST",
							data : dataString,
							success: function(){
								lgbx('.success').fadeIn(200).show();
								lgbx('.error').fadeOut(200).hide();
								}
						});
						
					}
				});
				lgbx(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});

				lgbx('.non-retina').colorbox({rel:'group5', transition:'none'})
				lgbx('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				lgbx("#click").click(function(){ 
					lgbx('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
<!-- lightbox -->



<div style='display:none'>
<div id='inline_content' style='padding:10px; background:#fff;'>

 
	<div id="sites">
	<form id="myForm">
		<label class="sites-label">Profile template</label>
		<input class="css-checkbox" type="radio" name="site" id="cvbg0" value="0" <?php if ($checked==0) echo "checked=\"checked\""?> /><label for="cvbg0"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/combg0.jpg" alt="No Background" /></label>
		<input class="css-checkbox" type="radio" name="site" id="cvbg1" value="1" <?php if ($checked==1) echo "checked=\"checked\""?> /><label for="cvbg1"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/combg1.jpg" alt="Cute Green Background" /></label>
		<input class="css-checkbox" type="radio" name="site" id="cvbg2" value="2" <?php if ($checked==2) echo "checked=\"checked\""?> /><label for="cvbg2"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/combg2.jpg" alt="Christmas Gold Background" /></label>
		<!--<input class="css-checkbox" type="radio" name="site" id="cvbg3" value="3" <?php if ($checked==3) echo "checked=\"checked\""?> /><label for="cvbg3"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/combg3.jpg" alt="Blue Vintage Background" /></label>
		<input class="css-checkbox" type="radio" name="site" id="cvbg4" value="4" <?php if ($checked==4) echo "checked=\"checked\""?> /><label for="cvbg4"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/combg4.jpg" alt="Blue Vintage Background" /></label>-->
	</form>
	</div>	
<?php
	echo "<label class=\"sites-label\">Background URL</label><input size=\"43\"type=\"text\" name =\"bgimg\" id=\"bgimg\" value=\"".$company->bg_image."\"><br />";
	//echo "<label class=\"sites-label\">Background color</label><input type=\"text\" name =\"bgcolor\" id=\"bgcolor\" class=\"demo\" value=\"#70C24A\">";
	//echo "<br/><label class=\"sites-label\">Container color</label><input type=\"text\" name =\"ctncolor\ id=\"ctncolor\" class=\"demo\" value=\"#FFFFFF\">";
	echo "<label class=\"sites-label\">Background color</label><input type=\"text\" name =\"bgcolor\" id=\"bgcolor\" class=\"demo\" value=\"".$company->bg_color."\">";
	echo "<label class=\"sites-label\">Container color</label><input type=\"text\" name =\"ccolor\" id=\"ccolor\" class=\"demo\" value=\"".$company->ctn_color."\">";
	echo "<label class=\"sites-label\">Text color</label><input type=\"text\" name =\"txtcolor\" id=\"txtcolor\" class=\"demo\" value=\"".$company->txtcolor."\">";
	echo "<label class=\"sites-label\">Link color</label><input type=\"text\" name =\"link_color\" id=\"link_color\" class=\"demo\" value=\"".$company->link_color."\">";
	echo "<label class=\"sites-label\" style=\"float:left;\">Container opacity</label>";
?>

          <div class="slider-wrapper-h">
            <input type="text" id="cont-opacity" class="js-opacity" />
            <div class="powerranger js-change-opacity"></div>
          </div> 

<!--<a id="JQueryClick" class="wpjb-button" href = "javascript:void(0)" onClick="customize(<?php wpjb_resume_id() ?>)"><?php _e("Save", WPJB_DOMAIN) ?></a>-->
</div></div>	

<?php
}
?>	
	

</div>




<!--range slider-->		
<link rel="stylesheet" href="<?php echo plugins_url('powerange.css', __FILE__ );?>">  
<script src="<?php echo plugins_url('powerange.js', __FILE__ );?>" type="text/javascript"></script>

  <script type="text/javascript">
    // Interacting with elements.
    var opct = document.querySelector('.js-opacity');
    var initOpct = new Powerange(opct, { callback: setOpacity, decimal: true, min: 0, max: 1, start: 1 });

    function setOpacity() {
      document.querySelector('.js-change-opacity').style.opacity = opct.value;
    }
  </script>	
<!--range slider-->

<!-- MiniColors picker-->
<script src="<?php echo plugins_url('jquery.minicolors.js', __FILE__ );?>"></script>
<link rel="stylesheet" href="<?php echo plugins_url('jquery.minicolors.css', __FILE__ );?>">
<script>
var picker = jQuery.noConflict();
picker(window).load(function(){
		picker('#sites input:radio').addClass('input_hidden');
		picker('#sites label').click(function() {
			picker(this).addClass('selected').siblings().removeClass('selected');
		});});
		picker(document).ready( function() {
			
            picker('.demo').each( function() {
                //
                // Dear reader, it's actually very easy to initialize MiniColors. For example:
                //
                //  $(selector).minicolors();
                //
                // The way I've done it below is just for the demo, so don't get confused 
                // by it. Also, data- attributes aren't supported at this time. Again, 
                // they're only used for the purposes of this demo.
                //
				picker(this).minicolors({
					control: picker(this).attr('data-control') || 'hue',
					defaultValue: picker(this).attr('data-defaultValue') || '',
					inline: picker(this).attr('data-inline') === 'true',
					letterCase: picker(this).attr('data-letterCase') || 'lowercase',
					opacity: picker(this).attr('data-opacity'),
					position: picker(this).attr('data-position') || 'bottom left',
					change: function(hex, opacity) {
						var log;
						try {
							log = hex ? hex : 'transparent';
							if( opacity ) log += ', ' + opacity;
							console.log(log);
						} catch(e) {}
					},
					theme: 'default'
				});
                
            });
			
		});
	</script>
<!-- MiniColors picker-->
