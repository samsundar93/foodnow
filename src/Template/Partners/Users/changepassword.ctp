<section class="col-xs-12 col-sm-9">
    <div class="buyer-title">Change Password</div>
    <div class="products-section no-padding-top">
        <div class="clearfix">
            <div class="checkout-wrapper buyer-checkout-wrapper no-margin-bottom">
                <div class="checkout-body">
                    <div class="checkout-body-title">
                        <span class="pull-left checkout-body-left">&nbsp;</span>
                    </div>
                    <?php echo $this->Form->create('changepassword',array('name'=>'changepassword',
                        'id'=>'changepassword',
                        'class'=>'form-horizontal'
                    ));
                    ?>
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-group clearfix">
                            <div class="col-sm-4">
                                <label for="category_name">New Password<span class="help">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <?= $this->Form->input("password",[
                                    "type" => "password",
                                    "class" => "form-control my-form-control",
                                    "id" => 'password',
                                    "div" => false,
                                    "label" => false
                                ]);?>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="col-sm-4">
                                <label for="category_name">Confirm Password<span class="help">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <?= $this->Form->input("confirm_password",[
                                    "type" => "password",
                                    "class" => "form-control my-form-control",
                                    "id" => 'confirm_password',
                                    "div" => false,
                                    "label" => false
                                ]);?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 text-center">
                        <button class="btn btn-submit" type="submit" onclick=" return changePassword();">Submit</button>
                    </div>
                    <?= $this->Form->end();?>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<script type="text/javascript">

    function changePassword(){
        var password        = $.trim($("#password").val()) ;
        var confirm_password         = $.trim($("#confirm_password").val()) ;
        $('.error').html('');

        if(password == ''){
            $('#password').after('<label class="error">Please enter the new password</label>');
            $("#password").focus();
            return false;

        }else if(confirm_password == ''){
            $('#confirm_password').after('<label class="error">Please enter the confirm password</label>');
            $("#confirm_password").focus();
            return false;

        }else if(password != confirm_password){
            $('#password').after('<label class="error">New password and confirm should be same.</label>');
            $("#password").focus();
            return false;
        }
    }

</script>