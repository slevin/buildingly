<?php

  function get_lat(){
    return $_GET['lat'] != '' ? htmlentities($_GET['lat']) : '40.7391874';
  }
  
  function get_long(){
    return $_GET['long'] != '' ? htmlentities($_GET['long']) : '-73.9897746';
  }
 
  function get_partners(){
  	for($i=0; $i<strlen($_GET['partners']); $i++){
  	  switch($_GET['partners'][$i]){
  	  	case 'y':
  	  	  $partners[] = 'yipit';
  	  	  break;
  	  	case 'm':
  	  	  $partners[] = 'meetup';
  	  	  break;
  	  	case 'g':
  	  	  $partners[] = 'grubhub';
  	  	  break;
  	  	case 'e':
  	  	  $partners[] = 'eventbrite';
  	  	  break;
  	  	case 'o':
  	  	  $partners[] = 'ordrin';
  	  	  break;
  	  }
  	}
    return $partners;
  }
  
  function check_params(){
  	if(!check_lat_long() || !check_partners()){
  	  die('You are missing required parameters.');
  	}
  }
  
  function check_lat_long(){
    if(!isset($_GET['lat']) || !isset($_GET['long'])){
	  throw new Exception('Lat and long must both be given');
	  return false;
    }
    if(!is_numeric($_GET['lat']) || !is_numeric($_GET['long'])){
	  throw new Exception('Lat and long must both be numeric');
	  return false;
    }
    return true;
  }
  
  function check_partners(){
    if(!isset($_GET['partners'])){
	  throw new Exception('At least one partner must be specified');
	  return false;
    }
    return true;
  }