<ul role="menu" class="submenu cat-products">
	@foreach($menu_products as $product)
	<li class="menu-item animate-dropdown menu-item-object-static_block">
		<a href="{{url('/product/'.$product->slug)}}">{{$product->name}}</a>
	</li>
	@endforeach
</ul>