<div class="summary entry-summary">

	<h1 itemprop="name" class="product_title entry-title">{{$product->name}}</h1>

	<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		<div class="star-rating" title="Rated {{number_format($product->getAvgScoreAttribute(), 2)}} out of 5">
			<span style="width:{{$product->getAvgScoreAttribute() * 20}}%">
				<strong itemprop="ratingValue" class="rating">{{number_format($product->getAvgScoreAttribute(), 1)}}</strong> out of 
				<span itemprop="bestRating">5</span>				based on 
				<span itemprop="ratingCount" class="rating">{{$product->reviews->count()}}</span> customer ratings			
			</span>
		</div>
		<a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<span itemprop="reviewCount" class="count">{{$product->reviews->count()}}</span> customer reviews)</a>
	</div><!-- .woocommerce-product-rating -->

	<div itemprop="description">
		{!! $product->shortdescription !!}
	</div><!-- /description -->

</div><!-- .summary -->