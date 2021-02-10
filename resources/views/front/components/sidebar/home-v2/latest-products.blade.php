<aside class="widget widget_products">
    <h3 class="widget-title">Latest Products</h3>
    <ul class="product_list_widget">
        @foreach ($latests as $product)
        <li>
            <a href="{{ route('front.get.product', str_slug($product->slug)) }}" title="Notebook Black Spire V Nitro  VN7-591G">
                <img width="180" height="180" src="{{asset("storage/$product->cover")}}" alt="" class="wp-post-image"/><span class="product-title">{{$product->name}}</span>
            </a>
            <span class="electro-price"><ins><span class="amount">{{$product->price}}</span></ins> <del><span class="amount">todo</span></del></span>
        </li>
        @endforeach
    </ul>
</aside>
