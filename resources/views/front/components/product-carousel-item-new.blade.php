
<ul class="product-loop-categories">
    @foreach ($latests as $latest)
        <li class="product-category product first"><a href="{{route('front.get.product', $latest->slug)}}"><img src="{{asset("storage/$latest->cover")}}" alt="" width="250" height="232"><h3>{{$latest->name}} <mark class="count">(2)</mark></h3></a></li>
    @endforeach
</ul>

