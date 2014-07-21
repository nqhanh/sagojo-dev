=== Drag and Drop Front-End Design Builder ===
Contributors: diegpl, pkelbert
Donate link: http://wpsoft.com.br/ 
Tags: drag and drop, front-end, design builder, live edition, limitless, drag-and-drop, drag-n-drop
Requires at least: 3.0.1
Tested up to: 3.8
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Design Builder that allow live edition in the front end through the Limitless drag and drop system (http://themeforest.net/item/limitless-multipurpose-drag-n-drop-theme/5528738)
With this plugin always when you click in an element, their attributes are opened, avoiding waste of time to find it in a big list.

== Description ==

Design Builder that allow live edition in the front end through the Limitless drag and drop system (http://themeforest.net/item/limitless-multipurpose-drag-n-drop-theme/5528738)
With this plugin always when you click in an element, their attributes are opened, avoiding waste of time to find it in a big list.

https://www.youtube.com/watch?v=xoabbUfg_dE

Our sites:
http://wpsoftwares.com

http://wpsoft.com.br

== Installation ==

1. Upload it to plugins folder (/wp-content/plugins/)
2. Activate the plugin
3. For both versions 1.7.7 or 2.0 in a local host you need to set $firstMatrix = array_keys($section[0]['matrix'])[0] instead array_shift(array_keys($arg['matrix'])). I don`t know why, if someone knows that, please tell me.

	For the version 1.7.7:  Change the both foreach at line 194 in limitless/backend/classes/class_enigma.php for this code:

			foreach ($args as $key => $section) {
			
			//first matrix referrer on visual_settings.php
			$firstMatrix = array_shift(array_keys($section[0]['matrix']));		
			$firstMatrixFiltered = trim(trim(str_replace(array(' p.', ' p ','.', ' ul ',' li ',' a ',' ,', '   ','  ',','), ' ', str_replace(array('#',' > span','div.',' > a','h2','h1','h4','a.','h3','table','caption','ul li a','ul li','input[type=text]','>li>a'), '',$firstMatrix)), '.'), ' ');
			
			//$key access the class name
			$code .='<h4 class="engima-styler-title '.$firstMatrixFiltered.'">'.$key.'<i class="angle-downicon- ioa-front-icon"></i> <a href="" class="en-section-reset">'.__('Reset','ioa').'</a> </h4><div class="enigma-styler-section clearfix">';

			foreach ($section as  $key => $arg) {
			$firstMatrix = array_shift(array_keys($arg['matrix']));		
			$firstMatrixFiltered = trim(trim(str_replace(array(' p.', ' p ','.', ' ul ',' li ',' a ',' ,', '   ','  ',','), ' ', str_replace(array('#',' > span','div.',' > a','h2','h1','h4','a.','h3','table','caption','ul li a','ul li','input[type=text]','>li>a'), '',$firstMatrix)), '.'), ' ');
			// $arg['class'] to access the class if I have it no visual_settings		
			// access the first value of matrix array -- array_shift(array_keys($arg['matrix']))
			$code .='<h5 class="sub-styler-title '.$firstMatrixFiltered.'">'.$arg['label'].'<i class="angle-downicon- ioa-front-icon"></i> <a href="" class="en-comp-reset">'.__('Reset','ioa').'</a> </h5><div class="sub-styler-section clearfix">';
	
	For the version 2.0: Change the both foreach at the line 201 at limitless/backend/deprecated/class_enigma.php
	
		foreach ($args as $key => $section) {
			
			//first matrix referrer on visual_settings.php
			//'.var_dump($section[0]['matrix']).'
			
			$firstMatrix = array_keys($section[0]['matrix'])[0];	
			//$firstMatrix = array_shift(array_keys($section[0]['matrix']));	
			//echo var_dump($section[0]['matrix']);
			//echo $firstMatrix;
			$firstMatrixFiltered = trim(trim(str_replace(array(' p.', ' p ','.', ' ul ',' li ',' a ',' ,', '   ','  ',','), ' ', str_replace(array('#',' > span','div.',' > a','h2','h1','h4','a.','h3','table','caption','ul li a','ul li','input[type=text]','>li>a'), '',$firstMatrix)), '.'), ' ');
			
			$code .='<div class="en-sub-sec" data-search="'.strtolower($key).'" ><h4 class="engima-styler-title '.$firstMatrixFiltered.'">'.$key.'<a href="" class="en-section-reset">'.__('Reset','ioa').'</a> </h4><div class="enigma-styler-section clearfix">';

		foreach ($section as  $key => $arg) {
			
			$firstMatrix = array_keys($arg['matrix'])[0];		
			$firstMatrixFiltered = trim(trim(str_replace(array(' p.', ' p ','.', ' ul ',' li ',' a ',' ,', '   ','  ',','), ' ', str_replace(array('#',' > span','div.',' > a','h2','h1','h4','a.','h3','table','caption','ul li a','ul li','input[type=text]','>li>a'), '',$firstMatrix)), '.'), ' ');
			// $arg['class'] to access the class if I have it no visual_settings		
			// access the first value of matrix array -- array_shift(array_keys($arg['matrix']))
						
			$code .='<div class="en-sub-sec" data-search="'.strtolower($arg['label']).'"><h5 class="sub-styler-title '.$firstMatrixFiltered.'">'.$arg['label'].'<a href="" class="en-comp-reset">'.__('Reset','ioa').'</a> </h5><div class="sub-styler-section clearfix">';

4. It is done. Use it!!!

== Frequently Asked Questions ==

= What is missing on this plugin? =

It helps to get the attribute category, but still doesn`t show the exact element you clicked over it.


== Screenshots ==

1. Attributes opened after a click
2. Console running some logs

== Changelog ==

= 1.0 =
* Plugin released.

== Arbitrary section ==



== Markdown ==

1. Don`t waste your time
2. Let your clients more independent
