<?
session_start();

$username = "bale";
$password = "lrv9273";


if($_POST && ($_POST['user'] && $_POST['pass']))
{
		if ($_POST['user'] == $username && $_POST['pass'] == $password) {
		$_SESSION['logged_in'] = true;
		$_SESSION['admin_name']=$_POST['user'];
		header ("Location: booking_calender.php");
		}
		else {
		header ("Location: index.php?reason=failure&error=1");
		}

}


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