function filter_orders(order)
{
	if(document.filter_form.filter.value)
		location.replace("orders.php?order="+order+"&filter="+document.filter_form.filter.value);
}

function view_ticket(code) {
	eval("window.open('view_html_ticket.php?code='+code,'', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=700,height=700');");
}

