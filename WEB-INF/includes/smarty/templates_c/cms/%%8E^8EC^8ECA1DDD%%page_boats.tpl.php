<?php /* Smarty version 2.6.25, created on 2015-06-13 13:09:37
         compiled from settings/page_boats.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'settings/page_boats.tpl', 46, false),)), $this); ?>
      <table width="850" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="220" valign="top" class="content-padding"><table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="txt-side">Currently added boats are listed in the table presented. To add a new boat, use the form on the right. </td>
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
                      <td width="87%" class="txt-side">Edit Boat </td>
                    </tr>
                  </table></td>
              </tr>
          </table></td>
          <td width="630" class="dotted-border content-padding2">
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
		<table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr>
                  <td width="56%" valign="top" class="outline-grey"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <tr>
                        <td width="5%" class="table-header">ID</td>
                        <td width="45%" class="table-header">Boat</td>
                        <td width="15%" class="table-header">Seats</td>
                        <td width="15%" class="table-header">Active</td>
                        <td width="20%" class="table-header">&nbsp;</td>
                      </tr>
					  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['boats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                      <tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#F8F8F8,#FFFFFF"), $this);?>
">
                        <td class="table-line"><?php echo $this->_tpl_vars['boats'][$this->_sections['i']['index']]['boat_id']; ?>
</td>
                        <td class="table-line"><?php echo $this->_tpl_vars['boats'][$this->_sections['i']['index']]['boat_name']; ?>
</td>
                        <td class="table-line"><?php echo $this->_tpl_vars['boats'][$this->_sections['i']['index']]['boat_passengers']; ?>
</td>
                        <td class="table-line"><?php if ($this->_tpl_vars['boats'][$this->_sections['i']['index']]['boat_del'] == 0): ?>Yes<?php else: ?>No<?php endif; ?></td>
                        <td class="table-line"><div align="left">&nbsp; <a href="boats.php?tour_id=<?php echo $this->_tpl_vars['tour_id']; ?>
&option=edit&id=<?php echo $this->_tpl_vars['boats'][$this->_sections['i']['index']]['boat_id']; ?>
"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" border="0"></a></div></td>
                      </tr>
  					  <?php endfor; else: ?>
                      <tr>
                        <td colspan="6" bgcolor="#F8F8F8" class="table-line">There are no boats defined!</td>
                      </tr>
					  <?php endif; ?>						 
                  </table></td>
				  <form name="boat_edit" method="post" action="boats.php?tour_id=<?php echo $this->_tpl_vars['tour_id']; ?>
&option=<?php echo $this->_supers['get']['option']; ?>
&id=<?php echo $this->_supers['get']['id']; ?>
" onsubmit="validate(); return returnVal;">
                  <input type="hidden" name="boat_tour_id" value="<?php echo $this->_tpl_vars['tour_id']; ?>
" />     
                  <?php if ($this->_supers['get']['option'] != edit): ?>
                    <input type="hidden" name="boat_del" value="0" /> 
                  <?php endif; ?>
                  <td width="44%" valign="top" class="outline-grey"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <tr>
                        <td class="table-header-light">&nbsp;<?php if ($this->_supers['get']['option'] == edit): ?>Edit<?php else: ?>Add new<?php endif; ?> boat: </td>
                      </tr>
                      <tr>
                        <td class="sitetable-padding"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                            
                            <tr>
                              <td width="39%" class="sidetable-txt">Boat name: </td>
                              <td width="61%" class="sidetable-txt"><input name="boat_name" type="text" maxlength="50" value="<?php echo $this->_tpl_vars['boat']['boat_name']; ?>
" class="cell-130" /></td>
                            </tr>
                            <tr>
                              <td class="sidetable-txt"> Seats: </td>
                              <td class="sidetable-txt"><input name="boat_passengers" type="text" maxlength="5" value="<?php echo $this->_tpl_vars['boat']['boat_passengers']; ?>
"  class="sidetable-dropdown3" /></td>
                            </tr>
							<?php if ($this->_supers['get']['option'] == edit): ?>
                            <tr>
                              <td class="sidetable-txt">Active/Not: </td>
                              <td class="sidetable-txt"><input name="boat_del" type="checkbox" <?php if ($this->_tpl_vars['boat']['boat_del'] == 0): ?> checked<?php endif; ?>/></td>
                            </tr>
							<?php endif; ?>
                            <tr>
                              <td colspan="2" class="sidetable-txt"><img src="images/line-grey.gif" width="100%" height="1"></td>
                            </tr>
                            <tr>
                              <td colspan="2" class="sidetable-txt"><div align="center"><a href="javascript: document.boat_edit.submit();" onclick="validate(); return returnVal;" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image39','','images/button-submit-on.gif',1)"><img src="images/button-submit-off.gif" alt="Submit" name="Image39" width="63" height="23" border="0"></a></div></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
				  </form>
                </tr>
              </table>
            <br></td></tr>
      </table>
      <br>


