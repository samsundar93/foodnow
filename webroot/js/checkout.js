$(document).ready(function () {
    initialize();
});
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.
var placeSearch, autocomplete,autocomplete1;
var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};

function initialize() {
    // Create the autocomplete object, restricting the search
    autocomplete1 = new google.maps.places.Autocomplete(
        /** @type {HTMLInputElement} */ (document.getElementById('street_address')),
        { types: ['geocode'],componentRestrictions: {country: "IND"} });
    google.maps.event.addListener(autocomplete1, 'place_changed', function() {
        fillInAddress();
    });
}

// The START and END in square brackets define a snippet for our documentation:
// [START region_fillform]
function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete1.getPlace();


    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
        }
    }

}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = new google.maps.LatLng(
                position.coords.latitude, position.coords.longitude);
            autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
                geolocation));
        });
    }
}

$(document).ready(function () {

    $('#addAdderssBtn').on('click', function() {

        var resId          = $("#resId").val();
        var search         = $("#search").val();
        var title          = $("#title").val();
        var flatno         = $("#flatno").val();
        var street_address = $("#street_address").val();
        var street_name    = $("#street_name").val();
        var area_name      = $("#area_name").val();
        var postcode       = $("#postcode").val();
        var land_mark      = $("#land_mark").val();
        $('.error').html('');

        if(title == ''){
            $(".titleErr").addClass('error').html('Please enter the address title');
            $("#title").focus();
            return false;
        }else if(flatno == ''){
            $(".flatnoErr").addClass('error').html('Please enter the home/flat no');
            $("#flatno").focus();
            return false;
        }else if(street_address == ''){
            $(".streetaddErr").addClass('error').html('Please enter the street address');
            $("#street_address").focus();
            return false;
        }else{

            $('#addAdderssBtn').attr('disabled', true);
            $.post(baseUrl+'checkouts/ajaxaction',{
                'search': search,
                'title' : title,
                'flatno': flatno,
                'landmark': land_mark,
                'address':street_address,
                'resId':resId,
                'action': 'addAddress'

            }, function (output) {
                if($.trim(output) == 'error') {
                    $(".streetaddErr").addClass('error').html('Sorry, but we are unable to provide service at your location at this time!');
                    $("#street_address").focus();
                    $('#addAdderssBtn').attr('disabled', false);
                    return false;
                }else if($.trim(output) == '1') {
                    $(".titleErr").addClass('error').html('title already exists');
                    $("#title").focus();
                    $('#addAdderssBtn').attr('disabled', false);
                    return false;
                }else {
                    $("#address_pop").modal('hide');
                    $('#addAdderssBtn').attr('disabled', false);
                    showAllAddress();
                    //showAllDropAddress();

                    $("#selectPickup").html(output);

                    $("#title").val('');
                    $("#flatno").val('');
                    $("#street_address").val('');
                    $("#land_mark").val('');
                }

            });
            return false;
        }
    });

})

function showAllAddress() {
    var resId          = $("#resId").val();

    $.ajax({
        type   : 'POST',
        url    : baseUrl+'checkouts/ajaxaction',
        data   : {'resId':resId,action:'selectAllAddress'},
        success: function(data){
            $("#showAll").html(data);
            return false;

        }
    });return false;
}

function placeOrder() {
    $("#checkoutBtn").attr('disabled',true);
    $(".error").html('');
    var deliveryAddress = $('input:radio[name=checkout_address]:checked').val();
    var stripeId = $('input:radio[name=stripeId]:checked').val();
    var paymentMethod = $('input:radio[name=payment_method]:checked').val();
    var orderType = $('input:radio[name=order_type]:checked').val();

    if((deliveryAddress == '' || deliveryAddress == undefined) && orderType == 'delivery') {
        $("#checkoutBtn").attr('disabled',false);
        $("#addressErr").addClass('error').html('Sorry, but we are unable to continue without a delivery address.');
        return false;

    }else if(paymentMethod == '' || paymentMethod == undefined) {
        $("#checkoutBtn").attr('disabled',false);
        $("#paymentErr").addClass('error').html('Sorry, please choose payment.');
        return false;

    }else {
        if(paymentMethod == 'stripe' && (stripeId == '' || stripeId == undefined)) {

            var handler = StripeCheckout.configure({
                key: 'pk_test_6pRNASCoBOKtIshFeQd4XMUh',
                image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
                locale: 'auto',
                token: function(token) {
                    if(token.id != '') {
                        $("#res-sp-token").val(token.id);
                        //$("#res-sp-payed").val();
                        $("#checkoutForm").submit();return false;
                    }

                }
            });

            var payedAmount = '100';
            // Open Checkout with further options:
            handler.open({
                name: 'Stripe.com',
                description: 'Stripe payment',
                zipCode: false,
                amount: payedAmount*100
            });
            $("#checkoutBtn").attr('disabled',false);
            return false;

            // Close Checkout on page navigation:
            window.addEventListener('popstate', function() {
                handler.close();
            });
            return false;
        }else {
            $("#checkoutForm").submit();return false;
        }

        //
    }

}

function checkAddress() {
    $(".error").html('');
    //var deliveryAddress = $('input:radio[name=selectedAddress]:checked').val();
    var deliveryAddress = $('input:radio[name=checkout_address]:checked').val();
    var orderType = $('input:radio[name=order_type]:checked').val();
    if(orderType == 'delivery') {
        if(deliveryAddress == '' || deliveryAddress == undefined) {
            //Sorry, but we are unable to continue without a delivery address.
            $("#addressErr").addClass('error').html('Sorry, but we are unable to continue without a delivery address.');
            return false;
        }else {
            $("#paymentDetails").css('display','block');
        }
    }else {
        $("#paymentDetails").css('display','block');
    }

    return false;

}

function showCheckout() {
    var paymentMethod = $('input:radio[name=payment_method]:checked').val();
    if(paymentMethod == 'stripe') {
        $("#saveCards").css('display','block');
    }else {
        $("#saveCards").css('display','none');
    }
    $("#checkoutBtn").css('display', 'block');
}

function orderType(type) {
    if(type == 'pickup') {
        $("#deliveryAmt").css('display','none');
        $("#deliveryDetails").css('display','none');
        $(".deliveryTotal").css('display','none');
        $(".pickupTotal").css('display','block');
    }else {
        $("#deliveryAmt").css('display','block');
        $("#deliveryDetails").css('display','block');
        $(".deliveryTotal").css('display','block');
        $(".pickupTotal").css('display','none');
    }

}