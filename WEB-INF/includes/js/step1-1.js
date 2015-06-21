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
function isnumeric(text, text_alert) {
	valid = true;
	
	var sw_text;

	for(var j=0; j<text.length; j++) {
		if(isNaN(text.charAt(j))) {
			sw_text = 1;
			break;
		}
	}
	
	if((sw_text==1)) {
		valid = false;
		alert(text_alert);
		return valid;
	}
	
	return valid;
}



function set_fields(status, price){
	for (i = 0; i < document.step1.elements.length; i++) {
		if(document.step1.elements[i].name != "charter" && (document.step1.elements[i].type=="text" || document.step1.elements[i].type=="checkbox")){		
			if (document.step1.elements[i].name != "total")
			{
				document.step1.elements[i].value="";
				document.step1.elements[i].disabled=status;
			}
		}
	}
	if (status==true) 
	{
		var price_fee = parseFloat(document.step1.elements["price_fee"].value);
	
		document.getElementById("total_val").value = parseFloat(price) + price_fee;
		document.getElementById("tot_price").innerHTML = Currency( parseFloat(price) + price_fee);
	}
	else 
	{
		calculate_total();
	}
}

function is_charter(price){
	if(document.step1.charter.checked==true){		
		set_fields(true, price);
	} else {
		set_fields(false, price);
	}
}

function check_form(){
	if(document.step1.charter.checked==true || document.step1.total.value>0){
		
	    if ( document.getElementById('order_reseller_id') && '0' ==  document.getElementById('order_reseller_id').value) {
	       alert('Please specify type of booking.');
	    } else {
	   	   document.step1.submit();	
	    }
	} else {
		alert("Please specify the number of people for your voyage, as well as the ticket types you would like to purchase. If you would like to book a charter, please select this option below");
	}
}