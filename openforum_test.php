<html>
<body>


<table class="openforum"><tr class="openforumheader"><td>Title</td><td>Teaser</td></tr>
<?php

$ch = curl_init("http://api.openforum.com/v1/summaries/most-recent?apikey=5q2evymkx53dwzumv73adv4p");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
preg_replace('/%u([a-fA-F0-9]{4})/', '&#x\\1;', $output);
curl_close($ch);
$data = simplexml_load_string($output);
foreach($data->ReturnItems->Content as $index => $info){
  echo "<tr class='openforumitem'><td class='openforumtitle'> $info->Title </td><td class='openforumtext'> $info->TeaserText </td></tr> ";
}

?>
</table>
</body>
</html>
