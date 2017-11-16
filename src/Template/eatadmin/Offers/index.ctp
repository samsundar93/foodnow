<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Offer Management</h4>
            </div>
            <a class="btn btn-info addnewbtn pull-right" href="<?php echo ADMIN_BASE_URL; ?>offers/addedit/">
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
                                <th>Restaurant Name</th>
                                <th>Percentage</th>
                                <th>Price</th>
                                <th>From</th>
                                <th>To</th>
                                <th class="no-sort">Added Date</th>
                                <th class="no-sort text-center">Status</th>
                                <th class="no-sort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty(count($offerList))) {
                                foreach ($offerList as $key=>$list){?>
                                    <tr>
                                        <td><?php echo $key+1;?></td>
                                        <td>
                                            <?php echo $list['restaurant_id'];?>
                                        </td>
                                        <td>
                                            <?php echo $list['offer_percentage'];?>
                                        </td>
                                        <td>
                                            <?php echo $list['offer_price'];?>
                                        </td>
                                        <td>
                                            <?php
                                            echo date("d-M-Y", strtotime($list['valid_from'])); ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo date("d-M-Y", strtotime($list['valid_to'])); ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo date("d-M-Y H:i:s", strtotime($list['created'])); ?>
                                        </td>
                                        <td align="center" id="status_<?php echo $list['id'];?>">
                                            <?php if($list['status'] == 1){?>
                                                <button class="btn btn-icon-toggle active" type="button" onclick="changeStatus('<?= $list['id'] ?>', '0', 'status', 'customers/ajaxaction', 'custstatuschange')">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            <?php }else {?>
                                                <button class="btn btn-icon-toggle deactive" type="button" onclick="changeStatus('<?= $list['id'] ?>', '1', 'status', 'customers/ajaxaction', 'custstatuschange')">
                                                    <i class="fa fa-close"></i>
                                                </button>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <!--<a href="<?php /*echo ADMIN_BASE_URL; */?>customers/addressmanage/<?php /*echo $list['id'];*/?>" class="btn btn-info">AddressBook</a>-->

                                            <a href="<?php echo ADMIN_BASE_URL; ?>customers/addedit/<?php echo $list['id'];?>" class="btn btn-icon-toggle" data-original-title="Edit" data-placement="top" data-toggle="tooltip" id="<?php echo $list['id']; ?>" >
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button class="btn btn-icon-toggle" data-original-title="Delete" data-placement="top" data-toggle="tooltip" type="button" id="<?php echo $list['id']; ?>" onclick="return deleteRecord(<?php echo $list['id']; ?>, 'customers/deletecust', 'customers', '', 'catTable')">

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