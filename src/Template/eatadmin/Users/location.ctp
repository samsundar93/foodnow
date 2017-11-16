<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Settings</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo ADMIN_BASE_URL ?>">Dashboard</a></li>
                    <li class="active">Location Settings</li>
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
                            <a href="locationTab">
                                <span class="text-left admin_user_head">Location Settings</span>
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
                                            <?= $this->Form->create('locationSetting',[
                                                'id' => 'locationFrom'
                                            ])?>
                                            <div class="sttabs tabs-style-shape">
                                                <nav>
                                                    <ul>
                                                        <li>
                                                        </li>
                                                    </ul>
                                                </nav>

                                                <div class="content-wrap">
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
                                                                        'value' => ($site_data['timezone'] ? $site_data['timezone']:  ''),
                                                                        'empty'  => 'Please Choose timezone',
                                                                        'class' => 'form-control',
                                                                        'label' => false
                                                                    ]) ?>
                                                                    <span class="timezoneErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix">
                                                            <div class="col-md-3"></div>
                                                            <div class="col-md-4">
                                                                 <button class="btn btn-success" type="button" onclick=   "locationValidate();">
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

    function locationValidate(){

        var site_address     = $.trim($("#site_address").val());
        var site_city        = $.trim($("#site_city").val());
        var site_zipcode     = $.trim($("#site_zipcode").val());
        var site_state       = $.trim($("#site_state").val());
        var site_country     = $.trim($("#site_country").val());
        var timezone         = $.trim($("#timezone").val());
        $('.error').html('');

        if(site_address == ''){
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

        }else{
            $("#locationFrom").submit();
        }
    }
</script>