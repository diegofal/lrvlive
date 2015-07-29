<?
/**********************************************************************
 ** Script Name: Functions.php                                        **
 ** Version:     1.3 - 21-jan-05                                      **
 ** Author:      Pat Fox                                              **
 ** Function:    Contains simple procedures to encode, encrypt,       **
 **              decode, decrypt and split the information POSTed     **
 **              to and from VSP Form.                                **
 **                                                                   **
 ** Revision History:                                                 **
 ** Version  Author     Date and notes                                **
 **    1.0   Mat Peck   18/01/2002 - First ASP release                **
 **    1.1   Mat Peck   07/03/2002 - Base64 routines patched          **
 **    1.2   Pat Fox    29/07/2002 - PHP version                      **
 **    1.2   Tony Welch 9/07/2003 - Addition of post code fields 2.21 **
 **    1.3   Peter G    21-jan-05 - Add new 2.22 response fields      **
 ***********************************************************************/

// ** Set variables to indentify the vendor **

//$VendorName="londonrib";
//$EncryptionPassword="CzjZd2yZ4jTr9CLm";

//$EncryptionPassword="cle09hm8rDQ96AlY";

//NEW
$VendorName = "londonribvoyage";
$EncryptionPassword = "GAzHuWWJyBg6mZyj";


//$URL = "http://162.13.140.19/booking.php?subpage=step8";
//$URL = "http://www.londonribvoyages.com/booking.php?subpage=step8";
$URL = "http://staging.londonribvoyages.com:9090/booking.php?subpage=step8";

//** Your server's IP address or dns name and web app directory.  Fully qualified **
//** Examples : $MyServer="https://www.newco.com/php-form-kit/", $MyServer="192.168.0.1/php-form-kit", $MyServer="http://localhost/php-form-kit/" **

//$MyServer="http://162.13.140.19/";
$MyServer = "http://www.londonribvoyages.com/";

//*********************************************************************************
// The protx site to send information to **

//** Simulator site **
//$vspsite = "https://ukvpstest.protx.com/VSPSimulator/VSPFormGateway.asp";

//** Test site **
// $vspsite="https://ukvpstest.protx.com/vps2form/submit.asp";

//** Live site - ONLY uncomment when going live **
$vspsite = "https://ukvps.protx.com/vps2form/submit.asp";

$vspsite = "https://live.sagepay.com/gateway/service/vspform-register.vsp";
//*********************************************************************************
// ** Base 64 Encoding function **
// PHP does it natively but just for consistency and ease of maintenance, let's declare our own function
function base64Encode($plain)
{
    // Initialise output variable
    $output = "";

    // Do encoding
    $output = base64_encode($plain);

    // Return the result
    return $output;
}


/* Base 64 decoding function **
** PHP does it natively but just for consistency and ease of maintenance, let's declare our own function **/
function base64Decode($scrambled)
{
    // Initialise output variable
    $output = "";

    // Fix plus to space conversion issue
    $scrambled = str_replace(" ", "+", $scrambled);

    // Do encoding
    $output = base64_decode($scrambled);

    // Return the result
    return $output;
}


/*  The SimpleXor encryption algorithm                                                                                **
**  NOTE: This is a placeholder really.  Future releases of Form will use AES or TwoFish.  Proper encryption      **
**  This simple function and the Base64 will deter script kiddies and prevent the "View Source" type tampering        **
**  It won't stop a half decent hacker though, but the most they could do is change the amount field to something     **
**  else, so provided the vendor checks the reports and compares amounts, there is no harm done.  It's still          **
**  more secure than the other PSPs who don't both encrypting their forms at all                                      */

function simpleXor($InString, $Key)
{
    // Initialise key array
    $KeyList = array();
    // Initialise out variable
    $output = "";

    // Convert $Key into array of ASCII values
    for ($i = 0; $i < strlen($Key); $i++) {
        $KeyList[$i] = ord(substr($Key, $i, 1));
    }

    // Step through string a character at a time
    for ($i = 0; $i < strlen($InString); $i++) {
        // Get ASCII code from string, get ASCII code from key (loop through with MOD), XOR the two, get the character from the result
        // % is MOD (modulus), ^ is XOR
        $output .= chr(ord(substr($InString, $i, 1)) ^ ($KeyList[$i % strlen($Key)]));
    }

    // Return the result
    return $output;
}

function getToken($thisString)
{

    // List the possible tokens
    $Tokens = array(
        "Status",
        "StatusDetail",
        "VendorTxCode",
        "VPSTxId",
        "TxAuthNo",
        "Amount",
        "AVSCV2",
        "AddressResult",
        "PostCodeResult",
        "CV2Result",
        "GiftAid",
        "3DSecureStatus",
        "CAVV",
        "AddressStatus",
        "CardType",
        "Last4Digits",
        "PayerStatus");

    // Initialise arrays
    $output = array();
    $resultArray = array();

    // Get the next token in the sequence
    for ($i = count($Tokens) - 1; $i >= 0; $i--) {
        // Find the position in the string
        $start = strpos($thisString, $Tokens[$i]);
        // If it's present
        if ($start !== false) {
            // Record position and token name
            $resultArray[$i]->start = $start;
            $resultArray[$i]->token = $Tokens[$i];
        }
    }

    // Sort in order of position
    sort($resultArray);
    // Go through the result array, getting the token values
    for ($i = 0; $i < count($resultArray); $i++) {
        // Get the start point of the value
        $valueStart = $resultArray[$i]->start + strlen($resultArray[$i]->token) + 1;
        // Get the length of the value
        if ($i == (count($resultArray) - 1)) {
            $output[$resultArray[$i]->token] = substr($thisString, $valueStart);
        } else {
            $valueLength = $resultArray[$i + 1]->start - $resultArray[$i]->start - strlen($resultArray[$i]->token) - 2;
            $output[$resultArray[$i]->token] = substr($thisString, $valueStart, $valueLength);
        }

    }

    // Return the ouput array
    return $output;
}

// Randomise based on time
function randomise()
{
    list($usec, $sec) = explode(' ', microtime());
    return (float)$sec + ((float)$usec * 100000);
}

function addPKCS5Padding($input)
{
    $blockSize = 16;
    $padd = "";

    // Pad input to an even block size boundary.
    $length = $blockSize - (strlen($input) % $blockSize);
    for ($i = 1; $i <= $length; $i++)
    {
        $padd .= chr($length);
    }

    return $input . $padd;
}

function removePKCS5Padding($input)
{
    $blockSize = 16;
    $padChar = ord($input[strlen($input) - 1]);

    /* Check for PadChar is less then Block size */
    if ($padChar > $blockSize)
    {
        die('Invalid encryption string');
    }
    /* Check by padding by character mask */
    if (strspn($input, chr($padChar), strlen($input) - $padChar) != $padChar)
    {
        die('Invalid encryption string');
    }

    $unpadded = substr($input, 0, (-1) * $padChar);
    /* Chech result for printable characters */
    if (preg_match('/[[:^print:]]/', $unpadded))
    {
        die('Invalid encryption string');
    }
    return $unpadded;
}



function generate_crypt($ThisVendorTxCode, $ThisAmount, $ThisDescription, $ThisCustomerEmail, $ThisCustomerName, $ThisVendorEmail,
                        $ThisDeliveryAddress, $ThisDeliveryPostCode, $MyURL = "")
{
    global $EncryptionPassword;
    global $URL;
    if (!empty($MyURL)) $URL = $MyURL;

    $ThisCurrency = "GBP";
    $ThisShoppingBasket = "OFF";

    //** Build the crypt string plaintext **
    $stuff = "VendorTxCode=" . $ThisVendorTxCode . "&";
    $stuff .= "Amount=" . $ThisAmount . "&";
    $stuff .= "Currency=" . $ThisCurrency . "&";
    $stuff .= "Description=" . $ThisDescription . "&";
    //$stuff .= "SuccessURL=http://www.x3studios.com/clients/londonrib_cms/booking.php&";
    //$stuff .= "FailureURL=http://www.x3studios.com/clients/londonrib_cms/contact.htm&";
    $stuff .= "SuccessURL=" . $URL . "&";
    $stuff .= "FailureURL=" . $URL . "&";

    if (!empty($ThisCustomerEmail)) {
        $stuff .= "CustomerEmail=" . $ThisCustomerEmail . "&";
    }
    if (!empty($ThisVendorEmail)) {
        $stuff .= "VendorEmail=" . $ThisVendorEmail . "&";
    }
    if (!empty($ThisCustomerName)) {
        $stuff .= "CustomerName=" . $ThisCustomerName . "&";
    }
    if (!empty($ThisDeliveryAddress) && !empty($ThisDeliveryPostCode)) {
        $stuff .= "BillingAddress=" . $ThisDeliveryAddress . "&";
        $stuff .= "BillingPostCode=" . $ThisDeliveryPostCode . "&";

    }
    if (!empty($ThisDeliveryPostCode)) {
//	  $stuff .= "BillingPostCode=" . $ThisDeliveryPostCode . "&";
    }


    $stuff .= "EMailMessage=Thank you for purchasing your ticket with London RIB  Voyages.";

    // ** Encrypt the plaintext string for inclusion in the hidden field **
    //$crypt = base64Encode(SimpleXor($stuff,$EncryptionPassword));
    return base64Encode(SimpleXor($stuff, $EncryptionPassword));
}

function generate_crypt3($ThisVendorTxCode, $ThisAmount, $ThisDescription, $ThisCustomerEmail, $ThisCustomerName, $ThisVendorEmail,
                         $ThisDAddress1, $ThisDPostCode, $ThisDSurname, $ThisDFirstNames, $ThisDCity, $ThisDCountry,
                         $ThisBAddress1, $ThisBPostCode, $ThisBSurname, $ThisBFirstNames, $ThisBCity, $ThisBCountry,
                         $MyURL = "")
{
    global $EncryptionPassword;
    global $URL;
    if (!empty($MyURL)) $URL = $MyURL;

    $ThisCurrency = "GBP";
    $ThisShoppingBasket = "OFF";

    //** Build the crypt string plaintext **
    $stuff = "VendorTxCode=" . $ThisVendorTxCode . "&";
    $stuff .= "Amount=" . $ThisAmount . "&";
    $stuff .= "Currency=" . $ThisCurrency . "&";
    $stuff .= "Description=" . $ThisDescription . "&";
    //$stuff .= "SuccessURL=http://www.x3studios.com/clients/londonrib_cms/booking.php&";
    //$stuff .= "FailureURL=http://www.x3studios.com/clients/londonrib_cms/contact.htm&";
    $stuff .= "SuccessURL=" . $URL . "&";
    $stuff .= "FailureURL=" . $URL . "&";
    //$stuff .= "FailureURL=http://staging.londonribvoyages.com:9090/booking.php?subpage=step8&";
    // V3
    $stuff .= "BillingSurname=" . $ThisBSurname . "&";
    $stuff .= "BillingFirstNames=" . $ThisBFirstNames . "&";
    $stuff .= "BillingAddress1=" . $ThisBAddress1 . "&";
    $stuff .= "BillingCity=" . $ThisBCity . "&";
    $stuff .= "BillingPostCode=" . $ThisBPostCode . "&";
    $stuff .= "BillingCountry=" . $ThisBCountry . "&";

    $stuff .= "DeliverySurname=" . $ThisDSurname . "&";
    $stuff .= "DeliveryFirstNames=" . $ThisDFirstNames . "&";
    $stuff .= "DeliveryAddress1=" . $ThisDAddress1 . "&";
    $stuff .= "DeliveryCity=" . $ThisDCity . "&";
    $stuff .= "DeliveryPostCode=" . $ThisDPostCode . "&";
    $stuff .= "DeliveryCountry=" . $ThisDCountry . "&";

    if (!empty($ThisCustomerEmail)) {
        $stuff .= "CustomerEmail=" . $ThisCustomerEmail . "&";
    }
    if (!empty($ThisVendorEmail)) {
        $stuff .= "VendorEmail=" . $ThisVendorEmail . "&";
    }
    if (!empty($ThisCustomerName)) {
        $stuff .= "CustomerName=" . $ThisCustomerName . "&";
    }
    //if (!empty($ThisDeliveryAddress) && !empty($ThisDeliveryPostCode)) {
    //  $stuff .= "BillingAddress=" . $ThisDeliveryAddress . "&";
    //  $stuff .= "BillingPostCode=" . $ThisDeliveryPostCode . "&";

    //}
    //if (!empty($ThisDeliveryPostCode)) {
//	  $stuff .= "BillingPostCode=" . $ThisDeliveryPostCode . "&";
    //}


    $stuff .= "EMailMessage=Thank you for purchasing your ticket with London RIB  Voyages.";

    // ** Encrypt the plaintext string for inclusion in the hidden field **
    //$crypt = base64Encode(SimpleXor($stuff,$EncryptionPassword));
    //return base64Encode(SimpleXor($stuff, $EncryptionPassword));
    $stuff = addPKCS5Padding($stuff);

    $crypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $EncryptionPassword, $stuff, MCRYPT_MODE_CBC, $EncryptionPassword);

    // Perform hex encoding and return.
    return "@" . strtoupper(bin2hex($crypt));
    //return ($stuff);
}

function decode_crypt($crypt)
{
    global $EncryptionPassword;
    $hex = substr($crypt, 1);
    if (!preg_match('/^[0-9a-fA-F]+$/', $hex))
    {
        die('Invalid encryption string');
    }
    $crypt = pack('H*', $hex);

    $string = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $EncryptionPassword, $crypt, MCRYPT_MODE_CBC, $EncryptionPassword);

    return removePKCS5Padding($string);


    // Old version 2 decryption
    //$Decoded = SimpleXor(base64Decode($crypt), $EncryptionPassword);

    //$values = getToken($Decoded);
    //print_r($values);
    //return array("code" => $values['VendorTxCode'], "status" => $values['Status']);
}

?>
