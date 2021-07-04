@extends('layout.app') 
@section('content')

<div class="container" style="padding: 2%;">
    <h4 class="d-inline">Products</h4>
    <!-- Button trigger modal -->
    <a class="btn btn-success float-right" href="/products/create" > <i class="fas fa-plus"></i>&nbsp;&nbsp;Add Product</a>
</div>

<div class="container">
<table class="cm-table" id="product-table">
  <thead class="cm-table-header">
    <tr>
      <th scope="col">Product</th>
      <th scope="col">P.NO</th>
      <th scope="col">Cost</th>
      <th scope="col">Quantity</th>
      <th scope="col">Availability</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  @foreach($products as $product)
    <tr>
      <td>{{ $product->product_name }}</td>
      <td>{{ $product->product_no  }}</td>
      <td>{{ $product->product_cost  }}</td>
      <td>{{ $product->quantity }} ml</td>
      <td>{{ $product->active ? 'Available' : 'Not available' }}</td>
      <td>
        <div class="btn-group" role="group" aria-label="Basic example">
          <button id="view_product_btn" data-id="{{Crypt::encrypt($product->id)}}" data-toggle="modal" data-target="#viewProductModal" type="button" class="btn btn-dark" title="View"><i class="far fa-file"></i></button>
          <a class="btn btn-dark" href="/products/{{Crypt::encrypt($product->id)}}/edit" title="Edit"><i class="fas fa-edit"></i></a>
          <button id="delete_product_btn" data-id="{{Crypt::encrypt($product->id)}}" data-name="{{$product->product_name}}" data-toggle="modal" data-target="#deleteProductModal" type="button" class="btn btn-dark" title="Delete"><i class="fas fa-trash"></i></button>
        </div>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>

@include('modals.products.viewProductModal')
@include('modals.products.deleteProductModal')

<script type="text/javascript">
  $("document").ready(function(){
    setTimeout(function(){
       $(".alert").slideUp(500);
    }, 4000 ); // 5 secs

});
$('#product-table').DataTable(); // need to convert to serverside
</script>
@stop