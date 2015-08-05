<?
include "check_session.php";

$smarty->assign("pages_dir","pages");
$smarty->assign("page","map");
$smarty->assign("title","Locations | London RIB Voyages");
$smarty->assign("desc","You will see iconic locations of London on our speedboats trips in the Thames. London Eye, Tower Bridge, Houses of Parliament, Cleopatra's Needle, Somerset House, Oxo tower, HMS President, St Pauls Cathedral, Millennium Bridge and many more");
$smarty->display('site_pages.tpl');
?>
