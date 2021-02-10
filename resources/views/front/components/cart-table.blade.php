@if(!$cartItems->isEmpty())
    <table class="shop_table shop_table_responsive cart">
        <thead>
            <tr>
                <th class="product-remove">&nbsp;</th>
                <th class="product-thumbnail">&nbsp;</th>
                <th class="product-name">Product</th>
                <th class="product-price">Price</th>
                <th class="product-subtotal">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $cartItem)
            <tr class="cart_item">

                <td class="product-remove">
                    <form action="{{ route('cart.destroy', $cartItem->rowId) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                        <button onclick="return confirm('Are you sure?')" class="btn-remove">x</button>
                    </form>
                </td>

                <td class="product-thumbnail">
                    <a href="{{ route('front.get.product', [$cartItem->product->slug]) }}">
                        @if(isset($cartItem->cover))
                            <img src="{{ asset("storage/$cartItem->cover") }}" alt="{{ $cartItem->name }}">
                        @else
                            <img src="https://placehold.it/120x120" alt="" class="img-responsive img-thumbnail">
                        @endif
                    </a>
                </td>

                <td data-title="Product" class="product-name">
                    <a href="{{ route('front.get.product', [$cartItem->product->slug]) }}">
                        <h3>{{ $cartItem->name }}</h3>
                        @if(isset($cartItem->options))
                            @foreach($cartItem->options as $key => $option)
                                @if($key == 'art_upload')
                                    <a href="{{asset($option)}}" target="_blank"><span class="label label-primary">See Art File Attached</span></a>
                                @else
                                    <span class="label label-primary">{{ $key }} : {{ $option }}</span>
                                @endif
                            @endforeach
                        @endif
                    </a>
                </td>

                <td data-title="Price" class="product-price">
                    <span class="amount"> {{ number_format($cartItem->price, 2) }}</span>
                </td>

                <td data-title="Total" class="product-subtotal">
                    <span class="amount">{{ number_format($cartItem->price * $cartItem->qty, 2) }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot></tfoot>
    </table>


    <div class="cart-collaterals">

        <div class="cart_totals ">

            <h2>Cart Totals</h2>

            <table class="shop_table shop_table_responsive">

                <tbody>
                    <tr class="cart-subtotal">
                        <th>Subtotal</th>
                        <td data-title="Subtotal"><span class="amount">{{config('cart.currency')}} {{ $subtotal }}</span></td>
                    </tr>


                    <tr class="shipping">
                        <th>Shipping</th>
                        <td data-title="Shipping">
                            <span class="amount">
                                @if(isset($shippingFee) && $shippingFee != 0)
                                {{config('cart.currency')}} {{ $shippingFee }}
                                @endif
                            </span>
                        </td>
                    </tr>

                    <tr class="shipping">
                        <th>Tax</th>
                        <td data-title="Shipping">
                            <span class="amount">
                                {{config('cart.currency')}} {{ number_format($tax, 2) }}
                            </span>
                        </td>
                    </tr>

                    <tr class="order-total">
                        <th>Total</th>
                        <td data-title="Total"><strong><span class="amount">{{config('cart.currency')}} {{ $total }}</span></strong> </td>
                    </tr>
                </tbody>
            </table>

            <div class="wc-proceed-to-checkout">
                <a href="{{ route('home') }}" class="checkout-button button alt wc-forward">Continue shopping</a>            
                <a class="checkout-button button alt wc-forward btn btn-primary" href="{{ route('checkout.index') }}">Proceed to Checkout</a>
            </div>
        </div>
    </div>

@else
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-warning">No products in cart yet. <a href="{{ route('home') }}">Shop now!</a></p>
        </div>
    </div>
@endif



