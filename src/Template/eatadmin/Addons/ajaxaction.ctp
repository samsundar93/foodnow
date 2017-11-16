<?php if($action == 'addonsstatuschange' && $field == 'status') { ?>
    <?php if($status == 'active'){?>
        <button class="btn btn-icon-toggle active" type="button" onclick="changeStatus('<?= $id ?>', '0', '<?= $field ?>', 'addons/ajaxaction', 'addonsstatuschange')">
            <i class="fa fa-check"></i>
        </button>
    <?php }else {?>
        <button class="btn btn-icon-toggle deactive" type="button" onclick="changeStatus('<?= $id ?>', '1', '<?= $field ?>', 'addons/ajaxaction', 'addonsstatuschange')">
            <i class="fa fa-close"></i>
        </button>
    <?php }?>
    <?php exit();} ?>

<?php if($action == 'Addons') { ?>
    <table id="catTable" class="table table-hover table-striped">
        <thead>
        <tr>
            <th>S. No</th>
            <th>Category Name</th>
            <th>Restaurant Name</th>
            <th>Added Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(isset($addonsList) && !empty($addonsList)) {
            foreach($addonsList as $key => $value) { ?>
                <tr id="<?php echo $value['id']; ?>">
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $value['category']['catname']; ?></td>
                    <td><?php echo $value['restaurant']['restaurant_name']; ?></td>
                    <td><?php
                        echo date("d-M-Y H:i:s", strtotime($value['created'])); ?></td>
                    <td align="center" id="status_<?php echo $value['id']; ?>">
                        <?php if ($value['status'] == 1) { ?>
                            <button class="btn btn-icon-toggle active" type="button"
                                    onclick="changeStatus('<?= $value['id'] ?>', '0', 'status', 'addons/ajaxaction', 'addonsstatuschange')">
                                <i class="fa fa-check "></i>
                            </button>
                        <?php } else { ?>
                            <button class="btn btn-icon-toggle deactive" type="button"
                                    onclick="changeStatus('<?= $value['id'] ?>', '1', 'status', 'addons/ajaxaction', 'addonsstatuschange')">
                                <i class="fa fa-close"></i>
                            </button>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="<?php echo ADMIN_BASE_URL; ?>addons/addedit/<?php echo $value['id']; ?>"
                           class="btn btn-icon-toggle" data-original-title="Edit"
                           data-placement="top" data-toggle="tooltip"
                           id="<?php echo $value['id']; ?>">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <button class="btn btn-icon-toggle" data-original-title="Delete"
                                data-placement="top" data-toggle="tooltip" type="button"
                                id="<?php echo $value['id']; ?>"
                                onclick="return deleteRecord(<?php echo $value['id']; ?>, 'addons/deleteaddons', 'Addons', '', 'catTable')">
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
