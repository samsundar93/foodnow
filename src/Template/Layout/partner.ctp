<!DOCTYPE HTML>
<html>
<head>
    <?= $this->element('partner/css') ?>
</head>
<body>
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<script>
    var jsSitePartner = "<?php echo PARTNER_BASE_URL; ?>";
</script>
<div id="wrapper">
    <?php if($action != 'login') { ?>
        <?php
        echo $this->element('partner/header');
        ?>

        <?php echo $this->element('partner/leftside'); ?>
    <?php } ?>

    <?php echo $this->Flash->render(); ?>
    <?= $this->fetch('content') ?>

    <?= $this->element('partner/footer') ?>
    <?= $this->element('partner/js') ?>

</body>
</html>