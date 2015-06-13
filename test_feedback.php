<?

include "check_session.php";
include "browser.php";
include "WEB-INF/includes/functions/functions_email.php";

require_once (ROOT_PATH."/WEB-INF/includes/classes/mail_queue.php");

$emails = $db->select_fields($db->email, "", array('order_user','order_user2','order_admin','order_modified', 'voucher_user', 'voucher_admin', 'feedback', 'thames_festival_blast'));
$emails = $emails[0];

if (isset($_POST["email"])) {

	test_feedback_mail($_POST["email"]);

	echo "EMAIL SENT <br />";
}

//echo $emails['feedback']."*";

 //send_confirmation_mail_voucher("fcisco@gmail.com", "848c2405b1bd6e3d14bdd20c0451cfba");
 //echo "EMAIL SENT <br />";


function test_feedback_mail($adr_to) {
    global $db, $COUNTRIES, $emails;

    require_once ROOT_PATH.'/WEB-INF/includes/classes/Mail.php';

    $mail_object =& Mail::factory('smtp');

    $recipients = $adr_to;
    $headers = array(
        "From"		 	=>	"London RIB Voyages <".COMPANY_EMAIL_CONFIRMATIONS.">",
        "To"		 	=>	$adr_to,
        "Subject"	 	=>	"We hope you had a great experience!",
        "MIME-Version" 	=> 	"1.0",
        "Content-type" 	=> 	"text/html; charset=UTF-8"
    );
    //"Content-type" 	=> 	"text/html; charset=iso-8859-1"

    $res = $mail_object->send($recipients, $headers, $emails['feedback']);

    $fields = array();

    if (PEAR::isError($res)) {
        echo $res->getMessage();
    }
    else
    {
        echo "email sent";
    }

    return true;
}

?>

<form method="POST">
	Email: <input type="text" name="email" id="email" />
	<input type="submit" value="send test email" />
</form>