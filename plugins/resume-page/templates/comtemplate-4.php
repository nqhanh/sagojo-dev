<style type="text/css">
			/* Just some styles to set the page layout. */
			* {margin:0;padding:0;font-family:Arial, Verdana, sans-serif;}
			h1 {font-size:18px;margin:20px 0;}
			h2 {font-size:14px;margin:20px 0;}
			h3 {font-size:14px;margin:20px 0;}
			p {font-size:12px;margin:20px 0;}
			a {font-size:12px;}
			#container {width:960px;margin:0 auto;}
			
			/* Used in Example 3 */
			#example3 ul {list-style:none;}
			#example3 h3 {color:#fff;text-transform:uppercase;font-size:24px;}
			#example3 p {color:#fff;}
			#example3 .frame-1 {background:url(<?php echo plugins_url('images/slide1.gif', __FILE__ );?>) top left repeat;}
			#example3 .frame-2 {background:url(<?php echo plugins_url('images/slide2.gif', __FILE__ );?>) top left repeat;}
			#example3 .frame-3 {background:url(<?php echo plugins_url('images/slide3.gif', __FILE__ );?>) top left repeat;}
			#example3 .frame-4 {background:url(<?php echo plugins_url('images/slide4.gif', __FILE__ );?>) top left repeat;}
			#example3 .frame-5 {background:url(<?php echo plugins_url('images/slide5.gif', __FILE__ );?>) top left repeat;}
			#example3 .frame-content {width:600px;padding:20px 20px;}
			#example3 .frame-closed .frame-content {display:none;}
			#example3 .frame-open .frame-content {display:block;}
		</style>
		<!-- JQUERY ______________________ -->
	<!--[if lt IE 9]> <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script> <![endif]-->
	<!--[if gte IE 9]><!--> <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js" type="text/javascript"></script> <!--<![endif]-->
		<script src="<?php //echo plugins_url('js/jquery-1.4.2.min.js', __FILE__ );?>" type="text/javascript"></script>
		<script src="<?php echo plugins_url('js/jquery.easing.1.3.js', __FILE__ );?>" type="text/javascript"></script>
		<script src="<?php echo plugins_url('js/jquery.zaccordion.js', __FILE__ );?>" type="text/javascript"></script>
		
<section class="resume-wrap <?php echo $themeclass;?>" >
			<div class="resume-container">
				<div class="resume-inner">
<div id="container">
				<div id="example3">
				<div class="frame-1">
					<div class="frame-content">
						<h3><?php echo $name;?></h3>
						<p><img src="<?php echo $image;?>" width="150px"></p>
					</div>
				</div>
				<div class="frame-2">
					<div class="frame-content">
						<h3><?php _e($experience_title);?></h3>
						<p><?php echo $experience ?></p>
					</div>
				</div>
				<div class="frame-3">
					<div class="frame-content">
						<h3><?php echo _e($portfolio_title);?></h3>
						<?php  
					$siteurl = site_url();
					$directory  = "wp-content/plugins/wpjobboard/environment/company/portfolio/".$company_ID; 
					$images = scandir($directory);
					$ignore = Array(".", "..");
					foreach($images as $dispimage){
					    if(!in_array($dispimage, $ignore)){
					    echo "<a href='$siteurl/$directory/$dispimage' rel='lightbox[roadtrip]' title=''><img src='$siteurl/$directory/$dispimage' width='100px'></a>";
					    }
					}
					//echo ba_resume_page_portfolio($company_ID,"company");
					?>
					</div>
				</div>
				<div class="frame-4">
					<div class="frame-content">
						<ul>
				<?php if($location): ?>
				<li>
					<label><?php _e("Company Address", WPJB_DOMAIN) ?></label>
					<div class="diachicty"><?php echo $location ?></div>
				</li>
				<?php endif; ?>
				
				<?php if($website): ?>
				<li>
					<label><?php _e("Company Website", WPJB_DOMAIN) ?></label>
					<?php echo $website ?>
				</li>           
				<?php endif; ?>	
				
				<?php if($fieldarea): ?>
				<li>
					<label><?php _e("Field of Business", WPJB_DOMAIN) ?></label>
					<?php echo $fieldarea ?>
				</li>  
				<?php endif; ?>
				
				<?php if($quality): ?>
				<li>
					<label><?php _e("Number of Employees", WPJB_DOMAIN) ?></label>
					<?php echo $quality ?>
				</li>              
				<?php endif; ?>
			</ul>
					</div>
				</div>
				<div class="frame-5">
					<div class="frame-content">
						<h3><?php _e($education_title);?></h3>
						<p><?php 		
							$job = $education;
							$job = strip_tags($job, '<p><a><b><strong><em><i><ul><li><h3><h4><br>');
							$job = nl2br($job);
							$find = array("</ul><br />", "</li><br />", "</ol><br />");
							$repl = array("</ul>", "</li>", "</ol>");
							_e(str_replace($find, $repl, $job));
						?></p>
					</div>
				</div>
			</div>
			<div id="thumbs">
				<a href="#" class="thumb-0">Start</a> <a href="#" class="thumb-1">1</a> <a href="#" class="thumb-2">2</a> <a href="#" class="thumb-3">3</a> <a href="#" class="thumb-4">4</a> <a href="#" class="thumb-5">5</a> <a href="#" class="thumb-6">Stop</a>
			</div>
			
			<script type="text/javascript">
				$(document).ready(function() {
					var accordion = $("#example3").zAccordion({
						slideWidth: 600,
						width: 900,
						height: 350,
						timeout: 3000,
						slideClass: "frame",
						slideOpenClass: "frame-open",
						slideClosedClass: "frame-closed",
						easing: "easeOutCirc"
					});
					$("#thumbs .thumb-0").click(function(){
						accordion.start();
						return false;
					});
					$("#thumbs .thumb-1").click(function(){
						accordion.click(0);
						return false;
					});
					$("#thumbs .thumb-2").click(function(){
						accordion.click(1);
						return false;
					});
					$("#thumbs .thumb-3").click(function(){
						accordion.click(2);
						return false;
					});
					$("#thumbs .thumb-4").click(function(){
						accordion.click(3);
						return false;
					});
					$("#thumbs .thumb-5").click(function(){
						accordion.click(4);
						return false;
					});
					$("#thumbs .thumb-6").click(function(){
						accordion.stop();
						return false;
					});
				});
			</script>
			</div></div></div>
		</section>