<div class="product-actions-wrapper">
	<div class="product-actions">
		<div class="availability in-stock">
			<span>Configure and Price</span>
		</div><!-- /.availability -->

		<form class="variations_form cart" action = "{{ route('cart.store') }}" method="post">

			{{ csrf_field() }}

			<table class="variations">
				<tbody>
					<tr>
						@foreach ($product->attributes as $attribute)
							@if($attribute->hide == false && $attribute->name != 'Width' && $attribute->name != 'Height')
								<td class="label"><label>{{ $attribute->name }}</label></td>
								<td class="value">
									<input type="hidden" class="attribute_id" value="{{$attribute->id}}">

									<select id="attr{{$attribute->id}}" class="product_attr" name="attr{{$attribute->id}}" data-attribute_name="aattr{{$attribute->id}}">
										@foreach ($attribute->values as $value)
									<option value="{{$value->id}}" {{ $value->default == 1 ? 'selected="selected"' : '' }}>{{$value->value}}</option>
										@endforeach
									</select>
									<a class="reset_variations" href="#">Clear</a>
								</td>
							@endif
						@endforeach
					</tr>
				</tbody>
			</table>
			<input type="hidden" name="" id="total_price" value="">


			<div class="single_variation_wrap">
				<div class="woocommerce-variation single_variation"></div>
				<div class="woocommerce-variation-add-to-cart variations_button">
					<button type="submit" class="single_add_to_cart_button button alt"><i class="fa fa-cloud-upload" aria-hidden="true"></i> UPLOAD YOUR FILE</button>
					<input type="hidden" name="product" value="{{ $product->id }}" />
					<input type="hidden" name="add-to-cart" value="2439" />
					<input type="hidden" name="product_id" value="2439" />
					<input type="hidden" name="variation_id" class="variation_id" value="0" />
				</div>
			</div>
		</form><!-- /.variations_form -->
		<div itemprop="offers">

			<p class="price">
				<span class="electro-price">Printing Cost: <ins>$<span class="amount">{{$product->price}}</span></ins></span>
			</p>

		</div>
	</div><!-- /.product-actions -->
</div><!-- /.product-actions-wrapper -->


<script>
	var product_id = jQuery('input[name="product"]').val();

//show total price for default set attribute values i.e. options

$( document ).ready(function() {
    //if any value is not set to default, fetch selected option
	$attribute_values_ids = [];
    $(".product_attr").each(function() {
	    $attribute_values_ids.push({
            thiskey: jQuery(this).siblings('.attribute_id').val(), 
            thisvalue:  jQuery(this).val(),
        });
	});
	//now, fetch all these ids and get the prices sum from php
		jQuery.ajax({
			url: '{{route("getAttributesRatesOnLoad")}}',
			method: 'GET',
			data: { 'product_id':product_id, 'attribute_values_ids':$attribute_values_ids },
			success: function (response) {
			$price = parseFloat(response).toFixed(2);
			$total_price = jQuery('.amount').text($price);
			jQuery('#total_price').val($price);
			}
		});
});


(function () {
    var previous;

    $(".product_attr").on('focus', function () {
        // Store the current value on focus and on change
        previous = this.value;
    }).change(function() {
        // Do something with the previous value after the change
        ////////////////////////////////////////////
        	var attribute_id = jQuery(this).siblings('.attribute_id').val(); //get the attribute id that is just changed and save the total sum before that for its addition or substraction on the basis of newly selected attribute value's price
			var attribute_value_id = jQuery(this).val(); // get attribute value for attribue before change 
        	var prev_attribute_value_id = previous;

		jQuery.ajax({
			url: '{{route("getAttributesRates")}}',
			method: 'GET',
			data: { 'product_id':product_id, 'attribute_id':attribute_id, 'attribute_value_id':attribute_value_id, 'prev_attribute_value_id':prev_attribute_value_id },
			success: function (response) {
				if (response.old_price !== null) {
					$previous_selected_attribute_value_price = parseFloat(response.old_price);
				} else {
					$previous_selected_attribute_value_price = 0.00;
				}
				if (response.new_price !== null) {
					$selected_attribute_value_price = parseFloat(response.new_price);
				} else {
					$selected_attribute_value_price = 0.00;
				}

				$total_price = jQuery('#total_price').val();
	            $sub_old_selected_attr_value_price = $total_price - $previous_selected_attribute_value_price;
				// console.log($total_price);
				$add_new_selected_attr_value_price = $sub_old_selected_attr_value_price + $selected_attribute_value_price;
				// console.log($sub_old_selected_attr_value_price);
	            $new_total_price = $add_new_selected_attr_value_price.toFixed(2);
				// console.log($add_new_selected_attr_value_price);
				jQuery('#total_price').val($new_total_price);
				jQuery('.amount').text($new_total_price);
			}
		});
        ////////////////////////////////////////////

        // at last Make sure the previous value is updated
        previous = this.value;
    });
})();

        </script>
