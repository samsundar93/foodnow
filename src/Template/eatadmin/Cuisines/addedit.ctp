<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">
                    <?php if(!empty($id)) {?> Edit <?php }else{?> Add <?php }?> Cuisine
                </h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo ADMIN_BASE_URL ?>">Dashboard</a></li>
                    <li><a href="<?php echo ADMIN_BASE_URL ?>cuisines">Management</a></li>
                    <li class="active"><?php if(!empty($id)) {?> Edit <?php }else{?> Add <?php }?> Cuisines </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <?= $this->Flash->render() ?>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <?= $this->Form->create('cuisineFrom',[
                                'id' => 'cuisineFrom',
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
                                    <label class="control-label col-md-3">Cuisine Name<span class="red">*</span></label>
                                    <div class="col-md-4">
                                        <?= $this->Form->input('cuisine_name',[
                                            'type' => 'text',
                                            'id'   => 'cuisine_name',
                                            'class' => 'form-control',
                                            'value' => isset($cuisineList['cuisine_name']) ? $cuisineList['cuisine_name'] :  '',
                                            'label' => false
                                        ]) ?>
                                        <span class="nameErr"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button type="button" class="btn btn-info" onclick="cuisineAddEdit()">Submit</button>
                                    <a class="btn btn-danger" href="<?php echo ADMIN_BASE_URL?>cuisines/"> Cancel</a>
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
    function cuisineAddEdit(){
        var cuisine_name        = $.trim($("#cuisine_name").val()) ;
        var editedId         = $.trim($("#editedId").val()) ;
        $('.error').html('');

        if(cuisine_name == ''){
            $(".nameErr").addClass('error').html('Please enter the cuisine name');
            $("#cuisine_name").focus();
            return false;

        }else{
            $.ajax({
                type   : 'POST',
                url    : baseUrl+'cuisines/checkCuisine',
                data   : {id:editedId, cuisine_name:cuisine_name},
                success: function(data){
                    if($.trim(data) == 'false') {
                        $(".nameErr").addClass('error').html('This cuisine name already exists');
                        $("#cuisine_name").focus();
                        return false;
                    }else {
                        $("#cuisineFrom").submit();
                    }

                }
            });return false;
            //
        }
    }
</script>