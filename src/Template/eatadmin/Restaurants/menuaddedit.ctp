<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">
                    <?php if(!empty($id)) {?> Edit <?php }else{?> Add <?php }?> Menu
                </h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo ADMIN_BASE_URL ?>">Dashboard</a></li>
                    <li><a href="<?php echo ADMIN_BASE_URL ?>restaurant/menu">Management</a></li>
                    <li class="active"><?php if(!empty($id)) {?> Edit <?php }else{?> Add <?php }?> Menu </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <?= $this->Flash->render() ?>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <?= $this->Form->create('menuAddEditFrom',[
                                'id' => 'menuAddEditFrom',
                                'enctype'  =>'multipart/form-data',
                                'data-toggle' => 'validator'
                            ])?>

                            <?= $this->Form->input('username',[
                                'type' => 'hidden',
                                'name' => 'editedId',
                                'id'   => 'editedId',
                                'value' => isset($id) ? $id : ''
                            ]) ?>

                            <?php if(!isset($menuDetails['restaurant']['restaurant_name']) && $menuDetails['restaurant']['restaurant_name'] == '') { ?>
                                <div class="form-body">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Restaurant<span class="red">*</span></label>
                                        <div class="col-md-4">
                                            <?= $this->Form->input('restaurant_id',[
                                                'type' => 'select',
                                                'id'   => 'restaurant_id',
                                                'class' => 'form-control',
                                                'options' => $restaurantList,
                                                'label' => false,
                                                'value'   => isset($menuDetails['restaurant_id']) ? $menuDetails['restaurant_id'] :  '',
                                                'empty'   =>'Please Choose Restaurant',
                                                'onchange' => 'return getCategory(this.value)'
                                            ]) ?>
                                            <span class="restaurantErr"></span>
                                        </div>
                                    </div>
                                </div>
                            <?php }else { ?>

                                <div class="form-body">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Restaurant<span class="red">*</span></label>
                                        <div class="col-md-4">
                                            <?= $this->Form->input('restaurant_id',[
                                                'type' => 'text',
                                                'name' => 'restaurant_id',
                                                'class' => 'form-control',
                                                'id'   => 'restaurant_id',
                                                'value' => isset($menuDetails['restaurant']['restaurant_name']) ? $menuDetails['restaurant']['restaurant_name'] : '',
                                                'label' => false,
                                                'readonly'
                                            ]) ?>
                                            <span class="restaurantErr"></span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Category Name<span class="red">*</span></label>
                                    <div class="col-md-4" id="categoryList">
                                        <?= $this->Form->input('category_id',[
                                            'type' => 'select',
                                            'id'   => 'category_id',
                                            'class' => 'form-control',
                                            'options' => $categoryList,
                                            'label' => false,
                                            'value'   => isset($menuDetails['category_id']) ? $menuDetails['category_id'] :  '',
                                            'empty'   =>'Please Choose Category'
                                        ]) ?>
                                        <span class="categoryErr"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Menu Name<span class="red">*</span></label>
                                    <div class="col-md-4">
                                        <?= $this->Form->input('menu_name',[
                                            'type' => 'text',
                                            'id'   => 'menu_name',
                                            'class' => 'form-control',
                                            'label' => false,
                                            'value'   => isset($menuDetails['menu_name']) ? $menuDetails['menu_name'] :  ''
                                        ]) ?>
                                        <span class="menunameErr"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Menu Type<span class="red">*</span></label>
                                    <div class="col-md-4">
                                        <?=
                                        $this->Form->radio(
                                            'menu_type',
                                            [
                                                ['value' => 'veg', 'text' => 'Veg', 'checked' => ($menuDetails['menu_type'] == 'veg') ? 'checked' : ''],
                                                ['value' => 'nonveg', 'text' => 'Non Veg', 'checked' => ($menuDetails['menu_type'] == 'nonveg') ? 'checked' : '' ],
                                                ['value' => 'other', 'text' => 'Other', 'checked' => ($menuDetails['menu_type'] == 'other') ? 'checked' : '' ]

                                            ]
                                        );
                                        ?>
                                        <span class="menutypeErr"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Price Option<span class="red">*</span></label>
                                    <div class="col-md-4">
                                        <?=
                                        $this->Form->radio(
                                            'price_option',
                                            [
                                                ['value' => 'single', 'text' => 'Single', 'checked' => ($menuDetails['price_option'] == 'single') ? 'checked' : ''],
                                                ['value' => 'multiple', 'text' => 'Multiple', 'checked' => ($menuDetails['price_option'] == 'multiple') ? 'checked' : '' ]

                                            ]
                                        );
                                        ?>
                                        <span class="menupriceErr"></span>
                                    </div>
                                </div>
                            </div>

                            <div id="singlePrice" class="form-body" style="<?php echo ($menuDetails['price_option'] != 'multiple') ? 'display:block' : '' ?>">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Price<span class="red">*</span></label>
                                    <div class="col-md-4">
                                        <?= $this->Form->input('menu_price',[
                                            'type' => 'text',
                                            'id'   => 'menu_price',
                                            'class' => 'form-control',
                                            'label' => false,
                                            'value'   => isset($menuDetails['menu_price']) ? $menuDetails['menu_price'] :  ''
                                        ]) ?>
                                        <span class="menunameErr"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="multiple" style="<?php echo ($menuDetails['price_option'] != 'multiple') ? 'display:none' : '' ?>">
                                <label class="col-md-3 control-label">&nbsp;</label>
                                <div class="col-md-8 col-lg-8">
                                    <div class="row addPriceTop">
                                        <div class="col-lg-7">
                                            <div class="row">
                                                <div class="col-md-6"><?php
                                                    echo $this->Form->input('ProductDetail.sub_name',
                                                        array('class'=>'form-control multipleValidate',
                                                            'placeholder'=>'Menu Name',
                                                            'data-attr'=>'product name',
                                                            'name' => 'data[ProductDetail][0][sub_name]',
                                                            'label'=>false)); ?>
                                                </div>
                                                <div class="col-md-3"><?php
                                                    echo $this->Form->input('ProductDetail.orginal_price',
                                                        array('class'=>'form-control multipleValidate',
                                                            'placeholder'=>'Price',
                                                            'type' => 'text',
                                                            'id' => 'ProductDetailOrginalPrice0',
                                                            'data-attr'=>'original price',
                                                            'name' => 'data[ProductDetail][0][orginal_price]',
                                                            'label'=>false)); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="moreOption"></div>
                                    <a class="addPrice btn green" href="javascript:void(0);" onclick="multipleOption();"><i class="fa fa-plus"></i> Add Price</a>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Addons<span class="red">*</span></label>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="radio-list">
                                            <label class="radio-inline"> <?php
                                                $addonYes = array('Yes' => 'Yes');
                                                $addonNo = array('No' => 'No');
                                                echo $this->Form->radio('Product.product_addons',$addonYes, [
                                                    'checked' => $addonYes,
                                                    'legend'=>false,
                                                    'onchange' => 'return getAddons(this.value);',
                                                    'hiddenField'=>false
                                                ]); ?>
                                            </label>
                                            <label class="radio-inline"><?php
                                                echo $this->Form->radio('Product.product_addons',$addonNo, [
                                                    'checked' => $addonNo,
                                                    'legend'=>false,
                                                    'checked' => 'checked',
                                                    'onchange' => 'return getAddons(this.value);',
                                                    'hiddenField'=>false
                                                ]); ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Menu Image<span class="red">*</span></label>
                                    <div class="col-sm-4">
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                <span class="fileinput-filename menu_image"><?php echo $menuDetails['menu_image'] ?></span>
                                            </div>
                                            <span class="input-group-addon btn btn-default btn-file">
                                                                            <span class="fileinput-new">Select file</span>
                                                                            <span class="fileinput-exists">Change</span>
                                                                            <input type="file" name="sitelogo">
                                                                        </span>
                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove
                                            </a>

                                        </div>
                                        <span class="imageErr"></span>
                                    </div>
                                    <div class="col-sm-4">
                                        <img src="<?php echo ADMIN_BASE_URL.'images/'.$menuDetails['menu_image'] ?>" alt="No image" class="img-responsive img-rounded" width="100"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Menu Description<span class="red">*</span></label>
                                    <div class="col-md-4">
                                        <?= $this->Form->input('menu_description',[
                                            'type' => 'textarea',
                                            'id'   => 'menu_description',
                                            'class' => 'form-control',
                                            'label' => false,
                                            'value'   => isset($menuDetails['menu_description']) ? $menuDetails['menu_description'] :  ''
                                        ]) ?>
                                        <span class=""></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">popular Dish<span class="red">*</span></label>
                                    <div class="col-md-4">
                                        <?=
                                        $this->Form->radio(
                                            'popular_dish',
                                            [
                                                ['value' => 'yes', 'text' => 'Yes', 'checked' => ($menuDetails['popular_dish'] == 'yes') ? 'checked' : ''],
                                                ['value' => 'no', 'text' => 'No', 'checked' => ($menuDetails['popular_dish'] == 'no') ? 'checked' : '' ]

                                            ]
                                        );
                                        ?>
                                        <span class="popularErr"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Spicy Dish<span class="red">*</span></label>
                                    <div class="col-md-4">
                                        <?=
                                        $this->Form->radio(
                                            'spicy_dish',
                                            [
                                                ['value' => 'yes', 'text' => 'Yes', 'checked' => ($menuDetails['spicy_dish'] == 'yes') ? 'checked' : ''],
                                                ['value' => 'no', 'text' => 'No', 'checked' => ($menuDetails['spicy_dish'] == 'no') ? 'checked' : '' ]

                                            ]
                                        );
                                        ?>
                                        <span class="spicyErr"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button type="button" class="btn btn-info" onclick="menuAddEdit()">Submit</button>
                                    <a class="btn btn-danger" href="<?php echo ADMIN_BASE_URL?>category/"> Cancel</a>
                                </div>
                            </div>
                            <?=  $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>



<script type="text/javascript">
    $(document).ready(function () {
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

        var restaurant_id        = $.trim($("#restaurant_id").val()) ;
        var category_id        = $.trim($("#category_id").val()) ;
        var menu_name        = $.trim($("#menu_name").val()) ;
        var editedId         = $.trim($("#editedId").val()) ;

        var menu_type      = $.trim($("input[name='menu_type']:checked").val());
        var price_option      = $.trim($("input[name='price_option']:checked").val());
        var menu_image        = $.trim($(".menu_image").html());
        var img = $('.menu_image').html().split('.').pop().toLowerCase();

        $('.error').html('');

        if(restaurant_id == ''){
            $(".restaurantErr").addClass('error').html('Please choose restaurant');
            $("#restaurant_id").focus();
            return false;

        }else if(category_id == ''){
            $(".categoryErr").addClass('error').html('Please enter the category name');
            $("#category_id").focus();
            return false;

        }else if(menu_name == ''){
            $(".menunameErr").addClass('error').html('Please enter the Menu Name');
            $("#menu_name").focus();
            return false;

        }else if(menu_type == ''){
            $(".menutypeErr").addClass('error').html('Please choose menu type');
            $("#menu_type").focus();
            return false;

        }else if(price_option == ''){
            $(".categoryErr").addClass('error').html('Please choose price option');
            $("#menupriceErr").focus();
            return false;

        }else if(menu_image == ''){
            $(".imageErr").addClass('error').html('Please select Menu Image');
            $(".menu_image").focus();
            return false;

        }else if(menu_image != '' && $.inArray(img, ['gif','png','jpg','jpeg']) == -1){
            $(".imageErr").addClass('error').html("Please Select the Valid Image Type");
            $(".menu_image").focus();
            return false;

        }else{
            $.ajax({
                type   : 'POST',
                url    : baseUrl+'restaurants/checkMenu',
                data   : {id:editedId, category_id:category_id,restaurant_id:restaurant_id,menu_name:menu_name},
                success: function(data){
                    if($.trim(data) == '1') {
                        $(".nameErr").addClass('error').html('This menu name already exists');
                        $("#menu_name").focus();
                        return false;
                    }else {
                        $("#menuAddEditFrom").submit();
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

        html =  '<div id = "moreProuct'+i+'" class="row addPriceTop multipleMenu">'+
            '<div class="col-lg-7">'+
            '<div class="row">'+
            '<div class="col-md-6">'+
            '<div class="input text">'+
            '<input type="text" id="ProductDetailSubName" data-attr="product name" maxlength="100" placeholder="Menu Name" class="form-control multipleValidate" name="data[ProductDetail][' + i + '][sub_name]">'+
            '</div>'+
            '</div>'+
            '<div class="col-md-3">'+
            '<div class="input number">'+
            '<input type="text" id="ProductDetailOrginalPrice'+i+'" data-attr="original price" step="any" placeholder="Price" class="form-control multipleValidate" name="data[ProductDetail][' + i + '][orginal_price]">'+
            '</div>'+
            '</div>'+
            '<span class="ItemRemove" onclick="removeOption('+i+');"><i class="fa fa-times"></i></span>'+
            '</div>'+
            '</div>'+
            '</div>';

        appendMultipleSubAddons(i);

        i++;
        $('#moreOption').append(html);
        html = '';
        return false;
    }

    function appendMultipleSubAddons(removeId) {
        var multipleLength = $('.multipleMenu').length;
        var i = 1;

        $('.productAddonsMenu').each(function() {
            var subaddonName = $(this).attr('id');
            multipleAddon = '<div class="col-md-3 col-lg-2 removeAppendAddon_'+removeId+'">'+
                '<input class="form-control singleValidate" type="text" name="'+subaddonName+'[]">'+
                '</div>';
            $('#appendMultiplePrice_'+i).append(multipleAddon);
            i++;
        });
    }

    function removeOption(id) {
        $('#moreProuct' + id).remove();
        $('.removeAppendAddon_'+id).remove();
    }

    function getAddons(option) {
        var category_id        = $.trim($("#category_id").val()) ;
        var price_option      = $.trim($("input[name='price_option']:checked").val());

        var restaurant_id        = $.trim($("#restaurant_id").val()) ;
        var category_id        = $.trim($("#category_id").val()) ;
        var menu_name        = $.trim($("#menu_name").val()) ;

        if(category_id == ''){
            $(".categoryErr").addClass('error').html('Please enter the category name');
            $("#category_id").focus();
            return false;

        }else {
            if (option == 'Yes') {
                var $menuLength = '';
                if (price_option == 'multiple') {
                    $menuLength = $('.addPriceTop').length;
                }
                $('#getShowAddons').load(
                    URL,
                    {
                        'productId' : '',
                        'restaurant_id' : restaurant_id,
                        'category_id' : category_id,
                        'price_option' : price_option,
                        'menuLength' : $menuLength,
                        'Action' : 'getAddons'
                    },
                    function (response) {
                        if (price_option == 'multiple') {
                            var multipleLength = $('.multipleMenu').length;
                            var j = 0;
                            for (j = 1; j <= multipleLength; j++) {
                                appendMultipleSubAddons(j);
                            }
                        }
                        $('#getShowAddons').show();
                        return false;
                    }
                );

                $.ajax({
                    type   : 'POST',
                    url    : baseUrl+'restaurants/ajaxaction',
                    data   : {'productId' : '','restaurant_id' : restaurant_id,'category_id' : category_id,'price_option' : price_option,'menuLength' : $menuLength,'action' : 'getAddons'},
                    success: function(response){
                        if (price_option == 'multiple') {
                            var multipleLength = $('.multipleMenu').length;
                            var j = 0;
                            for (j = 1; j <= multipleLength; j++) {
                                appendMultipleSubAddons(j);
                            }
                        }
                        $("#getShowAddons").html(response);
                        //$('#getShowAddons').show();

                    }
                });return false;

            } else {
                $('#getShowAddons').hide();
                return false;
            }
        }

    }
    
</script>