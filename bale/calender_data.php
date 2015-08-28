<?php
require_once "../WEB-INF/includes/classes/class.x3.database.php";
require_once "../WEB-INF/includes/config.php";
require_once "../WEB-INF/includes/functions/functions_utils.php";
include "../WEB-INF/includes/smarty/smarty_cms.php";


// DB connction
$db = new DB_config;
$db->connect();

$tours = $_REQUEST['tours'];
$curyear = $_REQUEST['curyear'];

  $id = $_REQUEST['caldate']; 
  $tdata = date("Y-m-d");
  $time =  date("H:i:s");


$dateTmp = new DateTime();
$dateTmp->add(new DateInterval('PT30M'));
$timeTmp = $dateTmp->format('H:i:s');

  if($id == "")
  {
    $date_val =  $tdata;  
  }
  else
  {
    $date_val =  $id;  
  }

   
echo '<table width="97%" border="0" align="right" cellpadding="0" cellspacing="0" style="border:#bfbebe solid 1px;">
		<tr>
		<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr height="45">
		<td width="66" height="30" class="right_col">Time</td>
		<td width="139" height="30" class="right_col">Tour</td>
		<td width="66" height="30" class="right_col">Av. Seats</td>
		<td width="139" height="30" class="right_col_2">Book Now</td>
		</tr>';
		  
 $query = "SELECT 
	 			d.departure_id,
	 			d.departure_boat_id,
	 			d.departure_date,
	 			d.departure_time,
	 			b.boat_passengers, 
	 			b.boat_del,
	 			t.tour_name, 
			   	UNIX_TIMESTAMP(concat_ws(d.departure_date, d.departure_time )) AS departure_unixtime 
			FROM
				departure d 
				INNER JOIN boat b ON d.departure_boat_id = b.boat_id
				INNER JOIN tours t ON d.departure_tour_id = t.tour_id
			WHERE
				d.departure_date = '$date_val'
				AND if (curdate() = departure_date, departure_time > '$timeTmp', 1)
				AND b.boat_del = 0
				AND b.boat_passengers > 0				
				AND t.tour_id IN ($tours)
			ORDER BY d.departure_time ASC";

		$result_new = mysql_query($query);
		$total_arr  = array();
		$total_arr = "";
		while($departure = mysql_fetch_assoc($result_new))
		{
			$query = "SELECT o.order_id,o.order_date,o.order_departure_id,o.order_tickets,o.order_quantities,
					o.order_tickets_number,d.departure_tour_id AS order_tour_id FROM $db->order AS o
					LEFT JOIN $db->departure AS d ON o.order_departure_id = d.departure_id
					WHERE o.order_departure_id = '".$departure['departure_id']."'";
			$res_order = mysql_query($query);	
			$count     = mysql_num_rows($res_order);		
					
			$total = 0;
			$total_price = 0.00;
			$total_blocked = 0;
			$orders = array();
			while($orders_fetch = mysql_fetch_assoc($res_order))
			{
				if($orders_fetch['order_tickets']!='0'){
					$total_blocked += $orders_fetch['order_tickets_number'];
				} else {
					$total_blocked += $departure['boat_passengers'];
				}
				
				$orders[]['order_tickets'] = $orders_fetch['order_tickets'];
				$orders[]['order_total'] = $orders_fetch['order_total'];
				$orders[]['order_tickets'] = $orders_fetch['order_tickets'];
				$orders[]['order_quantities'] = $orders_fetch['order_quantities'];		  
			}
			
			for ($i=0;$i<=sizeof($orders)-1; $i++){

				if($orders[$i]['order_tickets']!='0'){
					$total += $orders[$i]['order_tickets_number'];
				} else {
					$total += $departure['boat_passengers'];
				}
				$total_price += $orders[$i]['order_total'];

				$orders[$i]['order_tickets'] = explode("|", $orders[$i]['order_tickets']);
				$orders[$i]['order_quantities'] = explode("|", $orders[$i]['order_quantities']);		

			}

			//{if ($departures[i].available == 0 && $departures[i].reseller_orders_num == 0)|| $departures[i].timedout == 1}

			$departures[$key]['reserved'] = $total;
			$departures[$key]['blocked'] = $total_blocked;
			$departures[$key]['available'] = $departure['boat_passengers'] - $total_blocked;

// added by Carlos
		if ($departures[$key]['available'] > 0){

			$bookButton = '<input type="button" name="booking" 
							style="width: 80px;height: 25px;outline: none; font-family:Verdana, Arial, Helvetica, sans-serif; color:#35788B; font-size:11px; font-weight:bold" value="BOOK NOW"
							onclick="window.location = \'booking_add.php?curyear='.$curyear.'&vdate='.$departure['departure_date'].'&departure_id='.$departure['departure_id'].'\'" />';


			$total_arr[] =  $departure['boat_passengers'] - $total_blocked;
			$dept_time = explode(":",$departure['departure_time']);
	
			echo	'<tr>
					<td width="66" height="28" class="ab2">'.$dept_time[0].':'.$dept_time[1].'</td>
					<td width="139" height="0" class="ab2">'.$departure['tour_name'].'</td>
					<td width="66" height="0" class="ab2">'.$departures[$key]['available'].'</td>


					<td width="66" height="0" class="ab2_right">'.$bookButton.'</td>
					</tr>';
			}
		}
echo   '</table></td>
		</tr>
		</table>';
?>

