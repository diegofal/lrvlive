function filter_resellers()
{
	if(document.filter_form.filter.value)
		location.replace("reseller_offers.php?reseller_id="+document.filter_form.filter.value);
}