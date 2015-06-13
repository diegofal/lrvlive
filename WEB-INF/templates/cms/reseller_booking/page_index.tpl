	<table class="main">
		<tr><td class="header">
			<DIV  style="width:100%;">
				
				<div id="divimageleft">
					<img src="/bale/img/london_rib_extended.png"  width="100%" ></img>
				</div>
			</div>
		</td></tr>
		<tr><td class="content">
		<form id="loginform" name="login" action="check_login.php" method="post" enctype="application/x-www-form-urlencoded">
		<div class="s2"><div class="s1"><div class="s0">
			<table class="tl">
			<thead><tr><th colspan="2"><h1>Login</h1></th></tr></thead>
			<tfoot><tr><td colspan="2"><div class="buttons"><div class="button"><input type="submit" value="login"></div></div></td></tr></tfoot>
		
			<tbody>
				<tr>	
					<td><label for="username">Login</label></td>
					<td><input type="text" name="user" id="username"></td>
				</tr>
				<tr>	
					<td><label for="password">Password</label></td>
					<td><input type="password" name="pass" id="password"></td>
				</tr>
		{if $smarty.get.reason=="failure"}
				<tr>	
					<td colspan="2"><p class="er">
			{config_load file="config.conf" section="Errors"}
			{if $smarty.get.error==1}
				{#error_1#}
			{elseif $smarty.get.error==2}
				{#error_2#}
			{elseif $smarty.get.error==3}
				{#error_3#}
			{else}
				{#error_4#}
			{/if}
					</p></td>
				</tr>
		{/if}
			</tbody>
			</table>
		</div></div></div>
                </form>
		</td></tr>
	</table>
