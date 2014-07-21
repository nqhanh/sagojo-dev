<?php
/**
 * Description of Recent Jobs
 *
 * @author greg
 * @package
 */

class Wpjb_Widget_FeaturedLocalJobs extends Daq_Widget_Abstract
{
    
    public function __construct() 
    {
        $this->_context = Wpjb_Project::getInstance();
        $this->_viewAdmin = "featured-jobs-local.php";
        $this->_viewFront = "featured-jobs-local.php";
        
        parent::__construct(
            "wpjb-featured-local-jobs", 
            __("Home Featured Jobs", WPJB_DOMAIN),
            array("description"=>__("Displays home page list of recent featured jobs.", WPJB_DOMAIN))
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
		/*->order("RAND()")*/
    	/*->limit($this->_get("count", 5))*/
    	->execute();
    }
    
}

?>