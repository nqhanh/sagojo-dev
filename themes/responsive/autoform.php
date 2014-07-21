<?php
require('../../wp-blog-header.php');
global $wpdb;


$user_id = $_POST['js_id'];
//$post_data['jobid'] = $_POST['j_id'];
$post_data['userid'] = $_POST['js_id'];

$rows = $wpdb->get_results("SELECT id FROM wpjb_resume WHERE user_id = $user_id");
foreach ( $rows as $row ){
	$post_data['resume_id_txt'] = $row->id;

}
$post_data['applicant_name'] = $_POST['js_name'];
$post_data['email'] = $_POST['js_email'];
$post_data['resume'] = $_POST['message'];
//$post_data['wpjb_preview'] = 'submit';

foreach ( $post_data as $key => $value) {
    $post_items[] = $key . '=' . $value;
}
$post_string = implode ('&', $post_items);
//$post_string = urlencode($post_string);
//echo $post_string;
$curl_connection = curl_init();
curl_setopt($curl_connection, CURLOPT_URL, "http://sagojo.com/tim-viec-lam/apply/".$_POST['j_slug']);
curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl_connection, CURLOPT_USERAGENT,
  "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)");
curl_setopt($curl_connection, CURLOPT_POST, true);


curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);

$result = curl_exec($curl_connection);
//echo $result;
//print_r(curl_getinfo($curl_connection));
/*echo curl_errno($curl_connection) . '-' .
                curl_error($curl_connection);*/

curl_close($curl_connection);

//header ("Location: ".$_POST['j_slug']."?".SID);
?>