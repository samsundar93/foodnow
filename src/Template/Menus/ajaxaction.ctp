<?php if($action == 'cartUpdate') { ?>
    <?php if(!empty($cartsDetails)) { ?>
        <div class="cart-item-height">
            <div class="cart-add-box-menu-sec">
                    <?php foreach ($cartsDetails as $key => $value) { ?>
                        <div class="cart-add-box-menu">
                            <div class="col-sm-6 no-padding">
                                <span><?php echo $value['restaurant_menu']['menu_name'] ?></span>
                            </div>
                            <div class="col-sm-4 no-padding text-center">
                                <span class="minus-icon">
                                    <i class="fa fa-minus" onclick="addCart('<?php echo $value['menu_id'] ?>','remove')"></i>
                                </span>
                                <span class="dishbox-item-count">
                                    <?php echo $value['quantity'] ?>
                                </span>
                                <span class="plus-icon">
                                    <i class="fa fa-plus" onclick="addCart('<?php echo $value['menu_id'] ?>','add')"></i>
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
                <div class="cart-add-box-total-text"><span class="pull-left">Delivery Charge</span><span class="pull-right">$ <?php echo  number_format($deliveryCharge,2); ?></span></div>
            </div>
        </div>
        <div class="cart-add-box-pay">
            <div class=""><span class="pull-left">Total Pay</span><span class="pull-right">$ <?php echo number_format($totalAmount,2) ?></span></div>
        </div>
    <?php }else { ?>
        Your Cart Empty
    <?php } ?>


    <?php echo '@@'.$minimumOrder;  die(); } ?>
