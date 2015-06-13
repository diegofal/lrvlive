<html>
<head>
<title>Booking</title>
<link href="../WEB-INF/assets/css/site-styles.css" rel="stylesheet" type="text/css" />
<body onLoad="window.opener.location.reload();">			
<br />
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center"> 
  <tr>
	<td height="21" valign="top"><h1><strong>Complete </strong></h1></td>
  </tr>
  <tr>
	<td><div align="left" class="content-formatting"> 
		{if $results.status == 'OK'}
		An email was sent to the client you ordered for.<br><br>
		Please inform your client to check his email address to view his ticket and the Information page which he will need to read.
		<br><br>
		Please <a href="javascript:window.close()">close</a> this window.
		{else}						
		Sorry, the payment operation could not be performed properly. <br /><br />The error message: <strong>{$results.status}</strong>. <br /><br />Please <a href="javascript:window.close()">close</a> this window and try again. 
		{/if}
		<br>
	  <br>
	  <br>
								</div></td>
  </tr>
</table>
</body>
</head>
			