<div class="list-group" id="list-tab" role="tablist">
  <a class="list-group-item list-group-item-action cm-group-item {{ Request::is('products') ? 'active' : '' }}" id="list-products-list"  href="{{ url('/products') }}" ><i class="fas fa-coffee"></i>&nbsp;&nbsp; Products</a>
  <a class="list-group-item list-group-item-action cm-group-item {{ Request::is('customers') ? 'active' : '' }}" id="list-customers-list"  href="{{ url('/customers') }}" ><i class="far fa-address-book"></i>&nbsp;&nbsp; Customers</a>
  <a class="list-group-item list-group-item-action cm-group-item {{ Request::is('orders') ? 'active' : '' }}" id="list-orders-list" href="{{ url('/orders') }}" ><i class="fas fa-shopping-cart"></i>&nbsp;&nbsp; Orders</a>
</div>