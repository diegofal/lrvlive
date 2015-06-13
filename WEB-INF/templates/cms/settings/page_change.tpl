<form name="change_pass" action="change.php" method="post" onsubmit="validate(); return returnVal;">
      <table width="850" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="220" valign="top" class="content-padding"><table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="txt-side">Change your CMS login password by using the form on the right. </td>
              </tr>

          </table></td>
          <td width="630" class="dotted-border content-padding2">
		  {if !empty($message)}
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
          <br>
		  {/if}				  
		  <table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr>
              <td class="calendar-header-months"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="25%" class="sidetable-txt">Your current password: </td>
                    <td width="75%"> <input type="password" name="old_password" maxlength="10" class="cell-130"></td>
                    </tr>
              </table></td>
            </tr>
          </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/spacer.gif" width="10" height="4"></td>
              </tr>
            </table>
            <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
              <tr>
                <td width="25%" class="style1">New password: </td>
                <td width="75%"><input type="password" name="new_password" maxlength="10" class="cell-130"></td>
              </tr>
              <tr>
                <td class="style1">Retype new password: </td>
                <td width="75%"><input type="password" name="retype_new_password" maxlength="10" class="cell-130"></td>
              </tr>
              <tr>
                <td><img src="images/spacer.gif" width="10" height="4"></td>
              </tr>			  
              <tr>
                <td class="style1">&nbsp;</td>
                <td><a href="javascript: document.change_pass.submit();" onclick="validate(); return returnVal;" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image39','','images/button-submit-on.gif',1)"><img src="images/button-submit-off.gif" alt="Submit" name="Image39" width="63" height="23" border="0"></a></td>
              </tr>
            </table>
            <br></td>
        </tr>
      </table>
</form>
      <br>