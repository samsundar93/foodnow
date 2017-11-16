function reponsiveImages(){	
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
if(window.addEventListener){
	window.addEventListener("load",reponsiveImages,!1);
	window.addEventListener("resize",reponsiveImages,!1);
}
else{
	window.attachEvent("onload",reponsiveImages);
	window.attachEvent("onresize",reponsiveImages);
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


$(document).ready(function() {
  //$('.summernote').summernote();
  var i = 0;
  $('.btn-varient').click(function(){
    i++;
    var option_inputs = '<div class="form-group clearfix"> <div class="col-sm-3"> <label><input type="text" class="form-control my-form-control" value=""></label> </div><div class="col-sm-7 input-tag-div" data-id="'+i+'"> <input type="text" class="form-control my-form-control" value="your tags" > </div><div class="col-sm-1"> <button class="btn btn-pink" onclick="remove_inputtag(this)">Remove</button> </div></div>'
    $('.append-form-group').append(option_inputs);
    $('.input-tag-div[data-id="'+i+'"] input[type=text]').tagsinput();
  });
  $('.quick-desc-add').click(function(){
    var option_inputs = '<div class="form-group append-quick clearfix"> <div class="col-sm-4"></div><div class="col-sm-8"> <div class="col-sm-5"> <input type="text" class="form-control my-form-control" placeholder="Name"> </div><div class="col-sm-5"> <input type="text" class="form-control my-form-control" placeholder="Value"> </div><div class="col-sm-2"> <button class="btn btn-pink" onclick="remove_quick(this)">Remove</button> </div></div></div>'
    $('.quick-desc').append(option_inputs);
  });
  $('.more-image-add').click(function(){
    var option_inputs = '<div class="form-group remove-img clearfix"><div class="col-sm-4"></div> <div class="col-sm-6"> <label class="labelfile" for="upload_image">error.png</label> <input id="upload_image" class="form-control my-form-control my-form-control my-form-control hidden" name="insurance" type="file"> </div><div class="col-sm-2 text-right"> <button class="btn btn-pink more-image-add" onclick="remove_image(this)">Remove</button> </div></div>'
    $('.image-upload').append(option_inputs);
  });
  $('.shipping-add').click(function(){
    var option_inputs = '<tr class="shipping-plus-append"> <td><input type="text" ></td></td><td><input type="text"></td><td><input type="text"></td><td><input type="text"></td><td><button class="btn btn-pink shipping-add" onclick="remove_tableRow(this)">-</button></td></tr>'
    $('tbody').append(option_inputs);
  });
   $('.tax-add').click(function(){
    var option_inputs = '<div class="form-group clearfix"> <div class="col-sm-4"></div><div class="col-sm-8"> <div class="col-sm-5 no-padding-left"> <div class="col-sm-12 no-padding"><input type="text" class="form-control my-form-control"></div></div><div class="col-sm-5"> <div class="col-sm-12 no-padding"><input type="text" class="form-control my-form-control"></div></div><div class="col-sm-2 text-right" onclick="remove_tax(this)"> <button class="btn btn-pink tax-add">-</button> </div></div></div>'
    $('.tax-add-div').append(option_inputs);
    return false;
  });
});
function remove_inputtag(id) {
    $(id).closest('.form-group').remove();
  }
function remove_quick(id) {
    $(id).closest('.append-quick').remove();
  }
  function remove_image(id) {
    $(id).closest('.remove-img').remove();
  }
  function remove_tableRow(id) {
    $(id).closest('.shipping-plus-append').remove();
  }
   function remove_tax(id) {
    $(id).closest('.form-group').remove();
  }
  $(function($) {
  $('#upload_image').change(function() {
    var fullPath = $(this).val();
    if (fullPath) {
        var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
        var filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
            filename = filename.substring(1);
        }
        $('[for="upload_image"]').html(filename);
    }
  });
});
  $(document).ready(function() {
    $('input[name=free-ship]').click(function(){
      if(this.id =='free-ship-no') {
        $('.shipping-table').show();
      }
      else{ 
        $('.shipping-table').hide();
      }

    });

    $('input[name=price-option]').click(function(){
      if(this.id =='price-option-mul') {
        $('.single-radio-content').hide();
        $('.multiple-radio-content').show();
      }
      else{ 
        $('.multiple-radio-content').hide();
        $('.single-radio-content').show();
      }

    });
  });

  $(document).ready(function(){
        $(".category li input").change(function(){
        if($(this).prop("checked") == true){
            $(this).parent().next("ul").find("[type=checkbox]").prop("checked",true);
        }
        else{
            $(this).parent().next("ul").find("[type=checkbox]").prop("checked",false);
        }
      });
      $(".category ul.subcategory input").change(function(){
        var checklength = $(this).closest('ul').find('input[type=checkbox]').length;
        var checkedlength = $(this).closest('ul').find('input[type=checkbox]:checked').length;
        if(checklength == checkedlength) {
        $(this).closest('ul').prev('a').find('input[type=checkbox]').prop("checked",true);
        }
        else{
         $(this).closest('ul').prev('a').find('input[type=checkbox]').prop("checked",false);
        }
      });
      $(".category ul.subcategory input").change(function(){
        var checklength = $(this).closest('ul').find('input[type=checkbox]').length;
        var checkedlength = $(this).closest('ul').find('input[type=checkbox]:checked').length;
        if(checklength == checkedlength) {
        $(this).closest('ul').prev('a').find('input[type=checkbox]').prop("checked",true);
        }
        else{
         $(this).closest('ul').prev('a').find('input[type=checkbox]').prop("checked",false);
        }
      });
      $('.category li span').click(function(){
        $(this).siblings('.subcategory').slideToggle('fast');
      });
      $('.subcategory li span').click(function(){
        $(this).siblings('.childcategory').slideToggle('fast');
      });
  });

function loginValidate() {
  $(".error").html('');
  var name = $("#username").val();
  var password = $("#password").val();
  if(name == '') {
      $('[id="username"]').after('<label class="error">Please enter username</label>');
      $('[id="username"]').select();
      return false;
  }else if(password == '') {
      $('[id="password"]').after('<label class="error">Please enter password</label>');
      $('[id="password"]').select();
      return false;
  }

}

function changeStatus(id, changestaus, field, urlval, action)
{
    $.ajax({
        type   : 'POST',
        url    : jsSitePartner+''+urlval,
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
            url    : jsSitePartner+''+urlval,
            data   : {id:id, page:page, action:action},
            success: function(data){

                $("#ajaxReplace").html(data);
                $("#"+loadDiv).DataTable({
                    columnDefs: [ { orderable: false, targets: [-1,-2] } ]
                });
            }
        });return false;
    }
}