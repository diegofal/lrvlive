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
	if (true) {};
	return valid;
}
function countryChange(){
	if ($('#country').val() == 'US') {$('#stateDiv').css('display', 'block')} else { $('#stateDiv').css('display', 'none') };
}

$( document ).ready(function() {
	if ($('#country').val() == 'US') {$('#stateDiv').css('display', 'block')} else { $('#stateDiv').css('display', 'none') };
});
function check_input(){

	for (i = 0; i < document.voucher_step1.elements.length; i++) {
		if(document.voucher_step1.elements[i].name == "quantity[]" 
			&& document.voucher_step1.elements[i].value) {
			if(!isnumeric(
				document.voucher_step1.elements[i].value, 
				"An error has occured! This field only supports numeric characters.")){				
				document.voucher_step1.elements[i].value = "";
			}			
		}
	}

}

function check_form(){
	validate();
	/*try {
		if (document.voucher_step1.voucher_order_name.value == '') throw("Please type your name");
		if (document.voucher_step1.voucher_order_lastname.value == '') throw("Please type your Surname");
		if (document.voucher_step1.order_phone.value == '') throw("Please type your phone");
		if (document.voucher_step1.order_email.value == '') throw("Please type your email");
		if (document.voucher_step1.voucher_order_city.value == '') throw("Please type your city");
		if (document.voucher_step1.voucher_order_address1.value == '') throw("Please type your address");
		if (document.voucher_step1.voucher_order_postcode.value == '') throw("Please type your Post code or 0");
		if (document.voucher_step1.voucher_order_email.value == '') throw("Please type your Email");
		if (document.voucher_step1.voucher_order_phone.value == '') throw("Please type your Phone");
		if (document.voucher_step1.voucher_order_to.value == '') throw("Please type Name of person to receive this Voucher");
		if (document.voucher_step1.voucher_order_phone_to.value == '') throw("Please type Phone of person to receive this Voucher");
		if (document.voucher_step1.voucher_order_name_to.value == '') throw("Please type Name of person to be posted to");
		if (document.voucher_step1.voucher_order_address1_to.value == '') throw("Please type Address of where the voucher is to be posted");
		if (document.voucher_step1.voucher_order_message.value == '') throw("Please type Message from sender");
	}
	catch (err){
		alert(err);
		return;
	}
*/
	/*
	if (returnVal) {
		//Check Quantity at least 1
		var total_quantity = 0;
		for (i = 0; i < document.voucher_step1.elements.length; i++) {
			if(document.voucher_step1.elements[i].name == "quantity[]" 
				&& document.voucher_step1.elements[i].value) 
				if(isnumeric(
					document.voucher_step1.elements[i].value, 
					"Sorry, quantity fields only supports numeric characters.")){
					total_quantity += document.voucher_step1.elements[i].value;				
				} else {
					document.voucher_step1.elements[i].value = "";
				}			
		}
		if (total_quantity < 1) {
			alert("You have to enter the quantity of tickets you want to purchase.")
			returnVal = false;
		}
	}
*/
	if(returnVal) document.voucher_step1.submit();	
	//return returnVal;
}