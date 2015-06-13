<?
if (empty($_GET['id']) || empty($_GET["code"]))
	exit("Invalid booking code. Contact system administrator");

// includere smarty :
require_once "check_login.php";
require_once "../WEB-INF/includes/functions/functions_log.php";
require_once "../WEB-INF/includes/functions/functions_order.php";
require_once "../WEB-INF/includes/classes/mail_queue.php";

// se include clasa de prelucrare a DB, configurarile si functiile utile :
require_once "../WEB-INF/includes/classes/class.x3.utils.php";

$results = Mail_Queue::getMailsByParentId($_GET['id']);

if (count($results) > 0) {		
	$smarty->assign("rows",count($results));
	$smarty->assign("results",$results);	
}
$smarty->assign("order_unique_code",$_GET["code"]);

$smarty->display('make_booking/page_ticket_emails.tpl');
?>