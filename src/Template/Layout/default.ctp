<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Food Delivery Pickup</title>
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
<!--Start of Zendesk Chat Script-->
<?php if($_SERVER['HTTP_HOST'] != 'localhost'){ ?>
    <script type="text/javascript">
        window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
            d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
        _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
            $.src="https://v2.zopim.com/?5GuWXCIEimv3J3FWy6J5yTx0O4xnSNwy";z.t=+new Date;$.
                type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
    </script>
<?php } ?>

<!--End of Zendesk Chat Script-->
</body>
</html>