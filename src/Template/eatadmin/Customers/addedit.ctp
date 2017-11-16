<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">
                    <?php if(!empty($id)) {?> Edit <?php }else{?> Add <?php }?> Customer
                </h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo ADMIN_BASE_URL ?>">Dashboard</a></li>
                    <li><a href="<?php echo ADMIN_BASE_URL ?>customers">Management</a></li>
                    <li class="active"><?php if(!empty($id)) {?> Edit <?php }else{?> Add <?php }?> Customer </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <?= $this->Flash->render() ?>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <?= $this->Form->create('customerFrom',[
                                'id' => 'customerFrom',
                                'enctype'  =>'multipart/form-data',
                                'data-toggle' => 'validator'
                            ])?>

                            <?= $this->Form->input('username',[
                                'type' => 'hidden',
                                'name' => 'editedId',
                                'id'   => 'editedId',
                                'value' => isset($id) ? $id : ''
                            ]) ?>
                            <span class="commonErr"></span>

                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Name<span class="red">*</span></label>
                                    <div class="col-md-4">
                                        <?= $this->Form->input('name',[
                                            'type' => 'text',
                                            'id'   => 'name',
                                            'class' => 'form-control',
                                            'label' => false,
                                            'value'   => isset($customerList['name']) ? $customerList['name'] :  '',
                                        ]) ?>
                                        <span class="nameErr"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Email<span class="red">*</span></label>
                                    <div class="col-md-4">
                                        <?= $this->Form->input('username',[
                                            'type' => 'text',
                                            'id'   => 'username',
                                            'class' => 'form-control',
                                            'value' => isset($customerList['username']) ? $customerList['username'] :  '',
                                            'label' => false
                                        ]) ?>
                                        <span class="usernameErr"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Phone Number<span class="red">*</span></label>
                                    <div class="col-md-4">
                                        <?= $this->Form->input('phone_number',[
                                            'type' => 'text',
                                            'id'   => 'phone_number',
                                            'class' => 'form-control',
                                            'value' => isset($customerList['phone_number']) ? $customerList['phone_number'] :  '',
                                            'label' => false
                                        ]) ?>
                                        <span class="phoneErr"></span>
                                    </div>
                                </div>
                            </div>

                            <?php if(!isset($id) && $id == '') { ?>
                                <div class="form-body">
                                    <div class="form-group clearfix">
                                        <label class="control-label col-md-3">Password<span class="red">*</span></label>
                                        <div class="col-md-4">
                                            <?= $this->Form->input('password',[
                                                'type' => 'password',
                                                'id'   => 'password',
                                                'class' => 'form-control',
                                                'value' => isset($customerList['password']) ? $customerList['password'] :  '',
                                                'label' => false
                                            ]) ?>
                                            <span class="passErr"></span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button type="button" class="btn btn-info" onclick="customerAddEdit()">Submit</button>
                                    <a class="btn btn-danger" href="<?php echo ADMIN_BASE_URL?>customers/"> Cancel</a>
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
    function customerAddEdit(){

        var phone_pattern = /([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/;
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        var name        = $.trim($("#name").val()) ;
        var username        = $.trim($("#username").val()) ;
        var phone_number        = $.trim($("#phone_number").val()) ;
        var password        = $.trim($("#password").val()) ;
        var editedId         = $.trim($("#editedId").val()) ;
        $('.error').html('');

        if(name == ''){
            $(".nameErr").addClass('error').html('Please your name');
            $("#name").focus();
            return false;

        }else if(username == ''){
            $(".usernameErr").addClass('error').html('Please enter your email address');
            $("#username").focus();
            return false;

        }else if(!regex.test(username)) {
            $(".usernameErr").addClass('error').html('Please enter valid email');
            $("#username").focus();
            return false;

        }else if(phone_number == ''){
            $(".phoneErr").addClass('error').html('Please enter your phone number');
            $("#phone_number").focus();
            return false;

        }else if(!phone_pattern.test( phone_number )) {
            $(".phoneErr").addClass('error').html('Please enter valid phonenumber');
            $("#phone_number").focus();
            return false;

        }else{
            if(editedId == '') {
                if(password == '') {
                    $(".passErr").addClass('error').html('Please enter password');
                    $("#password").focus();
                    return false;
                }
            }
            $.ajax({
                type   : 'POST',
                url    : baseUrl+'customers/checkCustomer',
                data   : {id:editedId, phone_number:phone_number,username:username},
                success: function(data){
                    if($.trim(data) == 'false') {
                        $(".commonErr").addClass('error').html('This email or phone number already exists');
                        return false;
                    }else {
                        $("#customerFrom").submit();
                    }

                }
            });return false;

        }
    }
</script>