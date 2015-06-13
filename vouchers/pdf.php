<?
session_start();


define('FPDF_FONTPATH','../WEB-INF/includes/classes/font/');
require('../WEB-INF/includes/classes/class.pdf.php');

class PDF extends FPDF {
	
	var $id;
	var $logo;
	
	// functie de setarea a variabilelelor utile :
	// ----------------------------------------------------------------------------------------------------
	function SetVars($code) {
		$this->id = $code;
		$this->logo = "img/logo.jpg";
	}

	function MakeVoucher() {

		//image
		$this->Image("numbers/".$this->id.".jpg", 190, 10);
		$this->Image("img/top.jpg", 40, 35);
		$this->Image($this->logo, 5, 5, 45);
		$this->Image("img/aregranted.jpg", 85, 110);
		$imagesize = getimagesize("names/".$this->id.".jpg");
		$x = (148 - (int)(ceil($imagesize[0]/6)));
		$this->Image("names/".$this->id.".jpg", $x, 93);
		$this->Image("img/lrv-text.jpg", 90, 127);
		$this->Image("dates/".$this->id.".jpg", 32, 142);
		$this->Image("img/btext.jpg", 45, 160);
		$this->Image("img/signature.jpg", 190, 145);
		$this->Image("img/line.jpg", 35, 142);
	

	}
	// ----------------------------------------------------------------------------------------------------
}


if (!isset($_GET['code']) || empty($_GET['code'])) die ('error');
	else $code = $_GET['code'];


		require_once "../WEB-INF/includes/classes/class.x3.database.php";
		require_once "../WEB-INF/includes/config.php";

		// DB connction
		$db = new DB_config;
		$db->connect();
		$query = "SELECT * FROM $db->voucher_order, $db->voucher
				  WHERE voucher_order_voucher_id = voucher_id
				  AND voucher_order_unique_code = '".$code."'";
		$fields = array("voucher_order_id","voucher_order_date","voucher_order_unique_code","voucher_order_to",
					"voucher_order_address1", "voucher_order_address2", "voucher_order_city", "voucher_order_postcode", "voucher_order_country",
					"voucher_order_phone", "voucher_order_email", "voucher_order_tickets", "voucher_order_quantities", "voucher_order_total", "voucher_order_number",
					"voucher_order_discounted_total", "voucher_discount", "voucher_name");
		$voucher_order = $db->select_fields($db->voucher_order, $query, $fields, "", "", "", "", "", 1);
		if(empty($voucher_order['voucher_order_id'])) die('This voucher does not exist!');


$pdf = new PDF("L","mm","A4");
$pdf->AddPage();
$pdf->SetVars($code);
$pdf->MakeVoucher();

// ptr a face download la fisier :
$pdf->Output("lrv_voucher.pdf", "D");

















?>