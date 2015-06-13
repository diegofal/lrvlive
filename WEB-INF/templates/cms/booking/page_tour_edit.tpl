<form name="editor_form" action="{$smarty.server.PHP_SELF}" method="post" enctype="multipart/form-data">
{if empty($tour_id)}
<input type="hidden" name="do" value="add">
{else}
<input name="tour_id" type="hidden" value="{$content.tour_id}" />	
<input type="hidden" name="do" value="update">
{/if}
  <table width="850" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td width="230" valign="top" class="content-padding"><table width="91%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="outline-orange">
		  <tr>
			<td class="table-paglistEditorAct">
			{if empty($tour_id)}
			<div align="left" class="txt-tahoma"><strong>Add new tour:</strong></div>
			{else}
			<div align="left" class="txt-tahoma"><strong>Edit tour:</strong></div>
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
		<td width="13%" class="txt-tahoma"><strong>Tour name: </strong></td>
		<td width="87%"><input name="tour_name" type="text" maxlength="100" value="{$content.tour_name}"  class="cell-100prc" /></td>
	  </tr>
	  <tr>
		<td valign="top" class="txt-tahoma"><strong>Meta Tags: </strong></td>
		<td><textarea name="page_meta" rows="4" class="cell-100prc-multi">{$content.page_meta}</textarea>
		</td>
	  </tr>	
	  <tr>
		<td valign="top" class="txt-tahoma"><strong>Tour Special Text (for homepage):</strong></td>
		<td><input name="tour_special_text_home" type="text" maxlength="100" value="{$content.tour_special_text_home}"  class="cell-100prc" />
		</td>
	  </tr>		
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Tour short name 1 (for homepage): </strong></td>
		<td width="87%"><input name="tour_home_name1" type="text" maxlength="100" value="{$content.tour_home_name1}"  class="cell-100prc" /></td>
	  </tr>
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Tour short name 2 (for homepage): </strong></td>
		<td width="87%"><input name="tour_home_name2" type="text" maxlength="100" value="{$content.tour_home_name2}"  class="cell-100prc" /></td>
	  </tr>
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Tour duration (for homepage): </strong></td>
		<td width="87%"><input name="tour_duration" type="text" maxlength="100" value="{$content.tour_duration}"  class="cell-100prc" /></td>
	  </tr>
	  <tr>
		<td valign="top" class="txt-tahoma"><strong>Short description: </strong></td>
		<td><textarea name="tour_short_description" rows="4" class="cell-100prc-multi">{$content.tour_short_description}</textarea>
		</td>
	  </tr>
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Image for homepage:</strong></td>
		<td width="87%">{if !empty($content.tour_home_image)}<img src="../img/tours/thumb/{$content.tour_home_image}">{/if}<input name="tour_home_image" type="file" class="cell-100prc" /></td>
	  </tr>
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Big Image:</strong></td>
		<td width="87%">{if !empty($content.tour_big_image)}<img src="../img/tours/thumb/{$content.tour_big_image}">{/if}<input name="tour_big_image" type="file" class="cell-100prc" /></td>
	  </tr>
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Image 1:</strong></td>
		<td width="87%">{if !empty($content.tour_image1)}<img src="../img/tours/thumb/{$content.tour_image1}">{/if}<input name="tour_image1" type="file" class="cell-100prc" /></td>
	  </tr>
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Image 2:</strong></td>
		<td width="87%">{if !empty($content.tour_image2)}<img src="../img/tours/thumb/{$content.tour_image2}">{/if}<input name="tour_image2" type="file" class="cell-100prc" /></td>
	  </tr>
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Image 3:</strong></td>
		<td width="87%">{if !empty($content.tour_image3)}<img src="../img/tours/thumb/{$content.tour_image3}">{/if}<input name="tour_image3" type="file" class="cell-100prc" /></td>
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
		<td width="13%" class="txt-tahoma"><strong>Charter Price: </strong></td>
		<td width="87%"><input name="tour_charter_price" type="text" maxlength="100" value="{$content.tour_charter_price}"  class="cell-100prc" /></td>
	  </tr>

	  <tr>
		<td colspan="2" valign="top" class="txt-tahoma"><span class="sidetable-txt"><img src="images/line-grey.gif" width="100%" height="1" vspace="5"></span></td>
		</tr>

	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Uses boats & tickets of: </strong></td>
		<td width="87%"><select class="cell-100prc" name="tour_shared_id">{html_options options=$tours selected=$content.tour_shared_id}</select></td>
	  </tr>
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Orders Prefix</strong></td>
		<td width="87%"><input name="tour_prefix" type="text" maxlength="100" value="{$content.tour_prefix}"  class="cell-100prc" /></td>
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