@php($addresstab = '')
@php($orderstab = '')
@php($profiletab = '')
@if(isset($_GET['tab']))
    @if($_GET['tab'] == 'address')
        @php($addresstab = 'active')
    @endif
    @if($_GET['tab'] == 'orders')
        @php($orderstab = 'active')
    @endif
    @if($_GET['tab'] == 'profile')
        @php($profiletab = 'active')
    @endif
@else
    @php($profiletab = 'active')
@endif

@extends('layouts.front.app')

@section('content')
    <!-- Main content -->
    <section class="container content">

        <nav class="woocommerce-breadcrumb">
            <a href="{{url('/')}}">Home</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
            <a href="{{url('/accounts')}}">My Account</a>
        </nav><!-- /.woocommerce-breadcrumb -->

        @if(count($billing_addresses)==0)
        <div class="alert alert-success">
           <a href="{{ route('customer.address.create', [$customer->id, 'addressType=billing']) }}">Before checkout, Please create the billing address first</a>
        </div>
        @else
            @if(count($shipping_addresses)==0)
            <div class="alert alert-success">
                <p>Ship to a different address? <a href="{{ route('customer.address.create', [$customer->id, 'addressType=shipping']) }}">Create the shipping address here</a></p>
            </div>
            @endif
            @if (count(Cart::content()) > 0)
            <div class="alert alert-success">
               <p>To proceed checkout, <a href="{{url('/checkout')}}">click here</a></p>
            </div>
            @endif
        @endif

        <div class="row">
            <div class="col-md-12">
                <h2><i class="fa fa-home"></i>My Account</h2>
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <!-- Nav tabs -->
                <ul class="nav account-nav">
                    <li class="nav-item">
                        <a class="nav-link {{$profiletab}}" href="#tab-profile" data-toggle="tab">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{$orderstab}}" href="#tab-orders" data-toggle="tab">Orders</a>
                    </li>
                    <li class="nav-item {{$addresstab}}">
                        <a class="nav-link" href="#tab-address" data-toggle="tab">Address</a>
                    </li>
                </ul><!-- /.nav -->
            </div>

            <div class="col-md-10">
                <!-- tab content -->
                <div class="tab-content account-tab-content">
                    <div class="tab-pane {{$profiletab}}" id="tab-profile" role="tabpanel">    
                        @include('front.components.account-profile-tab')                       
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane {{$orderstab}}" id="tab-orders" role="tabpanel">
                            @include('front.components.account-orders-tab')
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane {{$addresstab}}" id="tab-address" role="tabpanel">
                            @include('front.components.account-address-tab')
                    </div><!-- /.tab-pane -->
                </div> <!-- /.tab-content -->       
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection