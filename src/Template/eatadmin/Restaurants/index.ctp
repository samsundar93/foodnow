<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Restaurant Management</h4>
            </div>
            <a class="btn btn-info addnewbtn addnewbtn pull-right" href="<?php echo ADMIN_BASE_URL; ?>restaurants/addedit/">
                <i class="fa fa-plus"></i> Add New
            </a>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <?= $this->Flash->render() ?>
                    <div class="table-responsive" id="ajaxReplace">
                        <table id="catTable" class="table table-striped">
                            <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Restaurant Name</th>
                                <th>Email</th>
                                <th>Added Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(isset($restaurantList) && !empty($restaurantList)) {
                                foreach($restaurantList as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $key +1; ?></td>
                                        <td><?php echo $value['restaurant_name']; ?></td>
                                        <td><?php echo $value['contact_email']; ?></td>
                                        <td><?php
                                            echo date("d-M-Y H:i:s", strtotime($value['created'])); ?></td>
                                        <td align="center" id="status_<?php echo $value['id'];?>">
                                            <?php if($value['status'] == 1){?>
                                                <button class="btn btn-icon-toggle active" type="button" onclick="changeStatus('<?= $value['id'] ?>', '0', 'status', 'restaurants/ajaxaction', 'restaurantStatus')">
                                                    <i class="fa fa-check "></i>
                                                </button>
                                            <?php }else {?>
                                                <button class="btn btn-icon-toggle deactive" type="button" onclick="changeStatus('<?= $value['id'] ?>', '1', 'status', 'restaurants/ajaxaction', 'restaurantStatus')">
                                                    <i class="fa fa-close"></i>
                                                </button>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <a href="<?php echo ADMIN_BASE_URL; ?>restaurants/addedit/<?php echo $value['id'];?>" class="btn btn-icon-toggle" data-original-title="Edit" data-placement="top" data-toggle="tooltip" id="<?php echo $value['id']; ?>" >
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button class="btn btn-icon-toggle" data-original-title="Delete" data-placement="top" data-toggle="tooltip" type="button" id="<?php echo $value['id']; ?>" onclick="return deleteRecord(<?php echo $value['id']; ?>, 'restaurants/deleteRestaurant', 'Restaurants', '', 'catTable')">
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
