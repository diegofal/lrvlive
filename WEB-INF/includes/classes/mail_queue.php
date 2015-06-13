<?php
require_once ROOT_PATH.'/WEB-INF/includes/functions/functions_log.php';

class Mail_Queue
{
	/*
  `email_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email_subject` varchar(250) DEFAULT NULL,
  `email_create_time` datetime NOT NULL,
  `email_sent_time` datetime DEFAULT NULL,
  `email_create_env` varchar(50) NOT NULL,
  `email_ip` varchar(50) DEFAULT NULL,
  `email_email_type` varchar(250) NOT NULL,
  `email_sent` tinyint(1) NOT NULL,
  `email_error_message` text,
  `email_parent_id` bigint(20) DEFAULT NULL,
  `email_sender` varchar(250) DEFAULT NULL,
  `email_recipients` varchar(250) NOT NULL,
  `email_reply_to` varchar(250) DEFAULT NULL,
  `email_try_sent` tinyint(1) NOT NULL,
  `email_headers` text,
  `email_body` text NOT NULL,
	 */	
	function put($email_type, $environment, $recipients, $subject, $body, $parent_id = 0, $sender = COMPANY_EMAIL_FROM, $headers = "", $reply_to = "")
	{
		global $db;
		
		$fields = array();
		$fields["email_create_time"] = date("Y/m/d H:i:s");
		$fields["email_create_env"] = $environment;
		$fields["email_ip"] = $_SERVER['REMOTE_ADDR'];
		$fields["email_email_type"] = $email_type;
		$fields["email_sent"] = 0;		
		if ($parent_id != 0)
			$fields["email_parent_id"] = $parent_id; 
		$fields["email_sender"] = $sender;
		$fields["email_recipients"] = $recipients;
		if ($reply_to != "")
			$fields["email_reply_to"] = $reply_to; 
		$fields["email_try_sent"] = 0;
		if ($headers != "")
			$fields["email_headers"] = $headers; 
		$fields["email_body"] = $body;
		$fields["email_subject"] = $subject;
		
		return $db->insert_field("email_queue", $fields); 
	}
	
	function sendMailsInQueue()
	{
		global $db;
		require_once ROOT_PATH.'/WEB-INF/includes/classes/Mail.php';
				
		$failed = array();
		$emails_sent = 0;
		
		$query = "SELECT * FROM email_queue WHERE email_sent = 0 AND email_try_sent = 0 ORDER BY email_create_time";
		$mail_queue = $db->select_fields("email_queue", $query);
		
		$mail_object =& Mail::factory('smtp');
				
		foreach($mail_queue as $item) {
			
			$recipients = $item["email_recipients"];
			$headers = array(
					"From"		 	=>	"London RIB Voyages <".$item["email_sender"].">",
					"To"		 	=>	$item["email_recipients"],
					"Subject"	 	=>	$item["email_subject"],
					"MIME-Version" 	=> 	"1.0",
					"Content-type" 	=> 	"text/html; charset=UTF-8"					
					);
					//"Content-type" 	=> 	"text/html; charset=iso-8859-1"					

			if ($item["email_reply_to"] != null && $item["email_reply_to"] != "")
				$headers["Return-Path"] = $item["email_reply_to"];
			
			$res = $mail_object->send($recipients, $headers, $item["email_body"]);
			
			if (PEAR::isError($res)) {
				$item["email_try_sent"] = 1;
				$item["email_error_message"] = $res->getMessage();

				$failed[] = $item;
			}
			else
			{
				$item["email_sent"] = 1;
				$item["email_sent_time"] = date("Y/m/d H:i:s");
				$emails_sent++;
			}
			
			$db->edit_field("email_queue", $item, "email_id", $item["email_id"]);
			
		}
		
		if (count($failed) > 0) {
			//Failed report
			$body = "The following ".count($failed)." email confirmations have failed.\n\n";
			$body .= "-----------------------\n";
			foreach ($failed as $item) {
				$body .= $item["email_email_type"]." Id: ".$item["email_parent_id"]."\n";
				$body .= "It was created at '".$item["email_create_env"]."'\n";
				$body .= "Recipient email: ".$item["email_recipients"]."\n";
				$body .= "Email record id: ".$item["email_id"]."\n";
				$body .= "Error message: ".$item["email_error_message"]."\n";
				$body .= "-----------------------\n";
			}
			
			write_email_log("Some emails fail.\n".$body);	
					
			mail(
					COMPANY_EMAIL_CONFIRMATIONS.",fcisco@gmail.com", 
					"[LRV] Email Service Alert",
					$body,
					'From: '.COMPANY_EMAIL_FROM_BOOKINGS);			
		}
		
		//print_r($failed);
		
		return $emails_sent;
	}

    function remove_feedback($address) {
        if ($address == "")
            return;

        global $db;

        $query = "DELETE FROM feedback_email_list WHERE email = '".$address."'";

        echo $query;

        return $db->delete_field("feedback_email_list","", "", $query);
    }

	function put_feedback($address, $send_date) {
		if ($address == "")
			return;

		global $db;

		$fields = array("email" => $address, "send_date" => $send_date);
		return $db->insert_field("feedback_email_list", $fields); 
	}

	function sendMailsInQueueFeedback($count = 10)
	{
		global $db, $emails;
		require_once ROOT_PATH.'/WEB-INF/includes/classes/Mail.php';
				
		$failed = array();
		$emails_sent = 0;
		
		$query = "SELECT * 
						FROM feedback_email_list 
						WHERE sent = 0 
							AND email_try_send = 0 
							AND (send_date <= CURDATE() OR send_date is null)
					LIMIT ".$count;
		$mail_queue = $db->select_fields("feedback_email_list", $query);
		
		$mail_object =& Mail::factory('smtp');
				
		foreach($mail_queue as $item) {
			
			$recipients = $item["email"];
			$headers = array(
					"From"		 	=>	"London RIB Voyages <".COMPANY_EMAIL_CONFIRMATIONS.">",
					"To"		 	=>	$item["email"],
					"Subject"	 	=>	"We hope you had a great experience!",
					"MIME-Version" 	=> 	"1.0",
					"Content-type" 	=> 	"text/html; charset=UTF-8"					
					);
					//"Content-type" 	=> 	"text/html; charset=iso-8859-1"					

			$res = $mail_object->send($recipients, $headers, $emails['feedback']);
			
			$fields = array();

			if (PEAR::isError($res)) {
				$fields["email_try_send"] = 1;
				$fields["error"] = $res->getMessage();
				$item["error"] = $fields["error"];
				$fields["email"] = $item["email"];

				$failed[] = $item;
			}
			else
			{
				$fields["sent"] = 1;
				$fields["date_sent"] = date("Y/m/d H:i:s");
				$emails_sent++;
			}
			
			$db->edit_field("feedback_email_list", $fields, "id", $item["id"]);
			
			sleep(1); // Wait for one minute to prevent blacklisting.
		}
		
		if (count($failed) > 0) {
			//Failed report
			$body = "The following ".count($failed)." email feedback have failed.\n\n";
			$body .= "-----------------------\n";
			foreach ($failed as $item) {
				$body .= "Id: ".$item["id"]."\n";
				$body .= "Recipient email: ".$item["email"]."\n";
				$body .= "Error message: ".$item["error"]."\n";
				$body .= "-----------------------\n";
			}
			
			write_email_log("Some emails fail.\n".$body);	
					
			mail(
					COMPANY_EMAIL_CONFIRMATIONS.",fcisco@gmail.com", 
					"[LRV] Feedback email alert",
					$body,
					'From: '.COMPANY_EMAIL_FROM_BOOKINGS);			
		}
		
		//print_r($failed);
		
		return $emails_sent;
	}

	function getMailsByParentId($parent_id, $email_type = "BOOKING") {
		global $db;
		
		$query = "SELECT * FROM email_queue WHERE email_email_type LIKE '$email_type' AND email_parent_id = $parent_id ORDER BY email_create_time DESC";
		$mail_queue = $db->select_fields("email_queue", $query);

		return $mail_queue;
	}
	
	function getMailsByRecipients($email) {
		global $db;
		
		$query = "SELECT * FROM email_queue WHERE email_recipients LIKE '$email' ORDER BY email_create_time DESC";
		$mail_queue = $db->select_fields("email_queue", $query);
		
		return $mail_queue; 
	}
}