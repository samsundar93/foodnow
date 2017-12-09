<?php
    echo $this->Html->script([
        /*FRONT_JS.'jquery.min.js',
        FRONT_JS.'bootstrap.min.js',
        FRONT_JS.'jquery-ui.js',*/
        FRONT_JS.'slick.min.js',
        FRONT_JS.'bootstrap-select.min.js',
        FRONT_JS.'popModal.min.js',
        FRONT_JS.'enscroll.js',
        FRONT_JS.'common.js',
        FRONT_JS.'page-scroll.js',
        FRONT_JS.'jquery.timepicker.min.js',
        FRONT_JS.'pusher.js'
    ]);
?>

<?php

if($controller == 'Users' || $controller == 'Restaurants') {
    echo $this->Html->script(
        [
            FRONT_JS.'address.js'
        ]
    );
}

if($controller == 'Checkouts') {
    echo $this->Html->script(
        [
            FRONT_JS.'checkout.js',
            'https://checkout.stripe.com/checkout.js'
        ]
    );
}

?>
