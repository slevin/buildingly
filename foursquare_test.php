<?php

$lat = "40.7391874";
$lon = "-73.9897746";

$fs_client_id = "YECXLIILUHH0AMSLGCWKLVKJDZMA30YKLI3ZMSI0KQGNKUBV";
$fs_client_secret = "HZNC0M4RZAEEOJ1PO2L0H31XNKKE1YVFWF0DF1EBJQWM1BNL";
$fs_client_param = "client_id={$fs_client_id}&client_secret={$fs_client_secret}";

// get top 20 trending events within 1000 meters
$fs_venue_count = 20;
$fs_radius_meters = 1000;

$trending_url = "https://api.foursquare.com/v2/venues/trending?ll={$lat},{$lon}&limit={$fs_venue_count}&radius={$fs_radius_meters}&{$fs_client_param}";
$ch = curl_init($trending_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);

$trending_json = json_decode($output);
// TODO confirm meta->code response is 200

$venues_json = $trending_json->response->venues;

//preg_replace('/%u([a-fA-F0-9]{4})/', '&#x\\1;', $output);
//print_r(json_decode($output));

/*
$event_url = "https://api.foursquare.com/v2/venues/VENUE_ID/events"


*/

echo "<ul class=\"fs_list\">";
foreach($venues_json as $venue) {
    $venue_id = $venue->id;
    $venue_name = $venue->name;
    $venue_url = "https://foursquare.com/v/{$venue_id}";
    $venue_here = "";
    if (property_exists($venue, "hereNow")) {
        $venue_here = $venue->hereNow->count;
    }
    $categories = $venue->categories;
    $category_icon = "";
    $category_name = "";
    if (count($categories) > 0) {
        $category = $categories[0];
        $category_icon = $category->icon;
        $category_name = $category->name;
    }
    $special_messages = array();
    if (property_exists($venue, "specials")) {
        foreach ($venue->specials as $special) {
            $special_message = $special->message;
            $special_messages[] = "<div>{$special_message}</div>";
        }
    }
    $specials_html = implode("\n", $special_messages);
    $events_url = "https://api.foursquare.com/v2/venues/{$venue_id}/events?{$fs_client_param}";
    $fs_events_curl = curl_init($events_url);
    curl_setopt($fs_events_curl, CURLOPT_RETURNTRANSFER, 1);
    $events_curl_return = curl_exec($fs_events_curl);
    // TODO make sure return code is valid
    $events_json = json_decode($events_curl_return);
    $event_list = $events_json->response->events->items;
    $event_names = array();
    foreach ($event_list as $event) {
        $event_names[] = $event->name;
    }
    $events_html = implode(", ", $event_names);

    $foursquare_venue_html = <<<HERE
<li>
<img class="fs_venue_icon" src="{$category_icon}" />
<a class="fs_venue_link" href="${venue_url}"><span class="fs_venue_name">{$venue_name}<span></a><br/>
<span class="fs_checkedin_header">Checked In:</span> <span class="fs_checked_in_count">{$venue_here}</span><br/>
<span class="fs_category_header">Category:</span> <span class="fs_category_title">{$category_name}</span><br/>
<span class="fs_events_header">Events:</span> <span class="fs_events_list">{$events_html}</span><br/>
<span class="fs_specials_header">Specials:</span> <span class="fs_specials_list">{$specials_html}</span>
</li>
HERE;
    echo $foursquare_venue_html;
}
echo "</ul>";
?>
