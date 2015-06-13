<?
include "check_session.php";


if (isset($_GET['delete']) || !empty($_GET['delete'])) {
$wipe=base64_decode($_GET['delete']);
$query = "DELETE FROM $db->order WHERE order_payd = 0 AND order_sid = '".$wipe."'";
$db->delete_field($db->order, "", "", $query);
}
else {die();exit();}
?>