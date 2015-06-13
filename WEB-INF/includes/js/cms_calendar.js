function filter_tours(back_url)
{
	if(document.departure.filter.value)
		location.replace("calendar.php?tour_id="+document.departure.filter.value+back_url);
}

function view_ticket(code) {
	eval("window.open('view_html_ticket.php?code='+code,'', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=700,height=700');");
}