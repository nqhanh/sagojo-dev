<?php
/**
 * Description of Savedjob
 *
 * @author greg
 * @package
 */

class Wpjb_Model_Save extends Daq_Db_OrmAbstract
{
    protected $_name = "wpjb_save";

    protected function _init()
    {
        $this->_reference["job"] = array(
            "localId" => "j_id",
            "foreign" => "Wpjb_Model_Job",
            "foreignId" => "id",
            "type" => "ONE_TO_ONE"
        );
    }

    
}

?>