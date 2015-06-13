	<table class="main">
		<tr>
			<td class="header" colspan="3">
				<DIV  style="width:100%;">
					<div id="divimageleft">
						<img src="/bale/img/london_rib_extended.png"  width="100%" ></img>
					</div>

					<div id="divimageright">
						{if $company_image_path ne ""} 
							<img src="{$company_image_path}" width="200px" height="45px" ></img>
						{/if}
					</div>

					<DIV id="logout"><a style="color:white" href="/bale/logout.php">LOGOUT >></a></DIV>
				</DIV>
			</td>
		</tr>
       
		<tr>
		<td class="content" style="display: none;">
		<h1><span id="time"><input type="text" id="hours" name="hours" value="{$smarty.now|date_format:"%H"}"><span id="blink">:</span><input type="text" id="minutes" name="minutes" value="{$smarty.now|date_format:"%m"}"></span>{$smarty.now|date_format:"%A, %B %d"}</h1>
		</td>{$calendar_data}</tr>

	</table>

<div id="popupcontent1" style="display:none;padding-bottom: 10px;background-color:#FFFFFF; border: 1px solid black;">
			<div style="width: 356px; font-family:Arial, Helvetica, sans-serif; 
				font-size:18px; font-weight:bold; color:#000000; padding-top:10px;height:30px;">
					The booking was placed successfully.
			</div>
			<div style="margin:10px">Booking Reference Id: <b>{$smarty.get.id}</b></div>
			<div id="date_set"><input type="button" name="close" style="width: 175px;height: 25px;
				outline: none; font-family:Verdana, Arial, Helvetica, sans-serif; 
				color:#35788B; font-size:11px; font-weight:bold" 
				value="OK" onclick="return hidePopup()"></div>
		
		</div>	
{if $error}
<script type="text/javascript">alert('{$error}');</script>
{/if}

	