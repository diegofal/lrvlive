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

function isFloat( text, text_alert ) {
 
 if( isNaN( text ) ) {
  alert( text_alert );
  return false;
 }    
 return true;

}

function calculate_total(){
	var total = 0;

	/*for (i = 0; i < document.edit_ticket.elements.length; i++) {
		if(document.edit_ticket.elements[i].name != "charter" && document.edit_ticket.elements[i].type=="checkbox" && document.edit_ticket.elements[i].checked==true){		
			document.edit_ticket.elements[i-3].value= "1";
		} 
		if(document.edit_ticket.elements[i].name != "charter" && document.edit_ticket.elements[i].type=="checkbox" && document.edit_ticket.elements[i].checked==false){		
			document.edit_ticket.elements[i-3].value= "0";
		}
	}*/		

	for (i = 0; i < document.edit_ticket.elements.length; i++) {
		if(document.edit_ticket.elements[i].name == "quantity[]" && document.edit_ticket.elements[i].value) 
			if(isnumeric(document.edit_ticket.elements[i].value, "An error has occured! This field only supports numeric characters.")){
				//alert(document.edit_ticket.elements[i].value);
				total += parseInt(document.edit_ticket.elements[i].value)*parseFloat(document.edit_ticket.elements[i+1].value);
			} else {
				document.edit_ticket.elements[i].value = "";
			}		
		//alert(total);
	}
	document.edit_ticket.total.value = Currency(total);
}

function set_fields(status, price){
	maxim = 0;
	for (i = 0; i < document.edit_ticket.elements.length; i++) {
		if(document.edit_ticket.elements[i].name == "order_title") maxim=i-1;
	}
	document.edit_ticket.total.value = Currency(price);
	for (i = 0; i < maxim; i++) {
		if(document.edit_ticket.elements[i].name != "charter" && document.edit_ticket.elements[i].name != "total" && (document.edit_ticket.elements[i].type=="text" || document.edit_ticket.elements[i].type=="checkbox")){		
			document.edit_ticket.elements[i].value="";
			document.edit_ticket.elements[i].disabled=status;
		}
	}
}

function is_charter(price){
	if(document.edit_ticket.charter && document.edit_ticket.charter.checked==true){	
		//alert("Deactivate Ticket");
		set_fields(true, price);
	} else {
		set_fields(false, price);
		calculate_total();
	}
}

function is_bespoke() {
if (!isFloat(document.edit_ticket.bespoke_price.value, "An error has occured! This field only supports numeric characters.")) {
document.edit_ticket.bespoke_price.value = "";}
}

function calculate_seats(){
	var total = 0;
	for (i = 0; i < document.edit_ticket.elements.length; i++) {
		if(document.edit_ticket.elements[i].name == "seats[]"){		
			total += document.edit_ticket.elements[i].value * document.edit_ticket.elements[i-2].value;
		}
	}
	return total;
}

function check_form(free){
	//aic mai trebuie verificat daca exista numarul de locuri specificat
	if (free < calculate_seats()) {
		alert("You chosed "+ calculate_seats() +" seats. There are only "+free+" free. Some seats might be blocked by other visitors. Please chose less seats or try another departure!");
	} else if((document.edit_ticket.charter && document.edit_ticket.charter.checked==true) || document.edit_ticket.total.value>0) {
		validate();
		if (returnVal) document.edit_ticket.submit();	
	 } else if(Currency(document.edit_ticket.total.value) == '0.00') { 
		document.edit_ticket.submit(); 	
	} else {
		alert("Pease specify the number of people for your voyage, as well as the ticket types you would like to purchase. If you would like to book a charter, please select this option below")
	}
	
}
