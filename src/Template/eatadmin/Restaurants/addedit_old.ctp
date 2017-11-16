<script>
    $(function() {
        initialize1('contact_address');
    })
</script>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <?php echo $this->Form->create('mcat_addedit_form',array('name'=>'restaurant_addedit_form',
                        'id'=>'restaurant_addedit_form',
                        'enctype'=>'multipart/form-data',
                        'class'=>'form-horizontal'
                    ));
                    ?>
                        <div class="sttabs tabs-style-linebox setting-tab">
                            <nav>
                                <ul>
                                    <li id="contact"><a href="#section-linebox-1" class="sticon ti-home"><span>contact info</span></a></li>
                                    <li id="info"><a href="#section-linebox-2" class="sticon ti-gift"><span>restaurant info</span></a></li>
                                    <li id="delivery"><a onclick="return getMap()" href="#section-linebox-3" class="sticon ti-trash"><span>delivery info</span></a></li>

                                    <li id="commission"><a href="#section-linebox-6" class="sticon ti-gift"><span>commision management</span></a></li>
                                    <li><a href="#section-linebox-7" class="sticon ti-trash"><span>invoice period</span></a></li>
                                    <li><a href="#section-linebox-8" class="sticon ti-upload"><span>meta tags</span></a></li>
                                </ul>
                            </nav>
                            <input type="hidden" id="restaurantId" name="restaurantId" value="<?php echo ((!empty($restaurantList['id'])) ? $restaurantList['id'] : '') ?>" />
                            <div class="content-wrap content-wrapper-bg text-center">
                                <section id="section-linebox-1">
                                    <span id="contactErr" class="col-xs-12 btn-sm text-center"></span>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="name">Contact Name<span class="help">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="contact_name" name="contact_name" value="<?php echo $restaurantList['contact_name']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="name">Contact Phone<span class="help">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="contact_phone" name="contact_phone" maxlength="12" value="<?php echo $restaurantList['contact_phone']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" class="control-label" for="name">Contact Email<span class="help">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="contact_email" name="contact_email" value="<?php echo $restaurantList['contact_email']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="name">Address<span class="help">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="contact_address" name="contact_address" value="<?php echo $restaurantList['contact_address']; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section id="section-linebox-2">
                                    <span id="infoErr" class="col-xs-12 btn-sm text-center"></span>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="name">Restaurant Name<span class="help">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="restaurant_name" name="restaurant_name" value="<?php echo $restaurantList['restaurant_name']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="name">Restaurant Phone<span class="help">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="restaurant_phone" id="restaurant_phone" maxlength="12" value="<?php echo $restaurantList['restaurant_phone']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <label class="control-label col-md-4">Restaurant Logo</label>
                                                    <div class="col-sm-8">
                                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                            <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                                <span class="fileinput-filename site_logo"></span>
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
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-2">
                                                        <div class="">Restaurant Timings</div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="">First Open time and close time </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="">Second Open time and close time </div>
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-12 parent no-padding">
                                                        <div class="col-sm-11">
                                                            <div class="mask-div-parent">
                                                                <div class="mask-div-child"></div>
                                                                <div class="col-sm-2"><label>monday</label></div>
                                                                <div class="col-sm-4 col-sm-offset-1">
                                                                    <div class="col-sm-5">
                                                                        <select name="monday_firstopen_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['monday_firstopen_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <select name="monday_firstclose_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['monday_firstclose_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-sm-offset-1">
                                                                    <div class="col-sm-5">
                                                                        <select name="monday_secondopen_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['monday_secondopen_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <select name="monday_secondclose_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['monday_secondclose_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1 mask_checkbox">
                                                            <input type="checkbox" name="monday_status" value="Closed">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-12 parent no-padding">
                                                        <div class="col-sm-11">
                                                            <div class="mask-div-parent">
                                                                <div class="mask-div-child"></div>
                                                                <div class="col-sm-2"><label>Tuesday</label></div>
                                                                <div class="col-sm-4 col-sm-offset-1">
                                                                    <div class="col-sm-5">
                                                                        <select name="tuesday_firstopen_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['tuesday_firstopen_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <select name="tuesday_firstclose_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['tuesday_firstclose_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-sm-offset-1">
                                                                    <div class="col-sm-5">
                                                                        <select name="tuesday_secondopen_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['tuesday_secondopen_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <select name="tuesday_secondclose_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['tuesday_secondclose_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1 mask_checkbox">
                                                            <input type="checkbox" name="tuesday_status" value="Closed">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-12 parent no-padding">
                                                        <div class="col-sm-11">
                                                            <div class="mask-div-parent">
                                                                <div class="mask-div-child"></div>
                                                                <div class="col-sm-2"><label>Wednesday</label></div>
                                                                <div class="col-sm-4 col-sm-offset-1">
                                                                    <div class="col-sm-5">
                                                                        <select name="wednesday_firstopen_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['wednesday_firstopen_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <select name="wednesday_firstclose_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['wednesday_firstclose_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-sm-offset-1">
                                                                    <div class="col-sm-5">
                                                                        <select name="wednesday_secondopen_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['wednesday_secondopen_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <select name="wednesday_secondclose_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['wednesday_secondclose_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1 mask_checkbox">
                                                            <input type="checkbox" name="wednesday_status" value="Closed">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-12 parent no-padding">
                                                        <div class="col-sm-11">
                                                            <div class="mask-div-parent">
                                                                <div class="mask-div-child"></div>
                                                                <div class="col-sm-2"><label>Thursday</label></div>
                                                                <div class="col-sm-4 col-sm-offset-1">
                                                                    <div class="col-sm-5">
                                                                        <select name="thursday_firstopen_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['thursday_firstopen_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <select name="thursday_firstclose_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['thursday_firstclose_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-sm-offset-1">
                                                                    <div class="col-sm-5">
                                                                        <select name="thursday_secondopen_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['thursday_secondopen_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <select name="thursday_secondclose_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['thursday_secondclose_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1 mask_checkbox">
                                                            <input type="checkbox" name="thursday_status" value="Closed">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-12 parent no-padding">
                                                        <div class="col-sm-11">
                                                            <div class="mask-div-parent">
                                                                <div class="mask-div-child"></div>
                                                                <div class="col-sm-2"><label>Friday</label></div>
                                                                <div class="col-sm-4 col-sm-offset-1">
                                                                    <div class="col-sm-5">
                                                                        <select name="friday_firstopen_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['friday_firstopen_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <select name="friday_firstclose_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['friday_firstclose_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-sm-offset-1">
                                                                    <div class="col-sm-5">
                                                                        <select name="friday_secondopen_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['friday_secondopen_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <select name="friday_secondclose_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['friday_secondclose_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1 mask_checkbox">
                                                            <input type="checkbox" name="friday_status" value="Closed">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-12 parent no-padding">
                                                        <div class="col-sm-11">
                                                            <div class="mask-div-parent">
                                                                <div class="mask-div-child"></div>
                                                                <div class="col-sm-2"><label>Saturday</label></div>
                                                                <div class="col-sm-4 col-sm-offset-1">
                                                                    <div class="col-sm-5">
                                                                        <select name="saturday_firstopen_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['saturday_firstopen_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <select name="saturday_firstclose_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['saturday_firstclose_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-sm-offset-1">
                                                                    <div class="col-sm-5">
                                                                        <select name="saturday_secondopen_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['saturday_secondopen_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <select name="saturday_secondclose_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['saturday_secondclose_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1 mask_checkbox">
                                                            <input type="checkbox" name="saturday_status" value="Closed">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-12 parent no-padding">
                                                        <div class="col-sm-11">
                                                            <div class="mask-div-parent">
                                                                <div class="mask-div-child"></div>
                                                                <div class="col-sm-2"><label>Sunday</label></div>
                                                                <div class="col-sm-4 col-sm-offset-1">
                                                                    <div class="col-sm-5">
                                                                        <select name="sunday_firstopen_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['sunday_firstopen_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <select name="sunday_firstclose_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['sunday_firstclose_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4 col-sm-offset-1">
                                                                    <div class="col-sm-5">
                                                                        <select name="sunday_secondopen_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['sunday_secondopen_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <select name="sunday_secondclose_time" class="form-control">
                                                                            <?php foreach($timingAm as $key => $value) { ?>
                                                                                <option <?php echo ($restaurantList['sunday_secondclose_time'] == $value) ? 'checked' : ''; ?> value="<?php echo $value; ?>" >
                                                                                    <?php echo $value ?>
                                                                                </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1 mask_checkbox">
                                                            <input type="checkbox" id="sunday_status" value="Closed">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-sm-offset-2">

                                                <div class="form-group clearfix">
                                                    <div class="col-sm-4">
                                                        <label class="control-label">Pickup</label>
                                                    </div>
                                                    <div class="col-sm-8 text-left">
                                                        <input type="radio" <?php echo ($restaurantList['restaurant_pickup'] == 'Yes') ? 'checked' : ''; ?> value="Yes" id="pickup-radio-name1" name="restaurant_pickup">
                                                        <label for="pickup-radio-name1">Yes</label>
                                                        <input value="No" type="radio" id="pickup-radio-name2" name="restaurant_pickup" <?php echo ($restaurantList['restaurant_pickup'] == 'No') ? 'checked' : ''; ?>>
                                                        <label for="pickup-radio-name2">No</label>
                                                    </div>
                                                    <span id="pickupErr" class="col-xs-12 btn-sm text-center"></span>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-4">
                                                        <label class="control-label">Delivery</label>
                                                    </div>
                                                    <div class="col-sm-8 text-left">
                                                        <input value="Yes" type="radio" id="delivery-radio-name1" name="restaurant_delivery" <?php echo ($restaurantList['restaurant_delivery'] == 'Yes') ? 'checked' : ''; ?>>
                                                        <label for="delivery-radio-name1">Yes</label>
                                                        <input value="No" type="radio" id="delivery-radio-name2" name="restaurant_delivery" <?php echo ($restaurantList['restaurant_delivery'] == 'No') ? 'checked' : ''; ?>>
                                                        <label for="delivery-radio-name2">No</label>
                                                    </div>
                                                    <span id="deliverytErr" class="col-xs-12 btn-sm text-center"></span>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-4">
                                                        <label class="control-label">Book a Table</label>
                                                    </div>
                                                    <div class="col-sm-8 text-left">
                                                        <input value="Yes" <?php echo ($restaurantList['restaurant_table'] == 'Yes') ? 'checked' : ''; ?> type="radio" id="book-radio-name1" name="restaurant_table">
                                                        <label for="book-radio-name1">Yes</label>
                                                        <input <?php echo ($restaurantList['restaurant_table'] == 'No') ? 'checked' : ''; ?> value="No" type="radio" id="book-radio-name2" name="restaurant_table">
                                                        <label for="book-radio-name2">No</label>
                                                    </div>
                                                    <span id="tableErr" class="col-xs-12 btn-sm text-center"></span>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="name">About Restaurant</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <textarea class="form-control" rows='5' name="restaurant_about"><?php echo $restaurantList['restaurant_about'] ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="name">Tax<span class="help">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="restaurant_tax" value="<?php echo $restaurantList['restaurant_tax'] ?>" id="restaurant_tax">
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="name">Cuisine<span class="help">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <?= $this->Form->input('restaurant_cuisine',[
                                                            'type' => 'select',
                                                            'multiple' => 'multiple',
                                                            'id'   => 'restaurant_cuisine',
                                                            'class' => 'form-control',
                                                            'options' => $cuisinesList,
                                                            'label' => false,
                                                            'value'   => isset($selectedCuisine) ? $selectedCuisine :  '',
                                                        ]) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">

                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section id="section-linebox-3">
                                    <span id="deliveryErr" class="col-xs-12 btn-sm text-center"></span>
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <div class="form-group clearfix m-t-40">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="name">Delivery Estimation Time<span class="help">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="estimate_time" id="estimate_time" value="<?php echo $restaurantList['estimate_time']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="name">Minimum Order<span class="help">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="minimum_order" id="minimum_order" value="<?php echo $restaurantList['minimum_order']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <div class="col-sm-4">
                                                    <label class="control-label" class="control-label" for="name">Delivery charge<span class="help">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="delivery_charge" id="delivery_charge" value="<?php echo $restaurantList['delivery_charge']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="name">Delivery Distance <span class="help">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="delivery_distance" name="delivery_distance" value="<?php echo $restaurantList['delivery_distance']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <div class="col-sm-12">
                                                    <div id="mapShow"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </section>
                                <section id="section-linebox-6">
                                    <span id="commissionErr" class="col-xs-12 btn-sm text-center"></span>
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class="form-group clearfix">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="name">Restaurant Commission<span class="help">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="restaurant_commission" name="restaurant_commission" value="<?php echo $restaurantList['restaurant_commission']; ?>">
                                            </div>
                                        </div>

                                    </div>
                                </section>
                                <section id="section-linebox-7">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class="form-group clearfix">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="name">Invoice Period<span class="help">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="invoice_period">
                                                    <option selected="<?php echo ($restaurantList['invoice_period'] == '15') ? 'selected' : '' ?>">15 days</option>
                                                    <option selected="<?php echo ($restaurantList['invoice_period'] == '30') ? 'selected' : '' ?>">30 days</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </section>
                                <section id="section-linebox-8">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class="form-group clearfix">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="name">Meta Titles<span class="help">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <textarea class="form-control"  rows="5" name="restaurant_metatitle"><?php  echo $restaurantList['restaurant_metatitle'];?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="name">Meta Keywords<span class="help">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <textarea class="form-control"  rows="5" name="restaurant_metakeyword"><?php  echo $restaurantList['restaurant_metakeyword'];?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="name">Meta Descriptions<span class="help">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <textarea class="form-control"  rows="5" name="restaurant_metadescription"><?php  echo $restaurantList['restaurant_metadescription'];?></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </section>
                                <div class="text-center">
                                    <input onclick="return restaurantAdd();" class="btn btn-success waves-effect waves-light m-r-10" type="submit" value="Submit">
                                    <a class="btn btn-danger" href=""> Cancel</a>
                                </div>
                            </div>
                        </div>
                    <?php echo $this->Form->end();?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function restaurantAdd() {
        $(".error").html('');
        //$(".#contact").removeClass('error');
        //$(".#info").removeClass('error');
        var phone_pattern = /([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/;
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        var contact_name = $("#contact_name").val();
        var contact_phone = $("#contact_phone").val();
        var contact_email = $("#contact_email").val();
        var contact_address = $("#contact_address").val();
        var restaurant_name = $("#restaurant_name").val();
        var restaurant_phone = $("#restaurant_phone").val();
        var restaurant_tax = $("#restaurant_tax").val();
        //var restaurant_email = $("#restaurant_email").val();
        var estimate_time = $("#estimate_time").val();
        var minimum_order = $("#minimum_order").val();
        var delivery_charge = $("#delivery_charge").val();
        var delivery_distance = $("#delivery_distance").val();
        var restaurant_commission = $("#restaurant_commission").val();

        if(contact_name == '') {
            $("#contact").click();
            $("#contactErr").addClass('error').html('Please enter contact name');
            $("#contact_name").focus();
            return false;

        }else if(contact_phone == '') {
            $("#contact").click();
            $("#contactErr").addClass('error').html('Please enter contact phone');
            $("#contact_phone").focus();
            return false;

        }else if(!phone_pattern.test( contact_phone )) {
            $("#contact").click();
            $("#contactErr").addClass('error').html('Please enter valid phonenumber');
            $("#contact_phone").focus();
            return false;

        }else if(contact_email == '') {
            $("#contact").click();
            $("#contactErr").addClass('error').html('Please enter contact email');
            $("#contact_email").focus();
            return false;

        }else if(!regex.test(contact_email)) {
            $("#contact").click();
            $("#contactErr").addClass('error').html('Please enter valid email');
            $("#contact_email").focus();
            return false;

        }else if(contact_address == '') {
            $("#contact").click();
            $("#contactErr").addClass('error').html('Please enter contact address');
            $("#contact_address").focus();
            return false;

        }else if(restaurant_name == '') {
            $("#info").click();
            $("#infoErr").addClass('error').html('Please enter restaurant name');
            $("#restaurant_name").focus();
            return false;

        }else if(restaurant_phone == '') {
            $("#info").click();
            $("#infoErr").addClass('error').html('Please enter restaurant phone');
            $("#restaurant_phone").focus();
            return false;

        }else if(!phone_pattern.test( restaurant_phone )) {
            $("#info").click();
            $("#infoErr").addClass('error').html('Please enter valid phonenumber');
            $("#restaurant_phone").focus();
            return false;

        }else if(restaurant_tax == '') {
            $("#info").click();
            $("#infoErr").addClass('error').html('Please enter restaurant tax');
            $("#restaurant_tax").focus();
            return false;

        }/*else if(restaurant_email == '') {
            $("#info").click();
            $("#infoErr").addClass('error').html('Please enter restaurant email');
            $("#restaurant_email").focus();
            return false;
        }else if(!regex.test(restaurant_email)) {
            $("#info").click();
            $("#infoErr").addClass('error').html('Please enter valid email');
            $("#restaurant_email").focus();
            return false;

        }*/else if(estimate_time == '') {
            $("#delivery").click();
            $("#deliveryErr").addClass('error').html('Please enter estimated time');
            $("#estimate_time").focus();
            getMap();
            return false;

        }else if(minimum_order == '') {
            $("#delivery").click();
            $("#deliveryErr").addClass('error').html('Please enter minimum order amount');
            $("#minimum_order").focus();
            getMap();
            return false;

        }else if(delivery_charge == '') {
            $("#delivery").click();
            $("#deliveryErr").addClass('error').html('Please enter delivery charge');
            $("#delivery_charge").focus();
            getMap();
            return false;

        }else if(delivery_distance == '') {
            $("#delivery").click();
            $("#deliveryErr").addClass('error').html('Please enter delivery distance');
            $("#delivery_distance").focus();
            getMap();
            return false;

        }else if(restaurant_commission == '') {
            $("#commission").click();
            $("#commissionErr").addClass('error').html('Please enter commission');
            $("#restaurant_commission").focus();
            return false;
        }else {
            var Url             = baseUrl+"restaurants/checkEmail";
            var restaurantId = $("#restaurantId").val();
            $.post(
                Url,
                {contact_email:contact_email, id:restaurantId},
                function(data) {
                    if($.trim(data) == 'false') {
                        $("#contact").click();
                        $("#contactErr").addClass('error').html('Email already exists');
                        $("#contact_email").focus();
                        return false;
                    }else {
                        document.restaurant_addedit_form.submit();
                    }
                    return false;
                }

            );
            return false;
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
        var Url             = baseUrl+"restaurants/ajaxaction";

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
</script>