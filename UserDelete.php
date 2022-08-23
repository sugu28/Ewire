<?php

$_password = "2069|29a7ea7b83b4cc5f2d98";
$password = hash('sha512', $_password);

// API URL to send data
$url = 'https://ft.yapay.in/?action=getbalance&ver=3&mid=2069&hash='.$password;

$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);
// Will dump a beauty json <3
$fr=json_decode($result, true);

echo $fr["Response"]["balanceAmount"];
?>