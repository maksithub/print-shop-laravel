@extends('layouts.front.app')

@section('content')
<div class="container content">
    <nav class="woocommerce-breadcrumb">
        <a href="{{url('/')}}">Home</a>
        <span class="delimiter"><i class="fa fa-angle-right"></i></span>
        <a href="{{url('/login')}}">Login</a>
    </nav><!-- /.woocommerce-breadcrumb -->

    <div class="customer-login-form">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h2>Reset Password</h2>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">E-Mail Address</label>

                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>  <!-- /.customer-login-form -->
</div>
@endsection
