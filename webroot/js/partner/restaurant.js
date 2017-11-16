function restaurantEdit() {
    alert('comeee');
    $(".error").html('');
    //$(".#contact").removeClass('error');
    //$(".#info").removeClass('error');
    var phone_pattern = /([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/;
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    var contact_name = $("#contact_name").val();
    var contact_phone = $("#contact_phone").val();
    var contact_email = $("#contact_email").val();
    var contact_address = $("#contact_address").val();
    var restaurant_name = $("#restaurant_name").val();
    var restaurant_phone = $("#restaurant_phone").val();
    var restaurant_tax = $("#restaurant_tax").val();
    //var restaurant_email = $("#restaurant_email").val();
    var estimate_time = $("#estimate_time").val();
    var minimum_order = $("#minimum_order").val();
    var delivery_charge = $("#delivery_charge").val();
    var delivery_distance = $("#delivery_distance").val();
    var restaurant_commission = $("#restaurant_commission").val();

    if(contact_name == '') {
        $("#contact").click();
        $("#contact_name").after('<label class="error">Please enter contact name</label>');
        $("#contact_name").focus();
        return false;

    }else if(contact_phone == '') {
        $("#contact").click();
        $("#contact_phone").after('<label class="error">Please enter contact phone</label>');
        $("#contact_phone").focus();
        return false;

    }else if(!phone_pattern.test( contact_phone )) {
        $("#contact").click();
        $("#contact_phone").after('<label class="error">Please enter valid phone</label>');
        $("#contact_phone").focus();
        return false;

    }else if(contact_email == '') {
        $("#contact").click();
        $("#contact_email").after('<label class="error">Please enter contact email</label>');
        $("#contact_email").focus();
        return false;

    }else if(!regex.test(contact_email)) {
        $("#contact").click();
        $("#contact_email").after('<label class="error">Please enter valid contact mail</label>');
        $("#contact_email").focus();
        return false;

    }else if(contact_address == '') {
        $("#contact").click();
        $("#contact_address").after('<label class="error">Please enter contact address</label>');
        $("#contact_address").focus();
        return false;

    }else if(restaurant_name == '') {
        $("#info").click();
        $("#restaurant_name").after('<label class="error">Please enter valid restaurant name</label>');
        $("#restaurant_name").focus();
        return false;

    }else if(restaurant_phone == '') {
        $("#info").click();
        $("#restaurant_phone").after('<label class="error">Please enter valid contact mail</label>');
        $("#restaurant_phone").focus();
        return false;

    }else if(!phone_pattern.test( restaurant_phone )) {
        $("#info").click();
        $("#restaurant_phone").after('<label class="error">Please enter valid phonenumber</label>');
        $("#restaurant_phone").focus();
        return false;

    }else if(restaurant_tax == '') {
        $("#info").click();
        $("#restaurant_tax").after('<label class="error">Please enter restaurant tax</label>');
        $("#restaurant_tax").focus();
        return false;

    }else if(estimate_time == '') {
        $("#delivery").click();
        $("#estimate_time").after('<label class="error">Please enter estimate time</label>');
        $("#estimate_time").focus();
        getMap();
        return false;

    }else if(minimum_order == '') {
        $("#delivery").click();
        $("#minimum_order").after('<label class="error">Please enter minimum order amount</label>');
        $("#minimum_order").focus();
        getMap();
        return false;

    }else if(delivery_charge == '') {
        $("#delivery").click();
        $("#delivery_charge").after('<label class="error">Please enter delivery charge</label>');
        $("#delivery_charge").focus();
        getMap();
        return false;

    }else if(delivery_distance == '') {
        $("#delivery").click();
        $("#delivery_distance").after('<label class="error">Please enter delivery distance</label>');
        $("#delivery_distance").focus();
        getMap();
        return false;

    }else if(restaurant_commission == '') {
        $("#commission").click();
        $("#restaurant_commission").after('<label class="error">Please enter restaurant commission</label>');
        $("#restaurant_commission").focus();
        return false;
    }else {
        var Url             = jsSitePartner+"restaurants/checkEmail";
        var restaurantId = $("#restaurantId").val();
        $.post(
            Url,
            {contact_email:contact_email},
            function(data) {
                if($.trim(data) == 'false') {
                    $("#contact").click();
                    $("#contact_email").after('<label class="error">Email already exists</label>');
                    $("#contact_email").focus();
                    return false;
                }else {
                    document.restaurantForm.submit();
                }
                return false;
            }

        );
        return false;
    }
}