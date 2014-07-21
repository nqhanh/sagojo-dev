<?php
/**
 * Description of Ext
 *
 * @author greg
 * @package 
 */

class Daq_Validate_File_Count
    extends Daq_Validate_Abstract implements Daq_Validate_Interface
{
    protected $_ext = array();

    public function __construct($max)
    {
         $this->_count = $max;
    }

	public function isValid($value)
    {
        if($this->_count < $value['count']) {
            $this->setError(__("Max files upload is 6.", DAQ_DOMAIN));
            return false;
        }

        return true;
    }
}

?>