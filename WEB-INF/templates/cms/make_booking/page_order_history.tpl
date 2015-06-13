<html>
<head>
<title>Order log</title></script>
<link href="../WEB-INF/assets/css/site-styles.css" rel="stylesheet"
	type="text/css" />


<body onLoad="init_address();">
	<br>
	<table width="90%" border="0" cellspacing="0" cellpadding="0"
		align="center">		
		<tr>
			<td class="content-formatting"><h1>Order log</h1></td>
		</tr>
		<tr>
			<td>
				<table width="100%" border="1" cellpadding="0" cellspacing="1"
					class="booking-tableoutln1">
					<tr>
						<td class="booking-tableheader1">Order Id</td>
						<td class="booking-tableheader1">Date</td>
						<td class="booking-tableheader1">Action</td>
						<td class="booking-tableheader1">Context</td>
						<td class="booking-tableheader1">Previous Data</td>
						<td class="booking-tableheader1">New Data</td>
					</tr>
					{section name=i loop=$results} {assign var="order" value=$results[i]}
					<tr bgcolor="{cycle values=',#f8f8f8'}">
						<td class="booking-tablecont1" valign="top">{$order.order_id}</td>
						<td class="booking-tablecont1" valign="top">{$order.date}</td>
						<td class="booking-tablecont1" valign="top">{$order.action}</td>
						<td class="booking-tablecont1" valign="top">{$order.context}</td>
						<td class="booking-tablecont1" valign="top">{$order.previous_data}</td>
						<td class="booking-tablecont1" valign="top">{$order.new_data}</td>
					</tr>
					{/section}
				</table>

			</td>
		</tr>
	</table>


</body>
</head>