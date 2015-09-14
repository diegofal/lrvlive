<?
include "check_session.php";

$smarty->assign("pages_dir","pages");
$smarty->assign("page","map");
$smarty->assign("meta","river sightseeing, london rib voyages directions, river landmarks, london rib voyages, speedboat rides, london speedboat, london rib tours, speedboat experiences, thames river cruise, london boat trips, london river cruise, london rib experience, river thames cruise, thames cruise, city cruises
");
$smarty->assign("title","London RIB Voyages | Our Map - Meeting Points, Landmarks");
$smarty->assign("desc","Getting on a London RIB Voyages speedboat is a great way of sightseeing the capital. Our map explains where you can hop on and what you'll see!");
$smarty->display('site_pages.tpl');
?>
