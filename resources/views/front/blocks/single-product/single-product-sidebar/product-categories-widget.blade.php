<aside id="electro_product_categories_widget-2" class="widget woocommerce widget_product_categories electro_widget_product_categories">
	<ul class="product-categories category-single">
		<li class="product_cat">

			<ul class="show-all-cat">
				<li class="product_cat">
					<span class="show-all-cat-dropdown">
						Show All Categories
					</span>
					<ul style="display: none">
						@foreach ($cats as $cat)
						<li class="cat-item cat-item-228">
							<a href="{{route("catetory/$cat->slug")}}">{{$cat->name}}</a>
							 <span class="count">(0)</span>
						</li>
						@endforeach
					</ul>
				</li>
			</ul>
		</li><!-- .product_cat -->
	</ul><!-- .product-categories -->
</aside><!-- .widget -->