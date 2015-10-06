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
$openVoucher = $_GET['openVoucher'];
$smarty->assign("openVoucher",$openVoucher);
$smarty->assign("pages_dir","pages");
$smarty->assign("title","London RIB Voyages | Ultimate London Adventure, London Eye");
$smarty->assign("desc","Step aboard London RIB Voyages' new generation of speedboats. Our ‘Ultimate London Adventure’ is a jam-packed, adrenaline-fuelled 50 minutes of fun.");
$smarty->assign("meta","ultimate london adventure, london eye pier, london eye boat, london rib voyages, speedboat rides, london speedboat, london rib tours, speedboat experiences, thames river cruise, london boat trips, london river cruise, london rib experience, river thames cruise, thames cruise, city cruises
");
$smarty->assign("page","ultimatelondon");
$smarty->display('site_pages.tpl');
?>
