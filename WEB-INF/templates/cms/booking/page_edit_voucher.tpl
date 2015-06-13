<html>
<head>
<title>Edit Voucher</title>
<link href="../WEB-INF/assets/css/site-styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/edit_ticket.js"></script>
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/validation.js"></script>	
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/macromedia.js"></script>	
{literal}
<script language="javascript">
<!--
function init_address() {

	define('voucher_order_to', 'string', 'Name of person to receive this Voucher:',3, 50);
	define('voucher_order_phone_to', 'string', 'Phone number of receiver',8);
	define('voucher_order_email', 'email', 'Email',6);
	define('voucher_order_name', 'string', 'Name of sender',4);
	define('voucher_order_phone', 'string', 'Telephone of sender',8);
	define('voucher_order_name_to', 'string', 'Name of the person of who it is to be posted',4);
	define('voucher_order_address1_to', 'string', 'Address of where the voucher is to be posted',10);
	define('voucher_order_message', 'string', 'Message from sender',4);
	define('voucher_order_number', 'string', 'Voucher No', 15, 16);
	define('voucher_order_total', 'num', 'Total');

}
-->
</script>
{/literal}	
<body onLoad="init_address();">
<br />
<h1>{$tour.tour_name} : Edit voucher to {$voucher_order.voucher_order_to}</h1>
<form name="edit_voucher" method="post" action="edit_voucher.php">
<input type="hidden" name="tour_id" value="{$tour_id}">

				<table width="100%" bvoucher_order="0" cellspacing="2" cellpadding="2">
				  <tr>
				  	<td colspan="2" class="content-formatting">Please fill out the form below. Fields marked with (*) represents required information.<br></td>
				  </tr>
				  <tr>
					<td><img src="../WEB-INF/assets/images/utils/spacer.gif" width="22" height="7"></td>
				  </tr>
				  <tr>
					<td width="25%" class="content-formatting"><div align="left"><strong>*Name of person to receive this Voucher: </strong></div></td>
					<td width="75%"><input name="voucher_order_to" value="{$voucher_order.voucher_order_to}"  maxlength="50" type="text" class="booking-cell" size="25"></td>
				  </tr>
				  <tr>
					<td class="content-formatting"><div align="left"><strong>*Phone number of receiver: </strong></div></td>
					<td><input name="voucher_order_phone_to" value="{$voucher_order.voucher_order_phone_to}" maxlength="50" type="text" class="booking-cell" size="25"></td>
				  </tr>
				  <tr>
					<td class="content-formatting"><div align="left"><strong>*Email of sender:</strong></div></td>
					<td><input name="voucher_order_email" value="{$voucher_order.voucher_order_email}" maxlength="16" type="text" class="booking-cell" size="25"></td>
				  </tr>
				  <tr>
					<td class="content-formatting"><div align="left"><strong>*Name of sender: </strong></div></td>
					<td><input name="voucher_order_name" value="{$voucher_order.voucher_order_name}" maxlength="50" type="text" class="booking-cell" size="35"></td>
				  </tr>
				  <tr>
					<td class="content-formatting"><div align="left"><strong>*Telephone of sender: </strong></div></td>
					<td><input name="voucher_order_phone" value="{$voucher_order.voucher_order_phone}" maxlength="50" type="text" class="booking-cell" size="35"></td>
				  </tr>
				  <tr>
					<td class="content-formatting"><div align="left"><strong>*Name of the person of who it is to be posted: </strong></div></td>
					<td><input name="voucher_order_name_to" value="{$voucher_order.voucher_order_name_to}" maxlength="50" type="text" class="booking-cell" size="25"></td>
				  </tr>
				  <tr>
					<td class="content-formatting"><div align="left"><strong>*Address of where the voucher is to be posted: </strong></div></td>
					<td><input name="voucher_order_address1_to"  value="{$voucher_order.voucher_order_address1_to}" maxlength="50" type="text" class="booking-cell" size="25"></td>
				  </tr>
				   <tr>
					<td class="content-formatting"><div align="left"><strong>*Message from sender: </strong></div></td>
					<td><input name="voucher_order_message"  value="{$voucher_order.voucher_order_message}" maxlength="50" type="text" class="booking-cell" size="25"></td>
				  </tr>
				  <tr>
					<td><img src="../WEB-INF/assets/images/utils/spacer.gif" width="22" height="7"></td>
				  </tr>
				  <tr>
					<td class="content-formatting"><div align="left"><strong>*Voucher No.: </strong></div></td>
					<td><input name="voucher_order_number"  value="{$voucher_order.voucher_order_number}" maxlength="17" type="text" class="booking-cell" size="25"></td>
				  </tr>
				  <tr>
					<td class="content-formatting"><div align="left"><strong>*Total, &pound;: </strong></div></td>
					<td><input name="voucher_order_total"  value="{$voucher_order.voucher_order_total}" maxlength="15" type="text" class="booking-cell" size="25"></td>
				  </tr>
				  <tr>
					<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="2"><div align="center"><a href="javascript:document.edit_voucher.submit();" onMouseOut="MM_swapImgRestore()"onMouseOver="MM_swapImage('Image32','','../WEB-INF/assets/images/booking/button-proceed-on.gif',1)" onclick="validate(); return returnVal;"><img src="../WEB-INF/assets/images/booking/button-proceed-off.gif" name="Image32" width="107" height="32" border="0"></a></div></td>
						</tr>
					</table></td>
				  </tr>
				</table>
<input name="code" value="{$voucher_order.voucher_order_unique_code}" maxlength="10" type="Hidden">		 
</form>
</body>
</head>