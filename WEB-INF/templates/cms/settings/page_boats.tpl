      <table width="850" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="220" valign="top" class="content-padding"><table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="txt-side">Currently added boats are listed in the table presented. To add a new boat, use the form on the right. </td>
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
                      <td width="87%" class="txt-side">Edit Boat </td>
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
                        <td width="5%" class="table-header">ID</td>
                        <td width="45%" class="table-header">Boat</td>
                        <td width="15%" class="table-header">Seats</td>
                        <td width="15%" class="table-header">Active</td>
                        <td width="20%" class="table-header">&nbsp;</td>
                      </tr>
					  {section name=i loop=$boats}
                      <tr bgcolor="{cycle values="#F8F8F8,#FFFFFF"}">
                        <td class="table-line">{$boats[i].boat_id}</td>
                        <td class="table-line">{$boats[i].boat_name}</td>
                        <td class="table-line">{$boats[i].boat_passengers}</td>
                        <td class="table-line">{if $boats[i].boat_del == 0}Yes{else}No{/if}</td>
                        <td class="table-line"><div align="left">&nbsp; <a href="boats.php?tour_id={$tour_id}&option=edit&id={$boats[i].boat_id}"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" border="0"></a></div></td>
                      </tr>
  					  {sectionelse}
                      <tr>
                        <td colspan="6" bgcolor="#F8F8F8" class="table-line">There are no boats defined!</td>
                      </tr>
					  {/section}						 
                  </table></td>
				  <form name="boat_edit" method="post" action="boats.php?tour_id={$tour_id}&option={$smarty.get.option}&id={$smarty.get.id}" onsubmit="validate(); return returnVal;">
                  <input type="hidden" name="boat_tour_id" value="{$tour_id}" />     
                  {if $smarty.get.option != edit}
                    <input type="hidden" name="boat_del" value="0" /> 
                  {/if}
                  <td width="44%" valign="top" class="outline-grey"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <tr>
                        <td class="table-header-light">&nbsp;{if $smarty.get.option == edit}Edit{else}Add new{/if} boat: </td>
                      </tr>
                      <tr>
                        <td class="sitetable-padding"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                            
                            <tr>
                              <td width="39%" class="sidetable-txt">Boat name: </td>
                              <td width="61%" class="sidetable-txt"><input name="boat_name" type="text" maxlength="50" value="{$boat.boat_name}" class="cell-130" /></td>
                            </tr>
                            <tr>
                              <td class="sidetable-txt"> Seats: </td>
                              <td class="sidetable-txt"><input name="boat_passengers" type="text" maxlength="5" value="{$boat.boat_passengers}"  class="sidetable-dropdown3" /></td>
                            </tr>
							{if $smarty.get.option == edit}
                            <tr>
                              <td class="sidetable-txt">Active/Not: </td>
                              <td class="sidetable-txt"><input name="boat_del" type="checkbox" {if $boat.boat_del == 0} checked{/if}/></td>
                            </tr>
							{/if}
                            <tr>
                              <td colspan="2" class="sidetable-txt"><img src="images/line-grey.gif" width="100%" height="1"></td>
                            </tr>
                            <tr>
                              <td colspan="2" class="sidetable-txt"><div align="center"><a href="javascript: document.boat_edit.submit();" onclick="validate(); return returnVal;" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image39','','images/button-submit-on.gif',1)"><img src="images/button-submit-off.gif" alt="Submit" name="Image39" width="63" height="23" border="0"></a></div></td>
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



