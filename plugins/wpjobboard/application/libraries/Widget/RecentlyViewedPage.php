<?php
/**
 * Description of Categories
 *
 * @author greg
 * @package
 */

class Wpjb_Widget_RecentlyViewedPage extends Daq_Widget_Abstract
{
    public function __construct() 
    {
        $this->_context = Wpjb_Project::getInstance();
        $this->_viewAdmin = "recently-viewed-page.php";
        $this->_viewFront = "recently-viewed-page.php";
        
        parent::__construct(
            "wpjb-recently-viewed-page", 
            __("Recently Viewed Page", WPJB_DOMAIN),
            array("description"=>__("Recently viewed jobs list on page.", WPJB_DOMAIN))
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
        if(!isset($_COOKIE['wpjb']) || !is_array($_COOKIE['wpjb'])) {
            return "recently-viewed";
        }

        $ids = $_COOKIE['wpjb'];
        arsort($ids);

        $i = 0;
        $list = array();
        foreach($ids as $id => $time) {
            $job = new Wpjb_Model_Job($id);
            $list[] = $job;
            $i++;

            if($i >= 5) {
                break;
            }
        }

        $this->view->jobList = $list;
        
    }

}

?>