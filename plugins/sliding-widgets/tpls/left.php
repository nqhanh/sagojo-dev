<!-- slider div for left-->
<div id="wpbs_slider">
    <div class="icon_label" id="icon_label">
    <!--<div class="wpbs_handle">-->
    <?php //if(!$icon_url)echo $icon_label;?>
    <!--</div>-->
    </div>
    <div id="wpbs__cont">
    <div  class="widgetcont">
    <?php dynamic_sidebar('Sliding Widget');?>
    </div>
    </div>
    
    </div>

<script language="JavaScript">
    <!--
      
      var wpssclose_ = 0;
      jQuery('#icon_label').click(function() {
          if(wpssclose_==1) {
           jQuery('#wpbs_slider').animate({            
            left: '-=<?php echo $width;?>'            
          }, 400, function() {
            // Animation complete.
          });   
          wpssclose_ = 0;
          } else {
          jQuery('#wpbs_slider').animate({            
            left: '+=<?php echo $width;?>'            
          }, 400, function() {
            // Animation complete.
          });
          wpssclose_ = 1;
          }
      });

 
    //-->
    </script>
    