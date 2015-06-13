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
				{foreach key=key item=item from=$menu_cms}
					{if $pages_dir == $key}
						{assign var="submenu" value=$item}
					{/if}
				{/foreach}	
				{foreach key=key item=item from=$menu_cms_pages}
						{assign var="submenus" value=$item}
				{/foreach}	
						  
				{if $pages_dir == booking}
                <td width="155"><img src="images/menu-book-act.jpg" alt="Booking" name="Image3" width="155" height="39"></td>
				{else}
				<td width="155"><a href="booking.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','images/menu-book-on.jpg',1)"><img src="images/menu-book-off.jpg" name="Image3" width="155" height="39" border="0"></a></td>
				{/if}
				{if $pages_dir == editor}
                <td width="126"><img src="images/menu-editor-act.jpg" name="Image4" width="126" height="39" border="0"></td>
				{else}
                <td width="126"><a href="editor.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','images/menu-editor-on.jpg',1)"><img src="images/menu-editor-off.jpg" name="Image4" width="126" height="39" border="0"></a></td>
				{/if}
				{if $pages_dir == settings}
                <td width="108"><img src="images/menu-settings-act.jpg" name="Image5" width="108" height="39" border="0"></td>
				{else}
                <td width="108"><a href="settings.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image5','','images/menu-settings-on.jpg',1)"><img src="images/menu-settings-off.jpg" name="Image5" width="108" height="39" border="0"></a></td>
				{/if}
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
				{foreach key=key item=item from=$submenu}
					{if $page == $key}
					<td nowrap id="submenu-active">{$item}</td>
					<td><img src="images/spacer.gif" width="2" height="10"></td>
					{else}
					<td nowrap id="submenu-normal"><a href="{$key}.php" id="submenu">{$item}</a></td>
					<td><img src="images/spacer.gif" width="2" height="10"></td>				
					{/if}
				{/foreach}		  
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