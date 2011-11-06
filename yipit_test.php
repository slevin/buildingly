<?php

class request{	
	protected $url;
	protected $response;
	
	public function __construct($url){
	  $this->url = $url;
	}
	
	public function getResponse($param = 'json'){
	  $ch = curl_init($this->url);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $this->response = curl_exec($ch);
      $this->response = preg_replace('/%u([a-fA-F0-9]{4})/', '&#x\\1;', $this->response);
      curl_close($ch);
      if($param == 'obj'){
        $this->response = json_decode($this->response);
      }
	  return $this->response;
	}
	
	public function getUrl(){
	  return $this->url;
	}
}

class yipitRequest extends request{
	
	public function printRows($num = 10){
		if(empty($this->response)){
	  	  $this->getResponse();
		}
		$data = json_decode($this->response);
		return $data;
	}
}


	$request = new yipitRequest("http://api.yipit.com/v1/deals/?key=SyfdMvpxgqA8tmSm&lat=40.7391874&lon=-73.9897746");
	$data = $request->getResponse('obj');
	$deals = $data->response->deals;
	$i = 0;

	foreach($deals as $deal){
	//print_r($deal);
	  if($i == 10){break;}
	
	  $end_time = strtotime($deal->end_date);
	  $remaining = round((($end_time - time())/60)/60);
	  $hours_remaining = $remaining % 24;
	  $days_remaining = floor($remaining/24);
	  
 	  echo <<<EOT
   		<h3><a href="{$deal->url}">{$deal->title}</a></h3>
          <p class="bname">{$deal->business->name}</hp>
          <p>{$deal->business->locations[0]->address} {$deal->business->locations[0]->locality} {$deal->business->locations[0]->state}, {$deal->business->locations[0]->zip_code}</p>
          <p>{$deal->price->formatted}</h4>
          <img 
          <div align="left" style="border:1px solid black">Worth: {$deal->value->formatted} | Price: {$deal->price->formatted} | Discount: {$deal->discount->formatted}</div>
          <br/>
          <div align="right"<p><a class="btn primary large" href="{$deal->url}">Grab it! &raquo;</a></p></div>
          <div align="right" style="border:1px black">Time left: {$days_remaining} days, {$hours_remaining} hours<br/></div>
EOT;
		$i++;
	}