<?php
/**
 * Description of Resume
 *
 * @author greg
 * @package 
 */

class Wpjb_Form_Admin_Resume extends Daq_Form_ObjectAbstract
{
    protected $_model = "Wpjb_Model_Resume";

    const MODE_ADMIN = 1;

    const MODE_SELF = 2;

    public static $mode = 1;

    public function _exclude()
    {
        if($this->_object->getId()) {
            return array("id" => $this->_object->getId());
        } else {
            return array();
        }
    }

    protected function _getCategoryArr()
    {
        $query = new Daq_Db_Query();
        return $query->select("t.*")
            ->from("Wpjb_Model_Category t")
            ->order("title")
            ->execute();
    }

    public static function getDegrees()
    {
        return array(
            0  => __("---", WPJB_DOMAIN),
            1  => __("Junior High School", WPJB_DOMAIN),
            2  => __("High School", WPJB_DOMAIN),
            3  => __("Vocational Training/ ITI (Professional Certification)", WPJB_DOMAIN),
            4  => __("Associate Degree", WPJB_DOMAIN),
            5  => __("Diploma (3 years)", WPJB_DOMAIN),
            6  => __("Bachelor&#039;s Degree", WPJB_DOMAIN),
            7  => __("Bachelor of Engineering", WPJB_DOMAIN),
            8  => __("Master&#039;s Degree", WPJB_DOMAIN),
            9  => __("Master of Art (M.A)", WPJB_DOMAIN),
			18  => __("Master of Commerce (M.Com)", WPJB_DOMAIN),			
			10  => __("Master of Science (M.Sc)", WPJB_DOMAIN),
			11  => __("Master of Architecture (M.Arch)", WPJB_DOMAIN),
			12  => __("Master of Business Administration (MBA)", WPJB_DOMAIN),
			13  => __("Master of Engineering/Technology (M.E/M.Tech)", WPJB_DOMAIN),
			14  => __("Master of Law (LLM)", WPJB_DOMAIN),
			15  => __("Master of Medicine/Surgery (MD/MS)", WPJB_DOMAIN),
			16  => __("Master of Pharmacy (M.Pharm)", WPJB_DOMAIN),
			17  => __("Doctorate (PhD)", WPJB_DOMAIN),
            19 => __("Other", WPJB_DOMAIN),
        );
    }

    public static function getExperience()
    {
        return array(
            0  => __("No Work Experience", WPJB_DOMAIN),
            1  => __("Less than 1 Year", WPJB_DOMAIN),
            2  => __("1+ to 2 Years", WPJB_DOMAIN),
            3  => __("2+ to 3 Years", WPJB_DOMAIN),
            4  => __("3+ to 5 Years", WPJB_DOMAIN),
            5  => __("5+ to 7 Years", WPJB_DOMAIN),
            6  => __("7+ to 10 Years", WPJB_DOMAIN),
            7  => __("10+ to 15 Years", WPJB_DOMAIN),
            8  => __("More than 15 Years", WPJB_DOMAIN),
        );

    }
	
	public static function getCurrency()
    {
        return array(
            0  => __("USD", WPJB_DOMAIN),
            1  => __("VND", WPJB_DOMAIN),            
        );

    }
	
	public static function getCVstyle()
    {
        return array(
            0  => __("Default CV", WPJB_DOMAIN),
            1  => __("Modern CV", WPJB_DOMAIN),            
        );

    }
    
    public function init()
    {
        $this->addGroup("default", __("Personal Information", WPJB_DOMAIN)); 
		$this->addGroup("resume", __("Resume", WPJB_DOMAIN));		
		$this->addGroup("experience", __("Experience", WPJB_DOMAIN));
		$this->addGroup("education", __("Education", WPJB_DOMAIN));
		$this->addGroup("skills", __("Skills", WPJB_DOMAIN));		
        $this->addGroup("fields", __("Additional Fields", WPJB_DOMAIN));
		
		$e = new Daq_Form_Element("stylecv", Daq_Form_Element::TYPE_SELECT);
        $e->setLabel(__("CVitae template", WPJB_DOMAIN));
		$e->setHint(__("An innovative approach to cv design.", WPJB_DOMAIN));
        $e->setValue($this->_object->stylecv);
        foreach(self::getCVstyle() as $k => $v) {
            $e->addOption($k, $k, $v);
        }
        $this->addElement($e, "default");
		
		$e = new Daq_Form_Element("is_active", Daq_Form_Element::TYPE_CHECKBOX);
        $e->setLabel(__("Is Resume Active", WPJB_DOMAIN));
        $e->setHint(__("If resume is inactive employers won't find you search results.", WPJB_DOMAIN));
        $e->addOption(1, 1, __("Yes", WPJB_DOMAIN));
        $e->setValue($this->_object->is_active);
        $e->addFilter(new Daq_Filter_Int());
        $this->addElement($e, "default");

        $e = new Daq_Form_Element("firstname");
        $e->setLabel(__("First", WPJB_DOMAIN));
        $e->setRequired(true);
        $e->setValue($this->_object->firstname);
        $this->addElement($e, "default");
        
        $e = new Daq_Form_Element("lastname");
        $e->setLabel(__("Last Name", WPJB_DOMAIN));
        $e->setRequired(true);
        $e->setValue($this->_object->lastname);
        $this->addElement($e, "default");
		
		$e = new Daq_Form_Element("namsinh");
        $e->setLabel(__("Birthday", WPJB_DOMAIN));
        $e->setRequired(true);
        $e->setValue($this->_object->namsinh);
        
        ?>
	    <script language="javascript" type="text/javascript"> $(function() { 
                
                
                //$("#txtCalendar").datepicker(); // by default 
                
                $("#namsinh").datepicker({ showWeek: true, showButtonPanel: true, changeMonth: true, changeYear: true, dateFormat: 'dd/mm/yy', yearRange: '1935:2048' }); }); 
                
                
                </script>       
       <?php
        $this->addElement($e, "default");
		
		$e = new Daq_Form_Element("gender", Daq_Form_Element::TYPE_SELECT);
       $e->setLabel(__("Gender", WPJB_DOMAIN));
	   $e->setValue($this->_object->gender);
       foreach(Wpjb_List_Gender::getAll() as $listing) {
           $e->addOption($listing['code'], $listing['code'], __($listing['name']));
       }
       $e->setRequired(true);
	   $this->addElement($e, "default"); 

        $e = new Daq_Form_Element("country", Daq_Form_Element::TYPE_SELECT);
        $e->setLabel(__("Country", WPJB_DOMAIN));
        $e->setValue($this->_object->country ? $this->_object->country : wpjb_locale());
        foreach(Wpjb_List_Country::getAll() as $listing) {
            $e->addOption($listing['code'], $listing['code'], __($listing['name']));
        }
        $this->addElement($e, "default");
		
		$e = new Daq_Form_Element("city", Daq_Form_Element::TYPE_SELECT);
        $e->setLabel(__("City", WPJB_DOMAIN));
        $e->setValue($this->_object->city ? $this->_object->city : wpjb_locale());
        foreach(Wpjb_List_City::getAll() as $listing) {
            $e->addOption($listing['code'], $listing['code'], __($listing['name']));
        }
        $this->addElement($e, "default");

        $e = new Daq_Form_Element("address");
        $e->setValue($this->_object->address);
        $e->setLabel(__("Address", WPJB_DOMAIN));
        $e->addValidator(new Daq_Validate_StringLength(null, 250));
        $this->addElement($e, "default");
        
        $e = new Daq_Form_Element("email");
        $e->setRequired(true);
        $e->setLabel(__("Email Address", WPJB_DOMAIN));
        $e->setHint(__('This field will be shown only to registered employers.', WPJB_DOMAIN));
        $e->addValidator(new Daq_Validate_Email());
        $e->setValue($this->_object->email);
        $this->addElement($e, "default");

        $e = new Daq_Form_Element("phone");
        $e->setLabel(__("Phone Number", WPJB_DOMAIN));
        $e->setHint(__('This field will be shown only to registered employers.', WPJB_DOMAIN));
        $e->setValue($this->_object->phone);
        $this->addElement($e, "default");

        $e = new Daq_Form_Element("website");
        $e->setLabel(__("Website", WPJB_DOMAIN));
        $e->setHint(__('This field will be shown only to registered employers.', WPJB_DOMAIN));
        $e->addValidator(new Daq_Validate_Url());
        $e->setValue($this->_object->website);
        $this->addElement($e, "default");                

        $e = new Daq_Form_Element_File("image", Daq_Form_Element::TYPE_FILE);
        $e->setLabel(__("Your Photo", WPJB_DOMAIN));
        $e->setHint(__("Max. file size 100 kB. Image size 150x225 px. File formats *.jpg; *.gif; *.png .", WPJB_DOMAIN));
        $e->addValidator(new Daq_Validate_File_Default());
        $e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        $e->addValidator(new Daq_Validate_File_Size(100000));
        $e->addValidator(new Daq_Validate_File_ImageSize(150, 225));
        $this->addElement($e, "default");
        
        $e = new Daq_Form_Element_File("file", Daq_Form_Element::TYPE_FILE);
        $e->setLabel(__("File", WPJB_DOMAIN));
        $e->setHint(__("Allowed Formats: pdf; doc; docx; rtf; txt.", WPJB_DOMAIN));
        $e->addValidator(new Daq_Validate_File_Default());
        $e->addValidator(new Daq_Validate_File_Ext("pdf,doc,docx,rtf,txt"));
        $this->addElement($e, "default");
		
        $directory  = "wp-content/plugins/wpjobboard/environment/resumes/portfolio/".$this->_object->getId();
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
        	$e->setLabel(__("Your Portfolio", WPJB_DOMAIN));
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
        	$e->setLabel(__("Your Portfolio", WPJB_DOMAIN));
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
        	$e->setLabel(__("Your Portfolio", WPJB_DOMAIN));
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
        	$e->setLabel(__("Your Portfolio", WPJB_DOMAIN));
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
        	$e->setLabel(__("Your Portfolio", WPJB_DOMAIN));
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
        	$e->setLabel(__("Your Portfolio", WPJB_DOMAIN));
        	$e->setHint(__("Max. file size 512Kb. Image size 1024x768 px. File formats *.jpg; *.gif; *.png .", WPJB_DOMAIN));
        	$e->addValidator(new Daq_Validate_File_Default());
        	$e->addValidator(new Daq_Validate_File_Ext("jpg,jpeg,gif,png"));
        	$e->addValidator(new Daq_Validate_File_Size(512000));
        	$e->addValidator(new Daq_Validate_File_ImageSize(1024, 768));
        	//$e->addValidator(‘Count’,false, array(‘min’=>1, ‘max’=>6));
        	$this->addElement($e, "default");

        }       
    
        
		$e = new Daq_Form_Element("salary");
        $e->setLabel(__("Salary Preference", WPJB_DOMAIN));
		/*$e->setHint(__("Example: 10.000.000 VND or 1,000 USD", WPJB_DOMAIN));*/
		$e->addValidator(new Daq_Validate_Int());
        $e->setValue($this->_object->salary);
        $this->addElement($e, "resume");
		
		$e = new Daq_Form_Element("sym_currency", Daq_Form_Element::TYPE_SELECT);
        /*$e->setLabel(__("Experience Summary", WPJB_DOMAIN));*/
        $e->setValue($this->_object->sym_currency);
        foreach(self::getCurrency() as $k => $v) {
            $e->addOption($k, $k, $v);
        }
        $this->addElement($e, "resume");

        $e = new Daq_Form_Element("title");
        $e->setLabel(__("Professional Headline", WPJB_DOMAIN));
        $e->setHint(__("Describe yourself in few words, for example: Experienced Web Developer", WPJB_DOMAIN));
        $e->addValidator(new Daq_Validate_StringLength(1, 120));
        $e->setValue($this->_object->title);
        $this->addElement($e, "resume");

        $e = new Daq_Form_Element("category_id", Daq_Form_Element::TYPE_SELECT);
        $e->setLabel(__("Category", WPJB_DOMAIN));
        $e->setValue($this->_object->category_id);
        $e->addValidator(new Daq_Validate_Db_RecordExists("Wpjb_Model_Category", "id"));
        foreach($this->_getCategoryArr() as $category) {			
            $e->addOption($category->id, $category->id, __($category->title));
        }
        $this->addElement($e, "resume");

        $e = new Daq_Form_Element("headline", Daq_Form_Element::TYPE_TEXTAREA);
        $e->setLabel(__("Profile Summary", WPJB_DOMAIN));
        $e->setHint(__("Use this field to list your skills, specialities, experience or goals", WPJB_DOMAIN));
        $e->setValue($this->_object->headline);
        $this->addElement($e, "resume");

        $e = new Daq_Form_Element("years_experience", Daq_Form_Element::TYPE_SELECT);
        $e->setLabel(__("Experience Summary", WPJB_DOMAIN));
        $e->setValue($this->_object->years_experience);
        foreach(self::getExperience() as $k => $v) {
            $e->addOption($k, $k, $v);
        }
        $this->addElement($e, "experience");

        $e = new Daq_Form_Element("experience", Daq_Form_Element::TYPE_TEXTAREA);
        $e->setLabel(__("Experience", WPJB_DOMAIN));
		if(version_compare(get_bloginfo("version"), "3.3.0", ">=")) {
            $e->setRenderer("wpjb_form_helper_tinymce");
        } else {
            $eDesc = str_replace(
                '{tags}',
                '<p><a><b><strong><em><i><ul><li><h3><h4><br>',
                __("Only {tags} HTML tags are allowed", WPJB_DOMAIN)
            );
        }
        $e->addClass("wpjb-textarea-wide");
        $e->setHint(__("List companies you worked for (remember to include: company name, time period, your position and job description)", WPJB_DOMAIN));
        $e->setValue($this->_object->experience);
        $this->addElement($e, "experience");
        
        $e = new Daq_Form_Element("degree", Daq_Form_Element::TYPE_SELECT);
        $e->setLabel(__("Degree", WPJB_DOMAIN));
        $e->setValue($this->_object->degree);
        foreach(self::getDegrees() as $k => $v) {
            $e->addOption($k, $k, $v);
        }
        $this->addElement($e, "education");

        $e = new Daq_Form_Element("education", Daq_Form_Element::TYPE_TEXTAREA);
        $e->setLabel(__("Education", WPJB_DOMAIN));
		if(version_compare(get_bloginfo("version"), "3.3.0", ">=")) {
            $e->setRenderer("wpjb_form_helper_tinymce");
        } else {
            $eDesc = str_replace(
                '{tags}',
                '<p><a><b><strong><em><i><ul><li><h3><h4><br>',
                __("Only {tags} HTML tags are allowed", WPJB_DOMAIN)
            );
        }
        $e->setHint(__("Your education, describe schools you attended, time period, degree and fields of study", WPJB_DOMAIN));
        $e->setValue($this->_object->education);
        $this->addElement($e, "education");
		
		$e = new Daq_Form_Element("skills", Daq_Form_Element::TYPE_TEXTAREA);
        $e->setLabel(__("Skills", WPJB_DOMAIN));
		if(version_compare(get_bloginfo("version"), "3.3.0", ">=")) {
            $e->setRenderer("wpjb_form_helper_tinymce");
        } else {
            $eDesc = str_replace(
                '{tags}',
                '<p><a><b><strong><em><i><ul><li><h3><h4><br>',
                __("Only {tags} HTML tags are allowed", WPJB_DOMAIN)
            );
        }
        $e->setHint(__("The skills section of your resume should be an accurate reflection of skills that you have.", WPJB_DOMAIN));
        $e->setValue($this->_object->skills);
        $this->addElement($e, "skills");       

        if(self::$mode == self::MODE_ADMIN) {
            $e = new Daq_Form_Element("is_approved", Daq_Form_Element::TYPE_SELECT);
            $e->setLabel(__("Resume Status", WPJB_DOMAIN));
            $e->addOption(Wpjb_Model_Resume::RESUME_PENDING, Wpjb_Model_Resume::RESUME_PENDING, __("Pending Approval", WPJB_DOMAIN));
            $e->addOption(Wpjb_Model_Resume::RESUME_DECLINED, Wpjb_Model_Resume::RESUME_DECLINED, __("Declined", WPJB_DOMAIN));
            $e->addOption(Wpjb_Model_Resume::RESUME_APPROVED, Wpjb_Model_Resume::RESUME_APPROVED, __("Approved", WPJB_DOMAIN));
            $e->setValue($this->_object->is_approved);
            $e->addFilter(new Daq_Filter_Int());
            $this->addElement($e, "admin");
        }

        $this->_additionalFields();

        apply_filters("wpja_form_init_resume", $this);

        $this->setModifiedScheme(Wpjb_Project::getInstance()->conf("form_admin_resume", true));
    }

    public function isValid($values)
    {
        $isValid = parent::isValid($values);

        $ext = null;
        if($this->hasElement("image")) {
            $ext = $this->getElement("image")->getExt();
        }
        
        $value = $this->getValues();

        if($ext) {
            $e = new Daq_Form_Element("image_ext");
            $e->setValue($ext);
            $this->addElement($e);
        }

        return $isValid;
    }

    public function save()
    {
        $image = null;
        if($this->hasElement("image")) {
            $image = $this->getElement("image");
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
        
        $file = null;
        if($this->hasElement("file")) {
            $file = $this->getElement("file");
        }

        $valueList = $this->getValues();
        parent::save();
        $this->_saveAdditionalFields($valueList);

        if($image && $image->fileSent()) {
            $image->setDestination(Wpjb_List_Path::getPath("resume_photo"));
            $image->upload("photo_".$this->getObject()->getId().".".$image->getExt());
        }
        
        $destination = Wpjb_List_Path::getPath("portfolio")."/".$this->_object->getId();
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
        
        if($file && $file->fileSent()) {
            $file->setDestination(Wpjb_List_Path::getPath("resume_photo"));
            $file->upload("file_".$this->getObject()->getId().".".$file->getExt());
        }

        apply_filters("wpja_form_save_resume", $this);

        $this->reinit();
    }


    protected function _additionalFields()
    {
        $query = new Daq_Db_Query();
        $result = $query->select("*")->from("Wpjb_Model_AdditionalField t")
            ->joinLeft("t.value t2", "job_id=".$this->getObject()->getId())
            ->where("t.field_for = 3")
            ->where("t.is_active = 1")
            ->execute();


        foreach($result as $field) {
            $e = new Daq_Form_Element("field_".$field->getId(), $field->type);
            $e->setLabel($field->label);
            $e->setHint($field->hint);


            if($field->type == Daq_Form_Element::TYPE_SELECT) {
                $query = new Daq_Db_Query();
                $option = $query->select("*")
                    ->from("Wpjb_Model_FieldOption t")
                    ->where("field_id=?", $field->getId())
                    ->execute();

                foreach($option as $o) {
                    if($o->value == $field->getValue()->value) {
                        $e->setValue($o->id);
                        break;
                    }
                }

            } else {
                $e->setValue($field->getValue()->value);
            }

            if($field->type != Daq_Form_Element::TYPE_CHECKBOX) {
                $e->setRequired((bool)$field->is_required);
            } else {
                $e->addFilter(new Daq_Filter_Int());
            }

            if($field->type == Daq_Form_Element::TYPE_TEXT) {
                switch($field->validator) {
                    case 1:
                        $e->addValidator(new Daq_Validate_StringLength(0, 80));
                        break;
                    case 2:
                        $e->addValidator(new Daq_Validate_StringLength(0, 160));
                        break;
                    case 3:
                        $e->addValidator(new Daq_Validate_Int());
                        break;
                    case 4:
                        $e->addValidator(new Daq_Validate_Float());
                        break;
                }
            }

            foreach((array)$field->getOptionList() as $option) {
                $e->addOption($option->getId(), $option->getId(), __($option->value));
            }

            $this->addElement($e, "fields");
        }
    }

    protected function _saveAdditionalFields(array $valueList)
    {
        $query = new Daq_Db_Query();
        $result = $query->select("*")
            ->from("Wpjb_Model_AdditionalField t")
            ->where("is_active = 1")
            ->where("field_for = 3")
            ->execute();

        $query = new Daq_Db_Query();
        $fieldValue = $query->select("*")
            ->from("Wpjb_Model_FieldValue t")
            ->where("job_id = ?", $this->getObject()->getId())
            ->execute();

        foreach($result as $option) {
            $id = "field_".$option->getId();
            $value = $valueList[$id];
            if($option->type == Daq_Form_Element::TYPE_SELECT) {
                foreach((array)$option->getOptionList() as $opt) {
                    if($opt->id == $value) {
                        $value = $opt->value;
                        break;
                    }
                }
            }

            $object = null;
            foreach($fieldValue as $temp) {
                if($temp->field_id == $option->getId()) {
                    $object = $temp;
                    break;
                }
            }

            if($object === null) {
                $object = new Wpjb_Model_FieldValue();
                $object->field_id = $option->getId();
                $object->job_id = $this->getObject()->getId();
            }

            $object->value = $value;
            $object->save();
        }
    }

}

?>
