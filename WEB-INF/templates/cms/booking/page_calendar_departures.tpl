      <table width="850" border="0" cellspacing="0" cellpadding="0" id="main-content">
      <tr>
        <td width="220" valign="top" class="content-padding"><table width="90%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="txt-side">Departure times set for the selected day are shown here. To add a new time, use the form to the right. </td>
          </tr>
          <tr>
            <td class="txt-side">&nbsp;</td>
          </tr>
          <tr>
            <td class="txt-side"><strong>The Icons: </strong></td>
          </tr>
          <tr>
            <td class="txt-side"><img src="images/spacer.gif" width="10" height="5"></td>
          </tr>
          <tr>
            <td class="txt-side"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="13%"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" vspace="2" border="0"></td>
                <td width="87%" class="txt-side">Edit Departure Time </td>
              </tr>
            </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" vspace="2" border="0"></td>
                  <td width="87%" class="txt-side">Delete Departure Time </td>
                </tr>
              </table>
              </td>
          </tr>
        </table>
          </td>
        <td width="630" class="dotted-border content-padding2">
          <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td width="67%"><div align="center" class="calendar-monthtxt">
                  <div align="left">{$tour_name} : Departures for {$smarty.get.day|date_format:"%B %d, %Y"}: </div>
                </div></td>
                <td width="30%"><div align="right" class="txt-side"><a href="calendar.php?tour_id={$tour_id}&subpage=calendar&month={$smarty.session.sess_month}" id="submenu">Back to calendar</a>&nbsp;</div></td>
                <td width="3%"><div align="right"><span class="txt-side"><img src="images/icons/calendar_back_16.gif" alt="Back to calendar" width="16" height="16" vspace="3"></span></div></td>
              </tr>
            </table>
		  {if !empty($message)}
          <br>
          <table width="100%" border="0" cellpadding="1" cellspacing="1">
            <tr>
              <td class="outline-grey"><table width="100%" border="0" cellpadding="3" cellspacing="0" bgcolor="#99FFCC">
                  <tr>
                    <td width="4%"><img src="images/icons/bulb_16_hot.gif" width="16" height="16"></td>
                    <td width="96%" class="txt-tahoma"><strong>{$message}</strong></td>
                  </tr>
                </table></td>
              </tr>
          </table>		  
		  {/if}
          <br>
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td width="56%" class="outline-grey" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                  <tr>
                    <td width="17%" class="table-header">Time</td>
                    <td width="44%" class="table-header">Boat</td>
                    <td width="39%" class="table-header">&nbsp;</td>
                  </tr>
				  
				{section name=i loop=$departures}
                  <tr bgcolor="{cycle values="#F8F8F8,#FFFFFF"}">
                    <td class="table-line">{$departures[i].departure_time|truncate:5:""}</td>
                    <td class="table-line">{$departures[i].boat_name}</td>
                    <td class="table-line"><div align="left">
					<a href="calendar.php?tour_id={$tour_id}&subpage=departures&option=edit&day={$smarty.get.day}&id={$departures[i].departure_id}"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" border="0"></a>&nbsp; &nbsp; 
					<a href="calendar.php?tour_id={$tour_id}&subpage=departures&option=delete&day={$smarty.get.day}&id={$departures[i].departure_id}" onclick="return confirm('Are you sure you want to delete this departure?');"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" border="0"></a></div></td>
                  </tr>				
				{sectionelse}
                  <tr>
                    <td bgcolor="#F8F8F8" class="table-line" colspan="3">There are no departures defined!</td>
                  </tr>
				{/section}				  
                </table></td>
                <td width="44%" valign="top" class="outline-grey"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                  <tr>
                    <td class="table-header-light"> &nbsp; {if $smarty.get.option != edit}Add new{else}Edit{/if} departure time: </td>
                  </tr>
                  <tr>
                    <td class="sitetable-padding"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">

                      <tr>
                        <td colspan="2" class="sidetable-txt"><img src="images/spacer.gif" width="10" height="2"></td>
                        </tr>
					<form name="departure" method="post" action="calendar.php?tour_id={$tour_id}&subpage=departures&day={$smarty.get.day}" enctype="application/x-www-form-urlencoded">

                      <tr>
                        <td width="41%" class="sidetable-txt">Tour: </td>
                        <td width="59%" class="sidetable-txt">
						<select name="filter" class="cell-130" onchange="filter_tours('&subpage=departures&day={$smarty.get.day}');">
						{section name=i loop=$tours}
							<option value="{$tours[i].tour_id}" {if $smarty.get.tour_id==$tours[i].tour_id}selected{/if}>{$tours[i].tour_name}</option>
						{/section}
						</select>

						</td>
                      </tr>
                      <tr>
                        <td width="41%" class="sidetable-txt">Boat name: </td>
                        <td width="59%" class="sidetable-txt">
						{html_radios name="departure_boat_id" options=$boats selected=$departure.departure_boat_id separator="<br />"}

						<input type="hidden" name="departure_date" value="{$smarty.get.day}" />   
						<input type="hidden" name="but_departure_id" value="{$departure.departure_id}" />           
						<input type="hidden" name="departure_tour_id" value="{$tour_id}" />           

						</td>
                      </tr>
                      <tr>
                        <td class="sidetable-txt">Departure time:</td>
                        <td class="sidetable-txt">
						{html_select_time display_seconds=false minute_interval=5 time=$departure.departure_time prefix="but" all_extra="class='sidetable-dropdown2'"}
						</td>
                      </tr>
                      <tr>
                        <td colspan="2" class="sidetable-txt"><img src="images/line-grey.gif" width="100%" height="1"></td>
                        </tr>
                      <tr>
                        <td colspan="2" class="sidetable-txt"><div align="center"><a href="javascript: document.departure.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image39','','images/button-submit-on.gif',1)"><img src="images/button-submit-off.gif" alt="Submit" name="Image39" width="63" height="23" border="0"></a></div></td>
                        </tr>
					<form>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table>
            <br></td>
      </tr>
    </table>
    <br>