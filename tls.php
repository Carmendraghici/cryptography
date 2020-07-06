<?php
// A sample PHP Script to POST data using cURL use TLS 1.2
// Data in JSON format
 
/*
CURL_SSLVERSION_DEFAULT (0)
CURL_SSLVERSION_TLSv1 (1)
CURL_SSLVERSION_SSLv2 (2)
CURL_SSLVERSION_SSLv3 (3)
CURL_SSLVERSION_TLSv1_0 (4)
CURL_SSLVERSION_TLSv1_1 (5)
CURL_SSLVERSION_TLSv1_2 (6)
*/


$data = array(
    'name' => 'Produs TLS',
    'description' => 'Test comunicare cRUD TLS',
    'price' => '25',
    'photo'=>'@' . realpath('demo.jpg') . ';filename=demo.jpg'
);
 
//$data = json_encode($data);
 
$ch = curl_init('localhost/laravelshop/public/api/apiproducts');

curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 1); 
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 2);

curl_setopt($ch, CURLOPT_CERTINFO, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_HEADER, true);


curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);

curl_setopt ($ch, CURLOPT_SSLVERSION, 6);  //Force requsts to use TLS 1.2
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 
 
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//     'Content-Type: application/json',
//     'Content-Length: ' . strlen($data))
// );
 
$result = curl_exec($ch);

$skip = intval(curl_getinfo($ch, CURLINFO_HEADER_SIZE));
$head = substr($result,0,$skip);
$result = substr($result,$skip);
$info = curl_getinfo($ch);
$info = var_export($info,true);


curl_close($ch);
echo "<pre>";
var_dump($result);
echo $head;
echo $info;
?>