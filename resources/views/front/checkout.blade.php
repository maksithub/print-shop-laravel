@extends('layouts.front.app')

@section('content')
    <div class="container product-in-cart-list">
        @if(!$products->isEmpty())
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('home') }}"> <i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Checkout</li>
                    </ol>
                </div>
                <div class="col-md-12 content">
                    <div class="box-body">
                        @include('layouts.errors-and-messages')
                    </div>
                    @if(count($billingAddress)>0)
                        <div class="row">
                            <div class="col-md-12">
                                @include('front.checkout.product-list-table', compact('products'))
                            </div>
                        </div>
                        @if(isset($addresses))
                            <div class="row">
                                <div class="col-md-12">
                                    <legend><i class="fa fa-home"></i> Addresses</legend>
                                    <table class="table table-striped">
                                        <thead>
                                            <th class="col-md-2">Alias</th>
                                            <th class="col-md-4">Address</th>
                                            <th class="col-md-2">Billing Address</th>
                                            <th class="col-md-4">Delivery Address</th>
                                        </thead>
                                        @if(count($billingAddress)>0)
                                        <tbody>
                                            @foreach($billingAddress as $key => $address)
                                                <tr>
                                                    <td class="col-md-2">{{ $address->alias }}</td>
                                                    <td class="col-md-4">
                                                        {{ $address->address_1 }} {{ $address->address_2 }} <br />
                                                        @if(!is_null($address->province))
                                                            {{ $address->city }} {{ $address->province->name }} <br />
                                                        @endif
                                                        {{ $address->city }} {{ $address->state_code }} <br>
                                                        {{ $address->country->name }} {{ $address->zip }}
                                                    </td>
                                                    <td class="col-md-2">
                                                        <label class="col-md-6 col-md-offset-3">
                                                        <input
                                                                    type="radio"
                                                                    value="{{ $address->id }}"
                                                                    name="billing_address"
                                                                    checked="checked">
                                                        </label>
                                                    </td>
                                                    <td class="col-md-4">
                                                        <label for="sameDeliveryAddress">
                                                            <input type="checkbox" id="sameDeliveryAddress" checked="checked"> Same as billing
                                                        </label>
                                                        @if(count($shippingAddress)==0)
                                                        <div class="shippingAddressLink">Ship to different address? <a href="{{ route('customer.address.create', [$customer->id, 'addressType=shipping']) }}">Create the shipping address here</a></div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        @endif
                                        @if(count($shippingAddress))
                                        <tbody style="display: none" id="sameDeliveryAddressRow">
                                            @foreach($shippingAddress as $key => $address)
                                                <tr>
                                                    <td class="col-md-2">{{ $address->alias }}</td>
                                                    <td class="col-md-4">
                                                        {{ $address->address_1 }} {{ $address->address_2 }} <br />
                                                        @if(!is_null($address->province))
                                                            {{ $address->city }} {{ $address->province->name }} <br />
                                                        @endif
                                                        {{ $address->city }} {{ $address->state_code }} <br>
                                                        {{ $address->country->name }} {{ $address->zip }}
                                                    </td>
                                                    <td class="col-md-2"></td>
                                                    <td class="col-md-4">
                                                        <label class="">
                                                            <input type="radio" value="{{ $address->id }}" name="delivery_address" checked="checked">
                                                        </label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        @endif
                        @if(!is_null($rates))
                            <div class="row">
                                <div class="col-md-12">
                                    <legend><i class="fa fa-truck"></i> Courier</legend>
                                    <ul class="list-unstyled">
                                        @foreach($rates as $rate)
                                            <li class="col-md-4">
                                                <label class="radio">
                                                    <input type="radio" name="rate" data-fee="{{ $rate->amount }}" value="{{ $rate->object_id }}">
                                                </label>
                                                <img src="{{ $rate->provider_image_75 }}" alt="courier" class="img-thumbnail" /> {{ $rate->currency }} {{ $rate->amount }}<br />
                                                {{ $rate->servicelevel->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div> <br>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <legend><i class="fa fa-credit-card"></i> Payment</legend>
                                @if(isset($payments) && !empty($payments))
                                    <table class="table table-striped">
                                        <thead>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th class="pull-right">Choose payment</th>
                                        </thead>
                                        <tbody>
                                        @foreach($payments as $payment)
                                            @include('layouts.front.payment-options', compact('payment', 'total', 'shipment'))
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p class="alert alert-danger">No payment method set</p>
                                @endif
                            </div>
                        </div>
                    @else
                        <p class="alert alert-danger"><a href="{{ route('customer.address.create', [$customer->id]) }}">No billing address found. You need to create an address first here.</a></p>
                    @endif
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-12">
                    <p class="alert alert-warning">No products in cart yet. <a href="{{ route('home') }}">Show now!</a></p>
                </div>
            </div>
        @endif
    </div>
@endsection