      <table width="850" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="220" valign="top" class="content-padding"><table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="txt-side">Using the form to the right, you can setup multiple departure times for a boat for the selected time interval.<br /><br />NOTE: The departures added using this method can be deleted only one at a time.</td>
              </tr>
            </table>
          </td>
          <td width="630" valign="top" class="dotted-border content-padding2">
		  {if !empty($message)}
          <table width="100%" border="0" cellpadding="1" cellspacing="1">
            <tr>
              <td class="outline-grey"><table width="100%" border="0" cellpadding="3" cellspacing="0" bgcolor="#99FFCC">
                  <tr>
                    <td width="4%"><img src="images/icons/bulb_16_hot.gif" width="16" height="16"></td>
                    <td width="96%" class="txt-tahoma"><strong>{$message}</strong></td>
                  </tr>
                </table></td>
              </tr>
                <tr>
                  <td><img src="images/spacer.gif" width="10" height="7"></td>
                </tr>			  
          </table>		  
		  {/if}		
		<form name="filter_form">
		<p class="txt-side">Please select tour : 
			<select name="filter" class="cell-130" onchange="filter_tours();">
			{section name=i loop=$tours}
			<option value="{$tours[i].tour_id}" {if $smarty.get.tour_id==$tours[i].tour_id}selected{/if}>{$tours[i].tour_name}</option>
			{/section}
			</select>
		</p>
		</form>
	  	<form name="form_template" method="post" action="template.php?tour_id={$tour_id}">
		  <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td class="calendar-header-months"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="34%" class="sidetable-txt">Add multiple departures for boat: </td>
                      <td width="35%">      
					  <select name="departure_boat_id" class="sidetable-dropdown1">
                          <option value="0">Select one...</option>
						  {html_options options=$boats selected=$departure.departure_boat_id}
                      </select>                      
					  </td>
                      <td width="31%" class="txt-tahoma"><div align="right"><a href="boats.php?option=add" id="submenu">Add new boat</a> </div></td>
                    </tr>
                </table></td>
              </tr>
            </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><img src="images/spacer.gif" width="10" height="7"></td>
                </tr>
              </table>
              <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
                <tr>
                  <td width="8%" class="style1">From:</td>
                  <td width="92%">
				  {html_select_date end_year="+1" prefix="date_from" day_value_format="%02d" 
				  day_extra='class="sidetable-dropdown2"' month_extra='class="sidetable-dropdown4"' year_extra='class="sidetable-dropdown3"'}
                  </td>
                </tr>
                <tr>
                  <td class="style1">To:</td>
                  <td width="92%">
				  {html_select_date end_year="+1" prefix="date_to" day_value_format="%02d"
				  day_extra='class="sidetable-dropdown2"' month_extra='class="sidetable-dropdown4"' year_extra='class="sidetable-dropdown3"'}
                  </td>
                </tr>
              </table>
              <table width="100%" border="0" cellpadding="2" cellspacing="1">
                <tr>
                  <td width="100%" class="sidetable-txt"><img src="images/line-grey.gif" width="100%" height="1"></td>
                </tr>
              </table>
              <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
                <tr>
                  <td width="15%" class="style1">Time Interval: </td>
                  <td width="85%">
				  	{html_select_time display_seconds=false minute_interval=5 prefix="time_from" all_extra='class="sidetable-dropdown2"'}
                    <span class="txt-tahoma">-</span>
					{html_select_time display_seconds=false  minute_interval=5 prefix="time_to" all_extra='class="sidetable-dropdown2"'}  
				  </td>
                </tr>
                <tr>
                  <td class="style1">Frequency:</td>
                  <td width="85%">
				  	<select name="frequencyMinute" class="sidetable-dropdown3">
						<option value="05">05</option>
						<option value="10">10</option>
						<option value="15">15</option>
						<option value="20">20</option>
						<option value="25">25</option>
						<option value="30">30</option>
						<option value="35">35</option>
						<option value="40">40</option>
						<option value="45">45</option>
						<option value="50">50</option>
						<option value="55">55</option>
						<option value="60">60</option>
						<option value="65">65</option>						
						<option value="70">70</option>						
						<option value="75">75</option>						
						<option value="80">80</option>						
						<option value="85">85</option>						
						<option value="90">90</option>						
						<option value="95">95</option>						
						<option value="100">100</option>						
                    </select>
                      <span class="txt-tahoma">minutes</span> </td>
                </tr>
              </table>
              <table width="100%" border="0" cellpadding="2" cellspacing="1">
                <tr>
                  <td width="100%" class="sidetable-txt"><img src="images/line-grey.gif" width="100%" height="1"></td>
                </tr>
                <tr>
                  <td><img src="images/spacer.gif" width="10" height="4"></td>
                </tr>
				<tr>
                  <td class="sidetable-txt"><div align="left"><a href="javascript: if(document.form_template.departure_boat_id.value != 0) document.form_template.submit(); else alert('Please select a boat from the dropdown!')" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image18','','images/button-adddep-on.gif',1)"><img src="images/button-adddep-off.gif" name="Image18" width="130" height="23" border="0"></a></div></td>
                </tr>
              </table>
			  </form>
              <br>
              <br>
              <br>
              <br>
              <br>
			<br></td></tr>
      </table>