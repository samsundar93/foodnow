<header>
    <section class="header-top">
        <div class="container">
            <a class="logo" href="<?php echo PARTNER_BASE_URL ?>"><img src="<?php echo BASE_URL ?>images/logo.png"></a>
            <ul class="pull-right">
                <?php if(isset($logginUser) && empty($logginUser)) { ?>
                    <li><a href="buyer-login.php"><i class="fa fa-sign-in"></i> Login</a></li>
                    <li><a href="buyer-signup.php"><i class="fa fa-user-plus"></i> Register</a></li>
                <?php }else { ?>
                    <li><a href="<?php echo PARTNER_BASE_URL ?>users/logout" class=""><i class="fa fa-sign-out"></i>Logout</a></li>
                <?php } ?>
            </ul>
        </div>
    </section>

</header>
<nav>

</nav>