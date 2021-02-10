<div class="woocommerce-tabs wc-tabs-wrapper">
	<ul class="nav nav-tabs electro-nav-tabs tabs wc-tabs" role="tablist">
		<li class="nav-item reviews_tab">
			<a href="#tab-reviews" class="active" data-toggle="tab">Reviews</a>
		</li>

		<li class="nav-item description_tab">
			<a href="#tab-description" data-toggle="tab">Overview</a>
		</li>

<!-- 		<li class="nav-item specification_tab">
			<a href="#tab-specification" data-toggle="tab">Specification</a>
		</li> -->

		<li class="nav-item accessories_tab">
			<a href="#tab-accessories" data-toggle="tab">Accessories</a>
		</li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane active panel entry-content wc-tab" id="tab-reviews">
			@include('front.blocks.single-product.woocommerce-tabs.reviews-tab')
		</div><!-- /.panel -->

		<div class="tab-pane in panel entry-content wc-tab" id="tab-description">
			@include('front.blocks.single-product.woocommerce-tabs.description-tab')
		</div>

		<div class="tab-pane panel entry-content wc-tab" id="tab-specification">
			@include('front.blocks.single-product.woocommerce-tabs.specification-tab')
		</div><!-- /.panel -->

		<div class="tab-pane panel entry-content wc-tab" id="tab-accessories">
			{{--@include('front.blocks.single-product.woocommerce-tabs.accessories-tab')--}}
		</div>
	</div>
</div><!-- /.woocommerce-tabs -->