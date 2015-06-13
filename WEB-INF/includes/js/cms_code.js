function view_ticket(code) {
	eval("window.open('view_html_ticket.php?code='+code,'', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=700,height=700');");
}

function view_voucher_details(code) {
	eval("window.open('view_voucher_details.php?code='+code,'', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=700,height=700');");
}

function view_html_voucher(code) {
	eval("window.open('/vouchers/'+code+'.html','', 'toolbar=1,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=1024,height=700');");
}

function view_pdf_voucher(code) {
	eval("window.open('/vouchers/'+code+'.pdf','', 'toolbar=1,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=1024,height=700');");
}



