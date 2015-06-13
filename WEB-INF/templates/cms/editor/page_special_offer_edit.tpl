<form name="editor_form" action="{$smarty.server.PHP_SELF}" method="post" enctype="multipart/form-data">

  <table width="850" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td width="230" valign="top" class="content-padding"><table width="91%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="outline-orange">
		  <tr>
			<td class="table-paglistEditorAct">
			{if empty($package_id)}
			<div align="left" class="txt-tahoma"><strong>Add new Special Offer:</strong></div>
			{else}
			<div align="left" class="txt-tahoma"><strong>Edit Special Offer:</strong></div>
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
		<td width="25%" class="txt-tahoma"><strong>Special offer name: </strong></td>
		<td width="75%"><input name="OfferTitle" type="text" maxlength="100" value="{$content.OfferTitle}"  class="cell-100prc_new" /></td>
	  </tr>
	  <tr>
	  	<td valign="top" class="txt-tahoma"><strong>Short description: </strong></td>
		<td valign="top" class="txt-tahoma">{$output}</td>	  
	  </tr>
	 <!-- <tr>
		<td valign="top" class="txt-tahoma"><strong>Short description: </strong></td>
		<td><textarea name="OfferDescription" rows="4" class="cell-100prc-multi_new">{$content.OfferDescription}</textarea>
		</td>
	  </tr>
	   <tr>
		<td valign="top" class="txt-tahoma"><strong>Background Color: </strong></td>
		<td><input name="OfferBackground" type="text" maxlength="100" value="{$content.OfferBackground}"  class="cell-100prc_new_1" id="colorcode"/>
			<a href="javascript:showColorPicker()" class="style112">Showcolorpicker</a>
			<div><script>drawColorPicker()</script></div>
		</td>
	  </tr>-->
	  
	   <tr>
		<td class="txt-tahoma"><strong>Image for top:</strong></td>
		<td>{if !empty($content.OfferTopimage)}<img src="../img/special_offer/thumb/{$content.OfferTopimage}">{/if}<input name="OfferTopimage" type="file" class="cell-100prc" />&nbsp;&nbsp;<a href="http://www.londonribvoyages.com/images/ab_t_1r.jpg" style="font-family:Tahoma, Arial, Helvetica; font-size:12px; color:#1B5FA9;" target="_blank">view sample file</a></td>
	  </tr>
	  <tr>
		<td class="txt-tahoma"><strong>Image for middle:</strong></td>
		<td>{if !empty($content.OfferMiddleimage)}<img src="../img/special_offer/thumb/{$content.OfferMiddleimage}">{/if}<input name="OfferMiddleimage" type="file" class="cell-100prc" />&nbsp;&nbsp;<a href="http://www.londonribvoyages.com/images/ab_t_middle.jpg" style="font-family:Tahoma, Arial, Helvetica; font-size:12px; color:#1B5FA9;" target="_blank">view sample file</a></td>
	  </tr>
	  <tr>
		<td class="txt-tahoma"><strong>Image for bottom:</strong></td>
		<td>{if !empty($content.OfferBottomimage)}<img src="../img/special_offer/thumb/{$content.OfferBottomimage}">{/if}<input name="OfferBottomimage" type="file" class="cell-100prc" />&nbsp;&nbsp;<a href="http://www.londonribvoyages.com/images/ab_t_bottom1.gif" style="font-family:Tahoma, Arial, Helvetica; font-size:12px; color:#1B5FA9;" target="_blank">view sample file</a></td>
	  </tr>
<!--	   <tr>
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
	  </tr>-->	
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
{if empty($OfferId)}
<input type="hidden" name="do" value="add">
{else}
<input name="OfferId" type="hidden" value="{$content.OfferId}" />	
<input type="hidden" name="do" value="update">
{/if}
</form>
<br>
<br>