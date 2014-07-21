<?php
/**
 * Description of Plain
 *
 * @author greg
 * @package 
 */

class Wpjb_Module_Frontend_Plain extends Wpjb_Controller_Frontend
{
    /**
     * Sends notifications
     *
     * Sends DAILY notifications to employers. Notifications are sent five
     * days before listing expiration.
     *
     * @return null
     */
    public function cronAction()
    {
        if(Wpjb_Project::getInstance()->conf("cron_lock", "1970-01-01") == date("Y-m-d")) {
            exit;
        }

        $ts  = "DATE_ADD(NOW(), INTERVAL 6 DAY)";
        $te  = "DATE_ADD(NOW(), INTERVAL 7 DAY)";

        $query = new Daq_Db_Query();
        $result = $query->select()
            ->from("Wpjb_Model_Job t")
            ->where("DATE_ADD(job_created_at, INTERVAL job_visible DAY) >= $ts")
            ->where("DATE_ADD(job_created_at, INTERVAL job_visible DAY) <  $ts")
            ->execute();

        foreach($result as $job) {
            Wpjb_Utility_Messanger::send(5, $job);
        }

        $instance = Wpjb_Project::getInstance();
        $instance->setConfigParam("cron_lock", date("Y-m-d"));
        $instance->saveConfig();

        exit;
    }

    protected function _notifyJob($id)
    {
        $job = new Wpjb_Model_Job($id);
        $mod = Wpjb_Project::getInstance()->conf("posting_moderation");
        if(!$mod) {
            $job->is_active = 1;
            $job->is_approved = 1;
            Wpjb_Utility_Messanger::send(2, $job);
        }

        $job->payment_paid = $this->getRequest()->post("mc_gross");
        $job->save();
    }

    protected function _notifyResume($id)
    {
        $object = new Wpjb_Model_ResumesAccess($id);
        $emp = new Wpjb_Model_Employer($object->employer_id);
        $emp->addAccess($object->extend);
        $emp->save();
    }

    public function notifyAction()
    {
        $payment = $this->getObject();

        $payment->made_at = date("Y-m-d H:i:s");
        $paypal = new Wpjb_Payment_PayPal($payment);
        try {
            $paypal->processTransaction($this->getRequest()->getAll());

            if($payment->object_type == Wpjb_Model_Payment::FOR_JOB) {
                $this->_notifyJob($payment->object_id);
            } elseif($payment->object_type == Wpjb_Model_Payment::FOR_RESUMES) {
                $this->_notifyResume($payment->object_id);
            } else {
                // wtf?
            }

            $payment->payment_paid = $this->getRequest()->post("mc_gross");
            $payment->external_id = $this->getRequest()->post("txn_id");
            $payment->is_valid = 1;
            $payment->save();

        } catch(Exception $e) {
            $payment->message = $e->getMessage();
            $payment->is_valid = 0;
            $payment->save();
        }

        exit;
        return false;
    }

    private function _open($tag, array $param = null)
    {
        $list = "";
        if(is_array($param)) {
            $list = array();
            foreach($param as $k => $v) {
                $list[] = $k."=\"".daq_escape($v)."\"";
            }
            $list = " ".join(" ", $list);
        }
        echo "<".$tag.$list.">";
    }

    private function _close($tag)
    {
        echo "</".$tag.">";
    }


    private function _xmlEntities($text, $charset = 'UTF-8'){
         // Debug and Test
        // $text = "test &amp; &trade; &amp;trade; abc &reg; &amp;reg; &#45;";

        // First we encode html characters that are also invalid in xml
        $text = htmlentities($text, ENT_COMPAT, $charset, false);

        // XML character entity array from Wiki
        // Note: &apos; is useless in UTF-8 or in UTF-16
        $arr_xml_special_char = array("&quot;","&amp;","&apos;","&lt;","&gt;");

        // Building the regex string to exclude all strings with xml special char
        $arr_xml_special_char_regex = "(?";
        foreach($arr_xml_special_char as $key => $value){
            $arr_xml_special_char_regex .= "(?!$value)";
        }
        $arr_xml_special_char_regex .= ")";

        // Scan the array for &something_not_xml; syntax
        $pattern = "/$arr_xml_special_char_regex&([a-zA-Z0-9]+;)/";

        // Replace the &something_not_xml; with &amp;something_not_xml;
        $replacement = '&amp;${1}';
        return preg_replace($pattern, $replacement, $text);
    }
    
    private function _tagIf($tag, $content, array $param = null)
    {
        if(strlen($content)>0) {
            $this->_tag($tag, $content, $param);
        }
    }

    private function _tag($tag, $content, array $param = null)
    {
        $this->_open($tag, $param);
        echo $this->_xmlEntities($content);
        $this->_close($tag);
    }

    private function _tagCIf($tag, $content, array $param = null)
    {
        if(!empty($content)) {
            $this->_tagC($tag, $content, $param);
        }
    }

    private function _tagC($tag, $content, array $param = null)
    {
        $this->_open($tag, $param);
        echo "<![CDATA[".$content."]]>";
        $this->_close($tag);
    }
    
    public function apiAction()
    {
        if(!$this->hasParam("engine")) {
            return false;
        }
        
        $engine = $this->getRequest()->getParam("engine");

        switch($engine) {
            case "indeed": $this->_indeed(); break;
            case "simply-hired": $this->_simplyHired(); break;
            case "google-base": $this->_googleBase(); break;
            case "juju": $this->_juju(); break;
        }

        exit;
        return false;
    }

    private function _jobs()
    {
        return Wpjb_Model_Job::activeSelect();
    }

    private function _indeed()
    {
        header("Content-type: application/xml");
        echo '<?xml version="1.0" encoding="UTF-8" ?>';
        $url = Wpjb_Project::getInstance()->getUrl();
        $this->_open("source");
        $this->_tag("publisher", Wpjb_Project::getInstance()->conf("seo_job_board_title"));
        $this->_tag("publisherurl", $url);
        $this->_tag("lastBuildDate", date(DATE_RSS));

        $jobs = $this->_jobs();
        $jobs->join("t1.category t2")->join("t1.type t3")->where("job_source <> 3");

        foreach($jobs->execute() as $job) {
            $ct = Wpjb_List_Country::getByCode($job->job_country);

            $this->_open("job");
            $this->_tagC("title", $job->job_title);
            $this->_tagC("date", $job->job_created_at);
            $this->_tagC("referencenumber", $job->id);
            $this->_tagC("url", $url."/".Wpjb_Project::getInstance()->router()->linkTo("job", $job));
            $this->_tagC("company", $job->company_name);
            $this->_tagC("city",  $job->job_location);
            $this->_tagC("state",  $job->job_state);
            $this->_tagC("country",  $ct['iso2']);
            $this->_tagC("description", strip_tags($job->job_description));
            $this->_tagC("jobtype", $job->getCategory()->title);
            $this->_tagC("category", $job->getType()->title);
            $this->_close("job");
        }
        $this->_close("source");
    }

    private function _simplyHired()
    {
        header("Content-type: application/xml");
        echo '<?xml version="1.0" encoding="UTF-8" ?>';
        $url = Wpjb_Project::getInstance()->getUrl();
        $router = Wpjb_Project::getInstance()->router();
        $this->_open("jobs");
        
        $jobs = $this->_jobs();
        $jobs->join("t1.category t2")->join("t1.type t3")->where("job_source <> 3");
        foreach($jobs->execute() as $job) {
            $ct = Wpjb_List_Country::getByCode($job->job_country);
            $addr = array(
                $job->job_location,
                $job->job_state,
                $job->job_zip_code
            );

            $this->_open("job");
            $this->_tag("title", $job->job_title);
            $this->_tag("detail-url", $url."/".$router->linkTo("job", $job));
            $this->_tag("job-code", $job->id);
            $this->_tag("posted-date", $job->job_created_at);
            $this->_open("description");
            $this->_tagC("summary", substr(strip_tags($job->job_description).'&bull;', 0, 250));
            $this->_close("description");
            $this->_open("location");
            $this->_tag("address", join(", ", $addr));
            $this->_tag("state", $job->job_state);
            $this->_tagIf("city", $job->job_location);
            $this->_tagIf("zip", $job->job_zip_code);
            $this->_tagIf("country", $ct['iso2']);
            $this->_close("location");
            $this->_open("company");
            $this->_tag("name", $job->company_name);
            $this->_tagIf("url", $job->company_url);
            $this->_close("company");
            $this->_close("job");
        }

        $this->_close("jobs");
    }

    private function _googleBase()
    {
        header("Content-type: application/xml");
        echo '<?xml version="1.0" encoding="UTF-8" ?>';
        echo '<rss version ="2.0" xmlns:g="http://base.google.com/ns/1.0">';
        $url = Wpjb_Project::getInstance()->getUrl();
        $router = Wpjb_Project::getInstance()->router();
        
        $this->_open("channel");
        $this->_tag("description", Wpjb_Project::getInstance()->conf("seo_job_board_title"));
        $this->_tag("link", $url);

        $jobs = $this->_jobs();
        $jobs->join("t1.category t2")->join("t1.type t3");
        foreach($jobs->execute() as $job) {
            $this->_open("item");
            $this->_tag("g:location", $job->job_location);
            $this->_tag("title", $job->job_title);
            $this->_tagC("description", substr(strip_tags($job->job_description), 0, 250));
            $this->_tag("link", $url."/".$router->linkTo("job", $job));
            $this->_tag("g:publish_date", $job->job_created_at);
            $this->_tag("g:employer", $job->company_name);
            $this->_tag("guid", $url."/".$router->linkTo("job", $job));
            $this->_close("item");
        }
        $this->_close("channel");
        $this->_close("rss");
    }

    private function _juju()
    {
        header("Content-type: application/xml");
        echo '<?xml version="1.0" encoding="UTF-8" ?>';
        echo '<positionfeed
            xmlns="http://www.job-search-engine.com/employers/positionfeed-namespace/"
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
            xsi:schemaLocation="http://www.job-search-engine.com/employers/positionfeed-namespace/ http://www.job-search-engine.com/employers/positionfeed.xsd" version="2006-04">';

        $url = Wpjb_Project::getInstance()->getUrl();
        $router = Wpjb_Project::getInstance()->router();

        $this->_tag("source", Wpjb_Project::getInstance()->conf("seo_job_board_title"));
        $this->_tag("sourcurl", $url);
        $this->_tag("feeddate", date(DATE_ISO8601));

        $jobs = $this->_jobs();
        $jobs->join("t1.category t2")->join("t1.type t3");
        foreach($jobs->execute() as $job) {
            $code = Wpjb_List_Country::getByCode($job->job_country);
            $code = $code['iso2'];
            $this->_open("job", array("id"=>$job->id));
            $this->_tag("employer", $job->company_name);
            $this->_tag("title", $job->job_title);
            $this->_tagC("description", substr(strip_tags($job->job_description), 0, 250));
            $this->_tag("postingdate", date(DATE_ISO8601, $job->job_created_at));
            $this->_tag("joburl", $url."/".$router->linkTo("job", $job));
            $this->_open("location");
            $this->_tag("nation", $code);
            $this->_tagIf("state", $job->job_state);
            $this->_tagIf("zip", $job->job_zip_code);
            $this->_tagIf("city", $job->job_location);
            $this->_close("location");
            $this->_close("job");
        }
        $this->_close("positionfeed");

    }

    private function _esc($text)
    {
        return esc_html(ent2ncr($text));
    }

    public function feedAction()
    {
        $category = $this->getRequest()->get("slug", "all");

        $query = $this->_jobs();
        if($category != "all") {
            $query->join("t1.category t2", $query->quoteInto("t2.slug = ?", $category));
        } else {
            $query->join("t1.category t2");
        }

        $result = $query->execute();

        header("Content-type: application/xml");

        $rss = new DOMDocument();
        $rss->formatOutput = true;

        $wraper = $rss->createElement("rss");
        $wraper->setAttribute("version", "2.0");
        $wraper->setAttribute('xmlns:atom', "http://www.w3.org/2005/Atom");

        $channel = $rss->createElement("channel");

        $title = $rss->createElement("title", $this->_esc(Wpjb_Project::getInstance()->conf("seo_job_board_title")));
        $channel->appendChild($title);
        $link = $rss->createElement("link", $this->_esc(Wpjb_Project::getInstance()->getUrl()));
        $channel->appendChild($link);
        $description = $rss->createElement("description", $this->_esc(Wpjb_Project::getInstance()->conf("seo_job_board_title")));
        $channel->appendChild($description);

        foreach($result as $job) {
            $link = Wpjb_Project::getInstance()->getUrl()."/";
            $link.= Wpjb_Project::getInstance()->router()->linkTo("job", $job);
            $pubDate = date(DATE_RSS, strtotime($job->job_created_at));
			
			$desc="<pre>Nơi làm việc: ".$job->job_address."\n <br />";
           
            $desc.="Tên công ty: ".$job->company_name."\n <br />";
          
            $desc.="Mức lương: Thỏa thuận"."\n <br /><br />";
			
			$desc.="<strong>Mô tả công việc:</strong><br /> ".$job->job_description."\n <br /><br />";

            $desc.="<strong>Yêu cầu:</strong><br /> ".$job->job_required."\n <br /><br />";

            $desc.="<strong>Quyền lợi:</strong><br /> ".$job->job_interest."\n <br /><br />";

            $desc.="<strong>Người liên hệ:</strong> ".$job->job_contact."\n <br />";

            $desc.="<strong>Điện thoại liên hệ:</strong> ".$job->job_phone."\n <br />";

            $desc.="<strong>Địa chỉ liên hệ:</strong> ".$job->job_address."\n <br /><br />";

            $desc.="<strong>-> Ứng tuyển ngay:</strong> ".$this->_esc($link)."</pre>";

            
            $description = $rss->createCDATASection($desc);
            $desc = $rss->createElement("description");
            $desc->appendChild($description);



            $item = $rss->createElement("item");
			$item->appendChild($rss->createElement("title", $this->_esc($job->job_title)));
            //$item->appendChild($rss->createElement("title", "<<< VIỆC LÀM HẤP DẪN - ĐANG TUYỂN >>> <br />"));
            //$item->appendChild($rss->createElement("title", "<<< VIỆC LÀM HẤP DẪN - ĐANG TUYỂN >>> <br />".mb_convert_case($this->_esc($job->job_title))),MB_CASE_UPPER, "UTF-8");
            //$item->appendChild($rss->createElement("title", "<<< VIỆC LÀM HẤP DẪN - ĐANG TUYỂN >>> <br />*****".strtoupper($this->_esc($job->job_title)))).' *****';
            $item->appendChild($rss->createElement("link", $this->_esc($link)));
            $item->appendChild($desc);
            $item->appendChild($rss->createElement("pubDate", $pubDate));
            $item->appendChild($rss->createElement("guid", $this->_esc($link)));

            $channel->appendChild($item);
        }

        $wraper->appendChild($channel);
        $rss->appendChild($wraper);

        print $rss->saveXML();

        exit;
        return false;

    }

    public function discountAction()
    {
        $code = $this->getRequest()->post("code");

        $validator = new Wpjb_Validate_Coupon();
        if($validator->isValid($code)) {
            $query = new Daq_Db_Query();
            $result = $query->select()->from("Wpjb_Model_Discount t")
                ->where("code = ?", $code)
                ->limit(1)
                ->execute();
            print json_encode($result[0]->toArray());
        } else {
            $class = new stdClass();
            $err = $validator->getErrors();
            $class->isError = true;
            $class->error = $err[0];
            print json_encode($class);
        }

        exit;
        return false;
    }

    public function trackerAction()
    {
        $job = $this->getObject();
        if(!$job->is_active) {
            return false;
        }

        $job->stat_views++;

        $id = $job->getId();
        if(!isset($_COOKIE['wpjb'][$id])) {
            $job->stat_unique++;
        }
        
        $job->save();

        $find = array("https://www.", "https://", "http://www.", "http://");
        $domain = get_bloginfo("url");
        $domain = str_replace($find, "", $domain);

        setcookie("wpjb[$id]", time(), time()+(3600*24*30), "/", $domain);

        echo "var WpjbTracker = {};";

        exit;
        return false;
    }

}

?>
