<html>
<head>
<title>Booking</title>
<link href="../WEB-INF/assets/css/site-styles.css" rel="stylesheet" type="text/css" />
<body onLoad="window.opener.location.reload();">			
<br />
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center"> 
  <tr>
	<td height="21" valign="top"><h1><strong>Ticket Edition</strong></h1></td>
  </tr>
  <tr>
	<td><div align="left" class="content-formatting"> 
		{if $result}
			The ticket was successfully modified.
		{else}
			No fields were edited.
		{/if}
		<br><br>
		{if $resendconfirmation}
			An email has been sent to the client.  Please inform your client to check his / her email.
		{else}
			No email was sent to the client. If you want to send a ticket confirmation to the client you have to check the "Send email confirmation to client" field.
		{/if}
		<br><br>
		Please <a href="javascript:window.close()">close</a> this window.
		</div></td>
  </tr>
</table>
</body>
</head>
			