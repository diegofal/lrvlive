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
                      <td width="13%"><img src="images/icons/mail_info_16.gif" alt="View voucher details" width="16" height="16" vspace="2"></td>
                      <td width="87%" class="txt-side">&nbsp;View voucher details</td>
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
					<td width="13%"><img src="images/icons/config_clock_16.gif" alt="Relocate Voucher" width="16" height="16" vspace="2"></td>
					<td width="87%" class="txt-side">&nbsp;Edit voucher</td>
				</tr>
	            </table>
				  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="13%"><img src="images/icons/lock_ok_16.gif" alt="Mark Voucher  as Used" width="16" height="16" vspace="2"></td>
                      <td width="87%" class="txt-side">&nbsp;Mark voucher as Used </td>
                    </tr>
                  </table>
				  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/lock_16_dis.gif" alt="Voucher Used" width="16" height="16" vspace="2"></td>
                        <td width="87%" class="txt-side">&nbsp;Voucher Used </td>
                      </tr>
                 </table>
				 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/del_16.gif" alt="Delete Voucher" width="16" height="16" vspace="2"></td>
                        <td width="87%" class="txt-side">&nbsp;Delete Voucher </td>
                      </tr>
                 </table></td>
              </tr>
          </table></td>
          <td width="700" valign="top" class="dotted-border content-padding2">
			<p class="table-line"><a href="orders.php">Tour Orders</a> | <strong>Voucher Orders</strong></p>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/spacer.gif" width="10" height="10"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="1" class="outline-grey">
                  <tr>
                    <td width="5%" {$head.voucher_order_id}</td>
                    <td width="25%" {$head.voucher_order_to}</td>
                    <td width="10%" {$head.voucher_name}</td>
                    <td width="10%" {$head.voucher_order_number}</td>
                    <td width="10%" {$head.voucher_order_date}</td>
                    <td width="8%" {$head.voucher_order_total}</td>
                    <td width="4%" {$head.voucher_discount}</td>
                    <td width="8%" {$head.voucher_order_discounted_total}</td>
                    <td width="15%" class="table-header">&nbsp;&nbsp;</td>
                  </tr>
				  {section name=i loop=$voucher_orders}
				  {if $voucher_orders[i].voucher_order_delete==0}
				  <tr bgcolor="{cycle values="#F8F8F8,#FFFFFF"}">
                    <td class="table-line">{$voucher_orders[i].voucher_order_id}</td>
                    <td class="table-line"><a href="mailto:{$voucher_orders[i].voucher_order_email}" id="submenu">{$voucher_orders[i].voucher_order_to}</a> </td>
                    <td class="table-line">{$voucher_orders[i].voucher_name}</td>
                    <td class="table-line">{$voucher_orders[i].voucher_order_number}</td>
                    <td class="table-line">{$voucher_orders[i].voucher_order_date|date_format:"%B %d, %Y"}</td>
                    <td class="table-line">&pound;{$voucher_orders[i].voucher_order_total}</td>
                    <td class="table-line">{$voucher_orders[i].voucher_discount}%</td>
                    <td class="table-line">&pound;{$voucher_orders[i].voucher_order_discounted_total}</td>
                    <td class="table-line"><div align="center">
					{if $voucher_orders[i].voucher_order_used==0}
						<a href="voucher_orders.php?&option=use&mark={$voucher_orders[i].voucher_order_unique_code}"  onclick="return confirm('Are you sure you want to mark this voucher as used?');"><img src="images/icons/lock_ok_16.gif" width="16" height="16" border="0"></a>
					{else}
						<img src="images/icons/lock_16_dis.gif" width="16" height="16" vspace="2" border="0">
					{/if}
						<a href="javascript:openwind('edit_voucher.php?id={$voucher_orders[i].voucher_order_unique_code}', 600, 500, 'yes')"><img src="images/icons/config_clock_16.gif"  title="Edit voucher" width="16" height="16" border="0"></a>
						<a href="javascript:view_voucher_details('{$voucher_orders[i].voucher_order_unique_code}');"><img src="images/icons/mail_info_16.gif" alt="View voucher details" width="16" height="16" vspace="2" border="0"></a>
						<a href="../vouchers/html.php?code={$voucher_orders[i].voucher_order_unique_code}" target="_blank"><img src="images/icons/icon_ie.gif" alt="View html voucher" width="16" height="16" vspace="2" border="0"></a>
						<a href="../vouchers/pdf.php?code={$voucher_orders[i].voucher_order_unique_code}" target="_blank"><img src="images/icons/icon_pdf.gif" alt="View pdf voucher" width="16" height="16" vspace="2" border="0"></a>
						<a href="voucher_orders.php?&option=delete&mark={$voucher_orders[i].voucher_order_unique_code}"  onclick="return confirm('Are you sure you want to delete this voucher?');"><img src="images/icons/del_16.gif" width="16" height="16" border="0"></a>
					</div></td>
                  </tr>
				  {/if}
				  {sectionelse}
				  <tr>
                    <td bgcolor="#F8F8F8" class="table-line" colspan="7">There are no voucher orders found!</td>
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
