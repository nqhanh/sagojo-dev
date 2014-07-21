<?php
/**
 * Description of Import
 *
 * @author greg
 * @package 
 */

class Wpjb_Module_Admin_Import extends Wpjb_Controller_Admin
{
    public function init()
    {

    }
    
    public function indexAction()
    {
        
    }

    public function careerbuilderAction()
    {
        $query = new Daq_Db_Query();
        $this->view->category = $query->select("*")
            ->from("Wpjb_Model_Category t")
            ->execute();
    }
    
    public function indeedAction()
    {
        $query = new Daq_Db_Query();
        $this->view->category = $query->select("*")
            ->from("Wpjb_Model_Category t")
            ->execute();
        
        $isConf = Wpjb_Project::getInstance()->getConfig("indeed_publisher");
        if(strlen($isConf)>0 && is_numeric($isConf)) {
            $this->view->isConf = true;
        } else {
            $this->view->isConf = false;
        }
    }
//Import CVitae   
    public function cvitaeAction()
    {
        $element = new Daq_Form_Element_File("file", Daq_Form_Element::TYPE_FILE);
        $element->isRequired(true);
        
        $request = Daq_Request::getInstance();
        
        if($this->isPost() && $element->validate()) {
            $file = $_FILES["file"]["tmp_name"];
            $content = file_get_contents($file);
            $xml = simplexml_load_string($content);
            $i = 0;
           
            foreach ($xml->Item as $resume) {
                $this->_cvimport($resume);
                $i++;
            }
            
            $m = str_replace("{x}", $i, __("CVs imported: {x}."));
            $this->view->_flash->addInfo($m);
        }
    }
    
    protected function _cvimport($xml)
    {
        $user_login = (string)$xml->ContactEmail;
		$fullname = (string)$xml->FullName;
		$pieces = explode(" ", $fullname);
		$result = count($pieces);
		$first_name = $pieces[0];
		for ($i=1;$i<$result-1;$i++) {$first_name.= " ".$pieces[$i];}
		$last_name = $pieces[$result-1];
		
		$email = (string)$xml->ContactEmail;
		$birthday = (string)$xml->Birthday;
		$gender = (int)$xml->Gender;
		$id = username_exists( $user_login );
		if ( !$id and email_exists($email) == false ) {
			$password = wp_generate_password( 8, false);
			$id = wp_create_user($user_login, $password, $email, $first_name, $last_name);
     
			$object = new Wpjb_Model_Resume();
			$object->user_id = $id;
			
			$object->firstname = $first_name;
			$object->lastname = $last_name;
			$object->namsinh = $birthday;
			$object->gender = $gender;
			$object->address = (string)$xml->ContactAddress;
			$object->email = $email;
			$object->phone = (string)$xml->ContactPhone;
			$object->title = (string)$xml->DesiredPosition;
			$object->headline = (string)$xml->CareerObjective;
			$object->experience = (string)$xml->Experience;
			$object->education = (string)$xml->SchoolOfGraduaion;
			$object->years_experience = (int)$xml->YearOfExperience;
			$object->degree = (int)$xml->Education;
			$object->skills = (string)$xml->Skills;
			$object->category_id = $this->_getCategoryId($xml->Major);
			$object->city = (int)$xml->LocationWorking;
			$object->is_active = 1;
			$object->country = 704;
			$object->created_at = date("Y-m-d H:i:s");
			$object->updated_at = date("Y-m-d H:i:s");
			$object->save();
			
			$url = site_url();
			$url .= "/?page_id=100";
			
			$mail = new Wpjb_Utility_Message(17);
                $mail->setTo($email);
                $mail->setParam("username", $user_login);
                $mail->setParam("password", $password);
                $mail->setParam("login_url", $url);
				$mail->setParam("last_name",$last_name);
                $mail->send();
				
		} else {
				$password = __('User already exists.  Password inherited.');
			}
     
    }
	
//Import Jobs    
    public function xmlAction()
    {
        $element = new Daq_Form_Element_File("file", Daq_Form_Element::TYPE_FILE);
        $element->isRequired(true);
        
        $request = Daq_Request::getInstance();
        
        if($this->isPost() && $element->validate()) {
            $file = $_FILES["file"]["tmp_name"];
            $content = file_get_contents($file);
            $xml = simplexml_load_string($content);
            $i = 0;
           
            foreach ($xml->job as $job) {
                $this->_import($job);
                $i++;
            }
            
            $m = str_replace("{x}", $i, __("Jobs imported: {x}."));
            $this->view->_flash->addInfo($m);
        }
    }
    
    protected function _import($xml)
    {
        $id = null;
        if($xml->id > 0) {
            $id = (int)$xml->id;
        }
        
        $job = new Wpjb_Model_Job($id);
        $job->company_name = (string)$xml->company_name;
        $job->company_email = (string)$xml->company_email;
        $job->company_website = (string)$xml->company_website;
        
        $job->job_title = (string)$xml->job_title;
        $job->job_description = (string)$xml->job_description;
        $job->job_required = (string)$xml->job_required;
        $job->job_interest = (string)$xml->job_interest;
        $job->contact_description = (string)$xml->contact_description;
        $job->job_salary = (int)$xml->job_salary;
        $job->sym_currency = (int)$xml->sym_currency;
        $job->job_contact = (string)$xml->job_contact;
        $job->job_phone = (string)$xml->job_phone;
        $job->job_address = (string)$xml->job_address;
        $job->job_slug = $this->_getUniqueSlug($job->job_title);
        
        if(strlen($xml->company_logo_ext)>=3) {
            $job->company_logo_ext = (string)$xml->company_logo_ext;
            $logo = base64_decode((string)$xml->company_logo);
        }
        
        $job->job_category = $this->_getCategoryId($xml->category);
        $job->job_type = $this->_getJobTypeId($xml->job_type);
        
        
        $c = Wpjb_List_Country::getByAlpha2((string)$xml->job_country);
        
        $job->job_country = $c["code"];
        $job->job_state = (string)$xml->job_state;
        $job->job_zip_code = (string)$xml->job_zip_code;
        $job->job_location = (string)$xml->job_location;
        
        $job->job_created_at = (string)$xml->job_created_at;
        if(!(string)$xml->job_modified_at) {
            $job->job_modified_at = (string)$xml->job_modified_at;
        } else {
            $job->job_modified_at = (string)$xml->job_created_at;
        }
        $job->job_visible = (int)$xml->job_visible;
		$job->job_f_visible = (int)$xml->job_f_visible;
        
        $stt = "{$job->job_created_at} +{$job->job_visible} DAYS";
        $job->job_expires_at = date("Y-m-d H:i:s", strtotime($stt));
		
		$sttf = "{$job->job_created_at} +{$job->job_f_visible} DAYS";
        $job->feature_expires_at = date("Y-m-d H:i:s", strtotime($sttf));
        
        $job->is_approved = (int)$xml->is_approved;
        $job->is_active = (int)$xml->is_approved;
        $job->is_featured = (int)$xml->is_featured;
		$job->is_new = (int)$xml->is_new;
		$job->is_hot = (int)$xml->is_hot;
		$job->is_top = (int)$xml->is_top;
        $job->is_filled = (int)$xml->is_filled;
        
        $job->payment_sum = (float)$xml->payment_sum;
        $job->payment_paid = (float)$xml->payment_paid;
        $job->payment_currency = (float)$xml->payment_currency;
        $job->payment_discount = (float)$xml->payment_discount;
        
        
        $job->save();
        
        if($logo) {
            $baseDir = Wpjb_Project::getInstance()->getProjectBaseDir();
            $baseDir = "/environment/images/job_".$job->getId().".".$job->company_logo_ext;
            file_put_contents($baseDir, $file);
        }
        
    }
    
    protected function _getJobTypeId($type)
    {
        $title = (string)$type->title;
        $slug = (string)$type->slug;
        $color = (string)$type->color;
        if(strlen($slug)<1) {
            $slug = sanitize_title_with_dashes($title);
        }
        
        $query = new Daq_Db_Query();
        $result = $query->select("*")
            ->from("Wpjb_Model_JobType t")
            ->where("t.title LIKE ?", "%".$title."%")
            ->orWhere("t.slug LIKE ?", "%".$slug."%")
            ->execute();

        if(count($result)>0) {
            $jobType = $result[0];
            return $jobType->getId();
        } else {
            $jobType = new Wpjb_Model_JobType();
            $jobType->title = $title;
            $jobType->slug = $slug;
            $jobType->color = $color;
            $jobType->save();
            return $jobType->getId();
        }
    }
    
    protected function _getCategoryId($category)
    {
        $title = (string)$category->title;
        $slug = (string)$category->slug;
        if(strlen($slug)<1) {
            $slug = sanitize_title_with_dashes($title);
        }
        
        $query = new Daq_Db_Query();
        $result = $query->select("*")
            ->from("Wpjb_Model_Category t")
            ->where("t.title LIKE ?", "%".$title."%")
            ->orWhere("t.slug LIKE ?", "%".$slug."%")
            ->execute();

        if(count($result)>0) {
            $category = $result[0];
            return $category->getId();
        } else {
            $category = new Wpjb_Model_Category;
            $category->title = $title;
            $category->slug = $slug;
            $category->save();
            return $category->getId();
        }
    }
	
    protected function _getUniqueSlug($title)
    {		
			
		$title = khongdau( $title );		
        $slug = sanitize_title_with_dashes($title);
        $newSlug = $slug;
        $isUnique = true;

        $query = new Daq_Db_Query();
        $query->select("t.job_slug")
            ->from("Wpjb_Model_Job t")
            ->where("(t.job_slug = ?", $newSlug)
            ->orWhere("t.job_slug LIKE ? )", $newSlug."%");

        $list = array();
        $c = 0;
        foreach($query->fetchAll() as $q) {
            $list[] = $q->t__job_slug;
            $c++;
        }

        if($c > 0) {
            $isUnique = false;
            $i = 1;
            do {
                $i++;
                $newSlug = $slug."-".$i;
                if(!in_array($newSlug, $list)) {
                    $isUnique = true;
                }
            } while(!$isUnique);
        }

        return $newSlug;
    }
}

?>