<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Shop\ProductAttributes\ProductAttribute;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getAttributesRatesOnLoad', function () {
	$product_id = request('product_id');
	$attribute_values_ids = request('attribute_values_ids');

   $total_price = 0;
	foreach ($attribute_values_ids as $key => $value) {
	   $attribute_id = $value['thiskey'];
	   $attribute_value_id = $value['thisvalue'];
	    $this_price = DB::table('attribute_value_product_attribute')->where('product_attribute_id', $product_id)->where('attribute_id', $attribute_id)->where('attribute_value_id', $attribute_value_id)->value('addprice');
		$total_price += $this_price;
	}

	return $total_price;
  
})->name('getAttributesRatesOnLoad');

Route::get('/getAttributesRates', function () {
	//first get the attributes of this product only
	$product_id = request('product_id');
	$attribute_id = request('attribute_id');
	$prev_attribute_value_id = request('prev_attribute_value_id');
	$attribute_value_id = request('attribute_value_id');

	//get the product attribute old selected value price
	$old_price = DB::table('attribute_value_product_attribute')->where('product_attribute_id', $product_id)->where('attribute_id', $attribute_id)->where('attribute_value_id', $prev_attribute_value_id)->value('addprice');

	//get the product attribute new selected value price
	$new_price = DB::table('attribute_value_product_attribute')->where('product_attribute_id', $product_id)->where('attribute_id', $attribute_id)->where('attribute_value_id', $attribute_value_id)->value('addprice');
	$data = ['old_price' => $old_price, 'new_price' => $new_price];
	return $data;
  
})->name('getAttributesRates');

