@extends('layout.loginApp') 
@section('loginContent')

<form method="POST" action="/register"> @csrf
<div class="container cs-dashboard">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="jumbotron order-shop-slide">
            <h3 class="shop-slide-heading"><i class="fas fa-user-circle"></i> Customer Sign Up! </h3>
            <a class="btn btn-secondary float-right d-inline back-to-table" href="/"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>
            <br>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="jumbotron order-now-bottom-slide">
                    <!-- ...................................... -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="add-customer-name">Customer Name &nbsp;<i class="cm-mandatory-fields">*</i></label> 
                            <input type="text" name="name" id="add-customer-name" class="form-control cp-login-input {{ $errors->has('name') ? ' is-invalid-data' : '' }}" value="{{ old('name') }}"> 
                            @if($errors->has('name'))
                                <div class="cm-field-error">{{ $errors->first('name') }}</div> 
                            @endif
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add-age">Age &nbsp;<i class="cm-mandatory-fields">*</i></label> 
                            <input type="text" name="age" id="add-age" class="form-control cp-login-input {{ $errors->has('age') ? ' is-invalid-data' : '' }}" value="{{ old('age') }}"> 
                            @if($errors->has('age'))
                                <div class="cm-field-error">{{ $errors->first('age') }}</div> 
                            @endif
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add-gender">Gender &nbsp;</label> 
                            <select class="form-control sl-form-control cp-login-input" id="add-gender" name="gender" value="{{ old('gender') }}">
                                <option value="M" {{ (old('gender') == "M") ? "selected" : "" }}>Male</option>
                                <option value="F" {{ (old('gender') == "F") ? "selected" : "" }}>Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="add-email">Email &nbsp;<i class="cm-mandatory-fields">*</i></label> 
                            <input type="email" name="email" id="add-email" class="form-control cp-login-input {{ $errors->has('email') ? ' is-invalid-data' : '' }}" value="{{ old('email') }}"> 
                            @if($errors->has('email'))
                                <div class="cm-field-error">{{ $errors->first('email') }}</div> 
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="add-mobile">Mobile &nbsp;<i class="cm-mandatory-fields">*</i></label> 
                            <input type="text" pattern="\d*" maxlength="10" name="mobile" id="add-mobile" class="form-control cp-login-input {{ $errors->has('mobile') ? ' is-invalid-data' : '' }}" value="{{ old('mobile') }}"> 
                            @if($errors->has('mobile'))
                                <div class="cm-field-error">{{ $errors->first('mobile') }}</div> 
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="add-address">Address &nbsp;</label> 
                            <textarea class="form-control sl-form-control cp-login-input" name="address" id="aad-address"
                                rows="3"></textarea>
                            @if($errors->has('address'))
                                <div class="cm-field-error">{{ $errors->first('address') }}</div> 
                            @endif
                        </div>
                    </div>
                    <!-- ...................................... -->
                    <br>
                    <div class="form-row cm-field-btn-row">
                        <button type="submit" class="btn btn-success" style="width:100%;" >
                        <i class="far fa-save"></i>&nbsp;&nbsp;Create Profile
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