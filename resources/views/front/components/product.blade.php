<div class="product-outer">
    <div class="product-inner">
        <a href="{{ route('front.get.product', str_slug($product->slug)) }}">
           <img src="assets/images/blank.gif" data-echo="{{ asset("storage/$product->cover") }}" class="img-responsive" alt="{{ $product->name }}">
        </a>

        <div class="media-body">

            <a href="{{ route('front.get.product', str_slug($product->slug)) }}">
                <h3>{{ $product->name }}</h3>
            </a>

            <div class="price-add-to-cart">
                <span class="price">
                    <span class="electro-price">
                        <span class="amount">
                                {{ config('cart.currency') }}
                                {{ number_format($product->price, 2) }}
                        </span>
                    </span>
                </span>
                <form action="{{ route('cart.store') }}" class="form-inline" method="post">
                    {{ csrf_field() }}
                    @foreach ($productAttributes as $attribute)
                        {{-- expr --}}
                    @endforeach
                    <input type="hidden" name="quantity" value="1" />
                    <input type="hidden" name="product" value="{{ $product->id }}">
                    <button id="add-to-cart-btn" type="submit" class="button add_to_cart_button" data-toggle="modal" data-target="#cart-modal"> <i class="fa fa-cart-plus"></i> Add to cart</button>
                </form>
            </div><!-- /.price-add-to-cart -->

            <div class="hover-area">
                <div class="action-buttons">
                   <a href="#" rel="nofollow" class="add_to_wishlist"> Wishlist</a>
                </div>
            </div>

        </div>


    </div><!-- /.product-inner -->
</div><!-- /.product-outer -->
