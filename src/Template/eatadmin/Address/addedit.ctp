<script>
    $(function() {
        initialize1('contact_address');
    })
</script>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">
                    <?php if(!empty($id)) {?> Edit <?php }else{?> Add <?php }?> Customer
                </h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo ADMIN_BASE_URL ?>">Dashboard</a></li>
                    <li><a href="<?php echo ADMIN_BASE_URL ?>address">Management</a></li>
                    <li class="active"><?php if(!empty($id)) {?> Edit <?php }else{?> Add <?php }?> Customer </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <?= $this->Flash->render() ?>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <?= $this->Form->create('addressFrom',[
                                'id' => 'addressFrom',
                                'enctype'  =>'multipart/form-data',
                                'data-toggle' => 'validator'
                            ])?>

                            <?= $this->Form->input('username',[
                                'type' => 'hidden',
                                'name' => 'editedId',
                                'id'   => 'editedId',
                                'value' => isset($id) ? $id : ''
                            ]) ?>
                            <span class="commonErr"></span>

                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Customer Name<span class="red">*</span></label>
                                    <div class="col-md-4">
                                        <?= $this->Form->input('customer_id',[
                                            'type' => 'select',
                                            'id'   => 'customer_id',
                                            'class' => 'form-control',
                                            'options' => $customerList,
                                            'label' => false,
                                            'value'   => isset($addressDetails['customer_id']) ? $addressDetails['customer_id'] :  '',
                                            'empty'   =>'Please Choose Customer'
                                        ]) ?>
                                        <span class="customerErr"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Title<span class="red">*</span></label>
                                    <div class="col-md-4">
                                        <?= $this->Form->input('title',[
                                            'type' => 'text',
                                            'id'   => 'title',
                                            'class' => 'form-control',
                                            'label' => false,
                                            'value'   => isset($addressDetails['title']) ? $addressDetails['title'] :  '',
                                        ]) ?>
                                        <span class="titleErr"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Address<span class="red">*</span></label>
                                    <div class="col-md-4">
                                        <?= $this->Form->input('address',[
                                            'type' => 'text',
                                            'id'   => 'contact_address',
                                            'class' => 'form-control',
                                            'value' => isset($addressDetails['address']) ? $addressDetails['address'] :  '',
                                            'label' => false
                                        ]) ?>
                                        <span class="addressErr"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">LandMark<span class="red">*</span></label>
                                    <div class="col-md-4">
                                        <?= $this->Form->input('landmark',[
                                            'type' => 'text',
                                            'id'   => 'landmark',
                                            'class' => 'form-control',
                                            'value' => isset($addressDetails['landmark']) ? $addressDetails['landmark'] :  '',
                                            'label' => false
                                        ]) ?>
                                        <span class="phoneErr"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button type="button" class="btn btn-info" onclick="addressAddEdit()">Submit</button>
                                    <a class="btn btn-danger" href="<?php echo ADMIN_BASE_URL?>address/"> Cancel</a>
                                </div>
                            </div>
                            <?=  $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>



<script type="text/javascript">
    function addressAddEdit(){
        $(".error").html('');

        var customer_id        = $.trim($("#customer_id").val()) ;
        var title        = $.trim($("#title").val()) ;
        var address        = $.trim($("#contact_address").val()) ;
        var editedId         = $.trim($("#editedId").val()) ;

        if(customer_id == ''){
            $(".customerErr").addClass('error').html('Please choose customer');
            $("#customer_id").focus();
            return false;

        }else if(title == ''){
            $(".titleErr").addClass('error').html('Please enter address title');
            $("#title").focus();
            return false;

        }else if(address == ''){
            $(".addressErr").addClass('error').html('Please enter your address');
            $("#address").focus();
            return false;

        }else{
            $.ajax({
                type   : 'POST',
                url    : baseUrl+'address/ajaxaction',
                data   : {id:editedId, title:title,customer_id:customer_id,action:'checktitle'},
                success: function(data){
                    if($.trim(data) != '1') {
                        $(".commonErr").addClass('error').html('This title already exists');
                        return false;
                    }else {
                        $("#addressFrom").submit();
                    }

                }
            });return false;

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