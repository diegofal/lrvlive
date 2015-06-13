<?
// includere smarty :
include "../WEB-INF/includes/smarty/smarty_cms.php";

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","index");
$smarty->assign("page","index");
$smarty->display('cms_pages.tpl');
?>