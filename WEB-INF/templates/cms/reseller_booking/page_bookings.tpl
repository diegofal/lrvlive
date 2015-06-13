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

					<DIV id="logout"><a style="color:black" href="/bale/logout.php">LOGOUT >></a></DIV>
				</DIV>
			</td>
		</tr>

		<tr>
		<td class="content">
		<div style="float:right; width:100%; margin-top:-20px;padding-top:0px; border:0px #FF0000 solid;" align="right"> </div>
		
		<div style="clear:both;width:100%; border:0px #FF0000 solid;">
		<form name="refresh" action="booking.php" method="post"><div style="position: relative;"><input type="hidden" name="openHistoryId" id="openHistoryId" value=""><div class="button" style="position: absolute; margin-top: 20px; left: 40%;"><input type="submit" value="refresh"></div></div></form>
		<h1><span id="time"><input type="text" id="hours" name="hours" value="{$smarty.now|date_format:"%H"}"><span id="blink">:</span><input type="text" id="minutes" name="minutes" value="{$smarty.now|date_format:"%m"}"></span>
		{if $cur_day_format ne ""}
		{$cur_day_format}
		{else}
		{$smarty.now|date_format:"%A, %B %d"}
		 {/if}
		</h1>
		</div>

<input type="button" name="back" value="<< Back" onClick="return Backlink('booking_calender.php')">		
<input type="button" name="prev-day" value="Prev Day" onClick="window.location.href='booking.php?vdate={$prev_date}'">		
<input type="button" name="next-day" value="Next Day" onClick="window.location.href='booking.php?vdate={$next_date}'">		

<div style="clear:both;width:100%; border:0px #FF0000 solid; text-align:center">
 {if !empty($smarty.get.expired) && ($smarty.get.expired==true)}
  <div align="center" class="content-formatting" align="center"><strong><span style="color:#880000;">The ticket(s) you booked has just been paid by another person. Please try again with other options.</span></strong></div><br />
  {/if}
</div>
		
<!--<tr><td colspan="8" align="right"><input type="button" name="back" value="<< Back"></td></tr>
-->		{if $status}<p class="ok">{$status}</p>{/if}




		<form id="order" action="#" method="post">
		<div class="s2"><div class="s1"><div class="s0">
		<input type="hidden" name="job" value="">
		 <table class="tl">
		<thead><tr><th style="width: 20px;">Time</th><th>Tour</th><th>Seats Available</th><th colspan="3">&nbsp;</th></tr></thead>

		{section name=i loop=$departures}
		                
						    {assign var="tour_id" value=$departures[i].departure_tour_id}
							{assign var="ticket_adult" value=$valid_tickets[$tour_id].adult}
							{assign var="ticket_child" value=$valid_tickets[$tour_id].child}
			<tbody{if $departures[i].timedout == 1}  class="disabled"{/if}{if $history_id && $history_id == $departures[i].departure_id} class="openDeparture"{/if}>
			<!-- Added by Carlos -->
			{if !(($departures[i].available == 0 && $departures[i].reseller_orders_num == 0) || $departures[i].timedout == 1) }
				<tr>	
					<td>{$departures[i].departure_time|truncate:5:""}</td>
						<td>{if $departures[i].reseller_orders_num != 0 && $departures[i].timedout == 0}<span class="openHistory" onclick="toggleHistory(this, 'history_{$departures[i].departure_id}');">{/if}{$departures[i].tour_name}{if $departures[i].reseller_orders_num != 0 && $departures[i].timedout == 0}</span>{/if}</td>
						<td><strong>{$departures[i].available}</strong></td>
							<td colspan="3" align="center">
							<!-- <input type="button" name="booking" style="width: 80px;height: 25px;outline: none; font-family:Verdana, Arial, Helvetica, sans-serif; color:#35788B; font-size:11px; font-weight:bold" value="BOOK NOW" onclick="return showPopup(300,350,{$departures[i].departure_id}, {$departures[i].available}, {$departures[i].departure_tour_id},{$ticket_adult.ticket_price},{$ticket_child.ticket_price},'{$cur_date}');"/> -->
							<input type="button" name="booking" 
								style="width: 80px;height: 25px;outline: none; 
								font-family:Verdana, Arial, Helvetica, sans-serif; 
								color:#35788B; font-size:11px; font-weight:bold" 
								value="BOOK NOW" 
								onclick="window.location = 'booking_add.php?vdate={$cur_date}&departure_id={$departures[i].departure_id}';"/>
							</td>
					</tr>
			{/if}
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
					<td><input type="button" class="save" name="save_ticket" style="width: 80px;height: 25px;outline: none; font-family:Verdana, Arial, Helvetica, sans-serif; color:#35788B; font-size:11px; font-weight:bold" value="BOOK NOW" ></td>
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
	
		<div id="popupcontent" style="display:none;">
		<form method="post" action="booking.php" name="popup_form" onsubmit="return validateBooking();"> 
		<input type="hidden" name="total"  id="total" value="" />
		<input type="hidden" name="dep_id" id="dep_id" value="" />	
		<input type="hidden" name="tour_id" id="tour_id" value="" />
		<input type="hidden" name="adult_price" id="adult_price" value="" />
		<input type="hidden" name="child_price" id="child_price" value="" />
		<input type="hidden" name="ddate" id="ddate" value="" />
		
		<input type="hidden" name="command" value="add" />
			
		<table width="100%" border="0" cellpadding="0px" cellspacing="0px">
		<tr><td align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold; color:#000000; padding-top:10px;" height="30" valign="middle">Customer Details:</td>
		  <td align="center" valign="middle"><a href="#" title="CLOSE" onclick="return HidePopups()"><img src="img/cross.gif"/></a></td>
		</tr>
		</table>
		<table class="div_class" cellpadding="4x" cellspacing="4px" style="padding-top:15px;">
		<tr>
		<td align="center" colspan="2">
		<table width="100%" border="0" cellspacing="0px" cellpadding="8px" style="border:#bfbebe solid 1px;">
		<tr>
		<td class="weekday_11" height="40px" colspan="3" style="padding-left:5px;">Please enter customers details below : </td>
		</tr>
		
		<tr>
		<td width="80"  height="25" align="left" style="padding-left:5px;" class="text_font">Name:</td>
		<td width="1" bgcolor="#E7E5E6" class="text_font">&nbsp;</td>
		<td width="240" align="left" style="padding-left:5px;" class="text_font"><input type="text"  name="name" value="{$smarty.session.Name}"></td>
		</tr>
	
	    <tr>
		<td  height="25" align="left" style="padding-left:5px;" class="text_font">Mobile:</td>
		<td  bgcolor="#E7E5E6" class="text_font"></td>
		<td  align="left" style="padding-left:5px;" class="text_font"><input type="text" name="mobile" value="{$smarty.session.Phone}"></td>
		</tr>
	
	<tr>
		<td height="25" align="left" style="padding-left:5px;" class="text_font">Email:</td>
		<td bgcolor="#E7E5E6" class="text_font"></td>
		<td align="left" style="padding-left:5px;" class="text_font"><input type="text" name="email" value="{$smarty.session.Email}"></td>
		</tr>
	
	<tr>
		<td height="25" align="left" style="padding-left:5px;" class="text_font">No. Adult:</td>
		<td bgcolor="#E7E5E6" class="text_font"></td>
		<td align="left" style="padding-left:5px;" class="text_font"><input type="text" name="adult" id="adult" value="{$smarty.session.Adult}"></td>
		</tr>
	
	<tr>
		<td height="25" align="left" style="padding-left:5px;" class="text_font">No. Child:</td>
		<td bgcolor="#E7E5E6" class="text_font"></td>
		<td align="left" style="padding-left:5px;" class="text_font"><input type="text" name="kid" id="kid" value="{$smarty.session.Kids}"></td>
		</tr>
		<tr>
		<td height="25" align="left" style="padding-left:5px;" class="text_font">&nbsp;</td>
		<td bgcolor="#E7E5E6" class="text_font"></td>
		<td align="left" style="padding-left:5px;" class="text_font">&nbsp;</td>
		</tr>
	
		<tr>
		<td align="left" style="padding-left:5px;padding-bottom:15px;" class="text_font">&nbsp;</td>
		<td bgcolor="#E7E5E6" class="text_font"></td>
		<td align="left" style="padding-left:5px;" class="text_font"><input type="submit" name="save" style="width: 175px;height: 25px;outline: none; font-family:Verdana, Arial, Helvetica, sans-serif; color:#35788B; font-size:11px; font-weight:bold" value="COMPLETE THIS BOOKING" /></td>
		</tr>
			<tr>
		<td height="25" align="left" style="padding-left:5px;" class="text_font">&nbsp;</td>
		<td bgcolor="#E7E5E6" class="text_font"></td>
		<td align="left" style="padding-left:5px;" class="text_font">&nbsp;</td>
		</tr>
		</table></td></tr></table>	
		</form>
		</div>
		
		<div id="popupcontent1" style="display:none;background-color:#FFFFFF; border: 1px solid black;">
			<div style="width: 356px; font-family:Arial, Helvetica, sans-serif; 
				font-size:18px; font-weight:bold; color:#000000; padding-top:10px;height:30px;">
					Customer Details:
			</div>
			<div>Thank you. Your booking is now completed. </div>
			<div id="date_set"><input type="button" name="close" style="width: 175px;height: 25px;
				outline: none; font-family:Verdana, Arial, Helvetica, sans-serif; 
				color:#35788B; font-size:11px; font-weight:bold" 
				value="CLOSE THIS WINDOW" onclick="return hidePopup()"></div>
		
		</div>	

{if $error}
<script type="text/javascript">alert('{$error}');</script>
{/if}