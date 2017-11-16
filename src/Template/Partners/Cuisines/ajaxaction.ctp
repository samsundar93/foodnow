<?php if($action == 'cuisinestatuschange' && $field == 'status') { ?>
    <?php if($status == 'active'){?>
        <div class="label label-table label-success">
            <a class="statusColor" onclick="changeStatus('<?= $id ?>', '0', '<?= $field ?>', 'cuisines/ajaxaction', 'cuisinestatuschange')">
                <i class="fa fa-check"></i>
            </a>
        </div>
    <?php }else {?>
        <div class="label label-table label-danger">
            <a class="statusColor" type="button" onclick="changeStatus('<?= $id ?>', '1', '<?= $field ?>', 'cuisines/ajaxaction', 'cuisinestatuschange')">
                <i class="fa fa-close"></i>
            </a>
        </div>
    <?php }?>
    <?php exit();} ?>

<?php if($action == 'Cuisines') { ?>
    <table id="myTable" class="table table-striped clearfix">
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
        <?php if(!empty($cuisineList)) { ?>
            <?php foreach ($cuisineList as $key => $value) { ?>
                <tr>
                    <td><?php echo $key+1 ?></td>
                    <td><?php echo $value['cuisine_name'] ?></td>
                    <td id="status_<?php echo $value['id'];?>">
                        <?php if($value['status'] == '0') { ?>
                            <div class="label label-table label-danger">
                                <a class="statusColor" href="javascript:;" onclick="changeStatus('<?= $value['id'] ?>', '1', 'status', 'cuisines/ajaxaction', 'cuisinestatuschange')"><i class="fa fa-close"></i></a>
                            </div>
                        <?php }else { ?>
                            <div class="label label-table label-success">
                                <a class="statusColor" href="javascript:;" onclick="changeStatus('<?= $value['id'] ?>', '0', 'status', 'cuisines/ajaxaction', 'cuisinestatuschange')"><i class="fa fa-check"></i></a>
                            </div>
                        <?php } ?>

                    </td>
                    <td><?php echo date('Y-m-d h:i A', strtotime($value['created'])); ?></td>
                    <td>
                        <a href="<?php echo PARTNER_BASE_URL ?>cuisines/edit/<?php echo $value['id'] ?>"><span class="label label-default label-violet"><i class="fa fa-pencil"></i></span></a>
                        <a data-original-title="Delete" data-placement="top" data-toggle="tooltip" id="<?php echo $value['id']; ?>" onclick="return deleteRecord(<?php echo $value['id']; ?>, 'cuisines/deletecate', 'Category', '', 'myTable')" href=""><span class="label label-danger"><i class="fa fa-trash"></i></span></a>
                    </td>
                </tr>
            <?php }
        }?>
        </tbody>
    </table>
    <?php exit(); } ?>
