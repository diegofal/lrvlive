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
//GENII §¤¥áì ¤®¯¨á âì ã¤ «¥­¨¥ departures, boats, tickets
if (@$_GET['option'] == 'delete' && !empty($_GET['Tid']) && is_numeric($_GET['Tid'])){
	$query = "DELETE FROM $db->testimonials WHERE Tid = '".trim($_GET['Tid'])."'";
	$db->delete_field($db->testimonials, "", "", $query);
	
	/*-MAKING XML-*/
		$xmlStr = "<?xml version='1.0' encoding='ISO-8859-1'?>";
		$xmlStr .= "<slideshow>";
		$xmlStr .= "<photos url='http://www.londonribvoyages.com/img/testimonial/thumb/logo_london_eye.jpg' content='' />";
		$query 			= "SELECT * FROM $db->testimonials"; 
		$fields 		= array("Tid","TesimonialImage","TestimonialDesc");
		$Testimonial	= $db->select_fields($db->special_offer,$query, $fields,"","","Tid", "", "");
		foreach($Testimonial as $Tindex=>$Tvalue)
		{
		$xmlStr .="<photos url='http://www.londonribvoyages.com/img/testimonial/thumb/".$Tvalue['TesimonialImage']."' content='".htmlentities(strip_tags(trim(stripslashes($Tvalue['TestimonialDesc']))),ENT_QUOTES)."' />";
		}
		$xmlStr .= "</slideshow>";
		//echo $xmlStr; exit();
		
		//$filename = $FS_PATH.'../slideshow.xml';
		$filename = '/var/www/sites/londonribvoyages.com/www/slideshow.xml';
		
		if (is_writable($filename)) 
		{
			if (!$handle = fopen($filename, 'w')) 
			{
				echo "Cannot open file ($filename)";
				exit;
			}
			// Write $somecontent to our opened file.
			if (fwrite($handle, $xmlStr) === FALSE) 
			{
				echo "Cannot write to file ($filename)";
				exit;
			}
				fclose($handle);
		} 
		else {
			echo "The file $filename is not writable";
		}
		/*-END OF MAKING XML-*/
		
	header("Location: testimonial.php");
	exit();
}



// setare variabile :
$utils->set_get_var($start, "start", 0);
$utils->set_get_var($order, "order", "Tid");

//view calendar
//if(!empty($_GET['mark'])){
//	$db->edit_field($db->order, array("order_used"=>1), "order_id", $_GET['mark']);
//}

//$query_add = "AND package_del = 0";
//if(isset($_GET['filter']) && is_numeric($_GET['filter'])){
//	$query_add = " AND order_used ='".$_GET['filter']."'";
//}

$query = "SELECT * FROM $db->testimonials"; 

$total_records = $db->get_num_rows($db->testimonials, $query);

//generate table head
$head_fields = array("Tid"=>"Testimonial ID","TesimonialImage"=>"Testimonial Image");

$head = $utils->head_table_new($head_fields, "testimonial.php", "order", "Tid|ASC", "table-header", "table-headerUp", "table-headerDwn");
$smarty->assign("head",$head);

// generarea link-urilor de navigare :
$navigator = $utils->navigate_text($total_records, $start, PER_PAGE, "testimonial.php", "submenu", 5);
$smarty->assign("navigator",$navigator);


$fields = array("Tid", "TesimonialImage");
$testimonials = $db->select_fields($db->testimonials,$query, $fields,"","","Tid", $start, PER_PAGE);

$smarty->assign("testimonials",$testimonials);

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","editor");
$smarty->assign("page","testimonial");
$smarty->display('cms_pages.tpl');

?>