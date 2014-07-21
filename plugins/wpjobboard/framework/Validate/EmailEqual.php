<?php
/**
 * Description of Date
 *
 * @author greg
 * @package
 */

class Daq_Validate_EmailEqual
    extends Daq_Validate_Abstract implements Daq_Validate_Interface
{
    private $_key = null;

    public function  __construct($key)
    {
        $this->_key = $key;
    }

    public function isValid($value)
    {
        if(!isset($_POST[$this->_key])) {
            $this->setError(__("Email do not match", WPJB_DOMAIN));
            return false;
        }

        if($_POST[$this->_key] != $value) {
            $this->setError(__("Email do not match", WPJB_DOMAIN));
            return false;
        }

        return true;
    }
}
?>