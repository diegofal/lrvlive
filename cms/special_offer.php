<?
// includere smarty :
include "check_login.php";

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

//definire obiect utils
$utils = new x3_utils;

//initializez variabilele nedefinite
//$utils->set_get_var($subpage, "subpage","calendar");
//$utils->set_get_var($month, "month", 0);

//delete 
//GENII здесь дописать удаление departures, boats, tickets
if (@$_GET['option'] == 'delete' && !empty($_GET['OfferId']) && is_numeric($_GET['OfferId'])){
	$query = "DELETE FROM $db->special_offer WHERE OfferId = '".trim($_GET['OfferId'])."'";
	$db->delete_field($db->package, "", "", $query);

		
		/*-MAKING XML-*/
		$xmlStr = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		$xmlStr .= "<slideshow>";
		$query 			= "SELECT * FROM $db->special_offer"; 
		$fields 		= array("OfferId", "OfferTitle","OfferDescription");
		$special_offer  = $db->select_fields($db->special_offer,$query, $fields,"","","OfferId", "", "");
		foreach($special_offer as $Sindex=>$svalue)
		{
			$nodeHeading = htmlentities(trim($svalue['OfferTitle']),ENT_QUOTES);
			$nodeContent = str_replace("...", "", $smarty->smarty_modifier_truncate(strip_tags(trim(stripslashes(html_entity_decode($svalue['OfferDescription'])))),65));
			$nodeContent = str_replace("\"", "'", $nodeContent);
			$nodeLink = "http://www.londonribvoyages.com/special_offer.php?ID=".$svalue['OfferId'];
			$xmlStr .= "<photos heading=\"".$nodeHeading."\" content=\"".$nodeContent."\" link=\"".$nodeLink."\" />";
		}
		$xmlStr .= "</slideshow>";
		$xmlStr = utf8_encode($xmlStr);		
		
		//$filename = '/var/www/sites/londonribvoyages.com/www/offers.xml';
		$filename = '../offers.xml';
		
		if (!file_exists($filename)) { echo "Error: The file $filename could not be found! Please, contact system administrator."; exit(); }
		if (!is_writable($filename)) { echo "Error: The file $filename is not writable! Please, contact system administrator."; exit(); }
		
		if (!$handle = fopen($filename, 'w')) { echo "Error: Cannot open file ($filename). Please, contact system administrator."; exit();}
		if (fwrite($handle, $xmlStr) === FALSE) { echo "Error: Cannot write to file ($filename). Please, contact system administrator."; exit();}
		fclose($handle);
		 
		/*-END OF MAKING XML-*/

	header("Location: special_offer.php");
	exit();
}



// setare variabile :
$utils->set_get_var($start, "start", 0);
$utils->set_get_var($order, "order", "OfferId");

//view calendar
//if(!empty($_GET['mark'])){
//	$db->edit_field($db->order, array("order_used"=>1), "order_id", $_GET['mark']);
//}

//$query_add = "AND package_del = 0";
//if(isset($_GET['filter']) && is_numeric($_GET['filter'])){
//	$query_add = " AND order_used ='".$_GET['filter']."'";
//}

$query = "SELECT * FROM $db->special_offer"; 

$total_records = $db->get_num_rows($db->special_offer, $query);

//generate table head
$head_fields = array("OfferId"=>"Special Offer ID","OfferTitle"=>"Special Offer Name");

$head = $utils->head_table_new($head_fields, "special_offer.php", "order", "OfferId|ASC", "table-header", "table-headerUp", "table-headerDwn");
$smarty->assign("head",$head);

// generarea link-urilor de navigare :
$navigator = $utils->navigate_text($total_records, $start, PER_PAGE, "special_offer.php", "submenu", 5);
$smarty->assign("navigator",$navigator);


$fields = array("OfferId", "OfferTitle");
$special_offer = $db->select_fields($db->special_offer,$query, $fields,"","","OfferId", $start, PER_PAGE);

$smarty->assign("special_offers",$special_offer);

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","editor");
$smarty->assign("page","special_offer");
$smarty->display('cms_pages.tpl');

?>
