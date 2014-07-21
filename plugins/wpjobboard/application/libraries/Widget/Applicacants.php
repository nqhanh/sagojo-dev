<?php
/**
 * Description of Applicants
 *
 * @author hanhdo
 * @package
 */

class Wpjb_Widget_Applicacants extends Daq_Widget_Abstract
{
    public function __construct() 
    {
        $this->_context = Wpjb_Project::getInstance();
        $this->_viewAdmin = "applicants.php";
        $this->_viewFront = "applicants.php";
        
        parent::__construct(
            "wpjb-applicants", 
            __("Recently Applied", WPJB_DOMAIN),
            array("description"=>__("Displays list of recent applied jobs", WPJB_DOMAIN))
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
        $query = new Daq_Db_Query();
        $this->view->applications = $query->select()
            ->from("Wpjb_Model_Application t1")
			->join("t1.job t2")
			->limit(5)
			->where("t1.user_id = ?", get_current_user_id())
            ->order("applied_at DESC")
            ->execute();
    }
	

}

?>