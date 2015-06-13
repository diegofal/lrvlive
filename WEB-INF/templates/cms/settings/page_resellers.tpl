     
	  <table width="850" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="220" valign="top" class="content-padding"><table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="txt-side">Resselers: </td>
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
                      <td width="87%" class="txt-side">Edit resseler</td>
                    </tr>
                  </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" vspace="2" border="0"></td>
                        <td width="87%" class="txt-side">Delete resseler</td>
                      </tr>
                  </table></td>
              </tr>
          </table></td>
          <td width="630" class="dotted-border content-padding2">
			<!-- Table resellers -->
			<table width="100%" border="0" cellspacing="1" cellpadding="0">
			                <tr>
			                  <td width="50%" valign="top" class="outline-grey"><table width="100%" border="0" cellspacing="1" cellpadding="0">
			                      <tr>
			                        <td width="43%" class="table-header">Resseler Name </td>
			                        <td width="23%" class="table-header">&nbsp;</td>
			                      </tr>
							   	{section name=i loop=$resellers}
			                      <tr  bgcolor="{cycle values="#F8F8F8,#FFFFFF"}">
			                        <td class="table-line">{$resellers[i].reseller_name}</td>
			                        <td nowrap class="table-line"><div align="left">&nbsp;
                                            <a href="resellers.php?option=edit&id={$resellers[i].reseller_id}">
                                                <img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" border="0">
                                            </a>&nbsp; &nbsp;

                                            <a href="resellers.php?option=delete&id={$resellers[i].reseller_id}" onclick="return confirm('Are you sure you want to delete this reseller?');">
                                                <img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" border="0">
                                            </a>
                                        </div>
                                    </td>
			                      </tr>
			  					  {sectionelse}
			                      <tr>
			                        <td colspan="3" bgcolor="#F8F8F8" class="table-line">There are no resellers defined!</td>
			                      </tr>
								  {/section}				
			                  </table>
			<!-- end table resellers -->
		  </td>
		  <form name="resellers_edit" method="post" action="resellers.php?option={$smarty.get.option}&id={$smarty.get.id}" onsubmit="validate(); return returnVal;">
	               <input type="hidden" name="ticket_tour_id" value="{$tour_id}" />           
	               <td width="50%" valign="top" class="outline-grey">
			<!-- Table edit-submit -->
			<table width="100%" border="0" cellspacing="1" cellpadding="0">
				<tr>
					<td class="table-header-light">&nbsp; {if $smarty.get.option == edit}Edit{else}Add new{/if} resseler: </td>
				</tr>
				<tr>
					<td valign="top" class="sitetable-padding"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
				                            
				<tr>
					<td width="39%" class="sidetable-txt">Name: </td>
					<td width="61%" class="sidetable-txt"><input name="reseller_name" type="text" maxlength="50" value="{$reseller.reseller_name}" class="cell-130" /></td>
				</tr>
				{section name=x loop=$tours}
					<tr>
			        	<td colspan="2" class="sidetable-txt"><br /><img src="images/line-grey.gif" width="100%" height="1"><br /></td>
			        </tr>
					<tr>
			        	<td colspan="2" class="sidetable-txt">{$tours[x].tour_name}<br /><br /></td>
			        </tr>
						{section name=i loop=$tickets}
								{if $tickets[i].ticket_tour_id == $tours[x].tour_id}
				               	<tr>
			                    	<td class="table-line"> {$tickets[i].ticket_type} &pound;: </td>
			                    	<td class="sidetable-txt"><input type="text" maxlength="8" value="&pound;{$tickets[i].ticket_price}"  class="sidetable-dropdown5" disabled /><input name="reseller_ticket_{$tickets[i].ticket_id}" type="text" maxlength="5" class="sidetable-dropdown5" value="{section name=t loop=$reseller_tickets}{if $tickets[i].ticket_id == $reseller_tickets[t].ticket_id}{$reseller_tickets[t].ticket_price}{/if}{/section}" /></td>
			                    </tr>
								{/if}
				               	{sectionelse}
								<tr>
					            	<td colspan="3" bgcolor="#F8F8F8" class="table-line">There are no tickets defined!</td>
					            </tr>
						{/section}
						<tr>
			            	<td class="table-line"> Charter &pound;: </td>
			            	<td class="sidetable-txt"><input name="reseller_charter_{$tours[x].tour_id}" type="text" maxlength="8" class="sidetable-dropdown5" value="{section name=t loop=$reseller_cmns}{if $tours[x].tour_id == $reseller_cmns[t].reseller_tour_id}{$reseller_cmns[t].reseller_charter}{/if}{/section}" /></td>
			            </tr>
						<tr>
			            	<td class="table-line"> Commission %: </td>
			            	<td class="sidetable-txt"><input name="reseller_commission_{$tours[x].tour_id}" type="text" maxlength="8" class="sidetable-dropdown5" value="{section name=t loop=$reseller_cmns}{if $tours[x].tour_id == $reseller_cmns[t].reseller_tour_id}{$reseller_cmns[t].reseller_cmn}{/if}{/section}" /></td>
			            </tr>
				{/section}
				 <tr>
					<td colspan="2" class="sidetable-txt"><br /><img src="images/line-grey.gif" width="100%" height="1"></td>
				</tr>
				<tr>
					<td colspan="2" class="sidetable-txt"><br /><div align="center"><a href="javascript: document.resellers_edit.submit();" onclick="validate(); return returnVal;" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image39','','images/button-submit-on.gif',1)"><img src="images/button-submit-off.gif" alt="Submit" name="Image39" width="63" height="23" border="0"></a></div></td>
				</tr>
			</table>
			<!-- end table edit-submit -->		
		  </td>
	            </tr>
	           </table></td>
	          	  </form>
	  </tr>
	         </table>
	       <br></td></tr>
	 </table>
	 <br>