<div class="accessories">

	<div class="electro-wc-message"></div>
	<div class="row">
		<div class="col-xs-12 col-sm-9 col-left">
			<ul class="products columns-5">
				@foreach ($assets as $asset)
					<li class="product">
						<div class="product-outer">
							<div class="product-inner">
								<a href="{{route("assets/$asset->slug")}}">
									<h3>{{$asset->name}}</h3>
									<div class="product-thumbnail">
										
										<img data-echo="{{asset("storage/$asset->thumbnail")}}" src="assets/images/blank.gif" alt="">
																												
									</div>
								</a>
							</div><!-- /.product-inner -->
						</div><!-- /.product-outer -->
					</li>
				@endforeach
			</ul><!-- /.products -->
		</div><!-- /.col -->
	</div><!-- /.row -->

</div><!-- /.accessories -->
