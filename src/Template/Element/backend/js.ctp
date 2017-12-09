<?php
echo $this->Html->script([
    ADMIN_JS.'jquery-ui.js',
    ADMIN_JS.'jquery.dataTables.min.js',
    ADMIN_JS.'jquery.slimscroll.js',
    ADMIN_JS.'raphael-min.js',
    ADMIN_JS.'sidebar-nav.min.js',
    ADMIN_JS.'jquery.sparkline.min.js',
    ADMIN_JS.'jquery.peity.min.js',
    ADMIN_JS.'jquery.peity.init.js',
    ADMIN_JS.'custom.min.js',
    //ADMIN_JS.'jQuery.style.switcher.js',
    ADMIN_JS.'cbpFWTabs.js',
    ADMIN_JS.'jasny-bootstrap.js',
    ADMIN_JS.'custom.js',
    ADMIN_JS.'jquery.validate.min.js',
    ADMIN_JS.'dataTables.scroller.min.js',
    ADMIN_JS.'common.js',
    FRONT_JS.'pusher.js'
    ]);
?>

<?php
    if($controller == 'Orders' || $controller == 'Reports') {
        echo $this->Html->script([
            ADMIN_JS.'dataTables.buttons.min.js',
            ADMIN_JS.'buttons.flash.min.js',
            ADMIN_JS.'buttons.html5.min.js',
            ADMIN_JS.'jQuery.style.switcher.js',
        ]);
    }

    if($controller == 'Outlets' || $controller == 'Customers'){
        echo $this->Html->script([
            ADMIN_JS.'onlyaddress.js'
        ]);
    }

    if($controller == 'Category'){
        echo $this->Html->script([
            ADMIN_JS.'jquery.tablednd.js',
        ]);
    }

    if($controller == 'Outlets' || $controller == 'Offers'){
        echo $this->Html->script([
            ADMIN_JS.'jquery.ui.js',
        ]);
    }

    /*if($controller == 'Offers') {
        echo $this->Html->script([
            ADMIN_JS . 'bootstrap-datepicker.js',
        ]);
    }*/
?>



