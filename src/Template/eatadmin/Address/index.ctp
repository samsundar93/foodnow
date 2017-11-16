<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Customer Management</h4>
            </div>
            <a class="btn btn-info addnewbtn pull-right" href="<?php echo ADMIN_BASE_URL; ?>address/addedit/">
                <i class="fa fa-plus"></i> Add New
            </a>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <?= $this->Flash->render() ?>
                    <div class="table-responsive" id="ajaxReplace">
                        <table id="catTable" class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th >S. No</th>
                                <th>Customer Name</th>
                                <th>Address Title</th>
                                <th class="no-sort">Added Date</th>
                                <th class="no-sort text-center">Status</th>
                                <th class="no-sort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty(count($addessList))) {
                                foreach ($addessList as $key=>$list) {?>
                                    <tr>
                                        <td><?php echo $key+1;?></td>
                                        <td>
                                            <?php echo $list['customer']['name'];?>
                                        </td>
                                        <td>
                                            <?php echo $list['title'];?>
                                        </td>
                                        <td><?php
                                            echo date("d-M-Y H:i:s", strtotime($list['created'])); ?></td>
                                        <td align="center" id="status_<?php echo $list['id'];?>">
                                            <?php if($list['status'] == 1){?>
                                                <button class="btn btn-icon-toggle active" type="button" onclick="changeStatus('<?= $list['id'] ?>', '0', 'status', 'address/ajaxaction', 'addressstatuschange')">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            <?php }else {?>
                                                <button class="btn btn-icon-toggle deactive" type="button" onclick="changeStatus('<?= $list['id'] ?>', '1', 'status', 'address/ajaxaction', 'addressstatuschange')">
                                                    <i class="fa fa-close"></i>
                                                </button>
                                            <?php }?>
                                        </td>
                                        <td>

                                            <a href="<?php echo ADMIN_BASE_URL; ?>address/addedit/<?php echo $list['id'];?>" class="btn btn-icon-toggle" data-original-title="Edit" data-placement="top" data-toggle="tooltip" id="<?php echo $list['id']; ?>" >
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button class="btn btn-icon-toggle" data-original-title="Delete" data-placement="top" data-toggle="tooltip" type="button" id="<?php echo $list['id']; ?>" onclick="return deleteRecord(<?php echo $list['id']; ?>, 'address/deleteaddress', 'address', '', 'catTable')">

                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php }?>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#catTable').DataTable({
            columnDefs: [ { orderable: false, targets: [-1,-2] } ]
        });
    });
</script>