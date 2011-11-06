<html>
<body>

<table class="restrauantlist">
<tr class="restaurantheader">
<td>
Restaurant Name
</td>
<td>
Cuisines
</td>
</tr>
<?php
$ch = curl_init("https://r-test.ordr.in/dl/ASAP/77840/san+francisco/3502+16th+St?_auth=1,nn5dr9wH4RGTlmtZu8bTaA");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
preg_replace('/%u([a-fA-F0-9]{4})/', '&#x\\1;', $output);
curl_close($ch);
$data = json_decode($output);
foreach($data as $index => $info){
  echo "<tr class='restaurantentry'><td class='restaurantname'><a href='../seemenu.php?id=$info->id'>$info->na</a></td><td class='restaurantcusine'> ";
  foreach($info->cu as $index => $cuisine){
    if($index > 4){
      break;
    }
    if($index > 0){
      echo ", ";
    }
    echo $cuisine;
  }
  echo "</td></tr>";
}
//print_r(json_decode($output));
?>
</table>
</body>
</html>
