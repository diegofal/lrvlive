function filter_tours()
{
	if(document.filter_form.filter.value)
		location.replace("boats.php?tour_id="+document.filter_form.filter.value);
}