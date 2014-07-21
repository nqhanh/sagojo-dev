<?php
/**
 * Description of Recent Jobs
 *
 * @author greg
 * @package
 */

class Wpjb_Widget_FeaturedJobBanner extends Daq_Widget_Abstract
{
    
    public function __construct() 
    {
        $this->_context = Wpjb_Project::getInstance();
        $this->_viewAdmin = "featured-jobs-banner.php";
        $this->_viewFront = "featured-jobs-banner.php";
        
        parent::__construct(
            "wpjb-featured-job-banner", 
            __("Featured Job Banner", WPJB_DOMAIN),
            array("description"=>__("Displays banner of featured jobs.", WPJB_DOMAIN))
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

    /*public function _filter()
    {
        $query = new Daq_Db_Query();
        $this->view->jobList = Wpjb_Model_Job::activeSelect()
            ->where("t1.is_featured = 1 AND t1.is_big=0")
            ->limit($this->_get("count", 5))
            ->execute();   
    }*/
    public function _filter()
    {
    	$query = new Daq_Db_Query();
    	$this->view->jobList = Wpjb_Model_Job::activeFeature()
    	->where("t1.is_hot = 1")
		->order("RAND()")
    	->limit($this->_get("count", 5))
    	->execute();
    }
    
}

?>