<table width="100%" border="0" cellspacing="1" cellpadding="0">
	<form name="form_code" method="post">
		<tr>
			<td class="calendar-header-months"><table width="423" border="0"
					cellpadding="0" cellspacing="0">
					<tr>
						<td width="30%" class="sidetable-txt">Search by Booking Id:</td>
						<td width="33%" class="sidetable-txt"><input name="parent_id"
							type="text" class="cell-130">
						</td>
						<td width="35%" class="sidetable-txt"><a
							href="javascript:document.form_code.submit();"
							onMouseOut="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('Image14','','images/button-submit-on.gif',1)"><img
								src="images/button-submit-off.gif" name="Image14" width="63"
								height="23" border="0"> </a>
						</td>
					</tr>

				</table>
			</td>
		</tr>
		<tr>
			<td class="calendar-header-months"><table width="423" border="0"
					cellpadding="0" cellspacing="0">
					<tr>
						<td width="30%" class="sidetable-txt">Search by email:</td>
						<td width="33%" class="sidetable-txt"><input name="mail"
							type="text" class="cell-130">
						</td>
						<td width="35%" class="sidetable-txt"><a
							href="javascript:document.form_code.submit();"
							onMouseOut="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('Image14','','images/button-submit-on.gif',1)"><img
								src="images/button-submit-off.gif" name="Image14" width="63"
								height="23" border="0"> </a>
						</td>
					</tr>

				</table>
			</td>
		</tr>
	</form>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><img src="images/spacer.gif" width="10" height="10"></td>
	</tr>
{if !empty($rows)}	
	<tr>
		<td>{$rows} rows found.</td>
	</tr>
	<tr>
		<td><img src="images/spacer.gif" width="10" height="10"></td>
	</tr>
{/if}
{if !empty($message)}	
	<tr>
		<td>{$message}</td>
	</tr>
	<tr>
		<td><img src="images/spacer.gif" width="10" height="10"></td>
	</tr>
{/if}
</table>

{if !empty($results)}
<table width="100%" border="0" cellspacing="1" cellpadding="0">
	<tr>
		<td class="outline-grey"><table width="100%" border="0"
				cellpadding="0" cellspacing="1">
				<tr>
					<td class="table-header">Booking Id</td>
					<td class="table-header">Was Sent?</td>
					<td class="table-header">Created</td>
					<td class="table-header">Sent date</td>
					<td class="table-header">Error</td>
					<td class="table-header">Recipient</td>
					<td class="table-header">Sender</td>
					<td class="table-header">Subject</td>
				</tr>
				{section name=i loop=$results} {assign var="mail" value=$results[i]}
				<tr>
					<td bgcolor="#F8F8F8" class="table-line">{$mail.email_parent_id}</td>
					<td bgcolor="#F8F8F8" class="table-line">
						{if $mail.email_sent == "1"}
							Yes 
						{else}
							{if $mail.email_try_sent == "1"}
								Error
							{else}
								Not yet.
							{/if}
						{/if}
					</td>
					<td bgcolor="#F8F8F8" class="table-line">{$mail.email_create_time}</td>
					<td bgcolor="#F8F8F8" class="table-line">{$mail.email_sent_time}</td>
					<td bgcolor="#F8F8F8" class="table-line">{$mail.email_error_message}</td>
					<td bgcolor="#F8F8F8" class="table-line">{$mail.email_recipients}</td>
					<td bgcolor="#F8F8F8" class="table-line">{$mail.email_sender}</td>
					<td bgcolor="#F8F8F8" class="table-line">{$mail.email_subject}</td>					
				</tr>
				{/section}

			</table></td>
	</tr>
</table>
{/if}
