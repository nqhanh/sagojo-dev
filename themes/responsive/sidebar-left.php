<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Main Widget Template
 *
 *
 * @file           sidebar-left.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/sidebar-left.php
 * @link           http://codex.wordpress.org/Theme_Development#Widgets_.28sidebar.php.29
 * @since          available since Release 1.0
 */
?>
<style type="text/css" media="screen">
    
    .slide-out-div {
       /*padding: 20px;*/
        width: 310px;
        background: #F0F8FF;
		box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3), 0 3px 8px rgba(0, 0, 0, 0.2);
        /*border: #29216d 2px solid;*/
		z-index:999;	
    }
    .slide-out-div em {
	width: 300px;
	height: 157px;
	display: block;
	padding: 10px;
	text-align: center;
	font: italic 100% Georgia, "Times New Roman", Times, serif;
	color: #333;
	background: url(<?php echo bloginfo('template_directory');?>/images/wearehiring.png) no-repeat;
	position: absolute;
	top: -136px;
	left: 10px;
}
	</style>
    <script src="<?php echo bloginfo('template_directory');?>/js/jquery.tabSlideOut.v1.3.js"></script>
    <script type="text/javascript">
	var q = jQuery.noConflict();
	</script>     
         <script>
         q(function(){
             q('.slide-out-div').tabSlideOut({
                 tabHandle: '.handle',                              //class of the element that will be your tab
                 pathToTabImage: '<?php echo bloginfo('template_directory');?>/images/contact_tab.gif',          //path to the image for the tab (optionaly can be set using css)
                 imageHeight: '122px',                               //height of tab image
                 imageWidth: '40px',                               //width of tab image    
                 tabLocation: 'left',                               //side of screen where tab lives, top, right, bottom, or left
                 speed: 300,                                        //speed of animation
                 action: 'click',                                   //options: 'click' or 'hover', action to trigger animation
                 topPos: '33%',                                   //position from the top
                 fixedPosition: true                               //options: true makes it stick(fixed position) on scroll
             });
         });

         </script>
		 <div class="slide-out-div"><em></em>
		 <a class="handle" href="http://link-for-non-js-users">Content</a>
		<?php responsive_widgets_before(); // above widgets container hook ?>
        <!--<div id="widgets" class="grid-right col-300 rtl-fit">-->
		<div id="widgets">
        <?php responsive_widgets(); // above widgets hook ?>
            
            <?php if (!dynamic_sidebar('left-sidebar')) : ?>
            <div class="widget-wrapper">
            
                <div class="widget-title"><?php _e('In Archive', 'responsive'); ?></div>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>

            </div><!-- end of .widget-wrapper -->
            <?php endif; //end of right-left ?>

        <?php responsive_widgets_end(); // after widgets hook ?>
        </div><!-- end of #widgets -->
		<?php responsive_widgets_after(); // after widgets container hook ?>
		</div>