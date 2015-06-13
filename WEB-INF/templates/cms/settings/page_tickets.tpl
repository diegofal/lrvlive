      <table width="850" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="220" valign="top" class="content-padding"><table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="txt-side">Currently added tickets are listed in the table presented. To add a new ticket, use the form on the right. </td>
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
                      <td width="13%"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" vspace="2" border="0"></td>
                      <td width="87%" class="txt-side">Edit Ticket</td>
                    </tr>
                  </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" vspace="2" border="0"></td>
                        <td width="87%" class="txt-side">Delete Ticket</td>
                      </tr>
                  </table></td>
              </tr>
          </table></td>
          <td width="630" class="dotted-border content-padding2">
		<form name="filter_form">
		<p class="txt-side">Please select tour : 
			<select name="filter" class="cell-130" onchange="filter_tours();">
			{section name=i loop=$tours}
			<option value="{$tours[i].tour_id}" {if $smarty.get.tour_id==$tours[i].tour_id}selected{/if}>{$tours[i].tour_name}</option>
			{/section}
			</select>
		</p>
		</form>
		<table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr>
                  <td width="56%" valign="top" class="outline-grey"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <tr>
                        <td width="43%" class="table-header">Ticket Name </td>
                        <td width="34%" class="table-header">Price</td>
                        <td width="23%" class="table-header">&nbsp;</td>
                      </tr>
				   	 {section name=i loop=$tickets}
                      <tr  bgcolor="{cycle values="#F8F8F8,#FFFFFF"}">
                        <td class="table-line">{$tickets[i].ticket_type}</td>
                        <td class="table-line">&pound;{$tickets[i].ticket_price}</td>
                        <td nowrap class="table-line"><div align="left">&nbsp; <a href="tickets.php?tour_id={$tour_id}&option=edit&id={$tickets[i].ticket_id}"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" border="0"></a>&nbsp; &nbsp; <a href="tickets.php?option=delete&id={$tickets[i].ticket_id}" onclick="return confirm('Are you sure you want to delete this ticket?');"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" border="0"></a></div></td>
                      </tr>
  					  {sectionelse}
                      <tr>
                        <td colspan="3" bgcolor="#F8F8F8" class="table-line">There are no tickets defined!</td>
                      </tr>
					  {/section}				
                  </table></td>
				  <form name="ticket_edit" method="post" action="tickets.php?tour_id={$tour_id}&option={$smarty.get.option}&id={$smarty.get.id}" onsubmit="validate(); return returnVal;">
                  <input type="hidden" name="ticket_tour_id" value="{$tour_id}" />           
                  <td width="44%" valign="top" class="outline-grey"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <tr>
                        <td class="table-header-light">&nbsp; {if $smarty.get.option == edit}Edit{else}Add new{/if} ticket: </td>
                      </tr>
                      <tr>
                        <td valign="top" class="sitetable-padding"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                            
                            <tr>
                              <td width="39%" class="sidetable-txt">Ticket name: </td>
                              <td width="61%" class="sidetable-txt"><input name="ticket_type" type="text" maxlength="50" value="{$ticket.ticket_type}" class="cell-130" /></td>
                            </tr>
                            <tr>
                              <td class="sidetable-txt"> Price: </td>
                              <td class="sidetable-txt"><input name="ticket_price" type="text" maxlength="5" value="{$ticket.ticket_price}"  class="sidetable-dropdown3" /></td>
                            </tr>
                            <tr>
                              <td class="sidetable-txt"> Seats: </td>
                              <td class="sidetable-txt"><input name="ticket_seats" type="text" maxlength="2" value="{$ticket.ticket_seats}"  class="sidetable-dropdown2" /></td>
                            </tr>							
                            <tr>
                              <td colspan="2"> <input name="ticket_special" value="1" type="checkbox" {if $ticket.ticket_special==1}checked="checked"{/if} /> <span class="sidetable-txt" >Check for special offer</span></td>
                            </tr>							
                            <tr>
                              <td colspan="2" class="sidetable-txt"><img src="images/line-grey.gif" width="100%" height="1"></td>
                            </tr>
                            <tr>
                              <td colspan="2" class="sidetable-txt"><div align="center"><a href="javascript: document.ticket_edit.submit();" onclick="validate(); return returnVal;" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image39','','images/button-submit-on.gif',1)"><img src="images/button-submit-off.gif" alt="Submit" name="Image39" width="63" height="23" border="0"></a></div></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
               	  </form>
			    </tr>
              </table>
            <br></td></tr>
      </table>
      <br>