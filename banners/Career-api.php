<?php
if(isset($_POST['tag']) && $_POST['tag'] !='')
{
	global $wpdb;
	//receive
	$tag = $_POST['tag'];
	require('../../wp-blog-header.php');
	
	$arrayJob = array();
	$response = array();
	$category = array();
	$arrayResume = array();
	if($tag=="categories")
	{	
		$results = $wpdb->get_results("SELECT title,id FROM wpjb_category");
		foreach($results as $c)
        {
            $title = $c->title;
            $temp = explode("[:en]", $title);
            $temp1 = explode("[:vi]",$temp[0]);
			$id = $c->id;
            array_push($category,array("category"=>$temp1[1],"id"=>$id));
        }
        $response = array("categories"=>$category);
        echo json_encode($response);
	}
	//blog
	else if($tag=="blog")
	{
		require('../../rss-reader-api.php');
		  $rss = new Feed('http://sagojo.com/feed');
			$show = $rss->getContent();
			$response = array("RSS_arr" => $rss->getContent());
			echo json_encode($response);	
	}
	//save job
	else if($tag=="savejob")
	{
		$j_id =intval($_POST['j_id']);
		$js_id = intval($_POST['js_id']);
		$save = array(
						'js_id'=>$js_id,
						'j_id'=>$j_id
					 );
		$insert = $wpdb->insert('wpjb_save',$save);
	}
	//delete job is saved
	else if($tag=="deletejob")
	{
		$j_id = intval($_POST['j_id']);
		$js_id = intval ($_POST['js_id']);
		$wpdb->query("DELETE FROM wpjb_save WHERE `j_id`='$j_id' AND `js_id`='$js_id'");
	}
     else if($tag=="getapplied")
    {
        $applyjob = array();
        $user_id = intval($_POST["user_id"]);
        
        $str=        " SELECT job.id AS job_id,";
        $str= $str . " type.id AS type_id, type.title AS type_title, ";
        $str= $str . " category.id AS category_id, category.title AS category_title,";
        $str= $str . " employer.id AS employer_id, employer.company_info AS company_info,";
        $str= $str . " job.company_name, job.company_website, job.company_email, job.company_logo_ext,";
        $str= $str . " job.job_location, job.job_title, job.job_created_at, job.job_description,";
        $str= $str . " job.job_required, job.job_interest, job.contact_description, job.job_salary,";
        $str= $str . " job.sym_currency, job.job_contact, job.job_phone, job.job_address,";
        $str= $str . " job.job_expires_at, job.stat_views, job.geo_latitude, job.geo_longitude, job.job_slug";
        
        $str= $str . " FROM wpjb_application AS apply";
        $str= $str . " INNER JOIN wpjb_job AS job ON apply.job_id = job.id AND apply.user_id =$user_id";
        $str= $str . " LEFT JOIN wpjb_category AS category ON job.job_category = category.id";
        $str= $str . " LEFT JOIN wpjb_type AS type ON job.job_type = type.id";
        $str= $str . " LEFT JOIN wpjb_employer AS employer ON job.employer_id = employer.id";
        
        $str= $str . " ORDER BY apply.applied_at DESC";
    
        $results = $wpdb->get_results($str);
        
        //print_r ($results);
        
        foreach($results as $m)
        {
            $job_id = $m->job_id;
            
            $type_id = $m->type_id;
            $iparr = split ("\[:vi]", $m->type_title);
            $iparr = split ("\[:ja]", $iparr[1]);
            $type_title = $iparr[0];
            
            $category_id = $m->category_id;
            $iparr = split ("\[:en]", $m->category_title);
            $iparr = split ("\[:vi]", $iparr[0]);
            $category_title = $iparr[1];
            
            $employer_id = $m->employer_id;
            $company_info = $m->company_info;
            $company_name = $m->company_name;
            $company_website = $m->company_website;
            $company_email = $m->company_email;
            $company_logo_ext = $m->company_logo_ext;
            $job_location = $m->job_location;
            $job_title = $m->job_title;
            
            $date = new DateTime($m->job_created_at);
            $job_created_at = date_format($date ,'d/m/Y H:i:s');
            
            $job_description = $m->job_description;
            $job_required = $m->job_required;
            $job_interest = $m->job_interest;
            $contact_description = $m->contact_description;
            $job_salary = $m->job_salary;
            $sym_currency = $m->sym_currency;
            $job_contact = $m->job_contact;
            $job_phone = $m->job_phone;
            $job_address = $m->job_address;
            $date1= new DateTime($m->job_expires_at);
            $job_expires_at = date_format($date1 ,'d/m/Y H:i:s');
            $stat_views = $m->stat_views;
            $geo_latitude = $m->geo_latitude;
            $geo_longitude = $m->geo_longitude;
            $job_slug = $m->job_slug;
            
            array_push($applyjob,array("job_id" => $job_id, "type_id" => $type_id, "type_title" => $type_title, "category_id" => $category_id, "category_title" => $category_title, "employer_id" => $employer_id, "company_info" => $company_info, "company_name" => $company_name, "company_website" => $company_website, "company_email" => $company_email, "company_logo_ext" => $company_logo_ext, "job_location" => $job_location, "job_title" => $job_title, "job_created_at" => $job_created_at, "job_description" => $job_description, "job_required" => $job_required, "job_interest" => $job_interest, "contact_description" => $contact_description, "job_salary" => $job_salary, "sym_currency" => $sym_currency, "job_contact" => $job_contact, "job_phone" => $job_phone, "job_address" => $job_address, "job_expires_at" => $job_expires_at, "stat_views" => $stat_views, "geo_latitude" => $geo_latitude, "geo_longitude" => $geo_longitude, "job_slug" => $job_slug));
        }
        $response = array("appliedjobs"=>$applyjob);
        echo json_encode($response);
    }
		//delete job is applied
	else if($tag=="deletejobapplied")
	{
		$j_id = intval($_POST['j_id']);
		$js_id = intval ($_POST['js_id']);
		$wpdb->query("DELETE FROM wpjb_application WHERE `job_id`='$j_id' AND `user_id`='$js_id'");
	}
   //get all save job by user id
    else if($tag=="getsavejob")
    {
        $savejob = array();
        $js_id = intval($_POST['js_id']);
        
        $str=        " SELECT job.id AS job_id,";
        $str= $str . " type.id AS type_id, type.title AS type_title, ";
        $str= $str . " category.id AS category_id, category.title AS category_title,";
        $str= $str . " employer.id AS employer_id, employer.company_info AS company_info,";
        $str= $str . " job.company_name, job.company_website, job.company_email, job.company_logo_ext,";
        $str= $str . " job.job_location, job.job_title, job.job_created_at, job.job_description,";
        $str= $str . " job.job_required, job.job_interest, job.contact_description, job.job_salary,";
        $str= $str . " job.sym_currency, job.job_contact, job.job_phone, job.job_address,";
        $str= $str . " job.job_expires_at, job.stat_views, job.geo_latitude, job.geo_longitude, job.job_slug";
        
        $str= $str . " FROM wpjb_save AS save";
        $str= $str . " INNER JOIN wpjb_job AS job ON save.j_id = job.id AND save.js_id =$js_id";
        $str= $str . " LEFT JOIN wpjb_category AS category ON job.job_category = category.id";
        $str= $str . " LEFT JOIN wpjb_type AS type ON job.job_type = type.id";
        $str= $str . " LEFT JOIN wpjb_employer AS employer ON job.employer_id = employer.id";
        
        $str= $str . " ORDER BY save.date DESC";
        
        $results = $wpdb->get_results($str);
        
        foreach($results as $m)
        {
            $job_id = $m->job_id;
            
            $type_id = $m->type_id;
            $iparr = split ("\[:vi]", $m->type_title);
            $iparr = split ("\[:ja]", $iparr[1]);
            $type_title = $iparr[0];
            
            $category_id = $m->category_id;
            $iparr = split ("\[:en]", $m->category_title);
            $iparr = split ("\[:vi]", $iparr[0]);
            $category_title = $iparr[1];
            
            $employer_id = $m->employer_id;
            $company_info = $m->company_info;
            $company_name = $m->company_name;
            $company_website = $m->company_website;
            $company_email = $m->company_email;
            $company_logo_ext = $m->company_logo_ext;
            $job_location = $m->job_location;
            $job_title = $m->job_title;
            
            $date = new DateTime($m->job_created_at);
            $job_created_at = date_format($date ,'d/m/Y H:i:s');
            
            $job_description = $m->job_description;
            $job_required = $m->job_required;
            $job_interest = $m->job_interest;
            $contact_description = $m->contact_description;
            $job_salary = $m->job_salary;
            $sym_currency = $m->sym_currency;
            $job_contact = $m->job_contact;
            $job_phone = $m->job_phone;
            $job_address = $m->job_address;
            $date1= new DateTime($m->job_expires_at);
            $job_expires_at = date_format($date1 ,'d/m/Y H:i:s');
            $stat_views = $m->stat_views;
            $geo_latitude = $m->geo_latitude;
            $geo_longitude = $m->geo_longitude;
            $job_slug = $m->job_slug;
            
            array_push($savejob,array("job_id" => $job_id, "type_id" => $type_id, "type_title" => $type_title, "category_id" => $category_id, "category_title" => $category_title, "employer_id" => $employer_id, "company_info" => $company_info, "company_name" => $company_name, "company_website" => $company_website, "company_email" => $company_email, "company_logo_ext" => $company_logo_ext, "job_location" => $job_location, "job_title" => $job_title, "job_created_at" => $job_created_at, "job_description" => $job_description, "job_required" => $job_required, "job_interest" => $job_interest, "contact_description" => $contact_description, "job_salary" => $job_salary, "sym_currency" => $sym_currency, "job_contact" => $job_contact, "job_phone" => $job_phone, "job_address" => $job_address, "job_expires_at" => $job_expires_at, "stat_views" => $stat_views, "geo_latitude" => $geo_latitude, "geo_longitude" => $geo_longitude, "job_slug" => $job_slug));
        }
        $response = array("savejobs"=>$savejob);
        echo json_encode($response);
    
    }
	//all jobs
    else if($tag == 'alljob')
    {
		$date_expires = date("Y-m-d 23:59:59");
        $str=        " SELECT job.id AS job_id,";
        $str= $str . " type.id AS type_id, type.title AS type_title, ";
        $str= $str . " category.id AS category_id, category.title AS category_title,";
        $str= $str . " employer.id AS employer_id, employer.company_info AS company_info,";
        $str= $str . " job.company_name, job.company_website, job.company_email, job.company_logo_ext,";
        $str= $str . " job.job_location, job.job_title, job.job_created_at, job.job_description,";
        $str= $str . " job.job_required, job.job_interest, job.contact_description, job.job_salary,";
        $str= $str . " job.sym_currency, job.job_contact, job.job_phone, job.job_address,";
        $str= $str . " job.job_expires_at, job.stat_views, job.geo_latitude, job.geo_longitude, job.job_slug";
            
        $str= $str . " FROM wpjb_job AS job";
        $str= $str . "  JOIN wpjb_category AS category ON job.job_category = category.id";
        $str= $str . "  JOIN wpjb_type AS type ON job.job_type = type.id";
        $str= $str . " LEFT JOIN wpjb_employer AS employer ON job.employer_id = employer.id";
            
        $str= $str . " WHERE job.is_active=1 AND DATEDIFF(job.job_expires_at,CURDATE()) > 0 AND job.is_filled = 0";
        $str= $str . " ORDER BY job.id DESC";
            
        $rs = $wpdb->get_results($str);
        
        foreach($rs as $m)
        {
            $job_id = $m->job_id;
            
            $type_id = $m->type_id;
            $iparr = split ("\[:vi]", $m->type_title);
            $iparr = split ("\[:ja]", $iparr[1]);
            $type_title = $iparr[0];
            
            $category_id = $m->category_id;
            $iparr = split ("\[:en]", $m->category_title);
            $iparr = split ("\[:vi]", $iparr[0]);
            $category_title = $iparr[1];
            
            $employer_id = $m->employer_id;
            $company_info = $m->company_info;
            $company_name = $m->company_name;
            $company_website = $m->company_website;
            $company_email = $m->company_email;
            $company_logo_ext = $m->company_logo_ext;
            $job_location = $m->job_location;
            $job_title = $m->job_title;
                
            $date = new DateTime($m->job_created_at);
            $job_created_at = date_format($date ,'d/m/Y H:i:s');
            
            $job_description = $m->job_description;
            $job_required = $m->job_required;
            $job_interest = $m->job_interest;
            $contact_description = $m->contact_description;
            $job_salary = $m->job_salary;
            $sym_currency = $m->sym_currency;
            $job_contact = $m->job_contact;
            $job_phone = $m->job_phone;
            $job_address = $m->job_address;
            $date1= new DateTime($m->job_expires_at);
            $job_expires_at = date_format($date1 ,'d/m/Y H:i:s');
            $stat_views = $m->stat_views;
            $geo_latitude = $m->geo_latitude;
            $geo_longitude = $m->geo_longitude;
            $job_slug = $m->job_slug;
                
            array_push($arrayJob,array("job_id" => $job_id, "type_id" => $type_id, "type_title" => $type_title, "category_id" => $category_id, "category_title" => $category_title, "employer_id" => $employer_id, "company_info" => $company_info, "company_name" => $company_name, "company_website" => $company_website, "company_email" => $company_email, "company_logo_ext" => $company_logo_ext, "job_location" => $job_location, "job_title" => $job_title, "job_created_at" => $job_created_at, "job_description" => $job_description, "job_required" => $job_required, "job_interest" => $job_interest, "contact_description" => $contact_description, "job_salary" => $job_salary, "sym_currency" => $sym_currency, "job_contact" => $job_contact, "job_phone" => $job_phone, "job_address" => $job_address, "job_expires_at" => $job_expires_at, "stat_views" => $stat_views, "geo_latitude" => $geo_latitude, "geo_longitude" => $geo_longitude, "job_slug" => $job_slug));
        }
        $response = array("arrayJob" => $arrayJob);
        echo json_encode($response);       
    }
	//all jobs 1
    else if($tag == 'alljob1')
    {
        $date_expires = date("Y-m-d 23:59:59");
        $str=        " SELECT job.id AS job_id,";
        $str= $str . " type.id AS type_id, type.title AS type_title, ";
        $str= $str . " category.id AS category_id, category.title AS category_title,";
        $str= $str . " employer.id AS employer_id, employer.company_info AS company_info,";
        $str= $str . " job.company_name, job.company_website, job.company_email, job.company_logo_ext,";
        $str= $str . " job.job_location, job.job_title, job.job_created_at, job.job_description,";
        $str= $str . " job.job_required, job.job_interest, job.contact_description, job.job_salary,";
        $str= $str . " job.sym_currency, job.job_contact, job.job_phone, job.job_address,";
        $str= $str . " job.job_expires_at, job.stat_views, job.geo_latitude, job.geo_longitude, job.job_slug";
            
        $str= $str . " FROM wpjb_job AS job";
        $str= $str . " LEFT JOIN wpjb_category AS category ON job.job_category = category.id";
        $str= $str . " LEFT JOIN wpjb_type AS type ON job.job_type = type.id";
        $str= $str . " LEFT JOIN wpjb_employer AS employer ON job.employer_id = employer.id";
            
        $str= $str . " WHERE job.is_active=1 AND DATEDIFF(job.job_expires_at,CURDATE()) > 0 AND job.is_filled = 0";
        $str= $str . " ORDER BY job.id DESC LIMIT 0,200";
            
        $rs = $wpdb->get_results($str);
        
        foreach($rs as $m)
        {
            $job_id = $m->job_id;
            
            $type_id = $m->type_id;
            $iparr = split ("\[:vi]", $m->type_title);
            $iparr = split ("\[:ja]", $iparr[1]);
            $type_title = $iparr[0];
            
            $category_id = $m->category_id;
            $iparr = split ("\[:en]", $m->category_title);
            $iparr = split ("\[:vi]", $iparr[0]);
            $category_title = $iparr[1];
            
            $employer_id = $m->employer_id;
            $company_info = $m->company_info;
            $company_name = $m->company_name;
            $company_website = $m->company_website;
            $company_email = $m->company_email;
            $company_logo_ext = $m->company_logo_ext;
            $job_location = $m->job_location;
            $job_title = $m->job_title;
                
            $date = new DateTime($m->job_created_at);
            $job_created_at = date_format($date ,'d/m/Y H:i:s');
            
            $job_description = $m->job_description;
            $job_required = $m->job_required;
            $job_interest = $m->job_interest;
            $contact_description = $m->contact_description;
            $job_salary = $m->job_salary;
            $sym_currency = $m->sym_currency;
            $job_contact = $m->job_contact;
            $job_phone = $m->job_phone;
            $job_address = $m->job_address;
            $date1= new DateTime($m->job_expires_at);
            $job_expires_at = date_format($date1 ,'d/m/Y H:i:s');
            $stat_views = $m->stat_views;
            $geo_latitude = $m->geo_latitude;
            $geo_longitude = $m->geo_longitude;
            $job_slug = $m->job_slug;
                
            array_push($arrayJob,array("job_id" => $job_id, "type_id" => $type_id, "type_title" => $type_title, "category_id" => $category_id, "category_title" => $category_title, "employer_id" => $employer_id, "company_info" => $company_info, "company_name" => $company_name, "company_website" => $company_website, "company_email" => $company_email, "company_logo_ext" => $company_logo_ext, "job_location" => $job_location, "job_title" => $job_title, "job_created_at" => $job_created_at, "job_description" => $job_description, "job_required" => $job_required, "job_interest" => $job_interest, "contact_description" => $contact_description, "job_salary" => $job_salary, "sym_currency" => $sym_currency, "job_contact" => $job_contact, "job_phone" => $job_phone, "job_address" => $job_address, "job_expires_at" => $job_expires_at, "stat_views" => $stat_views, "geo_latitude" => $geo_latitude, "geo_longitude" => $geo_longitude, "job_slug" => $job_slug));
        }
        $response = array("arrayJob" => $arrayJob);
        echo json_encode($response);       
    }
    //update job 1
    else if($tag == 'updatejob1')
    {
        $lastTime = intval($_POST['lastTime']); // Min of job_id
    
        $str=        " SELECT job.id AS job_id,";
        $str= $str . " type.id AS type_id, type.title AS type_title, ";
        $str= $str . " category.id AS category_id, category.title AS category_title,";
        $str= $str . " employer.id AS employer_id, employer.company_info AS company_info,";
        $str= $str . " job.company_name, job.company_website, job.company_email, job.company_logo_ext,";
        $str= $str . " job.job_location, job.job_title, job.job_created_at, job.job_description,";
        $str= $str . " job.job_required, job.job_interest, job.contact_description, job.job_salary,";
        $str= $str . " job.sym_currency, job.job_contact, job.job_phone, job.job_address,";
        $str= $str . " job.job_expires_at, job.stat_views, job.geo_latitude, job.geo_longitude, job.job_slug";
        
        $str= $str . " FROM wpjb_job AS job";
        $str= $str . " LEFT JOIN wpjb_category AS category ON job.job_category = category.id";
        $str= $str . " LEFT JOIN wpjb_type AS type ON job.job_type = type.id";
        $str= $str . " LEFT JOIN wpjb_employer AS employer ON job.employer_id = employer.id";
        
        $str= $str . " WHERE job.is_active=1 AND DATEDIFF(job.job_expires_at,CURDATE()) > 0 AND job.is_filled = 0 AND job.id < $lastTime";
        $str= $str . " ORDER BY job.id DESC";
        
        $rs = $wpdb->get_results($str);
        
        foreach($rs as $m)
        {
            $job_id = $m->job_id;
            
            
            $type_id = $m->type_id;
            $iparr = split ("\[:vi]", $m->type_title);
            $iparr = split ("\[:ja]", $iparr[1]);
            $type_title = $iparr[0];
            
            
            $category_id = $m->category_id;
            $iparr = split ("\[:en]", $m->category_title);
            $iparr = split ("\[:vi]", $iparr[0]);
            $category_title = $iparr[1];
            
            
            $employer_id = $m->employer_id;
            $company_info = $m->company_info;
            $company_name = $m->company_name;
            $company_website = $m->company_website;
            $company_email = $m->company_email;
            $company_logo_ext = $m->company_logo_ext;
            $job_location = $m->job_location;
            $job_title = $m->job_title;
            
            $date = new DateTime($m->job_created_at);
            $job_created_at = date_format($date ,'d/m/Y H:i:s');
            
            
            $job_description = $m->job_description;
            $job_required = $m->job_required;
            $job_interest = $m->job_interest;
            $contact_description = $m->contact_description;
            $job_salary = $m->job_salary;
            $sym_currency = $m->sym_currency;
            $job_contact = $m->job_contact;
            $job_phone = $m->job_phone;
            $job_address = $m->job_address;
            $date1= new DateTime($m->job_expires_at);
            $job_expires_at = date_format($date1 ,'d/m/Y H:i:s');
            $stat_views = $m->stat_views;
            $geo_latitude = $m->geo_latitude;
            $geo_longitude = $m->geo_longitude;
            $job_slug = $m->job_slug;
            
            array_push($arrayJob,array("job_id" => $job_id, "type_id" => $type_id, "type_title" => $type_title, "category_id" => $category_id, "category_title" => $category_title, "employer_id" => $employer_id, "company_info" => $company_info, "company_name" => $company_name, "company_website" => $company_website, "company_email" => $company_email, "company_logo_ext" => $company_logo_ext, "job_location" => $job_location, "job_title" => $job_title, "job_created_at" => $job_created_at, "job_description" => $job_description, "job_required" => $job_required, "job_interest" => $job_interest, "contact_description" => $contact_description, "job_salary" => $job_salary, "sym_currency" => $sym_currency, "job_contact" => $job_contact, "job_phone" => $job_phone, "job_address" => $job_address, "job_expires_at" => $job_expires_at, "stat_views" => $stat_views, "geo_latitude" => $geo_latitude, "geo_longitude" => $geo_longitude, "job_slug" => $job_slug));
            
            
        }
        $response = array("arrayJob" => $arrayJob);
        echo json_encode($response);
        
    }
	 //update job 
    else if($tag == 'updatejob')
    {
        $lastTime = intval($_POST['lastTime']); // Max of job_id
    
        $str=        " SELECT job.id AS job_id,";
        $str= $str . " type.id AS type_id, type.title AS type_title, ";
        $str= $str . " category.id AS category_id, category.title AS category_title,";
        $str= $str . " employer.id AS employer_id, employer.company_info AS company_info,";
        $str= $str . " job.company_name, job.company_website, job.company_email, job.company_logo_ext,";
        $str= $str . " job.job_location, job.job_title, job.job_created_at, job.job_description,";
        $str= $str . " job.job_required, job.job_interest, job.contact_description, job.job_salary,";
        $str= $str . " job.sym_currency, job.job_contact, job.job_phone, job.job_address,";
        $str= $str . " job.job_expires_at, job.stat_views, job.geo_latitude, job.geo_longitude, job.job_slug";
        
        $str= $str . " FROM wpjb_job AS job";
        $str= $str . " LEFT JOIN wpjb_category AS category ON job.job_category = category.id";
        $str= $str . " LEFT JOIN wpjb_type AS type ON job.job_type = type.id";
        $str= $str . " LEFT JOIN wpjb_employer AS employer ON job.employer_id = employer.id";
        
        $str= $str . " WHERE job.is_active=1 AND DATEDIFF(job.job_expires_at,CURDATE()) > 0 AND job.is_filled = 0 AND job.id > $lastTime";
        $str= $str . " ORDER BY job.id DESC";
        
        $rs = $wpdb->get_results($str);
        
        foreach($rs as $m)
        {
            $job_id = $m->job_id;
            
            
            $type_id = $m->type_id;
            $iparr = split ("\[:vi]", $m->type_title);
            $iparr = split ("\[:ja]", $iparr[1]);
            $type_title = $iparr[0];
            
            
            $category_id = $m->category_id;
            $iparr = split ("\[:en]", $m->category_title);
            $iparr = split ("\[:vi]", $iparr[0]);
            $category_title = $iparr[1];
            
            
            $employer_id = $m->employer_id;
            $company_info = $m->company_info;
            $company_name = $m->company_name;
            $company_website = $m->company_website;
            $company_email = $m->company_email;
            $company_logo_ext = $m->company_logo_ext;
            $job_location = $m->job_location;
            $job_title = $m->job_title;
            
            $date = new DateTime($m->job_created_at);
            $job_created_at = date_format($date ,'d/m/Y H:i:s');
            
            
            $job_description = $m->job_description;
            $job_required = $m->job_required;
            $job_interest = $m->job_interest;
            $contact_description = $m->contact_description;
            $job_salary = $m->job_salary;
            $sym_currency = $m->sym_currency;
            $job_contact = $m->job_contact;
            $job_phone = $m->job_phone;
            $job_address = $m->job_address;
            $date1= new DateTime($m->job_expires_at);
            $job_expires_at = date_format($date1 ,'d/m/Y H:i:s');
            $stat_views = $m->stat_views;
            $geo_latitude = $m->geo_latitude;
            $geo_longitude = $m->geo_longitude;
            $job_slug = $m->job_slug;
            
            array_push($arrayJob,array("job_id" => $job_id, "type_id" => $type_id, "type_title" => $type_title, "category_id" => $category_id, "category_title" => $category_title, "employer_id" => $employer_id, "company_info" => $company_info, "company_name" => $company_name, "company_website" => $company_website, "company_email" => $company_email, "company_logo_ext" => $company_logo_ext, "job_location" => $job_location, "job_title" => $job_title, "job_created_at" => $job_created_at, "job_description" => $job_description, "job_required" => $job_required, "job_interest" => $job_interest, "contact_description" => $contact_description, "job_salary" => $job_salary, "sym_currency" => $sym_currency, "job_contact" => $job_contact, "job_phone" => $job_phone, "job_address" => $job_address, "job_expires_at" => $job_expires_at, "stat_views" => $stat_views, "geo_latitude" => $geo_latitude, "geo_longitude" => $geo_longitude, "job_slug" => $job_slug));
            
            
        }
        $response = array("arrayJob" => $arrayJob);
        echo json_encode($response);
        
    }
    //top jobs
    else if($tag == 'topjob')
    {
        $str=        " SELECT job.id AS job_id,";
        $str= $str . " type.id AS type_id, type.title AS type_title, ";
        $str= $str . " category.id AS category_id, category.title AS category_title,";
        $str= $str . " employer.id AS employer_id, employer.company_info AS company_info,";
        $str= $str . " job.company_name, job.company_website, job.company_email, job.company_logo_ext,";
        $str= $str . " job.job_location, job.job_title, job.job_created_at, job.job_description,";
        $str= $str . " job.job_required, job.job_interest, job.contact_description, job.job_salary,";
        $str= $str . " job.sym_currency, job.job_contact, job.job_phone, job.job_address,";
        $str= $str . " job.job_expires_at, job.stat_views, job.geo_latitude, job.geo_longitude, job.job_slug";
        	
        $str= $str . " FROM wpjb_job AS job";
        $str= $str . " LEFT JOIN wpjb_category AS category ON job.job_category = category.id";
        $str= $str . " LEFT JOIN wpjb_type AS type ON job.job_type = type.id";
        $str= $str . " LEFT JOIN wpjb_employer AS employer ON job.employer_id = employer.id";
        
        $str= $str . " WHERE job.is_active=1 AND DATEDIFF(job.job_expires_at,CURDATE()) >= 0";
        $str= $str . " ORDER BY job.stat_views ,job.id DESC";
        $str= $str . " LIMIT 0,100";
        
        $rs = $wpdb->get_results($str);
        	
        	
        	
        foreach($rs as $m)
        {
            $job_id = $m->job_id;
        
        
            $type_id = $m->type_id;
            $iparr = split ("\[:vi]", $m->type_title);
            $iparr = split ("\[:ja]", $iparr[1]);
            $type_title = $iparr[0];
        
        
            $category_id = $m->category_id;
            $iparr = split ("\[:en]", $m->category_title);
            $iparr = split ("\[:vi]", $iparr[0]);
            $category_title = $iparr[1];
        
        
            $employer_id = $m->employer_id;
            $company_info = $m->company_info;
            $company_name = $m->company_name;
            $company_website = $m->company_website;
            $company_email = $m->company_email;
            $company_logo_ext = $m->company_logo_ext;
            $job_location = $m->job_location;
            $job_title = $m->job_title;
        
            $date = new DateTime($m->job_created_at);
            $job_created_at = date_format($date ,'d/m/Y H:s:i');
        
        
            $job_description = $m->job_description;
            $job_required = $m->job_required;
            $job_interest = $m->job_interest;
            $contact_description = $m->contact_description;
            $job_salary = $m->job_salary;
            $sym_currency = $m->sym_currency;
            $job_contact = $m->job_contact;
            $job_phone = $m->job_phone;
            $job_address = $m->job_address;
            $date1= new DateTime($m->job_expires_at);
            $job_expires_at = date_format($date1 ,'d/m/Y H:i:s');
            $stat_views = $m->stat_views;
            $geo_latitude = $m->geo_latitude;
            $geo_longitude = $m->geo_longitude;
            $job_slug = $m->job_slug;
        
            array_push($arrayJob,array("job_id" => $job_id, "type_id" => $type_id, "type_title" => $type_title, "category_id" => $category_id, "category_title" => $category_title, "employer_id" => $employer_id, "company_info" => $company_info, "company_name" => $company_name, "company_website" => $company_website, "company_email" => $company_email, "company_logo_ext" => $company_logo_ext, "job_location" => $job_location, "job_title" => $job_title, "job_created_at" => $job_created_at, "job_description" => $job_description, "job_required" => $job_required, "job_interest" => $job_interest, "contact_description" => $contact_description, "job_salary" => $job_salary, "sym_currency" => $sym_currency, "job_contact" => $job_contact, "job_phone" => $job_phone, "job_address" => $job_address, "job_expires_at" => $job_expires_at, "stat_views" => $stat_views, "geo_latitude" => $geo_latitude, "geo_longitude" => $geo_longitude, "job_slug" => $job_slug));
        	
        		 
        }
        $response = array("arrayJob" => $arrayJob);
        echo json_encode($response);
    }
    //subcribe
    else if($tag == 'subcribe')
    {
        $keyword = $_POST['keyword'];
        $email = $_POST['email'];
        $is_active = 0;
        $created_at = date("Y-m-d H:i:s");
        
        $subcribedata = array( 'keyword' => $keyword, 'email' => $email, 'is_active' => $is_active, 'created_at' => $created_at );
        
        $insert = $wpdb -> insert ('wpjb_alert', $subcribedata);
        if(is_wp_error($insert))
        {
            $response["status"] = 'error';
            $response["msg"] = $insert->get_error_message();
        }
        else
        {
            $response["status"] = 'success';
            $response["msg"] = 'Create successful';
        }
        echo json_encode($response);
        
    }
     // 
    else if ($tag == 'register')
    {
		$user_name = $_POST['user_name'];
        $user_login = $_POST['user_login'];
        $user_password = $_POST['user_password'];
        $birthday = $_POST['birthday'];
        $user_email = $_POST['user_email'];
        $user_gender = $_POST['user_gender'];
        if($_POST['user_gender'] == 'male')
            $user_gender = '1';
        else if ($_POST['user_gender'] == 'female')
            $user_gender = '0';
        $user_url = $_POST['user_url'];
        $display_name = $_POST['display_name'];
        $user_firstname = $_POST['first_name'];
        $user_lastname = $_POST['last_name'];
        $fbconnect_netid = $_POST['fbconnect_netid'];
        
        if(($fbconnect_netid == 'career_facebook') && email_exists($user_email))
        {
			$user_id_isfill = $wpdb->get_var("SELECT ID FROM wp_users WHERE `user_login` = '$user_login' OR `user_login` = '$user_name'");
			$rows = $wpdb->get_results("SELECT title,headline,experience,education FROM wpjb_resume WHERE `user_id` =$user_id_isfill");
			foreach ($rows as $row){
				if ($row->title==""||$row->headline==""||$row->experience==""||$row->education=="") $response["isfill"] = 0;
				else $response["isfill"] = 1;
			}
            $response["success"] = 2;
            $response["user_id"] = $wpdb->get_var("SELECT ID FROM wp_users WHERE `user_login` = '$user_login' OR `user_login` = '$user_name'");
            $response["msg"] = 'Login facebook successful';
            echo json_encode($response);
        }
        else if(!validate_username($user_login))
        {
            $response["error"] = 2;
            $response["error_msg"] = "Invalidate username";
            echo json_encode($response);
        }
        else if(!is_email($user_email))
        {
            $response["error"] = 3;
            $response["error_msg"] = "Invalidate email";
            echo json_encode($response);
        }
        else
        {
            if($fbconnect_netid == 'career_facebook')
            {
                
                $user_password = wp_generate_password();
                $response["passgen"] = $user_password;
            }
            $userdata = array(
                                'user_login' => $user_login,
                                'user_pass' => $user_password,
                                'user_email' => $user_email,
                                'user_url' => $user_url,
                                'display_name' => $display_name,
                                );
            
            $user = wp_insert_user($userdata);
            if(is_wp_error($user))
            {	
			$user_id_isfill = $wpdb->get_var("SELECT ID FROM wp_users WHERE user_login = '$user_login' OR `user_login` = '$user_name'");
			$rows = $wpdb->get_results("SELECT title,headline,experience,education FROM wpjb_resume WHERE user_id =$user_id_isfill");
			foreach ($rows as $row){
				if ($row->title==""||$row->headline==""||$row->experience==""||$row->education=="") $response["isfill"] = 0;
				else $response["isfill"] = 1;
			}
                $response["error"] = 4;
                $response["user_id"] = $wpdb->get_var("SELECT ID FROM wp_users WHERE user_login = '$user_login' OR `user_login` = '$user_name'");
                $response["error_msg"] = $user->get_error_message();
                echo json_encode($response);
            }
            else
            {
                $wpjb_resume = array(
                                        'user_id' => $user,
                                        'email' => $user_email,
                                        'firstname' => $user_firstname,
                                        'lastname' => $user_lastname,
                                        'created_at' => date("Y-m-d H:i:s"),
                                        'updated_at' => date("Y-m-d H:i:s"),
                                        'namsinh' => $birthday,
                                        'gender' => $user_gender
                                        );
                $wpdb->insert('wpjb_resume', $wpjb_resume);				
                add_user_meta($user, '__via', $fbconnect_netid);
	
                $response["success"] = 3;
                $response["msg"] = 'Create user successful';
                $response["user"] = $user_login;
                $response["password"] = $user_password;
                $response["netid"] = $fbconnect_netid;
                $response["user_id"] = $user;	
				$response["isfill"] = 0;	
                echo json_encode($response);
            }
        }
        
    }
    elseif ($tag == 'update')
    {
        
        $user_email = $_POST['user_email'];
        $user_pass = $_POST['user_pass'];
    
        $new_birthday = $_POST['new_birthday'];
        $new_password = $_POST['new_password'];
        $new_email = $_POST['new_email'];
        $new_lastname = $_POST['new_lastname'];
        $new_firstname = $_POST['new_firstname'];
    
        $find_user = get_user_by('email', $user_email);
    
        $creds = array();
        $creds['user_login'] = $find_user->user_login;
        $creds['user_password'] = $_POST['user_pass'];
        $creds['remember'] = false;
    
        $user = wp_signon($creds, false);
        if(is_wp_error($user))
        {
            $response["error"] = 5;
            $response["error_msg"] = $user->get_error_message();
            echo json_encode($response);
        }
        else if(	$new_email && !is_email($user_email))
        {
            $response["error"] = 6;
            $response["msg"] = 'Invalide email';
            echo json_encode($response);
        }
        else
        {
            $userdata = array( 'ID' => $user->ID);
            $wpjb_resume = array();
        
            if($new_email)
            {
                $userdata['user_email'] = $new_email;
                $wpjb_resume['email'] = $new_email;
                $response["newemail"] = $new_email;
            }
            if($new_password)
            {
                $userdata['user_pass'] = $new_password;
                $response["newpass"] = $new_password;
            }
            wp_update_user($userdata);
        
            if($new_birthday)
            {
                $wpjb_resume['namsinh'] = $new_birthday;
                $response["newbirth"] = $new_birthday;
            }
            if($new_lastname)
            {
                $wpjb_resume['lastname'] = $new_lastname;
                $response["new_lastname"] = $new_lastname;
            }
            if($new_firstname)
            {
                $wpjb_resume['firstname'] = $new_firstname;
                $response["new_firstname"] = $new_firstname;
            }
            if($_POST['new_gender'])
            {
                $new_gender = $_POST['new_gender'];
                if( $_POST['new_gender'] && $_POST['new_gender'] == 'male')
                    $new_gender = '1';
                else if ($_POST['new_gender'] && $_POST['new_gender'] == 'female')
                    $new_gender = '0';
                $wpjb_resume['gender'] = $new_gender;
                $response["newgender"] = $new_gender;
            }
            $wpdb->update('wpjb_resume', $wpjb_resume, array('user_id' => $user->ID));
            $response["success"] = 4;
            echo json_encode($response);
        }
    }
     else if($tag == 'login')
    {
        $response = array("tag" => $tag, "success" => 0, "error" => 0);
    
        $creds = array();
        $creds['user_login'] = $_POST['user_login'];
        $creds['user_password'] = $_POST['user_password'];
        $creds['remember'] = false;
    
        $user = wp_signon($creds, false);
        if(is_wp_error($user))
        {
            $response["error"] = 1;
            $response["error_msg"] = $user->get_error_message();
            echo json_encode($response);
        }
        else
        {	
			$user_login = $_POST['user_login'];
			$user_id_isfill = $wpdb->get_var("SELECT ID FROM wp_users WHERE user_login = '$user_login'");
			$rows = $wpdb->get_results("SELECT title,headline,experience,education FROM wpjb_resume WHERE user_id =$user_id_isfill");
			foreach ($rows as $row){
				if ($row->title==""||$row->headline==""||$row->experience==""||$row->education=="") $response["isfill"] = 0;
				else $response["isfill"] = 1;
			}
            $response["success"] = 1;
            $response["msg"] = 'Login successful';
            $response["ID"] = $user->ID;
            $response["username"] = $user->user_login;
            $response["email"] = $user->user_email;
            $response["user_url"] = $user->user_url;
            $response["name"] = $user->display_name;
            $response["gender"] = $wpdb->get_var("SELECT gender FROM wpjb_resume WHERE user_id = {$user->ID}") == '1' ? 'male' : 'female';
            $response["birthday"] = $wpdb->get_var("SELECT namsinh FROM wpjb_resume WHERE user_id = {$user->ID}");
            $response["firstname"] = $wpdb->get_var("SELECT firstname FROM wpjb_resume WHERE user_id = {$user->ID}");
            $response["lastname"] = $wpdb->get_var("SELECT lastname FROM wpjb_resume WHERE user_id = {$user->ID}");
            
            echo json_encode($response);
        }
    }
	//update time stat view
	else if($tag=="updatestatview")
	{
		$j_id = intval($_POST['j_id']);
		$js_id = intval ($_POST['js_id']);
		$wpdb->query("INSERT IGNORE INTO `wpjb_viewed` ( `JS_ID` , `J_ID`) VALUES ($js_id, $j_id)");
	}
	//update time stat view in job
	else if ($tag == "updatestatviewjob")
    {
        $j_id = intval($_POST['j_id']);
        $wpdb->query("UPDATE wpjb_job  SET stat_views = stat_views + 1  WHERE id = $j_id");
    }
	//get resume
	else if($tag=="getresume")
	{
		$js_id = intval($_POST['js_id']);
    
        $str= "SELECT firstname,lastname,namsinh,gender,country,city,address,email,phone,website,image_ext,salary,sym_currency,
			title,category_id,headline,years_experience,experience,degree,education,id FROM wpjb_resume WHERE user_id = $js_id";     
        $rs = $wpdb->get_results($str);    
        foreach($rs as $r)
        {
           $firstname = $r->firstname;
		   $lastname = $r->lastname;
		   $namsinh = $r->namsinh;
		   $gender = $r->gender;
		   $country = $r->country;
		   $city = $r->city;
		   $address = $r->address;
		   $email = $r->email;
		   $phone = $r->phone;
		   $website = $r->website;
		   $image_ext = $r->image_ext;
		   $salary = $r->salary;
		   $sym_currency = $r->sym_currency;
		   $title = $r->title;
		   $category_id = $r->category_id;
		   $headline = $r->headline;
		   $years_experience = $r->years_experience;
		   $experience = $r->experience;
		   $degree = $r->degree;
		   $education = $r->education;
		   $id = $r->id;
		   
            
            array_push($arrayResume,array("firstname" => $firstname, "lastname" => $lastname, "namsinh" => $namsinh, "gender" => $gender, "country" => $country, "city" => $city, "address" => $address, "email" => $email, "phone" => $phone, "website" => $website, "image_ext" => $image_ext, "salary" => $salary, "sym_currency" => $sym_currency, "title" => $title, "category_id" => $category_id, "headline" => $headline, "years_experience" => $years_experience, "experience" => $experience, "degree" => $degree, "education" => $education,"id"=>$id));
            
            
        }
        $response = array("arrayResumes" => $arrayResume);
        echo json_encode($response);
	}
	//get resume
	else if($tag=="updateresume")
	{
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$namsinh = $_POST['namsinh'];
		$gender = $_POST['gender'];
		$country = intval($_POST['country']);
		$city = intval($_POST['city']);
		$address = $_POST['address'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$website = $_POST['website'];
		$image_ext = $_POST['image_ext'];
		$salary = $_POST['salary'];
		$sym_currency = $_POST['sym_currency'];
		$title = $_POST['title'];
		$category_id = intval($_POST['category_id']);
		$headline = $_POST['headline'];
		$years_experience = intval($_POST['years_experience']);
		$experience = $_POST['experience'];
		$degree = intval($_POST['degree']);
		$education = $_POST['education'];
		$js_id = intval($_POST['js_id']);
		$id = intval($_POST['id']);
		
		$image = $_POST['img'];//encode
		if($image!="")
		{
			define('UPLOAD_DIR', '../../wp-content/plugins/wpjobboard/environment/resumes/');
					$image = str_replace('data:image/png;base64,', '', $image);
					$image = str_replace(' ', '+', $image);
					$data = base64_decode($image);
					$file = UPLOAD_DIR . 'photo_' .$id. '.jpg';	
					$success = file_put_contents($file, $data);
					echo $success ? $file : 'Unable to save the file.';
		}
		$wpdb->query("UPDATE wpjb_resume SET `firstname` = '$firstname',`lastname` = '$lastname',
		`namsinh` = '$namsinh',`gender` = $gender,`country` = $country,`city` = $city,
		`address` = '$address',`email` = '$email',`phone` = '$phone',`website` = '$website',
		`image_ext` = '$image_ext',`salary` = '$salary',`sym_currency` = '$sym_currency',
		`title` = '$title',`category_id` = $category_id,`headline` = '$headline',
		`years_experience` = $years_experience,`experience` = '$experience',
		`degree` = $degree,`education` = '$education' WHERE user_id = $js_id");
	}
    else
    {
        echo "Invalid Request";
    }
}
else
	echo "Access denied";
?>