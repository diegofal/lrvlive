<?
include "check_session.php";


$smarty->assign("pages_dir","pages");
$smarty->assign("title","London RIB Voyages | Beware the Barrier, Tower Bridge");
$smarty->assign("desc","The ultimate Halloween night! Creep onto one of London RIB Voyages boats for a 30 knot ride, then join London Walks for a Jack the Ripper walking tour");
$smarty->assign("page","bewarethebarrier");
$smarty->display('site_pages.tpl');
?>
