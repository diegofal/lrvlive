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
	
	if (returnVal) {
		/* Check Quantity at least 1 */
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

	if(returnVal) document.voucher_step1.submit();	
	//return returnVal;
}