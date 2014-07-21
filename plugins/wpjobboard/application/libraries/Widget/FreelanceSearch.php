<?php
/**
 * Description of Freelance Search
 *
 * @author greg
 * @package
 */

class Wpjb_Widget_FreelanceSearch extends Daq_Widget_Abstract
{
    public function __construct() 
    {
        $this->_context = Wpjb_Project::getInstance();
        $this->_viewAdmin = "freelancesearch.php";
        $this->_viewFront = "freelancesearch.php";
        
        parent::__construct(
            "wpjb-freelance-search", 
            __("Search Projects", WPJB_DOMAIN),
            array("description"=>__("Search projects widget.", WPJB_DOMAIN))
        );
    }

}

?>