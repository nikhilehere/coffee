@extends('layout.app') 
@section('content')

<div class="container" style="padding: 2%;">
    <h4 class="d-inline">Orders</h4>
    <!-- Button trigger modal -->
    <a class="btn btn-success float-right" href="/orders/create" > <i class="fas fa-plus"></i>&nbsp;&nbsp;Create Order</a>
</div>

<div class="container">
<table class="cm-table table  data-table" id="orders-table">
  <thead class="cm-table-header">
    <tr>
      <th scope="col">Order No</th>
      <th scope="col">Product</th>
      <th scope="col">Quantity</th>
      <th scope="col">Customer</th>
      <th scope="col">Pay Mode</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  
  </tbody>
</table>
</div>

@include('modals.orders.viewOrderModal')
@include('modals.orders.deleteOrderModal')

<script type="text/javascript">
 
// $('#orders-table').DataTable(); // need to convert to serverside
$(function () {
    
    var table = $('#orders-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('orders.index') }}",
        columns: [
            {data: 'order_no', name: 'order_no'},
            {data: 'product', name: 'OrderProduct.product_name'},
            {data: 'nos', name: 'nos'},
            {data: 'customer', name: 'OrderCustomer.name'},
            {data: 'pay_mode', name: 'pay_mode'},
            {data: 'status', name: 'OrderStatus.status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
@stop