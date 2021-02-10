<aside id="woocommerce_products-2" class="widget woocommerce widget_products">
	<h3 class="widget-title">Latest Products</h3>
	<ul class="product_list_widget">
		@foreach ($products as $product)
		<li>
			<a href="{{route("products/$product->slug")}}" title="Notebook Black Spire V Nitro  VN7-591G">
				<img class="wp-post-image" src="{{asset("storage/$product->cover")}}" alt="">		
				<span class="product-title">{{$product->name}}</span>
			</a>
			<span class="electro-price"><ins><span class="amount">{{
				$product->price}}</span></ins> <del><span class="amount">&#36;todo</span></del></span>
		</li>
		@endforeach
	</ul><!-- .product_list_widget -->
</aside><!-- .widget -->