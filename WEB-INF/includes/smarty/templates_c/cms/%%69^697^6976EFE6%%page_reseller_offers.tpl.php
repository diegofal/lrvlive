<?php /* Smarty version 2.6.25, created on 2015-06-13 13:10:06
         compiled from settings/page_reseller_offers.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'settings/page_reseller_offers.tpl', 51, false),)), $this); ?>
<table width="850" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="220" valign="top" class="content-padding"><table width="90%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="txt-side">Currently added offers are listed in the table presented. To add a new offer, use the form on the right. </td>
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
                                <td width="87%" class="txt-side">Edit Offer</td>
                            </tr>
                        </table>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="13%"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" vspace="2" border="0"></td>
                                <td width="87%" class="txt-side">Delete Offer</td>
                            </tr>
                        </table></td>
                </tr>
            </table></td>
        <td width="630" class="dotted-border content-padding2">
            <form name="filter_form">
                <p class="txt-side">Please select reseller :
                    <select name="filter" class="cell-130" onchange="filter_resellers();">
                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['resellers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                            <option value="<?php echo $this->_tpl_vars['resellers'][$this->_sections['i']['index']]['reseller_id']; ?>
" <?php if ($this->_supers['get']['reseller_id'] == $this->_tpl_vars['resellers'][$this->_sections['i']['index']]['reseller_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['resellers'][$this->_sections['i']['index']]['reseller_name']; ?>
</option>
                        <?php endfor; endif; ?>
                    </select>
                </p>
            </form>
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr>
                    <td width="56%" valign="top" class="outline-grey"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                            <tr>
                                <td width="43%" class="table-header">Offer Name </td>
                                <td width="20%" class="table-header">Price</td>
                                <td width="14%" class="table-header">Seats</td>
                                <td width="23%" class="table-header">&nbsp;</td>
                            </tr>
                            <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['reseller_offers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                <tr  bgcolor="<?php echo smarty_function_cycle(array('values' => "#F8F8F8,#FFFFFF"), $this);?>
">
                                    <td class="table-line"><?php echo $this->_tpl_vars['reseller_offers'][$this->_sections['i']['index']]['name']; ?>
</td>
                                    <td class="table-line">&pound;<?php echo $this->_tpl_vars['reseller_offers'][$this->_sections['i']['index']]['price']; ?>
</td>
                                    <td class="table-line"><?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['reseller_seat_count']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['t']['show'] = true;
$this->_sections['t']['max'] = $this->_sections['t']['loop'];
$this->_sections['t']['step'] = 1;
$this->_sections['t']['start'] = $this->_sections['t']['step'] > 0 ? 0 : $this->_sections['t']['loop']-1;
if ($this->_sections['t']['show']) {
    $this->_sections['t']['total'] = $this->_sections['t']['loop'];
    if ($this->_sections['t']['total'] == 0)
        $this->_sections['t']['show'] = false;
} else
    $this->_sections['t']['total'] = 0;
if ($this->_sections['t']['show']):

            for ($this->_sections['t']['index'] = $this->_sections['t']['start'], $this->_sections['t']['iteration'] = 1;
                 $this->_sections['t']['iteration'] <= $this->_sections['t']['total'];
                 $this->_sections['t']['index'] += $this->_sections['t']['step'], $this->_sections['t']['iteration']++):
$this->_sections['t']['rownum'] = $this->_sections['t']['iteration'];
$this->_sections['t']['index_prev'] = $this->_sections['t']['index'] - $this->_sections['t']['step'];
$this->_sections['t']['index_next'] = $this->_sections['t']['index'] + $this->_sections['t']['step'];
$this->_sections['t']['first']      = ($this->_sections['t']['iteration'] == 1);
$this->_sections['t']['last']       = ($this->_sections['t']['iteration'] == $this->_sections['t']['total']);
?><?php if ($this->_tpl_vars['reseller_offers'][$this->_sections['i']['index']]['reseller_offer_id'] == $this->_tpl_vars['reseller_seat_count'][$this->_sections['t']['index']]['reseller_offer_id']): ?><?php echo $this->_tpl_vars['reseller_seat_count'][$this->_sections['t']['index']]['seats_count']; ?>
<?php endif; ?><?php endfor; endif; ?></td>
                                    <td nowrap class="table-line"><div align="left">&nbsp; <a href="reseller_offers.php?reseller_id=<?php echo $this->_tpl_vars['reseller_id']; ?>
&option=edit&id=<?php echo $this->_tpl_vars['reseller_offers'][$this->_sections['i']['index']]['reseller_offer_id']; ?>
"><img src="images/icons/config_clock_16.gif" alt="Edit" width="16" height="16" border="0"></a>&nbsp; &nbsp; <a href="reseller_offers.php?option=delete&reseller_id=<?php echo $this->_tpl_vars['reseller_id']; ?>
&id=<?php echo $this->_tpl_vars['reseller_offers'][$this->_sections['i']['index']]['reseller_offer_id']; ?>
" onclick="return confirm('Are you sure you want to delete this offer?');"><img src="images/icons/del_16.gif" alt="Delete" width="16" height="16" border="0"></a></div></td>
                                </tr>
                                <?php endfor; else: ?>
                                <tr>
                                    <td colspan="3" bgcolor="#F8F8F8" class="table-line">There are no reseller offers defined!</td>
                                </tr>
                            <?php endif; ?>
                        </table></td>
                    <form name="offer_edit" method="post" action="reseller_offers.php?reseller_id=<?php echo $this->_tpl_vars['reseller_id']; ?>
&option=<?php echo $this->_supers['get']['option']; ?>
&id=<?php echo $this->_supers['get']['id']; ?>
" onsubmit="validate(); return returnVal;">
                        <input type="hidden" name="reseller_id" value="<?php echo $this->_tpl_vars['reseller_id']; ?>
" />
                        <td width="44%" valign="top" class="outline-grey"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                                <tr>
                                    <td class="table-header-light">&nbsp; <?php if ($this->_supers['get']['option'] == edit): ?>Edit<?php else: ?>Add new<?php endif; ?> offer: </td>
                                </tr>
                                <tr>
                                    <td valign="top" class="sitetable-padding"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">

                                            <tr>
                                                <td width="39%" class="sidetable-txt">Offer name: </td>
                                                <td width="61%" class="sidetable-txt"><input name="name" type="text" maxlength="50" value="<?php echo $this->_tpl_vars['reseller_offer']['name']; ?>
" class="cell-130" /></td>
                                            </tr>
                                            <tr>
                                                <td class="sidetable-txt"> Price: </td>
                                                <td class="sidetable-txt"><input name="price" type="text" maxlength="5" value="<?php echo $this->_tpl_vars['reseller_offer']['price']; ?>
"  class="sidetable-dropdown3" /></td>
                                            </tr>

                                            <?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['tours']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['x']['show'] = true;
$this->_sections['x']['max'] = $this->_sections['x']['loop'];
$this->_sections['x']['step'] = 1;
$this->_sections['x']['start'] = $this->_sections['x']['step'] > 0 ? 0 : $this->_sections['x']['loop']-1;
if ($this->_sections['x']['show']) {
    $this->_sections['x']['total'] = $this->_sections['x']['loop'];
    if ($this->_sections['x']['total'] == 0)
        $this->_sections['x']['show'] = false;
} else
    $this->_sections['x']['total'] = 0;
if ($this->_sections['x']['show']):

            for ($this->_sections['x']['index'] = $this->_sections['x']['start'], $this->_sections['x']['iteration'] = 1;
                 $this->_sections['x']['iteration'] <= $this->_sections['x']['total'];
                 $this->_sections['x']['index'] += $this->_sections['x']['step'], $this->_sections['x']['iteration']++):
$this->_sections['x']['rownum'] = $this->_sections['x']['iteration'];
$this->_sections['x']['index_prev'] = $this->_sections['x']['index'] - $this->_sections['x']['step'];
$this->_sections['x']['index_next'] = $this->_sections['x']['index'] + $this->_sections['x']['step'];
$this->_sections['x']['first']      = ($this->_sections['x']['iteration'] == 1);
$this->_sections['x']['last']       = ($this->_sections['x']['iteration'] == $this->_sections['x']['total']);
?>
                                                <tr>
                                                    <td colspan="2" class="sidetable-txt"><br /><img src="images/line-grey.gif" width="100%" height="1"><br /></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="sidetable-txt"><?php echo $this->_tpl_vars['tours'][$this->_sections['x']['index']]['tour_name']; ?>
<br /><br /></td>
                                                </tr>
                                                <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['tickets']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                                    <?php if ($this->_tpl_vars['tickets'][$this->_sections['i']['index']]['ticket_tour_id'] == $this->_tpl_vars['tours'][$this->_sections['x']['index']]['tour_id']): ?>
                                                        <tr>
                                                            <td class="table-line"> <?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['ticket_type']; ?>
 &pound;: </td>
                                                            <td class="sidetable-txt"><input name="reseller_ticket_<?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['ticket_id']; ?>
" type="text" maxlength="5" class="sidetable-dropdown5" value="<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['reseller_offer_tickets']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['t']['show'] = true;
$this->_sections['t']['max'] = $this->_sections['t']['loop'];
$this->_sections['t']['step'] = 1;
$this->_sections['t']['start'] = $this->_sections['t']['step'] > 0 ? 0 : $this->_sections['t']['loop']-1;
if ($this->_sections['t']['show']) {
    $this->_sections['t']['total'] = $this->_sections['t']['loop'];
    if ($this->_sections['t']['total'] == 0)
        $this->_sections['t']['show'] = false;
} else
    $this->_sections['t']['total'] = 0;
if ($this->_sections['t']['show']):

            for ($this->_sections['t']['index'] = $this->_sections['t']['start'], $this->_sections['t']['iteration'] = 1;
                 $this->_sections['t']['iteration'] <= $this->_sections['t']['total'];
                 $this->_sections['t']['index'] += $this->_sections['t']['step'], $this->_sections['t']['iteration']++):
$this->_sections['t']['rownum'] = $this->_sections['t']['iteration'];
$this->_sections['t']['index_prev'] = $this->_sections['t']['index'] - $this->_sections['t']['step'];
$this->_sections['t']['index_next'] = $this->_sections['t']['index'] + $this->_sections['t']['step'];
$this->_sections['t']['first']      = ($this->_sections['t']['iteration'] == 1);
$this->_sections['t']['last']       = ($this->_sections['t']['iteration'] == $this->_sections['t']['total']);
?><?php if ($this->_tpl_vars['tickets'][$this->_sections['i']['index']]['ticket_id'] == $this->_tpl_vars['reseller_offer_tickets'][$this->_sections['t']['index']]['ticket_id']): ?><?php echo $this->_tpl_vars['reseller_offer_tickets'][$this->_sections['t']['index']]['quantity']; ?>
<?php endif; ?><?php endfor; endif; ?>" /></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <?php endfor; else: ?>
                                                    <tr>
                                                        <td colspan="3" bgcolor="#F8F8F8" class="table-line">There are no tickets defined!</td>
                                                    </tr>
                                                <?php endif; ?>

                                            <?php endfor; endif; ?>
                                            <tr>
                                                <td colspan="2" class="sidetable-txt"><div align="center"><a href="javascript: document.offer_edit.submit();" onclick="validate(); return returnVal;" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image39','','images/button-submit-on.gif',1)"><img src="images/button-submit-off.gif" alt="Submit" name="Image39" width="63" height="23" border="0"></a></div></td>
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