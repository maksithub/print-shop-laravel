@if(!empty($products) && !collect($products)->isEmpty())
<div class="woocommerce columns-3">
    <ul class="product-loop-categories">
        @foreach($products as $product)
            <li class="product-category product first">
                <a href="{{route('front.get.product', $product->slug)}}"><img src="{{asset("storage/$product->cover")}}" alt="" width="250" height="232"><h3>{{$product->name}} <mark class="count">(2)</mark></h3></a>
            </li><!-- /.products -->
        @endforeach
    </ul>
</div>
@else
    <p class="alert alert-warning">No products yet.</p>
@endif