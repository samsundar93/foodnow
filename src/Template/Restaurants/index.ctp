<section class="search-banner-sec">
    <div class="container">
        <div class="col-xs-12">
            <div class="seacr-banner">
                <div class="seacr-banner-img">
                    <img src="images/searchbanner2.png">
                </div>
                <div class="seacr-banner-img">
                    <img src="images/searchbanner1.png">
                </div>
                <div class="seacr-banner-img">
                    <img src="images/searchbanner3.png">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="filter-searc-sec">
    <div class="container">
        <div class="filter-part-div">
            <div class="col-sm-6">
               <span>FITLTER BY <button class="btn btn-default cusine">Cusine <i class="fa fa-caret-down" aria-hidden="true"></i>
               </button> <button class="btn btn-default">Budget <i class="fa fa-caret-down" aria-hidden="true"></i>
               </button></span>
                <button class="btn btn-default">MoreFilters <i class="fa fa-caret-down" aria-hidden="true"></i>
                </button>
            </div>
            <div class="col-sm-6">
               <span class="pull-right">SORT BY <button class="btn btn-default">Relavance <i class="fa fa-caret-down" aria-hidden="true"></i>
               </button></span>
            </div>
        </div>
        <div class="filter-content-part">
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> American
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> Indian
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> chinease
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> Italy
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> German
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> pasta
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> cafe
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> backery
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> fastfood
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> vegfood
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> Tandoori
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> Grill
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> Soups
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> Desserts
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> Salads
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> American
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> American
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> American
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> American
            </div>
            <div class="col-lg-2 col-sm-3 col-xs-4">
                <input type="checkbox"> American
            </div>
            <div class="col-xs-12">
                <button class="btn cusine-filter-btn">Apply</button>
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
                <div class="col-sm-6">
                    <a href="<?php echo BASE_URL ?>menus/lists/<?php echo $value['id'] ?>">
                        <div class="res-white">
                        <div class="res-opacity"></div>
                        <div class="col-sm-6 no-padding">
                            <div class="res-white-img"><img src="<?php echo BASE_URL ?>backend/images/restaurant/<?php echo $value['restaurant_logo'] ?>"></div>
                        </div>
                        <div class="col-sm-6 no-padding p-l-15">
                            <div class="rest-top">
                                <div class="res-title"><?php echo $value['restaurant_name'] ?></div>
                                <div class="res-desc">American, Fast Food</div>
                            </div>
                            <div class="res-bottom">
                                <div class="col-sm-5 no-padding"><span class="search-price">Min Price</span><span
                                            class="search-rate">$<?php echo $value['minimum_order'] ?></span></div>
                                <div class="col-sm-3 no-padding text-right"><span class="search-review"><i
                                                class="fa fa-star" aria-hidden="true"></i>
                                   4.5</span>
                                </div>
                                <div class="col-sm-4 no-padding text-right"><span class="search-time"><?php echo $value['estimate_time'] ?></span><span
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