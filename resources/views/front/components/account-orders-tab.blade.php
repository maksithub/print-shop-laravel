<?php
date_default_timezone_set("America/Phoenix");
?>
@if(!$orders->isEmpty())
    <table class="table">
    <tbody>
    <tr>
        <td>Date</td>
        <td>Total</td>
        <td>Status</td>
    </tr>
    </tbody>
    <tbody>
    @foreach ($orders as $key => $order)
        <tr>
            <td>
                <a data-toggle="modal" data-target="#order_modal_{{$order['id']}}" title="Show order" href="javascript: void(0)">{{ date('M d, Y h:i a', strtotime($order['created_at'])) }}</a>
                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="order_modal_{{$order['id']}}" tabindex="-1" role="dialog" aria-labelledby="MyOrders">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Reference #{{$order['reference']}}</h4>
                            </div>
                            <div class="modal-body">
                                <h4>Order Details</h4>
                                <table class="table orderDetails_table">
                                    <thead>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        
                                            @foreach($items[$key] as $item)
                                                <tr>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->price * $item->quantity}}</td>
                                                </tr>
                                            @endforeach
                                        
                                    </tbody>
                                </table>
                                <table class="table">
                                    <thead>
                                        <th>Address</th>
                                        <th>Payment Method</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <address>
                                                    <strong>{{$order['address']->alias}}</strong><br />
                                                    {{$order['address']->address_1}} {{$order['address']->address_2}}<br>
                                                </address>
                                            </td>
                                            <td>{{$order['payment']}}</td>
                                            <td>{{ config('cart.currency_symbol') }} {{$order['total']}}</td>
                                            <td><p class="text-center" style="color: #ffffff; background-color: {{ $order['status']->color }};padding:3px;">{{ $order['status']->name }}</p></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td><span class="label @if($order['total'] != $order['total_paid']) label-danger @else label-success @endif">{{ config('cart.currency') }} {{ $order['total'] }}</span></td>
            <td><p class="text-center" style="color: #ffffff; background-color: {{ $order['status']->color }}">{{ $order['status']->name }}</p></td>
        </tr>
    @endforeach
    </tbody>
</table>
    {{ $orders->links() }}
@else
    <p class="alert alert-warning">No orders yet. <a href="{{ route('home') }}">Shop now!</a></p>
@endif