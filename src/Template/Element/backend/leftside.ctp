<div class="navbar-default sidebar" role="navigation">

    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <div>
                    <img src="<?php echo ADMIN_IMG ?>genu.jpg" alt="user-img" class="img-circle">
                </div>
            </div>
        </div>

        <ul class="nav" id="side-menu">
            <li>
                <a href="<?php echo ADMIN_BASE_URL ?>users/dashboard/" class="waves-effect<?php echo ($controller == 'UsersContoller') ? 'active' : '' ?>">
                    <i class="linea-icon linea-basic fa-fw" data-icon="v"></i>
                    <span class="hide-menu"> Dashboard </span>
                </a>
            </li>

            <li>
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="fa fa-cog"></i>
                    <span class="hide-menu">Setting
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li> <a href="<?php echo ADMIN_BASE_URL?>users/site/">Site Setting</a></li>
                    <li> <a href="<?php echo ADMIN_BASE_URL?>users/contact/">Contact Setting</a></li>
                    <li> <a href="<?php echo ADMIN_BASE_URL?>users/location/">Location Setting</a></li>
                    <li> <a href="<?php echo ADMIN_BASE_URL?>users/payment/">Payment Setting</a></li>
                    <li> <a href="<?php echo ADMIN_BASE_URL?>users/sms/">SMS Setting</a></li>
                </ul>
            </li>

            <li>
                <a href="<?php echo ADMIN_BASE_URL ?>category" class="waves-effect">
                    <i class="fa fa-tags"></i>
                    <span class="hide-menu">Category
                        <!--<span class="fa arrow"></span>-->
                    </span>
                </a>
            </li>

            <li>
                <a href="<?php echo ADMIN_BASE_URL ?>addons" class="waves-effect">
                    <i class="fa fa-gift"></i>
                    <span class="hide-menu">Addons</span>
                </a>
            </li>

            <li>
                <a href="<?php echo ADMIN_BASE_URL ?>cuisines" class="waves-effect">
                    <i class="fa fa-tags"></i>
                    <span class="hide-menu">Cuisines
                        <!--<span class="fa arrow"></span>-->
                    </span>
                </a>
            </li>


             <li>
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="fa fa-ticket"></i>
                    <span class="hide-menu">Restaurant
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li> <a href="<?php echo ADMIN_BASE_URL?>restaurants/">Manage Restaurant</a></li>
                    <li> <a href="<?php echo ADMIN_BASE_URL?>restaurants/menu">Restaurant Menu</a></li>
                    <li> <a href="<?php echo ADMIN_BASE_URL?>offers/">Restaurant Offer</a></li>
                    <li> <a href="<?php echo ADMIN_BASE_URL?>restaurants/review/">Restaurant Review</a></li>
                </ul>
            </li>

            <li>
                <a href="<?php echo ADMIN_BASE_URL ?>customers" class="waves-effect">
                    <i class="fa fa-gift"></i>
                    <span class="hide-menu">Customer</span>
                </a>
            </li>

            <li>
                <a href="<?php echo ADMIN_BASE_URL ?>address" class="waves-effect">
                    <i class="fa fa-gift"></i>
                    <span class="hide-menu">Addressbook</span>
                </a>
            </li>

            <li>
                <a href="javascript:void(0);" class="waves-effect hide">
                    <i class="fa fa-user"></i>
                    <span class="hide-menu">Followers
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li> <a href="<?php echo ADMIN_BASE_URL ?>followers/">Followers Management</a></li>
                    <li> <a href="<?php echo ADMIN_BASE_URL ?>followers/addedit/">Follower Add</a></li>
                </ul>
            </li>


            <li>
                <a href="<?php echo ADMIN_BASE_URL ?>orders/" class="waves-effect">
                    <i class="fa fa-reorder"></i>
                    <span class="hide-menu">Orders</span>
                </a>
            </li>
            <li>
                <a href="<?php echo ADMIN_BASE_URL ?>reports/" class="waves-effect">
                    <i class="fa fa-bar-chart"></i>
                    <span class="hide-menu">Reports</span>
                </a>
            </li>
            <li>
                <a href="<?php echo ADMIN_BASE_URL ?>reviews/" class="waves-effect">
                    <i class="fa fa-star-o"></i>
                    <span class="hide-menu">Reviews</span>
                </a>
            </li>

            <li>
                <a href="<?php echo ADMIN_BASE_URL ?>reviews/" class="waves-effect">
                    <i class="fa fa-star-o"></i>
                    <span class="hide-menu">Dispatch</span>
                </a>
            </li>

        </ul>
    </div>
</div>