<?php if($action == 'restaurantMenuStatus' && $field == 'status') { ?>
    <?php if($status == 'active'){?>
        <div class="label label-table label-success">
        <a class="statusColor" href="javascript:;" onclick="changeStatus('<?= $id ?>', '0', 'status', 'menus/ajaxaction', 'restaurantMenuStatus')"><i class="fa fa-check"></i></a>
        </div>
    <?php }else {?>
        <div class="label label-table label-danger">
            <a class="statusColor" href="javascript:;" onclick="changeStatus('<?= $id ?>', '1', 'status', 'menus/ajaxaction', 'restaurantMenuStatus')"><i class="fa fa-close"></i></a>
        </div>
    <?php }?>

<?php exit();} ?>