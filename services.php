<?
// if($_SERVER['REMOTE_ADDR'] == '37.157.49.220') { echo 'OK'; exit; }

// includere smarty :
include "check_session.php";

//$id_page = 1;
//$content = $db->select_fields($db->page, "", "", "page_id", $id_page , "", "", "",1 );


//
//$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_id ASC";
//$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_home_name1", "tour_home_name2", "tour_duration", "tour_home_image", "title_home_page", "tour_special_text_home", "tour_charter_price"));

//foreach ($tours as $index=>$tour) {
//	$query = "SELECT ticket_type, ticket_price FROM `".$db->ticket."` WHERE 1 AND ticket_tour_id = '".$tour['tour_id']."' AND ticket_del = 0";
//	$tickets = $db->select_fields($db->ticket, $query, array("ticket_type", "ticket_price"));
//	if (sizeof($tickets)>0)
//		$tours[$index]['tour_tickets'] = $tickets;
//	else
//		$tours[$index]['tour_tickets'] = false;
//
//	$query = "SELECT * FROM $db->voucher WHERE 1 AND voucher_del = 0 AND voucher_tour_id = ".$tour['tour_id']." ORDER BY voucher_id ASC";
//	$vouchers = $db->select_fields ($db->voucher,$query, array("voucher_id","voucher_tour_id"));
//	if (sizeof($vouchers) > 0) {
//		$tours[$index]['have_voucher'] = true;
//		$tours[$index]['voucher_id'] = $vouchers[0]['voucher_id'];
//	}
//
//
//}
//
//	$tours_indexed = array();
//
//	foreach ($tours as $tour) {
//		$tours_indexed[$tour['tour_id']] = $tour;
//	}
//
//
//$smarty->assign("tours",$tours_indexed);
//$smarty->assign("_tours",$tours);

//print_r($tours_indexed);

//$smarty->assign("content",$content);

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","pages");
$smarty->assign("page","services");
$smarty->assign("title","London RIB Voyages | Special & Group Events");
$smarty->assign("meta","safety boating, river to restaurant, charter city boat trips, stag boat rides, hen boat rides, river filming, corporate boat rides, boat rides for coporate events, london rib voyages, speedboat rides, london speedboat, london rib tours, speedboat experiences, thames river cruise, london boat trips, london river cruise, london rib experience, river thames cruise, thames cruise, city cruises
");
$smarty->assign("desc","London RIB Voyages cater for special events too including filming, Stag & Hen do's, corporate activities and river to restaurant drop-offs.");
$smarty->display('site_pages.tpl');
?>
