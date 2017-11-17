<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Settings</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo ADMIN_BASE_URL ?>">Dashboard</a></li>
                    <li class="active">Banner Settings</li>
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
                        <?= $this->Form->create('bannerSettings',[
                            'id' => 'bannerSettings',
                            'enctype'  =>'multipart/form-data'
                        ])?>
                            <div class="col-xs-12">
                                <span class="pull-right">
                                    <?= $this->Flash->render() ?>
                                </span>
                            </div>
                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Banner 1</label>
                                    <div class="col-sm-4">
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                <span class="fileinput-filename site_logo"><?php   ?></span>
                                            </div>
                                            <span class="input-group-addon btn btn-default btn-file">
                                                    <span class="fileinput-new">Select file</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="banner1">
                                                </span>
                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove
                                            </a>

                                        </div>
                                        <span class="logoErr"></span>
                                    </div>
                                    <div class="col-sm-4">
                                        <img src="<?php echo $bannerData['banner1'] ?>" alt="No image" class="img-responsive img-rounded" width=""/>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Banner 2</label>
                                    <div class="col-sm-4">
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                <span class="fileinput-filename site_logo"><?php   ?></span>
                                            </div>
                                            <span class="input-group-addon btn btn-default btn-file">
                                                    <span class="fileinput-new">Select file</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="banner2">
                                                </span>
                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove
                                            </a>

                                        </div>
                                        <span class="logoErr"></span>
                                    </div>
                                    <div class="col-sm-4">
                                        <img src="<?php echo $bannerData['banner2'] ?>" alt="No image" class="img-responsive img-rounded" width=""/>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Banner 3</label>
                                    <div class="col-sm-4">
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                <span class="fileinput-filename site_logo"><?php   ?></span>
                                            </div>
                                            <span class="input-group-addon btn btn-default btn-file">
                                                    <span class="fileinput-new">Select file</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="banner3">
                                                </span>
                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove
                                            </a>

                                        </div>
                                        <span class="logoErr"></span>
                                    </div>
                                    <div class="col-sm-4">
                                        <img src="<?php echo $bannerData['banner3'] ?>" alt="No image" class="img-responsive img-rounded" width=""/>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Banner 4</label>
                                    <div class="col-sm-4">
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                <span class="fileinput-filename site_logo"><?php   ?></span>
                                            </div>
                                            <span class="input-group-addon btn btn-default btn-file">
                                                    <span class="fileinput-new">Select file</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="banner4">
                                                </span>
                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove
                                            </a>

                                        </div>
                                        <span class="logoErr"></span>
                                    </div>
                                    <div class="col-sm-4">
                                        <img src="<?php echo $bannerData['banner4'] ?>" alt="No image" class="img-responsive img-rounded" width=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="col-md-3"></div>
                                <div class="col-md-4 options-radio">
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa fa-check"></i>
                                        Submit
                                    </button>
                                </div>
                            </div>
                        <?=  $this->Form->end(); ?>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>