@extends('layout.app') 
@section('content')

<form method="POST" action="/wallet-recharge"> @csrf
<div class="container cs-dashboard">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="jumbotron order-shop-slide">
            <h3 class="shop-slide-heading"><i class="fas fa-wallet"></i> Recharge! </h3>
            <a class="btn btn-secondary float-right d-inline back-to-table" href="/wallet"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>
<br>
            
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="jumbotron order-now-bottom-slide text-right">
                        <h1 class="dash-slide-heading float-left">Balance</h1>
                        <h1>&#8377; {{ number_format($customer->wallet, 2) }}</h1>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="jumbotron order-now-bottom-slide">
                    <label for="add-amount">Amount &nbsp;</label> 
					<select class="form-control sl-form-control cp-login-input" id="add-amount" name="amount" value="{{ old('gender') }}">
                        <option value="500" {{ (old('amount') == "500") ? "selected" : "" }}>&#8377; 500</option>
                        <option value="1000" {{ (old('amount') == "1000") ? "selected" : "" }}>&#8377; 1000</option>
                        <option value="2000" {{ (old('amount') == "2000") ? "selected" : "" }}>&#8377; 2000</option>
                    </select>
                    <br>
                    <div class="form-row cm-field-btn-row">
                        <button type="submit" class="btn btn-success" style="width:100%;" >
                            <i class="far fa-credit-card"></i>&nbsp;&nbsp;Pay Now
                        </button>
                    </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
  </div>
</div>
</form>



@stop