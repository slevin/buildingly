<?php
$address = isset($_GET['address']) && $_GET['address'] != '' ? $_GET['address'] : '902 Broadway';
$city = isset($_GET['city']) && $_GET['city'] != '' ? $_GET['city'] : 'New York';

$vars = rawurlencode($address.' '.$city.' NY');
$ch = curl_init("http://dev.virtualearth.net/REST/v1/Locations/{$vars}?o=json&key=Astz1QZHF2CCNpI6aMVIXtchjBuAUIXTt2PBlI7UrMPbsNoousBCc_bXtYR_40cb");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
preg_replace('/%u([a-fA-F0-9]{4})/', '&#x\\1;', $output);
curl_close($ch);
$data = json_decode($output);
$resource = $data->resourceSets[0]->resources[0];
$postalcode = $resource->address->postalCode;
$lat = $resource->point->coordinates[0];
$long = $resource->point->coordinates[1];

//
//$pathelements = explode('/', parse_url($_SERVER['REQUEST_URI'])['path']);
//$city = 'New York';
//$state = 'NY';
//$address;
//$pathindex = 3;
//if ($pathelements.length == $pathindex){
////show form
//} else { if ($pathelements.length > $pathindex + 1) {
//$city = $pathelements[$pathindex];
//$pathindex++;
//}
//$address = $pathelements[$pathindex];
//}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Buildingly</title>
    <meta name="description" content="buildingly">
    <meta name="author" content="buildingly">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="../bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>
    <style>
div.loading{background-image:url('http://www.careeravenues.in/Images/loadingGIF.gif');height:10em; width:10em;background-repeat:no-repeat;}
</style>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.js"></script>
	<script>
			$(function(){
					$.ajax({url:"../foursquare_test.php?lat=<?php echo $lat; ?>&long=<?php echo $long; ?>", 
					dataType:'html',
					success:function(data){$('#foursquare').append(data); $('#loadingfoursquare').css('display', 'none');}});

					$.ajax({url:"../yipit_test.php?lat=<?php echo $lat; ?>&long=<?php echo $long; ?>", 
					dataType:'html',
					success:function(data){$('#yipit').append(data); $('#loadingyipit').css('display', 'none');}});

					$.ajax({url:"../ordr_test.php", 
					dataType:'html',
					success:function(data){$('#ordr').append(data); $('#loadingordr').css('display', 'none');}});

					$.ajax({url:"../meetup_test.php?lat=<?php echo $lat; ?>&long=<?php echo $long; ?>", 
					dataType:'html',
					success:function(data){$('#meetup').append(data); $('#loadingmeetup').css('display', 'none');}});
			});
		</script>
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
  </head>

  <body>
    <div class="topbar">
      <div class="fill">
        <div class="container">
          <a class="brand" href="#">Buildingly</a>
          <ul class="nav">
            <li class="active"><a href="index.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
      <img src="../assets/Buildingly_logo.png" alt="Buildingly" />
        <h2>What's happening in your building?</h2>
        <p>You spend 90% of your time in the same two or three places. See what's happening and who's doing what in your building!</p>
        <p><a class="btn primary large">Get Started &raquo;</a></p>
      </div>

      <!-- Example row of columns -->
      <div class="row">
      
        <div class="span-one-third">
          <h2>Food Delivery</h2>
          <div id="ordr">
            <div id="loadingordr" class="loading"></div>
          </div>
          <p><a class="btn primary large" href="#">View Details &raquo;</a></p>
        </div>
        
        <div class="span-one-third">
          <h2>Deals</h2>
          <div id="yipit">
            <div id="loadingyipit" class="loading"></div>
          </div>
          
       </div>
       
        <div class="span-one-third">
          <h2>Social Feed</h2>
          <div id="foursquare">
            <div id="loadingfoursquare" class="loading"></div>
          </div>
<hr size=1 />
          <div id="meetup">
            <div id="loadingmeetup" class="loading"></div>
          </div>
        </div>
      </div>

      <footer>
        <p>&copy; Buildingly, 2011</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
