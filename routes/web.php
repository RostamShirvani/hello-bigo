<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\CategoryController as HomeCategoryController;
use App\Http\Controllers\Home\CommentController as HomeCommentController;
use App\Http\Controllers\Home\CompareController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\PaymentController;
use App\Http\Controllers\Home\ProductController as HomeProductController;
use App\Http\Controllers\Home\UserProfileController;
use App\Http\Controllers\Home\WishlistController;
use App\Http\Controllers\UserAddressController;
use Illuminate\Support\Facades\Route;

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

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard');

Route::prefix('/admin')->name('admin.')->middleware(['role:super_admin'])->group(callback: function (){
    Route::resource('brands', BrandController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('products', ProductController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('coupons', CouponController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::get('/settings/edit', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings/update', [SettingController::class, 'update'])->name('settings.update');

    Route::get('/comments/{comment}/change-approve', [CommentController::class, 'changeApprove'])->name('comments.change-approve');
    // Get category attributes
    Route::get('/category-attributes/{category}', [CategoryController::class, 'getCategoryAttributes']);

    // Edit product images
    Route::get('/products/{product}/edit-images', [ProductImageController::class, 'edit'])->name('products.images.edit');
    Route::delete('/products/{product}/images-destroy', [ProductImageController::class, 'destroy'])->name('products.images.destroy');
    Route::put('/products/{product}/images-set-primary', [ProductImageController::class, 'setPrimary'])->name('products.images.set_primary');
    Route::post('/products/{product}/images-add', [ProductImageController::class, 'add'])->name('products.images.add');

    // Edit product category
    Route::get('/products/{product}/edit-category', [ProductController::class, 'editCategory'])->name('products.category.edit');
    Route::put('/products/{product}/update-category', [ProductController::class, 'updateCategory'])->name('products.category.update');
});

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/categories/{category:slug}', [HomeCategoryController::class, 'show'])->name('home.categories.show');
Route::get('/products/{product:slug}', [HomeProductController::class, 'show'])->name('home.products.show');
Route::post('/comments/{product}', [HomeCommentController::class, 'store'])->name('home.comments.store');

Route::get('/add-to-wishlist/{product}', [WishlistController::class, 'add'])->name('home.wishlist.add');
Route::get('/remove-from-wishlist/{product}', [WishlistController::class, 'remove'])->name('home.wishlist.remove');

Route::get('/compare', [CompareController::class, 'index'])->name('home.compare.index');
Route::get('/add-to-compare/{product}', [CompareController::class, 'add'])->name('home.compare.add');
Route::get('/remove-from-compare/{product}', [CompareController::class, 'remove'])->name('home.compare.remove');

Route::get('/cart', [CartController::class, 'index'])->name('home.cart.index');
Route::post('/add-to-cart', [CartController::class, 'add'])->name('home.cart.add');
Route::get('/remove-from-cart/{rowId}', [CartController::class, 'remove'])->name('home.cart.remove');
Route::put('/cart', [CartController::class, 'update'])->name('home.cart.update');
Route::get('/clear-cart', [CartController::class, 'clear'])->name('home.cart.clear');
Route::post('/check-coupon', [CartController::class, 'checkCoupon'])->name('home.coupons.check');
Route::get('/checkout', [CartController::class, 'checkout'])->name('home.orders.checkout')->middleware('auth');

Route::post('/payment', [PaymentController::class, 'payment'])->name('home.payment');
Route::get('/payment-verify/{gatewayName}', [PaymentController::class, 'paymentVerify'])->name('home.payment_verify');

// login with google account and ...
Route::get('/login/{provider}' , [AuthController::class , 'redirectToProvider'])->name('provider.login');
Route::get('/login/{provider}/callback' , [AuthController::class , 'handleProviderCallback']);

Route::any('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/check-otp', [AuthController::class, 'checkOtp']);
Route::post('/resend-otp', [AuthController::class, 'resendOtp']);
Route::post('/register-new-user', [AuthController::class, 'registerNewUser']);
//Route::post('/login-with-password', [AuthController::class, 'loginWithPassword']);

Route::prefix('profile')->name('home.')->middleware('auth')->group(function (){
    Route::get('/', [UserProfileController::class, 'index'])->name('users_profile.index');

    Route::get('/comments', [HomeCommentController::class, 'usersProfileIndex'])->name('comments.users_profile.index');

    Route::get('/wishlist', [WishlistController::class, 'usersProfileWishlist'])->name('wishlist.users_profile.index');

    Route::get('/addresses', [UserAddressController::class, 'index'])->name('addresses.index');
    Route::post('/addresses', [UserAddressController::class, 'store'])->name('addresses.store');
    Route::put('/addresses/{address}', [UserAddressController::class, 'update'])->name('addresses.update');

    Route::get('/orders', [UserProfileController::class, 'usersProfileIndex'])->name('users_profile.orders');
    Route::get('/fallback/{order}', [UserProfileController::class, 'fallback'])->name('users_profile.fallback');

    Route::post('/update-profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/change-password', [UserProfileController::class, 'changePassword'])->name('change.password');
});

Route::get('/get-province-cities-list', [UserAddressController::class, 'getProvinceCitiesList']);

Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('home.about-us');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('home.contact-us');
Route::post('/contact-us-form', [HomeController::class, 'contactUsForm'])->name('home.contact-us.form');

Route::get('/test', function (){
//    \Cart::clear();
    dd(\Cart::getContent());
});


//Route::get('login', function () {
//    return redirect()->route('site.homes.index', ['modal' => 'authModal']);
//})->name('login');

Route::get('/images/profiles/{url}', function ($url) {
    $img = file_get_contents("https://bigotop.com/images/profiles/{$url}.jpg");
    return response($img)->header('Content-type', 'image/png');
})->name('images.process');

Route::get('/images/load', function () {
    $data = request()->input('data');
    $img = file_get_contents($data);
    return response($img)->header('Content-type', 'image/png');
})->name('images.load');

Route::get('/bigo-user/{bigoId}', [\App\Http\Controllers\API\User\UserController::class, 'getBigoUser']);

//Route::get('/links', function() {
//    if(request()->ip() === '54.36.151.105' || request()->ip() === '144.91.122.91'){
//
//        $silverLinks = SilverLink::query()->orderBy('id', 'desc')->limit(10)->get();
//        return response()->json($silverLinks->toArray());
//    }
//});
//Route::delete('/delete/{id}' , function($id) {
//    $blacklist = Blacklist::findOrFail($id);
//
//    $blacklist->delete();
//
//    return back()->with('success' , 'کاربر   با موفقیت از بلک لیست حذف شد!');
//});
