

<section class="cartpage-sec checkout-sec">
   <div class="container">
      <?= $this->Form->create('checkoutForm',[
         'id' => 'checkoutForm',
         'url' => '/checkouts/placeOrder'
         ])?>
      <div class="item_head">
         Restaurant: <?php echo $restaurantDetails['restaurant_name']; ?>
      </div>
      <div class="col-sm-8 checkouts">
         <div class="item_list2">
            <div class="accordian">
               <div class="addressinformation accordian_head active_check">
                  <div class="col-sm-1 col-xs-12">
                     <div class="checkouts_round">1</div>
                  </div>
                  <div class="col-sm-8 col-xs-9 no-padding mobile_headbar">Delivery Details<br><span>Address, order notes & coupons</span></div>
               </div>
               <div class="accordian_cont" id="addressDetails">
                   <div id="deliveryDetails">

                       <p class="bold">
                           Select Delivery Address<span class="pull-right red-font">
                     <a href="javascript:;" data-toggle="modal" data-target="#address_pop">+ Add New Address</a>
                     </span>
                       </p>
                       <div id="changeAddress" class="col-xs-12 no-padding">
                           <input type="hidden" id='pickupCount' value="<?php echo count($addressBookLists) ?>">
                           <?php if(!empty($addressBookLists)) { ?>
                               <div class="col-sm-12 address-choose-div no-padding-left">
                                   <input type="radio" id="home_address" name="checkout_address" value="<?php echo $addressBookLists[0]['id']; ?>" >
                                   <label for="home_address">
                                       <div class="col-sm-1">
                                           <div class="address-icon">
                                               <i class="fa fa-address-card-o"></i>
                                           </div>
                                       </div>
                                       <div class="col-sm-10">
                                           <div class="clearfix accordian_address_box" id="selectPickup">
                                               <div class="">
                                                   <input id="selectedAddress" name="selectedAddress" type="radio" value="<?php echo $addressBookLists[0]['id']; ?>">
                                                   <div for="selectedAddress"><?php echo $addressBookLists[0]['title'] ?></div>
                                                   <div class="margin-top-5 col-xs-12 no-padding selectedAddress">
                                                       <?php //echo $customerDetails['addressbooks'][0]['flatno'] ?>
                                                       <?php echo $addressBookLists[0]['address'] ?>
                                                       <?php echo ($addressBookLists[0]['landmark']) ? 'Landmark'.'-'.$addressBookLists[0]['landmark'] : '' ?>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-sm-1 no-padding">
                                           <div class="address-right"></div>
                                       </div>
                                   </label>
                               </div>
                           <?php } ?>
                           <?php if(!empty($totalAddress) && ($totalAddress>1)){?>
                               <div class="col-sm-12 no-padding save-pick-add clearfix">
                                   <span class="selectPickup"></span>
                                   Not the address you were looking for?
                                   <a href="javascript:;" data-toggle="modal" data-target="#alladdress_pop">
                                       <p class="saved_add">Choose from your other saved pickup address</p>
                                   </a>
                               </div>
                           <?php } ?>
                       </div>
                       <div class="date-time">
                      <div class="col-sm-6 no-padding-left">
                          <label class="col-sm-5 no-padding">Delivery Date</label>
                          <div class="col-sm-7 no-padding">
                            <input type="text" class="form-control" id="delivery_date">
                          </div>
                      </div>
                      <div class="col-sm-6 no-padding-right">
                          <label class="col-sm-5 no-padding">Delivery Time</label>
                          <div class="col-sm-7 no-padding">
                            <input type="text" class="form-control" id="delivery_time">
                          </div>
                      </div>
                   </div>
                   </div>
                   
                  <div class="order_notes">
                     <div class="order_notes_title">Order Notes:</div>
                     <div class="order_notes_text">Wish to share something that we can help you with?</div>
                     <textarea name="instruction" class="accordian_address_box_text margin-top-5 no-padding" placeholder="If you want to add any comment, e.g. about allergies or delivery instructions, this is the right place"></textarea>
                  </div>
                  <button onclick="return checkAddress()" class="btn btn-lg place_green checkouts_btn m-b-10">CONTINUE TO PAYMENT</button>
                  <div id="addressErr"></div>
               </div>
            </div>
            <input type="hidden" name="resId" id='resId' value="<?php echo ($restaurantDetails['id'] != '') ? $restaurantDetails['id'] : ''; ?>">
            <input type="hidden" name="res-sp-token" id='res-sp-token' value="">
            <input type="hidden" name="res-sp-payed" id='res-sp-payed' value="">
            <div class="accordian">
               <div class="accordian_head">
                  <div class="col-sm-1 col-xs-12">
                     <div class="checkouts_round">2</div>
                  </div>
                  <div class="col-sm-11 col-xs-12 no-padding mobile_headbar">Payment Details<br><span>How do you wish to pay?</span></div>
               </div>
               <div class="accordian_cont" id="paymentDetails" style="display:none;" >
                  <div classs="accordian_cont2">
                     <div class="col-sm-3 col-xs-12 pay-radio">
                        <input onclick="return showCheckout();" value="cod" type="radio" id="cod" name="payment_method">
                        <label for="cod">COD</label>
                     </div>
                     <div class="col-sm-3 col-xs-12 pay-radio">
                        <input onclick="return showCheckout();" value="paytm" type="radio" id="paytm" name="payment_method">
                        <label for="paytm">PAYTM</label>
                     </div>
                     <div class="col-sm-3 col-xs-12 pay-radio">
                        <input onclick="return showCheckout();" value="paypal" type="radio" id="paypal" name="payment_method">
                        <label for="paypal">PAYPAL</label>
                     </div>

                      <div class="col-sm-3 col-xs-12 pay-radio">
                          <input onclick="return showCheckout();" value="stripe" type="radio" id="stripe" name="payment_method">
                          <label for="stripe">STRIPE</label>
                      </div>

                      <div class="col-xs-12 no-padding m-t-20 " id="saveCards" style="display: none">
                          <?php if(!empty($saveCardDetails)) {
                              foreach ($saveCardDetails as $key => $value) {
                                  ?>
                                  <div class="col-sm-12 address-choose-div no-padding-left">
                                      <input type="radio" id="save_card_<?php echo $value['id']; ?>" name="stripeId"
                                             value="<?php echo $value['id']; ?>" <?php echo ($key == 0) ? '' : '' ?>>
                                      <label for="save_card_<?php echo $value['id']; ?>">
                                          <div class="col-sm-1">
                                              <div class="address-icon">
                                                  <i class="fa fa-address-card-o"></i>
                                              </div>
                                          </div>
                                          <div class="col-sm-10">
                                              <div class="clearfix accordian_address_box" id="selectPickup">
                                                  <div class="">
                                                      <input id="selectedStripe" name="selectedStripe" type="radio"
                                                             value="<?php echo $value['id']; ?>">
                                                      <div for="selectedStripe"></div>
                                                      <div class="margin-top-5 col-xs-12 no-padding selectedAddress">
                                                          <?php echo 'XXXX-XXXX-XXXX-'.$value['card_number'] ?>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-sm-1 no-padding">
                                              <div class="address-right"></div>
                                          </div>
                                      </label>
                                  </div>
                              <?php }
                          }?>
                          <div class="col-sm-12 address-choose-div no-padding-left">
                              <input type="radio" id="newcard" name="stripeId" value="" >
                              <label for="newcard">
                                  <div class="col-sm-1">
                                      <div class="address-icon">
                                          <i class="fa fa-address-card-o"></i>
                                      </div>
                                  </div>
                                  <div class="col-sm-10">
                                      <div class="clearfix accordian_address_box" id="selectPickup">
                                          <div class="">
                                              <input id="selectedStripe" name="selectedStripe" type="radio" value="">
                                              <div for="selectedStripe"></div>
                                              <div class="margin-top-5 col-xs-12 no-padding selectedAddress">
                                                  Pay with New Card
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-1 no-padding">
                                      <div class="address-right"></div>
                                  </div>
                              </label>
                          </div>
                      </div>

                  </div>
                  <span id="paymentErr"></span>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-4">
         <div class="cart-scrolladd-box">
            <div class="cart-add-box-checkout cart-add-box-checkout-page">
                <div class="pickup-door text-center">
                    <div class="col-sm-4 col-sm-offset-2 no-padding  pick-cus">
                        <input type="radio" id="pickradio" name="order_type" value="pickup" onclick="return orderType('pickup');">
                        <label for="pickradio">Pickup</label>
                    </div>
                    <div class="col-sm-4 no-padding pick-cus">
                        <input type="radio" id="delvradio" name="order_type" value="delivery" checked onclick="return orderType('delivery');">
                        <label for="delvradio">Delivery</label>
                    </div>
                </div>
               <div id="cartDetails">
                  <?php if(!empty($cartsDetails)) { ?>
                  <div class="cart-item-height">
                     <div class="cart-add-box-menu-sec">
                        <?php foreach ($cartsDetails as $key => $value) { ?>
                        <div class="cart-add-box-menu">
                           <div class="col-sm-6 no-padding">
                              <span><?php echo $value['restaurant_menu']['menu_name'] ?></span>
                           </div>
                           <div class="col-sm-4 no-padding text-center">
                              <span class="dishbox-item-count">
                              <?php echo $value['quantity'] ?>
                              </span>
                           </div>
                           <div class="col-sm-2 no-padding text-right">
                              <span class="final-price">$<?php echo number_format($value['price'],2) ?></span>
                           </div>
                        </div>
                        <?php
                           }?>
                     </div>
                     <div class="cart-add-box-total">
                        <div class="cart-add-box-total-text"><span class="pull-left">Item Total</span><span class="pull-right">$<span id="subTotal"><?php echo number_format($subTotal,2) ?></span></span></div>
                        <div class="cart-add-box-total-text"><span class="pull-left">Tax</span><span class="pull-right">$<?php echo number_format($taxAmount,2) ?></span></div>
                        <div id="deliveryAmt" class="cart-add-box-total-text"><span class="pull-left">Delivery Charge</span><span class="pull-right">$ <?php echo number_format($deliveryCharge,2); ?></span></div>
                     </div>
                  </div>
                  <div class="cart-add-box-pay">
                     <div class="deliveryTotal"><span class="pull-left">Total Pay</span><span class="pull-right">$ <?php echo number_format($totalAmount,2) ?></span></div>

                      <div class="pickupTotal" style="display: none"><span class="pull-left">Total Pay</span><span class="pull-right">$ <?php echo number_format($withOutDelivery,2) ?></span></div>
                  </div>
                  <?php }else { ?>
                  Your Cart Empty
                  <?php } ?>
               </div>
               <div class="checkout-btn">
                  <button style="display: none" onclick="return placeOrder()" id="checkoutBtn" class="btn check-btn place_green">CONFIRM ORDER</button>
               </div>
            </div>
         </div>
      </div>
      <?=  $this->Form->end(); ?>
   </div>
</section>
<div class="modal fade signup_popup" id="address_pop" tabindex="-1" role="dialog" data-keyboard="false" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
            <div class="modal-head pull-left">Add New Address</div>
         </div>
         <div class="modal-body clearfix">
            <div id="signup-carousel" class="col-xs-12 no-padding carousel slide" data-interval="false">
               <div class="carousel-inner">
                  <div class="item active">
                     <?= $this->Form->create('addressSetting',[
                        'id' => 'addressFrom'
                        ])?>
                     <div class="col-xs-12 loginForm_fields">
                        <div class="form-horizontal">
                           <?=
                              $this->Form->input('addressAdd', [
                                  'type' => 'hidden',
                                  'name' => 'action',
                                  'value' => 'addAddress'
                              ]);
                              ?>
                           <!--span id="commonErr"></span>-->
                           <div class="form-group texticon">
                              <label class="login_label">Address Title</label>
                              <?= $this->Form->input('title',[
                                 'type' => 'text',
                                 'id'   => 'title',
                                 'class' => 'form-control',
                                 'label' => false,
                                 'required'
                                 ]) ?>
                              <span class="titleErr"></span>
                           </div>
                           <div class="form-group texticon">
                              <label class="login_label">Home/Flat No</label>
                              <?= $this->Form->input('flatno',[
                                 'type' => 'text',
                                 'id'   => 'flatno',
                                 'class' => 'form-control',
                                 'label' => false,
                                 'required'
                                 ]) ?>
                              <span class="flatnoErr"></span>
                           </div>
                           <div class="form-group texticon">
                              <label class="login_label">Street Address</label>
                              <?= $this->Form->input('street_address',[
                                 'type' => 'text',
                                 'id'   => 'street_address',
                                 'class' => 'form-control',
                                 'label' => false,
                                 'required'
                                 ]) ?>
                              <span class="streetaddErr"></span>
                           </div>
                           <div class="form-group texticon">
                              <label class="login_label">Land Mark</label>
                              <?= $this->Form->input('land_mark',[
                                 'type' => 'text',
                                 'id'   => 'land_mark',
                                 'class' => 'form-control',
                                 'label' => false
                                 ]) ?>
                              <span class="landmarkErr"></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-12">
                        <div class="col-md-12 text-center signup_submit">
                           <input id="addAdderssBtn" type="button" class="btn" value="SUBMIT">
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
<div class="modal fade signup_popup" id="alladdress_pop" tabindex="-1" role="dialog" data-keyboard="false" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
            <div class="modal-head pull-left">Select a pickup address</small></div>
         </div>
         <div class="modal-body clearfix paddingLRModal">
            <div  data-interval="false">
               <span id="selectErr"></span>
               <div class="item active" id="showAll">
                  <?php if(!empty($addressBookLists)) {
                     foreach($addressBookLists as $key => $value) {
                         ?>
                  <div class="col-xs-12 select_add_popup">
                     <div class="accordian_address_box">
                        <div class="radio-item">
                           <input onclick="return selectAddress('<?php echo $value['id']; ?>')" name="address" id="select-address-<?php echo $value['id']; ?>" type="radio" value="<?php echo $value['id']; ?>">
                           <label for="select-address-<?php echo $value['id']; ?>">
                           <?php echo $value['title'] ?>
                           </label><br>
                           <?php echo $value['address'] ?>
                           <?php echo ($value['landmark']) ? 'Landmark'.'-'.$value['landmark'] : '' ?><br>
                        </div>
                     </div>
                  </div>
                  <?php }
                     } ?>
               </div>
               <div>
                  <span>Below addresses are out of delivery area</span>
                  <div class="item active" id="">
                     <?php if(!empty($outOfDelivery)) {
                        foreach($outOfDelivery as $key => $value) {
                            ?>
                     <div class="col-xs-12 select_add_popup">
                        <div class="accordian_address_box">
                           <div class="radio-item">
                              <input name="address" id="select-address-<?php echo $value['id']; ?>" type="radio" value="<?php echo $value['id']; ?>">
                              <label for="select-address-<?php echo $value['id']; ?>">
                              <?php echo $value['title'] ?>
                              </label><br>
                              <?php echo $value['address'] ?>
                              <?php echo ($value['landmark']) ? 'Landmark'.'-'.$value['landmark'] : '' ?><br>
                           </div>
                        </div>
                     </div>
                     <?php }
                        } ?>
                  </div>
               </div>
            </div>
            <div>
               <div class="text-center margin-bottom-15">
                  <button onclick="selectAddress()" class="btn btn-lg place_red checkouts_btn">SELECT</button>
                  <!--<button class="btn btn-lg checkouts_btn">CANCEL</button>-->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   function selectAddress(id) {
   
       $.ajax({
           type   : 'POST',
           url    : baseUrl+'checkouts/ajaxaction',
           data   : {addressId:id,action:'selectAddress'},
           success: function(data){
               $("#selectPickup").html(data);
               $("#alladdress_pop").modal('hide');
               return false;
   
           }
       });return false;
   }
   
</script>

