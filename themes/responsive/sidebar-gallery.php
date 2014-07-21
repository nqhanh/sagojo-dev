<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Gallery Widget Template
 *
 *
 * @file           sidebar-gallery.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/sidebar-gallery.php
 * @link           http://codex.wordpress.org/Theme_Development#Widgets_.28sidebar.php.29
 * @since          available since Release 1.0
 */
?>
<style type="text/css">
.toasty_Container{
    display:inline-block;
    /*position:fixed;*/
	position: absolute;
    text-align:left;
    z-index: 1000;
    text-align: left;
}
.toasty_Container.topr{ left:62.7%; }
.toasty_Container.topr .toasty_Holder {
    position: relative;
    width: 310px;
}
#modal-background {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #000;
    opacity: .50;
    -webkit-opacity: .5;
    -moz-opacity: .5;
    filter: alpha(opacity=50);
    z-index: 1000;
}

#modal-content {
    background-color: white;
    border-radius: 10px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    box-shadow: 0 0 20px 0 #222;
    -webkit-box-shadow: 0 0 20px 0 #222;
    -moz-box-shadow: 0 0 20px 0 #222;
    display: none;
    z-index: 1000;
}

#modal-background.active, #modal-content.active {
    display: block;
}​
</style>			
<script>
/*$(document).ready(function() {
  var par = $('menu');
  $(par).hide();
  
  $('icon').click(function(e) {
      $(par).toggle();
      e.preventDefault();
  });
});*/
$(function(){
    $("#modal-launcher, #modal-background").click(function() {
        $("#modal-content, #modal-background").toggleClass("active");
    });
});
</script>
			
		<?php responsive_widgets_before(); // above widgets container hook ?>
        <div id="widgets" class="grid col-300 fit gallery-meta">
		<icon><img src="<?php echo bloginfo('template_directory');?>/images/menu_icon.png" id="modal-launcher" class="menu-icon" /></icon>
		<div id="modal-background"></div>
<menu id="modal-content">
<div class="toasty_Container topr">
<div class="toasty_Holder">

        <?php responsive_widgets(); // above widgets hook ?>
            <?php if (!dynamic_sidebar('gallery-widget')) : ?>
            <div class="widget-wrapper">
            
                <div class="widget-title"><?php _e('In Archive', 'responsive'); ?></div>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>

            </div><!-- end of .widget-wrapper -->
			<?php endif; //end of sidebar-right-half ?>

        <?php responsive_widgets_end(); // after widgets hook ?>
		
</div></div>
</menu>
        </div><!-- end of #widgets -->
		<?php responsive_widgets_after(); // after widgets container hook ?>
