<?php
if (!isset($_GET['code']) || empty($_GET['code'])) 
	die ('error');
else 
	$code = $_GET['code'];

        require_once "../WEB-INF/includes/classes/class.x3.database.php";
        require_once "../WEB-INF/includes/config.php";

        // DB connction
        $db = new DB_config;
        $db->connect();

        $this_id = $code;
		/*Fetching Email*/
		$emails = $db->select_fields($db->email, "", array('order_user','order_user2','order_admin','order_modified', 'voucher_user', 'voucher_admin', 'feedback', 'thames_festival_blast'));
        $emails = $emails[0];
						
        $query = "SELECT * FROM $db->order, $db->departure, $db->boat, $db->tour
                  WHERE  order_departure_id = departure_id
                  AND departure_boat_id = boat_id
                  AND departure_tour_id = tour_id
                  AND order_unique_code = '".$code."'";
        $fields = array("order_id","order_reseller_id","order_date","order_unique_code","order_title","order_first_name","order_last_name",
                    "order_street_address1", "order_street_address2", "order_city", "order_zip", "order_country",
                    "order_phone", "order_email", "order_tickets", "order_quantities", "order_total", 
                    "departure_date", "departure_time", "boat_name", "tour_id", "tour_name");
        $order = $db->select_fields($db->order, $query, $fields, "", "", "", "", "", 1);
		$mail_name = $order['order_first_name']." ".$order['order_last_name'];

        if(empty($order['order_id'])) die('This thicket does not exist!');

        $tickets_type = explode("|", $order['order_tickets']);
        $tickets_nr = explode("|", $order['order_quantities']);

        $tickets = $db->select_fields($db->ticket);
//
        $tmp = array ('ticket_id' => 0,  'ticket_type' => 'Charter',  'ticket_price' => $order['order_total'],  'ticket_del' => 0 );
        $tickets[] = $tmp;
        
        $reseller = get_reseller_name($order);
		
        $msg_body = "";
        if ($order['tour_id'] == "12" || $order['tour_id'] == "21" || $order['tour_id'] == "23") //Different email for st katerines dock.
            $msg_body = $emails['order_user2'];
        else if ($order['tour_id'] == "24" || $order['tour_id'] == "25")
            $msg_body = $emails['thames_festival_blast'];
        else
            $msg_body = $emails['order_user'];

        $msg = "<p><strong>Date of Voyage:</strong> ".date("d F Y",strtotime($order['departure_date']))."<br>
                <strong>Departure Time:</strong> ".substr($order['departure_time'],0,5)." (Please ensure you arrive <strong>15 minutes</strong> prior to your trips departure)<br>";
              
        
        $msg .= "<strong>Tickets Purchased:</strong>\n";

        $_ticket_types = array();
        $_tickets = array();
        foreach($tickets as $ticket){
            if (in_array($ticket['ticket_id'],$tickets_type)) $_ticket_types [] = $ticket['ticket_type'];
        }
        foreach($tickets_nr as $value) {
            $_tickets [] = $value;
        }

    for ($i=0; $i<sizeof($_ticket_types); $i++){
        $msg .= $_ticket_types[$i]." : ".$_tickets[$i]."\n";
    }
$msg .= "<br><strong>Total Cost:</strong> ".$order['order_total']."<br>
<strong>Type of booking:</strong> ".$reseller."<br>
<strong>Booking Code:</strong> ".$order['order_id']."<br>
<strong>Booking Date:</strong> ".date("m.d.Y",strtotime($order['order_date']))."<br>
<br><br>
<strong>Billing Name and Address:</strong><br>
".$order['order_first_name']." ".$order['order_last_name']."<br>
".$order['order_phone']."<br>
<a href=\"mailto:".$order['order_email']."\">".$order['order_email']."</a><br></p>";


$msg .= "\n";
$comments = "";
$user_message = preg_replace(array("/(<img[^>]*?src=['\"])(\/.*?)(['\"][^>]*?>)/", "/%%DETAILS%%/", "/%%USERNAME%%/", "/%%COMMENTS%%/"),
						array("\\1http://".$_SERVER['SERVER_NAME']."\\2\\3", $msg, $mail_name, $comments),
						$msg_body);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>LRV Booking Confirmation</title>
                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    </head>
<body onload="window.print()">
<?php echo $user_message ?>
</body>
</html>