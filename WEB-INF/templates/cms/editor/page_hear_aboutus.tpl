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
                      <td width="87%" class="txt-side">Edit Hear About us </td>
                    </tr>
					   <tr>
                      <td width="13%"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" vspace="2" border="0"></td>
                      <td width="87%" class="txt-side">Delete Hear About us </td>
                    </tr>
                  </table></td>
              </tr>
          </table></td>
          <td width="630" class="dotted-border content-padding2" style="padding-top:40px;">
		  <table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr>
                  <td width="56%" valign="top" class="outline-grey"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <tr>
                        <td width="65%" class="table-header">Hear About us </td>
                        <td width="35%" class="table-header">&nbsp;</td>
                      </tr>
				   	 {section name=i loop=$tbl_hear_about_us}
                      <tr  bgcolor="{cycle values="#F8F8F8,#FFFFFF"}">
                        <td class="table-line">{$tbl_hear_about_us[i].Title}</td>
                        <td nowrap class="table-line"><div align="left">&nbsp; <a href="hear_aboutus.php?option=edit&id={$tbl_hear_about_us[i].Hid}"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" border="0"></a>&nbsp; &nbsp; <a href="hear_aboutus.php?option=delete&id={$tbl_hear_about_us[i].Hid}" onclick="return confirm('Are you sure you want to delete this hear about us?');"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" border="0"></a></div></td>
                      </tr>
  					  {sectionelse}
                      <tr>
                        <td colspan="3" bgcolor="#F8F8F8" class="table-line">There are no hear about us details!</td>
                      </tr>
					  {/section}				
                  </table></td>
				  <form name="hearaboutus_edit" method="post" action="" onsubmit="validate(); return returnVal;">
               
                  <td width="44%" valign="top" class="outline-grey"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <tr>
                        <td class="table-header-light">&nbsp; {if $smarty.get.option == edit}Edit{else}Add New{/if} Hear About us: </td>
                      </tr>
                      <tr>
                        <td valign="top" class="sitetable-padding"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                            
                            <tr>
                              <td width="39%" class="sidetable-txt">Title: </td>
                              <td width="61%" class="sidetable-txt"><input name="Title" type="text" maxlength="50" value="{if $smarty.get.option == edit}{$tbl_hear_about_us[0].Title}{/if}" class="cell-130" />						  
							  </td>
                            </tr>
                            <tr>
                              <td colspan="2" class="sidetable-txt"><img src="images/line-grey.gif" width="100%" height="1"></td>
                            </tr>
                            <tr>
                              <td colspan="2" class="sidetable-txt"><div align="center"><a href="javascript:document.hearaboutus_edit.submit();" onclick="validate(); return returnVal;" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image39','','images/button-submit-on.gif',1)"><img src="images/button-submit-off.gif" alt="Submit" name="Image39" width="63" height="23" border="0"></a></div></td>
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