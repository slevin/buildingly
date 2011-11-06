<?php
if($_POST){
	session_start();
	//print_r($_POST);
	$_SESSION['deal'] = $_POST['deal'];
}
?>
<html>
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
    <link href="bootstrap.css" rel="stylesheet">
    <link href="/jquery-ui-1.7.3.custom/css/ui-lightness/jquery-ui-1.7.3.custom.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>
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
              padding-left: 10px;
              padding-right: 10px;
          }
          .restaurantname {
              font: 12pt Helvetica, arial;
              color: #f45604
          }
          .content-main{ width: 940px; margin:0px auto;}
          input,textarea,select{width: 320px;}
          .openforumtitle a{color: #DF530A}
          .openforumtitle{padding: 0px;}
          #nav{margin-bottom: 20px;}
          .searchbar {
              width: 530px;
              background: url('/assets/search_bar.png') no-repeat;
              height:52px;
              border:none;
              font-size: 24px;
              padding-left: 10px;
              padding-bottom:6px;
          }
          .searchbutton {
              padding: 0px; 0px; 0px; 0px;
              width:54px;
              height: 53px;
              background:url('/assets/search_button.png') no-repeat;
          }
      </style>
    <style>
div.loading{background-image:url('http://www.careeravenues.in/Images/loadingGIF.gif');height:10em; width:10em;background-repeat:no-repeat;}
div.selectedtab{color: #DF530A}
div.tabselector{display: inline-block}
</style>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.js"></script>
	<script type="text/javascript" src="/jquery-ui-1.7.3.custom/js/jquery-ui-1.7.3.custom.min.js"></script>
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

		<script>

var selectedtab;

function gototab(type){
if (type != selectedtab)
{
$('#'+selectedtab+'tab').removeClass('selectedtab');
$('#'+selectedtab+'content').css('display', 'none');
selectedtab = type;
$('#'+selectedtab+'tab').addClass('selectedtab');
if ($('#'+selectedtab+'content').html() == ''){
$('#loadingopenforum').css('display','');
} else {
$('#'+selectedtab+'content').css('display', '');
}
}
}

function getforum(type){
$('#openforumcontent').html('');
$('#loadingopenforum').css('display', '');
$.ajax({url:"../openforum_test.php?type="+type,
dataType:'html',
success:function(data){filldiv(data);}});
}

			function init(){
				$('.tabselector').tabs();
gototab('most-recent');
callajax("most-recent");

setTimeout('callajax("most-viewed")', 1000);
setTimeout('callajax("most-commented")', 2000);
setTimeout('callajax("most-shared")',3000);
			}

function callajax(type){
$.ajax({url:"../openforum_test.php?type="+type,
dataType:'html',
success:function(data){filldiv(data, type);}});
}

function filldiv(data, type){
$('#'+type+'content').html(data);
if (type == selectedtab){
$('#loadingopenforum').css('display', 'none');
$('#'+type+'content').css('display', '');
}
}
		</script>

</head>

<body onload="init()">

<div class="header_bar">
        <div style="position: absolute; left: 130px; top: 50px;">
            <img src="/assets/buildingly_logo_new.png">
        </div>
        <div style="position: absolute; left: 400px; top: 55px; width: 700px;"><div style="position: relative;">
            <input type="text" value="902 Broadway, New York, NY" class="searchbar" size="100">&nbsp;
            <button style="position: absolute; left: 500px;" class="searchbutton"></button>
             </div>

        </div>
    </div>
<div clas="wrapper">
<div class="content-main">
<form method="post" action="/deal_post.php">
<table>
    <tr>
        <td width="450px">
            <div>
        What deal would you like to offer?<br />
            <textarea rows="5" cols="50" id="desc" name="desc">

            </textarea>
</div>
            <div>
            How can people access your deal?<br />
            <select id="pick-up" name="pick-up">
                <option>In-Store</option>
                <option>Call Us</option>
                <option>Fax Us</option>
                <option>Go to the website for details</option>
                </select>
            </div>
			
            <div>
            Date and time constraints for your deal:<br/>
            <input type="text" id="constraints" name="constraints"/>
            </div>
            <div>
            	<p>How much does it cost?</p>	
            	<input type="text" id="price" name="price"/>
            </div>
            <div>
            	<p>What do you usually charge for it?</p>	
            	<input type="text" id="worth" name="worth"/>
            </div>
        </td>

        <td>
            <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Deli+near+902+Broadway,+New+York,+NY&amp;aq=0&amp;sll=37.926868,-95.712891&amp;sspn=51.910431,77.34375&amp;vpsrc=0&amp;ie=UTF8&amp;hq=Deli&amp;hnear=902+Broadway,+New+York,+10010&amp;t=m&amp;ll=40.731519,-73.980753&amp;spn=0.006295,0.006295&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Deli+near+902+Broadway,+New+York,+NY&amp;aq=0&amp;sll=37.926868,-95.712891&amp;sspn=51.910431,77.34375&amp;vpsrc=0&amp;ie=UTF8&amp;hq=Deli&amp;hnear=902+Broadway,+New+York,+10010&amp;t=m&amp;ll=40.731519,-73.980753&amp;spn=0.006295,0.006295" style="color:#0000FF;text-align:left">View Larger Map</a></small>
            
        </td>
</tr>
        <tr>
        <td colspan="2">
        <h3>American Express Open Articles</h3>
		<div id="openforum">
		<div id="nav">
<div id="most-recenttab" class="tabselector" onclick="gototab('most-recent')">
Most Recent
</div>
<div id="most-viewedtab" class="tabselector" onclick="gototab('most-viewed')">
Most Viewed
</div>
<div id="most-sharedtab" class="tabselector" onclick="gototab('most-shared')">
Most Shared
</div>
<div id="most-commentedtab" class="tabselector" onclick="gototab('most-commented')">
Most Commented
</div>
</div>
<div id="loadingopenforum" class="loading"></div>
<div id="most-recentcontent" style="display:none"></div>
<div id="most-viewedcontent" style="display:none"></div>
<div id="most-sharedcontent" style="display:none"></div>
<div id="most-commentedcontent" style="display:none"></div>
		</div>

        </td>

    </tr>
</table>
</form>
</div>
</div>
</body>

</html>


