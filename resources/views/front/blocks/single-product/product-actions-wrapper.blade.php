<div class="product-actions-wrapper">
	<div class="product-actions">
		<div class="availability in-stock">
			<span>Configure and Price</span>
		</div><!-- /.availability -->

		<form class="variations_form cart" action = "{{ route('upload.index') }}" method="post">

			{{ csrf_field() }}

			<table class="variations">
				<tbody>
					<tr>
						@foreach ($product->attributes as $attribute)
							@if($attribute->hide == false && $attribute->name != 'Width' && $attribute->name != 'Height')
								<td class="label"><label>{{ $attribute->name }}</label></td>
								<td class="value">
									<select id="attr{{$attribute->id}}" class="attribute" name="attr{{$attribute->id}}" data-attribute_name="aattr{{$attribute->id}}">
										@foreach ($attribute->values as $value)
									<option value="{{$value->id}}" {{ $value->default == 1 ? 'selected="selected"' : '' }} data-factor="{{$value->factor}}">{{$value->value}}</option>
										@endforeach
									</select>
									<a class="reset_variations" href="#">Clear</a>
								</td>
							@endif
						@endforeach
					</tr>
				</tbody>
			</table>


			<div class="single_variation_wrap">
				<div class="woocommerce-variation single_variation"></div>
				<div class="woocommerce-variation-add-to-cart variations_button">
					<button type="submit" class="single_add_to_cart_button button alt"><i class="fa fa-cloud-upload" aria-hidden="true"></i> UPLOAD YOUR FILE</button>
					<input type="hidden" name="product" value="{{ $product->id }}" />
					<input type="hidden" name="productName" value="{{ $product->name }}" />
					<input type="hidden" name="add-to-cart" value="{{ $product->id }}" />
					<input type="hidden" name="product_id" value="{{ $product->id }}" />
					<input type="hidden" name="variation_id" class="variation_id" value="0" />
					<input type="hidden" name="quantity" class="variation_id" value="1" />
					<input type="hidden" name="final_price" value="{{$product->price}}">
				</div>
			</div>
		</form><!-- /.variations_form -->
		<div itemprop="offers">

			<p class="price">
				<span class="electro-price">Printing Cost: <ins>$<span class="amount">{{$product->price}}</span></ins></span>
				<input type="hidden" name="basic_price" value="{{$product->price}}">
			</p>

		</div>
	</div><!-- /.product-actions -->
</div><!-- /.product-actions-wrapper -->

<script type="text/javascript">

(function () {
	$(".variations_form .attribute").change(function(){
		var selected = $(".variations_form .attribute").find(":selected");
		var basic_price = parseFloat($("input[name='basic_price']").val());
		var sum_price = basic_price;
		selected.each(function(index){
			console.log($(this).attr("data-factor"));
			sum_price = sum_price*parseFloat($(this).attr("data-factor"));
		});
		$(".price .amount").text(sum_price.toFixed(2));
		$("input[name='final_price']").val(sum_price.toFixed(2));

	});
})();

</script>