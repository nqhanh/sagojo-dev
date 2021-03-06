<?php
/**
 * Description of Categories
 *
 * @author greg
 * @package
 */

class Wpjb_Widget_FreelanceMenu extends Daq_Widget_Abstract
{
    public function __construct() 
    {
        $this->_context = Wpjb_Project::getInstance();
        $this->_viewAdmin = "freelance-menu.php";
        $this->_viewFront = "freelance-menu.php";
        
        parent::__construct(
            "wpjb-freelance-menu", 
            __("Freelance Menu", WPJB_DOMAIN),
            array("description"=>__("Displays Freelance Menu", WPJB_DOMAIN))
        );
    }
    
    public function update($new_instance, $old_instance) 
    {
	$instance = $old_instance;
	$instance['title'] = htmlspecialchars($new_instance['title']);
	$instance['hide'] = (int)($new_instance['hide']);
	$instance['count'] = (int)($new_instance['count']);
	$instance['hide_empty'] = (int)($new_instance['hide_empty']);
        return $instance;
    }
    
}

?>