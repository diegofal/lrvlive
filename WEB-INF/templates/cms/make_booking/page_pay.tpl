<html>
<head>
<title>Booking</title>
<body onLoad="document.pay.submit();">
<form name="pay" method="post" action="{$vspsite}">
	<INPUT TYPE="hidden" NAME="VPSProtocol" VALUE="2.22">
	<INPUT TYPE="hidden" NAME="TxType" VALUE="PAYMENT">
	<INPUT TYPE="hidden" NAME="Vendor" VALUE="londonribvoyage">
	<INPUT TYPE="hidden" NAME="Crypt" VALUE="{$crypt}">
</form>
</body>
</head>