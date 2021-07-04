@extends('layout.app') 
@section('content')
<form method="POST" action="/orders"> @csrf
    <div class="card sl-content-card cm-field-container">
        <div class="card-header sl-card-header">
            <h3 class="d-inline">Create Order </h3>
            <a class="btn btn-secondary float-right d-inline back-to-table" href="/orders"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Orders</a>
        </div>
        <div class="card-body cm-fields">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="order-customer-name">Customer Name &nbsp;<i class="cm-mandatory-fields">*</i></label> 
					<select name="customer" id="order-customer-name" class="form-control">
						<option value="">Select Customer</option>
						@foreach($customers as $customer)
						<option value="{{ $customer->id }}" {{ (old('customer') == $customer->id) ? "selected" : "" }}>{{ $customer->name }}</option>
						@endforeach
					</select>
					@if($errors->has('customer'))
						<div class="cm-field-error">{{ $errors->first('customer') }}</div> 
					@endif
                </div>
				<div class="form-group col-md-6">
					<label for="order-product-name">Product &nbsp;<i class="cm-mandatory-fields">*</i></label> 
					<select name="product" id="order-product-name" class="form-control">
						<option value="">Select Product</option>
						@foreach($products as $product)
						<option value="{{ $product->id }}" {{ (old('product') == $product->id) ? "selected" : "" }}>{{ $product->product_name }} {{ $product->quantity }} ml [&#8377; {{ $product->product_cost }}]</option>
						@endforeach
					</select>
					@if($errors->has('product'))
						<div class="cm-field-error">{{ $errors->first('product') }}</div> 
					@endif
                </div>
			</div>

            <div class="form-row">
				<div class="form-group col-md-3">
					<label for="add-quantity">Quantity &nbsp;<i class="cm-mandatory-fields">*</i></label> 
					<select name="quantity" id="order-product-name" class="form-control">
						<option value="1" {{ (old('quantity') == "1") ? "selected" : "" }}>1</option>
						<option value="2" {{ (old('quantity') == "2") ? "selected" : "" }}>2</option>
						<option value="3" {{ (old('quantity') == "3") ? "selected" : "" }}>3</option>
						<option value="4" {{ (old('quantity') == "4") ? "selected" : "" }}>4</option>
					</select>
                </div>
				<div class="form-group col-md-3">
					<label for="add-mode">Pay Mode </label> 
					<label class="form-control form-control-label" >COD </label> 
                </div>
				<div class="form-group col-md-6">
					<label>Order No </label> 
					<label class="form-control form-control-label" >{{ $newInsertID }}</label> 
					<input type="hidden" name="order_no" value="{{ $newInsertID }}">
                </div>
			</div>
		</div>
        <div class="card-footer text-muted">
			<div class="form-row cm-field-btn-row">
				<button type="reset" class="btn btn-secondary">Clear</button>
				<button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;Create</button>
			</div>
		</div>
    </div> 
</form>

@stop