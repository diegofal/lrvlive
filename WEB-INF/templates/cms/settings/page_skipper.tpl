      <table width="850" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="220" valign="top" class="content-padding"><table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="txt-side">Currently added skipper are listed in the table presented. To add a new skipper, use the form on the right. </td>
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
                      <td width="87%" class="txt-side">Edit Skipper </td>
                    </tr>
					   <tr>
                      <td width="13%"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" vspace="2" border="0"></td>
                      <td width="87%" class="txt-side">Delete Skipper </td>
                    </tr>
                  </table></td>
              </tr>
          </table></td>
          <td width="630" class="dotted-border content-padding2" style="padding-top:40px;">
		  <table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr>
                  <td width="56%" valign="top" class="outline-grey"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <tr>
                        <td width="65%" class="table-header">Skippers </td>
                        <td width="35%" class="table-header">&nbsp;</td>
                      </tr>
				   	 {section name=i loop=$skippers}
                      <tr  bgcolor="{cycle values="#F8F8F8,#FFFFFF"}">
                        <td class="table-line">{$skippers[i].skipper_name}</td>
                        <td nowrap class="table-line"><div align="left">&nbsp; <a href="skipper.php?option=edit&id={$skippers[i].skipper_id}"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" border="0"></a>&nbsp; &nbsp; <a href="skipper.php?option=delete&id={$skippers[i].skipper_id}" onclick="return confirm('Are you sure you want to delete this skipper?');"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" border="0"></a></div></td>
                      </tr>
  					  {sectionelse}
                      <tr>
                        <td colspan="3" bgcolor="#F8F8F8" class="table-line">There are no skippers!</td>
                      </tr>
					  {/section}				
                  </table></td>
				  <form name="skipper_edit" method="post" action="" onsubmit="validate(); return returnVal;">
               
                  <td width="44%" valign="top" class="outline-grey"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <tr>
                        <td class="table-header-light">&nbsp; {if $smarty.get.option == edit}Edit{else}Add new{/if} Skipper: </td>
                      </tr>
                      <tr>
                        <td valign="top" class="sitetable-padding"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                            
                            <tr>
                              <td width="39%" class="sidetable-txt">Skipper name: </td>
                              <td width="61%" class="sidetable-txt"><input name="skipper_name" type="text" maxlength="50" value="{$skipper[0].skipper_name}" class="cell-130" />						  
							  </td>
                            </tr>
                            <tr>
                              <td colspan="2" class="sidetable-txt"><img src="images/line-grey.gif" width="100%" height="1"></td>
                            </tr>
                            <tr>
                              <td colspan="2" class="sidetable-txt"><div align="center"><a href="javascript:document.skipper_edit.submit();" onclick="validate(); return returnVal;" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image39','','images/button-submit-on.gif',1)"><img src="images/button-submit-off.gif" alt="Submit" name="Image39" width="63" height="23" border="0"></a></div></td>
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