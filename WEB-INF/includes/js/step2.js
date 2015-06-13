function GetXmlHttpObject_ms()
{ 
	var objXMLHttp=null
	if (window.XMLHttpRequest)
	{
		objXMLHttp=new XMLHttpRequest()
	}
	else if(window.ActiveXObject)
	{
		objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
	}
	return objXMLHttp
}

function select_month(){
	document.step2.selected_date.value = "";
	document.step2.submit();
}

function select_day(id){
	if (document.step2.selected_date.value) { 
		document.getElementById(document.step2.selected_date.value).className = "cal_height_width cal_style_3 style_pointer";	
	} 
	if(document.getElementById(id)){
		document.step2.selected_date.value = id;
		document.getElementById(id).className = "cal_height_width cal_style_4";	
	}
}

function check_form(){
	if(document.step2.selected_date.value){
		document.step2.submit();	
	} else {
		alert("Please select a month and date you would like to book your ticket!")
	}
}

function Showdiv()
{
	if(xmlHttp.readyState == 4)
	{
		var retString = xmlHttp.responseText;		
		document.getElementById("replace_div_time").innerHTML = retString;
	}
}
function SelectedMenus(tour_id,selectDate,sesid)
{
	xmlHttp = GetXmlHttpObject_ms();
	var url = "departure_time.php";
	xmlHttp.open("POST", url, true);
	xmlHttp.onreadystatechange = Showdiv
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send("tour_id="+escape(tour_id)+"&selectDate="+escape(selectDate)+"&sid="+escape(sesid));
}
function Currency(amount)
{
 var i = parseFloat(amount);

 if(isNaN(i)) { i = 0.00; }

 i = Math.round( i * 100 ) / 100;

 i = i.toString();

 if ( i.indexOf( "." ) == -1 ) i+=".";

 var dPos = i.indexOf( "." );

 while( dPos != i.length - 3 ) {
   i+="0";
   dPos = i.indexOf( "." );
 }

  return i;

}

function select_departure(id, price){
		if(document.step2.number_of_people.value == "Charter"){
			document.step2.price.value = price;
			document.getElementById("total_cost").innerHTML = "<strong>&pound; "+ Currency(price)+"</strong>";				
		}else{
			document.step2.selected_departure.value = id;
		}
}

function check_form(){
	if(document.step2.selected_departure.value){
		document.step2.submit();	
	} else {
		//alert("Please select which one best suits your needs!");
		alert("Please select the day you wish to book your trip from the Calendar.");
	}
}
