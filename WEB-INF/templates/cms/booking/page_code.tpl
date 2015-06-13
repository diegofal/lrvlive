{if $section == "bookings"}
      <table width="850" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="220" valign="top" class="content-padding"><table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="txt-side">Entering the confirmation code sent out with the invoice will validate the authenticity of the ticket. </td>
              </tr>

          </table>
            <table width="90%" border="0" cellspacing="0" cellpadding="0">

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
                      <td width="13%"><img src="images/icons/lock_ok_16.gif" alt="Previous Month" width="16" height="16" vspace="2"></td>
                      <td width="87%" class="txt-side">Mark Ticket  as Used </td>
                    </tr>
                  </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/lock_16_dis.gif" alt="Previous Month" width="16" height="16" vspace="2"></td>
                        <td width="87%" class="txt-side">Ticket Used </td>
                      </tr>
                    </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/mail_info_16.gif" alt="Previous Month" width="16" height="16" vspace="2"></td>
                        <td width="87%" class="txt-side">View Ticket </td>
                      </tr>
                  </table></td>
              </tr>
            </table></td>
          <td width="630" valign="top" class="dotted-border content-padding2">
		  <p class="table-line"><strong>Tour Orders</strong> | <a href="code.php?section=vouchers">Voucher Orders</a></p>
		  <table width="100%" border="0" cellspacing="1" cellpadding="0">
		  <form name="form_code" method="post" action="code.php?section={$section}">
            <tr>
              <td class="calendar-header-months"><table width="423" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="17%" class="sidetable-txt">Enter code: </td>
                  <td width="32%" class="sidetable-txt"><input name="query" type="text" class="cell-130"></td>
                  <td width="51%" class="sidetable-txt"><a href="javascript:document.form_code.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image14','','images/button-validate-on.gif',1)"><img src="images/button-validate-off.gif" name="Image14" width="77" height="19" border="0"></a></td>
                </tr>

              </table></td>
            </tr>
            <tr>
              <td class="calendar-header-months"><table width="423" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="17%" class="sidetable-txt">Enter&nbsp;name: </td>
                  <td width="32%" class="sidetable-txt"><input name="name" type="text" value="{$client_name}" class="cell-130"></td>
                  <td width="51%" class="sidetable-txt"><a href="javascript:document.form_code.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image14','','images/button-validate-on.gif',1)"><img src="images/button-validate-off.gif" name="Image14" width="77" height="19" border="0"></a></td>
                </tr>

              </table></td>
            </tr>
          </form>
		  </table>
		  {if !empty($message)}
          <br>
          <table width="100%" border="0" cellpadding="1" cellspacing="1">
            <tr>
              <td class="outline-grey"><table width="100%" border="0" cellpadding="3" cellspacing="0" bgcolor="#99FFCC">
                  <tr>
                    <td width="4%"><img src="images/icons/bulb_16_hot.gif" width="16" height="16"></td>
                    <td width="96%" class="txt-tahoma"><strong>{$message}</strong></td>
                  </tr>
                </table></td>
              </tr>
          </table>		  
		  {/if}		  
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/spacer.gif" width="10" height="10"></td>
              </tr>
            </table>
		  {if !empty($orders)}
		  <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td class="outline-grey"><table width="100%" border="0" cellpadding="0" cellspacing="1">
                  <tr>
                    <td width="9%" class="table-header">Tkt</td>
                    <td width="26%" class="table-header">Name</td>
                    <td width="14%" class="table-header">Date </td>
                    <td width="9%" class="table-header">Time</td>
                    <td width="20%" class="table-header">Boat</td>
                    <td width="12%" class="table-header">Total</td>
                    <td colspan="2" class="table-header">&nbsp;</td>
                    </tr>
                  {section name=i loop=$orders}
				  {assign var="order" value=$orders[i]}
                  <tr>
				  	<form name="form_mark" method="post" action="code.php?section={$section}">
					<input name="mark" type="hidden" value="{$order.order_id}" />
                    <td bgcolor="#F8F8F8" class="table-line">{$order.order_id}</td>
                    <td bgcolor="#F8F8F8" class="table-line"><a href="mailto:{$order.order_email}" id="submenu">{$order.order_title} {$order.order_first_name} {$order.order_last_name}</a> </td>
                    <td bgcolor="#F8F8F8" class="table-line">{$order.departure_date|date_format:"%B %d, %Y"}</td>
                    <td bgcolor="#F8F8F8" class="table-line">{$order.departure_time|truncate:5:""}</td>
                    <td bgcolor="#F8F8F8" class="table-line">{$order.boat_name}</td>
                    <td bgcolor="#F8F8F8" class="table-line">&pound;{$order.order_total}</td>
                    <td width="5%" bgcolor="#F8F8F8" class="table-line">
						{if $order.order_used==0}
							<a href="javascript:document.form_mark.submit();"  onclick="return confirm('Are you sure you want to mark this ticket as used?');"><img src="images/icons/lock_ok_16.gif" width="16" height="16" border="0"></a>
						{else}
						<img src="images/icons/lock_16_dis.gif" width="16" height="16" vspace="2" border="0">
						{/if}
						&nbsp;<a href="javascript:openwind('edit_ticket.php?option=resellers&reseller_id={$order.order_reseller_id}&tour_id={$order.departure_tour_id}&code={$order.order_unique_code}', 600, 500, 'yes')"><img src="images/icons/config_clock_16.gif" title="Edit Ticket" border="0" height="16" width="16"></a>
					</td>
                    <td width="5%" bgcolor="#F8F8F8" class="table-line">
						<a href="javascript:view_ticket('{$order.order_unique_code}');"><img src="images/icons/mail_info_16.gif" width="16" height="16" vspace="2" border="0"></a>
					</td>
				  </form>
                  </tr>
                  {/section}

                </table></td>
              </tr>
            </table>
			{/if}
            <br>
            <br>
            <br></td>
      </tr>
    </table><br>
{/if}


{if $section == "vouchers"}
      <table width="850" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="220" valign="top" class="content-padding"><table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="txt-side">Entering the confirmation code sent out with the invoice will validate the authenticity of the ticket. </td>
              </tr>

          </table>
            <table width="90%" border="0" cellspacing="0" cellpadding="0">

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
                      <td width="13%"><img src="images/icons/mail_info_16.gif" alt="View voucher details" width="16" height="16" vspace="2"></td>
                      <td width="87%" class="txt-side">&nbsp;View voucher details</td>
                    </tr>
                  </table>
				  <table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					<td width="13%"><img src="images/icons/config_clock_16.gif" alt="Relocate Voucher" width="16" height="16" vspace="2"></td>
					<td width="87%" class="txt-side">&nbsp;Edit voucher</td>
				</tr>
	            </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/icon_ie.gif" alt="View html voucher" width="16" height="16" vspace="2"></td>
                        <td width="87%" class="txt-side">&nbsp;View html voucher</td>
                      </tr>
                    </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/icon_pdf.gif" alt="View pdf voucher" width="16" height="16" vspace="2"></td>
                        <td width="87%" class="txt-side">&nbsp;View pdf voucher</td>
                      </tr>
                  </table>
				  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="13%"><img src="images/icons/lock_ok_16.gif" alt="Mark Voucher  as Used" width="16" height="16" vspace="2"></td>
                      <td width="87%" class="txt-side">&nbsp;Voucher not Used </td>
                    </tr>
                  </table>
				   <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/lock_16_dis.gif" alt="Voucher Used" width="16" height="16" vspace="2"></td>
                        <td width="87%" class="txt-side">&nbsp;Voucher Used </td>
                      </tr>
                 </table></td>
              </tr>
            </table></td>
          <td width="630" valign="top" class="dotted-border content-padding2">
		  <p class="table-line"><a href="code.php?section=bookings">Tour Orders</a> | <strong>Voucher Orders</strong></p>
		  <table width="100%" border="0" cellspacing="1" cellpadding="0">
		  <form name="form_code" method="post" action="code.php?section={$section}">
            <tr>
              <td class="calendar-header-months"><table width="423" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="17%" class="sidetable-txt">Enter code: </td>
                  <td width="32%" class="sidetable-txt"><input name="query" type="text" class="cell-130"></td>
                  <td width="51%" class="sidetable-txt"><a href="javascript:document.form_code.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image14','','images/button-validate-on.gif',1)"><img src="images/button-validate-off.gif" name="Image14" width="77" height="19" border="0"></a></td>
                </tr>

              </table></td>
            </tr>
          </form>
		  </table>
		  {if !empty($message)}
          <br>
          <table width="100%" border="0" cellpadding="1" cellspacing="1">
            <tr>
              <td class="outline-grey"><table width="100%" border="0" cellpadding="3" cellspacing="0" bgcolor="#99FFCC">
                  <tr>
                    <td width="4%"><img src="images/icons/bulb_16_hot.gif" width="16" height="16"></td>
                    <td width="96%" class="txt-tahoma"><strong>{$message}</strong></td>
                  </tr>
                </table></td>
              </tr>
          </table>		  
		  {/if}		  
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/spacer.gif" width="10" height="10"></td>
              </tr>
            </table>
		  {if !empty($voucher_order)}
            <table width="100%" border="0" cellpadding="0" cellspacing="1" class="outline-grey">
                  <tr>

                    <td width="5%" class="table-header">No.</td>
                    <td width="25%" class="table-header">Name</td>
                    <td width="10%" class="table-header">Voucher</td>
                    <td width="10%" class="table-header">Voucher No.</td>
                    <td width="10%" class="table-header">Date</td>
                    <td width="8%" class="table-header">Total</td>
                    <td width="8%" class="table-header">Discount</td>
                    <td width="8%" class="table-header">Final price</td>
                    <td width="15%" class="table-header">&nbsp;&nbsp;</td>
                  </tr>
				  <tr bgcolor="{cycle values="#F8F8F8,#FFFFFF"}">
                    <td class="table-line">{$voucher_order.voucher_order_id}</td>
                    <td class="table-line"><a href="mailto:{$voucher_order.voucher_order_email}" id="submenu">{$voucher_order.voucher_order_to}</a> </td>
                    <td class="table-line">{$voucher_order.voucher_name}</td>
                    <td class="table-line">{$voucher_order.voucher_order_number}</td>
                    <td class="table-line">{$voucher_order.voucher_order_date|date_format:"%B %d, %Y"}</td>
                    <td class="table-line">&pound;{$voucher_order.voucher_order_total}</td>
                    <td class="table-line">{$voucher_order.voucher_discount}%</td>
                    <td class="table-line">&pound;{$voucher_order.voucher_order_discounted_total}</td>
                    <td class="table-line"><div align="center">
					{if $voucher_order.voucher_order_used==0}
						<img src="images/icons/lock_ok_16.gif" width="16" height="16" border="0">
					{else}
						<img src="images/icons/lock_16_dis.gif" width="16" height="16" vspace="2" border="0">
					{/if}
						<a href="javascript:openwind('edit_voucher.php?id={$voucher_order.voucher_order_unique_code}', 600, 500, 'yes')"><img src="images/icons/config_clock_16.gif"  title="Edit voucher" width="16" height="16" border="0"></a>
						<a href="javascript:view_voucher_details('{$voucher_order.voucher_order_unique_code}');"><img src="images/icons/mail_info_16.gif" alt="View voucher details" width="16" height="16" vspace="2" border="0"></a>
						<a href="javascript:view_html_voucher('{$voucher_order.voucher_order_unique_code}');"><img src="images/icons/icon_ie.gif" alt="View html voucher" width="16" height="16" vspace="2" border="0"></a>
						<a href="javascript:view_pdf_voucher('{$voucher_order.voucher_order_unique_code}');"><img src="images/icons/icon_pdf.gif" alt="View pdf voucher" width="16" height="16" vspace="2" border="0"></a>
					</div></td>
                  </tr>
                </table>

{/if}
            <br>
            <br>
            <br></td>
      </tr>
    </table><br>
{/if}