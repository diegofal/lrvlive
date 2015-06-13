<div class="lr_body float_left">
	<div class="lr_left_r1">
		<div class="pep_left_r1_middle">
			<div class="style_tour_details">
				<h1 class="ab_text_1">{$package.package_name}</h1>
				<div class="style_tour_details_5 text_4">{$package.package_full_description}</div>
			</div>	
		</div>
	</div>

<!--Include Right Menu-->

{if $package.package_name eq 'Private Charter Speedboats'}
	{include file="utils/site_right_private_charter.tpl" }
{/if}

{if $package.package_name eq 'Pirates of the Thames'}
	{include file="utils/site_right_pirates.tpl" }
{/if} 
                                          
{if $package.package_name eq 'Ultimate London Adventure'}
		{include file="utils/site_right_ultimate.tpl" }
{/if}

 </div>                                           