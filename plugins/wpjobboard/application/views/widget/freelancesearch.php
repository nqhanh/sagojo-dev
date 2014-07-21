<p>
    <label for="<?php echo $widget->get_field_id("title") ?>">
    <?php _e("Title", WPJB_DOMAIN) ?>
    <?php $this->_html->input(array(
        "id" => $widget->get_field_id("title"),
        "name" => $widget->get_field_name("title"),
        "value" => $instance["title"],
        "type" => "text",
        "class"=> "widefat",
        "maxlength" => 100
    )); 
    ?>
   </label>
</p>