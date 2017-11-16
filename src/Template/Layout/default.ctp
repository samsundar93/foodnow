<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LikeEat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <?=
    $this->Html->meta('icon')
    ?>

    <!--Include CSS files-->
    <?=
    $this->element('css')
    ?>

</head>
<body  data-spy="scroll" data-target="#myScrollspy" data-offset="50">

<?php
    echo $this->element('header');
?>
<!--BODY CONTENT START-->
<?php
    echo $this->Flash->render();
?>

<?=
    $this->fetch('content')
?>

<?php
echo $this->element('footer');
?>



<?= $this->element('js') ?>
<script>
    var baseUrl = "<?php echo BASE_URL; ?>";
</script>
</body>
</html>