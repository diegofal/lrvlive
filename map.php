<?
include "check_session.php";

$smarty->assign("pages_dir","pages");
$smarty->assign("page","map");
$smarty->assign("title","London RIB Voyages | Our Map - Meeting Points, Landmarks");
$smarty->assign("desc","Getting on a London RIB Voyages speedboat is a great way of sightseeing the capital. Our map explains where you can hop on and what you'll see!");
$smarty->display('site_pages.tpl');
?>
