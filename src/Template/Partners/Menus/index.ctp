<section class="col-xs-12 col-sm-9">
    <div class="buyer-title">Menu Manage</div>
    <div class="products-section no-padding-top">
        <div class="clearfix">
            <div class="checkout-wrapper buyer-checkout-wrapper no-margin-bottom">
                <div class="checkout-body">
                    <div class="checkout-body-title">
                        <span class="pull-right">
                             <a href="<?php echo PARTNER_BASE_URL ?>menus/add" class="btn-submit">Add New</a>
                        </span>
                    </div>

                    <div class="clearfix"></div>
                    <div class="order-searcbox table-responsive tablecls" id="ajaxReplace">
                        <table id="myTable" class="table table-striped clearfix">
                            <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Menu Name</th>
                                <th>Category Name</th>
                                <th>Added Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(isset($menuDetails) && !empty($menuDetails)) {
                                foreach($menuDetails as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo $value['menu_name']; ?></td>
                                        <td><?php echo $value['category']['catname']; ?></td>
                                        <td id="status_<?php echo $value['id'];?>">
                                            <?php if($value['status'] == '0') { ?>
                                                <div class="label label-table label-danger">
                                                    <a class="statusColor" href="javascript:;" onclick="changeStatus('<?= $value['id'] ?>', '1', 'status', 'menus/ajaxaction', 'restaurantMenuStatus')"><i class="fa fa-close"></i></a>
                                                </div>
                                            <?php }else { ?>
                                                <div class="label label-table label-success">
                                                    <a class="statusColor" href="javascript:;" onclick="changeStatus('<?= $value['id'] ?>', '0', 'status', 'menus/ajaxaction', 'restaurantMenuStatus')"><i class="fa fa-check"></i></a>
                                                </div>
                                            <?php } ?>

                                        </td>
                                        <td><?php echo date('Y-m-d h:i A', strtotime($value['created'])); ?></td>
                                        <td>
                                            <a href="<?php echo PARTNER_BASE_URL ?>menus/edit/<?php echo $value['id'] ?>"><span class="label label-default label-violet"><i class="fa fa-pencil"></i></span></a>
                                            <a data-original-title="Delete" data-placement="top" data-toggle="tooltip" id="<?php echo $value['id']; ?>" onclick="return deleteRecord(<?php echo $value['id']; ?>, 'menus/deleteMenus', 'Menus', '', 'myTable')" href=""><span class="label label-danger"><i class="fa fa-trash"></i></span></a>
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
</section>

