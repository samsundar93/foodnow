<?php if($controller == 'Users') { ?>
    <header class="header">
        <div class="container">
            <div class="header-menu">
                <a class="logo"><img src="<?php echo BASE_URL ?>/images/logo.png"></a>
                <ul class="top-menu">
                    <?php if(isset($logginUser) && empty($logginUser)) { ?>
                        <li><a href="" data-toggle="modal" data-target="#login_popup" class="" >Login</a></li>
                        <li><a href="" data-toggle="modal" data-target="#signup_popup" class="">Signup</a></li>
                    <?php }else { ?>
                        <li><a href="" class="" >Welcome <?php echo $this->request->session()->read('customername')  ?></a></li>
                        <li><a href="<?php echo BASE_URL ?>/users/logout" class="">Logout</a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="header-cont">
                <div class="header-title">Order from restaurants near you</div>
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="col-sm-8 no-padding banner-input">
                        <input autocomplete="off" id="searchLocation" type="text" class="form-control my-form-control" placeholder="Eg: Anna Nagar, Chennai, Tamil Nadu">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <?= $this->Form->input('enterSearch',[
                            'type' => 'hidden',
                            'id'   => 'enterSearch',
                            'class' => 'form-control my-from-control',
                            'label' => false
                        ]) ?>
                        <span class="addressErr"></span>
                    </div>
                    <div class="col-sm-4 no-padding">
                        <button onclick="return searchLocation()" class="btn home-search-btn form-control">SHOW RESTAURANTS</button>
                    </div>
                    <div class="header-sub-cont">We deliver in all location in your country</div>
                </div>
            </div>
        </div>
    </header>

<?php }else if($controller == 'Restaurants') { ?>
    <header class="search-header">
        <div class="breadcrump">
            <div class="container">
                <div class="col-sm-6">Download Our app</div>
                <div class="col-sm-6 pull-right text-right">
                    <ul class="search-header-ul">
                        <?php if(isset($logginUser) && empty($logginUser)) { ?>
                            <li><a href="" data-toggle="modal" data-target="#login_popup" class="" >Login</a></li>
                            <li><a href="" data-toggle="modal" data-target="#signup_popup" class="">Signup</a></li>
                        <?php }else { ?>
                            <li><a href="" class="" >Welcome <?php echo $this->request->session()->read('customername')  ?></a></li>
                            <li><a href="<?php echo BASE_URL ?>/users/logout" class="">Logout</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="searchpage-search">
            <div class="container">
                <div class="col-sm-2">
                    <a href="<?php echo BASE_URL ?>" class="search-logo"><img src="<?php echo BASE_URL ?>/images/logo.png"></a>
                </div>
                <div class="col-sm-8 res-header-section">
                    <div class="col-sm-4 no-padding">
                        <label class="form-control serach-form-control search-label">
                            <div class="serach-label-title">Delivery Location <i class="fa fa-angle-down"></i></div>
                            <div class="serach-label-loc"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                <?php echo $this->request->session()->read('searchLocation') ?>
                            </div>
                        </label>
                    </div>
                    <div class="col-sm-8 no-padding serach-input">
                        <input type="text" class="form-control serach-form-control" placeholder="Search for Restaurants">
                        <i class="fa fa-search"></i>
                    </div>

                    <div class="restaurant-search-location" style="display:none;">
                      <div class="add-search-title">SEARCH ANOTHER LOCATION</div>
                      <div class="add-search-box">
                        <input type="text" class="form-control" id="searchLocation" placeholder="Enter delivery location (Area, Street or Landmark)">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                      </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <button class="btn seachpage-seach-btn">Search</button>
                </div>
            </div>
        </div>
    </header>
<?php } ?>

<?php if($controller == 'Menus') { ?>
    <header class="search-header">
         <div class="breadcrump">
            <div class="container">
               <div class="col-sm-6">Download Our app</div>
               <div class="col-sm-6 pull-right text-right">
                  <ul class="search-header-ul">
                     <li><a href="">Help & Support</a></li>
                      <?php if(isset($logginUser) && empty($logginUser)) { ?>
                          <li><a href="" data-toggle="modal" data-target="#login_popup" class="" >Login</a></li>
                          <li><a href="" data-toggle="modal" data-target="#signup_popup" class="">Signup</a></li>
                      <?php }else { ?>
                          <li><a href="" class="" >Welcome <?php echo $this->request->session()->read('customername')  ?></a></li>
                          <li><a href="<?php echo BASE_URL ?>/users/logout" class="">Logout</a></li>
                      <?php } ?>
                  </ul>
               </div>
            </div>
         </div>
         <div class="cartpage-search">
            <div class="container">
               <div class="col-sm-2">
                  <a href="<?php echo BASE_URL ?>" class="search-logo"><img src="<?php echo BASE_URL ?>/images/logo.png"></a>
               </div>
            </div>
         </div>
         <section class="restaurant-head-sec">
            <div class="container">
              <div class="col-sm-2 no-padding-right">
                <div class="res-image">
                <img class="img-thumbnail" src="<?php echo BASE_URL ?>/images/res.jpg">
                </div>
              </div>
               <div class="col-sm-4">
                  <div class="cart-res-name">
                      <?php echo $restaurantDetails['restaurant_name'] ?>
                  </div>
                  <div class="cart-res-cusine">Cusines: <?php echo $cuisinesList; ?></div>
                  <div class="cart-review-div">
                     <span class="search-review pull-left"><i class="fa fa-star" aria-hidden="true"></i>4.5</span>
                     <span class="cart-del-time"><span class="search-time">39</span><span class="search-min">Mins</span>
                     </span>
                  </div>
               </div>
              
            </div>
         </section>
      </header>
<?php } ?>


<?php if($controller == 'Checkouts') { ?>
    <header class="search-header">
        <div class="breadcrump-checkout">
            <div class="container">
                <div class="col-sm-6">Download Our app</div>
                <div class="col-sm-6 pull-right text-right">
                    <ul class="search-header-ul">
                        <?php if(isset($logginUser) && empty($logginUser)) { ?>
                            <li><a href="" data-toggle="modal" data-target="#login_popup" class="" >Login</a></li>
                            <li><a href="" data-toggle="modal" data-target="#signup_popup" class="">Signup</a></li>
                        <?php }else { ?>
                            <li><a href="" class="" >Welcome <?php echo $this->request->session()->read('customername')  ?></a></li>
                            <li><a href="<?php echo BASE_URL ?>/users/logout" class="">Logout</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="searchpage-search-checkout">
            <div class="container">
                <div class="col-sm-2">
                    <a href="<?php echo BASE_URL ?>" class="search-logo"><img src="<?php echo BASE_URL ?>/images/logo.png"></a>
                </div>
            </div>
        </div>
    </header>
<?php } ?>

