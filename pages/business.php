<html>
	<head>
<style>
div.loading{background-image:url('http://www.careeravenues.in/Images/loadingGIF.gif');height:10em; width:10em;background-repeat:no-repeat;}
</style>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.js"></script>
		<script>
function getforum(type){
$('#openforumcontent').html('');
$('#loadingopenforum').css('display', '');
$.ajax({url:"../openforum_test.php?type="+type,
dataType:'html',
success:function(data){filldiv(data);}});
}
			function init(){
					$.ajax({url:"../openforum_test.php", 
					dataType:'html',
					success:function(data){filldiv(data);}});
			}
function filldiv(data){
$('#openforumcontent').html(data);
$('#loadingopenforum').css('display', 'none');
}
		</script>
	</head>
	<body onload="init()">
		<div id="openforum">
<input type="button" onclick="getforum('most-recent')" text="Most Recent" value="Most Recent" />
<input type="button" onclick="getforum('most-viewed')" value="Most Viewed" />
<input type="button" onclick="getforum('most-shared')" value="Most Shared" />
<input type="button" onclick="getforum('most-commented')" value="Most Commented" /> 
<div id="loadingopenforum" class="loading"></div>
<div id="openforumcontent"></div>
		</div>
	</body>
</html>
