<section class="col-xs-12 col-sm-9">
    <div class="buyer-title">Cuisine Manage</div>
    <div class="products-section no-padding-top">
        <div class="clearfix">
            <div class="checkout-wrapper buyer-checkout-wrapper no-margin-bottom">
                <div class="checkout-body">

                    <div class="clearfix"></div>
                    <div class="order-searcbox table-responsive tablecls" id="ajaxReplace">
                        <table id="myTable" class="table table-striped clearfix">
                            <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Restaurant Name</th>
                                <th>Delivey Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($orderDetails)) { ?>
                                <?php foreach ($orderDetails as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $key+1 ?></td>
                                        <td><?php echo $value['order_number'] ?></td>
                                        <td><?php echo $value['customer_name'] ?></td>
                                        <td><?php echo $value['restaurant']['restaurant_name'] ?></td>
                                        <td><?php echo date('Y-m-d h:i A', strtotime($value['delivery_date'])) ?></td>
                                        <td id="status_<?php echo $value['id'];?>">
                                            <?php if($value['status'] == '0') { ?>
                                                <div class="label label-table label-danger">
                                                    <a class="statusColor" href="javascript:;" onclick="changeStatus('<?= $value['id'] ?>', '1', 'status', 'category/ajaxaction', 'categorystatuschange')"><i class="fa fa-close"></i></a>
                                                </div>
                                            <?php }else { ?>
                                                <div class="label label-table label-success">
                                                    <a class="statusColor" href="javascript:;" onclick="changeStatus('<?= $value['id'] ?>', '0', 'status', 'category/ajaxaction', 'categorystatuschange')"><i class="fa fa-check"></i></a>
                                                </div>
                                            <?php } ?>

                                        </td>
                                        <td><?php echo date('Y-m-d h:i A', strtotime($value['created'])); ?></td>
                                    </tr>
                                <?php }
                            }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

