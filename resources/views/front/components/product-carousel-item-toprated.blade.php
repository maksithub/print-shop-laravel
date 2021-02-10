
<ul class="product-loop-categories">
    @foreach ($toprates as $toprate)
        <li class="product-category product first"><a href="{{route('front.get.product', $toprate->slug)}}"><img src="{{asset("storage/$toprate->cover")}}" alt="" width="250" height="232"><h3>{{$toprate->name}} <mark class="count">(2)</mark></h3></a></li>
    @endforeach
</ul>

