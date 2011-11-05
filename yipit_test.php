<?php
$ch = curl_init("http://api.yipit.com/v1/deals/?key=SyfdMvpxgqA8tmSm&lat=40.7391874&lon=-73.9897746");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
preg_replace('/%u([a-fA-F0-9]{4})/', '&#x\\1;', $output);
curl_close($ch);
print_r(json_decode($output));
