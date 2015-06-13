<table width="100%" border="0" cellspacing="1" cellpadding="0">
	<form name="form_code" method="post">
		<tr>
			<td class="calendar-header-months"><table width="423" border="0"
					cellpadding="0" cellspacing="0">
					<tr>
						<td width="30%" class="sidetable-txt">Search by Tx Number:</td>
						<td width="33%" class="sidetable-txt"><input name="txnumber"
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
						<td width="30%" class="sidetable-txt">Search by name:</td>
						<td width="33%" class="sidetable-txt"><input name="name"
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
						<td width="30%" class="sidetable-txt">Search by&nbsp;email:</td>
						<td width="33%" class="sidetable-txt"><input name="email"
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

{if !empty($orders)}
<table width="100%" border="0" cellspacing="1" cellpadding="0">
	<tr>
		<td class="outline-grey"><table width="100%" border="0"
				cellpadding="0" cellspacing="1">
				<tr>
					<td class="table-header">Id</td>
					<td class="table-header">Name</td>
					<td class="table-header">Email</td>
					<td class="table-header">Phone</td>
					<td class="table-header">Date</td>
					<td class="table-header">Time</td>
					<td class="table-header">Boat</td>
					<td class="table-header">Seats</td>
					<td class="table-header">Tickets</td>
					<td class="table-header">Total</td>
				</tr>
				{section name=i loop=$orders} {assign var="order" value=$orders[i]}
				<tr>
					<td bgcolor="#F8F8F8" class="table-line">{$order.order_id}</td>
					<td bgcolor="#F8F8F8" class="table-line"><a
						href="mailto:{$order.order_email}" id="submenu">{$order.order_title}
							{$order.order_first_name} {$order.order_last_name}</a>
					</td>
					<td bgcolor="#F8F8F8" class="table-line">{$order.order_email}</td>
					<td bgcolor="#F8F8F8" class="table-line">{$order.order_phone}</td>
					<td bgcolor="#F8F8F8" class="table-line">{$order.departure_date|date_format:"%B
						%d, %Y"}</td>
					<td bgcolor="#F8F8F8" class="table-line">{$order.departure_time|truncate:5:""}</td>
					<td bgcolor="#F8F8F8" class="table-line">{$order.boat_name}</td>
					<td bgcolor="#F8F8F8" class="table-line">{$order.order_tickets_number}</td>
					<td bgcolor="#F8F8F8" class="table-line">{$order.tickets}</td>
					<td bgcolor="#F8F8F8" class="table-line">&pound;{$order.order_total}</td>					
				</tr>
				{/section}

			</table></td>
	</tr>
</table>
{/if}
