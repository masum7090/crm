<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\TwoFactorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Middleware\Google2FAMiddleware;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\MailSettingController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleAssignController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\DomainExtensionController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\DomainController;








Route::name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::middleware('guest:admin')->group(function () {
            Route::get('/login', [AuthenticatedSessionController::class, 'adminCreate'])->name('create');
            Route::post('/login', [AuthenticatedSessionController::class, 'adminStore'])->name('login.submit');

        });

        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/2fa/enable', [TwoFactorController::class, 'enable'])->name('2fa.enable');
            Route::post('/2fa/confirm', [TwoFactorController::class, 'confirm'])->name('2fa.confirm');
            Route::get('/2fa/verify', [TwoFactorController::class, 'showVerify'])->name('2fa.verify');
            Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify.post');
            Route::post('/2fa/disable', [TwoFactorController::class, 'disable'])->name('2fa.disable');

            Route::middleware([Google2FAMiddleware::class])->group(function () {
                Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
                Route::post('logout', [AuthenticatedSessionController::class, 'adminLogout'])->name('logout');

                Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
                Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
                Route::post('/password_update', [ProfileController::class, 'password_update'])->name('password.update');

                Route::get('/mail-settings', [MailSettingController::class, 'index'])->name('mail.index');
                Route::post('/mail-settings', [MailSettingController::class, 'update'])->name('mail.update');
                Route::post('/mail/test', [MailSettingController::class, 'sendTestMail'])->name('mail.test');

                Route::resource('roles', RoleController::class);
                Route::resource('permissions', PermissionController::class);
                Route::get('role-assign', [RoleAssignController::class, 'index'])->name('role.assign.index');
                Route::post('role-assign', [RoleAssignController::class, 'store'])->name('role.assign.store');
                Route::resource('countries', CountryController::class);
                Route::get('/{id}/edit', [CountryController::class, 'edit'])->name('edit');
                Route::put('/{id}', [CountryController::class, 'update'])->name('update');
                Route::delete('/{id}', [CountryController::class, 'destroy'])->name('destroy');
                Route::resource('clients', ClientController::class);
                Route::get('/{id}/edit', [ClientController::class, 'edit'])->name('edit');
                Route::put('/{id}', [ClientController::class, 'update'])->name('update');
                Route::resource('categories', CategoryController::class);
                Route::resource('domain-extensions', DomainExtensionController::class);
                Route::resource('providers', ProviderController::class);

                // Orders & Invoices
                Route::resource('orders', OrderController::class);
                Route::post('orders/{order}/generate-invoice', [OrderController::class, 'generateInvoice'])->name('orders.generate-invoice');
                
                Route::resource('invoices', InvoiceController::class)->only(['index', 'show']);
                Route::post('invoices/{invoice}/update-status', [InvoiceController::class, 'updateStatus'])->name('invoices.update-status');
                
                // Domains
                Route::get('domains-list', [DomainController::class, 'index'])->name('domains.index');
            });
        });
    });
