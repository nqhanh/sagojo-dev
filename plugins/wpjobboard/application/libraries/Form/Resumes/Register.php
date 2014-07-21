<?php

/**
* Description of Login
*
* @author greg
* @package
*/

class Wpjb_List_From
{
    private static $_list = array();

    public static function getByCode($code)
    {
        return self::_getBy('code', $code);
    }

    public static function getByAlpha2($code)
    {
        return self::_getBy('iso2', $code);
    }

    public static function getByAlpha3($code)
    {
        return self::_getBy('iso3', $code);
    }

    private static function _getBy($index, $code)
    {
        foreach(self::getAll() as $from) {
            if($from[$index] == $code) {
                return $from;
            }
        }
    }

    public static function getAll()
    {
        if(!empty(self::$_list)) {
            return self::$_list;
        }

        $file = "learn_from.ini";
        $default = Wpjb_List_Path::getPath("app_config")."/".$file;
        $user = Wpjb_List_Path::getPath("user_config")."/".$file;

        if(is_file($user)) {
            self::$_list = Daq_Config::parseIni($user, null, true);
        } else {
            self::$_list = Daq_Config::parseIni($default, null, true);
        }

        return self::$_list;
    }
}
class Wpjb_Form_Resumes_Register extends Daq_Form_Abstract
{
   public function init()
   {
       $this->addGroup("default", __("Sign up for job seekers", WPJB_DOMAIN));
	   
	   $e = new Daq_Form_Element("user_login", Daq_Form_Element::TYPE_TEXT);
       $e->setLabel(__("[:en]Login name[:vi]Tên đăng nhập[:ja]ログイン名", WPJB_DOMAIN));
       $e->setRequired(true);
       $e->addFilter(new Daq_Filter_Trim());
       $e->addValidator(new Daq_Validate_WP_Username());
       $this->addElement($e, "default");
	   
	   $e = new Daq_Form_Element("user_email", Daq_Form_Element::TYPE_TEXT);
       $e->setLabel(__("E-mail", WPJB_DOMAIN));
       $e->addFilter(new Daq_Filter_Trim());
       $e->addValidator(new Daq_Validate_WP_Email());
	   $e->addValidator(new Daq_Validate_EmailEqual("user_email2"));
       $e->setRequired(true);
       $this->addElement($e, "default");
	   
	   $e = new Daq_Form_Element("user_email2", Daq_Form_Element::TYPE_TEXT);
       $e->setLabel(__("Confirm email", WPJB_DOMAIN));
       $e->setRequired(true);
       $this->addElement($e, "default");

       $e = new Daq_Form_Element("user_first_name", Daq_Form_Element::TYPE_TEXT);
       $e->setLabel(__("First name", WPJB_DOMAIN));
       $e->setRequired(true);
       $e->addFilter(new Daq_Filter_Trim());
       /*$e->addValidator(new Daq_Validate_WP_Username());*/
       $this->addElement($e, "default");
       
       $e = new Daq_Form_Element("user_last_name", Daq_Form_Element::TYPE_TEXT);
       $e->setLabel(__("Last Name", WPJB_DOMAIN));
       $e->setRequired(true);
       $e->addFilter(new Daq_Filter_Trim());
       /*$e->addValidator(new Daq_Validate_WP_Username());*/
       $this->addElement($e, "default");           	

	   $e = new Daq_Form_Element("user_birthday", Daq_Form_Element::TYPE_TEXT);
       $e->setLabel(__("Birthday", WPJB_DOMAIN));
	   /*$e->setHint(__("&nbsp;&nbsp;&nbsp; Example: 24/12/2013", WPJB_DOMAIN));*/
       $e->setRequired(true);
       $e->addFilter(new Daq_Filter_Trim());
	/*$e->addValidator(new Daq_Validate_Date());*/
	   ?>
	    <script language="javascript" type="text/javascript"> $(function() { 
                
                
                //$("#txtCalendar").datepicker(); // by default 
                
                $("#user_birthday").datepicker({ showWeek: true, showButtonPanel: true, changeMonth: true, changeYear: true, dateFormat: 'dd/mm/yy', yearRange: '1935:2048' }); }); 
                
                
                </script>             
       <?php
       $this->addElement($e, "default"); 

	   $e = new Daq_Form_Element("gender", Daq_Form_Element::TYPE_SELECT);
       $e->setLabel(__("Gender", WPJB_DOMAIN));
	   $e->setValue(($this->_object->gender) ? $this->_object->gender : $def);
       foreach(Wpjb_List_Gender::getAll() as $listing) {
           $e->addOption($listing['code'], $listing['code'], __($listing['name']));
       }
       
	   $this->addElement($e, "default"); 	   
	   
	   $e = new Daq_Form_Element("learn_from", Daq_Form_Element::TYPE_SELECT);
       $e->setLabel(__("I learned about sagojo from", WPJB_DOMAIN));
	   $e->setValue(($this->_object->learn_from) ? $this->_object->learn_from : $def);
       foreach(Wpjb_List_From::getAll() as $listing) {
           $e->addOption($listing['code'], $listing['code'], __($listing['name']));
       }
       $e->setRequired(true);
	   $this->addElement($e, "default");
	   
	   /*$e = new Daq_Form_Element("terms", Daq_Form_Element::TYPE_TEXTAREA);      
		foreach(Wpjb_List_Terms::getAll() as $listing) {
            $e->setValue(__($listing['name']));
        }	   
       $this->addElement($e, "default");*/
	   
	   $e = new Daq_Form_Element("Agreement", Daq_Form_Element::TYPE_CHECKBOX);
       $e->setLabel(__("Terms Of Use", WPJB_DOMAIN));
       $e->addOption(1, 1, __("I agree with <a href='http://www.sagojo.com/?page_id=245'>Terms Of Use</a> and <a href='http://www.sagojo.com/?page_id=258'>Privacy Statement</a>", WPJB_DOMAIN));
       $e->setValue($this->_object->is_agree);
	   $e->addValidator(new Daq_Validate_Checked());
	   $e->setRequired(true);
       $e->addFilter(new Daq_Filter_Int());
       $this->addElement($e, "default");
	   

       apply_filters("wpjr_form_init_register", $this);

   }


}

?>