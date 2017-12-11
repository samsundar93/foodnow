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
                <!-- BEGIN PORTLET-->
                <div class="white-box">
                    <?= $this->Flash->render() ?>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <?php
                            echo $this->Form->create('Product',array('class' =>"form-horizontal",
                                'id' => 'menuEditForm',
                                'type'  => 'file')); ?>
                            <?= $this->Form->input('username',[
                                'type' => 'hidden',
                                'name' => 'editedId',
                                'id'   => 'editedId',
                                'value' => isset($id) ? $id : ''
                            ]) ?>
                            <div class="form-body">
                                <label class="error" id="productError"></label>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Restaurant<span class="star">*</span></label>
                                    <div class="col-md-6 col-lg-4">
                                        <?= $this->Form->input('restaurant_id',[
                                            'type' => 'select',
                                            'id'   => 'restaurant_id',
                                            'class' => 'form-control',
                                            'options' => $restaurantList,
                                            'value'   => isset($menuDetails['restaurant_id']) ? $menuDetails['restaurant_id'] :  '',
                                            'label' => false,
                                            'empty'   =>'Please Choose Restaurant',
                                            'onchange' => 'return getCategory(this.value)'
                                        ]) ?>
                                        <label class="restaurantErr"></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Category Name <span class="star">*</span></label>
                                    <div class="col-md-6 col-lg-4" id="categoryList">
                                        <?= $this->Form->input('category_id',[
                                            'type' => 'select',
                                            'id'   => 'category_id',
                                            'class' => 'form-control',
                                            'options' => $categoryList,
                                            'value'   => isset($menuDetails['category_id']) ? $menuDetails['category_id'] :  '',
                                            'label' => false,
                                            'empty'   =>'Please Choose Category'
                                        ]) ?>
                                        <label class="categoryErr"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Menu Name <span class="star">*</span></label>
                                    <div class="col-md-6 col-lg-4"><?php
                                        echo $this->Form->input('Menu.menu_name',
                                            array('class' => 'form-control',
                                                'value'   => isset($menuDetails['menu_name']) ? $menuDetails['menu_name'] :  '',
                                                'label' => false)); ?>
                                        <label class="menunameErr" id=""></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Menu Type <span class="star">*</span></label>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                                <input type="radio" name="menu_type" value="veg" <?php echo ($menuDetails['menu_type'] == 'veg') ? 'checked' : ''; ?>> Veg
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="menu_type" value="nonveg" <?php echo ($menuDetails['menu_type'] == 'nonveg') ? 'checked' : ''; ?>> Non Veg
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="menu_type" value="other" <?php echo ($menuDetails['menu_type'] == 'other') ? 'checked' : ''; ?>> Others
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Price Option <span class="star">*</span></label>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                                <input type="radio" id="price-option-single" name="price_option" value="single" <?php echo ($menuDetails['price_option'] == 'single') ? 'checked' : ''; ?>> Single
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" id="price-option-multiple" name="price_option" value="multiple" <?php echo ($menuDetails['price_option'] == 'multiple') ? 'checked' : ''; ?>> Multiple
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"  id="singlePrice" style="<?php echo ($menuDetails['price_option'] != 'single') ? 'display:none' : ''; ?>">
                                    <label class="col-md-3 control-label">Price <span class="star">*</span></label>
                                    <div class="col-md-8 col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <div class="row">
                                                    <div class="col-md-3"><?php
                                                        echo $this->Form->input('MenuDetail.orginal_price',
                                                            array('class'=>'form-control singleValidate',
                                                                'placeholder'=>'Price',
                                                                'data-attr'=>'original price',
                                                                'value' => $menuDetails['menu_details'][0]['orginal_price'],
                                                                'type' => 'text',
                                                                'label'=>false)); ?>
                                                        <label class="originalErr"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="multiple" style="<?php echo ($menuDetails['price_option'] == 'multiple') ? 'display:block' : 'display:none'; ?>">
                                    <label class="col-md-3 control-label">&nbsp;</label>
                                    <div class="col-md-8 col-lg-8">
                                        <?php if($menuDetails['price_option'] == 'multiple') {
                                            foreach ($menuDetails['menu_details'] as $mkey => $mvalue) { ?>
                                                <div id="moreProuct<?php echo $mkey; ?>" class="row addPriceTop">
                                                    <div class="col-lg-7">
                                                        <div class="row">
                                                            <div class="col-md-6"><?php
                                                                echo $this->Form->input('MenuDetail.sub_name',
                                                                    array('class'=>'form-control multipleValidate multipleprice',
                                                                        'placeholder'=>'Menu Name',
                                                                        'id' => 'multiple_menu_'.$mkey,
                                                                        'name' => 'data[MenuDetail]['.$mkey.'][sub_name]',
                                                                        'value' => $mvalue['sub_name'],
                                                                        'label'=>false)); ?>
                                                            </div>
                                                            <div class="col-md-3"><?php
                                                                echo $this->Form->input('MenuDetail.orginal_price',
                                                                    array('class'=>'form-control multipleValidate',
                                                                        'placeholder'=>'Price',
                                                                        'type' => 'text',
                                                                        'id' => 'multiple_menuprice_'.$mkey,
                                                                        'data-attr'=>'original price',
                                                                        'name' => 'data[MenuDetail]['.$mkey.'][orginal_price]',
                                                                        'value' => $mvalue['orginal_price'],
                                                                        'label'=>false)); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        <?php
                                            }
                                        }else{ ?>
                                            <div class="row addPriceTop">
                                                <div class="col-lg-7">
                                                    <div class="row">
                                                        <div class="col-md-6"><?php
                                                            echo $this->Form->input('MenuDetail.sub_name',
                                                                array('class'=>'form-control multipleValidate multipleprice',
                                                                    'placeholder'=>'Menu Name',
                                                                    'id' => 'multiple_menu_0',
                                                                    'name' => 'data[MenuDetail][0][sub_name]',
                                                                    'label'=>false)); ?>
                                                        </div>
                                                        <div class="col-md-3"><?php
                                                            echo $this->Form->input('MenuDetail.orginal_price',
                                                                array('class'=>'form-control multipleValidate',
                                                                    'placeholder'=>'Price',
                                                                    'type' => 'text',
                                                                    'id' => 'multiple_menuprice_0',
                                                                    'data-attr'=>'original price',
                                                                    'name' => 'data[MenuDetail][0][orginal_price]',
                                                                    'label'=>false)); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div id="moreOption"></div>
                                        <a class="addPrice btn green" href="javascript:void(0);" onclick="multipleOption();"><i class="fa fa-plus"></i> Add Price</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Addons <span class="star"></span></label>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                                <input type="radio" id="menuaddons" name="menuaddons" value="Yes" <?php echo ($menuDetails['menuaddons'] == 'Yes') ? 'checked' : ''; ?> onchange="return getAddons(this.value)"> Yes
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" id="menuaddons" name="menuaddons" value="No" <?php echo ($menuDetails['menuaddons'] == 'No') ? 'checked' : ''; ?> onchange="return getAddons(this.value)"> No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="getShowAddons" class="col-xs-12"></div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Image <span class="star"></span></label>
                                    <div class="col-md-6 col-lg-4"><?php
                                        echo $this->Form->input("Menu.menu_image",
                                            array("label"=>false,
                                                "type"=>"file",
                                                "name"=>"menuImage")); ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <img src="<?php echo MENU_LOGO_URL.'/'.$id.'/'.$menuDetails['menu_image'] ?>" alt="No image" class="img-responsive img-rounded" width="50"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Description</label>
                                    <div class="col-md-6 col-lg-4"><?php
                                        echo $this->Form->input('Menu.menu_description',
                                            array('class'=>'form-control',
                                                'value' => $menuDetails['menu_description'],
                                                'label'=>false)); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Popular <span class="star"></span></label>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                                <input type="radio" id="popular_dish" name="popular_dish" value="Yes" <?php echo ($menuDetails['popular_dish'] == 'Yes') ? 'checked' : ''; ?>> Yes
                                            </label>
                                            <label class="radio-inline">

                                                <input type="radio" id="popular_dish" name="popular_dish" value="No" <?php echo ($menuDetails['popular_dish'] == 'No') ? 'checked' : ''; ?>> No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Spicy <span class="star"></span></label>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                                <input type="radio" id="spicy_dish" name="spicy_dish" value="Yes" <?php echo ($menuDetails['spicy_dish'] == 'Yes') ? 'checked' : ''; ?>> Yes
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" id="spicy_dish" name="spicy_dish" value="No" <?php echo ($menuDetails['spicy_dish'] == 'No') ? 'checked' : ''; ?>> No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button class="btn btn-submit" type="button" onclick=" return menuAddEdit();">Save</button>
                                            <a class="btn btn-cancel" href="<?php echo ADMIN_BASE_URL ?>restaurants/menu"> Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div><?php
                            echo $this->Form->end(); ?>
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
            </div>
        </div>
    </div>
</div>

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
        var restaurant_id      = $.trim($("#restaurant_id").val()) ;
        var category_id      = $.trim($("#category_id").val()) ;
        var menu_name        = $.trim($("#menu-menu-name").val()) ;

        var originalPrice    = $.trim($("#menudetail-orginal-price").val());
        var menu_type        = $.trim($("input[name='menu_type']:checked").val());
        var price_option     = $.trim($("input[name='price_option']:checked").val());
        var addons           = $.trim($("input[name='menuaddons']:checked").val());
        var menu_image       = $.trim($(".menu-menu-image").html());

        // var img = $('#menu-menu-image').html().split('.').pop().toLowerCase();
        //alert(img);
        $('.error').html('');



        if(restaurant_id == ''){
            $(".restaurantErr").addClass('error').html('Please enter select restaurant');
            $("#restaurant_id").focus();
            error = 1;
            return false;

        }else if(category_id == ''){
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


        if(error == 0 && menuLength == 0){
            $.ajax({
                type   : 'POST',
                url    : baseUrl+'restaurants/checkMenu',
                data   : {id:'', category_id:category_id,menu_name:menu_name},
                success: function(data){
                    if($.trim(data) == '1') {
                        $(".menunameErr").addClass('error').html('This menu name already exists');
                        $("#menu-menu-name").focus();
                        return false;
                    }else {
                        $("#menuEditForm").submit();
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

        if($('#moreProuct'+i+'').length !== 0) {
            i++;
            multipleOption();
            return false;
        }

        html =  '<div id = "moreProuct'+i+'" class="row addPriceTop multipleMenu addPriceTop">'+
            '<div class="col-lg-7">'+
            '<div class="row">'+
            '<div class="col-md-6">'+
            '<div class="input text">'+
            '<input type="text" id="multiple_menu_'+i+'" data-attr="product name" maxlength="100" placeholder="Menu Name" class="form-control multipleValidate" name="data[MenuDetail][' + i + '][sub_name]">'+
            '</div>'+
            '</div>'+
            '<div class="col-md-3">'+
            '<div class="input number">'+
            '<input type="text" id="multiple_menuprice_'+i+'" data-attr="original price" step="any" placeholder="Price" class="form-control multipleValidate" name="data[MenuDetail][' + i + '][orginal_price]">'+
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
        var editedId        = $.trim($("#editedId").val()) ;
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
                var menuLength = '';
                if (price_option == 'multiple') {
                    menuLength = $('.addPriceTop').length;
                }

                $.ajax({
                    type   : 'POST',
                    url    : baseUrl+'restaurants/ajaxaction',
                    data   : {'menuId' : editedId,'restaurant_id' : restaurant_id,'category_id' : category_id,'price_option' : price_option,'menuLength' : menuLength,'action' : 'getAddons'},
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