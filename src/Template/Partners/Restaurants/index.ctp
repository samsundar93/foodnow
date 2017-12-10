<section class="col-xs-12 col-sm-9">
    <div class="buyer-title">Restaurant Details</div>
    <div class="products-section no-padding-top">
        <div class="clearfix">
            <div class="checkout-wrapper buyer-checkout-wrapper no-margin-bottom">
                <?php echo $this->Form->create('restaurantForm',array('name'=>'restaurantForm',
                    'id'=>'restaurantForm',
                    'class'=>'form-horizontal',
                    'enctype' => 'multipart/form-data'
                ));
                ?>
                <div class="checkout-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#section-linebox-1" data-toggle="tab" class="sticon ti-home"><span>Contact Info</span></a></li>
                        <li><a href="#section-linebox-2" data-toggle="tab" class="sticon ti-gift"><span>Restaurant Info</span></a></li>
                        <li><a onclick="return getMap()" href="#section-linebox-3" data-toggle="tab" class="sticon ti-trash"><span>Delivery Info</span></a></li>
                        <li><a href="#section-linebox-4" data-toggle="tab" class="sticon ti-trash"><span>Commission Management</span></a></li>
                        <li><a href="#section-linebox-5" data-toggle="tab" class="sticon ti-trash"><span>Invoice Period</span></a></li>
                        <li><a href="#section-linebox-6" data-toggle="tab" class="sticon ti-trash"><span>Meta Tag</span></a></li>
                    </ul>
                    <div class="tab-content tab-top">
                        <div id="section-linebox-1" class="tab-pane fade in active">
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="form-group clearfix">
                                    <div class="col-sm-4">
                                        <label for="name">Contact Name<span class="help">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <?= $this->Form->input('contact_name',[
                                            'type' => 'text',
                                            'id'   => 'contact_name',
                                            'class' => 'form-control my-form-control',
                                            'value' => $restaurantDetails['contact_name'],
                                            'label' => false
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-sm-4">
                                        <label for="name">Contact Phone<span class="help">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <?= $this->Form->input('contact_phone',[
                                            'type' => 'text',
                                            'id'   => 'contact_phone',
                                            'class' => 'form-control my-form-control',
                                            'value' => $restaurantDetails['contact_phone'],
                                            'label' => false
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-sm-4">
                                        <label for="name">Contact Email<span class="help">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <?= $this->Form->input('contact_email',[
                                            'type' => 'text',
                                            'id'   => 'contact_email',
                                            'class' => 'form-control my-form-control',
                                            'value' => $restaurantDetails['contact_email'],
                                            'label' => false
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-sm-4">
                                        <label for="name">Address<span class="help">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <?= $this->Form->input('contact_address',[
                                            'type' => 'text',
                                            'id'   => 'contact_address',
                                            'class' => 'form-control my-form-control',
                                            'value' => $restaurantDetails['contact_address'],
                                            'label' => false
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="section-linebox-2" class="tab-pane fade in">
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="form-group clearfix">
                                    <div class="col-sm-4">
                                        <label for="name">Restaurant Name<span class="help">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <?= $this->Form->input('restaurant_name',[
                                            'type' => 'text',
                                            'id'   => 'restaurant_name',
                                            'class' => 'form-control my-form-control',
                                            'value' => $restaurantDetails['restaurant_name'],
                                            'label' => false
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-sm-4">
                                        <label for="name">Restaurant Phone<span class="help">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <?= $this->Form->input('restaurant_phone',[
                                            'type' => 'text',
                                            'id'   => 'restaurant_phone',
                                            'class' => 'form-control my-form-control',
                                            'value' => $restaurantDetails['restaurant_phone'],
                                            'label' => false
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="image-upload">
                                    <div class="form-group clearfix">
                                        <div class="col-sm-4">
                                            <label for="name">Restaurant Logo<span class="help">*</span></label>
                                        </div>
                                        <div class="col-sm-5">
                                            <label class="labelfile" for="restaurantlogo">Choose a Image</label>
                                            <?php echo $this->Form->input('restaurantlogo', [
                                                'type' => 'file',
                                                'class' => 'form-control my-form-control hidden product_image',
                                                'id' => 'restaurantlogo',
                                                'label' => false
                                            ]);
                                            ?>
                                            <input type="hidden" id="restaurantlogo" class="uploadProduct">
                                        </div>
                                        <div class="col-sm-3">
                                            <img src="<?php echo BASE_URL.'backend/images/restaurant/'.$restaurantDetails['restaurant_logo'] ?>" alt="No image" class="img-responsive img-rounded" width="50"/>
                                        </div>
                                    </div>
                                </div>
                                <label class="m-b-10 m-t-10">Available Day & Time</label>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped available-time-table">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Day</th>
                                            <th class="text-center">First Open</th>
                                            <th class="text-center">First Close</th>
                                            <th class="text-center">Second Open</th>
                                            <th class="text-center">Second Close</th>
                                            <th class="text-center">Close</th>
                                        </tr>
                                        <tr class="text-center tr-div">
                                            <td class="close-div"><span>Sunday</span></td>
                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('sunday_firstopen_time',[
                                                        'type' => 'select',
                                                        'id'   => 'sunday_firstopen_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['sunday_firstopen_time'])) ? $restaurantDetails['sunday_firstopen_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>
                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('sunday_firstclose_time',[
                                                        'type' => 'select',
                                                        'id'   => 'sunday_firstclose_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['sunday_firstclose_time'])) ? $restaurantDetails['sunday_firstclose_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>

                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('sunday_secondopen_time',[
                                                        'type' => 'select',
                                                        'id'   => 'sunday_secondopen_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['sunday_secondopen_time'])) ? $restaurantDetails['sunday_secondopen_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>

                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('sunday_secondclose_time',[
                                                        'type' => 'select',
                                                        'id'   => 'sunday_secondclose_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['sunday_secondclose_time'])) ? $restaurantDetails['sunday_secondclose_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>
                                            <td class="close-check">
                                                <input type="checkbox" name="sunday_status" value="Closed" id="sunday"
                                                    <?php echo ($restaurantDetails['sunday_status'] == 'Closed') ? 'checked' : '' ?> >
                                                <label for="sunday">&nbsp;</label>
                                            </td>
                                        </tr>
                                        <tr class="text-center tr-div">
                                            <td class="close-div"><span>Monday</span></td>
                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('monday_firstopen_time',[
                                                        'type' => 'select',
                                                        'id'   => 'monday_firstopen_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['monday_firstopen_time'])) ? $restaurantDetails['monday_firstopen_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>
                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('monday_firstclose_time',[
                                                        'type' => 'select',
                                                        'id'   => 'monday_firstclose_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['monday_firstclose_time'])) ? $restaurantDetails['monday_firstclose_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>

                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('monday_secondopen_time',[
                                                        'type' => 'select',
                                                        'id'   => 'monday_secondopen_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['monday_secondopen_time'])) ? $restaurantDetails['monday_secondopen_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>

                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('monday_secondclose_time',[
                                                        'type' => 'select',
                                                        'id'   => 'monday_secondclose_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['monday_secondclose_time'])) ? $restaurantDetails['monday_secondclose_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>
                                            <td class="close-check">
                                                <input type="checkbox" name="monday_status" value="Closed"  id="monday" <?php echo ($restaurantDetails['monday_status'] == 'Closed') ? 'checked' : '' ?> >
                                                <label for="monday">&nbsp;</label>
                                            </td>
                                        </tr>
                                        <tr class="text-center tr-div">
                                            <td class="close-div"><span>Tuesday</span></td>
                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('tuesday_firstopen_time',[
                                                        'type' => 'select',
                                                        'id'   => 'tuesday_firstopen_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['tuesday_firstopen_time'])) ? $restaurantDetails['tuesday_firstopen_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>
                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('tuesday_firstclose_time',[
                                                        'type' => 'select',
                                                        'id'   => 'tuesday_firstclose_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['tuesday_firstclose_time'])) ? $restaurantDetails['tuesday_firstclose_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>

                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('tuesday_secondopen_time',[
                                                        'type' => 'select',
                                                        'id'   => 'tuesday_secondopen_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['tuesday_secondopen_time'])) ? $restaurantDetails['tuesday_secondopen_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>

                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('tuesday_secondclose_time',[
                                                        'type' => 'select',
                                                        'id'   => 'tuesday_secondclose_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['tuesday_secondclose_time'])) ? $restaurantDetails['tuesday_secondclose_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>
                                            <td class="close-check">
                                                <input type="checkbox" name="tuesday_status" value="Closed"  id="tuesday" <?php echo ($restaurantDetails['tuesday_status'] == 'Closed') ? 'checked' : '' ?> >
                                                <label for="tuesday">&nbsp;</label>
                                            </td>
                                        </tr>
                                        <tr class="text-center tr-div">
                                            <td class="close-div"><span>Wednesday</span></td>
                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('wednesday_firstopen_time',[
                                                        'type' => 'select',
                                                        'id'   => 'wednesday_firstopen_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['wednesday_firstopen_time'])) ? $restaurantDetails['wednesday_firstopen_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>
                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('wednesday_firstclose_time',[
                                                        'type' => 'select',
                                                        'id'   => 'wednesday_firstclose_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['wednesday_firstclose_time'])) ? $restaurantDetails['wednesday_firstclose_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>

                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('wednesday_secondopen_time',[
                                                        'type' => 'select',
                                                        'id'   => 'wednesday_secondopen_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['wednesday_secondopen_time'])) ? $restaurantDetails['wednesday_secondopen_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>

                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('wednesday_secondclose_time',[
                                                        'type' => 'select',
                                                        'id'   => 'wednesday_secondclose_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['wednesday_secondclose_time'])) ? $restaurantDetails['wednesday_secondclose_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>
                                            <td class="close-check">
                                                <input type="checkbox" name="wednesday_status" value="Closed"  id="wednesday" <?php echo ($restaurantDetails['wednesday_status'] == 'Closed') ? 'checked' : '' ?> >
                                                <label for="wednesday">&nbsp;</label>
                                            </td>
                                        </tr>
                                        <tr class="text-center tr-div">
                                            <td class="close-div"><span>Thursday</span></td>
                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('thursday_firstopen_time',[
                                                        'type' => 'select',
                                                        'id'   => 'thursday_firstopen_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['thursday_firstopen_time'])) ? $restaurantDetails['thursday_firstopen_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>
                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('thursday_firstclose_time',[
                                                        'type' => 'select',
                                                        'id'   => 'thursday_firstclose_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['thursday_firstclose_time'])) ? $restaurantDetails['thursday_firstclose_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>

                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('thursday_secondopen_time',[
                                                        'type' => 'select',
                                                        'id'   => 'thursday_secondopen_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['thursday_secondopen_time'])) ? $restaurantDetails['thursday_secondopen_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>

                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('thursday_secondclose_time',[
                                                        'type' => 'select',
                                                        'id'   => 'thursday_secondclose_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['thursday_secondclose_time'])) ? $restaurantDetails['thursday_secondclose_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>
                                            <td class="close-check">
                                                <input type="checkbox" name="thursday_status" value="Closed"  id="thursday" <?php echo ($restaurantDetails['thursday_status'] == 'Closed') ? 'checked' : '' ?>>
                                                <label for="thursday">&nbsp;</label>
                                            </td>
                                        </tr>
                                        <tr class="text-center tr-div">
                                            <td class="close-div"><span>Friday</span></td>
                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('friday_firstopen_time',[
                                                        'type' => 'select',
                                                        'id'   => 'friday_firstopen_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['friday_firstopen_time'])) ? $restaurantDetails['friday_firstopen_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>
                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('friday_firstclose_time',[
                                                        'type' => 'select',
                                                        'id'   => 'friday_firstclose_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['friday_firstclose_time'])) ? $restaurantDetails['friday_firstclose_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>

                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('friday_secondopen_time',[
                                                        'type' => 'select',
                                                        'id'   => 'friday_secondopen_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['friday_secondopen_time'])) ? $restaurantDetails['friday_secondopen_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>

                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('friday_secondclose_time',[
                                                        'type' => 'select',
                                                        'id'   => 'friday_secondclose_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['friday_secondclose_time'])) ? $restaurantDetails['friday_secondclose_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>
                                            <td class="close-check">
                                                <input type="checkbox"  name="friday_status" value="Closed"  id="friday" <?php echo ($restaurantDetails['friday_status'] == 'Closed') ? 'checked' : '' ?> >
                                                <label for="friday">&nbsp;</label>
                                            </td>
                                        </tr>
                                        <tr class="text-center tr-div">
                                            <td class="close-div"><span>Saturday</span></td>
                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('saturday_firstopen_time',[
                                                        'type' => 'select',
                                                        'id'   => 'saturday_firstopen_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['saturday_firstopen_time'])) ? $restaurantDetails['saturday_firstopen_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>
                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('saturday_firstclose_time',[
                                                        'type' => 'select',
                                                        'id'   => 'saturday_firstclose_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['saturday_firstclose_time'])) ? $restaurantDetails['saturday_firstclose_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>
                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('saturday_secondopen_time',[
                                                        'type' => 'select',
                                                        'id'   => 'saturday_secondopen_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['saturday_secondopen_time'])) ? $restaurantDetails['saturday_secondopen_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>
                                            <td class="close-div">
                                                <div class="input select">
                                                    <?= $this->Form->input('saturday_secondclose_time',[
                                                        'type' => 'select',
                                                        'id'   => 'saturday_secondclose_time',
                                                        'class' => 'form-control',
                                                        'options' => $timelist,
                                                        'value' => (isset($restaurantDetails['saturday_secondclose_time'])) ? $restaurantDetails['saturday_secondclose_time'] : '',
                                                        'empty' =>'Please Choose Time',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </td>
                                            <td class="close-check">
                                                <input type="checkbox" name="saturday_status" value="Closed"  id="saturday" <?php echo ($restaurantDetails['saturday_status'] == 'Closed') ? 'checked' : '' ?> >
                                                <label for="saturday">&nbsp;</label>
                                            </td>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="form-group clearfix">

                                    <div class="col-sm-4">
                                        <label for="name">Pickup<span class="help">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="col-sm-6 no-padding">
                                            <input id="products-price-option-single" type="radio" value="Yes" name="restaurant_pickup" checked>
                                            <label for="products-price-option-single"> Yes</label>
                                        </div>
                                        <div class="col-sm-6 no-padding">
                                            <input id="products-price-option-multiple" type="radio" value="No" name="restaurant_pickup">
                                            <label for="products-price-option-multiple"> No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-sm-4">
                                        <label for="name">Delivery<span class="help">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="col-sm-6 no-padding">
                                            <input id="restaurant_delivery_yes" type="radio" value="Yes" name="restaurant_delivery" checked>
                                            <label for="restaurant_delivery_yes"> Yes</label>
                                        </div>
                                        <div class="col-sm-6 no-padding">
                                            <input id="restaurant_delivery_no" type="radio" value="No" name="restaurant_delivery">
                                            <label for="restaurant_delivery_no"> No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-sm-4">
                                        <label for="name">Book a Table<span class="help">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="col-sm-6 no-padding">
                                            <input id="restaurant_table_yes" type="radio" value="Yes" name="restaurant_table" checked>
                                            <label for="restaurant_table_yes"> Yes</label>
                                        </div>
                                        <div class="col-sm-6 no-padding">
                                            <input id="restaurant_table_no" type="radio" value="No" name="restaurant_table">
                                            <label for="restaurant_table_no"> No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-sm-4">
                                        <label for="name">About Restaurant<span class="help">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="col-sm-12 no-padding">
                                            <div class="input select">
                                                <?= $this->Form->input('restaurant_about',[
                                                    'type' => 'textarea',
                                                    'id'   => 'restaurant_about',
                                                    'class' => 'form-control',
                                                    'value' => $restaurantDetails['restaurant_about'],
                                                    'label' => false
                                                ]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-sm-4">
                                        <label for="name">Tax<span class="help">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="col-sm-12 no-padding">
                                            <div class="input select">
                                                <?= $this->Form->input('restaurant_tax',[
                                                    'type' => 'text',
                                                    'id'   => 'restaurant_tax',
                                                    'class' => 'form-control',
                                                    'value' => (isset($restaurantDetails['restaurant_tax'])) ? $restaurantDetails['restaurant_tax'] : '',
                                                    'label' => false
                                                ]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="name">Cuisine<span class="help">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="col-sm-12 no-padding">
                                            <div class="input select">
                                                <?= $this->Form->input('restaurant_cuisine',[
                                                    'type' => 'select',
                                                    'multiple' => 'multiple',
                                                    'id'   => 'restaurant_cuisine',
                                                    'class' => 'form-control',
                                                    'options' => $cuisinesList,
                                                    'value' => (!empty($selectedCuisines)) ? array_values($selectedCuisines) : '',
                                                    'label' => false
                                                ]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div id="section-linebox-3" class="tab-pane fade">

                            <div class="col-sm-8 col-sm-offset-2 clearfix">
                                <div class="quick-desc ">
                                    <div class="form-group clearfix">
                                        <div class="col-sm-4">
                                            <label for="name">Delivery Estimation Time<span class="help">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="col-sm-12 no-padding">
                                                <div class="input select">
                                                    <?= $this->Form->input('estimate_time',[
                                                        'type' => 'text',
                                                        'id'   => 'estimate_time',
                                                        'class' => 'form-control',
                                                        'value' => (isset($restaurantDetails['estimate_time'])) ? $restaurantDetails['estimate_time'] : '',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="col-sm-4">
                                            <label for="name">Minimum Order<span class="help">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="col-sm-12 no-padding">
                                                <div class="input select">
                                                    <?= $this->Form->input('minimum_order',[
                                                        'type' => 'text',
                                                        'id'   => 'minimum_order',
                                                        'class' => 'form-control',
                                                        'value' => (isset($restaurantDetails['minimum_order'])) ? $restaurantDetails['minimum_order'] : '',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="col-sm-4">
                                            <label for="name">Delivery charge<span class="help">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="col-sm-12 no-padding">
                                                <div class="input select">
                                                    <?= $this->Form->input('delivery_charge',[
                                                        'type' => 'text',
                                                        'id'   => 'delivery_charge',
                                                        'class' => 'form-control',
                                                        'value' => (isset($restaurantDetails['delivery_charge'])) ? $restaurantDetails['delivery_charge'] : '',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="col-sm-4">
                                            <label for="name">Delivery Distance<span class="help">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="col-sm-9 no-padding">
                                                <div class="input select">
                                                    <?= $this->Form->input('delivery_distance',[
                                                        'type' => 'text',
                                                        'id'   => 'delivery_distance',
                                                        'class' => 'form-control',
                                                        'value' => (isset($restaurantDetails['delivery_distance'])) ? $restaurantDetails['delivery_distance'] : '',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 no-padding">
                                                <input onclick="return getMap();" type="button" class="btn btn-cancel" value="View Map">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="col-sm-12">
                                            <div id="mapShow"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="section-linebox-4" class="tab-pane fade">

                            <div class="col-sm-8 col-sm-offset-2 clearfix">
                                <div class="quick-desc ">
                                    <div class="form-group clearfix">
                                        <div class="col-sm-4">
                                            <label for="name">Commission (%)<span class="help">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="col-sm-12 no-padding">
                                                <div class="input select">
                                                    <?= $this->Form->input('restaurant_commission',[
                                                        'type' => 'text',
                                                        'id'   => 'restaurant_commission',
                                                        'class' => 'form-control',
                                                        'value' => (isset($restaurantDetails['restaurant_commission'])) ? $restaurantDetails['restaurant_commission'] : '',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="section-linebox-5" class="tab-pane fade">

                            <div class="col-sm-8 col-sm-offset-2 clearfix">
                                <div class="quick-desc ">
                                    <div class="form-group clearfix">
                                        <div class="col-sm-4">
                                            <label for="name">Invoice Period<span class="help">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="col-sm-12 no-padding">
                                                <div class="input select">
                                                    <select class="form-control" name="invoice_period">
                                                        <option selected="<?php echo ($restaurantDetails['invoice_period'] == '15') ? 'selected' : '' ?>">15 days</option>
                                                        <option selected="<?php echo ($restaurantDetails['invoice_period'] == '30') ? 'selected' : '' ?>">30 days</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="section-linebox-6" class="tab-pane fade">

                            <div class="col-sm-8 col-sm-offset-2 clearfix">
                                <div class="quick-desc ">
                                    <div class="form-group clearfix">
                                        <div class="col-sm-4">
                                            <label for="name">Meta Titles<span class="help">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="col-sm-12 no-padding">
                                                <div class="input select">
                                                    <?= $this->Form->input('restaurant_metatitle',[
                                                        'type' => 'textarea',
                                                        'id'   => 'restaurant_metatitle',
                                                        'class' => 'form-control',
                                                        'value' => (isset($restaurantDetails['restaurant_metatitle'])) ? $restaurantDetails['restaurant_metatitle'] : '',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="col-sm-4">
                                            <label for="name">Meta Keywords<span class="help">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="col-sm-12 no-padding">
                                                <div class="input select">
                                                    <?= $this->Form->input('restaurant_metakeyword',[
                                                        'type' => 'textarea',
                                                        'id'   => 'restaurant_metakeyword',
                                                        'class' => 'form-control',
                                                        'value' => (isset($restaurantDetails['restaurant_metakeyword'])) ? $restaurantDetails['restaurant_metakeyword'] : '',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="col-sm-4">
                                            <label for="name">Meta Descriptions<span class="help">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="col-sm-12 no-padding">
                                                <div class="input select">
                                                    <?= $this->Form->input('restaurant_metadescription',[
                                                        'type' => 'textarea',
                                                        'id'   => 'restaurant_metadescription',
                                                        'class' => 'form-control',
                                                        'value' => (isset($restaurantDetails['restaurant_metadescription'])) ? $restaurantDetails['restaurant_metadescription'] : '',
                                                        'label' => false
                                                    ]) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 text-center">
                            <button onclick="return restaurantEdit();" class="btn-submit" type="button">Submit</button>
                            <a class="btn btn-cancel" href="<?php echo BASE_URL ?>seller/products"> Cancel</a>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end();?>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        $('.available-time-table tr .close-check input[type="checkbox"]').change(function(){
            if($(this).is(":checked") == true) {
                $(this).closest('.tr-div').find('.close-div').addClass('disabled');
                $(this).closest('.tr-div').find('select').attr('disabled',true);
            }
            else {
                $(this).closest('.tr-div').find('.close-div').removeClass('disabled');
                $(this).closest('.tr-div').find('select').attr('disabled',false);
            }
        });
        $('.available-time-table tr .close-check input[type="checkbox"]').each(function(){
            if($(this).is(":checked") == true) {
                $(this).closest('.tr-div').find('.close-div').addClass('disabled');
                $(this).closest('.tr-div').find('select').attr('disabled',true);
            }
            else {
                $(this).closest('.tr-div').find('.close-div').removeClass('disabled');
                $(this).closest('.tr-div').find('select').attr('disabled',false);
            }
        });
    })

    initialize1('contact_address');



    // Get Map
    function getMap()
    {
        var restaurantId = $("#restaurantId").val();
        if(restaurantId == '') {
            var service_area    = $("#contact_address").val();
        }else {
            var service_area    = $("#contact_address").val();
            var service_miles    = $("#delivery_distance").val();
        }
        var Url             = jsSitePartner+"restaurants/ajaxaction";

        $(".priceErr").html("");
        if(service_area != ''){
            $.post(
                Url,
                {service_area:service_area, service_miles:service_miles,action:'getMap'},
                function(data) {
                    //clearConsole();

                    var resultCircle = $.trim(data).split('**********');
                    $('#mapShow').html(resultCircle[0]);
                    $('#mapShow').append(resultCircle[1]);
                    return false;
                }
            );
        }
    }

    var placeSearch, autocomplete,autocomplete1;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initialize1(id) {
        // Create the autocomplete object, restricting the search
        autocomplete1 = new google.maps.places.Autocomplete(
            /** @type {HTMLInputElement} */ (document.getElementById(id)),
            { types: ['geocode'],componentRestrictions: {country: "IN"} });
        google.maps.event.addListener(autocomplete1, 'place_changed', function() {
            fillInAddress1();
        });
    }
    // The START and END in square brackets define a snippet for our documentation:
    // [START region_fillform]
    function fillInAddress1() {
        // Get the place details from the autocomplete object.
        var place = autocomplete1.getPlace();


        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                //document.getElementById(addressType).value = val;
            }
        }
    }

    // [START region_geolocation]
    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = new google.maps.LatLng(
                    position.coords.latitude, position.coords.longitude);
                autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
                    geolocation));
            });
        }
    }

</script>