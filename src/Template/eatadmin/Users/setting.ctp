<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Site Settings</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo ADMIN_BASE_URL ?>">Dashboard</a></li>
                    <li class="active">Common Settings</li>
                </ol>
            </div>
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <svg class="hidden">
                        <defs>
                            <path id="tabshape" d="M80,60C34,53.5,64.417,0,0,0v60H80z"/>
                        </defs>
                    </svg>
                    <section class="m-t-39">
                        <?= $this->Flash->render() ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-info">
                                    <div class="panel-wrapper collapse in" aria-expanded="true">
                                        <div class="panel-body">
                                            <?= $this->Form->create('siteSetting',[
                                                  'id' => 'settingFrom',
                                                 'enctype'  =>'multipart/form-data'
                                            ])?>
                                            <div class="sttabs tabs-style-shape">
                                                <nav>
                                                    <ul>
                                                        <li>
                                                            <a href="#sitetab">
                                                                <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                                                                <span>Site</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#contactTab">
                                                                <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                                                                <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                                                                <span>Contact</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="locationTab">
                                                                <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                                                                <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                                                                <span>Location</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="paymentTab">
                                                                <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                                                                <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                                                                <span>Payment</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="SMSTab">
                                                                <svg viewBox="0 0 80 60" preserveAspectRatio="none"><use xlink:href="#tabshape"></use></svg>
                                                                <span>SMS</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                                <div class="content-wrap">
                                                    <!--Site Details-->
                                                    <section id="sitetab">
                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Site Name<span class="red">*</span></label>
                                                                <div class="col-md-4">
                                                                    <?= $this->Form->input('site_name',[
                                                                        'type' => 'text',
                                                                        'id'   => 'site_name',
                                                                        'class' => 'form-control',
                                                                        'label' => false
                                                                    ]) ?>
                                                                    <span class="nameErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Site Logo<span class="red">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                                        <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                                            <span class="fileinput-filename site_logo"><?php echo $site_data['site_logo'] ?></span>
                                                                        </div>
                                                                        <span class="input-group-addon btn btn-default btn-file">
                                                                            <span class="fileinput-new">Select file</span>
                                                                            <span class="fileinput-exists">Change</span>
                                                                            <input type="file" name="sitelogo">
                                                                        </span>
                                                                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove
                                                                        </a>

                                                                    </div>
                                                                    <span class="logoErr"></span>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <img src="<?php echo ADMIN_BASE_URL.'images/'.$site_data['site_logo'] ?>" alt="No image" class="img-responsive img-rounded" width="100"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Site Fav Icon<span class="red">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                                        <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                                            <span class="fileinput-filename site_favicon"><?php echo $site_data['site_favicon'] ?></span>
                                                                        </div>
                                                                        <span class="input-group-addon btn btn-default btn-file">
                                                                            <span class="fileinput-new">Select file</span>
                                                                            <span class="fileinput-exists">Change</span>
                                                                            <input type="file" name="sitefav">
                                                                        </span>
                                                                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove
                                                                        </a>
                                                                    </div>
                                                                    <span class="faviconErr"></span>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <img src="<?php echo ADMIN_BASE_URL.'images/'.$site_data['site_favicon'] ?>" alt="No image" class="img-responsive img-rounded" width="50"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Site Currency<span class="red">*</span></label>
                                                                <div class="col-md-4">
                                                                    <?= $this->Form->input('site_currency',[
                                                                        'type' => 'text',
                                                                        'id'   => 'site_currency',
                                                                        'class' => 'form-control',
                                                                        'label' => false
                                                                    ]) ?>
                                                                    <span class="currencyErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Drop Time<span class="red">*</span></label>
                                                                <div class="col-md-4">
                                                                    <?=
                                                                    $this->Form->radio(
                                                                        'drop_timing',
                                                                        [
                                                                            ['value' => '24', 'text' => '24 Hrs', 'checked' => ($site_data['drop_timing'] == '24') ? 'checked' : '' ],
                                                                            ['value' => '48', 'text' => '48 Hrs', 'checked' => ($site_data['drop_timing'] == '48') ? 'checked' : '' ]
                                                                        ]
                                                                    );
                                                                    ?>
                                                                    <span class="dropErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </section>

                                                    <!--Site Contact Information-->
                                                    <section id="contactTab">

                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Admin Name<span class="red">*</span></label>
                                                                <div class="col-md-4">
                                                                    <?= $this->Form->input('admin_name',[
                                                                        'type' => 'text',
                                                                        'id'   => 'admin_name',
                                                                        'class' => 'form-control',
                                                                        'label' => false
                                                                    ]) ?>
                                                                    <span class="admNameErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Admin Email<span class="red">*</span></label>
                                                                <div class="col-md-4">
                                                                    <?= $this->Form->input('admin_email',[
                                                                        'type' => 'text',
                                                                        'id'   => 'admin_email',
                                                                        'class' => 'form-control',
                                                                        'label' => false
                                                                    ]) ?>
                                                                    <span class="admEmailErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Order Email<span class="red">*</span></label>
                                                                <div class="col-md-4">
                                                                    <?= $this->Form->input('order_email',[
                                                                        'type' => 'text',
                                                                        'id'   => 'order_email',
                                                                        'class' => 'form-control',
                                                                        'label' => false
                                                                    ]) ?>
                                                                    <span class="orderEmailErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">ContactUs Email<span class="red">*</span></label>
                                                                <div class="col-md-4">
                                                                    <?= $this->Form->input('contactus_email',[
                                                                        'type' => 'text',
                                                                        'id'   => 'contactus_email',
                                                                        'class' => 'form-control',
                                                                        'label' => false
                                                                    ]) ?>
                                                                    <span class="contactusErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Site Phone Number<span class="red">*</span></label>
                                                                <div class="col-md-4">
                                                                    <?= $this->Form->input('site_phonenumber',[
                                                                        'type' => 'text',
                                                                        'id'   => 'site_phonenumber',
                                                                        'class' => 'form-control',
                                                                        'maxlength' => 10,
                                                                        'label' => false
                                                                    ]) ?>
                                                                    <span class="phonenumberErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>

                                                    <!--Site Location Details-->

                                                    <section id="locationTab">

                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Site Address<span class="red">*</span></label>
                                                                <div class="col-md-4">
                                                                    <?= $this->Form->input('site_address',[
                                                                        'type' => 'text',
                                                                        'id'   => 'site_address',
                                                                        'class' => 'form-control',
                                                                        'label' => false
                                                                    ]) ?>
                                                                    <span class="addressErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Site City<span class="red">*</span></label>
                                                                <div class="col-md-4">
                                                                    <?= $this->Form->input('site_city',[
                                                                        'type' => 'text',
                                                                        'id'   => 'site_city',
                                                                        'class' => 'form-control',
                                                                        'label' => false
                                                                    ]) ?>
                                                                    <span class="cityErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Site Zipcode<span class="red">*</span></label>
                                                                <div class="col-md-4">
                                                                    <?= $this->Form->input('site_zipcode',[
                                                                        'type' => 'text',
                                                                        'id'   => 'site_zipcode',
                                                                        'class' => 'form-control',
                                                                        'label' => false
                                                                    ]) ?>
                                                                    <span class="zipcodeErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Site State<span class="red">*</span></label>
                                                                <div class="col-md-4">
                                                                    <?= $this->Form->input('site_state',[
                                                                        'type' => 'text',
                                                                        'id'   => 'site_state',
                                                                        'class' => 'form-control',
                                                                        'label' => false
                                                                    ]) ?>
                                                                    <span class="stateErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Site Country<span class="red">*</span></label>
                                                                <div class="col-md-4">
                                                                    <?= $this->Form->input('site_country',[
                                                                        'type' => 'text',
                                                                        'id'   => 'site_country',
                                                                        'class' => 'form-control',
                                                                        'label' => false
                                                                    ]) ?>
                                                                    <span class="countryErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Time Zone<span class="red">*</span></label>
                                                                <div class="col-md-4">
                                                                    <?= $this->Form->input('timezone',[
                                                                        'type' => 'select',
                                                                        'id'   => 'timezone',
                                                                        'options'=> $zone,
                                                                        'value' => ($site_data['timezone'] ?? ''),
                                                                        'empty'  => 'Please Choose timezone',
                                                                        'class' => 'form-control',
                                                                        'label' => false
                                                                    ]) ?>
                                                                    <span class="timezoneErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>

                                                    <!--Site Payment Details-->
                                                    <section id="paymentTab">


                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Payment Method<span class="red">*</span></label>
                                                                <div class="col-md-4">
                                                                    <?=
                                                                    $this->Form->radio(
                                                                        'payment_mode',
                                                                        [
                                                                            ['value' => 'Demo', 'text' => 'Demo', 'checked' => ($site_data['payment_mode'] == 'Demo') ? 'checked' : ''],
                                                                            ['value' => 'Live', 'text' => 'Live', 'checked' => ($site_data['payment_mode'] == 'Live') ? 'checked' : '' ]

                                                                        ]
                                                                    );
                                                                    ?>
                                                                    <span class="paymentErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="paydemo" style="<?php echo ($site_data['payment_mode'] == 'Live') ? 'display:none' : '' ?>">

                                                            <div class="form-body">
                                                                <div class="form-group clearfix">
                                                                    <label class="control-label col-md-3">Paypal Demo Url<span class="red">*</span></label>
                                                                    <div class="col-md-4">
                                                                        <?= $this->Form->input('paypal_demo_url',[
                                                                            'type' => 'text',
                                                                            'id'   => 'paypal_demo_url',
                                                                            'class' => 'form-control',
                                                                            'label' => false
                                                                        ]) ?>
                                                                        <span class="demo_urlErr"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-body">
                                                                <div class="form-group clearfix">
                                                                    <label class="control-label col-md-3">Paypal Demo Business<span class="red">*</span></label>
                                                                    <div class="col-md-4">
                                                                        <?= $this->Form->input('paypal_demo_business',[
                                                                            'type' => 'text',
                                                                            'id'   => 'paypal_demo_business',
                                                                            'class' => 'form-control',
                                                                            'label' => false
                                                                        ]) ?>
                                                                        <span class="demo_businessErr"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div id="paylive" style="<?php echo ($site_data['payment_mode'] == 'Demo') ? 'display:none' : '' ?>">
                                                            <div class="form-body">
                                                                <div class="form-group clearfix">
                                                                    <label class="control-label col-md-3">Paypal Live Url<span class="red">*</span></label>
                                                                    <div class="col-md-4">
                                                                        <?= $this->Form->input('paypal_live_url',[
                                                                            'type' => 'text',
                                                                            'id'   => 'paypal_live_url',
                                                                            'class' => 'form-control',
                                                                            'label' => false
                                                                        ]) ?>
                                                                        <span class="live_urlErr"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-body">
                                                                <div class="form-group clearfix">
                                                                    <label class="control-label col-md-3">Paypal Live Business<span class="red">*</span></label>
                                                                    <div class="col-md-4">
                                                                        <?= $this->Form->input('paypal_live_business',[
                                                                            'type' => 'text',
                                                                            'id'   => 'paypal_live_business',
                                                                            'class' => 'form-control',
                                                                            'label' => false
                                                                        ]) ?>
                                                                        <span class="live_businessErr"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </section>

                                                    <!--Site SMS Setting-->
                                                    <section id="SMSTab">

                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Twilio Token Id<span class="red">*</span></label>
                                                                <div class="col-md-4">
                                                                    <?= $this->Form->input('twilio_token_id',[
                                                                        'type' => 'text',
                                                                        'id'   => 'twilio_token_id',
                                                                        'class' => 'form-control',
                                                                        'label' => false
                                                                    ]) ?>
                                                                    <span class="token_idErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Twilio Secret Key<span class="red">*</span></label>
                                                                <div class="col-md-4">
                                                                    <?= $this->Form->input('twilio_secret_key',[
                                                                        'type' => 'text',
                                                                        'id'   => 'twilio_secret_key',
                                                                        'class' => 'form-control',
                                                                        'label' => false
                                                                    ]) ?>
                                                                    <span class="secret_keyErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Twilio From Number<span class="red">*</span></label>
                                                                <div class="col-md-4">
                                                                    <?= $this->Form->input('twilio_from_no',[
                                                                        'type' => 'text',
                                                                        'id'   => 'twilio_from_no',
                                                                        'class' => 'form-control',
                                                                        'label' => false
                                                                    ]) ?>
                                                                    <span class="from_noErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div><!-- /tabs -->
                                                <button style="margin: 13px 0 8px 407px;" class="btn btn-success" type="button" onclick="settingValidate();">
                                                    <i class="fa fa-check"></i>
                                                    Submit
                                                </button>
                                            <?=  $this->Form->end(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

    //Accpet Only Number//
    $(document).ready(function() {
        $("#site_phonenumber").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });


    //Validate Email Address//
    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    };

    //Validate Site Setting//
  function settingValidate(){


        var site_name        = $.trim($("#site_name").val()) ;
        var site_logo        = $.trim($(".site_logo").html()) ;
        var site_favicon     = $.trim($(".site_favicon").html());
        var site_currency    = $.trim($("#site_currency").val());
        var drop_timing      = $.trim($("input[name='drop_timing']:checked").val());

        var admin_name       = $.trim($("#admin_name").val()) ;
        var admin_email      = $.trim($("#admin_email").val()) ;
        var order_email      = $.trim($("#order_email").val()) ;
        var contactus_email  = $.trim($("#contactus_email").val()) ;
        var site_phonenumber = $.trim($("#site_phonenumber").val()) ;

        var site_address     = $.trim($("#site_address").val());
        var site_city        = $.trim($("#site_city").val());
        var site_zipcode     = $.trim($("#site_zipcode").val());
        var site_state       = $.trim($("#site_state").val());
        var site_country     = $.trim($("#site_country").val());
        var timezone         = $.trim($("#timezone").val());

        var payment_mode          = $.trim($("input[name='payment_mode']:checked").val());
        var paypal_demo_url       = $.trim($("#paypal_demo_url").val());
        var paypal_demo_business  = $.trim($("#paypal_demo_business").val());
        var paypal_live_url       = $.trim($("#paypal_live_url").val());
        var paypal_live_business  = $.trim($("#paypal_live_business").val());

        var twilio_token_id       = $.trim($("#twilio_token_id").val());
        var twilio_secret_key     = $.trim($("#twilio_secret_key").val());
        var twilio_from_no        = $.trim($("#twilio_from_no").val());

        var img = $('.site_logo').html().split('.').pop().toLowerCase();
        var icon = $('.site_favicon').html().split('.').pop().toLowerCase();
        $('.error').html('');

        if(site_name == ''){
            $(".nameErr").addClass('error').html('Please enter your site name');
            $("#site_name").focus();
            return false;

        }else if(site_logo == ''){
            $(".logoErr").addClass('error').html('Please select site logo');
            $(".site_logo").focus();
            return false;

        }else if(site_logo != '' && $.inArray(img, ['gif','png','jpg','jpeg']) == -1){
            $(".logoErr").addClass('error').html("Please Select the Valid Image Type");
            $(".site_logo").focus();
            return false;

        }/*else if(site_favicon == ''){
            $(".faviconErr").addClass('error').html('Please select site favIcon');
            $(".site_favicon").focus();
            return false;

        }else if(site_favicon != '' && $.inArray(icon, ['ico']) == -1){
            $(".faviconErr").addClass('error').html("Please select Fav Icon as .ico Format");
            $(".site_favicon").focus();
            return false;

        }*/else if(site_currency == ''){
            $(".currencyErr").addClass('error').html('Please enter site currency');
            $("#site_currency").focus();
            return false;

        }else if(drop_timing == ''){
            $(".dropErr").addClass('error').html('Please select drop timing');
            $(".drop_timing").focus();
            return false;

        }else if(admin_name == ''){
            $(".admNameErr").addClass('error').html('Please enter admin name');
            $("#admin_name").focus();
            return false;

        }else if(admin_email == ''){
            $(".admEmailErr").addClass('error').html('Please enter admin email');
            $("#admin_email").focus();
            return false;

        }else if(admin_email != '' && !isValidEmailAddress(admin_email)) {
              $(".admEmailErr").addClass('error').html('Please enter valid email address');
              $("#admin_email").focus();
              return false;

        }else if(order_email == ''){
            $(".orderEmailErr").addClass('error').html('Please enter order email');
            $("#order_email").focus();
            return false;

        }else if(order_email != '' && !isValidEmailAddress(order_email)) {
            $(".orderEmailErr").addClass('error').html('Please enter valid email address');
            $("#order_email").focus();
            return false;
        }else if(contactus_email == ''){
            $(".contactusErr").addClass('error').html('Please enter contactus email');
            $("#contactus_email").focus();
            return false;

        }else if(contactus_email != '' && !isValidEmailAddress(contactus_email)) {
            $(".contactusErr").addClass('error').html('Please enter valid email address');
            $("#contactus_email").focus();
            return false;
        }else if(site_phonenumber == ''){
            $(".phonenumberErr").addClass('error').html('Please enter site phonenumber');
            $("#site_phonenumber").focus();
            return false;

        }else if(site_address == ''){
            $(".addressErr").addClass('error').html('Please enter site address');
            $("#site_address").focus();
            return false;

        }else if(site_city == ''){
            $(".cityErr").addClass('error').html('Please enter site city');
            $("#site_city").focus();
            return false;

        }else if(site_zipcode == ''){
            $(".zipcodeErr").addClass('error').html('Please enter site zipcode');
            $("#site_zipcode").focus();
            return false;

        }else if(site_state == ''){
            $(".stateErr").addClass('error').html('Please enter site state');
            $("#site_state").focus();
            return false;

        }else if(site_country == ''){
            $(".countryErr").addClass('error').html('Please enter site country');
            $("#site_country").focus();
            return false;

        }else if(timezone == ''){
            $(".timezoneErr").addClass('error').html('Please enter timezone');
            $("#timezone").focus();
            return false;

        }else if(payment_mode == ''){
            $(".paymentErr").addClass('error').html('Please select payment mode');
            $(".payment_mode").focus();
            return false;

        }else if( payment_mode == 'Demo' && paypal_demo_url == ''){
            $(".demo_urlErr").addClass('error').html('Please enter paypal demo url');
            $("#paypal_demo_url").focus();
            return false;

        } else if(payment_mode == 'Demo' && paypal_demo_business == ''){
            $(".demo_businessErr").addClass('error').html('Please enter paypal demo business');
            $("#paypal_demo_business").focus();
            return false;

        } else if(payment_mode == 'Live' && paypal_live_url == ''){
            $(".live_urlErr").addClass('error').html('Please enter paypal live url');
            $("#paypal_live_url").focus();
            return false;

        }else if(payment_mode == 'Live' && paypal_live_business == ''){
            $(".live_businessErr").addClass('error').html('Please enter paypal live business');
            $("#paypal_live_business").focus();
            return false;

        }else if(twilio_token_id == ''){
            $(".token_idErr").addClass('error').html('Please enter twilio token id');
            $("#twilio_token_id").focus();
            return false;

        } else if(twilio_secret_key == ''){
            $(".secret_keyErr").addClass('error').html('Please enter twilio secret key');
            $("#twilio_secret_key").focus();
            return false;

        } else if(twilio_from_no == ''){
            $(".from_noErr").addClass('error').html('Please enter twilio from number');
            $("#twilio_from_no").focus();
            return false;
        }else{
            $("#settingFrom").submit();
        }
    }
</script>