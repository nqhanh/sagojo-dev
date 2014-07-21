<link href='http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo plugins_url('css/demo.css', __FILE__ );?>">
<link rel="stylesheet" href="<?php echo plugins_url('css/forkit.css', __FILE__ );?>">
<!-- JQUERY ______________________ -->
	<!--[if lt IE 9]> <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script> <![endif]-->
	<!--[if gte IE 9]><!--> <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js" type="text/javascript"></script> <!--<![endif]-->
<script src="<?php echo site_url('wp-content/plugins/wpjobboard/templates/job-board/js/imgLiquid.js', __FILE__ );?>" type="text/javascript"></script>
<script type="text/javascript">
				$(document).ready(function () {
					$(".imgLiquidFill").imgLiquid({fill:true});
					$(".imgLiquidNoFill").imgLiquid({fill:false});
				});
			</script>
<section class="resume-wrap <?php echo $themeclass;?>" >
<div>
	<div class="resume-container">
		<div class="resume-inner">
				
			<article>	
<?php
$siteurl = site_url();
$file1 = "./wp-content/plugins/wpjobboard/environment/company/cover_$company_ID.jpg";

if (file_exists($file1)) {
 echo "<div class='boxSep'><div class='imgLiquidFill imgLiquid'><img src='$siteurl/wp-content/plugins/wpjobboard/environment/company/cover_$company_ID.jpg'></div></div>";}

?>			
			<h1 style="display:block;"><?php _e($name)?></h1>
			<div class="intro">
			<img src="<?php echo $image;?>" width="150px">
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
			</div><div style="clear:both;"></div>
			<h2><?php _e($experience_title);?></h2>
			<p>
				<?php 		
					$job = $experience;
					$job = strip_tags($job, '<p><a><b><strong><em><i><ul><li><h3><h4><br>');
					$job = nl2br($job);
					$find = array("</ul><br />", "</li><br />", "</ol><br />");
					$repl = array("</ul>", "</li>", "</ol>");
					_e(str_replace($find, $repl, $job));
				?>
			</p>
			<h2><?php _e($education_title);?></h2>
			<p>
				<?php 		
					$job = $education;
					$job = strip_tags($job, '<p><a><b><strong><em><i><ul><li><h3><h4><br>');
					$job = nl2br($job);
					$find = array("</ul><br />", "</li><br />", "</ol><br />");
					$repl = array("</ul>", "</li>", "</ol>");
					_e(str_replace($find, $repl, $job));
				?>
			</p>
			
			</article>
</div>	</div>	
		<!-- The contents (if there's no contents the ribbon acts as a link) -->
		<?php if (!$hide_portfolio) { ?><!-- start portfolio -->
		<div class="forkit-curtain">
			<div class="close-button"></div>
			<h2><?php echo _e($portfolio_title);?></h2>
			<small><?php _e($name)?></small>
			<?php           
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
		<!-- end portfolio -->
		<?php }?>
		<!-- The ribbon -->
		<a class="forkit" data-text="Hình ảnh" data-text-detached="Kéo xuống để xem >" href="https://github.com/hakimel/forkit.js"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://github-camo.global.ssl.fastly.net/365986a132ccd6a44c23a9169022c0b5c890c387/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f7265645f6161303030302e706e67" alt="Fork me on GitHub"></a>

<script src="<?php echo plugins_url('js/forkit.js', __FILE__ );?>" type="text/javascript"></script>

				
				
</div>					
		</section>