function variantShowHide() {
    var priceOption = $('[name="Products[price_option]"]:checked').val();
    if (priceOption == 'single') {
        $('.single-radio-content').show();
        $('.multiple-radio-content').hide();
    } else if (priceOption == 'multiple') {
        $('.single-radio-content').hide();
        $('.multiple-radio-content').show();
    }
}

function generateVariants() {
    $('.error').remove();
    var variantList = $('.variantClass').length;

    var pricetype = $('[name="Products[ask_price]"]:checked').val();
    var action = '';
    alert(variantList);
    if(pricetype == 1)
        action = "display: none";
    /*else
     action = "display: inline-block";*/

    if (variantList > 0) {
        $('.variantClass').each(function() {


            var id = this.id.split('_');
            //Products[variant][2][option]
            if($('[name="Products[variant]['+id[1]+'][option]"]').val() == '') {
                $('.error').remove();
                $('[name="Products[variant]['+id[1]+'][option]"]').after('<label class="error">Please enter variant option value</label>');
                return false;
            }

            if ($('[name="Products[variant]['+id[1]+'][value]"]').val() == '') {
                $('.error').remove();
                $('[name="Products[variant]['+id[1]+'][value]"]').after('<label class="error">Please enter variant option value</label>');
                return false;
            }
            var exist = 0;
            $('.variantClass').each(function() {
                var nowId = this.id.split('_');
                if ($('[name="Products[variant]['+nowId[1]+'][option]"]').val() == $('[name="Products[variant]['+id[1]+'][option]"]').val()) {
                    exist++;
                    if (exist >= 2) {
                        $('.error').remove();
                        $('[name="Products[variant]['+nowId[1]+'][option]"]').after('<label class="error">Variant option name already exist</label>');
                        return false;
                    }
                }
            });
            variantList--;
        });

        if (variantList == 0) {
            var variants = new Array('');
            var options  = new Array();
            var temp     = new Array();
            var i = 0;
            $('.variants').each(function() {
                if (this.value != '') {
                    options[i] = this.value;
                    i++;
                }
            });
            i = 0;

            var l = 0;
            for (var i = 0; i < options.length; i++) {
                var optionSplit = options[i].split(',');

                for (var j = 0; j < variants.length; j++) {
                    for (var k = 0; k < optionSplit.length; k++) {
                        if (variants[j] == '') {
                            temp[l] = optionSplit[k];
                        } else {
                            temp[l] = variants[j] +' | '+ optionSplit[k];
                        }
                        l++
                    }
                }
                variants = temp;
                l = 0;
                temp = new Array();
            }
            var html = '';
            for (var m = 0; m < variants.length; m++) {
                html += '<tr>' +
                    '<td>' +
                    '<input class="form-control my-form-control generatedPattern" type="text" id="pattern_'+m+'" name="Products[generated]['+m+'][pattern]" placeholder="Pattern/Design No">' +
                    '</td>' +
                    '<td class="text-left">' +variants[m]+
                    '<input type="hidden" name="Products[generated]['+m+'][name]" value="'+variants[m]+'">' +
                    '</td>' +
                    '<td>' +
                    '<input class="form-control my-form-control" type="text" id="stack_'+m+'" name="Products[generated]['+m+'][stack]" placeholder="Quantity" value="1">' +
                    '</td>' +
                    '<td>' +
                    '<input class="form-control my-form-control" type="text" id="min_'+m+'" name="Products[generated]['+m+'][min]" placeholder="Price" value="1">' +
                    '</td>' +

                    '</tr>';
            }
            $('#genarated_varients').show();
            $('#generatedVariants').html('');
            $('#generatedVariants').append(html);
        }
    }
    return false;
}

var v = 1;
function addVariant() {

    var category = $.trim($('#category_id').val());

    if (category != '') {

        var html = '<div class="form-group clearfix variantClass" id="variantContent_'+v+'"> <div class="col-sm-3"> <label><input type="text" name="Products[variant]['+v+'][option]" class="form-control my-form-control" value="" ></label> </div><div class="col-sm-4 input-tag-div" data-id="'+v+'"> <input type="text" name="Products[variant]['+v+'][value]" data-role="tagsinput" class="form-control my-form-control variants" value="" > </div><div class="col-sm-1"> <a name="variantContent_'+v+'" class="btn btn-pink varientRemove" onclick="removeId(this.name)">Remove</a> </div></div>'
        $('#variantList').append(html);
        //$('.variants:last').tagsinput()
        $('.input-tag-div[data-id="'+v+'"] input[type=text]').tagsinput();
        v++;
    }else {
        $(".shopCategoryErr").addClass('error').html('Please choose category');
        $("#category_id").focus();
        return false;
    }
    return false;
}

function removeId(id) {
    $('#'+id).remove();
    return false;
}

var i= 1;
function addProductImage() {
    if($('#productImage_'+i+'').length !== 0) {
        i++;
        addProductImage();
        return false;
    }
    var option_inputs = '<div class="form-group remove-img clearfix"><div class="col-sm-4"></div> <div class="col-sm-6"> <label class="labelfile" for="product_image_'+i+'">Choose Image</label> <input id="product_image_'+i+'" class="form-control my-form-control hidden product_image" name="product_image[]" type="file"><input type="hidden" id="productImage_'+i+'" class=""> </div><div class="col-sm-2 text-right"> <button class="btn btn-pink more-image-add" onclick="remove_image(this)">Remove</button> </div></div>'
    $('.image-upload').append(option_inputs);


    $(".product_image").change(function () {
        var fullPath = $(this).val();
        if (fullPath) {
            var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
            var filename = fullPath.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
            var fileType = filename.substring(2);
            var type = fileType.split('.');
            if($.inArray(type[1], ['gif','png','jpg','jpeg']) == -1) {
                alert('Please Select the Valid Image Type');
                return false;
            }else {
                var currId = this.id;
                var split = currId.split('_');
                $('[for="'+this.id+'"]').html(filename);
                $('[id="productImage_'+split[2]+'"]').val(filename);
                $("#productImage_"+split[2]).addClass('uploadProduct');
            }

        }
    });
    i++;


    return false;
}


$(function($) {
    $(".product_image").change(function () {
        var fullPath = $(this).val();
        if (fullPath) {
            var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
            var filename = fullPath.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
            var fileType = filename.substring(2);
            var type = fileType.split('.');
            if($.inArray(type[1], ['gif','png','jpg','jpeg']) == -1) {
                alert('Please Select the Valid Image Type');
                return false;
            }else {
                var currId = this.id;
                var split = currId.split('_');
                $('[for="'+this.id+'"]').html(filename);
                $('[id="productImage_'+split[2]+'"]').val(filename);
                $("#productImage_"+split[2]).addClass('uploadProduct');
            }
        }
    });
});

function deleteImage(id) {
    if (id != '') {
        var seller_id = $("#seller_id").val();
        $.post(jssitebaseurl+'products/deleteImage', {'imgId' : id, 'action' : 'ImageDelete','seller_id':seller_id}, function() {
            $('#productImage'+id).remove();
        });
    }
}
var j =1;
function addProductDesc() {

    if($('#productDes_'+j+'').length !== 0) {
        j++;
        addProductDesc();
        return false;
    }

    var option_inputs = '<div class="form-group append-quick clearfix"> <div class="col-sm-4"></div><div class="col-sm-8"> <div class="col-sm-5"> <input type="text" class="form-control my-form-control" id="productDes_'+j+'" name="Products[Detail]['+j+'][name]" placeholder="Name"> </div><div class="col-sm-5"> <input type="text" class="form-control my-form-control" name="Products[Detail]['+j+'][value]" placeholder="Value"> </div><div class="col-sm-2"> <a class="btn btn-danger" onclick="remove_quick(this)">Remove</a> </div></div></div>'
    $('#addMoreDetail').append(option_inputs);
    j++;
    return false;

}

var t= 1;
function addProductTax() {

    if($('#tax_name_'+t+'').length !== 0) {
        t++;
        addProductTax();
        return false;
    }

    var option_inputs = '<div class="form-group clearfix"> <div class="col-sm-4"></div><div class="col-sm-8"> <div class="col-sm-5 no-padding-left"> <div class="col-sm-12 no-padding"><input placeholder="Tax Name" name="Products[Tax]['+t+'][name]" type="text" id="tax_name_'+t+'" class="form-control my-form-control"></div></div><div class="col-sm-5"> <div class="col-sm-12 no-padding"><input type="text" name="Products[Tax]['+t+'][percentage]" placeholder="Tax Percentage" id="tax_percentage" class="form-control my-form-control"></div></div><div class="col-sm-2 text-right" onclick="remove_tax(this)"> <a class="btn btn-pink">-</a> </div></div></div>'
    $('.tax-add-div').append(option_inputs);
    t++;
    return false;

}
$(document).ready(function(){

    $('input[name=free_shipping]').click(function(){
        if(this.id =='free_shipping_no') {
            $('.international_shipping').show();
            $('.shipping-table').show();
        }
        else{
            $('.international_shipping').hide();
            $('.shipping-table').hide();
        }

    });


    $('.all-checkbox input[type=checkbox]').change(function(){
        if($(this).is(":checked")==true){
            $('.checkbox-table').find("input[type=checkbox]").prop("checked", true);
        }
        else{
            $('.checkbox-table').find("input[type=checkbox]").prop("checked", false);
        }

    });
    $('.checkbox-table input[type=checkbox]').change(function(){
        if($(this).is(":checked")==true){$('#send').show();}
        else{$('#send').hide();}
    });
    countrysearchfilter();
});

var s = 1;
var shipCountryList = $(".auto-drop-down").html();
function addShipping() {

    if($('#country_'+s+'').length !== 0) {
        s++;
        addShipping();
        return false;
    }

    var shipCountryList = $(".auto-drop-down").html();

    var option_inputs = '<tr class="shipping-plus"> <td><div class="relative shipdropdowm"><input autocomplete="off" id="shipTo_'+s+'" type="text" placeholder="Enter Country" class="countrySearch form-control my-form-control"><ul class="auto-drop-down dropDownList">'+shipCountryList+'</ul></div><input type="hidden" id="country_'+s+'" name="Products[Shipping]['+s+'][country]" value=""></td></td><td><input class="form-control my-form-control" type="text" id="processing_time_'+s+'" name="Products[Shipping]['+s+'][processing]" ></td><td><input class="form-control my-form-control" type="text" name="Products[Shipping]['+s+'][cost]" id="cost_'+s+'"></td><td><input class="form-control my-form-control" type="text" name="Products[Shipping]['+s+'][extra_cost]" id="extra_cost_'+s+'"></td><td><button class="btn btn-violet shipping-add" onclick="remove_tableRow(this)">-</button></td></tr>';
    $('#shippingplus').append(option_inputs);
    s++;
    countrysearchfilter();

}
function countrysearchfilter(){
    $('.countrySearch').keyup(function(){
        $(".error").remove();
        $(this).next(".auto-drop-down").show();
        var that = this, $allListElements = $(this).next('.auto-drop-down').find('li');
        var $matchingListElements = $allListElements.filter(function(i, li){
            var listItemText = $(li).text().toUpperCase(), searchText = that.value.toUpperCase();
            return ~listItemText.indexOf(searchText);
        });
        $allListElements.hide();
        $matchingListElements.show();
    });
    $(".auto-drop-down li").click(function () {
        $(".auto-drop-down").hide();
        var id = $(this).attr('id');
        //$(this).parents(".shipdropdowm").next("input[type=hidden]").attr("value",id);
        $(this).parents(".shipdropdowm").next("input[type=hidden]").attr("value",$(this).text());
        $(this).parent("ul").prev(".countrySearch").val($(this).text())
    })
}
function getDropDown(type) {
    if(type == 'yes') {
        var action = 'getCountry'
    }else {
        var action = 'getCity'
    }

    $.ajax({
        type   : 'POST',
        url    : jssitebaseurl+'products/ajaxaction',
        data   : {action:action},
        success: function(data){
            $(".dropDownList").html(data);
            countrysearchfilter();
            return false;
        }
    });
    return false;

}

function productAddEdit() {
    $(".error").html('');

    var productId = $("#productId").val();
    var shopname = $("#shop_name").val();
    var product_name = $("#product_name").val();
    var category_id = $("#category_id").val();
    var subcategory_id = $("#subcategory_id").val();
    var sibling_id = $("#sibling_id").val();
    var other = $("#other").val();


    if(shopname == '') {
        $('#shop_name').after('<label class="error">Please choose shop name</label>');
        $('#shop_name').select();
        return false;
    }else if(product_name == '') {
        $('#product_name').after('<label class="error">Please choose product name</label>');
        $('#product_name').select();
        return false;

    }else if(category_id  == '') {
        $('#category_id').after('<label class="error">Please choose category</label>');
        $('#category_id').select();
        return false;

    }else if(subcategory_id == '') {
        $('#subcategory_id').after('<label class="error">Please choose subcategory</label>');
        $('#subcategory_id').select();
        return false;

    }else if(sibling_id == '' && other == '') {
        $('#sibling_id').after('<label class="error">Please choose sibling</label>');
        $('#sibling_id').select();
        return false;
    }else {

        var price = $('[name="Products[price_option]"]:checked').val();
        var generatedPattern = 1;
        if (price == 'multiple') {
            var checkVariantEr = 0;
            var variantList = $('.variantClass').length;
            if (variantList > 0) {
                generatedPattern = $('.generatedPattern').length;
                if (generatedPattern > 0) {
                    $('.generatedPattern').each(function () {
                        var itsId = this.id.split('_');
                        var pattern = $('#pattern_' + itsId[1]).val();
                        var minOrder = $('#min_' + itsId[1]).val();

                        if (pattern == '') {
                            $('.error').remove();
                            $('#pattern_' + itsId[1]).after('<label class="error">Please enter pattern/design no</label>');
                            $('#pattern_' + itsId[1]).select();
                            checkVariantEr++;
                            return false;
                        }
                        if (isNaN(minOrder) || minOrder <= 0) {
                            $('.error').remove();
                            $('#min_' + itsId[1]).after('<label class="error">Please enter count for minimum order count</label>');
                            $('#min_' + itsId[1]).select();
                            return false;
                        }
                        generatedPattern--;
                    });
                    if(checkVariantEr > 0)
                        return false;
                } else {
                    $('#variantList').append('<label class="error">Please generate variants</label>');
                    return false;
                }
            } else {
                $('#variantList').append('<label class="error">Please generate variants</label>');
                return false;
            }
        } else if (price == 'single') {
            var patternNo = $('#pattern_number').val();
            var product_price = $('#product_price').val();
            var product_stack = $('#product_stack').val();

            var minqty = $('[name="Products[minimum_qty]"]').val();

            if (patternNo == '') {
                $('[name="pattern_no"]').after('<label class="error">Please enter pattern number</label>');
                $('[name="pattern_no"]').select();
                return false;
            } else if (isNaN(product_price) || product_price <= 0) {
                $('.error').remove();
                $('[name="price"]').after('<label class="error">Please enter product price</label>');
                $('[name="price"]').select();
                return false;
            } else if (isNaN(product_stack) || product_stack <= 0) {
                $('.error').remove();
                $('[name="stack"]').after('<label class="error">Please enter stack in hand</label>');
                $('[name="stack"]').select()
                return false;
            } else {
                generatedPattern = 0;
            }
        } else {
            $('[name="Products[price_option]"]').after('<label class="error">Please select price option</label>');
            return false;
        }
        if (generatedPattern == 0) {
            var checkProductImageEr = 0;
            var productImageList = $('.uploadProduct').length;

            var imglen = $('.uploadProduct').length;

            if(imglen == 0) {
                $('.error').remove();
                $('#'+this.id).after('<label class="error">Please choose a image</label>');
                $('#'+this.id).select();
                checkProductImageEr++;
                return false;
            }else {
                $(".uploadProduct").each(function () {
                    if($("#"+this.id).val() == ''){
                        $('#'+this.id).after('<label class="error">Please choose a image</label>');
                        $('#'+this.id).select();
                        checkProductImageEr++;
                        return false;
                    }else {
                        productImageList--;
                    }
                })
            }

            if(productImageList == 0) {
                //$("#productAdd").submit();
                var shipping_type      = $.trim($("input[name='free_shipping']:checked").val());
                if(shipping_type == 'No') {
                    var shipping_mode      = $.trim($("input[name='international_shipping']:checked").val());
                    if(shipping_mode == '') {
                        $('[for="international_shipping_yes"]').after('<label class="error">Please choose shipping type</label>');
                        $('[for="international_shipping_yes"]').select();
                        return false;
                    }else {
                        var shippingLength = $(".countrySearch").length;
                        $(".countrySearch").each(function () {
                            if(shippingLength > 0) {
                                var itsId = this.id.split('_');

                                var country = $("#country_"+$.trim(itsId[1])).val();
                                var processing = $("#processing_time_"+$.trim(itsId[1])).val();
                                var cost = $("#cost_"+$.trim(itsId[1])).val();
                                var extraCost = $("#extra_cost_"+$.trim(itsId[1])).val();
                                if(country == '') {
                                    $("#shipTo_"+$.trim(itsId[1])).after('<label class="error">Please choose shipping to</label>');
                                    $("#shipTo_"+$.trim(itsId[1])).select();
                                    return false;

                                }else if(processing == ''){
                                    $("#processing_time_"+$.trim(itsId[1])).after('<label class="error">Please enter processing time</label>');
                                    $("#processing_time_"+$.trim(itsId[1])).select();
                                    return false;

                                }else if(cost == '') {
                                    $("#cost_"+$.trim(itsId[1])).after('<label class="error">Please enter cost</label>');
                                    $("#cost_"+$.trim(itsId[1])).select();
                                    return false;

                                }else if(extraCost == '') {
                                    $("#extra_cost_"+$.trim(itsId[1])).after('<label class="error">Please enter extracost</label>');
                                    $("#extra_cost_"+$.trim(itsId[1])).select();
                                    return false;

                                }else {
                                    shippingLength--;
                                }
                                if(shippingLength == 0) {
                                    $("#productAdd").submit();
                                    return false;
                                }
                            }
                        });
                    }
                }else {
                    $("#productAdd").submit();
                    return false;
                }
                return false;
            }
            return false;
        }
    }
    return false;

}

function getSubcategory(id) {
    $.ajax({
        type   : 'POST',
        url    : jssitebaseurl+'products/ajaxaction',
        data   : {id:id,action:'getSubCategory'},
        success: function(data){
            $("#subCategory").html(data);return false;
        }
    });
    return false;
}
function getSiblings(id) {
    $.ajax({
        type   : 'POST',
        url    : jssitebaseurl+'products/ajaxaction',
        data   : {id:id,action:'getSiblings'},
        success: function(data){
            $("#siblings").html(data);return false;
        }
    });
    return false;
}