				
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="<?php echo plugins_url('js/turn.min.js', __FILE__ );?>" type="text/javascript"></script>
<section class="resume-wrap <?php echo $themeclass;?>" >
			<div class="resume-container">
				<div class="resume-inner" style="background: rgba(255,255,255,0);">
				
				
<div id="flipbook" style="margin:0 auto;">
	<div class="hard flip-content"><div class="gradient"></div>
	
	
	
	<?php
	$siteurl = site_url();
	$file1 = "./wp-content/plugins/wpjobboard/environment/company/cover_$company_ID.jpg";
	
	if (file_exists($file1)) {
	 echo "<img style ='width:512px;margin-left:0;margin-top:0;' class='img-introduction' src='$siteurl/wp-content/plugins/wpjobboard/environment/company/cover_$company_ID.jpg'><h1 class='frontcover resume-bio-title'>$name</h1>";}
	else { echo "<img class='img-introduction' src='$image'><h1 class='frontcover resume-bio-title'>$name</h1>";}
	?>	
	
	
	</div>
	<div class="hard flip-content"><div class="gradient"></div></div>
	<div class="flip-content"><div class="gradient"></div><div class="introduction"><h2 class="hoatdong resume-bio-title"><?php _e($experience_title);?></h2></div></div>
	<div class="flip-content"><div class="gradient"></div></div>
	<div class="flip-content"><div class="gradient"></div><div class="introduction"><h3><?php _e($name)?></h3>
	<?php 		
		$job = $experience;
		$job = strip_tags($job, '<p><a><b><strong><em><i><ul><li><h3><h4><br>');
		$job = nl2br($job);
		$find = array("</ul><br />", "</li><br />", "</ol><br />");
		$repl = array("</ul>", "</li>", "</ol>");
		_e(str_replace($find, $repl, $job));
	?>
	</div></div>
	<div class="flip-content"><div class="gradient"></div>
	
	<span class="intro">
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
	
	
	</span>
	<div class="flip-content trongsuot"><div class="gradient"></div><h2 class="hoatdong resume-bio-title"><?php echo _e($portfolio_title);?></h2></div>
	<div class="flip-content trongsuot"><div class="gradient"></div></div>
	<?php $directory  = "wp-content/plugins/wpjobboard/environment/company/portfolio/".$company_ID; 
					$images = scandir($directory);
					$ignore = Array(".", "..");
					$count=0;
					$siteurl = site_url();
					$info = $siteurl.'/'.$directory.'/'.$images[2];
					list($width, $height, $type, $attr) = getimagesize($info);
					$oldwidth = $width;
					if ($width!=512) {
						$width = 512;
						$height = $height * (512 / $oldwidth);
					}
					$width = $width*2;
					foreach($images as $dispimage){
						if(!in_array($dispimage, $ignore)){ 
						 ?>
						<div><div class="gradient"></div><img style="width: 100%; height: 100%;" src="<?php echo $siteurl.'/'.$directory.'/'.$dispimage;?>"></div>
						<?php
						$count++;
						}
					}
if($count%2==0){
?>

	<div class="flip-content"><div class="gradient"></div><div class="introduction"><h3><?php _e($education_title);?></h3>
	<?php 		
		$job = $education;
		$job = strip_tags($job, '<p><a><b><strong><em><i><ul><li><h3><h4><br>');
		$job = nl2br($job);
		$find = array("</ul><br />", "</li><br />", "</ol><br />");
		$repl = array("</ul>", "</li>", "</ol>");
		_e(str_replace($find, $repl, $job));
	?>
	</div></div>
	<div class="flip-content"><div class="gradient"></div></div>
	<div class="hard flip-content"><div class="gradient"></div></div>
	<div class="hard flip-content"><div class="gradient"></div><img class="img-logo-end" style="margin-top: 90px;" src="<?php echo $image ?>"><div class="company-name-end"><?php _e($name)?></div></div>
<?php } else {	?>
	<div class="flip-content"><div class="gradient"></div></div>
	<div class="flip-content"><div class="gradient"></div><div class="introduction"><h3><?php _e($education_title);?></h3><?php _e($education) ?></div></div>
	<div class="flip-content"><div class="gradient"></div></div>
	<div class="hard flip-content"><div class="gradient"></div></div>
	<div class="hard flip-content"><div class="gradient"></div><img class="img-logo-end" style="margin-top: 90px;" src="<?php echo $image ?>"><div class="company-name-end"><?php _e($name)?></div></div>
<?php } ?>
</div>

<!--<div id="book">
</div>

<div id="controls" style="top: 50%;
position: absolute;
width: 1176px;
left: -77px;">
	<div style="float:left;"><button id="previous">&larr; Trước</button></div>
	<div style="float:right;"><button id="next">Tiếp &rarr;</button></div>
</div>-->

</div></div>
		</section>
<script type="text/javascript">

	// Sample using dynamic pages with turn.js

	var numberOfPages = <?php echo $count-1?>; 
// Adds the pages that the book will need
	function addPage(page, flipbook) {
		// 	First check if the page is already in the book
		if (!flipbook.turn('hasPage', page)) {
			// Create an element for this page
			var element = $('<div />', {'class': 'page '+((page%2==0) ? 'odd' : 'even'), 'id': 'page-'+page}).html('<i class="loader"></i>');
			// If not then add the page
			flipbook.turn('addPage', element, page);
			
		}
	}

	$(window).ready(function(){
		$('#book').turn({acceleration: true,
							pages: numberOfPages,
							elevation: 50,
							gradients: !$.isTouch,
							when: {
								turning: function(e, page, view) {

									// Gets the range of pages that the book needs right now
									var range = $(this).turn('range', page);

									// Check if each page is within the book
									for (page = range[0]; page<=range[1]; page++) 
										addPage(page, $(this));

								},

								turned: function(e, page) {
									$('#page-number').val(page);
								}
							}
						});

		$('#number-pages').html(numberOfPages);

		$('#page-number').keydown(function(e){

			if (e.keyCode==13)
				$('#flipbook').turn('page', $('#page-number').val());
				
		});
	});

	$(window).bind('keydown', function(e){

		if (e.target && e.target.tagName.toLowerCase()!='input')
			if (e.keyCode==37)
				$('#flipbook').turn('previous');
			else if (e.keyCode==39)
				$('#flipbook').turn('next');

	});

$('#previous').click(function()
{
$('#flipbook').turn('previous');
});
$('#next').click(function()
{
$('#flipbook').turn('next');
});
</script>

<!--<script type="text/javascript">
	$("#flipbook").turn({
		width: 400,
		height: 300,
		autoCenter: true
	});
</script>-->

<script type="text/javascript">
	$("#flipbook").turn({
		width: <?php echo $width?>,
		height: <?php echo $height?>,
		autoCenter: true,
		acceleration: true,
		shadows: !$.isTouch
	});
	$('#flipbook').bind('turned', function(e, page) {

		console.log('Current view: ', $('#flipbook').turn('view'));

	})
</script>