<html>
<head>
<title>Relocate Ticket</title>
<link href="../WEB-INF/assets/css/site-styles.css" rel="stylesheet" type="text/css" />
<body {if !empty($ok)}onload="window.opener.location.reload();"{/if}>
<br>
{if empty($ok)}
<form name="relocate" method="post" action="relocate_ticket.php?option=confirm">
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center"> 
  <tr>
	<td valign="top" height="30" class="content-formatting"><span style="font-size:14; font-weight:bold;">Relocate Ticket</span></td>
  </tr>
  <tr>
	<td>
	
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="booking-tableoutln1">
				  <tr>
				  	<td colspan="2" class="booking-tableheader1">Relocate Ticket</td>
				  </tr>
				  <tr>
					<td><img src="../WEB-INF/assets/images/utils/spacer.gif" width="22" height="7"></td>
				  </tr>				  
				  <tr>
					<td width="25%"  class="booking-tablecont1"><div align="left"><strong>From: </strong></div></td>
					<td width="75%" class="booking-tablecont1">
						<input name="order" type="hidden" value="{$order.order_id}">
						<input name="from" type="hidden" value="{$departure.departure_id}">
						{$departure.departure_date|date_format:"%d %b %Y"}, {$departure.departure_time|truncate:5:""}
					</td>
				  </tr>
				  <tr>
					<td class="booking-tablecont1"><div align="left"><strong>To:</strong></div></td>
					<td class="booking-tablecont1">
					{if !empty($to)}
					<select name="to" class="booking-cell" style="width:250px">
					  	{section name=i loop=$to}
						<option value="{$to[i].departure_id}">{$to[i].departure_date|date_format:"%d %b %Y"}, {$to[i].departure_time|truncate:5:""} ({$to[i].available} available seats)</option>
					  	{/section}
					</select>
					{else}
						There are no other possibilities!
					{/if}
					</td>
				  </tr>		
				</table>
		</td>
	</tr>
</table>
<br>
<div align="center"><a href="javascript:document.relocate.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image32','','../WEB-INF/assets/images/booking/button-proceed-on.gif',1)"><img src="../WEB-INF/assets/images/booking/button-proceed-off.gif" name="Image32" width="107" height="32" border="0"></a></div>
</form>
{else}
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center"> 
  <tr>
	<td>
	
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="booking-tableoutln1">
				  <tr>
				  	<td class="booking-tableheader1">Relocate Ticket</td>
				  </tr>
				  <tr>
					<td><img src="../WEB-INF/assets/images/utils/spacer.gif" width="22" height="7"></td>
				  </tr>				  
				  <tr>
					<td class="booking-tablecont1">
					<div align="left">
						{if $ok == true}
							The ticket was successfully relocated. <br>An email has been sent to the client.  Please inform your client to check his / her email.
						{else}
							An error occured. Please try again.
						{/if}
					</div>
					</td>
				  </tr>
				</table>
		</td>
	</tr>
</table>
<br>
{/if}
<br><br>
</body>
</head>