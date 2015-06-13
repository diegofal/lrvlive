<html>
<head>
<title>Booking</title>
<link href="../WEB-INF/assets/css/site-styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/make_booking.js"></script>
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/validation.js"></script>	
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/macromedia.js"></script>	

<body>
<br />
<div style="position: relative; top: 30%; left: 40%;">
<div class="content-formatting"><strong>Please, select reseller:</strong></div>
<form name="resellers" method="post" action="make_booking.php?tour_id={$smarty.get.tour_id}&departure_id={$smarty.get.departure_id}&free={$smarty.get.free}">
<select name="reseller_id" id="reseller_id" class="booking-cell107" style="width:180px;">
<option value="0">Choose Reseller Below</option>
<option value="-1">LRV</option>
{section name=i loop=$resellers}
<option value="{$resellers[i].reseller_id}">{$resellers[i].reseller_name}</option>
{/section}
</select><br><br>
<a href="#" onclick="return onChooseReseller();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image32','','../WEB-INF/assets/images/booking/button-proceed-on.gif',1)"><img src="../WEB-INF/assets/images/booking/button-proceed-off.gif" name="Image32" width="107" height="32" border="0"></a></div>
</form>
</body>
</head>