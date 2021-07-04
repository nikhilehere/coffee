@extends('layout.app') 
@section('content')

<form method="POST" action="/customers/update"> @csrf
<div class="container cs-dashboard">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="jumbotron order-shop-slide">
            <h3 class="shop-slide-heading"><i class="fas fa-user-circle"></i> My Profile! </h3>
            <a class="btn btn-secondary float-right d-inline back-to-table" href="/wallet"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>
            <br>
            
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="jumbotron order-now-bottom-slide text-right">
                        <h1 class="dash-slide-heading float-left" style="text-transform: capitalize;" >{{$customer->name}}</h1>
                        <h1>&#8377; {{ number_format($customer->wallet, 2) }}</h1>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="jumbotron order-now-bottom-slide">
                    <!-- ...................................... -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="add-customer-name">Customer Name &nbsp;<i class="cm-mandatory-fields">*</i></label> 
                            <input type="text" name="name" id="add-customer-name" class="form-control cp-login-input {{ $errors->has('name') ? ' is-invalid-data' : '' }}" value="{{ $customer->name }}"> 
                            @if($errors->has('name'))
                                <div class="cm-field-error">{{ $errors->first('name') }}</div> 
                            @endif
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add-age">Age &nbsp;<i class="cm-mandatory-fields">*</i></label> 
                            <input type="text" name="age" id="add-age" class="form-control cp-login-input {{ $errors->has('age') ? ' is-invalid-data' : '' }}" value="{{ $customer->age }}"> 
                            @if($errors->has('age'))
                                <div class="cm-field-error">{{ $errors->first('age') }}</div> 
                            @endif
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add-gender">Gender &nbsp;</label> 
                            <select class="form-control sl-form-control cp-login-input" id="add-gender" name="gender" value="{{ $customer->gender }}">
                                <option value="M" {{ $customer->gender == "M" ? "selected" : "" }}>Male</option>
                                <option value="F" {{ $customer->gender == "F" ? "selected" : "" }}>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="add-email">Email &nbsp;<i class="cm-mandatory-fields">*</i></label> 
                            <input type="text" name="email" id="add-email" class="form-control cp-login-input {{ $errors->has('email') ? ' is-invalid-data' : '' }}" value="{{ $customer->email }}"> 
                            @if($errors->has('email'))
                                <div class="cm-field-error">{{ $errors->first('email') }}</div> 
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="add-mobile">Mobile &nbsp;<i class="cm-mandatory-fields">*</i></label> 
                            <input type="text" name="mobile" id="add-mobile" class="form-control cp-login-input {{ $errors->has('mobile') ? ' is-invalid-data' : '' }}" value="{{ $customer->mobile }}"> 
                            @if($errors->has('mobile'))
                                <div class="cm-field-error">{{ $errors->first('mobile') }}</div> 
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="add-address">Address &nbsp;</label> 
                            <textarea class="form-control sl-form-control cp-login-input" name="address" id="aad-address"
                                rows="3">{{ $customer->address}}</textarea>
                            @if($errors->has('address'))
                                <div class="cm-field-error">{{ $errors->first('address') }}</div> 
                            @endif
                        </div>
                    </div>
                    <input type="hidden" name="customer_id" value="{{Crypt::encrypt($customer->id)}}">
                    <!-- ...................................... -->
                    <br>
                    <div class="form-row cm-field-btn-row">
                        <button type="submit" class="btn btn-success" style="width:100%;" >
                        <i class="far fa-save"></i>&nbsp;&nbsp;Update Profile
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