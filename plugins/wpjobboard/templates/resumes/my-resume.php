<script src="<?php echo plugins_url('jquery-1.7.1.min.js', __FILE__ );?>" type="text/javascript"></script>
<script src="<?php echo plugins_url('jquery-ui-1.8.18.custom.min.js', __FILE__ );?>" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


	

	

<?php /* @var $resume Wpjb_Model_Resume */ ?>
<div id="wpjb-main" class="wpjr-page-my-resume">

    <?php wpjb_flash() ?>
	<div class="wpjb-menu-bar">
	<?php $is_modern = $resume->stylecv;
		if($is_modern==1) {?>
        <a href="<?php echo site_url()?>/resume/?job_resumes=<?php wpjb_resume_id() ?>"><?php _e("View my resume", WPJB_DOMAIN); ?></a>
		<p><a class='inline' href="#inline_content"><?php _e("Design you CVitae", WPJB_DOMAIN); ?></a></p>
		<?php } else {?> <a href="?page_id=275&job_resumes=/view/<?php wpjb_resume_id() ?>"><?php _e("View my resume", WPJB_DOMAIN); ?></a><?php }?>
		
    </div>
    <form action="" method="post" id="wpjb-resume" class="wpjb-form" enctype="multipart/form-data">

        <fieldset>
            <legend><?php _e("Resume Information", WPJB_DOMAIN) ?></legend>
            <!--<div>
                <label class="wpjb-label"><?php //_e("Resume Status", WPJB_DOMAIN) ?></label>
                <span><?php //echo wpjb_resume_status($resume) ?></span>
            </div>-->
            <div>
                <label class="wpjb-label"><?php _e("Last Updated", WPJB_DOMAIN) ?></label>
                <span><?php echo wpjb_resume_last_update("d M, Y", $resume) ?></span>
            </div>
            <?php if($resume->hasImage()): ?>
            <div>
                <label class="wpjb-label"><?php _e("Profile Image", WPJB_DOMAIN) ?></label>
                <span>
                    <a href="<?php echo $resume->getImageUrl() ?>" class="wpjb-button"><?php _e("Preview", WPJB_DOMAIN) ?></a>
                    <a href="<?php echo wpjr_link_to("myresumedel") ?>" class="wpjb-button"><?php _e("Delete photo", WPJB_DOMAIN) ?></a>
                </span>
            </div>
            <?php endif; ?>
			 
            <?php if($resume->hasFile()): ?>
            <div>
                <label class="wpjb-label"><?php _e("File", WPJB_DOMAIN) ?></label>
                <span>
                    <a href="<?php echo $resume->getFileUrl() ?>" class="wpjb-button"><?php _e("Download", WPJB_DOMAIN) ?></a>
                    <a href="<?php echo wpjr_link_to("myresumedel_file") ?>" class="wpjb-button"><?php _e("Delete file", WPJB_DOMAIN) ?></a>
                </span>
            </div>
            <?php endif; ?>
            
            <?php           
					$directory  = "wp-content/plugins/wpjobboard/environment/resumes/portfolio/".$resume->id; 
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
<?php remove_filter( "mce_buttons_3","enable_more_buttons");?>
<?php remove_filter( 'tiny_mce_before_init', 'myformatTinyMCE' );?>


        <?php wpjb_form_render_hidden($form) ?><?php //Form/Admin/Resume?>
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
    
        <p class="submit">
        <input type="submit" value="<?php _e("Save Changes", WPJB_DOMAIN) ?>" class="button-primary" name="Submit"/>
        </p>

    </form>
	
	
<?php $is_modern = $resume->stylecv;
if($is_modern==1) {
$checked = $resume->template;
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
					inline:true, width:"55%",
					height:"75%",
					
					onCleanup:function(){ 
						
						var rid=<?php wpjb_resume_id() ?>; 
						
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
							url : "<?php echo site_url()?>/wp-content/banners/save-state.php", // give complete url here
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
		<label class="sites-label"><?php _e("CVitae template", WPJB_DOMAIN) ?></label>
		<input class="css-checkbox" type="radio" name="site" id="cvbg0" value="0" <?php if ($checked==0) echo "checked=\"checked\""?> /><label for="cvbg0"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/cvbg0.jpg" alt="No Background" /></label>
		<input class="css-checkbox" type="radio" name="site" id="cvbg1" value="1" <?php if ($checked==1) echo "checked=\"checked\""?> /><label for="cvbg1"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/cvbg1.jpg" alt="Cute Green Background" /></label>
		<input class="css-checkbox" type="radio" name="site" id="cvbg2" value="2" <?php if ($checked==2) echo "checked=\"checked\""?> /><label for="cvbg2"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/cvbg2.jpg" alt="Christmas Gold Background" /></label>
		<input class="css-checkbox" type="radio" name="site" id="cvbg3" value="3" <?php if ($checked==3) echo "checked=\"checked\""?> /><label for="cvbg3"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/cvbg3.jpg" alt="Blue Vintage Background" /></label>
		<input class="css-checkbox" type="radio" name="site" id="cvbg4" value="4" <?php if ($checked==4) echo "checked=\"checked\""?> /><label for="cvbg4"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/cvbg4.jpg" alt="Blue Vintage Background" /></label>
	</form>
	</div>	

	<label class="sites-label"><?php _e("Background URL", WPJB_DOMAIN) ?></label><input size="43"type="text" name ="bgimg" id="bgimg" value="<?php echo $resume->bg_image?>"><br />
	<label class="sites-label"><?php _e("Background color", WPJB_DOMAIN) ?></label><input type="text" name ="bgcolor" id="bgcolor" class="demo" value="<?php echo $resume->bg_color?>">
	<label class="sites-label"><?php _e("Container color", WPJB_DOMAIN) ?></label><input type="text" name ="ccolor" id="ccolor" class="demo" value="<?php echo $resume->ctn_color?>">
	<label class="sites-label"><?php _e("Text color", WPJB_DOMAIN) ?></label><input type="text" name ="txtcolor" id="txtcolor" class="demo" value="<?php echo $resume->txtcolor?>">
	<label class="sites-label"><?php _e("Link color", WPJB_DOMAIN) ?></label><input type="text" name ="link_color" id="link_color" class="demo" value="<?php echo $resume->link_color?>">
	<label class="sites-label" style="float:left;"><?php _e("Container opacity", WPJB_DOMAIN) ?></label>


          <div class="slider-wrapper-h">
            <input type="text" id="cont-opacity" class="js-opacity" />
            <div class="powerranger js-change-opacity"></div>
          </div> 

<!--<a id="JQueryClick" class="wpjb-button" href = "javascript:void(0)" onClick="customize(<?php wpjb_resume_id() ?>)"><?php _e("Save", WPJB_DOMAIN) ?></a>-->
</div></div>	

<?php
}
?>
<script type="text/javascript">
<?php if(Wpjb_Project::getInstance()->conf("cv_approval")==1 && wpjb_resume()->is_approved == Wpjb_Model_Resume::RESUME_APPROVED): ?>
   WpjbResume.Message = "<?php _e("Wait! Your resume next status will be 'pending approval' and it won't be visible until Administrator manually approve it. Do you want to continue?", WPJB_DOMAIN) ?>";
   WpjbResume.Init();
<?php endif; ?>
<?php if(wpjb_resume()->hasImage()): ?>
    WpjbResume.Avatar = "<?php echo wpjb_resume()->getImageUrl() ?>";
<?php endif; ?>
    WpjbResume.HandleImage();
</script>

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
