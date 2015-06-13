    <script src="../WEB-INF/includes/js/jquery-1.7.2.min.js" type="text/javascript">
    </script>
    <script type="text/javascript">
{literal}
    	$(document).ready(function () {
    		//bindLinks();
    	});
    	
    	function bindLinks() {
    		$("#main-content a").click(function(event) {
    			if ($(this).attr("href").indexOf("javascript") > -1)
    				return true;
    			
				event.preventDefault();
				
				loadPage($(this).attr("href"));
	        });
    	}
    	
    	function loadPage(url) {
    		$("#loader").show();
    			
			var loadstr = url + " #main-content";
			
			$("#main-content").load(loadstr, function(responseText, statusText, xhr) {
	                if(statusText == "success") {		                        
	                        if (loadstr.indexOf("subpage=bookings") > -1) {
	                        	$.getScript("../WEB-INF/includes/js/cms_bookings.js");
	                        }
	                        bindLinks();
	                }
	                if(statusText == "error")
	                	alert("An error occurred: " + xhr.status + " - " + xhr.statusText);
	                
	                $("#loader").hide();
	        });
    	}    	
    	
    	function change_monthes()                                      	
		{
			if(document.change_month.cur_month.value)
				window.location = "calendar.php?subpage=calendar&month="+document.change_month.cur_month.value;
				//loadPage("calendar.php?subpage=calendar&month="+document.change_month.cur_month.value);
		}
{/literal}
    </script>
    <div id="loader" style="display:none; left: 50%; top:50%; position:absolute; background-color: #000; border: 1px solid #CCC;">
    	<img src="../images/ajax-loader.gif" alt="Loading..." style="margin:20px;"  />
    </div>
      <table width="850" border="0" cellspacing="0" cellpadding="0" id="main-content">
      <tr>
        <td width="220" valign="top" class="content-padding"><table width="90%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="txt-side">The calendar allows direct access to the daily bookings and the departure times for each boat. </td>
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
                <td width="13%"><img src="images/icons/arrow_prev.gif" alt="Previous Month" width="16" height="16" vspace="2"></td>
                <td width="87%" class="txt-side">Previous month </td>
              </tr>
            </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/arrow_next.gif" alt="Previous Month" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">Next month </td>
                </tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/clock_16.gif" alt="Previous Month" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">Departures for the day  </td>
                </tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/clock_16_dis.gif" alt="Previous Month" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">Cannot edit departures </td>
                </tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/group_info_16.gif" alt="Previous Month" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">Bookings for the day </td>
                </tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/group_info_16_dis.gif" alt="Previous Month" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">No bookings made </td>
                </tr>
              </table>
</td>
          </tr>
        </table>
          </td>
        <td width="630" class="dotted-border content-padding2">
		<table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td class="calendar-header-months">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="33%"><a href="calendar.php?subpage=calendar&month={$month-1}"><img src="images/icons/arrow_prev.gif" alt="Previous Month" width="16" height="16" border="0"></a></td>
                <td width="33%">
				<form name="change_month"  style="margin: 0;">
				<div align="center" class="calendar-monthtxt">
					<select onchange="change_monthes();" name="cur_month" style="width: 100%; font-size: 14px; font-weight: bold; color: rgb(107, 64, 13);">
						{foreach from=$select_monthes item=smonth key=skey}
							<option value={$skey}{if $skey==$month} selected="true"{/if}>{$smonth}</option>
						{/foreach}
					</select>
				</div>
				</form>
				</td>
                <td width="33%"><a href="calendar.php?subpage=calendar&month={$month+1}"><div align="right"><img src="images/icons/arrow_next.gif" alt="Next Month" width="16" height="16" border="0"></div></a></td>
              </tr>
            </table>
			</td>
          </tr>
        </table>

          <table width="100%" border="0" cellpadding="0" cellspacing="1">
              <tr>
                <td width="14%" bgcolor="#FFFFFF" class="calendar-header"><div align="center">SUN</div></td>
                <td width="14%" bgcolor="#FFFFFF" class="calendar-header"><div align="center">MON</div></td>
                <td width="14%" bgcolor="#FFFFFF" class="calendar-header"><div align="center">TUE</div></td>
                <td width="14%" bgcolor="#FFFFFF" class="calendar-header"><div align="center">WED</div></td>
                <td width="14%" bgcolor="#FFFFFF" class="calendar-header"><div align="center">THU</div></td>
                <td width="14%" bgcolor="#FFFFFF" class="calendar-header"><div align="center">FRI</div></td>
                <td width="14%" bgcolor="#FFFFFF" class="calendar-header"><div align="center">SAT</div></td>
              </tr>
			{section name=day loop=$days step=7}
			<tr>
				{section name=i loop=$week_loop}
				{assign var="index" value=$smarty.section.day.index+$week_loop[i]}
				{if (!empty($days[$index].number))}
				<td valign="top" bgcolor="#FFFFFF" class="calendar-cell">
						<table width="100%" border="0" cellspacing="2" cellpadding="0">
						  <tr>
							<td class="calendar-day">{$days[$index].number}</td>
						  </tr>
						  <tr>
							<td height="35" valign="bottom"><div align="right">
							{*if $YMDmonth < $YMmonth|cat:"-"|cat:$days[$index].number*}
								<a href="calendar.php?subpage=departures&day={$YMmonth}-{$days[$index].number}"><img src="images/icons/clock_16.gif" alt="Departures" width="16" height="16" border="0"></a>
							{*else*}
								<!--<img src="images/icons/clock_16_dis.gif" width="16" height="16" border="0">-->
							{*/if*}
							{if $days[$index].bookings==1}
							<a href="calendar.php?subpage=bookings&day={$YMmonth}-{$days[$index].number}"><img src="images/icons/group_info_16.gif" alt="Bookings" width="16" height="16" border="0"></a>
							{else}
							<img src="images/icons/group_info_16_dis.gif" width="16" height="16" border="0">
							{/if}
							</div></td>
						  </tr>
						</table>
				</td>
				{else}
                <td bgcolor="#FFFFFF">&nbsp;</td>
				{/if}
				{/section}
			</tr>
			{/section}

          </table>
        <br></td></tr>
    </table>