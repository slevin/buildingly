<?php
$lat = isset($_GET['lat']) && $_GET['lat'] != '' ? $_GET['lat'] : '40.7391874';
$lon = isset($_GET['long']) && $_GET['long'] != '' ? $_GET['long'] : '-73.9897746';

// get top 20 trending events within 1000 meters
$meetup_url = "https://api.meetup.com/2/open_events?key=63295e21264a66d6b1df5453165&sign=true&lon={$lon}&lat={$lat}&time=,1w&radius=1&page=20";
$ch = curl_init($meetup_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
$output = utf8_encode($output);
$meetup_json = json_decode($output);
$events = $meetup_json->results;

date_default_timezone_set("America/New_York");

if(is_object($events[0])){
echo "<ul class=\"meetup_list\">";
foreach($events as $event) {
    /*
     *  url, description, name, venue name, date time, groupname
     */

    $meetup_date = date("M d Y, h:i a", $event->time / 1000);
    $dt = time();
    $venue_name = "";
    if (property_exists($event, "venue")) {
        $venue_name = $event->venue->name;
    }
    $meetup_event_html = <<<HERE
<li class="meetup_li">
    <img src="assets/meetup_icon.png" />
    <a class="meetup_event_link" href="{$event->event_url}"><span class="meetup_event_name">{$event->name}</span></a><br/>
    <span class="meetup_event_date">{$meetup_date}</span> -
    <span class="meetup_event_venue">{$venue_name}</span><br />
    <span class="meetup_event_group">{$event->group->name}</span><br />
</li>
HERE;
    echo $meetup_event_html;
}
echo "</ul>";
}
?>
