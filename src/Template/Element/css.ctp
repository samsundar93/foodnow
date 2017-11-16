<?php
echo $this->Html->css([
        FRONT_CSS.'bootstrap.min.css',
        FRONT_CSS.'font-awesome.min.css',
        FRONT_CSS.'slick.css',
        FRONT_CSS.'popModal.min.css',
        FRONT_CSS.'style.css',
        FRONT_CSS.'slick-theme.css',
]);

if($controller == 'Users' || $controller == 'Restaurants'|| $controller == 'Checkouts') {
    echo $this->Html->script([
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyAzYAo0kwVA0qTj7iPEedXbAoBx03UI9Lg&libraries=places&region=IN'

    ]);
    //AIzaSyCbF87_gxLI8KUpk3MVmHC9pDlqoYWyuNQ

}

?>



