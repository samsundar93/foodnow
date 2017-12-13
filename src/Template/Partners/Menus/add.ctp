<section class="col-xs-12 col-sm-9">
   <div class="buyer-title">Menu Add</div>
   <div class="products-section no-padding-top">
      <div class="clearfix">
         <div class="checkout-wrapper buyer-checkout-wrapper no-margin-bottom">
            <div class="checkout-body">
               <div class="checkout-body-title">
                  <span class="pull-left checkout-body-left">&nbsp;</span>
               </div>
               <?php echo $this->Form->create('menuAdd',array('name'=>'menuAdd',
                  'id'=>'menuAddForm',
                  'class'=>'form-horizontal'
                  ));
                  ?>

                   <div class="col-sm-6 col-sm-offset-3">
                        <label class="commonErr"></label>
                        <div class="form-group clearfix clearfix">
                            <div class="col-sm-4">
                            <label>Category Name <span class="star">*</span></label>
                            </div>
                            <div class="col-sm-8" id="categoryList">
                               <?= $this->Form->input('category_id',[
                                  'type' => 'select',
                                  'id'   => 'category_id',
                                  'class' => 'form-control',
                                  'options' => $categoryList,
                                  'label' => false,
                                  'empty'   =>'Please Choose Category'
                                  ]) ?>
                               <label class="categoryErr" id=""></label>

                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-sm-4">
                            <label>Menu Name <span class="star">*</span></label>
                            </div>
                            <div class="col-sm-8"><?php
                               echo $this->Form->input('Menu.menu_name',
                                   array('class' => 'form-control',
                                       'label' => false)); ?>
                                <label class="menunameErr" id=""></label>
                            </div>
                        </div>

                        <div class="form-group clearfix">

                            <div class="col-sm-4">
                                <label for="name">Menu Type<span class="help">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <div class="col-sm-3 no-padding">
                                    <input type="radio" name="menu_type" value="veg" id="veg">
                                    <label for="veg">Veg</label>
                                </div>
                                <div class="col-sm-5 no-padding">
                                    <input type="radio" name="menu_type" value="nonveg" id="nonveg" checked>
                                    <label for="nonveg">Non Veg</label>
                                </div>
                                <div class="col-sm-3 no-padding">
                                     <input type="radio" name="menu_type" value="other" id="otherfood" checked>
                                    <label for="otherfood">Others</label>
                                </div>
                            </div>
                        </div>

                         <div class="form-group clearfix">

                            <div class="col-sm-4">
                                <label for="name">Price Option<span class="help">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <div class="col-sm-6 no-padding">
                                    <input type="radio" id="price-option-single" name="price_option" value="single" checked>
                                    <label for="price-option-single">Single</label>
                                </div>
                                <div class="col-sm-6 no-padding">
                                    <input type="radio" id="price-option-multiple" name="price_option" value="multiple">
                                    <label for="price-option-multiple">Multiple</label>
                                </div>
                            </div>
                        </div>

                         <div class="form-group clearfix"  id="singlePrice">
                             <div class="col-sm-4">
                                <label class="">Price <span class="star">*</span></label>
                             </div>
                            <div class="col-sm-8"><?php
                               echo $this->Form->input('MenuDetail.orginal_price',
                                   array('class'=>'form-control singleValidate',
                                       'placeholder'=>'Price',
                                       'data-attr'=>'original price',
                                       'type' => 'text',
                                       'label'=>false)); ?>
                                <label class="originalErr"></label>
                            </div>
                         </div>
                         <div id="multiple" style="display: none">
                            <div class="form-group clearfix">
                                <label class="col-sm-4 control-label">&nbsp;</label>
                                <div class="col-sm-8">
                                    <div class="col-sm-5 no-padding-left"><?php
                                       echo $this->Form->input('MenuDetail.sub_name',
                                           array('class'=>'form-control multipleValidate multipleprice',
                                               'placeholder'=>'Menu Name',
                                               'data-attr'=>'product name',
                                               'id' => 'multiple_menu_0',
                                               'name' => 'data[MenuDetail][0][sub_name]',
                                               'label'=>false)); ?>
                                    </div>
                                    <div class="col-sm-5 no-padding-left"><?php
                                       echo $this->Form->input('MenuDetail.orginal_price',
                                           array('class'=>'form-control multipleValidate',
                                               'placeholder'=>'Price',
                                               'type' => 'text',
                                               'id' => 'multiple_menuprice_0',
                                               'data-attr'=>'original price',
                                               'name' => 'data[MenuDetail][0][orginal_price]',
                                               'label'=>false)); ?>
                                    </div>
                                    <div class="col-sm-2">
                                    <a class="addPrice btn green" href="javascript:void(0);" onclick="multipleOption();"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                         </div>
                         <div class="form-group clearfix">
                             <div class="col-sm-4">
                                <label>Addons <span class="star"></span></label>
                             </div>
                            <div class="col-sm-8">
                                <div class="col-sm-6 no-padding">
                                    <input type="radio" id="addon_yes" name="menuaddons" value="Yes" onclick="getAddons('Yes')">
                                    <label for="addon_yes">Yes</label>
                                </div>
                                <div class="col-sm-6 no-padding">
                                    <input type="radio" id="addon_no" name="menuaddons" value="No" checked onclick="getAddons('No')">
                                    <label for="addon_no">No</label>
                                </div>
                            </div>
                         </div>
                         <div id="getShowAddons" class="col-xs-12">

                         </div>

                         <div class="form-group clearfix">
                             <div class="col-sm-4">
                                <label class="">Image <span class="star"></span></label>
                             </div>
                            <div class="col-sm-8"><?php
                               echo $this->Form->input("Menu.menu_image",
                                   array("label"=>false,
                                       "type"=>"file",
                                       "name"=>"menuImage")); ?>
                            </div>
                         </div>
                         <div class="form-group clearfix">
                             <div class="col-sm-4">
                                <label class="">Description</label>
                            </div>
                            <div class="col-sm-8"><?php
                               echo $this->Form->textarea('Menu.menu_description',
                                   array('class'=>'form-control',
                                       'label'=>false)); ?>
                            </div>
                        </div>
                       <div class="form-group clearfix">

                           <div class="col-sm-4">
                               <label for="name">Popular<span class="help">*</span></label>
                           </div>
                           <div class="col-sm-8">
                               <div class="col-sm-6 no-padding">
                                   <input type="radio" id="popular_yes" name="popular_dish" value="Yes">
                                   <label for="popular_yes">Yes</label>
                               </div>
                               <div class="col-sm-6 no-padding">
                                   <input type="radio" id="popular_no" name="popular_dish" value="No" checked>
                                   <label for="popular_no">No</label>
                               </div>
                           </div>
                       </div>

                       <div class="form-group clearfix">

                           <div class="col-sm-4">
                               <label for="name">Spicy<span class="help">*</span></label>
                           </div>
                           <div class="col-sm-8">
                               <div class="col-sm-6 no-padding">
                                   <input type="radio" id="spicy_dish_yes" name="spicy_dish" value="Yes">
                                   <label for="spicy_dish_yes">Yes</label>
                               </div>
                               <div class="col-sm-6 no-padding">
                                   <input type="radio" id="spicy_dish_no" name="spicy_dish" value="No" checked>
                                   <label for="spicy_dish_no">No</label>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="col-xs-12 text-center">
                  <button class="btn btn-submit" type="button" onclick=" return menuAddEdit();">Save</button>
                  <a class="btn btn-cancel" href="<?php echo PARTNER_BASE_URL ?>menus"> Cancel</a>
               </div>
               <?= $this->Form->end();?>
            </div>
         </div>
      </div>
   </div>
   </div>
</section>
<script type="text/javascript">
   $(document).ready(function () {
       $("#price-option-multiple").click(function () {
           $("#singlePrice").css('display','none');
           $("#multiple").css('display','block');
       });
   
       $("#price-option-single").click(function () {
           $("#multiple").css('display','none');
           $("#singlePrice").css('display','block');
       });
   });
   function menuAddEdit(){

       var error = 0;
       var category_id      = $.trim($("#category_id").val()) ;
       var menu_name        = $.trim($("#menu-menu-name").val()) ;

       var originalPrice    = $.trim($("#menudetail-orginal-price").val());
       var menu_type        = $.trim($("input[name='menu_type']:checked").val());
       var price_option     = $.trim($("input[name='price_option']:checked").val());
       var addons           = $.trim($("input[name='menuaddons']:checked").val());
       var menu_image       = $.trim($(".menu-menu-image").html());

      // var img = $('#menu-menu-image').html().split('.').pop().toLowerCase();
       //alert(img);
       $('.error').html('');


   
       if(category_id == ''){
           $(".categoryErr").addClass('error').html('Please enter the category name');
           $("#category_id").focus();
           error = 1;
           return false;
   
       }else if(menu_name == ''){
           $(".menunameErr").addClass('error').html('Please enter the Menu Name');
           $("#menu-menu-name").focus();
           error = 1;
           return false;
   
       }else if(menu_type == ''){
           $(".menutypeErr").addClass('error').html('Please choose menu type');
           $("#menu_type").focus();
           error = 1;
           return false;
   
       }

       if(price_option == ''){
           $(".categoryErr").addClass('error').html('Please choose price option');
           $("#menupriceErr").focus();
           error = 1;
           return false;
   
       }
       if(price_option != '' && price_option == 'single' && originalPrice == '' ) {
            $(".originalErr").addClass('error').html('Please enter the amount');
           $("#menudetail-orginal-price").focus();
           error = 1;
            return false;
       }else if(price_option != 'single') {
           var menuLength = $('.multipleprice').length;
            $('.multipleprice').each(function () {
                var id = this.id;
                var key = id.split('_');
                if($("#"+id).val() == '') {
                    $('.commonErr').addClass('error').html('Please enter the name');
                    $("#"+id).focus();
                    return false
                }else if($("#multiple_menuprice_"+key[2]).val() == '') {
                    $('.commonErr').addClass('error').html('Please enter the amount');
                    $("#multiple_menuprice_"+key[2]).focus();
                    return false
                }else {
                    menuLength--;
                    if(menuLength == 0) {
                        error = 0;
                    }

                }
            });
       }else {
           var menuLength = 0;
           error = 0;
       }

       /*if(menu_image == ''){
           $(".imageErr").addClass('error').html('Please select Menu Image');
           $(".menu-menu-image").focus();
           return false;
   
       }else if(menu_image != '' && $.inArray(img, ['gif','png','jpg','jpeg']) == -1){
           $(".imageErr").addClass('error').html("Please Select the Valid Image Type");
           $(".menu-menu-image").focus();
           return false;
   
       }else*/

       if(error == 0 && menuLength == 0){
           $.ajax({
               type   : 'POST',
               url    : jsSitePartner+'menus/checkMenu',
               data   : {id:'', category_id:category_id,menu_name:menu_name},
               success: function(data){
                   if($.trim(data) == '1') {
                       $(".menunameErr").addClass('error').html('This menu name already exists');
                       $("#menu-menu-name").focus();
                       return false;
                   }else {
                       $("#menuAddForm").submit();
                   }
   
               }
           });return false;
           //
       }
   }
   
   function getCategory(id) {
       $.ajax({
           type   : 'POST',
           url    : baseUrl+'restaurants/ajaxaction',
           data   : {id:id,action:'getCategory'},
           success: function(data){
               $("#categoryList").html(data);return false;
   
           }
       });return false;
   }
   var i = 1;
   
   function multipleOption() {

       if($("#multiple_menu_"+i).length != 0) {
           alert('comeee');
       }

       html =  '<div id = "moreProuct'+i+'" class="form-group clearfix">'+
       '<label class="col-sm-4 control-label">&nbsp;</label>'+
       '<div class="col-sm-8">'+
       '<div  class="row addPriceTop multipleMenu">'+

           '<div class="col-sm-5">'+
           '<div class="input text">'+
           '<input type="text" id="multiple_menu_'+i+'" data-attr="product name" maxlength="100" placeholder="Menu Name" class="form-control multipleValidate multipleprice" name="data[MenuDetail][' + i + '][sub_name]">'+
           '</div>'+
           '</div>'+
           '<div class="col-sm-5">'+
           '<div class="input number">'+
           '<input type="text" id="multiple_menuprice_'+i+'" data-attr="original price" step="any" placeholder="Price" class="form-control multipleValidate" name="data[MenuDetail][' + i + '][orginal_price]">'+
           '</div>'+
           '</div>'+
           '<div class="col-sm-2">'+
           '<span class="ItemRemove" onclick="removeOption('+i+');"><i class="fa fa-times"></i></span>'+
           '</div>'
           '</div>'
           '</div>'
           '</div>';
   
       appendMultipleSubAddons(i);
   
       i++;
       $('#multiple').append(html);
       html = '';
       return false;
   }
   
   function appendMultipleSubAddons(removeId) {
       var multipleLength = $('.multipleMenu').length;
       var i = 1;
   
       $('.productAddonsMenu').each(function() {
           var subaddonName = $(this).attr('id');
           multipleAddon = '<div class="col-sm-6 col-lg-3 removeAppendAddon_'+removeId+'">'+
               '<input class="form-control singleValidate" type="text" name="'+subaddonName+'[]">'+
               '</div>';
           $('#appendMultiplePrice_'+i).append(multipleAddon);
           i++;
       });
   }
   
   function removeOption(id) {
    //$(this).parent('div').remove();
       $('#moreProuct' + id).remove();
       $('.removeAppendAddon_'+id).remove();
   }
   
   function getAddons(option) {
       var category_id        = $.trim($("#category_id").val()) ;
       var price_option      = $.trim($("input[name='price_option']:checked").val());
   
       var restaurant_id        = $.trim($("#restaurant_id").val()) ;
       var category_id        = $.trim($("#category_id").val()) ;
       var menu_name        = $.trim($("#menu-menu-name").val()) ;
   
       if(category_id == ''){
           $(".categoryErr").addClass('error').html('Please enter the category name');
           $("#category_id").focus();
           return false;
   
       }else {
           if (option == 'Yes') {
               var $menuLength = '';
               if (price_option == 'multiple') {
                   $menuLength = $('.addPriceTop').length;
               }
   
               $.ajax({
                   type   : 'POST',
                   url    : jsSitePartner+'menus/ajaxaction',
                   data   : {'productId' : '','restaurant_id' : restaurant_id,'category_id' : category_id,'price_option' : price_option,'menuLength' : $menuLength,'action' : 'getAddons'},
                   success: function(response){
                       if (price_option == 'multiple') {
                           var multipleLength = $('.multipleMenu').length;
                           var j = 0;
                           for (j = 1; j <= multipleLength; j++) {
                               appendMultipleSubAddons(j);
                           }
                       }
                       $("#getShowAddons").html(response);
                       $('#getShowAddons').show();
   
                   }
               });return false;
   
           } else {
               $('#getShowAddons').hide();
               return false;
           }
       }
   
   }
   
</script>

