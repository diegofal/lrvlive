<?
require_once "../WEB-INF/includes/functions/functions_benchmark.php";
$profiler = new profiler("cms_edit_ticket");

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

$debug = (isset($_GET['debug']) && $_GET['debug'] == "1");

switch (@$_GET['option']) {
	case 'resellers' :
		//resellers
		$query = "SELECT * FROM $db->resellers WHERE 1 AND reseller_del = 0 ORDER BY reseller_name ASC";
		$resellers = $db->select_fields ($db->resellers, $query);
		$smarty->assign("resellers",$resellers);
			
		$smarty->display('make_booking/page_edit_ticket_resellers.tpl');
		break;
		
	//Resend email confirmation
	case 'resendconf':

		if (!empty($_GET['code']) && $db->exist_value($db->order,'order_unique_code',$_GET['code'])) {
			
			$order = $db->select_fields($db->order,"","", 'order_unique_code',$_GET['code'], "", "", "", 1);

			if (isset($_POST["order_id"])) {

				require_once "../WEB-INF/includes/functions/functions_email_cms_edit.php";

				$result = send_email_confirmation($order, "backend resend");
				
				if ($result)		
					$smarty->assign("message","Confirmation email will be re-sent in the next minutes.");
				else
					$smarty->assign("message","ERROR: There was a problem re-sending the email confirmation. Please try again later.");
					
				$smarty->display('make_booking/page_resend_confirmation_done.tpl');
			} else {
			
				$smarty->assign("order",$order);
				$smarty->display('make_booking/page_resend_confirmation.tpl');
			}
		} else {
			print '<script language="javascript">window.close();</script>';
		}
		
		break;
		
	case 'confirm' :
	default:

		//edit ticket
		if (!empty($_GET['id']) && $db->exist_value($db->order,'order_id',$_GET['id'])) {
		
			if (!empty($_POST)){

				if (isset($_POST['tour_id']) && is_numeric($_POST['tour_id'])) {
					$tour_id = $_POST['tour_id'];
				}
				else {
					die("tour error");
				}

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

				if (!in_array($_POST['order_method'], array("protx", "streamline", "cash", "cheque"))) $_POST['order_method'] = "protx";

				//general settings
				if(!empty($_POST['charter']) && ($_POST['charter']=='yes')){
					//if is charter
					//is reseler?
					if (!empty($_POST['reseller_id']) && $_POST['reseller_id'] != -1 && (empty($_POST['bespoke_price']) || !is_numeric($_POST['bespoke_price']))) {
						$query = "SELECT * FROM $db->reseller_cmns  WHERE reseller_tour_id= ".$tour_id . " AND reseller_id=". $_POST[reseller_id];
						$charter = $db->select_fields ($db->reseller_cmns ,$query, "" , "", "", "", "1", "", 1);
							
						$fields = array("order_tickets"=>"0","order_quantities"=>"1", "order_tickets_number"=>1, "order_total"=>$charter[reseller_charter]);
					}
					else $fields = array("order_tickets"=>"0","order_quantities"=>"1", "order_tickets_number"=>1, "order_total"=>$tour_details['tour_charter_price']);
						
				} else {

					//if isn't charter
					foreach($_POST['quantity'] as $key => $value){
						if (empty($value))  {
							unset($_POST['quantity'][$key]);
							unset($_POST['ticket'][$key]);
						}
					}
						
					//extract tickets seats
					$query = "SELECT * FROM $db->ticket WHERE ticket_tour_id = $tour_id";				
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
					array("order_title" => @$_POST['order_title'],
							"order_first_name" => @$_POST['order_first_name'],
							"order_last_name" => @$_POST['order_last_name'],
							"order_tokens_redeemed" => @$_POST['tokens_redeemed'],
							"order_street_address1" => @$_POST['order_street_address1'],
							"order_street_address2" => @$_POST['order_street_address2'],
							"order_city" => @$_POST['order_city'],
							"order_zip" => @$_POST['order_zip'],
							"order_country" => @$_POST['order_country'],
							"order_phone" => @$_POST['order_phone'],
							"order_fax" => @$_POST['order_fax'],
							"order_email" => @$_POST['order_email'],
							"order_reseller_id " => @$_POST['reseller_id'],	
							"order_reseller_name" => $reseller,
							"order_comments" => nl2br(@$_POST['comments']),
							"order_note_office" => nl2br(@$_POST['order_note_office']),
					  		"order_note_crew" => nl2br(@$_POST['order_note_crew']),
					)
				);

				$fields["order_method"] = trim($_POST['order_method']);
				//if($db->edit_field($db->order, $fields, "order_id", $_GET['id']))
				$result = edit_order($fields, "order_id", $_GET['id'], "backend edit_ticket");
				require_once "../WEB-INF/includes/functions/functions_email_cms_edit.php";		
					
				$order = $db->select_fields($db->order, "", "", 'order_id', $_GET['id'], "", "", "", 1);
				if (isset($_POST['resendconfirmation'])) {
					send_email_confirmation($order, "backend edit-ticket");					
				}
												
				if ($debug) {					
					echo "Result: $result";
					echo "<br />Fields:<pre>";
					print_r($fields);
					echo "</pre>";
				} 
				
				$smarty->assign("result", $result);
				$smarty->assign("resendconfirmation",isset($_POST['resendconfirmation']));
				$smarty->display('make_booking/page_edit_done.tpl');
			} else {
				print '<script language="javascript">window.close();</script>';
			}
		}
		//extract dates from database
		else if (!empty($_GET['code']) && $db->exist_value($db->order,'order_unique_code',$_GET['code']))
		{
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
				//header("Location: booking.php?subpage=tours");
				//exit();
				die("tour error");
			}


			$order = $db->select_fields($db->order,"","", 'order_unique_code',$_GET['code'], "", "", "", 1);
	
			//extract departure date and time
			$query = "SELECT * FROM $db->departure, $db->boat
			  WHERE departure_id = '".$order['order_departure_id']."'
			  AND departure_boat_id = boat_id
			";

			$fields = array("departure_id", "departure_date","departure_time", "boat_charter_price", "boat_passengers");
			$departure = $db->select_fields($db->departure, $query, $fields, "","", "", "", "", 1);
			//detect how many free places are available and send $free to Smarty
			$fields_array = array("departure_id", "departure_date","departure_time", "available", "order_tickets");
			$query = "
				SELECT departure_id, departure_date, departure_time, boat_passengers, IFNULL(SUM(order_tickets_number),0) AS taken,
				boat_passengers-IFNULL(SUM(order_tickets_number),0) as available, order_tickets
				FROM $db->boat, $db->departure
				LEFT JOIN $db->order ON (departure_id = order_departure_id)
				WHERE departure_id= '".$departure['departure_id']."'
				AND boat_del = 0 
				AND departure_boat_id = boat_id 
				GROUP BY departure_id
			";	
			$free_places = $db->select_fields($db->departure, $query, $fields_array, "", "", "", "", "", 1);
			//if is charter
			if($order['order_tickets'] == 0) $order['order_tickets_number'] = $departure['boat_passengers'];
			if($free_places['order_tickets'] == 0) $free_places['available'] = 0;

			$free = $free_places['available'] + $order['order_tickets_number'];
			$smarty->assign("free",$free);

			//extract prices and tickets
			$session = $db->select_fields($db->session, "", "", 'session_sid', session_id(), "", "", "", 1);
			$smarty->assign("session",$session);

			if (empty($_POST[reseller_id]) or $_POST[reseller_id] == -1) {
				
				$older_order_tickets = str_replace("|", ",", $order['order_tickets']);
				
				$where = "ticket_tour_id = $tour_id AND ticket_del = '0'";
				if (!empty($older_order_tickets)) {
					$where = "ticket_tour_id = $tour_id AND (ticket_del = '0' OR ticket_id in ($older_order_tickets))";					
				}
				
				//normal tickets
				$query = "SELECT * FROM $db->ticket
					WHERE
						$where					
					AND ticket_special = '0'";
				$tickets = $db->select_fields($db->ticket, $query, "");

				//special tickets
				$query = "SELECT * FROM $db->ticket
					WHERE
						$where
					AND ticket_special = '1'";
				$special_tickets = $db->select_fields($db->ticket, $query, "");

				//if is not charter
				if ($order['order_tickets'] != "0")
				{

					$order['order_tickets'] = explode("|", $order['order_tickets']);
					$order['order_quantities'] = explode("|", $order['order_quantities']);
					//normal tickets
					
					foreach($tickets as $key => $ticket)
					{
						$i = array_search($ticket['ticket_id'], $order['order_tickets']);
						if ($i !== FALSE) {
							$tickets[$key]['quantity'] = $order['order_quantities'][$i];
						}
					}

					//special tickets
					foreach($special_tickets as $key => $ticket)
					{
						$i = array_search($ticket['ticket_id'], $order['order_tickets']);
						if ($i !== FALSE) {
							$special_tickets[$key]['quantity'] = $order['order_quantities'][$i];
						}
					}

				}
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
				if ($order['order_tickets'] != "0")
				{
					$order['order_tickets'] = explode("|", $order['order_tickets']);
					$order['order_quantities'] = explode("|", $order['order_quantities']);
					foreach($reseller_tickets as $key => $ticket)
					{
						$i = array_search($ticket['ticket_id'], $order['order_tickets']);
						if ($i !== FALSE) {
							$reseller_tickets[$key]['quantity'] = $order['order_quantities'][$i];
						}
					}
				}
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
				if ($order['order_tickets'] != "0")
				{
					foreach($reseller_s_tickets as $key => $ticket)
					{
						$i = array_search($ticket['ticket_id'], $order['order_tickets']);
						if ($i !== FALSE) {
							$reseller_s_tickets[$key]['quantity'] = $order['order_quantities'][$i];
						}
					}
				}
				$special_tickets = $reseller_s_tickets;
					
				//charter
				$query = "SELECT * FROM $db->reseller_cmns  WHERE reseller_tour_id= ".$tour_id . " AND reseller_id=". $_POST[reseller_id];
				$charter = $db->select_fields ($db->reseller_cmns ,$query, "" , "", "", "", "1", "", 1);
				$smarty->assign("charter",$charter);
			}

			$order['order_comments']=htmlspecialchars(strip_tags($order['order_comments'], ''));
			$order['order_note_office']=htmlspecialchars(strip_tags($order['order_note_office'], ''));
			$order['order_note_crew']=htmlspecialchars(strip_tags($order['order_note_crew'], ''));
						

			$smarty->assign("tour",$tour_details);
			$smarty->assign("tour_id",$tour_id);
			$smarty->assign("tours",$tours);

			$smarty->assign("order",$order);

			$smarty->assign("tickets",$tickets);
			$smarty->assign("departure",$departure);
			$smarty->assign("special_tickets",$special_tickets);
			$smarty->assign("no_tickets",@count($tickets));

			$smarty->assign("COUNTRIES",$COUNTRIES);
			$smarty->display('make_booking/page_edit_ticket.tpl');
			

		} else {
			print '<script language="javascript">window.close();</script>';
		}
		break;
}

$profiler->end();

?>
