<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\DomainSearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;
use App\Http\Controllers\Client\InvoiceController as ClientInvoiceController;
use App\Http\Controllers\Client\PdfController;
use App\Http\Controllers\Client\PaymentController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', function () {
    return view('market_place.home');
});
Route::post('/check-domain', [DomainSearchController::class, 'check'])->name('check.domain');
Route::get('/plans', function () {
    $domain = request()->get('domain');
    return view('market_place.partials.plans', compact('domain'));
})->name('plans');

Route::get('/checkout-page', function () {
    return view('market_place.partials.checkout-page');
})->name('checkout-page');

Route::get('/dashboard', function () {
    return view('market_place.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/{id}/edit', [ClientController::class, 'edit'])->name('edit');
Route::put('/{id}', [ClientController::class, 'update'])->name('update');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Client Dashboard Routes
    Route::name('client.')->group(function () {
        Route::resource('my-orders', ClientOrderController::class)
            ->only(['index', 'show'])
            ->names([
                'index' => 'orders.index',
                'show' => 'orders.show',
            ]);
            
        Route::resource('my-invoices', ClientInvoiceController::class)
            ->only(['index', 'show'])
            ->names([
                'index' => 'invoices.index',
                'show' => 'invoices.show',
            ]);

        Route::get('invoices/{invoice}/pdf', [PdfController::class, 'downloadInvoice'])->name('invoices.pdf');
        
        Route::get('invoices/{invoice}/pay', [PaymentController::class, 'pay'])->name('invoices.pay');
        Route::get('payment/success', [PaymentController::class, 'success'])->name('payment.success');
        Route::get('payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
    });
});
Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
