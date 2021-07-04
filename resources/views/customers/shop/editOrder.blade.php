@extends('layout.app') 
@section('content')

<form method="POST" action="/orders/update"> @csrf
<div class="container cs-dashboard">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="jumbotron order-shop-slide">
            <h3 class="shop-slide-heading">Update order! </h3>
            <div class="form-row">
				<div class="form-group col-md-12">
					<div class="card text-right product-tiles">
                        <div class="card-body">
                            <h2 class="card-title float-left">{{ $order->OrderProduct->product_name }}</h2>
                            <h5 class="card-title">{{ $order->OrderProduct->product_no }}</h5>
                            <!-- <p class="card-text">--------------------------------------------------</p> -->
                            <h6 class="card-title"> &#8377; {{ $order->OrderProduct->product_cost }}</h6>
                        </div>
                    </div>
                </div>
			</div>
            <!-- fields -->
            <div class="form-row">
                <div class="form-group col-md-4">
					<label for="add-mobile">Order No &nbsp;<i class="cm-mandatory-fields">*</i></label> 
                    <label class="form-control cp-login-input" >{{ $order->order_no }}</label> 
                </div>
				<div class="form-group col-md-4">
					<label >Quantity </label> 
					<select name="nos" id="order-quantity" class="form-control cp-login-input">
						<option value="1" {{ ($order->nos == "1") ? "selected" : "" }}>1</option>
						<option value="2" {{ ($order->nos == "2") ? "selected" : "" }}>2</option>
						<option value="3" {{ ($order->nos == "3") ? "selected" : "" }}>3</option>
						<option value="4" {{ ($order->nos == "4") ? "selected" : "" }}>4</option>
					</select>
                </div>
				<div class="form-group col-md-4">
					<label >Payment </label> 
					<select name="pay_mode" id="order-product-name" class="form-control cp-login-input">
						<option value="1" {{ ($order->pay_mode == "1") ? "selected" : "" }}>Wallet</option>
						<option value="0" {{ ($order->pay_mode == "0") ? "selected" : "" }}>Cash On Delivery</option>
					</select>
                </div>
                <input type="hidden" id="cust-product_cost" name="product_cost" value="{{ $order->OrderProduct->product_cost }}">
				<input type="hidden" name="order_id" value="{{Crypt::encrypt($order->id)}}">
			</div>
            <div class="form-row">
            <div class="form-group col-md-12">
                <h5 class="card-title text-center">Total Amount :  &#8377; <span id="total-amt-display">{{ $order->OrderProduct->product_cost }}</span></h5>
            </div>
				
			</div>
            <div class="card-footer text-muted">
                <div class="form-row cm-field-btn-row">
                    <a class="btn btn-secondary" href="{{ url()->previous() }}"><i class="fas fa-arrow-circle-left"></i> Back</a>
                    <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i>&nbsp;&nbsp;Update Order</button>
                </div>
            </div>
            <!-- fields -->

        </div>
    </div>
    <div class="col-md-1"></div>
  </div>
</div>
</form>

<script>
    $('#order-quantity').on('change', function() {
        $('#total-amt-display').text(this.value * $('#cust-product_cost').val());
    });
</script>


@stop