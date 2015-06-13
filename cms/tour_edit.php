<?

ini_set('error_reporting', E_ALL);

// includere smarty :
include "check_login.php";

include("FCKeditor/fckeditor.php");

if (isset($_REQUEST['tour_id'])) $tour_id = (int)$_REQUEST['tour_id'];

//	
if (isset($_POST) && @$_POST['do']=="add") {
		unset($_POST['do']);
//		print_r($_FILES);
		if (empty($_FILES['tour_image1']['name']) || empty($_POST['tour_name'])) {
			$error = "Add:Tour name and Image 1 are mandatory";
		}
		if (!isset($error)) {
			$db->insert_field($db->tour, $_POST);	
			$tour_id = $db->mysqlinsertid();
			if (!empty($_FILES['tour_home_image']['name'])) $db->insert_file($db->tour, "tour_id", $tour_id, "tour_home_image", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/tours/", $large_dim="600", $thumb_dim="170", $both="1", $file_type="", $name="tour_home_image");
			if (!empty($_FILES['tour_big_image']['name'])) $db->insert_file($db->tour, "tour_id", $tour_id, "tour_big_image", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/tours/", $large_dim="600", $thumb_dim="390", $both="1", $file_type="", $name="tour_big_image");
			if (!empty($_FILES['tour_image1']['name'])) $db->insert_file($db->tour, "tour_id", $tour_id, "tour_image1", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/tours/", $large_dim="600", $thumb_dim="119", $both="1", $file_type="", $name="tour_image1");
			if (!empty($_FILES['tour_image2']['name'])) $db->insert_file($db->tour, "tour_id", $tour_id, "tour_image2", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/tours/", $large_dim="600", $thumb_dim="119", $both="1", $file_type="", $name="tour_image2");
			if (!empty($_FILES['tour_image3']['name'])) $db->insert_file($db->tour, "tour_id", $tour_id, "tour_image3", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/tours/", $large_dim="600", $thumb_dim="119", $both="1", $file_type="", $name="tour_image3");
			if (!empty($_FILES['tour_image4']['name'])) $db->insert_file($db->tour, "tour_id", $tour_id, "tour_image4", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/tours/", $large_dim="600", $thumb_dim="119", $both="1", $file_type="", $name="tour_image4");
		}
		else {
			$smarty->assign("error", $error);
		}
	}


if (isset($_POST) && @$_POST['do']=="update") {
		unset($_POST['do']);
		if (empty($_POST['tour_name'])) {
			$error = "Update:Tour name and Image 1 are mandatory";
		}
		if (!isset($error)) {
			$db->edit_field($db->tour, $_POST, "tour_id", $tour_id);
			
			/*
			echo "<pre>";
			print_r($_FILES);
			echo "</pre>";
			*/
			
			if (!empty($_FILES['tour_home_image']['name'])) {
				$db->insert_file($db->tour, "tour_id", $tour_id, "tour_home_image", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/tours/", $large_dim="600", $thumb_dim="170", $both="1", $file_type="", $name="tour_home_image");
			}
			if (!empty($_FILES['tour_big_image']['name'])) $db->insert_file($db->tour, "tour_id", $tour_id, "tour_big_image", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/tours/", $large_dim="600", $thumb_dim="390", $both="1", $file_type="", $name="tour_big_image");				
			if (!empty($_FILES['tour_image1']['name'])) $db->insert_file($db->tour, "tour_id", $tour_id, "tour_image1", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/tours/", $large_dim="600", $thumb_dim="119", $both="1", $file_type="", $name="tour_image1");
			if (!empty($_FILES['tour_image2']['name'])) $db->insert_file($db->tour, "tour_id", $tour_id, "tour_image2", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/tours/", $large_dim="600", $thumb_dim="119", $both="1", $file_type="", $name="tour_image2");
			if (!empty($_FILES['tour_image3']['name'])) $db->insert_file($db->tour, "tour_id", $tour_id, "tour_image3", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/tours/", $large_dim="600", $thumb_dim="119", $both="1", $file_type="", $name="tour_image3");
			if (!empty($_FILES['tour_image4']['name'])) $db->insert_file($db->tour, "tour_id", $tour_id, "tour_image4", $_FILES, $_SERVER['DOCUMENT_ROOT']."/img/tours/", $large_dim="600", $thumb_dim="119", $both="1", $file_type="", $name="tour_image4");
			
		}
		else {
			$smarty->assign("error", $error);
		}

	}



if(@$_GET['option']=="add"){
	$content = array("tour_name" => "", "tour_short_description" => "", "tour_full_description" => "", "tour_home_name1"=>"", "tour_home_name2"=>"", "tour_duration"=>"");
} elseif (isset($error) && !isset($tour_id)) {
	$content = array("tour_name" => $_POST['tour_name'], "tour_short_description" => $_POST['tour_short_description'], "tour_full_description" => $_POST['tour_full_description'],
					"tour_home_name1"=>$_POST['tour_home_name1'], "tour_home_name2"=>$_POST['tour_home_name2'], "tour_duration"=>$_POST['tour_duration']
					);

} else {
	$content = $db->select_fields($db->tour, "", "", "tour_id", $tour_id, "", "", "",1 );
}

$smarty->assign("content",$content);

/*$oFCKeditor      			= new FCKeditor('tour_full_description') ;
$oFCKeditor->BasePath 		='FCKeditor/';
$oFCKeditor->Value 			= stripslashes(trim($content['tour_full_description']));
$oFCKeditor->ToolbarSet 	= 'Default';
$oFCKeditor->Width  		= '100%';//'636' ;
$oFCKeditor->Height 		= '800';
$output = $oFCKeditor->CreateHtml();*/

$output = "<textarea name=\"tour_full_description\">".stripslashes(trim($content['tour_full_description']))."</textarea>
			<script language=\"javascript\">
			    CKEDITOR.replace( 'tour_full_description' );
			</script>";

$smarty->assign("output",$output);

// asignare variabile smarty si generare fisier smarty :
//$smarty->assign("pages_dir","editor");
//$smarty->assign("page","home");
//$smarty->display('cms_pages.tpl');

// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","booking");
$smarty->assign("page","tour_edit");
if (isset($tour_id)) $smarty->assign("tour_id",$tour_id);
$smarty->display('cms_pages.tpl');


?>
