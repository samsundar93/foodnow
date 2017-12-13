<section class="col-xs-12 col-sm-9">
    <div class="buyer-title">Orders Manage</div>
    <div class="products-section no-padding-top">
        <div class="clearfix">
            <div class="checkout-wrapper buyer-checkout-wrapper no-margin-bottom">
                <div class="checkout-body">

                    <div class="clearfix"></div>
                    <div class="order-searcbox table-responsive tablecls" id="ajaxReplace">
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
</section>

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
                "url": jsSitePartner+"reports/getOrderDetails",
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

</script>