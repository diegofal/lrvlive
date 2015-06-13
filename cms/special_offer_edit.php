<?

// includere smarty :
include "check_login.php";

include("FCKeditor/fckeditor.php");

if (isset($_REQUEST['OfferId'])) $OfferId = (int)$_REQUEST['OfferId'];

//	
if (isset($_POST) && @$_POST['do']=="add") {
		unset($_POST['do']);
		if (!isset($error)) {
			$db->insert_field($db->special_offer, $_POST);	
			$OfferId = $db->mysqlinsertid();
			$TopImage 			= trim($_FILES['OfferTopimage']['name']);
			$TopImageTmp 		= trim($_FILES['OfferTopimage']['tmp_name']);
			$MiddleImage 		= trim($_FILES['OfferMiddleimage']['name']);
			$MiddleImageTmp 	= trim($_FILES['OfferMiddleimage']['tmp_name']);
			$BottomImage 		= trim($_FILES['OfferBottomimage']['name']);
			$BottomImageTmp 	= trim($_FILES['OfferBottomimage']['tmp_name']);
			if (!empty($_FILES['OfferTopimage']['name']))
			{
				$path_info 		= pathinfo($TopImage);
				$extension 		= $path_info["extension"];
				$TopimageName 	= time().'_top.'.$extension;
				
				$Query = "UPDATE special_offer SET 
						  OfferTopimage = '".$TopimageName."'
						  WHERE OfferId = '".$OfferId."'";
				$Result = mysql_query($Query);
				if($Result)
				{
					@move_uploaded_file($TopImageTmp,$_SERVER['DOCUMENT_ROOT']."/img/special_offer/thumb/".$TopimageName);				
				}		  
			}
			if (!empty($_FILES['OfferMiddleimage']['name']))
			{
				$path_info 			= pathinfo($MiddleImage);
				$extension 			= $path_info["extension"];
				$MiddleimageName 	= time().'_middle.'.$extension;
				
				$Query = "UPDATE special_offer SET 
						  OfferMiddleimage = '".$MiddleimageName."'
						  WHERE OfferId = '".$OfferId."'";
				$Result = mysql_query($Query);
				if($Result)
				{
					@move_uploaded_file($MiddleImageTmp,$_SERVER['DOCUMENT_ROOT']."/img/special_offer/thumb/".$MiddleimageName);				
				}		  
			}
			if (!empty($_FILES['OfferBottomimage']['name']))
			{
				$path_info 			= pathinfo($BottomImage);
				$extension 			= $path_info["extension"];
				$BottomimageName 	= time().'_bottom.'.$extension;
				
				$Query = "UPDATE special_offer SET 
						  OfferBottomimage = '".$BottomimageName."'
						  WHERE OfferId = '".$OfferId."'";
				$Result = mysql_query($Query);
				if($Result)
				{
					@move_uploaded_file($BottomImageTmp,$_SERVER['DOCUMENT_ROOT']."/img/special_offer/thumb/".$BottomimageName);				
				}		  
			}
			
			/*if (!empty($_FILES['OfferTopimage']['name'])) $db->insert_file($db->special_offer, "OfferId", $OfferId, "OfferTopimage", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/special_offer/thumb/", "", "", "", $file_type="", $name="OfferTopimage");
			if (!empty($_FILES['OfferMiddleimage']['name'])) $db->insert_file($db->special_offer, "OfferId", $OfferId, "OfferMiddleimage", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/special_offer/thumb/", "", "", "", $file_type="", $name="OfferMiddleimage");
			if (!empty($_FILES['OfferBottomimage']['name'])) $db->insert_file($db->special_offer, "OfferId", $OfferId, "OfferBottomimage", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/special_offer/thumb/", "", "", "", $file_type="", $name="OfferBottomimage");*/
		}
		else {
			$smarty->assign("error", $error);
		}
	  	
		
	}


if (isset($_POST) && @$_POST['do']=="update") {
		unset($_POST['do']);
		
		if (!isset($error)) {
			$db->edit_field($db->special_offer, $_POST, "OfferId", $OfferId);
			
			$TopImage 			= trim($_FILES['OfferTopimage']['name']);
			$TopImageTmp 		= trim($_FILES['OfferTopimage']['tmp_name']);
			$MiddleImage 		= trim($_FILES['OfferMiddleimage']['name']);
			$MiddleImageTmp 	= trim($_FILES['OfferMiddleimage']['tmp_name']);
			$BottomImage 		= trim($_FILES['OfferBottomimage']['name']);
			$BottomImageTmp 	= trim($_FILES['OfferBottomimage']['tmp_name']);
			
			if (!empty($_FILES['OfferTopimage']['name']))
			{
				$Query1 	= mysql_query("SELECT OfferTopimage FROM $db->special_offer WHERE OfferId = '".$OfferId."'");
				$Row_Img    = mysql_fetch_array($Query1);  
				$Image_name = trim($Row_Img['OfferTopimage']); 
				if($Image_name!="")
				{
					unlink($_SERVER['DOCUMENT_ROOT']."/img/special_offer/thumb/".$Image_name);
				}
				
				$path_info 		= pathinfo($TopImage);
				$extension 		= $path_info["extension"];
				$TopimageName 	= time().'_top.'.$extension;
				
				$Query = "UPDATE special_offer SET 
						  OfferTopimage = '".$TopimageName."'
						  WHERE OfferId = '".$OfferId."'";
				$Result = mysql_query($Query);
				if($Result)
				{
					@move_uploaded_file($TopImageTmp,$_SERVER['DOCUMENT_ROOT']."/img/special_offer/thumb/".$TopimageName);				
				}		  
			}
			if (!empty($_FILES['OfferMiddleimage']['name']))
			{
				$Query2 		= mysql_query("SELECT OfferMiddleimage FROM $db->special_offer WHERE OfferId = '".$OfferId."'");
				$Row_Img1    	= mysql_fetch_array($Query2);  
				$Image_name1 	= trim($Row_Img1['OfferMiddleimage']); 
				if($Image_name1!="")
				{
					unlink($_SERVER['DOCUMENT_ROOT']."/img/special_offer/thumb/".$Image_name1);
				}
				
				$path_info 			= pathinfo($MiddleImage);
				$extension 			= $path_info["extension"];
				$MiddleimageName 	= time().'_middle.'.$extension;
				
				$Query = "UPDATE special_offer SET 
						  OfferMiddleimage = '".$MiddleimageName."'
						  WHERE OfferId = '".$OfferId."'";
				$Result = mysql_query($Query);
				if($Result)
				{
					@move_uploaded_file($MiddleImageTmp,$_SERVER['DOCUMENT_ROOT']."/img/special_offer/thumb/".$MiddleimageName);				
				}		  
			}
			if (!empty($_FILES['OfferBottomimage']['name']))
			{
				$Query3 		= mysql_query("SELECT OfferBottomimage FROM $db->special_offer WHERE OfferId = '".$OfferId."'");
				$Row_Img2    	= mysql_fetch_array($Query3);  
				$Image_name2 	= trim($Row_Img2['OfferBottomimage']); 
				if($Image_name2!="")
				{
					unlink($_SERVER['DOCUMENT_ROOT']."/img/special_offer/thumb/".$Image_name2);
				}
			
				$path_info 			= pathinfo($BottomImage);
				$extension 			= $path_info["extension"];
				$BottomimageName 	= time().'_bottom.'.$extension;
				
				$Query = "UPDATE special_offer SET 
						  OfferBottomimage = '".$BottomimageName."'
						  WHERE OfferId = '".$OfferId."'";
				$Result = mysql_query($Query);
				if($Result)
				{
					@move_uploaded_file($BottomImageTmp,$_SERVER['DOCUMENT_ROOT']."/img/special_offer/thumb/".$BottomimageName);				
				}		  
			}
			
			/*if (!empty($_FILES['OfferTopimage']['name'])) $db->insert_file($db->special_offer, "OfferId", $OfferId, "OfferTopimage", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/special_offer/thumb/", "", "", "", $file_type="", $name="OfferTopimage");
			if (!empty($_FILES['OfferMiddleimage']['name'])) $db->insert_file($db->special_offer, "OfferId", $OfferId, "OfferMiddleimage", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/special_offer/thumb/", "", "", "", $file_type="", $name="OfferMiddleimage");
			if (!empty($_FILES['OfferBottomimage']['name'])) $db->insert_file($db->special_offer, "OfferId", $OfferId, "OfferBottomimage", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/special_offer/thumb/", "", "", "", $file_type="", $name="OfferBottomimage");*/
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
	$content = $db->select_fields($db->special_offer, "", "", "OfferId", $OfferId, "", "", "",1 );

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
}

$smarty->assign("content",$content);

/*-$oFCKeditor = new FCKeditor('OfferDescription') ;
$oFCKeditor->BasePath = 'FCKeditor/';
$oFCKeditor->ToolbarSet = 'MyToolbar';
$oFCKeditor->Width  = '400' ;
$oFCKeditor->Height = '300' ;
$oFCKeditor->Value = $content['OfferDescription'];
$output = $oFCKeditor->CreateHtml() ;-*/


/*$oFCKeditor      			= new FCKeditor('OfferDescription') ;
$oFCKeditor->BasePath 		='FCKeditor/';
$oFCKeditor->Value 			= stripslashes(trim($content['OfferDescription']));
$oFCKeditor->ToolbarSet 	= 'Default';
$oFCKeditor->Width  		= '100%';//'636' ;
$oFCKeditor->Height 		= '800';
$output = $oFCKeditor->CreateHtml();*/

$output = "<textarea name=\"OfferDescription\">".stripslashes(trim($content['OfferDescription']))."</textarea>
			<script language=\"javascript\">
			    CKEDITOR.replace( 'OfferDescription' );
			</script>";

$smarty->assign("output",$output);



// asignare variabile smarty si generare fisier smarty :
//$smarty->assign("pages_dir","editor");
//$smarty->assign("page","home");
//$smarty->display('cms_pages.tpl');

// asignare variabile smarty si generare fisier smarty :

$smarty->assign("pages_dir","editor");
$smarty->assign("page","special_offer_edit");
if (isset($OfferId)) $smarty->assign("OfferId",$OfferId);
$smarty->display('cms_pages.tpl');


?>
