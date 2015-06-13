      <table width="850" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="220" valign="top" class="content-padding"><table width="91%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="txt-side">Vouchers page description. You may sort the list based on any table header. <br>
                <br>
                </td>
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
                         <td width="13%"><img src="images/icons/add_16.gif" width="16" height="16" border="0" alt="Add"></td>
                         <td width="87%" class="txt-side">Add new Voucher</td>
                     </tr>
                  </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" vspace="2" border="0"></td>
                        <td width="87%" class="txt-side">Edit Voucher</td>
                      </tr>
                    </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" vspace="2" border="0"></td>
                        <td width="87%" class="txt-side">Delete Voucher</td>
                      </tr>
                  </table></td>
              </tr>
          </table></td>
          <td width="630" valign="top" class="dotted-border content-padding2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/spacer.gif" width="10" height="10"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="1" class="outline-grey">
                  <tr>
                    <td width="15%" {$head.voucher_id}</td>
                    <td width="25%" {$head.voucher_name}</td>
                    <td width="25%" {$head.voucher_tour_id}</td>
                    <td width="15%" {$head.voucher_discount}</td>
                    <td width="20%" class="table-header">&nbsp;&nbsp; </td>
                  </tr>
				  {section name=i loop=$vouchers}
				  <tr bgcolor="{cycle values="#F8F8F8,#FFFFFF"}">
                    <td class="table-line">{$vouchers[i].voucher_id}</td>
                    <td class="table-line"><a href="voucher_edit.php?voucher_id={$vouchers[i].voucher_id}" id="submenu">{$vouchers[i].voucher_name}</a> </td>
                    <td class="table-line">{$vouchers[i].tour_name}</td>
                    <td class="table-line">{$vouchers[i].voucher_discount}%</td>
                    <td class="table-line"><div align="center">
					<a href="voucher_edit.php?voucher_id={$vouchers[i].voucher_id}"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" vspace="2" border="0"></a>
					<a href="vouchers.php?option=delete&voucher_id={$vouchers[i].voucher_id}" onclick="return confirm('Are you sure to delete this Voucher?');"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" vspace="2" border="0"></a>
					</div></td>
                  </tr>
				  {sectionelse}
				  <tr>
                    <td bgcolor="#F8F8F8" class="table-line" colspan="7">There are no Vouchers in database!</td>
				  </tr>
				  {/section} 
				  <tr bgcolor="#FFFFFF">
                    <td class="table-line">*</td>
                    <td colspan="3" class="table-line">Add new Voucher</td>
                    <td class="table-line"><div align="center"><a href="voucher_edit.php?option=add"><img src="images/icons/add_16.gif" alt="Add" width="16" height="16" vspace="2" border="0"></a></div>
					</td>
                  </tr>

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
