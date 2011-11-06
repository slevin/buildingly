<?php
$lat = isset($_GET['lat']) && $_GET['lat'] != '' ? $_GET['lat'] : '40.7391874';
$long = isset($_GET['long']) && $_GET['long'] != '' ? $_GET['long'] : '-73.9897746';

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


$request = new yipitRequest("http://api.yipit.com/v1/deals/?key=SyfdMvpxgqA8tmSm&lat={$lat}&lon={$long}");
$data = $request->getResponse('obj');
$deals = $data->response->deals;

foreach($deals as $deal){
	//print_r($deal);
	$end_time = strtotime($deal->end_date);
	$remaining = date('h', $end_time - time());
 echo <<<EOT
   <h3><a href="{$deal->url}">{$deal->title}</a></h3>
          <h4>{$deal->business->name}</h4>
          <p>{$deal->business->locations[0]->address} {$deal->business->locations[0]->locality} {$deal->business->locations[0]->state}, {$deal->business->locations[0]->zip_code}</p>
          <h4>{$deal->price->formatted}</h4> 
          <div align="left" style="border:1px solid black">Worth: {$deal->value->formatted} | Price: {$deal->price->formatted} | Discount: {$deal->discount->formatted}</div>
          <br/>
          <div align="right"<p><a class="btn primary large" href="{$deal->url}">Grab it! &raquo;</a></p></div>
          <div align="right" style="border:1px black">Time left: {$remaining} <br/></div>
EOT;
}