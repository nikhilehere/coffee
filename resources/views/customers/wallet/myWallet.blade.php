@extends('layout.app') 
@section('content')

<div class="container cs-dashboard">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="jumbotron order-shop-slide">
            <h3 class="shop-slide-heading"><i class="fas fa-wallet"></i> My Wallet! </h3>
            <a class="btn btn-secondary float-right d-inline back-to-table" href="/shopNow"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>
<br>
            
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="jumbotron order-now-bottom-slide text-right">
                        <h1 class="dash-slide-heading float-left">Balance</h1>
                        <h1 class="wallet-amt" >&#8377; {{ number_format($customer->wallet, 2) }}</h1>
                        <a class="btn cs-w-withdrawal-btn btn-lg" href="/withdrawal" role="button"><i class="fas fa-piggy-bank"></i> Withdrawal</a>
                        <a class="btn cs-w-recharge-btn btn-lg" href="/wallet-recharge" role="button"><i class="far fa-credit-card"></i> Recharge</a>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
  </div>
</div>




@stop