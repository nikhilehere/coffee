@extends('layout.app') 
@section('content')

<div class="container cs-dashboard">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="jumbotron order-shop-slide">
            <h3 class="shop-slide-heading">Select your choice! </h3>
            <a class="btn btn-secondary float-right d-inline back-to-table" href="/shopNow"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>
<br>
            <div class="form-row shop-tiles">
                @foreach($products as $product)
				<div class="form-group col-md-12">
                    <div class="col-md-1"></div>
                        <div class="card col-md-10 text-right product-tiles">
                            <div class="card-body">
                                <h2 class="card-title float-left">{{ $product->product_name }}</h2>
                                <h5 class="card-title">{{ $product->product_no }}</h5>
                                <a href="/buy-now/{{$product->id}}" class="btn btn-primary cs-order-btn">Buy Now &#8377; {{ $product->product_cost }}</a>
                            </div>
                        </div>
                    <div class="col-md-1"></div>
                </div>
                @endforeach
			</div>
        </div>
    </div>
    <div class="col-md-1"></div>
  </div>
</div>




@stop