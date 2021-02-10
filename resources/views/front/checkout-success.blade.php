@extends('layouts.front.app')

@section('content')
    <div class="container product-in-cart-list">
        <div class="row">
            <div class="col-md-12">
                <hr>
                <h1>Thank you!</h1>
                <p class="alert alert-success">Your order is under way! <a href="{{ route('home') }}">Show more!</a></p>
                @isset($message)
                <p class="alert alert-success">{{$message}}</p>
                @endisset
            </div>
        </div>
    </div>
@endsection