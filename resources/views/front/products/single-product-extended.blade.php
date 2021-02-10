<div id="content" class="site-content" tabindex="-1">
	<div class="container">

		<nav class="woocommerce-breadcrumb">
			<a href="{{url('/')}}">Home</a>
			<span class="delimiter"><i class="fa fa-angle-right"></i></span>
			Product
			<span class="delimiter"><i class="fa fa-angle-right"></i></span>
			{{$product->name}}
		</nav>

		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<div class="product">
					<div class="single-product-wrapper">
						<div class="product-images-wrapper">
							<span class="onsale">Sale!</span>
							@include('front.blocks.single-product.images-block')

						</div><!-- /.product-images-wrapper -->
						@include('front.blocks.single-product.single-product-extended-summary')
						@include('front.blocks.single-product.product-actions-wrapper')
					</div><!-- /.single-product-wrapper -->

					@include('front.blocks.single-product.woocommerce-tabs')
				</div><!-- /.product -->
			</main><!-- /.site-main -->
		</div><!-- /.content-area -->
	</div><!-- /.container -->
</div><!-- /.site-content -->
