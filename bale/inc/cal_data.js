var xmlHttp

function showUser(str,tours,curdate,curyear)
{ 
var changestate = document.getElementById("change").value;
	if(changestate == 0)
	{
		document.getElementById("change").value = 1; 
		xmlHttp=GetXmlHttpObject()
		if (xmlHttp==null)
		 {
		 alert ("Browser does not support HTTP Request")
		 return
		 }
		 
		document.getElementById("txtHint").innerHTML="<table><tr><td><img src='img/progress.gif'></td></tr></table>";
		document.getElementById("changedate").innerHTML="<a href='booking.php?vdate="+str+"' id='changedate' class='date_heading'>CLICK HERE TO BOOK THIS DAY</a><br /><span id='textdate' class='t3'>"+curdate+"</span>";
		
		var url="calender_data.php";
		url=url+"?caldate="+str;
		url=url+"&tours="+tours;
		url=url+"&curyear="+curyear;
		url=url+"&sid="+Math.random();
		xmlHttp.onreadystatechange=stateChanged; 
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
}
function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 document.getElementById("txtHint").innerHTML=xmlHttp.responseText
 document.getElementById("change").value = 0; 
 } 
}

function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}