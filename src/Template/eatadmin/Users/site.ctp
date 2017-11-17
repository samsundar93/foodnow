<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Settings</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo ADMIN_BASE_URL ?>">Dashboard</a></li>
                    <li class="active">Site Settings</li>
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
                            <a href="#sitetab">
                                <span class="text-left admin_user_head">Site Settings</span>
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
                                            <?= $this->Form->create('siteSetting',[
                                                'id' => 'siteFrom',
                                                'enctype'  =>'multipart/form-data'
                                            ])?>
                                            <div class="sttabs tabs-style-shape">
                                                <nav>
                                                    <ul>
                                                        <li>

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
                                                                    <img src="<?php echo ADMIN_BASE_URL.'images/'.$site_data['site_logo'] ?>" alt="No image" class="img-responsive img-rounded" width="50"/>
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


                                                        <div class="clearfix">
                                                            <div class="col-md-3"></div>
                                                            <div class="col-md-4 options-radio">
                                                                <button class="btn btn-success" type="button" onclick="siteValidate();">
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

//Validate Email Address//
function isValidEmailAddress(emailAddress) {
var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
return pattern.test(emailAddress);
};

//Validate Site Setting//
function siteValidate(){

    var site_name        = $.trim($("#site_name").val()) ;
    var site_logo        = $.trim($(".site_logo").html()) ;
    var site_favicon     = $.trim($(".site_favicon").html());
    var site_currency    = $.trim($("#site_currency").val());


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

    }else if(site_favicon == ''){
        $(".faviconErr").addClass('error').html('Please select site favIcon');
        $(".site_favicon").focus();
        return false;

    }else if(site_favicon != '' && $.inArray(icon, ['ico']) == -1){
        $(".faviconErr").addClass('error').html("Please select Fav Icon as .ico Format");
        $(".site_favicon").focus();
        return false;

    }else if(site_currency == ''){
        $(".currencyErr").addClass('error').html('Please enter site currency');
        $("#site_currency").focus();
        return false;

    }else{
        $("#siteFrom").submit();
    }
}
</script>
