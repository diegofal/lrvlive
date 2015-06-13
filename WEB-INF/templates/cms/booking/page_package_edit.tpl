<form name="editor_form" action="{$smarty.server.PHP_SELF}" method="post" enctype="multipart/form-data">

  <table width="850" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td width="230" valign="top" class="content-padding"><table width="91%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="outline-orange">
		  <tr>
			<td class="table-paglistEditorAct">
			{if empty($package_id)}
			<div align="left" class="txt-tahoma"><strong>Add new Corporate Package:</strong></div>
			{else}
			<div align="left" class="txt-tahoma"><strong>Edit Corporate Package:</strong></div>
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
		<td width="13%" class="txt-tahoma"><strong>Package name: </strong></td>
		<td width="87%"><input name="package_name" type="text" maxlength="100" value="{$content.package_name}"  class="cell-100prc" /></td>
	  </tr>
	  <tr>
		<td valign="top" class="txt-tahoma"><strong>Meta Tags: </strong></td>
		<td><textarea name="page_meta" rows="4" class="cell-100prc-multi">{$content.page_meta}</textarea>
		</td>
	</tr>
	  <tr>
		<td valign="top" class="txt-tahoma"><strong>Short description: </strong></td>
		<td><textarea name="package_short_description" rows="4" class="cell-100prc-multi">{$content.package_short_description}</textarea>
		</td>
	  </tr>
	   <tr>
		<td width="13%" class="txt-tahoma"><strong>Image for homepage:</strong></td>
		<td width="87%">{if !empty($content.package_home_image)}<img src="../img/packages/thumb/{$content.package_home_image}">{/if}<input name="package_home_image" type="file" class="cell-100prc" /></td>
	  </tr>
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Big Image:</strong></td>
		<td width="87%">{if !empty($content.package_big_image)}<img src="../img/packages/thumb/{$content.package_big_image}">{/if}<input name="package_big_image" type="file" class="cell-100prc" /></td>
	  </tr>
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Image 1:</strong></td>
		<td width="87%">{if !empty($content.package_image1)}<img src="../img/packages/thumb/{$content.package_image1}">{/if}<input name="package_image1" type="file" class="cell-100prc" /></td>
	  </tr>
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Image 2:</strong></td>
		<td width="87%">{if !empty($content.package_image2)}<img src="../img/packages/thumb/{$content.package_image2}">{/if}<input name="package_image2" type="file" class="cell-100prc" /></td>
	  </tr>
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Image 3:</strong></td>
		<td width="87%">{if !empty($content.package_image3)}<img src="../img/packages/thumb/{$content.package_image3}">{/if}<input name="package_image3" type="file" class="cell-100prc" /></td>
	  </tr>
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Image 4:</strong></td>
		<td width="87%">{if !empty($content.package_image4)}<img src="../img/packages/thumb/{$content.package_image4}">{/if}<input name="package_image4" type="file" class="cell-100prc" /></td>
	  </tr>
	  <tr>
		<td colspan="2" valign="top" class="txt-tahoma"><span class="sidetable-txt"><img src="images/line-grey.gif" width="100%" height="1" vspace="5"></span></td>
		</tr>
	  <tr>
		<td colspan="2" valign="top" class="txt-tahoma">
		{$output}
		</td>
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
{if empty($package_id)}
<input type="hidden" name="do" value="add">
{else}
<input name="package_id" type="hidden" value="{$content.package_id}" />	
<input type="hidden" name="do" value="update">
{/if}
</form>
<br>
<br>