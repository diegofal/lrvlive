<?
include "check_session.php";
include "WEB-INF/includes/functions/functions_payment.php";
include "WEB-INF/includes/functions/functions_log.php"; //CALIN
if(sizeof($_POST) && !empty($_POST))
{
					$fields = array(
									"Name"=>$_POST['Name'],
									"Email"=>$_POST['Email']);
			
			if( $db->exist_value($db->tbl_newsletter_clients,'Name', trim($_POST['Name']))){
			} else {
				$fields['Status'] = '1';
				$fields['Date'] = date("Y-m-d h:i:s");
				$db->insert_field($db->tbl_newsletter_clients, $fields);
			}
			$url = $_SERVER['HTTP_REFERER'];
			if(strstr($url,"?"))
			{
				$rediectUrl = $url;	
			}
			else
			{
				$rediectUrl = $url.'?msg=true';
			}
			header("Location:$rediectUrl");
			exit();

}

?>