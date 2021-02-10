
<ul class="products columns-2">
	@foreach($products as $product)
		<?php
		if(empty($i))
			$i = 0;
		$i++;
		$classes = '';
		if ( ( $i - 1 ) % 2 === 0) {
			$classes = 'first';
		}
		if ( 0 === $i % 2 ) {
			$classes = 'last';
		}
		?>

		<li class="product product-card <?php echo $classes; ?>">
			@include('front.components.product-card', ['product'=>$product])
		</li><!-- /.products -->
	@endforeach
	
</ul>
