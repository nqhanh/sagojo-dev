<style type="text/css">
    #wpbs_slider{
        -webkit-border-top-left-radius: 6px;
        -webkit-border-top-right-radius: 6px;
        -moz-border-radius-topleft: 6px;
        -moz-border-radius-topright: 6px;
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
        position: <?php if($sticky=="yes")echo "fixed";else echo "absolute";?>;
        /*top:0px;*/
        bottom:-<?php echo ($height);?>px;
        /*left:-<?php //echo $wssopt['width'];?>px;*/
        left:<?php echo ($spos);?>px;
        width:<?php echo ($icon_box_width);?>px;;
        height:<?php echo ($height+$icon_box_height);?>px;
       
        background: <?php echo $bg;?> url('<?php echo $icon_url;?>')  no-repeat;
        background-position: 3px 5px  ;
        cursor: pointer;
        z-index:999999;
    }
    #wpbs__cont{
        margin-top:<?php echo $icon_box_height;?>px;
        color:<?php echo $text_color;?>;
        padding-left: 10px;
        padding-top: 10px;
    }
    .icon_label{
        
        color: <?php echo $label_color;?>;
       float: right;
       /*padding: 8px;*/
       position:relative;
       width: <?php echo $icon_box_width;?>px;       
       height: <?php echo $icon_box_height;?>px;
    }
   
</style>
