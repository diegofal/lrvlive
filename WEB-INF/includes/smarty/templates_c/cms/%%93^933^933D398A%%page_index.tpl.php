<?php /* Smarty version 2.6.25, created on 2015-06-13 12:53:00
         compiled from index/page_index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'index/page_index.tpl', 67, false),)), $this); ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<form name="login" action="check_login.php" method="post" enctype="application/x-www-form-urlencoded">
  <tr>
    <td rowspan="3" valign="top" class="splash-backleft">&nbsp;</td>
    <td width="309" height="55" valign="top"><img src="images/splash/splash_backtop.gif" width="309" height="55" /></td>
    <td rowspan="3" valign="top" class="splash-backright">&nbsp;</td>
  </tr>
  <tr>
    <td width="309" height="96" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="splash-backbox">
      <tr>
        <td><img src="images/splash/splash_logo.jpg" alt="London RIB Voyages" width="309" height="67" /></td>
      </tr>
      <tr>
        <td class="splash-backlogin splash-contentpadding"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="splash-content"><div align="justify">Please enter your username and password in the form&nbsp; below to access the CMS administration panel. </div></td>
          </tr>
          <tr>
            <td class="splash-content"><img src="images/splash/splash_line.gif" width="100%" height="2" vspace="10"></td>
          </tr>
          <tr>
            <td class="splash-content"><img src="images/spacer.gif" width="10" height="5"></td>
          </tr>
          <tr>
            <td class="splash-content"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="28%"><div align="left" class="splash-content"><strong>Username: </strong></div></td>
                <td width="72%"><input name="user" type="text" maxlength="10" class="splash-cell"></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td class="splash-content"><img src="images/spacer.gif" width="10" height="6"></td>
          </tr>
          <tr>
            <td class="splash-content"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="28%"><div align="left" class="splash-content"><strong>Password: </strong></div></td>
                <td width="72%"><input name="pass" type="password" maxlength="10" class="splash-cell"></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td class="splash-content"><img src="images/spacer.gif" width="10" height="8"></td>
          </tr>
          <tr>
            <td class="splash-content"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="28%"><div align="left" class="splash-content"></div></td>
                <td width="72%">
					<a href="javascript:document.login.submit();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image8','','images/button-login-on.gif',1)"><img src="images/button-login-off.gif" alt="Login" name="Image8" width="53" height="23" border="0"></a>
<!--				<input type="image" src="images/button-login-off.gif" alt="Login" name="Login" width="53" height="23" border="0" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Login','','images/button-login-on.gif',1)">
				<input type="image" src="images/button-login-off.gif" alt="Login" name="but_submit" width="53" height="23" border="0" onMouseOut="MM_swapImgRestore()" onMouseOver="alert(document.login.but_submit.name);">-->
			</td>
              </tr>
            </table></td>
          </tr>
		<?php if ($this->_supers['get']['reason'] == 'failure'): ?>
          <tr>
            <td class="splash-content"><img src="images/splash/splash_line.gif" width="100%" height="2" vspace="10"></td>
          </tr>		
          <tr>
            <td class="splash-content"><img src="images/spacer.gif" width="10" height="8"></td>
          </tr>		
		 <tr>
		 	<td class="splash-content">
			<?php echo smarty_function_config_load(array('file' => "config.conf",'section' => 'Errors'), $this);?>

			<?php if ($this->_supers['get']['error'] == 1): ?>
				<?php echo $this->_config[0]['vars']['error_1']; ?>

			<?php elseif ($this->_supers['get']['error'] == 2): ?>
				<?php echo $this->_config[0]['vars']['error_2']; ?>

			<?php elseif ($this->_supers['get']['error'] == 3): ?>
				<?php echo $this->_config[0]['vars']['error_3']; ?>

			<?php else: ?>
				<?php echo $this->_config[0]['vars']['error_4']; ?>

			<?php endif; ?>
			</td>
		 </tr>
		<?php endif; ?>			
          <tr>
            <td class="splash-content"><img src="images/spacer.gif" width="10" height="8"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="images/splash/splash_boxbottom.gif" width="309" height="10" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" class="splash-backmiddle">&nbsp;</td>
  </tr>
</form>
</table>
