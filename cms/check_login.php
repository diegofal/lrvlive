<?
// start session:
session_name("cms_session");
session_start();

// includes 
require_once "../WEB-INF/includes/classes/class.x3.database.php";
require_once "../WEB-INF/includes/config.php";
require_once "../WEB-INF/includes/functions/functions_utils.php";
include "../WEB-INF/includes/smarty/smarty_cms.php";

$smarty->assign("menu_cms",$menu_cms);

// DB connction
$db = new DB_config;
$db->connect();

/*
$query = "DELETE FROM $db->order WHERE order_payd = 0 AND order_time < ".(time()-600);
$db->delete_field($db->order, "", "", $query);
*/

// authenticate
$array_config = array("config_admin_user", "config_admin_pass");
$array_session = array("username", "password");
$db->check_session_login($db->config, $array_config, $array_session, "admin", "", "", "", "index.php", "index.php", "booking.php");

// Close session file write lock to avoid deadlock in other scripts
session_write_close();
?>