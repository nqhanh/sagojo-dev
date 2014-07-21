<?php
/**
 * Description of Messanger
 *
 * @author greg
 * @package
 */

class Wpjb_Utility_Messanger
{
    public static function parse(Wpjb_Model_Email $mail, Wpjb_Model_Job $job, array $append)
    {
        $active = "active";
        if(!$job->is_active && !$job->is_approved) {
            $active = "inactive";
        }

        $time = strtotime ( $job->job_created_at );
        $newdate = strtotime ('+'.$job->job_visible.' day', $time) ;
        $expiration = date ( "Y-m-d H:i:s" , $newdate );
		$vexpiration = date ( "d-m-Y H:i:s" , $newdate );

        /* @var $job Wpjb_Model_Job */
		$job_pack = $job->payment_sum;
		if($job_pack==0)$job_pack = $job->payment_discount;
		if($job_pack==50){
			$number="1";
			$vpack="Cơ bản";$epack="Basic";
			$vbenefit="- 1 email tư vấn tuyển dụng<br/>- 1 tuần 'Việc làm tốt nhất'<br/>- Đăng tin lên trang Facebook<br/>- Sử dụng đăng tin trong 30 ngày";
			$ebenefit="- 1 consultant email<br/>- 7 days listed on the homepage<br/>- Your job will be posted on fanpage Facebook";}
		elseif($job_pack==100){
			$number="5";
			$vpack="Chuyên nghiệp";$epack="Standard";
			$vbenefit="- 4 email tư vấn tuyển dụng<br/>- 1 tuần 'Việc làm tốt nhất'<br/>- 1 tuần top đầu ngành nghề<br/>- 1 tuần 'Việc làm hấp dẫn'<br/>- Hiệu ứng nổi bật khung tin<br/>- Đăng tin lên trang Facebook<br/>- Sử dụng đăng tin trong 30 ngày";
			$ebenefit="- 4 consultant emails<br/>- 7 days listed on the homepage<br/>- Priority Search for 1 weeks<br/>- Featured Job for 1 weeks<br/>- Color highlighted brings more attention<br/>- Your job will be posted on fanpage Facebook<br/>- Online Job Posting for 30 days";}
		elseif($job_pack==200){
			$number="5";
			$vpack="Nâng cao";$epack="Advance";
			$vbenefit="- 4 email tư vấn tuyển dụng<br/>- 2 tuần 'Việc làm tốt nhất'<br/>- 2 tuần top đầu ngành nghề<br/>- 2 tuần 'Việc làm hấp dẫn'<br/>- Đặt logo công ty trên trang chủ.<br/>- Liên hệ, chăm sóc tư vấn tuyển dụng<br/>- Hiệu ứng nổi bật khung tin<br/>- Đăng tin lên trang Facebook<br/>- Sử dụng đăng tin trong 30 ngày";
			$ebenefit="- 4 consultant emails<br/>- 14 days listed on the homepage<br/>- Priority Search for 2 weeks<br/>- Featured Job for 2 weeks<br/>- Your company′s logos on the homepage<br/>- Support and consulting for your recruitments<br/>- Color highlighted brings more attention<br/>- Your job will be posted on fanpage Facebook<br/>- Online Job Posting for 30 days";}
        $exchangeArray = array(
          "id" => $job->getId(),
          "created" => $job->job_created_at,
          "visible" => $job->job_visible,
          "price" => $job->paymentAmount(),
          "paid" => $job->paymentPaid(),
          //"promo_code" => $job->promoCode,
          "discount" => $job->paymentDiscount(),
          "company" => $job->company_name,
          "location" => $job->locationToString(),
          "email" => $job->company_email,
          "position_title" => $job->job_title,
          "listing_type" => $job->getType(true)->title,
          "category" => $job->getCategory(true)->title,
          "active" => $active,
          "url" => Wpjb_Project::getInstance()->getUrl()."/".Wpjb_Project::getInstance()->router()->linkTo("job", $job),
          //"pay_paypal" => Core::url("pay/paypal/" . $job->id),
          "expiration" => $expiration,
		  "signature" => __("<table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#251E6E'><tr><td width='20px'></td><td width='260px'><img src='http://sagojo.com/wp-content/themes/responsive/core/images/default-logo.png' width='150'></td><td><font color='#FFFFFF' face='Arial' size='5'>plum jobs, rewarding lives</font></td></tr><tr><td width='20px'></td><td colspan='2'><font color='#FFFFFF' face='Arial'>Job matching and Job auctioning service for freelancers, jobseekers, employers and agencies	| <img src='http://sagojo.com/wp-content/themes/responsive/images/jp.png'> From Japan - Tokyo</font></td></tr><tr><td>&nbsp;</td></tr></table>", WPJB_DOMAIN),
		  "vpack" => $vpack,
		  "epack" => $epack,
		  "vbenefit" => $vbenefit,
		  "ebenefit" => $ebenefit,
		  "contact_person" => $job->job_contact,
		  "contact_phone" => $job->job_phone,
		  "number" => $number,
        );
        foreach($append as $k => $v) {
            $exchangeArray[$k] = $v;
        }

        $body = $mail->mail_body;
        $mail_title = $mail->mail_title;
        foreach($exchangeArray as $key => $value) {
            //$v = esc_html($value, false);
            $v = $value;
            $body = str_replace('{$'.$key.'}', $v, $body);
            $mail_title = str_replace('{$'.$key.'}', $v, $mail_title);
        }

        return array($mail_title, $body);
    }

    public static function send($key, Wpjb_Model_Job $job, $append = array())
    {
        $mail = new Wpjb_Model_Email($key);

        list($title, $body) = self::parse($mail, $job, $append);

        if($mail->sent_to == 1) {
            $sendTo = $mail->mail_from;
        } else {
            $sendTo = $job->company_email;
        }

        if($key == 7) {
            $sendTo = $append['alert_email'];
        }
        if($key == 8) {
            $sendTo = $append['applicant_email'];
        }
		
	        $headers = "From: ". $mail->mail_from;
	        $headers.= " <" .  $mail->mail_from . ">\r\n";
		
		
        extract(apply_filters("wpjb_messanger", array(
            "key" => $key,
            "sendTo" => $sendTo,
            "title" => $title,
            "body" => $body,
            "headers" => $headers
        )));
        add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
        wp_mail($sendTo, $title, $body, $headers);		
		
    }
	
}

?>