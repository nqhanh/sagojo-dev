<?php
/**
 * Description of Categories
 *
 * @author greg
 * @package
 */

class Wpjb_Widget_CategoriesHot extends Daq_Widget_Abstract
{
    public function __construct() 
    {
        $this->_context = Wpjb_Project::getInstance();
        $this->_viewAdmin = "categorieshot.php";
        $this->_viewFront = "categorieshot.php";
        
        parent::__construct(
            "wpjb-hot-job-categories", 
            __("Hot Job Categories", WPJB_DOMAIN),
            array("description"=>__("Displays list of available HOT job categories", WPJB_DOMAIN))
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

    public function _filter()
    {
        $query = new Daq_Db_Query();
        $this->view->categories = $query->select()
            ->order("title")
            ->from("Wpjb_Model_Category t")
			->where("t.id = 1")
			->orWhere("t.id = 17") ->orWhere("t.id = 31") ->orWhere("t.id = 58") ->orWhere("t.id = 57") ->orWhere("t.id = 47") ->orWhere("t.id = 34") 
			->orWhere("t.id = 7") ->orWhere("t.id = 15") ->orWhere("t.id = 18") ->orWhere("t.id = 22") 
			->orWhere("t.id = 41") ->orWhere("t.id = 40") ->orWhere("t.id = 2")
            ->execute();
        
    }
}

?>