<section class="col-xs-12 col-sm-9">
    <div class="buyer-title">Menu Add</div>
    <div class="products-section no-padding-top">
        <div class="clearfix">
            <div class="checkout-wrapper buyer-checkout-wrapper no-margin-bottom">
                <div class="checkout-body">
                    <div class="checkout-body-title">
                        <span class="pull-left checkout-body-left">&nbsp;</span>
                    </div>
                    <?php echo $this->Form->create('menuAdd',array('name'=>'menuAdd',
                        'id'=>'menuAddForm',
                        'class'=>'form-horizontal',
                        'enctype' => 'multipart/form-data'
                    ));
                    ?>
                    <?= $this->Form->input('username',[
                        'type' => 'hidden',
                        'name' => 'editedId',
                        'id'   => 'editedId',
                        'value' => isset($id) ? $id : ''
                    ]) ?>

                    <div class="col-sm-6 col-sm-offset-3">
                        <label class="commonErr"></label>
                        <div class="form-group clearfix clearfix">
                            <div class="col-sm-4">
                                <label>Category Name <span class="star">*</span></label>
                            </div>
                            <div class="col-sm-8" id="categoryList">
                                <?= $this->Form->input('category_id',[
                                    'type' => 'select',
                                    'id'   => 'category_id',
                                    'class' => 'form-control',
                                    'options' => $categoryList,
                                    'label' => false,
                                    'value' => $menuDetails['category_id']
                                ]) ?>
                                <label class="categoryErr" id=""></label>

                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-sm-4">
                                <label>Menu Name <span class="star">*</span></label>
                            </div>
                            <div class="col-sm-8"><?php
                                echo $this->Form->input('Menu.menu_name',
                                    array('class' => 'form-control',
                                        'value' => $menuDetails['menu_name'],
                                        'label' => false)); ?>
                                <label class="menunameErr" id=""></label>
                            </div>
                        </div>

                        <div class="form-group clearfix">

                            <div class="col-sm-4">
                                <label for="name">Menu Type<span class="help">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <div class="col-sm-3 no-padding">
                                    <input type="radio" name="menu_type" value="veg" id="veg" <?php echo ($menuDetails['menu_type'] == 'veg') ? 'checked' : '' ?> >
                                    <label for="veg">Veg</label>
                                </div>
                                <div class="col-sm-5 no-padding">
                                    <input type="radio" name="menu_type" value="nonveg" id="nonveg" <?php echo ($menuDetails['menu_type'] == 'nonveg') ? 'checked' : '' ?>>
                                    <label for="nonveg">Non Veg</label>
                                </div>
                                <div class="col-sm-3 no-padding">
                                    <input type="radio" name="menu_type" value="other" id="otherfood" <?php echo ($menuDetails['menu_type'] == 'other') ? 'checked' : '' ?> >
                                    <label for="otherfood">Others</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group clearfix">

                            <div class="col-sm-4">
                                <label for="name">Price Option<span class="help">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <div class="col-sm-6 no-padding">
                                    <input type="radio" id="price-option-single" name="price_option" value="single" <?php echo ($menuDetails['price_option'] == 'single') ? 'checked' : '' ?>>
                                    <label for="price-option-single">Single</label>
                                </div>
                                <div class="col-sm-6 no-padding">
                                    <input type="radio" id="price-option-multiple" name="price_option" value="multiple" <?php echo ($menuDetails['price_option'] == 'multiple') ? 'checked' : '' ?>>
                                    <label for="price-option-multiple">Multiple</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group clearfix"  id="singlePrice" style="<?php echo ($menuDetails['price_option'] == 'single') ? 'display:block' : 'display:none' ?>">
                            <div class="col-sm-4">
                                <label class="">Price <span class="star">*</span></label>
                            </div>
                            <div class="col-sm-8"><?php
                                echo $this->Form->input('MenuDetail.orginal_price',
                                    array('class'=>'form-control singleValidate',
                                        'placeholder'=>'Price',
                                        'data-attr'=>'original price',
                                        'type' => 'text',
                                        'value' => $menuDetails['menu_details'][0]['orginal_price'],
                                        'label'=>false)); ?>
                                <label class="originalErr"></label>
                            </div>
                        </div>
                        <div id="multiple" style="<?php echo ($menuDetails['price_option'] == 'single') ? 'display:none' : 'display:block' ?>">
                            <div class="form-group clearfix">
                                <label class="col-sm-4 control-label">&nbsp;</label>
                                <div class="col-sm-8">
                                    <?php if($menuDetails['price_option'] == 'multiple') {
                                        foreach ($menuDetails['menu_details'] as $mkey => $mvalue) { ?>
                                            <div class="col-sm-5 no-padding-left addPriceTop"><?php
                                                echo $this->Form->input('MenuDetail.sub_name',
                                                    array('class' => 'form-control multipleValidate multipleprice',
                                                        'placeholder' => 'Menu Name',
                                                        'data-attr' => 'product name',
                                                        'id' => 'multiple_menu_'.$mkey,
                                                        'name' => 'data[MenuDetail]['.$mkey.'][sub_name]',
                                                        'value' => $mvalue['sub_name'],
                                                        'label' => false)); ?>
                                            </div>
                                            <div class="col-sm-5 no-padding-left">
                                                <?php
                                                echo $this->Form->input('MenuDetail.orginal_price',
                                                    array('class' => 'form-control multipleValidate',
                                                        'placeholder' => 'Price',
                                                        'type' => 'text',
                                                        'id' => 'multiple_menuprice_'.$mkey,
                                                        'data-attr' => 'original price',
                                                        'name' => 'data[MenuDetail]['.$mkey.'][orginal_price]',
                                                        'value' => $mvalue['orginal_price'],
                                                        'label' => false));
                                                ?>
                                            </div>
                                        <?php }
                                    }else {?>

                                        <div class="col-sm-5 no-padding-left addPriceTop"><?php
                                            echo $this->Form->input('MenuDetail.sub_name',
                                                array('class' => 'form-control multipleValidate multipleprice',
                                                    'placeholder' => 'Menu Name',
                                                    'data-attr' => 'product name',
                                                    'id' => 'multiple_menu_0',
                                                    'name' => 'data[MenuDetail][0][sub_name]',
                                                    'label' => false)); ?>
                                        </div>
                                        <div class="col-sm-5 no-padding-left"><?php
                                            echo $this->Form->input('MenuDetail.orginal_price',
                                                array('class' => 'form-control multipleValidate',
                                                    'placeholder' => 'Price',
                                                    'type' => 'text',
                                                    'id' => 'multiple_menuprice_0',
                                                    'data-attr' => 'original price',
                                                    'name' => 'data[MenuDetail][0][orginal_price]',
                                                    'label' => false)); ?>
                                        </div>

                                    <?php } ?>
                                    <div class="col-sm-2">
                                        <a class="addPrice btn green" href="javascript:void(0);" onclick="multipleOption();"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-sm-4">
                                <label>Addons <span class="star"></span></label>
                            </div>
                            <div class="col-sm-8">
                                <div class="col-sm-6 no-padding">
                                    <input type="radio" id="addon_yes" name="menuaddons" value="Yes" onclick="getAddons('Yes')" <?php echo ($menuDetails['menuaddons'] == 'Yes') ? 'checked' : '' ?>>
                                    <label for="addon_yes">Yes</label>
                                </div>
                                <div class="col-sm-6 no-padding">
                                    <input type="radio" id="addon_no" name="menuaddons" value="No" onclick="getAddons('No')" <?php echo ($menuDetails['menuaddons'] == 'No') ? 'checked' : '' ?>>
                                    <label for="addon_no">No</label>
                                </div>
                            </div>
                        </div>
                        <div id="getShowAddons" class="col-xs-12">

                        </div>

                        <div class="form-group clearfix">
                            <div class="col-sm-4">
                                <label class="">Image <span class="star"></span></label>
                            </div>
                            <div class="col-sm-6"><?php
                                echo $this->Form->input("Menu.menu_image",
                                    array("label"=>false,
                                        "type"=>"file",
                                        "name"=>"menuImage")); ?>
                            </div>
                            <div class="col-sm-2">
                                <img src="<?php echo MENU_LOGO_URL.'/'.$id.'/'.$menuDetails['menu_image'] ?>" alt="No image" class="img-responsive img-rounded" width="50"/>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-sm-4">
                                <label class="">Description</label>
                            </div>
                            <div class="col-sm-8"><?php
                                echo $this->Form->textarea('Menu.menu_description',
                                    array('class'=>'form-control',
                                        'value' => $menuDetails['menu_description'],
                                        'label'=>false)); ?>
                            </div>
                        </div>

                        <div class="form-group clearfix">

                            <div class="col-sm-4">
                                <label for="name">Popular<span class="help">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <div class="col-sm-6 no-padding">
                                    <input type="radio" id="popular_yes" name="popular_dish" value="Yes" <?php echo ($menuDetails['popular_dish'] == 'Yes') ? 'checked' : '' ?>>
                                    <label for="popular_yes">Yes</label>
                                </div>
                                <div class="col-sm-6 no-padding">
                                    <input type="radio" id="popular_no" name="popular_dish" value="No" <?php echo ($menuDetails['popular_dish'] == 'No') ? 'checked' : '' ?>>
                                    <label for="popular_no">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group clearfix">

                            <div class="col-sm-4">
                                <label for="name">Spicy<span class="help">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <div class="col-sm-6 no-padding">
                                    <input type="radio" id="spicy_dish_yes" name="spicy_dish" value="Yes" <?php echo ($menuDetails['spicy_dish'] == 'Yes') ? 'checked' : '' ?>>
                                    <label for="spicy_dish_yes">Yes</label>
                                </div>
                                <div class="col-sm-6 no-padding">
                                    <input type="radio" id="spicy_dish_no" name="spicy_dish" value="No" <?php echo ($menuDetails['spicy_dish'] == 'No') ? 'checked' : '' ?>>
                                    <label for="spicy_dish_no">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 text-center">
                    <button class="btn btn-submit" type="button" onclick=" return menuAddEdit();">Save</button>
                    <a class="btn btn-cancel" href="<?php echo PARTNER_BASE_URL ?>menus"> Cancel</a>
                </div>
                <?= $this->Form->end();?>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        var option      = $.trim($("input[name='menuaddons']:checked").val());
        getAddons(option);

        $("#price-option-multiple").click(function () {
            $("#singlePrice").css('display','none');
            $("#multiple").css('display','block');
        });

        $("#price-option-single").click(function () {
            $("#multiple").css('display','none');
            $("#singlePrice").css('display','block');
        });
    });
    function menuAddEdit(){

        var error = 0;
        var category_id      = $.trim($("#category_id").val()) ;
        var menu_name        = $.trim($("#menu-menu-name").val()) ;

        var originalPrice    = $.trim($("#menudetail-orginal-price").val());
        var menu_type        = $.trim($("input[name='menu_type']:checked").val());
        var price_option     = $.trim($("input[name='price_option']:checked").val());
        var addons           = $.trim($("input[name='menuaddons']:checked").val());
        var menu_image       = $.trim($(".menu-menu-image").html());

        var editedId        = $.trim($("#editedId").val()) ;

        // var img = $('#menu-menu-image').html().split('.').pop().toLowerCase();
        //alert(img);
        $('.error').html('');



        if(category_id == ''){
            $(".categoryErr").addClass('error').html('Please enter the category name');
            $("#category_id").focus();
            error = 1;
            return false;

        }else if(menu_name == ''){
            $(".menunameErr").addClass('error').html('Please enter the Menu Name');
            $("#menu-menu-name").focus();
            error = 1;
            return false;

        }else if(menu_type == ''){
            $(".menutypeErr").addClass('error').html('Please choose menu type');
            $("#menu_type").focus();
            error = 1;
            return false;

        }

        if(price_option == ''){
            $(".categoryErr").addClass('error').html('Please choose price option');
            $("#menupriceErr").focus();
            error = 1;
            return false;

        }
        if(price_option != '' && price_option == 'single' && originalPrice == '' ) {
            $(".originalErr").addClass('error').html('Please enter the amount');
            $("#menudetail-orginal-price").focus();
            error = 1;
            return false;
        }else if(price_option != 'single') {
            var menuLength = $('.multipleprice').length;
            $('.multipleprice').each(function () {
                var id = this.id;
                var key = id.split('_');
                if($("#"+id).val() == '') {
                    $('.commonErr').addClass('error').html('Please enter the name');
                    $("#"+id).focus();
                    return false
                }else if($("#multiple_menuprice_"+key[2]).val() == '') {
                    $('.commonErr').addClass('error').html('Please enter the amount');
                    $("#multiple_menuprice_"+key[2]).focus();
                    return false
                }else {
                    menuLength--;
                    if(menuLength == 0) {
                        error = 0;
                    }

                }
            });
        }else {
            var menuLength = 0;
            error = 0;
        }

        /*if(menu_image == ''){
            $(".imageErr").addClass('error').html('Please select Menu Image');
            $(".menu-menu-image").focus();
            return false;

        }else if(menu_image != '' && $.inArray(img, ['gif','png','jpg','jpeg']) == -1){
            $(".imageErr").addClass('error').html("Please Select the Valid Image Type");
            $(".menu-menu-image").focus();
            return false;

        }else*/

        if(error == 0 && menuLength == 0){
            $.ajax({
                type   : 'POST',
                url    : jsSitePartner+'menus/checkMenu',
                data   : {id:editedId, category_id:category_id,menu_name:menu_name},
                success: function(data){
                    if($.trim(data) == '1') {
                        $(".menunameErr").addClass('error').html('This menu name already exists');
                        $("#menu-menu-name").focus();
                        return false;
                    }else {
                        $("#menuAddForm").submit();
                    }

                }
            });return false;
            //
        }
    }

    function getCategory(id) {
        $.ajax({
            type   : 'POST',
            url    : baseUrl+'restaurants/ajaxaction',
            data   : {id:id,action:'getCategory'},
            success: function(data){
                $("#categoryList").html(data);return false;

            }
        });return false;
    }
    var i = 1;

    function multipleOption() {

        if($("#multiple_menu_"+i).length != 0) {
            i++;
            multipleOption();
            return false;
        }

        html =  '<div id = "moreProuct'+i+'" class="form-group clearfix addPriceTop">'+
            '<label class="col-sm-4 control-label">&nbsp;</label>'+
            '<div class="col-sm-8">'+
            '<div  class="row addPriceTop multipleMenu">'+

            '<div class="col-sm-5">'+
            '<div class="input text">'+
            '<input type="text" id="multiple_menu_'+i+'" data-attr="product name" maxlength="100" placeholder="Menu Name" class="form-control multipleValidate multipleprice" name="data[MenuDetail][' + i + '][sub_name]">'+
            '</div>'+
            '</div>'+
            '<div class="col-sm-5">'+
            '<div class="input number">'+
            '<input type="text" id="multiple_menuprice_'+i+'" data-attr="original price" step="any" placeholder="Price" class="form-control multipleValidate" name="data[MenuDetail][' + i + '][orginal_price]">'+
            '</div>'+
            '</div>'+
            '<div class="col-sm-2">'+
            '<span class="ItemRemove" onclick="removeOption('+i+');"><i class="fa fa-times"></i></span>'+
            '</div>'
        '</div>'
        '</div>'
        '</div>';

        appendMultipleSubAddons(i);

        i++;
        $('#multiple').append(html);
        html = '';
        return false;
    }

    function appendMultipleSubAddons(removeId) {
        var multipleLength = $('.multipleMenu').length;
        var i = 1;

        $('.productAddonsMenu').each(function() {
            var subaddonName = $(this).attr('id');
            multipleAddon = '<div class="col-sm-6 col-lg-3 removeAppendAddon_'+removeId+'">'+
                '<input class="form-control singleValidate" type="text" name="'+subaddonName+'[]">'+
                '</div>';
            $('#appendMultiplePrice_'+i).append(multipleAddon);
            i++;
        });
    }

    function removeOption(id) {
        //$(this).parent('div').remove();
        $('#moreProuct' + id).remove();
        $('.removeAppendAddon_'+id).remove();
    }

    function getAddons(option) {
        var category_id        = $.trim($("#category_id").val()) ;
        var price_option      = $.trim($("input[name='price_option']:checked").val());
        var editedId        = $.trim($("#editedId").val()) ;
        var restaurant_id        = $.trim($("#restaurant_id").val()) ;
        var category_id        = $.trim($("#category_id").val()) ;
        var menu_name        = $.trim($("#menu-menu-name").val()) ;

        if(category_id == ''){
            $(".categoryErr").addClass('error').html('Please enter the category name');
            $("#category_id").focus();
            return false;

        }else {
            if (option == 'Yes') {
                var menuLength = '';
                if (price_option == 'multiple') {
                    menuLength = $('.addPriceTop').length;
                }

                $.ajax({
                    type   : 'POST',
                    url    : jsSitePartner+'menus/ajaxaction',
                    data   : {'menuId' : editedId,'category_id' : category_id,'price_option' : price_option,'menuLength' : menuLength,'action' : 'getAddons'},
                    success: function(response){
                        if (price_option == 'multiple') {
                            var multipleLength = $('.multipleMenu').length;
                            var j = 0;
                            for (j = 1; j <= multipleLength; j++) {
                                appendMultipleSubAddons(j);
                            }
                        }
                        $("#getShowAddons").html(response);
                        $('#getShowAddons').show();

                    }
                });return false;

            } else {
                $('#getShowAddons').hide();
                return false;
            }
        }

    }

</script>

