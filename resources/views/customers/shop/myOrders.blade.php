@extends('layout.app') 
@section('content')

<div class="container cs-dashboard">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="jumbotron order-shop-slide">
            <h3 class="shop-slide-heading">My Orders </h3>
            <a class="btn btn-success float-right" href="/shop" > <i class="fas fa-plus"></i>&nbsp;&nbsp;Create Order</a>
            <div class="table-responsive">
                <table class="cm-cust-table table  data-table" id="orders-table-customer">
                    <thead class="cm-cust-table-header">
                        <tr>
                        <th scope="col">Order No</th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <!-- <th scope="col">Customer</th> -->
                        <th scope="col">Pay Mode</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
			</div>
        </div>
    </div>
    <div class="col-md-1"></div>
  </div>
</div>

@include('modals.orders.customerViewOrder')
@include('modals.orders.cancelOrderModal')

<script type="text/javascript">
 
$(function () {
    
    var table = $('#orders-table-customer').DataTable({
        processing: true,
        serverSide: true,
        // responsive: true,
        ajax: "{{ route('orders.index') }}",
        columns: [
            {data: 'order_no', name: 'order_no'},
            {data: 'product', name: 'OrderProduct.product_name'},
            {data: 'nos', name: 'nos'},
            // {data: 'customer', name: 'OrderCustomer.name'},
            {data: 'pay_mode', name: 'pay_mode'},
            {data: 'status', name: 'OrderStatus.status',orderable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        'createdRow': function( row, data, dataIndex ) {
                        if( data['order_status']['id'] ==  6){
                                $(row).addClass('cancelled-order');
                        }
                    }
    });
    
  });
</script>


@stop