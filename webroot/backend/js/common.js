
$(document).ready(function(){

    //$('#myTable').DataTable();
    $("#stripe-payment-mode-live").click(function() {
        $("#payLive").show();
        $("#payTest").hide();
    });
    $("#stripe-payment-mode-test").click(function() {
        $("#payTest").show();
        $("#payLive").hide();
    });

    $("#sms-mode-live").click(function() {
        $("#smstwillo").show();
    });
    $("#sms-mode-demo").click(function() {
        $("#smstwillo").hide();
    });

    $("#sms-mode-on").click(function() {
        $("#sms_div").show();
    });

    $("#sms-mode-off").click(function() {
        $("#sms_div").hide();
    });

    $("#search-by-normal").click(function() {
        $("#normal").show();
    });

    $("#search-by-google").click(function() {
        $("#normal").hide();
    });


    $("#offer-type-price").click(function() {
        $("#priceType").show();
        $("#percentType").hide();
    });

    $("#offer-type-percentage").click(function() {
        $("#percentType").show();
        $("#priceType").hide();
    });



    $("#phone_number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});

function changeStatus(id, changestaus, field, urlval, action)
{
    $.ajax({
        type   : 'POST',
        url    : baseUrl+''+urlval,
        data   : {id:id, field:field ,changestaus:changestaus,action:action},
        success: function(data){
            //clearConsole();
            if(action == '') {
                window.location.reload();
            }else {
                $("#"+field+"_"+id).html(data);
                return false;
            }
        }
    });
    return false;
}



function deleteRecord(id, urlval, action, page, loadDiv)
{
    var str = "Are you sure want to delete this "+action;
    if(confirm(str))
    {
        $("#maska").show();$(".ui-loader").show();
        $.ajax({
            type   : 'POST',
            url    : baseUrl+''+urlval,
            data   : {id:id, page:page, action:action},
            success: function(data){

                $("#ajaxReplace").html(data);
                if(action != 'customer' && action != 'Followers'){
                    $("#"+loadDiv).DataTable({
                        columnDefs: [ { orderable: false, targets: [-1,-2] } ]
                    });
                }else if(action == 'Followers'){
                    $("#"+loadDiv).DataTable({
                        columnDefs: [ { orderable: false, targets: [-1,-2,-4] } ]
                    });
                }
            }
        });return false;
    }
}


function customerSignup() {

    var name            = $.trim($("#custname").val());
    var email           = $.trim($("#custemail").val());
    var password        = $.trim($("#custpassword").val());
    var phonenumber     = $.trim($("#custphone").val());
    var profile_photo   = $.trim($(".profile_photo").html()) ;
    var img             = $('.profile_photo').html().split('.').pop().toLowerCase();
    $('.error').html('');

    if(name == '') {
        $("#nameErr").addClass('error').html('Please enter your name');
        $("#custname").focus();
        return false;
    }else if(email == '') {
        $("#emailErr").addClass('error').html('Please enter your email address');
        $("#custemail").focus();
        return false;
    }else if(email != '' && !isValidEmailAddress(email)) {
        $("#emailErr").addClass('error').html('Please enter valid email address');
        $("#custemail").focus();
        return false;
    }else if(password == '') {
        $("#passwordErr").addClass('error').html('Please enter your password');
        $("#custpassword").focus();
        return false;
    }else if(phonenumber == '') {
        $("#phoneErr").addClass('error').html('Please enter your phonenumber');
        $("#custphone").focus();
        return false;
    }else if(profile_photo == ''){
        $(".imageErr").addClass('error').html('Please enter the item image');
        $(".profile_photo").focus();
        return false;

    }else if(profile_photo != '' && $.inArray(img, ['gif','png','jpg','jpeg']) == -1){
        $(".imageErr").addClass('error').html("Please Select the Valid Image Type");
        $(".profile_photo").focus();
        return false;

    }else{
        $.post(jssitebaseUrl+'users/customerSignup', {
            'name' : name,
            'username': email,
            'password':password,
            'phone_number':phonenumber
        }, function (output) {
            output = JSON.parse(output);
            if (output.sucess == 1) {
                window.location.reload();
            } else if (output.sucess == 2) {
                $("#commonErr").addClass('error').html('Mail Already exists');
                $("#custemail").focus();
                return false;
            }else {
                $("#commonErr").addClass('error').html('Required Fields are missing');
                return false;
            }
        });
    }
    return false;
}
$(document).ready(function(){
    $('.mask_checkbox input[type=checkbox]').change(function(){
        if($(this).is(':checked')){
            $(this).parents('.parent').find('.mask-div-child').addClass('mask-div-active')
        }
        else {
            $(this).parents('.parent').find('.mask-div-child').removeClass('mask-div-active')
        }
    });
});
