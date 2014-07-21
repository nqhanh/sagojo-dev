<?php
/**
 * Description of We are hiring Jobs
 *
 * @author hanhdo
 * @package
 */

class Wpjb_Widget_Wearehiring extends Daq_Widget_Abstract
{
    
    public function __construct() 
    {
        $this->_context = Wpjb_Project::getInstance();
        $this->_viewAdmin = "wearehiring.php";
        $this->_viewFront = "wearehiring.php";
        
        parent::__construct(
            "wpjb-wearehiring-jobs", 
            __("We are hiring", WPJB_DOMAIN),
            array("description"=>__("Displays list of recent we are hiring jobs.", WPJB_DOMAIN))
        );
    }
    
    public function update($new_instance, $old_instance) 
    {
	$instance = $old_instance;
	$instance['title'] = htmlspecialchars($new_instance['title']);
	$instance['hide'] = (int)($new_instance['hide']);
	$instance['count'] = (int)($new_instance['count']);
        return $instance;
    }

    public function _filter()
    {
        $query = new Daq_Db_Query();
        $this->view->jobList = Wpjb_Model_Job::activeSelect()
            ->where("t1.is_featured = 1")
			->where("t1.job_phone = '08 7309 1212'")
            ->limit($this->_get("count", 5))
            ->execute();   
    }
    
}

?>