<?php
/**
 * Description of Update
 *
 * @author greg
 * @package 
 */

class Wpjb_Module_Admin_Update extends Wpjb_Controller_Admin
{
    public function init()
    {

    }

    public function indexAction()
    {
        $tools = array();
        if(class_exists("ZipArchiive")) {
            $tools['zip'] = true;
        }
        if(Wpjb_Project::getInstance()->conf("front_template") != "default") {
            $tools['tpl'] = true;
        }
        $this->view->tools = $tools;
        
        $this->view->checksum = Wpjb_Utility_Seal::checksum();
        $this->view->upgrade = Wpjb_Upgrade_Manager::check(true);
    }

    public function upgradeAction()
    {       
        if($this->getMethod() != "POST" || !$this->hasParam("checksum") || !$this->hasParam("version")) {
            $this->indexAction();
            return;
        }

        $ck = Wpjb_Utility_Seal::checksum();
        $up = Wpjb_Upgrade_Manager::check(true)->available->version;

        if($ck != $this->_request->post("checksum") || $up != $this->_request->post("version")) {
            $this->indexAction();
            return;
        }

        try {
            $this->view->result = Wpjb_Upgrade_Manager::updateTo($up->available->version);
            $this->view->slot("upgrade", Wpjb_Upgrade_Manager::check(true));
        } catch(Exception $e) {
            $this->view->error = $e->getMessage();
        }
    }
}

?>