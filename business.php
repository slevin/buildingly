<html>
	<head>
<style>
div.loading{background-image:url('http://www.careeravenues.in/Images/loadingGIF.gif');height:10em; width:10em;background-repeat:no-repeat;}
div.selectedtab{color:red;}
</style>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.js"></script>
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
$.ajax({url:"/penforum_test.php?type="+type,
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
$.ajax({url:"openforum_test.php?type="+type,
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
	</body>
</html>
