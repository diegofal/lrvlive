	{* HEADER *}
	{if $page == index or $page == test_index}
	{include file="utils/site_header.tpl"}
	{elseif $subpage == _step1 or $subpage == _step2 or $subpage == _step3 or $subpage == _step4 or $subpage == _step5 or $subpage == _step6 or $subpage == _step8 or $subpage == _voucher_step1 or $subpage == _voucher_step2 or $subpage == _voucher_step3 or $subpage == _voucher_step4}
	{include file="utils/site_booking_header.tpl"}     	
	{else}
	{include file="utils/site_header_details.tpl"}
	{/if}
    
    
	{* CONTENT *}
	{include file="$pages_dir/page_$page$subpage.tpl"}

	{* FOOTER *}
	{if $page == index}
	{include file="utils/site_footer.tpl"}
	{elseif $subpage == _step1 or $subpage == _step2 or $subpage == _step3 or $subpage == _step4 or $subpage == _step5 or $subpage == _step6 or $subpage == _step8}
	{include file="utils/site_booking_footer.tpl"}   
	{else}
	{include file="utils/site_footer_detail.tpl"}
	{/if}


