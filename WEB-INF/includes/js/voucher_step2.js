function check_form(){
	if(document.voucher_step2.confirm.checked==false){
		alert("Please confirm that you have read our Terms & Conditions.");
	} else {
		document.voucher_step2.submit();	
	}
}