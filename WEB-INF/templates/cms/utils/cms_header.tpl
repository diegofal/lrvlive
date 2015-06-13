<!--START HEADER-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
{config_load file="config.conf" section="General"}
<title>{#COMPANY_NAME#}</title>

{if $page == "index"}
<link href="css/splash.css" rel="stylesheet" type="text/css" />
{else}
<link href="css/main.css" rel="stylesheet" type="text/css" />
{/if}

<script src="ckeditor/ckeditor.js"></script>
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/validation.js"></script>
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/macromedia.js"></script>
<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/color_picker.js"></script>

{if $subpage == "_bookings"}
	<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/cms_bookings.js"></script>
{/if}

{if $page == "orders"}
	<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/cms_orders.js"></script>
{/if}

{if $page == "voucher_orders"}
	<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/cms_voucher_orders.js"></script>
{/if}

{if $page == "calendar"}
	<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/cms_calendar.js"></script>
{/if}

{if $page == "boats"}
	<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/cms_boats.js"></script>
{/if}

{if $page == "tickets"}
	<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/cms_tickets.js"></script>
{/if}

{if $page == "template"}
	<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/cms_template.js"></script>
{/if}

{if $page == "code"}
	<script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/cms_code.js"></script>
{/if}

{if $page == "reseller_offers"}
    <script language="javascript" type="text/javascript" src="../WEB-INF/includes/js/cms_reseller_offers.js"></script>
{/if}


    {if $page=="boats"}
{literal}
<script language="javascript">
<!--
function init_boats() {
	define('boat_name', 'string', 'Boat Name',5);
	define('boat_passengers', 'num', 'No. of Passengers');
}
-->
</script>
{/literal}
{/if}

{if $page=="tickets"}
{literal}
<script language="javascript">
<!--
function init_tickets() {
	define('ticket_type', 'string', 'Ticket Name',5);
	define('ticket_price', 'num', 'Price');
}
-->
</script>
{/literal}
{/if}

{if $page=="skipper"}
{literal}
<script language="javascript">
<!--
function init_skippers() {
	define('skipper_name', 'string', 'skipper name',5);
	}
-->
</script>
{/literal}
{/if}

{if $page=="hear_aboutus"}
{literal}
<script language="javascript">
<!--
function init_hearaboutus() {
	define('Title', 'string', 'Title',5);
	}
-->
</script>
{/literal}
{/if}

{if $page=="guide"}
{literal}
<script language="javascript">
<!--
function init_guides() {
	define('guide_name', 'string', 'guide name',5);
	}
-->
</script>
{/literal}
{/if}

{if $page=="resellers"}
{if $smarty.get.error==name}<script language="javascript">alert("Error. Name {$smarty.get.name} is already used or not was been cleaned from your DB.")</script>{/if}
{literal}
<script language="javascript">
<!--
function init_resellers() {
	define('reseller_name', 'string', 'Name',5);
	}
-->
</script>
{/literal}
{/if}

{if $page=="change"}
{literal}
<script language="javascript">
<!--
function init_change() {
define('old_password', 'string', 'Old Password', 4);
define('new_password', 'password', 'New Password', 4);
define('retype_new_password', 'retype', 'Retype New Password');
}
-->
</script>
{/literal}
{/if}
</head>
{strip}
<body onLoad="
{if page=="index"}
	MM_preloadImages('images/button-login-on.gif');
{/if}
{if pages_dir=="booking"}
	MM_preloadImages('images/menu-editor-on.jpg','images/menu-settings-on.jpg');
{/if}
{if pages_dir=="editor"}
	MM_preloadImages('images/menu-settings-on.jpg','images/menu-book-on.jpg');
{/if}
{if pages_dir=="settings"}
	MM_preloadImages('images/menu-editor-on.jpg','images/button-submit-on.gif');
{/if}
{if $page=="boats"}
	init_boats();
{/if}
{if $page=="tickets"}
	init_tickets();
{/if}
{if $page=="skipper"}
	init_skippers();
{/if}
{if $page=="hear_aboutus"}
	init_hearaboutus();
{/if}
{if $page=="guide"}
	init_guides();
{/if}
{if $page=="change"}
	init_change();
{/if}
{if $page=="resellers"}
	init_resellers();
{/if}
">
{/strip}
{if $page!="index"}
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="backgr-left">&nbsp;</td>
    <td width="6" class="border-left">&nbsp;</td>
    <td width="880" valign="top" bgcolor="#FFFFFF">
{/if}	
<!--END HEADER-->