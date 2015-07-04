function openwind(file_link, width, height, scrollbar) {
	var parameters;
	var winx = (screen.width - width) / 2;
    var winy = (screen.height - height) / 2;
	
	parameters = "width="+width+", height="+height+", top="+winy+", left="+winx+", status=no, scrollbars="+scrollbar;
	
	win = window.open(file_link,'view',parameters);
	win.window.focus();
}

function check_form(){
	if(document.step3.terms.checked==false){
		alert("Please confirm that you have read our Terms & Conditions.");
	} else if(document.step3.order_find.value=='0') {
		alert("Please select a suitable option from the dropdown!");
	} else {
		document.step3.submit();	
	}
}