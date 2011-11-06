<?php 
session_start();
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
    <link href="/bootstrap.css" rel="stylesheet">
    <link href="/buldingly.css" rel="stylesheet">
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
					$.ajax({url:"foursquare_test.php", 
					dataType:'html',
					success:function(data){$('#foursquare').append(data); $('#loadingfoursquare').css('display', 'none');}});

					$.ajax({url:"yipit_test.php", 
					dataType:'html',
					success:function(data){$('#yipit').append(data); $('#loadingyipit').css('display', 'none');}});

					$.ajax({url:"ordr_test.php", 
					dataType:'html',
					success:function(data){$('#ordr').append(data); $('#loadingordr').css('display', 'none');}});

					$.ajax({url:"meetup_test.php", 
					dataType:'html',
					success:function(data){$('#meetup').append(data); $('#loadingmeetup').css('display', 'none');}});
			});
		</script>
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

      <style>
         .header_bar {
    height:176px;
    background-image: url('/assets/header_bar.png');
    background-repeat: repeat-x;
}       body {
             background-color: #f5f4ef;
             margin-top: 0px;
             padding-top: 0px;
         }
        .container {
            width: 1000px;
            background-image: url('/assets/content_bg.png');
            background-repeat: repeat-y;
            padding-top: 20px;
        }
        .title_main {
            font-family: Helvetica;
            font-size: 18pt;
            color: #f45604;
        }
        .title_sub {
            font: 10pt Helvetica;
            color: darkgray;
        }

          h2 {
              font: 18pt Helvetica, arial;
              color: #3f454b;
              margin-bottom: 20px;
          }
          .span-one-third {
              padding-left: 20px;
              padding-right: 20px;
          }

          .restaurantname {
              font: 12pt Helvetica, arial;
              color: #f45604
          }
      </style>
  </head>

  <body>
  <!--
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
    -->
    <div class="header_bar">
        <div style="position:absolute;left:150px;top:70px;">
        <span class="title_main">BUILDINGLY</span><br />
        <span class="title_sub">WHAT'S NEAR YOUR BUILDING</span>
        </div>
    </div>
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
      
        <div class="span-one-third" style="border: none;">
          <h2>DELIVERY NEARBY</h2>
            <select><option>Food Type</option></select><br /><br />
          <div id="ordr">
            <div id="loadingordr" class="loading"></div>
          </div>
          <p><a class="btn primary large" href="#">View Details &raquo;</a></p>
        </div>
        
        <div class="span-one-third" style="border: none;">
          <h2>DEALS NEARBY</h2>
          <div id="yipit">
            <div id="loadingyipit" class="loading"></div>
          </div>
          
       </div>
       
        <div class="span-one-third" style="border: none;">
          <h2>SOCIAL FEEDS</h2>
          <div id="foursquare">
            <div id="loadingfoursquare" class="loading"></div>
          </div>
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
