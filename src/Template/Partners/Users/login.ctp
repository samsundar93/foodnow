<section class="col-xs-12 col-sm-12">
    <div class="login-box">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="login-left">
                <div class="login-title">Login</div>
                <?php echo $this->Form->create('productAdd',array('name'=>'userLogin',
                    'id'=>'userLogin',
                    'class'=>'form-horizontal'
                )); ?>
                    <div class="form-group clearfix">
                        <label>Username Or Email*</label>
                        <?= $this->Form->input('username',[
                            'type' => 'text',
                            'id'   => 'username',
                            'class' => 'form-control login-form-control',
                            'label' => false
                        ]) ?>
                    </div>
                    <div class="form-group clearfix">
                        <label>Password*</label>
                        <?= $this->Form->input('password',[
                            'type' => 'password',
                            'id'   => 'password',
                            'class' => 'form-control login-form-control',
                            'label' => false
                        ]) ?>
                    </div>
                    <div class="form-group clearfix">
                        <span class="pull-left"><input type="checkbox" id="remember"><label for="remember">Remember Me</label></span>
                        <!--<span class="pull-right"><a href="">Forgot Password?</a></span>-->
                    </div>
                    <div class="login-btn-div text-center">
                        <button type="submit" onclick="return loginValidate();" class="btn login-btn">LOGIN</button>
                    </div>
                <?= $this->Form->end();?>
                <div class="or-text text-center">OR</div>
                <div class="">
                    <div class="col-sm-6 col-xs-12 no-padding-left"><button class="facebook-btn">facebook</button></div>
                    <div class="col-sm-6 col-xs-12 no-padding-right"><button class="google-btn">Google Plus</button></div>
                </div>
                <div class="login-sign-text">New To Here?<a href="">Sign Up</a></div>
            </div>
        </div>
    </div>
    </div>
</section>