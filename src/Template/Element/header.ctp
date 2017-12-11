<?php if($controller == 'Users') { ?>
    <header class="header">
        <div class="container">
            <div class="header-menu">
                <a class="logo" href="<?php echo BASE_URL ?>"><img src="<?php echo BASE_URL ?>/images/logo.png"></a>

                <span id="menu-icon">
                <span class="pull-right visible-xs menubar" onclick="openNav()"><i class="fa fa-bars" aria-hidden="true"></i></span></span>
                <ul class="top-menu hidden-xs">
                    <?php if(isset($logginUser) && empty($logginUser)) { ?>
                        <li><a href="" data-toggle="modal" data-target="#login_popup" class="" >Login</a></li>
                        <li><a href="" data-toggle="modal" data-target="#signup_popup" class="">Signup</a></li>
                    <?php }else { ?>
                        <li><a href="<?php echo BASE_URL ?>myaccount" class="" >Welcome <?php echo $this->request->session()->read('customername')  ?></a></li>
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
        <ul id="mobilemenu" class="visible-xs">
          <?php if(isset($logginUser) && empty($logginUser)) { ?>
                        <li><a href="" data-toggle="modal" data-target="#login_popup" class="" >Login</a></li>
                        <li><a href="" data-toggle="modal" data-target="#signup_popup" class="">Signup</a></li>
                    <?php }else { ?>
                        <li><a href="" class="" >Welcome <?php echo $this->request->session()->read('customername')  ?></a></li>
                        <li><a href="<?php echo BASE_URL ?>/users/logout" class="">Logout</a></li>
                    <?php } ?>
        </ul>
    </header>
    <input type="hidden" id="countryCode">


<?php }else if($controller == 'Restaurants') { ?>
    <header class="search-header">
        <div class="breadcrump">
            <div class="container">
                <div class="col-sm-6 col-xs-8 padding-5">Download Our app</div>
                <div class="col-sm-6 pull-right text-right">
                  <span id="menu-icon">
                <span class="pull-right visible-xs menubar second-menubar" onclick="otheropenNav()"><i class="fa fa-bars" aria-hidden="true"></i></span></span>
                    <ul class="search-header-ul hidden-xs">
                        <?php if(isset($logginUser) && empty($logginUser)) { ?>
                            <li><a href="" data-toggle="modal" data-target="#login_popup" class="" >Login</a></li>
                            <li><a href="" data-toggle="modal" data-target="#signup_popup" class="">Signup</a></li>
                        <?php }else { ?>
                            <li><a href="<?php echo BASE_URL ?>myaccount" class="" >Welcome <?php echo $this->request->session()->read('customername')  ?></a></li>
                            <li><a href="<?php echo BASE_URL ?>/users/logout" class="">Logout</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <ul id="second-mobilemenu" class="visible-xs">
          <?php if(isset($logginUser) && empty($logginUser)) { ?>
                        <li><a href="" data-toggle="modal" data-target="#login_popup" class="" >Login</a></li>
                        <li><a href="" data-toggle="modal" data-target="#signup_popup" class="">Signup</a></li>
                    <?php }else { ?>
                        <li><a href="" class="" >Welcome <?php echo $this->request->session()->read('customername')  ?></a></li>
                        <li><a href="<?php echo BASE_URL ?>/users/logout" class="">Logout</a></li>
                    <?php } ?>
        </ul>
        <div class="searchpage-search">
            <div class="container">
                <div class="col-sm-2">
                    <a href="<?php echo BASE_URL ?>" class="search-logo"><img src="<?php echo BASE_URL ?>/images/logo.png"></a>
                </div>
                <div class="col-sm-8 res-header-section">
                    <div class="col-sm-4 col-xs-12 no-padding">
                        <label class="form-control serach-form-control search-label m-b-5">
                            <div class="serach-label-title">Delivery Location <i class="fa fa-angle-down"></i></div>
                            <div class="serach-label-loc"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                <?php echo $this->request->session()->read('searchLocation') ?>
                            </div>
                        </label>
                    </div>
                    <div class="col-sm-8 col-xs-12 no-padding serach-input">
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
                <div class="col-sm-2 col-xs-12">
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
               <div class="col-sm-6 col-xs-8 padding-5">Download Our app</div>
               <div class="col-sm-6 col-xs-4 pull-right text-right">
                  <span id="menu-icon">
                <span class="pull-right visible-xs menubar second-menubar" onclick="otheropenNav()"><i class="fa fa-bars" aria-hidden="true"></i></span></span>
                  <ul class="search-header-ul hidden-xs">
                     <li><a href="">Help & Support</a></li>
                      <?php if(isset($logginUser) && empty($logginUser)) { ?>
                          <li><a href="" data-toggle="modal" data-target="#login_popup" class="" >Login</a></li>
                          <li><a href="" data-toggle="modal" data-target="#signup_popup" class="">Signup</a></li>
                      <?php }else { ?>
                          <li><a href="<?php echo BASE_URL ?>myaccount" class="" >Welcome <?php echo $this->request->session()->read('customername')  ?></a></li>
                          <li><a href="<?php echo BASE_URL ?>/users/logout" class="">Logout</a></li>
                      <?php } ?>
                  </ul>
               </div>
            </div>
         </div>
         <div class="cartpage-search">
            <div class="container">
               <div class="col-sm-2 col-xs-12">
                  <a href="<?php echo BASE_URL ?>" class="search-logo"><img src="<?php echo BASE_URL ?>/images/logo.png"></a>
               </div>
            </div>
         </div>
         <section class="restaurant-head-sec">
            <div class="container">
              <div class="col-sm-2 col-xs-12 no-padding-right">
                <div class="res-image">
                <img class="img-thumbnail" src="<?php echo $restaurantDetails['restaurant_logo'] ?>">
                </div>
              </div>
               <div class="col-sm-6 col-xs-12 p-t-b-15 text-xs-center">
                  <div class="cart-res-name">
                      <?php echo $restaurantDetails['restaurant_name'] ?>
                  </div>
                  <div class="cart-res-cusine">Cusines: <?php echo $cuisinesList; ?></div>
                  <div class="cart-review-div">
                     <span class="search-review pull-left"><i class="fa fa-star" aria-hidden="true"></i>4.5</span>
                     <span class="cart-del-time"><span class="search-time"><?php echo $restaurantDetails['estimate_time'] ?></span><span class="search-min">Mins</span>
                     </span>
                  </div>
               </div>
               <div class="col-sm-4 col-xs-12 text-center">
                 <div class="min-amount">Minimum order amount is $ <?php echo $minimumOrderAmount; ?></div>
               </div>
              
            </div>
         </section>
         <ul id="second-mobilemenu" class="visible-xs">
                     <li><a href="">Help & Support</a></li>
                      <?php if(isset($logginUser) && empty($logginUser)) { ?>
                          <li><a href="" data-toggle="modal" data-target="#login_popup" class="" >Login</a></li>
                          <li><a href="" data-toggle="modal" data-target="#signup_popup" class="">Signup</a></li>
                      <?php }else { ?>
                          <li><a href="<?php echo BASE_URL ?>myaccount" class="" >Welcome <?php echo $this->request->session()->read('customername')  ?></a></li>
                          <li><a href="<?php echo BASE_URL ?>/users/logout" class="">Logout</a></li>
                      <?php } ?>
                  </ul>
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
                            <li><a href="<?php echo BASE_URL ?>myaccount" class="" >Welcome <?php echo $this->request->session()->read('customername')  ?></a></li>
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
<?php if($controller == 'Myaccount') { ?>
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
                            <li><a href="<?php echo BASE_URL ?>myaccount" class="" >Welcome <?php echo $this->request->session()->read('customername')  ?></a></li>
                            <li><a href="<?php echo BASE_URL ?>/users/logout" class="">Logout</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="myaccount-search-header">
            <div class="container">
                <div class="col-sm-2">
                    <a href="<?php echo BASE_URL ?>" class="search-logo"><img src="<?php echo BASE_URL ?>/images/logo.png"></a>
                </div>
            </div>
        </div>
    </header>
<?php } ?>
<script>
    $(document).ready(function () {


    })
</script>

