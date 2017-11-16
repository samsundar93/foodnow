function reponsive(){
	var imglength = document.getElementsByClassName("data-responsive");
	for(var i=0;i<imglength.length;i++){
		if(window.innerWidth<480){
			var url = imglength[i].getAttribute("data-xs");
			imglength[i].setAttribute("src",url);
		}
		else if(window.innerWidth>=480 && window.innerWidth<768){	
			var url = imglength[i].getAttribute("data-sm");
			imglength[i].setAttribute("src",url);
		}
		else if(window.innerWidth>=768 && window.innerWidth<1024){
			var url = imglength[i].getAttribute("data-md");
			imglength[i].setAttribute("src",url);
		}
		else{
			var url = imglength[i].getAttribute("data-lg");
			imglength[i].setAttribute("src",url);
		}
	}	
	return false;
}

function reponsiveq(){
	$("img").each(function(){
		if($(window).width()<480){
			var url = $(this).attr("data-xs");
			$(this).attr("src",url);
		}
		else if($(window).width()>=480 && $(window).width()<768){
			var url = $(this).attr("data-sm");
			$(this).attr("src",url);
		}
		else if($(window).width()>=768 && $(window).width()<1024){
			var url = $(this).attr("data-md");
			$(this).attr("src",url);
		}
		else{
			var url = $(this).attr("data-lg");
			$(this).attr("src",url);
		}
	});
}
if(window.addEventListener){
	window.addEventListener("load",reponsive,!1);
	window.addEventListener("resize",reponsive,!1);
}
else{
	window.attachEvent("onload",reponsive);
	window.attachEvent("onresize",reponsive);
};

$(document).ready(function(){
	$('.products-list').slick({
		autoplay:true,
		arrows:true,
		prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
		nextArrow:'<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>',
		infinite:false,
		slidesToShow:4
	});
	$('.brand-list').slick({
		autoplay:true,
		arrows:true,
		prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
		nextArrow:'<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>',
		infinite:false,
		slidesToShow:6
	});
	$(".header-cart").click(function(){
		$("#sidebar-right").toggle();
		$(".sidebar_overlay").toggleClass("sidebar_overlay_active");
	});
	$(".close-icon-white").click(function(){
		$("#sidebar-right").toggle();
		$(".sidebar_overlay").toggleClass("sidebar_overlay_active");
	});
	$(".range-slider").slider({
		range: true,
		min: 0,
		max: 500,
		values: [ 75, 300 ],
			slide: function( event, ui ) {
			$("#startvalue").val($(".range-slider").slider("values",0));
			$("#endvalue").val($(".range-slider").slider("values",1));
		}
	});
	
});