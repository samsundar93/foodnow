<section class="myaccount-sec">
<div class="container">
   <div class="order-viewrapper">
               <div class="order-viewr-header">
                  <h4 class="modal-title">Order Details - <?php echo $orderDetails['order_number'] ?></h4>
               </div>
                  <div class="order-modal-content">
                     <div class="col-xs-12 m-t-20">
                        <div class="pull-left order-pop-head">
                           <h4><?php echo $orderDetails['order_number'] ?></h4>
                           <h5><?php echo ($orderDetails['order_type'] == 'delivery') ? 'Delivery' : 'Pickup' ?></h5>
                        </div>
                        <div class="order-pop-add pull-right text-right">
                           <div><?php echo $orderDetails['customer_name'] ?></div>
                           <div><?php echo $orderDetails['customer_email'] ?></div>
                           <div><?php echo $orderDetails['customer_phone'] ?></div>
                           <div><?php echo $orderDetails['delivery_address'] ?></div>
                        </div>
                     </div>
                     <div class="col-xs-12">   
                        <div class="order-pop-payemt">
                           <div class="col-sm-6 no-padding-left text-left">
                              <div>
                                 <strong>PAYMENT TYPE</strong>
                              </div>
                              <div><?php echo $orderDetails['payment_mode'] ?></div>
                           </div>
                            <?php if($orderDetails['payment_mode'] != 'cod') { ?>
                               <div class="col-sm-6 no-padding-right text-right">
                                  <div>
                                     <strong>TRANSACTION ID</strong>
                                  </div>
                                  <div>Ch_1BK1sNB07VJngVPLvQj1kG3o</div>
                               </div>
                            <?php } ?>
                        </div>
                        <div class="order-pop-delivery">
                           <div class="col-sm-6 no-padding-left text-left">
                              <div>
                                 <strong><?php echo ($orderDetails['order_type'] == 'delivery') ? 'Delivery' : 'Pickup' ?> Date/Time</strong>
                              </div>
                              <div> <?php echo $orderDetails['delivery_date'].' '. $orderDetails['delivery_time'] ?> </div>
                           </div>
                            <?php if($orderDetails['order_type'] == 'delivery') { ?>
                               <div class="col-sm-6 no-padding-right text-right">
                                  <div>
                                     <strong>DELIVERED TIME</strong>
                                  </div>
                                  <div>30 min</div>
                               </div>
                            <?php } ?>
                        </div>
                        <table class="table order-pop-table">
                           <thead>
                              <tr>
                                 <th>ITEM NAME</th>
                                 <th>QUANTITY</th>
                                 <th class="text-right">TOTAL</th>
                              </tr>
                           </thead>
                            <?php foreach ($orderDetails['carts'] as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $value['restaurant_menu']['menu_name'] ?></td>
                                    <td><?php echo $value['quantity'] ?></td>
                                    <td class="text-right">$ <?php echo  number_format($value['price'],2) ?></td>
                                </tr>
                            <?php } ?>

                            <tr>
                                <td class="text-right" colspan="2">item total</td>
                                <td class="text-right">$ <?php echo number_format($orderDetails['subtotal'],2) ?></td>
                            </tr>
                            <tr>
                                <td class="text-right" colspan="2">service tax</td>
                                <td class="text-right">$ <?php echo number_format($orderDetails['taxamount'],2) ?></td>
                            </tr>

                            <?php if($orderDetails['order_type'] == 'delivery') { ?>
                                <tr>
                                    <td class="text-right" colspan="2">delivery charge</td>
                                    <td class="text-right">$ <?php echo number_format($orderDetails['delivery_charge'],2) ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td class="text-right" colspan="2"><strong>GRAND TOTAL</strong></td>
                                <td class="text-right"><strong>$ <?php echo number_format($orderDetails['grand_total'],2) ?></strong></td>
                            </tr>
                        </table>
                     </div>
                  </div>
               
            </div>
</div>
</section>