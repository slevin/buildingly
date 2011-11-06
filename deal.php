<?php

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
    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>
    <style>
div.loading{background-image:url('http://www.careeravenues.in/Images/loadingGIF.gif');height:10em; width:10em;background-repeat:no-repeat;}
div.selectedtab{color:red;}

</style>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.js"></script>

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
$('#'+selectedtab+'tab').removeClass();
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

<div>Buldingly</div>
<div>Welcome Back, Albert's Deli</div>
<div>Profile Page | Deal Page</div>

<form method="post" action="/deal_post.php">
<table>
    <tr>
        <td>
            <div>
        What deal would you like to offer?<br />
            <textarea rows="5" cols="50">

            </textarea>
</div>
            <div>
            How can people access your deal?<br />
            <select>
                <option>In-Store</option>
                <option>Call Us</option>
                <option>Fax Us</option>
                <option>Go to the website for details</option>
                </select><br />
                <input type="text" />
            </div>

            <div>
            Date and time constraints for your deal:<br/>
            <input type="text"/><br />
            </div>

            <div>
            Do people need a coupon to access your deal?<br/>
            <select>
                <option>No</option>
                <option>Printed Coupon</option>
                <option>Secret Code</option>
            </select>
            </div>
        </td>

        <td>
            <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Deli+near+902+Broadway,+New+York,+NY&amp;aq=0&amp;sll=37.926868,-95.712891&amp;sspn=51.910431,77.34375&amp;vpsrc=0&amp;ie=UTF8&amp;hq=Deli&amp;hnear=902+Broadway,+New+York,+10010&amp;t=m&amp;ll=40.731519,-73.980753&amp;spn=0.006295,0.006295&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Deli+near+902+Broadway,+New+York,+NY&amp;aq=0&amp;sll=37.926868,-95.712891&amp;sspn=51.910431,77.34375&amp;vpsrc=0&amp;ie=UTF8&amp;hq=Deli&amp;hnear=902+Broadway,+New+York,+10010&amp;t=m&amp;ll=40.731519,-73.980753&amp;spn=0.006295,0.006295" style="color:#0000FF;text-align:left">View Larger Map</a></small>

            <div>
            Select radius for your deal:<br />
            <select>
                <option>1/4 mile</option>
                <option>1/2 mile</option>
                <option>1 mile</option>
                <option>3 miles</option>
                <option>Select Using Map</option>
            </select>
            </div>

            
        </td>

        <td>
		<div id="openforum">
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
</body>

</html>


