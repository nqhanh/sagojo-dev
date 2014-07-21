<style type="text/css">

/* The page body */
html, body {
  background: #333;
  /*overflow: hidden;*/
  font-family: Helvetica, Arial, sans-serif;
}

/* The div holding the wooden table img tag */
#wooden-table {
  position: absolute;
  left: -5000px;
}

/* The light table itself */
#lighttable {
  position: relative;
  /*width: 800px;*/
  height: 800px;
  /*background: #eee url(<?php echo plugins_url('images/wooden-table.jpg', __FILE__ );?>);*/
  padding: 70px;
  margin: 0 auto;
  /*border: 20px solid #111;*/
  display: none;
}

/* Photos on the light table */
#lighttable img {
  border: 10px solid #fff;
  box-shadow: 0 0 1em rgba(0, 0, 0, 0.9);
  -moz-box-shadow: 0 0 1em rgba(0, 0, 0, 0.9);
  -webkit-box-shadow: 0 0 1em rgba(0, 0, 0, 0.9);
  position: absolute;
  left: -9999px;
  top: -9999px;
}

/* The description at the top of the page */

#description {
  padding: 10px 10px 5px 10px;
  background: #111;
  color: #fff;
  width: 45em;
  margin: 0 auto -5px auto;
  text-align: center;
}

#description h1 {
  font-size: 14px;
}

#description a {
  color: #bbf;
}

</style>
<script src="<?php echo plugins_url('js/jquery.js', __FILE__ );?>" type="text/javascript"></script>
<script src="<?php echo plugins_url('js/jquery-ui-1.8.2.custom.min.js', __FILE__ );?>" type="text/javascript"></script>
<script src="<?php echo site_url('wp-content/plugins/wpjobboard/templates/job-board/js/imgLiquid.js', __FILE__ );?>" type="text/javascript"></script>
<script type="text/javascript">
				$(document).ready(function () {
					$(".imgLiquidFill").imgLiquid({fill:true});
					$(".imgLiquidNoFill").imgLiquid({fill:false});
				});
			</script>

<script type="text/javascript">

var newImageZIndex = 1;  // To make sure newly-loaded images land on top of images on the table
var loaded = false;      // Used to prevent initPhotos() running twice

// When the document is ready, fire up the table!
$( init );

// When the wooden table image has loaded, start bringing in the photos
function init() {
  var woodenTable = $('#wooden-table img');
  woodenTable.load( initPhotos );

  // Hack for browsers that don't fire load events for cached images
  if ( woodenTable.get(0).complete ) $(woodenTable).trigger("load");
}

// Set up each of the photos on the table

function initPhotos() {

  // (Ensure this function doesn't run twice)
  if ( loaded ) return;
  loaded = true;

  // The table image has loaded, so bring in the table
  $('#lighttable').fadeIn('fast');

  // Process each photo in turn...
  $('#lighttable img').each( function(index) {

    // Set a random position and angle for this photo
    var left = Math.floor( Math.random() * 450 + 500 );
    var top = Math.floor( Math.random() * 100 + 100 );
    var angle = Math.floor( Math.random() * 60 - 30 );
    $(this).css( 'left', left+'px' );
    $(this).css( 'top', top+'px' );
    $(this).css( 'transform', 'rotate(' + angle + 'deg)' );   
    $(this).css( '-moz-transform', 'rotate(' + angle + 'deg)' );   
    $(this).css( '-webkit-transform', 'rotate(' + angle + 'deg)' );
    $(this).css( '-o-transform', 'rotate(' + angle + 'deg)' );

    // Make the photo draggable
    $(this).draggable( { containment: 'parent', stack: '#lighttable img', cursor: 'pointer' } );

    // Hide the photo for now, in case it hasn't finished loading
    $(this).hide();

    // When the photo image has loaded...
    $(this).load( function() {

      // (Ensure this function doesn't run twice)
      if ( $(this).data('loaded') ) return;
      $(this).data('loaded', true);

      // Record the photo's true dimensions
      var imgWidth = $(this).width();
      var imgHeight = $(this).height();

      // Make the photo bigger, so it looks like it's high above the table
      $(this).css( 'width', imgWidth * 1.5 );
      $(this).css( 'height', imgHeight * 1.5 );

      // Make it completely transparent, ready for fading in
      $(this).css( 'opacity', 0 );

      // Make sure its z-index is higher than the photos already on the table
      $(this).css( 'z-index', newImageZIndex++ );

      // Gradually reduce the photo's dimensions to normal, fading it in as we go
      $(this).animate( { width: imgWidth, height: imgHeight, opacity: .95 }, 1200 );
    } );

    // Hack for browsers that don't fire load events for cached images
    if ( this.complete ) $(this).trigger("load");

  });

}

</script>

		
		
<section class="resume-wrap <?php echo $themeclass;?>" >
			<div class="resume-container">
				
<div id="wooden-table"><img src="<?php echo plugins_url('images/wooden-table.jpg', __FILE__ );?>" alt="Wooden table image" /></div>
	
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
			</div><div style="clear:both;padding-bottom:40px;"></div>
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
		</div>
		<div id="lighttable">
		<?php       
					$directory  = "wp-content/plugins/wpjobboard/environment/company/portfolio/".$company_ID; 
					$images = scandir($directory);
					$ignore = Array(".", "..");
					foreach($images as $dispimage){
					    if(!in_array($dispimage, $ignore)){
					    echo "<img src='$siteurl/$directory/$dispimage' width='250px'>";
					    }
					}
					//echo ba_resume_page_portfolio($company_ID,"company");
					?>
	</div>				
				</div>
		</section>