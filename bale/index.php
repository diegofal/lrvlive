<?
// includere smarty :
include "../WEB-INF/includes/smarty/smarty_cms.php";

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","reseller_booking");
$smarty->assign("page","index");
$smarty->display('cms_resellers.tpl');
?>