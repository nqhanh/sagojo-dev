<?php
/**
 * Description of Islocal
 *
 * @author greg
 * @package 
 */

class Wpjb_Model_Islocal extends Daq_Db_OrmAbstract
{
    protected $_name = "wpjb_islocal";

    protected function _init()
    {
        $this->_reference["jobs"] = array(
            "localId" => "id",
            "foreign" => "Wpjb_Model_Job",
            "foreignId" => "is_big",
            "type" => "ONE_TO_ONE"
        );
    }

    public function getCount()
    {
        $count = Wpjb_Project::getInstance()->conf("count", array("is_big"=>array()));
        $count = $count["is_big"];

        if(!array_key_exists($this->getId(), $count)) {
            return null;
        }

        return $count[$this->getId()];
    }
}

?>