      <table width="850" border="0" cellspacing="0" cellpadding="0" id="main-content">
      <tr>
        <td width="220" valign="top" class="content-padding"><table width="90%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="txt-side">This page shows the online  booking activity for the selected day. <br>
              <br>
              Customers that purchased tickets for each trip are shown by clicking &quot;View Bookings&quot;. </td>
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
            <td class="txt-side">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/add_16.gif" alt="Add Booking" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">Add Booking  </td>
                </tr>
              </table>	
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/config_clock_16.gif" alt="Relocate Ticket" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">Edit Ticket</td>
                </tr>
              </table>	
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/clock_16.gif" alt="Relocate Ticket" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">Relocate Ticket</td>
                </tr>
              </table>					  
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/del_16.gif" alt="Delete Booking" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">Delete Ticket</td>
                </tr>
              </table>				  
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="13%"><img src="images/icons/lock_ok_16.gif" alt="Mark Ticket  as Used" width="16" height="16" vspace="2"></td>
                <td width="87%" class="txt-side">Mark Ticket  as Used </td>
              </tr>
            </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/lock_16_dis.gif" alt="Ticket Used" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">Ticket Used</td>
                </tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/mail_info_16.gif" alt="View Ticket" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">View Ticket   </td>
                </tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%"><img src="images/icons/icon_email_16.gif" alt="Email confirmation status" width="16" height="16" vspace="2"></td>
                  <td width="87%" class="txt-side">Resend email confirmation</td>
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
                  <div align="left">Bookings for {$smarty.get.day|date_format:"%A, %B %d, %Y"}</div>
                </div></td>
                <td width="30%"><div align="right" class="txt-side"><a href="calendar.php?subpage=calendar&month={$smarty.session.sess_month}" id="submenu">Back to calendar</a>&nbsp;</div></td>
                <td width="3%"><div align="right"><span class="txt-side"><img src="images/icons/calendar_back_16.gif" alt="Back to calendar" width="16" height="16" vspace="3"></span></div></td>
              </tr>
          </table>
          <br>

            <table width="100%" border="0" cellpadding="0" cellspacing="1" class="outline-grey">
              <tr>
                <td width="20%" {$head.departure_tour_id}</td>
                <td width="10%" {$head.departure_time}</td>
                <td width="25%" {$head.boat_name}</td>
                <td width="15%" class="table-header">Reservations</td>
                <td colspan="2" width="30%" class="table-header">&nbsp;</td>
              </tr>
			{section name=i loop=$departures}
			  {assign var=tour_id value=$departures[i].departure_tour_id}
			  {assign var=depart_id value=$departures[i].departure_id}
  			 
			 <tr bgcolor="{$tour_colours[$tour_id]}" id="colapse_{$departures[i].departure_id}"  {if $departures[i].departure_id==$smarty.get.id}style="display:none;"{/if}>
                <td class="table-line">{$tour_names[$tour_id]}</td>
				<td class="table-line">{$departures[i].departure_time|truncate:5:""}</td>
                <td class="table-line">{$departures[i].boat_name} ({if $departures[i].boat_del == 0}Yes{else}No{/if})</td>
                <td class="table-line">{$departures[i].reserved} / {$departures[i].boat_passengers} </td>
                <td class="table-line"><div align="center">
					{if $departures[i].reserved == 0}
					<div align="center">--- </div>
					{else}
					<a href="javascript:expand({$departures[i].departure_id})" id="submenu"><strong>View Bookings</strong></a> 
					{/if}
					</div>
				</td>
                <td class="table-line"><div align="right">
			     {if $information_arr[$tour_id][$depart_id].skipper == "" || $information_arr[$tour_id][$depart_id].guide == "" }
					<a href="javascript:void(0)" onClick="window.open('skipper_guide_detail.php?tour_id={$departures[i].departure_tour_id}&dep_id={$departures[i].departure_id}&cur_date={$select_date}','MyPopUp','width=400,height=450,toolbar=0,scrollbars=1,screenX=10,screenY=10')" class="txt-side_book" title="Choose Skipper">
					<img src="images/icons/addskipper.gif" width="16" height="16" border="0" title="Add Skipper/Guide"></a>&nbsp;
					{/if}
					{if $departures[i].reserved < $departures[i].boat_passengers && $departures[i].boat_del == 0}
					<a href="javascript:openwind('make_booking.php?option=resellers&tour_id={$departures[i].departure_tour_id}&departure_id={$departures[i].departure_id}&free={$departures[i].boat_passengers-$departures[i].blocked}', 600, 500, 'yes')"><img src="images/icons/add_16.gif" width="16" height="16" border="0"></a>
					{else}
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					{/if}
				</div>
				</td>				
              </tr>
			  
			 
			{if $departures[i].reserved != 0}
              <tr {if $departures[i].departure_id!=$smarty.get.id}style="display:none;"{/if} id="expand_{$departures[i].departure_id}">
                <td colspan="6" bgcolor="#F0F5FD" class="outline-bluish book-list-back">
				  <img src="images/spacer.gif" width="10" height="3">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="81%" class="book-list-header"><span class="style1">{$tour_names[$tour_id]} | {$departures[i].departure_time|truncate:5:""} | {$departures[i].boat_name}&nbsp; |&nbsp; {$departures[i].reserved} seats out of {$departures[i].boat_passengers}&nbsp; | Total: &pound;{$departures[i].total_price}</span></td>
                    <td width="19%" nowrap class="book-list-header"><div align="right"><a href="javascript:colapse({$departures[i].departure_id})" id="submenu">Close expanded view </a></div></td>
                  </tr>
                 </table>
                  <img src="images/spacer.gif" width="10" height="8"><br>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="table-line"><strong>Code</strong></td>
                    <td class="table-line"><strong>Client</strong></td>
                    <td class="table-line"><strong>Seats</strong></td>
                    <td class="table-line"><strong>Amount</strong></td>
					<td class="table-line"><strong>Reseller</strong></td>
                    <td class="table-line"><div align="right">
					{if $information_arr[$tour_id][$depart_id].skipper == "" || $information_arr[$tour_id][$depart_id].guide == "" }
					<a href="javascript:void(0)" onClick="window.open('skipper_guide_detail.php?tour_id={$departures[i].departure_tour_id}&dep_id={$departures[i].departure_id}&cur_date={$select_date}','MyPopUp','width=400,height=450,toolbar=0,scrollbars=1,screenX=10,screenY=10')" class="txt-side_book" title="Choose Skipper">
					<img src="images/icons/addskipper.gif" width="16" height="16" border="0" title="Add Skipper/Guide"></a>&nbsp;
					{/if}
						{if $departures[i].reserved < $departures[i].boat_passengers && $departures[i].boat_del == 0}
						<a href="javascript:openwind('make_booking.php?option=resellers&tour_id={$departures[i].departure_tour_id}&departure_id={$departures[i].departure_id}&free={$departures[i].boat_passengers-$departures[i].blocked}', 600, 500, 'yes')"><img src="images/icons/add_16.gif" width="16" height="16" border="0"></a>
						{/if}
					</div></td>
                  </tr>
				  {assign var="orders" value=$departures[i].orders}
				  {section name=j loop=$orders}
                  <tr bordercolor="#EBF2FE" bgcolor="{cycle values="#FFFFFF,#F8FAFE"}">
                    <td width="14%" class="table-line outline-topb style3">
                    	{if $orders[j].order_payd != 0}
                    		{$orders[j].order_id}
                    		{if $orders[j].order_tour_shared_id != 0} 
                    			<b>{$orders[j].order_tour_prefix}</b>
                    		{/if}
                    	{else}
                    		<span style="color:#FF0000;"> 
	                    		{$orders[j].order_id}
	                    		{if $orders[j].order_tour_shared_id != 0} 
	                    			<b>{$orders[j].order_tour_prefix}</b>
	                			{/if}
                			</span>
            			{/if}
            		</td>
                    <td width="39%" class="table-line outline-topb style3">
                    	{if $orders[j].order_payd != 0}
                    		{$orders[j].order_title}
                			{$orders[j].order_first_name}
                			{$orders[j].order_last_name}
                			({$orders[j].order_email})
                			{$orders[j].order_phone}
                			<br>
                			{$orders[j].order_note_crew}
                		{else}
                			 <span style="color:#FF0000;">
                			 	{$orders[j].order_title}
                			 	{$orders[j].order_first_name} 
                			 	{$orders[j].order_last_name} 
                			 	({$orders[j].order_email}) 
                			 	{$orders[j].order_phone} 
                			 	<br>
                			 	{$orders[j].order_note_crew}
            			 	</span>
            			 {/if}
            		</td>
                    <td width="10%" class="table-line outline-topb style3">
                    	{if $orders[j].order_payd != 0} 
                    		{if $orders[j].order_tickets_number==1 && $orders[j].order_tickets=='0'}
                    			Charter
                			{else}
                				{$orders[j].order_tickets_number}
            				{/if}
        				{else} 
        					<span style="color:#FF0000;">  
        						{if $orders[j].order_tickets_number==1 && $orders[j].order_tickets=='0'}
        							Charter
    							{else}
    								{$orders[j].order_tickets_number}
								{/if}
							</span> 
						{/if}
					</td>
                    <td width="12%" class="table-line outline-topb style3">{if $orders[j].order_payd != 0} &pound;
{$orders[j].order_total format="%.2f"} {else} <span style="color:#FF0000;">&pound;{$orders[j].order_total format="%.2f"}</span> {/if}</td>
					<td width="10%" class="table-line outline-topb style3">{if $orders[j].order_payd != 0} {if $orders[j].order_reseller_name}{$orders[j].order_reseller_name}{else}LRV{/if} {else} <span style="color:#FF0000;"> {if $orders[j].order_reseller_name}{$orders[j].order_reseller_name}{else}LRV{/if}</span>{/if}</td>
                    <td width="25%" class="table-line outline-topb">
					<div align="left" style="display:inline;">
						<a href="calendar.php?subpage=bookings&day={$smarty.get.day}&delete={$orders[j].order_id}"  onclick="return confirm('Are you sure you want to delete this ticket?');"><img src="images/icons/del_16.gif" title="Delete Ticket" width="16" height="16" border="0"></a>			
						&nbsp; 
						<a href="javascript:openwind('edit_ticket.php?option=resellers&reseller_id={$orders[j].order_reseller_id}&tour_id={$departures[i].departure_tour_id}&code={$orders[j].order_unique_code}', 600, 500, 'yes')"><img src="images/icons/config_clock_16.gif"  title="Edit Ticket" width="16" height="16" border="0"></a>
						{if $departures[i].boat_del == 0}
							&nbsp;
							<a href="javascript:openwind('relocate_ticket.php?tour_id={$departures[i].departure_tour_id}&code={$orders[j].order_unique_code}', 400, 200, 'no')"><img src="images/icons/clock_16.gif"  title="Relocate Ticket" width="16" height="16" border="0"></a>
						{/if}
						&nbsp;
						{if $orders[j].order_used==0}
							<a href="calendar.php?subpage=bookings&day={$smarty.get.day}&id={$departures[i].departure_id}&mark={$orders[j].order_id}"  onclick="return confirm('Are you sure you want to mark this ticket as used?');"><img src="images/icons/lock_ok_16.gif"  title="Mark Ticket as Used" width="16" height="16" border="0"></a>{else}<img src="images/icons/lock_16_dis.gif"  title="Ticket Used" width="16" height="16" border="0">
						{/if}
						&nbsp; 
						<a href="javascript:view_ticket('{$orders[j].order_unique_code}');"><img src="images/icons/mail_info_16.gif"  title="View Ticket" width="16" height="16" border="0"></a>
						&nbsp; 
						<a href="javascript:openwind('ticket_emails.php?id={$orders[j].order_id}&code={$orders[j].order_unique_code}', 900, 400, 'yes')"><img src="images/icons/icon_email_16.gif"  title="Re-send email confirmation" width="16" height="16" border="0"></a>
            &nbsp; 
            <a href="javascript:openwind('order_history.php?id={$orders[j].order_id}', 900, 400, 'yes')"><img src="images/icons/icon-log.png"  title="View order modification history" width="16" height="16" border="0"></a>
					</div></td>
                  </tr>
				  {/section}
				  {if $information_arr[$tour_id][$depart_id].skipper ne ""}
				  <tr>
                <td bgcolor="#F8F8F8" class="table-line" colspan="4">
				
				<table border="0" width="100%" cellpadding="2px" cellspacing="0px">
					 <td width="2%"> 
					 <a href="calendar.php?skiper_guide_id={$information_arr[$tour_id][$depart_id].skipper_tour_id}&cur_date={$select_date}&command=delete_skipper" title="Delete Skipper">
				  <img src="images/icons/del_16.gif" alt="Delete Skipper" width="16" height="16" vspace="2" border="0">
				  </a>
				  </td>
					 <td width="10%" align="left" class="txt-side_book1">Skipper :</td>
                  <td width="88%" class="txt-side_book" align="left">			  
				  <a href="javascript:void(0)" onClick="window.open('skipper_detail.php?tour_id={$departures[i].departure_tour_id}&dep_id={$departures[i].departure_id}&cur_date={$select_date}','MyPopUp','width=400,height=450,toolbar=0,scrollbars=1,screenX=10,screenY=10')" class="txt-side_book2" title="Choose Skipper">{$information_arr[$tour_id][$depart_id].skipper}</a>				  </td>
					 </table>
				</td>
		      </tr>
				  
				  {/if}
				  
				  {if $information_arr[$tour_id][$depart_id].guide ne ""}
				  <tr>
                <td bgcolor="#F8F8F8" class="table-line" colspan="4">
				
				<table border="0" width="100%" cellpadding="2px" cellspacing="0px">
					 <td width="2%" align="right"> 
					 <a href="calendar.php?skiper_guide_id={$information_arr[$tour_id][$depart_id].skipper_tour_id}&cur_date={$select_date}&command=delete_guide" title="Delete Guide">
				  <img src="images/icons/del_16.gif" alt="Delete Guide" width="16" height="16" vspace="2" border="0">
				  </a>
				  </td>
					 <td width="10%" align="left" class="txt-side_book1">Guide :</td>
                  <td width="88%" align="left" valign="middle" class="txt-side_book">
				  <a href="javascript:void(0)" onClick="window.open('guide_detail.php?tour_id={$departures[i].departure_tour_id}&dep_id={$departures[i].departure_id}&cur_date={$select_date}','MyPopUp','width=400,height=450,toolbar=0,scrollbars=1,screenX=10,screenY=10')" class="txt-side_book2" title="Choose Guide">{$information_arr[$tour_id][$depart_id].guide}</a></td>
				  </table>
				</td>
		      </tr>
				  
				  {/if}
                </table>
              </td></tr>
			{/if}
			{sectionelse}
			  <tr>
                <td bgcolor="#F8F8F8" class="table-line" colspan="4">
				There are no bookings defined!
				</td>
		      </tr>
			{/section}	
            </table>
            <br>
            <br>
            <br></td>
      </tr>
    </table><br>
