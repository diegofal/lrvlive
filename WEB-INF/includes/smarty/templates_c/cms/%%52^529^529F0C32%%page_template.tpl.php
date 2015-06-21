<?php /* Smarty version 2.6.25, created on 2015-06-13 14:01:08
         compiled from booking/page_template.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'booking/page_template.tpl', 43, false),array('function', 'html_select_date', 'booking/page_template.tpl', 60, false),array('function', 'html_select_time', 'booking/page_template.tpl', 81, false),)), $this); ?>
      <table width="850" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="220" valign="top" class="content-padding"><table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="txt-side">Using the form to the right, you can setup multiple departure times for a boat for the selected time interval.<br /><br />NOTE: The departures added using this method can be deleted only one at a time.</td>
              </tr>
            </table>
          </td>
          <td width="630" valign="top" class="dotted-border content-padding2">
		  <?php if (! empty ( $this->_tpl_vars['message'] )): ?>
          <table width="100%" border="0" cellpadding="1" cellspacing="1">
            <tr>
              <td class="outline-grey"><table width="100%" border="0" cellpadding="3" cellspacing="0" bgcolor="#99FFCC">
                  <tr>
                    <td width="4%"><img src="images/icons/bulb_16_hot.gif" width="16" height="16"></td>
                    <td width="96%" class="txt-tahoma"><strong><?php echo $this->_tpl_vars['message']; ?>
</strong></td>
                  </tr>
                </table></td>
              </tr>
                <tr>
                  <td><img src="images/spacer.gif" width="10" height="7"></td>
                </tr>			  
          </table>		  
		  <?php endif; ?>		
		<form name="filter_form">
		<p class="txt-side">Please select tour : 
			<select name="filter" class="cell-130" onchange="filter_tours();">
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['tours']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<option value="<?php echo $this->_tpl_vars['tours'][$this->_sections['i']['index']]['tour_id']; ?>
" <?php if ($this->_supers['get']['tour_id'] == $this->_tpl_vars['tours'][$this->_sections['i']['index']]['tour_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['tours'][$this->_sections['i']['index']]['tour_name']; ?>
</option>
			<?php endfor; endif; ?>
			</select>
		</p>
		</form>
	  	<form name="form_template" method="post" action="template.php?tour_id=<?php echo $this->_tpl_vars['tour_id']; ?>
">
		  <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td class="calendar-header-months"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="34%" class="sidetable-txt">Add multiple departures for boat: </td>
                      <td width="35%">      
					  <select name="departure_boat_id" class="sidetable-dropdown1">
                          <option value="0">Select one...</option>
						  <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['boats'],'selected' => $this->_tpl_vars['departure']['departure_boat_id']), $this);?>

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
				  <?php echo smarty_function_html_select_date(array('end_year' => "+1",'prefix' => 'date_from','day_value_format' => "%02d",'day_extra' => 'class="sidetable-dropdown2"','month_extra' => 'class="sidetable-dropdown4"','year_extra' => 'class="sidetable-dropdown3"'), $this);?>

                  </td>
                </tr>
                <tr>
                  <td class="style1">To:</td>
                  <td width="92%">
				  <?php echo smarty_function_html_select_date(array('end_year' => "+1",'prefix' => 'date_to','day_value_format' => "%02d",'day_extra' => 'class="sidetable-dropdown2"','month_extra' => 'class="sidetable-dropdown4"','year_extra' => 'class="sidetable-dropdown3"'), $this);?>

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
				  	<?php echo smarty_function_html_select_time(array('display_seconds' => false,'minute_interval' => 5,'prefix' => 'time_from','all_extra' => 'class="sidetable-dropdown2"'), $this);?>

                    <span class="txt-tahoma">-</span>
					<?php echo smarty_function_html_select_time(array('display_seconds' => false,'minute_interval' => 5,'prefix' => 'time_to','all_extra' => 'class="sidetable-dropdown2"'), $this);?>
  
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