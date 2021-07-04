@extends('layout.app') 
@section('content')

<div class="container cs-dashboard">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="jumbotron order-now-slide cm-zoom">
            <h1 class="dash-slide-heading">Take a break! </h1>
            <p class="lead">Take a cup and forget about everything for a few minutes..</p>
            <a class="btn cs-order-btn btn-lg" href="/shop" role="button"><i class="fas fa-coffee"></i> Order Now</a>
        </div>
    </div>
    
    <div class="col-md-1"></div>
  </div>
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-5">
        <div class="jumbotron order-now-bottom-slide cm-zoom">
            <h1 class="dash-slide-heading">Wallet</h1>
            <p class="lead">A wallet that never Goes Out Of Style.</p>
            <a class="btn cs-order-btn btn-lg" href="/wallet" role="button"><i class="fas fa-wallet"></i> My Wallet</a>
        </div>
    </div>
    <div class="col-md-5">
        <div class="jumbotron order-now-bottom-slide cm-zoom">
            <h1 class="dash-slide-heading">My Orders!</h1>
            <p class="lead">The coffee of your choice..</p>
            <a class="btn cs-order-btn btn-lg" href="/orders" role="button"> <i class="fas fa-store"></i> Manage Order</a>
        </div>
    </div>
    <div class="col-md-1"></div>
  </div>
</div>




@stop