<?php
/**
 * Description of Email
 *
 * @author greg
 * @package 
 */

class Daq_Validate_Textarea
    extends Daq_Validate_Abstract implements Daq_Validate_Interface
{
    public function isValid($value)
    {
        if (strlen($_POST['resume'])<200) {
            $this->setError(__("String is to short", WPJB_DOMAIN));
            return false;
        }
        return true;
    }
}

?>