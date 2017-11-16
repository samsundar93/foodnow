<?php if($action == 'catstatuschange' && $field == 'status') { ?>
    <?php if($status == 'active'){?>
        <button class="btn btn-icon-toggle active" type="button" onclick="changeStatus('<?= $id ?>', '0', '<?= $field ?>', 'category/ajaxaction', 'catstatuschange')">
            <i class="fa fa-check"></i>
        </button>
    <?php }else {?>
        <button class="btn btn-icon-toggle deactive" type="button" onclick="changeStatus('<?= $id ?>', '1', '<?= $field ?>', 'category/ajaxaction', 'catstatuschange')">
            <i class="fa fa-close"></i>
        </button>
    <?php }?>
    <?php exit();} ?>

<?php if($action == 'Categories') { ?>
    <table id="catTable" class="table table-striped">
        <thead>
        <tr>
            <th>S. No</th>
            <th>Category Name</th>
            <th>Restaurant Name</th>
            <th>Sort By</th>
            <th>Added Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(isset($categoryList) && !empty($categoryList)) {
            foreach($categoryList as $key => $value) { ?>
                <tr id="<?php echo $value['id']; ?>">
                    <td><?php echo $key +1; ?></td>
                    <td><?php echo $value['catname']; ?></td>
                    <td><?php echo $value['restaurant']['restaurant_name']; ?></td>
                    <td id="sort_order_<?php echo $value['id'];?>"><?php echo $value['sortorder']; ?></td>
                    <td><?php
                        echo date("d-M-Y H:i:s", strtotime($value['created'])); ?></td>
                    <td align="center" id="status_<?php echo $value['id'];?>">
                        <?php if($value['status'] == 1){?>
                            <button class="btn btn-icon-toggle active" type="button" onclick="changeStatus('<?= $value['id'] ?>', '0', 'status', 'category/ajaxaction', 'catstatuschange')">
                                <i class="fa fa-check "></i>
                            </button>
                        <?php }else {?>
                            <button class="btn btn-icon-toggle deactive" type="button" onclick="changeStatus('<?= $value['id'] ?>', '1', 'status', 'category/ajaxaction', 'catstatuschange')">
                                <i class="fa fa-close"></i>
                            </button>
                        <?php }?>
                    </td>
                    <td>
                        <a href="<?php echo ADMIN_BASE_URL; ?>category/addedit/<?php echo $value['id'];?>" class="btn btn-icon-toggle" data-original-title="Edit" data-placement="top" data-toggle="tooltip" id="<?php echo $value['id']; ?>" >
                            <i class="fa fa-pencil"></i>
                        </a>
                        <button class="btn btn-icon-toggle" data-original-title="Delete" data-placement="top" data-toggle="tooltip" type="button" id="<?php echo $value['id']; ?>" onclick="return deleteRecord(<?php echo $value['id']; ?>, 'category/deletecate', 'Categories', '', 'catTable')">
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
