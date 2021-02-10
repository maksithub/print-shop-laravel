<section>
    <header>
        <h2 class="h1">Best Deals</h2>
    </header>
    <div class="woocommerce columns-3">
        <ul class="product-loop-categories">
            @foreach ($best_deals as $product)
                <li class="product-category product first"><a href="{{route('front.get.product', $product->slug)}}"><img src="{{asset("storage/$product->cover")}}" alt="" width="250" height="232"><h3>{{$product->name}} <mark class="count">(2)</mark></h3></a></li>
            @endforeach
        </ul>
    </div>
</section>
