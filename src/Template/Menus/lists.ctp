<section class="cartpage-sec">
    <div class="container">
        <div class="col-sm-2 no-padding-right">
            <div class="sidebar">
                <div class="cart-menu-box" id="myScrollspy">
                    <div class="cart-menu-box-title active">Menu</div>
                    <ul class="nav nav-pills nav-stacked cart-menu-box-ul">
                        <?php if(!empty($menuDetails)) {
                            $catId = '';
                            foreach ($menuDetails as $key => $value) {
                                if (!empty($value['restaurant_menus'])) {
                                    ?>
                                    <li class="">
                                        <a href="#food_<?php echo $value['id']; ?>" rel="m_PageScroll2id">
                                            <?php echo $value['catname']; ?>
                                            <span class="pull-right arrow-icon">
                                                <i class="fa fa-angle-down"></i>
                                            </span>
                                        </a>
                                    </li>
                                <?php }
                            }
                        }?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="cart-dish-box">
                <?php if(!empty($menuDetails)) {
                    $catId = '';
                    foreach($menuDetails as $key => $value) {
                        if(!empty($value['restaurant_menus'])) {
                            ?>
                            <div class="dishbox-title"><b><?php echo $value['catname']; ?></b></div>
                            <?php foreach ($value['restaurant_menus'] as $mkey => $mvalue) { ?>
                                <section id="food_<?php echo $value['id']; ?>">
                                    <div class="dishbox-item-row">
                                        <div class="border-bottom-1">
                                            <div class="col-sm-8 item-name">
                                                <span class="vegimage">
                                                    <img src="<?php echo BASE_URL ?>images/<?php echo ($mvalue['menu_type'] == 'veg') ? 'veg.png' : 'nonveg.jpg' ?> ">
                                                </span>
                                                <?php echo $mvalue['menu_name'] ?>
                                            </div>
                                            <div class="col-sm-2">
                                                <span class="minus-icon"><i class="fa fa-minus" onclick="addCart('<?php echo $mvalue['id'] ?>','remove')"></i></span>
                                                <?php
                                                if(!empty($cartsDetails)) { ?>
                                                    <?php

                                                    foreach ($cartsDetails as $ckey => $cvalue) { ?>
                                                        <?php if ($cvalue['menu_id'] == $mvalue['id']) { ?>
                                                            <span class="dishbox-item-count"
                                                                  id="quantity_<?php echo $mvalue['id'] ?>"><?php echo ($cvalue['quantity'] != '') ? $cvalue['quantity'] : 0 ?></span>
                                                            <?php break;
                                                        } else if (($ckey + 1) >= $cartCount) { ?>
                                                            <span class="dishbox-item-count"
                                                                  id="quantity_<?php echo $mvalue['id'] ?>">0</span>
                                                            <?php

                                                            break;
                                                        }
                                                    }
                                                }else {?>
                                                    <span class="dishbox-item-count" id="quantity_<?php echo $mvalue['id'] ?>">0</span>
                                                <?php } ?>
                                                <span class="plus-icon"><i class="fa fa-plus" onclick="addCart('<?php echo $mvalue['id'] ?>','add')"></i></span>
                                            </div>
                                            <div class="col-sm-2 text-right">
                                                <span class="final-price">$<?php echo $mvalue['menu_details'][0]['orginal_price'] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            <?php }
                        }
                    }

                } ?>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="cart-scrolladd-box">
                <input id="minimum_order" type="hidden" value="<?php echo $minimumOrder; ?>">
                <div class="cart-add-box">
                    <div class="cart-add-box-tittle">YOUR CART</div>

                    <!--<div class="cart-add-box-res">Restaurant: <?php /*echo $restaurantDetails['restaurant_name'] */?></div>-->
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
                                    <div id="deliveryAmt" class="cart-add-box-total-text"><span class="pull-left">Delivery Charge</span><span class="pull-right">$ <?php echo number_format($deliveryCharge,2); ?></span></div>
                                </div>
                            </div>
                            <div class="cart-add-box-pay">
                                <div class=""><span class="pull-left">Total Pay</span><span class="pull-right">$ <?php echo number_format($totalAmount,2) ?></span></div>
                            </div>
                        <?php }else { ?>
                            Your Cart Empty
                        <?php } ?>

                    </div>

                    <div class="checkout-btn">
                            <?php if(isset($logginUser) && empty($logginUser)) { ?>
                                <?php if ($final[0]['currentStatus'] == 'Open') { ?>
                                    <button data-toggle="modal" data-target="#login_popup" id="submitBtn"
                                            class="btn check-btn" <?php echo (empty($cartsDetails) || $subTotal < $final[0]['minimum_order']) ? 'disabled' : ''; ?> >
                                        CHECKOUT
                                    </button>
                                <?php } else if ($final[0]['currentStatus'] == 'Closed') { ?>
                                    <button data-toggle="modal" data-target="#login_popup" id="submitBtn" class="btn check-btn" <?php echo (empty($cartsDetails) || $subTotal < $final[0]['minimum_order']) ? 'disabled' : ''; ?>>
                                        PREORDER
                                    </button>
                                <?php } else { ?>
                                    <button data-toggle="modal" data-target="#login_popup" id="submitBtn" class="btn check-btn" <?php echo (empty($cartsDetails) || $subTotal < $final[0]['minimum_order']) ? 'disabled' : ''; ?>>
                                        PREORDER
                                    </button>
                                <?php }
                            }else {?>
                                <?php if ($final[0]['currentStatus'] == 'Open') { ?>
                                    <button id="submitBtn" onclick="return submitOrder();" class="btn check-btn" <?php echo (empty($cartsDetails) || $subTotal < $final[0]['minimum_order']) ? 'disabled' : ''; ?> >
                                        CHECKOUT
                                    </button>
                                <?php } else if ($final[0]['currentStatus'] == 'Closed') { ?>
                                    <button id="submitBtn" onclick="return submitOrder();" class="btn check-btn" <?php echo (empty($cartsDetails) || $subTotal < $final[0]['minimum_order']) ? 'disabled' : ''; ?>>
                                        PREORDER
                                    </button>
                                <?php } else { ?>
                                    <button id="submitBtn" onclick="return submitOrder();" class="btn check-btn" <?php echo (empty($cartsDetails) || $subTotal < $final[0]['minimum_order']) ? 'disabled' : ''; ?>>
                                        PREORDER
                                    </button>
                                <?php }
                            } ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        var countryList = ["Afghanistan", "Albania", "Algeria"/*... and so on*/];

        // Set the autocomplete for the countries input
        $("#dishes").autocomplete({
            source: countryList
        });

    });
    function addCart(menuId,type) {
        var quantity = $("#quantity_"+menuId).html();
        if(type == 'add') {
            var addCount = parseInt(quantity) +1;
            $("#quantity_"+menuId).html(addCount);
        }else if(type == 'remove') {
            var addCount = parseInt(quantity) -1;
        }
        var quantity = $("#quantity_"+menuId).html();
        if(menuId != '' && quantity != 0) {
            var quantity = $("#quantity").html();
            if(quantity != 0) {
                $.ajax({
                    type   : 'POST',
                    url    : baseUrl+'menus/ajaxaction',
                    data   : {menuid:menuId,action:'cartUpdate','type':type},
                    success: function(data){
                        if(type == 'remove') {
                            //var addCount = parseInt(quantity) -1;
                            $("#quantity_"+menuId).html(addCount);
                        }
                        var result = data.split('@@');
                        $("#cartDetails").html(result[0]);
                        $("#minimum_order").val(result[1]);
                        if(result[1] == '1') {
                            $("#submitBtn").attr('disabled',false);
                        }else {
                            $("#submitBtn").attr('disabled',true);
                        }

                        return false;

                    }
                });return false;
            }

        }
    }

    function submitOrder() {
        var minimumOrder =  $("#minimum_order").val();

        if(minimumOrder == '1') {
            window.location.href = baseUrl+'checkouts';
        }else {
            $("#submitBtn").attr('disabled',true);
        }

        return false;

    }

</script>

