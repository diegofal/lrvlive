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
	<tr>
		<td class="content">
			<h1><span id="time"><input type="text" id="hours" name="hours" value="{$smarty.now|date_format:"%H"}"><span id="blink">:</span><input type="text" id="minutes" name="minutes" value="{$smarty.now|date_format:"%m"}"></span>
			{if $cur_day_format ne ""}
			{$cur_day_format}
			{else}
			{$smarty.now|date_format:"%A, %B %d"}
			 {/if}
			</h1>
			<h1 style="text-align:left;">Departure: {$departure.departure_date|date_format:"%A, %B %d"} at {$departure.departure_time|date_format:"%H:%M"}</h1>
		
			{if !empty($error)}
				<div style="width:335px;font-family: Arial, Helvetica, sans-serif; font-size: 14px; 
					font-weight: bold; color: #FF0000;">
					{$error}
				</div>
			{/if}
			<form method="post" action="" name="popup_form"
				onsubmit="return validateBooking_add();">
				<input type="hidden" name="action" value="add" />
				<input type="hidden" name="tour_id" value="{$tour[0].tour_id}" />				

				<div style="font-family: Arial, Helvetica, sans-serif; font-size: 18px; 
					font-weight: bold; color: #000000; padding-top: 10px; height:30px;">Customer Details:</div>
				<table class="div_class" cellpadding="4x" cellspacing="4px"
					style="padding-top: 15px;">
					<tr>
						<td align="center" colspan="2">
							<table width="100%" border="0" cellspacing="0px"
								cellpadding="8px" style="border: #bfbebe solid 1px;">
								<tr>
									<td class="weekday_11" height="40px" colspan="3"
										style="padding-left: 5px;">Please enter customers details
										below :</td>
								</tr>

								<tr>
									<td width="80" height="25" align="left"
										style="padding-left: 5px;" class="text_font">First Name:</td>
									<td width="1" bgcolor="#E7E5E6" class="text_font">&nbsp;</td>
									<td width="240" align="left" style="padding-left: 5px;"
										class="text_font"><input type="text" name="first_name"
										value="{$smarty.session.FirstName}"></td>
								</tr>
								
								<tr>
									<td width="80" height="25" align="left"
										style="padding-left: 5px;" class="text_font">Last Name:</td>
									<td width="1" bgcolor="#E7E5E6" class="text_font">&nbsp;</td>
									<td width="240" align="left" style="padding-left: 5px;"
										class="text_font"><input type="text" name="last_name"
										value="{$smarty.session.LastName}"></td>
								</tr>

								<tr>
									<td height="25" align="left" style="padding-left: 5px;"
										class="text_font">Mobile:</td>
									<td bgcolor="#E7E5E6" class="text_font"></td>
									<td align="left" style="padding-left: 5px;" class="text_font"><input
										type="text" name="mobile" value="{$smarty.session.Phone}"></td>
								</tr>

								<tr>
									<td height="25" align="left" style="padding-left: 5px;"
										class="text_font">Email:</td>
									<td bgcolor="#E7E5E6" class="text_font"></td>
									<td align="left" style="padding-left: 5px;" class="text_font"><input
										type="text" name="email" value="{$smarty.session.Email}"></td>
								</tr>
								{section name=i loop=$tickets}
								<tr>
									<td height="25" align="left" style="padding-left: 5px;"
										class="text_font">No. {$tickets[i].ticket_type}:</td>
									<td bgcolor="#E7E5E6" class="text_font"></td>
									<td align="left" style="padding-left: 5px;" class="text_font">
										<input name="ticket[]" type="hidden" value="{$tickets[i].ticket_id}" />
										<input name="quantity[]" type="text" id="kid" value="0" />
										<input name="price[]" type="hidden" value="{$reseller_tickets[i].ticket_price}" />
									</td>
								</tr>								
								{/section}
								<tr>
									<td colspan="3" style="height:30px;">
										<input type="button" name="cancel"
											value="CANCEL" style="width: 100px; height: 25px; 
											outline: none; font-family: Verdana, Arial, Helvetica, sans-serif; 
											color: #35788B; font-size: 11px; font-weight: bold; float: left; 
											margin-left:10px;" onclick="javascript: history.back();" />
										<input type="submit" name="save"
											style="width: 175px; height: 25px; outline: none; 
											font-family: Verdana, Arial, Helvetica, sans-serif; 
											color: #35788B; font-size: 11px; font-weight: bold; float:right;
											margin-right:10px;"
											value="COMPLETE THIS BOOKING" />
									</td>
								</tr>
								<tr>
									<td height="25" align="left" style="padding-left: 5px;"
										class="text_font">&nbsp;</td>
									<td bgcolor="#E7E5E6" class="text_font"></td>
									<td align="left" style="padding-left: 5px;" class="text_font">&nbsp;</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>
