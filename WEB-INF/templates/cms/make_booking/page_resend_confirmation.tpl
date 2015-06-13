<html>
<head>
<title>Re-send email confirmation #{$order.order_id}</title>
<link href="../WEB-INF/assets/css/site-styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/macromedia.js"></script> 
</head>
<body>
<br />
<form name="resendform" method="POST">
	<input type="hidden" name="order_id" id="order_id" value="{$order.order_id}" />
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center"> 
  <tr> 
    <td height="21" valign="top" class="content-formatting"><h1>Resend email confirmation to: {$order.order_first_name} {$order.order_last_name} ({$order.order_email}).</h1>
  </tr>
  <tr>
  	<td colspan="2">
  		<div align="center">
  			<a href="javascript: document.forms['resendform'].submit();" 
  				onMouseOut="MM_swapImgRestore()"
				onMouseOver="MM_swapImage('Image32','','../WEB-INF/assets/images/booking/button-proceed-on.gif',1)">
				<img src="../WEB-INF/assets/images/booking/button-proceed-off.gif" name="Image32" width="107" height="32" border="0">
			</a>
		</div>
	</td>    
  </tr> 
</table>
</form>
</body>
</head>
