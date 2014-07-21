<?php
/**
 * Description of Applicants
 *
 * @author hanhdo
 * @package
 */

class Wpjb_Widget_Savejobs extends Daq_Widget_Abstract
{
    public function __construct() 
    {
        $this->_context = Wpjb_Project::getInstance();
        $this->_viewAdmin = "savejobs.php";
        $this->_viewFront = "savejobs.php";
        
        parent::__construct(
            "wpjb-save", 
            __("Saved Job", WPJB_DOMAIN),
            array("description"=>__("Displays list saved jobs", WPJB_DOMAIN))
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
        $this->view->saved = $query->select()
            ->from("Wpjb_Model_Save t1")
			->join("t1.job t2")
			->limit(5)
			->where("t1.js_id = ?", get_current_user_id())
            ->order("date DESC")
            ->execute();
    }
	

}

?>