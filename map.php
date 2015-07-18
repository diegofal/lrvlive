<?
include "check_session.php";

$smarty->assign("pages_dir","pages");
$smarty->assign("page","map");
$smarty->display('site_pages.tpl');
?>
