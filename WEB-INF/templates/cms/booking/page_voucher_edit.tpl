<form name="editor_form" action="{$smarty.server.PHP_SELF}" method="post" enctype="multipart/form-data">
{if empty($voucher_id)}
<input type="hidden" name="do" value="add">
{else}
<input name="voucher_id" type="hidden" value="{$content.voucher_id}" />	
<input type="hidden" name="do" value="update">
{/if}
  <table width="850" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td width="230" valign="top" class="content-padding"><table width="91%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="outline-orange">
		  <tr>
			<td class="table-paglistEditorAct">
			{if empty($voucher_id)}
			<div align="left" class="txt-tahoma"><strong>Add new Voucher:</strong></div>
			{else}
			<div align="left" class="txt-tahoma"><strong>Edit Voucher:</strong></div>
			{/if}
			</td>
		  </tr>
		</table>
		  <br>
		  </td>
	  </tr>
	</table>
	  </td>
	<td width="620" valign="top" class="dotted-border content-padding2">
	{if isset($error)}<p class="txt-tahoma" style="color:red">{$error}</p>{/if}
	<table width="100%" border="0" cellspacing="0" cellpadding="4">
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Name: </strong></td>
		<td width="87%"><input name="voucher_name" type="text" maxlength="100" value="{$content.voucher_name}"  class="cell-100prc" /></td>
	  </tr>
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Select Tour: </strong></td>
		<td width="87%">		  <select name="voucher_tour_id" class="cell-130">
			{section name=i loop=$tours}
			<option value="{$tours[i].tour_id}" {if $content.voucher_tour_id==$tours[i].tour_id}selected{/if}>{$tours[i].tour_name}</option>
			{/section}
			</select></td>
	  </tr>
	  <tr>
		<td valign="top" class="txt-tahoma"><strong>Description: </strong></td>
		<td><textarea name="voucher_description" rows="4" class="cell-100prc-multi">{$content.voucher_description}</textarea>
		</td>
	  </tr>
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Discount: </strong></td>
		<td width="5%"><input name="voucher_discount" type="text" maxlength="5" value="{$content.voucher_discount}"  size="3" /> %</td>
	  </tr>
	  <tr>
		<td colspan="2" valign="top" class="txt-tahoma"><span class="sidetable-txt"><img src="images/line-grey.gif" width="100%" height="1" vspace="5"></span></td>
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