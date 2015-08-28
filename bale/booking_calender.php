<?
session_start();

if ((empty($_SESSION['logged_in']))) {
	header("Location: index.php");
	exit();
}

$current_reseller_id = $_SESSION['current_reseller_id'];

// includes 
require_once "../WEB-INF/includes/classes/class.x3.database.php";
require_once "../WEB-INF/includes/config.php";
require_once "../WEB-INF/includes/functions/functions_utils.php";
include "../WEB-INF/includes/smarty/smarty_cms.php";


// DB connction
$db = new DB_config;
$db->connect();

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

//definire obiect utils
$utils = new x3_utils;

$year_mon = $_REQUEST['curyear'];
$year_arr = explode("_",$year_mon);


$current_month = ($year_arr[1]!="")?$year_arr[1]:date("m");
$current_year  = ($year_arr[0]!="")?$year_arr[0]:date("Y");

$full_mon_name = date("F",mktime(0,0,0,$current_month,1,$current_year));

$cdate         = date("d");
$cyear = date("Y");
$nextyear = date("Y")+1;
$cmon = date("F",mktime(0,0,0,date("m"),date("d"),date("Y")));

						 


$firstdate = $cdate-($cdate-1);

$first_day  = date("D",mktime(0,0,0,$current_month,$firstdate,$current_year));

if($current_month=='01' || $current_month=='03' || $current_month=='05' || $current_month=='07' || $current_month=='08' || $current_month=='10' || $current_month=='12')
{
	$totaldays=31;
}
elseif ($current_month=='04' || $current_month=='06' || $current_month=='09' || $current_month=='11')
{
	$totaldays=30;
}
elseif ($current_month=="02")
{
	if($current_year%4==0)
	$totaldays=29;
	else 
	$totaldays=28;
}
  
		
$pagecontent ='<td width="1161" class="right_bg_line">
<table width="923" border="2" cellspacing="0" cellpadding="0" style="margin-bottom:-30px;margin-top: 18px;">
<tr>
<td>
<div style="float:right;"></div>
</td></tr>
<table width="923" border="2" cellspacing="0" cellpadding="0">
<tr>
<td valign="top" class="cal_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="t2">All Tours</td>
</tr>
<tr>
<td valign="top" style="padding-top:22px;"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="69%"><table width="180" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="50%">
<form action="" method="GET" name="selectyear">';
if(isset($_REQUEST['month']))
{ 
	$pagecontent.='<input type=hidden name=month value="'.$_REQUEST['month'].'">';
} 
		
$pagecontent.='<select name="curyear" id="curyear" onchange="document.selectyear.submit();">';
for($month = 0; $month < 12; $month++)
{
	$time = mktime(0,0,0, date("m") + $month, 1, date("Y"));
	$cyear = date("Y", $time);
	$cmon = date("F", $time);
	$num_mon = date("m", $time);
	$pagecontent.='<option  value="'.$cyear."_".$num_mon.'" 
		'.($_REQUEST['curyear'] == $cyear."_".$num_mon?"selected":$cyear."_".$num_mon).'>'.$cmon.','.$cyear.'
		</option>';
}
		
$pagecontent.='</select></form>		</td>

<td width="50%" align="center"><form name="refresh" action="booking_calender.php" method="post"><div style="position: relative;"><input type="hidden" name="openHistoryId" id="openHistoryId" value=""><div class="button" style="position: absolute; margin-top:0px; left: 60%;"><input type="submit" value="refresh"></div></div></form>	</td>
</tr>
</table></td>
<td width="31%" align="center"  id="changedate"><a href="booking.php?vdate='.date("Y-m-d").'" class="date_heading">CLICK HERE TO BOOK THIS DAY</a><br /><span id="textdate" class="t3">'.date("l,F d").'</span></td>
</tr>
 <tr>
<td width="69%" style="padding-top:15px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:#bfbebe solid 1px;">
<tr>
<td><table width="100%" border="1" cellspacing="0" height="30" cellpadding="0">
<tr height="45">
<td width="84" height="30" align="center" class="weekday">Sunday</td>
<td width="84" height="30" class="weekday">Monday</td>
<td width="84" height="30" class="weekday">Tuesday</td>
<td width="84" height="30" class="weekday">Wednesday</td>
<td width="84" height="30" class="weekday">Thursday</td>
<td width="84" height="30" class="weekday">Friday</td>
<td width="84" height="30" class="weekday_1">Saturday</td>
</tr>
</table></td>
</tr>';
		
switch ($first_day)
{
	case 'Sun':
	$leave = 0;
	break;
	case 'Mon':
	$leave = 1;
	break;
	case 'Tue':
	$leave = 2;
	break;
	case 'Wed':
	$leave = 3;
	break;
	case 'Thu':
	$leave = 4;
	break;
	case 'Fri':
	$leave = 5;
	break;
	case 'Sat':
	$leave = 6;
	break;
}
			
$pagecontent.='<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>';
		
for ($j=0;$j<$leave;$j++)
{
	$pagecontent.='<td width="84" valign="top" class="date"><table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
	<td class="t5a">&nbsp;</td>
	</tr>
	<tr>
	<td  style="padding-top:22px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td width="29%" rowspan="2" valign="bottom" class="t6_big">&nbsp;</td>
	<td width="71%" class="t6">&nbsp;</td>
	</tr>
	<tr>
	<td class="t6">&nbsp;</td>
	</tr>
	</table></td>
	</tr>
	</table></td>';

}


$d = 1;
while ($d <= $totaldays)
{
	
	$cdat      = $d;
	if($cdat < 10) { $cdat      = '0'.$cdat;}
	$today     = $current_year.'-'.$current_month.'-'.$cdat;
	$cdat      = $cdat+1; 
	$cur_time  = date("H:i:s"); 
			
			//calculate pasenger---------------------------------------/
			
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
				d.departure_date = '$today' 
				AND b.boat_del = 0
				AND b.boat_passengers > 0
				AND t.tour_id IN (".implode(",", $_SESSION["tours"]).")
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
			
			$orders[]['order_tickets'] 		 = $orders_fetch['order_tickets'];
			$orders[]['order_total']  		 = $orders_fetch['order_total'];
			$orders[]['order_tickets'] 		 = $orders_fetch['order_tickets'];
			$orders[]['order_quantities'] 	 = $orders_fetch['order_quantities'];		  
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
			
		//$departures[$key]['orders'] = $orders;
		//$departures[$key]['reseller_orders'] = $reseller_orders;
		//$departures[$key]['reseller_orders_num'] = sizeof($reseller_orders);
		$departures[$key]['reserved'] = $total;
		$departures[$key]['blocked'] = $total_blocked;
		$departures[$key]['available'] = $departure['boat_passengers'] - $total_blocked;
		$total_arr[] =  $departure['boat_passengers'] - $total_blocked;
	}

	$total_available_seat = array_sum($total_arr);	
//calculation Ends---------------------------------------/
					
			if($leave%7==0)
			$pagecontent.='</tr><tr>';
		    if(strlen($d) < 2)
				{
					$EventDate = '0'.$d;
				}
				else
				{
					$EventDate = $d;
				}
		$today_val      = $current_year.'-'.$current_month.'-'.$EventDate;	
		$cur_day_format =  date("l,F d",strtotime($today_val));
		
		$pagecontent.='<input type="hidden" name="ready" id="change" value="0"><td width="84" valign="top" class="date" style="cursor:pointer;" onclick="return showUser(\''.$today_val.'\',\''.implode(",", $_SESSION["tours"]).'\',\''.$cur_day_format.'\',\''.$year_mon.'\')">
		<table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">';
		$chnage = 1;
		if(strlen($d) < 2)
				{
					$InsertDate = '0'.$d;
				}
				else
				{
					$InsertDate = $d;
				}
		
								
		$pagecontent.='<tr>
		
		<td class="t5a">';
		if(isset($_REQUEST['month']) || isset($_REQUEST['year'])) { 
		
		$pagecontent.='<font color="#639eca" class="t5a">'.$d.'</font>';
		
		} elseif ($d==date("d")) {
		$pagecontent.=' '.$d.''; 
		}else {
		$pagecontent.='<font color="#639eca" class="t5a">'.$d.'</font>';
		}
		$pagecontent.='&nbsp;</td></tr>
			<tr>
			<td style="padding-top:22px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>';
			if(($total_available_seat > 0) && ($d >= date("j")))
			{
				
				$pagecontent.='<td width="42%" rowspan="2" valign="bottom" class="t6_big">'.$total_available_seat.'</td>
				<td width="58%" class="t6">seats</td>
				<tr>
				<td class="t6">available</td></tr>';
			}
		  else if(($total_available_seat > 0) && ($current_month != date("m")))
			{
				
				$pagecontent.='<td width="42%" rowspan="2" valign="bottom" class="t6_big">'.$total_available_seat.'</td>
				<td width="58%" class="t6">seats</td>
				<tr>
				<td class="t6">available</td></tr>';
			}	
		  else
			{
				$pagecontent.='<td width="42%" rowspan="2" valign="bottom" class="t6_big">&nbsp;</td>
				<td width="58%" class="t6">&nbsp;</td><tr>
				<td class="t6">&nbsp;</td></tr>';
			}
			
			$pagecontent.='</tr>
			</table></td>
			</tr>
			</table></td>';
			$d++;
			$leave++;
		}

		$pagecontent.='</tr>
		</table></td>
		</tr>
		</table></td>
		<td width="31%" align="right" valign="top" style="padding-top:15px;">
		<div id="txtHint">';
		 $time =  date("H:i:s"); 
		 $tdata = date("Y-m-d");
		 
$pagecontent.='<table width="97%" border="0" align="right" cellpadding="0" cellspacing="0" style="border:#bfbebe solid 1px;">
		<tr>
		<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr  height="45">
		<td width="66" height="30" class="right_col">Time</td>
		<td width="139" height="30" class="right_col">Tour</td>
		<td width="66" height="30" class="right_col">Av. Seats</td>
		<td width="139" height="30" class="right_col_2">Book Now</td>
		</tr>
		</table></td>
		</tr><tr>
		<td><table width="100%" border="0" cellspacing="0" cellpadding="0">';
		
		$query = "SELECT 
					departure.departure_id,
					departure.departure_boat_id,
					departure.departure_date,
		           	departure.departure_time,
		           	boat.boat_passengers,
		           	boat.boat_del,
		           	tours.tour_name, 
				   	UNIX_TIMESTAMP(concat_ws(departure_date, departure_time )) AS departure_unixtime
			   	FROM
					departure d 
					INNER JOIN boat b ON d.departure_boat_id = b.boat_id
					INNER JOIN tours t ON d.departure_tour_id = t.tour_id
				WHERE
					d.departure_date = '$tdata'
					   AND if (curdate() = departure_date, departure_time > '".$time."', 1)
					AND b.boat_del = 0
					AND b.boat_passengers > 0
					AND t.tour_id IN (".implode(",", $_SESSION["tours"]).")
			   	ORDER BY departure.departure_time ASC";



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
			
			$departures[$key]['reserved'] = $total;
			$departures[$key]['blocked'] = $total_blocked;
			$departures[$key]['available'] = $departure['boat_passengers'] - $total_blocked;

			 $total_arr[] =  $departure['boat_passengers'] - $total_blocked;
			 $dept_time = explode(":",$departure['departure_time']);
			 
			$pagecontent.='<tr>
		<td width="66" height="28" class="ab2">'.$dept_time[0].':'.$dept_time[1].'</td>
		<td width="139" height="0" class="ab2">'.$departure['tour_name'].'</td>
		<td width="66" height="0" class="ab2_right">'.$departures[$key]['available'].'</td>
		</tr>';
		}
		
$pagecontent.='</table></td>
		</tr>
		</table>
		</div>
		
		</td>
		</tr>
		</table></td>
		</tr>
		</table></td>
		</tr>
		</table></td>';

			
//		print_r($departures);
        $smarty->assign("calendar_data",$pagecontent);
		$smarty->assign("error",$error);
		$smarty->assign("status",$status);
		$smarty->assign("history_id",$history_id);
		$smarty->assign("company_image_path",$_SESSION["companyimagepath"]);
		$smarty->assign("current_reseller_id",$current_reseller_id);
		$smarty->assign("departures",$departures);
		$smarty->assign("tickets",$tickets);
		$smarty->assign("valid_tickets",$valid_tickets);
		
		
//		$smarty->assign("unixtime",time());
	
		$smarty->assign("pages_dir","reseller_booking");
		$smarty->assign("page","bookings_calender");
		$smarty->display('cms_resellers.tpl');	

if($_REQUEST['type'] == "Show_Popup")
{
   $vdate = $_REQUEST['vdate'];
echo '<script>
	  showPopupnew("300","350","'.$vdate.'");
      </script>';
}

?>

