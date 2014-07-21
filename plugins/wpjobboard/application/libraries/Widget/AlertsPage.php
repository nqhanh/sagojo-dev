<?php
/**
 * Description of JobBoardMenu
 *
 * @author greg
 * @package
 */

class Wpjb_Widget_AlertsPage extends Daq_Widget_Abstract
{
    public function __construct() 
    {
        $this->_context = Wpjb_Project::getInstance();
        $this->_viewAdmin = "alerts-page.php";
        $this->_viewFront = "alerts-page.php";
        
        parent::__construct(
            "wpjb-widget-alerts-page", 
            __("Job Alerts Page", WPJB_DOMAIN),
            array("description"=>__("Allows to create new job alert on page", WPJB_DOMAIN))
        );
    }
    
    public function update($new_instance, $old_instance) 
    {
	$instance = $old_instance;
	$instance['title'] = htmlspecialchars($new_instance['title']);
	$instance['hide'] = (int)($new_instance['hide']);
        return $instance;
    }

    public function _filter()
    {

    }


}

?>