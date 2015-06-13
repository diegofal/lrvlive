<?
// includere smarty :
include "check_session.php";

$id_page = 3;
$content = $db->select_fields($db->page, "", "", "page_id", $id_page , "", "", "",1 );
$smarty->assign("content",$content);

$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_id ASC";
$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_home_name1", "tour_home_name2", "tour_duration", "tour_home_image", "tour_charter_price"));

// asignare variabile smarty si generare fisier smarty :
/*echo "<pre>";
print_r($content);
exit();*/
$smarty->assign("_tours",$tours);
$smarty->assign("pages_dir","pages");
$smarty->assign("page","route");
$smarty->display('site_pages.tpl');
?>