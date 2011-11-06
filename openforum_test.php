<html>
<body>


<table class="openforum"><tr class="openforumheader"><td>Title</td></tr>
<?php
$selector = $_GET["type"];
switch($selector){
case "most-viewed":
case "most-shared":
case "most-commented":
case "most-recent":
break;
default:
$selector = "most-recent";
}
$ch = curl_init("http://api.openforum.com/v1/summaries/$selector?apikey=5q2evymkx53dwzumv73adv4p&count=10");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
preg_replace('/%u([a-fA-F0-9]{4})/', '&#x\\1;', $output);
curl_close($ch);
$data = simplexml_load_string($output);
foreach($data->ReturnItems->Content as $index => $info){
  echo "<tr class='openforumitem'><td class='openforumtitle'><a href='http://www.openforum.com{$info->LinkUrl}'>$info->Title</a></td>";
  if ($selector == "most-recent"){
    echo "<td class='openforumtext'> $info->TeaserText </td>";
  }
  echo "</tr>";
}

?>
</table>
</body>
</html>
