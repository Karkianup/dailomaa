<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\ForgotPasswordController;
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

Route::get('/', 'Frontend\HomeController@index')->name('home');
// Route::get('/cart', 'Frontend\CartController@index')->name('cart.index');

Route::get('cmd',function(){
    \Artisan::call('config:cache');
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    echo "Success !!";
});


Route::get('/cart', 'Frontend\CartController@cart')->name('cart.index');
Route::post('/add', 'Frontend\CartController@add')->name('cart.store');
Route::post('/add-to-cart', 'Frontend\CartController@addFromProductPage')->name('product-page-cart.store');
Route::post('/update', 'Frontend\CartController@update')->name('cart.update');
Route::post('/remove', 'Frontend\CartController@remove')->name('cart.remove');
Route::post('/clear', 'Frontend\CartController@clear')->name('cart.clear');


Route::get('/direct-order', 'Frontend\DirectOrderController@index')->name('direct-order.index')->middleware('auth');
Route::post('direct-order', 'Frontend\DirectOrderController@store')->name('direct-order.store');

// Route::post('/checkout', 'Frontend\CheckoutController@checkout')->name('checkout.index');
Route::get('/checkout', 'Frontend\CheckoutController@cartCheckout')->name('checkout-from-cart');

// After clicking proceed to pay button
Route::post('payment', 'Frontend\OrderController@paymentMethods')->name('checkout-payment');

// Route::middleware(['auth'])->group(function () {
// Start for Esewa

Route::get('/checkout/payment/esewa/completed/{randomOrderID}', [
    'name' => 'Esewa Payment Completed',
    'as' => 'checkout.payment.esewa.completed',
    'uses' => 'Frontend\EsewaController@orderCompleted',
]);

Route::get('/checkout/payment/failed/{randomOrderID}', [
    'name' => 'Esewa Payment Failed',
    'as' => 'checkout.payment.esewa.failed',
    'uses' => 'Frontend\EsewaController@orderFailed',
]);

Route::post('/checkout/payment/esewa/process', [
    'name' => 'Esewa Checkout Payment',
    'as' => 'checkout.payment.esewa.process',
    'uses' => 'Frontend\EsewaController@process',
]);


// End for esewa

// Start for cash on delivery

Route::post('/checkout/payment/cod/process', [
    'name' => 'Cash on Delivery Payment Process',
    'as' => 'checkout.payment.cod.process',
    'uses' => 'Frontend\OrderController@cashOnDelivery',
]);

// End for cash on delivery

// Start for CellPay

Route::get('/checkout/payment/cellpay/process', [
    'name' => 'CellPay Checkout Process',
    'as' => 'checkout.payment.cellpay.process',
    'uses' => 'Frontend\CellPayController@process',
]);

Route::post('/checkout/payment/cellpay/completed/{random_order_id}', [
    'name' => 'CellPay Payment Completed',
    'as' => 'checkout.payment.cellpay.completed',
    'uses' => 'Frontend\CellPayController@paymentCompleted',
]);

// Route::get('/checkout/payment/cellpay/completed/{random_order_id}', function (Request $request) {
//     // return $request->route('name');
//     dd('hi');
// })->name('checkout.payment.cellpay.completed');


Route::get('/checkout/payment/cellpay/failed/{random_order_id}', [
    'name' => 'CellPay Payment Failed',
    'as' => 'checkout.payment.cellpay.failed',
    'uses' => 'Frontend\CellPayController@paymentFailed',
]);

Route::get('/checkout/payment/cellpay/cancelled/{random_order_id}', [
    'name' => 'CellPay Payment Cancelled',
    'as' => 'checkout.payment.cellpay.cancelled',
    'uses' => 'Frontend\CellPayController@paymentCancelled',
]);
// });


Route::post('review', 'Frontend\ReviewController@store')->name('review');
Auth::routes();

Route::prefix('admin')->group(function () {
    //admin password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::prefix('retailer')->group(function () {
    //retailer password reset routes
    Route::post('/password/email', 'Auth\RetailerForgotPasswordController@sendResetLinkEmail')->name('retailer.password.email');
    Route::get('/password/reset', 'Auth\RetailerForgotPasswordController@showLinkRequestForm')->name('retailer.password.request');
    Route::post('/password/reset', 'Auth\RetailerResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\RetailerResetPasswordController@showResetForm')->name('retailer.password.reset');
});

Route::get('google', function () {

    return view('auth/google-login');
});

Route::get('auth/google', 'Auth\Google\LoginController@redirectToGoogle')->name('google-login-proceed');

Route::get('auth/google/callback', 'Auth\Google\LoginController@handleGoogleCallback');


Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/login/retailer', 'Auth\LoginController@showRetailerLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
// Route::get('/register/retailer', 'Auth\RegisterController@showRetailerRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/retailer', 'Auth\LoginController@retailerLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
// Route::post('/register/retailer', 'Auth\RegisterController@createRetailer');

Route::get('page/{url}', 'Frontend\PageController@show')->name('page-wise');

Route::get('product/{slug}', 'Frontend\ProductController@details')->name('product-details');

Route::get('category/{slug}', 'Frontend\ProductController@categoryWise')->name('product-category-wise');

// Filtering category according to price
Route::get('category/filter/price', 'Frontend\ProductFilterController@categoryPrice')->name('filter-product-by-price');

// Sorting products according to sub category after getting filtered according to price
Route::get('category/filter/min={minPrice}/max={maxPrice}', 'Frontend\ProductFilterController@categoryPriceSort')->name('category-price-sort');

Route::get('content/{slug}', 'Frontend\ProductController@subCategoryWise')->name('product-sub-category-wise');

// Filtering sub category according to price
Route::get('content/filter/price', 'Frontend\ProductFilterController@subCategoryPrice')->name('filter-product-by-price');

// Sorting products according to sub category after getting filtered according to price
Route::get('content/filter/min={minPrice}/max={maxPrice}', 'Frontend\ProductFilterController@subCategoryPriceSort')->name('content-price-sort');

Route::get('/search', 'Frontend\SearchController@search')->name('search.index');

// Filtering searched according to price
Route::get('search/filter/price', 'Frontend\SearchController@searchByPrice')->name('search-product-by-price');

// For sorting the product after searching
Route::get('search/product/filter/{product}', 'Frontend\SearchController@justSort')->name('search-and-sort');

// For sorting the product after sorting according to price
Route::get('search/filter/product={product}/min={minPrice}/max={maxPrice}', 'Frontend\SearchController@searchAndSort')->name('search-product-and-sort');

Route::get('/contact', 'Frontend\ContactController@index')->name('contact');

Route::post('contact', 'Frontend\ContactController@contact')->name('contact-store');

Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function () {
    Route::get('/dashboard', 'Admin\DashboardController@index');

    Route::resource('profile', 'Commons\ProfileController', ['as' => 'admin_profile']);

    Route::get('/change-password', 'Commons\ProfileController@changePassword');
    Route::put('/update-password', 'Commons\ProfileController@updatePassword');

    Route::get('/developer', 'Developer\DeveloperController@index');

    Route::get('route-cache', 'Developer\DeveloperController@routeCache')->name('admin-route-cache');

    Route::get('route-clear', 'Developer\DeveloperController@routeClear')->name('admin-route-clear');

    Route::get('view-cache', 'Developer\DeveloperController@viewCache')->name('admin-view-cache');

    Route::get('view-clear', 'Developer\DeveloperController@viewClear')->name('admin-view-clear');

    Route::get('config-cache', 'Developer\DeveloperController@configCache')->name('admin-config-cache');

    Route::get('config-clear', 'Developer\DeveloperController@configClear')->name('admin-config-clear');

    Route::get('cache-clear', 'Developer\DeveloperController@cacheClear')->name('admin-cache-clear');

    Route::get('clear-clockwork', 'Developer\DeveloperController@clearClockwork')->name('admin-clear-clockwork');

    Route::get('optimize', 'Developer\DeveloperController@optimizeForce')->name('admin-optimize');

    // For menucategory
    Route::resource('menu-category', 'Admin\MenuCategoryController', ['as' => 'admin']);

    Route::get('menu-category/menu/{id}', 'Admin\MenuCategoryController@categoryWiseMenus')
        ->name('admin-menu-category-wise-menus');

    // For menu
    Route::resource('menu', 'Admin\MenuController', ['as' => 'admin']);

    //  For updating menu order
    Route::post('update-menu', 'Admin\MenuController@updateOrder')->name('update-menu');

    // For menu items
    Route::resource('menu-item', 'Admin\MenuItemsController', ['as' => 'admin']);

    Route::get('menu-category/menu/menu-items/{id}', 'Admin\MenuController@menuWiseMenuItems')
        ->name('admin-menu-wise-menu-items');

    //  For updating menu item order
    Route::post('update-menu-item', 'Admin\MenuItemsController@updateOrder')->name('update-menu-item');

    Route::resource('product-wise-reviews', 'Admin\ProductWiseReviewsController', ['as' => 'admin']);

    Route::get('product/reviews/{id}', 'Admin\ProductController@productWiseReviews')
        ->name('admin-product-wise-reviews');

    Route::resource('banner', 'Admin\BannerController');

    Route::resource('retailer', 'Admin\RetailerController');

    Route::resource('wholesaler', 'Admin\WholesalerController');

    Route::resource('customer', 'Admin\CustomerController');

    Route::resource('admin', 'Admin\AdminController');

    Route::resource('brand', 'Admin\BrandController', ['as' => 'admin']);

    Route::resource('direct-order', 'Admin\DirectOrderController', ['as' => 'admin']);




    Route::resource('order', 'Admin\OrderController', ['as' => 'admin']);

    Route::get('pending-orders', [
        'as' => 'admin.pending',
        'uses' => 'Admin\OrderController@pendingOrders'
    ]);

    Route::get('cancelled-orders', [
        'as' => 'admin.cancelled',
        'uses' => 'Admin\OrderController@cancelledOrders'
    ]);
    Route::get('delivered-orders', [
        'as' => 'admin.delivered',
        'uses' => 'Admin\OrderController@deliveredOrders'
    ]);

    Route::get('out-for-delivery', [
        'as' => 'admin.out-for-delivery',
        'uses' => 'Admin\OrderController@outForDelivery'
    ]);

    Route::resource('query', 'Admin\QueryController');

    Route::resource('category', 'Admin\CategoryController', ['as' => 'admin']);

    Route::resource('category-wise-sub-category', 'Admin\CategoryWiseSCController', ['as' => 'admin']);

    Route::get('category-wise-sub-category/create/{slug}', [
        'as' => 'admin.category-wise-sub-category.create',
        'uses' => 'Admin\CategoryWiseSCController@create'
    ]);

    Route::resource('sub-category', 'Admin\SubCategoryController', ['as' => 'admin']);

    Route::resource('sub-category-wise-brands', 'Admin\SCWiseBrandsController', ['as' => 'admin']);

    Route::get('sub-category-wise-brands/create/{slug}', [
        'as' => 'admin.sub-category-wise-brands.create',
        'uses' => 'Admin\SCWiseBrandsController@create'
    ]);

    Route::resource('brand-wise-products', 'Admin\BrandWiseProducts', ['as' => 'admin']);

    Route::get('brand-wise-products/create/{slug}', [
        'as' => 'admin.brand-wise-products.create',
        'uses' => 'Admin\BrandWiseProducts@create'
    ]);

    Route::resource('payment-method', 'Admin\PaymentMethodController', ['as' => 'admin']);

    Route::resource('page', 'Admin\PageController', ['as' => 'admin']);

    Route::post('admin-page-ckeditor-image', 'Admin\CkeditorController@pageImage')
        ->name('admin-ckeditor-page-image.upload');

    Route::resource('product', 'Admin\ProductController', ['as' => 'admin']);

    Route::post('admin-ckeditor-product-image', 'Admin\CkeditorController@uploadProductImage')
        ->name('admin-ckeditor-product-image.upload');

    Route::resource('site-settings', 'Admin\SiteSettingController');
});

Route::group(['prefix' => 'retailer', 'middleware' => ['auth:retailer']], function () {
    // Route::view('/dashboard', 'Dashboard/Retailer/Dashboard/index');
    Route::get('/dashboard', 'Retailer\DashboardController@index');

    Route::resource('profile', 'Commons\ProfileController', ['as' => 'retailer_profile']);

    Route::get('/change-password', 'Commons\ProfileController@changePassword');
    Route::put('/update-password', 'Commons\ProfileController@updatePassword');


    Route::resource('brand', 'Admin\BrandController', ['as' => 'retailer']);

    Route::resource('order', 'Admin\OrderController', ['as' => 'retailer']);

    Route::get('pending-orders', [
        'as' => 'retailer.pending',
        'uses' => 'Admin\OrderController@pendingOrders'
    ]);
    Route::get('delivered-orders', [
        'as' => 'retailer.delivered',
        'uses' => 'Admin\OrderController@deliveredOrders'
    ]);

    Route::get('out-for-delivery', [
        'as' => 'retailer.out-for-delivery',
        'uses' => 'Admin\OrderController@outForDelivery'
    ]);

    Route::resource('product-wise-reviews', 'Admin\ProductWiseReviewsController', ['as' => 'retailer']);

    Route::get('product/reviews/{id}', 'Admin\ProductController@productWiseReviews')
        ->name('retailer-product-wise-reviews');



    Route::resource('category', 'Admin\CategoryController', ['as' => 'retailer']);

    Route::resource('category-wise-sub-category', 'Admin\CategoryWiseSCController', ['as' => 'retailer']);

    Route::get('category-wise-sub-category/create/{slug}', [
        'as' => 'retailer.category-wise-sub-category.create',
        'uses' => 'Admin\CategoryWiseSCController@create'
    ]);

    Route::resource('sub-category', 'Admin\SubCategoryController', ['as' => 'retailer']);


    Route::resource('sub-category-wise-brands', 'Admin\SCWiseBrandsController', ['as' => 'retailer']);

    Route::get('sub-category-wise-brands/create/{slug}', [
        'as' => 'retailer.sub-category-wise-brands.create',
        'uses' => 'Admin\SCWiseBrandsController@create'
    ]);

    Route::resource('brand-wise-products', 'Admin\BrandWiseProducts', ['as' => 'retailer']);

    Route::get('brand-wise-products/create/{slug}', [
        'as' => 'retailer.brand-wise-products.create',
        'uses' => 'Admin\BrandWiseProducts@create'
    ]);


    Route::resource('product', 'Admin\ProductController', ['as' => 'retailer']);

    Route::post('retailer-ckeditor-product-image', 'Admin\CkeditorController@uploadProductImage')
        ->name('retailer-ckeditor-product-image.upload');
});

Route::group(['prefix' => 'customer', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', 'Customer\DashboardController@index');
    Route::get('/home', 'Customer\AccountController@index')->name('customer.home');
    Route::get('/profile', 'Customer\ProfileController@index');
    Route::get('/profile/edit', 'Customer\ProfileController@edit');
    Route::put('/profile/update', 'Customer\ProfileController@update');
    Route::get('/order', 'Customer\OrderController@index', ['as' => 'customer.order']);
    Route::get('/reviews', 'Customer\ReviewController@index');
    // Route::get('/checkout', 'Customer\CartController@checkout');

    // Route::resource('profile', 'Customer\ProfileController', ['as' => 'customer_profile']);

    Route::get('/change-password', 'Customer\ProfileController@changePassword');
    Route::put('/update-password', 'Customer\ProfileController@updatePassword');
});

//for index-page-cart
Route::post('/index/cart','Frontend\CartController@addindexPageCart')->name('index.cart.store');

Route::get('admin/product/{product}/destroy','Admin\ProductController@destroyProduct')->name('admin.destroy.product');
Route::get('/admin/brand/{brand}/destroy/','Admin\BrandController@destroyBrand')->name('admin.destroy.brand');

Route::get('/admin/category/{category}/destroy/','Admin\CategoryController@destroyCategory')->name('admin.destroy.category');

//advertisement
Route::get('/admin/advertisement/','Admin\AdvertisementController@index')->name('admin.advertisement.index');
Route::get('/admin/advertisement/create','Admin\AdvertisementController@create')->name('admin.advertisement.create');
Route::post('/admin/advertisement/store','Admin\AdvertisementController@store')->name('admin.advertisement.store');
Route::get('/admin/advertisement/{advertisement}/edit','Admin\AdvertisementController@edit')->name('admin.advertisement.edit');
Route::put('/admin/advertisement/{advertisement}','Admin\AdvertisementController@update')->name('admin.advertisement.update');
Route::get('/admin/advertisement/{advertisement}/delete','Admin\AdvertisementController@destroy')->name('admin.advertisement.destroy');

// view all
Route::get('view/just-for-you','Frontend\ProductController@viewAllJustForYou')->name('just.for.you');
Route::get('view/featured-product','Frontend\ProductController@viewAllFeaturedProduct')->name('featured.product');
Route::get('view/new-arrival','Frontend\ProductController@viewAllNewArrival')->name('new.arrival.product');

//map
Route::get('/admin/map/edit','Admin\MapController@edit')->name('admin.map.edit');
Route::put('/map/update','Admin\MapController@update')->name('admin.map.update');


// mail/contact
Route::get('/contact/us','Frontend\MailController@index')->name('user.contact.us');
Route::post('/mail/us','Frontend\MailController@contactForm')->name('user.mail.us');

Route::get('/order/excel/download','Customer\OrderController@exportOrder')->name('export.order');

//advertisement1
Route::get('/admin/advertisement1/','Admin\Advertisement1Controller@index')->name('admin.advertisement1.index');
Route::get('/admin/advertisement1/create','Admin\Advertisement1Controller@create')->name('admin.advertisement1.create');
Route::post('/admin/advertisement1','Admin\Advertisement1Controller@store')->name('admin.advertisement1.store');
Route::get('/admin/advertisement1/{advertisement}/edit','Admin\Advertisement1Controller@edit')->name('admin.advertisement1.edit');
Route::put('/admin/advertisement1/{advertisement}','Admin\Advertisement1Controller@update')->name('admin.advertisement1.update');
Route::get('/admin/advertisement1/{advertisement}/delete','Admin\Advertisement1Controller@destroy')->name('admin.advertisement1.destroy');



Route::get('/scrap-sell','Frontend\ScrapSellController@index')->name('user.scrap-sell')->middleware('auth');
Route::post('/scrap-sell','Frontend\ScrapSellController@store')->name('user.scrap-sell.store')->middleware('auth');

//advertisement2
Route::get('/admin/advertisement2/','Admin\Advertisment2Controller@index')->name('admin.advertisement2.index');
Route::get('/admin/advertisement2/create','Admin\Advertisment2Controller@create')->name('admin.advertisement2.create');
Route::post('/admin/advertisement2','Admin\Advertisment2Controller@store')->name('admin.advertisement2.store');
Route::get('/admin/advertisement2/{advertisement}/edit','Admin\Advertisment2Controller@edit')->name('admin.advertisement2.edit');
Route::put('/admin/advertisement2/{advertisement}','Admin\Advertisment2Controller@update')->name('admin.advertisement2.update');
Route::get('/admin/advertisement2/{advertisement}/delete','Admin\Advertisment2Controller@destroy')->name('admin.advertisement2.destroy');

Route::get('customer/track/order', 'Customer\OrderController@trackOrder');
Route::get('customer/payment', 'Customer\OrderController@paymentHistory')->name('customer.payment.history');

Route::get('customer/check/order/{orderId}', 'Customer\OrderController@orderCheck')->name('customer.order.check');