<div style="clear:both;padding-top:60px;"></div>
<?php echo $theme->before_widget ?>
<article class="post"><em></em>
<div class="taber-form-alert">
<div class="outside">
        <div class="inside">
 
        <h5><?php if($title) echo $theme->before_title.$title.$theme->after_title ?></h5>
    
 <p>  
<?php _e('Job Alerts save you time by allowing you to see new job opportunities in your inbox instead of trying to manually search for jobs every day.',WPJB_DOMAIN);?>
</p>
<form id="wpjb-from-tem-a-p" action="<?php esc_attr_e(wpjb_link_to("alert_confirm")) ?>" method="post">
<input type="hidden" name="add_alert" value="1" />
<ul id="taber-wpjb-widget-alerts-page" class="taber-wpjb-widget">
    <li>
        
        <input type="text" name="keyword" value="" placeholder="<?php _e("Keyword", WPJB_DOMAIN) ?>" size="25" />
    </li>
    <li>
        
        <input type="text" name="email" value="" placeholder="<?php _e("E-mail", WPJB_DOMAIN) ?>" size="25" />
    </li>
    <li>
        <input type="submit" value="<?php _e("Add Alert", WPJB_DOMAIN) ?>" />
    </li>

</ul>
</form>
<li style="list-style-type: circle;"><?php _e('Simply enter a search and we&rsquo;ll email you new jobs that match your criteria.',WPJB_DOMAIN) ?></li>
<li style="list-style-type: circle;"><?php _e('Stop and start your alerts at any time. To cancel an alert, click the "delete-alert" link at the bottom of every alert email.',WPJB_DOMAIN) ?></li>
</div></div>
</div>
<?php echo $theme->after_widget ?>

<?php //endif; ?>
