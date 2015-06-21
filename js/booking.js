var Booking = new function(){
    var me = this;

    me.getTourTickets= function(tourId){
        var parameters = {};
        parameters.tourid = tourId;

        $.ajax({
            type: "GET",
            url: "api/bookings/gettourtickets",
            data: parameters,
            success: function(response){
                response = JSON.parse(response);



            },
            error: function(){
                alert("error");
            },
            dataType: "html"
        });
    }
}