{* HEADER *}
{include file="utils/cms_header.tpl"}

{if $page!=index}
	{* MENU *}
	{include file="utils/cms_menu.tpl"}
{/if}

{* CONTENT *}
{include file="$pages_dir/page_$page$subpage.tpl"}

{* FOOTER *}
{include file="utils/cms_footer.tpl"}