<?php /* Smarty version 2.6.25, created on 2015-06-21 15:08:41
         compiled from site_pages.tpl */ ?>
		<?php if ($this->_tpl_vars['page'] == index || $this->_tpl_vars['page'] == test_index): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "utils/site_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php elseif ($this->_tpl_vars['subpage'] == _step1 || $this->_tpl_vars['subpage'] == _step2 || $this->_tpl_vars['subpage'] == _step3 || $this->_tpl_vars['subpage'] == _step4 || $this->_tpl_vars['subpage'] == _step5 || $this->_tpl_vars['subpage'] == _step6 || $this->_tpl_vars['subpage'] == _step8 || $this->_tpl_vars['subpage'] == _voucher_step1 || $this->_tpl_vars['subpage'] == _voucher_step2 || $this->_tpl_vars['subpage'] == _voucher_step3 || $this->_tpl_vars['subpage'] == _voucher_step4): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "utils/site_booking_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>     	
	<?php else: ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "utils/site_header_details.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
    
    
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['pages_dir'])."/page_".($this->_tpl_vars['page']).($this->_tpl_vars['subpage']).".tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<?php if ($this->_tpl_vars['page'] == index): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "utils/site_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php elseif ($this->_tpl_vars['subpage'] == _step1 || $this->_tpl_vars['subpage'] == _step2 || $this->_tpl_vars['subpage'] == _step3 || $this->_tpl_vars['subpage'] == _step4 || $this->_tpl_vars['subpage'] == _step5 || $this->_tpl_vars['subpage'] == _step6 || $this->_tpl_vars['subpage'] == _step8): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "utils/site_booking_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "utils/site_footer_detail.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>

