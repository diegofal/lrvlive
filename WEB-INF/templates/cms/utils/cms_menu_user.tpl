<table width="600" cellpadding="0" cellspacing="0" border="0" align="center">
	<tr><td><img src="../WEB-INF/assets/images/utils/spacer.gif" width="1" height="20" alt=""></td></tr>
	<tr><td height="1" class="bgwhite"></td></tr>
	<tr>
		<td height="25" class="tdbord tdpaddleft10">
			{foreach key=key item=item from=$menu_user}
				{if $smarty.get.option==$key}
					<a href="{$pages_dir}.php?subpage={$smarty.get.subpage}&option={$key}&id={$smarty.get.id}{if !empty($smarty.get.location)}&location={$smarty.get.location}{/if}&start={$smarty.get.start}&order={$smarty.get.order}" class="aheadroll">{$item}</a>
				{else}
					<a href="{$pages_dir}.php?subpage={$smarty.get.subpage}&option={$key}&id={$smarty.get.id}{if !empty($smarty.get.location)}&location={$smarty.get.location}{/if}&start={$smarty.get.start}&order={$smarty.get.order}" class="ahead">{$item}</a>
				{/if}
				&nbsp;&nbsp;&nbsp;
			{/foreach}

		</td>
	</tr>
	<tr><td height="1" class="bgwhite"></td></tr>
	<tr><td><img src="../WEB-INF/assets/images/utils/spacer.gif" width="1" height="20" alt=""></td></tr>
</table>