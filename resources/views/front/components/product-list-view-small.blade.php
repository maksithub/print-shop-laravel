<div role="tabpanel" class="tab-pane" id="list-view-small" aria-expanded="true">
	@include('front.components.product-image')

	<ul class="products columns-3">
		@foreach($products as $product)
			<li class="product list-view list-view-small">
				<div class="media">
					<div class="media-left">
						<a href="{{ route('front.get.product', [$cartItem->product->slug]) }}">
							<img class="wp-post-image" data-echo="{{ asset("storage/$product->cover") }}?>" src="assets/images/blank.gif" alt="">
						</a>
					</div>
					<div class="media-body media-middle">
						<div class="row">
							<div class="col-xs-12">
									<div class="product-short-description">
										<ul style="padding-left: 18px;">
											<li>4.5 inch HD Screen</li>
											<li>Android 4.4 KitKat OS</li>
											<li>1.4 GHz Quad Core&trade; Processor</li>
											<li>20 MP front Camera</li>
										</ul>
									</div>
									<div class="product-rating">
										<div title="Rated 4 out of 5" class="star-rating"><span style="width:80%"><strong class="rating">4</strong> out of 5</span></div> (3)
									</div>
								</a>
							</div>
							<div class="col-xs-12">
								<div class="price-add-to-cart">
									<span class="price"><span class="electro-price"><span class="amount">$1,218.00</span></span></span>
									<a class="button add_to_cart_button" href="{{route('front.category.slug', $category->slug)}}" rel="nofollow">Add to cart</a>
								</div><!-- /.price-add-to-cart -->
							</div>
						</div>
					</div>
				</div>
			</li>
		<?php } ?>
	</ul>
</div>
