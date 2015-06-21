<?php /* Smarty version 2.6.25, created on 2015-06-21 17:05:30
         compiled from pages/page_booking_step1.tpl */ ?>
<form name="step1" method="post" action="booking.php?tour_id=<?php echo $this->_tpl_vars['tour_id']; ?>
&subpage=step1">
<div class="step step-1">
    <header>
        <span>Step 1</span>
        <h3>Choose your trip type and seats</h3>
        <p>On the final step you will see a full payment detail before the confirmation.</p>
    </header>
    <div class="buy-content">

        <div>
            <label for="trip">Trip:</label>
            <select id="trip" name="trip" class="cs-select cs-skin-elastic">
                <option value="" disabled>Select your trip </option>
                <option value="9" <?php if ($this->_tpl_vars['tour_id'] == 9): ?> selected<?php endif; ?>>The Ultimate London Adventure</option>
                <option value="1" <?php if ($this->_tpl_vars['tour_id'] == 1): ?> selected<?php endif; ?>>Captain Kidd's Canary Wharf</option>
                <option value="4" <?php if ($this->_tpl_vars['tour_id'] == 4): ?> selected<?php endif; ?>>Thames Barrier Explorers Voyage</option>
                <option value="12" <?php if ($this->_tpl_vars['tour_id'] == 12): ?> selected<?php endif; ?>>Break The Barrier (Speed only)</option>
                <option value="-1">Spring has Sprung</option>
            </select>
        </div>

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
        <div>
            <input name="ticket[]" type="hidden" value="<?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['ticket_id']; ?>
" />
            <input name="price[]" type="hidden" value="<?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['ticket_price']; ?>
" />

            <label for="ticket_type_<?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['ticket_id']; ?>
"><?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['ticket_type']; ?>
:</label>
            <select id="ticket_type_<?php echo $this->_tpl_vars['tickets'][$this->_sections['i']['index']]['ticket_id']; ?>
" name="quantity[]" onchange="calculate_total()" class="cs-select ticket cs-skin-elastic">
                <option value="0" disabled selected>0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>
        <?php endfor; endif; ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
        <div>
            <label for="charter">Charter ?</label>
            <input type="checkbox" name="charter" id="charter"/>
        </div>
    </div>


</div>
</form>