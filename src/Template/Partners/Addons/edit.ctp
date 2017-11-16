<section class="col-xs-12 col-sm-9">
    <div class="buyer-title">Category Add</div>
    <div class="products-section no-padding-top">
        <div class="clearfix">
            <div class="checkout-wrapper buyer-checkout-wrapper no-margin-bottom">
                <div class="checkout-body">
                    <div class="checkout-body-title">
                        <span class="pull-left checkout-body-left">&nbsp;</span>
                    </div>
                    <?php echo $this->Form->create('categoryAdd',array('name'=>'addonsAddEditFrom',
                        'id'=>'addonsAddEditFrom',
                        'class'=>'form-horizontal'
                    ));
                    ?>
                    <?= $this->Form->input('editedId',[
                        'type' => 'hidden',
                        'name' => 'editedId',
                        'id'   => 'editedId',
                        'value' => isset($id) ? $id : ''
                    ]) ?>
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-group clearfix">
                            <div class="col-sm-4">
                                <label for="category_name">Category Name<span class="help">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <?= $this->Form->input('category_id',[
                                    'type' => 'select',
                                    'id'   => 'category_id',
                                    'class' => 'form-control',
                                    'options' => $categoryList,
                                    'label' => false,
                                    'value' => (isset($addonsList['category_id'])) ? $addonsList['category_id'] : '',
                                    'empty'   =>'Please Choose Category'
                                ]) ?>
                                <span class="categoryErr"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-group clearfix">
                            <div class="col-sm-4">
                                <label for="category_name">Addons Name<span class="help">*</span></label>
                            </div>
                            <div class="col-sm-4">
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
                            <button type="button" class="btn btn-submit" onclick="addonsAddEdit()">Submit</button>
                            <a class="btn btn-cancel" href="<?php echo ADMIN_BASE_URL?>addons/"> Cancel</a>
                        </div>
                    </div>
                    <?= $this->Form->end();?>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<script>

    function addonsAddEdit(){

        var category_id        = $.trim($("#category_id").val()) ;
        var menu_name        = $.trim($("#menu_name").val()) ;
        var editedId         = $.trim($("#editedId").val()) ;

        var mainaddons_name   = $('#mainaddons_name').val();
        var mainaddons_min_count  = $('#mainaddons_min_count').val();
        var mainaddons_count    = $('#mainaddons_count').val();


        $('.error').html('');

        if(category_id == ''){
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
                    url    : jsSitePartner+'addons/checkAddons',
                    data   : {id:editedId, category_id:category_id,mainaddons_name:mainaddons_name},
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