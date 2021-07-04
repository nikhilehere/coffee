@extends('layout.app') 
@section('content')

<div class="container" style="padding: 2%;">
    <h4 class="d-inline">Customers</h4>
    <!-- Button trigger modal -->
    <a class="btn btn-success float-right" href="/customers/create" > <i class="fas fa-plus"></i>&nbsp;&nbsp;Add Customer</a>
</div>

<div class="container">
<table class="cm-table" id="customer-table">
  <thead class="cm-table-header">
    <tr>
      <th scope="col">Customer</th>
      <th scope="col">Age</th>
      <th scope="col">Gender</th>
      <th scope="col">Mobile</th>
      <th scope="col">Email</th>
      <th scope="col">Wallet</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  @foreach($customers as $customer)
    <tr>
      <td>{{ $customer->name }}</td>
      <td>{{ $customer->age  }}</td>
      <td>{{ $customer->gender == 'M' ? 'Male' : 'Female' }}</td>
      <td>{{ $customer->mobile }}</td>
      <td>{{ $customer->email }}</td>
      <td>&#8377; {{ $customer->wallet }}</td>
      <td>
        <div class="btn-group" role="group" aria-label="Basic example">
          <button id="view_customer_btn" data-id="{{Crypt::encrypt($customer->id)}}" data-toggle="modal" data-target="#viewCustomerModal" type="button" class="btn btn-dark" title="View"><i class="far fa-file"></i></button>
          <a class="btn btn-dark" href="/customers/{{Crypt::encrypt($customer->id)}}/edit" title="Edit"><i class="fas fa-edit"></i></a>
          <button id="delete_customer_btn" data-id="{{Crypt::encrypt($customer->id)}}" data-name="{{$customer->name}}" data-toggle="modal" data-target="#deleteCustomerModal" type="button" class="btn btn-dark" title="Delete"><i class="fas fa-trash"></i></button>
        </div>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>

@include('modals.customers.viewCustomerModal')
@include('modals.customers.deleteCustomerModal')

<script type="text/javascript">
 
$('#customer-table').DataTable(); // need to convert to serverside
</script>
@stop