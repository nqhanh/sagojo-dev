<!--Neu la nguoi tim viec-->
    <?php  if((wp_get_current_user()->ID>0)&&(!get_user_meta(wp_get_current_user()->ID, "is_employer"))):  ?>

<?php echo $theme->before_widget ?>
<div class="form_alert">
<?php if($title) echo $theme->before_title.$title.$theme->after_title ?>

<form action="<?php esc_attr_e(wpjb_link_to("alert_confirm")) ?>" method="post">
<input type="hidden" name="add_alert" value="1" />
<ul id="wpjb_widget_alerts" class="wpjb_widget">
    <li>
        
        <input type="text" name="keyword" value="" placeholder="<?php _e("Keyword", WPJB_DOMAIN) ?>" size="30" />
    </li>
    <li>
        
        <input type="text" name="email" value="" placeholder="<?php _e("E-mail", WPJB_DOMAIN) ?>" size="30" />
    </li>
    <li>
        <input type="submit" value="<?php _e("Add Alert", WPJB_DOMAIN) ?>" />
    </li>

</ul>
</form>
</div>
<?php echo $theme->after_widget ?>

<?php endif; ?>
<!--End neu la nguoi tim viec-->