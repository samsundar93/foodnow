<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Settings</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo ADMIN_BASE_URL ?>">Dashboard</a></li>
                    <li class="active">SMS Settings</li>
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
                            <a href="#SMSTab">
                                <span class="text-left admin_user_head">SMS Settings</span>
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
                                            <?= $this->Form->create('smsSetting',[
                                                'id' => 'smsFrom'
                                            ])?>
                                            <div class="sttabs tabs-style-shape">
                                                <nav>
                                                    <ul>
                                                        <li>
                                                        </li>
                                                    </ul>
                                                </nav>
                                                <div class="content-wrap">
                                                    <!--Site SMS Setting-->
                                                    <div id="SMSTab" class="content-current">
                                                        <div class="form-body">
                                                            <div class="form-group clearfix">
                                                                <label class="control-label col-md-3">SMS Method<span class="red">*</span></label>
                                                                <div class="col-md-4 options-radio">
                                                                    <?=
                                                                    $this->Form->radio(
                                                                        'sms_mode',
                                                                        [

                                                                            ['value' => 'OFF', 'text' => 'OFF', 'checked' => ($site_data['sms_mode'] == 'OFF') ? 'checked' : ''],

                                                                            ['value' => 'ON', 'text' => 'ON', 'checked' => ($site_data['sms_mode'] == 'ON') ? 'checked' : '' ]

                                                                        ]
                                                                    );
                                                                    ?>
                                                                    <span class="smsErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div id="sms_div" style="<?php echo ($site_data['sms_mode'] == 'OFF') ? 'display:none' : '' ?>">
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
                                                    </div>
                                                        <div class="clearfix">
                                                            <div class="col-md-3"></div>
                                                            <div class="col-md-4">
                                                                <button class="btn btn-success" type="button" onclick="smsValidate();">
                                                                <i class="fa fa-check check-btn"></i>
                                                                Submit
                                                                </button>
                                                            </div>
                                                        </div>
                                                </div>
                                                <!-- /tabs -->
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
    //Validate SMS Setting//
    function smsValidate(){

        var sms_mode             = $.trim($("input[name='sms_mode']:checked").val());
        var twilio_token_id      = $.trim($("#twilio_token_id").val());
        var twilio_secret_key    = $.trim($("#twilio_secret_key").val());
        var twilio_from_no       = $.trim($("#twilio_from_no").val());
        $('.error').html('');

        if(sms_mode == '') {
            $(".smsErr").addClass('error').html('Please select sms mode');
            $(".sms_mode").focus();
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
            $("#smsFrom").submit();
        }
    }
</script>