<?php
$post_data['applicant_name'] = 'Nguyễn Thế  Chỉnh';
$post_data['email'] = 'nguyenthechinhit@gmail.com';
$post_data['resume'] = 'test';

foreach ( $post_data as $key => $value) {
    $post_items[] = $key . '=' . urlencode($value);
}
$post_string = implode ('&', $post_items);
//echo $post_string;
$curl_connection =
  curl_init('http://sagojo.com/tim-viec-lam/apply/quan-ly-giam-sat-dieu-hanh-nvkd/');

curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl_connection, CURLOPT_USERAGENT,
  "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);

curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);

$result = curl_exec($curl_connection);
/*echo $result;
print_r(curl_getinfo($curl_connection));
echo curl_errno($curl_connection) . '-' .
                curl_error($curl_connection);
*/
curl_close($curl_connection);
echo json_encode($result);
?>