$(function(){
	var address= getURLParam('address');
	var city = getURLParam('city');
	var url = "bing_test.php?address="+address+"&city="+city;
	
    $.ajax({url: url,
    dataType:'text',
    success:function(data){getlocalinfo(data.split(':'));}});
    
    $('#mainpagesearchform').submit(function(e){
    	e.preventDefault();
    	$('#foursquare, #yipit, #ordr, #meetup').html('').end();
    	$('#loadingfoursquare, #loadingyipit, #loadingordr, #loadingmeetup').show();
    	
    	address = $('#address').val();
    	city = 'New York';
    	url = "bing_test.php?address="+address+"&city="+city;
    	
    	setTimeout(function(){
    		$.ajax({url: url,
    	    	  dataType:'text',
    	    	  success:function(data){
    	    		  getlocalinfo(data.split(':'));
    	    	  }
    	    	});
    	}, 1500);
    	
    });
});

function getlocalinfo(arrLatLon){
	
	$.ajax({url:"foursquare_test.php?lat="+arrLatLon[0]+"&long="+arrLatLon[1], 
	dataType:'html',
	success:function(data){$('#foursquare').append(data); $('#loadingfoursquare').hide();}});

	$.ajax({url:"yipit_test.php?lat="+arrLatLon[0]+"&long="+arrLatLon[1],
	dataType:'html',
	success:function(data){$('#yipit').append(data); $('#loadingyipit').hide();}});

	$.ajax({url:"ordr_test.php", 
	dataType:'html',
	success:function(data){$('#ordr').append(data); $('#loadingordr').hide();}});

	$.ajax({url:"meetup_test.php?lat="+arrLatLon[0]+"&long="+arrLatLon[1],
	dataType:'html',
	success:function(data){$('#meetup').append(data); $('#loadingmeetup').hide();}});
}

function getURLParam(strParamName){
	  var strReturn = "";
	  var strHref = window.location.href;
	  if ( strHref.indexOf("?") > -1 ){
	    var strQueryString = strHref.substr(strHref.indexOf("?")).toLowerCase();
	    var aQueryString = strQueryString.split("&");
	    for ( var iParam = 0; iParam < aQueryString.length; iParam++ ){
	      if (
	aQueryString[iParam].indexOf(strParamName.toLowerCase() + "=") > -1 ){
	        var aParam = aQueryString[iParam].split("=");
	        strReturn = aParam[1];
	        break;
	      }
	    }
	  }
	  return unescape(strReturn);
	}