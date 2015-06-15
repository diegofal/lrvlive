<script src="WEB-INF/includes/js/jquery-1.7.2.min.js"></script>

<?php

require_once('WEB-INF/includes/classes/api.php'); // including service class to work with database


if (isset($_POST["Token"]) && isset($_POST["ResellerID"])){
    $token = $_POST["Token"];
    $resellerId = $_POST["ResellerID"];

    $oApi = new Api($resellerId,$token);

    $requestResult = null;

// process actions
    switch ($_REQUEST['action']) {
        case 'offers':
            $requestResult = $oApi->getAvailableOffers();

            break;
        case 'availability':
            $requestResult =  $oApi->getOfferAvailability();

            break;
        case 'reservation':
            $requestResult = $oApi->makeReservation();

            break;
        case 'confirmation':
            $requestResult = $oApi->confirmBooking();

            break;
    }
    echo json_encode($requestResult);

}




?>

ResellerID:
<input id="resellerId" type="text"/>
<br/>
Token:
<input id="token" type="text"/>

<br/>
<br/>
<div id="bookingData" class="section" style="display:none">
    First Name:
    <input id="firstName" type="text"/>
    <br/>
    Last Name:
    <input id="lastName" type="text"/>
    <br/>
    Phone:
    <input id="phone" type="text"/>
    <br/>
    Email:
    <input id="email" type="text"/>
    <br/>
    Special Notes:
    <input id="specialNotes" type="text"/>
    <br/>
</div>
<?
 if (!isset($_GET["action"])){
     ?>
     <br/>
     <button id="getOffers">Get Offers</button>

     <?
 }
?>

<br/><br/>
<table id="offers" class="section" style="display:none">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<table id="departures" class="section" style="display:none">
    <thead>
    <tr>
        <th>Id</th>
        <th>Date</th>
        <th>Time</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<table id="reservation" class="section" style="display:none">
    <thead>
    <tr>
        <th>BookingId</th>
        <th>Total Price</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<div id="confirmation" class="section" style="display:none">
    Your booking has been confirmed!
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#getOffers").click(getOffers);
    })

    function getOffers(){

        var parameters = getParameters();

        $("[class='section']").hide();

        $.ajax({
            type: "POST",
            url: "api/resellers/getavailableoffers",
            data: parameters,
            success: function(response){
                response = JSON.parse(response);
                if (response.Status=="OK"){
                    $("#offers").find("tbody").empty();

                    $(response.offers).each(function(){
                        var tr = "<tr><td>" +this.id+" </td><td>" + this.name + "</td><td>" + this.price +"</td><td><a href='#' onclick='javascript:getOfferAvailability(" + this.id +")'>Availability</a></td></tr>"
                        $("#offers").find("tbody").append(tr);
                    })
                }else{
                    alert("Request Error");
                }
                $("#offers").show();
            },
            error: function(){
                alert("error");
            },
            dataType: "html"
        });
    }

    function getOfferAvailability(offerId){
        var parameters = getParameters();

        parameters.OfferId = offerId;
        parameters.Date = '2015-06-16';

        $("#offers").hide();
        $.ajax({
            type: "POST",
            url: "api/resellers/getofferavailability",
            data: parameters,
            success: function(response){
                response = JSON.parse(response);
                if (response.Status=="OK"){
                    $("#departures").find("tbody").empty();

                    $(response.departures).each(function(){
                        var tr = "<tr><td>" +this.id+" </td><td>" + this.date + "</td><td>" + this.time +"</td><td><a href='#' onclick='javascript:makeReservation(" + offerId + "," + this.id +")'>Make Reservation</a></td></tr>"
                        $("#departures").find("tbody").append(tr);
                    })
                }else{
                    alert("Request Error");
                }
                $("#departures").show();
            },
            error: function(){
                alert("error");
            },
            dataType: "html"
        });
    }

    function makeReservation(offerId, departureId){
        var parameters = getParameters();

        parameters.OfferId = offerId;
        parameters.DepartureId = departureId;

        $("#departures").hide();
        $.ajax({
            type: "POST",
            url: "api/resellers/makereservation",
            data: parameters,
            success: function(response){
                response = JSON.parse(response);
                if (response.Status=="OK"){
                    $("#reservation").find("tbody").empty();

                    var tr = "<tr><td>" +response.BookingId+" </td><td>" + response.TotalPrice+ "</td><td><a href='#' onclick='javascript:confirmBooking(" + response.BookingId +")'>Confirm Booking</a></td></tr>"
                    $("#reservation").find("tbody").append(tr);
                    $("#bookingData").show();
                }else{
                    alert("Request Error");
                }
                $("#reservation").show();
            },
            error: function(){
                alert("error");
            },
            dataType: "html"
        });
    }

    function confirmBooking(bookingId){
        var parameters = getParameters();

        parameters.BookingId = bookingId;
        parameters.FirstName = $("#firstName").val();
        parameters.LastName = $("#lastName").val();
        parameters.Phone = $("#phone").val();
        parameters.Email= $("#email").val();
        parameters.SpecialNotes = $("#specialNotes").val();

        $("#reservation").hide();
        $.ajax({
            type: "POST",
            url: "api/resellers/confirmbooking",
            data: parameters,
            success: function(response){
                response = JSON.parse(response);
                if (response.Status=="OK"){
                    $("#confirmation").show();
                    $("#bookingData").hide();
                    $("#bookingData input").val('');
                }else{
                    alert("Request Error");
                }
            },
            error: function(){
                alert("error");
            },
            dataType: "html"
        });

    }
    function getParameters(){
        var parameters = {};

        parameters.ResellerID = $("#resellerId").val();
        parameters.Token = $("#token").val();

        return parameters;
    }
</script>