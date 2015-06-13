<?
// pornire sesiune :
require_once "check_login.php";
include "../WEB-INF/includes/functions/functions_payment.php";


if (empty($_POST) and !empty($_GET['id'])) {
// voucher_order
$query = "SELECT * FROM $db->voucher_order WHERE voucher_order_unique_code= '".$_GET['id']."'";
$voucher_order = $db->select_fields ($db->voucher_order ,$query, "" , "", "", "", "1", "", 1);
$smarty->assign("voucher_order",$voucher_order);

// voucher
$query = "SELECT * FROM $db->voucher WHERE voucher_id=".$voucher_order[voucher_order_voucher_id];
$voucher = $db->select_fields ($db->voucher ,$query, "" , "", "", "", "1", "", 1);


// tour
$query = "SELECT * FROM $db->tour WHERE tour_del = 0 AND tour_id = ".$voucher[voucher_tour_id];
$tour = $db->select_fields ($db->tour ,$query, "" , "", "", "", "1", "", 1);
$smarty->assign("tour",$tour);
$smarty->display('booking/page_edit_voucher.tpl');
}

elseif (!empty($_POST)) {
// voucher_order
$query = "SELECT * FROM $db->voucher_order WHERE voucher_order_unique_code= '".@$_POST['code']."'";
$voucher_order = $db->select_fields ($db->voucher_order ,$query, "" , "", "", "", "1", "", 1);

// voucher
$query = "SELECT * FROM $db->voucher WHERE voucher_id=".$voucher_order[voucher_order_voucher_id];
$voucher = $db->select_fields ($db->voucher ,$query, "" , "", "", "", "1", "", 1);

	
$_total=@$_POST['voucher_order_total'];
$total= $_total * ((100 - $voucher['voucher_discount'])/100);



$fields = 	array(      "voucher_order_to" => @$_POST['voucher_order_to'],
						"voucher_order_phone_to" => @$_POST['voucher_order_phone_to'],
						"voucher_order_email" => @$_POST['voucher_order_email'],
						"voucher_order_name" => @$_POST['voucher_order_name'],
						"voucher_order_phone" => @$_POST['voucher_order_phone'],
						"voucher_order_name_to" => @$_POST['voucher_order_name_to'],
						"voucher_order_address1_to" => @$_POST['voucher_order_address1_to'],
						"voucher_order_message" => @$_POST['voucher_order_message'],
						"voucher_order_number" => @$_POST['voucher_order_number'],
						"voucher_order_total" => @$_POST['voucher_order_total'],	
						"voucher_order_discounted_total" => $total,
						);
						
if( $db->edit_field($db->voucher_order, $fields, "voucher_order_unique_code", @$_POST['code']) ) {
	include "../WEB-INF/includes/functions/functions_email.php";
	include "../WEB-INF/includes/functions/functions_images.php";
	
	$query = "SELECT * FROM $db->voucher_order WHERE voucher_order_unique_code= '".@$_POST['code']."'";
	$voucher_order = $db->select_fields ($db->voucher_order ,$query, "" , "", "", "", "1", "", 1);
	
	#echo "<a href=\"http://localhost/vouchers/html.php?code=".$voucher_order['voucher_order_unique_code']."\">link</a>";
	$_img_date=explode("-", $voucher_order['voucher_order_date']);
	$img_date=$_img_date[2] . "." . $_img_date[1] . "." . substr($_img_date[0],-2,2);
	
	#@send_confirmation_mail_voucher($voucher_order['voucher_order_email'], $voucher_order['voucher_order_unique_code']);
	@make_voucher_images($voucher_order['voucher_order_unique_code'], array("voucher_order_number"=>$voucher_order['voucher_order_number'], "voucher_order_to"=>$voucher_order['voucher_order_to'], "voucher_order_date"=>$img_date, "guests"=>$voucher_order['voucher_order_tickets_number']));
	$smarty->display('make_booking/page_edit_done.tpl');
	exit();
}
						
$smarty->display('make_booking/page_edit_fault.tpl');
	} 	
else {
	print '<script language="javascript">window.close();</script>';
	die();
}
?>