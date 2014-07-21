<?php
    $wssopt = get_option('wpbs_opt',array());
    extract($wssopt);
?>
<style type="text/css">
   .inm{
       padding-left: 10px;
       color: #008000;
       font-weight: bold;
   }
   .button-primary{
       -webkit-border-radius: 5px !important;
-moz-border-radius: 5px !important;
border-radius: 5px !important;
   }
    
   .box_tbl{
       width: 100%;
   }
   /*.box_tbl td select, */
   .box_tbl td input{
       padding: 3px;
       font-size: 10pt;        
       font-family: 'Lucida Grande',Arial;
   }
   #wptb{
       width: 600px;
       min-width: 600px;
       font-family: 'Lucida Grande',Arial;    
   }
   
   .sbox{
       border:1px solid #B09CED;
       -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        background: #fafafa;
        margin-bottom: 5px;
   }
   .sbox .hndle{
       margin: 0px;
       padding: 7px;
background: #c1bfea;
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIyOSUiIHN0b3AtY29sb3I9IiNjMWJmZWEiIHN0b3Atb3BhY2l0eT0iMSIvPgogICAgPHN0b3Agb2Zmc2V0PSI3NCUiIHN0b3AtY29sb3I9IiNkOGQwZWYiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  #c1bfea 29%, #d8d0ef 74%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(29%,#c1bfea), color-stop(74%,#d8d0ef));
background: -webkit-linear-gradient(top,  #c1bfea 29%,#d8d0ef 74%);
background: -o-linear-gradient(top,  #c1bfea 29%,#d8d0ef 74%);
background: -ms-linear-gradient(top,  #c1bfea 29%,#d8d0ef 74%);
background: linear-gradient(to bottom,  #c1bfea 29%,#d8d0ef 74%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c1bfea', endColorstr='#d8d0ef',GradientType=0 );


       -webkit-border-top-left-radius: 4px;
       -webkit-border-top-right-radius: 4px;
       -moz-border-radius-topleft: 4px;
       -moz-border-radius-topright: 4px;
       border-top-left-radius: 4px;
       border-top-right-radius: 4px;
       border-bottom:1px solid #B09CED;
       font-weight: normal;
       font-family: 'Lucida Grande', 'Segoe UI';
       text-shadow: 1px 1px 1px #fff;
       cursor:pointer;
   } 
   .sbcont{
       padding: 7px;
   }
   .remv_box{
       float: right;
       margin-top: -2px;
      /* background: rgba(200,0,0,0.7);*/
       color: black;
       border: 0px;
       -webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
cursor: pointer;
background: #bab4ea;
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIyOCUiIHN0b3AtY29sb3I9IiNiYWI0ZWEiIHN0b3Atb3BhY2l0eT0iMSIvPgogICAgPHN0b3Agb2Zmc2V0PSI3NSUiIHN0b3AtY29sb3I9IiNjOGM0ZWIiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  #bab4ea 28%, #c8c4eb 75%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(28%,#bab4ea), color-stop(75%,#c8c4eb));
background: -webkit-linear-gradient(top,  #bab4ea 28%,#c8c4eb 75%);
background: -o-linear-gradient(top,  #bab4ea 28%,#c8c4eb 75%);
background: -ms-linear-gradient(top,  #bab4ea 28%,#c8c4eb 75%);
background: linear-gradient(to bottom,  #bab4ea 28%,#c8c4eb 75%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#bab4ea', endColorstr='#c8c4eb',GradientType=0 );
border: 1px solid #B09CED;
padding: 0px 3px;
   }   
   .toff{
       border-bottom: 0px !important;
       -webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
   } 
   .add_box{
       -webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px; 
padding: 5px !important;
font-family: 'Lucida Grande',Arial;
   }         
   </style>
   
   <div class="wrap">
   <div class="icon32" id="icon-tools"><br></div>
   <h2>Sliding Widgets <a class="add-new-h2" href="http://wpeden.com/product/wordpress-sliding-widget-area/">Get pro for creating multiple (unlimited) sliding widget area</a></h2> <br>
   <div style="clear: both;"></div>
   <div style="float: left;width: 500px;">
   <form action="" method="post" id="wptb">
    <input type="hidden" name="action" value="wpbs_save_settings">
    
         
        
        
       
<div class="inside">
<div class="boxdiv">

<script type="text/javascript">
   
     jQuery(document).ready(function(){ 
        jQuery('#bg_colorbox').miniColors({
                    
                    change: function(hex, rgb) {
                        jQuery("#console").prepend("HEX: " + hex + " (RGB: " + rgb.r + ", " + rgb.g + ", " + rgb.b + ")<br />");
                    }
                    
        }); 
                
        jQuery('#label_colorbox').miniColors({
                    
                    change: function(hex, rgb) {
                        jQuery("#console").prepend("HEX: " + hex + " (RGB: " + rgb.r + ", " + rgb.g + ", " + rgb.b + ")<br />");
                    }
                    
        });
        
      jQuery('#text_colorbox').miniColors({
                    
                    change: function(hex, rgb) {
                        jQuery("#console").prepend("HEX: " + hex + " (RGB: " + rgb.r + ", " + rgb.g + ", " + rgb.b + ")<br />");
                    }
                    
        });
        
     }); 
          
   </script>
<div class="sbox" id="box1">

<div class="sbcont" id="sbcont-box1" >
<table cellpadding="5" cellspacing="0" border="0" class="box_tbl">
<tr><td colspan="2">

<label>Icon url</label><br>
<input type="text" name="wpbs__opt[icon_url]" value="<?php echo $icon_url; ?>" size="62" />

</td></tr>
<!--<tr><td>

<label>Label for Icon</label><br>
<input type="text" name="wpbs__opt[icon_label]" value="<?php echo icon_label; ?>" size="20" />

</td><td colspan="2">

<label>Label Color</label><br>
<input type="text" id="label_colorbox" name="wpbs__opt[label_color]" value="<?php echo $label_color; ?>" size="20" />

</td></tr>-->
<tr><td>

<label>Control box width</label><br>
<input type="text" name="wpbs__opt[icon_box_width]" value="<?php echo $icon_box_width; ?>" size="10" />px

</td><td>

<label>Control box height</label><br>
<input type="text" name="wpbs__opt[icon_box_height]" value="<?php echo $icon_box_height; ?>" size="10" />px

</td></tr>
<tr><td>

<label>Position</label><br>

<select class="ps" rel="box1" name="wpbs__opt[position]">
<option value="left" <?php if($position=="left") echo 'selected="selected"';?>>left</option>
<option value="right" <?php if($position=="right") echo 'selected="selected"';?>>right</option>
<option value="top" <?php if($position=="top") echo 'selected="selected"';?>>top</option>
<option value="bottom" <?php if($position=="bottom") echo 'selected="selected"';?>>bottom</option>
</select>

</td><td>

<label id="spos_box1"><?php if($position=="left" || position=="right") echo "Top";else echo "Left";?></label><br>
<input type="text" name="wpbs__opt[spos]" value="<?php if(!empty($spos))echo $spos;else echo "50"; ?>" size="10" />px

</td></tr>
<tr><td>

<label>Sticky</label><br>

<select name="wpbs__opt[sticky]" style="width: 70px;">
<option value="yes" <?php if($sticky=="yes") echo 'selected="selected"';?>>Yes</option>
<option value="no" <?php if($sticky=="no") echo 'selected="selected"';?>>No</option>
</select>

</td><td>

<label>Background color</label><br>
<input type="text" id="bg_colorbox" name="wpbs__opt[bg]" value="<?php echo $bg; ?>" size="10" /><br />
<label>Text color</label><br>
<input type="text" id="text_colorbox" name="wpbs__opt[text_color]" value="<?php echo $text_color; ?>" size="10" />

</td></tr>
<tr><td>

<label>Box width</label><br>
<input type="text" name="wpbs__opt[width]" value="<?php echo $width; ?>" size="10" />px

</td><td>

<label>Box Height</label><br>
<input type="text" name="wpbs__opt[height]" value="<?php echo $height; ?>" size="10" />px

</td></tr>
<!--<tr><td colspan="2">


<label >Content</label><br>
<textarea cols="83" rows="5" name="wpbs__opt[content]"> <?php if(!empty($content))echo $content;?></textarea>

</td></tr>-->
<tr>
<td colspan="2">
<input type="checkbox" name="wpbs__opt[disable]" value="1" <?php if($disable==1)echo 'checked="checked"'; else echo '';?>> Disable/Hide
</td></tr>
</table>
     
     <div style="clear: both;">&nbsp;</div>
</div>     
     </div>
     
</div>
<br>

   
   
   
   <input type="submit" id="btn" class="button-primary" value="Save Settings"> 
   <span id="loading" style="display: none;"><img src="images/loading.gif" alt=""> saving...</span><br /><br />
   
</div>  


 
 


            <br clear="all" />
    <br clear="all" />
    
    
 
    </form>  
    </div> 
    <div  style="float: right;width: 350px;">
    <a href="http://wpeden.com/wpeden-club/?ref=slidingwidget" style="width:97%;overflow:hidden;margin:5px;background: #fafafa;border: 1px solid #ccc;display: block;float: left;text-align: center;-webkit-border-radius: 6px;-moz-border-radius: 6px;border-radius: 6px;" ><h3 style="margin: 0px;background: #ccc;-webkit-border-top-left-radius: 5px;-webkit-border-top-right-radius: 5px;-moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px;border-top-left-radius: 5px;border-top-right-radius: 5px;padding:5px;text-decoration: none;color:#333">WordPress Themes & Plugins Club</h3><span style="padding:10px;display: block;">WP Eden Club! Download all of our club themes and plugins only for $35 !</span></a>
    <a href="http://wpeden.com/minimax-wordpress-page-layout-builder-plugin/?ref=slidingwidget" style="width:97%;overflow:hidden;margin:5px;background: #fafafa;border: 1px solid #ccc;display: block;float: left;text-align: center;-webkit-border-radius: 6px;-moz-border-radius: 6px;border-radius: 6px;" ><h3 style="margin: 0px;background: #ccc;-webkit-border-top-left-radius: 5px;-webkit-border-top-right-radius: 5px;-moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px;border-top-left-radius: 5px;border-top-right-radius: 5px;padding:5px;text-decoration: none;color:#333">Drag & Drop Page Layout Builder</h3><img src="<?php echo plugins_url('pricing-table/images/minimax.png'); ?>" /></a>
   <a href="http://www.wpdownloadmanager.com/?ref=slidingwidget" style="width:97%;overflow:hidden;margin:5px;background: #fafafa;border: 1px solid #ccc;display: block;float: left;text-align: center;-webkit-border-radius: 6px;-moz-border-radius: 6px;border-radius: 6px;" ><h3 style="margin: 0px;background: #ccc;-webkit-border-top-left-radius: 5px;-webkit-border-top-right-radius: 5px;-moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px;border-top-left-radius: 5px;border-top-right-radius: 5px;padding:5px;text-decoration: none;color:#333">WordPress Download Manager Pro</h3><img src="<?php echo plugins_url('pricing-table/images/wpdm.png'); ?>" /></a>
   <a href="http://www.wpmarketplaceplugin.com/?ref=slidingwidget" style="width:97%;overflow:hidden;margin:5px;background: #fafafa;border: 1px solid #ccc;display: block;float: left;text-align: center;-webkit-border-radius: 6px;-moz-border-radius: 6px;border-radius: 6px;" ><h3 style="margin: 0px;background: #ccc;-webkit-border-top-left-radius: 5px;-webkit-border-top-right-radius: 5px;-moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px;border-top-left-radius: 5px;border-top-right-radius: 5px;padding:5px;text-decoration: none;color:#333">WordPress Marketplace Plugin</h3><img vspace="12" src="<?php echo plugins_url('pricing-table/images/wpmp.png'); ?>" /></a>
   <a href="http://wpeden.com/?ref=slidingwidget" style="width:97%;overflow:hidden;margin:5px;background: #fafafa;border: 1px solid #ccc;display: block;float: left;text-align: center;-webkit-border-radius: 6px;-moz-border-radius: 6px;border-radius: 6px;" ><h3 style="margin: 0px;background: #ccc;-webkit-border-top-left-radius: 5px;-webkit-border-top-right-radius: 5px;-moz-border-radius-topleft: 5px;-moz-border-radius-topright: 5px;border-top-left-radius: 5px;border-top-right-radius: 5px;padding:5px;text-decoration: none;color:#333">WordPress Themes & Plugins Collection</h3><img src="<?php echo plugins_url('pricing-table/images/wpeden.png'); ?>" /></a>
   <div style="clear: both;"></div>
   </div>
     <br>
     <br>
     
    </div>
    
    <br clear="all" />
    <br clear="all" />
    
    <script language="JavaScript">
    <!--
    window.onload=changeps;
    function changeps(){
        if(jQuery('.ps').val()=="left"||jQuery('.ps').val()=="right"){
            jQuery('#spos').text("Top");
        }else{
            jQuery('#spos').text("Left");
        }
    }
    jQuery('.ps').live("change",function(){        
        if(jQuery(this).val()=="left"||jQuery(this).val()=="right"){
            jQuery('#spos_'+jQuery(this).attr("rel")).text("Top");
        }else{
            jQuery('#spos_'+jQuery(this).attr("rel")).text("Left");
        }        
    });
    
   
 
    
      jQuery('#wptb').submit(function(){
           jQuery(this).ajaxSubmit({
               'url': ajaxurl,
               'beforeSubmit':function(){
                   jQuery('#loading').fadeIn();
               },
               'success':function(res){
                   jQuery('#loading').fadeOut();
               }
           });
      return false;
      });
    //-->
    </script>