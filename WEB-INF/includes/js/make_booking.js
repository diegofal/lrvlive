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

function isNumber(n) {
	return !isNaN(parseFloat(n)) && isFinite(n);
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

	for (i = 0; i < document.make_booking.elements.length; i++) {
		if(document.make_booking.elements[i].name != "charter" && document.make_booking.elements[i].type=="checkbox" && document.make_booking.elements[i].checked==true){       
			document.make_booking.elements[i-3].value= "1";
		} 
		if(document.make_booking.elements[i].name != "charter" && document.make_booking.elements[i].type=="checkbox" && document.make_booking.elements[i].checked==false){      
			document.make_booking.elements[i-3].value= "0";
		}
	}
	
	$('input[name="quantity[]"]').each(function() {
		var quantity = $(this).val(),
			price = $(this).next().val();		 
		if (isNumber(price) && 
				isnumeric(quantity, "Quantity only supports numeric characters.")) {
			total += quantity * price;
		}
	});
	
	$('input[name="total"]').val(Currency(total));
}

function set_fields(status, price){
	maxim = 0;
	for (i = 0; i < document.make_booking.elements.length; i++) {
		if(document.make_booking.elements[i].name == "order_title") maxim=i-1;
	}

	if (status==true) document.make_booking.total.value = Currency(price);
	else calculate_total();


	for (i = 0; i < maxim; i++) {
		if(document.make_booking.elements[i].name != "charter" && document.make_booking.elements[i].name != "total" && (document.make_booking.elements[i].type=="text" || document.make_booking.elements[i].type=="checkbox")){     
			document.make_booking.elements[i].value="";
			document.make_booking.elements[i].disabled=status;
		}
	}
}

function is_charter(price){
	if(document.make_booking.charter && document.make_booking.charter.checked==true){       
		//alert("Deactivate Ticket");
		set_fields(true, price);
	} else {
		set_fields(false, price);
	}
}

function is_bespoke() {
	if (!isFloat(document.make_booking.bespoke_price.value, "An error has occured! This field only supports numeric characters.")) {
		document.make_booking.bespoke_price.value = "";}
}

function calculate_seats(){
	var total = 0;
	for (i = 0; i < document.make_booking.elements.length; i++) {
		if(document.make_booking.elements[i].name == "seats[]"){        
			total += document.make_booking.elements[i].value * document.make_booking.elements[i-2].value;
		}
	}
	//alert(total);
	return total;
}

function check_form(free){

	// Added by Carlos
	if ($('input[name="quantity[]"]').length == 0 && $('input[type="checkbox"][name="charter"]').length ==0)
	{
		alert("The reserller form is not properly configured. In order to fix it go to settings->resellers menu.");
		return false;
	} 

	if (free < calculate_seats()) {
		alert("You chosed "+ calculate_seats() +" seats. There are only "+free+" free. Some seats might be blocked by other visitors. Please chose less seats or try another departure!");
	} else if(document.make_booking.charter && (document.make_booking.charter.checked==true || document.make_booking.total.value>0)){
		validate();
		if (returnVal) document.make_booking.submit();  
	} else if(Currency(document.make_booking.total.value) == '0.00') { 
		validate();
		if (returnVal) document.make_booking.submit(); 
	} else {
		alert("Pease specify the number of people for your voyage, as well as the ticket types you would like to purchase. If you would like to book a charter, please select this option below")
	}
}

function onChooseReseller() {
	if ('0' === document.getElementById('reseller_id').value) {
		alert('Please Choose from the list of resellers below');
		return false;
	}
	document.resellers.submit();
}