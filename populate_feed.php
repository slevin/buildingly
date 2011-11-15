<?php

  ini_set('error_reporting', 1);
  require_once('lib/request.class.php');
  require_once('include/util.php');

  date_default_timezone_set("America/New_York");
  check_params();
  $lat = get_lat();
  $long = get_long();
  $partners = get_partners();

  foreach($partners as $partner){
  	
    switch($partner){
      case 'yipit':
    	$url = 'http://api.yipit.com/v1/deals/';
    	$params = array(
	  	  'key' => 'Wggk8KqvnuC6af4m',
	  	  'lat' => $lat,
	  	  'lon' => $long,
		);
		break;
	  case 'ordrin':
	  	$url = 'https://r-test.ordr.in/dl/ASAP/77840/san+francisco/3502+16th+St';
	  	$params = array(
	  	 '_auth'=> '1,nn5dr9wH4RGTlmtZu8bTaA',
	  	);
	  	break;
    }
    $class = $partner.'Request';
    $request = new $class($url, $params);
	$request->printResults();
  }
  
