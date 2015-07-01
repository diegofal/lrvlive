<?php
error_reporting(0);
// Config parameters

$reselerID = "112";
$token = "abc";

$scritpUrl = "test2.php"; // if you change the script name.
$baseUrl = "http://134.213.145.120/lrvlive/";
//$baseUrl = "http://live.lrv.web/";

// End config



// PHP function to make a Request without externals libraries

    function curl($url, $fields = array()){
        $j = 0;
        $i = 0;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);

        if($fields){
            $fields_string = http_build_query($fields);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
        }

        $response = curl_exec($curl);
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $header_string = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        $header_rows = explode(PHP_EOL, $header_string);
        $header_rows = array_filter($header_rows, trim);
        foreach((array)$header_rows as $hr){
            $colonpos = strpos($hr, ':');
            $key = $colonpos !== false ? substr($hr, 0, $colonpos) : (int)$i++;
            $headers[$key] = $colonpos !== false ? trim(substr($hr, $colonpos+1)) : $hr;
        }
        foreach((array)$headers as $key => $val){
            $vals = explode(';', $val);
            if(count($vals) >= 2){
                unset($headers[$key]);
                foreach($vals as $vk => $vv){
                    $equalpos = strpos($vv, '=');
                    $vkey = $equalpos !== false ? trim(substr($vv, 0, $equalpos)) : (int)$j++;
                    $headers[$key][$vkey] = $equalpos !== false ? trim(substr($vv, $equalpos+1)) : $vv;
                }
            }
        }
        curl_close($curl);
        return $body;
    }
// End function
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.14.30/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <title>API Test</title>
</head>
<body>
<style>
    body{
        padding: 20px;
    }

</style>


<?php

// Make the Api call to the current step
switch ($_POST['step']){
    case 1:
        break;
    case 2:
        $url = $baseUrl."api/resellers/getofferavailability";
        $fields = array(
            'ResellerID' => $reselerID,
            'Token' => $token,
            'Date' => $_POST['offerDate'],
            'OfferId' => $_POST['offerId']
        );
        $response = curl($url, $fields);
        $json = json_decode($response);
        break;
    case 3:
        $departure = unserialize($_POST['DepartureInfo']);
        $url = $baseUrl."api/resellers/makereservation";
        $fields = array(
            'ResellerID' => $reselerID,
            'Token' => $token,
            'OfferId' => $_POST['OfferId'],
            'DepartureId' => $departure->id
        );
        $response = curl($url, $fields);
        $json = json_decode($response);
        break;
    case 4:
        $url = $baseUrl."api/resellers/confirmbooking";
        $fields = array(
            'ResellerID' => $reselerID,
            'Token' => $token,
            'Date' => $_POST['offerDate'],
            'OfferId' => $_POST['OfferId'],
            'BookingId' => $_POST['BookingId'],
            'FirstName' => $_POST['name'],
            'LastName' => $_POST['lastName'],
            'Phone' => $_POST['phone'],
            'Email'=> $_POST['email']
        );
        $response = curl($url, $fields);
        $json = json_decode($response);
        break;
    default:
        $url = $baseUrl."api/resellers/getavailableoffers";
        $fields = array(
            'ResellerID' => $reselerID,
            'Token' => $token
        );
        $response = curl($url, $fields);
        $json = json_decode($response);
        break;
}
// Show error if unsuccessful api call
if (!$json->Status == 'Ok' && $_POST['step'] != 1){
    echo '
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Error!</strong> Api call failed! on step ' .$_POST['step'] . ' detail: ' . print_r($json).'
            </div>
            ';
    die();
}


// The first time show all offers to the reseller

    if (!isset ($_POST['step'])){

?>
    <form action="<?=$scritpUrl?>" method="post" role="form">
	<input type="hidden" name="step" value="1">
    <legend>Step 1 - Get Offers</legend>
    <p>These are the offers avaiable for our test reseller account. You host this php script in your servers and change the ResellerID and Token, by the one giwen by us, in order to test the API integration.</p>
    <p><b>Offers</b></p>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Select</th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($json->offers as $offer){
                        $sOffer = serialize($offer);
                        echo "<tr>
        				<td>$offer->name</td>
        				<td>$offer->price</td>
        				<td><input type='radio' name='offerInfo' id='offerInfo' value='$sOffer'></td>
        			</tr>";
                    }
                    ?>

                    </tbody>

                </table>
            </div>

            <button type="submit" class="btn btn-primary">Select offer</button>
        </form>
<?
    }

// Show the current step

switch ($_POST['step']){
    case 1:
    case 2:
        if (isset($_POST['offerInfo'])) {
            $offer = unserialize($_POST['offerInfo']);
            $offerId = $offer->id;
            $offerName = $offer->name;

        } else {

            if ($_POST['offerName'] == ''){
                echo '
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Error!</strong> Go Back and select an offer in previous step
                    </div>
                    ';
                die();
            }

            $offerName = $_POST['offerName'];
            $offerId = $_POST['offerId'];
        }

        ?>
        <form action="<?=$scritpUrl?>" method="post" role="form">
        <input type="hidden" name="step" value="2">
        <input type="hidden" name="offerName" value="<?= $offerName ?>">
        <input type="hidden" name="offerId" value="<?= $offerId ?>">
        <legend>Step 2 - Make Reservation</legend>
        <p>Now that customer has selected the offer he wants to buy, it's time to check the availability and make the reservation</p>
        <div class="form-group">
            <label for="offerName">Offer</label>
            <input disabled type="text" class="form-control" name="offerName" id="offerName" value="<?= $offerName ?>">
        </div>
        <div class="form-group">
            <label for="offerDate">Select date</label>
            <div class='input-group date' >
                <input type='text' class="form-control"  id='datetimepicker4' id="offerDate" name="offerDate" value="<?=date("Y/m/d"); ?>"/>
                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                </span>
            </div>


        </div>
            <button type="submit" class="btn btn-primary">Get offer Availavility</button>
        </form>

<?
if ($_POST[step] == 2){
    // Show the list de departures to selected date
?>
    <br><br>
<form action="<?= $scritpUrl ?>" method="post" role="form">
    <input type="hidden" name="step" value="3">
    <input type="hidden" name="OfferId" value="<?=$_POST['offerId'] ?>">
    <input type="hidden" name="OfferName" value="<?=$_POST['offerName'] ?>">
    <input type="hidden" name="offerDate" value="<?=$_POST['offerDate'] ?>">

    <p><b>Trips for <?=  $_POST['offerName'] ?> for <?= $_POST['offerDate'] ?></b></p>

    <p>Please select the departure and click in ther button below</p>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Time</th>
                <th>Select</th>
            </tr>
            </thead>
            <tbody>
            <? foreach ($json->departures as $departure) {
                $sDeparture = serialize($departure);
                echo "<tr>
        				<td>$departure->time</td>
        				<td><input type='radio' name='DepartureInfo' id='DepartureInfo' value='$sDeparture'></td>
        			</tr>";
            }
            ?>

            </tbody>

        </table>
    </div>
    <button type="submit" class="btn btn-primary">Make reservation</button>
    <br>
    <p><b>Reservation will be saved for 15 minutes.</b></p>
</form>
<?
    }

    break;
    // end step 2
    case 3:
        ?>
        <form action="<?=$scritpUrl?>" method="post" role="form">
            <input type="hidden" name="step" value="4">
            <input type="hidden" name="BookingId" value="<?= $json->BookingId?>">
            <input type="hidden" name="OfferId" value="<?=$_POST['offerId'] ?>">
            <input type="hidden" name="OfferName" value="<?=$_POST['offerName'] ?>">
            <input type="hidden" name="offerDate" value="<?=$_POST['offerDate'] ?>">
            <legend>Step 3 - Confirm Booking</legend>
            <p>After ther customer has entered ther personal information and payed, reseller website will be able to confirm the booking</p>
            <div class="form-group">
                <label for="offerName">Offer</label>
                <input disabled type="text" class="form-control" name="offerName" id="offerName"  value="<?= $_POST['OfferName'] ?>">
            </div>
            <div class="form-group">
                <label for="tripDate">Trip Date</label>
                <input disabled type="text" class="form-control" name="tripDate" id="tripDate" value="<?= $departure->date ?>">
            </div>
            <div class="form-group">
                <label for="tripTime">Trip Time</label>
                <input disabled type="text" class="form-control" name="tripTime" id="tripTime" value="<?= $departure->time ?>">
            </div>
            <b>Please enter the following information and confirm the booking</b>
            <div class="form-group">
                <label for="name">First Name</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" name="lastName" id="lastName">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email">
            </div>
            <button type="submit" class="btn btn-primary">Confirm Booking</button>
        </form>
        <?
    break; // End Step 3

    case 4:
            echo '
            <div class="alert alert-success">
            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            	<strong>Booking!</strong> Booking success!
            </div>

            ';
    break; // End Step 4

} // End case

if (isset($json)){
    echo "<br><br><pre>";
    echo( json_encode($json));
    echo "</pre>";
}

?>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.14.30/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $(function () {
            $('#datetimepicker4').datetimepicker({
                format: 'YYYY-MM-DD',
                minDate: new Date()

            });
        });
    })
</script>

</body>
</html>



