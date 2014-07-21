<style type="text/css">
    #wpbs_slider{
        -webkit-border-top-right-radius: 6px;
        -webkit-border-bottom-right-radius: 6px;
        -moz-border-radius-topright: 6px;
        -moz-border-radius-bottomright: 6px;
        border-top-right-radius: 6px;
        border-bottom-right-radius: 6px;
        position: <?php if($sticky=="yes")echo "fixed";else echo "absolute";?>;
        top:<?php echo ($spos);?>px;
        left:-<?php echo $width;?>px;
        width:<?php echo ($width+$icon_box_width);?>px;
        height:<?php echo ($icon_box_height);?>px;
       
        background: <?php echo $bg;?> url('<?php echo $icon_url;?>')  no-repeat;
        background-position: <?php echo ($width+3);?>px 5px;
        cursor: pointer;
        z-index:999999;
                                                        
    }
     
    .icon_label{                
       color: <?php echo $label_color;?>;
       float: right;
      /* -webkit-transform: rotate(-90deg); 
       -moz-transform: rotate(-90deg);   */
       /*padding: 10px <?php echo ($icon_box_width/8);?>px 10px <?php echo ($icon_box_width/8);?>px ;*/
       position:relative;
       /*top: <?php echo ($icon_box_height/2);?>px;*/    
       /*top:<?php echo ($spos+15);?>px;*/
       /*left:25px;*/
       font-size: 12pt; 
       font-weight: bold;
       width: <?php echo $icon_box_width;?>px;       
       height: <?php echo $icon_box_height;?>px;       
    }
    .wpbs_handle{
       padding-top: 5px;
       position: absolute;         
        
       top:-<?php echo ($spos);?>px;
       left:-<?php echo $icon_box_height/2;?>px;
       width:<?php echo ($icon_box_height);?>px;
       height:<?php echo ($icon_box_width);?>px;
    }
    
    #wpbs__cont .widgettitle{
        font-size:10pt;
        font-weight: bold;
    }
    #wpbs__cont{
        color:<?php echo $text_color;?>;
    }
    .widgetcont{
        padding-left: 10px;
        padding-right: 10px;
        font-size:9pt;
    }
</style>