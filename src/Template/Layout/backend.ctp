<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php
        echo ($controller == 'Users' && $action == 'dashboard') ? 'DryAdmin' : $controller .' '. $action;
        ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <?=
    $this->Html->meta('icon')
    ?>

    <script>
        var baseUrl = "<?php echo ADMIN_BASE_URL; ?>";
    </script>

    <!--Include CSS files-->
    <?=
    $this->element('backend/css')
    ?>

</head>
<body>

    <?php if($logginUser){ ?>
        <header id="header">
            <?php
            echo $this->element('backend/header');
            ?>
        </header>
        <?php echo $this->element('backend/leftside'); ?>
    <?php } ?>
    <!--BODY CONTENT START-->
    <?php
    echo $this->Flash->render();
    ?>

    <?=
    $this->fetch('content')
    ?>

    <?= $this->element('backend/js') ?>
</body>
</html>