<div class="admin-sidebar">
    <div class="sidemenu-title">Seller Details</div>
    <ul class="side-menu">
        <li class="<?php echo ($controller == 'Users' && $action == 'dashboard') ? 'buyer-active' : '' ?>"><a href="<?php echo PARTNER_BASE_URL ?>users/dashboard">Dashboard</a></li>
        <li class="<?php echo ($controller == 'Users' && $action == 'changepassword') ? 'buyer-active' : '' ?>"><a href="<?php echo PARTNER_BASE_URL ?>users/changepassword">Change Password</a></li>
    </ul>

    <div class="sidemenu-title">Manage Category</div>
    <ul class="side-menu">

        <li class="<?php echo ($controller == 'Category') ? 'buyer-active' : '' ?>"><a href="<?php echo PARTNER_BASE_URL ?>category">Category</a></li>

        <li class="<?php echo ($controller == 'Cuisines') ? 'buyer-active' : '' ?>"><a href="<?php echo PARTNER_BASE_URL ?>cuisines">Sub Category</a></li>

        <!--<li class="<?php /*echo ($controller == 'Addons') ? 'buyer-active' : '' */?>"><a href="<?php /*echo PARTNER_BASE_URL */?>addons">Addons</a></li>-->
    </ul>

    <div class="sidemenu-title">Restaurant</div>

    <ul class="side-menu">
        <li class="<?php echo ($controller == 'Restaurants' && $action == 'index') ? 'buyer-active' : '' ?>"><a href="<?php echo PARTNER_BASE_URL ?>restaurants">Manage Restaurant</a></li>
        <li class="<?php echo ($controller == 'Menus') ? 'buyer-active' : '' ?>"><a href="<?php echo PARTNER_BASE_URL ?>menus">Manage Menus</a></li>
    </ul>

    <div class="sidemenu-title">Orders</div>

    <ul class="side-menu">
        <li class="<?php echo ($controller == 'Restaurants' && $action == 'index') ? 'buyer-active' : '' ?>"><a href="<?php echo PARTNER_BASE_URL ?>restaurants">Pending</a></li>
        <li class="<?php echo ($controller == 'Menus') ? 'buyer-active' : '' ?>"><a href="<?php echo PARTNER_BASE_URL ?>menus">Processing</a></li>
        <li class="<?php echo ($controller == 'Menus') ? 'buyer-active' : '' ?>"><a href="<?php echo PARTNER_BASE_URL ?>menus">Completed</a></li>
        <li class="<?php echo ($controller == 'Menus') ? 'buyer-active' : '' ?>"><a href="<?php echo PARTNER_BASE_URL ?>menus">Failed</a></li>
    </ul>


</div>