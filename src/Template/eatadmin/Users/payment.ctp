<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Settings</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo ADMIN_BASE_URL ?>">Dashboard</a></li>
                    <li class="active">Payment Settings</li>
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
                        <div class="col-xs-12">
                            <a href="#paymentTab">
                                <span class="text-left admin_user_head">Payment Settings</span>
                            </a>
                            <span class="pull-right">
                                <?= $this->Flash->render() ?>
                            </span>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-info">
                                    <div class="panel-wrapper collapse in" aria-expanded="true">
                                        <div class="panel-body">
                                            <?= $this->Form->create('paymentSetting',[
                                                'id' => 'paymentFrom'
                                            ])?>
                                            <div class="sttabs tabs-style-shape">
                                                <nav>
                                                    <ul>
                                                        <li>

                                                        </li>
                                                    </ul>
                                                </nav>

                                                <div class="content-wrap">
                                                    <!--Site Payment Details-->
                                                    <section id="paymentTab">
                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">Stripe Payment Mode<span class="red">*</span></label>
                                                                <div class="col-md-4 options-radio">
                                                                    <?=
                                                                    $this->Form->radio(
                                                                        'stripe_payment_mode',
                                                                        [

                                                                            ['value' => 'Test', 'text' => 'Test', 'checked' => ($site_data['stripe_payment_mode'] == 'Test') ? 'checked' : ''],

                                                                            ['value' => 'Live', 'text' => 'Live', 'checked' => ($site_data['stripe_payment_mode'] == 'Live') ? 'checked' : '' ]

                                                                        ]
                                                                    );
                                                                    ?>
                                                                    <span class="paymentErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="payTest" style="<?php echo ($site_data['stripe_payment_mode'] == 'Live') ? 'display:none' : '' ?>">
                                                            <div class="form-body">
                                                                <div class="form-group clearfix">
                                                                    <label class="control-label col-md-3">stripe apikey test<span class="red">*</span></label>
                                                                    <div class="col-md-4">
                                                                        <?= $this->Form->input('stripe_apikey_test',[
                                                                            'type' => 'text',
                                                                            'id'   => 'stripe_apikey_test',
                                                                            'class' => 'form-control',
                                                                            'label' => false
                                                                        ]) ?>
                                                                        <span class="stripe_testErr"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-body">
                                                                <div class="form-group clearfix">
                                                                    <label class="control-label col-md-3">publisher key test<span class="red">*</span></label>
                                                                    <div class="col-md-4">
                                                                        <?= $this->Form->input('publisher_key_test',[
                                                                            'type' => 'text',
                                                                            'id'   => 'publisher_key_test',
                                                                            'class' => 'form-control',
                                                                            'label' => false
                                                                        ]) ?>
                                                                        <span class="publisher_testErr"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="payLive" style="<?php echo ($site_data['stripe_payment_mode'] == 'Test') ? 'display:none' : '' ?>">
                                                            <div class="form-body">
                                                                <div class="form-group clearfix">
                                                                    <label class="control-label col-md-3">stripe apikey live<span class="red">*</span></label>
                                                                    <div class="col-md-4">
                                                                        <?= $this->Form->input('stripe_apikey_live',[
                                                                            'type' => 'text',
                                                                            'id'   => 'stripe_apikey_live',
                                                                            'class' => 'form-control',
                                                                            'label' => false
                                                                        ]) ?>
                                                                        <span class="stripe_liveErr"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-body">
                                                                <div class="form-group clearfix">
                                                                    <label class="control-label col-md-3">publisher key live<span class="red">*</span></label>
                                                                    <div class="col-md-4">
                                                                        <?= $this->Form->input('publisher_key_live',[
                                                                            'type' => 'text',
                                                                            'id'   => 'publisher_key_live',
                                                                            'class' => 'form-control',
                                                                            'label' => false
                                                                        ]) ?>
                                                                        <span class="publisher_liveErr"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="clearfix">
                                                            <div class="col-md-3"></div>
                                                            <div class="col-md-4">
                                                                <button class="btn btn-success" type="button" onclick="paymentValidate();">
                                                                    <i class="fa fa-check"></i>
                                                                    Submit
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </section>

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
    function paymentValidate(){

        var payment_mode      = $.trim($("input[name='stripe_payment_mode']:checked").val());
        var stripe_test       = $.trim($("#stripe_apikey_test").val());
        var publisher_test    = $.trim($("#publisher_key_test").val());
        var stripe_live       = $.trim($("#stripe_apikey_live").val());
        var publisher_live    = $.trim($("#publisher_key_live").val());

        $('.error').html('');

        if(payment_mode == ''){
            $(".payModeErr").addClass('error').html('Please select stripe payment mode');
            $(".stripe_payment_mode").focus();
            return false;

        }else if( payment_mode == 'Test' && stripe_test == ''){
            $(".stripe_testErr").addClass('error').html('Please enter stripe apikey test');
            $("#stripe_apikey_test").focus();
            return false;

        } else if(payment_mode == 'Test' && publisher_test == ''){
            $(".publisher_testErr").addClass('error').html('Please enter publisher key test');
            $("#publisher_key_test").focus();
            return false;

        } else if(payment_mode == 'Live' && stripe_live == ''){
            $(".stripe_liveErr").addClass('error').html('Please enter stripe apikey live');
            $("#stripe_apikey_live").focus();
            return false;

        }else if(payment_mode == 'Live' && publisher_live == ''){
            $(".publisher_liveErr").addClass('error').html('Please enter publisher key live');
            $("#publisher_key_live").focus();
            return false;

        }else{
            $("#paymentFrom").submit();
        }
    }
</script>