<?php
    echo $this->Html->css([
        ADMIN_CSS.'animate.css',
        ADMIN_CSS.'bootstrap.min.css',
        ADMIN_CSS.'morris.css',
        ADMIN_CSS.'sidebar-nav.min.css',
        ADMIN_CSS.'style.css',
        ADMIN_CSS.'gray-dark.css',
        ADMIN_CSS.'jquery.dataTables.min.css',
        ADMIN_CSS.'scroller.dataTables.min.css',
    ]);
?>


<?php
    echo $this->Html->script([
        ADMIN_JS.'jquery.js',
        ADMIN_JS.'bootstrap.min.js'
        ]);

        if($controller == 'Restaurants' || $controller == 'Customers'|| $controller == 'Address'){
            echo  $this->Html->script( 'https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyAzYAo0kwVA0qTj7iPEedXbAoBx03UI9Lg&sensor=false&libraries=places,geometry'
            );
        }
?>

<?php
    if($controller == 'Orders' || $controller == 'Reports') {
        echo $this->Html->css([
            ADMIN_CSS.'buttons.dataTables.min.css'
        ]);
    }
?>


<?php
    if($controller == 'Outlets' || $controller == 'Offers'){
        echo $this->Html->css([
            ADMIN_CSS.'jquery.ui.css',
        ]);
    }

    /*if($controller == 'Offers') {
        echo $this->Html->css([
            ADMIN_CSS . 'bootstrap-datepicker.css',
        ]);
    }*/
?>


