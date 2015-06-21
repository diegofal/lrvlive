<?php /* Smarty version 2.6.25, created on 2015-06-13 13:09:34
         compiled from utils/cms_menu.tpl */ ?>
<!-- START MENU -->
	<table width="880" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="880" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="411"><img src="images/header-top.jpg" alt="CMS" width="411" height="79"></td>
            <td width="469" valign="top"><table width="469" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="4"><img src="images/header-menu-top.jpg" alt="..." width="469" height="40"></td>
              </tr>
              <tr>
				<?php $_from = $this->_tpl_vars['menu_cms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
					<?php if ($this->_tpl_vars['pages_dir'] == $this->_tpl_vars['key']): ?>
						<?php $this->assign('submenu', $this->_tpl_vars['item']); ?>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>	
				<?php $_from = $this->_tpl_vars['menu_cms_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
						<?php $this->assign('submenus', $this->_tpl_vars['item']); ?>
				<?php endforeach; endif; unset($_from); ?>	
						  
				<?php if ($this->_tpl_vars['pages_dir'] == booking): ?>
                <td width="155"><img src="images/menu-book-act.jpg" alt="Booking" name="Image3" width="155" height="39"></td>
				<?php else: ?>
				<td width="155"><a href="booking.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','images/menu-book-on.jpg',1)"><img src="images/menu-book-off.jpg" name="Image3" width="155" height="39" border="0"></a></td>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['pages_dir'] == editor): ?>
                <td width="126"><img src="images/menu-editor-act.jpg" name="Image4" width="126" height="39" border="0"></td>
				<?php else: ?>
                <td width="126"><a href="editor.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','images/menu-editor-on.jpg',1)"><img src="images/menu-editor-off.jpg" name="Image4" width="126" height="39" border="0"></a></td>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['pages_dir'] == settings): ?>
                <td width="108"><img src="images/menu-settings-act.jpg" name="Image5" width="108" height="39" border="0"></td>
				<?php else: ?>
                <td width="108"><a href="settings.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image5','','images/menu-settings-on.jpg',1)"><img src="images/menu-settings-off.jpg" name="Image5" width="108" height="39" border="0"></a></td>
				<?php endif; ?>
                <td width="80" valign="bottom" class="header-back-logout"><div align="center"><a href="logout.php" class="logout">Log Out</a></div></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="42" valign="bottom" class="submenu-row">
			<table width="10" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<?php $_from = $this->_tpl_vars['submenu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
					<?php if ($this->_tpl_vars['page'] == $this->_tpl_vars['key']): ?>
					<td nowrap id="submenu-active"><?php echo $this->_tpl_vars['item']; ?>
</td>
					<td><img src="images/spacer.gif" width="2" height="10"></td>
					<?php else: ?>
					<td nowrap id="submenu-normal"><a href="<?php echo $this->_tpl_vars['key']; ?>
.php" id="submenu"><?php echo $this->_tpl_vars['item']; ?>
</a></td>
					<td><img src="images/spacer.gif" width="2" height="10"></td>				
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>		  
				</tr>
			</table>
		</td>
      </tr>
    </table>
      <table width="880" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="images/spacer.gif" width="10" height="35"></td>
      </tr>
    </table>
<!-- END MENU -->