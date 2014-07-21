<?php

/**
 * Description of Login
 *
 * @author greg
 * @package
 */

class Wpjb_Form_Frontend_Register extends Daq_Form_Abstract
{
    public function init()
    {
        $this->addGroup("auth", __("User Account", WPJB_DOMAIN));
        $this->addGroup("default", __("Company", WPJB_DOMAIN));
        $this->addGroup("location", __("Location", WPJB_DOMAIN));
		
		$e = new Daq_Form_Element("user_login", Daq_Form_Element::TYPE_TEXT);
		$e->setLabel(__("[:en]Login name[:vi]Tên đăng nhập[:ja]ログイン名", WPJB_DOMAIN));
		$e->setRequired(true);
		$e->addFilter(new Daq_Filter_Trim());
		$e->addValidator(new Daq_Validate_WP_Username());
		$this->addElement($e, "auth");
		
		$e = new Daq_Form_Element("user_email", Daq_Form_Element::TYPE_TEXT);
        $e->setLabel(__("E-mail", WPJB_DOMAIN));
        $e->addFilter(new Daq_Filter_Trim());
        $e->addValidator(new Daq_Validate_WP_Email());
		$e->addValidator(new Daq_Validate_EmailEqual("user_email2"));
        $e->setRequired(true);
        $this->addElement($e, "auth");
		
		/*--Hanh sua--*/ 		
	   
	   $e = new Daq_Form_Element("user_email2", Daq_Form_Element::TYPE_TEXT);
       $e->setLabel(__("Confirm email", WPJB_DOMAIN));
       $e->setRequired(true);
       $this->addElement($e, "auth");
		
		$e = new Daq_Form_Element("user_first_name", Daq_Form_Element::TYPE_TEXT);
        $e->setLabel(__("First name", WPJB_DOMAIN));
        $e->setRequired(true);
        $e->addFilter(new Daq_Filter_Trim());
        /*$e->addValidator(new Daq_Validate_WP_Username());*/
        $this->addElement($e, "auth");
       
        $e = new Daq_Form_Element("user_last_name", Daq_Form_Element::TYPE_TEXT);
        $e->setLabel(__("Last Name", WPJB_DOMAIN));
        $e->setRequired(true);
        $e->addFilter(new Daq_Filter_Trim());
        /*$e->addValidator(new Daq_Validate_WP_Username());*/
        $this->addElement($e, "auth");           
	   
		/*$e = new Daq_Form_Element("isbig", Daq_Form_Element::TYPE_HIDDEN);             
		$e->setValue($_GET['isbig']);
		$this->addElement($e, "auth");*/

        $e = new Daq_Form_Element("company_name");
        $e->setLabel(__("Company name", WPJB_DOMAIN));
        $e->setRequired(true);
        $e->addFilter(new Daq_Filter_Trim());
        $this->addElement($e, "default");

        $e = new Daq_Form_Element("company_website");
        $e->setLabel(__("Company website", WPJB_DOMAIN));
        $e->addValidator(new Daq_Validate_Url());
        $e->addFilter(new Daq_Filter_WP_Url);
        $e->addFilter(new Daq_Filter_Trim());
        $this->addElement($e, "default");

        $e = new Daq_Form_Element_File("company_logo", Daq_Form_Element::TYPE_FILE);
        $e->setLabel(__("Company Logo", WPJB_DOMAIN));		
        $e->setHint(__("Max. file size 30 kB. Image size 300x100 px. File formats *.jpg; *.gif; *.png .", WPJB_DOMAIN));
        $e->addValidator(new Daq_Validate_File_Default());
        $e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        $e->addValidator(new Daq_Validate_File_Size(30000));
        $e->addValidator(new Daq_Validate_File_ImageSize(300, 100));
        //$this->addElement($e, "default");

        $e = new Daq_Form_Element("company_info", Daq_Form_Element::TYPE_TEXTAREA);
        $e->setLabel(__("Company info", WPJB_DOMAIN));
        $e->setRequired(true);
        $e->addFilter(new Daq_Filter_Trim());
        $this->addElement($e, "default");

        $e = new Daq_Form_Element("is_public", Daq_Form_Element::TYPE_CHECKBOX);
        $e->setLabel(__("Publish Profile", WPJB_DOMAIN));
        $e->addOption(1, 1, __("Do not allow job seekers to view company profile", WPJB_DOMAIN));
        $e->setValue($this->_object->is_public);
        $e->addFilter(new Daq_Filter_Int());
        $this->addElement($e, "default");
        $options = get_option( 'myoption' ); 
        
        $def = wpjb_locale();
        $e = new Daq_Form_Element("company_country", Daq_Form_Element::TYPE_SELECT);
        $e->setLabel(__("Company Country", WPJB_DOMAIN));
        $e->setValue(($this->_object->company_country) ? $this->_object->company_country : $def);
        foreach(Wpjb_List_Country::getAll() as $listing) {
            $e->addOption($listing['code'], $listing['code'], __($listing['name']));
        }
        $e->addClass("wpjb-location-country");
        $this->addElement($e, "default");
		
        /*$e = new Daq_Form_Element("company_state");
        $e->setLabel(__("Company State", WPJB_DOMAIN));
        $e->setValue($this->_object->company_state);
        $e->addClass("wpjb-location-state");
        $this->addElement($e, "location");*/

        /*$e = new Daq_Form_Element("company_zip_code");
        $e->setLabel(__("Company Zip-Code", WPJB_DOMAIN));
        $e->addValidator(new Daq_Validate_StringLength(null, 20));
        $e->setValue($this->_object->company_zip_code);
        $this->addElement($e, "location");*/
        
        /*$e = new Daq_Form_Element("company_location");
        $e->setLabel(__("Company Location", WPJB_DOMAIN));
        $e->setValue($this->_object->company_location);
        $e->addClass("wpjb-location-city");
        $this->addElement($e, "location");*/
		
		
		$e = new Daq_Form_Element("company_location", Daq_Form_Element::TYPE_SELECT);
        $e->setLabel(__("Company Location", WPJB_DOMAIN));	
		$e->setValue(($this->_object->company_location) ? $this->_object->company_location : $def);
        foreach(Wpjb_List_City::getAll() as $listing) {
            $e->addOption($listing['code'], $listing['iso2'], __($listing['name']));
        }
        $e->addClass("wpjb-location-city");
		$this->addElement($e, "default");			
		
		/*$e = new Daq_Form_Element("terms", Daq_Form_Element::TYPE_TEXTAREA);      
		foreach(Wpjb_List_Terms::getAll() as $listing) {
            $e->setValue(__($listing['name']));
        $this->addElement($e, "default");*/
	   
		$e = new Daq_Form_Element("Agreement", Daq_Form_Element::TYPE_CHECKBOX);
        $e->setLabel(__("Terms Of Use", WPJB_DOMAIN));
        $e->addOption(1, 1, __("I agree with <a href='http://www.sagojo.com/?page_id=245'>Terms Of Use</a> and <a href='http://www.sagojo.com/?page_id=258'>Privacy Statement</a>", WPJB_DOMAIN));
        $e->setValue($this->_object->is_agree);
	    $e->addValidator(new Daq_Validate_Checked());
	    $e->setRequired(true);
        $e->addFilter(new Daq_Filter_Int());
        $this->addElement($e, "default");
		
        apply_filters("wpjb_form_init_register", $this);
    }


}

?>