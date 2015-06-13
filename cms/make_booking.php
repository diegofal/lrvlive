<?

require_once "../WEB-INF/includes/functions/functions_benchmark.php";
$profiler = new profiler("cms_make_booking");

//////////////////////////
$profiler->start_block("init_including");
//////////////////////////

// pornire sesiune :
require_once "check_login.php";
require_once "../WEB-INF/includes/functions/functions_payment.php";
require_once "../WEB-INF/includes/functions/functions_log.php";
require_once "../WEB-INF/includes/functions/functions_order.php";

////////////////////////
$profiler->stop_block("init_including");
//////////////////////////


/*echo "<pre>";
print_r($_POST);
exit();*/
switch (@$_GET['option']) {
	case "added":
		if(!empty($_GET['code'])) {	
			require_once "../WEB-INF/includes/functions/functions_email_cms.php";		
			$results = array("status"=>"ok");
			$order = $db->select_fields($db->order, "", "", 'order_unique_code', $_GET['code'], "", "", "", 1);
			send_email_confirmation($order, "backend make-booking (added)");
			send_feedback_mail($order['order_email'], $order['order_id']);
			$smarty->assign("results",$results);
			$smarty->display('make_booking/page_added.tpl');				
		} else {
			print '<script language="javascript">window.close();</script>';
		}
		break;
	
	case "done":
		if(!empty($_GET['code'])){
			if (empty($_GET['crypt'])){
				header("Location: booking.php");
				exit();			
			}
			$results = decode_crypt($_GET['crypt']);
			if ($results['status'] == 'OK') {
				require_once "../WEB-INF/includes/functions/functions_email_cms.php";
				$field = array("order_payd"=>1);
				edit_order($field, "order_unique_code", $_GET['code'], "backend make_booking");
				$order = $db->select_fields($db->order, "", "", 'order_unique_code', $_GET['code'], "", "", "", 1);
				send_email_confirmation($order, "backend make-booking (done)");				
			} else {
				//delete order			
				$db->delete_field($db->order, "order_unique_code", $_GET['code']);
			}
			$smarty->assign("results",$results);
			$smarty->display('make_booking/page_done.tpl');	
		} else {
			print '<script language="javascript">window.close();</script>';
		}
		
		break;

	case "pay":
		if (!empty($_POST)){
			//------------------ tour
	if (isset($_POST['tour_id']) && is_numeric($_POST['tour_id'])) {
		$tour_id = $_POST['tour_id'];
		}
	else {
			die("tour error");
		}
		/*echo "<pre>";
		print_r($_POST);
		exit();*/
		//Check Availability
		//check if there is tickets Available or Sold Out
			
			$query = "SELECT departure_id, departure_time, boat_passengers, boat_charter_price
					  FROM $db->departure,  $db->boat
					  WHERE departure_id = '".trim($_POST['departure_id'])."'
					  AND departure_boat_id = boat_id
					  AND departure_tour_id = ".$tour_id."
					  AND boat_del = 0";
			
			$fields = array("departure_id", "departure_time", "boat_passengers", "boat_charter_price");
	
			$departure = $db->select_fields($db->departure, $query, $fields, "", "", "", "", "", 1);
			
			if (!empty($departure['departure_id'])) {

				$query2 = "SELECT * FROM $db->order
						  WHERE order_departure_id = '".trim($_POST['departure_id'])."'";
				//echo $query; echo "<hr>"; echo $query2; exit(); 		  
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
				if(!empty($_POST['quantity']) && trim($_POST['charter']) != 'yes')
				{
					$quantiy = array_sum($_POST['quantity']);
				}
				else
				{
					$quantiy = '12';
				}
				$free_seats = trim($_POST['free_seats']);	
				$sum += $quantiy;
				
				if ($sum > $departure['boat_passengers']) {
				    
		 ?>			
				<html>
				<head></head>   
				<body>
				<form action="make_booking.php?tour_id=<?=$tour_id?>&departure_id=<?=trim($_POST['departure_id'])?>&free=<?=$free_seats?>&busy=true" name="TheForm" method="post">
				<?
				foreach($_POST as $ind=>$vals)
				{
					
					if($ind=='quantity')
					{
						foreach($vals as $Qind=>$qval)
						{
							echo "<input type='hidden' name='quantity1[".$Qind."]' value='".$qval."'>";
						}
					}
					else
					{
					echo "<input type='hidden' name='".$ind."' value='".$vals."'>";
					}
				}
				?> 
				</form>
				<script language="javascript">   
				function Redirect() 
				{ 
					document.TheForm.action="make_booking.php?tour_id=<?=$tour_id?>&departure_id=<?=trim($_POST['departure_id'])?>&free=<?=$free_seats?>&busy=true";
					document.TheForm.submit(); 
				}
				Redirect(); 
				</script>
				</body></html>
				<?
				 exit();
				}	
			}
		//------Ends Here-----//

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_id ASC";
		$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_name"));

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_id = ".$tour_id."";
		$tour_details = $db->select_fields ($db->tour, $query);
		if (sizeof($tour_details)>0) {
			$tour_details = $tour_details[0];
		}
		else {
			//header("Location: booking.php?subpage=tours"); 
			//exit();
			die("tour error");
		}
			
			//------------------


            // set default order method 'protx'
			if (!in_array($_POST['order_method'], array("protx", "streamline", "cash", "cheque", "voucher"))) $_POST['order_method'] = "protx";

			//general settings
			if(!empty($_POST['charter']) && ($_POST['charter']=='yes')){
			//if is charter
			//is reseller?
				if (!empty($_POST['reseller_id']) && $_POST['reseller_id'] != -1 && (empty($_POST['bespoke_price']) || !is_numeric($_POST['bespoke_price']))) {
					$query = "SELECT * FROM $db->reseller_cmns  WHERE reseller_tour_id= ".$tour_id . " AND reseller_id=". $_POST[reseller_id];
					$charter = $db->select_fields ($db->reseller_cmns ,$query, "" , "", "", "", "1", "", 1);
					
					$fields = array("order_tickets"=>"0","order_quantities"=>"1", "order_tickets_number"=>1, "order_total"=>$charter[reseller_charter]);
				}
				else $fields = array("order_tickets"=>"0","order_quantities"=>"1", "order_tickets_number"=>1, "order_total"=>$tour_details['tour_charter_price']);
			}
			else {
			//if isn't charter
				foreach($_POST['quantity'] as $key => $value){
					if (empty($value))  {
						unset($_POST['quantity'][$key]);
						unset($_POST['ticket'][$key]); 
					}
				}
				
				//extract tickets seats
				$query = "SELECT * FROM $db->ticket
						  WHERE ticket_del ='0'";				
				$_ticket = $db->select_field_keyval($db->ticket, $query, "ticket_id", "ticket_seats");
				$_total_seats = 0;
				foreach($_POST['ticket'] as $key => $value){
					$_total_seats += $_POST['quantity'][$key] * $_ticket[$_POST['ticket'][$key]];
				}
				$fields = array("order_tickets"=>implode("|",$_POST['ticket']),"order_quantities"=>implode("|",$_POST['quantity']), "order_tickets_number"=>$_total_seats, "order_total"=>$_POST['total']);
			}
			
			if (!empty($_POST['bespoke_price']) && is_numeric($_POST['bespoke_price'])) {
				$fields['order_total']=$_POST['bespoke_price'];
				$fields['order_bespoke_price']=1;
			}
			
			
			$uniqCode = md5(uniqid(rand(), true));
			
			if (@$_POST['reseller_id'] != -1){
			//extract reselers name. Just for excel
			$query = "SELECT * FROM $db->resellers WHERE reseller_id=". @$_POST['reseller_id'] . " AND reseller_del = 0";
			$resellers = $db->select_fields ($db->resellers, $query, "","","", "", "", "", 1);
			$reseller = $resellers['reseller_name'];
			
			//commision
			$query = "SELECT * FROM $db->reseller_cmns WHERE reseller_id=". @$_POST['reseller_id'] . " AND reseller_tour_id  = ".$tour_id."";
			$cmn = $db->select_fields ($db->reseller_cmns, $query, "","","", "", "", "", 1);
			$fields['order_reseller_commission'] = ($fields['order_total']/100) * $cmn['reseller_cmn'];
			}
			else {
				$reseller='LRV';
				$fields['order_reseller_commission']=0;
			}

			$fields = array_merge($fields,
					  array("order_date"=>date("Y-m-d"),
							"order_unique_code"=> $uniqCode, 
							"order_departure_id" => @$_POST['departure_id'],
							//"order_tokens_redeemed" => @$_POST['tokens_redeemed'],
							"order_title" => @$_POST['order_title'],
							"order_first_name" => @$_POST['order_first_name'],
							"order_last_name" => @$_POST['order_last_name'],
							"order_street_address1" => @$_POST['order_street_address1'],
							"order_street_address2" => @$_POST['order_street_address2'],
							"order_city" => @$_POST['order_city'],
							"order_zip" => @$_POST['order_zip'],
							"order_country" => @$_POST['order_country'],
							"order_phone" => @$_POST['order_phone'],
							"order_fax" => @$_POST['order_fax'],
							"order_email" => @$_POST['order_email'],
							"order_payd" => 0,
							"order_time" => time(),
							"order_reseller_id " => @$_POST['reseller_id'],	
							"order_reseller_name" => $reseller,
							"order_comments" => nl2br(@$_POST['comments']),
					  		"order_note_office" => nl2br(@$_POST['order_note_office']),
					  		"order_note_crew" => nl2br(@$_POST['order_note_crew']),
							)
						);			
			//******


			switch(trim($_POST['order_method'])) {
				case "streamline":
				case "cash":
				case "voucher":
				case "cheque":
					$fields["order_payd"] = 1;
					$fields["order_method"] = trim($_POST['order_method']);
					//$db->insert_field($db->order, $fields);
					generate_order($fields, "cms booking (cheque)");
					header("Location: make_booking.php?option=added&code=".$uniqCode);
					exit();							
					break;
				case "protx":
					$fields["order_method"] = "protx";
					//$db->insert_field($db->order, $fields);
					generate_order($fields, "cms booking (protx)");
					//GENII

					//$url = "http://162.13.140.19/cms/make_booking.php?option=done&code=".$uniqCode;
					$url = "http://www.londonribvoyages.com/cms/make_booking.php?option=done&code=".$uniqCode;
					
					$crypt = generate_crypt($fields['order_unique_code'], $fields['order_total'], $tour_details['tour_name'], $fields['order_email'], 
						$fields['order_title']." ". $fields['order_first_name']." ". $fields['order_last_name'], COMPANY_EMAIL, 
						$fields['order_street_address1']." ".$fields['order_street_address2'].", ".$fields['order_city'].", ".$fields['order_country'], $fields['order_zip'],
						$url);
					
					$smarty->assign("vspsite",$vspsite);
					$smarty->assign("crypt",$crypt);	
					$smarty->display('make_booking/page_pay.tpl');
					// Stop Protx
					break;
				}
			

		} else {
			print '<script language="javascript">window.close();</script>';
		}

		break;
		
	case "resellers":
		//resellers
			$query = "SELECT * FROM $db->resellers WHERE 1 AND reseller_del = 0 ORDER BY reseller_name ASC";
			$resellers = $db->select_fields ($db->resellers, $query);
			$smarty->assign("resellers",$resellers);
			
			$smarty->display('make_booking/page_resellers.tpl');
	break;
	default:

		if (isset($_GET['tour_id']) && is_numeric($_GET['tour_id'])) {
		$tour_id = $_GET['tour_id'];
		}
	else {
		$query = "SELECT tour_id FROM `".$db->tour."` WHERE 1 AND tour_del = 0";
		$tour_ids = $db->select_field($db->tour, "tour_id", "", $query);
	//	$tour_id  = $tour_ids[0];
		$tour_id = $tour_ids[0];
		}

		$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0 ORDER BY tour_name ASC";
		$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_name"));

		//extract departure date and time
		$query = "SELECT * FROM $db->departure, $db->boat 
				  WHERE departure_id = '". @$_GET['departure_id']."'
				  AND departure_boat_id = boat_id";
		
		$fields = array("departure_id", "departure_date","departure_time", "boat_charter_price", "boat_passengers");
		$departure = $db->select_fields($db->departure, $query, $fields, "","", "", "", "", 1);
		if (!empty($departure['departure_id']) && !empty($_GET['departure_id'])){
			//extract prices and tickets
			$session = $db->select_fields($db->session, "", "", 'session_sid', session_id(), "", "", "", 1);
			$smarty->assign("session",$session);
			
			if (empty($_POST[reseller_id]) or $_POST[reseller_id] == -1) {
				
				$query = "SELECT * FROM $db->tour WHERE 1 AND tour_id = ".$tour_id."";
				$tour_details = $db->select_fields ($db->tour, $query);
				if (sizeof($tour_details)>0) {
					$tour_details = $tour_details[0];
				}
				else {die("tour error");}
				
				//normal tickets
				$query = "SELECT * FROM $db->ticket
						  WHERE ticket_del ='0' 
						  AND ticket_tour_id = ".$tour_id."
						  AND ticket_special = '0'";
				$tickets = $db->select_fields($db->ticket, $query, "");
				//special tickets
				$query = "SELECT * FROM $db->ticket
						  WHERE ticket_del ='0' 
						  AND ticket_tour_id = ".$tour_id."
						  AND ticket_special = '1'";
				$special_tickets = $db->select_fields($db->ticket, $query, "");
			}	
			else {
			
				//resellers
				$query = "SELECT * FROM $db->resellers WHERE 1 AND reseller_del = 0 AND reseller_id=" . $_POST[reseller_id];
				$reseller = $db->select_fields ($db->resellers, $query, "", "", "", "", "", "", 1);
				$smarty->assign("reseller",$reseller);
				
			
				//verify and add
				//normal tickets
				//reseller tickets
				$query = "SELECT * FROM $db->reseller_tickets WHERE reseller_id=" . $_POST[reseller_id];
				$reseller_tickets = $db->select_fields($db->reseller_tickets, $query, "");
				
					while (list($key, $value) = each($reseller_tickets)) {
						$query = "SELECT * FROM $db->ticket WHERE ticket_del ='0' AND ticket_tour_id = ".$tour_id." AND ticket_special = '0'" ." AND ticket_id =" . $value[ticket_id];
						$normal_tickets = $db->select_fields($db->ticket, $query, "", "", "", "", "", "", 1);
						
						if (empty($normal_tickets[ticket_id])) unset($reseller_tickets[$key]);
						else {$reseller_tickets[$key][ticket_type]=$normal_tickets[ticket_type];
							$reseller_tickets[$key][ticket_seats]=$normal_tickets[ticket_seats];	
						}
					}
				
				sort($reseller_tickets);
				$tickets = $reseller_tickets;
				
				//special tickets
				//reseller tickets
				$query = "SELECT * FROM $db->reseller_tickets WHERE reseller_id=" . $_POST[reseller_id];
				$reseller_s_tickets = $db->select_fields($db->reseller_tickets, $query, "");
				
					while (list($key, $value) = each($reseller_s_tickets)) {
						$query = "SELECT * FROM $db->ticket WHERE ticket_del ='0' AND ticket_tour_id = ".$tour_id." AND ticket_special = '1'" ." AND ticket_id =" . $value[ticket_id];
						$normal_tickets = $db->select_fields($db->ticket, $query, "", "", "", "", "", "", 1);
						
						if (empty($normal_tickets[ticket_id])) unset($reseller_s_tickets[$key]);
						
						else {$reseller_s_tickets[$key][ticket_type]=$normal_tickets[ticket_type];
							$reseller_s_tickets[$key][ticket_seats]=$normal_tickets[ticket_seats];	
						}
					}
				
				sort($reseller_s_tickets);
				$special_tickets = $reseller_s_tickets;
				
				//charter
				$query = "SELECT * FROM $db->reseller_cmns  WHERE reseller_tour_id= ".$tour_id . " AND reseller_id=". $_POST[reseller_id];
				$charter = $db->select_fields ($db->reseller_cmns ,$query, "" , "", "", "", "1", "", 1);
				$smarty->assign("charter",$charter);
			}
			
			$free = trim($_GET['free']);
			$smarty->assign("free_seats",$free);
			$smarty->assign("tour",$tour_details);
			$smarty->assign("tour_id",$tour_id);
			$smarty->assign("tours",$tours);
			$smarty->assign("tickets",$tickets);
			$smarty->assign("departure",$departure);
			$smarty->assign("special_tickets",$special_tickets);
			$smarty->assign("no_tickets",@count($tickets));
			// asignare variabile smarty si generare fisier smarty :
			if(empty($session['session_country'])) $session['session_country'] = "GB";
			$smarty->assign("session",$session);		
			$smarty->assign("COUNTRIES",$COUNTRIES);
			$smarty->display('make_booking/page_make_booking.tpl');
	} else {
		print '<script language="javascript">window.close();</script>';
	}
}

$profiler->end();

?>
