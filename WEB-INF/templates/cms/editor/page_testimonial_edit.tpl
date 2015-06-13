<form name="editor_form" action="{$smarty.server.PHP_SELF}" method="post" enctype="multipart/form-data">

  <table width="850" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td width="230" valign="top" class="content-padding"><table width="91%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="outline-orange">
		  <tr>
			<td class="table-paglistEditorAct">
			{if empty($package_id)}
			<div align="left" class="txt-tahoma"><strong>Add New Testimonial:</strong></div>
			{else}
			<div align="left" class="txt-tahoma"><strong>Edit Testimonial:</strong></div>
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
		<td width="25%" class="txt-tahoma"><strong>Image for homepage:</strong></td>
		<td width="75%">{if !empty($content.TesimonialImage)}<img src="../img/testimonial/thumb/{$content.TesimonialImage}">{/if}<input name="TesimonialImage" type="file" class="cell-100prc" /></td>
	  </tr>
	  <tr>
	  	<td valign="top" class="txt-tahoma"><strong>Short description: </strong></td>
		<td colspan="2" valign="top" class="txt-tahoma"><textarea name="TestimonialDesc" rows="8" class="cell-100prc-multi">{$content.TestimonialDesc}</textarea></td>	  
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
{if empty($Tid)}
<input type="hidden" name="do" value="add">
{else}
<input name="Tid" type="hidden" value="{$content.Tid}" />	
<input type="hidden" name="do" value="update">
{/if}
</form>
<br>
<br>