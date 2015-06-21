<?php /* Smarty version 2.6.25, created on 2015-06-13 14:01:06
         compiled from booking/page_tours.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'booking/page_tours.tpl', 59, false),)), $this); ?>
      <table width="850" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="220" valign="top" class="content-padding"><table width="91%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="txt-side">Tours page description. You may sort the list based on any table header. <br>
                <br>
                </td>
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
                         <td width="13%"><img src="images/icons/add_16.gif" width="16" height="16" border="0" alt="Add"></td>
                         <td width="87%" class="txt-side">Add new Tour</td>
                     </tr>
                  </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" vspace="2" border="0"></td>
                        <td width="87%" class="txt-side">Edit Tour</td>
                      </tr>
                    </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" vspace="2" border="0"></td>
                        <td width="87%" class="txt-side">Delete Tour</td>
                      </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="13%"><img src="images/icons/mail_info_16.gif" alt="View Calendar for this Tour" width="16" height="16" vspace="2" border="0"></td>
                        <td width="87%" class="txt-side">View Calendar for this Tour</td>
                      </tr>
                  </table></td>
              </tr>
          </table></td>
          <td width="630" valign="top" class="dotted-border content-padding2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/spacer.gif" width="10" height="10"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="1" class="outline-grey">
                  <tr>
                    <td width="15%" <?php echo $this->_tpl_vars['head']['tour_id']; ?>
</td>
                    <td width="40%" <?php echo $this->_tpl_vars['head']['tour_name']; ?>
</td>
                    <td width="25%" <?php echo $this->_tpl_vars['head']['tour_charter_price']; ?>
</td>
                    <td width="30%" class="table-header">&nbsp;&nbsp; </td>
                  </tr>
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
				  <tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#F8F8F8,#FFFFFF"), $this);?>
">
                    <td class="table-line"><?php echo $this->_tpl_vars['tours'][$this->_sections['i']['index']]['tour_id']; ?>
</td>
                    <td class="table-line"><a href="calendar.php" id="submenu"><?php echo $this->_tpl_vars['tours'][$this->_sections['i']['index']]['tour_name']; ?>
</a> </td>
                    <td class="table-line"><?php echo $this->_tpl_vars['tours'][$this->_sections['i']['index']]['tour_charter_price']; ?>
</td>
                    <td class="table-line"><div align="center">
					<a href="calendar.php"><img src="images/icons/mail_info_16.gif" alt="View Calendar for this Tour" width="16" height="16" vspace="2" border="0"></a>
					<a href="tour_edit.php?tour_id=<?php echo $this->_tpl_vars['tours'][$this->_sections['i']['index']]['tour_id']; ?>
"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" vspace="2" border="0"></a>
					<a href="tours.php?option=delete&tour_id=<?php echo $this->_tpl_vars['tours'][$this->_sections['i']['index']]['tour_id']; ?>
" onclick="return confirm('Are you sure to delete this Tour?\n(All boats and tickets associated with this tour - will be also deleted)');"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" vspace="2" border="0"></a>
					</div></td>
                  </tr>
				  <?php endfor; else: ?>
				  <tr>
                    <td bgcolor="#F8F8F8" class="table-line" colspan="7">There are no tours in database!</td>
				  </tr>
				  <?php endif; ?> 
				  <tr bgcolor="#FFFFFF">
                    <td class="table-line">*</td>
                    <td class="table-line" colspan="2">Add new Tour</td>
                    <td class="table-line"><div align="center"><a href="tour_edit.php?option=add"><img src="images/icons/add_16.gif" alt="Add" width="16" height="16" vspace="2" border="0"></a></div>
					</td>
                  </tr>

                </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><img src="images/spacer.gif" width="10" height="3"></td>
                  </tr>
                </table>
				
				<?php if (! empty ( $this->_tpl_vars['navigator'] )): ?>
                <table width="100%" border="0" cellpadding="4" cellspacing="1" class="outline-grey">
                  <tr>
                    <td class="txt-tahoma"><div align="right"><?php echo $this->_tpl_vars['navigator']; ?>
</div></td>
                  </tr>
                </table>
				<?php endif; ?>
                <br>
                <br>
          <br></td></tr>
      </table>