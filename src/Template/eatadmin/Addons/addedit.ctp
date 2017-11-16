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
                    <li><a href="<?php echo ADMIN_BASE_URL ?>addons">Management</a></li>
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
                            <?= $this->Form->create('addonsAddEditFrom',[
                                'id' => 'addonsAddEditFrom',
                                'enctype'  =>'multipart/form-data',
                                'data-toggle' => 'validator'
                            ])?>

                            <?= $this->Form->input('username',[
                                'type' => 'hidden',
                                'name' => 'editedId',
                                'id'   => 'editedId',
                                'value' => isset($id) ? $id : ''
                            ]) ?>


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
                                            'value'   => isset($addonsList['restaurant_id']) ? $addonsList['restaurant_id'] :  '',
                                            'empty'   =>'Please Choose Restaurant',
                                            'onchange' => 'return getCategory(this.value)'
                                        ]) ?>
                                        <span class="restaurantErr"></span>
                                    </div>
                                </div>
                            </div>

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
                                            'value'   => isset($addonsList['category_id']) ? $addonsList['category_id'] :  '',
                                            'empty'   =>'Please Choose Category'
                                        ]) ?>
                                        <span class="categoryErr"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="col-md-3 control-label">Addons Name <span class="star">*</span></label>
                                    <div class="col-md-6 col-lg-3">
                                        <?php echo $this->Form->input('mainaddons_name', [
                                            'type'  => 'text',
                                            'class' => 'form-control',
                                            'id' => 'mainaddons_name',
                                            'value' => (isset($addonsList['mainaddons_name'])) ? $addonsList['mainaddons_name'] : '',
                                            'label'=> false
                                        ]); ?>
                                        <span class="mainaddonsErr"></span>
                                    </div>
                                    <div class="col-md-6 col-lg-2">
                                        <?php echo $this->Form->input('mainaddons_min_count', [
                                            'type'  => 'text',
                                            'class' => 'form-control',
                                            'id' => 'mainaddons_min_count',
                                            'value' => (isset($addonsList['mainaddons_min_count'])) ? $addonsList['mainaddons_min_count'] : '',
                                            'label'=> false
                                        ]); ?>
                                        <span class="mainaddonsminErr"></span>
                                    </div>
                                    <div class="col-md-6 col-lg-2">
                                        <?php echo $this->Form->input('mainaddons_count', [
                                            'type'  => 'text',
                                            'class' => 'form-control',
                                            'id' => 'mainaddons_count',
                                            'value' => (isset($addonsList['mainaddons_count'])) ? $addonsList['mainaddons_count'] : '',
                                            'label'=> false
                                        ]); ?>
                                        <span class="mainaddonscountErr"></span>
                                    </div>
                                    <!--<div class="col-md-6 col-lg-3">
                                        <a href="javascript:;" onclick="addMainAddons()" class="btn btn-success">Add More Main Addons</a>
                                    </div>-->
                                    <div class="col-md-6 col-lg-2">
                                        <a href="javascript:;" onclick="addSubAddons()" class="btn btn-success">Add Sub Addons</a>
                                    </div>
                                </div>


                                <div class="form-body" id="subAddonsList">
                                    <?php if(!empty($addonsList)) {
                                        foreach ($addonsList['subaddons'] as $key => $value) { ?>
                                            <div class="form-group clearfix" id="removeSubaddon_<?php echo $key ?>">
                                                <label></label>
                                                <div class="col-md-6 col-lg-3 col-md-offset-3">
                                                    <input type="text" id="SubAddonName_<?php echo $key ?>"
                                                           name="Subaddon[<?php echo $key ?>][subaddons_name]"
                                                           value = <?php echo $value['subaddons_name'] ?>
                                                           class="form-control subaddonsList"
                                                           placeholder="Subaddon Name">
                                                </div>
                                                <span class="subaddonsErr_0"></span>
                                                <div class="col-md-6 col-lg-2">
                                                    <input type="text" id="SubAddonPrice_<?php echo $key ?>"
                                                           name="Subaddon[<?php echo $key ?>][subaddons_price]" class="form-control" value = <?php echo $value['subaddons_price'] ?>
                                                           placeholder="Price">
                                                </div>
                                                <span class="subaddonspriceErr_0"></span>
                                            </div>
                                        <?php }
                                    }else {?>
                                        <div class="form-group clearfix" id="removeSubaddon_0">
                                            <label></label>
                                            <div class="col-md-6 col-lg-3 col-md-offset-3">
                                                <input type="text" id="SubAddonName_0" name="Subaddon[0][subaddons_name]" class="form-control subaddonsList" placeholder="Subaddon Name">
                                            </div>
                                            <span class="subaddonsErr_0"></span>
                                            <div class="col-md-6 col-lg-2">
                                                <input type="text" id="SubAddonPrice_0" name="Subaddon[0][subaddons_price]" class="form-control" placeholder="Price">
                                            </div>
                                            <span class="subaddonspriceErr_0"></span>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button type="button" class="btn btn-info" onclick="addonsAddEdit()">Submit</button>
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
    function addonsAddEdit(){

        var restaurant_id        = $.trim($("#restaurant_id").val()) ;
        var category_id        = $.trim($("#category_id").val()) ;
        var menu_name        = $.trim($("#menu_name").val()) ;
        var editedId         = $.trim($("#editedId").val()) ;

        var mainaddons_name   = $('#mainaddons_name').val();
        var mainaddons_min_count  = $('#mainaddons_min_count').val();
        var mainaddons_count    = $('#mainaddons_count').val();


        $('.error').html('');

        if(restaurant_id == ''){
            $(".restaurantErr").addClass('error').html('Please choose restaurant');
            $("#restaurant_id").focus();
            return false;

        }else if(category_id == ''){
            $(".categoryErr").addClass('error').html('Please enter the category name');
            $("#category_id").focus();
            return false;

        }else if(mainaddons_name == ''){
            $(".mainaddonsErr").addClass('error').html('Please enter main addons name');
            $("#mainaddons_name").focus();
            return false;

        }else if(mainaddons_min_count == ''){
            $(".mainaddonsminErr").addClass('error').html('Please enter minimum count');
            $("#mainaddons_min_count").focus();
            return false;

        }else if(mainaddons_count == ''){
            $(".mainaddonscountErr").addClass('error').html('Please enter main addons count');
            $("#mainaddons_count").focus();
            return false;

        }else {
            var subAddonsCount = $(".subaddonsList").length;

            if(subAddonsCount > 0) {
                $(".subaddonsList").each(function () {
                    var addonsId = (this.id).split('_');
                    var addonName = $("#SubAddonName_"+addonsId[1]).val();
                    var addonPrice = $("#SubAddonPrice_"+addonsId[1]).val();
                    if(addonName == '') {
                        $(".subaddonsErr_"+addonsId[1]).addClass('error').html('Please enter subaddons name');
                        $("#SubAddonName_"+addonsId[1]).focus();
                        return false;
                    }else if(addonPrice == '') {
                        $(".subaddonspriceErr_"+addonsId[1]).addClass('error').html('Please enter subaddons price');
                        $("#SubAddonPrice_"+addonsId[1]).focus();
                        return false;

                    }else {
                        subAddonsCount--

                    }
                })
            }

            if(subAddonsCount == 0) {
                $.ajax({
                    type   : 'POST',
                    url    : baseUrl+'addons/checkAddons',
                    data   : {id:editedId, category_id:category_id,restaurant_id:restaurant_id,mainaddons_name:mainaddons_name},
                    success: function(data){
                        if($.trim(data) == '1') {
                            $(".mainaddonsErr").addClass('error').html('This addons already exists');
                            $("#mainaddons_name").focus();
                            return false;
                        }else {
                            $("#addonsAddEditFrom").submit();
                        }

                    }
                });return false;
            }

        }
        return false;
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

    var a = 1;
    function addSubAddons(){

        if($('#SubAddonName_'+a+'').length !== 0) {
            a++;
            addSubAddons();
            return false;
        }

        $('#subAddonsList').append(
            '<div class="form-group clearfix" id="removeSubaddon_'+a+'">'+
            '<div class="col-md-6 col-lg-3 col-md-offset-2">'+
            '<input type="text" class="form-control subaddonsList" id="SubAddonName_'+a+'" name="Subaddon['+a+'][subaddons_name]" placeholder="Subaddon Name" >'+
            '</div>'+
            '<span class="subaddonsErr_'+a+'"></span>'+
            '<div class="col-md-6 col-lg-2">'+
            '<input type="text" class="form-control" id="SubAddonPrice_'+a+'" name="Subaddon['+a+'][subaddons_price]" placeholder="Price">'+
            '</div>'+
            '<span class="subaddonspriceErr_'+a+'"></span>'+
            '<div class="col-md-6 col-lg-2">'+
            '<a href="javascript:;" onclick="removeSubAddons('+a+');" class="btn btn-danger">X</a>'+
            '</div>'+
            '</div>'
        );
        a++;
    }

    function removeSubAddons(id){
        $('#removeSubaddon_'+id).remove();
        return false;
    }

</script>