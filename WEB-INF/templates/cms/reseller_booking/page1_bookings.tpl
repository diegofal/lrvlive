	<table class="main">
		<tr>
			<td class="header" colspan="3">
				<DIV  style="width:100%;">
					<div id="divimageleft">
						<img src="/bale/img/london_rib_extended.png"  width="100%" ></img>
					</div>

					<div id="divimageright">
						{if $company_image_path ne ""} 
							<img src="{$company_image_path}" width="200px" height="45px" ></img>
						{/if}
					</div>

					<DIV id="logout"><a style="color:white" href="/bale/logout.php">LOGOUT >></a></DIV>
				</DIV>
			</td>
		</tr>

		<tr><td class="leftMenu{if isset($smarty.cookies.displaymenu) && $smarty.cookies.displaymenu==0} hidden{/if}" id="leftMenu"><div class="leftMenu">
			<div class="mtop"></div>
			<div class="container">
				<img src="img/logos.png" alt="">
			</div>
			<div class="mbot"></div></div></td><td id="handle"><a onClick="displayLeftMenu()" title="Click to hide/show left menu"></a></td>

		<td class="content">

		<form name="refresh" action="booking.php" method="post"><div style="position: relative;"><input type="hidden" name="openHistoryId" id="openHistoryId" value=""><div class="button" style="position: absolute; margin-top: 20px; left: 40%;"><input type="submit" value="refresh"></div></div></form>
		<h1><span id="time"><input type="text" id="hours" name="hours" value="{$smarty.now|date_format:"%H"}"><span id="blink">:</span><input type="text" id="minutes" name="minutes" value="{$smarty.now|date_format:"%m"}"></span>{$smarty.now|date_format:"%A, %B %d"}</h1>

		{if $status}<p class="ok">{$status}</p>{/if}




		<form id="order" action="#" method="post">
		<div class="s2"><div class="s1"><div class="s0">
		<input type="hidden" name="job" value="">
		<table class="tl">
		<thead><tr><th style="width: 20px;">Time</th><th>Tour</th><th>Seats Available</th><th>Adult</th><th>Child</th><th style="width: 20px;">Save</th></tr></thead>

		{section name=i loop=$departures}
			<tbody{if $departures[i].timedout == 1}  class="disabled"{/if}{if $history_id && $history_id == $departures[i].departure_id} class="openDeparture"{/if}>
				<tr>	
					<td>{$departures[i].departure_time|truncate:5:""}</td>
					{if ($departures[i].available == 0 && $departures[i].reseller_orders_num == 0)|| $departures[i].timedout == 1}
						<td>{$departures[i].tour_name}</td>
						<td><strong>{$departures[i].available}</strong></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					{else}
						<td>{if $departures[i].reseller_orders_num != 0 && $departures[i].timedout == 0}<span class="openHistory" onclick="toggleHistory(this, 'history_{$departures[i].departure_id}');">{/if}{$departures[i].tour_name}{if $departures[i].reseller_orders_num != 0 && $departures[i].timedout == 0}</span>{/if}</td>
						<td><strong>{$departures[i].available}</strong></td>
						{if $departures[i].available == 0}
							<td colspan="3"></td>
						{else}
							{assign var="tour_id" value=$departures[i].departure_tour_id}
							{assign var="ticket_adult" value=$valid_tickets[$tour_id].adult}
							{assign var="ticket_child" value=$valid_tickets[$tour_id].child}
							<td>
								{if is_array($ticket_adult)}
								<label for="q[{$departures[i].departure_id}][{$ticket_adult.ticket_id}]">&pound;{$ticket_adult.ticket_price} x <input type="text" name="q[{$departures[i].departure_id}][{$ticket_adult.ticket_id}]" id="q[{$departures[i].departure_id}][{$ticket_adult.ticket_id}]" maxlength="2"></label>
								{else}&nbsp;{/if}
							</td>
							<td>
								{if is_array($ticket_child)}
								<label for="q[{$departures[i].departure_id}][{$ticket_child.ticket_id}]">&pound;{$ticket_child.ticket_price} x <input type="text" name="q[{$departures[i].departure_id}][{$ticket_child.ticket_id}]" id="q[{$departures[i].departure_id}][{$ticket_child.ticket_id}]" maxlength="2"></label></td>
								{else}&nbsp;{/if}
							<td><input type="button" class="save" name="add_{$departures[i].departure_id}" onclick="validateForm(this, 'q[{$departures[i].departure_id}][{$ticket_adult.ticket_id}]', 'q[{$departures[i].departure_id}][{$ticket_child.ticket_id}]', {$departures[i].available}, 1);"></td>
						{/if}
					{/if}
				</tr>
			</tbody>
		{if $departures[i].reseller_orders_num > 0}
			<tbody id="history_{$departures[i].departure_id}" class="history"{if $history_id && $history_id == $departures[i].departure_id}{else} style="display: none;"{/if}>
				{assign var="orders" value=$departures[i].reseller_orders}
				{section name=j loop=$orders}
				<tr>	
					<td>&nbsp;</td>
					<td colspan="2">No. passenger in group</td>
					{assign var="order_tour_id" value=$orders[j].order_tour_id}
					{assign var="order_ticket_adult" value=$valid_tickets[$order_tour_id].adult}
					{assign var="order_ticket_child" value=$valid_tickets[$order_tour_id].child}
					<td>
						{if is_array($order_ticket_adult)}
							<label for="h[{$orders[j].order_id}][{$order_ticket_adult.ticket_id}]">&pound;{$order_ticket_adult.ticket_price} x <input type="text" name="h[{$orders[j].order_id}][{$order_ticket_adult.ticket_id}]" id="h[{$orders[j].order_id}][{$order_ticket_adult.ticket_id}]" maxlength="2" value="{$orders[j].order_adult_tickets}"></label></td>
						{else}&nbsp;{/if}
					<td>
						{if is_array($order_ticket_child)}
							<label for="h[{$orders[j].order_id}][{$order_ticket_child.ticket_id}]">&pound;{$order_ticket_child.ticket_price} x <input type="text" name="h[{$orders[j].order_id}][{$order_ticket_child.ticket_id}]" id="h[{$orders[j].order_id}][{$order_ticket_child.ticket_id}]" maxlength="2" value="{$orders[j].order_child_tickets}"></label></td>
						{else}&nbsp;{/if}
					<td><input type="button" class="save" name="save_{$departures[i].departure_id}_{$orders[j].order_id}" onclick="validateForm(this, 'h[{$orders[j].order_id}][{$order_ticket_adult.ticket_id}]', 'h[{$orders[j].order_id}][{$order_ticket_child.ticket_id}]', {$departures[i].boat_passengers}, 0);"></td>
				</tr>	
				{/section}
			</tbody>
		{/if}
		{sectionelse}
			<tbody>
				<tr>	
					<td colspan="6"><strong>There are no departures scheduled for today.</strong></td>
				</tr>
			</tbody>
		{/section}
		</table>
		</div></div></div>
		</form>
		</td></tr>
	</table>
{if $error}
<script type="text/javascript">alert('{$error}');</script>
{/if}