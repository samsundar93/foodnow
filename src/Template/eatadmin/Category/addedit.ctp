<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">
                    <?php if(!empty($id)) {?> Edit <?php }else{?> Add <?php }?> Category
                </h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo ADMIN_BASE_URL ?>">Dashboard</a></li>
                    <li><a href="<?php echo ADMIN_BASE_URL ?>category">Management</a></li>
                    <li class="active"><?php if(!empty($id)) {?> Edit <?php }else{?> Add <?php }?> Category </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <?= $this->Flash->render() ?>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <?= $this->Form->create('categoryFrom',[
                                'id' => 'categoryFrom',
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
                                            'value'   => isset($categoryList['restaurant_id']) ? $categoryList['restaurant_id'] :  '',
                                            'empty'   =>'Please Choose Restaurant'
                                        ]) ?>
                                        <span class="restaurantErr"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Category Name<span class="red">*</span></label>
                                    <div class="col-md-4">
                                        <?= $this->Form->input('catname',[
                                            'type' => 'text',
                                            'id'   => 'catname',
                                            'class' => 'form-control',
                                            'value' => isset($categoryList['catname']) ? $categoryList['catname'] :  '',
                                            'label' => false
                                        ]) ?>
                                        <span class="nameErr"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button type="button" class="btn btn-info" onclick="categoryAddEdit()">Submit</button>
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
    function categoryAddEdit(){

        var restaurant_id        = $.trim($("#restaurant_id").val()) ;
        var catname        = $.trim($("#catname").val()) ;
        var editedId         = $.trim($("#editedId").val()) ;
        $('.error').html('');

        if(restaurant_id == ''){
            $(".restaurantErr").addClass('error').html('Please choose restaurant');
            $("#restaurant_id").focus();
            return false;

        }else if(catname == ''){
            $(".nameErr").addClass('error').html('Please enter the category name');
            $("#catname").focus();
            return false;

        }else{
            $.ajax({
                type   : 'POST',
                url    : baseUrl+'category/checkCategory',
                data   : {id:editedId, catname:catname,restaurant_id:restaurant_id},
                success: function(data){
                    if($.trim(data) == 'false') {
                        $(".nameErr").addClass('error').html('This category name already exists');
                        $("#catname").focus();
                        return false;
                    }else {
                        $("#categoryFrom").submit();
                    }

                }
            });return false;
            //
        }
    }
</script>