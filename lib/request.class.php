<?php
class request{	
	protected $url;
	protected $response;
	
	public function __construct($url, $params){
	  $query = http_build_query($params);
	  $this->url = $url.'?'.$query;
	  $this->getResponse();
	}
	
	public function getResponse($response_type = 'obj'){
	  $ch = curl_init($this->url);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $this->response = curl_exec($ch);
      $this->response = preg_replace('/%u([a-fA-F0-9]{4})/', '&#x\\1;', $this->response);
      curl_close($ch);
      if($response_type == 'obj'){
        $this->response = json_decode(utf8_encode($this->response));
      }
	  return $this->response;
	}
	
	public function getUrl(){
	  return $this->url;
	}
	
}

class yipitRequest extends request{

	public function printResults(){	
		
		$deals = $this->response->response->deals;
		$i = 0;
		foreach($deals as $deal){
	
	      if($i == 10){
	        break;
	      }
	
	  	  $end_time = strtotime($deal->end_date);
	  	  $remaining = round((($end_time - time())/60)/60);
	  	  $hours_remaining = $remaining % 24;
	  	  $days_remaining = floor($remaining/24);
	  	  $image = empty($deal->images->image_small) ? '' : '<img src="'.$deal->images->image_small.'"/><br />';
 	  	  echo <<<EOT
 	  	  {$image}
   		  <a style="font: 12pt Helvetica, arial;" href="{$deal->url}">{$deal->title}</a>
          <p style="margin-bottom: 2px;" class="bname">{$deal->business->name}</p>
          <p style="margin-bottom: 2px;">{$deal->business->locations[0]->address} {$deal->business->locations[0]->locality} {$deal->business->locations[0]->state}, {$deal->business->locations[0]->zip_code}</p>
          <p>Price: {$deal->price->formatted}</p>
          <div align="left" style="border:1px solid black">Worth: {$deal->value->formatted} | Price: {$deal->price->formatted} | Discount: {$deal->discount->formatted}</div>
          <br/>
          <div align="left" style="border:1px black">Time left: {$days_remaining} days, {$hours_remaining} hours<br/></div>
          <div align="left"<p><a class="btn primary large" style="margin-top: 10px;background: url('assets/get_deal_btn.png') no-repeat; width:125px; height:35px;border:none;" href="{$deal->url}"></a></p>
          </div>
          <br />
EOT;
		$i++;
	  }
	}
}

class ordrinRequest extends request{

	public function __construct($url, $params){
	  $query = http_build_query($params);
	  $this->url = $url.'?'.$query;
	  $this->url = str_replace('%2C', ',', $this->url);
	  $this->getResponse();
	}
	
	public function printResults(){
	  echo '<html><body><table class="restrauantlist">';
	  foreach($this->response as $index => $info){
  		echo "<tr class='restaurantentry'><td><span class='restaurantname'><a href='seemenu.php?id=$info->id'>$info->na</a></span><br/><span class='restaurantcusine'> ";
  		foreach($info->cu as $index => $cuisine){
    	  if($index > 4){
      		break;
    	  }
    	  if($index > 0){
      		echo ", ";
    	  }
    	  echo $cuisine;
  	    }
  	    echo "</span></td></tr>";
	  }
	  echo '</table></body></html>';
	}

}