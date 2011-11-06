<html>
<body>
<table class="wholemenu">
<?php
$id = $_GET['id'];
$ch = curl_init("https://r-test.ordr.in/rd/$id?_auth=1,nn5dr9wH4RGTlmtZu8bTaA");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
preg_replace('/%u([a-fA-F0-9]{4})/', '&#x\\1;', $output);
curl_close($ch);
$data = json_decode($output);

//foreach category
foreach($data->menu as $index => $info){
  echo "<tr class='menucategory'><td>$info->name</td></tr> ";

  //foreach menu item
  foreach($info->children as $index2 => $item){
    echo "<tr class='menuitem'><td class='menuitemname'>$item->name</td></tr>";
  }
}
//print_r(json_decode($output));
?>

</table>
</body>
</html>