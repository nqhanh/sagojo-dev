<!-- slider div for top-->
<div id="wpbs_slider">
    
    <div id="wpbs__cont">
    <?php dynamic_sidebar('Sliding Widget');?>
    </div>
    <div class="icon_label" id="icon_label">
    <?php //if(!$icon_url)echo $icon_label;?>
    </div>
    </div>
<script language="JavaScript">
    <!--
      /*var wpsscloseg1 = 0;
      jQuery('#wpbs_slider_g1').click(function() {
          if(wpsscloseg1==1) {
           jQuery('#wpbs_slider_g1').animate({            
            left: '-=295'            
          }, 400, function() {
            // Animation complete.
          });   
          wpsscloseg1 = 0;
          } else {
          jQuery('#wpbs_slider_g1').animate({            
            left: '+=295'            
          }, 400, function() {
            // Animation complete.
          });
          wpsscloseg1 = 1;
          }
      });*/
      var wpssclose_ = 0;
      jQuery('#icon_label').click(function() {
          if(wpssclose_==1) {
           jQuery('#wpbs_slider').animate({            
            top: '-=<?php echo $height;?>'            
          }, 400, function() {
            // Animation complete.
          });   
          wpssclose_ = 0;
          } else {
          jQuery('#wpbs_slider').animate({            
            top: '+=<?php echo $height;?>'            
          }, 400, function() {
            // Animation complete.
          });
          wpssclose_ = 1;
          }
      });
      /*var wpssclosetw = 0;
      jQuery('#wpbs_slider_tw').click(function() {
          if(wpssclosetw==1) {
           jQuery('#wpbs_slider_tw').animate({            
            left: '-=295'            
          }, 400, function() {
            // Animation complete.
          });   
          wpssclosetw = 0;
          } else {
          jQuery('#wpbs_slider_tw').animate({            
            left: '+=295'            
          }, 400, function() {
            // Animation complete.
          });
          wpssclosetw = 1;
          }
      });
      
      jQuery('#wpbs_slider_ol').hover(function(){
         jQuery('#wpbs_slider_ol').animate({            
            left: '+=527'            
          }, 400, function() {
            // Animation complete.
          });    
      },function(){
         jQuery('#wpbs_slider_ol').animate({            
            left: '-=527'            
          }, 400, function() {
            // Animation complete.
          }); 
      });*/
 
    //-->
    </script>