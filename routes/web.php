<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Shop\products\Product;

/**
 * Admin routes
 */
Route::namespace('Admin')->group(function () {
    Route::get('admin/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('admin/login', 'LoginController@login')->name('admin.login');
    Route::get('admin/logout', 'LoginController@logout')->name('admin.logout');
});
Route::group(['prefix' => 'admin', 'middleware' => ['employee'], 'as' => 'admin.' ], function () {
    Route::namespace('Admin')->group(function () {
        Route::group(['middleware' => ['role:admin|superadmin|clerk, guard:employee']], function () {
            Route::get('/', 'DashboardController@index')->name('dashboard');
            Route::namespace('Products')->group(function () {
                Route::resource('products', 'ProductController');
                Route::get('remove-image-product', 'ProductController@removeImage')->name('product.remove.image');
                Route::get('remove-image-thumb', 'ProductController@removeThumbnail')->name('product.remove.thumb'); 
                Route::post('products/{productID}/saveattributesfactor', 'ProductController@updateProductAttribute')->name('products.updateProductAttribute');
            });
            Route::namespace('Customers')->group(function () {
                Route::resource('customers', 'CustomerController');
                Route::resource('customers.addresses', 'CustomerAddressController');
            });
            Route::namespace('Categories')->group(function () {
                Route::resource('categories', 'CategoryController');
                Route::get('remove-image-category', 'CategoryController@removeImage')->name('category.remove.image');
            });
            Route::namespace('Orders')->group(function () {
                Route::resource('orders', 'OrderController');
                Route::resource('order-statuses', 'OrderStatusController');
                Route::get('orders/{id}/invoice', 'OrderController@generateInvoice')->name('orders.invoice.generate');
            });
            Route::namespace('Attributes')->group(function () {
                Route::resource('attributes', 'AttributeController');
                Route::resource('attributes.values', 'AttributeValueController');
                Route::get('products/{productID}/attributes/create', 'AttributeController@create')->name('products.attributes.create');
                Route::post('products/{productID}/attributes/store/', 'AttributeController@store')->name('products.attributes.store');
                Route::get('products/{productID}/attributes/{attributeID}/edit', 'AttributeController@edit')->name('products.attributes.edit');
                Route::put('products/{productID}/attributes/{attributeID}/update', 'AttributeController@update')->name('products.attributes.update');
                Route::get('products/{productID}/attributes/{attributeID}', 'AttributeController@show')->name('products.attributes.show');
                Route::delete('products/{productID}/attributes/{attributeID}/destroy', 'AttributeController@destroy')->name('products.attributes.destroy');

                Route::get('products/{productID}/attributes/{attributeID}/values/create', 'AttributeValueController@create')->name('products.attributes.values.create');
                Route::post('products/{productID}/attributes/{attributeID}/values/store', 'AttributeValueController@store')->name('products.attributes.values.store');
                Route::put('products/{productID}/attributes/{attributeID}/values/update', 'AttributeValueController@update')->name('products.attributes.values.update');
                Route::delete('products/{productID}/attributes/{attributeID}/values/{attributeValueID}/destroy', 'AttributeValueController@destroy')->name('products.attributes.values.destroy');
            });
            Route::resource('addresses', 'Addresses\AddressController');
            Route::resource('countries', 'Countries\CountryController');
            Route::resource('countries.provinces', 'Provinces\ProvinceController');
            Route::resource('countries.provinces.cities', 'Cities\CityController');
            Route::resource('couriers', 'Couriers\CourierController');
            Route::resource('brands', 'Brands\BrandController');

        });
        Route::group(['middleware' => ['role:admin|superadmin, guard:employee']], function () {
            Route::resource('employees', 'EmployeeController');
            Route::get('employees/{id}/profile', 'EmployeeController@getProfile')->name('employee.profile');
            Route::put('employees/{id}/profile', 'EmployeeController@updateProfile')->name('employee.profile.update');
            Route::resource('roles', 'Roles\RoleController');
            Route::resource('permissions', 'Permissions\PermissionController');
        });
    });
});

/**
 * Frontend routes
 */
Auth::routes();

Route::get('products_data', function(){
    $products =  Product::with('attributes', 'attributes.values')->get();
    return view('productdata')->with(['products'=>$products]);

});

Route::namespace('Auth')->group(function () {
    Route::get('cart/login', 'CartLoginController@showLoginForm')->name('cart.login');
    Route::post('cart/login', 'CartLoginController@login')->name('cart.login');
    Route::get('logout', 'LoginController@logout');
});

Route::namespace('Front')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('store-directory', 'StoreDirectoryController@index');
    Route::get('contactus', 'ContactUsController@index');
    Route::get('faq', 'FaqController@index');
    Route::post('upload', 'UploadController@index')->name('upload.index');
    Route::post('images-upload', 'UploadController@imagesUploadPost')->name('images.upload');

    Route::group(['middleware' => ['auth', 'web']], function () {

        Route::namespace('Payments')->group(function () {
            Route::get('bank-transfer', 'BankTransferController@index')->name('bank-transfer.index');
            Route::post('bank-transfer', 'BankTransferController@store')->name('bank-transfer.store');
        });

        Route::namespace('Addresses')->group(function () {
            Route::resource('country.state', 'CountryStateController');
            Route::resource('state.city', 'StateCityController');
        });

        Route::get('accounts', 'AccountsController@index')->name('accounts');
        Route::get('checkout', 'CheckoutController@index')->name('checkout.index');
        Route::post('checkout', 'CheckoutController@store')->name('checkout.store');
        Route::get('checkout/execute', 'CheckoutController@executePayPalPayment')->name('checkout.execute');
        Route::post('checkout/execute', 'CheckoutController@charge')->name('checkout.execute');
        Route::get('checkout/cancel', 'CheckoutController@cancel')->name('checkout.cancel');
        Route::get('checkout/success', 'CheckoutController@success')->name('checkout.success');
        Route::resource('customer.address', 'CustomerAddressController');
    });
    Route::resource('cart', 'CartController');

    Route::get("category/{slug}", 'CategoryController@getCategory')->name('front.category.slug');
    Route::get("search", 'ProductController@search')->name('search.product');
    Route::get("/product/{product}", 'ProductController@show')->name('front.get.product');
    Route::post('product/review', 'ProductController@review');
});


Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path('public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

