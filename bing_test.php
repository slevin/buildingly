<?php
$address = isset($_GET['address']) && $_GET['address'] != '' ? $_GET['address'] : '902 Broadway';
$city = isset($_GET['city']) && $_GET['city'] != '' ? $_GET['city'] : 'New York';

$vars = rawurlencode($address.' '.$city.' NY');
$ch = curl_init("http://dev.virtualearth.net/REST/v1/Locations/{$vars}?o=json&key=Astz1QZHF2CCNpI6aMVIXtchjBuAUIXTt2PBlI7UrMPbsNoousBCc_bXtYR_40cb");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
preg_replace('/%u([a-fA-F0-9]{4})/', '&#x\\1;', $output);
curl_close($ch);
$data = json_decode($output);
$resource = $data->resourceSets[0]->resources[0];
$postalcode = $resource->address->postalCode;
$lat = $resource->point->coordinates[0];
$long = $resource->point->coordinates[1];
echo $lat.':'.$long;
?>