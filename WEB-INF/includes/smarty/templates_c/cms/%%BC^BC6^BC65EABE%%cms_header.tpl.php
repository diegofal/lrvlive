<?php /* Smarty version 2.6.25, created on 2015-06-13 12:53:00
         compiled from utils/cms_header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'utils/cms_header.tpl', 5, false),)), $this); ?>
<!--START HEADER-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php echo smarty_function_config_load(array('file' => "config.conf",'section' => 'General'), $this);?>

<title><?php echo $this->_config[0]['vars']['COMPANY_NAME']; ?>
</title>

<?php if ($this->_tpl_vars['page'] == 'index'): ?>
<link href="css/splash.css" rel="stylesheet" type="text/css" />
<?php else: ?>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<?php endif; ?>

<script src="ckeditor/ckeditor.js"></script>
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/validation.js"></script>
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/macromedia.js"></script>
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/color_picker.js"></script>

<?php if ($this->_tpl_vars['subpage'] == '_bookings'): ?>
	<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/cms_bookings.js"></script>
<?php endif; ?>

<?php if ($this->_tpl_vars['page'] == 'orders'): ?>
	<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/cms_orders.js"></script>
<?php endif; ?>

<?php if ($this->_tpl_vars['page'] == 'voucher_orders'): ?>
	<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/cms_voucher_orders.js"></script>
<?php endif; ?>

<?php if ($this->_tpl_vars['page'] == 'calendar'): ?>
	<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/cms_calendar.js"></script>
<?php endif; ?>

<?php if ($this->_tpl_vars['page'] == 'boats'): ?>
	<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/cms_boats.js"></script>
<?php endif; ?>

<?php if ($this->_tpl_vars['page'] == 'tickets'): ?>
	<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/cms_tickets.js"></script>
<?php endif; ?>

<?php if ($this->_tpl_vars['page'] == 'template'): ?>
	<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/cms_template.js"></script>
<?php endif; ?>

<?php if ($this->_tpl_vars['page'] == 'code'): ?>
	<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/cms_code.js"></script>
<?php endif; ?>

<?php if ($this->_tpl_vars['page'] == 'reseller_offers'): ?>
    <script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/cms_reseller_offers.js"></script>
<?php endif; ?>


    <?php if ($this->_tpl_vars['page'] == 'boats'): ?>
<?php echo '
<script language="javascript">
<!--
function init_boats() {
	define(\'boat_name\', \'string\', \'Boat Name\',5);
	define(\'boat_passengers\', \'num\', \'No. of Passengers\');
}
-->
</script>
'; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['page'] == 'tickets'): ?>
<?php echo '
<script language="javascript">
<!--
function init_tickets() {
	define(\'ticket_type\', \'string\', \'Ticket Name\',5);
	define(\'ticket_price\', \'num\', \'Price\');
}
-->
</script>
'; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['page'] == 'skipper'): ?>
<?php echo '
<script language="javascript">
<!--
function init_skippers() {
	define(\'skipper_name\', \'string\', \'skipper name\',5);
	}
-->
</script>
'; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['page'] == 'hear_aboutus'): ?>
<?php echo '
<script language="javascript">
<!--
function init_hearaboutus() {
	define(\'Title\', \'string\', \'Title\',5);
	}
-->
</script>
'; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['page'] == 'guide'): ?>
<?php echo '
<script language="javascript">
<!--
function init_guides() {
	define(\'guide_name\', \'string\', \'guide name\',5);
	}
-->
</script>
'; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['page'] == 'resellers'): ?>
<?php if ($this->_supers['get']['error'] == name): ?><script language="javascript">alert("Error. Name <?php echo $this->_supers['get']['name']; ?>
 is already used or not was been cleaned from your DB.")</script><?php endif; ?>
<?php echo '
<script language="javascript">
<!--
function init_resellers() {
	define(\'reseller_name\', \'string\', \'Name\',5);
	}
-->
</script>
'; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['page'] == 'change'): ?>
<?php echo '
<script language="javascript">
<!--
function init_change() {
define(\'old_password\', \'string\', \'Old Password\', 4);
define(\'new_password\', \'password\', \'New Password\', 4);
define(\'retype_new_password\', \'retype\', \'Retype New Password\');
}
-->
</script>
'; ?>

<?php endif; ?>
</head>
<?php echo '<body onLoad="'; ?><?php if (page == 'index'): ?><?php echo 'MM_preloadImages(\'images/button-login-on.gif\');'; ?><?php endif; ?><?php echo ''; ?><?php if (pages_dir == 'booking'): ?><?php echo 'MM_preloadImages(\'images/menu-editor-on.jpg\',\'images/menu-settings-on.jpg\');'; ?><?php endif; ?><?php echo ''; ?><?php if (pages_dir == 'editor'): ?><?php echo 'MM_preloadImages(\'images/menu-settings-on.jpg\',\'images/menu-book-on.jpg\');'; ?><?php endif; ?><?php echo ''; ?><?php if (pages_dir == 'settings'): ?><?php echo 'MM_preloadImages(\'images/menu-editor-on.jpg\',\'images/button-submit-on.gif\');'; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['page'] == 'boats'): ?><?php echo 'init_boats();'; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['page'] == 'tickets'): ?><?php echo 'init_tickets();'; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['page'] == 'skipper'): ?><?php echo 'init_skippers();'; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['page'] == 'hear_aboutus'): ?><?php echo 'init_hearaboutus();'; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['page'] == 'guide'): ?><?php echo 'init_guides();'; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['page'] == 'change'): ?><?php echo 'init_change();'; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['page'] == 'resellers'): ?><?php echo 'init_resellers();'; ?><?php endif; ?><?php echo '">'; ?>

<?php if ($this->_tpl_vars['page'] != 'index'): ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="backgr-left">&nbsp;</td>
    <td width="6" class="border-left">&nbsp;</td>
    <td width="880" valign="top" bgcolor="#FFFFFF">
<?php endif; ?>	
<!--END HEADER-->