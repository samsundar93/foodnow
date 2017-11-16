<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Settings</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo ADMIN_BASE_URL ?>">Dashboard</a></li>
                    <li class="active">Contact Settings</li>
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
                            <a href="#contactTab">
                                <span class="text-left admin_user_head">Contact Settings</span>
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
                                            <?= $this->Form->create('contactSetting',[
                                                'id' => 'contactFrom'
                                            ])?>
                                            <div class="sttabs tabs-style-shape">
                                                <nav>
                                                    <ul>
                                                        <li>
                                                        </li>
                                                    </ul>
                                                </nav>

                                                <div class="content-wrap">
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
                                                                        'onkeypress' => "return isNumberKey(event)",
                                                                        'label' => false
                                                                    ]) ?>
                                                                    <span class="phonenumberErr"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix">
                                                            <div class="col-md-3"></div>
                                                            <div class="col-md-4">
                                                                 <button class="btn btn-success" type="button" onclick="contactValidate();">
                                                                    <i class="fa fa-check check-white"></i>
                                                                    Submit
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </section>

                                                </div><!-- /tabs -->
                                               
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
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }

    //Validate Email Address//
    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    };


    function contactValidate(){

        var admin_name       = $.trim($("#admin_name").val()) ;
        var admin_email      = $.trim($("#admin_email").val()) ;
        var order_email      = $.trim($("#order_email").val()) ;
        var contactus_email  = $.trim($("#contactus_email").val()) ;
        var site_phonenumber = $.trim($("#site_phonenumber").val()) ;
        $('.error').html('');

         if(admin_name == ''){
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

        }else{
            $("#contactFrom").submit();
        }
    }
</script>