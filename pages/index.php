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
					$.ajax({url:"/foursquare_test.php", 
					dataType:'html',
					success:function(data){$('#foursquare').append(data); $('#loadingfoursquare').css('display', 'none');}});

					$.ajax({url:"/yipit_test.php", 
					dataType:'html',
					success:function(data){$('#yipit').append(data); $('#loadingyipit').css('display', 'none');}});

					$.ajax({url:"/ordr_test.php", 
					dataType:'html',
					success:function(data){$('#ordr').append(data); $('#loadingordr').css('display', 'none');}});

					$.ajax({url:"/openforum_test.php", 
					dataType:'html',
					success:function(data){$('#openforum').append(data); $('#loadingopenforum').css('display', 'none');}});
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
        </div>
      </div>

      <footer>
        <p>&copy; Buildingly, 2011</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
