<?php if($action == 'cuisinestatuschange' && $field == 'status') { ?>
    <?php if($status == 'active'){?>
        <button class="btn btn-icon-toggle active" type="button" onclick="changeStatus('<?= $id ?>', '0', '<?= $field ?>', 'category/ajaxaction', 'cuisinestatuschange')">
            <i class="fa fa-check"></i>
        </button>
    <?php }else {?>
        <button class="btn btn-icon-toggle deactive" type="button" onclick="changeStatus('<?= $id ?>', '1', '<?= $field ?>', 'category/ajaxaction', 'cuisinestatuschange')">
            <i class="fa fa-close"></i>
        </button>
    <?php }?>
    <?php exit();} ?>

<?php if($action == 'Cuisines') { ?>
    <table id="catTable" class="table table-striped">
        <thead>
        <tr>
            <th>S. No</th>
            <th>Cuisine Name</th>
            <th>Added Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(isset($cuisineList) && !empty($cuisineList)) {
            foreach($cuisineList as $key => $value) { ?>
                <tr>
                    <td><?php echo $key +1; ?></td>
                    <td><?php echo $value['cuisine_name']; ?></td>
                    <td><?php
                        echo date("d-M-Y H:i:s", strtotime($value['created'])); ?></td>
                    <td align="center" id="status_<?php echo $value['id'];?>">
                        <?php if($value['status'] == 1){?>
                            <button class="btn btn-icon-toggle active" type="button" onclick="changeStatus('<?= $value['id'] ?>', '0', 'status', 'cuisines/ajaxaction', 'cuisinestatuschange')">
                                <i class="fa fa-check "></i>
                            </button>
                        <?php }else {?>
                            <button class="btn btn-icon-toggle deactive" type="button" onclick="changeStatus('<?= $value['id'] ?>', '1', 'status', 'cuisines/ajaxaction', 'cuisinestatuschange')">
                                <i class="fa fa-close"></i>
                            </button>
                        <?php }?>
                    </td>
                    <td>
                        <a href="<?php echo ADMIN_BASE_URL; ?>cuisines/addedit/<?php echo $value['id'];?>" class="btn btn-icon-toggle" data-original-title="Edit" data-placement="top" data-toggle="tooltip" id="<?php echo $value['id']; ?>" >
                            <i class="fa fa-pencil"></i>
                        </a>
                        <button class="btn btn-icon-toggle" data-original-title="Delete" data-placement="top" data-toggle="tooltip" type="button" id="<?php echo $value['id']; ?>" onclick="return deleteRecord(<?php echo $value['id']; ?>, 'cuisines/deletecate', 'Cuisine', '', 'catTable')">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
    <?php exit(); } ?>
