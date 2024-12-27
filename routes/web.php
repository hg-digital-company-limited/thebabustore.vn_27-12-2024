<?php

use App\Http\Controllers\CheckPaymentController;
use App\Livewire\Bank;
use App\Livewire\ProductDetail1;
use App\Livewire\Shop;
use App\Livewire\Thankyou;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Livewire\Cart;
use App\Livewire\Checkout;
use App\Livewire\ProductDetail;
use App\Livewire\Home;
use App\Livewire\About;
use App\Livewire\Contact;
use App\Livewire\ShippingPolicy;
use App\Livewire\PrivacyPolicy;
use App\Livewire\PaymentPolicy;
use App\Livewire\Transactions;
use App\Livewire\WarrantyPolicy;
use App\Livewire\ReturnPolicy;
use App\Livewire\OrderTracking;
use App\Livewire\Blog;
use App\Livewire\Search;
use App\Livewire\BlogPost;
use App\Livewire\Account;
use App\Livewire\AccountOrders;
use App\Livewire\ChangePassword;
use App\Livewire\AccountAddresses;
use App\Livewire\AccountOrdersDetail;
use App\Livewire\Login;
use App\Livewire\Logout;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Home::class);
Route::get('/about', About::class);
Route::get('/contact', Contact::class);
Route::get('/chinh-sach-van-chuyen', ShippingPolicy::class);
Route::get('/chinh-sach-bao-mat', PrivacyPolicy::class);
Route::get('/chinh-sach-thanh-toan', PaymentPolicy::class);
Route::get('/chinh-sach-bao-hanh', WarrantyPolicy::class);
Route::get('/chinh-sach-doi-tra-hang-hoan-tien', ReturnPolicy::class);
// Route::get('/apps/kiem-tra-don-hang', OrderTracking::class);
Route::get('/blogs', Blog::class);
Route::get('/blog/{slug}', BlogPost::class);
Route::get('/search', Search::class);

// Account routes

Route::middleware([CheckLogin::class])->group(function () {
    Route::get('/account', Account::class);
    Route::get('/account/orders', AccountOrders::class);
    Route::get('/account/orders/{orderCode}', AccountOrdersDetail::class);
    Route::get('/account/changepassword', ChangePassword::class);
    // Route::get('/account/addresses', AccountAddresses::class);
    Route::get('/account/logout', Logout::class);
    Route::get('/checkout', Checkout::class);
    Route::get('/thanks/{orderCode}', Thankyou::class)->name('thanks');
    Route::get('/bank/{orderCode}', Bank::class)->name('bank');
});




Route::get('/shop', Shop::class);
Route::get('/cart', Cart::class);
Route::get('/product/{slug}', ProductDetail::class);
Route::get('/product1/{slug}', ProductDetail1::class);



Route::middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::get('/auth/google', [Login::class, 'redirectToProvider'])->name('google.login');
    Route::get('/auth/google/register', [Register::class, 'redirectToProvider'])->name('google.register');
    Route::get('/auth/google/callback', [Login::class, 'handleGoogleCallback']);
    Route::get('/account/login', Login::class);
    Route::get('/account/register', Register::class);
});
Route::get('/checkpayment/{orderCode}', [CheckPaymentController::class, 'checkPayment']);
Route::get('/transactions', Transactions::class);
