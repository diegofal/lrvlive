<form name="editor_form" action="{$smarty.server.PHP_SELF}?subpage_id={$smarty.get.subpage_id}" method="post">
  <table width="850" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td width="230" valign="top" class="content-padding"><table width="91%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="outline-orange">
		 {foreach key=key item=item from=$menu_cms_pages}
		  <tr>
			<td {if empty($smarty.get.subpage_id) && ($smarty.get.option!=add)}class="table-paglistEditorAct"{else}class="table-paglistEditor"{/if}>
			{if $page != $key}
			<div align="left" class="txt-tahoma"><strong><a href="{$key}.php" class="submenu">{$item}</a></strong></div>
			{else}
			<div align="left" class="txt-tahoma"><strong>{$item}</strong></div>
			{/if}
			</td>
		  </tr>
		{/foreach}  
  
	{section name=i loop=$subpages}
		  <tr>
			<td {if $smarty.get.subpage_id!=$subpages[i].page_id}class="table-paglistEditor"{else}class="table-paglistEditorAct"{/if}><div align="left" class="txt-tahoma">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="21"><a href="{$smarty.server.PHP_SELF}?delete_id={$subpages[i].page_id}" onclick="return confirm('Are you sure to delete this page?');"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" border="0"></a></td>
					<td width="21">
						{if $smarty.section.i.first}
						<img src="images/icons/arrow-up_dis.gif" width="16" height="16" border="0">
						{else}
						<a href="{$smarty.server.PHP_SELF}?move_id1={$subpages[i].page_id}&move_id2={$subpages[i.index_prev].page_id}&pos1={$subpages[i].page_order}&pos2={$subpages[i.index_prev].page_order}"><img src="images/icons/arrow-up.gif" width="16" height="16" border="0"></a>
						{/if}
					</td>
					<td width="24">
						{if $smarty.section.i.last}
						<img src="images/icons/arrow-down_dis.gif" width="16" height="16" border="0">
						{else}
						<a href="{$smarty.server.PHP_SELF}?move_id1={$subpages[i].page_id}&move_id2={$subpages[i.index_next].page_id}&pos1={$subpages[i].page_order}&pos2={$subpages[i.index_next].page_order}"><img src="images/icons/arrow-down.gif" width="16" height="16" border="0"></a>
						{/if}
					</td>
					<td class="txt-tahoma">
					{if $smarty.get.subpage_id!=$subpages[i].page_id}
					<a href="{$smarty.server.PHP_SELF}?subpage_id={$subpages[i].page_id}" id="submenu">{$subpages[i].page_title}</a>
					{else}
					{$subpages[i].page_title}
					{/if}
					</td>
				  </tr>
				</table>
			</div></td>
		  </tr>
    {/section}
		</table>
		  </td>
	  </tr>
	</table>
	  </td>
	<td width="620" valign="top" class="dotted-border content-padding2"><table width="100%" border="0" cellspacing="0" cellpadding="4">
	{if !empty($smarty.get.subpage_id) || ($smarty.get.option==add)}
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Page name: </strong></td>
		<td width="87%"><input name="page_title" type="text" maxlength="100" value="{$content.page_name}"  class="cell-130" />
		<span class="txt-tahoma">(as it appears in the submenu)</span>
		</td>
	  </tr>
	  {/if}
	  <tr>
		<td width="13%" class="txt-tahoma"><strong>Page title: </strong></td>
		<td width="87%"><input name="page_title" type="text" maxlength="100" value="{$content.page_title}"  class="cell-100prc" /></td>
	  </tr>
	  <tr>
		<td valign="top" class="txt-tahoma"><strong>Meta Tags: </strong></td>
		<td><textarea name="page_meta" rows="4" class="cell-100prc-multi">{$content.page_meta}</textarea>
		</td>
	  </tr>
	  <tr>
		<td valign="top" class="txt-tahoma"><strong>Header text: </strong></td>
		<td><textarea name="page_header" rows="4" class="cell-100prc-multi">{$content.page_header}</textarea>
		</td>
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
		<td valign="top" class="txt-tahoma"><strong>Footer text: </strong></td>
		<td><textarea name="page_footer" rows="4" class="cell-100prc-multi">{$content.page_footer}</textarea>
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
	<input name="page_id" type="hidden" value="{$content.page_id}" />	
</form>
<br>
<br>


<!--

<p>
Subpages:
{if !empty($smarty.get.subpage_id)}
	<a href="{$smarty.server.PHP_SELF}">Default Page</a>&nbsp;&nbsp;&nbsp;
{else}	
	<strong>Default Page</strong>&nbsp;&nbsp;&nbsp;
{/if}

{section name=i loop=$subpages}
	{if $smarty.get.subpage_id!=$subpages[i].page_id}
		<a href="{$smarty.server.PHP_SELF}?subpage_id={$subpages[i].page_id}">{$subpages[i].page_title}</a>&nbsp;&nbsp;&nbsp;
	{else}
		<strong>{$subpages[i].page_title}</strong>&nbsp;&nbsp;&nbsp;
	{/if}
{/section}
</p>
<p>
	<a href="{$smarty.server.PHP_SELF}?option=add">Add new page</a>&nbsp;&nbsp;&nbsp;
</p>
<p>
<form action="{$smarty.server.PHP_SELF}?subpage_id={$smarty.get.subpage_id}" method="post">
	{if isset($content.page_order)}
	Order ID: <input name="page_order" type="text" maxlength="100" value="{$content.page_order}" /><br />
	{/if}
	Title: <input name="page_title" type="text" maxlength="100" value="{$content.page_title}" /><br />
	Meta: <br />
	 <textarea name="page_meta" style="WIDTH: 100%; HEIGHT: 80px">{$content.page_meta}</textarea>
	Body: <br />
		{$output}
	<br>
	<input name="page_id" type="hidden" value="{$content.page_id}" />	
	<input name="but_submit" type="submit" value="Save Page">
	{if !empty($smarty.get.subpage_id)}
	<input name="but_delete" type="submit" value="Delete Page" onclick="return confirm('Are you sure to delete this page?');">
	{/if}</form>
</p>-->