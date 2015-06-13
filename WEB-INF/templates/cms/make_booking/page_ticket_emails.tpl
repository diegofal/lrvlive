<html>
<head>
<title>Booking emails</title></script>
<link href="../WEB-INF/assets/css/site-styles.css" rel="stylesheet"
	type="text/css" />


<body onLoad="init_address();">

	<table width="90%" border="0" cellspacing="0" cellpadding="0"
		align="center">
		<tr>
			<td align="center">
				<br />
				<a href="edit_ticket.php?option=resendconf&code={$order_unique_code}">Resend
					email confirmation</a></td>
		</tr>
		<tr>
			<td class="content-formatting"><h1>Emails for this booking:</h1></td>
		</tr>
		<tr>
			<td>
				<table width="100%" border="0" cellpadding="0" cellspacing="1"
					class="booking-tableoutln1">
					<tr>
						<td class="booking-tableheader1">Was Sent?</td>
						<td class="booking-tableheader1">Created</td>
						<td class="booking-tableheader1">Sent date</td>
						<td class="booking-tableheader1">Error</td>
						<td class="booking-tableheader1">Recipient</td>
						<td class="booking-tableheader1">Sender</td>
						<td class="booking-tableheader1">Subject</td>
					</tr>
					{section name=i loop=$results} {assign var="mail"
					value=$results[i]}
					<tr bgcolor="{cycle values=',#f8f8f8'}">
						<td class="booking-tablecont1">{if $mail.email_sent == "1"} Yes
							{else} {if $mail.email_try_sent == "1"} No, Error {else} Not yet.
							{/if} {/if}</td>
						<td class="booking-tablecont1">{$mail.email_create_time}</td>
						<td class="booking-tablecont1">{$mail.email_sent_time}</td>
						<td class="booking-tablecont1">{$mail.email_error_message}</td>
						<td class="booking-tablecont1">{$mail.email_recipients}</td>
						<td class="booking-tablecont1">{$mail.email_sender}</td>
						<td class="booking-tablecont1">{$mail.email_subject}</td>
					</tr>
					{/section}
				</table>

			</td>
		</tr>
	</table>


</body>
</head>