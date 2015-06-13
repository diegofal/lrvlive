<?
if (!isset($_GET['code']) || empty($_GET['code'])) die ('error');
    else $code = $_GET['code'];


        require_once "../WEB-INF/includes/classes/class.x3.database.php";
        require_once "../WEB-INF/includes/config.php";

        // DB connction
        $db = new DB_config;
        $db->connect();
        $query = "SELECT * FROM $db->voucher_order, $db->voucher
                  WHERE voucher_order_voucher_id = voucher_id
                  AND voucher_order_unique_code = '".$code."'";
        $fields = array("voucher_order_id","voucher_order_date","voucher_order_unique_code","voucher_order_to",
                    "voucher_order_address1", "voucher_order_address2", "voucher_order_city", "voucher_order_postcode", "voucher_order_country",
                    "voucher_order_phone", "voucher_order_email", "voucher_order_tickets", "voucher_order_quantities", "voucher_order_total", "voucher_order_number",
                    "voucher_order_discounted_total", "voucher_discount", "voucher_name");
        $voucher_order = $db->select_fields($db->voucher_order, $query, $fields, "", "", "", "", "", 1);
        if(empty($voucher_order['voucher_order_id'])) die('This voucher does not exist!');

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>London RIB Voyages Voucher</title>
                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    </head>
<body class="land" onload="window.print()">
<style type="text/css">
@page .land {size: landscape;}
</style>
<table cellspacing="0" cellpadding="0" border="0">
    <tr>
        <td colspan="2" align="right"><img src="numbers/<?=$code?>.jpg" alt="Voucher number"><br><br></td>
    </tr>
    <tr>
        <td valign="top"><img src="img/logo.gif" width="215" height="138" alt="logo"></td>
        <td style="width: 660px; text-align: center;">
            <img src="img/top.gif" width="651" height="216" alt=""><br>
            <img src="names/<?=$code?>.jpg" alt=""><br>
            <img src="img/aregranted.gif" width="651" height="83" alt=""><br>
            <img src="img/lrv-text.gif" width="651" height="40" alt=""><br>
            <img src="img/line.gif" width="651" height="45" alt=""><br>
            <img src="dates/<?=$code?>.jpg"alt="">
            <img src="img/signature.gif" width="534" height="43" alt=""><br>
            <img src="img/btext.gif" width="651" height="130" alt=""><br><br>
        </td>
    </tr>
</table>

</body>
</html>