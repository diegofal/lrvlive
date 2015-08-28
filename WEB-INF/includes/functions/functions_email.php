<?
require_once (ROOT_PATH."/WEB-INF/includes/classes/mail_queue.php");

$emails = $db->select_fields($db->email, "", array('order_user','order_user2','order_admin','order_modified', 'voucher_user', 'voucher_admin', 'feedback', 'thames_festival_blast'));
$emails = $emails[0];

function send_confirmation_mail_voucher($adr_to, $unique_code) {
    global $db, $emails;

    $voucher_order = $db->select_fields($db->voucher_order, "", "", 'voucher_order_unique_code', $unique_code, "", "", "", 1);

    $this_id = $unique_code;

    $query = "SELECT * FROM $db->voucher_order, $db->voucher, $db->tour
              WHERE  voucher_order_voucher_id = voucher_id
              AND voucher_tour_id = tour_id
              AND voucher_order_unique_code = '".$this_id."'";
    $fields = array("voucher_order_id", "voucher_order_date", "voucher_order_to", "voucher_order_tickets_number",
                    "voucher_order_phone", "voucher_order_email", "voucher_order_number", "voucher_name", "voucher_tour_id", "tour_name",
                    "voucher_order_phone_to", "voucher_order_name", "voucher_order_name_to", "voucher_order_address1_to", "voucher_order_message");
    $voucher_order = $db->select_fields($db->order, $query, $fields, "", "", "", "", "", 1);

	$msg_body = $emails['voucher_user'];
	$admin_msg_body = $emails['voucher_admin'];

	$pier = "";

	if ($voucher_order['voucher_tour_id'] == "12" || $voucher_order['voucher_tour_id'] == "21" || $voucher_order['voucher_tour_id'] == "23" || $voucher_order['tour_id'] == "28") //Different email for st katerines dock.
        $pier = "Be sure to check-in with an LRV staff member at St Katharine’s Pier, <strong>at least 10 minutes</strong> before your scheduled sailing.";
    else if ($voucher_order['voucher_tour_id'] == "24" || $voucher_order['voucher_tour_id'] == "25")
		$pier = "Be sure to check-in with an LRV staff member at St Katharine’s Pier, <strong>at least 10 minutes</strong> before your scheduled sailing.";
    else
        $pier = "N.B Please be sure to check-in with an LRV staff member at Boarding Gate 1, London Eye, Waterloo Millennium Pier, <strong>at least 15 minutes</strong> before sailing.";

	$msg = "<p><strong>Name of person to receive this Voucher :</strong> ".$voucher_order['voucher_order_to']."<br>
			<strong>Phone number of receiver:</strong> ".$voucher_order['voucher_order_phone_to']."<br>
			<strong>Email of sender:</strong> ".$voucher_order['voucher_order_email']."<br>
			<strong>Name of sender:</strong> ".$voucher_order['voucher_order_name']."<br>
			<strong>Telephone of sender:</strong> ".$voucher_order['voucher_order_phone']."<br>
			<strong>Name of the person voucher to be posted to:</strong> ".$voucher_order['voucher_order_name_to']." <br>
			<strong>Address of where the voucher is to be posted:</strong> ".$voucher_order['voucher_order_address1_to']."<br>
			<strong>Message from sender:</strong> ".$voucher_order['voucher_order_message']." <br>
			<br>
			<strong>The voucher number is:</strong> ".$voucher_order['voucher_order_number']."<br></p>
			";


	$msg2 = "<p>A voucher has been purchased on the ".$voucher_order['voucher_order_date']." by ".$voucher_order['voucher_order_to']." for ".$voucher_order['voucher_order_tickets_number']." people for the ".$voucher_order['tour_name'].". <br>
			<br>
			The voucher number is: ".$voucher_order['voucher_order_number']."<br>
			<br>
			<br>
			You can also view this voucher details here: http://".$_SERVER['SERVER_NAME']."/cms/view_voucher_details.php?code=".$unique_code."</p>";

	$to  = $adr_to ;

//echo $pier."<br><br><br>";

//echo $msg_body."<br><br><br>";
	$user_message = preg_replace(array("/%%DETAILS%%/", "/%%PIER%%/"),
						array($msg, $pier),
						$msg_body);	
	$admin_message = preg_replace(array("/%%DETAILS%%/"),
						array($msg2),
						$admin_msg_body);
	$subject_flag = (TESTING?"[TEST] ":"");


//echo $user_message."<br><br><br>";

	Mail_Queue::put(
			"VOUCHER",
			"FRONT",
			$adr_to,
			$subject_flag."LRV Voucher",
			$user_message,
			$voucher_order['voucher_order_id'],
			COMPANY_EMAIL_FROM_BOOKINGS);
	
	Mail_Queue::put(
			"VOUCHER",
			"FRONT",
			COMPANY_EMAIL_CONFIRMATIONS,
			$subject_flag."LRV Voucher Purchase",
			$user_message,
			$voucher_order['voucher_order_id'],
			COMPANY_EMAIL_FROM_BOOKINGS);
	
}


function send_confirmation_mail($adr_to, $mail_name, $unique_code) {
    global $db, $COUNTRIES, $emails;

    $this_id = $unique_code;

    $query = "SELECT * FROM $db->order, $db->departure, $db->boat, $db->tour
              WHERE  order_departure_id = departure_id
              AND departure_boat_id = boat_id
              AND departure_tour_id = tour_id
              AND order_unique_code = '".$this_id."'";
    $fields = array("order_id","order_reseller_id","order_date","order_unique_code","order_title","order_first_name","order_last_name",
                "order_street_address1", "order_street_address2", "order_city", "order_zip", "order_country",
                "order_phone", "order_email", "order_tickets", "order_quantities", "order_total", 
                "departure_date", "departure_time", "boat_name", "tour_id", "tour_name");
    $order = $db->select_fields($db->order, $query, $fields, "", "", "", "", "", 1);


    if(empty($order['order_id'])) die('This thicket does not exist!');

    $tickets_type = explode("|", $order['order_tickets']);
    $tickets_nr = explode("|", $order['order_quantities']);

    $tickets = $db->select_fields($db->ticket);

    $tmp = array ('ticket_id' => 0,  'ticket_type' => 'Charter',  'ticket_price' => $order['order_total'],  'ticket_del' => 0 );
    $tickets[] = $tmp;
    
    $reseller = get_reseller_name($order);


    $msg_body = "";
    
    if ($order['tour_id'] == "12" || $order['tour_id'] == "21" || $order['tour_id'] == "23" || $order['tour_id'] == "28") //Different email for st katerines dock.
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


	$footer = "";

	if ($order['tour_id'] == "1" || $order['tour_id'] == "9") {
		$footer = "<p>Looking for other great experiences in London?  We can only recommend...</p>
		<p>
						<a href='http://www.theghostbustours.com/' target='_blank'>
							<img src='http://www.theghostbustours.com/edn/images/edinburg_index.jpg' border='0' width='185px' alt='The Ghost Bus Tours' />
						</a>
						<a href='http://www.londonducktours.co.uk/' target='_blank'>
							<img src='http://www.londonribvoyages.com/img/email/Ducks.jpg' border=0 width='100px' alt='London Duck Tours' />
						</a>
						<a href='http://www.jerseyboyslondon.com/' target='_blank'>
							<img src='http://collider.com/wp-content/uploads/jersey-boys-image.jpg' border=0 width='140px' alt='Jersey Boys' />
						</a>
						<a href='http://www.therainforestcafe.co.uk/' target='_blank'>
							<img src='http://orlandotouristtips.com/wp-content/uploads/Rainforest-Cafe.jpg' border=0 width='232px' alt='Rainforest Cafe' />
						</a>
						<a href='http://www.tallyhocycletours.com/' target='_blank'>
							<img src='http://www.londonribvoyages.com/img/email/TallyHoCycleTours.png' border='0' width='232px' alt='Tally Ho! Cycle Tours' />
						</a>
						</p>";
	}


	$msg .= "\n";
	$comments = "";
	$user_message = preg_replace(array("/(<img[^>]*?src=['\"])(\/.*?)(['\"][^>]*?>)/", "/%%DETAILS%%/", "/%%USERNAME%%/", "/%%COMMENTS%%/", "/%%FOOTER%%/"),
						array("\\1http://".$_SERVER['SERVER_NAME']."\\2\\3", $msg, $mail_name, $comments, $footer),
						$msg_body);

	$msg2 = "<p><strong>Date of Voyage:</strong> ".date("d F Y",strtotime($order['departure_date']))."<br>
			<strong>Departure Time:</strong> ".substr($order['departure_time'],0,5)." (Please ensure you arrive <strong>15 minutes</strong> prior to your trips departure)<br>
			<strong>Tickets Purchased:</strong> 
			\n";

    $_ticket_types = array();
    $_tickets = array();
    foreach($tickets as $ticket){
        if (in_array($ticket['ticket_id'],$tickets_type)) $_ticket_types [] = $ticket['ticket_type'];
    }
    foreach($tickets_nr as $value) {
        $_tickets [] = $value;
    }

	for ($i=0; $i<sizeof($_ticket_types); $i++){
		$msg2 .= $_ticket_types[$i]." : ".$_tickets[$i]."\n";
	}

	$msg2 .= "<br><strong>Total Cost:</strong> ".$order['order_total']."<br>
			<strong>Type of booking:</strong> ".$reseller."<br>
			<strong>Booking Code:</strong> ".$order['order_id']."<br>
			<strong>Booking Date:</strong> ".date("m.d.Y",strtotime($order['order_date']))."<br>
			<br><br>
			<strong>Billing Name and Address:</strong><br>
			".$order['order_first_name']." ".$order['order_last_name']."<br>
			".$order['order_phone']."<br>
			<a href=\"mailto:".$order['order_email']."\">".$order['order_email']."</a><br></p>";

	$order_link = "http://www.londonribvoyages.com/cms/view_html_ticket.php?code=".$unique_code."";
	$admin_msg_body .= $emails['order_admin'];

	$admin_message =  preg_replace(array("/(<img[^>]*?src=['\"])(\/.*?)(['\"][^>]*?>)/", "/%%DETAILS%%/", "/%%LINK%%/"),
						array("\\1http://".$_SERVER['SERVER_NAME']."\\2\\3", $msg2, $order_link),
						$admin_msg_body);


	$to  = $adr_to ;
	$to = $order['order_email'];
	
	$subject_flag = (TESTING?"[TEST] ":"");
	
	Mail_Queue::put(
			"BOOKING",
			"FRONT",
			$to,
			$subject_flag."LRV Booking Confirmation",
			$user_message,
			$order['order_id'],
			COMPANY_EMAIL_FROM_BOOKINGS);
	
	Mail_Queue::put(
			"BOOKING",
			"FRONT",
			COMPANY_EMAIL_CONFIRMATIONS,
			$subject_flag."Booking Confirmation",
			$user_message,
			$order['order_id'],
			COMPANY_EMAIL_FROM_BOOKINGS);
	
	return true;	
}

function send_feedback_mail($adr_to, $order_id) { 

	global $db, $COUNTRIES, $emails;

	$query = "SELECT * FROM 
	    			departure as d 
	    				INNER JOIN orders as o ON (o.order_departure_id = d.departure_id) 
	    			WHERE o.order_id=".$order_id;
    $departure = $db->select_fields("departure", $query);

	Mail_Queue::put_feedback($adr_to, $departure[0]["departure_date"]);

	return true;
}
?>
