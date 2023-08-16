<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\TypeController as AdminTypeController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

use App\Http\Controllers\Front\HomeController as FrontHomeController;
use App\Http\Controllers\Front\CatalogController as FrontCatalogController;
use App\Http\Controllers\Front\DetailController as FrontDetailController;
use App\Http\Controllers\Front\CheckoutController as FrontCheckoutController;
use App\Http\Controllers\Front\PaymentController as FrontPaymentController;
use App\Http\Controllers\Front\BookingController as FrontBookingController;


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

Route::name('front.')->group(function () {
    Route::get('/', [FrontHomeController::class, 'index'])->name('home');
    Route::get('/katalog', [FrontCatalogController::class, 'index'])->name('catalog');
    Route::get('/katalog/{type}', [FrontCatalogController::class, 'type'])->name('catalog.type');
    Route::get('/katalog/{slug}/detail', [FrontDetailController::class, 'index'])->name('catalog.detail');
    Route::get('/bookings', [FrontBookingController::class, 'index'])->name('bookings');
    Route::get('/faq', function () {
        return view('front.faq');
    })->name('faq');

    Route::group(['middleware', 'auth'], function() {
        Route::get('/katalog/{slug}/checkout', [FrontCheckoutController::class, 'index'])->name('catalog.checkout');
        Route::post('/katalog/{slug}/checkout', [FrontCheckoutController::class, 'store'])->name('catalog.checkout.store');
        Route::get('/payment/{bookingId}', [FrontPaymentController::class, 'index'])->name('payment');
        Route::get('/payment/{bookingId}/detail', [FrontPaymentController::class, 'update'])->name('payment.update');
        Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    });
});

Route::prefix('admin')->name('admin.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin'
])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/types', AdminTypeController::class);
    Route::resource('/cars', AdminCarController::class);
    Route::resource('/bookings', AdminBookingController::class);
});
