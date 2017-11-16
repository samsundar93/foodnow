<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Orders</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <div class="table-responsive">
                        <table id="orderpage" class="table table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Restaurant Name</th>
                                <th>Delivery Date</th>
                                <th>Status</th>
                                <th>Order Date</th>
                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function(){
        showOrders();
    });

    function showOrders() {
        $("#orderpage").DataTable().destroy();
        $('#orderpage').DataTable( {
            serverSide: true,
            processing: true,
            dom: 'Bfrtip',
            buttons: [
                'csv'
            ],
            "ajax": {
                "url": baseUrl+"orders/getOrderDetails",
                "type": "POST",
                'data': {

                }
            },
            "columns": [
                { "data": "Id"  },
                { "data": "Order ID"  },
                { "data": "Customer Name"  },
                { "data": "Restaurant Name"  },
                { "data": "Delivery Date"  },
                { "data": "Status"  },
                { "data": "Order Date"  }

            ]
        });
    }

    function changeOrderStatus(id) {
        var status = $("#currentStatus_"+id+" option:selected").val();
        if(status == 'Failed') {
            $("#orderId").val(id);
            $("#failedReason").modal('show');return false;
        }
        if(status != '' ) {
            $.ajax({
                'type' : 'POST',
                'url' : baseUrl+'orders/changeStatus',
                'data': {id:id,status:status},
                success: function(data) {
                    if($.trim(data) == '1') {
                        showOrders();
                    }
                }
            })
        }
    }

    function submitReason(id) {
        var status = 'failed';
        var failed_reason = $("#failedreason").val();
        var id = $("#orderId").val();

        if(status != '' && failed_reason == '') {
            $(".failedreason").html("Message must be filled");
            $("#failedreason").focus();
            return false;

        }else{
            $.ajax({
                'type' : 'POST',
                'url' : baseUrl+'orders/changeStatus',
                'data': {id:id,status:status,failed_reason:failed_reason},
                success: function(data) {
                    if($.trim(data) == '1') {
                        $("#failedReason").modal('hide');
                        $("#failedreason").val('');
                        showOrders();
                    }
                }
            })
        }
    }

</script>

<div class="modal fade" id="failedReason" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Failed Reason</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="orderId">
                    <span class="failedreason"> </span>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Message:</label>
                        <textarea class="form-control" id="failedreason"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button onclick="submitReason()" type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>