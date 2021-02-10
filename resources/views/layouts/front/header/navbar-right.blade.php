<?php
	$cartItems = Cart::content();
	$cartTotal = Cart::total();
?>
<ul class="navbar-mini-cart navbar-nav animate-dropdown nav pull-right flip">
	<li class="nav-item dropdown">
		<a href="/cart" class="nav-link" data-toggle="">
			<i class="ec ec-shopping-bag"></i>
			<span class="cart-items-count count">{{$cartItems->count()}}</span>
			<span class="cart-items-total-price total-price"><span class="amount">&#36;{{$cartTotal}}</span></span>
		</a>
		@if (sizeof($cartItems) > 0)
		<ul class="dropdown-menu dropdown-menu-mini-cart">
			<li>
				<div class="widget_shopping_cart_content">

					<ul class="cart_list product_list_widget ">
						@foreach($cartItems as $cartItem)
						<li class="mini_cart_item">
		                    <form action="{{ route('cart.destroy', $cartItem->rowId) }}" method="post">
		                        {{ csrf_field() }}
		                        <input type="hidden" name="_method" value="delete">
		                        <button onclick="return confirm('Are you sure?')" class="btn-remove remove">x</button>
		                    </form>

		                    <a href="{{ route('front.get.product', [$cartItem->product->slug]) }}">
		                        @if(isset($cartItem->cover))
		                            <img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="{{ asset("storage/$cartItem->cover") }}" alt="{{ $cartItem->name }}">{{ $cartItem->name }}
		                        @else
		                            <img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="https://placehold.it/120x120" alt="" class="img-responsive img-thumbnail">{{ $cartItem->name }}
		                        @endif
		                    </a>

							<span class="quantity">{{ $cartItem->qty }} × <span class="amount">&#36;{{ number_format($cartItem->price, 2) }}</span></span>			
						</li>
						@endforeach

					</ul><!-- end product list -->
					<p class="total"><strong>Subtotal:</strong> <span class="amount">£969.98</span></p>
					<p class="buttons">
						<a class="button wc-forward" href="/cart">View Cart</a>
						<a class="button checkout wc-forward" href="/checkout">Checkout</a>
					</p>
				</div>
			</li>
		</ul>
		@endif
	</li>
</ul>

<ul class="navbar-compare nav navbar-nav pull-right flip navbar-account">
	<li class="nav-item menu-item-has-children animate-dropdown dropdown">
		<a class="nav-link" href="{{ route('accounts', ['tab' => 'profile']) }}" data-toggle="" aria-haspopup="true"><i class="ec ec-user"></i>
			Hi, @if(auth()->check()) {{auth()->user()->name}} @else Login @endif !</a>
            <ul role="menu" class="dropdown-menu">
				@if(auth()->check())
					<li class="nav-item animate-dropdown"><a class="nav-link" href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
				@else
					<li class="nav-item animate-dropdown"><a class="nav-link" href="{{ route('login') }}"> <i class="fa fa-lock"></i> Login</a></li>
					<p style="font-size: 12px; margin-bottom: 0;">Don't have an account yet?</p>
					<li class="nav-item animate-dropdown"><a class="nav-link" href="{{ route('register') }}">
						<i class="fa fa-sign-in"></i> Register</a></li>
				@endif
            </ul>		
	</li>
<ul>

