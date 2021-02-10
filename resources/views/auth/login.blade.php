@extends('layouts.front.app')

@section('content')

    <!-- Main content -->
    <section class="container content">

        <nav class="woocommerce-breadcrumb">
            <a href="{{url('/')}}">Home</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
            <a href="{{url('/login')}}">Login</a>
        </nav><!-- /.woocommerce-breadcrumb -->

        <div class="customer-login-form">
            <div class="row">
                <div class="col-md-12">@include('layouts.errors-and-messages')</div>
                <div class="col-md-4 col-md-offset-4">
                    <h2>Login to your account</h2>
                    <form action="{{ route('login') }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group form-row">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" autofocus>
                         @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        </div>
                        <div class="form-group form-row">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" value="" class="form-control" placeholder="xxxxx">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        </div>
                        <div class="form-group form-row form-row-wide">
                            <input type="submit" class="w__100" type="submit" value="Login Now">
                        </div>
                    </form>
                    <div class="form-row">
                        <hr>
                        <a href="{{route('password.request')}}" class="pull-left">I forgot my password</a>
                        <a href="{{route('register')}}" class="text-center pull-right">No account? Register Now.</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
