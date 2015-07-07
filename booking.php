<?
include "check_session.php";
include "browser.php";
include "WEB-INF/includes/functions/functions_payment.php";
include "WEB-INF/includes/functions/functions_log.php";
include "WEB-INF/includes/functions/functions_order.php";

$price_fee = 3.95;
// Added by Carlos
$smarty->assign("price_fee", $price_fee);

$smarty->assign("os",browser_detection( 'os' ));

$smarty->assign("MycontentpageMeta",'');

$smarty->assign('order_id',$_SESSION['order_id']);

if( isset($_GET['tour_id']) && trim($_GET['tour_id'])!="" )
{
	if( trim($_GET['tour_id'])=="9" )
	{
		$smarty->assign("content",array("page_title"=>"Thames Boat Trips | for the ultimate James Bond London adventure"));
		$smarty->assign("tourTmp",array("tour_big_image_altTitle"=>"James Bond Thames Boat Trips"));
	}
	if( trim($_GET['tour_id'])=="1" )
	{
		$smarty->assign("content",array("page_title"=>"boat trip on the Thames for families | family sightseeing adventure in London"));
		$smarty->assign("tourTmp",array("tour_big_image_altTitle"=>"Captain Kidd�s Canary Wharf Voyages"));
	}	
	if( trim($_GET['tour_id'])=="4" )
	{
		$smarty->assign("content",array("page_title"=>"RIB Thames River Cruise | The ultimate London sightseeing trip to the Thames Barrier"));
		$smarty->assign("tourTmp",array("tour_big_image_altTitle"=>"Fast paced Thames River Cruise to the Thames Barrier"));
	}	
}
else if( isset($_GET['package_id']) && trim($_GET['package_id'])!="" )
{
	if( trim($_GET['package_id'])=="5" )
	{
		$smarty->assign("content",array("page_title"=>"Thames boat party | London Rib�s Pirate parties on the Thames"));
		$smarty->assign("MycontentpageMeta",'<meta name="description" content="Enjoy a Thames boat party with a difference � an imaginative alternative to any land bound kid�s party or celebration. Bold Buccaneers wishing to set sail should suitability attired for piratical daring do!" />
<meta name="keywords" content="thames boat party, pirate party, London rib voyages. Thames, London Boat trips" />');
		$smarty->assign("tourTmp",array("tour_big_image_altTitle"=>"Thames boat party with the pirates from London Rib Voyages!"));
	}
}	
else
{
	$smarty->assign("tourTmp",array("tour_big_image_altTitle"=>""));
	$smarty->assign("content",array("page_title"=>"Online Booking"));
}	

switch (@$_GET['subpage']){

/**
	VOUCHER STEP 4
*/
	case "voucher_step4":
		
		if (empty($_GET['crypt'])) {
			header("Location: booking.php?subpage=vouchers&expired=true");
			exit();			
		}

		$results = @decode_crypt($_GET['crypt']);
		
		/*
		write_log("Code: ".$results['code'].", Status: ".$results['status']);
		*/

		$voucher_order = $db->select_fields($db->voucher_order, "", "", 'voucher_order_unique_code', $results['code'], "", "", "", 1);

		
		if ($results['status'] == 'OK') {

			include "WEB-INF/includes/functions/functions_email.php";
			include "WEB-INF/includes/functions/functions_images.php";

			$_date = date("Y-m-d");
			$_img_date = date("d.m.y");
			$fields = array("voucher_order_date"=>$_date, 
							"voucher_order_payd" => 1);
			$db->edit_field($db->voucher_order, $fields, "voucher_order_unique_code", $results['code']);

			$query = "SELECT count(voucher_order_id) as cnt FROM `".$db->voucher_order."` WHERE 1 AND voucher_order_payd = 1 AND voucher_order_date = CURDATE()";
			$next_today_order = $db->select_field($db->voucher_order, "cnt", "", $query);

			$_order_time = date("Hm");
			$_order_dmy = date("dmy");
			$next_today_order = sprintf("%02d", $next_today_order[0]);
			$voucher_number = "lrv".$_order_time.$_order_dmy.$next_today_order;

			$db->edit_field($db->voucher_order, array("voucher_order_number"=>$voucher_number), "voucher_order_unique_code", $results['code']);
			@make_voucher_images($voucher_order['voucher_order_unique_code'], array("voucher_order_number"=>$voucher_number, "voucher_order_to"=>$voucher_order['voucher_order_to'], "voucher_order_date"=>$_img_date, "guests"=>$voucher_order['voucher_order_tickets_number']));
			@send_confirmation_mail_voucher($voucher_order['voucher_order_email'], $voucher_order['voucher_order_unique_code']);

			write_log("Time: ".$voucher_order['voucher_order_time'].", Voucher Order ID: ".$voucher_order['voucher_order_id'].", Direction: FROM PROTX, Voucher Order Code: ".$voucher_order['voucher_order_unique_code'].", Total: ". $voucher_order['voucher_order_total'].
				", Session ID: ".session_id().", results = ".serialize($results).", voucher_order = ".serialize($voucher_order));
			

		}	else {

			write_log("Time: ".$voucher_order['voucher_order_time'].", Voucher Order ID: ".$voucher_order['voucher_order_id'].", Direction: FROM PROTX (ERROR status not ok), Voucher Order Code: ".$voucher_order['voucher_order_unique_code'].", Total: ". $voucher_order['voucher_order_total'].
				", Session ID: ".session_id().", results = ".serialize($results).", voucher_order = ".serialize($voucher_order));

		}
		$smarty->assign("voucher_id",$voucher_order['voucher_order_voucher_id']);
		$smarty->assign("results",$results);
		$smarty->assign("subpage","_voucher_step4");
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		$smarty->display('site_pages.tpl');	
		
		session_destroy();	

		break;	

/**
	VOUCHER STEP 3
*/

	case "voucher_step3":

		if (isset($_GET['voucher_id']) && is_numeric($_GET['voucher_id'])) {
			$voucher_id = $_GET['voucher_id'];
			}
		else {
			$query = "SELECT voucher_id FROM `".$db->voucher."` WHERE 1 AND voucher_del = 0";
			$voucher_ids = $db->select_field($db->voucher, "voucher_id", "", $query);
		//	$voucher_id  = $voucher_ids[0];
			$voucher_id = $voucher_ids[0];
		}

		$query = "SELECT * FROM $db->voucher WHERE 1 AND voucher_del = 0 ORDER BY voucher_id ASC";
		$vouchers = $db->select_fields ($db->voucher,$query, array("voucher_id","voucher_name"));

		$query = "SELECT * FROM $db->voucher WHERE 1 AND voucher_id = ".$voucher_id."";
		$voucher_details = $db->select_fields ($db->voucher, $query);
		if (sizeof($voucher_details)>0) {
			$voucher_details = $voucher_details[0];
		}
		else {
			header("Location: booking.php?subpage=vouchers"); 
			exit();
		}

		if(!isset($_SESSION['voucher_order_id'])){
			header("Location: booking.php?subpage=vouchers&expired=true");
			exit();
		}

		if(!$db->exist_value($db->voucher_order,'voucher_order_id', $_SESSION['voucher_order_id'])) {
			header("Location: booking.php?subpage=vouchers&expired=true");
			exit();
		}

		//extract current session
		$voucher_order = $db->select_fields($db->voucher_order, "", "", 'voucher_order_id', $_SESSION['voucher_order_id'], "", "", "", 1);

		if (empty($voucher_order["voucher_order_unique_code"])) {

			/*Validation to avoid replacement of
			 uniquecode when client press F5, bug 2012/12 */			
			$fields = array();
			$fields['voucher_order_unique_code'] = md5(uniqid(rand(), true));
			$fields["voucher_order_time"] = time()+600;
			
			$db->edit_field($db->voucher_order, $fields, 'voucher_order_id', $_SESSION['voucher_order_id']);

			$voucher_order = $db->select_fields($db->voucher_order, "", "", 'voucher_order_id', $_SESSION['voucher_order_id'], "", "", "", 1);

		}			
		
		
		write_log("Time: ".$voucher_order['voucher_order_time'].", Voucher Order ID: ".$voucher_order['voucher_order_id'].", Direction: TO PROTX, Voucher Order Code: ".$voucher_order['voucher_order_unique_code'].", Session ID: ".session_id().", voucher_order = ".serialize($voucher_order));
		
	    $URL = "http://www.londonribvoyages.com/booking.php?subpage=voucher_step4";

	    if (TESTING) {
			/*
			 * using functions from "functions_payment.php"
			 * We send what Step8 is expecting as a 'success' payment
			 */
			$crypt = base64Encode(SimpleXor("VendorTxCode=".$voucher_order['voucher_order_unique_code']."&Status=OK",$EncryptionPassword));
			header("Location: booking.php?subpage=voucher_step4&crypt=".$crypt);
			exit();
		}

		$crypt = generate_crypt($voucher_order['voucher_order_unique_code'], $voucher_order['voucher_order_discounted_total'], $voucher_details['voucher_name'], $voucher_order['voucher_order_email'], 
			$voucher_order['voucher_order_to'], COMPANY_EMAIL, 
			$voucher_order['voucher_order_address1'].", ".$voucher_order['voucher_order_address2'].", ".$voucher_order['voucher_order_city'].", ".$voucher_order['voucher_order_country'], $voucher_order['voucher_order_postcode'], $URL);
		$smarty->assign("vspsite",$vspsite);
		$smarty->assign("crypt",$crypt);
						  
		  			
		$smarty->assign("COUNTRIES",$COUNTRIES);
		$smarty->assign("subpage","_voucher_step3");

		$smarty->assign("voucher_id",$voucher_id);		
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		$smarty->display('site_pages.tpl');		
		break;	
/**
	VOUCHER STEP 2
*/
	case "voucher_step2":

		if (isset($_GET['voucher_id']) && is_numeric($_GET['voucher_id'])) {
			$voucher_id = $_GET['voucher_id'];
			}
		else {
			$query = "SELECT voucher_id FROM `".$db->voucher."` WHERE 1 AND voucher_del = 0";
			$voucher_ids = $db->select_field($db->voucher, "voucher_id", "", $query);
		//	$voucher_id  = $voucher_ids[0];
			$voucher_id = $voucher_ids[0];
		}

		$query = "SELECT * FROM $db->voucher WHERE 1 AND voucher_del = 0 ORDER BY voucher_id ASC";
		$vouchers = $db->select_fields ($db->voucher,$query, array("voucher_id","voucher_name"));

		$query = "SELECT * FROM $db->voucher WHERE 1 AND voucher_id = ".$voucher_id."";
		$voucher_details = $db->select_fields ($db->voucher, $query);
		if (sizeof($voucher_details)>0) {
			$voucher_details = $voucher_details[0];
		}
		else {
			header("Location: booking.php?subpage=vouchers"); 
			exit();
		}

		if(!isset($_SESSION['voucher_order_id'])){
			header("Location: booking.php?subpage=vouchers&expired=true");
			exit();			
		}		


		if(isset($_POST['confirm'])){
			if( $db->exist_value($db->voucher_order,'voucher_order_id', $_SESSION['voucher_order_id'])){
				header("Location: booking.php?voucher_id=".$voucher_id."&subpage=voucher_step3");
				exit();
			}
		}	

		$voucher_order = $db->select_fields($db->voucher_order, "", "", 'voucher_order_id', $_SESSION['voucher_order_id'], "", "", "", 1);

		$smarty->assign("voucher",$voucher_details);
		$smarty->assign("voucher_order",$voucher_order);
		$smarty->assign("voucher_id",$voucher_id);

		//extract tickets 
		$all_tickets = $db->select_fields($db->ticket, "", "", "ticket_del", "0");
		
		$selected_tickets = explode("|",$voucher_order["voucher_order_tickets"]);
		$selected_quantities = explode("|",$voucher_order["voucher_order_quantities"]);

		$tickets = array();
		
		//only selected tickets
		foreach($all_tickets as $ticket){
			$k = array_search($ticket['ticket_id'],$selected_tickets);
			if ($k!==false) {
				$tmp = array();
				$tmp['type'] = $ticket['ticket_type'];
				$tmp['price'] = $ticket['ticket_price'];
				$tmp['quantity'] = $selected_quantities[$k];
				$tmp['total'] = sprintf("%0.2f", $tmp['quantity'] * $tmp['price']);
				$tickets[] = $tmp;
			}
		}
		$smarty->assign("tickets",$tickets);
		$smarty->assign("subpage","_voucher_step2");
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		$smarty->display('site_pages.tpl');		

	break;

/**
	VOUCHER STEP 1
*/

	case "voucher_step1":

		if (isset($_GET['voucher_id']) && is_numeric($_GET['voucher_id'])) {
			$voucher_id = $_GET['voucher_id'];
		}
		else {
			$query = "SELECT voucher_id FROM `".$db->voucher."` WHERE 1 AND voucher_del = 0";
			$voucher_ids = $db->select_field($db->voucher, "voucher_id", "", $query);
			$voucher_id = $voucher_ids[0];
		}

		$query = "SELECT * FROM $db->voucher WHERE 1 AND voucher_del = 0 ORDER BY voucher_id ASC";
		$vouchers = $db->select_fields ($db->voucher,$query, array("voucher_id","voucher_name"));

		$query = "SELECT * FROM $db->voucher WHERE 1 AND voucher_id = ".$voucher_id."";
		$voucher_details = $db->select_fields ($db->voucher, $query);
		if (sizeof($voucher_details)>0) {
			$voucher_details = $voucher_details[0];
		}
		else {
			header("Location: booking.php?subpage=vouchers"); 
			exit();
		}


		if (!empty($_POST)){

				foreach($_POST['quantity'] as $key => $value){
					if (empty($value))  {
						unset($_POST['quantity'][$key]);
						unset($_POST['ticket'][$key]);
					}
				}
				
				//extract tickets seats
				$query = "SELECT * FROM $db->ticket
						  WHERE 1 
						  AND ticket_tour_id = ".$voucher_details['voucher_tour_id']."
						  AND ticket_del ='0'";				
				$_ticket = $db->select_field_keyval($db->ticket, $query, "ticket_id", "ticket_seats");
				$_total_seats = 0;
				foreach($_POST['ticket'] as $key => $value){
					$_total_seats += $_POST['quantity'][$key] * $_ticket[$_POST['ticket'][$key]];
				}
				// GENII ????? ????? ????????? ????? + ????????
				$_total  = 0;
				foreach($_POST['ticket'] as $key => $value){
					$_total += $_POST['quantity'][$key] * $_POST['price'][$key];
				}

				$discounted_total = $_total * ((100 - $voucher_details['voucher_discount'])/100);				
				/*add booking fee */
				$discounted_total = $discounted_total + (float)$price_fee;	

				$fields = array(
									"voucher_order_to"=>$_POST['voucher_order_to'],
									"voucher_order_phone_to"=>$_POST['voucher_order_phone_to'],
									"voucher_order_email"=>$_POST['voucher_order_email'],
									"voucher_order_name"=>$_POST['voucher_order_name'],
									"voucher_order_phone"=>$_POST['voucher_order_phone'],
									"voucher_order_name_to"=>$_POST['voucher_order_name_to'],
									"voucher_order_address1_to"=>$_POST['voucher_order_address1_to'],
									"voucher_order_message"=>$_POST['voucher_order_message'],
									
									"voucher_order_tickets"=>implode("|",$_POST['ticket']),
									"voucher_order_quantities"=>implode("|",$_POST['quantity']),
									"voucher_order_tickets_number"=>$_total_seats,
									"voucher_order_total"=>$_total,
									"voucher_order_discounted_total"=>$discounted_total,
									"voucher_order_time"=>time(),
									"voucher_order_method"=>"protx",
									"voucher_order_voucher_id"=>$voucher_id);
			
			if(isset($_SESSION['voucher_order_id']) &&  $db->exist_value($db->voucher_order,'voucher_order_id', $_SESSION['voucher_order_id'])){
				
				$voucher_order = $db->select_fields($db->voucher_order, "", "", 'voucher_order_id', $_SESSION['voucher_order_id'], "", "", "", 1);
				
				if ($voucher_order["voucher_order_payd"]=="1")
					die("Your order has already been received.<br/>
					If you had any issues during the payment process please call us on: 0207 928 8933 or email us to bookings@londonribvoyages.com");


				$db->edit_field($db->voucher_order, $fields, 'voucher_order_id', $_SESSION['voucher_order_id']);
			} else {
				$fields['voucher_order_sid'] = session_id();
				$db->insert_field($db->voucher_order, $fields);

				$_SESSION['voucher_order_id'] = $db->mysqlinsertid();
			}
			header("Location: booking.php?voucher_id=".$voucher_id."&subpage=voucher_step2");
			exit();
		}

		//extract prices and tickets
		if (isset($_SESSION['voucher_order_id'])) {
			$voucher_order = $db->select_fields($db->voucher_order, "", "", 'voucher_order_id', $_SESSION['voucher_order_id'], "", "", "", 1);
			$smarty->assign("voucher_order",$voucher_order);

			$selected_quantities =explode("|",$voucher_order['voucher_order_quantities']);
			//print_r($selected_quantities);
			$selected_tickets = explode("|",$voucher_order['voucher_order_tickets']);
			//print_r($selected_tickets);
		}
		
		//normal tickets
		$query = "SELECT * FROM $db->ticket
				  WHERE ticket_del ='0' 
				  AND ticket_tour_id = ".$voucher_details['voucher_tour_id']."
				  AND ticket_special = '0'";
		$tickets = $db->select_fields($db->ticket, $query, "");
		//print_r($tickets);
		foreach($tickets as $key => $ticket){
			$k = array_search($ticket['ticket_id'],$selected_tickets);
			if ($k!==false) $tickets[$key]['quantity'] = $selected_quantities[$k];
		}
		//print_r($tickets);

		//special tickets
		$query = "SELECT * FROM $db->ticket
				  WHERE ticket_del ='0' 
				  AND ticket_tour_id = ".$voucher_details['voucher_tour_id']."
				  AND ticket_special = '1'";
		$special_tickets = $db->select_fields($db->ticket, $query, "");
		foreach($special_tickets as $key => $ticket){
			$k = array_search($ticket['ticket_id'],$selected_tickets);
			if ($k!==false) $special_tickets[$key]['quantity'] = $selected_quantities[$k];
		}
		//print_r($special_tickets);		

//		echo ("test");
		$smarty->assign("tickets",$tickets);
		$smarty->assign("special_tickets",$special_tickets);
		$smarty->assign("voucher",$voucher_details);
		$smarty->assign("voucher_id",$voucher_id);
		$smarty->assign("vouchers",$vouchers);
		

		$smarty->assign("subpage","_voucher_step1");
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		$smarty->display('site_pages.tpl');		
		
	break;
/**
	VOUCHERS
*/	
	case "vouchers":
		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_id ASC";
		$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_name", "tour_short_description", "tour_big_image"));
	
		$query = "SELECT * FROM $db->voucher WHERE 1 AND voucher_del = 0 ORDER BY voucher_id ASC";
		$vouchers = $db->select_fields ($db->voucher,$query, array("voucher_id","voucher_tour_id"));
		
		$smarty->assign("vouchers",$vouchers);
		$smarty->assign("tours",$tours);
		$smarty->assign("subpage","_vouchers");
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		$smarty->display('site_pages.tpl');		
		
	break;
/**
	VOUCHER DETAILS
*/	
	case "voucher_details":

	if (isset($_GET['voucher_id']) && is_numeric($_GET['voucher_id'])) {
		$voucher_id = $_GET['voucher_id'];
		
		$query = "SELECT * FROM `".$db->voucher."` WHERE voucher_id=".$_GET['voucher_id'] ." AND voucher_del = 0";
		$voucher = $db->select_fields ($db->voucher ,$query, "" , "", "", "", "1", "", 1);
		if (empty($voucher[voucher_tour_id])) {header("Location: booking.php?subpage=vouchers"); };
		}
		else {header("Location: booking.php?subpage=vouchers");}
		
		$smarty->assign("voucher",$voucher);

		$query = "SELECT tour_id FROM `".$db->tour."` WHERE tour_id=".$voucher[voucher_tour_id]." AND tour_del = 0";
		$tour_ids = $db->select_field($db->tour, "tour_id", "", $query);
		$tour_id = $tour_ids[0];
		
		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_id ASC";
		$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_home_name1","tour_name","order_by"));
		
		$Tour_Tripe = array();
		  foreach($tours as $Tvaluearr)	
		  {
			 $Tour_Trip[$Tvaluearr['order_by']] =  $Tvaluearr;	
		  }
		 $smarty->assign("Tour_Trip",$Tour_Trip);

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_id = ".$tour_id."";
		$tour_details = $db->select_fields ($db->tour, $query);
		if (sizeof($tour_details)>0) {
			$tour_details = $tour_details[0];
		}
		else {
			header("Location: booking.php?subpage=tours"); 
			exit();
		}

		//normal tickets
		$query = "SELECT * FROM $db->ticket
				  WHERE ticket_del ='0' 
				  AND ticket_tour_id = ".$tour_id."
				  AND ticket_special = '0'";
		$tickets = $db->select_fields($db->ticket, $query, "");
		//print_r($tickets);

		//special tickets
		$query = "SELECT * FROM $db->ticket
				  WHERE ticket_del ='0' 
				  AND ticket_tour_id = ".$tour_id."
				  AND ticket_special = '1'";
		$special_tickets = $db->select_fields($db->ticket, $query, "");
		//print_r($special_tickets);
		
		$smarty->assign("tickets",$tickets);
		$smarty->assign("special_tickets",$special_tickets);

		$smarty->assign("tour",$tour_details);
		$smarty->assign("tour_id",$tour_id);
		$smarty->assign("tours",$tours);

		if (!empty($tour_details['tour_image1'])) {
			$image1 = explode (".", $tour_details['tour_image1']); unset ($image1[sizeof($image1) -1]);
			$smarty->assign("image1", implode (".", $image1));
		}
		if (!empty($tour_details['tour_image2'])) {
			$image2 = explode (".", $tour_details['tour_image2']); unset ($image2[sizeof($image2) -1]);
			$smarty->assign("image2", implode (".", $image2));
		}
		if (!empty($tour_details['tour_image3'])) {
			$image3 = explode (".", $tour_details['tour_image3']); unset ($image3[sizeof($image3) -1]);
			$smarty->assign("image3", implode (".", $image3));
		}
		if (!empty($tour_details['tour_image4'])) {
			$image4 = explode (".", $tour_details['tour_image4']); unset ($image4[sizeof($image4) -1]);
			$smarty->assign("image4", implode (".", $image4));
		}
		$smarty->assign("_tours",$tours);
		$smarty->assign("subpage","_voucher_details");
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		$smarty->display('site_pages.tpl');		
		
	break;
	case "select":

		$smarty->assign("subpage","_select");
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		$smarty->display('site_pages.tpl');		
		
	break;
/**
	PACKAGE DETAILS
*/
	case "package_details":

	if (isset($_GET['package_id']) && is_numeric($_GET['package_id'])) {
		$package_id = $_GET['package_id'];
		}
	else {
		$query = "SELECT package_id FROM `".$db->package."` WHERE 1 AND package_del = 0";
		$package_ids = $db->select_field($db->package, "package_id", "", $query);
	//	$package_id  = $package_ids[0];
		$package_id = $package_ids[0];
		}

		$query = "SELECT * FROM $db->package WHERE 1 AND package_id = ".$package_id."";
		$package_details = $db->select_fields ($db->package, $query);
		if (sizeof($package_details)>0) {
			$package_details = $package_details[0];
		}
		else {
			header("Location: booking.php?subpage=select"); 
			exit();
		}
		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_id ASC";
		$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_home_name1","tour_name","order_by"));
		
		$Tour_Tripe = array();
		  foreach($tours as $Tvaluearr)	
		  {
			 $Tour_Trip[$Tvaluearr['order_by']] =  $Tvaluearr;	
		  }
		 $smarty->assign("Tour_Trip",$Tour_Trip);
		
		$smarty->assign("package",$package_details);
		$smarty->assign("package_id",$package_id);

		if (!empty($package_details['package_image1'])) {
			$image1 = explode (".", $package_details['package_image1']); unset ($image1[sizeof($image1) -1]);
			$smarty->assign("image1", implode (".", $image1));
		}
		if (!empty($package_details['package_image2'])) {
			$image2 = explode (".", $package_details['package_image2']); unset ($image2[sizeof($image2) -1]);
			$smarty->assign("image2", implode (".", $image2));
		}
		if (!empty($package_details['package_image3'])) {
			$image3 = explode (".", $package_details['package_image3']); unset ($image3[sizeof($image3) -1]);
			$smarty->assign("image3", implode (".", $image3));
		}
		if (!empty($package_details['package_image4'])) {
			$image4 = explode (".", $package_details['package_image4']); unset ($image4[sizeof($image4) -1]);
			$smarty->assign("image4", implode (".", $image4));
		}
		$backgound_style = array("style_div_1","style_div_2");
		$smarty->assign("_tours",$tours);
		$smarty->assign("style_div",$backgound_style);
		$smarty->assign("subpage","_package_details");
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		$smarty->display('site_pages.tpl');		
		
	break;
/**
	TOURS
*/
	case "tours":

	$id_page = 26;
	$content = $db->select_fields($db->page, "", "", "page_id", $id_page , "", "", "",1 );
	$smarty->assign("content",$content);



$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_id ASC";
$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_home_name1", "tour_home_name2", "tour_duration", "tour_home_image","tour_big_image", "tour_charter_price","order_by"));

/*echo "<pre>";
print_r($tours);
echo "</pre>";*/

foreach ($tours as $index=>$tour) {
	$query = "SELECT ticket_type, ticket_price FROM `".$db->ticket."` WHERE 1 AND ticket_tour_id = '".$tour['tour_id']."' AND ticket_del = 0";
	$tickets = $db->select_fields($db->ticket, $query, array("ticket_type", "ticket_price"));
	if (sizeof($tickets)>0)
		$tours[$index]['tour_tickets'] = $tickets;
	else 
		$tours[$index]['tour_tickets'] = false;

	$query = "SELECT * FROM $db->voucher WHERE 1 AND voucher_del = 0 AND voucher_tour_id = ".$tour['tour_id']." ORDER BY voucher_id ASC";
	$vouchers = $db->select_fields ($db->voucher,$query, array("voucher_id","voucher_tour_id"));
	
	if (sizeof($vouchers) > 0) {
		$tours[$index]['have_voucher'] = true;
		$tours[$index]['voucher_id'] = $vouchers[0]['voucher_id'];
	}
	$query = "SELECT * FROM $db->package WHERE 1 AND package_del = 0 ORDER BY package_id ASC LIMIT 0,2";
	$packages = $db->select_fields ($db->package,$query, array("package_id","package_name", "package_short_description", "package_big_image"));

}

	/*-Tours Array-*/
	$tours_indexed = array();
	foreach ($tours as $tour) {
	$tours_indexed[$tour['tour_id']."_Heading_Text"] = $tour['tour_home_name1'];
		foreach($tour as $k=>$v)
		{
			if($k == 'tour_home_name1')
			{
				$strn_val = $smarty->smarty_modifier_truncate($tour['tour_home_name1'],25);
				$tour['tour_home_name1'] = $strn_val;
			}
		}
		//echo $tour['tour_id'].'----Test';
		
		$tours_indexed[$tour['tour_id']] = $tour;
		
	}
	/*-Packages Array-*/
		$packageIndex = array();
		$style_array  = array("imagerow_image_4","imagerow_image_5");
		foreach($packages as $tourPackage)
		{
			foreach($tourPackage as $Pindex=>$Pvalue)
			{
				if($Pindex == 'package_name')
				{
					$packag_val = $smarty->smarty_modifier_truncate($tourPackage['package_name'],20);
					$tourPackage['package_name'] = $packag_val;
				}
			}
			$packageIndex[] = $tourPackage;
		}
		
		/*-Random Tour Id-*/
		$tour_id_arr = "";
		$tour_id_arr = array();
		foreach($tours as $tindex=>$tvalue)
		{
			if($tvalue['tour_id'] != '8')
			{
				$tour_id_arr[] = $tvalue['tour_id'];
			}	
		}
		
		$count_tours 	= count($tour_id_arr).'countr';
		$first 	= $second = '';
		$first 	= rand(0,($count_tours-1));
		$second = rand(0,($count_tours-1));
		
		for($i = 0;$i<$count_tours;$i++)
		{
			if($first == $second)
			{
				$second = rand(0,($count_tours-1));
			}
		}
	
	  $Tour_Trip = array();
	  foreach($tours as $Tvaluearr)	
	  {
	  	if($Tvaluearr['tour_id'] != '8') {
	  	 $Tour_Trip[$Tvaluearr['order_by']] =  $Tvaluearr;	
	  	}	  	 
	  }
	  
	  //echo $trip_counts; exit();

	  //unset($Tour_Trip[count($Tour_Trip)-1]);
	  
		/*echo "<pre>";
		print_r($Tour_Trip);
		echo "</pre>";*/

	  $trip_count  = ""; 
	  $trip_counts  = count($Tour_Trip);	

	  
	  

	  $smarty->assign("Tour_Trip",$Tour_Trip);
	  $smarty->assign("trip_counts",$trip_counts);
	  
	  /*$imgind = 0;	
	  $Image_size_array = array(); 
	  foreach($tours as $Tindex=>$Tvalue)
	  {
		   $image_name   	 =  $Tvalue['tour_big_image'];
		   $imgwidth		 = 197;
		   $imgheight 		 = 118;
		   $ppath_image 	 = $WS_PATH.'img/tours/thumb/'; 
		   $spath_image		 = $FS_PATH.'img/tours/thumb/'; 
		   $Image_size_array[$imgind] = $smarty->ImageResize($ppath_image,$spath_image,$imgwidth,$imgheight,$image_name);	
		   //$Image_size_array = $smarty->ImageResize($ppath_image,$spath_image,$imgwidth,$imgheight,$image_name);	
		   $imgind++;
	  }*/
	  
		$myArray[]	= $tour_id_arr[$first];
		$myArray[] 	= $tour_id_arr[$second];
		/*echo "<pre>";
		print_r($Tour_Trip);
		exit();*/
		
		//$smarty->assign("Imagesize",$Image_size_array);
		$smarty->assign("tours",$tours_indexed);
		$smarty->assign("_tours",$tours);
		$smarty->assign("TourId_0",$myArray[0]);
		$smarty->assign("TourId_1",$myArray[1]);
		
		$smarty->assign("styleSheet",$style_array);
		$smarty->assign("packages",$packageIndex);
		//$smarty->assign("content",$content);		
		
		$smarty->assign("subpage","_tours");
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		$smarty->display('site_pages.tpl');		
		
	break;
/**
	CHARTER
*/
	case "charter":
		
		$id_page = 1;
		$content = $db->select_fields($db->page, "", "", "page_id", $id_page , "", "", "",1 );

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_id ASC";
		$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_home_name1", "tour_home_name2", "tour_duration", "tour_home_image", "tour_charter_price","order_by"));

		foreach ($tours as $index=>$tour) {
			$query = "SELECT ticket_type, ticket_price FROM `".$db->ticket."` WHERE 1 AND ticket_tour_id = '".$tour['tour_id']."' AND ticket_del = 0";
			$tickets = $db->select_fields($db->ticket, $query, array("ticket_type", "ticket_price"));
			if (sizeof($tickets)>0)
				$tours[$index]['tour_tickets'] = $tickets;
			else 
				$tours[$index]['tour_tickets'] = false;

			$query = "SELECT * FROM $db->voucher WHERE 1 AND voucher_del = 0 AND voucher_tour_id = ".$tour['tour_id']." ORDER BY voucher_id ASC";
			$vouchers = $db->select_fields ($db->voucher,$query, array("voucher_id","voucher_tour_id"));
			
			if (sizeof($vouchers) > 0) {
				$tours[$index]['have_voucher'] = true;
				$tours[$index]['voucher_id'] = $vouchers[0]['voucher_id'];
			}
			$query 		= "SELECT * FROM $db->package WHERE 1 AND package_del = 0 ORDER BY package_id ASC";
			$packages 	= $db->select_fields ($db->package,$query, array("package_id","package_name", "package_short_description", "package_home_image"));
		}
	
		//echo "<pre>"; print_r($packages);
		foreach( $packages as $key=>$val )
		{
			$package_nameTmp = $packages[$key]['package_name'];
			if( strlen($package_nameTmp)>23 )
			{
				$package_nameTmp = $package_nameTmp;
			}		
			$packagesTmp[$key]['package_name'] = $package_nameTmp;
		}	
		//echo "<pre>"; print_r($packagesTmp);
	
		$Tour_Tripe = array();
		foreach($tours as $Tvaluearr)	
		{
			$Tour_Trip[$Tvaluearr['order_by']] =  $Tvaluearr;	
		}
		$smarty->assign("Tour_Trip",$Tour_Trip);
	
		/*-Tours Array-*/
		$tours_indexed = array();
		foreach ($tours as $tour) {
			foreach($tour as $k=>$v)
			{
				if($k == 'tour_home_name1')
				{
					$strn_val = $smarty->smarty_modifier_truncate($tour['tour_home_name1'],25);
					$tour['tour_home_name1'] = $strn_val;
				}
			}
			$tours_indexed[$tour['tour_id']] = $tour;
		}
		/*-Packages Array-*/
		$packageIndex = array();
		$style_array  = array("imagerow_image_4","imagerow_image_5");
		foreach($packages as $tourPackage)
		{
			$packageIndex[] = $tourPackage;
		}

		/*-Random Tour Id-*/
		$tour_id_arr = "";
		$tour_id_arr = array();
		foreach($tours as $tindex=>$tvalue)
		{
			if($tvalue['tour_id'] != '8')
			{
				$tour_id_arr[] = $tvalue['tour_id'];
			}
		}
		
		$count_tours 	= count($tour_id_arr).'countr';
		$first 	= $second = '';
		$first 	= rand(0,($count_tours-1));
		$second = rand(0,($count_tours-1));
		
		for($i = 0;$i<$count_tours;$i++)
		{
			if($first == $second)
			{
				$second = rand(0,($count_tours-1));
			}
		}
		
		$myArray[]	= $tour_id_arr[$first];
		$myArray[] 	= $tour_id_arr[$second];
		/*-END HERE-*/	
		$smarty->assign("packagesTmp",$packagesTmp);
		
		$smarty->assign("tours",$tours_indexed);
		$smarty->assign("_tours",$tours);
		$smarty->assign("TourId_0",$myArray[0]);
		$smarty->assign("TourId_1",$myArray[1]);

		
		$smarty->assign("styleSheet",$style_array);
		$smarty->assign("packages",$packageIndex);
		$smarty->assign("content",$content);		
		
		$smarty->assign("subpage","_charter");
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		$smarty->display('site_pages.tpl');		
		break;
/**
	TOUR DETAILS
*/
	case "tour_details":	
	
		if (isset($_GET['tour_id']) && is_numeric($_GET['tour_id'])) {
			$tour_id = $_GET['tour_id'];
			}
		else {
			$query = "SELECT tour_id FROM `".$db->tour."` WHERE 1 AND tour_del = 0";
			$tour_ids = $db->select_field($db->tour, "tour_id", "", $query);
		//	$tour_id  = $tour_ids[0];
			$tour_id = $tour_ids[0];
		}

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_id ASC";
		$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_name","tour_home_name1","order_by"));
		
		
		$query = "SELECT * FROM $db->voucher WHERE 1 AND voucher_del = 0 AND voucher_tour_id = ".$tour_id." ORDER BY voucher_id ASC";
		$vouchers = $db->select_fields ($db->voucher,$query, array("voucher_id","voucher_tour_id"));

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 AND tour_id = ".$tour_id."";
		$tour_details = $db->select_fields ($db->tour, $query);
		/*echo "<pre>";
		print_r($tour_details);
		exit();*/
		
						
		if (sizeof($tour_details)>0) {
			$tour_details = $tour_details[0];
		}
		else {
			header("Location: booking.php?subpage=tours"); 
			exit();
		}


		//normal tickets
		$query = "SELECT * FROM $db->ticket
				  WHERE ticket_del ='0' 
				  AND ticket_tour_id = ".$tour_id."
				  AND ticket_special = '0'";
		$tickets = $db->select_fields($db->ticket, $query, "");
		//print_r($tickets);

		//special tickets
		$query = "SELECT * FROM $db->ticket
				  WHERE ticket_del ='0' 
				  AND ticket_tour_id = ".$tour_id."
				  AND ticket_special = '1'";
		$special_tickets = $db->select_fields($db->ticket, $query, "");
/*		echo "<pre>";
		print_r($tours);
		exit();
*/		
		//print_r($special_tickets);
		  $Tour_Tripe = array();
		  foreach($tours as $Tvaluearr)	
		  {
			 $Tour_Trip[$Tvaluearr['order_by']] =  $Tvaluearr;	
		  }
		 
		$smarty->assign("Tour_Trip",$Tour_Trip);
		$backgound_style = array("style_div_1","style_div_2");
		$smarty->assign("vouchers",$vouchers);
		$smarty->assign("tickets",$tickets);
		$smarty->assign("style_div",$backgound_style);
		$smarty->assign("special_tickets",$special_tickets);
		$smarty->assign("tour",$tour_details);
		$smarty->assign("tour_id",$tour_id);
		$smarty->assign("tours",$tours);
						

		if (!empty($tour_details['tour_image1'])) {
			$image1 = explode (".", $tour_details['tour_image1']); unset ($image1[sizeof($image1) -1]);
			$smarty->assign("image1", implode (".", $image1));
		}
		if (!empty($tour_details['tour_image2'])) {
			$image2 = explode (".", $tour_details['tour_image2']); unset ($image2[sizeof($image2) -1]);
			$smarty->assign("image2", implode (".", $image2));
		}
		if (!empty($tour_details['tour_image3'])) {
			$image3 = explode (".", $tour_details['tour_image3']); unset ($image3[sizeof($image3) -1]);
			$smarty->assign("image3", implode (".", $image3));
		}
		if (!empty($tour_details['tour_image4'])) {
			$image4 = explode (".", $tour_details['tour_image4']); unset ($image4[sizeof($image4) -1]);
			$smarty->assign("image4", implode (".", $image4));
		}
		
		$smarty->assign("subpage","_tour_details");
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		$smarty->display('site_pages.tpl');		
		
		break;

/**
	
	


	STEP 8
*/

	case "step8":

		if (empty($_GET['crypt'])) {
			write_error_log("Access to step 8 without crypt variable.\nIP:".$_SERVER['REMOTE_ADDR']."\nGET: ".implode_array($_GET)."\nPOST: ".implode_array($_POST));
			header("Location: booking.php?subpage=step1&expired=true");
			exit();			
		}
		
		write_log("Valid confirmation entry, checking result code and status...");
		
		$results = decode_crypt($_REQUEST['crypt']);
		
		write_log("Code: ".$results['code'].", Status: ".$results['status']);

		$order = $db->select_fields($db->order, "", "", 'order_unique_code', $results['code'], "", "", "", 1);

		if ($order["order_payd"] != 1){

			if ($results['status'] == 'OK'){

				write_log("Time: ".$order['order_time'].", Order ID: ".$order['order_id'].", Direction: FROM PROTX, Order Code: ".$order['order_unique_code'].", Total: ". $order['order_total'].
					", Email: ".$order['order_email'].", Name: ".$order['order_title']." ".$order['order_first_name']." ".$order['order_last_name'].", Address: ".
					$order['order_street_address1']." ".$order['order_street_address2'].", City: ".$order['order_city'].", Country: ".$order['order_country'].
					", Zip:".$order['order_zip'].", Shared tour ID:".$order['order_tour_shared_id'].", Session ID: ".session_id());

				
				include "WEB-INF/includes/functions/functions_email.php";
		
				if (empty($order['order_date'])) {
					mail ("fcisco@gmail.com", "LRV booking issue #".$order['order_id'], "(Status ok but no order date)");
				}

				$fields = array("order_date"=>date("Y-m-d"), 
								"order_payd" => 1);
				
				//$db->edit_field($db->order, $fields, "order_unique_code", $results['code']);
				edit_order($fields, "order_unique_code", $results['code'], "frontend booking step8");

				send_email_confirmation_front($order);
				send_feedback_mail($order['order_email'], $order['order_id']);

				//Google Analytics Ecommerce tracking
				$order_tickets_id = explode("|", $order['order_tickets']);
			    $order_tickets_qty = explode("|", $order['order_quantities']);
			    $query = "SELECT t.tour_name FROM 
			    			(tours as t
			    			INNER JOIN departure as d ON (d.departure_tour_id = t.tour_id))
			    			INNER JOIN orders as o ON (o.order_departure_id = d.departure_id) 
			    			WHERE o.order_id=".$order['order_id'];
			    $tour = $db->select_fields($db->tour, $query);
			    $tickets = $db->select_fields($db->ticket);
			    $tickets[] = array ('ticket_id' => 0,  'ticket_type' => 'Charter',  'ticket_price' => $order['order_total'],  'ticket_del' => 0 );
			    
			    $ga_trans = array('order_id'=>$order['order_id'],
			    				'store_name'=>'LondonRibVoyages',
			    				'total'=>$order['order_total'],
			    				'tax'=>'0',
			    				'shipping'=>'',
			    				'city'=>'London',
			    				'state'=>'London',
			    				'country'=>'United Kingdom');
			    $ga_items = array();
			    $index = 0;
	        	foreach($order_tickets_id as $id) {
			    	foreach($tickets as $ticket) {	
			        	if ($ticket['ticket_id'] == $id) {
			        		$ga_items [] = array('order_id'=>$order['order_id'],
			        							'code'=>'ticket_'.$ticket['ticket_id'],
			        							'product'=>$tour[0]['tour_name'],
			        							'variation'=>$ticket['ticket_type'],
			        							'unit_price'=>$ticket['ticket_price'],
			        							'quantity'=>$order_tickets_qty[$index]);
			        		$index++;
			        	}
			        }
	            }
	            $smarty->assign("ga_trans",$ga_trans);
	            $smarty->assign("ga_items",$ga_items);

			}	
			/*elseif ($results['status'] == 'OK' && empty($order['order_date'])){

				mail ("fcisco@gmail.com", "LRV booking error #".$order['order_id'], "(ERROR status ok but no order date)");
				write_log("Time: ".$order['order_time'].", Order ID: ".$order['order_id'].", Direction: FROM PROTX (ERROR status ok but no order date), Order Code: ".$order['order_unique_code'].", Total: ". $order['order_total'].
					", Email: ".$order['order_email'].", Name: ".$order['order_title']." ".$order['order_first_name']." ".$order['order_last_name'].", Address: ".
					$order['order_street_address1']." ".$order['order_street_address2'].", City: ".$order['order_city'].", Country: ".$order['order_country'].
					", Zip:".$order['order_zip'].", Shared tour ID:".$order['order_tour_shared_id'].", Session ID: ".session_id().", results = ".serialize($results).", order = ".serialize($order));
			}*/
		
			else {
				mail ("fcisco@gmail.com", "LRV booking error #".$order['order_id'], "(ERROR status not ok)");
				write_log("Time: ".$order['order_time'].", Order ID: ".$order['order_id'].", Direction: FROM PROTX (ERROR status not ok), Order Code: ".$order['order_unique_code'].", Total: ". $order['order_total'].
					", Email: ".$order['order_email'].", Name: ".$order['order_title']." ".$order['order_first_name']." ".$order['order_last_name'].", Address: ".
					$order['order_street_address1']." ".$order['order_street_address2'].", City: ".$order['order_city'].", Country: ".$order['order_country'].
					", Zip:".$order['order_zip'].", Shared tour ID:".$order['order_tour_shared_id'].", Session ID: ".session_id().", results = ".serialize($results).", order = ".serialize($order));

			}
		}

		$smarty->assign("results",$results);
		$smarty->assign("subpage","_step8");
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		$smarty->display('site_pages.tpl');	
		session_destroy();	
		break;	
		
	case "step7":
//		if(!empty($_POST)){
//			header("Location: booking.php?subpage=step8");
//			exit();			
//		}

	/*if (isset($_GET['tour_id']) && is_numeric($_GET['tour_id'])) {
		$tour_id = $_GET['tour_id'];
		}
	else {
		$query = "SELECT tour_id FROM `".$db->tour."` WHERE 1 AND tour_del = 0";
		$tour_ids = $db->select_field($db->tour, "tour_id", "", $query);
	//	$tour_id  = $tour_ids[0];
		$tour_id = $tour_ids[0];
		}

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_id ASC";
		$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_name"));

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_id = ".$tour_id."";
		$tour_details = $db->select_fields ($db->tour, $query);
		if (sizeof($tour_details)>0) {
			$tour_details = $tour_details[0];
		}
		else {
			header("Location: booking.php?subpage=tours"); 
			exit();
		}

		if(empty($my_session)){
			header("Location: booking.php?tour_id=".$tour_id."&subpage=step1&expired=true");
			exit();			
		}	
			

		$fields = array();
		$fields['order_unique_code'] = md5(uniqid(rand(), true));
		$fields["order_time"] = time()+600;
		if( $db->exist_value($db->order,'order_sid', session_id())){
			//$db->edit_field($db->order, $fields, 'order_sid', session_id());
			edit_order($fields, 'order_sid', session_id(), "frontend booking step7");
		} 
				
		//extract current session
		$order = $db->select_fields($db->order, "", "", 'order_sid', session_id(), "", "", "", 1);
		$departure = $db->select_fields($db->departure, "", "", 'departure_id', @$order['order_departure_id'], "", "", "", 1);
		if(empty($departure['departure_id']) || empty($order['order_first_name']) || empty($order['order_tickets_number'])){
			header("Location: booking.php?tour_id=".$tour_id."&subpage=step1&expired=true");
			exit();			
		}			
		
		//CALIN - 03 August 2006 - START
		write_log("Time: ".$order['order_time'].", Order ID: ".$order['order_id'].", Direction: TO PROTX, Order Code: ".$order['order_unique_code'].", Total: ". $order['order_total'].
		 	", Email: ".$order['order_email'].", Name: ".$order['order_title']." ".$order['order_first_name']." ".$order['order_last_name'].", Address: ".
			$order['order_street_address1']." ".$order['order_street_address2'].", City: ".$order['order_city'].", Country: ".$order['order_country'].
			", Zip:".$order['order_zip'].", Session ID: ".session_id().", order = ".serialize($order));

		//CALIN - 03 August 2006 - START

		$crypt = generate_crypt($order['order_unique_code'], $order['order_total'], $tour_details['tour_name'], $order['order_email'], 
			$order['order_title']." ". $order['order_first_name']." ". $order['order_last_name'], COMPANY_EMAIL, 
			$order['order_street_address1'].", ".$order['order_street_address2'].", ".$order['order_city'].", ".$order['order_country'], $order['order_zip']);
		$smarty->assign("vspsite",$vspsite);
		$smarty->assign("crypt",$crypt);
		
		$wipe=base64_encode($order['order_sid']);
		$smarty->assign("wipe",$wipe);
		//verify if is free
		//print_r($departure);
				  
				  			
		$smarty->assign("COUNTRIES",$COUNTRIES);
		$smarty->assign("subpage","_step6");
		
		$smarty->assign("tour_id",$tour_id);
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		$smarty->display('site_pages.tpl');		
		break;	*/
/**
	STEP 6
*/
	case "step6":
		
		if (isset($_GET['tour_id']) && is_numeric($_GET['tour_id'])) {
			$tour_id = $_GET['tour_id'];
		} else {	
			$query = "SELECT tour_id FROM `".$db->tour."` WHERE 1 AND tour_del = 0";
			$tour_ids = $db->select_field($db->tour, "tour_id", "", $query);
			$tour_id = $tour_ids[0];
		}

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_id ASC";
		$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_name"));

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_id = ".$tour_id."";
		$tour_details = $db->select_fields ($db->tour, $query);
		if (sizeof($tour_details)>0) {
			$tour_details = $tour_details[0];
		}
		else {
			write_error_log("Step6: no tour_details.\nIP:".$_SERVER['REMOTE_ADDR']."\nGET: ".implode_array($_GET)."\nPOST: ".implode_array($_POST));
			header("Location: booking.php?subpage=tours"); 
			exit();
		}

		if(!isset($_SESSION['order_id'])) {
			write_error_log("Step6: no session.\nIP:".$_SERVER['REMOTE_ADDR']."\nGET: ".implode_array($_GET)."\nPOST: ".implode_array($_POST));
			header("Location: booking.php?tour_id=".$tour_id."&subpage=step1&expired=true");
			exit();
		}	
			
		//extract current session
		$order = $db->select_fields($db->order, "", "", 'order_id', $_SESSION['order_id'], "", "", "", 1);
		$departure = $db->select_fields($db->departure, "", "", 'departure_id', @$order['order_departure_id'], "", "", "", 1);
		if(empty($departure['departure_id']) || empty($order['order_first_name']) || empty($order['order_tickets_number'])){
			header("Location: booking.php?tour_id=".$tour_id."&subpage=step1&expired=true");
			exit();
		}
		
		if (empty($order["order_unique_code"])) {
			
			//Ask if its set to avoid replacement.
			$fields = array();
			$order["order_unique_code"] = $fields['order_unique_code'] = md5(uniqid(rand(), true));
			$order["order_time"] = $fields["order_time"] = time()+600;

			if( $db->exist_value($db->order,'order_id', $_SESSION['order_id'])){
				edit_order($fields, 'order_id', $_SESSION['order_id'], 'frontend booking step6');			
			} 
		}
		

		write_log("Time: ".$order['order_time'].", Order ID: ".$order['order_id'].", Direction: TO PROTX, Order Code: ".$order['order_unique_code'].", Total: ".$order['order_total'].
		 	", Email: ".$order['order_email'].", Name: ".$order['order_title']." ".$order['order_first_name']." ".$order['order_last_name'].", Address: ".
			$order['order_street_address1']." ".$order['order_street_address2'].", City: ".$order['order_city'].", Country: ".$order['order_country'].
			", Zip:".$order['order_zip'].", Session ID: ".session_id().", IP: ".$_SERVER['REMOTE_ADDR'].", order = ".serialize($order));

		if (TESTING) {
			/*
			 * using functions from "functions_payment.php"
			 * We send what Step8 is expecting as a 'success' payment
			 */
			$crypt = base64Encode(SimpleXor("VendorTxCode=".$order['order_unique_code']."&Status=OK",$EncryptionPassword));
			header("Location: booking.php?subpage=step8&crypt=".$crypt);
			exit();
		}

		$crypt = generate_crypt($order['order_unique_code'], $order['order_total'], $tour_details['tour_name'], $order['order_email'], 
			$order['order_title']." ". $order['order_first_name']." ". $order['order_last_name'], COMPANY_EMAIL, 
			$order['order_street_address1'].", ".$order['order_street_address2'].", ".$order['order_city'].", ".$order['order_country'], $order['order_zip']);
			
		/*
		 * ONLY FOR TESTING (look config.php)
		 */ 	
					
		$smarty->assign("vspsite",$vspsite);
		$smarty->assign("crypt",$crypt);
		
		$wipe=base64_encode($order['order_id']);
		$smarty->assign("wipe",$wipe);
		

		$smarty->assign("COUNTRIES",$COUNTRIES);
		$smarty->assign("subpage","_step6");
		
		$smarty->assign("tour_id",$tour_id);
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		$smarty->display('site_pages.tpl');		
		break;	
/**
	STEP 5
*/
	case "step5":
		if (isset($_GET['tour_id']) && is_numeric($_GET['tour_id'])) {
			$tour_id = $_GET['tour_id'];
		}
		else {
			$query = "SELECT tour_id FROM `".$db->tour."` WHERE 1 AND tour_del = 0";
			$tour_ids = $db->select_field($db->tour, "tour_id", "", $query);
			$tour_id = $tour_ids[0];
		}

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_id ASC";
		$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_name"));

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_id = ".$tour_id."";
		$tour_details = $db->select_fields ($db->tour, $query);

		if (sizeof($tour_details)>0) {
			$tour_details = $tour_details[0];
		}
		else {
			header("Location: booking.php?subpage=tours"); 
			exit();
		}

		if(!isset($_SESSION['order_id'])){
			header("Location: booking.php?tour_id=".$tour_id."&subpage=step1&expired=true");
			exit();			
		}		
		//extract current session
		$order = $db->select_fields($db->order, "", "", 'order_id', $_SESSION['order_id'], "", "", "", 1);
		$departure = $db->select_fields($db->departure, "", "", 'departure_id', @$order['order_departure_id'], "", "", "", 1);
		if(empty($departure['departure_id']) || empty($order['order_first_name']) || empty($order['order_tickets_number'])){
			header("Location: booking.php?tour_id=".$tour_id."&subpage=step1&expired=true");
			exit();			
		}	
		
		if(!empty($_POST)){
		
			$fields = array();
			$fields["order_time"] = time();

			if($db->exist_value($db->order,'order_id', $_SESSION['order_id'])){
				edit_order($fields, 'order_id', $_SESSION['order_id'],'frontend booking step5');
			}
					
			if(!$db->exist_value($db->order,'order_id', $_SESSION['order_id'])){

				header("Location: booking.php?tour_id=".$tour_id."&subpage=step1&expired=true");
				exit();			

			}
		
			
			//check if there is tickets Available or Sold Out
			
			if ($order['order_tour_shared_id'] !=0) {
				$_tour_id = $order['order_tour_shared_id'];
			} else {
				$_tour_id = $tour_id;
			}


			$query = "SELECT departure_id, departure_time, boat_passengers, boat_charter_price
					  FROM $db->departure,  $db->boat
					  WHERE departure_id = '".$order['order_departure_id']."'
					  AND departure_boat_id = boat_id
					  AND departure_tour_id = ".$_tour_id."
					  AND boat_del = 0";
	
			$fields = array("departure_id", "departure_time", "boat_passengers", "boat_charter_price");
	
			$departure = $db->select_fields($db->departure, $query, $fields, "", "", "", "", "", 1);
			
			if (!empty($departure['departure_id'])) {
				$query2 = "SELECT * FROM $db->order
						  WHERE order_departure_id = '".$order['order_departure_id']."'";
				$fields = array("order_tickets", "order_tickets_number");
				$orders = $db->select_fields($db->order, $query2, $fields);
				$sum = 0;
				foreach($orders as $order)
				{
					//charter
					if (($order['order_tickets']==0) && ($order['order_tickets_number']==1)) {
						$sum += $departure['boat_passengers'];
					} else {
					//normal
						$sum +=  $order['order_tickets_number'];
					}
				}
				if ($sum > $departure['boat_passengers']) {
					header("Location: booking.php?tour_id=".$tour_id."&subpage=step1&busy=true");
					exit();				
				} else {
					header("Location: booking.php?tour_id=".$tour_id."&subpage=step6");
					exit();
				}
			} else {
				header("Location: booking.php?tour_id=".$tour_id."&subpage=step1&busy=true");
				exit();				
			}
		}
		$style_array = array("style_div_detail1","style_div_detail2");
		$smarty->assign("divStyles",$style_array);
		$smarty->assign("order",$order);
		$smarty->assign("departure",$departure);

		//extract tickets 
		$all_tickets = $db->select_fields($db->ticket, "", "", "ticket_del", "0");
		
		$selected_tickets = explode("|",$order["order_tickets"]);
		$selected_quantities = explode("|",$order["order_quantities"]);

		$tickets = array();
		
		//only selected tickets
		foreach($all_tickets as $ticket){
			$k = array_search($ticket['ticket_id'],$selected_tickets);
			if ($k!==false) {
				$tmp = array();
				$tmp['type'] = $ticket['ticket_type'];
				$tmp['price'] = $ticket['ticket_price'];
				$tmp['quantity'] = $selected_quantities[$k];
				$tmp['total'] = sprintf("%0.2f", $tmp['quantity'] * $tmp['price']);
				$tickets[] = $tmp;
			}
		}

		$smarty->assign("tickets",$tickets);
		$wipe=base64_encode($order['order_id']);
		$smarty->assign("wipe",$wipe);

		$smarty->assign("tour",$tour_details);
		$smarty->assign("tour_id",$tour_id);
		$smarty->assign("tours",$tours);

		$smarty->assign("COUNTRIES",$COUNTRIES);
		$smarty->assign("subpage","_step5");
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		$smarty->display('site_pages.tpl');
		break;
/**
	STEP 4
*/
	case "step4":
	if (isset($_GET['tour_id']) && is_numeric($_GET['tour_id'])) {
		$tour_id = $_GET['tour_id'];
		}
	else {
		$query = "SELECT tour_id FROM `".$db->tour."` WHERE 1 AND tour_del = 0";
		$tour_ids = $db->select_field($db->tour, "tour_id", "", $query);
	//	$tour_id  = $tour_ids[0];
		$tour_id = $tour_ids[0];
		}

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_id ASC";
		$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_name"));

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_id = ".$tour_id."";
		$tour_details = $db->select_fields ($db->tour, $query);
		if (sizeof($tour_details)>0) {
			$tour_details = $tour_details[0];
		}
		else {
			header("Location: booking.php?subpage=tours"); 
			exit();
		}

		if(!isset($_SESSION['order_id'])){
			header("Location: booking.php?tour_id=".$tour_id."&subpage=step1&expired=true");
			exit();			
		}		

		if(!empty($_POST)){
			$fields = $_POST;
			$fields["order_time"] = time();

            //extract tickets
            $all_tickets = $db->select_fields($db->ticket, "", "", "ticket_del", "0");

            $selected_tickets = explode("|",$order["order_tickets"]);
            $selected_quantities = explode("|",$order["order_quantities"]);

            $tickets = array();

            //only selected tickets
            foreach($all_tickets as $ticket){
                $k = array_search($ticket['ticket_id'],$selected_tickets);
                if ($k!==false) {
                    $tmp = array();
                    $tmp['type'] = $ticket['ticket_type'];
                    $tmp['price'] = $ticket['ticket_price'];
                    $tmp['quantity'] = $selected_quantities[$k];
                    $tmp['total'] = sprintf("%0.2f", $tmp['quantity'] * $tmp['price']);
                    $tickets[] = $tmp;
                }
            }
            //var_dump($tickets); die();
            $smarty->assign("tickets",$tickets);

			if( $db->exist_value($db->order,'order_id', $_SESSION['order_id'])){
				edit_order($fields, 'order_id', $_SESSION['order_id'], 'frontend booking step4');
				header("Location: booking.php?tour_id=".$tour_id."&subpage=step5");
				exit();
			}
		}
        $order = $db->select_fields($db->order, "", "", 'order_id', $_SESSION['order_id'], "", "", "", 1);
        $fields = $_POST;
        $fields["order_time"] = time();

        //extract tickets
        $all_tickets = $db->select_fields($db->ticket, "", "", "ticket_del", "0");

        $selected_tickets = explode("|",$order["order_tickets"]);
        $selected_quantities = explode("|",$order["order_quantities"]);

        $tickets = array();

        //only selected tickets
        foreach($all_tickets as $ticket){
            $k = array_search($ticket['ticket_id'],$selected_tickets);
            if ($k!==false) {
                $tmp = array();
                $tmp['type'] = utf8_encode($ticket['ticket_type']);
                $tmp['price'] = $ticket['ticket_price'];
                $tmp['quantity'] = $selected_quantities[$k];
                $tmp['total'] = sprintf("%0.2f", $tmp['quantity'] * $tmp['price']);
                $tickets[] = $tmp;
            }
        }
        //var_dump($selected_tickets); die();
        $smarty->assign("tickets",$tickets);
        $tour_details = $db->select_fields ($db->tour, $query);
        $tour_name = $tour_details[0]['tour_name'];
        //var_dump($tour_details[0]['tour_name']); die();
		//extract current session
		$order = $db->select_fields($db->order, "", "", 'order_id', $_SESSION['order_id'], "", "", "", 1);
		if(empty($order['order_find'])){
			header("Location: booking.php?subpage=step1&expired=true");
			exit();			
		}
        //$departure = $db->select_fields($db->departure, $query, $fields, "", "", "", "", "", 1);
        $departure  = $db->select_fields($db->departure, "", "", 'departure_id', @$order['order_departure_id'], "", "", "", 1);
        //var_dump($departure); die();
		if(empty($order['order_country'])) $order['order_country'] = "GB";
		$smarty->assign("order",$order);
        $smarty->assign("departure",$departure);
        $smarty->assign("tour",$tour_name);
		$wipe=base64_encode($order['order_id']);
		$smarty->assign("wipe",$wipe);

		$smarty->assign("tour_id",$tour_id);
		$smarty->assign("COUNTRIES",$COUNTRIES);
		$smarty->assign("subpage","_step4");
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
        $smarty->display('site_pages.tpl');
		break;		
/**
	STEP 3
*/
	case "step3":

		if (isset($_GET['tour_id']) && is_numeric($_GET['tour_id'])) {
			$tour_id = $_GET['tour_id'];
		}
		else 
		{
			$query = "SELECT tour_id FROM `".$db->tour."` WHERE 1 AND tour_del = 0";
			$tour_ids = $db->select_field($db->tour, "tour_id", "", $query);
			$tour_id = $tour_ids[0];
		}

			
		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_id ASC";
		$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_name"));

		$about_query = "SELECT * FROM $db->tbl_hear_about_us WHERE 1 AND Status = 1 ORDER BY Hid ASC";
		$hear_about = $db->select_fields ($db->tbl_hear_about_us,$about_query, array("Hid","Title"));

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_id = ".$tour_id."";
		$tour_details = $db->select_fields ($db->tour, $query);

		if (sizeof($tour_details)>0) {
			$tour_details = $tour_details[0];
		}
		else {
			header("Location: booking.php?subpage=tours"); 
			exit();
		}

		if(!isset($_SESSION['order_id'])){
			header("Location: booking.php?tour_id=".$tour_id."&subpage=step1&expired=true");
			exit();			
		}		
		//extract current session
		$order 		= $db->select_fields($db->order, "", "", 'order_id', $_SESSION['order_id'], "", "", "", 1);

		//add to database
		if(!empty($_POST['order_find'])){
            $fields = $_POST;
            $fields["order_time"] = time();
            if($db->exist_value($db->order,'order_id', $_SESSION['order_id'])){
                edit_order($fields, 'order_id', $_SESSION['order_id'],'frontend booking step5');
            }

			//$fields = array("order_find"=>$_POST['order_find'], "order_time"=>time(), "order_total" => $order["order_total"] - $_POST['facebook_discount'], "order_facebook_discount" => $_POST['facebook_discount']);
			$fields = array("order_find"=>$_POST['order_find'], "order_time"=>time(), "order_total" => $order["order_total"]);

			if( $db->exist_value($db->order,'order_id', $_SESSION['order_id'])){
				edit_order($fields, 'order_id', $_SESSION['order_id'], 'frontend booking step3');
				header("Location: booking.php?tour_id=".$tour_id."&subpage=step4");
				exit();
			}
		}	

		$departure  = $db->select_fields($db->departure, "", "", 'departure_id', @$order['order_departure_id'], "", "", "", 1);

		if(empty($departure['departure_id'])){
			header("Location: booking.php?tour_id=".$tour_id."&subpage=step1&expired=true");
			exit();			
		}	
		
		//Check Availability
		//check if there is tickets Available or Sold Out
			
			if ($order['order_tour_shared_id'] !=0) {
				$_tour_id = $order['order_tour_shared_id'];
			} else {
				$_tour_id = $tour_id;
			}
			$query3 = "SELECT departure_id, departure_time, boat_passengers, boat_charter_price
					  FROM $db->departure,  $db->boat
					  WHERE departure_id = '".$order['order_departure_id']."'
					  AND departure_boat_id = boat_id
					  AND departure_tour_id = ".$_tour_id."
					  AND boat_del = 0";
			
			$fields3 = array("departure_id", "departure_time", "boat_passengers", "boat_charter_price");
	
			$departures = $db->select_fields($db->departure, $query3, $fields3, "", "", "", "", "", 1);
			
			if (!empty($departures['departure_id'])) {
				$query2 = "SELECT * FROM $db->order
						  WHERE order_departure_id = '".$order['order_departure_id']."'";
				//echo $query; echo "<hr>"; echo $query2; exit(); 		  
				$fields = array("order_tickets", "order_tickets_number");
				$orders = $db->select_fields($db->order, $query2, $fields);
				$sum = 0;
				foreach($orders as $ordern)
				{
					//charter
					if (($ordern['order_tickets']==0) && ($ordern['order_tickets_number']==1)) {
						$sum += $departures['boat_passengers'];
					} else {
					//normal
						$sum +=  $ordern['order_tickets_number'];
					}
				}
				if ($sum > $departures['boat_passengers']) {
					header("Location: booking.php?tour_id=".$tour_id."&subpage=step1&busy=true");
					exit();
					}				
			}
		//------Ends Here-----//

		$smarty->assign("hear_about_us",$hear_about);
		$smarty->assign("order",$order);
		$smarty->assign("departure",$departure);
        $smarty->assign("bottomTotal", $_POST['bottomTotal']);

		//extract tickets 
		$all_tickets = $db->select_fields($db->ticket, "", "", "ticket_del", "0");
		
		$selected_tickets = explode("|",$order["order_tickets"]);
		$selected_quantities = explode("|",$order["order_quantities"]);

		$tickets = array();
		
		//only selected tickets
		foreach($all_tickets as $ticket){
			$k = array_search($ticket['ticket_id'],$selected_tickets);
			if ($k!==false) {
				$tmp = array();
				$tmp['type'] = $ticket['ticket_type'];
				$tmp['price'] = $ticket['ticket_price'];
				$tmp['quantity'] = $selected_quantities[$k];
				$tmp['total'] = sprintf("%0.2f", $tmp['quantity'] * $tmp['price']);
				$tickets[] = $tmp;
			}
		}
		/*		echo "<pre>";
				print_r($tickets);
				echo "==================================>";
				print_r($tour_details);
				print_r($wipe);
				print_r($order);
				exit();
		*/
		$style_array = array("style_div_detail1","style_div_detail2");
		$smarty->assign("divStyles",$style_array);
		$smarty->assign("tickets",$tickets);
        $smarty->assign("bottomTotal", $_POST['bottomTotal']);
		//Deprecated (not used)
		$wipe=base64_encode($order['order_id']);
		$smarty->assign("wipe",$wipe);
        $smarty->assign("bottomTotal", $_POST['bottomTotal']);
		$smarty->assign("tour",$tour_details);
		$smarty->assign("tour_id",$tour_id);
		$smarty->assign("tours",$tours);
	
		$smarty->assign("subpage","_step3");
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		
		$smarty->display('site_pages.tpl');

		break;	
/**
	STEP 2
**/
	case "step2":

		if (isset($_GET['tour_id']) && is_numeric($_GET['tour_id'])) {
			$tour_id = $_GET['tour_id'];
			}
		else {
			$query = "SELECT tour_id FROM `".$db->tour."` WHERE 1 AND tour_del = 0";
			$tour_ids = $db->select_field($db->tour, "tour_id", "", $query);
			$tour_id = $tour_ids[0];
		}

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_id ASC";
		$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_name"));

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_id = ".$tour_id."";
		$tour_details = $db->select_fields ($db->tour, $query);
		
		if (sizeof($tour_details)>0) {
			$tour_details = $tour_details[0];
		}
		else {
			header("Location: booking.php?subpage=tours"); 
			exit();
		}
    /*
		if (!isset($_SESSION['order_id'])){

			header("Location: booking.php?tour_id=".$tour_id."&subpage=step1&expired=true");
			exit();			

		}

*/
		// Save values
		if (!empty($_POST['selected_departure'])) {

			$fields = array("order_departure_id"=>$_POST['selected_departure'],"order_date"=>$_POST['selected_date'], "order_time"=>time());
			
			if(!empty($_POST['price'])) {
				/* also adding booking fee */
				$fields["order_total"] = $_POST['price'] + (float)$price_fee;
			}
			
			if( $db->exist_value($db->order,'order_id', $_SESSION['order_id'])){

				edit_order($fields, 'order_id', $_SESSION['order_id'], 'frontend booking step2');
				header("Location: booking.php?tour_id=".$tour_id."&subpage=step3");
				exit();

			}

		}

		//start variables
		$month 				= (isset($_POST['month']))?$_POST['month']:date("Y-m");
		$YM_current_month 	= date("Y-m");
		$current_date 		= date("Y-m-d");
		$current_day 		= date("d");
		
		//extract current session
		$order = $db->select_fields($db->order, "", "", 'order_id', $_SESSION['order_id'], "", "", "", 1);
		
		if(empty($order['order_quantities'])){
			header("Location: booking.php?tour_id=".$tour_id."&subpage=step1&expired=true");
			exit();			
		}

		$smarty->assign("order",$order);
		
		
		@list(,$referer) = explode("?",@$_SERVER['HTTP_REFERER']);
		$referer_string = "tour_id=".$tour_id."&subpage=step2";
		if ($referer != $referer_string){
			$month = (!empty($order['order_date']))?date("Y-m",strtotime($order['order_date'])):$month;
		}
			
		$months = array();	
		$base = strtotime(date('Y-m',time()) . '-01 00:00:01');
		for ($i = 0; $i<8; $i++) {
			$tmp = array();
			$curmonth = ($i == 0) ? $base : strtotime("+$i month", $base);
			$tmp["departure_fm_date"] = date("F Y", $curmonth);
			$tmp["departure_ym_date"] = date("Y-m", $curmonth);
			$months[] = $tmp;
		}
		
		$smarty->assign("months",$months);		
		
		$smarty->assign("month",$month);

		if($order['order_tour_shared_id'] !=0) {
			$_tour_id = $order['order_tour_shared_id'];
		} else {
			$_tour_id = $tour_id;
		}
		
		//extract days
		$query = "SELECT *
				  FROM $db->departure, $db->boat
				  WHERE departure_boat_id = boat_id
				  AND departure_tour_id = ".$_tour_id."
				  AND boat_del = 0
				  AND SUBSTRING(departure_date,1,7) >= '".$month."'
				  GROUP BY departure_date
				  ORDER BY departure_date";
		$fields = array("departure_date");
		$departure_days = $db->select_fields($db->departure, $query, $fields);
		//print_r($departure_days);
		
		//			TYPES: 
		//			0 - Too late to book
		//			1 - Sold out
		//			2 - Tickets available
		//			3 - Day Selected 
		
		$days_in_month = date("t", strtotime($month."-01")); // days in current month
		$index = date("w",strtotime($month."-01")); // first day in what day
		
		$days = array();//"
		
		for($i=-$index+1; $i<=$days_in_month;$i++){
			$tmp = array();
			$tmp['day'] = ($i>0)?$i:0;
			$tmp['date']  = $month."-".sprintf("%02d",$tmp['day']);

			if ($tmp['day']==0) {
				$tmp['type'] = -1;			
			} elseif($tmp['date']<$current_date){
				//Too late to book
				$tmp['type'] = 0;
			} elseif ($tmp['date'] == $current_date){
					// check for today bookings
				  $query = "SELECT departure_id, departure_time, boat_passengers, boat_charter_price
					  FROM $db->departure,  $db->boat
					  WHERE departure_date = '".$current_date."'
					  AND departure_time > CURTIME() 
					  AND departure_boat_id = boat_id
					  AND departure_tour_id = ".$_tour_id."
					  AND boat_del = 0
					  ORDER BY departure_time ASC";

				$fields 	= array("departure_id","boat_passengers"); 
				$departures = $db->select_fields($db->departure, $query, $fields);

					
				if(!empty($departures))
				{
					$tmp['type'] = 0;

					foreach($departures as $Dindex=>$Dvalue)
					{
						if ($tmp['type'] == 2)
							break;

						$query2 = "SELECT * FROM $db->order
						WHERE order_departure_id = '".$Dvalue['departure_id']."'";
							  
						$field2 = array("order_tickets", "order_tickets_number");
						$orders = $db->select_fields($db->order, $query2, $field2);
						
						$occupied_seats = 0;						
						foreach($orders as $orderdata)
						{
							//charter
							if (($orderdata['order_tickets']==0) && ($orderdata['order_tickets_number']==1)) {
								$occupied_seats += $Dvalue['boat_passengers'];
							} else {
								//normal
								$occupied_seats += $orderdata['order_tickets_number'];
							}
						}
					
						//Order Is Charter...
						if(($order['order_tickets']==0) && ($order['order_tickets_number']==1)) {
							if ($occupied_seats == 0)
								$tmp['type'] = 2;
						} else {
							if ($order['order_tickets_number'] <= $Dvalue['boat_passengers']-$occupied_seats)
								$tmp['type'] = 2;
						}					
					}
				}
				else
				{		
					$tmp['type'] = 0;
				}	
			} else {
				//check if there is tickets Available or Sold Out
				$query = "SELECT departure_id, boat_passengers, sum(order_tickets_number) as tickets_no
						  FROM $db->boat, $db->departure
						  LEFT JOIN $db->order ON (departure_id = order_departure_id)
						  WHERE departure_date = '".$tmp['date']."'
						  AND departure_boat_id = boat_id
						  AND departure_tour_id = ".$_tour_id."
						  AND boat_del = 0
						  AND boat_passengers != '0'
						  GROUP BY departure_id";


				$fields = array("departure_id","boat_passengers", "tickets_no");
				$departures = $db->select_fields($db->departure, $query, $fields);
				
				$tmp['type'] = 1;

				foreach($departures as $departure) {

					if ($tmp['type'] == 2)
						break;

					$query3 = "SELECT * FROM $db->order
								WHERE order_departure_id = '".$departure['departure_id']."'";
					$field3 = array("order_tickets", "order_tickets_number");			
					$order3 = $db->select_fields($db->order, $query3, $field3);	
					
					$occupied_seats = 0;
					foreach($order3 as $orderdata)
					{
						//charter
						if(($orderdata['order_tickets_number']==1) && ($orderdata['order_tickets']=="0")) {
							$occupied_seats += $departure['boat_passengers'];
						} else { //normal						
							$occupied_seats += $orderdata['order_tickets_number'];
						}
					}
					

					//Order Is Charter...
					if(($order['order_tickets']==0) && ($order['order_tickets_number']==1)) {
						if ($occupied_seats == 0)
							$tmp['type'] = 2;
					} else {
						if ($order['order_tickets_number'] <= $departure['boat_passengers']-$occupied_seats)
							$tmp['type'] = 2;
					}				
				}					
			}
			
			$days[] = $tmp;
		}
		//exit();

        $order = $db->select_fields($db->order, "", "", 'order_id', $order_id, "", "", "", 1);
        if ($order['order_tour_shared_id'] !=0) {
            $_tour_id = $order['order_tour_shared_id'];
        } else {
            $_tour_id = $tour_id;
        }


        $today = new DateTime();


        $selectDate = $today->format('Y-m-d');

//        $query = "SELECT departure_id, departure_time, boat_passengers, boat_charter_price
//            FROM $db->departure,  $db->boat
//            WHERE departure_date = '".$selectDate."'
//            ".(($selectDate == date("Y-m-d"))?" AND departure_time > CURTIME()":"")."
//            AND departure_boat_id = boat_id
//            AND departure_tour_id = ".$tour_id."
//            AND boat_del = 0
//            ORDER BY departure_time ASC";
            //echo $query; exit();

        $departuresQuery = "SELECT departure_id, departure_time, boat_passengers, boat_charter_price
					  FROM $db->departure,  $db->boat
					  WHERE departure_date = '".$selectDate."'
					  AND departure_boat_id = boat_id
					  AND departure_tour_id = ".$_tour_id."
					  AND boat_del = 0
					  ORDER BY departure_time ASC";

        $availableDepartureDaysQuery = "SELECT DISTINCT departure_date
					  FROM $db->departure,  $db->boat
					  WHERE departure_boat_id = boat_id
					  AND departure_tour_id = ".$_tour_id."
					  AND boat_del = 0
					  ORDER BY departure_date ASC";

        $fields 	= array("departure_id", "departure_time", "boat_passengers", "boat_charter_price");
        $departures = $db->select_fields($db->departure, $departuresQuery, $fields);


        $availableDatesResults = $db->select_fields($db->departure, $availableDepartureDaysQuery, array("departure_date"));
        $availableDates = [];

        foreach($availableDatesResults as $availableDateResult){
            $availableDates[] = $availableDateResult['departure_date'];
        }

        $Initdepartures =  json_encode($departures);


		$smarty->assign("sessionId",$sessionId);
		$smarty->assign("days",$days);
		$smarty->assign("tour",$tour_details);
		$smarty->assign("tour_id",$tour_id);
		$smarty->assign("tours",$tours);
        $smarty->assign("availableDates",json_encode($availableDates));
        $smarty->assign("departures",$Initdepartures);

        $smarty->assign("contor", array(0,1,2,3,4,5,6));
		$smarty->assign("subpage","_step2");
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		$smarty->display('site_pages.tpl');
		break;

/**
	STEP 1
**/

	case "step1":
//		if (TESTING && !isset($_GET['debug']) && empty($_POST)) {
//			die("Sorry! LRV Booking is currently down for maintenance.<br/>
//				We expect to be back in a couple of minutes. Thanks for your patience.");
//		}

		if (isset($_GET['tour_id']) && is_numeric($_GET['tour_id'])) {
			$tour_id = $_GET['tour_id'];
		}
		else 
		{
			$query = "SELECT tour_id FROM `".$db->tour."` WHERE 1 AND tour_del = 0";
			$tour_ids = $db->select_field($db->tour, "tour_id", "", $query);
			$tour_id = $tour_ids[0];
		}

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_id ASC";
		$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_name"));

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_id = ".$tour_id."";
		$tour_details = $db->select_fields ($db->tour, $query);
		if (sizeof($tour_details)>0) {
			$tour_details = $tour_details[0];
		}
		else {
			header("Location: booking.php?subpage=tours");
			exit();
		}

		if (!empty($_POST)){

            $smarty->assign('bottomTotal',$_POST['bottomTotal']);

			// Deleted by Carlos
			/*Adding booking fee for regular orders */
			//$order_total = 3.95; 

			if(!empty($_POST['charter']) && ($_POST['charter']=='on')){
				/*
				Charter
				*/
                //var_dump($_POST['charter']); die();
				$order_total = $tour_details['tour_charter_price'] + (float)$price_fee;
				
				$fields = array("order_tickets"=>"0","order_quantities"=>"1", "order_tickets_number"=>1, "order_total"=>$order_total, "order_time"=>time(), "order_method"=>"protx");
				if ($tour_details['tour_shared_id'] != 0) {
					$fields['order_tour_shared_id'] = $tour_details['tour_shared_id'];
					$fields['order_tour_prefix'] = $tour_details['tour_prefix'];
				} else {
					$fields['order_tour_shared_id'] = 0;
					$fields['order_tour_prefix'] = "";
				}

			} else {
				/*
				NOT Charter
				*/


				$order_total = $_POST['total'];

				foreach($_POST['quantity'] as $key => $value){
					if (empty($value))  {
						unset($_POST['quantity'][$key]);
						unset($_POST['ticket'][$key]);
					}
				}
				if ($tour_details['tour_shared_id'] != 0) {
					$_tour_id = $tour_details['tour_shared_id'];
				} else {
					$_tour_id = $tour_id;

				}
				
				//extract tickets seats
				$query = "SELECT * FROM $db->ticket
						  WHERE 1 
						  AND ticket_tour_id = ".$_tour_id."
						  AND ticket_del ='0'";				
				$_ticket = $db->select_field_keyval($db->ticket, $query, "ticket_id", "ticket_seats");
				$_total_seats = 0; 
				foreach($_POST['ticket'] as $key => $value){
					$_total_seats += $_POST['quantity'][$key] * $_ticket[$_POST['ticket'][$key]];
				}
				
				$fields = array("order_tickets"=>implode("|",$_POST['ticket']),"order_quantities"=>implode("|",$_POST['quantity']), "order_tickets_number"=>$_total_seats, "order_total"=>$order_total, "order_time"=>time(), "order_method"=>"protx");

				if ($tour_details['tour_shared_id'] != 0) {
					$fields['order_tour_shared_id'] = $tour_details['tour_shared_id'];
					$fields['order_tour_prefix'] = $tour_details['tour_prefix'];
				} else {
					$fields['order_tour_shared_id'] = 0;
					$fields['order_tour_prefix'] = "";
				}


			}
				
			/*$query = "SELECT * FROM $db->resellers WHERE 1 AND reseller_del = 0 AND reseller_id = " . intval($_POST['order_reseller_id']);
			$resellers = $db->select_fields ($db->resellers, $query);
			    if (is_array($resellers) and count($resellers))*/
			if(trim($_POST['order_reseller_id'])!="")
			{
				$fields['order_reseller_id'] = $_POST['order_reseller_id'];
			}
			else
			{
				$fields['order_reseller_id'] = '-1';
			}	

			//print_r($fields);
			
			if( isset($_SESSION['order_id']) && $db->exist_value($db->order,'order_id', $_SESSION['order_id'])){
				$order = $db->select_fields($db->order, "", "", 'order_id', $_SESSION['order_id'], "", "", "", 1);
				
				if ($order["order_payd"]=="1")
					die("Your order has already been placed.<br/>
					If you had any issues during the payment process please call us on: 0207 928 8933 or email us to bookings@londonribvoyages.com");

				$fields['order_departure_id'] = "NULL";
				$fields['order_date'] = "NULL";

				edit_order($fields, 'order_id', $_SESSION['order_id'], 'frontend booking step1');
			} else {
				$fields['order_sid'] = session_id();			
				$_SESSION['order_id'] = generate_order($fields, "frontend booking");


			}
            $smarty->assign("bottomTotal", $_POST['bottomTotal']);
			header("Location: booking.php?tour_id=".$tour_id."&subpage=step2");
			exit();
		}

		//extract prices and tickets
		$order = $db->select_fields($db->order, "", "", 'order_id', $_SESSION['order_id'], "", "", "", 1);
		$smarty->assign("order",$order);

		$selected_quantities 	= explode("|",$order['order_quantities']);
		$selected_tickets 		= explode("|",$order['order_tickets']);
		
		if ($tour_details['tour_shared_id'] != 0) {
			$_tour_id = $tour_details['tour_shared_id'];
		} else {
			$_tour_id = $tour_id;
		}
			

		//normal tickets
		$query = "SELECT * FROM $db->ticket
				  WHERE ticket_del ='0' 
				  AND ticket_tour_id = ".$_tour_id."
				  AND ticket_special = '0'";
		$tickets = $db->select_fields($db->ticket, $query, "");
		//print_r($tickets);
		foreach($tickets as $key => $ticket){
			$k = array_search($ticket['ticket_id'],$selected_tickets);
			if ($k!==false) $tickets[$key]['quantity'] = $selected_quantities[$k];
		}
		

		//special tickets
		$query = "SELECT * FROM $db->ticket
				  WHERE ticket_del ='0' 
				  AND ticket_tour_id = ".$_tour_id."
				  AND ticket_special = '1'";
		$special_tickets = $db->select_fields($db->ticket, $query, "");
		
		foreach($special_tickets as $key => $ticket){
			$k = array_search($ticket['ticket_id'],$selected_tickets);
			if ($k!==false) $special_tickets[$key]['quantity'] = $selected_quantities[$k];
		}
		//print_r($special_tickets);
		$query = "SELECT * FROM $db->resellers WHERE 1 AND reseller_del = 0";
		$resellers = $db->select_fields ($db->resellers, $query);
		
/*		echo "<pre>";
		print_r($tickets);
		exit();
*/

		$smarty->assign("resellers",$resellers);
		$smarty->assign("tour",$tour_details);
		$smarty->assign("tour_id",$tour_id);
		$smarty->assign("tours",$tours);
		$smarty->assign("tickets",$tickets);
		$smarty->assign("special_tickets",$special_tickets);
		$smarty->assign("no_tickets",@count($tickets));
		$smarty->assign("subpage","_step1");
        $smarty->assign("price_fee", PRICE_FEE);
		
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		$smarty->display('site_pages.tpl');
		break;
	default:
		// asignare variabile smarty si generare fisier smarty :
		$smarty->assign("pages_dir","pages");
		$smarty->assign("page","booking");
		$smarty->display('site_pages.tpl');
}

?>
