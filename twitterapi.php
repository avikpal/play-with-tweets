<?php
// ---------- Twitter API Function ------------
// Query the Twitter API with a particular url
function queryTwitter($url) {
$cURL = curl_init();
curl_setopt($cURL, CURLOPT_URL, $url);
curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($cURL, CURLOPT_CONNECTTIMEOUT, 5);
$data = curl_exec($cURL);
curl_close($cURL);
return json_decode($data);
}
?>
