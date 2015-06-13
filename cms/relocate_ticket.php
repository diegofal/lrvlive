<?

require_once "../WEB-INF/includes/functions/functions_benchmark.php";
$profiler = new profiler("cms_relocate_ticket");

//////////////////////////
$profiler->start_block("init_including");
//////////////////////////


// pornire sesiune :
require_once "check_login.php";

require_once "../WEB-INF/includes/functions/functions_payment.php";
require_once "../WEB-INF/includes/functions/functions_log.php";
require_once "../WEB-INF/includes/functions/functions_order.php";

require_once "../WEB-INF/includes/functions/functions_email_cms.php";

////////////////////////
$profiler->stop_block("init_including");
//////////////////////////
	
if (!empty($_GET['code']) && $db->exist_value($db->order,'order_unique_code',$_GET['code']))
{

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
	} else {
		die("tour error");
	}

	$order = $db->select_fields($db->order,"","", 'order_unique_code',$_GET['code'], "", "", "", 1);
	$order_ticketsTmp = $order['order_tickets'];
	$order_tickets_numberTmp = $order['order_tickets_number'];

	//extract departure date and time
	$query = "SELECT * FROM $db->departure, $db->boat 
			  WHERE departure_id = '".$order['order_departure_id']."'
			  AND departure_boat_id = boat_id
			  AND boat_del = 0";
	
	$fields_array = array("departure_id", "departure_date","departure_time", "boat_id", "boat_name", "boat_passengers");
	$departure = $db->select_fields($db->departure, $query, $fields_array, "","", "", "", "", 1);
	
	if ($order['order_tickets']==0) $order['order_tickets_number'] = $departure['boat_passengers'];
	
	//extract all departures witch can apply
	$fields_array = array("departure_id", "departure_date","departure_time", "available", "order_tickets");
	$fields_array_new 	= array("order_departure_id", "Available", "order_tickets");
	//$today = date("Y-m-d");
	if( $order_tickets_numberTmp==1 && $order_ticketsTmp==0 ) // that means charter
	{
		$query = "
			SELECT departure_id, departure_date, departure_time, boat_passengers, IFNULL(SUM(order_tickets_number),0) AS taken,
			boat_passengers-IFNULL(SUM(order_tickets_number),0) as available, order_tickets
			FROM 
				departure
			    INNER JOIN
				boat ON departure.departure_boat_id = boat.boat_id
				LEFT JOIN 
				orders ON order_departure_id = departure_id 
			WHERE 
			departure_id != '".$departure['departure_id']."'
			AND boat_del = 0 
			AND departure_boat_id = boat_id 
			AND departure_tour_id = ".$tour_id."
			AND departure_date >= '".date("Y-m-d")."'
			GROUP BY departure_id
			HAVING boat_passengers-taken>='".$order['order_tickets_number']."'
			ORDER BY departure_date, departure_time	
		";
		$to = $db->select_fields($db->departure, $query, $fields_array);
	}
	else
	{
		$query = "
			SELECT departure_id, departure_date, departure_time, boat_passengers as available
			FROM 
				departure
			    INNER JOIN
				boat ON departure.departure_boat_id = boat.boat_id
			WHERE boat_del = 0 
			AND departure_boat_id = boat_id 
			AND departure_tour_id = ".$tour_id."
			AND departure_date >= '".date("Y-m-d")."'
			ORDER BY departure_date, departure_time";
		$Res = $db->select_fields($db->departure, $query, $fields_array);	
		$k = 0;
		foreach($Res as $Dindex=>$Dvalue)
		{
			$query2 = "
			SELECT order_departure_id,IFNULL(SUM(order_tickets_number),0) AS taken,
			".$Dvalue['available']."-IFNULL(SUM(order_tickets_number),0) as Available,order_tickets
			FROM orders	WHERE order_departure_id = '".$Dvalue['departure_id']."'
			AND (order_tickets != '0' And order_tickets != '' And order_tickets != 'NULL')
			GROUP BY order_departure_id
			HAVING Available >='".$order['order_tickets_number']."'";
			//echo $query2; echo "<hr>";
			$result2 		= mysql_query($query2);
			$OrderStatus 	= mysql_fetch_array($result2);
			//echo "<pre>"; print_r($OrderStatus); echo "<hr>";
			//$departure_id   = $Dvalue['departure_id'];
			if(mysql_num_rows($result2)< 1)
			{
				$checkWeather_inorrderTblornot = mysql_query("select * from orders where order_departure_id = '".$Dvalue['departure_id']."'");
				if(mysql_num_rows($checkWeather_inorrderTblornot) > 0)
				{
					unset($Res[$Dindex]);									
				}
				else
				{	
					if($Dvalue['available'] > '0')
					{
						$to[$k]['departure_id'] 	= $Dvalue['departure_id'];
						$to[$k]['available'] 		= $Dvalue['available'];
						$to[$k]['departure_date'] 	= $Dvalue['departure_date'];
						$to[$k]['departure_time'] 	= $Dvalue['departure_time'];
						$k++;
					}
				}	
			}	
			else
			{
				$result3 	= mysql_query($query2);
				$fetch  	= mysql_fetch_array($result3);
				//echo "<pre>"; print_r($fetch); echo "#########################################>";
				if($Dvalue['departure_id'] == $fetch['order_departure_id'])
				{
					if($Dvalue['available'] - $fetch['taken'] > '0')
					{
						$to[$k]['departure_id'] 	= $Dvalue['departure_id'];
						$to[$k]['available'] 		= $Dvalue['available'] - $fetch['taken'];
						$to[$k]['departure_date'] 	= $Dvalue['departure_date'];
						$to[$k]['departure_time'] 	= $Dvalue['departure_time'];
						$k++;
					}
				}
			}
			
		}		
	}
	$smarty->assign("order",$order);
	$smarty->assign("to",$to);
	$smarty->assign("departure",$departure);
	$smarty->display('make_booking/page_relocate_booking.tpl');			
	
} elseif (!empty($_POST['from']) && !empty($_POST['to']) && !empty($_POST['order']) &&
		$db->exist_value($db->departure,'departure_id',$_POST['from']) && 
		$db->exist_value($db->departure,'departure_id',$_POST['to']) &&
		$db->exist_value($db->order,'order_id',$_POST['order']))
{
	//relocating 

    $order = $db->select_fields($db->order, "", "", 'order_id', $_POST['order'], "", "", "", 1);

	$array_fields = array("order_departure_id"=>$_POST['to']);
	//if($db->edit_field($db->order, $array_fields, "order_id", $_POST['order']))

    remove_feedback($order["order_email"]);

	$result = edit_order($array_fields, "order_id", $_POST['order'], "backend relocate_ticket");

	if ($result)
	{
		$smarty->assign("ok","true");
		require_once "../WEB-INF/includes/functions/functions_email_cms_edit.php";
		$order = $db->select_fields($db->order, "", "", 'order_id', $_POST['order'], "", "", "", 1);
		send_email_confirmation($order, "backend make-booking (added)", false);
        send_feedback_mail($order["order_email"], $order["order_id"]);
	}
	else
	{ 
		$smarty->assign("ok","false");	
	}
	
	$smarty->display('make_booking/page_relocate_booking.tpl');		
}
else 
{
	print '<script language="javascript">window.close();</script>';
}

$profiler->end();

?>
