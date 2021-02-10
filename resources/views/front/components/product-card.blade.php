
    <div class="product-outer">
		<div class="media product-inner">

			<a class="media-left" href="{{ route('front.get.product', str_slug($product->slug)) }}" title="Pendrive USB 3.0 Flash 64 GB">
				<img class="media-object wp-post-image img-responsive" src="assets/images/blank.gif" data-echo="{{asset("storage/$product->cover")}}" alt="">

			</a>

			<div class="media-body">
				<span class="loop-product-categories">
					<a href="{{ route('front.get.product', str_slug($product->slug)) }}" rel="tag"></a>
				</span>

				<a href="{{ route('front.get.product', str_slug($product->slug)) }}">
					<h3>{{ $product->name }}</h3>
				</a>

				<div class="price-add-to-cart">
					<span class="price">
	                    <span class="electro-price">
	                        <ins><span class="amount"> <?php echo "55";?></span></ins>
	                        <?php //if($oldPrice):?>
	                            <del><span class="amount"><?php echo "33";?></span></del>
	                        <?php //endif;?>
                            <span class="amount"> <?php echo "20";?></span>
	                    </span>
	                </span>

					<a href="{{ route('front.get.product', str_slug($product->slug)) }}" class="button add_to_cart_button">Add to cart</a>
				</div><!-- /.price-add-to-cart -->

				<div class="hover-area">
	                <div class="action-buttons">

	                    <a href="#" class="add_to_wishlist">
	                            Wishlist</a>

	                    <a href="#" class="add-to-compare-link">Compare</a>
	                </div>
	            </div>

			</div>
		</div><!-- /.product-inner -->
	</div><!-- /.product-outer -->

