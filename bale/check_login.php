<?
session_start();

$users = array(
	"bale" =>
		array("current_reseller_id" => 49, "password" => "lrv9273", "tours" => array(1,20,4), "companyimagepath" => ""),
	"tower" =>
		array("current_reseller_id" => 134, "password" => "lrv1977", "tours" => array(12), "companyimagepath" => ""),
	"shangrila" =>
		array("current_reseller_id" => 138, "password" => "lrv1236", "tours" => array(12), "companyimagepath" => "")
);

if($_POST && ($_POST['user'] && $_POST['pass']))
{
	if (!array_key_exists($_POST['user'], $users)) {
		header ("Location: index.php?reason=failure&error=1");
	}

	$user = $users[$_POST['user']];

	if ($_POST['pass'] == $user["password"]) {
		$_SESSION['current_reseller_id']= $user["current_reseller_id"];
		$_SESSION['logged_in'] = true;
		$_SESSION['admin_name']=$_POST['user'];
		$_SESSION["tours"] = $user["tours"];
		$_SESSION["companyimagepath"] = $user["companyimagepath"];

		header ("Location: booking_calender.php");
	}
	else {
		header ("Location: index.php?reason=failure&error=1");
	}
}

die();

// includes 
require_once "../WEB-INF/includes/classes/class.x3.database.php";
require_once "../WEB-INF/includes/config.php";
require_once "../WEB-INF/includes/functions/functions_utils.php";
include "../WEB-INF/includes/smarty/smarty_cms.php";


// DB connction
$db = new DB_config;
$db->connect();

$query = "DELETE FROM $db->order WHERE order_payd = 0 AND order_time < ".(time()-1800);
$db->delete_field($db->order, "", "", $query);

// authenticate
//$array_config = array("config_bale_user", "config_bale_pass");
//$array_session = array("username", "password");
//$db->check_session_login($db->config, $array_config, $array_session, "bale", "", "", "", "index.php", "index.php", "booking.php");
?>