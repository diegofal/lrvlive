<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td width="100%" height="27" class="tdpaddleft10">
			&nbsp;&nbsp;&nbsp;
			<img src="../WEB-INF/assets/images/icons/sag_but.gif" width="16" height="9" alt="">
			&nbsp;
			{foreach key=key item=item from=$submenu}
				{if $subpage==$key}
					<strong><a href="{$pages_dir}.php?subpage={$key}{if !empty($smarty.get.location)}&location={$smarty.get.location}{/if}" class="alinkroll">{$item}</a></strong>
				{else}
					<a href="{$pages_dir}.php?subpage={$key}{if !empty($smarty.get.location)}&location={$smarty.get.location}{/if}" class="alink">{$item}</a>
				{/if}
				&nbsp;&nbsp;
			{/foreach}
		</td>
	</tr>
	<tr><td><img src="../WEB-INF/assets/images/utils/spacer.gif" width="1" height="7" alt=""></td></tr>
</table>