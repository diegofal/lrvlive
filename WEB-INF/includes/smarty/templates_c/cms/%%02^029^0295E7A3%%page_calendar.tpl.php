<?php /* Smarty version 2.6.25, created on 2015-06-13 13:09:34
         compiled from booking/page_calendar.tpl */ ?>
    <script src="../WEB-INF/includes/js/jquery-1.7.2.min.js" type="text/javascript">
    </script>
    <script type="text/javascript">
<?php echo '
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
'; ?>

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
                <td width="33%"><a href="calendar.php?subpage=calendar&month=<?php echo $this->_tpl_vars['month']-1; ?>
"><img src="images/icons/arrow_prev.gif" alt="Previous Month" width="16" height="16" border="0"></a></td>
                <td width="33%">
				<form name="change_month"  style="margin: 0;">
				<div align="center" class="calendar-monthtxt">
					<select onchange="change_monthes();" name="cur_month" style="width: 100%; font-size: 14px; font-weight: bold; color: rgb(107, 64, 13);">
						<?php $_from = $this->_tpl_vars['select_monthes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['skey'] => $this->_tpl_vars['smonth']):
?>
							<option value=<?php echo $this->_tpl_vars['skey']; ?>
<?php if ($this->_tpl_vars['skey'] == $this->_tpl_vars['month']): ?> selected="true"<?php endif; ?>><?php echo $this->_tpl_vars['smonth']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</div>
				</form>
				</td>
                <td width="33%"><a href="calendar.php?subpage=calendar&month=<?php echo $this->_tpl_vars['month']+1; ?>
"><div align="right"><img src="images/icons/arrow_next.gif" alt="Next Month" width="16" height="16" border="0"></div></a></td>
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
			<?php unset($this->_sections['day']);
$this->_sections['day']['name'] = 'day';
$this->_sections['day']['loop'] = is_array($_loop=$this->_tpl_vars['days']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['day']['step'] = ((int)7) == 0 ? 1 : (int)7;
$this->_sections['day']['show'] = true;
$this->_sections['day']['max'] = $this->_sections['day']['loop'];
$this->_sections['day']['start'] = $this->_sections['day']['step'] > 0 ? 0 : $this->_sections['day']['loop']-1;
if ($this->_sections['day']['show']) {
    $this->_sections['day']['total'] = min(ceil(($this->_sections['day']['step'] > 0 ? $this->_sections['day']['loop'] - $this->_sections['day']['start'] : $this->_sections['day']['start']+1)/abs($this->_sections['day']['step'])), $this->_sections['day']['max']);
    if ($this->_sections['day']['total'] == 0)
        $this->_sections['day']['show'] = false;
} else
    $this->_sections['day']['total'] = 0;
if ($this->_sections['day']['show']):

            for ($this->_sections['day']['index'] = $this->_sections['day']['start'], $this->_sections['day']['iteration'] = 1;
                 $this->_sections['day']['iteration'] <= $this->_sections['day']['total'];
                 $this->_sections['day']['index'] += $this->_sections['day']['step'], $this->_sections['day']['iteration']++):
$this->_sections['day']['rownum'] = $this->_sections['day']['iteration'];
$this->_sections['day']['index_prev'] = $this->_sections['day']['index'] - $this->_sections['day']['step'];
$this->_sections['day']['index_next'] = $this->_sections['day']['index'] + $this->_sections['day']['step'];
$this->_sections['day']['first']      = ($this->_sections['day']['iteration'] == 1);
$this->_sections['day']['last']       = ($this->_sections['day']['iteration'] == $this->_sections['day']['total']);
?>
			<tr>
				<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['week_loop']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
				<?php $this->assign('index', $this->_sections['day']['index']+$this->_tpl_vars['week_loop'][$this->_sections['i']['index']]); ?>
				<?php if (( ! empty ( $this->_tpl_vars['days'][$this->_tpl_vars['index']]['number'] ) )): ?>
				<td valign="top" bgcolor="#FFFFFF" class="calendar-cell">
						<table width="100%" border="0" cellspacing="2" cellpadding="0">
						  <tr>
							<td class="calendar-day"><?php echo $this->_tpl_vars['days'][$this->_tpl_vars['index']]['number']; ?>
</td>
						  </tr>
						  <tr>
							<td height="35" valign="bottom"><div align="right">
															<a href="calendar.php?subpage=departures&day=<?php echo $this->_tpl_vars['YMmonth']; ?>
-<?php echo $this->_tpl_vars['days'][$this->_tpl_vars['index']]['number']; ?>
"><img src="images/icons/clock_16.gif" alt="Departures" width="16" height="16" border="0"></a>
															<!--<img src="images/icons/clock_16_dis.gif" width="16" height="16" border="0">-->
														<?php if ($this->_tpl_vars['days'][$this->_tpl_vars['index']]['bookings'] == 1): ?>
							<a href="calendar.php?subpage=bookings&day=<?php echo $this->_tpl_vars['YMmonth']; ?>
-<?php echo $this->_tpl_vars['days'][$this->_tpl_vars['index']]['number']; ?>
"><img src="images/icons/group_info_16.gif" alt="Bookings" width="16" height="16" border="0"></a>
							<?php else: ?>
							<img src="images/icons/group_info_16_dis.gif" width="16" height="16" border="0">
							<?php endif; ?>
							</div></td>
						  </tr>
						</table>
				</td>
				<?php else: ?>
                <td bgcolor="#FFFFFF">&nbsp;</td>
				<?php endif; ?>
				<?php endfor; endif; ?>
			</tr>
			<?php endfor; endif; ?>

          </table>
        <br></td></tr>
    </table>