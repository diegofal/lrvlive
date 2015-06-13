var tick;

function stop() {clearTimeout(tick);}

function showTime()
{
	var ut=new Date();
	var h,m;
	var time="";
	h=ut.getHours();
	m=ut.getMinutes();
	if(m<=9) m="0"+m;
	if(h<=9) h="0"+h;
	document.getElementById('hours').value = h;
	document.getElementById('minutes').value = m;
	tick=setTimeout("showTime()",1000);
}



function getElementsByClassName(oElm, strTagName, oClassNames){
	var arrElements = (strTagName == "*" && oElm.all)? oElm.all : oElm.getElementsByTagName(strTagName);
	var arrReturnElements = new Array();
	var arrRegExpClassNames = new Array();
	if(typeof oClassNames == "object"){
		for(var i=0; i<oClassNames.length; i++){
			arrRegExpClassNames.push(new RegExp("(^|\\s)" + oClassNames[i].replace(/\-/g, "\\-") + "(\\s|$)"));
		}
	}
	else{
		arrRegExpClassNames.push(new RegExp("(^|\\s)" + oClassNames.replace(/\-/g, "\\-") + "(\\s|$)"));
	}
	var oElement;
	var bMatchesAll;
	for(var j=0; j<arrElements.length; j++){
		oElement = arrElements[j];
		bMatchesAll = true;
		for(var k=0; k<arrRegExpClassNames.length; k++){
			if(!arrRegExpClassNames[k].test(oElement.className)){
				bMatchesAll = false;
				break;
			}
		}
		if(bMatchesAll){
			arrReturnElements.push(oElement);
		}
	}
	return (arrReturnElements)
}
// ---

function isAValidEmail( emailField )
{ 
   // var emailregex=/^[\w]+\+?\w*@[\w]+\.[\w.]+\w$/; 
   var emailregex=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    var match=emailField.match( emailregex ); 
    if ( !match ) 
    { 
       return false; 
    }
    else
    {
       return true; 
    }
}

function isPhoneNumber(s) 
{

     // Check for correct phone number
	 var validPhoneDigits = '0123456789()-+';
	 var phoneLength = s.length;
	 
	for(var i=0; i < phoneLength; i++)
	 {
	   if(validPhoneDigits.indexOf(s.substr(i,1)) == '-1')
		{
		  var returnvar = false;
		  break;
		}
		else
		{
		  var returnvar = true;
		} 
		
	 }
	 return returnvar;
}
	 
function trim(str) 
	{ 
		return str.replace(/^\s*|\s*$/g,"");
	}

// Array support for the push method in IE 5
if(typeof Array.prototype.push != "function"){
	Array.prototype.push = ArrayPush;
	function ArrayPush(value){
		this[this.length] = value;
	}
}
// ---
/*
	Examples of how to call the function:
	
	To get all a elements in the document with a "info-links" class:
    getElementsByClassName(document, "a", "info-links");
    
	To get all div elements within the element named "container", with a "col" and a "left" class:
    getElementsByClassName(document.getElementById("container"), "div", ["col", "left"]);
*/
// ---




function tableruler()
{
	var b;
	if (document.getElementsByTagName)
	{
		var tables=document.getElementsByTagName('table');
		for (var i=0;i<tables.length;i++)
		{

			if(tables[i].className=='tl')
			{
				var trs=tables[i].getElementsByTagName('tr');
				var odd = true;
				for(var j=0;j<trs.length;j++)
				{
					if(trs[j].parentNode.nodeName=='TBODY')
					{
						if (odd && trs[j].parentNode.className != 'history') {trs[j].className=trs[j].className + ' stripped';}
						if (trs[j].parentNode.className != 'history') {odd = !odd;}
						trs[j].onmouseover=function(){this.className += ' ruled';}
						trs[j].onmouseout=function(){this.className = this.className.replace(/(\s)?(ruled)/g,'');}
					}
				}
			}
		}
		var inp=document.getElementsByTagName('input');
		for (var i=0;i<inp.length;i++)
		{
			if (inp[i].getAttribute('type')=='text')
			{
				inp[i].onfocus = function () {setRowSelected(this);};
				inp[i].onchange = function () {validate(this);};
				inp[i].onkeyup = function () {validate(this);};
				inp[i].onblur = function () {validate(this);};
			}
		}

		var tbodies=document.getElementsByTagName('tbody');
		for (var i=0;i<tbodies.length;i++)
		{
			if (tbodies[i].className.match(/history/g))
			{
				var trs = tbodies[i].getElementsByTagName('tr');
				var hodd = true;
				for (var j=0;j<trs.length;j++)
				{
					if (trs.length>1)
					{
						if (j==0)
						{
							var tds = trs[j].getElementsByTagName('td');
							for (k=0; k<tds.length;k++)
							{
								tds[k].className += ' firstRow';
							}
						}
						if (j==((trs.length)-1))
						{
							var tds = trs[j].getElementsByTagName('td');
							for (k=0; k<tds.length;k++)
							{
								tds[k].className += ' lastRow';
							}
						}
						
						if (hodd) {trs[j].className += ' stripped';};
						hodd = !hodd;
					}
					else
					{
						var tds = trs[j].getElementsByTagName('td');
						for (k=0; k<tds.length;k++)
						{
							tds[k].className += ' onlyRow';
						}
					}
				}
			}
		}
	}
}

function setRowSelected(input)
{
	var isSelectedRow = input.parentNode.parentNode.parentNode.className.match(/(\s)?(rowSelected)/g)
	if (!isSelectedRow)
	{
		if (document.getElementById('order') != null)
			document.getElementById('order').reset();

		var selectedRows = getElementsByClassName(document, "tr", "rowSelected");
		if (selectedRows[0]) {selectedRows[0].className = selectedRows[0].className.replace(/(\s)?(rowSelected)/g,'');}
		
		input.parentNode.parentNode.parentNode.className += ' rowSelected';
	}
}

function validate(input)
{
	//var seats = /\D/;
	//if (seats.test(input.value)) 
	//{
	//	input.value = input.value.replace(/\D*/g,'');
	//}
}

function validateForm(button, adult, kid, total, checkzeros)
{
	document.forms['order'].job.value = button.name;
	
	
	var adult = document.getElementById(adult);
	var kid = document.getElementById(kid);

   if(adult)
    {
	validate(adult);
	}
	if(kid)
    {
	validate(kid);
	}

	if (adult && adult.value!='') {var val1 = parseInt(adult.value);} else val1 = 0;
	if (kid && kid.value!='') {var val2 = parseInt(kid.value);} else val2 = 0;

	var sum =  val1 + val2;

	if (sum > total)
	{
		alert('There are not enough seats!');
	}
	else
	{
		if (checkzeros && sum == 0) 
		{
			alert('Nothing to submit');
		}
		else
		{
			document.forms['order'].submit();
		}
	}

}

function validateBooking()
{
	//document.forms['order'].job.value = button.name;
	var total = document.popup_form.total.value; 
	var checkzeros = 1;   
	
	var adult = document.popup_form.adult;
	var kid   = document.popup_form.kid;

    if(trim(document.popup_form.name.value) == "")
	  {
		 alert("Please enter name.");
		 document.popup_form.name.focus();
		 return false;
	  }
	  
   if(trim(document.popup_form.mobile.value) == "")
	  {
		 alert("Please enter mobile.");
		 document.popup_form.mobile.focus();
		 return false;
	  }  
	  
   if(!isPhoneNumber(document.popup_form.mobile.value))
      {
		 alert("Please enter valid mobile number.");
		 document.popup_form.mobile.focus();
		 return false;		  
	  }
	  
   if(trim(document.popup_form.email.value) == "")
	  {
		 alert("Please enter email.");
		 document.popup_form.email.focus();
		 return false;
	  } 
	  
   if(!isAValidEmail(document.popup_form.email.value))
      {
		 alert("Please enter valid email address.");
		 document.popup_form.email.focus();
		 return false; 
	  }
	  
	

   if(adult)
    {
	validate(adult);
	}
	if(kid)
    {
	validate(kid);
	}
    if (adult && adult.value!='') {var val1 = parseInt(adult.value);} else val1 = 0;
	if (kid && kid.value!='') {var val2 = parseInt(kid.value);} else val2 = 0;

	var sum =  val1 + val2;
    var tot = parseInt(total);
	if (sum > tot)
	{
		alert('There are not enough seats!');
		document.popup_form.adult.focus();
		return false;
		
	}
	else
	{
		if (sum == 0) 
		{
			alert('Nothing to submit');
			return false;
		}
    }
           return true; 

}

function validateBooking_add()
{	
    if(trim(document.popup_form.first_name.value) == "")
	  {
		 alert("Please enter first name.");
		 document.popup_form.first_name.focus();
		 return false;
	  }
    
    if(trim(document.popup_form.last_name.value) == "")
	  {
		 alert("Please enter last.");
		 document.popup_form.last_name.focus();
		 return false;
	  }
	  
   if(trim(document.popup_form.mobile.value) == "")
	  {
		 alert("Please enter mobile.");
		 document.popup_form.mobile.focus();
		 return false;
	  }  
	  
   if(!isPhoneNumber(document.popup_form.mobile.value))
      {
		 alert("Please enter valid mobile number.");
		 document.popup_form.mobile.focus();
		 return false;		  
	  }
	  
   if(trim(document.popup_form.email.value) == "")
	  {
		 alert("Please enter email.");
		 document.popup_form.email.focus();
		 return false;
	  } 
	  
   if(!isAValidEmail(document.popup_form.email.value))
      {
		 alert("Please enter valid email address.");
		 document.popup_form.email.focus();
		 return false; 
	  }
	 
   return true; 

}


function appendInputTypeClasses()
{
	if ( !document.getElementsByTagName ) return;
	var inputs = document.getElementsByTagName('input');
	var inputLen = inputs.length;
	for (var i=0; i<inputs.length; i++)
	{
		if (inputs[i].getAttribute('type')) inputs[i].className += ' ' + inputs[i].getAttribute('type');
	}
}


function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++)
	{
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}
	

function displayLeftMenu()
{

	if (document.getElementById)
	{
		var lmenu=document.getElementById('leftMenu');
		if (lmenu.className == 'leftMenu')
		{
			lmenu.className = 'hidden';
			createCookie('displaymenu', '0', 7);
		}
		else {
			lmenu.className = 'leftMenu';
			createCookie('displaymenu', '1', 7);
		}
	}	
}

function toggleHistory(clickedTbody, hId)
{
	var hist = document.getElementById(hId);
	var show = hist.style.display!='';
	var clickedTbody = clickedTbody.parentNode.parentNode.parentNode;

	var tbodies = document.getElementsByTagName('tbody');
	for (var i=0;i<tbodies.length;i++)
	{
		if(tbodies[i].className=='history') {tbodies[i].style.display = 'none';};
		if(tbodies[i].className=='openDeparture') {tbodies[i].className = '';}
	}

	hist.style.display = (show)?'' : 'none';

	document.getElementById('openHistoryId').value =  (show)? hId : '';
	

	clickedTbody.className = (show)?'openDeparture' : '';

}

var pageRefresh;
function monitor()
{
	clearTimeout(pageRefresh);
	pageRefresh = setTimeout ("document.forms['refresh'].submit()", 120000);
}

window.onload = function()
{
	tableruler();
	appendInputTypeClasses();
	showTime();
	monitor();
	var obody = document.getElementsByTagName('body');

	obody[0].onkeyup = function() {monitor()};
	obody[0].onmousemove = function() {monitor()};
	obody[0].onclick = function() {monitor()};
}

window.onunload = function() {stop();};
function sendlinktoadd(sndurl)
{
	 location.replace(sndurl);
}

function Backlink(sendurl)
{
	 location.replace(sendurl);
}


var baseText = null; 
function showPopup(w,h,depid,tot,tourid,aprice,cprice,entrydated)
{   
var popUp = document.getElementById("popupcontent");    
popUp.style.display="";
popUp.style.top = "200px";   
popUp.style.left = "400px";   
popUp.style.width = w + "px";   
popUp.style.height = h + "px";    
if (baseText == null) 
baseText = popUp.innerHTML;   
popUp.innerHTML = baseText + "<div id=\"statusbar\"><button onclick=\"hidePopup();\">Close window</button></div>";  

document.getElementById("total").value   = tot;
document.getElementById("dep_id").value  = depid;
document.getElementById("tour_id").value = tourid;
document.getElementById("adult_price").value = aprice;
document.getElementById("child_price").value = cprice;
document.getElementById("ddate").value = entrydated;


var sbar = document.getElementById("statusbar");   
sbar.style.marginTop = (parseInt(h)-40) + "px";   
popUp.style.visibility = "visible";
}

function showPopupnew(w,h,vdate)
{   
$("#popupcontent1").show();
$("#popupcontent1").center();
}

function hidePopup(curdate)
{   
    var popUp = document.getElementById("popupcontent1");   
	popUp.style.display = "none";
   // location.href = "booking.php?vdate="+curdate; 	
}
function HidePopups()
{   
	var popUp = document.getElementById("popupcontent");   
	popUp.style.display = "none";
	
}