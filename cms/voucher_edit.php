<?

// includere smarty :
include "check_login.php";

include("FCKeditor/fckeditor.php");

if (isset($_REQUEST['voucher_id'])) $voucher_id = (int)$_REQUEST['voucher_id'];

//  
if (isset($_POST) && @$_POST['do']=="add") {
        unset($_POST['do']);
//      print_r($_FILES);
        if ($_POST['voucher_discount'] < 0 || empty($_POST['voucher_name'])) {
            $error = "Add:Voucher name and Discount are mandatory";
        }
        if (!isset($error)) {
            $query = "SELECT * FROM $db->voucher  WHERE voucher_tour_id=".$_POST['voucher_tour_id'] . ' AND voucher_del = 0';
            $check = $db->select_fields ($db->voucher ,$query, "" , "", "", "", "1", "", 1);
            if (!empty($check['voucher_id'])) {$error = "Add:Voucher for this tour already exists"; $smarty->assign("error", $error);}
            else {$db->insert_field($db->voucher, $_POST);  
            $voucher_id = $db->mysqlinsertid();}
        }
        else {
            $smarty->assign("error", $error);
        }
    }


if (isset($_POST) && @$_POST['do']=="update") {
        unset($_POST['do']);
        if ($_POST['voucher_discount'] < 0 || empty($_POST['voucher_name'])) {
            $error = "Save:Voucher name and Discount are mandatory";
        }
        if (!isset($error)) {
            $db->edit_field($db->voucher, $_POST, "voucher_id", $voucher_id);
        }
        else {
            $smarty->assign("error", $error);
        }

    }



if(@$_GET['option']=="add"){
    $content = array("voucher_name" => "", "voucher_description" => "", "voucher_discount" => "");
} elseif (isset($error) && !isset($voucher_id)) {
    $content = array("voucher_name" => $_POST['voucher_name'], "voucher_description" => $_POST['voucher_description'], "voucher_discount" => $_POST['voucher_discount']);

} else {
    $content = $db->select_fields($db->voucher, "", "", "voucher_id", $voucher_id, "", "", "",1 );
}

$smarty->assign("content",$content);


$query = "SELECT * FROM $db->tour WHERE 1 AND tour_del = 0";
$tours = $db->select_fields ($db->tour,$query, array("tour_id","tour_name"));

$smarty->assign("tours",$tours);



// asignare variabile smarty si generare fisier smarty :
$smarty->assign("pages_dir","booking");
$smarty->assign("page","voucher_edit");
if (isset($voucher_id)) $smarty->assign("voucher_id",$voucher_id);
$smarty->display('cms_pages.tpl');


?>