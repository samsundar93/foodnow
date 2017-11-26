<section class="search-banner-sec">
    <div class="container">
        <div class="col-xs-12">
            <div class="seacr-banner">
                <?php if($siteSettings['banner1'] != '') { ?>
                    <div class="seacr-banner-img">
                        <img src="<?php echo $siteSettings['banner1']; ?>">
                    </div>
                <?php } ?>

                <?php if($siteSettings['banner2'] != '') { ?>
                    <div class="seacr-banner-img">
                        <img src="<?php echo $siteSettings['banner2']; ?>">
                    </div>
                <?php } ?>

                <?php if($siteSettings['banner3'] != '') { ?>
                    <div class="seacr-banner-img">
                        <img src="<?php echo $siteSettings['banner3']; ?>">
                    </div>
                <?php } ?>

                <?php if($siteSettings['banner4'] != '') { ?>
                    <div class="seacr-banner-img">
                        <img src="<?php echo $siteSettings['banner4']; ?>">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<section class="filter-searc-sec">
    <div class="container">
        <div class="filter-part-div">
            <div class="col-xs-6 col-sm-6">
               <span>FITLTER BY
                   <button class="btn btn-default cusine">Cusine
                       <i class="fa fa-caret-down" aria-hidden="true"></i>
                   </button>
                  <!-- <button class="btn btn-default resttype">Type
                       <i class="fa fa-caret-down" aria-hidden="true"></i>
                   </button>-->
               </span>
            </div>
            <div class="col-xs-6 col-sm-6">
               <span class="pull-right">SORT BY <button class="btn btn-default">Relavance <i class="fa fa-caret-down" aria-hidden="true"></i>
               </button></span>
            </div>
        </div>
        <div class="filter-content-part">
            <?php if(!empty($allCuisinesLists)) {
                foreach ($allCuisinesLists as $key => $value) { ?>
                    <div class="col-lg-2 col-sm-3 col-xs-4">
                        <input type="checkbox" name="filterCuisines" value="<?php echo $key; ?>"> <?php echo $value; ?>
                    </div>
            <?php
                }
            }?>


            <div class="col-xs-12">
                <button onclick="return filter()" class="btn cusine-filter-btn">Apply</button>
                <button class="btn btn-default cusine-cancel-btn">cancel</button>
            </div>
        </div>

        <div class="filter-content-type" style="display: none">
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox" name="filterTypes" value="pickup"> Pickup
            </div>

            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox" name="filterTypes" value="delivery"> Delivery
            </div>

            <div class="col-xs-12">
                <button onclick="return filter()" class="btn cusine-filter-btn">Apply</button>
                <button class="btn btn-default cusine-cancel-btn">cancel</button>
            </div>
        </div>
    </div>
</section>
<section class="restaurant-sec">
    <div class="container">
        <?php if(!empty($result)) {
            foreach ($result as $key => $value) {
                ?>
                <div class="col-sm-6 restLists" data-cuisines="<?php echo $value['restaurant_cuisine'] ?>">
                    <a href="<?php echo BASE_URL ?>menus/lists/<?php echo $value['id'] ?>">
                        <div class="res-white">
                        <div class="res-opacity"></div>
                        <div class="col-sm-6 no-padding">
                            <div class="res-white-img"><img src="<?php echo $value['restaurant_logo'] ?>"></div>
                        </div>
                        <div class="col-sm-6 no-padding p-l-15">
                            <div class="rest-top">
                                <div class="res-title"><?php echo $value['restaurant_name'] ?></div>
                                <div class="res-desc"><?php echo $value['cuisineLists'] ?></div>
                            </div>
                            <div class="res-bottom">
                                <div class="col-sm-5 col-xs-6 no-padding"><span class="search-price">Min Price</span><span
                                            class="search-rate">$<?php echo $value['minimum_order'] ?></span></div>
                                <div class="col-sm-3 col-xs-2 no-padding text-right"><span class="search-review"><i
                                                class="fa fa-star" aria-hidden="true"></i>
                                   4.5</span>
                                </div>
                                <div class="col-sm-4 col-xs-4 no-padding text-right"><span class="search-time"><?php echo $value['estimate_time'] ?></span><span
                                            class="search-min">Mins</span></div>
                            </div>
                        </div>
                        <div class="res-white-overlay">
                            <div class="small-box">
                            </div>
                        </div>
                    </a>
                    </div>
                </div>
            <?php }
        }?>
    </div>
</section>