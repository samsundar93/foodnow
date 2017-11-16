<section class="col-xs-12 col-sm-9">
    <div class="buyer-title">Cuisine Edit</div>
    <div class="products-section no-padding-top">
        <div class="clearfix">
            <div class="checkout-wrapper buyer-checkout-wrapper no-margin-bottom">
                <div class="checkout-body">
                    <div class="checkout-body-title">
                        <span class="pull-left checkout-body-left">&nbsp;</span>
                    </div>
                    <?php echo $this->Form->create('categoryAdd',array('name'=>'categoryAdd',
                        'id'=>'cuisineEdit',
                        'class'=>'form-horizontal'
                    ));
                    ?>
                    <?= $this->Form->input('editId',[
                        'type' => 'hidden',
                        'id'   => 'editId',
                        'class' => 'form-control',
                        'value' => ($id) ? $id : '',
                        'label' => false
                    ]) ?>
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-group clearfix">
                            <div class="col-sm-4">
                                <label for="category_name">Cuisine Name<span class="help">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <?= $this->Form->input("cuisine_name",[
                                    "type" => "text",
                                    "class" => "form-control my-form-control",
                                    "id" => 'cuisine_name',
                                    "div" => false,
                                    'value' => ($cuisineList['cuisine_name']) ? $cuisineList['cuisine_name'] : '',
                                    "label" => false
                                ]);?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 text-center">
                        <button class="btn btn-submit" type="submit" onclick=" return cuisineAddEdit();">Submit</button>
                        <a class="btn btn-cancel" href="<?php echo PARTNER_BASE_URL ?>category"> Cancel</a>
                    </div>
                    <?= $this->Form->end();?>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<script type="text/javascript">

    function cuisineAddEdit(){
        var cuisine_name        = $.trim($("#cuisine_name").val()) ;
        var editedId         = $.trim($("#editedId").val()) ;
        $('.error').html('');

        if(cuisine_name == ''){
            $('#cuisine_name').after('<label class="error">Please enter the cuisine name</label>');
            $("#cuisine_name").focus();
            return false;

        }else{
            $.ajax({
                type   : 'POST',
                url    : jsSitePartner+'cuisines/checkCuisine',
                data   : {id:editedId, cuisine_name:cuisine_name},
                success: function(data){
                    if($.trim(data) == 'false') {
                        $('#cuisine_name').after('<label class="error">cuisine name already exists</label>');
                        $("#cuisine_name").focus();
                        return false;
                    }else {
                        $("#cuisineEdit").submit();
                    }

                }
            });return false;
            //
        }
    }

</script>