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
$smarty->assign("title","Totally Thames Blast 2015 | London RIB Voyages");
$smarty->assign("desc","Celebrate this year?s ?Totally Thames Festival? on a river trip with a modern twist!");
$smarty->assign("page","totallythames");
$smarty->display('site_pages.tpl');
?>
