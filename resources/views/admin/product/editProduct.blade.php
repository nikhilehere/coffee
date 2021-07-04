@extends('layout.app') 
@section('content')
<form method="POST" action="/products/update"> 
    @csrf
    <div class="card sl-content-card cm-field-container">
        <div class="card-header sl-card-header">
            <h3 class="d-inline">Update Product </h3>
            <a class="btn btn-secondary float-right d-inline back-to-table" href="/products"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Products</a>
        </div>
        <div class="card-body cm-fields">
			<div class="form-row">
				<div class="form-group col-md-8">
					<label for="add-product-name">Product Name &nbsp;<i class="cm-mandatory-fields">*</i></label> 
                    <input type="text" value="{{$product->product_name}}" name="product_name" id="add-product-name" class="form-control {{ $errors->has('product_name') ? ' is-invalid-data' : '' }}" value="{{ old('product_name') }}"> 
					@if($errors->has('product_name'))
						<div class="cm-field-error">{{ $errors->first('product_name') }}</div> 
					@endif
                </div>
				<div class="form-group col-md-4">
					<label for="add-product-no">Product No &nbsp;</label> 
                    <input type="text" value="{{$product->product_no}}" name="product_no" id="add-product-no" class="form-control {{ $errors->has('product_no') ? ' is-invalid-data' : '' }}" value="{{ old('product_no') }}"> 
					@if($errors->has('product_no'))
						<div class="cm-field-error">{{ $errors->first('product_no') }}</div> 
					@endif
                </div>
			</div>

            <div class="form-row">
				<div class="form-group col-md-4">
					<label for="add-product-cost">Product Cost &nbsp;<i class="cm-mandatory-fields">*</i></label> 
                    <input type="text" value="{{$product->product_cost}}" name="product_cost" id="add-product-cost" class="form-control {{ $errors->has('product_cost') ? ' is-invalid-data' : '' }}" value="{{ old('product_cost') }}"> 
					@if($errors->has('product_cost'))
						<div class="cm-field-error">{{ $errors->first('product_cost') }}</div> 
					@endif
                </div>
				<div class="form-group col-md-4">
					<label for="add-product-quantity">Product quantity &nbsp;</label> 
					<input type="text" value="{{$product->quantity}}" name="product_quantity" id="add-product-quantity" class="form-control {{ $errors->has('product_quantity') ? ' is-invalid-data' : '' }}" value="{{ old('product_quantity') }}"> 
					@if($errors->has('product_quantity'))
						<div class="cm-field-error">{{ $errors->first('product_quantity') }}</div> 
					@endif
                </div>
				<div class="form-group col-md-4">
					<label for="add-product-availability">Product Availability &nbsp;</label> 
					@if($errors->has('product_availability'))
						<div class="cm-field-error">{{ $errors->first('product_availability') }}</div> 
					@endif
                    <select class="form-control sl-form-control" id="labType" name="product_availability">
                        <option value="1" {{ ($product->active == "1") ? "selected" : "" }}>Available</option>
                        <option value="0" {{ ($product->active == "0") ? "selected" : "" }}>Not available</option>
                    </select>
                </div>
                <input type="hidden" name="product_id" value="{{Crypt::encrypt($product->id)}}"> 
			</div>
		</div>
        <div class="card-footer text-muted">
			<div class="form-row cm-field-btn-row">
				<button type="reset" class="btn btn-secondary">Default</button>
				<button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;Update</button>
			</div>
		</div>
    </div> 
</form>
@stop