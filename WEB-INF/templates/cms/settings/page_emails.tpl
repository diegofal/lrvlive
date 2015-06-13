<form name="editor_form" action="{$smarty.server.PHP_SELF}" method="post">
  <table width="850" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td width="230" valign="top" class="content-padding"><table width="91%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="txt-side">Please use following wildcards:<br>
				%%USERNAME%% - to insert user name<br>
                %%DETAILS%% - to insert order or voucher details<br>
				%%COMMENTS%% - to insert admin order comments<br>
				%%LINK%% - to isert admin cms edit page link<br>
				</td>
              </tr>

	</table>
	  </td>
	<td width="620" valign="top" class="dotted-border content-padding2"><table width="100%" border="0" cellspacing="0" cellpadding="4">
	  <tr>
		<td colspan="2" valign="top" class="txt-tahoma"><strong>User order</strong><br>
		{$output}
		</td>
	  </tr>
	  <tr>
		<td colspan="2" valign="top" class="txt-tahoma"><strong>User order (Break The Barrier Tour #12)</strong><br>
		{$output5}
		</td>
	  </tr>
	  <tr>
		<td colspan="2" valign="top" class="txt-tahoma"><strong>Admin Order</strong><br>
		{$output1}
		</td>
	  </tr>
	  <tr>
		<td colspan="2" valign="top" class="txt-tahoma"><strong>Modified Order</strong><br>
		{$output2}
		</td>
	  </tr>
	  <tr>
		<td colspan="2" valign="top" class="txt-tahoma"><strong>User Voucher</strong><br>
		{$output3}
		</td>
	  </tr>
	  <tr>
		<td colspan="2" valign="top" class="txt-tahoma"><strong>Admin Voucher</strong><br>
		{$output4}
		</td>
	  </tr>	  
	  <tr>
		<td colspan="2" valign="top" class="txt-tahoma"><strong>Feedback</strong><br>
		{$output6}
		</td>
	  </tr>
	  <tr>
		<td colspan="2" valign="top" class="txt-tahoma"><span class="sidetable-txt">
		  <a href="javascript:document.editor_form.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image39','','images/button-submit-on.gif',1)"><img src="images/button-submit-off.gif" alt="Submit" name="Image39" width="63" height="23" border="0"></a>
		</span></td>
		</tr>			  
	</table>
	  <br></td>
  </tr>
</table>
</form>
<br>
<br>