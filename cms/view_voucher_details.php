<?

		$this_id = $_GET['code'];			// id-ul user-ului seledctat
	// ----------------------------------------------------------------------------------------------------
	
	// functii FPDF ptr scrierea de tip HTML :
	// ----------------------------------------------------------------------------------------------------

		require_once "../WEB-INF/includes/classes/class.x3.database.php";
		require_once "../WEB-INF/includes/config.php";

		// DB connction
		$db = new DB_config;
		$db->connect();
		$query = "SELECT * FROM $db->voucher_order, $db->voucher
				  WHERE voucher_order_voucher_id = voucher_id
				  AND voucher_order_unique_code = '".$this_id."'";
		$fields = array("voucher_order_id","voucher_order_date","voucher_order_unique_code","voucher_order_to",
					"voucher_order_address1", "voucher_order_address2", "voucher_order_city", "voucher_order_postcode", "voucher_order_country",
					"voucher_order_phone", "voucher_order_email", "voucher_order_tickets", "voucher_order_quantities", "voucher_order_total", "voucher_order_number",
					"voucher_order_discounted_total", "voucher_discount", "voucher_name", "voucher_order_phone_to", "voucher_order_name", "voucher_order_name_to", "voucher_order_address1_to", "voucher_order_message");
		$voucher_order = $db->select_fields($db->voucher_order, $query, $fields, "", "", "", "", "", 1);
		
		if(empty($voucher_order['voucher_order_id'])) die('This voucher does not exist!');

		$tickets_type = explode("|", $voucher_order['voucher_order_tickets']);
		$tickets_nr = explode("|", $voucher_order['voucher_order_quantities']);

		$tickets = $db->select_fields($db->ticket);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Voucher details</TITLE>
</HEAD>
<BODY>
<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
			<b>Voucher details:<br><br></b>
			<? echo "Name of person to receive this Voucher : ".$voucher_order['voucher_order_to']."<br>";?>
			<? echo "Phone number of receiver: ".$voucher_order['voucher_order_phone_to']."<br>";?>
			<? echo "Email of sender: ".$voucher_order['voucher_order_email']."<br>";?>
			<? echo "Name of sender:: ".$voucher_order['voucher_order_name']."<br>";?>
			<? echo "Telephone of sender: ".$voucher_order['voucher_order_phone']."<br>";?>
			<? echo "Name of the person of who it is to be posted: ".$voucher_order['voucher_order_name_to']."<br>";?>
			<? echo "Address of where the voucher is to be posted: ".$voucher_order['voucher_order_address1_to']."<br>";?>
			<? echo "Message from sender: ".$voucher_order['voucher_order_message']."<br>";?>
		</td>
		<td><img src="../WEB-INF/assets/images/utils/logo_pdf.jpg" width="171" height="156" alt="logo"></td>
	</tr>
</table>
<br>
<table>
	<tr><td>
<? echo "Booking Date:</td><td> ".date("m.d.Y",strtotime($voucher_order['voucher_order_date']))."<br>";?>
	</td></tr>
	<tr><td>
<? echo "Booking Code:</td><td> ".$voucher_order['voucher_order_id']."<br>";?>
	</td></tr>
	<tr><td>
Voucher Name:</td><td><b><? echo $voucher_order['voucher_name'];?></b><br>
	</td></tr>
	<tr><td>
Voucher No:</td><td><b><? echo $voucher_order['voucher_order_number'];?></b><br>
	</td></tr>
	<tr>
		<td>
<?
		foreach($tickets as $ticket){
			if (in_array($ticket['ticket_id'],$tickets_type)) echo $ticket['ticket_type'].":<br>";
		}
?>
		</td>
		<td>
<?
		foreach($tickets_nr as $value) {
			echo "<b>".$value."</b><br>";
		}

?>
		</td>
	</tr>
	<tr>
		<td><br>Total Cost:</td><td><br><b>&pound;<? echo $voucher_order['voucher_order_total'];?></b></td>
	</tr>
	<tr>
		<td>Discount:</td><td><b><? echo $voucher_order['voucher_discount'];?>%</b>
	</td>
	<tr>
		<td><strong>Final Price:</strong></td><td><b>&pound;<? echo $voucher_order['voucher_order_discounted_total'];?></b>
	</td>
	</tr>
</table>


</BODY>
</HTML>