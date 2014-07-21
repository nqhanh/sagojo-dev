<?php
/**
 * Description of Recent Local Jobs
 *
 * @author greg
 * @package
 */

class Wpjb_Widget_RecentLocalJobs extends Daq_Widget_Abstract
{
    public function __construct() 
    {
        $this->_context = Wpjb_Project::getInstance();
        $this->_viewAdmin = "recent-jobs-local.php";
        $this->_viewFront = "recent-jobs-local.php";
        
        parent::__construct(
            "wpjb-recent-local-jobs", 
            __("Home Top Jobs", WPJB_DOMAIN),
            array("description"=>__("Displays home page list of Top jobs", WPJB_DOMAIN))
        );
    }
    
    public function update($new_instance, $old_instance) 
    {
	$instance = $old_instance;
	$instance['title'] = htmlspecialchars($new_instance['title']);
	$instance['count'] = (int)($new_instance['count']);
	$instance['hide'] = (int)($new_instance['hide']);
        return $instance;
    }

    /*public function _filter()
    {
        $query = new Daq_Db_Query();
        $this->view->jobList = Wpjb_Model_Job::activeSelect()
			->where("t1.is_featured=0")
            ->order("t1.job_created_at DESC")
            ->limit($this->_get("count", 5))
            ->execute();
    }*/
    public function _filter()
    {
    	$query = new Daq_Db_Query();
    	$this->view->jobList = Wpjb_Model_Job::activeFeature()
    	->where("t1.is_new=1")
    	/*->order("t1.job_created_at DESC")*/
    	->order("t1.id DESC")
    	/*->limit($this->_get("count", 5))*/
    	->execute();
    }

}

?>