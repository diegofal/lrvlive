<?
require_once (ROOT_PATH."/WEB-INF/includes/classes/mail_queue.php");

$emails = $db->select_fields($db->email, "", array('order_user','order_user2','order_admin','order_modified', 'voucher_user', 'voucher_admin', 'feedback', 'thames_festival_blast'));
$emails = $emails[0];

function send_confirmation_mail($adr_to, $mail_name, $unique_code, $comments="") {
	global $db, $COUNTRIES, $emails;

	$query = "SELECT * FROM $db->order, $db->departure, $db->boat, $db->tour
	WHERE  order_departure_id = departure_id
	AND departure_boat_id = boat_id
	AND departure_tour_id = tour_id
	AND order_unique_code = '".$unique_code."'";
	$fields = array("order_id","order_reseller_id","order_date","order_unique_code","order_title","order_first_name","order_last_name",
			"order_street_address1", "order_street_address2", "order_city", "order_zip", "order_country",
			"order_phone", "order_email", "order_tickets", "order_quantities", "order_total",
			"departure_date", "departure_time", "boat_name", "tour_id", "tour_name");
	$order = $db->select_fields($db->order, $query, $fields, "", "", "", "", "", 1);

	$tickets_type = explode("|", $order['order_tickets']);
	$tickets_nr = explode("|", $order['order_quantities']);

	$tickets = $db->select_fields($db->ticket);
	$reseller = get_reseller_name($order);

	$tmp = array ('ticket_id' => 0,  'ticket_type' => 'Charter',  'ticket_price' => $order['order_total'],  'ticket_del' => 0 );
	$tickets[] = $tmp;

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
	<strong>Booking Date:</strong> ".date("d.m.Y",strtotime($order['order_date']))."<br>
	<br><br>
	<strong>Billing Name and Address:</strong><br>
	".$order['order_first_name']." ".$order['order_last_name']."<br>
	".$order['order_phone']."<br>
	<a href=\"mailto:".$order['order_email']."\">".$order['order_email']."</a><br></p>";


	$msg .= "\n";

	$footer = "";

	if ($order['tour_id'] == "1" || $order['tour_id'] == "9") {
		$footer = "<p>Looking for other great experiences in London?  We can only recommend...</p>
		<p>
						<a href='http://www.theghostbustours.com/' target='_blank'>
							<img src='http://www.theghostbustours.com/edn/images/edinburg_index.jpg' border='0' width='185px' alt='The Ghost Bus Tours' />
						</a>
						<a href='http://www.londonducktours.co.uk/' target='_blank'>
							<img src='http://blogs.whatsontv.co.uk/movietalk/files/2012/11/13245-Master-DUCK-TOURS-Logo-CMYK1.jpg' border=0 width='100px' alt='London Duck Tours' />
						</a>
						<a href='http://www.jerseyboyslondon.com/' target='_blank'>
							<img src='http://collider.com/wp-content/uploads/jersey-boys-image.jpg' border=0 width='140px' alt='Jersey Boys' />
						</a>
						<a href='http://www.therainforestcafe.co.uk/' target='_blank'>
							<img src='http://orlandotouristtips.com/wp-content/uploads/Rainforest-Cafe.jpg' border=0 width='232px' alt='Rainforest Cafe' />
						</a>      </p>";
	}

	$user_message = preg_replace(array("/(<img[^>]*?src=['\"])(\/.*?)(['\"][^>]*?>)/", "/%%DETAILS%%/", "/%%USERNAME%%/", "/%%COMMENTS%%/", "/%%FOOTER%%/"),
			array("\\1http://".$_SERVER['SERVER_NAME']."\\2\\3", $msg, $mail_name, nl2br($comments), $footer),
			$msg_body);

	$to  = $adr_to ;
	$subject_flag = (TESTING?"[TEST] ":"");

	/*$headers = 'From: bookings@londonribvoyages.com' . "\r\n" .
			'Reply-To: bookings@londonribvoyages.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();*/

	Mail_Queue::put(
			"BOOKING",
			"CMS-EDIT",
			$to,
			$subject_flag."LRV Booking Confirmation",
			$user_message,
			$order['order_id'],
			COMPANY_EMAIL_FROM_BOOKINGS);

	return true;
}
?>