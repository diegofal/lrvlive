      <table width="850" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="150" valign="top" class="content-padding"><table width="91%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="txt-side">List of all orders placed up to date is displayed on this page. You may sort the list based on any table header. <br>
                    <br>
                Clicking on a name will allow you to send an email to the selected client. </td>
              </tr>
              <tr>
                <td class="txt-side">&nbsp;</td>
              </tr>
              <tr>
                <td class="txt-side"><strong>The Icons: </strong></td>
              </tr>
              <tr>
                <td class="txt-side"><img src="images/spacer.gif" width="10" height="5"></td>
              </tr>
              <tr>
                <td class="txt-side"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="13%"><img src="images/icons/lock_ok_16.gif" alt="Mark Ticket  as Used" width="16" height="16" vspace="2"></td>
                      <td width="87%" class="txt-side">Mark Ticket  as Used </td>
                    </tr>
                  </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/lock_16_dis.gif" alt="Ticket Used" width="16" height="16" vspace="2"></td>
                        <td width="87%" class="txt-side">Ticket Used </td>
                      </tr>
                    </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/mail_info_16.gif" alt="View Ticket" width="16" height="16" vspace="2"></td>
                        <td width="87%" class="txt-side">View Ticket</td>
                      </tr>
                  </table></td>
              </tr>
          </table></td>
          <td width="700" valign="top" class="dotted-border content-padding2">
			<p class="table-line"><strong>Tour Orders</strong> | <a href="voucher_orders.php">Voucher Orders</a></p>
			<table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr>
              <td class="calendar-header-months"><div align="right">
                <table width="423" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="67%" class="sidetable-txt"><div align="right">Filter by ticket type: </div></td>
						<form name="filter_form">
                        <td width="33%"><div align="right">
                          <select name="filter" class="cell-130" onchange="filter_orders('{$smarty.get.order}');">
                            <option {if $smarty.get.filter=="all"}selected{/if} value="all">Show all</option>
                            <option {if $smarty.get.filter=="1"}selected{/if} value="1">Show used only</option>
                            <option {if $smarty.get.filter=="0"}selected{/if} value="0">Show unused only</option>
                          </select>
                        </div></td>
						</form>
                      </tr>
				</table>
              </div></td>
            </tr>
          </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/spacer.gif" width="10" height="10"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="1" class="outline-grey">
                  <tr>
                    <td width="7%" {$head.order_id}</td>
                    <td width="28%" {$head.order_first_name}</td>
                    <td width="15%" {$head.departure_date}</td>
                    <td width="5%" {$head.departure_time}</td>
                    <td width="10%" {$head.tour_name}</td>
                    <td width="15%" {$head.boat_name}</td>
                    <td width="10%" {$head.order_total}</td>
                    <td width="10%" class="table-header">&nbsp;&nbsp; </td>
                  </tr>
				  {section name=i loop=$orders}
				  <tr bgcolor="{cycle values="#F8F8F8,#FFFFFF"}">
                    <td class="table-line">{$orders[i].order_id}</td>
                    <td class="table-line"><a href="mailto:{$orders[i].order_email}" id="submenu">{$orders[i].order_title} {$orders[i].order_first_name} {$orders[i].order_last_name}</a> </td>
                    <td class="table-line">{$orders[i].departure_date|date_format:"%B %d, %Y"}</td>
                    <td class="table-line">{$orders[i].departure_time|truncate:5:""}</td>
                    <td class="table-line">{$orders[i].tour_name}</td>
                    <td class="table-line">{$orders[i].boat_name}</td>
                    <td class="table-line">&pound;{$orders[i].order_total}</td>
                    <td class="table-line"><div align="center">
					{if $orders[i].order_used==0}
						<a href="orders.php?start={$smarty.get.start}&order={$smarty.get.order}&filter={$smarty.get.filter}&mark={$orders[i].order_id}"  onclick="return confirm('Are you sure you want to mark this ticket as used?');"><img src="images/icons/lock_ok_16.gif" width="16" height="16" border="0"></a>
					{else}
						<img src="images/icons/lock_16_dis.gif" width="16" height="16" vspace="2" border="0">
					{/if}
						<a href="javascript:view_ticket('{$orders[i].order_unique_code}');"><img src="images/icons/mail_info_16.gif" alt="Previous Month" width="16" height="16" vspace="2" border="0"></a>
					</div></td>
                  </tr>
				  {sectionelse}
				  <tr>
                    <td bgcolor="#F8F8F8" class="table-line" colspan="7">There are no bookings defined!</td>
				  </tr>
				  {/section} 
                </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><img src="images/spacer.gif" width="10" height="3"></td>
                  </tr>
                </table>
				
				{if !empty($navigator)}
                <table width="100%" border="0" cellpadding="4" cellspacing="1" class="outline-grey">
                  <tr>
                    <td class="txt-tahoma"><div align="right">{$navigator}</div></td>
                  </tr>
                </table>
				{/if}
                <br>
                <br>
          <br></td></tr>
      </table>
