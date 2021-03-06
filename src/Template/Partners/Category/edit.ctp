<section class="col-xs-12 col-sm-9">
    <div class="buyer-title">Category Edit</div>
    <div class="products-section no-padding-top">
        <div class="clearfix">
            <div class="checkout-wrapper buyer-checkout-wrapper no-margin-bottom">
                <div class="checkout-body">
                    <div class="checkout-body-title">
                        <span class="pull-left checkout-body-left">&nbsp;</span>
                    </div>
                    <?php echo $this->Form->create('categoryAdd',array('name'=>'categoryAdd',
                        'id'=>'categoryEdit',
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
                                <label for="category_name">Category Name<span class="help">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <?= $this->Form->input("catname",[
                                    "type" => "text",
                                    "class" => "form-control my-form-control",
                                    "id" => 'category_name',
                                    "value" => ($categoryList['catname'] != '') ? $categoryList['catname'] : '',
                                    "div" => false,
                                    "label" => false
                                ]);?>
                            </div>
                            <span class="categoryNameErr"></span>
                        </div>
                    </div>
                    <div class="col-xs-12 text-center">
                        <button class="btn btn-submit" type="submit" onclick=" return categoryValidation();">Submit</button>
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

    function categoryValidation(){
        $(".error").html('');
        var editId = $("#editId").val();
        var categoryname = $.trim($("#category_name").val());
        if(categoryname == '') {
            $('#category_name').after('<label class="error">Please enter category name</label>');
            $("#category_name").focus();
            return false;
        }else {
            $.ajax({
                type   : 'POST',
                url    : jsSitePartner+'category/categoryCheck',
                data   : {id:editId, categoryname:categoryname},
                success: function(data){
                    if($.trim(data) == 0) {
                        $("#categoryEdit").submit();
                    }else {
                        $('#category_name').after('<label class="error">category name already exists</label>');
                        $("#category_name").focus();
                        return false;
                    }
                }
            });
            return false;

        }
    }

</script>