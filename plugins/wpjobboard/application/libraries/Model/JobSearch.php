<?php
/**
 * Description of JobSearch
 *
 * @author greg
 * @package 
 */

class Wpjb_Model_JobSearch extends Daq_Db_OrmAbstract
{
    protected $_name = "wpjb_job_search";
    
    protected function _init()
    {

    }

    public static function createFrom(Wpjb_Model_Job $job)
    {
        $query = new Daq_Db_Query();
        $object = $query->select()
            ->from(__CLASS__." t")
            ->where("job_id = ?", $job->getId())
            ->limit(1)
            ->execute();

        if(empty($object)) {
            $object = new self;
        } else {
            $object = $object[0];
        }

        $country = Wpjb_List_Country::getByCode($job->job_country);
		//$city = Wpjb_List_City::getByCode($job->job_location);
        $city = $job->job_location;
        
       /*$location = array(
            $country['iso2'],
            $country['iso3'],
            $country['name'],
            $job->job_state,
            $city['iso2'],
            $city['iso3'],
            $city['name'],
            $job->job_zip_code
        );*/
        
        $location = $job->job_location;        
        
        $object->job_id = $job->getId();
        $object->title = strip_tags($job->job_title);
        $object->description = strip_tags($job->job_description).strip_tags($job->job_required).strip_tags($job->job_interest);
        $object->company = $job->company_name;
        //$object->location = join(" ", $location);
        $object->location = $location;
        $object->save();
    }
    
    public static function search($params)
    {
        $category = null;
        $type = null;
        $posted = null;
        $query = null;
        $field = array();
        $location = null;
        $page = null;
        $count = null;
        $order = null;
        $sort = null;
        
        extract($params);
        $select = Wpjb_Model_Job::activeSelect();
        
        if(isset($is_featured)) {
            $select->where("t1.is_featured = 1");
        }
        
        if(isset($employer_id)) {
            $select->where("t1.employer_id IN(?)", $employer_id);
        }
        
        if(isset($country)) {
            $select->where("t1.job_country = ?", $country);
        }
		
		if(isset($city)) {
            $select->where("t1.job_location = ?", $city);
        }            
        
        if(is_array($category)) {
        	$category = array_map("intval", $category);
        	$select->join("t1.category t2", "t2.id IN (".join(",",$category).")");
        } elseif(!empty($category)) {
        	$select->join("t1.category t2", "t2.id = ".(int)$category);
        } else {
        	$select->join("t1.category t2");
        }

        if(is_array($type)) {
            $type = array_map("intval", $type);
            $select->join("t1.type t3", "t3.id IN (".join(",",$type).")");
        } elseif(!empty($type)) {
            $select->join("t1.type t3", "t3.id=".(int)$type);
        } else {
            $select->join("t1.type t3");
        }

        $days = $posted;
        if($days == 1) {
            $time = date("Y-m-d");
            $select->where("DATE(job_created_at) = ?", date("Y-m-d"));
        } elseif($days == 2) {
            $time = date("Y-m-d", strtotime("yesterday"));
            $select->where("DATE(job_created_at) = ?", date("Y-m-d", strtotime("now -1 day")));
        } elseif(is_numeric($days)) {
            $select->where("job_created_at >= DATE_SUB(NOW(), INTERVAL ? DAY)", (int)$days);
        }       
        
        if(is_array($field)) {
            foreach($field as $k => $v) {
                $k = intval($k);
                $v = trim($v);
                if($k<1 || empty($v)) {
                    continue;
                }
                $custom = new Wpjb_Model_AdditionalField($k);
                if($custom->field_for != 1) {
                    continue;
                }
                
                $q = new Daq_Db_Query();
                $q->select("COUNT(*) AS c");
                $q->from("Wpjb_Model_FieldValue tf$k");
                $q->where("tf$k.job_id=t1.id");
                if($custom->type == 3 || $custom->type == 4) {
                    $q->where("tf$k.value = ?", $v);
                } else {
                    $q->where("tf$k.value LIKE ?", "%$v%");
                }
                $select->where("($q)>0");
            }
        }
        
        $searchString = $search = $query;
        $q = "MATCH(t4.title, t4.description, t4.location, t4.company)";
        $q.= "AGAINST (? IN BOOLEAN MODE)";

        $select->select("COUNT(*) AS `cnt`");
        $itemsFound = 0;
        
        if($searchString && strlen($searchString)<=3) {
            $select->join("t1.search t4");
            $select->where("(t4.title LIKE ?", '%'.$searchString.'%');
            $select->orWhere("t4.description LIKE ?)", '%'.$searchString.'%');
            $itemsFound = $select->fetchColumn();
            $search = false;

        } elseif($searchString) {

            foreach(array(1, 2, 3) as $t) {
                
                $test = clone $select;
                $test->join("t1.search t4");
                if($t == 1) {
                    $test->where(str_replace("?", '\'"'.mysql_real_escape_string($search).'"\'', $q));
                } elseif($t == 2) {
                    $test->where($q, "+".  str_replace(" ", " +", $search));
                } else {
                    $test->where($q, $search);
                }

                $itemsFound = $test->fetchColumn();
                if($itemsFound>0) {
                    break;
                }

            }
            
        } else {
            $itemsFound = $select->fetchColumn();
        }                

        if($search) {
            $select->join("t1.search t4");
            if($t == 1) {
                $select->where(str_replace("?", '\'"'.mysql_real_escape_string($search).'"\'', $q));
            } elseif($t == 2) {
                $select->where($q, "+".  str_replace(" ", " +", $search));
            } else {
                $select->where($q, $search);
            }
        }

        if($searchString && $location) {
        							if($location=='TP Hồ Chí Minh'){
                                        $select->where("t4.location LIKE '%TP Hồ Chí Minh%'                                                    
                                                    or t4.location LIKE '%TP.HCM%'
													or t4.location LIKE '%TP. HCM%'");
                                    }

                                    else if($location=='TP Hà Nội'){
                                        $select->where("t4.location LIKE '%TP Hà Nội%'
                                                    or t4.location LIKE '%Hà Nội%'");
                                    }

                                    else if($location=='TP Đà Nẵng'){
                                        $select->where("t4.location LIKE '%TP Đà Nẵng%'
                                                    or t4.location LIKE '%Đà Nẵng%'");
                                    }
                                    
                                    else if($location=='Bà Rịa Vũng Tàu'){
                                    	$select->where("t4.location LIKE '%Bà Rịa Vũng Tàu%'
                                                    or t4.location LIKE '%Bà Rịa - Vũng Tàu%'");
                                    }                                    
                                    else {
                                    $select->where("t4.location LIKE ?", "%$location%");
                                    }
                                    //$itemsFound = $select->fetchColumn();
        	} elseif($location) {
        		
                                    if($location=='TP Hồ Chí Minh'){
                                        $select->join("t1.search t4");
                                        $select->where("t4.location LIKE '%TP Hồ Chí Minh%'                                                    
                                                    or t4.location LIKE '%TP.HCM%'
													or t4.location LIKE '%TP. HCM%'");
                                    }

                                    else if($location=='TP Hà Nội'){
                                        $select->join("t1.search t4");
                                        $select->where("t4.location LIKE '%TP Hà Nội%'
                                                    or t4.location LIKE '%Hà Nội%'");
                                    }

                                    else if($location=='TP Đà Nẵng'){
                                        $select->join("t1.search t4");
                                        $select->where("t4.location LIKE '%TP Đà Nẵng%'
                                                    or t4.location LIKE '%Đà Nẵng%'");
                                    }
                                    else if($location=='Bà Rịa Vũng Tàu'){
                                    	$select->join("t1.search t4");
                                    	$select->where("t4.location LIKE '%Bà Rịa Vũng Tàu%'
                                                    or t4.location LIKE '%Bà Rịa - Vũng Tàu%'");
                                    }
                                    else if($location=='Tây Bắc'){
                                    	$select->join("t1.search t4");
                                    	$select->where("t4.location LIKE '%Lai Châu - Điện Biên%'
                                                    or t4.location LIKE '%Lào Cai%'
                                    				or t4.location LIKE '%Lai Châu%'
                                    				or t4.location LIKE '%Điện Biên%'
	                                    			or t4.location LIKE '%Sơn La%'
	                                    			or t4.location LIKE '%Yên Bái%'");
                                    }
                                    else if($location=='Đông Bắc'){
                                    	$select->join("t1.search t4");
                                    	$select->where("t4.location LIKE '%Bắc Kạn%'
                                                    or t4.location LIKE '%Bắc Giang%'
                                    				or t4.location LIKE '%Cao Bằng%'
                                    				or t4.location LIKE '%Hà Giang%'
	                                    			or t4.location LIKE '%Lạng Sơn%'
	                                    			or t4.location LIKE '%Thái Nguyên%'
                                    				or t4.location LIKE '%Tuyên Quang%'");
                                    }
                                    else if($location=='Duyên hải Bắc bộ'){
                                    	$select->join("t1.search t4");
                                    	$select->where("t4.location LIKE '%Hải Phòng%'
                                                    or t4.location LIKE '%Nam Định%'
                                    				or t4.location LIKE '%Quảng Ninh%'
                                    				or t4.location LIKE '%Thái Bình%'");
                                    }
                                    else if($location=='Bắc bộ'){
                                    	$select->join("t1.search t4");
                                    	$select->where("t4.location LIKE '%Bắc Ninh%'
                                                    or t4.location LIKE '%Phú Thọ%'
                                    				or t4.location LIKE '%Hà Nam%'
                                    				or t4.location LIKE '%Hải Dương%'
	                                    			or t4.location LIKE '%Hòa Bình%'
	                                    			or t4.location LIKE '%Hưng Yên%'
                                    				or t4.location LIKE '%Ninh Bình%'
                                    				or t4.location LIKE '%Vĩnh Phúc%'
                                    				or t4.location LIKE '%TP Hà Nội%'
                                                    or t4.location LIKE '%Hà Nội%'");
                                    }
                                    else if($location=='Bắc Trung bộ'){
                                    	$select->join("t1.search t4");
                                    	$select->where("t4.location LIKE '%Hà Tĩnh%'
                                                    or t4.location LIKE '%Nghệ An%'
                                    				or t4.location LIKE '%Thanh Hóa%'
                                    				or t4.location LIKE '%Quảng Bình%'
	                                    			or t4.location LIKE '%Quảng Trị%'
	                                    			or t4.location LIKE '%Thừa Thiên Huế%'
                                    				or t4.location LIKE '%Thừa Thiên-Huế%'");
                                    }
                                    else if($location=='Nam Trung bộ'){
                                    	$select->join("t1.search t4");
                                    	$select->where("t4.location LIKE '%Đà Nẵng%'
	                                    			or t4.location LIKE '%Quảng Nam%'
	                                    			or t4.location LIKE '%TP Đà Nẵng%'
                                    				or t4.location LIKE '%Bình Thuận%'
                                    				or t4.location LIKE '%Bình Định%'
                                    				or t4.location LIKE '%Khánh Hòa%'
                                                    or t4.location LIKE '%Ninh Thuận%'
	                                    			or t4.location LIKE '%Phú Yên%'
	                                    			or t4.location LIKE '%Quảng Ngãi%'");
                                    }
                                    else if($location=='Tây nguyên'){
                                    	$select->join("t1.search t4");
                                    	$select->where("t4.location LIKE '%Đắk Lắk%'
                                                    or t4.location LIKE '%Đắk Nông%'
                                    				or t4.location LIKE '%Đắc Nông%'
                                    				or t4.location LIKE '%Gia Lai%'
                                    				or t4.location LIKE '%Kon Tum%'
                                    				or t4.location LIKE '%Lâm Đồng%'
                                    				or t4.location LIKE '%Đắc Lắc%'");
                                    }
                                    else if($location=='Đông Nam bộ'){
                                    	$select->join("t1.search t4");
                                    	$select->where("t4.location LIKE '%Bình Dương%'
                                                    or t4.location LIKE '%Bình Phước%'
                                    				or t4.location LIKE '%Đồng Nai%'
                                    				or t4.location LIKE '%Tây Ninh%'
                                    				or t4.location LIKE '%Vũng Tàu%'
                                    				or t4.location LIKE '%TP Hồ Chí Minh%'
                                                    or t4.location LIKE '%TP.HCM%'
													or t4.location LIKE '%TP. HCM%'");
                                    }
                                    else if($location=='Miền Tây'){
                                    	$select->join("t1.search t4");
                                    	$select->where("t4.location LIKE '%An Giang%'
                                                    or t4.location LIKE '%Bạc Liêu%'
                                    				or t4.location LIKE '%Bến Tre%'
                                    				or t4.location LIKE '%Cần Thơ%'
                                    				or t4.location LIKE '%Cà Mau%'
                                    				or t4.location LIKE '%Đồng Tháp%'
                                                    or t4.location LIKE '%Hậu Giang%'
													or t4.location LIKE '%Kiên Giang%'
                                    				or t4.location LIKE '%Long An%'
                                    				or t4.location LIKE '%Sóc Trăng%'
                                    				or t4.location LIKE '%Tiền Giang%'
                                                    or t4.location LIKE '%Trà Vinh%'
													or t4.location LIKE '%Vĩnh Long%'");
                                    }
                                    else {
                                    $select->join("t1.search t4");
                                    $select->where("t4.location LIKE ?", "%$location%");
                                    }
                                    $select->where("t1.is_active = 1");
            						$select->where("t1.job_expires_at >= ?", date("Y-m-d 23:59:59"));
            						if(Wpjb_Project::getInstance()->conf("front_hide_filled")) {
            							$select->where("is_filled = 0");
            						}
                                    $itemsFound = $select->fetchColumn();
            }
            
        $select->select("*");
        if($page && $count) {
            $select->limitPage($page, $count);
        }
        
        $ord = array("id", "job_created_at", "job_title");
        
        if(!in_array($order, $ord)) {
            $order = null;
        }
        if($sort != "desc") {
            $sort = "asc";
        } 
        if($order) {
            $select->order("t1.is_featured DESC, t1.$order $sort");
        }
        
        $jobList = $select->execute();
        
        $response = new stdClass;
        $response->job = $jobList;
        $response->page = $page;
        $response->perPage = $count;
        $response->count = count($jobList);
        $response->total = $itemsFound;
        
        $link = wpjb_link_to("feed_custom");
        $link2 = wpjb_link_to("search");
        $p2 = $params;
        unset($p2["page"]);
        unset($p2["count"]);
        $q2 = http_build_query($p2);
        $glue = "?";
        if(stripos($link, "?")) {
            $glue = "&";
        }
        $response->url = new stdClass;
        $response->url->feed = $link.$glue.$q2;
        $response->url->search = $link2.$glue.$q2;
        
        return $response;
    }
}

?>