<?php
/**
 * Description of categoryshow
 *
 * @author greg
 * @package
 
 dat ten file trung voi ten class nhe
 */

class Wpjb_Widget_CategoryShow extends Daq_Widget_Abstract
{
    public function __construct() 
    {
        $this->_context = Wpjb_Project::getInstance();
        $this->_viewAdmin = "category-menu.php";
        $this->_viewFront = "category-menu.php";
        
        parent::__construct(
            "wpjb-category-menu", 
            __("Category-Show", WPJB_DOMAIN),
            array("description"=>__("Cai Nay Cua Toi viet", WPJB_DOMAIN))
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
        $info = wp_get_current_user();
        $isAdmin = true;
        if(!isset($info->wp_capabilities) || !$info->wp_capabilities['administrator']) {
            $isAdmin = false;
        }

        if(Wpjb_Model_Employer::current()->isEmployer()) {
            $this->view->is_employee = false;
        } else {
            $this->view->is_employee = true;
        }

        if($info->ID>0) {
            $this->view->is_loggedin = true;
        } else {
            $this->view->is_loggedin = false;
        }
    }

}
    

?>