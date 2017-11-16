<?php if($controller !== 'Menus') { ?>
<footer>
    <div class="container">
        <div class="col-sm-4">
            <ul class="footer-ul">
                <li><i class="fa fa-dot-circle-o"></i><a href="#">About Us</a></li>
                <li><i class="fa fa-dot-circle-o"></i><a href="#">Team</a></li>
                <li><i class="fa fa-dot-circle-o"></i><a href="#">Career</a></li>
                <li><i class="fa fa-dot-circle-o"></i><a href="#">Help & support</a></li>
            </ul>
        </div>
        <div class="col-sm-4">
            <ul class="footer-ul">
                <li><i class="fa fa-dot-circle-o"></i><a href="#">Terms & Conditions </a></li>
                <li><i class="fa fa-dot-circle-o"></i><a href="#">Refunds & Cancellation Policy</a></li>
                <li><i class="fa fa-dot-circle-o"></i><a href="#">Privacy Policy</a></li>
                <li><i class="fa fa-dot-circle-o"></i><a href="#">Offer Terms </a></li>
            </ul>
        </div>
        <div class="col-sm-4">
            <ul class="social-ul">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i>
                    </a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i>
                    </a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i>
                    </a></li>
                <li><a href="#"><i class="fa fa-google" aria-hidden="true"></i>
                    </a></li>
            </ul>
        </div>
    </div>
</footer>
<div class="copyright">All Rights Reserved By copyright @2017</div>
<?php } ?>
<div id="login_popup" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header clearfix">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body clearfix">
                <div class="login_popup_cont">
                    <div class="login-title">Log in to your account</div>
                    <div class="form-group">
                        <?= $this->Form->input('loginUser',[
                            'type' => 'text',
                            'id'   => 'loginUser',
                            'class' => 'form-control my-from-control',
                            'placeholder' => 'Phone Number',
                            'autocomplete' => 'off',
                            'label' => false
                        ]) ?>
                        <span class="userLoginErr"></span>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('loginPass',[
                            'type' => 'password',
                            'id'   => 'loginPass',
                            'class' => 'form-control my-from-control',
                            'placeholder' => 'Password',
                            'autocomplete' => 'off',
                            'label' => false
                        ]) ?>
                        <span class="userPassErr"></span>
                    </div>
                    <div class="login-btn"><button onclick="return customerRegister()" class="btn">Login</button></div>
                    <div class="forget"><a href="">Forget your password?</a>
                    </div>
                </div>
                <div class="login_popup_cont2">
                    <div class="login-title2">Not a member yet?</div>
                    <div class="join-family">Join Our Family</div>
                    <div class="login-sign-btn"><button class="btn" data-dismiss="modal" data-target="#signup_popup" data-toggle="modal">Sign Up</button></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="signup_popup" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header clearfix">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body clearfix">
                <?= $this->Form->create('customerFrom',[
                    'id' => 'customerFrom',
                    'enctype'  =>'multipart/form-data',
                    'data-toggle' => 'validator'
                ])?>
                    <div class="login_popup_cont">
                        <div class="login-title">Register with LikeEat</div>
                        <span class="commonErr"></span>
                        <div class="form-group">
                            <?= $this->Form->input('name',[
                                'type' => 'text',
                                'id'   => 'name',
                                'class' => 'form-control my-from-control',
                                'placeholder' => 'Name',
                                'autocomplete' => 'off',
                                'label' => false
                            ]) ?>
                            <span class="nameErr"></span>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->input('username',[
                                'type' => 'text',
                                'id'   => 'username',
                                'placeholder' => 'Email',
                                'class' => 'form-control my-from-control',
                                'autocomplete' => 'off',
                                'label' => false
                            ]) ?>
                            <span class="usernameErr"></span>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->input('phone_number',[
                                'type' => 'text',
                                'id'   => 'phone_number',
                                'placeholder' => 'Phone Number',
                                'class' => 'form-control my-from-control',
                                'autocomplete' => 'off',
                                'label' => false
                            ]) ?>
                            <span class="phoneErr"></span>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->input('password',[
                                'type' => 'password',
                                'id'   => 'password',
                                'placeholder' => 'Password',
                                'class' => 'form-control my-from-control',
                                'autocomplete' => 'off',
                                'label' => false
                            ]) ?>
                            <span class="passErr"></span>
                        </div>
                        <div class="forget">
                            <input type="checkbox"> I accept the <a href="">Terms and condition</a>
                        </div>
                        <div class="login-btn">
                            <button onclick="return userRegister()" class="btn">Register</button>
                        </div>

                    </div>
                <?=  $this->Form->end(); ?>
                <div class="login_popup_cont2">
                    <div class="login-title2">Alreday a member?</div>
                    <div class="join-family">Login Now and feel the next level of food ordering</div>
                    <div class="login-sign-btn"><button data-dismiss="modal" data-target="#login_popup" data-toggle="modal" class="btn">Login</button></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="checkoutlogin_popup" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header clearfix">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body clearfix">
                <div class="login_popup_cont">
                    <div class="login-title">Log in to your account</div>
                    <div class="form-group">
                        <?= $this->Form->input('checkoutLoginUser',[
                            'type' => 'text',
                            'id'   => 'checkoutLoginUser',
                            'class' => 'form-control my-from-control',
                            'placeholder' => 'Phone Number',
                            'autocomplete' => 'off',
                            'label' => false
                        ]) ?>
                        <span class="checkoutLoginErr"></span>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('checkoutLoginPass',[
                            'type' => 'password',
                            'id'   => 'checkoutLoginPass',
                            'class' => 'form-control my-from-control',
                            'placeholder' => 'Password',
                            'autocomplete' => 'off',
                            'label' => false
                        ]) ?>
                        <span class="checkoutPassErr"></span>
                    </div>
                    <div class="login-btn"><button onclick="return checkoutLogin()" class="btn">Login</button></div>
                    <div class="forget"><a href="">Forget your password?</a>
                    </div>
                </div>
                <div class="login_popup_cont2">
                    <div class="login-title2">Not a member yet?</div>
                    <div class="join-family">Join Our Family</div>
                    <div class="login-sign-btn"><button class="btn" data-dismiss="modal" data-target="#signup_popup" data-toggle="modal">Sign Up</button></div>
                </div>
            </div>
        </div>
    </div>
</div>