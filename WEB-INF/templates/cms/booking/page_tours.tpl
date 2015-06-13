      <table width="850" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="220" valign="top" class="content-padding"><table width="91%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="txt-side">Tours page description. You may sort the list based on any table header. <br>
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
                         <td width="87%" class="txt-side">Add new Tour</td>
                     </tr>
                  </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" vspace="2" border="0"></td>
                        <td width="87%" class="txt-side">Edit Tour</td>
                      </tr>
                    </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" vspace="2" border="0"></td>
                        <td width="87%" class="txt-side">Delete Tour</td>
                      </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/mail_info_16.gif" alt="View Calendar for this Tour" width="16" height="16" vspace="2" border="0"></td>
                        <td width="87%" class="txt-side">View Calendar for this Tour</td>
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
                    <td width="15%" {$head.tour_id}</td>
                    <td width="40%" {$head.tour_name}</td>
                    <td width="25%" {$head.tour_charter_price}</td>
                    <td width="30%" class="table-header">&nbsp;&nbsp; </td>
                  </tr>
				  {section name=i loop=$tours}
				  <tr bgcolor="{cycle values="#F8F8F8,#FFFFFF"}">
                    <td class="table-line">{$tours[i].tour_id}</td>
                    <td class="table-line"><a href="calendar.php" id="submenu">{$tours[i].tour_name}</a> </td>
                    <td class="table-line">{$tours[i].tour_charter_price}</td>
                    <td class="table-line"><div align="center">
					<a href="calendar.php"><img src="images/icons/mail_info_16.gif" alt="View Calendar for this Tour" width="16" height="16" vspace="2" border="0"></a>
					<a href="tour_edit.php?tour_id={$tours[i].tour_id}"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" vspace="2" border="0"></a>
					<a href="tours.php?option=delete&tour_id={$tours[i].tour_id}" onclick="return confirm('Are you sure to delete this Tour?\n(All boats and tickets associated with this tour - will be also deleted)');"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" vspace="2" border="0"></a>
					</div></td>
                  </tr>
				  {sectionelse}
				  <tr>
                    <td bgcolor="#F8F8F8" class="table-line" colspan="7">There are no tours in database!</td>
				  </tr>
				  {/section} 
				  <tr bgcolor="#FFFFFF">
                    <td class="table-line">*</td>
                    <td class="table-line" colspan="2">Add new Tour</td>
                    <td class="table-line"><div align="center"><a href="tour_edit.php?option=add"><img src="images/icons/add_16.gif" alt="Add" width="16" height="16" vspace="2" border="0"></a></div>
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
