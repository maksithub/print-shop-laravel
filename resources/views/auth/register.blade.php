@extends('layouts.front.app')

@section('content')
<div class="container">

<nav class="woocommerce-breadcrumb">
    <a href="{{url('/')}}">Home</a>
    <span class="delimiter"><i class="fa fa-angle-right"></i></span>
    <a href="{{url('/register')}}">Register</a>
</nav><!-- /.woocommerce-breadcrumb -->

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="customer-login-form">
                <h2>Register</h2>
                <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="form-row form-row-wide form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Name *</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="form-row form-row-wide form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">E-Mail Address *</label>

                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-row form-row-wide form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">Create Password *</label>

                        <input id="password" type="password" class="form-control" name="password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-row form-row-wide form-group{{ $errors->has('password-confirm') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="control-label">Confirm Password *</label>

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                        @if ($errors->has('password-confirm'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password-confirm') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-row form-row-wide form-group{{ $errors->has('phonenum') ? 'has-error' : ''}}">
                        <label for="phonenumber" class="control-label">Phone Number *</label>

                        <input id="phonenum" type="tel" class="form-control" name="phonenum">
                    </div>

                    <div class="form-row form-row-wide form-group">
                        <input type="submit" class="btn btn-primary w__100" value="Register">
                    </div>
                </form>

                <div class="form-row form-row wide mb__0">
                    <p class="tc">*We may use your phone number to contact you regarding any issues with your orders.</p> 
                    <p class="mb__0">By creating an account, you agree to 1hrprint Terms and Conditions and Privacy Policy, including your consent to 1hrprint sending e-mails about promotions and discounts.</p>                   
                </div>

                <div class="form-row">
                    <hr>
                    <span>Already have an account? </span><a href="{{url('/login')}}">Log in Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
