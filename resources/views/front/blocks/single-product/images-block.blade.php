<div class="images electro-gallery">
	<div class="thumbnails-single owl-carousel">
		@foreach($images as $image)
		<a href="{{asset("storage/$image->src")}}" class="zoom" title="" data-rel="prettyPhoto[product-gallery]">
			<img src="/assets/images/blank.gif" data-echo="{{asset("storage/$image->src")}}" class="wp-post-image" alt="">
		</a>
		@endforeach
	</div><!-- .thumbnails-single -->

	<div class="thumbnails-all columns-5 owl-carousel">
		@foreach($images as $image)
		<a href="{{asset("storage/$image->src")}}" class="" title="">
			<img src="/assets/images/blank.gif" data-echo="{{asset("storage/$image->src")}}" class="wp-post-image" alt="">
		</a>
		@endforeach

	</div><!-- .thumbnails-all -->
</div><!-- .electro-gallery -->
