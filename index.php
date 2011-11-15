<?php
session_start();
$address = isset($_POST['address']) ? htmlentities($_POST['address']) : '';
$city = isset($_POST['city']) ? htmlentities($_POST['city']) : 'New York';
if(!isset($_SESSION['address'])){
  $_SESSION['address'] = $address;
}
if($_POST){
	header('Location: /');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Buildingly</title>
    <meta name="description" content="buildingly">
    <meta name="author" content="buildingly">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.js"></script>
	<script type="text/javascript" src="/js/script.js"></script>
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
  </head>
  
<?php if (isset($_SESSION['address'])):?>
  <body>
    <div class="header_bar">
        <a id="logo" href="/"></a>
        <div style="position:absolute; left:400px; top:55px; width: 700px;">
          <div style="position:relative;">
            <form id="mainpagesearchform">
              <input size="100" class="searchbar" name="address" id="address" type="text" value="<?php echo $_SESSION['address']; ?>"/>
              <button class="searchbutton deals" type="submit"></button>
            </form>
          </div>
        </div>
    </div>
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
      
        <div class="span-one-third" style="border: none;">
          <h2>DELIVERY NEARBY</h2>
          <div id="loadingordr" class="loading"></div>
          <div id="ordr"></div>
        </div>
        
        <div class="span-one-third" style="border: none;">
          <h2>DEALS NEARBY</h2>
          <div id="loadingyipit" class="loading"></div>
          <div id="yipit"></div>
       </div>
       
        <div class="span-one-third" style="border: none;">
          <h2>EVENTS NEARBY</h2>
          <!--  <div id="loadingfoursquare" class="loading"></div>
          <div id="foursquare"></div> -->
          <div id="loadingmeetup" class="loading"></div>
          <div id="meetup"></div>
          <div id="loadingeventbrite" class="loading"></div>
          <div id="eventbrite"></div>
        </div>
      </div>

      <footer>
        <p>&copy; Buildingly, 2011</p>
      </footer>

    </div> <!-- /container -->

  </body>
<?php else: ?>
  <body class="searchpage">
	<form method="post" action="/" id="addressSearch">
	  <div style="position: relative; left: 70px; top: 235px; width: 700px;">
	    <input id="address" name="address" size="100" class="searchbar" type="text" value="902 Broadway" />
	    <input type="hidden" name="city" value="New York" />
	    <button class="searchbutton" type="submit" style="position:absolute; left: 500px;"></button>
	  </div>
	</form>
  </body>
<?php endif; ?>
</html>