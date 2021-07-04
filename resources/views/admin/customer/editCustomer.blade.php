@extends('layout.app') 
@section('content')
<form method="POST" action="/customers/update"> @csrf
    <div class="card sl-content-card cm-field-container">
        <div class="card-header sl-card-header">
            <h3 class="d-inline">Update Customer </h3>
            <a class="btn btn-secondary float-right d-inline back-to-table" href="/customers"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Customers</a>
        </div>
        <div class="card-body cm-fields">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="add-customer-name">Customer Name &nbsp;<i class="cm-mandatory-fields">*</i></label> 
					<input type="text" name="name" id="add-customer-name" class="form-control {{ $errors->has('name') ? ' is-invalid-data' : '' }}" value="{{ $customer->name }}"> 
					@if($errors->has('name'))
						<div class="cm-field-error">{{ $errors->first('name') }}</div> 
					@endif
                </div>
				<div class="form-group col-md-3">
					<label for="add-age">Age &nbsp;<i class="cm-mandatory-fields">*</i></label> 
					<input type="text" name="age" id="add-age" class="form-control {{ $errors->has('age') ? ' is-invalid-data' : '' }}" value="{{ $customer->age }}"> 
					@if($errors->has('age'))
						<div class="cm-field-error">{{ $errors->first('age') }}</div> 
					@endif
                </div>
				<div class="form-group col-md-3">
					<label for="add-gender">Gender &nbsp;</label> 
					<select class="form-control sl-form-control" id="add-gender" name="gender" value="{{ $customer->gender }}">
                        <option value="M" {{ $customer->gender == "M" ? "selected" : "" }}>Male</option>
                        <option value="F" {{ $customer->gender == "F" ? "selected" : "" }}>Female</option>
                    </select>
                </div>
			</div>

            <div class="form-row">
				<div class="form-group col-md-8">
					<label for="add-email">Email &nbsp;<i class="cm-mandatory-fields">*</i></label> 
					<input type="text" name="email" id="add-email" class="form-control {{ $errors->has('email') ? ' is-invalid-data' : '' }}" value="{{ $customer->email }}"> 
					@if($errors->has('email'))
						<div class="cm-field-error">{{ $errors->first('email') }}</div> 
					@endif
                </div>
				<div class="form-group col-md-4">
					<label for="add-mobile">Mobile &nbsp;<i class="cm-mandatory-fields">*</i></label> 
					<input type="text" name="mobile" id="add-mobile" class="form-control {{ $errors->has('mobile') ? ' is-invalid-data' : '' }}" value="{{ $customer->mobile }}"> 
					@if($errors->has('mobile'))
						<div class="cm-field-error">{{ $errors->first('mobile') }}</div> 
					@endif
                </div>
			</div>
            <div class="form-row">
				<div class="form-group col-md-12">
					<label for="add-address">Address &nbsp;</label> 
					<textarea class="form-control sl-form-control" name="address" id="aad-address"
                        rows="3">{{ $customer->address}}</textarea>
					@if($errors->has('address'))
						<div class="cm-field-error">{{ $errors->first('address') }}</div> 
					@endif
                </div>
			</div>
			<input type="hidden" name="customer_id" value="{{Crypt::encrypt($customer->id)}}">
		</div>
        <div class="card-footer text-muted">
			<div class="form-row cm-field-btn-row">
				<button type="reset" class="btn btn-secondary">Clear</button>
				<button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;Update</button>
			</div>
		</div>
    </div> 
</form>

@stop