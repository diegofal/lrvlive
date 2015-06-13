<?
// includere smarty :
include "check_login.php";

// se include clasa de generare excel :
require_once "../WEB-INF/includes/classes/class.x3.excel.php";

$xls = new x3_excel;

if ($_POST['type'] == 'year') {
    $query = "
    SELECT 
        date_format( d.departure_date, '%b' ) AS 'Month', count( * ) AS 'Amount of trips', sum( r.order_total ) AS 'Total income'
    FROM
        $db->order AS r, $db->departure AS d
    WHERE
            r.order_departure_id = d.departure_id
        AND year( d.departure_date ) = '" . intval($_POST['Date_Year']) . "'
    GROUP BY month( d.departure_date ) 
    ORDER BY month( d.departure_date ) 
    ";
    $array_head = array('Month'=>'other', 'Amount of trips'=>'other', 'Total income'=>'other');
    error_reporting(0);
    $array_fields = array('Month', 'Amount of trips', 'Total income');
    $xls->xls_generate_from_table($db->order, "Year_" . $_POST['Date_Year'] . '_report', $array_fields, $array_head, $query);
    exit();
}


if(!empty($_POST['per_boat'])) {


$query_where = "";
if($_POST['type'] == "month") {
    //$date = date("Y-m-d", mktime(0, 0, 0, date("m")-$_POST['months'], date("d"), date("Y")));
    //$query_where = " WHERE order_date >= '".$date."'";
    $date_start = $_POST['monthsYear'].'-'.$_POST['monthsMonth'].'-01';
    $date_stop = $_POST['monthsYear'].'-'.$_POST['monthsMonth'].'-31';
    $query_where = " WHERE departure_date >= '".$date_start."' AND departure_date <= '".$date_stop."'";
} else
if($_POST['type'] == "order_date") {
    //$date = date("Y-m-d", mktime(0, 0, 0, date("m")-$_POST['months'], date("d"), date("Y")));
    //$query_where = " WHERE order_date >= '".$date."'";
    $_POST['orderYear'] = date('Y');
    $date_start = $_POST['monthsYear'].'-'.$_POST['monthsMonth'].'-01';
    $date_stop = $_POST['orderYear'].'-'.$_POST['orderMonth'].'-31';
    $query_where = " WHERE order_date >= '".$date_start."' AND order_date <= '".$date_stop."'";
} else {
    $date = $_POST['selYear'].'-'.$_POST['selMonth'].'-'.$_POST['selDay'];
    $query_where = " WHERE departure_date = '".$date."'";
}


$query = "SELECT *
          FROM $db->order, $db->departure, $db->boat, $db->tour".
          $query_where.
          " AND order_departure_id=departure_id 
			AND departure_boat_id = boat_id 
			AND departure_tour_id = tour_id
			ORDER BY departure_date ASC, boat_id ASC";


$values = $db->select_fields($db->order, $query, array("order_id", "order_date", "order_departure_id", "order_tickets", "order_quantities", "order_tickets_number", "order_total", "order_payd", "departure_boat_id", "departure_date", "boat_name", "boat_passengers", "boat_id", "tour_name"));
//    error_reporting (0);
    $dates = array ();
    foreach ($values as $k=>$v) {


        $dates[$v['departure_date']]['boat_id'][] = $v['boat_id'];
        $dates[$v['departure_date']]['boat_name'][] = $v['boat_name'];
        $dates[$v['departure_date']]['tour_name'][] = $v['tour_name'];
		if ($v['order_tickets'] == 0 )
	        $dates[$v['departure_date']]['order_tickets_number'][] = $v['boat_passengers'];
		else 
	        $dates[$v['departure_date']]['order_tickets_number'][] = $v['order_tickets_number'];
        $dates[$v['departure_date']]['order_total'][] = $v['order_total'];
    }


    $j = 0;
    foreach ($dates as $date=>$value) {
            if (is_array ($value['boat_name'])) {
                for ($i=0;$i<sizeof($value['boat_name']); $i++){
                if ($_tmp_date == $date && $_tmp_boat_id == $value['boat_id'][$i]) {

                    $final[$j]['total_seats'] += $value['order_tickets_number'][$i];
                    $final[$j]['total'] += $value['order_total'][$i];
                    $final[$j]['total'] = sprintf("%0.2f",$final[$j]['total']);

                    
                } else {
        
                    $j++;
                    $final[$j]['date'] = $date;
                    $final[$j]['boat_name'] = $value['boat_name'][$i];
                    $final[$j]['tour_name'] = $value['tour_name'][$i];
                    $final[$j]['boat_id'] = $value['boat_id'][$i];
                    $final[$j]['total_seats'] = $value['order_tickets_number'][$i];
                    $final[$j]['total'] = sprintf("%0.2f",$value['order_total'][$i]);


                }
                    $_tmp_boat_name = $value['boat_name'][$i];
                    $_tmp_date = $date;
                    $_tmp_boat_id = $value['boat_id'][$i];
                }
            }
            $j++;
        }


    foreach ($final as $o=>$p) {

		$query = "SELECT COUNT(departure_id) as departures FROM $db->departure, $db->boat WHERE departure_date = '".$p['date']."' AND departure_boat_id = boat_id AND boat_id = '".$p['boat_id']."'";
		$value = $db->select_field($db->departure, "departures", "", $query);
		$final[$o]['departures'] = $value[0];
	}

$array_head = array('Date'=>'date','Boat'=>'text', 'Tour'=>'text', 'Total seats'=>'number', 'Total departures'=>'number', 'Total sales'=>'other');
$array_fields = array("date", "boat_name", "tour_name", "total_seats", "departures", "total");
$xls->xls_generate_from_array($final, "per_boat_report", $array_fields, $array_head);
//print_r($final);

} else {


// setare date de extragere :
$array_fields = array('order_id','order_title','order_first_name','order_last_name');

$array_head = array('Order ID'=>'number','Title'=>'text',
                    'First Name'=>'text', 'Last Name'=>'text');
                    
if(!empty($_POST['order'])) {
    $array_fields[] = "order_date";
    $array_head['Date'] = "date";
}
if(!empty($_POST['address'])) {
    $array_fields[] = "order_street_address1";
    $array_head['Address1'] = "text";
    $array_fields[] = "order_street_address2";
    $array_head['Address2'] = "text";
    $array_fields[] = "order_city";
    $array_head['City'] = "text";
    $array_fields[] = "order_zip";
    $array_head['Zip'] = "text";
    $array_fields[] = "order_country";
    $array_head['Country'] = "text";

}
if(!empty($_POST['phone'])) {
    $array_fields[] = "order_phone";
    $array_head['Phone'] = "text";
}
if(!empty($_POST['email'])) {
    $array_fields[] = "order_email";
    $array_head['Email'] = "text";
}
if(!empty($_POST['total'])) {
    $array_fields[] = "order_total";
    $array_head['Total'] = "other";
}
if(!empty($_POST['payment'])) {
    $array_fields[] = "order_method";
    $array_head['Payment'] = "text";
}
if(!empty($_POST['reseller'])) {
    $array_fields[] = "order_reseller_name";
    $array_head['Reseller'] = "text";
    
    $array_fields[] = "order_reseller_commission";
    $array_head['Commision'] = "other";
}
if(!empty($_POST['find'])) {
    $array_fields[] = "order_find";
    $array_head['How did you find us?'] = "text";
}
$query_where = "";
if($_POST['type'] == "month") {
    //$date = date("Y-m-d", mktime(0, 0, 0, date("m")-$_POST['months'], date("d"), date("Y")));
    //$query_where = " WHERE order_date >= '".$date."'";
    $date_start = $_POST['monthsYear'].'-'.$_POST['monthsMonth'].'-01';
    $date_stop = $_POST['monthsYear'].'-'.$_POST['monthsMonth'].'-31';
    $query_where = " WHERE departure_date >= '".$date_start."' AND departure_date <= '".$date_stop."'";
} else
if($_POST['type'] == "order_date") {
    //$date = date("Y-m-d", mktime(0, 0, 0, date("m")-$_POST['months'], date("d"), date("Y")));
    //$query_where = " WHERE order_date >= '".$date."'";
    $query_where = " WHERE month(order_date) = ".intval($_POST['orderMonth'])." AND year(order_date) = year(now())";
} else {
    $date = $_POST['selYear'].'-'.$_POST['selMonth'].'-'.$_POST['selDay'];
    $query_where = " WHERE departure_date = '".$date."'";
}

if(!empty($_POST['payment_filter']) && ($_POST['payment_filter']!="all") && !empty($_POST['payment']))
{
    $query_where .= " AND order_method = '".$_POST['payment_filter']."'";
}

if(empty($_POST['reseller']))
{
    $query_where .= " AND order_reseller_id =-1";
}
elseif (!empty($_POST['reseller']) && !empty($_POST['reseller_filter']) && $_POST['reseller_filter']!="all"){
    $query_where .= " AND (order_reseller_name='".$_POST['reseller_filter']."' OR order_reseller_name='".$_POST['reseller_filter'].".')";
    //Quick fix point for some resellers name that holds a . after
}

// generare excel :
$query = "SELECT *  
          FROM $db->order, $db->departure".
          $query_where.
          " AND order_departure_id=departure_id";
//echo $query; die();
if ('order_date' == $_POST['type']) {
    $report_name = "order_date_reports";
} else {
    $report_name = "customer_reports";
}


        //echo $query;
        //die();



$xls->xls_generate_from_table($db->order, $report_name, $array_fields, $array_head, $query);
}
?>