<?php
/**
 * Description of Required
 *
 * @author greg
 * @package 
 */

class Daq_Validate_Checked
    extends Daq_Validate_Abstract implements Daq_Validate_Interface

{
    public function isValid($value)
    {
        
        if ( empty( $_POST['Agreement'] ) ) {  
            $this->setError(__("ERROR: Please accept the Terms of Use.", WPJB_DOMAIN)); 
             return false;
            
        }
        else
      
            return true;
            
            
    }
}
?>