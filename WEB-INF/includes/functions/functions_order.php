<?php

/*
 * Create new order
 */
function generate_order($fields, $context = "") {		
	global $db;
	
	if (validate_seats($fields)) {	

		$result = $db->insert_field($db->order, $fields);
		//write_orders_log("New order generated - $context - Session Id: ".$fields['order_sid']."\n".print_r($fields, true));	
		
		$id = $db->mysqlinsertid();

		save_order_history('order_sid', $fields['order_sid'], "new", $context, $fields);

		return $id;
		
	} else {
		
		$m = "New order generation failed - $context";
		if (isset($fields['order_sid'])) {
			$m .= " - Session Id: ".$fields['order_sid'];
		} else {
			$m .= " - No session info";
		}
		$m .= "\n".print_r($fields, true);
		write_orders_log($m);
		
		exit("Order could not be saved. Invalid seats numbers. Please try again later or contact us to get assistance.");
		
	}
}

/*
 * Edit existing order
 */
function edit_order($fields, $fieldfilter, $fieldvalue, $context = "") {
	global $db;
	
	if (isset($fields['order_tickets']) && isset($fields['order_quantities']) && isset($fields['order_tickets_number']))
	{
		if (!validate_seats($fields)) {
			$m = "Order edition failed - $context - $fieldfilter = $fieldvalue";			
			$m .= "\n".print_r($fields, true);
			write_orders_log($m);
			
			exit("Order could not be saved. Invalid seats numbers. Please try again later or contact us to get assistance.");
		}
	} else {
		if (isset($fields['order_tickets_number'])) {
			if (!(is_numeric($fields['order_tickets_number']) && $fields['order_tickets_number'] > 0)) {
				$m = "Order edition failed - $context - $fieldfilter = $fieldvalue";
				$m .= "\n".print_r($fields, true);
				write_orders_log($m);
					
				exit("Order could not be saved. Invalid seats numbers. Please try again later or contact us to get assistance.");
			}
		}
	}
	
	//Departure validation, fix to open issue.
	if (isset($fields['order_departure_id'])) {
		$departure = $db->select_fields($db->departure, "", "", 'departure_id', $fields['order_departure_id'], "", "", "", 1);
		if(!isset($departure['departure_id']) || empty($departure['departure_id'])) {
			$m = "Try to edit order with departure = 0 - $context - $fieldfilter = $fieldvalue";
			$m .= "\n".print_r($fields, true);
			write_orders_log($m);
			
			unset($fields['order_departure_id']);
		}
	}
	
	save_order_history($fieldfilter, $fieldvalue, "edit", $context, $fields);

	$result = $db->edit_field($db->order, $fields, $fieldfilter, $fieldvalue);

	//write_orders_log("Order edited - $context - $fieldfilter = $fieldvalue \n".print_r($fields, true));
	return $result;
}

function validate_seats($fields) {
	if (!isset($fields['order_tickets']) || !isset($fields['order_quantities']) || !isset($fields['order_tickets_number']))
		return false;
	
	if (!is_charter($fields)) {
				
		$tickets = $fields['order_tickets']; //String | separated
		$quantities = $fields['order_quantities']; //String | separated
		$tickets_number = $fields['order_tickets_number']; //Number
		
		if (empty($tickets) || empty($quantities) || $tickets_number < 1)
			return false;
		
		$tickets_arr = explode("|", $tickets);
		$quantities_arr = explode("|", $quantities);
		
		if (count($tickets_arr) != count($quantities_arr))
			return false;
				
// 		$q_count = 0;
// 		foreach ($quantities_arr as $q)
// 			$q_count += $q;
		
// 		if ($q_count != $tickets_number)
// 			return false;
		
	}
	return true;
}

function is_charter($fields) {	
	return ($fields['order_tickets'] == 0 && $fields['order_quantities'] == 1 && $fields['order_tickets_number'] == 1);	
}

function send_email_confirmation($order, $context = "unknown context", $add_comments = true) {
	$comments = $add_comments ? $order['order_comments'] : "";

	$result = @send_confirmation_mail($order['order_email'],  $order['order_title']." ".$order['order_first_name']." ".$order['order_last_name'], $order['order_unique_code'], $comments);
	
	if ($result) {
		$fields = array("order_email_confirmation_sent"=>true);
		edit_order($fields, "order_id", $order["order_id"], "send email confirmation");
	} else {
		$fields = array("order_email_confirmation_sent"=>false);
		edit_order($fields, "order_id", $order["order_id"], "send email confirmation");
	
		$m = "Email confirmation failed - $context";
		if (isset($order['order_sid'])) {
			$m .= " - Session Id: ".$order['order_sid'];
		} else {
			$m .= " - No session info";
		}
		$m .= "\n".print_r($order, true);
		write_orders_log($m);
	}
	
	return $result;
}

function send_email_confirmation_front($order) {	
	$result = @send_confirmation_mail($order['order_email'],  $order['order_first_name']." ".$order['order_last_name'], $order['order_unique_code']);
	
	if ($result) {
		$fields = array("order_email_confirmation_sent"=>true);
		edit_order($fields, "order_id", $order["order_id"], "send email confirmation");
	} else {
		$fields = array("order_email_confirmation_sent"=>false);
		edit_order($fields, "order_id", $order["order_id"], "send email confirmation");
		
		$m = "Email confirmation failed - Frontend";
		if (isset($order['order_sid'])) {
			$m .= " - Session Id: ".$order['order_sid'];
		} else {
			$m .= " - No session info";
		}
		$m .= "\n".print_r($order, true);
		write_orders_log($m);
	}
}

function save_order_history($fieldfilter, $fieldvalue, $action, $context, $new_data) {	
	global $db;

	$previous_data = $db->select_fields($db->order, "", "",$fieldfilter, $fieldvalue, "", "", "", 1);

	$fields = array(
		"order_id" => $previous_data["order_id"],
		"date" => date("Y-m-d H:i:s"),
		"action" => $action,
		"context" => $context,
		"previous_data" => $action=="new"?"":serialize($previous_data),
		"new_data" => serialize($new_data)
	);

	$db->insert_field("orders_history", $fields);
}