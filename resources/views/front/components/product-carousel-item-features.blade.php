
<ul class="product-loop-categories">
    @foreach ($features as $feature)
        <li class="product-category product first"><a href="{{route('front.get.product', $feature->slug)}}"><img src="{{asset("storage/$feature->cover")}}" alt="" width="250" height="232"><h3>{{$feature->name}} <mark class="count">(2)</mark></h3></a></li>
    @endforeach
</ul>

