<?
if (!isset($_GET['code']) || empty($_GET['code'])) die ('error');
    else $code = $_GET['code'];

        require_once "../WEB-INF/includes/classes/class.x3.database.php";
        require_once "../WEB-INF/includes/config.php";

        // DB connction
        $db = new DB_config;
        $db->connect();

        $this_id = $code;

        $voucher_order = $db->select_fields($db->voucher_order, "", "", 'voucher_order_unique_code', $code, "", "", "", 1);

        $query = "SELECT * FROM $db->voucher_order, $db->voucher, $db->tour
                  WHERE  voucher_order_voucher_id = voucher_id
                  AND voucher_tour_id = tour_id
                  AND voucher_order_unique_code = '".$this_id."'";
        $fields = array("voucher_order_id", "voucher_order_date", "voucher_order_to", "voucher_order_tickets_number",
                        "voucher_order_number", "voucher_name", "tour_name");
        $voucher_order = $db->select_fields($db->order, $query, $fields, "", "", "", "", "", 1);

$msg = "<br />
Thank you for purchasing your London RIB Voucher. Please download & print your voucher by clicking on either of the following links:<br />
<br />
HTML Voucher: http://".$_SERVER['SERVER_NAME']."/vouchers/".$code.".html<br />
PDF Voucher: http://".$_SERVER['SERVER_NAME']."/vouchers/".$code.".pdf<br />
<br />
To vaildate your voucher & to check sailing times please contact our office at Waterloo Millenium Pier, British Airways London Eye on 020 7928 2350.<br />
This voucher must be produced when collecting your boarding pass.<br />
Vouchers are valid for 9 months from date of issue.";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>LRV Voucher</title>
                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    </head>
<body onload="window.print()">
<?php echo $msg ?>
</body>
</html>