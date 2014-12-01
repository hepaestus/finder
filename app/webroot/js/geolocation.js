$( document ).ready(function() {
    //console.log( "ready!" );
    var lat = 0;
    var lng = 0;
    var loc;
    $("#ExtendedProfilePostalCode").focusout(function() {
        $.get("http://maps.googleapis.com/maps/api/geocode/json?components=postal_code:" + $("#postalcode").val() + "&sensor=false", function(response) {
            var results = response['results'][0];
            var address_str = results.formatted_address;
            lat = results.geometry.location.lat;
            lng = results.geometry.location.lng;
            console.log("From Postal Code: " + lat + "," + lng);
            $("#ExtendedProfileLatitude").val(lat);
            $("#ExtendedProfileLlongitude").val(lng);
        });
    });
    
    function GetLocation(loc) {
        lat = loc.coords.latitude;
        lng = loc.coords.longitude;
        console.log("From Geolocation: " + lat + "," + lng);
        initializeMap();
        //$("#ExtendedProfilePostalCode").val(loc.postalcode);
        $("#ExtendedProfileLatitude").val(loc.coords.latitude);
        $("#ExtendedProfileLongitude").val(loc.coords.longitude);
    }
    
    navigator.geolocation.getCurrentPosition(GetLocation); 
