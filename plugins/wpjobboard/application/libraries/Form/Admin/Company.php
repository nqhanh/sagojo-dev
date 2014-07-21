<?php
/**
 * Description of Company
 *
 * @author greg
 * @package 
 */

class Wpjb_Form_Admin_Company extends Daq_Form_ObjectAbstract
{
    protected $_model = "Wpjb_Model_Employer";

    const MODE_ADMIN = 1;

    const MODE_SELF = 2;

    private $_mode = null;

    public function __construct($id, $mode = self::MODE_ADMIN)
    {
        $this->_mode = $mode;
        parent::__construct($id);
    }

    public function _exclude()
    {
        if($this->_object->getId()) {
            return array("id" => $this->_object->getId());
        } else {
            return array();
        }
    }
	
	public static function getCVstyle()
    {
        return array(
            0  => __("Default profile", WPJB_DOMAIN),
            1  => __("Modern profile", WPJB_DOMAIN),            
        );

    }
    
    public function init()
    {
        $user = new WP_User($this->getObject()->user_id);
        
        $this->addGroup("default", __("Company", WPJB_DOMAIN));
        $this->addGroup("location", __("Location", WPJB_DOMAIN));
		$this->addGroup("introduction", __("Introduction", WPJB_DOMAIN));
		$this->addGroup("whyus", __("Why us", WPJB_DOMAIN));
        
        $e = new Daq_Form_Element("user_email", Daq_Form_Element::TYPE_TEXT);
        $e->setLabel(__("E-mail", WPJB_DOMAIN));
		$e->setHint("This email is use as contact email");
        $e->addFilter(new Daq_Filter_Trim());
        $e->addValidator(new Daq_Validate_WP_Email(array("exclude"=>$this->getObject()->user_id)));
        $e->setValue($user->user_email);
        $e->setRequired(true);
        $this->addElement($e, "default");
        
        $e = new Daq_Form_Element("company_name");
        $e->setLabel(__("Company Name", WPJB_DOMAIN));
        $e->setRequired(true);
        $e->setValue($this->_object->company_name);
        $this->addElement($e, "default");
		
		$e = new Daq_Form_Element("company_website");
        $e->setLabel(__("Company Website", WPJB_DOMAIN));
        $e->addValidator(new Daq_Validate_Url());
        $e->addFilter(new Daq_Filter_WP_Url);
        $e->setValue($this->_object->company_website);
        $this->addElement($e, "default");
		
		$e = new Daq_Form_Element("company_qual");
        $e->setLabel(__("Number of Employees", WPJB_DOMAIN));
		$e->addValidator(new Daq_Validate_Int());
        $e->setValue($this->_object->company_qual);
        $this->addElement($e, "default");
		
		$e = new Daq_Form_Element("company_field");
        $e->setLabel(__("Field of Business", WPJB_DOMAIN));		
        $e->setValue($this->_object->company_field);
        $this->addElement($e, "default");
        
        $e = new Daq_Form_Element_File("company_logo", Daq_Form_Element::TYPE_FILE);
        $e->setLabel(__("Company Logo", WPJB_DOMAIN));
        $e->setHint(__("Max. file size 30 kB. Image size 300x100 px. File formats *.jpg; *.gif; *.png .", WPJB_DOMAIN));
        $e->addValidator(new Daq_Validate_File_Default());
        $e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        $e->addValidator(new Daq_Validate_File_Size(30000));
        $e->addValidator(new Daq_Validate_File_ImageSize(300, 100));
        $this->addElement($e, "default");
		
		$e = new Daq_Form_Element_File("file", Daq_Form_Element::TYPE_FILE);
        $e->setLabel(__("Company cover", WPJB_DOMAIN));
        $e->setHint(__("Max. file size 200 kB. File formats *.jpg.", WPJB_DOMAIN));
        $e->addValidator(new Daq_Validate_File_Default());
        $e->addValidator(new Daq_Validate_File_Ext("jpg"));
		$e->addValidator(new Daq_Validate_File_Size(200000));
        $this->addElement($e, "default");

        $directory  = "wp-content/plugins/wpjobboard/environment/company/portfolio/".$this->_object->getId();
        $images = scandir($directory);
        $ignore = Array(".", "..");
        $count=0;
        foreach($images as $dispimage){
	        	if(!in_array($dispimage, $ignore)){
	        		$count++;
	        	}
        	}
if ($count==0) { 
        	
        	$e = new Daq_Form_Element_File("portfolio", Daq_Form_Element::TYPE_FILE);
        	$e->setLabel(__("Company gallery", WPJB_DOMAIN));
        	//$e->setHint(__("Max. file size 512Kb. Image size 1024x768 px. File formats *.jpg; *.gif; *.png .", WPJB_DOMAIN));
        	$e->addValidator(new Daq_Validate_File_Default());
        	$e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        	$e->addValidator(new Daq_Validate_File_Size(512000));
        	$e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        	//$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        	$this->addElement($e, "default");

			        $e = new Daq_Form_Element_File("portfolio2", Daq_Form_Element::TYPE_FILE);
			        $e->setLabel(__("", WPJB_DOMAIN));
			        $e->addValidator(new Daq_Validate_File_Default());
			        $e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
			        $e->addValidator(new Daq_Validate_File_Size(512000));
			        $e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
			        //$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        			$this->addElement($e, "default");
        				
        $e = new Daq_Form_Element_File("portfolio3", Daq_Form_Element::TYPE_FILE);
        $e->setLabel(__("", WPJB_DOMAIN));
        $e->addValidator(new Daq_Validate_File_Default());
        $e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        $e->addValidator(new Daq_Validate_File_Size(512000));
        $e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        //$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        $this->addElement($e, "default");
        			
        $e = new Daq_Form_Element_File("portfolio4", Daq_Form_Element::TYPE_FILE);
        $e->setLabel(__("", WPJB_DOMAIN));
        $e->addValidator(new Daq_Validate_File_Default());
        $e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        $e->addValidator(new Daq_Validate_File_Size(512000));
        $e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        //$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        $this->addElement($e, "default");
        		
        $e = new Daq_Form_Element_File("portfolio5", Daq_Form_Element::TYPE_FILE);
        $e->setLabel(__("", WPJB_DOMAIN));
        $e->addValidator(new Daq_Validate_File_Default());
        $e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        $e->addValidator(new Daq_Validate_File_Size(512000));
        $e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        //$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        $this->addElement($e, "default");
        	
        $e = new Daq_Form_Element_File("portfolio6", Daq_Form_Element::TYPE_FILE);
        $e->setLabel(__("", WPJB_DOMAIN));	        
        $e->setHint(__("Max. file size 512Kb. Image size 1024x768 px. File formats *.jpg; *.gif; *.png .", WPJB_DOMAIN));
        $e->addValidator(new Daq_Validate_File_Default());
        $e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        $e->addValidator(new Daq_Validate_File_Size(512000));
        $e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        //$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        $this->addElement($e, "default");      
        }
        
        else if ($count==1) {
        	 
        	$e = new Daq_Form_Element_File("portfolio", Daq_Form_Element::TYPE_FILE);
        	$e->setLabel(__("Company gallery", WPJB_DOMAIN));
        	//$e->setHint(__("Max. file size 512Kb. Image size 1024x768 px. File formats *.jpg; *.gif; *.png .", WPJB_DOMAIN));
        	$e->addValidator(new Daq_Validate_File_Default());
        	$e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        	$e->addValidator(new Daq_Validate_File_Size(512000));
        	$e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        	//$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        	$this->addElement($e, "default");
        
        	$e = new Daq_Form_Element_File("portfolio2", Daq_Form_Element::TYPE_FILE);
        	$e->setLabel(__("", WPJB_DOMAIN));
        	$e->addValidator(new Daq_Validate_File_Default());
        	$e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        	$e->addValidator(new Daq_Validate_File_Size(512000));
        	$e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        	//$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        	$this->addElement($e, "default");
        
        	$e = new Daq_Form_Element_File("portfolio3", Daq_Form_Element::TYPE_FILE);
        	$e->setLabel(__("", WPJB_DOMAIN));
        	$e->addValidator(new Daq_Validate_File_Default());
        	$e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        	$e->addValidator(new Daq_Validate_File_Size(512000));
        	$e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        	//$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        	$this->addElement($e, "default");
        	 
        	$e = new Daq_Form_Element_File("portfolio4", Daq_Form_Element::TYPE_FILE);
        	$e->setLabel(__("", WPJB_DOMAIN));
        	$e->addValidator(new Daq_Validate_File_Default());
        	$e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        	$e->addValidator(new Daq_Validate_File_Size(512000));
        	$e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        	//$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        	$this->addElement($e, "default");
        
        	$e = new Daq_Form_Element_File("portfolio5", Daq_Form_Element::TYPE_FILE);
        	$e->setLabel(__("", WPJB_DOMAIN));
        	$e->setHint(__("Max. file size 512Kb. Image size 1024x768 px. File formats *.jpg; *.gif; *.png .", WPJB_DOMAIN));        	 
        	$e->addValidator(new Daq_Validate_File_Default());
        	$e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        	$e->addValidator(new Daq_Validate_File_Size(512000));
        	$e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        	//$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        	$this->addElement($e, "default");

        }
        else if ($count==2) {
        
        	$e = new Daq_Form_Element_File("portfolio", Daq_Form_Element::TYPE_FILE);
        	$e->setLabel(__("Company gallery", WPJB_DOMAIN));
        	//$e->setHint(__("Max. file size 512Kb. Image size 1024x768 px. File formats *.jpg; *.gif; *.png .", WPJB_DOMAIN));
        	$e->addValidator(new Daq_Validate_File_Default());
        	$e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        	$e->addValidator(new Daq_Validate_File_Size(512000));
        	$e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        	//$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        	$this->addElement($e, "default");
        
        	$e = new Daq_Form_Element_File("portfolio2", Daq_Form_Element::TYPE_FILE);
        	$e->setLabel(__("", WPJB_DOMAIN));
        	$e->addValidator(new Daq_Validate_File_Default());
        	$e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        	$e->addValidator(new Daq_Validate_File_Size(512000));
        	$e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        	//$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        	$this->addElement($e, "default");
        
        	$e = new Daq_Form_Element_File("portfolio3", Daq_Form_Element::TYPE_FILE);
        	$e->setLabel(__("", WPJB_DOMAIN));
        	$e->addValidator(new Daq_Validate_File_Default());
        	$e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        	$e->addValidator(new Daq_Validate_File_Size(512000));
        	$e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        	//$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        	$this->addElement($e, "default");
        
        	$e = new Daq_Form_Element_File("portfolio4", Daq_Form_Element::TYPE_FILE);
        	$e->setLabel(__("", WPJB_DOMAIN));
        	$e->setHint(__("Max. file size 512Kb. Image size 1024x768 px. File formats *.jpg; *.gif; *.png .", WPJB_DOMAIN));
        	$e->addValidator(new Daq_Validate_File_Default());
        	$e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        	$e->addValidator(new Daq_Validate_File_Size(512000));
        	$e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        	//$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        	$this->addElement($e, "default");
   
        }
        
        else if ($count==3) {
        
        	$e = new Daq_Form_Element_File("portfolio", Daq_Form_Element::TYPE_FILE);
        	$e->setLabel(__("Company gallery", WPJB_DOMAIN));
        	//$e->setHint(__("Max. file size 512Kb. Image size 1024x768 px. File formats *.jpg; *.gif; *.png .", WPJB_DOMAIN));
        	$e->addValidator(new Daq_Validate_File_Default());
        	$e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        	$e->addValidator(new Daq_Validate_File_Size(512000));
        	$e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        	//$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        	$this->addElement($e, "default");
        
        	$e = new Daq_Form_Element_File("portfolio2", Daq_Form_Element::TYPE_FILE);
        	$e->setLabel(__("", WPJB_DOMAIN));
        	$e->addValidator(new Daq_Validate_File_Default());
        	$e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        	$e->addValidator(new Daq_Validate_File_Size(512000));
        	$e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        	//$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        	$this->addElement($e, "default");
        
        	$e = new Daq_Form_Element_File("portfolio3", Daq_Form_Element::TYPE_FILE);
        	$e->setLabel(__("", WPJB_DOMAIN));
        	$e->setHint(__("Max. file size 512Kb. Image size 1024x768 px. File formats *.jpg; *.gif; *.png .", WPJB_DOMAIN));
        	$e->addValidator(new Daq_Validate_File_Default());
        	$e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        	$e->addValidator(new Daq_Validate_File_Size(512000));
        	$e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        	//$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        	$this->addElement($e, "default");
       
        }
        
        else if ($count==4) {
        
        	$e = new Daq_Form_Element_File("portfolio", Daq_Form_Element::TYPE_FILE);
        	$e->setLabel(__("Company gallery", WPJB_DOMAIN));
        	//$e->setHint(__("Max. file size 512Kb. Image size 1024x768 px. File formats *.jpg; *.gif; *.png .", WPJB_DOMAIN));
        	$e->addValidator(new Daq_Validate_File_Default());
        	$e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        	$e->addValidator(new Daq_Validate_File_Size(512000));
        	$e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        	//$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        	$this->addElement($e, "default");
        
        	$e = new Daq_Form_Element_File("portfolio2", Daq_Form_Element::TYPE_FILE);
        	$e->setLabel(__("", WPJB_DOMAIN));
        	$e->setHint(__("Max. file size 512Kb. Image size 1024x768 px. File formats *.jpg; *.gif; *.png .", WPJB_DOMAIN));
        	$e->addValidator(new Daq_Validate_File_Default());
        	$e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        	$e->addValidator(new Daq_Validate_File_Size(512000));
        	$e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        	//$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        	$this->addElement($e, "default");

        }
        
        else if ($count==5) {
        
        	$e = new Daq_Form_Element_File("portfolio", Daq_Form_Element::TYPE_FILE);
        	$e->setLabel(__("Company gallery", WPJB_DOMAIN));
        	$e->setHint(__("Max. file size 512Kb. Image size 1024x768 px. File formats *.jpg; *.gif; *.png .", WPJB_DOMAIN));
        	$e->addValidator(new Daq_Validate_File_Default());
        	$e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        	$e->addValidator(new Daq_Validate_File_Size(512000));
        	$e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        	//$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        	$this->addElement($e, "default");

        }    

        $def = wpjb_locale();
		
		$e = new Daq_Form_Element("company_country", Daq_Form_Element::TYPE_SELECT);
        $e->setLabel(__("Company Country", WPJB_DOMAIN));
        $e->setValue(($this->_object->company_country) ? $this->_object->company_country : $def);
        foreach(Wpjb_List_Country::getAll() as $listing) {
            $e->addOption($listing['code'], $listing['code'], $listing['name']);
        }
        $e->addClass("wpjb-location-country");
        $this->addElement($e, "location");		
		
		$e = new Daq_Form_Element("company_address");
        $e->setLabel(__("Company Address", WPJB_DOMAIN));		
        $e->setValue($this->_object->company_address);
        $this->addElement($e, "location");
		
		$e = new Daq_Form_Element("company_location", Daq_Form_Element::TYPE_SELECT);
        $e->setLabel(__("Company Location", WPJB_DOMAIN));		
        $e->setValue(($this->_object->company_location) ? $this->_object->company_location : $def);
		foreach(Wpjb_List_City::getAll() as $listingcity) {
            $e->addOption($listingcity['code'], $listingcity['code'], __($listingcity['name']));
        }
        $e->addClass("wpjb-location-city");
        $this->addElement($e, "location");

        /*$e = new Daq_Form_Element("company_state", Daq_Form_Element::TYPE_SELECT);
        $e->setLabel(__("Company State", WPJB_DOMAIN));
        $e->setValue(($this->_object->company_state) ? $this->_object->company_state : $def);
        foreach(Wpjb_List_State::getByCountry($country) as $k => $v) {
            $e->addOption($k, $k, __($v));
        }
        $this->addElement($e, "location");*/

		/*$e = new Daq_Form_Element("company_zip_code");
        $e->setLabel(__("Company Zip-Code", WPJB_DOMAIN));
        $e->addValidator(new Daq_Validate_StringLength(null, 20));
        $e->setValue($this->_object->company_zip_code);
        $this->addElement($e, "location");*/
 
        $e = new Daq_Form_Element("is_public", Daq_Form_Element::TYPE_CHECKBOX);
        $e->setLabel(__("Publish Profile", WPJB_DOMAIN));
        $e->addOption(1, 1, __("Do not allow job seekers to view company profile", WPJB_DOMAIN));
        $e->setValue($this->_object->is_public);
        $e->addFilter(new Daq_Filter_Int());
        $this->addElement($e, "default");

        if($this->_mode != self::MODE_ADMIN) {
            return;
        }

        $e = new Daq_Form_Element("slug");
        $e->setRequired(true);
        $e->setValue($this->_object->slug);
        $e->setLabel("Company Slug");
        $e->setHint("The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.");
        $e->addValidator(new Daq_Validate_Slug());
        $e->addValidator(new Daq_Validate_Db_NoRecordExists("Wpjb_Model_Employer", "slug", $this->_exclude()));
        //$this->addElement($e, "manage");

        $e = new Daq_Form_Element("is_active", Daq_Form_Element::TYPE_CHECKBOX);
        $e->setLabel(__("Is Active", WPJB_DOMAIN));
        $e->setHint(__("Activates company account", WPJB_DOMAIN));
        $e->addOption(1, 1, __("Yes", WPJB_DOMAIN));
        $e->setValue($this->_object->is_active);
        $e->addFilter(new Daq_Filter_Int());
        $this->addElement($e, "default");
		
		$e = new Daq_Form_Element("stylecv", Daq_Form_Element::TYPE_SELECT);
        $e->setLabel(__("Profile template", WPJB_DOMAIN));
		$e->setHint(__("An innovative approach to profile design.", WPJB_DOMAIN));
        $e->setValue($this->_object->stylecv);
        foreach(self::getCVstyle() as $k => $v) {
            $e->addOption($k, $k, $v);
        }
        $this->addElement($e, "default");
		
		$e = new Daq_Form_Element("company_info", Daq_Form_Element::TYPE_TEXTAREA);
        $e->setLabel(__("Introduction", WPJB_DOMAIN));
		if(version_compare(get_bloginfo("version"), "3.3.0", ">=")) {
            $e->setRenderer("wpjb_form_helper_tinymce");
        } else {
        $eDesc = str_replace(
            '{tags}',
            '<p><a><b><strong><em><i><ul><li><h3><h4><br>',
            __("Use this field to describe your company profile (what you do, company size etc). Only {tags} HTML tags are allowed", WPJB_DOMAIN)
        );
		}
		$eDesc = __("Use this field to describe your company profile (what you do, company size etc).", WPJB_DOMAIN);
        $e->setHint($eDesc);
        $e->setValue($this->_object->company_info);
        $this->addElement($e, "introduction");
		
		$e = new Daq_Form_Element("why_us", Daq_Form_Element::TYPE_TEXTAREA);
        $e->setLabel(__("Why work with us?", WPJB_DOMAIN));
		if(version_compare(get_bloginfo("version"), "3.3.0", ">=")) {
            $e->setRenderer("wpjb_form_helper_tinymce");
        } else {
        $eDesc = str_replace(
            '{tags}',
            '<p><a><b><strong><em><i><ul><li><h3><h4><br>',
            __("Use this field to describe your company profile (what you do, company size etc). Only {tags} HTML tags are allowed", WPJB_DOMAIN)
        );
		}
		/*$eDesc = __("Use this field to describe your company profile (what you do, company size etc).", WPJB_DOMAIN);
        $e->setHint($eDesc);*/
        $e->setValue($this->_object->why_us);
        $this->addElement($e, "whyus");

        apply_filters("wpja_form_init_company", $this);
    }

    public function isValid($values)
    {
        $isValid = parent::isValid($values);

        $ext = $this->getElement("company_logo")->getExt();
        $value = $this->getValues();

        if($ext) {
            $e = new Daq_Form_Element("company_logo_ext");
            $e->setValue($ext);
            $this->addElement($e);
        }

        return $isValid;
    }

    public function save()
    {
        $file = $this->getElement("company_logo");
		
		$cover = null;
        if($this->hasElement("file")) {
            $cover = $this->getElement("file");
        }
		
		$portfolio = null;
        if($this->hasElement("portfolio")) {
            $portfolio = $this->getElement("portfolio");
        }
        
        $portfolio2 = null;
        if($this->hasElement("portfolio2")) {
        	$portfolio2 = $this->getElement("portfolio2");
        }
        $portfolio3 = null;
        if($this->hasElement("portfolio3")) {
        	$portfolio3 = $this->getElement("portfolio3");
        }
        $portfolio4 = null;
        if($this->hasElement("portfolio4")) {
        	$portfolio4 = $this->getElement("portfolio4");
        }
        $portfolio5 = null;
        if($this->hasElement("portfolio5")) {
        	$portfolio5 = $this->getElement("portfolio5");
        }
        $portfolio6 = null;
        if($this->hasElement("portfolio6")) {
        	$portfolio6 = $this->getElement("portfolio6");
        }
        
        wp_update_user(array(
            "ID" => $this->getObject()->user_id,
            "user_email" => $this->getElement("user_email")->getValue()
        ));
        
        parent::save();

        if($file->fileSent()) {
            $file->setDestination(Wpjb_List_Path::getPath("company_logo"));
            $file->upload("logo_".$this->getObject()->getId().".".$file->getExt());
        }
		
		if($cover && $cover->fileSent()) {
            $cover->setDestination(Wpjb_List_Path::getPath("company_logo"));
            $cover->upload("cover_".$this->getObject()->getId().".".$cover->getExt());
        }
		
		$destination = Wpjb_List_Path::getPath("gallery")."/".$this->_object->getId();
        if(!is_dir($destination)) {
        	mkdir($destination);
        }
		if($portfolio && $portfolio->fileSent()) {	
						
            $portfolio->setDestination($destination); 
                       
            $portfolio->upload();
        }
        if($portfolio2 && $portfolio2->fileSent()) {

        	$portfolio2->setDestination($destination);
        
        	$portfolio2->upload();
        }
        if($portfolio3 && $portfolio3->fileSent()) {
        	
        	$portfolio3->setDestination($destination);
        
        	$portfolio3->upload();
        }
        if($portfolio4 && $portfolio4->fileSent()) {        		
        		
        	$portfolio4->setDestination($destination);
        
        	$portfolio4->upload();
        }
        if($portfolio5 && $portfolio5->fileSent()) {       	
        		
        	$portfolio5->setDestination($destination);
        
        	$portfolio5->upload();
        }
        if($portfolio6 && $portfolio6->fileSent()) {
        	
        	$portfolio6->setDestination($destination);
        
        	$portfolio6->upload();
        }
        

    }

}

?>
