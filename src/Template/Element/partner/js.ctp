<?= $this->Html->script([
    PARTNER_JS.'jquery.js',
    PARTNER_JS.'bootstrap.min.js',
    PARTNER_JS.'jquery-ui.min.js',
    PARTNER_JS.'slick.min.js',
    PARTNER_JS.'jquery.dataTables.min.js',
    PARTNER_JS.'common.js',
    PARTNER_JS.'bootstrap-tagsinput.js',
    PARTNER_JS.'product.js',
]); ?>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({});
    } );
</script>

<?php
    if($controller == 'Restaurants') {

        echo $this->Html->script(
            [
                PARTNER_JS.'restaurant.js'
            ]
        );
    }

?>

