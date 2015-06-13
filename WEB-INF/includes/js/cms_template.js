function filter_tours()
{
	if(document.filter_form.filter.value)
		location.replace("template.php?tour_id="+document.filter_form.filter.value);
}