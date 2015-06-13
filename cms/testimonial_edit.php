<?

// includere smarty :
include "check_login.php";

include("FCKeditor/fckeditor.php");

if (isset($_REQUEST['Tid'])) $Tid = (int)$_REQUEST['Tid'];

//	
if (isset($_POST) && @$_POST['do']=="add") {
		unset($_POST['do']);
		if (!isset($error)) {
			$db->insert_field($db->testimonials, $_POST);	
			$Tid = $db->mysqlinsertid();
			if (!empty($_FILES['TesimonialImage']['name'])) $db->insert_file($db->testimonials, "Tid", $Tid, "TesimonialImage", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/testimonial/thumb/", "", "", "", $file_type="", $name="TesimonialImage");
		
		}
		else {
			$smarty->assign("error", $error);
		}
	}


if (isset($_POST) && @$_POST['do']=="update") {
		unset($_POST['do']);
		
		if (!isset($error)) {
			$db->edit_field($db->testimonials, $_POST, "Tid", $Tid);
			if (!empty($_FILES['TesimonialImage']['name'])) $db->insert_file($db->testimonials, "Tid", $Tid, "TesimonialImage", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/testimonial/thumb/", "", "", "", $file_type="", $name="TesimonialImage");
		
		}
		else {
			$smarty->assign("error", $error);
		}

	}



if(@$_GET['option']=="add"){
	$content = array("package_name" => "", "package_short_description" => "", "package_full_description" => "");
} elseif (isset($error) && !isset($package_id)) {
	$content = array("package_name" => $_POST['package_name'], "package_short_description" => $_POST['package_short_description'], "package_full_description" => $_POST['package_full_description']);

} else {
	$content = $db->select_fields($db->testimonials, "", "", "Tid", $Tid, "", "", "",1 );
	
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
}

/*echo "<pre>";
print_r($content);
exit();
*/
$smarty->assign("content",$content);

$oFCKeditor = new FCKeditor('TestimonialDesc') ;
$oFCKeditor->BasePath = 'FCKeditor/';
$oFCKeditor->ToolbarSet = 'MyToolbar';
$oFCKeditor->Width  = '400' ;
$oFCKeditor->Height = '300' ;
$oFCKeditor->Value = $content['TestimonialDesc'];
$output = $oFCKeditor->CreateHtml() ;
$smarty->assign("output",$output);

// asignare variabile smarty si generare fisier smarty :
//$smarty->assign("pages_dir","editor");
//$smarty->assign("page","home");
//$smarty->display('cms_pages.tpl');

// asignare variabile smarty si generare fisier smarty :

$smarty->assign("pages_dir","editor");
$smarty->assign("page","testimonial_edit");
if (isset($Tid)) $smarty->assign("Tid",$Tid);
$smarty->display('cms_pages.tpl');


?>