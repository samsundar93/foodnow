$(document).ready(function(){

    $('.cart-item-height').enscroll();
    $('.seacr-banner').slick({
         infinite: true,
         dots:true,
         arrow:false,
         autoplay: true,
        autoplaySpeed: 2000,
    });
    

    $(window).on('scroll',function(){
        var navheight = ($('.breadcrump').outerHeight() + $('.searchpage-search').outerHeight());
        if($(window).scrollTop() > navheight){
            $('.searchpage-search').addClass('fixed')
        }
        else {
            $('.searchpage-search').removeClass('fixed')
        }
        var filterheight = (($('.searchpage-search').outerHeight()+ $('.search-banner-sec').outerHeight()) - 150);
        var top = $('.searchpage-search').outerHeight();
        if($(window).scrollTop() > filterheight){
            $('.filter-searc-sec').addClass('filterfixed').css('top',top)
        }
        else {
            $('.filter-searc-sec').removeClass('filterfixed').css('top',0)
        }
    });

    $('.cusine').click(function(){
        $('.filter-content-type').hide();
        $('.filter-content-part').toggle();
    });
    $('.cusine-cancel-btn').click(function(){
        $('.filter-content-part').hide();
    });

    $('.resttype').click(function(){
        $('.filter-content-part').hide();
        $('.filter-content-type').toggle();
    });
    $('.type-cancel-btn').click(function(){
        $('.filter-content-type').hide();
    });



});

/* cartpage script*/
$(window).on('scroll',function(){
    var cartnavheight = ($('.breadcrump').outerHeight() + $('.cartpage-search').outerHeight());
    var cartpagesearchHeight =  $('.cartpage-search').outerHeight();
    if($(window).scrollTop() > cartnavheight){
        $('.cartpage-search').addClass('cart-fixed')
        $('.restaurant-head-sec').addClass('cart-fixed').css('top',cartpagesearchHeight)
    }
    else {
        $('.cartpage-search').removeClass('cart-fixed')
        $('.restaurant-head-sec').removeClass('cart-fixed').css('top',cartpagesearchHeight)
    }
    var headerheight = ($('.cartpage-search').outerHeight() + $('.restaurant-head-sec').outerHeight());
    var sidebarwidth = $('.sidebar').outerWidth();
    var cartboxwidth = $('.cart-scrolladd-box').outerWidth();
    var middleheight = $(window).outerHeight() - ($('.cartpage-search').outerHeight() + $('.restaurant-head-sec').outerHeight() + $('.copyright').outerHeight());
    var cart_item = $(window).outerHeight() - ($('.cartpage-search').outerHeight() + $('.restaurant-head-sec').outerHeight()+ $('.cart-add-box-tittle').outerHeight() + $('.cart-add-box-res').outerHeight()+ $('.cart-add-box-pay').outerHeight()+$('.checkout-btn').outerHeight()+$('.pickup-door').outerHeight() );


    if($(window).scrollTop() > cartnavheight){
        $('.cart-menu-box').addClass('cart-fixed').css({"top": headerheight, "width": sidebarwidth});
        $('.cart-add-box').addClass('cart-fixed').css({"top": headerheight, "width": cartboxwidth});
        $('.cart-item-height').css({"max-height": cart_item})
    }
    else {
        $('.cart-menu-box').removeClass('cart-fixed').css({"top": headerheight, "width": sidebarwidth});
        $('.cart-add-box').removeClass('cart-fixed').css({"top": headerheight, "width": cartboxwidth});
    }

});

$(document).ready(function(){

        $('.dropmenu').hide();

        $(".cart-menu-box-ul li a").click(function(){
            $('.cart-menu-box-ul li a').removeClass('active');
             $(this).addClass('active');
            if ($('.dropmenu').is(':visible')) {
            $(".dropmenu").slideUp();             
            }
            if ($(this).next(".dropmenu").is(':visible')) {
                $(this).next(".dropmenu").slideUp();
                $(this).children(".arrow-icon").css('transform','rotate(360deg)');
                $(this).removeClass('active');
            } 
            else {
                $(this).next(".dropmenu").slideDown();
                $(this).children(".arrow-icon").css('transform','rotate(180deg)');
                $(this).addClass('active');
                    }
            });

    });
$(document).ready(function(){
        $(".message").addClass("success");
        setTimeout(function(){
            $(".message").removeClass("success");
        },3000);
        $(".message-error").addClass("success");
        setTimeout(function(){
            $(".message-error").removeClass("success");
        },3000);
    });



function userRegister() {

	$(".error").html('');
    var phone_pattern = /([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/;
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	var name = $("#name").val();
	var username = $("#username").val();
	var phone_number = $("#phone_number").val();
	var password = $("#password").val();

	if(name == '') {
        $(".nameErr").addClass('error').html('Please your name');
        $("#name").focus();
        return false;

	}else if(username == '') {
        $(".usernameErr").addClass('error').html('Please enter your email address');
        $("#username").focus();
        return false;

	}else if(!regex.test(username)) {
        $(".usernameErr").addClass('error').html('Please enter valid email');
        $("#username").focus();
        return false;

    }else if(phone_number == '') {
        $(".phoneErr").addClass('error').html('Please enter your phone number');
        $("#phone_number").focus();
        return false;

	}else if(!phone_pattern.test( phone_number )) {
        $(".phoneErr").addClass('error').html('Please enter valid phonenumber');
        $("#phone_number").focus();
        return false;

    }else if(password == '') {
        $(".passErr").addClass('error').html('Please enter password');
        $("#password").focus();
        return false;
	}else {
        $.ajax({
            type   : 'POST',
            url    : baseUrl+'users/checkCustomer',
            data   : {phone_number:phone_number,username:username,name:name,password:password},
            success: function(data){
                if($.trim(data) == 'false') {
                    $(".commonErr").addClass('error').html('This email or phone number already exists');
                    return false;
                }else {
                    window.location.reload();
                    return false;
                }

            }
        });return false;
	}
}

function customerRegister() {
	$(".error").html('');
    var username = $("#loginUser").val();
    var password = $("#loginPass").val();

    if(username == '') {
        $(".userLoginErr").addClass('error').html('Please enter registered mobile number');
        $("#loginUser").focus();
        return false;

	}else if(password == '') {
        $(".userPassErr").addClass('error').html('Please enter password');
        $("#loginPass").focus();
        return false;
	}else {
        $.ajax({
            type   : 'POST',
            url    : baseUrl+'users/customerLogin',
            data   : {username:username,password:password},
            success: function(data){
                if($.trim(data) == '0') {
                    $(".userPassErr").addClass('error').html('Invalid Login');
                    return false;
                }else if($.trim(data) == '1') {
                    window.location.reload();
                    return false;
                }else if($.trim(data) == '2') {
                    $(".userPassErr").addClass('error').html('Your account has been deactive. Please Contact Admin');
                    return false;
                }else if($.trim(data) == '3') {
                    $(".userPassErr").addClass('error').html('Invalid Request');
                    return false;
                }

            }
        });return false;
	}
	
}

function searchLocation() {
	$(".error").html('');
	var enterSearch = $("#enterSearch").val();

	if(enterSearch == '') {
        $(".addressErr").addClass('error').html('Please enter your delivery location');
        $("#searchLocation").focus();
        return false;
	}
}

function filter() {
    $(".filter-content-part").css('display','none');
    if($("input[name='filterCuisines']:checked").length > 0) {

        var cuisineLen = $("input[name='filterCuisines']:checked").length;
        $.each($("input[name='filterCuisines']:checked"), function(){
            var i=0;
            var restLength = $('.restLists').length;
            var id = $(this).val();
            $('.restLists').each(function () {

                var attr = $(this).attr('data-cuisines');
                var matches = attr.match(id);

                if(matches == null) {
                   if($(this).hasClass('Cuisine removeCuisine') || $(this).hasClass('removeCuisine Cuisine')) {
                        $(this).removeClass('Cuisine removeCuisine');
                        $(this).removeClass('removeCuisine Cuisine');
                    }else if($(this).hasClass('Cuisine')){
                        $(this).addClass('Cuisine removeCuisine');
                    }else {
                        $(this).addClass('removeCuisine');
                    }

                }else {
                    $(this).addClass('Cuisine');
                }
            });
            cuisineLen--;
        });

    }else {
        $('.restLists').each(function () {
            $(this).removeClass('filterCuisine');
            $(this).addClass('Cuisine');
        })

    }

    if(cuisineLen == 0) {
        $('.restLists').each(function () {
            if(!$(this).hasClass('Cuisine')) {
                $(this).addClass('filterCuisine');
            }else {
                $(this).removeClass('filterCuisine');
            }
        });
    }
    return false;
}