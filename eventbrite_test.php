<?php
date_default_timezone_set("America/New_York");
$lat = isset($_GET['lat']) && $_GET['lat'] != '' ? $_GET['lat'] : '40.7391874';
$lon = isset($_GET['long']) && $_GET['long'] != '' ? $_GET['long'] : '-73.9897746';

$date_str = date('Y-m-d', time()).' '.date('Y-m-d', time()+(86400*3));

  $params = array(
	'app_key'	=> 'VWX6CFRBWMVW3NZDIP',
    'latitude'  => $lat,
  	'longitude' => $lon,
  	'date'		=> 'Today',
  	'within'	=> '1',
  );
  $params = http_build_query($params);

$eventbrite_url = "http://www.eventbrite.com/json/event_search?{$params}";

$ch = curl_init($eventbrite_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
$output = utf8_encode($output);
$events_json = json_decode($output);
$events = $events_json->events;

echo "<ul class=\"eventbrite_list\">";
foreach($events as $event_obj) {
	if(isset($event_obj->summary)){
		continue;
	}
	$event = $event_obj->event;
    
    if($event->repeats == 'no'){
    	$start_time = strtotime($event->start_date);
    	$start_date = date('M j Y, g:i a', $start_time);
    	$date = '<span class="eventbrite_event_date">'.$start_date.'</span>';
    }
    if (isset($event->venue) && !empty($event->venue->name)) {
      $venue = '<span class="meetup_event_venue"> - '.$event->venue->name.'</span><br />';
    }
    
    $distance = $event->distance;
    $event_html = <<<HERE
<li class="eventbrite_li">
    <a class="eventbrite_event_link" href="{$event->url}" target="_blank"><span class="meetup_event_name">{$event->title}</span></a><br/>
    <div>$date $venue</div>
    <span class="meetup_event_distance">{$event->venue->address} | {$distance}</span><br />
    <span class="meetup_event_group">{$event->group->name}</span><br />
</li>
HERE;
    echo $event_html;
}
echo "</ul>";
