<?

// includere smarty :
include "check_login.php";

include("FCKeditor/fckeditor.php");

if (isset($_REQUEST['package_id'])) $package_id = (int)$_REQUEST['package_id'];

//	
if (isset($_POST) && @$_POST['do']=="add") {
		unset($_POST['do']);
//		print_r($_FILES);
		if (empty($_FILES['package_image1']['name']) || empty($_POST['package_name'])) {
			$error = "Add:Package name and Image 1 are mandatory";
		}
		if (!isset($error)) {
			$db->insert_field($db->package, $_POST);	
			$package_id = $db->mysqlinsertid();
			if (!empty($_FILES['package_home_image']['name'])) $db->insert_file($db->package, "package_id", $package_id, "package_home_image", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/packages/", $large_dim="600", $thumb_dim="170", $both="1", $file_type="", $name="package_home_image");
			if (!empty($_FILES['package_big_image']['name'])) $db->insert_file($db->package, "package_id", $package_id, "package_big_image", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/packages/", $large_dim="600", $thumb_dim="203", $both="1", $file_type="", $name="package_big_image");
			if (!empty($_FILES['package_image1']['name'])) $db->insert_file($db->package, "package_id", $package_id, "package_image1", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/packages/", $large_dim="600", $thumb_dim="119", $both="1", $file_type="", $name="package_image1");
			if (!empty($_FILES['package_image2']['name'])) $db->insert_file($db->package, "package_id", $package_id, "package_image2", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/packages/", $large_dim="600", $thumb_dim="119", $both="1", $file_type="", $name="package_image2");
			if (!empty($_FILES['package_image3']['name'])) $db->insert_file($db->package, "package_id", $package_id, "package_image3", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/packages/", $large_dim="600", $thumb_dim="119", $both="1", $file_type="", $name="package_image3");
			if (!empty($_FILES['package_image4']['name'])) $db->insert_file($db->package, "package_id", $package_id, "package_image4", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/packages/", $large_dim="600", $thumb_dim="119", $both="1", $file_type="", $name="package_image4");
		}
		else {
			$smarty->assign("error", $error);
		}
	}


if (isset($_POST) && @$_POST['do']=="update") {
		unset($_POST['do']);
		if (empty($_POST['package_name'])) {
			$error = "Update:Package name and Image 1 are mandatory";
		}
		//echo $_SERVER['DOCUMENT_ROOT']."/londonribvoyges/img/packages/".'=====================>'; exit();
		if (!isset($error)) {
			$db->edit_field($db->package, $_POST, "package_id", $package_id);
			if (!empty($_FILES['package_home_image']['name'])) $db->insert_file($db->package, "package_id", $package_id, "package_home_image", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/packages/", $large_dim="600", $thumb_dim="170", $both="1", $file_type="", $name="package_home_image");
			if (!empty($_FILES['package_big_image']['name'])) $db->insert_file($db->package, "package_id", $package_id, "package_big_image", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/packages/", $large_dim="600", $thumb_dim="203", $both="1", $file_type="", $name="package_big_image");
			if (!empty($_FILES['package_image1']['name'])) $db->insert_file($db->package, "package_id", $package_id, "package_image1", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/packages/", $large_dim="600", $thumb_dim="119", $both="1", $file_type="", $name="package_image1");
			if (!empty($_FILES['package_image2']['name'])) $db->insert_file($db->package, "package_id", $package_id, "package_image2", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/packages/", $large_dim="600", $thumb_dim="119", $both="1", $file_type="", $name="package_image2");
			if (!empty($_FILES['package_image3']['name'])) $db->insert_file($db->package, "package_id", $package_id, "package_image3", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/packages/", $large_dim="600", $thumb_dim="119", $both="1", $file_type="", $name="package_image3");
			if (!empty($_FILES['package_image4']['name'])) $db->insert_file($db->package, "package_id", $package_id, "package_image4", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/packages/", $large_dim="600", $thumb_dim="119", $both="1", $file_type="", $name="package_image4");

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
	$content = $db->select_fields($db->package, "", "", "package_id", $package_id, "", "", "",1 );
}

/*echo "<pre>";
print_r($content);
exit();
*/
$smarty->assign("content",$content);

$oFCKeditor      			= new FCKeditor('package_full_description') ;
$oFCKeditor->BasePath 		='FCKeditor/';
$oFCKeditor->Value 			= stripslashes(trim($content['package_full_description']));
$oFCKeditor->ToolbarSet 	= 'Default';
$oFCKeditor->Width  		= '100%';//'636' ;
$oFCKeditor->Height 		= '800';
$output = $oFCKeditor->CreateHtml();

$smarty->assign("output",$output);

// asignare variabile smarty si generare fisier smarty :
//$smarty->assign("pages_dir","editor");
//$smarty->assign("page","home");
//$smarty->display('cms_pages.tpl');

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","booking");
$smarty->assign("page","package_edit");
if (isset($package_id)) $smarty->assign("package_id",$package_id);
$smarty->display('cms_pages.tpl');


?>