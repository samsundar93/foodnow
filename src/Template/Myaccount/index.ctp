<section class="myaccount-sec">
   <div class="container">
      <div class="col-sm-4">
         <div class="myaccount-list-div">

            <ul class="myaccountli">
               <li data-myaccount="my_profile" class="green-addcls">
                  <a  href="javascript:;">My Profile</a>
               </li>
               <li data-myaccount="my_order" >
                  <a href="javascript:;">My Order</a>
               </li>
               <li data-myaccount="my_address">
                   <a  href="javascript:;">Saved Address</a>
               </li>
               <li data-myaccount="my_card">
                  <a  href="javascript:;">Payment</a>
               </li>
            </ul>
         </div>
      </div>
      <div class="col-sm-8">
         <div class="myaccount-content-div">
           <div id="my_profile" class="my-profile common-hide" >
              <div class="your-account">YOUR ACCOUNT</div>
               <span class="commonErr"></span>
              <div class="form-group clearfix">
                 <div class="col-sm-3 col-xs-12 no-padding-left">
                    <label>Name</label>
                 </div>
                 <div class="col-sm-6 col-xs-12">
                    <input type="text" id="name" class="form-control form-control-myaccount" value="<?php echo $customerDetails['name'] ?>" placeholder="Enter Your Name">
                 </div>
                 <span class="nameErr"></span>
              </div>
              <div class="form-group clearfix">
                 <div class="col-sm-3 col-xs-12 no-padding-left">
                    <label>Email</label>
                 </div>
                 <div class="col-sm-6 col-xs-12">
                    <input type="text" id="username" class="form-control form-control-myaccount" value="<?php echo $customerDetails['username'] ?>" placeholder="Enter Your Email Id">
                 </div>
                  <span class="usernameErr"></span>
              </div>
              <div class="form-group clearfix">
                 <div class="col-sm-3 col-xs-12 no-padding-left">
                    <label>Phone</label>
                 </div>
                 <div class="col-sm-6 col-xs-12 ">
                    <input type="text" id="phone_number" class="form-control form-control-myaccount custPhone" value="<?php echo $customerDetails['phone_number'] ?>" placeholder="Phone Number">
                 </div>
                  <span class="phoneErr"></span>
              </div>
              <button onclick="return saveDetails();" class="btn btn-lg place_green checkouts_btn">save changes</button>
           </div>

           <div id="my_order" class="my-order common-hide"  style="display:none">
              <div class="your-account">YOUR ORDERS</div>
              <div class="my-order-box m-b-10">
                 <div class="col-sm-8 no-padding">
                    <div>68Salem RR Briyani Unvagam <span class="gray-txt">(Order #: 1118285943)</span></div>
                    <div class="gray-txt">Nov 17, 2017 3:01 PM</div>
                 </div>
                 <div class="col-sm-3">
                    <button class="repeat-ordere">Repeat Order</button>
                 </div>
                 <div class="col-sm-1 no-padding text-right">
                    <div class="order-price">$ &nbsp;10</div>
                 </div>
              </div>
              <div class="my-order-box m-b-10">
                 <div class="col-sm-8 no-padding">
                    <div>68Salem RR Briyani Unvagam <span class="gray-txt">(Order #: 1118285943)</span></div>
                    <div class="gray-txt">Nov 17, 2017 3:01 PM</div>
                 </div>
                 <div class="col-sm-3">
                    <button class="repeat-ordere">Repeat Order</button>
                 </div>
                 <div class="col-sm-1 no-padding text-right">
                    <div class="order-price">$ &nbsp;10</div>
                 </div>
              </div>
              <div class="my-order-box m-b-10">
                 <div class="col-sm-8 no-padding">
                    <div>68Salem RR Briyani Unvagam <span class="gray-txt">(Order #: 1118285943)</span></div>
                    <div class="gray-txt">Nov 17, 2017 3:01 PM</div>
                 </div>
                 <div class="col-sm-3">
                    <button class="repeat-ordere">Repeat Order</button>
                 </div>
                 <div class="col-sm-1 no-padding text-right">
                    <div class="order-price">$ &nbsp;10</div>
                 </div>
              </div>
           </div>

           <div id="my_address" class="my-address common-hide" style="display:none">
               <div class="your-account">MY SAVED ADDRESS</div>
               <?php if(!empty($customerDetails['addressbooks'])) {
                   foreach ($customerDetails['addressbooks'] as $key => $value) { ?>
                       <div class="col-sm-9 no-padding">
                           <div class="profile_address_box m-b-10">
                               <div class="col-xs-8 no-padding-left">
                                   <span class="account_profile"><?php echo $value['title'] ?></span>
                                   <div><?php echo $value['address'] ?></div>
                                   <?php if($value['landmark'] != '') {
                                            ?>
                                            <div>LandMark - <?php echo $value['landmark'] ?></div>
                                            <?php
                                        }?>
                               </div>
                               <div class="col-xs-4 pull-right no-padding text-right">
                                   <button class="profile_edit">
                                       <i aria-hidden="true" class="fa fa-pencil-square-o"></i> Edit
                                   </button>
                                   <button class="profile_delete">
                                       <i aria-hidden="true" class="fa fa-trash-o"></i> Delete
                                   </button>
                               </div>
                           </div>
                       </div>
                   <?php }
               }?>

           </div>

           <div id="my_card" class="my-address common-hide" style="display:none">
              <div class="your-account">MY SAVED CARDS</div>
                 <div class="col-sm-6 no-padding">
                     <?php if(!empty($customerDetails['stripecards'])) {
                         foreach ($customerDetails['stripecards'] as $key => $value) { ?>
                             <div class="card-box m-b-10">
                                 <div class="firstblock clearfix">
                                     <div class="col-sm-8 no-padding">
                                         <div class="gray-txt">Card No:</div>
                                         <div>XXXX-XXXX-XXXX-<?php echo $value['card_number'] ?></div>
                                     </div>
                                 </div>
                                 <div class="secondblock clearfix">
                                     <div class="col-sm-6 no-padding">
                                         <i class="fa fa-cc-visa fa-2x" aria-hidden="true"></i>
                                     </div>
                                     <div class="col-sm-6 no-padding text-right">
                                         <button class="profile_delete">
                                             <i aria-hidden="true" class="fa fa-trash-o"></i> Delete
                                         </button>
                                     </div>
                                 </div>
                             </div>
                         <?php }
                     }?>
                 </div>
              </div>
           </div>
         </div>
      </div>
   </div>
</section>