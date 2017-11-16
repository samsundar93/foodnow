<?= $this->Html->css(PARTNER_CSS.'bootstrap.css') ?>
<?= $this->Html->css(PARTNER_CSS.'slick.css') ?>
<?= $this->Html->css(PARTNER_CSS.'jquery-ui.css') ?>
<?= $this->Html->css(PARTNER_CSS.'font-awesome.css') ?>
<?= $this->Html->css(PARTNER_CSS.'style.css') ?>
<?= $this->Html->css(PARTNER_CSS.'jquery.dataTables.min.css') ?>
<?= $this->Html->css(PARTNER_CSS.'bootstrap-tagsinput.css') ?>

<link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700" rel="stylesheet">

<?= $this->Html->script([
    PARTNER_JS.'jquery.js'
]); ?>

<?php
    if($controller == 'Restaurants') {
        echo $this->Html->script([
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyAzYAo0kwVA0qTj7iPEedXbAoBx03UI9Lg&libraries=places&region=IN'

        ]);
        //AIzaSyCbF87_gxLI8KUpk3MVmHC9pDlqoYWyuNQ

    }

?>
